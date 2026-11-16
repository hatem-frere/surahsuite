<?php

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @package    SurahSuite_Core
 * @subpackage SurahSuite_Core/includes
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

/**
 * Define the internationalization functionality.
 *
 * @since      0.1.0
 * @package    SurahSuite_Core
 * @subpackage SurahSuite_Core/includes
 */
class SurahSuite_i18n
{

    /**
     * Load the plugin text domain for translation.
     *
     * @since    0.1.0
     */
    public function load_plugin_textdomain()
    {
        load_plugin_textdomain(
            'surahsuite-core',
            false,
            dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );
    }
}
