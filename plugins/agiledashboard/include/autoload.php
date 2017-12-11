<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
function autoloada5a8ecdef3c646bc06de6e31c730aea5($class) {
    static $classes = null;
    if ($classes === null) {
        $classes = array(
            'adminkanbanpresenter' => '/AgileDashboard/AdminKanbanPresenter.class.php',
            'adminscrumpresenter' => '/AgileDashboard/AdminScrumPresenter.class.php',
            'agiledashboard_backlogitem_paginatedbacklogitemsrepresentations' => '/AgileDashboard/BacklogItem/PaginatedBacklogItemsRepresentations.class.php',
            'agiledashboard_backlogitem_paginatedbacklogitemsrepresentationsbuilder' => '/AgileDashboard/BacklogItem/PaginatedBacklogItemsRepresentationsBuilder.class.php',
            'agiledashboard_backlogitem_subbacklogitemdao' => '/AgileDashboard/BacklogItem/SubBacklogItemDao.class.php',
            'agiledashboard_backlogitem_subbacklogitemprovider' => '/AgileDashboard/BacklogItem/SubBacklogItemProvider.class.php',
            'agiledashboard_backlogitemdao' => '/AgileDashboard/BacklogItemDao.class.php',
            'agiledashboard_backlogitempresenter' => '/AgileDashboard/BacklogItemPresenter.class.php',
            'agiledashboard_cardrepresentation' => '/AgileDashboard/REST/v1/CardRepresentation.class.php',
            'agiledashboard_columnrepresentation' => '/AgileDashboard/REST/v1/ColumnRepresentation.class.php',
            'agiledashboard_configurationdao' => '/AgileDashboard/ConfigurationDao.class.php',
            'agiledashboard_configurationmanager' => '/AgileDashboard/ConfigurationManager.class.php',
            'agiledashboard_controller' => '/AgileDashboard/AgileDashboardController.class.php',
            'agiledashboard_dao' => '/Dao.class.php',
            'agiledashboard_defaultpaneinfo' => '/AgileDashboard/DefaultPaneInfo.class.php',
            'agiledashboard_fieldpriorityaugmenter' => '/AgileDashboard/FieldPriorityAugmenter.php',
            'agiledashboard_firstkanbancreator' => '/AgileDashboard/FirstKanbanCreator.php',
            'agiledashboard_firstscrumcreator' => '/AgileDashboard/FirstScrumCreator.php',
            'agiledashboard_hierarchychecker' => '/AgileDashboard/HierarchyChecker.php',
            'agiledashboard_kanban' => '/AgileDashboard/Kanban.class.php',
            'agiledashboard_kanbanactionschecker' => '/AgileDashboard/KanbanActionsChecker.php',
            'agiledashboard_kanbancannotaccessexception' => '/AgileDashboard/KanbanCannotAccessException.php',
            'agiledashboard_kanbancolumn' => '/AgileDashboard/KanbanColumn.php',
            'agiledashboard_kanbancolumndao' => '/AgileDashboard/KanbanColumnDao.class.php',
            'agiledashboard_kanbancolumnfactory' => '/AgileDashboard/KanbanColumnFactory.php',
            'agiledashboard_kanbancolumnmanager' => '/AgileDashboard/KanbanColumnManager.php',
            'agiledashboard_kanbancolumnnotfoundexception' => '/AgileDashboard/KanbanColumnNotFoundException.php',
            'agiledashboard_kanbancolumnnotremovableexception' => '/AgileDashboard/KanbanColumnNotRemovableException.php',
            'agiledashboard_kanbandao' => '/AgileDashboard/KanbanDao.class.php',
            'agiledashboard_kanbanfactory' => '/AgileDashboard/KanbanFactory.class.php',
            'agiledashboard_kanbanitemdao' => '/AgileDashboard/KanbanItemDao.class.php',
            'agiledashboard_kanbanitemmanager' => '/AgileDashboard/KanbanItemManager.class.php',
            'agiledashboard_kanbanmanager' => '/AgileDashboard/KanbanManager.class.php',
            'agiledashboard_kanbannotfoundexception' => '/AgileDashboard/KanbanNotFoundException.php',
            'agiledashboard_kanbanuserpreferences' => '/AgileDashboard/KanbanUserPreferences.php',
            'agiledashboard_milestone_backlog_backlogitem' => '/AgileDashboard/Milestone/Backlog/BacklogItem.class.php',
            'agiledashboard_milestone_backlog_backlogitembuilder' => '/AgileDashboard/Milestone/Backlog/BacklogItemBuilder.class.php',
            'agiledashboard_milestone_backlog_backlogitemcollection' => '/AgileDashboard/Milestone/Backlog/BacklogItemCollection.class.php',
            'agiledashboard_milestone_backlog_backlogitemcollectionfactory' => '/AgileDashboard/Milestone/Backlog/BacklogItemCollectionFactory.class.php',
            'agiledashboard_milestone_backlog_backlogitempresenterbuilder' => '/AgileDashboard/Milestone/Backlog/BacklogItemPresenterBuilder.class.php',
            'agiledashboard_milestone_backlog_backlogitempresentercollection' => '/AgileDashboard/Milestone/Backlog/BacklogItemPresenterCollection.class.php',
            'agiledashboard_milestone_backlog_backlogrowpresenter' => '/AgileDashboard/Milestone/Backlog/BacklogRowPresenter.class.php',
            'agiledashboard_milestone_backlog_backlogstrategy' => '/AgileDashboard/Milestone/Backlog/BacklogStrategy.class.php',
            'agiledashboard_milestone_backlog_backlogstrategyfactory' => '/AgileDashboard/Milestone/Backlog/BacklogStrategyFactory.class.php',
            'agiledashboard_milestone_backlog_descendantbacklogstrategy' => '/AgileDashboard/Milestone/Backlog/DescendantBacklogStrategy.class.php',
            'agiledashboard_milestone_backlog_descendantitemscollection' => '/AgileDashboard/Milestone/Backlog/DescendantItemsCollection.class.php',
            'agiledashboard_milestone_backlog_descendantitemsfinder' => '/AgileDashboard/Milestone/Backlog/DescendantItemsFinder.class.php',
            'agiledashboard_milestone_backlog_ibacklogitem' => '/AgileDashboard/Milestone/Backlog/IBacklogItem.class.php',
            'agiledashboard_milestone_backlog_ibacklogitemcollection' => '/AgileDashboard/Milestone/Backlog/IBacklogItemCollection.class.php',
            'agiledashboard_milestone_backlog_ibuildbacklogitemandbacklogitemcollection' => '/AgileDashboard/Milestone/Backlog/IBuildBacklogItemAndBacklogItemCollection.class.php',
            'agiledashboard_milestone_milestonedao' => '/AgileDashboard/Milestone/MilestoneDao.class.php',
            'agiledashboard_milestone_milestonereportcriterionoptionsprovider' => '/AgileDashboard/Milestone/MilestoneReportCriterionOptionsProvider.class.php',
            'agiledashboard_milestone_milestonereportcriterionprovider' => '/AgileDashboard/Milestone/MilestoneReportCriterionProvider.class.php',
            'agiledashboard_milestone_milestonerepresentationbuilder' => '/AgileDashboard/Milestone/MilestoneRepresentationBuilder.class.php',
            'agiledashboard_milestone_milestonestatuscounter' => '/AgileDashboard/Milestone/MilestoneStatusCounter.class.php',
            'agiledashboard_milestone_paginatedmilestones' => '/AgileDashboard/Milestone/PaginatedMilestones.php',
            'agiledashboard_milestone_paginatedmilestonesrepresentations' => '/AgileDashboard/Milestone/PaginatedMilestonesRepresentations.class.php',
            'agiledashboard_milestone_pane_content_contentnewpresenter' => '/AgileDashboard/Milestone/Pane/Content/ContentNewPresenter.class.php',
            'agiledashboard_milestone_pane_content_contentpane' => '/AgileDashboard/Milestone/Pane/Content/ContentPane.class.php',
            'agiledashboard_milestone_pane_content_contentpaneinfo' => '/AgileDashboard/Milestone/Pane/Content/ContentPaneInfo.class.php',
            'agiledashboard_milestone_pane_content_contentpresenter' => '/AgileDashboard/Milestone/Pane/Content/ContentPresenter.class.php',
            'agiledashboard_milestone_pane_content_contentpresenterbuilder' => '/AgileDashboard/Milestone/Pane/Content/ContentPresenterBuilder.class.php',
            'agiledashboard_milestone_pane_content_contentpresenterdescendant' => '/AgileDashboard/Milestone/Pane/Content/ContentPresenterDescendant.class.php',
            'agiledashboard_milestone_pane_panepresenterbuilderfactory' => '/AgileDashboard/Milestone/Pane/PanePresenterBuilderFactory.class.php',
            'agiledashboard_milestone_pane_planning_planningv2pane' => '/AgileDashboard/Milestone/Pane/Planning/PlanningV2Pane.class.php',
            'agiledashboard_milestone_pane_planning_planningv2paneinfo' => '/AgileDashboard/Milestone/Pane/Planning/PlanningV2PaneInfo.class.php',
            'agiledashboard_milestone_pane_planning_planningv2presenter' => '/AgileDashboard/Milestone/Pane/Planning/PlanningV2Presenter.class.php',
            'agiledashboard_milestone_pane_planning_submilestonefinder' => '/AgileDashboard/Milestone/Pane/Planning/SubmilestoneFinder.class.php',
            'agiledashboard_milestone_pane_presenterdata' => '/AgileDashboard/Milestone/Pane/PresenterData.class.php',
            'agiledashboard_milestone_pane_topplanning_topplanningv2paneinfo' => '/AgileDashboard/Milestone/Pane/TopPlanning/TopPlanningV2PaneInfo.class.php',
            'agiledashboard_milestone_selectedmilestoneprovider' => '/AgileDashboard/Milestone/SelectedMilestoneProvider.php',
            'agiledashboard_milestonepresenter' => '/Planning/MilestonePresenter.class.php',
            'agiledashboard_milestonescardwallrepresentation' => '/AgileDashboard/REST/v1/MilestonesCardwallRepresentation.class.php',
            'agiledashboard_pane' => '/AgileDashboard/Pane.class.php',
            'agiledashboard_paneiconlinkpresenter' => '/AgileDashboard/PaneIconLinkPresenter.class.php',
            'agiledashboard_paneiconlinkpresentercollectionfactory' => '/AgileDashboard/PaneIconLinkPresenterCollectionFactory.class.php',
            'agiledashboard_paneinfo' => '/AgileDashboard/PaneInfo.class.php',
            'agiledashboard_paneinfofactory' => '/AgileDashboard/PaneInfoFactory.class.php',
            'agiledashboard_paneinfoidentifier' => '/AgileDashboard/PaneInfoIdentifier.class.php',
            'agiledashboard_paneredirectionextractor' => '/PaneRedirectionExtractor.class.php',
            'agiledashboard_permissionsmanager' => '/AgileDashboard/PermissionsManager.php',
            'agiledashboard_planning_nearestplanningtrackerprovider' => '/AgileDashboard/Planning/NearestPlanningTrackerProvider.class.php',
            'agiledashboard_presenter_kanbansummarypresenter' => '/AgileDashboard/KanbanSummaryPresenter.class.php',
            'agiledashboard_rest_resourcesinjector' => '/AgileDashboard/REST/ResourcesInjector.class.php',
            'agiledashboard_rest_v2_resourcesinjector' => '/AgileDashboard/REST/v2/ResourcesInjector.class.php',
            'agiledashboard_semantic_dao_initialeffort' => '/AgileDashboard/Semantic/Dao/Dao_InitialEffort.class.php',
            'agiledashboard_semantic_dao_initialeffortdao' => '/AgileDashboard/Semantic/Dao/InitialEffortDao.class.php',
            'agiledashboard_semantic_initialeffort' => '/AgileDashboard/Semantic/Semantic_InitialEffort.class.php',
            'agiledashboard_semantic_initialeffortfactory' => '/AgileDashboard/Semantic/Semantic_InitialEffortFactory.class.php',
            'agiledashboard_semanticstatusnotfoundexception' => '/AgileDashboard/SemanticStatusNotFoundException.php',
            'agiledashboard_sequenceidmanager' => '/AgileDashboard/SequenceIdManager.php',
            'agiledashboard_swimlinerepresentation' => '/AgileDashboard/REST/v1/SwimlineRepresentation.class.php',
            'agiledashboard_usernotadminexception' => '/AgileDashboard/UserNotAdminException.php',
            'agiledashboard_xmlcontroller' => '/AgileDashboard/AgileDashboardXMLController.class.php',
            'agiledashboard_xmlexporter' => '/AgileDashboard/XMLExporter.class.php',
            'agiledashboard_xmlexporterunabletogetvalueexception' => '/AgileDashboard/XMLExporterUnableToGetValueException.class.php',
            'agiledashboard_xmlfullstructureexporter' => '/AgileDashboard/XMLFullStructureExporter.php',
            'agiledashboard_xmlimporter' => '/AgileDashboard/XMLImporter.class.php',
            'agiledashboard_xmlimporterinvalidtrackermappingsexception' => '/AgileDashboard/XMLImporterInvalidTrackerMappingsException.class.php',
            'agiledashboardconfigurationresponse' => '/AgileDashboard/AgileDashboardConfigurationResponse.php',
            'agiledashboardkanbanconfigurationupdater' => '/AgileDashboard/AgileDashboardKanbanConfigurationUpdater.class.php',
            'agiledashboardplugin' => '/agiledashboardPlugin.class.php',
            'agiledashboardplugindescriptor' => '/AgileDashboardPluginDescriptor.class.php',
            'agiledashboardplugininfo' => '/AgileDashboardPluginInfo.class.php',
            'agiledashboardrouter' => '/AgileDashboardRouter.class.php',
            'agiledashboardrouterbuilder' => '/AgileDashboardRouterBuilder.php',
            'agiledashboardscrumconfigurationupdater' => '/AgileDashboard/AgileDashboardScrumConfigurationUpdater.class.php',
            'agiledashboardstatisticsaggregator' => '/AgileDashboard/AgileDashboardStatisticsAggregator.class.php',
            'breadcrumb_agiledashboard' => '/BreadCrumbs/AgileDashboard.class.php',
            'breadcrumb_artifact' => '/BreadCrumbs/Artifact.class.php',
            'breadcrumb_breadcrumbgenerator' => '/BreadCrumbs/BreadCrumbGenerator.class.php',
            'breadcrumb_merger' => '/BreadCrumbs/Merger.class.php',
            'breadcrumb_milestone' => '/BreadCrumbs/Milestone.class.php',
            'breadcrumb_nocrumb' => '/BreadCrumbs/NoCrumb.class.php',
            'breadcrumb_pipe' => '/BreadCrumbs/Pipe.class.php',
            'breadcrumb_planning' => '/BreadCrumbs/Planning.class.php',
            'breadcrumb_planningandartifact' => '/BreadCrumbs/PlanningAndArtifact.class.php',
            'breadcrumb_virtualtopmilestone' => '/BreadCrumbs/VirtualTopMilestone.class.php',
            'kanban_semanticstatusallcolumnidsnotprovidedexception' => '/AgileDashboard/KanbanSemanticStatusAllColumnIdsNotProvidedException.php',
            'kanban_semanticstatusbasedonasharedfieldexception' => '/AgileDashboard/KanbanSemanticStatusBasedOnASharedFieldException.php',
            'kanban_semanticstatuscolumnidsnotinopensemanticexception' => '/AgileDashboard/KanbanSemanticStatusColumnIdsNotInOpenSemanticException.php',
            'kanban_semanticstatusnotboundtostaticvaluesexception' => '/AgileDashboard/KanbanSemanticStatusNotBoundToStaticValuesException.php',
            'kanban_semanticstatusnotdefinedexception' => '/AgileDashboard/KanbanSemanticStatusNotDefinedException.php',
            'kanban_semantictitlenotdefinedexception' => '/AgileDashboard/KanbanSemanticTitleNotDefinedException.php',
            'kanban_trackernotdefinedexception' => '/AgileDashboard/KanbanTrackerNotDefinedException.php',
            'kanban_usercantaddinplaceexception' => '/AgileDashboard/KanbanUserCantAddInPlaceException.php',
            'kanbanpresenter' => '/AgileDashboard/KanbanPresenter.class.php',
            'milestoneparentlinker' => '/AgileDashboard/Milestone/MilestoneParentLinker.php',
            'milestonepermissiondeniedexception' => '/Planning/MilestonePermissionDeniedException.class.php',
            'milestonereportcriteriondao' => '/AgileDashboard/Milestone/MilestoneReportCriterionDao.class.php',
            'planning' => '/Planning/Planning.class.php',
            'planning_artifactcreationcontroller' => '/Planning/ArtifactCreationController.class.php',
            'planning_artifactlinker' => '/Planning/ArtifactLinker.class.php',
            'planning_artifactmilestone' => '/Planning/ArtifactMilestone.class.php',
            'planning_artifactparentsselector' => '/Planning/ArtifactParentsSelector.class.php',
            'planning_artifactparentsselector_command' => '/Planning/ArtifactParentsSelector/Command.class.php',
            'planning_artifactparentsselector_nearestmilestonewithbacklogtrackercommand' => '/Planning/ArtifactParentsSelector/NearestMilestoneWithBacklogTrackerCommand.class.php',
            'planning_artifactparentsselector_parentinsamehierarchycommand' => '/Planning/ArtifactParentsSelector/ParentInSameHierarchyCommand.class.php',
            'planning_artifactparentsselector_sametrackercommand' => '/Planning/ArtifactParentsSelector/SameTrackerCommand.class.php',
            'planning_artifactparentsselector_subchildrenbelongingtotrackercommand' => '/Planning/ArtifactParentsSelector/SubChildrenBelongingToTrackerCommand.class.php',
            'planning_artifactparentsselectoreventlistener' => '/Planning/ArtifactParentsSelectorEventListener.class.php',
            'planning_carddisplaypreferences' => '/Planning/CardDisplayPreferences.class.php',
            'planning_controller' => '/Planning/PlanningController.class.php',
            'planning_formpresenter' => '/Planning/PlanningFormPresenter.class.php',
            'planning_importtemplateformpresenter' => '/Planning/ImportTemplateFormPresenter.class.php',
            'planning_invalidconfigurationexception' => '/Planning/InvalidConfigurationException.class.php',
            'planning_milestone' => '/Planning/Milestone.class.php',
            'planning_milestonecontroller' => '/Planning/MilestoneController.class.php',
            'planning_milestonecontrollerfactory' => '/Planning/MilestoneControllerFactory.class.php',
            'planning_milestonefactory' => '/Planning/MilestoneFactory.class.php',
            'planning_milestonelinkpresenter' => '/Planning/MilestoneLinkPresenter.class.php',
            'planning_milestonepanefactory' => '/Planning/MilestonePaneFactory.class.php',
            'planning_milestoneredirectparameter' => '/Planning/MilestoneRedirectParameter.class.php',
            'planning_milestoneselectorcontroller' => '/Planning/MilestoneSelectorController.class.php',
            'planning_nomilestone' => '/Planning/NoMilestone.class.php',
            'planning_noplanningsexception' => '/Planning/NoPlanningsException.class.php',
            'planning_notfoundexception' => '/Planning/NotFoundException.class.php',
            'planning_planningadminpresenter' => '/Planning/PlanningAdminPresenter.class.php',
            'planning_planningoutofhierarchyadminpresenter' => '/Planning/PlanningOutOfHierarchyAdminPresenter.class.php',
            'planning_presenter_basehomepresenter' => '/Planning/Presenters/BaseHomePresenter.class.php',
            'planning_presenter_homepresenter' => '/Planning/Presenters/HomePresenter.class.php',
            'planning_presenter_lastlevelmilestone' => '/Planning/Presenters/LastLevelMilestone.class.php',
            'planning_presenter_milestoneaccesspresenter' => '/Planning/Presenters/MilestoneAccessPresenter.class.php',
            'planning_presenter_milestoneburndownsummarypresenter' => '/Planning/Presenters/MilestoneBurndownSummaryPresenter.class.php',
            'planning_presenter_milestonesummarypresenter' => '/Planning/Presenters/MilestoneSummaryPresenter.class.php',
            'planning_presenter_milestonesummarypresenterabstract' => '/Planning/Presenters/MilestoneSummaryPresenterAbstract.class.php',
            'planning_requestvalidator' => '/Planning/PlanningRequestValidator.class.php',
            'planning_shortaccess' => '/Planning/ShortAccess.class.php',
            'planning_shortaccessfactory' => '/Planning/ShortAccessFactory.class.php',
            'planning_shortaccessmilestonepresenter' => '/Planning/ShortAccessMilestonePresenter.class.php',
            'planning_trackerpresenter' => '/Planning/TrackerPresenter.class.php',
            'planning_virtualtopmilestone' => '/Planning/VirtualTopMilestone.class.php',
            'planning_virtualtopmilestonecontroller' => '/Planning/VirtualTopMilestoneController.class.php',
            'planning_virtualtopmilestonepanefactory' => '/Planning/VirtualTopMilestonePaneFactory.class.php',
            'planningdao' => '/Planning/PlanningDao.class.php',
            'planningfactory' => '/Planning/PlanningFactory.class.php',
            'planningparameters' => '/Planning/PlanningParameters.class.php',
            'planningpermissionsmanager' => '/Planning/PlanningPermissionsManager.class.php',
            'planningpresenter' => '/Planning/PlanningPresenter.class.php',
            'tuleap\\agiledashboard\\event\\getadditionalscrumadminpanecontent' => '/AgileDashboard/Event/GetAdditionalScrumAdminPaneContent.php',
            'tuleap\\agiledashboard\\formelement\\burnup' => '/AgileDashboard/FormElement/Burnup.php',
            'tuleap\\agiledashboard\\formelement\\viewadminburnupfield' => '/AgileDashboard/FormElement/ViewAdminBurnupField.php',
            'tuleap\\agiledashboard\\kanban\\columnidentifier' => '/AgileDashboard/Kanban/ColumnIdentifier.php',
            'tuleap\\agiledashboard\\kanban\\realtime\\kanbanartifactmessagebuilder' => '/AgileDashboard/Kanban/RealTime/KanbanArtifactMessageBuilder.php',
            'tuleap\\agiledashboard\\kanban\\realtime\\kanbanartifactmessagesender' => '/AgileDashboard/Kanban/RealTime/KanbanArtifactMessageSender.php',
            'tuleap\\agiledashboard\\kanban\\realtime\\kanbanartifactmovedmessagerepresentation' => '/AgileDashboard/Kanban/RealTime/KanbanArtifactMovedMessageRepresentation.php',
            'tuleap\\agiledashboard\\kanban\\realtime\\kanbanartifactupdatedmessagerepresentation' => '/AgileDashboard/Kanban/RealTime/KanbanArtifactUpdatedMessageRepresentation.php',
            'tuleap\\agiledashboard\\kanban\\trackerreport\\reportfilterfromwherebuilder' => '/AgileDashboard/Kanban/TrackerReport/ReportFilterFromWhereBuilder.php',
            'tuleap\\agiledashboard\\kanban\\trackerreport\\trackerreportbuilder' => '/AgileDashboard/Kanban/TrackerReport/TrackerReportBuilder.php',
            'tuleap\\agiledashboard\\kanban\\trackerreport\\trackerreportdao' => '/AgileDashboard/Kanban/TrackerReport/TrackerReportDao.php',
            'tuleap\\agiledashboard\\kanban\\trackerreport\\trackerreportupdater' => '/AgileDashboard/Kanban/TrackerReport/TrackerReportUpdater.php',
            'tuleap\\agiledashboard\\kanbanartifactrightspresenter' => '/AgileDashboard/KanbanArtifactRightsPresenter.php',
            'tuleap\\agiledashboard\\kanbancumulativeflowdiagramdao' => '/AgileDashboard/KanbanCumulativeFlowDiagramDao.php',
            'tuleap\\agiledashboard\\kanbanjavascriptdependenciesprovider' => '/AgileDashboard/KanbanJavascriptDependenciesProvider.php',
            'tuleap\\agiledashboard\\kanbanrightspresenter' => '/AgileDashboard/KanbanRightsPresenter.php',
            'tuleap\\agiledashboard\\milestone\\artifactview' => '/AgileDashboard/Milestone/ArtifactView.php',
            'tuleap\\agiledashboard\\milestone\\criterion\\isearchonstatus' => '/AgileDashboard/Milestone/Criterion/ISearchOnStatus.php',
            'tuleap\\agiledashboard\\milestone\\criterion\\statusall' => '/AgileDashboard/Milestone/Criterion/StatusAll.php',
            'tuleap\\agiledashboard\\milestone\\criterion\\statusclosed' => '/AgileDashboard/Milestone/Criterion/StatusClosed.php',
            'tuleap\\agiledashboard\\milestone\\criterion\\statusopen' => '/AgileDashboard/Milestone/Criterion/StatusOpen.php',
            'tuleap\\agiledashboard\\monomilestone\\monomilestonebacklogitemdao' => '/AgileDashboard/MonoMilestone/MonoMilestoneBacklogItemDao.php',
            'tuleap\\agiledashboard\\monomilestone\\monomilestoneitemsfinder' => '/AgileDashboard/MonoMilestone/MonoMilestoneItemsFinder.php',
            'tuleap\\agiledashboard\\monomilestone\\scrumformonomilestonechecker' => '/AgileDashboard/MonoMilestone/ScrumForMonoMilestoneChecker.php',
            'tuleap\\agiledashboard\\monomilestone\\scrumformonomilestonedao' => '/AgileDashboard/MonoMilestone/ScrumForMonoMilestoneDao.php',
            'tuleap\\agiledashboard\\monomilestone\\scrumformonomilestonedisabler' => '/AgileDashboard/MonoMilestone/ScrumForMonoMilestoneDisabler.php',
            'tuleap\\agiledashboard\\monomilestone\\scrumformonomilestoneenabler' => '/AgileDashboard/MonoMilestone/ScrumForMonoMilestoneEnabler.php',
            'tuleap\\agiledashboard\\planning\\scrumplanningfilter' => '/Planning/ScrumPlanningFilter.php',
            'tuleap\\agiledashboard\\realtime\\realtimeartifactmessagecontroller' => '/AgileDashboard/RealTime/RealTimeArtifactMessageController.php',
            'tuleap\\agiledashboard\\realtime\\realtimeartifactmessageexception' => '/AgileDashboard/RealTime/RealTimeArtifactMessageException.php',
            'tuleap\\agiledashboard\\realtime\\realtimeartifactmessagesender' => '/AgileDashboard/RealTime/RealTimeArtifactMessageSender.php',
            'tuleap\\agiledashboard\\rest\\malformedqueryparameterexception' => '/AgileDashboard/REST/MalformedQueryParameterException.php',
            'tuleap\\agiledashboard\\rest\\querytocriterionconverter' => '/AgileDashboard/REST/QueryToCriterionConverter.php',
            'tuleap\\agiledashboard\\rest\\v1\\artifactcannotbechildrenofexception' => '/AgileDashboard/REST/v1/ArtifactCannotBeChildrenOfException.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\artifactcannotbeinbacklogofexception' => '/AgileDashboard/REST/v1/ArtifactCannotBeInBacklogOfException.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\artifactdoesnotexistexception' => '/AgileDashboard/REST/v1/ArtifactDoesNotExistException.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\artifactisclosedoralreadyplannedinanothermilestone' => '/AgileDashboard/REST/v1/ArtifactIsClosedOrAlreadyPlannedInAnotherMilestone.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\artifactisnotinbacklogtrackerexception' => '/AgileDashboard/REST/v1/ArtifactIsNotInBacklogTrackerException.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\artifactisnotinmilestonecontentexception' => '/AgileDashboard/REST/v1/ArtifactIsNotInMilestoneContentException.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\artifactisnotinunassignedtopbacklogitemsexception' => '/AgileDashboard/REST/v1/ArtifactIsNotInUnassignedBacklogItemsException.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\artifactisnotinunplannedbacklogitemsexception' => '/AgileDashboard/REST/v1/ArtifactIsNotInUnplannedBacklogItemsException.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\backlogitemparentreference' => '/AgileDashboard/REST/v1/BacklogItemParentReference.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\backlogitemrepresentation' => '/AgileDashboard/REST/v1/BacklogItemRepresentation.php',
            'tuleap\\agiledashboard\\rest\\v1\\backlogitemrepresentationfactory' => '/AgileDashboard/REST/v1/BacklogItemRepresentationFactory.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\backlogitemresource' => '/AgileDashboard/REST/v1/BacklogItemResource.php',
            'tuleap\\agiledashboard\\rest\\v1\\elementcannotbesubmilestoneexception' => '/AgileDashboard/REST/v1/ElementCannotBeSubmilestoneException.php',
            'tuleap\\agiledashboard\\rest\\v1\\filtervalidbacklogitems' => '/AgileDashboard/REST/v1/FilterValidBacklogItems.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\filtervalidcontent' => '/AgileDashboard/REST/v1/FilterValidContent.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\filtervalidsubmilestones' => '/AgileDashboard/REST/v1/FilterValidSubmilestones.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\idsfrombodyarenotuniqueexception' => '/AgileDashboard/REST/v1/IdsFromBodyAreNotUniqueException.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\itemlistedtwiceexception' => '/AgileDashboard/REST/v1/SubmilestoneListedTwiceException.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\ivalidateelementstoadd' => '/AgileDashboard/REST/v1/IValidateElementsToAdd.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\cumulativeflowdiagram\\diagramcolumnrepresentation' => '/AgileDashboard/REST/v1/Kanban/CumulativeFlowDiagram/DiagramColumnRepresentation.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\cumulativeflowdiagram\\diagrampointrepresentation' => '/AgileDashboard/REST/v1/Kanban/CumulativeFlowDiagram/DiagramPointRepresentation.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\cumulativeflowdiagram\\diagramrepresentation' => '/AgileDashboard/REST/v1/Kanban/CumulativeFlowDiagram/DiagramRepresentation.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\cumulativeflowdiagram\\diagramrepresentationbuilder' => '/AgileDashboard/REST/v1/Kanban/CumulativeFlowDiagram/DiagramRepresentationBuilder.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\cumulativeflowdiagram\\orderedcolumnrepresentationsbuilder' => '/AgileDashboard/REST/v1/Kanban/CumulativeFlowDiagram/OrderedColumnRepresentationsBuilder.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\cumulativeflowdiagram\\toomanypointsexception' => '/AgileDashboard/REST/v1/Kanban/CumulativeFlowDiagram/TooManyPointsException.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\itemcollectionrepresentation' => '/AgileDashboard/REST/v1/Kanban/ItemCollectionRepresentation.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\itemcollectionrepresentationbuilder' => '/AgileDashboard/REST/v1/Kanban/ItemCollectionRepresentationBuilder.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\itemrepresentationbuilder' => '/AgileDashboard/REST/v1/Kanban/ItemRepresentationBuilder.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\kanbanaddrepresentation' => '/AgileDashboard/REST/v1/Kanban/KanbanAddRepresentation.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\kanbanarchiveinforepresentation' => '/AgileDashboard/REST/v1/Kanban/KanbanArchiveInfoRepresentation.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\kanbanbackloginforepresentation' => '/AgileDashboard/REST/v1/Kanban/KanbanBacklogInfoRepresentation.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\kanbancollapsecolumnrepresentation' => '/AgileDashboard/REST/v1/Kanban/KanbanCollapseColumnRepresentation.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\kanbancolumnpatchrepresentation' => '/AgileDashboard/REST/v1/Kanban/KanbanColumnPATCHRepresentation.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\kanbancolumnpostrepresentation' => '/AgileDashboard/REST/v1/Kanban/KanbanColumnPOSTRepresentation.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\kanbancolumnrepresentation' => '/AgileDashboard/REST/v1/Kanban/KanbanColumnRepresentation.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\kanbancolumnsresource' => '/AgileDashboard/REST/v1/Kanban/KanbanColumnsResource.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\kanbanitempostrepresentation' => '/AgileDashboard/REST/v1/Kanban/KanbanItemPOSTRepresentation.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\kanbanitemrepresentation' => '/AgileDashboard/REST/v1/Kanban/KanbanItemRepresentation.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\kanbanitemsresource' => '/AgileDashboard/REST/v1/Kanban/KanbanItemsResource.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\kanbanrepresentation' => '/AgileDashboard/REST/v1/Kanban/KanbanRepresentation.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\kanbanrepresentationbuilder' => '/AgileDashboard/REST/v1/Kanban/KanbanRepresentationBuilder.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\kanbanresource' => '/AgileDashboard/REST/v1/Kanban/KanbanResource.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\timeinfofactory' => '/AgileDashboard/REST/v1/Kanban/TimeInfoFactory.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\trackerreport\\filtereddiagramrepresentationbuilder' => '/AgileDashboard/REST/v1/Kanban/TrackerReport/FilteredDiagramRepresentationBuilder.php',
            'tuleap\\agiledashboard\\rest\\v1\\kanban\\trackerreport\\filtereditemcollectionrepresentationbuilder' => '/AgileDashboard/REST/v1/Kanban/TrackerReport/FilteredItemCollectionRepresentationBuilder.php',
            'tuleap\\agiledashboard\\rest\\v1\\milestonecontentupdater' => '/AgileDashboard/REST/v1/MilestoneContentUpdater.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\milestoneinforepresentation' => '/AgileDashboard/REST/v1/MilestoneInfoRepresentation.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\milestoneparentreference' => '/AgileDashboard/REST/v1/MilestoneParentReference.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\milestonerepresentation' => '/AgileDashboard/REST/v1/MilestoneRepresentation.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\milestoneresource' => '/AgileDashboard/REST/v1/MilestoneResource.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\milestoneresourcevalidator' => '/AgileDashboard/REST/v1/MilestoneResourceValidator.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\orderidoutofboundexception' => '/AgileDashboard/REST/v1/OrderIdOutOfBoundException.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\orderrepresentation' => '/AgileDashboard/REST/v1/OrderRepresentation.php',
            'tuleap\\agiledashboard\\rest\\v1\\ordervalidator' => '/AgileDashboard/REST/v1/OrderValidator.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\patchaddbacklogitemsvalidator' => '/AgileDashboard/REST/v1/PatchAddBacklogItemsValidator.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\patchaddcontentvalidator' => '/AgileDashboard/REST/v1/PatchAddContentValidator.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\patchaddremovevalidator' => '/AgileDashboard/REST/v1/PatchAddRemoveValidator.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\planningreference' => '/AgileDashboard/REST/v1/PlanningReference.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\planningrepresentation' => '/AgileDashboard/REST/v1/PlanningRepresentation.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\planningresource' => '/AgileDashboard/REST/v1/PlanningResource.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\projectbacklogresource' => '/AgileDashboard/REST/v1/ProjectBacklogResource.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\projectmilestonesresource' => '/AgileDashboard/REST/v1/ProjectMilestonesResource.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\projectplanningsresource' => '/AgileDashboard/REST/v1/ProjectPlanningsResource.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\resourcespatcher' => '/AgileDashboard/REST/v1/ResourcesPatcher.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\submilestonealreadyhasaparentexception' => '/AgileDashboard/REST/v1/SubMilestoneAlreadyHasAParentException.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\submilestonedoesnotexistexception' => '/AgileDashboard/REST/v1/SubMilestoneDoesNotExistException.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\usercannotreadsubmilestoneexception' => '/AgileDashboard/REST/v1/UserCannotReadSubMilestoneException.class.php',
            'tuleap\\agiledashboard\\rest\\v1\\usercannotupdatemilestoneexception' => '/AgileDashboard/REST/v1/UserCannotUpdateMilestoneException.php',
            'tuleap\\agiledashboard\\rest\\v2\\backlogitemrepresentation' => '/AgileDashboard/REST/v2/BacklogItemRepresentation.php',
            'tuleap\\agiledashboard\\rest\\v2\\backlogitemrepresentationfactory' => '/AgileDashboard/REST/v2/BacklogItemRepresentationFactory.class.php',
            'tuleap\\agiledashboard\\rest\\v2\\backlogrepresentation' => '/AgileDashboard/REST/v2/BacklogRepresentation.php',
            'tuleap\\agiledashboard\\rest\\v2\\projectbacklogresource' => '/AgileDashboard/REST/v2/ProjectBacklogResource.class.php',
            'tuleap\\agiledashboard\\semantic\\dao\\semanticdonedao' => '/AgileDashboard/Semantic/Dao/SemanticDoneDao.php',
            'tuleap\\agiledashboard\\semantic\\semanticdone' => '/AgileDashboard/Semantic/SemanticDone.php',
            'tuleap\\agiledashboard\\semantic\\semanticdoneadminpresenter' => '/AgileDashboard/Semantic/SemanticDoneAdminPresenter.php',
            'tuleap\\agiledashboard\\semantic\\semanticdoneintropresenter' => '/AgileDashboard/Semantic/SemanticDoneIntroPresenter.php',
            'tuleap\\agiledashboard\\widget\\kanban' => '/AgileDashboard/Widget/Kanban.php',
            'tuleap\\agiledashboard\\widget\\mykanban' => '/AgileDashboard/Widget/MyKanban.php',
            'tuleap\\agiledashboard\\widget\\projectkanban' => '/AgileDashboard/Widget/ProjectKanban.php',
            'tuleap\\agiledashboard\\widget\\widgetaddtodashboarddropdownrepresentation' => '/AgileDashboard/Widget/WidgetAddToDashboardDropdownRepresentation.php',
            'tuleap\\agiledashboard\\widget\\widgetaddtodashboarddropdownrepresentationbuilder' => '/AgileDashboard/Widget/WidgetAddToDashboardDropdownRepresentationBuilder.php',
            'tuleap\\agiledashboard\\widget\\widgetkanbancreator' => '/AgileDashboard/Widget/WidgetKanbanCreator.php',
            'tuleap\\agiledashboard\\widget\\widgetkanbandao' => '/AgileDashboard/Widget/WidgetKanbanDao.php',
            'tuleap\\agiledashboard\\widget\\widgetkanbandeletor' => '/AgileDashboard/Widget/WidgetKanbanDeletor.php',
            'tuleap\\agiledashboard\\widget\\widgetkanbanpresenter' => '/AgileDashboard/Widget/WidgetKanbanPresenter.php',
            'tuleap\\agiledashboard\\widget\\widgetkanbanretriever' => '/AgileDashboard/Widget/WidgetKanbanRetriever.php',
            'tuleap\\tracker\\formelement\\burnuplogger' => '/AgileDashboard/FormElement/BurnupLogger.php'
        );
    }
    $cn = strtolower($class);
    if (isset($classes[$cn])) {
        require dirname(__FILE__) . $classes[$cn];
    }
}
spl_autoload_register('autoloada5a8ecdef3c646bc06de6e31c730aea5');
// @codeCoverageIgnoreEnd
