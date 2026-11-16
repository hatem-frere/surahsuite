<?php

/**
 * Fired during plugin deactivation.
 *
 * @package    SurahSuite_Core
 * @subpackage SurahSuite_Core/includes
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

/**
 * Class SurahSuite_Deactivator
 *
 * @since      0.1.0
 * @package    SurahSuite_Core
 * @subpackage SurahSuite_Core/includes
 */
class SurahSuite_Deactivator
{

    /**
     * Run the deactivation logic.
     *
     * @since    0.1.0
     */
    public static function deactivate()
    {
        // Flush rewrite rules to clean up.
        flush_rewrite_rules();
    }
}
