<?php

/**
 * Autoloader for SurahSuite Core.
 *
 * @package SurahSuite_Core
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

spl_autoload_register('surahsuite_core_autoloader');

/**
 * Dynamically loads the class attempting to be instantiated.
 *
 * @param string $class_name The fully-qualified name of the class to load.
 */
function surahsuite_core_autoloader($class_name)
{
    // Project-specific namespace prefix.
    $prefix = 'SurahSuite_';

    // Does the class use the namespace prefix?
    if (strpos($class_name, $prefix) !== 0) {
        return;
    }

    // Strip the prefix to get the base class name (e.g., 'SurahSuite_Activator' becomes 'Activator').
    $base_class_name = str_replace($prefix, '', $class_name);

    // Map specific classes to their specific file names if they don't follow the standard pattern.
    $special_files = array(
        'Core' => 'class-surahsuite-core.php',
        'DB'   => 'class-database.php',
        'i18n' => 'class-i18n.php',
    );

    if (array_key_exists($base_class_name, $special_files)) {
        $class_file = $special_files[$base_class_name];
    } else {
        // Convert base class name to WordPress file naming convention.
        // e.g., 'Teacher_Repository' -> 'class-teacher-repository.php'.
        $class_file = 'class-' . strtolower(str_replace('_', '-', $base_class_name)) . '.php';
    }

    // Define the directories to search, in order of priority.
    $paths = array(
        SURAHSUITE_CORE_PATH . 'includes/',
        SURAHSUITE_CORE_PATH . 'admin/',
        SURAHSUITE_CORE_PATH . 'public/',
    );

    // Dynamically add module directories to the search paths.
    $module_dirs = glob(SURAHSUITE_CORE_PATH . 'modules/*', GLOB_ONLYDIR);
    if ($module_dirs) {
        foreach ($module_dirs as $dir) {
            $paths[] = trailingslashit($dir);
        }
    }

    // Search for the file in the defined paths.
    foreach ($paths as $path) {
        $file = $path . $class_file;
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
}
