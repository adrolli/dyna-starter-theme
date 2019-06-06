<?php
/**
 * Gutenberg Colors
 *
 * @package Dyna
 * @subpackage Dyna Starter Theme
 * @version 1.0.0
 * @author Alf Drollinger
 * @copyright 2018 https://dyna.press
 * @license GPL V2 https://www.gnu.org/licenses/gpl
 *
 * @link https://dyna.press/docs/functions/theme-setup/gutenberg-colors
 */

Namespace Dyna;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly!
}

/**
 * Add support for custom color scheme
 * @since 1.0.0
 */
add_theme_support( 'editor-color-palette', array(
	array(
		'name'  => esc_html__( 'Strong Blue', 'dyna' ),
		'slug'  => 'strong-blue',
		'color' => '#0073aa',
	),
	array(
		'name'  => esc_html__( 'Lighter Blue', 'dyna' ),
		'slug'  => 'lighter-blue',
		'color' => '#229fd8',
	),
	array(
		'name'  => esc_html__( 'Very Light Gray', 'dyna' ),
		'slug'  => 'very-light-gray',
		'color' => '#eee',
	),
	array(
		'name'  => esc_html__( 'Very Dark Gray', 'dyna' ),
		'slug'  => 'very-dark-gray',
		'color' => '#444',
	),
) );