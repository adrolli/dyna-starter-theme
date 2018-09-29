<?php
/**
 * Dyna Template Functions
 *
 * Functions which enhance the theme by hooking into WordPress.
 *
 * @package Dyna
 * @subpackage Functions
 * @since 0.0.1
 * @version 0.0.8
 * @author Alf Drollinger - alf@dyna.press
 * @copyright 2018 Dyna - https://dyna.press
 * @license GNU GPL V2 - https://www.gnu.org/licenses/gpl
 *
 * @link https://codex.wordpress.org/Theme_Customization_API
 *
 */

namespace Dyna;

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 *
 * @since 0.0.1
 *
 */
function dyna_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'dyna_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 *
 * @since 0.0.1
 *
 */
function dyna_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', '\Dyna\dyna_pingback_header' );