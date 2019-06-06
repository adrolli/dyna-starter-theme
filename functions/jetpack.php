<?php
/**
 * Jetpack Support
 *
 * @package Dyna
 * @subpackage Dyna Starter Theme
 * @version 1.0.0
 * @author Alf Drollinger
 * @copyright 2018 https://dyna.press
 * @license GPL V2 https://www.gnu.org/licenses/gpl
 *
 * @link https://dyna.press/docs/functions/jetpack-support
 */

Namespace Dyna;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly!
}

/**
 * Jetpack setup function
 * @since 1.0.0
 */
function dyna_jetpack_setup() {
	// Add theme support for Infinite Scroll
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'dyna_infinite_scroll_render',
		'footer'    => 'page',
	) );

	// Add theme support for Responsive Videos
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Content Options
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
 * Custom render function for Infinite Scroll
 * @since 1.0.0
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
