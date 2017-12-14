<?php
/**
 * Copyright (c) Enalean, 2014 - 2017. All Rights Reserved.
 *
 * This file is a part of Tuleap.
 *
 * Tuleap is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Tuleap is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Tuleap. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Tuleap\TestManagement\REST\v1;

use EventManager;
use Project_AccessException;
use Project_AccessProjectNotFoundException;
use Tracker_Exception;
use Tracker_FormElement_InvalidFieldException;
use Tracker_FormElement_InvalidFieldValueException;
use Tracker_NoChangeException;
use Tracker_ChangesetNotCreatedException;
use Tracker_CommentNotStoredException;
use Tracker_AfterSaveException;
use Tracker_ChangesetCommitException;
use Tuleap\TestManagement\LabelFieldNotFoundException;
use Tracker_Permission_PermissionRetrieveAssignee;
use Tracker_Permission_PermissionsSerializer;
use Tracker_URLVerification;
use Tuleap\RealTime\NodeJSClient;
use Tuleap\REST\Header;
use Luracast\Restler\RestException;
use Tracker_ArtifactFactory;
use Tracker_FormElementFactory;
use ProjectManager;
use Tuleap\TestManagement\MilestoneItemsArtifactFactory;
use Tuleap\TestManagement\RealTime\RealTimeMessageSender;
use Tuleap\REST\ProjectAuthorization;
use Tuleap\TestManagement\ArtifactDao;
use Tuleap\TestManagement\ArtifactFactory;
use UserManager;
use PFUser;
use Tuleap\TestManagement\ConfigConformanceValidator;
use Tuleap\TestManagement\Config;
use Tuleap\TestManagement\Dao;
use Tracker_Artifact;
use Tracker_Artifact_PriorityDao;
use Tracker_Artifact_PriorityManager;
use Tracker_Artifact_PriorityHistoryDao;
use TrackerFactory;
use Tracker_REST_Artifact_ArtifactCreator;
use Tracker_REST_Artifact_ArtifactUpdater;
use Tracker_REST_Artifact_ArtifactValidator;
use Tracker_ReportFactory;
use Tuleap\Tracker\REST\v1\ArtifactLinkUpdater;

class CampaignsResource {

    const MAX_LIMIT = 50;

    /** @var Config */
    private $config;

    /** @var UserManager */
    private $user_manager;

    /** @var Tracker_ArtifactFactory */
    private $artifact_factory;

    /** @var ArtifactFactory */
    private $testmanagement_artifact_factory;

    /** @var Tracker_FormElementFactory */
    private $formelement_factory;

    /** @var ExecutionCreator */
    private $execution_creator;

    /** @var ConfigConformanceValidator */
    private $conformance_validator;

    /** @var ExecutionRepresentationBuilder */
    private $execution_representation_builder;

    /** @var CampaignRepresentationBuilder */
    private $campaign_representation_builder;

    /** @var ProjectManager */
    private $project_manager;

    /** @var TrackerFactory */
    private $tracker_factory;

    /** @var ArtifactLinkUpdater */
    private $artifactlink_updater;

    /** @var RealTimeMessageSender  */
    private $realtime_message_sender;

    public function __construct() {
        $this->project_manager                = ProjectManager::instance();
        $this->user_manager                   = UserManager::instance();
        $this->tracker_factory                = TrackerFactory::instance();
        $this->artifact_factory               = Tracker_ArtifactFactory::instance();
        $this->formelement_factory            = Tracker_FormElementFactory::instance();
        $this->config                         = new Config(new Dao());
        $this->conformance_validator          = new ConfigConformanceValidator(
            $this->config
        );
        $artifact_dao                         = new ArtifactDao();

        $this->testmanagement_artifact_factory = new ArtifactFactory(
            $this->config,
            $this->artifact_factory,
            $artifact_dao
        );

        $milestone_items_artifact_factory = new MilestoneItemsArtifactFactory(
            $this->config,
            $artifact_dao,
            $this->artifact_factory,
            EventManager::instance()
        );

        $assigned_to_representation_builder = new AssignedToRepresentationBuilder(
            $this->formelement_factory,
            $this->user_manager
        );

        $retriever = new RequirementRetriever($this->artifact_factory, $artifact_dao, $this->config);

        $this->execution_representation_builder   = new ExecutionRepresentationBuilder(
            $this->user_manager,
            $this->formelement_factory,
            $this->conformance_validator,
            $assigned_to_representation_builder,
            $artifact_dao,
            $this->artifact_factory,
            $retriever
        );

        $this->campaign_representation_builder    = new CampaignRepresentationBuilder(
            $this->user_manager,
            $this->formelement_factory,
            $this->testmanagement_artifact_factory
        );

        $artifact_validator = new Tracker_REST_Artifact_ArtifactValidator(
            $this->formelement_factory
        );

        $artifact_creator = new Tracker_REST_Artifact_ArtifactCreator(
            $artifact_validator,
            $this->artifact_factory,
            $this->tracker_factory
        );

        $this->execution_creator = new ExecutionCreator(
            $this->formelement_factory,
            $this->config,
            $this->project_manager,
            $this->tracker_factory,
            $artifact_creator
        );

        $definition_selector = new DefinitionSelector(
            $this->config,
            $this->testmanagement_artifact_factory,
            new ProjectAuthorization(),
            $this->artifact_factory,
            $milestone_items_artifact_factory,
            Tracker_ReportFactory::instance()
        );

        $this->campaign_creator = new CampaignCreator(
            $this->config,
            $this->project_manager,
            $this->formelement_factory,
            $this->tracker_factory,
            $definition_selector,
            $artifact_creator,
            $this->execution_creator
        );

        $artifact_updater = new Tracker_REST_Artifact_ArtifactUpdater (
            $artifact_validator
        );

        $this->campaign_updater = new CampaignUpdater(
            $this->formelement_factory,
            $artifact_updater
        );

        $priority_manager           = new Tracker_Artifact_PriorityManager(
            new Tracker_Artifact_PriorityDao(),
            new Tracker_Artifact_PriorityHistoryDao(),
            $this->user_manager,
            $this->artifact_factory
        );

        $this->artifactlink_updater = new ArtifactLinkUpdater($priority_manager);

        $node_js_client         = new NodeJSClient();
        $permissions_serializer = new Tracker_Permission_PermissionsSerializer(
            new Tracker_Permission_PermissionRetrieveAssignee(UserManager::instance())
        );

        $this->realtime_message_sender = new RealTimeMessageSender(
            $node_js_client,
            $permissions_serializer,
            $this->testmanagement_artifact_factory
        );
    }

    /**
     * @url OPTIONS {id}
     */
    public function optionsId($id) {
        Header::allowOptionsGet();
    }

    /**
     * Get campaign
     *
     * Get testing campaign by its id
     *
     * @url GET {id}
     *
     * @param int $id Id of the campaign
     *
     * @return Tuleap\TestManagement\REST\v1\CampaignRepresentation
     */
    protected function getId($id) {
        $this->optionsId($id);

        $user     = $this->user_manager->getCurrentUser();
        $campaign = $this->getCampaignFromId($id, $user);

        return $this->campaign_representation_builder->getCampaignRepresentation($user, $campaign);
    }

    /**
     * @url OPTIONS {id}/testmanagement_executions
     */
    public function optionsExecutions($id) {
        Header::allowOptionsGet();
    }

    /**
     * Get executions
     *
     * Get executions of a given campaign
     *
     * @url GET {id}/testmanagement_executions
     *
     * @param int $id Id of the campaign
     * @param int $limit  Number of elements displayed per page {@from path}
     * @param int $offset Position of the first element to display {@from path}
     *
     * @return array {@type Tuleap\TestManagement\REST\v1\ExecutionRepresentation}
     */
    protected function getExecutions($id, $limit = 10, $offset = 0) {
        $this->optionsExecutions($id);

        $user     = $this->user_manager->getCurrentUser();
        $campaign = $this->getCampaignFromId($id, $user);

        $execution_representations = $this->execution_representation_builder->getPaginatedExecutionsRepresentationsForCampaign(
            $user,
            $campaign,
            $this->config->getTestExecutionTrackerId($campaign->getTracker()->getProject()),
            $limit,
            $offset
        );

        $this->sendPaginationHeaders($limit, $offset, $execution_representations->getTotalSize());

        return $execution_representations->getRepresentations();
    }

    /**
     * PATCH test executions
     *
     * Create new test executions and unlink some test executions for a campaign
     *
     * @url PATCH {id}/testmanagement_executions
     *
     * @param int     $id                      Id of the campaign
     * @param string  $uuid                    UUID of current user {@from body}
     * @param array   $definition_ids_to_add   Test definition ids for which test executions should be created {@from body}
     * @param array   $execution_ids_to_remove Test execution ids which should be unlinked from the campaign {@from body}
     *
     * @return array {@type Tuleap\TestManagement\REST\v1\ExecutionRepresentation}
     */
    protected function patchExecutions($id, $uuid, $definition_ids_to_add, $execution_ids_to_remove)
    {
        $user                 = $this->user_manager->getCurrentUser();
        $campaign             = $this->getCampaignFromId($id, $user);
        $project              = $campaign->getTracker()->getProject();
        $project_id           = $project->getID();
        $new_execution_ids    = array();
        $executions_to_add    = array();
        $executions_to_remove = array();

        foreach ($definition_ids_to_add as $definition_id) {
            $new_execution_ref   = $this->execution_creator->createTestExecution(
                $project_id,
                $user,
                $definition_id
            );
            $new_execution_ids[] = $new_execution_ref->id;
            $executions_to_add[] = $new_execution_ref->getArtifact();
        }

        $executions_to_remove = $this->artifact_factory->getArtifactsByArtifactIdList($execution_ids_to_remove);

        $this->artifactlink_updater->updateArtifactLinks(
            $user,
            $campaign,
            $new_execution_ids,
            $execution_ids_to_remove,
            \Tracker_FormElement_Field_ArtifactLink::NO_NATURE
        );

        foreach($executions_to_remove as $execution) {
            $this->realtime_message_sender->sendExecutionDeleted($user, $campaign, $execution);
        }

        foreach ($executions_to_add as $execution) {
            $this->realtime_message_sender->sendExecutionCreated($user, $campaign, $execution);
        }

        $this->sendAllowHeadersForExecutionsList($campaign);

        $limit                     = 10;
        $offset                    = 0;
        $execution_representations = $this->execution_representation_builder->getPaginatedExecutionsRepresentationsForCampaign(
            $user,
            $campaign,
            $this->config->getTestExecutionTrackerId($project),
            $limit,
            $offset
        );

        $this->sendPaginationHeaders($limit, $offset, $execution_representations->getTotalSize());

        return $execution_representations->getRepresentations();
    }

    /**
     * @url OPTIONS
     */
    public function options() {
        Header::allowOptionsPost();
    }

    /**
     * POST campaign
     *
     * Create a new campaign
     *
     * @url POST
     *
     * @param int    $project_id    Id of the project the campaign will belong to
     * @param string $label         The label of the new campaign
     * @param string $test_selector The method used to set initial test definitions for campaign {@from query} {@choice none,all,milestone,report}
     * @param int    $milestone_id  Id of the milestone with which the campaign will be linked {@from query}
     * @param int    $report_id     Id of the report to retrieve test definitions for campaign {@from query}
     */
    protected function post($project_id, $label, $test_selector = 'all', $milestone_id = 0, $report_id = 0)
    {
        $this->options();
        return $this->campaign_creator->createCampaign(
            UserManager::instance()->getCurrentUser(),
            $project_id,
            $label,
            $test_selector,
            $milestone_id,
            $report_id
        );
    }

    /**
     * PATCH campaign
     *
     * @url PATCH {id}
     *
     * @param int     $id     Id of the campaign
     * @param string  $label  New label of the campaign {@from body}
     *
     * @return Tuleap\TestManagement\REST\v1\CampaignRepresentation
     *
     * @throws 400
     * @throws 403
     * @throws 500
     */
    protected function patch($id, $label = null)
    {
        $user                     = UserManager::instance()->getCurrentUser();
        $campaign                 = $this->getArtifactById($user, $id);
        $campaign_representation  = $this->campaign_representation_builder->getCampaignRepresentation($user, $campaign);

        if (! $campaign->userCanUpdate($user)) {
            throw new RestException(403, "You don't have the permission to update this campaign");
        }

        try {
            $this->campaign_updater->updateCampaign($user, $campaign, $label);

            $campaign_representation = $this->campaign_representation_builder->getCampaignRepresentation($user, $campaign);
        } catch (Tracker_ChangesetNotCreatedException $exception) {
            throw new RestException(400, $exception->getMessage());
        } catch (Tracker_CommentNotStoredException $exception) {
            throw new RestException(400, $exception->getMessage());
        } catch (Tracker_AfterSaveException $exception) {
            throw new RestException(400, $exception->getMessage());
        } catch (Tracker_ChangesetCommitException $exception) {
            throw new RestException(400, $exception->getMessage());
        } catch (Tracker_FormElement_InvalidFieldException $exception) {
            throw new RestException(400, $exception->getMessage());
        } catch (Tracker_FormElement_InvalidFieldValueException $exception) {
            throw new RestException(400, $exception->getMessage());
        } catch (Tracker_NoChangeException $exception) {
            // Do nothing
        } catch (LabelFieldNotFoundException $exception) {
            throw new RestException(500, $exception->getMessage());
        } catch (Tracker_Exception $exception) {
            throw new RestException(500, $exception->getMessage());
        }

        $this->realtime_message_sender->sendCampaignUpdated($user, $campaign);

        $this->sendAllowHeadersForCampaign($campaign);

        return $campaign_representation;
    }

    private function getCampaignFromId($id, PFUser $user) {
        $campaign = $this->testmanagement_artifact_factory->getArtifactById($id);

        if (! $this->isACampaign($campaign)) {
            throw new RestException(404, 'The campaign does not exist');
        }

        if (! $campaign->userCanView($user)) {
            throw new RestException(403, 'Access denied to this campaign');
        }

        return $campaign;
    }

    private function isACampaign($campaign) {
        return $campaign && $this->conformance_validator->isArtifactACampaign($campaign);
    }

    private function sendPaginationHeaders($limit, $offset, $size) {
        Header::sendPaginationHeaders($limit, $offset, $size, self::MAX_LIMIT);
    }

    private function sendAllowHeadersForExecutionsList(Tracker_Artifact $artifact)
    {
        $date = $artifact->getLastUpdateDate();
        Header::allowOptionsPatch();
        Header::lastModified($date);
    }


    /**
     * @param int $id
     *
     * @return Tracker_Artifact
     * @throws Project_AccessProjectNotFoundException 404
     * @throws Project_AccessException 403
     * @throws RestException 404
     */
    private function getArtifactById(PFUser $user, $id)
    {
        $artifact = $this->testmanagement_artifact_factory->getArtifactById($id);
        if ($artifact) {
            if (! $artifact->userCanView($user)) {
                throw new RestException(403);
            }

            ProjectAuthorization::userCanAccessProject($user, $artifact->getTracker()->getProject(), new Tracker_URLVerification());
            return $artifact;
        }
        throw new RestException(404);
    }

    private function sendAllowHeadersForCampaign(Tracker_Artifact $artifact)
    {
        $date = $artifact->getLastUpdateDate();
        Header::allowOptionsPatch();
        Header::lastModified($date);
    }
}
