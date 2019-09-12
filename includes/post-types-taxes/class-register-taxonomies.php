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
         * Client Type: Client Type
         */

        $labels = [
            'name'                       => __( 'Client Types', 'beeline-plugin' ),
            'singular_name'              => __( 'Client Type', 'beeline-plugin' ),
            'menu_name'                  => __( 'Client Types', 'beeline-plugin' ),
            'all_items'                  => __( 'All Client Types', 'beeline-plugin' ),
            'edit_item'                  => __( 'Edit Client Type', 'beeline-plugin' ),
            'view_item'                  => __( 'View Client Type', 'beeline-plugin' ),
            'update_item'                => __( 'Update Client Type', 'beeline-plugin' ),
            'add_new_item'               => __( 'Add New Client Type', 'beeline-plugin' ),
            'new_item_name'              => __( 'New Client Type', 'beeline-plugin' ),
            'parent_item'                => __( 'Parent Client Type', 'beeline-plugin' ),
            'parent_item_colon'          => __( 'Parent Client Type', 'beeline-plugin' ),
            'popular_items'              => __( 'Popular Client Types', 'beeline-plugin' ),
            'separate_items_with_commas' => __( 'Separate Client Types with commas', 'beeline-plugin' ),
            'add_or_remove_items'        => __( 'Add or Remove Client Types', 'beeline-plugin' ),
            'choose_from_most_used'      => __( 'Choose from the most used Client Types', 'beeline-plugin' ),
            'not_found'                  => __( 'No Client Types Found', 'beeline-plugin' ),
            'no_terms'                   => __( 'No Client Types', 'beeline-plugin' ),
            'items_list_navigation'      => __( 'Client Types List Navigation', 'beeline-plugin' ),
            'items_list'                 => __( 'Client Types List', 'beeline-plugin' )
        ];

        $options = [
            'label'              => __( 'Client Types', 'beeline-plugin' ),
            'labels'             => $labels,
            'public'             => true,
            'hierarchical'       => false,
            'label'              => 'Client Types',
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_nav_menus'  => true,
            'query_var'          => true,
            'rewrite'            => [
                'slug'         => 'client-type',
                'with_front'   => true,
                'hierarchical' => false,
            ],
            'show_admin_column'  => true,
            'show_in_rest'       => true,
            'rest_base'          => 'client_types',
            'show_in_quick_edit' => true
        ];

        /**
         * Register the taxonomy
         */
        register_taxonomy(
            'client_type',
            [
                'client'
            ],
            $options
        );

    }

}

// Run the class.
$blp_taxes = new Taxes_Register;