<?php
/**
 * Page templates class
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

/**
 * Page templates class
 *
 * @since  1.0.0
 * @access public
 */
final class Page_Templates {

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
	 * @access private
	 * @return self
	 */
	private function __construct() {

		$this->templates = [];

		// Add a filter to the attributes metabox to inject template into the cache.
		if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {

			// 4.6 and older.
			add_filter( 'page_attributes_dropdown_pages_args', [ $this, 'register_page_templates' ] );

		} else {

			// Add a filter to the wp 4.7 version attributes metabox.
			add_filter( 'theme_page_templates', [ $this, 'add_new_template' ] );
		}

		// Add a filter to the save post to inject out template into the page cache.
		add_filter( 'wp_insert_post_data', [ $this, 'register_page_templates' ] );

		// Filter the content.
		add_filter( 'the_content', [ $this, 'page_template_filters' ], 10, 2 );

		/**
		 * Add a filter to the template include to determine if the page
		 * has the template assigned and return it's path.
		 *
		 * This method is left intact for completeness but we are not using it.
		 * Instead we will use a content filter if the template is assigned.
		 */
		// add_filter( 'template_include', [ $this, 'locate_page_template' ] );

		// Add templates to this array.
		$this->templates = [
			'contact-page.php' => __( 'Contact Page', 'beeline-plugin' ),
			'about-page.php' => __( 'About Page', 'beeline-plugin' )
		];

	}

	/**
	 * Add the templates to the page dropdown for v4.7+
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array Returns the full array of templates.
	 *
	 */
	public function add_new_template( $posts_templates ) {

		$posts_templates = array_merge( $posts_templates, $this->templates );
		return $posts_templates;

	}

	/**
	 * Add templates to the pages cache in order to trick WordPress
	 * into thinking the template file exists where it doens't really exist.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function register_page_templates( $atts ) {

		// Create the key used for the themes cache.
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		// Retrieve the cache list.
		$templates = wp_get_theme()->get_page_templates();

		if ( empty( $templates ) ) {
			$templates = [];
		}

		// New cache, therefore remove the old one.
		wp_cache_delete( $cache_key , 'themes');

		// Merge templates with the existing templates array from the cache.
		$templates = array_merge( $templates, $this->templates );

		// Add the modified cache to allow WordPress to pick it up for listing available templates.
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );

		return $atts;

	}

	/**
	 * Content filters
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function page_template_filters( $content ) {

		// Bail if ACF Pro is not active.
		if ( ! blp_acf_pro() ) {
			return;
		}

		// Content for the contact page template.
		if ( is_page() && is_page_template( 'contact-page.php' ) ) {
			ob_start();

			// Include the snippet content.
			include_once BLP_PATH . 'frontend/partials/contact-page.php';

			$content = ob_get_contents();
			ob_end_clean();
			echo $content;
		} else {
			echo $content;
		}

	}

	/**
	 * Locate the page template
	 *
	 * Adds a filter to the template include to determine if the page
	 * has the template assigned and return it's path.
	 *
	 * This method is left intact for completeness but we are not using it.
	 * Instead we will use a content filter if the template is assigned.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object Returns the page template.
	 */
	public function locate_page_template( $template ) {

		// Get global post.
		global $post;

		// Return template if post is empty.
		if ( ! $post ) {
			return $template;
		}

		/**
		 * Template location
		 *
		 * Use the plugin template if ACF Pro is active. Otherwise,
		 * use the active theme's page.php file. Look first for a
		 * `page-contact.php` file for the 'contact' slug.
		 */

		// Look for `page-contact.php` in theme root.
		$page_contact = locate_template( 'page-contact.php' );

		/**
		 * If `page-contact.php` is found or this custom template
		 * is not selected, return the default template.
		 */
		if ( $page_contact || ! isset( $this->templates[get_post_meta(
			$post->ID, '_wp_page_template', true
		)] ) ) {
			return $template;
		}

		$file = BLP_PATH . 'frontend/templates/' . get_post_meta( $post->ID, '_wp_page_template', true );

		// Check if the file exist first.
		if ( file_exists( $file ) ) {
			return $file;

		// If not, return the default template.
		} else {
			return $template;
		}

	}

}

/**
 * Put an instance of the class into a function
 *
 * @since  1.0.0
 * @access public
 * @return object Returns an instance of the class.
 */
function blp_page_templates() {

	return Page_Templates::instance();

}

// Run an instance of the class.
blp_page_templates();