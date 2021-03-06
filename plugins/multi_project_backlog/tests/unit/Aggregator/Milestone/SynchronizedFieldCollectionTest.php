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

namespace Tuleap\MultiProjectBacklog\Aggregator\Milestone;

use Mockery as M;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use Tuleap\Test\Builders\UserTestBuilder;

final class SynchronizedFieldCollectionTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    public function testCanUserSubmitAndUpdateAllFieldsReturnsTrue(): void
    {
        $first_field = M::mock(\Tracker_FormElement_Field::class);
        $first_field->shouldReceive('getId')->andReturn('1023');
        $first_field->shouldReceive('userCanSubmit')->andReturnTrue();
        $first_field->shouldReceive('userCanUpdate')->andReturnTrue();
        $second_field = M::mock(\Tracker_FormElement_Field::class);
        $second_field->shouldReceive('getId')->andReturn('1024');
        $second_field->shouldReceive('userCanSubmit')->andReturnTrue();
        $second_field->shouldReceive('userCanUpdate')->andReturnTrue();
        $user = UserTestBuilder::aUser()->build();

        $collection = new SynchronizedFieldCollection([$first_field, $second_field]);
        $this->assertTrue($collection->canUserSubmitAndUpdateAllFields($user));
    }

    public function testItReturnsFalseWhenUserCantSubmitOneField(): void
    {
        $first_field = M::mock(\Tracker_FormElement_Field::class);
        $first_field->shouldReceive('getId')->andReturn('1023');
        $first_field->shouldReceive('userCanSubmit')->andReturnTrue();
        $first_field->shouldReceive('userCanUpdate')->andReturnTrue();
        $second_field = M::mock(\Tracker_FormElement_Field::class);
        $second_field->shouldReceive('getId')->andReturn('1024');
        $second_field->shouldReceive('userCanSubmit')->andReturnFalse();
        $user = UserTestBuilder::aUser()->build();

        $collection = new SynchronizedFieldCollection([$first_field, $second_field]);
        $this->assertFalse($collection->canUserSubmitAndUpdateAllFields($user));
    }

    public function testItReturnsFalseWhenUserCantUpdateOneField(): void
    {
        $first_field = M::mock(\Tracker_FormElement_Field::class);
        $first_field->shouldReceive('getId')->andReturn('1023');
        $first_field->shouldReceive('userCanSubmit')->andReturnTrue();
        $first_field->shouldReceive('userCanUpdate')->andReturnTrue();
        $second_field = M::mock(\Tracker_FormElement_Field::class);
        $second_field->shouldReceive('getId')->andReturn('1024');
        $second_field->shouldReceive('userCanSubmit')->andReturnTrue();
        $second_field->shouldReceive('userCanUpdate')->andReturnFalse();
        $user = UserTestBuilder::aUser()->build();

        $collection = new SynchronizedFieldCollection([$first_field, $second_field]);
        $this->assertFalse($collection->canUserSubmitAndUpdateAllFields($user));
    }

    public function testCanDetermineIfAFieldIsSynchronized(): void
    {
        $field = M::mock(\Tracker_FormElement_Field::class);
        $field->shouldReceive('getId')->andReturn('1023');

        $collection = new SynchronizedFieldCollection([$field]);
        $this->assertTrue($collection->isFieldSynchronized($field));

        $not_synchronized_field = M::mock(\Tracker_FormElement_Field::class);
        $not_synchronized_field->shouldReceive('getId')->andReturn('1024');
        $this->assertFalse($collection->isFieldSynchronized($not_synchronized_field));
    }

    public function testCanObtainsTheSynchronizedFieldIDs(): void
    {
        $field1 = M::mock(\Tracker_FormElement_Field::class);
        $field1->shouldReceive('getId')->andReturn('1023');
        $field2 = M::mock(\Tracker_FormElement_Field::class);
        $field2->shouldReceive('getId')->andReturn('1024');

        $collection = new SynchronizedFieldCollection([$field1, $field2]);
        $this->assertEquals([1023, 1024], $collection->getSynchronizedFieldIDs());
    }
}
