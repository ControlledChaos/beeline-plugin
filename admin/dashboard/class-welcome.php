<?php
/**
 * Welcome panel functionality.
 *
 * @package    Beeline_Plugin
 * @subpackage Admin\Dashboard
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

namespace Beeline_Plugin\Admin\Dashboard;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Welcome panel functionality.
 *
 * @since  1.0.0
 * @access public
 */
class Welcome {

	/**
	 * Instance of the class
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object Returns the instance.
	 */
	public static function instance() {

		// Variable for the instance to be used outside the class.
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
	 * @return void Constructor method is empty.
	 *              Change to `self` if used.
	 */
    public function __construct() {

		/**
		 * Remove the welcome panel dismiss button.
		 *
		 * @since 1.0.0
		 */

		// If ACF is active, get the field from the ACF options page.
		if ( blp_acf_pro() ) {
			$dismiss = get_field( 'blp_remove_welcome_dismiss', 'option' );

		// If ACF is not active, get the field from the WordPress/ClassicPress options page.
		} else {
			$dismiss = get_option( 'blp_remove_welcome_dismiss' );
		}

		if ( $dismiss ) {
			add_action( 'admin_head', [ $this, 'dismiss' ] );
		}

		/**
		 * Use the custom Welcome panel if option selected.
		 */

		// If ACF is active, get the field from the ACF options page.
		if ( blp_acf_pro() ) {
			$welcome = get_field( 'blp_custom_welcome', 'option' );
		} else {
			$welcome = get_option( 'blp_custom_welcome' );
		}

		if ( $welcome ) {
			remove_action( 'welcome_panel', 'wp_welcome_panel' );
			add_action( 'welcome_panel', [ $this, 'welcome_panel' ], 25 );

			// Register the welcome panel areas.
			add_action( 'widgets_init', [ $this, 'widget_areas' ], 25 );
		}

	}

	/**
	 * Remove the welcome panel dismiss button if option selected.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function dismiss() {

		$dismiss = '
			<style>
				/*
				* Welcome panel user dismiss option
				* is disabled in the Customizer
				*/
				a.welcome-panel-close, #wp_welcome_panel-hide, .metabox-prefs label[for="wp_welcome_panel-hide"] {
					display: none !important;
				}
				.welcome-panel {
					display: block !important;
				}
			</style>
			';

		echo $dismiss;

	}

	/**
	 * Register the welcome panel areas.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function widget_areas() {

		register_sidebar( [
			'name'          => __( 'Welcome Panel - First Area', 'beeline-plugin' ),
			'id'            => 'blp_welcome_widget_first',
			'description'   => __( '', 'beeline-plugin' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		] );

		register_sidebar( [
			'name'          => __( 'Welcome Panel - Second Area', 'beeline-plugin' ),
			'id'            => 'blp_welcome_widget_second',
			'description'   => __( '', 'beeline-plugin' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		] );

		register_sidebar( [
			'name'          => __( 'Welcome Panel - Third Area', 'beeline-plugin' ),
			'id'            => 'blp_welcome_widget_last',
			'description'   => __( '', 'beeline-plugin' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		] );

	}

	/**
	 * Remove the welcome panel dismiss button if option selected.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function welcome_panel() {

		$welcome = locate_template( 'template-parts/admin/welcome-panel.php' );

		if ( ! empty( $welcome ) ) {
			get_template_part( 'template-parts/admin/welcome-panel' );
		} else {
			include_once BLP_PATH . 'admin/dashboard/partials/welcome-panel.php';
		}

	}

	/**
	 * Enqueue he welcome panel stylesheet.
     *
     * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function styles() {

        // Get the screen ID to target the Dashboard.
        $screen = get_current_screen();

        // Enqueue only on the Dashboard screen.
        if ( $screen->id == 'dashboard' ) {
            wp_enqueue_style( BLP_ADMIN_SLUG . '-welcome', BLP_URL .  'assets/css/welcome.min.css', [], null, 'screen' );
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
function blp_welcome() {

	return Welcome::instance();

}

// Run an instance of the class.
blp_welcome();