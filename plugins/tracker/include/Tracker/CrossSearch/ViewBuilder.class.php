<?php
/**
 * Copyright (c) Enalean, 2012. All Rights Reserved.
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

require_once 'SemanticTitleReportField.class.php';
require_once 'Criteria.class.php';
require_once 'SemanticStatusReportField.class.php';
require_once 'SemanticValueFactory.class.php';
require_once 'CriteriaBuilder.class.php';
class Tracker_CrossSearch_ViewBuilder {
    /**
     * @var Tracker_FormElementFactory
     */
    private $form_element_factory;
    
    /**
     * @var TrackerFactory
     */
    private $tracker_factory;
    
    /**
     * @var Tracker_CrossSearch_Search
     */
    private $search;


    /**
     * @var Tracker_CrossSearch_CriteriaBuilder
     */
    private $criteria_builder;
    
    public function __construct(Tracker_FormElementFactory               $form_element_factory,
                                TrackerFactory                           $tracker_factory,
                                Tracker_CrossSearch_Search               $search,
                                Tracker_CrossSearch_CriteriaBuilder      $criteria_builder) {
        
        $this->form_element_factory   = $form_element_factory;
        $this->tracker_factory        = $tracker_factory;
        $this->search                 = $search;
        $this->criteria_builder       = $criteria_builder;
    }
    
    /**
     * @return Tracker_CrossSearch_SearchView 
     */
    public function buildView(Project $project, Tracker_CrossSearch_Criteria $request_criteria) {
        $service      = $this->getService($project);
        
        $criteria     = $this->criteria_builder->getCriteria($project, $this->getReport(), $request_criteria);
        $trackers     = $this->getTrackers($project, $this->tracker_factory);
        $content_view = $this->buildContentView($project, $request_criteria);
        
        return $this->getView($project, $service, $criteria, $trackers, $content_view);
   
    }
    
    /**
     * @return type Tracker_CrossSearch_SearchContentView
     */
    public function buildContentView(Project $project, Tracker_CrossSearch_Criteria $cross_search_criteria) {
        $tracker_ids = $this->getTrackersIds($project, $this->tracker_factory);
        
        return $this->buildCustomContentView('Tracker_CrossSearch_SearchContentView',
                                             $project,
                                             $cross_search_criteria,
                                             array(),
                                             $tracker_ids);
    }
    
    public function buildCustomContentView($classname, Project $project, Tracker_CrossSearch_Criteria $request_criteria, array $excludedArtifactIds, array $tracker_ids) {
        $report    = $this->getReport();
        $criteria  = $this->criteria_builder->getCriteria($project, $report, $request_criteria);
        $artifacts = $this->search->getHierarchicallySortedArtifacts($tracker_ids, $request_criteria, $excludedArtifactIds);
        
        return $this->getContentView($classname, $report, $criteria, $artifacts);
    }
    

    protected function getView(Project $project, Service $service, $criteria, $trackers, $content_view) {
        return new Tracker_CrossSearch_SearchView($project, $service, $criteria, $trackers, $content_view);
    }
    
    /**
     * @return Service
     */
    private function getService(Project $project) {
        $service = $project->getService('plugin_tracker');
        
        if ($service) {
            return $service;
        } else {
            $service_label = $GLOBALS['Language']->getText('plugin_tracker', 'title');
            $error_message = $GLOBALS['Language']->getText('project_service', 'service_not_used', array($service_label));
            
            throw new Tracker_CrossSearch_ServiceNotUsedException($error_message);
        }
    }
    protected function getContentView($classname, Tracker_Report $report, $criteria, $artifacts) {
        $artifact_factory = Tracker_ArtifactFactory::instance();
        
        return new $classname($report, $criteria, $artifacts, $artifact_factory, $this->form_element_factory);
    }
    
    private function getReport() {
        $name               = "Shared field search";
        $is_query_displayed = true;
        
        $report_id = $description = $current_renderer_id = $parent_report_id
            = $user_id = $is_default = $tracker_id = $updated_by = $updated_at
            = 0;
        
        $report = new Tracker_Report($report_id, 
                                     $name, 
                                     $description, 
                                     $current_renderer_id, 
                                     $parent_report_id, 
                                     $user_id, 
                                     $is_default, 
                                     $tracker_id, 
                                     $is_query_displayed, 
                                     $updated_by, 
                                     $updated_at);
        return $report;
    }

    private function getTrackers(Project $project, $tracker_factory) {
        return $tracker_factory->getTrackersByGroupId($project->getGroupId());
    }
    
    public function getTrackersIds($project, $tracker_factory) {
        $trackers    = $this->getTrackers($project, $tracker_factory);
        $tracker_ids = array();
        
        foreach ($trackers as $tracker) {
            $tracker_ids[] = $tracker->getId();
        }
        
        return $tracker_ids;
    }
}
?>
