<?php

namespace Pixelese\Beas\Admin;

class Menu {

    public function __construct() {

        add_action( 'admin_menu', [$this, 'plugin_menu_addition'] );

        add_action( 'admin_init', [$this, 'plugin_settings_register'] );

    }

    public function plugin_menu_addition(){

        $parent_menu_slug = 'pxls-beas-settings';

        add_menu_page( __('Before After Slider', 'before-after-slider-by-pixelese'), __('Before After Slider', 'before-after-slider-by-pixelese'), 'manage_options', $parent_menu_slug, [$this, 'plugin_menu_page'], 'dashicons-image-flip-horizontal', 20);

        add_submenu_page( $parent_menu_slug, __('Add New Slider', 'before-after-slider-by-pixelese'), __('Add New', 'before-after-slider-by-pixelese'), 'manage_options', 'post-new.php?post_type=pxls-beas');


        add_submenu_page( $parent_menu_slug, 'Slider Settings', 'Settings', 'manage_options', $parent_menu_slug, [$this, 'plugin_menu_settings_callback']);


    }

    public function plugin_menu_page(){

        /**
         * Place holder functiotn not need to do anything
         */

    }

    /**
     * Plugin Settings Page callback
     */

    public function plugin_menu_settings_callback(){

        ?>

        <div class="wrap">
            <h2>Before After Slider</h2>

            <form action="options.php" method="post">

                <?php 

                    settings_fields( 'pxls_beas_settings_group' );

                    //it require the pages slug where i need to show
                    do_settings_sections( 'pxls-beas-settings' ); 


                    submit_button('Save Settings');

                ?>

            </form>
        </div>

    <?php

    }


    /**
     * Register Settings
     */

    public function plugin_settings_register(){

        register_setting( 'pxls_beas_settings_group', 'pxls_beas_bf_bg_color', 'sanitize_text_field');

        register_setting( 'pxls_beas_settings_group', 'pxls_beas_bf_bg_color_opacity', 'floatval');

        add_settings_section( 'pxls_beas_settings_section_general', 'General Settings', '', 'pxls-bas-settings' );


        add_settings_field( 'pxls_beas_primary_color', 'Before After Tag Bg Color', [$this, 'pxls_beas_primary_color_callback'], 'pxls-beas-settings', 'pxls_beas_settings_section_general',);

        add_settings_field( 'pxls_beas_bf_bg_color_opacity', 'Before After Tag Bg Color Opacity', [$this, 'pxls_beas_primary_color_opacity_callback'], 'pxls-beas-settings', 'pxls_beas_settings_section_general',);


    }



    public function pxls_beas_primary_color_callback(){

        $get_bf_bg_color = get_option( 'pxls_beas_bf_bg_color');
       
       ?>

            <input type="color" name="pxls_beas_bf_bg_color" value="<?php echo esc_attr( $get_bf_bg_color ); ?>">

        <?php

    }


    //calback for opacity
    public function pxls_beas_primary_color_opacity_callback(){

        $get_bf_bg_color_opacity = get_option( 'pxls_beas_bf_bg_color_opacity');

       ?>

            <input type="number"  min="0" max="1" step="0.1" name="pxls_beas_bf_bg_color_opacity" value="<?php echo esc_attr($get_bf_bg_color_opacity); ?>" class="small-text">

        <?php

    }




}