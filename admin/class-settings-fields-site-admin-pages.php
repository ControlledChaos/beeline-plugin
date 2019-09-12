<?php
/**
 * Settings for the Admin Pages tab on the Site Settings page.
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
 * Settings for the Admin Pages tab.
 *
 * @since  1.0.0
 * @access public
 */
class Settings_Fields_Site_Admin_Pages {

	/**
	 * Holds the values to be used in the fields callbacks.
	 *
	 * @var array
	 */
	private $options;

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

			// Require the class files.
			$instance->dependencies();

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

		// Register settings sections and fields.
		add_action( 'admin_init', [ $this, 'settings' ] );

	}

	/**
	 * Class dependency files.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function dependencies() {

		// Callbacks for the Admin Pages tab.
		require BLP_PATH . 'admin/partials/field-callbacks/class-admin-pages-callbacks.php';

	}

	/**
	 * Plugin site settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 *
	 * @link  https://codex.wordpress.org/Settings_API
	 */
	public function settings() {

		// Admin pages settings section.
		add_settings_section(
			'blp-site-admin-pages',
			__( 'Admin Pages Settings', 'beeline-plugin' ),
			[],
			'blp-site-admin-pages'
		);

		// Use the admin header.
		add_settings_field(
			'blp_use_admin_header',
			__( 'Admin Header', 'beeline-plugin' ),
			[ Partials\Field_Callbacks\Admin_Pages_Callbacks::instance(), 'admin_header' ],
			'blp-site-admin-pages',
			'blp-site-admin-pages',
			[ esc_html__( 'Add the site title, site tagline, and a nav menu to the top of admin pages.', 'beeline-plugin' ) ]
		);

		register_setting(
			'blp-site-admin-pages',
			'blp_use_admin_header'
		);

		// Use custom sort order.
		add_settings_field(
			'blp_use_custom_sort_order',
			__( 'Drag & Drop Sort Order', 'beeline-plugin' ),
			[ Partials\Field_Callbacks\Admin_Pages_Callbacks::instance(), 'custom_sort_order' ],
			'blp-site-admin-pages',
			'blp-site-admin-pages',
			[ esc_html__( 'Add drag & drop sort order functionality to post types and taxonomies.', 'beeline-plugin' ) ]
		);

		register_setting(
			'blp-site-admin-pages',
			'blp_use_custom_sort_order'
		);

		// Admin footer credit.
		add_settings_field(
			'blp_footer_credit',
			__( 'Admin Footer Credit', 'beeline-plugin' ),
			[ Partials\Field_Callbacks\Admin_Pages_Callbacks::instance(), 'footer_credit' ],
			'blp-site-admin-pages',
			'blp-site-admin-pages',
			[ esc_html__( 'The "developed by" credit.', 'beeline-plugin' ) ]
		);

		register_setting(
			'blp-site-admin-pages',
			'blp_footer_credit'
		);

		// Admin footer link.
		add_settings_field(
			'blp_footer_link',
			__( 'Admin Footer Link', 'beeline-plugin' ),
			[ Partials\Field_Callbacks\Admin_Pages_Callbacks::instance(), 'footer_link' ],
			'blp-site-admin-pages',
			'blp-site-admin-pages',
			[ esc_html__( 'Link to the website devoloper.', 'beeline-plugin' ) ]
		);

		register_setting(
			'blp-site-admin-pages',
			'blp_footer_link'
		);

	}

}

/**
 * Put an instance of the class into a function.
 *
 * @since  1.0.0
 * @access public
 * @return object Returns an instance of the class.
 */
function blp_settings_fields_site_admin_pages() {

	return Settings_Fields_Site_Admin_Pages::instance();

}

// Run an instance of the class.
blp_settings_fields_site_admin_pages();