<?php
/**
 * Copyright (c) Enalean, 20127 All Rights Reserved.
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

namespace Tuleap\Tracker\FormElement;

use Tracker_FormElement_Field_BurndownException;

require_once TRACKER_BASE_DIR . '/../tests/bootstrap.php';

class BurndownConfigurationValueCheckerTest extends \TuleapTestCase
{
    /**
     * @var \Tracker_FormElement_Field_Integer
     */
    public $duration_field;

    /**
     * @var \Tracker_Artifact_Changeset
     */
    private $new_changeset;

    /**
     * @var \Tracker_Artifact_ChangesetValue_Integer
     */
    private $duration_changeset;

    /**
     * @var \Tracker_Artifact_ChangesetValue_Date
     */
    private $start_date_changeset;

    /**
     * @var \PFUser
     */
    private $user;

    /**
     * @var \Tracker_Artifact
     */
    private $artifact;

    /**
     * @var \Tracker_FormElement_Field
     */
    private $start_date_field;

    /**
     * @var ChartConfigurationFieldRetriever
     */
    private $configuration_field_retriever;

    /**
     * @var BurndownConfigurationValueRetriever
     */
    private $configuration_value_retriever;

    /**
     * @var BurndownConfigurationValueChecker
     */
    private $burndown_configuration_checker;

    public function setUp()
    {
        $this->configuration_field_retriever  = mock('Tuleap\Tracker\FormElement\ChartConfigurationFieldRetriever');
        $this->configuration_value_retriever  = mock('Tuleap\Tracker\FormElement\BurndownConfigurationValueRetriever');
        $this->burndown_configuration_checker = new BurndownConfigurationValueChecker(
            $this->configuration_field_retriever,
            $this->configuration_value_retriever
        );

        $this->start_date_field     = mock('Tracker_FormElement_Field_Date');
        $this->duration_field       = mock('Tracker_FormElement_Field_Integer');
        $this->artifact             = mock('Tracker_Artifact');
        $this->user                 = mock('PFUser');
        $this->start_date_changeset = mock('Tracker_Artifact_ChangesetValue_Date');
        $this->duration_changeset   = mock('Tracker_Artifact_ChangesetValue_Integer');
        $this->new_changeset        = mock('Tracker_Artifact_Changeset');
    }

    public function itReturnsFalseWhenBurndownDontHaveAStartDateField()
    {
        stub($this->configuration_field_retriever)->getBurndownStartDateField($this->artifact, $this->user)->throws(
            new Tracker_FormElement_Field_BurndownException()
        );

        $this->expectException('Tracker_FormElement_Field_BurndownException');

        $this->assertFalse(
            $this->burndown_configuration_checker->hasStartDate($this->artifact, $this->user)
        );
    }

    public function itReturnsFalseWhenStartDateFieldIsNeverDefined()
    {
        stub($this->configuration_field_retriever)->getBurndownStartDateField($this->artifact, $this->user)->returns(
            $this->start_date_field
        );
        stub($this->artifact)->getValue($this->start_date_field)->returns(null);

        $this->assertFalse(
            $this->burndown_configuration_checker->hasStartDate($this->artifact, $this->user)
        );
    }

    public function itReturnsFalseWhenStartDateFieldIsEmpty()
    {
        stub($this->configuration_field_retriever)->getBurndownStartDateField($this->artifact, $this->user)->returns(
            $this->start_date_field
        );
        stub($this->artifact)->getValue($this->start_date_field)->returns($this->start_date_changeset);
        stub($this->start_date_changeset)->getTimestamp()->returns(null);

        $this->assertFalse(
            $this->burndown_configuration_checker->hasStartDate($this->artifact, $this->user)
        );
    }

    public function itReturnsTrueWhenBurndownHasAStartDateAndStartDateIsFiled()
    {
        stub($this->configuration_field_retriever)->getBurndownStartDateField($this->artifact, $this->user)->returns(
            $this->start_date_field
        );
        stub($this->artifact)->getValue($this->start_date_field)->returns($this->start_date_changeset);
        stub($this->start_date_changeset)->getTimestamp()->returns(1488470204);

        $this->assertTrue(
            $this->burndown_configuration_checker->hasStartDate($this->artifact, $this->user)
        );
    }

    public function itReturnsConfigurationIsNotCorrectlySetWhenStartDateFieldIsMissing()
    {
        stub($this->configuration_value_retriever)->getBurndownDuration($this->artifact, $this->user)->returns(
            $this->duration_changeset
        );
        stub($this->configuration_value_retriever)->getBurndownStartDate($this->artifact, $this->user)->throws(
            new Tracker_FormElement_Field_BurndownException()
        );

        $this->assertFalse(
            $this->burndown_configuration_checker->areBurndownFieldsCorrectlySet($this->artifact, $this->user)
        );
    }

    public function itReturnsConfigurationIsNotCorrectlySetWhenStarDurationFieldIsMissing()
    {
        stub($this->configuration_value_retriever)->getBurndownDuration($this->artifact, $this->user)->throws(
            new Tracker_FormElement_Field_BurndownException()
        );
        stub($this->configuration_value_retriever)->getBurndownStartDate($this->artifact, $this->user)->returns(
            $this->start_date_field
        );

        $this->assertFalse(
            $this->burndown_configuration_checker->areBurndownFieldsCorrectlySet($this->artifact, $this->user)
        );
    }

    public function itReturnsConfigurationIsCorrectlySetWhenBurndownHasAStartDateAndADuration()
    {
        stub($this->configuration_value_retriever)->getBurndownDuration($this->artifact, $this->user)->returns(
            $this->duration_changeset
        );
        stub($this->configuration_value_retriever)->getBurndownStartDate($this->artifact, $this->user)->returns(
            $this->start_date_field
        );

        $this->assertTrue(
            $this->burndown_configuration_checker->areBurndownFieldsCorrectlySet($this->artifact, $this->user)
        );
    }

    public function itReturnsFalseWhenStartDateAndDurationDontHaveChanged()
    {
        stub($this->configuration_field_retriever)->getBurndownDurationField($this->artifact, $this->user)->returns(
            $this->duration_field
        );
        stub($this->configuration_field_retriever)->getBurndownStartDateField($this->artifact, $this->user)->returns(
            $this->start_date_field
        );
        stub($this->new_changeset)->getValue($this->start_date_field)->returns($this->start_date_changeset);
        stub($this->start_date_changeset)->hasChanged()->returns(false);

        stub($this->new_changeset)->getValue($this->duration_field)->returns($this->duration_changeset);
        stub($this->duration_changeset)->hasChanged()->returns(false);

        $this->assertFalse(
            $this->burndown_configuration_checker->hasConfigurationChange(
                $this->artifact,
                $this->user,
                $this->new_changeset
            )
        );
    }

    public function itReturnsTrueWhenStartDateHaveChanged()
    {
        stub($this->configuration_field_retriever)->getBurndownDurationField($this->artifact, $this->user)->returns(
            $this->duration_field
        );
        stub($this->configuration_field_retriever)->getBurndownStartDateField($this->artifact, $this->user)->returns(
            $this->start_date_field
        );
        stub($this->new_changeset)->getValue($this->start_date_field)->returns($this->start_date_changeset);
        stub($this->start_date_changeset)->hasChanged()->returns(true);

        stub($this->new_changeset)->getValue($this->duration_field)->returns($this->duration_changeset);
        stub($this->duration_changeset)->hasChanged()->returns(false);

        $this->assertTrue(
            $this->burndown_configuration_checker->hasConfigurationChange(
                $this->artifact,
                $this->user,
                $this->new_changeset
            )
        );
    }

    public function itReturnsTrueWhenDurationHaveChanged()
    {
        stub($this->configuration_field_retriever)->getBurndownDurationField($this->artifact, $this->user)->returns(
            $this->duration_field
        );
        stub($this->configuration_field_retriever)->getBurndownStartDateField($this->artifact, $this->user)->returns(
            $this->start_date_field
        );
        stub($this->new_changeset)->getValue($this->start_date_field)->returns($this->start_date_changeset);
        stub($this->start_date_changeset)->hasChanged()->returns(false);

        stub($this->new_changeset)->getValue($this->duration_field)->returns($this->duration_changeset);
        stub($this->duration_changeset)->hasChanged()->returns(true);

        $this->assertTrue(
            $this->burndown_configuration_checker->hasConfigurationChange(
                $this->artifact,
                $this->user,
                $this->new_changeset
            )
        );
    }
}
