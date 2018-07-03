<?php
/**
 * Created by CVUT CZM.
 * Author: Jiri Fryc
 * License: GNU GPLv3
 */

namespace filter_linklight\privacy;


use core_privacy\local\metadata\null_provider;

class provider implements null_provider
{

    /**
     * Get the language string identifier with the component's language
     * file to explain why this plugin stores no data.
     *
     * @return  string
     */
    public static function get_reason(): string
    {
        return 'privacy:metadata';
    }
}