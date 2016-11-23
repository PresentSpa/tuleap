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

document.addEventListener('DOMContentLoaded', function () {
    var date_picker_elements = document.querySelectorAll('.tlp-input-date');

    [].forEach.call(date_picker_elements, function (element) {
        tlp.datePicker(element);
    });

    var project_filter = document.getElementById('project-filter');
    if (project_filter) {
        tuleap.autocomplete_projects_for_select2(
            project_filter,
            {
                include_private_projects: true
            }
        );
    }
});
