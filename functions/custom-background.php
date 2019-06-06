<?php
/**
 * Background Image
 *
 * @package Dyna
 * @subpackage Dyna Starter Theme
 * @version 1.0.0
 * @author Alf Drollinger
 * @copyright 2018 https://dyna.press
 * @license GPL V2 https://www.gnu.org/licenses/gpl
 * 
 * @link https://dyna.press/docs/functions/theme-setup/custom-background
 */

namespace Dyna;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly!
}

/**
 * Add Custom Background Feature
 * @since 1.0.0
 */
add_theme_support( 'custom-background', apply_filters( 'Dyna\dyna_custom_background_args', array(
	'default-color' => $dyna_background_color,
	'default-image' => $dyna_background_image,
) ) );