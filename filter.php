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
/*
 * LinkLight Filter
 *
 * @package /
 * @category core
 * @copyright 2018 CVUT CZM, Jiri Fryc
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

class filter_linklight extends moodle_text_filter {

    /**
     * Override this function to actually implement the filtering.
     *
     * @param $text some HTML content.
     * @param array $options options passed to the filters
     * @return the HTML content after the filtering has been applied.
     */
    public function filter($text, array $options = array()) {
        global $CFG;
        $matches = [];
        preg_match_all('/<a[^\>]*>/', $text, $matches, PREG_OFFSET_CAPTURE);
        // We need to go from end. Otherwise we would break positioning.
        for ($i = count($matches[0]) - 1; $i >= 0; $i--) {
            $match = $matches[0][$i];
            if (count($match) == 0) {
                continue;
            }
            $pos = strpos($match[0], 'href=') + 5;

            if (strpos($match[0], $CFG->wwwroot, $pos) == $pos + 1) {
                $text = $this->internal_link($text, $match[1], strlen($match[0]));
            } else {
                $text = $this->external_link($text, $match[1], strlen($match[0]));
            }

        }
        return $text;
    }

    private function external_link(string $text, int $before, int $length) {
        $icon = get_config('filter_linklight', 'external_icon');
        if ($icon == null || $icon == '') {
            return $text;
        }
        $text = substr($text, 0, $before) . "&nbsp;" . substr($text, $before, $length) . "<i class='fa fa-{$icon}'></i>" .
                substr($text, $before + $length);
        return $text;
    }

    private function internal_link(string $text, int $before, int $length) {
        $icon = get_config('filter_linklight', 'internal_icon');
        if ($icon == null || $icon == '') {
            return $text;
        }
        $text = substr($text, 0, $before) . "&nbsp;" . substr($text, $before, $length) . "<i class='fa fa-{$icon}'></i>&nbsp;" .
                substr($text, $before + $length);
        return $text;
    }
}