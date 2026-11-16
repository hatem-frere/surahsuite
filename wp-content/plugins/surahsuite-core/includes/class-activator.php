<?php

/**
 * Fired during plugin activation.
 *
 * @package    SurahSuite_Core
 * @subpackage SurahSuite_Core/includes
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

/**
 * Class SurahSuite_Activator
 *
 * @since      0.1.0
 * @package    SurahSuite_Core
 * @subpackage SurahSuite_Core/includes
 */
class SurahSuite_Activator
{

    /**
     * Run the activation logic.
     *
     * @since    0.1.0
     */
    public static function activate()
    {
        // Create the database tables.
        SurahSuite_DB::create_tables();

        // Register custom user roles and capabilities.
        SurahSuite_Roles::register_roles();

        // Flush rewrite rules to ensure custom post types or endpoints work.
        flush_rewrite_rules();
    }
}
