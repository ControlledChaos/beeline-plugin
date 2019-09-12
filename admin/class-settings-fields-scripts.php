<?php
/**
 * Settings fields for script loading and more.
 *
 * @package    Beeline_Plugin
 * @subpackage Admin
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

namespace Beeline_Plugin\Admin;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Settings fields for script loading and more.
 *
 * @since  1.0.0
 * @access public
 */
class Settings_Fields_Scripts {

	/**
	 * Instance of the class
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object Returns the instance.
	 */
	public static function instance() {

		// Varialbe for the instance to be used outside the class.
		static $instance = null;

		if ( is_null( $instance ) ) {

			// Set variable for new instance.
			$instance = new self;

		}

		// Return the instance.
		return $instance;

	}

    /**
	 * Constructor method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
    public function __construct() {

		// Register settings.
		add_action( 'admin_init', [ $this, 'settings' ] );

		// Include jQuery Migrate.
		$migrate = get_option( 'blp_jquery_migrate' );
		if ( ! $migrate ) {
			add_action( 'wp_default_scripts', [ $this, 'include_jquery_migrate' ] );
		}

	}

	/**
	 * Register settings via the WordPress/ClassicPress Settings API.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function settings() {

		/**
		 * Generl script options.
		 */
		add_settings_section( 'blp-scripts-general', __( 'General Options', 'beeline-plugin' ), [ $this, 'scripts_general_section_callback' ], 'blp-scripts-general' );

		// Inline scripts.
		add_settings_field( 'blp_inline_scripts', __( 'Inline Scripts', 'beeline-plugin' ), [ $this, 'blp_inline_scripts_callback' ], 'blp-scripts-general', 'blp-scripts-general', [ esc_html__( 'Add script contents to footer', 'beeline-plugin' ) ] );

		register_setting(
			'blp-scripts-general',
			'blp_inline_scripts'
		);

		// Inline styles.
		add_settings_field( 'blp_inline_styles', __( 'Inline Styles', 'beeline-plugin' ), [ $this, 'blp_inline_styles_callback' ], 'blp-scripts-general', 'blp-scripts-general', [ esc_html__( 'Add script-related CSS contents to head', 'beeline-plugin' ) ] );

		register_setting(
			'blp-scripts-general',
			'blp_inline_styles'
		);

		// Inline jQuery.
		add_settings_field( 'blp_inline_jquery', __( 'Inline jQuery', 'beeline-plugin' ), [ $this, 'blp_inline_jquery_callback' ], 'blp-scripts-general', 'blp-scripts-general', [ esc_html__( 'Deregister jQuery and add its contents to footer', 'beeline-plugin' ) ] );

		register_setting(
			'blp-scripts-general',
			'blp_inline_jquery'
		);

		// Include jQuery Migrate.
		add_settings_field( 'blp_jquery_migrate', __( 'jQuery Migrate', 'beeline-plugin' ), [ $this, 'blp_jquery_migrate_callback' ], 'blp-scripts-general', 'blp-scripts-general', [ esc_html__( 'Use jQuery Migrate for backwards compatibility', 'beeline-plugin' ) ] );

		register_setting(
			'blp-scripts-general',
			'blp_jquery_migrate'
		);

		// Remove emoji script.
		add_settings_field( 'blp_remove_emoji_script', __( 'Emoji Script', 'beeline-plugin' ), [ $this, 'remove_emoji_script_callback' ], 'blp-scripts-general', 'blp-scripts-general', [ esc_html__( 'Remove emoji script from <head>', 'beeline-plugin' ) ] );

		register_setting(
			'blp-scripts-general',
			'blp_remove_emoji_script'
		);

		// Remove WordPress/ClassicPress version appended to script links.
		add_settings_field( 'blp_remove_script_version', __( 'Script Versions', 'beeline-plugin' ), [ $this, 'remove_script_version_callback' ], 'blp-scripts-general', 'blp-scripts-general', [ esc_html__( 'Remove WordPress/ClassicPress version from script and stylesheet links in <head>', 'beeline-plugin' ) ] );

		register_setting(
			'blp-scripts-general',
			'blp_remove_script_version'
		);

		// Minify HTML.
		add_settings_field( 'blp_html_minify', __( 'Minify HTML', 'beeline-plugin' ), [ $this, 'html_minify_callback' ], 'blp-scripts-general', 'blp-scripts-general', [ esc_html__( 'Minify HTML source code to increase load speed', 'beeline-plugin' ) ] );

		register_setting(
			'blp-scripts-general',
			'blp_html_minify'
		);

		/**
		 * Use included vendor scripts & options.
		 */
		add_settings_section( 'blp-scripts-vendor', __( 'Included Vendor Scripts', 'beeline-plugin' ), [ $this, 'scripts_vendor_section_callback' ], 'blp-scripts-vendor' );

		// Use Slick.
		add_settings_field( 'blp_enqueue_slick', __( 'Slick', 'beeline-plugin' ), [ $this, 'enqueue_slick_callback' ], 'blp-scripts-vendor', 'blp-scripts-vendor', [ esc_html__( 'Use Slick script and stylesheets', 'beeline-plugin' ) ] );

