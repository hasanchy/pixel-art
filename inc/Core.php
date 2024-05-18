<?php
namespace PIXELART;

use PIXELART\base\Core as BaseCore;
use PIXELART\rest\Settings;
use PIXELART\view\ConfigPage;

\defined('ABSPATH') or die('No direct access allowed!'); // Avoid direct file request

/**
 * Singleton core class which handles the main system for plugin. It includes
 * registering of the autoload, all hooks (actions & filters) (see BaseCore class).
 */
class Core extends BaseCore {
	public $image_meta_url = '_pixelart_product_img_url';
	public $gallery_meta_url = '_pixelart_product_gallery_url';

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
     * Application core constructor.
     */
	protected function __construct() 
	{
		parent::__construct();
		$this->assets = Assets::instance();

		// Load no-namespace API functions
        foreach (['general'] as $apiInclude) {
            require_once PIXELART_INC . 'api/' . $apiInclude . '.php';
        }

		add_action('init', [$this, 'init'], 2);
	}

	/**
	 * The init function is fired even the init hook of WordPress. If possible
	 * it should register all hooks to have them in one place.
	 */
	public function init()
	{
		$this->configPage = ConfigPage::instance();

        \add_action('rest_api_init', [Settings::instance(), 'rest_api_init']);
		\add_action('admin_enqueue_scripts', [$this->getAssets(), 'admin_enqueue_scripts']);
		\add_action('admin_menu', [$this->getConfigPage(), 'admin_menu']);
		\add_filter('plugin_action_links_' . \plugin_basename(PIXELART_FILE), [$this->getConfigPage(), 'plugin_action_links'], 10, 2);
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
     * Get singleton core class.
     *
     * @return Core
     */
    public static function getInstance()
    {
        return !isset(self::$me) ? self::$me = new \PIXELART\Core() : self::$me;
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

}