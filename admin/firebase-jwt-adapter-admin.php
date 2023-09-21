<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/charlynedsson/firebase-jwt-adapter
 * @since      1.0.0
 *
 * @package    Firebase_JWT_Adapter
 * @subpackage Firebase_JWT_Adapter/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @since      1.0.0
 * @package    Firebase_JWT_Adapter
 * @subpackage Firebase_JWT_Adapter/admin
 * @author     Charly Nedsson <charlynedsson@gmail.com>
 */

use Carbon_Fields\Container;
use Carbon_Fields\Field;

class Firebase_JWT_Adapter_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Load Carbon Fields.
     *
     * @since    1.0.0
     */
    public function fja_load_carbon_fields()
    {
        require_once(plugin_dir_path(__FILE__) . '../vendor/autoload.php');
        \Carbon_Fields\Carbon_Fields::boot();
    }

    /**
     * Create option page.
     *
     * @since    1.0.0
     */
    public function fja_attach_theme_options()
    {
        Container::make('theme_options', __('Firebase JWT Adapter', 'firebase-jwt-adapter'),)
            //->set_icon('dashicons-rest-api')            
            ->add_fields(array(
                Field::make('textarea', FIREBASE_JWT_ADAPTER_OPTION_KEY_FIREBASE_CONFIG, __('Firebase Config.'))
                    //->set_required(true)
                    ->set_attribute('placeholder', '
                    {
                        "type": "service_account",
                        "project_id": "project_id",
                        "private_key_id": "private_key_id",
                        "private_key": "-----BEGIN PRIVATE KEY-----...",
                        "client_email": "abc-123@a-b-c-123.iam.gserviceaccount.com",
                        "client_id": "client_id",
                        "auth_uri": "https://accounts.google.com/o/oauth2/auth",
                        "token_uri": "https://oauth2.googleapis.com/token",
                        "auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs",
                        "client_x509_cert_url": "client_x509_cert_url",
                        "universe_domain": "googleapis.com"
                      }
                    '),
                // Field::make('html', 'fja-version')
                //     ->set_html('<p><small>Version: ' . $this->version . '<small></p>')
            ));
    }
}