		register_setting(
			'blp-scripts-vendor',
			'blp_enqueue_slick'
		);

		// Use Tabslet.
		add_settings_field( 'blp_enqueue_tabslet', __( 'Tabslet', 'beeline-plugin' ), [ $this, 'enqueue_tabslet_callback' ], 'blp-scripts-vendor', 'blp-scripts-vendor', [ esc_html__( 'Use Tabslet script', 'beeline-plugin' ) ] );

		register_setting(
			'blp-scripts-vendor',
			'blp_enqueue_tabslet'
		);

		// Use Sticky-kit.
		add_settings_field( 'blp_enqueue_stickykit', __( 'Sticky-kit', 'beeline-plugin' ), [ $this, 'enqueue_stickykit_callback' ], 'blp-scripts-vendor', 'blp-scripts-vendor', [ esc_html__( 'Use Sticky-kit script', 'beeline-plugin' ) ] );

		register_setting(
			'blp-scripts-vendor',
			'blp_enqueue_stickykit'
		);

		/**
		 * Use Tooltipster.
		 *
		 * @todo Add option to enqueue on the backend.
		 */
		add_settings_field( 'blp_enqueue_tooltipster', __( 'Tooltipster', 'beeline-plugin' ), [ $this, 'enqueue_tooltipster_callback' ], 'blp-scripts-vendor', 'blp-scripts-vendor', [ esc_html__( 'Use Tooltipster script and stylesheet', 'beeline-plugin' ) ] );

		register_setting(
			'blp-scripts-vendor',
			'blp_enqueue_tooltipster'
		);

