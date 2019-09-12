<?php
/**
 * Register taxonomies.
 *
 * @package    Beeline_Plugin
 * @subpackage Includes\Post_Types_Taxes
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 *
 * @link       https://codex.wordpress.org/Function_Reference/register_taxonomy
 */

namespace Beeline_Plugin\Includes\Post_Types_Taxes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Register taxonomies.
 *
 * @since  1.0.0
 * @access public
 */
final class Taxes_Register {

    /**
	 * Constructor magic method.
     *
     * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

        // Register custom taxonomies.
		add_action( 'init', [ $this, 'register' ] );

	}

    /**
     * Register custom taxonomies.
     *
     * @since  1.0.0
	 * @access public
	 * @return void
     */
    public function register() {

        /**
         * Taxonomy: Sample taxonomy (Taxonomy).
         *
         * Renaming:
         * Search case "Taxonomy" and replace with your post type singular name.
         * Search case "Taxonomies" and replace with your post type plural name.
         * Search case "blp_taxonomy" and replace with your taxonomy database name.
         * Search case "taxonomies" and replace with your taxonomy permalink slug.
         */

        $labels = [
            'name'                       => __( 'Taxonomies', 'beeline-plugin' ),
            'singular_name'              => __( 'Taxonomy', 'beeline-plugin' ),
            'menu_name'                  => __( 'Taxonomy', 'beeline-plugin' ),
            'all_items'                  => __( 'All Taxonomies', 'beeline-plugin' ),
            'edit_item'                  => __( 'Edit Taxonomy', 'beeline-plugin' ),
            'view_item'                  => __( 'View Taxonomy', 'beeline-plugin' ),
            'update_item'                => __( 'Update Taxonomy', 'beeline-plugin' ),
            'add_new_item'               => __( 'Add New Taxonomy', 'beeline-plugin' ),
            'new_item_name'              => __( 'New Taxonomy', 'beeline-plugin' ),
            'parent_item'                => __( 'Parent Taxonomy', 'beeline-plugin' ),
            'parent_item_colon'          => __( 'Parent Taxonomy', 'beeline-plugin' ),
            'popular_items'              => __( 'Popular Taxonomies', 'beeline-plugin' ),
            'separate_items_with_commas' => __( 'Separate Taxonomies with commas', 'beeline-plugin' ),
            'add_or_remove_items'        => __( 'Add or Remove Taxonomies', 'beeline-plugin' ),
            'choose_from_most_used'      => __( 'Choose from the most used Taxonomies', 'beeline-plugin' ),
            'not_found'                  => __( 'No Taxonomies Found', 'beeline-plugin' ),
            'no_terms'                   => __( 'No Taxonomies', 'beeline-plugin' ),
            'items_list_navigation'      => __( 'Taxonomies List Navigation', 'beeline-plugin' ),
            'items_list'                 => __( 'Taxonomies List', 'beeline-plugin' )
        ];

        $options = [
            'label'              => __( 'Taxonomies', 'beeline-plugin' ),
            'labels'             => $labels,
            'public'             => true,
            'hierarchical'       => false,
            'label'              => 'Taxonomies',
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_nav_menus'  => true,
            'query_var'          => true,
            'rewrite'            => [
                'slug'         => 'taxonomies',
                'with_front'   => true,
                'hierarchical' => false,
            ],
            'show_admin_column'  => true,
            'show_in_rest'       => true,
            'rest_base'          => 'taxonomies',
            'show_in_quick_edit' => true
        ];

        /**
         * Register the taxonomy
         */
        register_taxonomy(
            'blp_taxonomy',
            [
                'blp_post_type' // Change to your post type name.
            ],
            $options
        );

    }

}

// Run the class.
$blp_taxes = new Taxes_Register;