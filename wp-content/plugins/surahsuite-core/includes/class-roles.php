<?php

/**
 * Custom User Roles and Capabilities.
 *
 * @package    SurahSuite_Core
 * @subpackage SurahSuite_Core/includes
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

/**
 * Class SurahSuite_Roles
 *
 * Handles the registration of custom user roles.
 *
 * @since      0.1.0
 * @package    SurahSuite_Core
 * @subpackage SurahSuite_Core/includes
 */
class SurahSuite_Roles
{

    /**
     * Register the custom roles.
     *
     * @since    0.1.0
     */
    public static function register_roles()
    {
        // 1. Quran Admin (Inherits Administrator but scoped)
        add_role(
            'quran_admin',
            __('Quran Admin', 'surahsuite-core'),
            array(
                'read'                   => true,
                'edit_posts'             => true,
                'manage_options'         => true, // Allows access to plugin settings
                'manage_surahsuite'      => true, // Custom capability for future use
                'manage_teachers'        => true,
                'manage_students'        => true,
                'manage_bookings'        => true,
                'manage_finances'        => true,
            )
        );

        // 2. Quran Teacher
        add_role(
            'quran_teacher',
            __('Quran Teacher', 'surahsuite-core'),
            array(
                'read'                   => true,
                'edit_posts'             => false,
                'manage_own_availability' => true,
                'view_own_bookings'      => true,
                'view_own_earnings'      => true,
            )
        );

        // 3. Quran Student
        add_role(
            'quran_student',
            __('Quran Student', 'surahsuite-core'),
            array(
                'read'                   => true,
                'book_sessions'          => true,
                'view_own_bookings'      => true,
                'view_own_invoices'      => true,
            )
        );

        // 4. Quran Parent
        add_role(
            'quran_parent',
            __('Quran Parent', 'surahsuite-core'),
            array(
                'read'                   => true,
                'manage_child_accounts'  => true,
                'view_child_bookings'    => true,
            )
        );

        // Ensure Administrator gets our custom capabilities too
        $admin = get_role('administrator');
        if ($admin) {
            $admin->add_cap('manage_surahsuite');
            $admin->add_cap('manage_teachers');
            $admin->add_cap('manage_students');
            $admin->add_cap('manage_bookings');
            $admin->add_cap('manage_finances');
        }
    }
}
