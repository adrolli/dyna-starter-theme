<?php
/**
 * Plugin Name: Dyna Builder
 * Description: Generates themes based on Dyna.
 */
 
 // todo _s and use gitignore?

class Dyna_Builder_Plugin {

	protected $theme;

	/**
	 * Fired when file is loaded.
	 */
	function __construct() {
		// All the black magic is happening in these actions.
		add_action( 'init', array( $this, 'init' ) );
		add_filter( 'dynabuild_generator_file_contents', array( $this, 'do_replacements' ), 10, 2 );

		// Use do_action( 'dynabuild_print_form' ); in your theme to render the form.
		add_action( 'dynabuild_print_form', array( $this, 'dynabuild_print_form' ) );
	}

	/**
	 * Renders the generator form
	 */
	function dynabuild_print_form() {
		?>
		<div id="generator-form" class="generator-form-skinny">
			<form method="POST">
				<input type="hidden" name="dynabuild_generate" value="1" />

				<?php if ( isset( $_REQUEST['can_i_haz_wpcom'] ) ) : ?>
					<input type="hidden" name="can_i_haz_wpcom" value="1" />
				<?php endif; ?>

				<section class="generator-form-inputs">
					<section class="generator-form-primary">
						<label for="dynabuild-name">Theme Name</label>
						<input type="text" id="dynabuild-name" name="dynabuild_name" placeholder="Theme Name" />
					</section><!-- .generator-form-primary -->

					<section class="generator-form-secondary">
						<label for="dynabuild-slug">Theme Slug</label>
						<input type="text" id="dynabuild-slug" name="dynabuild_slug" placeholder="Theme Slug" />

						<label for="dynabuild-author">Author</label>
						<input type="text" id="dynabuild-author" name="dynabuild_author" placeholder="Author" />

						<label for="dynabuild-author-uri">Author URI</label>
						<input type="text" id="dynabuild-author-uri" name="dynabuild_author_uri" placeholder="Author URI" />

						<label for="dynabuild-description">Description</label>
						<input type="text" id="dynabuild-description" name="dynabuild_description" placeholder="Description" />

						<input type="checkbox" id="dynabuild-woocommerce" name="dynabuild_woocommerce" value="1">
						<label for="dynabuild-woocommerce">WooCommerce boilerplate</label>

						<input type="checkbox" id="dynabuild-sass" name="dynabuild_sass" value="1">
						<label for="dynabuild-sass">_sassify!</label>
					</section><!-- .generator-form-secondary -->
				</section><!-- .generator-form-inputs -->

				<div class="generator-form-submit">
					<input type="submit" name="dynabuild_generate_submit" value="Generate" />
					<span class="generator-form-version">Based on <a href="http://github.com/dyna-press/dyna">Dyna from Github</a></span>
				</div><!-- .generator-form-submit -->
			</form>
		</div><!-- .generator-form -->
		<?php
	}

