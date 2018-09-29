<?php
/**
 * WordPress.com-specific functions and definitions
 *
 * This file is centrally included from `wp-content/mu-plugins/wpcom-theme-compat.php`.
 * It is not necessary but shipped with _s and here for compliance.
 *
 * @package Dyna
 * @subpackage Functions
 * @since 0.0.1
 * @version 0.0.8
 * @author Alf Drollinger - alf@dyna.press
 * @copyright 2018 Dyna - https://dyna.press
 * @license GNU GPL V2 - https://www.gnu.org/licenses/gpl
 *
 * @link https://github.com/Automattic/_s/blob/master/inc/wpcom.php
 *
 */

namespace Dyna;

/**
 * Adds support for wp.com-specific theme functions.
 *
 * @since 0.0.5
 * @global array $themecolors
 */
function dyna_wpcom_setup() {
	global $themecolors;

	// Set theme colors for third party services.
	if ( ! isset( $themecolors ) ) {
		// Whitelist wpcom specific variable intended to be overruled.
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$themecolors = array(
			'bg'     => '',
			'border' => '',
			'text'   => '',
			'link'   => '',
			'url'    => '',
		);
	}
}
add_action( 'after_setup_theme', '\Dyna\dyna_wpcom_setup' );
