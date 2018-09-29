<?php
/**
 * Dyna Theme Customizer
 **
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
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @since 0.0.5
 *
 */
function dyna_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'dyna_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'dyna_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', '\Dyna\dyna_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 * @since 0.0.5
 *
 */
function dyna_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 * @since 0.0.5
 *
 */
function dyna_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 * @since 0.0.5
 *
 */
function dyna_customize_preview_js() {
	wp_enqueue_script( 'dyna-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', '\Dyna\dyna_customize_preview_js' );
