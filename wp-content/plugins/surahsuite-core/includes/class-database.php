<?php

/**
 * Database schema management.
 *
 * @package    SurahSuite_Core
 * @subpackage SurahSuite_Core/includes
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

/**
 * Class SurahSuite_DB
 *
 * Handles the creation and updating of custom database tables.
 *
 * @since      0.1.0
 * @package    SurahSuite_Core
 * @subpackage SurahSuite_Core/includes
 */
class SurahSuite_DB
{

    /**
     * Get the array of custom table names.
     *
     * @since    0.1.0
     * @return   array    Array of table names with their keys.
     */
    public static function get_table_names()
    {
        global $wpdb;
        return array(
            'teacher_profiles'     => $wpdb->prefix . 'surahsuite_teacher_profiles',
            'teacher_availability' => $wpdb->prefix . 'surahsuite_teacher_availability',
            'plans'                => $wpdb->prefix . 'surahsuite_plans',
            'bookings'             => $wpdb->prefix . 'surahsuite_bookings',
            'transactions'         => $wpdb->prefix . 'surahsuite_transactions',
            'subscriptions'        => $wpdb->prefix . 'surahsuite_subscriptions',
        );
    }

    /**
     * Create the custom database tables.
     *
     * Uses dbDelta to safely create or update the database schema.
     *
     * @since    0.1.0
     */
    public static function create_tables()
    {
        global $wpdb;
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $charset_collate = $wpdb->get_charset_collate();
        $tables          = self::get_table_names();

        $sql = array();

        // 1. Teacher Profiles Table.
        $sql[] = "CREATE TABLE {$tables['teacher_profiles']} (
			id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
			user_id bigint(20) unsigned NOT NULL,
			ijazah_level varchar(100) NOT NULL DEFAULT '',
			gender varchar(20) NOT NULL DEFAULT '',
			bio text NOT NULL,
			hourly_rate decimal(10,2) NOT NULL DEFAULT '0.00',
			languages varchar(255) NOT NULL DEFAULT '',
			session_types varchar(255) NOT NULL DEFAULT '',
			status varchar(20) NOT NULL DEFAULT 'active',
			created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			PRIMARY KEY  (id),
			UNIQUE KEY user_id (user_id)
		) $charset_collate;";

        // 2. Teacher Availability Table.
        $sql[] = "CREATE TABLE {$tables['teacher_availability']} (
			id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
			teacher_id bigint(20) unsigned NOT NULL,
			weekday tinyint(1) NOT NULL,
			start_time time NOT NULL,
			end_time time NOT NULL,
			timezone varchar(50) NOT NULL DEFAULT 'UTC',
			is_recurring tinyint(1) NOT NULL DEFAULT 1,
			valid_from date DEFAULT NULL,
			valid_until date DEFAULT NULL,
			PRIMARY KEY  (id),
			KEY teacher_id (teacher_id)
		) $charset_collate;";

        // 3. Plans Table.
        $sql[] = "CREATE TABLE {$tables['plans']} (
			id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
			name varchar(255) NOT NULL,
			slug varchar(255) NOT NULL,
			price decimal(10,2) NOT NULL DEFAULT '0.00',
			currency varchar(3) NOT NULL DEFAULT 'USD',
			duration_days int(11) NOT NULL DEFAULT 30,
			session_count int(11) NOT NULL DEFAULT 0,
			description text NOT NULL,
			status varchar(20) NOT NULL DEFAULT 'active',
			PRIMARY KEY  (id),
			UNIQUE KEY slug (slug)
		) $charset_collate;";

        // 4. Bookings Table.
        $sql[] = "CREATE TABLE {$tables['bookings']} (
			id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
			student_id bigint(20) unsigned NOT NULL,
			teacher_id bigint(20) unsigned NOT NULL,
			plan_id bigint(20) unsigned DEFAULT NULL,
			session_type varchar(50) NOT NULL DEFAULT 'one-on-one',
			start_utc datetime NOT NULL,
			end_utc datetime NOT NULL,
			status varchar(20) NOT NULL DEFAULT 'pending',
			price decimal(10,2) NOT NULL DEFAULT '0.00',
			currency varchar(3) NOT NULL DEFAULT 'USD',
			notes text NOT NULL,
			created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			PRIMARY KEY  (id),
			KEY student_id (student_id),
			KEY teacher_id (teacher_id),
			KEY start_utc (start_utc),
			KEY status (status)
		) $charset_collate;";

        // 5. Transactions Table.
        $sql[] = "CREATE TABLE {$tables['transactions']} (
			id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
			booking_id bigint(20) unsigned DEFAULT NULL,
			plan_id bigint(20) unsigned DEFAULT NULL,
			gateway varchar(50) NOT NULL,
			gateway_txn_id varchar(255) NOT NULL,
			amount decimal(10,2) NOT NULL DEFAULT '0.00',
			currency varchar(3) NOT NULL DEFAULT 'USD',
			status varchar(20) NOT NULL DEFAULT 'pending',
			raw_response longtext NOT NULL,
			created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY  (id),
			KEY booking_id (booking_id),
			KEY gateway_txn_id (gateway_txn_id)
		) $charset_collate;";

        // 6. Subscriptions Table.
        $sql[] = "CREATE TABLE {$tables['subscriptions']} (
			id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
			student_id bigint(20) unsigned NOT NULL,
			plan_id bigint(20) unsigned NOT NULL,
			gateway varchar(50) NOT NULL,
			gateway_sub_id varchar(255) NOT NULL,
			status varchar(20) NOT NULL DEFAULT 'active',
			next_billing_utc datetime DEFAULT NULL,
			created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY  (id),
			KEY student_id (student_id),
			KEY plan_id (plan_id)
		) $charset_collate;";

        foreach ($sql as $query) {
            dbDelta($query);
        }
    }
}
