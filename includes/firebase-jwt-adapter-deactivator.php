<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://github.com/charlynedsson/firebase-jwt-adapter
 * @since      1.0.0
 *
 * @package    Firebase_JWT_Adapter
 * @subpackage Firebase_JWT_Adapter/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Firebase_JWT_Adapter
 * @subpackage Firebase_JWT_Adapter/includes
 * @author     Charly Nedsson <charlynedsson@gmail.com>
 */
class Firebase_JWT_Adapter_Deactivator
{

	/**
	 * Plugin deactivator.
	 *
	 * Firebase JWT Adapter plugin deactivator.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate()
	{
		Firebase_JWT_Adapter_Deactivator::app_delete_carbon_container_fields('carbon_fields_container_firebase_jwt_adapter');
	}

	/**
	 * Delete all fields values from Carbon Fields Theme Options Container
	 *
	 * @since    1.0.0
	 * @param string  $container_id  Example of id - "carbon_fields_container_{SANITIZED_CONTAINER_NAME}
	 * @return void
	 */
	private static function app_delete_carbon_container_fields($container_id)
	{
		$repository = \Carbon_Fields\Carbon_Fields::resolve('container_repository');
		$containers = $repository->get_containers();

		foreach ($containers as $container) {

			if ($container->get_id() !== $container_id) {
				continue;
			}

			

			$fields = $container->get_fields();

			foreach ($fields as $field) {

				$field->delete();
			}
		}
	}
}