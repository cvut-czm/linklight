<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    $setting = new admin_setting_configtext('filter_linklight/internal_icon',
            new lang_string('internal_link_icon','filter_linklight'),
            new lang_string('internal_link_icon_desc','filter_linklight'),
            'link',PARAM_ALPHANUMEXT);
    $settings->add($setting);
    $setting = new admin_setting_configtext('filter_linklight/external_icon',
            new lang_string('external_link_icon','filter_linklight'),
            new lang_string('external_link_icon_desc','filter_linklight'),
            'globe',PARAM_ALPHANUMEXT);
    $settings->add($setting);

}
