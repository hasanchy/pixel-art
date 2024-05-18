<?php
namespace PIXELART\rest;

use WP_Error;
use WP_REST_Response;

\defined('ABSPATH') or die('No direct access allowed!');

/**
 * Create an example REST Settings.
 */

class Settings
{
    private function __construct()
    {
        // Silence is golden.
    }

    /**
     * Register endpoints.
     */
    public function rest_api_init()
    {
        \register_rest_route( 'pixel-art/v1', '/settings', [
            'methods' => 'GET',
            'callback' => [ $this, 'get_settings' ],
            'permission_callback' => [ $this, 'permission_callback' ]
        ] );

        \register_rest_route( 'pixel-art/v1', '/settings', [
            'methods' => 'POST',
            'callback' => [ $this, 'save_settings' ],
            'permission_callback' => [ $this, 'permission_callback' ]
        ] );

    }

    public function get_settings() {
        $pixelart_amazon_access_key = get_option( 'pixelart_amazon_access_key' );
        $pixelart_amazon_secret_key  = get_option( 'pixelart_amazon_secret_key' );
		$pixelart_amazon_country_code  = get_option( 'pixelart_amazon_country_code' );
		$pixelart_amazon_affiliate_id  = get_option( 'pixelart_amazon_affiliate_id' );
        
        $pixelart_settings_remote_image = get_option( 'pixelart_settings_remote_image' );
        $pixelart_settings_product_price  = get_option( 'pixelart_settings_product_price' );
		$pixelart_settings_product_description  = get_option( 'pixelart_settings_product_description' );
		$pixelart_settings_product_attributes  = get_option( 'pixelart_settings_product_attributes' );

        $pixelart_settings_auto_sync = get_option( 'pixelart_settings_auto_sync' );
        $pixelart_settings_auto_sync_occurence  = get_option( 'pixelart_settings_auto_sync_occurence' );
		$pixelart_settings_sync_product_name  = get_option( 'pixelart_settings_sync_product_name' );
		$pixelart_settings_sync_product_price  = get_option( 'pixelart_settings_sync_product_price' );
        $pixelart_settings_sync_product_thumbnail  = get_option( 'pixelart_settings_sync_product_thumbnail' );
        $pixelart_settings_sync_product_description  = get_option( 'pixelart_settings_sync_product_description' );
        $pixelart_settings_sync_product_attributes  = get_option( 'pixelart_settings_sync_product_attributes' );

        $response = [
            'pixelart_amazon_access_key' => $pixelart_amazon_access_key ? $pixelart_amazon_access_key : "",
            'pixelart_amazon_secret_key'  => $pixelart_amazon_secret_key ? $pixelart_amazon_secret_key : "",
			'pixelart_amazon_country_code' => $pixelart_amazon_country_code ? $pixelart_amazon_country_code : "us",
			'pixelart_amazon_affiliate_id' => $pixelart_amazon_affiliate_id ? $pixelart_amazon_affiliate_id : "",
            'remote_image' => isset($pixelart_settings_remote_image) ? $pixelart_settings_remote_image : "No",
            'product_price'  => isset($pixelart_settings_product_price) ? (int)$pixelart_settings_product_price : 0,
			'product_description' => isset($pixelart_settings_product_description) ? (int)$pixelart_settings_product_description : 0,
			'product_attributes' => isset($pixelart_settings_product_attributes) ? (int)$pixelart_settings_product_attributes : 0,
            'auto_sync' => isset($pixelart_settings_auto_sync) ? $pixelart_settings_auto_sync : 'on',
            'auto_sync_occurence' => isset($pixelart_settings_auto_sync_occurence) ? $pixelart_settings_auto_sync_occurence : 'everyday',
            'sync_product_name' => isset($pixelart_settings_sync_product_name) ? (int)$pixelart_settings_sync_product_name : 1,
            'sync_product_price' => isset($pixelart_settings_sync_product_price) ? (int)$pixelart_settings_sync_product_price : 1,
            'sync_product_thumbnail' => isset($pixelart_settings_sync_product_thumbnail) ? (int)$pixelart_settings_sync_product_thumbnail : 1,
            'sync_product_description' => isset($pixelart_settings_sync_product_description) ? (int)$pixelart_settings_sync_product_description : 1,
            'sync_product_attributes' => isset($pixelart_settings_sync_product_attributes) ? (int)$pixelart_settings_sync_product_attributes : 1
        ];

        return rest_ensure_response( $response );
    }

    public function save_settings($req) {

        if ( isset( $req['pixelart_amazon_access_key'] ) ) {
			$pixelart_amazon_access_key = sanitize_text_field( $req['pixelart_amazon_access_key'] );
			$pixelart_amazon_secret_key = sanitize_text_field( $req['pixelart_amazon_secret_key'] );
			$pixelart_amazon_country_code = sanitize_text_field( $req['pixelart_amazon_country_code'] );
			$pixelart_amazon_affiliate_id = sanitize_text_field( $req['pixelart_amazon_affiliate_id'] );

			update_option('pixelart_amazon_access_key', $pixelart_amazon_access_key );
			update_option('pixelart_amazon_secret_key', $pixelart_amazon_secret_key );
			update_option('pixelart_amazon_country_code', $pixelart_amazon_country_code );
			update_option('pixelart_amazon_affiliate_id', $pixelart_amazon_affiliate_id );
		}

		$response = [
            'Success' => "Settings saved successfully"
        ];

        return new WP_REST_Response( $response );
	}

    /**
     * Check if user is allowed to call this service requests.
     */
    public function permission_callback()
    {
        $permit = \PIXELART\rest\Settings::permit();
        return $permit === null ? \true : $permit;
    }

    /**
     * Checks if the current user has a given capability and throws an error if not.
     *
     * @param string $cap The capability
     * @throws \WP_Error
     */
    public static function permit($cap = 'publish_posts')
    {
        if (!\current_user_can($cap)) {
            return new WP_Error('rest_pixelart_forbidden', \__('Forbidden'), ['status' => 403]);
        }
        if (!\pixelart_is_plugin_active()) {
            return new WP_Error('rest_pixelart_not_activated', \__('Delete WooCommerce Products is not active for the current user.', 'pixel-art'), ['status' => 500]);
        }
        return null;
    }

    /**
     * New instance.
     */
    public static function instance()
    {
        return new \PIXELART\rest\Settings();
    }
}