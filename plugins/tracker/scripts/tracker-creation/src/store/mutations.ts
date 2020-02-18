/*
 * Copyright (c) Enalean, 2020 - present. All Rights Reserved.
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

import { CreationOptions, State, Tracker } from "./type";

export function setActiveOption(state: State, option: CreationOptions): void {
    state.active_option = option;
}

export function setSelectedTrackerTemplate(state: State, tracker_id: string): void {
    let tracker: Tracker | undefined;

    for (let i = 0; !tracker && i < state.project_templates.length; i++) {
        tracker = state.project_templates[i].tracker_list.find(
            (tracker: Tracker) => tracker.id === tracker_id
        );
    }

    if (!tracker) {
        throw new Error("Tracker not found in store");
    }

    state.selected_tracker_template = tracker;
}

export function initTrackerName(state: State): void {
    if (state.selected_tracker_template) {
        state.tracker_to_be_created.name = state.selected_tracker_template.name;
    }
}

export function setTrackerName(state: State, name: string): void {
    state.tracker_to_be_created.name = name;
}

export function setTrackerShortName(state: State, shortname: string): void {
    state.tracker_to_be_created.shortname = shortname;
}
