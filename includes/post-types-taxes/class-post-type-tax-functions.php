<?php
/**
 * Functions for post types and taxonomies.
 *
 * @package    Site_Plugin
 * @subpackage Includes\Post_Types_Taxes
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

namespace Beeline_Plugin\Includes\Post_Types_Taxes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Functions for post types and taxonomies.
 *
 * @since  1.0.0
 * @access public
 */
class Post_Type_Tax_Functions {

	/**
	 * Get an instance of the class.
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
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Replace "Post" in the update messages.
		add_filter( 'post_updated_messages', [ $this, 'update_messages' ], 99 );

		// Change Posts to News.
		add_action( 'admin_menu', [ $this, 'change_menu_labels' ] );
		add_action( 'init', [ $this, 'change_page_labels' ] );
		add_action( 'admin_menu', [ $this, 'change_menu_icon' ] );
		add_filter( 'post_updated_messages', [ $this, 'change_page_messages' ] );
		add_action( 'admin_head', [ $this, 'dashboard_icons' ] );
		add_action( 'admin_footer', [ $this, 'at_glance_text' ] );

	}

	/**
	 * Replace "Post" in the update messages for custom post types.
	 *
	 * Example: where the edit screen reads "Post updated" and "View post"
	 * it would read "Project updated" and "View project" for post type Project.
	 *
	 * @since  1.0.0
	 * @access public
	 * @global object post
	 * @global int post_ID
	 * @param array $messages
	 * @return string Returns the text appropriate for each condition.
	 */
	public function update_messages( $messages ) {

		global $post, $post_ID;

		$post_types = get_post_types(
			[
				'show_ui'  => true,
				'_builtin' => false
			],
			'objects' );

		foreach ( $post_types as $post_type => $post_object ) {

			$messages[ $post_type ] = [
				0  => '', /* Unused. Messages start at index 1 */

				1  => sprintf(
					__( '%1s updated. <a href="%2s">View %3s</a>', 'beeline-plugin' ), $post_object->labels->singular_name,
					esc_url( get_permalink( $post_ID ) ),
					$post_object->labels->singular_name
				),
				2  => __( 'Custom field updated.', 'beeline-plugin' ),
				3  => __( 'Custom field deleted.', 'beeline-plugin' ),
				4  => sprintf(
					__( '1%s updated.', 'beeline-plugin' ),
					$post_object->labels->singular_name
				),
				5  => isset( $_GET['revision']) ? sprintf(
					__( '%1s restored to revision from %2s', 'beeline-plugin' ),
					$post_object->labels->singular_name,
					wp_post_revision_title( (int) $_GET['revision'], false )
					) : false,
				6  => sprintf(
					__( '%1s published. <a href="%2s">View %3s</a>', 'beeline-plugin' ),
					$post_object->labels->singular_name,
					esc_url( get_permalink( $post_ID ) ),
					$post_object->labels->singular_name
				),
				7  => sprintf(
					__( '%1s saved.', 'beeline-plugin' ),
					$post_object->labels->singular_name
				),
				8  => sprintf(
					__( '%1s submitted. <a target="_blank" href="%2s">Preview %3s</a>', 'beeline-plugin' ),
					$post_object->labels->singular_name,
					esc_url( add_query_arg( 'preview', 'true',
					get_permalink( $post_ID ) ) ),
					$post_object->labels->singular_name
				),
				9  => sprintf(
					__( '%1s scheduled for: <strong>%2s</strong>. <a target="_blank" href="%3s">Preview %4s</a>', 'beeline-plugin'  ),
					$post_object->labels->singular_name,
					date_i18n( __( 'M j, Y @ G:i', 'beeline-plugin' ),
					strtotime( $post->post_date ) ),
					esc_url( get_permalink( $post_ID ) ),
					$post_object->labels->singular_name
				),
				10 => sprintf(
					__( '%1s draft updated. <a target="_blank" href="%2s">Preview %3s</a>', 'beeline-plugin'  ),
					$post_object->labels->singular_name,
					esc_url( add_query_arg( 'preview', 'true',
					get_permalink( $post_ID ) ) ),
					$post_object->labels->singular_name
				),
			];

		}

		return $messages;
	}

	/**
	 * Change post type labels in the admin menu
	 *
	 * @since  1.0.0
	 * @access public
	 * @global object $menu Gets the admin menu.
	 * @global object $submenu Gets the admin submenus.
	 * @return string Returns the various labels.
	 */
	public function change_menu_labels() {

		// Access global variables.
		global $menu, $submenu;

		// The "Posts" position in the admin menu.
		$menu[5][0] = __( 'News', 'posts-to-news' );

		// Submenus of the "Posts" position in the admin menu.
		$submenu['edit.php'][5][0]  = __( 'News', 'posts-to-news' );
		$submenu['edit.php'][10][0] = __( 'Add News', 'posts-to-news' );
		$submenu['edit.php'][15][0] = __( 'News Categories', 'posts-to-news' );
		$submenu['edit.php'][16][0] = __( 'News Tags', 'posts-to-news' );

	}

