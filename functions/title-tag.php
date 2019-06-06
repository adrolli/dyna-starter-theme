<?php
/**
 * Title Tag
 *  
 * @package Dyna
 * @subpackage Dyna Starter Theme
 * @version 1.0.0
 * @author Alf Drollinger
 * @copyright 2018 https://dyna.press
 * @license GPL V2 https://www.gnu.org/licenses/gpl
 * 
 * @link https://dyna.press/docs/functions/theme-setup/title-tag
 */

Namespace Dyna;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly!
}

/**
* Add Title Tag
* @since 1.0.0
*/
add_theme_support( 'title-tag' );