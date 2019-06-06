<?php
/**
 * Theme Translation
 * 
 * @package Dyna
 * @subpackage Dyna Starter Theme
 * @version 1.0.0
 * @author Alf Drollinger
 * @copyright 2018 https://dyna.press
 * @license GPL V2 https://www.gnu.org/licenses/gpl
 * 
 * @link https://dyna.press/docs/functions/theme-setup/theme-translation
 */

Namespace Dyna;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly!
}

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly!
}

/**
* Load Theme Textdomain
* @since 1.0.0
*/
load_theme_textdomain( 'dyna', get_template_directory() . '/languages' );