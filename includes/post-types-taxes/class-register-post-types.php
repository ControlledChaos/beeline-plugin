<?php
/**
 * Register post types.
 *
 * @package    Beeline_Plugin
 * @subpackage Includes\Post_Types_Taxes
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 *
 * @link       https://codex.wordpress.org/Function_Reference/register_post_type
 */

namespace Beeline_Plugin\Includes\Post_Types_Taxes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Register post types.
 *
 * @since  1.0.0
 * @access public
 */
final class Post_Types_Register {

    /**
	 * Constructor magic method.
     *
     * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

        // Register client types.
		add_action( 'init', [ $this, 'register' ] );

	}

    /**
     * Register client types.
     *
     * Note for WordPress 5.0 or greater:
     * If you want your post type to adopt the block edit_form_image_editor
     * rather than using the classic editor then set `show_in_rest` to `true`.
     *
     * @since  1.0.0
	 * @access public
	 * @return void
     */
    public function register() {

        /**
         * Post Type: Clients
         */

        $labels = [
            'name'                  => __( 'Beeline Clients', 'beeline-plugin' ),
            'singular_name'         => __( 'Client', 'beeline-plugin' ),
            'menu_name'             => __( 'Clients', 'beeline-plugin' ),
            'all_items'             => __( 'All Clients', 'beeline-plugin' ),
            'add_new'               => __( 'Add New', 'beeline-plugin' ),
            'add_new_item'          => __( 'Add New Client', 'beeline-plugin' ),
            'edit_item'             => __( 'Edit Client', 'beeline-plugin' ),
            'new_item'              => __( 'New Client', 'beeline-plugin' ),
            'view_item'             => __( 'View Client', 'beeline-plugin' ),
            'view_items'            => __( 'View Clients', 'beeline-plugin' ),
            'search_items'          => __( 'Search Clients', 'beeline-plugin' ),
            'not_found'             => __( 'No Clients Found', 'beeline-plugin' ),
            'not_found_in_trash'    => __( 'No Clients Found in Trash', 'beeline-plugin' ),
            'parent_item_colon'     => __( 'Parent Client', 'beeline-plugin' ),
            'featured_image'        => __( 'Featured image for this client', 'beeline-plugin' ),
            'set_featured_image'    => __( 'Set featured image for this client', 'beeline-plugin' ),
            'remove_featured_image' => __( 'Remove featured image for this client', 'beeline-plugin' ),
            'use_featured_image'    => __( 'Use as featured image for this client', 'beeline-plugin' ),
            'archives'              => __( 'Client archives', 'beeline-plugin' ),
            'insert_into_item'      => __( 'Insert into Client', 'beeline-plugin' ),
            'uploaded_to_this_item' => __( 'Uploaded to this Client', 'beeline-plugin' ),
            'filter_items_list'     => __( 'Filter Clients', 'beeline-plugin' ),
            'items_list_navigation' => __( 'Clients list navigation', 'beeline-plugin' ),
            'items_list'            => __( 'Clients List', 'beeline-plugin' ),
            'attributes'            => __( 'Client Attributes', 'beeline-plugin' ),
            'parent_item_colon'     => __( 'Parent Client', 'beeline-plugin' ),
        ];

        // Apply a filter to labels for customization.
        $labels = apply_filters( 'client_labels', $labels );

        $options = [
            'label'               => __( 'Clients', 'beeline-plugin' ),
            'labels'              => $labels,
            'description'         => __( 'Beeline clients.', 'beeline-plugin' ),
            'public'              => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_rest'        => false,
            'rest_base'           => 'client_rest_api',
            'has_archive'         => true,
            'show_in_menu'        => true,
            'exclude_from_search' => false,
            'capability_type'     => 'post',
            'map_meta_cap'        => true,
            'hierarchical'        => false,
            'rewrite'             => [
                'slug'       => 'clients',
                'with_front' => true
            ],
            'query_var'           => 'client',
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-archive',
            'supports'            => [
                'title',
                'editor',
                'thumbnail',
                'page-attributes'
            ],
            'taxonomies'          => [
                'client_type'
            ],
        ];

        // Apply a filter to arguments for customization.
        $options = apply_filters( 'client_args', $options );

        /**
         * Register the post type
         *
         * Maximum 20 characters, cannot contain capital letters or spaces.
         */
        register_post_type(
            'client',
            $options
		);

		/**
         * Post Type: Team Members
         */

        $labels = [
            'name'                  => __( 'Team Members', 'beeline-plugin' ),
            'singular_name'         => __( 'Team Member', 'beeline-plugin' ),
            'menu_name'             => __( 'Team', 'beeline-plugin' ),
            'all_items'             => __( 'Team Members', 'beeline-plugin' ),
            'add_new'               => __( 'Add New', 'beeline-plugin' ),
            'add_new_item'          => __( 'Add New Team Member', 'beeline-plugin' ),
            'edit_item'             => __( 'Edit Team Member', 'beeline-plugin' ),
            'new_item'              => __( 'New Team Member', 'beeline-plugin' ),
            'view_item'             => __( 'View Team Member', 'beeline-plugin' ),
            'view_items'            => __( 'View Team', 'beeline-plugin' ),
            'search_items'          => __( 'Search Team', 'beeline-plugin' ),
            'not_found'             => __( 'No Team Members Found', 'beeline-plugin' ),
            'not_found_in_trash'    => __( 'No Team Members Found in Trash', 'beeline-plugin' ),
            'parent_item_colon'     => __( 'Parent Team Member', 'beeline-plugin' ),
            'featured_image'        => __( 'Featured image for this team member', 'beeline-plugin' ),
            'set_featured_image'    => __( 'Set featured image for this team member', 'beeline-plugin' ),
            'remove_featured_image' => __( 'Remove featured image for this team member', 'beeline-plugin' ),
            'use_featured_image'    => __( 'Use as featured image for this team member', 'beeline-plugin' ),
            'archives'              => __( 'Team archives', 'beeline-plugin' ),
            'insert_into_item'      => __( 'Insert into Team Member', 'beeline-plugin' ),
            'uploaded_to_this_item' => __( 'Uploaded to this Team Member', 'beeline-plugin' ),
            'filter_items_list'     => __( 'Filter Team', 'beeline-plugin' ),
            'items_list_navigation' => __( 'Team list navigation', 'beeline-plugin' ),
            'items_list'            => __( 'Team List', 'beeline-plugin' ),
            'attributes'            => __( 'Team Member Attributes', 'beeline-plugin' ),
            'parent_item_colon'     => __( 'Parent Team Member', 'beeline-plugin' ),
        ];

        // Apply a filter to labels for customization.
        $labels = apply_filters( 'team_labels', $labels );

        $options = [
            'label'               => __( 'Members', 'beeline-plugin' ),
            'labels'              => $labels,
            'description'         => __( 'Beeline Representatives team members.', 'beeline-plugin' ),
            'public'              => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_rest'        => false,
            'rest_base'           => 'team_rest_api',
            'has_archive'         => true,
            'show_in_menu'        => true,
            'exclude_from_search' => false,
            'capability_type'     => 'post',
            'map_meta_cap'        => true,
            'hierarchical'        => false,
            'rewrite'             => [
                'slug'       => 'team',
                'with_front' => true
            ],
            'query_var'           => 'team',
            'menu_position'       => 10,
            'menu_icon'           => 'dashicons-groups',
            'supports'            => [
                'title',
				'thumbnail',
				'page-attributes'
            ],
            'taxonomies'          => [],
        ];

        // Apply a filter to arguments for customization.
        $options = apply_filters( 'team_args', $options );

        /**
         * Register the post type
         *
         * Maximum 20 characters, cannot contain capital letters or spaces.
         */
        register_post_type(
            'team',
            $options
        );

    }

}

// Run the class.
$clients = new Post_Types_Register;