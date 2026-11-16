<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static.
 * - Check if the $_REQUEST['action'] is set.
 * - If not, exit.
 * - Check if the WP_UNINSTALL_PLUGIN constant is set.
 * - If not, exit.
 * - Check if the user has requested to delete data.
 * - If yes, run the cleanup.
 *
 * @package    SurahSuite_Core
 */

// If uninstall not called from WordPress, then exit.
if (! defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Check if the user chose to preserve data. Default to true for safety.
$preserve_data = get_option('surahsuite_preserve_data', true);

if (! $preserve_data) {
    global $wpdb;

    $tables = array(
        $wpdb->prefix . 'surahsuite_teacher_profiles',
        $wpdb->prefix . 'surahsuite_teacher_availability',
        $wpdb->prefix . 'surahsuite_plans',
        $wpdb->prefix . 'surahsuite_bookings',
        $wpdb->prefix . 'surahsuite_transactions',
        $wpdb->prefix . 'surahsuite_subscriptions',
    );

    foreach ($tables as $table) {
        // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
        $wpdb->query("DROP TABLE IF EXISTS $table");
    }

    // Delete options.
    delete_option('surahsuite_preserve_data');
    // Add other options here as they are created in later steps.
}
