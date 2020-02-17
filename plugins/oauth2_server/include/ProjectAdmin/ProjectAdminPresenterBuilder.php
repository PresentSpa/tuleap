<?php
/**
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

declare(strict_types=1);

namespace Tuleap\OAuth2Server\ProjectAdmin;

use Tuleap\OAuth2Server\App\AppDao;

class ProjectAdminPresenterBuilder
{
    /**
     * @var AppDao
     */
    private $app_dao;

    public function __construct(AppDao $app_dao)
    {
        $this->app_dao = $app_dao;
    }

    public static function buildSelf(): self
    {
        return new self(new AppDao());
    }

    public function build(\Project $project): ProjectAdminPresenter
    {
        $apps = [];
        $rows = $this->app_dao->searchByProject($project);
        foreach ($rows as $row) {
            $apps[] = new AppPresenter($row['name']);
        }
        return new ProjectAdminPresenter($apps);
    }
}
