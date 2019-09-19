<?php
/**
 * Fields post type client class
 *
 * @package    Beeline_Plugin
 * @subpackage Admin
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 *
 * @todo       Add admin and user access checks.
 */

namespace Beeline_Plugin\Admin;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Fields post type client class
 *
 * @since  1.0.0
 * @access public
 */
final class Fields_Post_Type_Client {

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

			// Register client post type fields.
    		$instance->contact_template_fields();

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
	private function __construct() {}

	/**
	 * Register client post type fields
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function contact_template_fields() {

		if ( function_exists( 'acf_add_local_field_group' ) ) :

			acf_add_local_field_group( [
				'key'    => 'group_5d7bb667c1aa1',
				'title'  => __( 'Clients', 'beeline-plugin' ),
				'fields' => [
					[
						'key'               => 'field_5d7bc9d1a4573',
						'label'             => __( 'Subheading', 'beeline-plugin' ),
						'name'              => 'subheading',
						'type'              => 'text',
						'instructions'      => __( '', 'beeline-plugin' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					],
					[
						'key'               => 'field_5d7bb6bf0a46a',
						'label'             => __( 'Website', 'beeline-plugin' ),
						'name'              => 'client_website',
						'type'              => 'url',
						'instructions'      => __( 'Enter the complete URL (web address).', 'beeline-plugin' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'default_value'     => '',
						'placeholder'       => 'https://example.com',
					],
					[
						'key'               => 'field_5d7bb70b0a46b',
						'label'             => __( 'Featured Image', 'beeline-plugin' ),
						'name'              => 'client_featured_image',
						'type'              => 'image',
						'instructions'      => __( 'Must be at least 1920 pixels wide by 1080 pixels high (HD video aspect ratio).', 'beeline-plugin' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'return_format'     => 'array',
						'preview_size'      => 'video-sm',
						'library'           => 'all',
						'min_width'         => '',
						'min_height'        => '',
						'min_size'          => '',
						'max_width'         => '',
						'max_height'        => '',
						'max_size'          => '',
						'mime_types'        => '',
					],
					[
						'key'               => 'field_5d7bc948fc28e',
						'label'             => __( 'Description or Bio', 'beeline-plugin' ),
						'name'              => 'client_description',
						'type'              => 'wysiwyg',
						'instructions'      => __( '', 'beeline-plugin' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'default_value'     => '',
						'tabs'              => 'all',
						'toolbar'           => 'basic',
						'media_upload'      => 1,
						'delay'             => 0,
					],
				],
				'location' => [
					[
						[
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'client',
						],
					],
				],
				'menu_order'            => 0,
				'position'              => 'acf_after_title',
				'style'                 => 'seamless',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => [
					0 => 'the_content',
					1 => 'discussion',
					2 => 'comments',
					3 => 'revisions',
					4 => 'slug',
					5 => 'format',
					6 => 'categories',
					7 => 'tags',
					8 => 'send-trackbacks',
				],
				'active'      => true,
				'description' => __( 'For the Clients post type.', 'beeline-plugin' ),
			] );

		endif;

	}

}

/**
 * Put an instance of the class into a function.
 *
 * @since  1.0.0
 * @access public
 * @return object Returns an instance of the class.
 */
function blp_fields_post_type_client() {

	return Fields_Post_Type_Client::instance();

}

// Run an instance of the class.
blp_fields_post_type_client();