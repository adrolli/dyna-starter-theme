<?php
/**
 * WooCommerce Support
 *
 * @package Dyna
 * @subpackage Dyna Starter Theme
 * @version 1.0.0
 * @author Alf Drollinger
 * @copyright 2018 https://dyna.press
 * @license GPL V2 https://www.gnu.org/licenses/gpl
 *
 * @link https://dyna.press/docs/functions/woocommerce-support
 */

Namespace Dyna;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly!
}

/**
 * WooCommerce setup function
 * @return void
 * @since 1.0.0
 */
function dyna_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', '\Dyna\dyna_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets
 * @return void
 * @since 1.0.0
 */
function dyna_woocommerce_scripts() {
	wp_enqueue_style( 'dyna-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'dyna-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', '\Dyna\dyna_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet
 * @since 1.0.0
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag
 * @param  array $classes CSS classes applied to the body tag
 * @return array $classes modified to include 'woocommerce-active' class
 * @since 1.0.0
 */
function dyna_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', '\Dyna\dyna_woocommerce_active_body_class' );

/**
 * Products per page
 * @return integer number of products
 * @since 1.0.0
 */
function dyna_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', '\Dyna\dyna_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns
 * @return integer number of columns
 * @since 1.0.0
 */
function dyna_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', '\Dyna\dyna_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives
 * @return integer products per row
 * @since 1.0.0
 */
function dyna_woocommerce_loop_columns() {
	return 3;
}
add_filter( 'loop_shop_columns', '\Dyna\dyna_woocommerce_loop_columns' );

/**
 * Related Products Args
 * @param array $args related products args
 * @return array $args related products args
 * @since 1.0.0
 */
function dyna_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', '\Dyna\dyna_woocommerce_related_products_args' );

if ( ! function_exists( 'dyna_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper
	 * @return  void
	 * @since 1.0.0
	 */
	function dyna_woocommerce_product_columns_wrapper() {
		$columns = dyna_woocommerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', '\Dyna\dyna_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'dyna_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close
	 * @return  void
	 * @since 1.0.0
	 */
	function dyna_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', '\Dyna\dyna_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper
 * @since 1.0.0
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'dyna_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content
	 * @return void
	 * @since 1.0.0
     */
	function dyna_woocommerce_wrapper_before() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php
	}
}
add_action( 'woocommerce_before_main_content', '\Dyna\dyna_woocommerce_wrapper_before' );

if ( ! function_exists( 'dyna_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content
	 * @return void
	 * @since 1.0.0
	 */
	function dyna_woocommerce_wrapper_after() {
			?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', '\Dyna\dyna_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart
 * @since 1.0.0
 */
if ( ! function_exists( 'dyna_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments Update via Ajax
	 * @param array $fragments Fragments to refresh via AJAX
	 * @return array Fragments to refresh via AJAX
	 * @since 1.0.0
	 */
	function dyna_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		dyna_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', '\Dyna\dyna_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'dyna_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link incl. number of items
	 * @return void
	 * @since 1.0.0
	 */
	function dyna_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'dyna' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'dyna' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'dyna_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart
	 * @return void
	 * @since 1.0.0
	 */
	function dyna_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php dyna_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}