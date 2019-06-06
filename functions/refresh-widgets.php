<?php
/**
 * Refresh Widgets
 *
 * @package Dyna
 * @subpackage Dyna Starter Theme
 * @version 1.0.0
 * @author Alf Drollinger
 * @copyright 2018 https://dyna.press
 * @license GPL V2 https://www.gnu.org/licenses/gpl
 * 
 * @link https://dyna.press/docs/functions/theme-setup/refresh-widgets
 */

Namespace Dyna;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly!
}

/**
 * Add Refresh Widgets Support
 * @since 1.0.0
 */
add_theme_support( 'customize-selective-refresh-widgets' );