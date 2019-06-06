<?php
/**
 * Dyna Functions.
 * 
 * This file functions.php is an obligatory WordPress Theme file.
 * It is used to write functions or (like we prefer) to include
 * other functions from the /functions-directory.
 *
 * @package Dyna
 * @subpackage Dyna Starter Theme
 * @version 1.0.0
 * @author Alf Drollinger
 * @copyright 2018 https://dyna.press
 * @license GPL V2 https://www.gnu.org/licenses/gpl
 *
 * @link https://dyna.press/docs/functions
 */

Namespace Dyna;

/**
 * Exit if accessed directly!
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load Global Variables
require get_template_directory() . '/theme-settings.php';

if ( ! function_exists( 'dyna_setup' ) ) :
        /**
         * Dyna Setup
         *
         * @since 1.0.0
         * @link https://dyna.press/docs/functions/theme-setup
         */
	function dyna_setup() {

                // Load Theme Translation
                require get_template_directory() . '/functions/theme-translation.php';

                // Load Automatic Feed Links
                require get_template_directory() . '/functions/automatic-feed-links.php';

                // Load Title Tag Management
                require get_template_directory() . '/functions/title-tag.php';

                // Load Featured Image
                require get_template_directory() . '/functions/featured-image.php';

                // Load Navigation Menu
                require get_template_directory() . '/functions/navigation-menus.php';

                // Load HTML5 Support
                require get_template_directory() . '/functions/html5-support.php';

                // Load Background Support
                require get_template_directory() . '/functions/custom-background.php';

                // Load Refresh Widgets
                require get_template_directory() . '/functions/refresh-widgets.php';

                // Load Custom Logo
                require get_template_directory() . '/functions/custom-logo.php';

                // Load Gutenberg Features
                require get_template_directory() . '/functions/gutenberg-features.php';

                // Load Gutenberg Colors
                require get_template_directory() . '/functions/gutenberg-colors.php';

	}
endif;
add_action( 'after_setup_theme', 'Dyna\dyna_setup' );

// Load Content Width
require get_template_directory() . '/functions/content-width.php';

// Load Google Fonts
//require get_template_directory() . '/functions/google-fonts.php';

// Load Widget Area
require get_template_directory() . '/functions/widget-areas.php';

// Load Styles and Scripts
require get_template_directory() . '/functions/styles-and-scripts.php';

// Load Custom Header
require get_template_directory() . '/functions/custom-header.php';

// Load Template Tags
require get_template_directory() . '/functions/template-tags.php';

// Load Template Functions
require get_template_directory() . '/functions/template-functions.php';

//Load Customizer additions
require get_template_directory() . '/functions/customizer.php';

// Load Jetpack compatibility
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/functions/jetpack.php';
}

// Load WooCommerce compatibility
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/functions/woocommerce.php';
}

// Load Disable Emojis
require get_template_directory() . '/functions/disable-emojis.php';

// Hide Archive Prefix
require get_template_directory() . '/functions/hide-archive-prefix.php';

// Load Gutenberg Blocks
// TODO: require get_template_directory() . '/functions/gutenberg-blocks.php';

// Load Header Settings
// TODO: require get_template_directory() . '/functions/header-settings.php';

// Load Footer Settings
// TODO: require get_template_directory() . '/functions/footer-settings.php';

// Load Page Template
// TODO: require get_template_directory() . '/functions/page-template.php';

// Activate Editor Functions
// TODO: 
require get_template_directory() . '/functions/editor-functions.php';
// Does not work yet, improve, see links inside

// Load Dyna Customizer
// TODO: require get_template_directory() . '/functions/dyna-customizer.php';