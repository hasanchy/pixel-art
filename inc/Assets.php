<?php
namespace PIXELART;

// @codeCoverageIgnoreStart
\defined('ABSPATH') or die('No direct access allowed!');
// Avoid direct file request
// @codeCoverageIgnoreEnd
/**
 * Asset management for frontend scripts and styles.
 */
class Assets
{
    public function admin_enqueue_scripts()
    {
        
        $cachebuster = $this->getCachebusterVersion();

        $scriptSrc = 'build/admin.js';
        $scriptPath = \trailingslashit(PIXELART_PATH) . $scriptSrc;
        if (\file_exists($scriptPath)) {
            $scriptUrl = \plugins_url($scriptSrc, PIXELART_FILE);
            // exit($scriptUrl);
            \wp_enqueue_script('admin', $scriptUrl, ['wp-element'], $cachebuster);
            
            // Localize script with server-side variables
            \wp_localize_script('admin', 'appLocalizer', [
                'restUrl' => home_url( '/wp-json' ),
                'restNonce' => wp_create_nonce( 'wp_rest' ),
            ]);
        }

        $styleSrc = 'build/admin.css';
        $stylePath = \trailingslashit(PIXELART_PATH) . $styleSrc;
        if (\file_exists($stylePath)) {
            $styleUrl = \plugins_url($styleSrc, PIXELART_FILE);
            \wp_enqueue_style('admin', $styleUrl, [], $cachebuster);
        }

    }

    public function getCachebusterVersion()
    {   
        return \wp_rand();
    }

    /**
     * New instance.
     *
     * @codeCoverageIgnore
     */
    public static function instance()
    {
        return new Assets();
    }

}