	/**
	 * Change post type labels on admin pages
	 *
	 * @since  1.0.0
	 * @access public
	 * @global array $wp_post_types Gets the array of admin page labels.
	 * @return string Returns the various labels.
	 */
	public function change_page_labels() {

		// Access global variables.
		global $wp_post_types;

		// The labels of the array.
		$labels = $wp_post_types['post']->labels;
		$labels->name               = __( 'News', 'posts-to-news' );
		$labels->singular_name      = __( 'News', 'posts-to-news' );
		$labels->add_new            = __( 'Add News', 'posts-to-news' );
		$labels->add_new_item       = __( 'Add News', 'posts-to-news' );
		$labels->edit_item          = __( 'Edit News', 'posts-to-news' );
		$labels->new_item           = __( 'News', 'posts-to-news' );
		$labels->view_item          = __( 'View News', 'posts-to-news');
		$labels->search_items       = __( 'Search News', 'posts-to-news' );
		$labels->not_found          = __( 'No News found', 'posts-to-news' );
		$labels->not_found_in_trash = __( 'No News found in Trash', 'posts-to-news' );
		$labels->all_items          = __( 'All News', 'posts-to-news'  );
		$labels->menu_name          = __( 'News', 'posts-to-news' );
		$labels->name_admin_bar     = __( 'News', 'posts-to-news' );

	}

	/**
	 * Change the pin icon to a megaphone
	 *
	 * @since  1.0.0
	 * @access public
	 * @global object $menu Gets the admin menu.
	 * @return string Returns the various labels.
	 */
	public function change_menu_icon() {

		// Access global variables.
		global $menu;

		foreach ( $menu as $key => $val ) {

			if ( __( 'News', 'posts-to-news' ) == $val[0] ) {
				$menu[$key][6] = 'dashicons-megaphone';
			}
		}
	}

	/**
	 * Change post messages
	 *
	 * @since  1.0.0
	 * @access public
	 * @param array $messages Gets the array of messages.
	 * @global object $post Gets the post object.
	 * @global object $post_ID Gets the post ID.
	 * @return array Returns the array of messages.
	 */
	public function change_page_messages( $messages ) {

		// Access global variables.
		global $post, $post_ID;

		// Conditional message for revisions.
		if ( isset( $_GET['revision'] ) ) {
			$revision = sprintf(
				__( '%1s %2s' ),
				__( 'News post restored to revision from', 'posts-to-news' ),
				wp_post_revision_title( (int) $_GET['revision'], false )
			);
		} else {
			$revision = false;
		}

		// Updated message.
		$updated = sprintf(
			__( '%1s <a href="%2s">%3s</a>' ),
			__( 'News updated.', 'posts-to-news' ),
			esc_url( get_permalink( $post_ID ) ),
			__( 'View News Post', 'posts-to-news' )
		);

		// Published message.
		$published = sprintf(
			__( '%1s <a href="%2s">%3s</a>' ),
			__( 'News published.', 'posts-to-news' ),
			esc_url( get_permalink( $post_ID ) ),
			__( 'View News Post', 'posts-to-news' )
		);

		// Submitted message.
		$submitted = sprintf(
			__( '%1s <a target="_blank" href="%2s">%3s</a>' ),
			__( 'News submitted.', 'posts-to-news' ),
			esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ),
			__( 'Preview News Post', 'posts-to-news' )
		);

		// Scheduled message.
		$scheduled = sprintf(
			__( '%1s <strong>%2s</strong>. <a target="_blank" href="%3s">%4s</a>' ),
			__( 'News scheduled for:', 'posts-to-news' ),
			date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ),
			esc_url( get_permalink( $post_ID ) ),
			__( 'Preview News Post', 'posts-to-news' )
		);

		// Draft updated message.
		$draft = sprintf(
			__( '%1s <a target="_blank" href="%2s">%3s</a>' ),
			__( 'News draft updated.', 'posts-to-news' ),
			esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ),
			__( 'Preview News Post', 'posts-to-news' )
		);

		// The array of messages for the Posts post type.
		$messages['post'] = [

			// First is unused. Messages start at index 1.
			0  => null,
			1  => $updated,
			2  => __( 'Custom field updated.', 'posts-to-news' ),
			3  => __( 'Custom field deleted.', 'posts-to-news' ),
			4  => __( 'News updated.', 'posts-to-news' ),
			5  => $revision,
			6  => $published,
			7  => __( 'News saved.', 'posts-to-news' ),
			8  => $submitted,
			9  => $scheduled,
			10 => $draft
		];

		// Return the array of messages.
		return $messages;

	}

	/**
	 * News posts dashboard icon
	 *
	 * Changes the posts icon in the At a Glance dashboard widget.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns the style block in the admin head.
	 */
	public function dashboard_icons() {

		// Get the screen ID to target the Dashboard.
        $screen = get_current_screen();

        // Bail if not on the Dashboard screen.
        if ( $screen->id != 'dashboard' ) {
			return;
		}

		// Minified style block.
		$style = '<style>#dashboard_right_now .post-count a[href="edit.php?post_type=post"]::before,#dashboard_right_now .post-count span::before{content:"\f488"!important;}</style>';

		// Print the style block.
		echo $style;

	}

	/**
	 * News posts dashboard text
	 *
	 * Changes the posts text in the At a Glance dashboard widget.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns the script block in the admin head.
	 */
	public function at_glance_text() {

		// Get the screen ID to target the Dashboard.
        $screen = get_current_screen();

        // Bail if not on the Dashboard screen.
        if ( $screen->id != 'dashboard' ) {
			return;
		} ?>
		<script>jQuery(document).ready(function(a){a('.post-count a[href="edit.php?post_type=post"]').text(function(){return a(this).text().replace('1 Post','1 News Post')}),a('.post-count a[href="edit.php?post_type=post"]').text(function(){return a(this).text().replace('Posts','News Posts')})});</script>
	<?php }

}

/**
 * Put an instance of the class into a function.
 *
 * @since  1.0.0
 * @access public
 * @return object Returns an instance of the class.
 */
function blp_type_taxes_functions() {

	return Post_Type_Tax_Functions::instance();

}

// Run an instance of the class.
blp_type_taxes_functions();