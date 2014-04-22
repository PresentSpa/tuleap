<?php
/**
 * Copyright (c) Xerox Corporation, Codendi Team, 2001-2009. All rights reserved
 *
 * This file is a part of Codendi.
 *
 * Codendi is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Codendi is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Codendi. If not, see <http://www.gnu.org/licenses/>.
 */
 
require_once('data-access/GraphOnTrackersV5_ChartFactory.class.php');
require_once(TRACKER_BASE_DIR .'/Tracker/Report/Tracker_Report_Renderer.class.php');

class GraphOnTrackersV5_Renderer extends Tracker_Report_Renderer {
    
    protected $charts;
    protected $chart_to_edit;
    protected $plugin;
    
    public function __construct($id, $report, $name, $description, $rank, $plugin) {
        parent::__construct($id, $report, $name, $description, $rank);
        $this->charts        = null;
        $this->chart_to_edit = null;
        $this->plugin        = $plugin;
        $this->chart_factories = array();
    }
    
    public function initiateSession() {
        $this->report_session = new Tracker_Report_Session($this->report->id);
        $this->report_session->changeSessionNamespace('renderers');
    }
    
    public function setCharts($charts) {
        $this->charts = $charts;
    }
    
    public function getCharts() {
        return $this->charts;
    }
    
    /**
     * Delete the renderer
     */
    public function delete() {
        foreach($this->getChartFactory()
                     ->getCharts($this) as $chart){
            $this->getChartFactory()
                 ->deleteChart($this->id, $chart->getId());
        }
    }
    
    /**
     * Fetch content of the renderer
     * @param array $matching_ids
     * @param Request $request
     * @return string
     */
    public function fetch($matching_ids, $request, $report_can_be_modified, PFUser $user) {
        $html = '';
        $this->initiateSession();
        $readonly = !$report_can_be_modified || $user->isAnonymous();

        if (!$readonly && $this->chart_to_edit) {
            $html .= '<script type="text/javascript" src="/plugins/graphontrackersv5/dependencies.js"></script>';
            
            $url = '?'. http_build_query(array(
                                               'report'   => $this->report->id,
                                               'renderer' => $this->id));
            $html .= '<p><a href="'. $url .'">&laquo; '. $GLOBALS['Language']->getText('plugin_graphontrackersv5_include_report','return_renderer') .'</a></p>';
            $html .= '<form action="'. $url .'" name="edit_chart_form" method="post">';
            $html .= '<input type="hidden" name="func" VALUE="renderer" />';
            $html .= '<input type="hidden" name="renderer_plugin_graphontrackersv5[edit_chart]" VALUE="'. $this->chart_to_edit->getId() .'" />';
            $html .= '<table>';
            $html .= '<thead>
                        <tr class="boxtable">
                            <th class="boxtitle">'.$GLOBALS['Language']->getText('plugin_graphontrackersv5_boxtable','chart_properties').'</th>
                            <th class="boxtitle">'.$GLOBALS['Language']->getText('plugin_graphontrackersv5_boxtable','preview').'</th>
                        </tr>
                      </thead>';
            $html .= '<tbody><tr valign="top"><td>';
            //{{{ Chart Properties
            foreach($this->chart_to_edit->getProperties() as $prop) {
                $html .= '<p>'. $prop->render() ."</p>\n";
            }
            $html .= '<p style="text-align:center;"><input type="submit" name="renderer_plugin_graphontrackersv5[update_chart]" value="'. $GLOBALS['Language']->getText('global', 'btn_submit') .'" /></p>';
            //}}}
            $html .= '</td><td style="text-align:center">';
            //{{{ Chart Preview

            $html .= $this->chart_to_edit->getContent();
            //}}}
            $html .= '</tr>';
            if ($help = $this->chart_to_edit->getHelp()) {
                $html .= '<tr><td colspan="2" class="inline_help">'. $help .'</td></tr>';
            }
            $html .= '</tbody></table>';
            $html .= '</form>';
        } else {
            $in_dashboard = false;
            $html .= $this->fetchCharts($this->report->getMatchingIds(), $user, $in_dashboard, $readonly);
        }
        return $html;
    }
    
