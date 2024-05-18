<?php
defined('ABSPATH') or die('No direct access allowed!'); // Avoid direct file request

/**
 * Show an admin notice to administrators when the minimum WP version
 * could not be reached. The error message is only in english available.
 */
function pixelart_skip_wp_admin_notice() {
    if (current_user_can('activate_plugins')) {
        $data = get_plugin_data(PIXELART_FILE, true, false);
        global $wp_version;
        echo '<div class=\'notice notice-error\'>
            <p><strong>' .
            esc_html($data['Name']) .
            '</strong> could not be initialized because you need minimum WordPress version ' .
            esc_html(PIXELART_MIN_WP) .
            ' ... you are running: ' .
            esc_html($wp_version) .
            '.
            <a href="' .
            esc_html(admin_url('update-core.php')) .
            '">Update WordPress now.</a>
        </div>';
    }
}
add_action('admin_notices', 'pixelart_skip_wp_admin_notice');
