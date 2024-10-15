<?php
/**
 * Constructor Parameters
 *
 * @param string    $text_domain your plugin text domain.
 * @param string    $parent_menu_slug the menu slug name where the "Recommendations" submenu will appear.
 * @param string    $submenu_label To change the submenu name.
 * @param string    $submenu_page_name an unique page name for the submenu.
 * @param int       $priority Submenu priority adjust.
 * @param string    $hook_suffix use it to load this library assets only to the recommedded plugins page. Not into the whol admin area.
 *
 */

if( class_exists('Hasthemes\HTMega_Builder\HTRP_Recommended_Plugins') ){
    $recommendations = new Hasthemes\HTMega_Builder\HTRP_Recommended_Plugins(
        array( 
            'text_domain'       => 'htmega-addons',
            'parent_menu_slug'  => 'htmega-addons', 
            'menu_capability'   => 'manage_options', 
            'menu_page_slug'    => '',
            'priority'          => 300,
            'assets_url'        => '',
            'hook_suffix'       => 'htmega-addons_page_htmega-addons_extensions',
        )
    );

    $recommendations->add_new_tab(array(
        'title' => __( 'Recommended Plugins', 'htmega-addons' ),
        'active' => true,
        'plugins' => array(
            array(
                'slug'      => 'woolentor-addons',
                'location'  => 'woolentor_addons_elementor.php',
                'name'      => __( 'ShopLentor – WooCommerce Builder for Elementor & Gutenberg +10 Modules – All in One Solution (formerly WooLentor)
                ', 'htmega-addons' )
            ),
            array(
                'slug'      => 'hashbar-wp-notification-bar',
                'location'  => 'init.php',
                'name'      => __( 'Notification Bar for WordPress', 'htmega-addons' )
            ),
            array(
                'slug'      => 'insert-headers-and-footers-script',
                'location'  => 'init.php',
                'name'      => __( 'Insert Headers and Footers Code', 'htmega-addons' )
            )
            
        )
    ));

    $recommendations->add_new_tab(array(
        'title' => esc_html__( 'WooCommerce', 'htmega-addons' ),

        'plugins' => array(

            array(
                'slug'      => 'woolentor-addons',
                'location'  => 'woolentor_addons_elementor.php',
                'name'      => __( 'WooLentor – WooCommerce Elementor Addons + Builder', 'htmega-addons' )
            ),
            array(
                'slug'      => 'wishsuite',
                'location'  => 'wishsuite.php',
                'name'      => __( 'WishSuite', 'htmega-addons' )
            ),
            array(
                'slug'      => 'ever-compare',
                'location'  => 'ever-compare.php',
                'name'      => __( 'EverCompare', 'htmega-addons' )
            ),
            array(
                'slug'      => 'quickswish',
                'location'  => 'quickswish.php',
                'name'      => __( 'QuickSwish', 'htmega-addons' )
            ),
            array(
                'slug'      => 'just-tables',
                'location'  => 'just-tables.php',
                'name'      => __( 'JustTables', 'htmega-addons' )
            ),
            array(
                'slug'      => 'whols',
                'location'  => 'whols.php',
                'name'      => __( 'Whols', 'htmega-addons' )
            ),

        )

    ));

    $recommendations->add_new_tab(array(
        'title' => esc_html__( 'Other Plugins', 'htmega-addons' ),
        'plugins' => array(
            array(
                'slug'      => 'wp-plugin-manager',
                'location'  => 'plugin-main.php',
                'name'      => __( 'WP Plugin Manager', 'htmega-addons' )
            ),
            array(
                'slug'      => 'ht-easy-google-analytics',
                'location'  => 'ht-easy-google-analytics.php',
                'name'      => __( 'HT Easy GA4 ( Google Analytics 4 )', 'htmega-addons' )
            ),
            array(
                'slug'      => 'ht-contactform',
                'location'  => 'contact-form-widget-elementor.php',
                'name'      => __( 'HT Contact Form 7', 'htmega-addons' )
            ),
            array(
                'slug'      => 'ht-wpform',
                'location'  => 'wpform-widget-elementor.php',
                'name'      => __( 'HT WPForms', 'htmega-addons' )
            ),
            array(
                'slug'      => 'docus',
                'location'  => 'docus.php',
                'name'      => __( 'Docus', 'htmega-addons' )
            ),
            array(
                'slug'      => 'data-captia',
                'location'  => 'data-captia.php',
                'name'      => __( 'DataCaptia', 'htmega-addons' )
            )

        )
    ));
}
