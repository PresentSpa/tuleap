/*
 * Copyright (c) Enalean, 2020-Present. All Rights Reserved.
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

import kanban_module from "../app.js";
import angular from "angular";
import "angular-mocks";
import { createAngularPromiseWrapper } from "../../../../../../../tests/jest/angular-promise-wrapper.js";

describe(`UserPreferencesService`, () => {
    let UserPreferencesService, mockBackend, wrapPromise;
    beforeEach(() => {
        angular.mock.module(kanban_module);
        let $rootScope;
        angular.mock.inject(function (_$rootScope_, $httpBackend, _UserPreferencesService_) {
            $rootScope = _$rootScope_;
            mockBackend = $httpBackend;
            UserPreferencesService = _UserPreferencesService_;
        });

        wrapPromise = createAngularPromiseWrapper($rootScope);
    });

    describe(`setPreference`, () => {
        it(`will call PATCH on user's preferences`, async () => {
            mockBackend
                .expectPATCH("/api/v1/users/110/preferences", {
                    key: "agiledashboard_kanban_item_view_mode_16",
                    value: "compact-view",
                })
                .respond(200);

            const promise = UserPreferencesService.setPreference(
                110,
                "agiledashboard_kanban_item_view_mode_16",
                "compact-view"
            );
            mockBackend.flush();
            expect(await wrapPromise(promise)).toBeTruthy();
        });
    });
});
