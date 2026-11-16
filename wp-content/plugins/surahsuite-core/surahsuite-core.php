<?php

/**
 * Plugin Name:       SurahSuite Core
 * Plugin URI:        https://hatemfrere.freehosting.dev/
 * Description:       The core engine for the SurahSuite Quran memorization platform. Handles teachers, students, bookings, and payments.
 * Version:           0.1.0
 * Requires at least: 6.0
 * Requires PHP:      8.0
 * Author:            Hatem Frere
 * Author URI:        https://hatemfrere.freehosting.dev/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       surahsuite-core
 * Domain Path:       /languages
 *
 * @package SurahSuite_Core
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

// Define plugin constants.
define('SURAHSUITE_CORE_VERSION', '0.1.0');
define('SURAHSUITE_CORE_FILE', __FILE__);
define('SURAHSUITE_CORE_PATH', plugin_dir_path(__FILE__));
define('SURAHSUITE_CORE_URL', plugin_dir_url(__FILE__));

// Load the autoloader.
require_once SURAHSUITE_CORE_PATH . 'includes/autoloader.php';

// Register activation and deactivation hooks.
register_activation_hook(__FILE__, array('SurahSuite_Activator', 'activate'));
register_deactivation_hook(__FILE__, array('SurahSuite_Deactivator', 'deactivate'));

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.1.0
 */
function run_surahsuite_core()
{
    $plugin = SurahSuite_Core::instance();
    $plugin->run();
}
add_action('plugins_loaded', 'run_surahsuite_core');
