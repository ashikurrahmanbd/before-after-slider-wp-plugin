<?php

namespace Pixelese\Bas\Admin;

class Menu {

    public function __construct() {

        add_action( 'admin_menu', [$this, 'plugin_menu_addition'] );

        add_action( 'admin_init', [$this, 'plugin_settings_register'] );

    }

    public function plugin_menu_addition(){

        $parent_menu_slug = 'pxls-bas-settings';

        add_menu_page( __('Before After Slider', 'pixelese-before-after-slider'), __('Before After Slider', 'pixelese-before-after-slider'), 'manage_options', $parent_menu_slug, [$this, 'plugin_menu_page'], 'dashicons-image-flip-horizontal' );


    }

    public function plugin_menu_page(){

        ?>

            <div class="wrap">
                <h2>Before After Slider</h2>

                <form action="options.php" method="post">

                    <?php 

                        settings_fields( 'pxls_bas_settings_group' );

                        //it require the pages slug where i need to show
                        do_settings_sections( 'pxls-bas-settings' ); 


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

        register_setting( 'pxls_bas_settings_group', 'pxls_bas_primary_color' );

        add_settings_section( 'pxls_bas_settings_section_general', 'General Settings', '', 'pxls-bas-settings' );


        add_settings_field( 'pxls_bas_primary_color', 'Primary Color', [$this, 'pxls_bas_primary_color_callback'], 'pxls-bas-settings', 'pxls_bas_settings_section_general',);



    }



    public function pxls_bas_primary_color_callback(){

        $get_color = get_option( 'pxls_bas_primary_color');
       
       ?>

            <input type="color" name="pxls_bas_primary_color" value="<?php echo $get_color; ?>">

        <?php

    }




}