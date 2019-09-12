<?php
/**
 * The core plugin class
 *
 * @package    Beeline_Plugin
 * @subpackage Includes
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

namespace Beeline_Plugin\Includes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Get plugins path to check for active plugins.
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Define the core functionality of the plugin.
 *
 * @since  1.0.0
 * @access public
 */
final class Init {

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

			// Get class dependencies.
			$instance->dependencies();

		}

		// Return the instance.
		return $instance;

	}

	/**
	 * Constructor method
	 *
	 * @since  1.0.0
	 * @access private
	 * @return self
	 */
	private function __construct() {

		// Stop site health checks.
		add_filter( 'site_status_tests', [ $this, 'remove_tests' ] );

		// Site Health page redirect.
		add_action( 'current_screen', [ $this, 'health_redirect' ] );

		// Remove the Draconian capital P filter.
		remove_filter( 'the_title', 'capital_P_dangit', 11 );
		remove_filter( 'the_content', 'capital_P_dangit', 11 );
		remove_filter( 'comment_text', 'capital_P_dangit', 31 );

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function dependencies() {

		// Translation functionality.
		require_once BLP_PATH . 'includes/class-i18n.php';

		// Admin/backend functionality, scripts and styles.
		require_once BLP_PATH . 'admin/class-admin.php';

		// Frontend functionality, scripts and styles.
		require_once BLP_PATH . 'frontend/class-frontend.php';

		// Various media and media library functionality.
		require_once BLP_PATH . 'includes/media/class-media.php';

		// Post types and taxonomies.
		require_once BLP_PATH . 'includes/post-types-taxes/class-post-type-tax.php';

		// Dev and maintenance tools.
		require_once BLP_PATH . 'includes/tools/class-tools.php';

	}

	/**
	 * Stop site health checks
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array Returns an array of allowed tests.
	 */
	public function remove_tests( $tests ) {

		unset( $tests['direct']['php_version'] );
		return $tests;

	}

	/**
	 * Site Health page redirect
	 */
	public function health_redirect() {

		if ( is_admin() ) {

			$screen = get_current_screen();

			// If screen ID is site health.
			if ( 'site-health' == $screen->id ) {
				wp_redirect( admin_url() );
				exit;
			}

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
function blp_init() {

	return Init::instance();

}

// Run an instance of the class.
blp_init();