		// Site Settings section.
		if ( blp_acf_options() ) {

			add_settings_section( 'blp-registered-fields-activate', __( 'Registered Fields Activation', 'beeline-plugin' ), [ $this, 'registered_fields_activate' ], 'blp-registered-fields-activate' );

			add_settings_field( 'blp_acf_activate_settings_page', __( 'Site Settings Page', 'beeline-plugin' ), [ $this, 'registered_fields_page_callback' ], 'blp-registered-fields-activate', 'blp-registered-fields-activate', [ __( 'Deactive the field group for the "Site Settings" options page.', 'beeline-plugin' ) ] );

			register_setting(
				'blp-registered-fields-activate',
				'blp_acf_activate_settings_page'
			);

		}

	}

	/**
	 * General section callback.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function scripts_general_section_callback( $args ) {

		$html = sprintf( '<p>%1s</p>', esc_html__( 'Inline settings only apply to scripts and styles included with the plugin.' ) );

		echo $html;

	}

	/**
	 * Inline jQuery.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function blp_inline_jquery_callback( $args ) {

		$option = get_option( 'blp_inline_jquery' );

		$html = '<p><input type="checkbox" id="blp_inline_jquery" name="blp_inline_jquery" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="blp_inline_jquery"> '  . $args[0] . '</label><br />';

		$html .= '<small><em>This may break the functionality of plugins that put scripts in the head</em>.</small></p>';

		echo $html;

	}

	/**
	 * Include jQuery Migrate.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function blp_jquery_migrate_callback( $args ) {

		$option = get_option( 'blp_jquery_migrate' );

		$html = '<p><input type="checkbox" id="blp_jquery_migrate" name="blp_jquery_migrate" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="blp_jquery_migrate"> '  . $args[0] . '</label><br />';

		$html .= '<small><em>Some outdated plugins and themes may be dependent on an old version of jQuery</em></small></p>';

		echo $html;

	}

	/**
	 * Inline scripts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function blp_inline_scripts_callback( $args ) {

		$option = get_option( 'blp_inline_scripts' );

		$html = '<p><input type="checkbox" id="blp_inline_scripts" name="blp_inline_scripts" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="blp_inline_scripts"> '  . $args[0] . '</label></p>';

		echo $html;

	}

	/**
	 * Inline styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function blp_inline_styles_callback( $args ) {

		$option = get_option( 'blp_inline_styles' );

		$html = '<p><input type="checkbox" id="blp_inline_styles" name="blp_inline_styles" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="blp_inline_styles"> '  . $args[0] . '</label></p>';

		echo $html;

	}

	/**
	 * Remove emoji script.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function remove_emoji_script_callback( $args ) {

		$option = get_option( 'blp_remove_emoji_script' );

		$html = '<p><input type="checkbox" id="blp_remove_emoji_script" name="blp_remove_emoji_script" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="blp_remove_emoji_script"> '  . $args[0] . '</label><br />';

		$html .= '<small><em>Emojis will still work in modern browsers</em></small></p>';

		echo $html;

	}

	/**
	 * Script options and enqueue settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function remove_script_version_callback( $args ) {

		$option = get_option( 'blp_remove_script_version' );

		$html = '<p><input type="checkbox" id="blp_remove_script_version" name="blp_remove_script_version" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="blp_remove_script_version"> '  . $args[0] . '</label></p>';

		echo $html;

	}

	/**
	 * Minify HTML source code.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function html_minify_callback( $args ) {

		$option = get_option( 'blp_html_minify' );

		$html = '<p><input type="checkbox" id="blp_html_minify" name="blp_html_minify" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="blp_html_minify"> '  . $args[0] . '</label></p>';

		echo $html;

	}

	/**
	 * Vendor section callback.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function scripts_vendor_section_callback( $args ) {

		$html = sprintf( '<p>%1s</p>', esc_html__( 'Look for Fancybox options on the Media Settings page.' ) );

		echo $html;

	}

	/**
	 * Use Slick.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function enqueue_slick_callback( $args ) {

		$option = get_option( 'blp_enqueue_slick' );

		$html = '<p><input type="checkbox" id="blp_enqueue_slick" name="blp_enqueue_slick" value="1" ' . checked( 1, $option, false ) . '/>';
		$html .= sprintf(
			'<label for="blp_enqueue_slick"> %1s</label> <a href="%2s" target="_blank" class="tooltip" title="%3s"><span class="dashicons dashicons-editor-help"></span></a>',
			$args[0],
			esc_attr( esc_url( 'http://kenwheeler.github.io/slick/' ) ),
			esc_attr( __( 'Learn more about Slick', 'beeline-plugin' ) )
		);
		$html .= '</p>';

		echo $html;

	}

	/**
	 * Use Tabslet.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function enqueue_tabslet_callback( $args ) {

		$option = get_option( 'blp_enqueue_tabslet' );

		$html = '<p><input type="checkbox" id="blp_enqueue_tabslet" name="blp_enqueue_tabslet" value="1" ' . checked( 1, $option, false ) . '/>';
		$html .= sprintf(
			'<label for="blp_enqueue_tabslet"> %1s</label> <a href="%2s" target="_blank" class="tooltip" title="%3s"><span class="dashicons dashicons-editor-help"></span></a>',
			$args[0],
			esc_attr( esc_url( 'http://vdw.github.io/Tabslet/' ) ),
			esc_attr( __( 'Learn more about Tabslet', 'beeline-plugin' ) )
		);
		$html .= '</p>';

		echo $html;

	}

	/**
	 * Use Sticky-kit.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function enqueue_stickykit_callback( $args ) {

		$option = get_option( 'blp_enqueue_stickykit' );

		$html = '<p><input type="checkbox" id="blp_enqueue_stickykit" name="blp_enqueue_stickykit" value="1" ' . checked( 1, $option, false ) . '/>';
		$html .= sprintf(
			'<label for="blp_enqueue_stickykit"> %1s</label> <a href="%2s" target="_blank" class="tooltip" title="%3s"><span class="dashicons dashicons-editor-help"></span></a>',
			$args[0],
			esc_attr( esc_url( 'http://leafo.net/sticky-kit/' ) ),
			esc_attr( __( 'Learn more about Sticky-kit', 'beeline-plugin' ) )
		);
		$html .= '</p>';

		echo $html;

	}

	/**
	 * Use Tooltipster.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function enqueue_tooltipster_callback( $args ) {

		$option = get_option( 'blp_enqueue_tooltipster' );

		$html = '<p><input type="checkbox" id="blp_enqueue_tooltipster" name="blp_enqueue_tooltipster" value="1" ' . checked( 1, $option, false ) . '/>';
		$html .= sprintf(
			'<label for="blp_enqueue_tooltipster"> %1s</label> <a href="%2s" target="_blank" class="tooltip" title="%3s"><span class="dashicons dashicons-editor-help"></span></a>',
			$args[0],
			esc_attr( esc_url( 'http://iamceege.github.io/tooltipster/' ) ),
			esc_attr( __( 'Learn more about Tooltipster', 'beeline-plugin' ) )
		);
		$html .= '</p>';

		echo $html;

	}

	/**
	 * Site Settings section.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function registered_fields_activate() {

		if ( blp_acf_options() ) {

			echo sprintf( '<p>%1s</p>', esc_html( 'The Controlled Chaos plugin registers custom fields for Advanced Custom Fields Pro that can be imported for editing. These built-in field goups must be deactivated for the imported field groups to take effect.', 'beeline-plugin' ) );

		}

	}

	/**
	 * Site Settings section callback.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function registered_fields_page_callback( $args ) {

		if ( blp_acf_options() ) {

			$html = '<p><input type="checkbox" id="blp_acf_activate_settings_page" name="blp_acf_activate_settings_page" value="1" ' . checked( 1, get_option( 'blp_acf_activate_settings_page' ), false ) . '/>';

			$html .= '<label for="blp_acf_activate_settings_page"> '  . $args[0] . '</label></p>';

			echo $html;

		}

	}

	/**
	 * Include jQuery Migrate.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
    public function include_jquery_migrate( $scripts ) {

		if ( ! empty( $scripts->registered['jquery'] ) ) {

			$scripts->registered['jquery']->deps = array_diff( $scripts->registered['jquery']->deps, [ 'jquery-migrate' ] );

		}

	}

}

/**
 * Put an instance of the class into a function.
 *
 * @since  1.0.0
 * @access public
 * @return object Returns an instance of the class.
 */
function blp_settings_fields_scripts() {

	return Settings_Fields_Scripts::instance();

}

// Run an instance of the class.
blp_settings_fields_scripts();