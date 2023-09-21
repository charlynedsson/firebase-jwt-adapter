<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/charlynedsson/firebase-jwt-adapter
 * @since      1.0.0
 *
 * @package    Firebase_JWT_Adapter
 * @subpackage Firebase_JWT_Adapter/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @since      1.0.0
 * @package    Firebase_JWT_Adapter
 * @subpackage Firebase_JWT_Adapter/public
 * @author     Charly Nedsson <charlynedsson@gmail.com>
 */

use Firebase\JWT\JWT;

class Firebase_JWT_Adapter_Public
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
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register endpoint routes.
     *
     * @since    1.0.0
     */
    public function fja_register_routes()
    {
        register_rest_route(
            'fja/v' . substr($this->version, 0, 1),
            '/getTokenWithCookie',
            array(
                'methods'  => WP_REST_Server::READABLE,
                'callback' => array($this, 'fja_getTokenWithCookie'),
                'permission_callback' => array($this, 'fja_permitCookie'),
            )
        );
    }

    /**
     * Cookie based endpoint callback.
     *
     * @since    1.0.0
     */
    public function fja_getTokenWithCookie()
    {
        $firebase_config = json_decode(carbon_get_theme_option(FIREBASE_JWT_ADAPTER_OPTION_KEY_FIREBASE_CONFIG), true);

        if (empty($firebase_config) || !isset($firebase_config['private_key']) || !isset($firebase_config['client_email'])) {
            return new WP_Error('rest_fja', esc_html__('Firebase JWT Adapter settings incomplete.', 'firebase-jwt-adapter'), array('status' => 500));
        }

        $user_Id = get_current_user_id();
        $token = $this->fja_create_custom_token($firebase_config['private_key'], $firebase_config['client_email'], $user_Id);

        return rest_ensure_response($token);
    }

    /**
     * Cookie based permission callback.
     *
     * @since    1.0.0
     */
    public function fja_permitCookie()
    {
        $permit = is_user_logged_in();
        return $permit;
    }

    /**
     * Return Firebase JWT token.
     *
     * @since    1.0.0
     */
    private function fja_create_custom_token($private_key, $service_account_email, $uid)
    {

        $now_seconds = time();
        $payload = array(
            "iss" => $service_account_email,
            "sub" => $service_account_email,
            "aud" => "https://identitytoolkit.googleapis.com/google.identity.identitytoolkit.v1.IdentityToolkit",
            "iat" => $now_seconds,
            "exp" => $now_seconds + (60 * 60),  // Maximum expiration time is one hour
            "uid" => apply_filters("fja_set_uid", $uid),
        );

        if (has_filter("fja_set_custom_claims")) {
            $payload["claims"] = apply_filters("fja_set_custom_claims", array());
        }

        return JWT::encode($payload, $private_key, "RS256");
    }
}
