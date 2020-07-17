<?php
/**
 * Copyright (c) Enalean, 2019 - Present. All Rights Reserved.
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

namespace Tuleap\Tracker\REST\v1;

use Tuleap\Tracker\FormElement\Field\File\Upload\FileToUpload;

/**
 * @psalm-immutable
 */
final class CreatedFileRepresentation
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $download_href;
    /**
     * @var ?string
     */
    public $upload_href;

    public function __construct(FileToUpload $file_to_upload, int $file_size)
    {
        $this->id            = $file_to_upload->getId();
        $this->download_href = $file_to_upload->getDownloadHref();

        if ($file_size !== 0) {
            $this->upload_href = $file_to_upload->getUploadHref();
        }
    }
}
