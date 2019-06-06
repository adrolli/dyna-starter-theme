<?php
/**
 * Navigation Menus
 *
 * @package Dyna
 * @subpackage Dyna Starter Theme
 * @version 1.0.0
 * @author Alf Drollinger
 * @copyright 2018 https://dyna.press
 * @license GPL V2 https://www.gnu.org/licenses/gpl
 *
 * @link https://dyna.press/docs/functions/theme-setup/navigation-menus
 */

Namespace Dyna;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly!
}

/**
 * Register Navigation Menus
 * @since 1.0.0
 */
register_nav_menus( array(
	'main-menu' => esc_html__( 'Main Menu', 'dyna' ),
	'page-menu' => esc_html__( 'Page Menu', 'dyna' ),
	'scroll-nav' => esc_html__( 'Scroll Navigation', 'dyna' ),
	'user-nav' =>  esc_html__( 'User Navigation', 'dyna' ),
	'visitor-nav' =>  esc_html__( 'Visitor Navigation', 'dyna' ),
	'languages' => esc_html__( 'Language Selector', 'dyna' ),
	'meta-nav' => esc_html__( 'Meta Navigation' , 'dyna' ),
	'social-nav' => esc_html__( 'Social Navigation' , 'dyna' ),
	'footer-links' => esc_html__( 'Footer Links' , 'dyna' ),
	'footer-nav1' => esc_html__( 'Footer Part1' , 'dyna' ),
	'footer-nav2' => esc_html__( 'Footer Part2' , 'dyna' ),
	'footer-nav3' => esc_html__( 'Footer Part3' , 'dyna' ),
	'footer-nav4' => esc_html__( 'Footer Part4' , 'dyna' ),
) );