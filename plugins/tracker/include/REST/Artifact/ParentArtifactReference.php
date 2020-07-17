<?php
/**
 * Copyright (c) Enalean, 2015-Present. All rights reserved
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
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Tuleap. If not, see <http://www.gnu.org/licenses/
 */

namespace Tuleap\Tracker\REST\Artifact;

use Tracker_Artifact;

/**
 * @psalm-immutable
 */
class ParentArtifactReference extends ArtifactReference
{

    /**
     * @var string
     */
    public $title;

    private function __construct(Tracker_Artifact $artifact, \Tracker $tracker, string $format = '')
    {
        parent::__construct($artifact, $tracker, $format);

        $this->title = $artifact->getCachedTitle();
    }

    /**
     * @return ParentArtifactReference
     */
    public static function build(Tracker_Artifact $artifact, string $format = ''): ArtifactReference
    {
        return new self($artifact, $artifact->getTracker(), $format);
    }
}
