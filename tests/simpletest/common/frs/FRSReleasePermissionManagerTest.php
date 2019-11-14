<?php
/**
 * Copyright (c) Enalean, 2017. All Rights Reserved.
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

namespace Tuleap\FRS;

use TuleapTestCase;

class FRSReleasePermissionManagerTest extends TuleapTestCase
{
    /**
     * @var FRSPermissionManager
     */
    private $frs_service_permission_manager;

    /**
     * @var \FRSReleaseFactory
     */
    private $release_factory;

    /**
     * @var ReleasePermissionManager
     */
    private $release_permission_manager;

    /**
     * @var \PFUser
     */
    private $user;

    /**
     * @var \Project
     */
    private $project;

    /**
     * @var \FrsRelease
     */
    private $release;

    public function setUp()
    {
        parent::setUp();
        $this->setUpGlobalsMockery();
        $this->frs_service_permission_manager = \Mockery::spy(\Tuleap\FRS\FRSPermissionManager::class);
        $this->release_factory                = \Mockery::spy(\FRSReleaseFactory::class);

        $this->release_permission_manager = new ReleasePermissionManager(
            $this->frs_service_permission_manager,
            $this->release_factory
        );

        $this->project = aMockProject()->withId(100)->build();
        $this->user    = \Mockery::spy(\PFUser::class);
        $this->release = \Mockery::spy(\FRSRelease::class);
    }

    public function itReturnsTrueWhenReleaseIsHiddenAndUserIsFrsAdmin()
    {
        $this->release->shouldReceive('isHidden')->andReturns(true);
        stub($this->release_factory)->userCanAdmin($this->user, $this->project->getID())->returns(true);

        $this->assertTrue(
            $this->release_permission_manager->canUserSeeRelease($this->user, $this->release, $this->project)
        );
    }

    public function itReturnsFalseWhenReleaseIsHiddenAndUserDoesntHaveAdminPermissions()
    {
        $this->release->shouldReceive('isHidden')->andReturns(true);
        stub($this->release_factory)->userCanAdmin($this->user, $this->project->getID())->returns(false);

        $this->assertFalse(
            $this->release_permission_manager->canUserSeeRelease($this->user, $this->release, $this->project)
        );
    }

    public function itReturnsTrueWHenReleaseIsActiveAndUserCanAccessFrsServiceAndUserCanAccessRelease()
    {
        $this->release->shouldReceive('isActive')->andReturns(true);
        stub($this->frs_service_permission_manager)->userCanRead($this->project, $this->user)->returns(true);
        stub($this->release_factory)->userCanRead(
            $this->project->getID(),
            $this->release->getPackageID(),
            $this->release->getReleaseID()
        )->returns(true);

        $this->assertTrue(
            $this->release_permission_manager->canUserSeeRelease($this->user, $this->release, $this->project)
        );
    }

    public function itReturnsFalseWhenReleaseIsActiveAndUserCannotAccessFrsService()
    {
        $this->release->shouldReceive('isActive')->andReturns(true);
        stub($this->frs_service_permission_manager)->userCanRead($this->project, $this->user)->returns(false);

        $this->assertFalse(
            $this->release_permission_manager->canUserSeeRelease($this->user, $this->release, $this->project)
        );
    }

    public function itReturnsFalseWHenReleaseIsActiveAndUserCanAccessFrsServiceAndUserCanNotAccessRelease()
    {
        $this->release->shouldReceive('isActive')->andReturns(true);
        stub($this->frs_service_permission_manager)->userCanRead($this->project, $this->user)->returns(true);
        stub($this->release_factory)->userCanRead(
            $this->project->getID(),
            $this->release->getPackageID(),
            $this->release->getReleaseID()
        )->returns(false);

        $this->assertFalse(
            $this->release_permission_manager->canUserSeeRelease($this->user, $this->release, $this->project)
        );
    }
}
