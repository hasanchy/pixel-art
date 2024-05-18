<?php
/**
 * Main file for WordPress.
 * 
 * @wordpress-plugin
 * Plugin Name:     Pixel Art
 * Description:     Efficiently fetch WooCommerce products in just a few clicks
 * Author:          ThemeDyno
 * Author URI:      https://themedyno.com/
 * Version:         1.0.0
 * Text Domain:     pixel-art
 * Domain Path:	    /languages
 *
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

defined('ABSPATH') or die('No direct access allowed!'); // Avoid direct file request

/**
 * Plugin constants. This file is procedural coding style for initialization of
 * the plugin core and definition of plugin configuration.
 */
if (defined('PIXELART_PATH')) {
    require_once dirname(__FILE__) . '/inc/base/others/fallback-already.php';
    return;
}

define('PIXELART_FILE', __FILE__);
define('PIXELART_PATH', dirname(PIXELART_FILE));
define('PIXELART_SLUG', basename(PIXELART_PATH));
define('PIXELART_INC', PIXELART_PATH . '/inc/');
define('PIXELART_MIN_PHP', '7.2.0'); // Minimum of PHP 7.2 required for autoloading and namespacing
define('PIXELART_MIN_WP', '5.2.0'); // Minimum of WordPress 5.0 required
define('PIXELART_NS', 'PIXELART');
define('PIXELART_IS_PRO', false);
define('PIXELART_SLUG_LITE', 'pixelart');
define('PIXELART_SLUG_PRO', 'pixelart-pro');

// Check PHP Version and print notice if minimum not reached, otherwise start the plugin core
require_once PIXELART_INC .
    'base/others/' .
    (version_compare(phpversion(), PIXELART_MIN_PHP, '>=') ? 'start.php' : 'fallback-php-version.php');