	/**
	 * Creates zip files and does a bunch of other stuff.
	 */
	function init() {
		if ( ! isset( $_REQUEST['dynabuild_generate'], $_REQUEST['dynabuild_name'] ) )
			return;

		if ( empty( $_REQUEST['dynabuild_name'] ) )
			wp_die( 'Please enter a theme name. Please go back and try again.' );

		$this->theme = array(
			'name'        => 'Theme Name',
			'slug'        => 'theme-name',
			'uri'         => 'https://dyna.press/',
			'author'      => 'Dyna',
			'author_uri'  => 'https://dyna.press/',
			'description' => 'This is a theme based on Dyna.',
			'sass'        => false,
			'wpcom'       => false,
		);

		$this->theme['name']        = trim( $_REQUEST['dynabuild_name'] );
		$this->theme['slug']        = sanitize_title_with_dashes( $this->theme['name'] );
		$this->theme['sass']        = (bool) isset( $_REQUEST['dynabuild_sass'] );
		$this->theme['woocommerce'] = (bool) isset( $_REQUEST['dynabuild_woocommerce'] );
		$this->theme['wpcom']       = (bool) isset( $_REQUEST['can_i_haz_wpcom'] );

		if ( ! empty( $_REQUEST['dynabuild_slug'] ) ) {
			$this->theme['slug'] = sanitize_title_with_dashes( $_REQUEST['dynabuild_slug'] );
		}

		// Let's check if the slug can be a valid function name.
		if ( ! preg_match( '/^[a-z_]\w+$/i', str_replace( '-', '_', $this->theme['slug'] ) ) ) {
			wp_die( 'Theme slug could not be used to generate valid function names. Please go back and try again.' );
		}

		if ( ! empty( $_REQUEST['dynabuild_description'] ) ) {
			$this->theme['description'] = trim( $_REQUEST['dynabuild_description'] );
		}

		if ( ! empty( $_REQUEST['dynabuild_author'] ) ) {
			$this->theme['author'] = trim( $_REQUEST['dynabuild_author'] );
		}

		if ( ! empty( $_REQUEST['dynabuild_author_uri'] ) ) {
			$this->theme['author_uri'] = trim( $_REQUEST['dynabuild_author_uri'] );
		}

		$zip = new ZipArchive;
		$zip_filename = sprintf( '/tmp/dynabuild-%s.zip', md5( print_r( $this->theme, true ) ) );
		$res = $zip->open( $zip_filename, ZipArchive::CREATE && ZipArchive::OVERWRITE );

		$prototype_dir = dirname( __FILE__ ) . '/prototype/';

		$exclude_files = array( '.travis.yml', 'codesniffer.ruleset.xml', '.jscsrc', '.jshintignore', 'CONTRIBUTING.md', '.git', '.svn', '.DS_Store', '.gitignore', '.', '..' );
		$exclude_directories = array( '.git', '.svn', '.github', '.', '..' );

		if ( ! $this->theme['sass'] ) {
			$exclude_directories[] = 'sass';
		}

		if ( ! $this->theme['woocommerce'] ) {
			$exclude_files[] = 'woocommerce.css';
			$exclude_files[] = 'woocommerce.php';

			if ( $this->theme['sass'] ) {
				$exclude_files[]       = 'woocommerce.scss';
				$exclude_directories[] = 'sass/shop';
			}
		}

		if ( ! $this->theme['wpcom'] ) {
			$exclude_files[] = 'wpcom.php';
		}

		$iterator = new RecursiveDirectoryIterator( $prototype_dir );
		foreach ( new RecursiveIteratorIterator( $iterator ) as $filename ) {

			if ( in_array( basename( $filename ), $exclude_files ) )
				continue;

			foreach ( $exclude_directories as $directory )
				if ( strstr( $filename, "/{$directory}/" ) )
					continue 2; // continue the parent foreach loop

			$local_filename = str_replace( trailingslashit( $prototype_dir ), '', $filename );

			//todo _s.pot
			if ( 'languages/_s.pot' == $local_filename )
				$local_filename = sprintf( 'languages/%s.pot', $this->theme['slug'] );

			$contents = file_get_contents( $filename );
			$contents = apply_filters( 'dynabuild_generator_file_contents', $contents, $local_filename );
			$zip->addFromString( trailingslashit( $this->theme['slug'] ) . $local_filename, $contents );
		}

		$zip->close();

		$this->do_tracking();

		header( 'Content-type: application/zip' );
		header( sprintf( 'Content-Disposition: attachment; filename="%s.zip"', $this->theme['slug'] ) );
		readfile( $zip_filename );
		unlink( $zip_filename );/**/
		die();
	}

