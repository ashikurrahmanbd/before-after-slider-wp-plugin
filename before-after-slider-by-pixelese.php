<?php
/**
 * Plugin Name: Before After Slider by Pixelese
 * Plugin URI: https://wordpress.org/plugins/before-after-slider-by-pixelese
 * Author: Ashikur Rahman
 * Author URI: https://ashikurrahmanbd.github.io/
 * Description: Professional Before After Comperison Slider
 * Tags: Slider, Before after slider, comperison slider
 * Version: 1.0.0
 * Requires PHP: 7.0
 * Requires at least: 5.0
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: before-after-slider-by-pixelese
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
final class PXLS_BEAS_Before_After_Slider{


    const version = '1.0.0';

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

        define( 'PXLS_BEAS_VERSION', self::version );

        define( 'PXLS_BEAS_PATH', plugin_dir_path( __FILE__ ) );

        define( 'PXLS_BEAS_URL', plugin_dir_url( __FILE__ ) );

        define( 'PXLS_BEAS_ASSETS', PXLS_BEAS_URL . '/assets' );

    }


    /**
     * Summary of activate
     * 
     * Things need to do upon plugin activation
     * 
     * @return void
     */
    public function activate(){

        $installed = get_option( 'pxls_beas_installed' );

        if ( ! $installed ) {

            update_option( 'pxls_beas_installed', time() );

        }

        update_option( 'pxls_beas_installed_version', PXLS_BEAS_VERSION );

    }


    /**
     * Load all the files and clases
     * 
     * @return void
     */
    public function load_dependencies() {

       if ( is_admin(  ) ) {

            new Pixelese\Beas\Admin();

       } else {

            new Pixelese\Beas\Frontend();

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
function pxls_BEAS_before_after_slider(){

    return PXLS_BEAS_Before_After_Slider::get_instance();

}


/**
 * Run the Plugin
*/
pxls_beas_before_after_slider();


function pxls_flush_rewrite_rules() {
    flush_rewrite_rules();
}
add_action('init', 'pxls_flush_rewrite_rules');