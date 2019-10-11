<?php
/**
 * The frontend content filters for post types
 *
 * @package    Beeline_Plugin
 * @subpackage Frontend
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

namespace Beeline_Plugin\Frontend;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The frontend content filters for post types
 *
 * @since  1.0.0
 * @access public
 */
class Content_Filters {

	/**
	 * Constructor method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Filter the client post type singular content.
		add_filter( 'the_content', [ $this, 'client_singular_filter' ], 10, 2 );

		// Filter the client post type archive content.
		add_filter( 'the_content', [ $this, 'client_archive_filter' ], 10, 2 );

		// Filter the team post type singular content.
		add_filter( 'the_content', [ $this, 'team_singular_filter' ], 10, 2 );

		// Filter the team post type archive content.
		add_filter( 'the_content', [ $this, 'team_archive_filter' ], 10, 2 );

	}

	/**
	 * Filter the client post type singular content
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string $content
	 * @return mixed Returns the custom HTML output.
	 */
	public function client_singular_filter( $content ) {

		// Return the default content if not client.
		if ( ! is_singular( 'client' ) ) {
			return $content;
		}

		ob_start();

		// Include the snippet content.
		include BLP_PATH . 'frontend/partials/singular-client.php';

		$content = ob_get_contents();
		ob_end_clean();
		echo $content;

	}

	/**
	 * Filter the client post type archive content
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string $content
	 * @return mixed Returns the custom HTML output.
	 */
	public function client_archive_filter( $content ) {

		// Return the default content if not client.
		if ( ! is_post_type_archive( 'client' ) ) {
			return $content;
		}

		ob_start();

		// Include the snippet content.
		include BLP_PATH . 'frontend/partials/archive-client.php';

		$content = ob_get_contents();
		ob_end_clean();
		echo $content;

	}

	/**
	 * Filter the team post type singular content
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string $content
	 * @return mixed Returns the custom HTML output.
	 */
	public function team_singular_filter( $content ) {

		// Return the default content if not team.
		if ( ! is_singular( 'team' ) ) {
			return $content;
		}

		ob_start();

		// Include the snippet content.
		include BLP_PATH . 'frontend/partials/singular-team.php';

		$content = ob_get_contents();
		ob_end_clean();
		echo $content;

	}

	/**
	 * Filter the team post type archive content
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string $content
	 * @return mixed Returns the custom HTML output.
	 */
	public function team_archive_filter( $content ) {

		// Return the default content if not team.
		if ( ! is_post_type_archive( 'team' ) ) {
			return $content;
		}

		ob_start();

		// Include the snippet content.
		include BLP_PATH . 'frontend/partials/archive-team.php';

		$content = ob_get_contents();
		ob_end_clean();
		echo $content;

	}

}

$blp_content_filters = new Content_Filters();