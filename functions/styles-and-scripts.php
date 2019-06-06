<?php
/**
 * Enqueue scripts and styles.
 *
 * @package Dyna
 * @subpackage Dyna Starter Theme
 * @version 1.0.0
 * @author Alf Drollinger
 * @copyright 2018 https://dyna.press
 * @license GPL V2 https://www.gnu.org/licenses/gpl
 * 
 * @link https://dyna.press/docs/functions/enqueue-styles-and-scripts
 */

Namespace Dyna;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly!
}

/**
 * Function dyna_scripts
 * @since 1.0.0
 */
function dyna_scripts() {

	wp_enqueue_style( 'dyna-styles', get_stylesheet_uri() );
	// wp_enqueue_style( 'theme-fonts', dyna_fonts_url() );
	wp_enqueue_script( 'dyna-scripts', get_template_directory_uri() . '/js/navigation.js', array(), '20180720', true );
	wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20180720', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'Dyna\dyna_scripts', 10 );