    /**
     * Fetch content to be displayed in widget
     */
    public function fetchWidget(PFUser $user) {
        $html = '';
        $in_dashboard = $readonly = true;
        $store_in_session = false;
        $html .= $this->fetchCharts($this->report->getMatchingIds(), $user, $in_dashboard, $readonly, $store_in_session);
        $html .= $this->fetchWidgetGoToReport();
        return $html;
    }
    
    protected function fetchCharts($matching_ids, PFUser $current_user, $in_dashboard = false, $readonly = null, $store_in_session = true) {
        $html = '';
        $hp = Codendi_HTMLPurifier::instance();
        if (!$readonly) {
            $html .= '<div id="tracker_report_renderer_view_controls">';
            $html .= '<div class="btn-group">';
            $html .= '<a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">';
            $html .= '<i class="icon-plus"></i> ';
            $html .= $GLOBALS['Language']->getText('plugin_graphontrackersv5_include_report','add_chart');
            $html .= ' <span class="caret"></span>';
            $html .= '</a>';
            $html .= '<ul class="dropdown-menu pull-right"> ';
            $url = '?'. http_build_query(array(
                                               'report'   => $this->report->id,
                                               'renderer' => $this->id,
                                               'func'     => 'renderer',
                                              ));
            $url_add = $url .'&amp;renderer_plugin_graphontrackersv5[add_chart]=';
            foreach($this->getChartFactory()->getChartFactories() as $factory) {
                $html .= '<li>';
                $html .= '<a href="'. $url_add . $factory['chart_type'] .'">';
                $html .= $factory['title'];
                $html .= '</a>';
                $html .= '</li>';
            }
            $html .= '</ul>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '<form action="" method="POST">
                <input type="hidden" name="func" VALUE="renderer" />
                <input type="hidden" name="renderer" VALUE="'. $this->id .'" />';

        }

        $chart_array = array();
        $html .= '<div class="tracker_report_renderer_graphontrackers_charts">';
        foreach($this->getChartFactory()
                     ->getCharts($this) as $chart) {
            $html .= '<div class="widget_report_graph">';
            $html .= $chart->fetchOnReport($this, $current_user, $readonly, $store_in_session);
            $html .= '</div>';
            $chart_array[$chart->id] = $chart->fetchAsArray();
        }
        $html .= '<div style="clear:both;"></div>';
        $html .= '</div>';
        if (!$readonly) {
            $html .='</form>';
        }

        $GLOBALS['HTML']->includeFooterJavascriptSnippet('tuleap.graphontrackersv5.graphs = '.json_encode($chart_array).';');

        return $html;
    }

    /**
     * Process the request
     * @param Request $request
     */
    public function processRequest(TrackerManager $tracker_manager, $request, $current_user) {
        $renderer_parameters = $request->get('renderer_plugin_graphontrackersv5');
        if ($renderer_parameters && is_array($renderer_parameters)) {
            if (isset($renderer_parameters['add_chart'])) { 
                $this->chart_to_edit = $this->getChartFactory()
                                            ->createChart($this, $renderer_parameters['add_chart']);
                $GLOBALS['Response']->redirect(TRACKER_BASE_URL.'/?'. http_build_query(array(
                    'report' => $this->report->id,
                    'renderer' => $this->id,
                    'func' => 'renderer',
                    'renderer_plugin_graphontrackersv5[edit_chart]' => $this->chart_to_edit->id,
                )));
            }
            
            if (isset($renderer_parameters['edit_chart']) ||
                isset($renderer_parameters['delete_chart']) && is_array($renderer_parameters['delete_chart'])
            ) {
                if ($this->report->userCanUpdate($current_user)) {
                    if (isset($renderer_parameters['edit_chart'])) {
                        $this->chart_to_edit = $this->getChartFactory()
                                                    ->getChart($this, $renderer_parameters['edit_chart']);
                        if (isset($renderer_parameters['update_chart']) && is_array($request->get('chart'))) {
                            if ($this->chart_to_edit->update($request->get('chart'))) {
                                //force the rank for all charts
                                $this->getChartFactory()->forceChartsRankInSession($this);
                                $GLOBALS['Response']->addFeedback('info', $GLOBALS['Language']->getText('plugin_graphontrackersv5_include_report','updated_report'));
                            }
                        }
                        $this->report->display($tracker_manager, $request, $current_user);
                    }
                    
                    if (isset($renderer_parameters['delete_chart']) && is_array($renderer_parameters['delete_chart'])) {
                        list($chart_id,) = each($renderer_parameters['delete_chart']);
                        if ($chart_id) {
                            $this->getChartFactory()->deleteChart($this, $chart_id);
                        }
                    }
                } else {
                    $GLOBALS['Response']->addFeedback('error', $GLOBALS['Language']->getText('global', 'perm_denied'));
                    $this->report->display($tracker_manager, $request, $current_user);
                }
            }
            
            if (isset($renderer_parameters['stroke'])) {
                $store_in_session = true;
                if ($request->exist('store_in_session')) {
                    $store_in_session = (bool)$request->get('store_in_session');
                }
                if ($chart = $this->getChartFactory()
                                  ->getChart($this, $renderer_parameters['stroke'], $store_in_session)) {
                    $chart->stroke();
                    exit;
                }
            }
        }
    }
    /**
     * Duplicate the renderer
     */
    public function duplicate($from_renderer, $field_mapping) {
        $this->getChartFactory()->duplicate($from_renderer, $this, $field_mapping);
    }
    
