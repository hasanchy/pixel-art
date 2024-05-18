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

		\add_action('init', array($this, 'create_block_wp_plugin_framework_block_init'));
        \add_action('rest_api_init', [Settings::instance(), 'rest_api_init']);
		\add_action('admin_enqueue_scripts', [$this->getAssets(), 'admin_enqueue_scripts']);
		\add_action('admin_menu', [$this->getConfigPage(), 'admin_menu']);
		\add_filter('plugin_action_links_' . \plugin_basename(PIXELART_FILE), [$this->getConfigPage(), 'plugin_action_links'], 10, 2);
	}

	function create_block_wp_plugin_framework_block_init() {
		register_block_type( PIXELART_PATH . '/build', array(
			'render_callback' => array($this, 'theHTML')
		  ) );
	}

    function theHTML($attributes) {
		$pixelart_pixel_data = get_option( 'pixelart_pixel_data' );
        $pixel_data = ($pixelart_pixel_data) ? unserialize( $pixelart_pixel_data ) : [];
        $aspect_ratio = 320;
        $grid_size = $aspect_ratio /16;
        $rect = '';
        $x = 0;
        $y = 0;
        for($i=0; $i<count($pixel_data); $i++){

            
            $rect .= '<rect width="'.$grid_size.'" height="'.$grid_size.'" x="'.$x.'" y="'.$y.'" fill="'.$pixel_data[$i].'" />';
            
            if( ($i+1)%16 === 0 ){
                $x = 0;
                $y += $grid_size; 
            }else{
                $x += $grid_size; 
            }

        }
		$svg = '<svg width="'.$aspect_ratio.'" height="'.$aspect_ratio.'" xmlns="http://www.w3.org/2000/svg">
        '.$rect.'
            Sorry, your browser does not support inline SVG.  
        </svg>';
	
		return sprintf(
			'<div>%s</div>',
			$svg
		);
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