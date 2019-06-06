<?php
/**
 * Template Functions
 * 
 * @package Dyna
 * @subpackage Dyna Starter Theme
 * @version 1.0.0
 * @author Alf Drollinger
 * @copyright 2018 https://dyna.press
 * @license GPL V2 https://www.gnu.org/licenses/gpl
 *
 * @link https://dyna.press/docs/functions/template-functions
 */

Namespace Dyna;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly!
}

/**
 * Add custom classes to the array of body classes
 * @param array $classes Classes for the body element.
 * @return array
 * @since 1.0.0
 */
function dyna_body_classes( $classes ) {
	// Add a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', '\Dyna\dyna_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 * @since 1.0.0
 */
function dyna_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', '\Dyna\dyna_pingback_header' );