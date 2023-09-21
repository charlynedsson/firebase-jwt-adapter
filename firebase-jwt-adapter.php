<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/charlynedsson/firebase-jwt-adapter
 * @since             1.0.0
 * @package           Firebase_JWT_Adapter
 *
 * @wordpress-plugin
 * Plugin Name:       Firebase JWT Adapter
 * Plugin URI:        https://github.com/charlynedsson/firebase-jwt-adapter
 * Description:       WordPress adapter plugin to encode Firebase compatible JWT. 
 * Version:           1.0.0
 * Author:            CnApp
 * Author URI:        https://charlynedsson.github.io/
 * License:           MIT
 * License URI:       https://github.com/charlynedsson/firebase-jwt-adapter/blob/master/LICENSE
 * Text Domain:       firebase-jwt-adapter
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('FIREBASE_JWT_ADAPTER_VERSION', '1.0.0');

/**
 * Option key for firebase configuration.
 * Used with Carbon Fields
 */
define('FIREBASE_JWT_ADAPTER_OPTION_KEY_FIREBASE_CONFIG', 'fja_firebase_config');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_firebase_jwt_adapter()
{
	require_once plugin_dir_path(__FILE__) . 'includes/firebase-jwt-adapter-activator.php';
	Firebase_JWT_Adapter_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_firebase_jwt_adapter()
{
	require_once plugin_dir_path(__FILE__) . 'includes/firebase-jwt-adapter-deactivator.php';
	Firebase_JWT_Adapter_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_firebase_jwt_adapter');
register_deactivation_hook(__FILE__, 'deactivate_firebase_jwt_adapter');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/firebase-jwt-adapter.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

function run_plugin_name()
{
	if (defined('FIREBASE_JWT_ADAPTER_VERSION')) {
		$version = FIREBASE_JWT_ADAPTER_VERSION;
	} else {
		$version = '1.0.0';
	}
	$plugin = new Firebase_JWT_Adapter('firebase-jwt-adapter', $version);
	$plugin->run();
}

run_plugin_name();
