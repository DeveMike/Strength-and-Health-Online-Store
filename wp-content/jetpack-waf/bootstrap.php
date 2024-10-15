<?php
define( 'DISABLE_JETPACK_WAF', false );
if ( defined( 'DISABLE_JETPACK_WAF' ) && DISABLE_JETPACK_WAF ) return;
define( 'JETPACK_WAF_MODE', 'normal' );
define( 'JETPACK_WAF_SHARE_DATA', '1' );
define( 'JETPACK_WAF_SHARE_DEBUG_DATA', false );
define( 'JETPACK_WAF_DIR', '/Applications/XAMPP/xamppfiles/htdocs/wordpress/wp-content/jetpack-waf' );
define( 'JETPACK_WAF_WPCONFIG', '/Applications/XAMPP/xamppfiles/htdocs/wordpress/wp-content/../wp-config.php' );
require_once '/Applications/XAMPP/xamppfiles/htdocs/wordpress/wp-content/plugins/jetpack/vendor/autoload.php';
Automattic\Jetpack\Waf\Waf_Runner::initialize();
