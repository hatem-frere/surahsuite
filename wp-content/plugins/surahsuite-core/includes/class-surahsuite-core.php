<?php

/**
 * The file that defines the core plugin class.
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @package    SurahSuite_Core
 * @subpackage SurahSuite_Core/includes
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * @since      0.1.0
 * @package    SurahSuite_Core
 * @subpackage SurahSuite_Core/includes
 * @author     Hatem Frere
 */
class SurahSuite_Core
{

    /**
     * The unique instance of the plugin.
     *
     * @since    0.1.0
     * @access   protected
     * @var      SurahSuite_Core    $instance    Maintains the singleton instance.
     */
    protected static $instance = null;

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    0.1.0
     * @access   protected
     * @var      SurahSuite_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The string used for the plugin's text domain.
     *
     * @since    0.1.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    0.1.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    0.1.0
     */
    private function __construct()
    {
        if (defined('SURAHSUITE_CORE_VERSION')) {
            $this->version = SURAHSUITE_CORE_VERSION;
        } else {
            $this->version = '0.1.0';
        }
        $this->plugin_name = 'surahsuite-core';

        $this->load_dependencies();
        $this->set_locale();
    }

    /**
     * Return the unique instance of the plugin.
     *
     * @since    0.1.0
     * @return   SurahSuite_Core    The singleton instance.
     */
    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - SurahSuite_Loader. Orchestrates the hooks of the plugin.
     * - SurahSuite_i18n. Defines internationalization functionality.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    0.1.0
     * @access   private
     */
    private function load_dependencies()
    {
        /**
         * The class responsible for orchestrating the actions and filters of the core plugin.
         * Note: These are loaded automatically by our autoloader.
         */
        $this->loader = new SurahSuite_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the SurahSuite_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    0.1.0
     * @access   private
     */
    private function set_locale()
    {
        $plugin_i18n = new SurahSuite_i18n();
        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    0.1.0
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     0.1.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name()
    {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     0.1.0
     * @return    SurahSuite_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     0.1.0
     * @return    string    The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }
}
