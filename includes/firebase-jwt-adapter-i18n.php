<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/charlynedsson/firebase-jwt-adapter
 * @since      1.0.0
 *
 * @package    Firebase_JWT_Adapter
 * @subpackage Firebase_JWT_Adapter/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Firebase_JWT_Adapter
 * @subpackage Firebase_JWT_Adapter/includes
 * @author     Charly Nedsson <charlynedsson@gmail.com>
 */
class Firebase_JWT_Adapter_i18n
{
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain()
	{
		$res = load_plugin_textdomain(
			'firebase-jwt-adapter',
			false,
			dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
		);
	}
}
