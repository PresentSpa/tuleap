<?php
/**
 * Copyright (c) Enalean, 2016 - 2017. All Rights Reserved.
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

namespace Tuleap\Theme\BurningParrot\Navbar;

use Tuleap\layout\NewDropdown\NewDropdownPresenter;

class Presenter
{
    /** @var UserNavPresenter */
    public $user_nav_presenter;

    public $homepage_label;
    /**
     * @var NewDropdownPresenter
     */
    public $new_dropdown;
    /**
     * @var bool
     * @psalm-readonly
     */
    public $is_super_user;

    public function __construct(
        UserNavPresenter $user_nav_presenter,
        NewDropdownPresenter $new_dropdown,
        bool $is_super_user
    ) {
        $this->user_nav_presenter   = $user_nav_presenter;
        $this->homepage_label       = _('Homepage');
        $this->new_dropdown         = $new_dropdown;
        $this->is_super_user        = $is_super_user;
    }
}
