<?php
namespace HTMegaOpt\Admin;

class Menu {

    /**
     * [init]
     */
    public function init() {
        add_action( 'admin_menu', [ $this, 'admin_menu' ], 220 );
    }

    /**
     * Register Menu
     *
     * @return void
     */
    public function admin_menu(){
        global $submenu;

        $slug        = 'htmega-addons';
        $capability  = 'manage_options';

        $hook = add_menu_page(
            esc_html__( 'HTMega Addons', 'htmega-addons' ),
            esc_html__( 'HTMega Addons', 'htmega-addons' ),
            $capability,
            $slug,
            [ $this, 'plugin_page' ],
            HTMEGA_ADDONS_PL_URL.'admin/assets/images/menu-icon.svg',
            59
        );

        if ( current_user_can( $capability ) ) {
            $submenu[ $slug ][] = array( esc_html__( 'Settings', 'htmega-addons' ), $capability, 'admin.php?page=' . $slug . '#/general' );
        }

        add_action( 'load-' . $hook, [ $this, 'init_hooks'] );

    }

    /**
     * Initialize our hooks for the admin page
     *
     * @return void
     */
    public function init_hooks() {
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
    }

    /**
     * Load scripts and styles for the app
     *
     * @return void
     */
    public function enqueue_scripts() {
        wp_enqueue_style('htmegaopt-sweetalert2');
        wp_enqueue_style( 'htmegaopt-admin' );
        wp_enqueue_style( 'htmegaopt-style' );
        wp_enqueue_script( 'htmegaopt-admin' );

        $option_localize_script = [
            'adminUrl'      => admin_url( '/' ),
            'ajaxUrl'       => admin_url( 'admin-ajax.php' ),
            'rootApiUrl'    => esc_url_raw( rest_url() ),
            'restNonce'     => wp_create_nonce( 'wp_rest' ),
            'verifynonce'   => wp_create_nonce( 'htmegaopt_verifynonce' ),
            'tabs'          => Options_Field::instance()->get_settings_tabs(),
            'sections'      => Options_Field::instance()->get_settings_subtabs(),
            'settings'      => Options_Field::instance()->get_registered_settings(),
            'options'       => htmegaopt_get_options( Options_Field::instance()->get_registered_settings() ),
            'labels'        => [
                'pro' => __( 'Pro', 'htmega-addons' ),
                'modal' => [
                    'title' => __( 'BUY PRO', 'htmega-addons' ),
                    'buynow' => __( 'Buy Now', 'htmega-addons' ),
                    'desc' => __( 'Our free version is great, but it doesn\'t have all our advanced features. The best way to unlock all of the features in our plugin is by purchasing the pro version.', 'htmega-addons' )
                ],
                'saveButton' => [
                    'text'   => __( 'Save Settings', 'htmega-addons' ),
                    'saving' => __( 'Saving...', 'htmega-addons' ),
                    'saved'  => __( 'Data Saved', 'htmega-addons' ),
                ],
                'enableAllButton' => [
                    'enable'   => __( 'Enable All', 'htmega-addons' ),
                    'disable'  => __( 'Disable All', 'htmega-addons' ),
                ],
                'resetButton' => [
                    'text'   => __( 'Reset All Settings', 'htmega-addons' ),
                    'reseting'  => __( 'Resetting...', 'htmega-addons' ),
                    'reseted'  => __( 'All Data Restored', 'htmega-addons' ),
                    'alert' => [
                        'one'=>[
                            'title' => __( 'Are you sure?', 'htmega-addons' ),
                            'text' => __( 'It will reset all the settings to default, and all the changes you made will be deleted.', 'htmega-addons' ),
                            'confirm' => __( 'Yes', 'htmega-addons' ),
                            'cancel' => __( 'No', 'htmega-addons' ),
                        ],
                        'two'=>[
                            'title' => __( 'Reset!', 'htmega-addons' ),
                            'text' => __( 'All settings has been reset successfully.', 'htmega-addons' ),
                            'confirm' => __( 'OK', 'htmega-addons' ),
                        ]
                    ],
                ]
            ]
        ];

        // update existing data to new Menu builder module settings default option
        $updated_megamenu_options = [
            "megamenubuilder" =>  wp_json_encode([
                "megamenubuilder_enable"   => htmega_get_option('megamenubuilder', 'htmega_advance_element_tabs'),
                "menu_items_color"           => htmega_get_option('menu_items_color', 'htmegamenu_setting_tabs'),
                "menu_items_hover_color"     => htmega_get_option('menu_items_hover_color', 'htmegamenu_setting_tabs'),
                "sub_menu_width"             => htmega_get_option('sub_menu_width', 'htmegamenu_setting_tabs',200),
                "sub_menu_bg_color"          => htmega_get_option('sub_menu_bg_color', 'htmegamenu_setting_tabs'),
                "sub_menu_items_color"       => htmega_get_option('sub_menu_items_color', 'htmegamenu_setting_tabs'),
                "sub_menu_items_hover_color" => htmega_get_option('sub_menu_items_hover_color', 'htmegamenu_setting_tabs'),
                "mega_menu_width"            => htmega_get_option('mega_menu_width', 'htmegamenu_setting_tabs'),
                "mega_menu_bg_color"         => htmega_get_option('mega_menu_bg_color', 'htmegamenu_setting_tabs'),
            ]),
        ];
        // megamenu modules defautl option's value update
        if ( empty( htmega_get_module_option( 'htmega_megamenu_module_settings' ) ) ) {
            update_option( 'htmega_megamenu_module_settings' , $updated_megamenu_options );
            update_option( 'htmegamenu_setting_tabs' , '' );
        }

        // update existing data to new theme builder module settings default option
        $updated_theme_builder_options = [
            "themebuilder" =>  wp_json_encode([
                "themebuilder_enable" => htmega_get_option('themebuilder', 'htmega_advance_element_tabs'),
                "single_blog_page"    => htmega_get_option('single_blog_page', 'htmegabuilder_templatebuilder_tabs','0'),
                "archive_blog_page"   => htmega_get_option('archive_blog_page', 'htmegabuilder_templatebuilder_tabs','0'),
                "header_page"         => htmega_get_option('header_page', 'htmegabuilder_templatebuilder_tabs','0'),
                "footer_page"         => htmega_get_option('footer_page', 'htmegabuilder_templatebuilder_tabs','0'),
                "search_page"         => htmega_get_option('search_page', 'htmegabuilder_templatebuilder_tabs','0'),
                "error_page"          => htmega_get_option('error_page', 'htmegabuilder_templatebuilder_tabs','0'),
                "coming_soon_page"    => htmega_get_option('coming_soon_page', 'htmegabuilder_templatebuilder_tabs','0'),
                "search_pagep"        => '0',
                "error_pagep"         => '0',
                "coming_soon_pagep"   => '0',
            ]),
        ];
        // megamenu modules defautl option's value update
        if ( empty( htmega_get_module_option( 'htmega_themebuilder_module_settings' ) ) ) {
            update_option( 'htmega_themebuilder_module_settings' , $updated_theme_builder_options );
            update_option( 'htmegabuilder_templatebuilder_tabs' , '' );
        }
        wp_localize_script( 'htmegaopt-admin', 'htmegaOptions', $option_localize_script );
    }

    /**
     * Render our admin page
     *
     * @return void
     */
    public function plugin_page() {
        ob_start();
		include_once HTMEGAOPT_INCLUDES .'/templates/settings-page.php';
		echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

}
