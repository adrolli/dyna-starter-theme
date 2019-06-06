<?php
/**
 * Custom Logo
 *
 * @package Dyna
 * @subpackage Dyna Starter Theme
 * @version 1.0.0
 * @author Alf Drollinger
 * @copyright 2018 https://dyna.press
 * @license GPL V2 https://www.gnu.org/licenses/gpl
 *
 * @link https://dyna.press/docs/functions/theme-setup/custom-logo
 */

Namespace Dyna;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly!
}

/**
 * Add custom logo 
 * @since 1.0.0
 */
add_theme_support( 'custom-logo', array(
	'height'      => $dyna_logo_width,
	'width'       => $dyna_logo_height,
	'flex-width'  => true,
	'flex-height' => true,
) );