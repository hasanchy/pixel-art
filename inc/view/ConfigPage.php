<?php

namespace PIXELART\view;

use PIXELART\base\UtilsProvider;
use PIXELART\Core;

\defined('ABSPATH') or die('No direct access allowed!');
// Avoid direct file request
/**
 * Add an option page to "Products".
 */
class ConfigPage
{
    use UtilsProvider;
    const COMPONENT_ID = PIXELART_SLUG . '-component';

    /**
     * Constructor.
     */
    private function __construct()
    {
        // Silence is golden.
    }
    /**
     * Add new menu page.
     */
    public function admin_menu()
    {
        \add_menu_page('Pixel Art - Amazon Product Importer', 'Pixel Art', 'manage_options', 'pixel-art', [$this, 'render_component_library'], 'dashicons-grid-view', 100);
    }

    /**
     * Show a "Settings" link in plugins list.
     *
     * @param string[] $actions
     * @return string[]
     */
    public function plugin_action_links($actions)
    {
        $actions[] = \sprintf('<a href="%s">%s</a>', $this->getUrl(), \__('Pixel Arts'));
        return $actions;
    }

    /**
     * Render the content of the menu page.
     */
    public function render_component_library()
    {
        echo '<div id="' . esc_html(self::COMPONENT_ID) . '" class="wrap"></div>';
    }

    /**
     * Get the URL of this page.
     */
    public function getUrl()
    {
        return \admin_url('admin.php?page=' . PIXELART_SLUG);
    }

    /**
     * New instance.
     */
    public static function instance()
    {
        return new \PIXELART\view\ConfigPage();
    }
}