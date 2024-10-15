<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

class HTMegaMenu_Admin_Settings {

    private $settings_api;

    function __construct() {
        $this->settings_api = new HTMega_Settings_API();
        add_action( 'admin_init', [ $this, 'admin_init' ] );
    }

    // Admin Initialize
    function admin_init() {

        // //set the settings
        $this->settings_api->set_sections( $this->admin_get_settings_sections() );

        // //initialize settings
        $this->settings_api->admin_init();
    }

    // Options page Section register
    function admin_get_settings_sections() {
        $sections = array(

            array(
                'id'    => 'htmegamenu_setting_tabs',
                'title' => esc_html__( 'HT Menu Settings', 'htmega-addons' )
            ),

        );
        return $sections;
    }


    // Admin Menu Page Render
    function plugin_page() {

        echo '<div class="wrap">';
            echo '<h2>'.esc_html__( 'HT Menu Settings','htmega-addons' ).'</h2>';
            $this->save_message();
            $this->settings_api->show_navigation();
            $this->settings_api->show_forms();
        echo '</div>';

    }

    // Save Options Message
    function save_message() {
        if( isset($_GET['settings-updated']) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended ?>
            <div class="updated notice is-dismissible"> 
                <p><strong><?php esc_html_e('Successfully Settings Saved.', 'htmega-addons') ?></strong></p>
            </div>
            <?php
        }
    }
}

new HTMegaMenu_Admin_Settings();