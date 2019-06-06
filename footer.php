<?php
/**
 * Footer Partial
 *
 * @package Dyna
 * @subpackage Dyna Starter Theme
 * @version 1.0.0
 * @author Alf Drollinger
 * @copyright 2018 https://dyna.press
 * @license GPL V2 https://www.gnu.org/licenses/gpl
 *
 * @link https://dyna.press/docs/template-partials/footer
 */

namespace Dyna;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly!
}
?>

<footer id="colophon" class="site-footer">
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
	<div class="site-info">
        Copyright <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?> <span class="sep"> | </span>

		<?php _e('Created with', 'dyna'); ?>

        <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'dyna' ) ); ?>">WordPress</a>

		<?php _e('and', 'dyna'); ?>

        <a href="<?php echo esc_url( __( 'https://dyna.press/', 'dyna' ) ); ?>">Dyna</a>

	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>