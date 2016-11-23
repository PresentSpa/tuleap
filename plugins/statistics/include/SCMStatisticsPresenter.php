<?php
/**
 * Copyright (c) Enalean, 2016. All Rights Reserved.
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

namespace Tuleap\Statistics;

class SCMStatisticsPresenter
{
    const TEMPLATE = 'scm-statistics';

    public $header;
    public $scm_statistics_label;
    public $start_date_label;
    public $end_date_label;
    public $project_id_label;
    public $project_placeholder;
    public $csv_export_button;
    public $start_date;
    public $end_date;
    public $project_id;

    public function __construct(
        AdminHeaderPresenter $header,
        $start_date,
        $end_date,
        $project_id
    ) {
        $this->header = $header;

        $this->scm_statistics_label = $GLOBALS['Language']->getText('plugin_statistics', 'scm_title');
        $this->start_date_label     = $GLOBALS['Language']->getText('plugin_statistics', 'start_date');
        $this->end_date_label       = $GLOBALS['Language']->getText('plugin_statistics', 'end_date');
        $this->project_id_label     = $GLOBALS['Language']->getText('plugin_statistics', 'scm_project_id');
        $this->project_help         = $GLOBALS['Language']->getText('plugin_statistics', 'scm_project_id_info');
        $this->project_placeholder  = $GLOBALS['Language']->getText('plugin_statistics', 'scm_project_selection');
        $this->csv_export_button    = $GLOBALS['Language']->getText('plugin_statistics', 'csv_export_button');

        $this->start_date = $start_date;
        $this->end_date   = $end_date;
        $this->project_id = $project_id;
    }
}
