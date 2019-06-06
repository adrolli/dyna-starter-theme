<?php
/**
 * Widget Areas
 *
 * @package Dyna
 * @subpackage Dyna Starter Theme
 * @version 1.0.0
 * @author Alf Drollinger
 * @copyright 2018 https://dyna.press
 * @license GPL V2 https://www.gnu.org/licenses/gpl
 * 
 * @link https://dyna.press/docs/functions/register-widget-areas/
 */

Namespace Dyna;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly!
}

/**
 * Register Header-Widgets
 * @since 1.0.0
 */

// TODO: add widget and change class no-sideba in template-functions.php!

/**
 * Register Sidebar-1
 * @since 1.0.0
 */
function dyna_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'dyna' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'dyna' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'Dyna\dyna_widgets_init' );

/**
 * Register Sidebar-2
 * @since 1.0.0
 */

// TODO: add widget and change class no-sideba in template-functions.php!

/**
 * Register Footer-Widgets
 * @since 1.0.0
 */

// TODO: add widget and change class no-sideba in template-functions.php!