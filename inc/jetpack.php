<?php
/**
 * Jetpack Compatibility File
 *
 * This file contains all functions for Jetpack compatibility as shipped with _s.
 *
 * @package Dyna
 * @subpackage Functions
 * @since 0.0.1
 * @version 0.0.8
 * @author Alf Drollinger - alf@dyna.press
 * @copyright 2018 Dyna - https://dyna.press
 * @license GNU GPL V2 - https://www.gnu.org/licenses/gpl
 *
 * @link https://jetpack.com/
 *
 */

namespace Dyna;

/**
 * Jetpack setup function.
 *
 * @link https://jetpack.com/support/infinite-scroll/
 * @link https://jetpack.com/support/responsive-videos/
 * @link https://jetpack.com/support/content-options/
 *
 * @since 0.0.1
 *
 */
function dyna_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'dyna_infinite_scroll_render',
		'footer'    => 'page',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'post-details'    => array(
			'stylesheet' => 'dyna-style',
			'date'       => '.posted-on',
			'categories' => '.cat-links',
			'tags'       => '.tags-links',
			'author'     => '.byline',
			'comment'    => '.comments-link',
		),
		'featured-images' => array(
			'archive'    => true,
			'post'       => true,
			'page'       => true,
		),
	) );
}
add_action( 'after_setup_theme', '\Dyna\dyna_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 *
 * @since 0.0.1
 *
 */
function dyna_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
}
