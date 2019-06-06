<?php
/**
 * Content width
 *
 * @package Dyna
 * @subpackage Dyna Starter Theme
 * @version 1.0.0
 * @author Alf Drollinger
 * @copyright 2018 https://dyna.press
 * @license GPL V2 https://www.gnu.org/licenses/gpl
 * 
 * @link https://dyna.press/docs/functions/content-width
 */

namespace Dyna;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly!
}

/**
 * Set the content width in pixels
 * @global int $content_width
 * @since 1.0.0
 */

function dyna_content_width() {
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'dyna_content_width', $dyna_content_width );
}
add_action( 'after_setup_theme', 'Dyna\dyna_content_width', 0 );