<?php
/**
 * Google Fonts
 *
 * @package Dyna
 * @subpackage Dyna Starter Theme
 * @version 1.0.0
 * @author Alf Drollinger
 * @copyright 2018 https://dyna.press
 * @license GPL V2 https://www.gnu.org/licenses/gpl
 *
 * @link https://dyna.press/docs/functions/google-fonts
 *
 */

Namespace Dyna;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly!
}

 /**
 * Register Google Fonts
 * @since 1.0.0
 */
function dyna_fonts_url() {
	$fonts_url = '';

	/*
	 *Translators: If there are characters in your language that are not
	 * supported by Nunito, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$nunito = esc_html_x( 'on', 'Nunito font: on or off', 'dyna' );

	if ( 'off' !== $nunito ) {
		$font_families = array();
		$font_families[] = 'Nunito:400,400italic,700,700italic';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;

}