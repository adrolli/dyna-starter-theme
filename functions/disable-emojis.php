<?php
/**
 * Disable Emojis
 *
 * @package Dyna
 * @subpackage Dyna Starter Theme
 * @version 1.0.0
 * @author Alf Drollinger
 * @copyright 2018 https://dyna.press
 * @license GPL V2 https://www.gnu.org/licenses/gpl
 *
 * @link https://dyna.press/docs/functions/disable-emojis
 */

Namespace Dyna;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly!
}

/**
 * Function disable emojis
 * @since 1.0.0
 */
function dyna_disable_wp_emoji() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', '\Dyna\dyna_disable_emoji_tinymce' );
  
  // filter to remove DNS prefetch
  add_filter( 'emoji_svg_url', '__return_false' );
}
add_action( 'init', '\Dyna\dyna_disable_wp_emoji' );

/**
 * Function disable emojis tinymce
 * @since 1.0.0
 * @param array $plugins The plugins
 * @return array
 */
function dyna_disable_emoji_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}