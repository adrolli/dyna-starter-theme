<?php
/**
 * Main template (index.php)
 *
 * @package Dyna
 * @subpackage Dyna Starter Theme
 * @version 1.0.0
 * @author Alf Drollinger
 * @copyright 2018 https://dyna.press
 * @license GPL V2 https://www.gnu.org/licenses/gpl
 *
 * @link https://dyna.press/docs/default-templates/main-template
 */

namespace Dyna;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly!
}

// use default header
get_header();
?>

	<main id="primary" class="site-main">

	<?php
	if ( have_posts() ) :

		if ( is_home() && ! is_front_page() ) : ?>
			<header>
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>

		<?php
		endif;

		while ( have_posts() ) : the_post();

			// Post-format-specific content partial
			get_template_part( 'partials/content', get_post_format() );

		endwhile;

		the_posts_navigation();

	else :

		// No content found partial
		get_template_part( 'partials/content', 'none' );

	endif; ?>

	</main><!-- #primary -->

<?php

// use default footer
get_footer();