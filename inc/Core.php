<?php
namespace PIXELART;

use PIXELART\rest\Settings;
use PIXELART\view\ConfigPage;

\defined('ABSPATH') or die('No direct access allowed!'); // Avoid direct file request

/**
 * Singleton core class which handles the main system for plugin. It includes
 */
class Core {
	/**
     * Singleton instance.
     */
    private static $me;
	/**
     * The config page.
     *
     * @var ConfigPage
     */
    private $configPage;
	/**
     * Assets handler.
     *
     * @var Assets
     */
    private $assets;
	/**
     * Settings handler.
     *
     * @var Settings
     */
    private $settings;

	/**
     * Application core constructor.
     */
	protected function __construct() 
	{
        $this->configPage = ConfigPage::instance();
		$this->assets = Assets::instance();
		$this->settings = Settings::instance();

		add_action('init', [$this, 'init'], 2);
	}

	/**
	 * The init function is fired even the init hook of WordPress. If possible
	 * it should register all hooks to have them in one place.
	 */
	public function init()
	{
        \add_action('admin_enqueue_scripts', [$this->getAssets(), 'admin_enqueue_scripts']);
		\add_action('init', [$this->getConfigPage(), 'create_pixel_art_block_init']);
		\add_action('admin_menu', [$this->getConfigPage(), 'admin_menu']);
		\add_filter('plugin_action_links_' . \plugin_basename(PIXELART_FILE), [$this->getConfigPage(), 'plugin_action_links'], 10, 2);
        \add_action('rest_api_init', [$this->getSettings(), 'rest_api_init']);
	}
    
    /**
     * Get singleton core class.
     *
     * @return Core
     */
    public static function getInstance()
    {
        return !isset(self::$me) ? self::$me = new \PIXELART\Core() : self::$me;
    }
	
	/**
     * Get config page.
     *
     * @codeCoverageIgnore
     */
    public function getConfigPage()
    {
        return $this->configPage;
    }

	/**
     * Get assets handler.
     *
     * @codeCoverageIgnore
     */
    public function getAssets()
    {
        return $this->assets;
    }

	/**
     * Get settings handler.
     *
     * @codeCoverageIgnore
     */
    public function getSettings()
    {
        return $this->settings;
    }

}