<?php
/**
 * Disable Emojis
 *
 * Disable the WP-style emojis that came with WordPress 2.4 as they are
 * a potential problem for GDPR and also not the best idea when it comes
 * to optimizing page speed.
 *
 * @package Dyna
 * @subpackage Functions
 * @since 0.0.8
 * @version 0.0.8
 * @author Alf Drollinger - alf@dyna.press
 * @copyright 2018 Dyna - https://dyna.press
 * @license GNU GPL V2 - https://www.gnu.org/licenses/gpl
 *
 * @link https://kinsta.com/knowledgebase/disable-emojis-wordpress/
 *
 */

namespace Dyna;

/**
 *
 * Function disable emojis
 *
 * @since 0.0.8
 *
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
 *
 * Function disable emojis tinymce
 *
 * @since 0.0.8
 *
 * @param array $plugins The plugins
 * @return array
 *
 */
function dyna_disable_emoji_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}