    public function afterProcessRequest($engine, $request, $current_user) {
        if (!$this->chart_to_edit) {
            parent::afterProcessRequest($engine, $request, $current_user);
        }
    }
    
    protected function getChartFactory() {
        return GraphOnTrackersV5_ChartFactory::instance();
    }
    
    public function getType(){
        return 'plugin_graphontrackersv5';
    }
    
    /**
     * Transforms Tracker_Renderer into a SimpleXMLElement
     * 
     * @param SimpleXMLElement $root the node to which the renderer is attached (passed by reference)
     */
    public function exportToXml(SimpleXMLElement $root, $formsMapping) {
        parent::exportToXML($root, $formsMapping);
        $child = $root->addChild('charts');
        foreach($this->getChartFactory()->getCharts($this) as $chart) {
            $grandchild = $child->addChild('chart');
            $chart->exportToXML($grandchild, $formsMapping);
        }
    }
    
    /**
     * Finnish saving renderer to database by creating charts
     * 
     * @param Report_Renderer $renderer containing the charts
     */
    public function afterSaveObject($renderer) {
        $cf = $this->getChartFactory();
        foreach ($renderer->getCharts() as $chart) {
            $chartDB = $cf->createDb($this->id, $chart);
        }
    }
    
   /**
    * Set the session
    *
    */
    public function setSession($renderer_id = null) {
        if(!$renderer_id) {
            $renderer_id = $this->id;
        }
        $this->report_session->set("{$this->id}.name", $this->name);
        $this->report_session->set("{$this->id}.description", $this->description);
        //$this->report_session->set("{$this->id}.plugin", $this->plugin);
        $this->report_session->set("{$this->id}.rank", $this->rank);
    }
    
    /**
     * Update the renderer
     *
     * @return bool true if success, false if failure
     */
    public function update() {
        $success = true;
        //Save charts
        $charts = $this->getChartFactory()->getCharts($this);
        //$this->report_session->changeSessionNamespace("renderers.{$this->id}");
        $chartsInSession = $this->report_session->get("$this->id.charts");
        if ($chartsInSession) {
            //Delete in db charts removed in session
            foreach($chartsInSession as $id =>$row) {
                if ($row === 'removed') {
                    $this->getChartFactory()->deleteDb($this,  $id);
                }
            }
        }
        
        foreach($charts as $chart_id => $chart) {
            //Update charts
            if ($chart_id > 0 ) {
                $method = 'updateDb';
            } else {
                $method = 'createDb';
            }
            $this->getChartFactory()->$method($this->id, $chart);
        }
        return $success;
    }
        
    /**
     * Create a renderer
     *
     * @return bool true if success, false if failure
     */
    public function create() {
        $success = true;
        $rrf = Tracker_Report_RendererFactory::instance();

        if ($renderer_id = $rrf->saveRenderer($this->report, $this->name, $this->description, $this->getType())) {
            //Save charts
            $charts = $this->getChartFactory()
                     ->getCharts($this);

            foreach($charts as $chart_id => $chart) {
                //Add new chart
                $this->getChartFactory()
                    ->createDb($renderer_id,
                               $chart
                               );
            }
        }
        return $success;
    }

    public function getIcon() {
        return 'icon-bar-chart';
    }
}