	/**
	 * Runs when looping through files contents, does the replacements fun stuff.
	 */
	function do_replacements( $contents, $filename ) {

		// Replace only text files, skip png's and other stuff.
		$valid_extensions = array( 'php', 'css', 'scss', 'js', 'txt' );
		$valid_extensions_regex = implode( '|', $valid_extensions );
		if ( ! preg_match( "/\.({$valid_extensions_regex})$/", $filename ) )
			return $contents;

		// Special treatment for style.css
		if ( in_array( $filename, array( 'style.css', 'sass/style.scss' ), true ) ) {
			$theme_headers = array(
				'Theme Name'  => $this->theme['name'],
				'Theme URI'   => esc_url_raw( $this->theme['uri'] ),
				'Author'      => $this->theme['author'],
				'Author URI'  => esc_url_raw( $this->theme['author_uri'] ),
				'Description' => $this->theme['description'],
				'Text Domain' => $this->theme['slug'],
			);

			foreach ( $theme_headers as $key => $value ) {
				$contents = preg_replace( '/(' . preg_quote( $key ) . ':)\s?(.+)/', '\\1 ' . $value, $contents );
			}

			// todo _s
			$contents = preg_replace( '/\b_s\b/', $this->theme['name'], $contents );

			return $contents;
		}

		// Special treatment for functions.php
		if ( 'functions.php' == $filename ) {

			if ( ! $this->theme['wpcom'] ) {
				// The following hack will remove the WordPress.com comment and include in functions.php.
				$find = 'WordPress.com-specific functions';
				$contents = preg_replace( '#/\*\*\n\s+\*\s+' . preg_quote( $find ) . '#i', '@wpcom_start', $contents );
				$contents = preg_replace( '#/inc/wpcom\.php\';#i', '@wpcom_end', $contents );
				$contents = preg_replace( '#@wpcom_start(.+)@wpcom_end\n?(\n\s)?#ims', '', $contents );
			}

			if ( ! $this->theme['woocommerce'] ) {
				// The following hack will remove the WooCommerce comment and include in functions.php.
				$find = 'Load WooCommerce compatibility file.';
				$contents = preg_replace( '#/\*\*\n\s+\*\s+' . preg_quote( $find ) . '#i', '@wpcom_start', $contents );
				$contents = preg_replace( '#/inc/woocommerce\.php\';\n\}#i', '@wpcom_end', $contents );
				$contents = preg_replace( '#@wpcom_start(.+)@wpcom_end\n?(\n\s)?#ims', '', $contents );
			}
		}

		// Special treatment for footer.php
		if ( 'footer.php' == $filename ) {
			// <?php printf( __( 'Theme: %1$s by %2$s.', '_s' ), '_s', '<a href="https://automattic.com/">Automattic</a>' );
			$contents = str_replace( 'https://automattic.com/', esc_url( $this->theme['author_uri'] ), $contents );
			$contents = str_replace( 'Automattic', $this->theme['author'], $contents );
			$contents = preg_replace( "#printf\\((\\s?__\\(\\s?'Theme:[^,]+,[^,]+,)([^,]+),#", sprintf( "printf(\\1 '%s',", esc_attr( $this->theme['name'] ) ), $contents );
		}

		// Special treatment for readme.txt
		if ( 'readme.txt' == $filename ) {
			$contents = preg_replace('/(?<=Description ==) *.*?(.*(?=(== Installation)))/s', "\n\n" . $this->theme['description'] . "\n\n", $contents );
			$contents = str_replace( '_s, or underscores', $this->theme['name'], $contents );
		}

		// Function names can not contain hyphens.
		$slug = str_replace( '-', '_', $this->theme['slug'] );

		// Regular treatment for all other files.
		$contents = str_replace( "@package _s", sprintf( "@package %s", str_replace( ' ', '_', $this->theme['name'] ) ), $contents ); // Package declaration.
		$contents = str_replace( "_s-", sprintf( "%s-",  $this->theme['slug'] ), $contents ); // Script/style handles.
		$contents = str_replace( "'_s'", sprintf( "'%s'",  $this->theme['slug'] ), $contents ); // Textdomains.
		$contents = str_replace( "_s_", $slug . '_', $contents ); // Function names.
		$contents = preg_replace( '/\b_s\b/', $this->theme['name'], $contents );
		return $contents;
	}

	function do_tracking() {

		// Track downloads.
		$user_agent = 'regular';
		if ( '_sh' == $_SERVER['HTTP_USER_AGENT'] ) {
			$user_agent = '_sh';
		}

		// Track features.
		$features   = array();
		if ( $this->theme['sass'] ) {
			$features[] = 'sass';
		}
		if ( $this->theme['woocommerce'] ) {
			$features[] = 'woocommerce';
		}
		if ( $this->theme['wpcom'] ) {
			$features[] = 'wpcom';
		}
		if ( empty( $features ) ) {
			$features[] = 'none';
		}

		wp_remote_get( add_query_arg( array(
			'v'                         => 'wpcom-no-pv',
			'x_dynabuild-downloads' => $user_agent,
			'x_dynabuild-features'  => implode( ',', $features ),
		), 'http://stats.wordpress.com/g.gif' ), array( 'blocking' => false ) );
	}
}
new Dyna_Builder_Plugin;
