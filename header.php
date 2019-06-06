<?php
/**
 * Header Partial
 *
* @package Dyna
 * @subpackage Dyna Starter Theme
 * @version 1.0.0
 * @author Alf Drollinger
 * @copyright 2018 https://dyna.press
 * @license GPL V2 https://www.gnu.org/licenses/gpl
 *
 * @link https://dyna.press/docs/template-partials/header
 */

namespace Dyna;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly!
}

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'dyna' ); ?></a>
		<header id="masthead" class="site-header">
			<div class="top-navigation">
			<?php
					wp_nav_menu( array(
						'theme_location' => 'page-menu',
						'menu_id'        => 'page-menu',
						'echo'           => true,
						'fallback_cb'    => 'link_to_menu_editor',
					) );
				?>
			</div><!-- .top-nav -->
			<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif;

				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php
				endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'dyna' ); ?></button>
				<?php
					wp_nav_menu( array(
						'theme_location' => 'main-menu',
						'menu_id'        => 'main-menu',
						'echo'           => true,
					) );
				?>
			</nav><!-- #site-navigation -->
		</header><!-- #masthead -->
