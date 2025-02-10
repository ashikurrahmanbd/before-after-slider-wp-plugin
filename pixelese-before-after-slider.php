<?php
/**
 * Plugin Name: Before After Slider by Pixelese
 * Plugin URI: https://wordpress.org/plugins/pixelese-before-after-slider
 * Author: Ashikur Rahman
 * Author URI: https://ashikurrahmanbd.github.io/
 * Description: Professional Before After Comperison Slider
 * Tags: Slider, Before after slider, comperison slider
 * Version: 1.0.0
 * Requires PHP: 7.0
 * Requires at least: 5.0
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: pixelese-before-after-slider.php
*/

if ( ! defined('ABSPATH') ) {

    exit;

}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Summary of Pixelese_Before_After_Slider
 * 
 * The Main Plugin Class
 * 
 * 
 * 
 */
final class Pixelese_Before_After_Slider{


    const version = '1.0';

    /**
     * Summary of __construct
     * 
     * class Constructor
     */
    private function __construct(){

        //define all the necessary constants
        $this->define_constants();

        //do whatever we need upon plugin activation
        register_activation_hook( __FILE__, [$this, 'activate'] );


        //load dependences of files
        add_action( 'plugins_loaded', [$this, 'load_dependencies'] );

        

    }


    /**
     * Summary of get_instance
     * 
     * Initalizes a singleton instance
     * 
     * @return \Pixelese_Before_After_Slider
     * 
     * \for root namespace
     */
    public static function get_instance(){

        static $instance = null;

        if ( !$instance ) {

            $instance = new self();

        }

        return $instance;

    }


    /**
     * Define all the constants
     * 
     * @return void
     */
    public function define_constants() {

        define( 'PXLS_BAS_VERSION', self::version );

        define( 'PXLS_BAS_FILE', __FILE__ );

        define( 'PXLS_BAS_PATH', __DIR__ );

        define( 'PXLS_BAS_URL', plugins_url( '', PXLS_BAS_FILE ) );

        define( 'PXLS_BAS_ASSETS', PXLS_BAS_URL . '/assets' );

    }


    /**
     * Summary of activate
     * 
     * Things need to do upon plugin activation
     * 
     * @return void
     */
    public function activate(){

        $installed = get_option( 'pxls_bas_installed' );

        if ( ! $installed ) {

            update_option( 'pxls_bas_installed', time() );

        }

        update_option( 'pxls_bas_installed_version', PXLS_BAS_VERSION );

    }


    /**
     * Load all the files and clases
     * 
     * @return void
     */
    public function load_dependencies() {

       if ( is_admin(  ) ) {

            new Pixelese\Bas\Admin();

       } else {

            new Pixelese\Bas\Frontend();

       }

    }




}


/**
 * Summary of pixelese_before_after_slider
 * 
 * Initialization of the main plugin
 * 
 * @return \Pixelese_Before_After_Slider
 */
function pixelese_before_after_slider(){

    return Pixelese_Before_After_Slider::get_instance();

}


/**
 * Run the Plugin
*/
pixelese_before_after_slider();

