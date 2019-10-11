<?php
/**
 * Fields post type team class
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
 * Fields post type team class
 *
 * @since  1.0.0
 * @access public
 */
final class Fields_Post_Type_Team {

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

			// Register team post type fields.
    		$instance->team_fields();

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
	 * Register team post type fields
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function team_fields() {

		if ( function_exists( 'acf_add_local_field_group' ) ) :

			acf_add_local_field_group( [
				'key'    => 'group_5d8268544debd',
				'title'  => __( 'Team Members', 'beeline-plugin' ),
				'fields' => [
					[
						'key'               => 'field_5d8269361da81',
						'label'             => __( 'Title/Position', 'beeline-plugin' ),
						'name'              => 'team_title',
						'type'              => 'text',
						'instructions'      => __( 'Required.', 'beeline-plugin' ),
						'required'          => 1,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'default_value'     => '',
						'placeholder'       => __( '', 'beeline-plugin' ),
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					],
					[
						'key'               => 'field_5d82698b1da83',
						'label'             => __( 'Featured Text', 'beeline-plugin' ),
						'name'              => 'team_summary',
						'type'              => 'text',
						'instructions'      => __( 'Optional. Add a blurb or a quote or brief summary.', 'beeline-plugin' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'default_value'     => '',
						'placeholder'       => __( '', 'beeline-plugin' ),
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					],
					[
						'key'               => 'field_5d7bc2ce0933e',
						'label'             => __( 'Email Address', 'beeline-plugin' ),
						'name'              => 'team_contact_email',
						'type'              => 'email',
						'instructions'      => __( '', 'beeline-plugin' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'default_value'     => '',
						'placeholder'       => __( '', 'beeline-plugin' ),
						'prepend'           => '',
						'append'            => '',
					],
					[
						'key'               => 'field_5d7bc2f40933f',
						'label'             => __( 'Phone Numbers', 'beeline-plugin' ),
						'name'              => 'team_contact_numbers',
						'type'              => 'repeater',
						'instructions'      => __( 'Make sure to keep the number format consistent for all numbers.', 'beeline-plugin' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'collapsed'         => 'field_5d7bc34109340',
						'min'               => 0,
						'max'               => 0,
						'layout'            => 'row',
						'button_label'      => __( 'Add Number', 'beeline-plugin' ),
						'sub_fields'        => [
							[
								'key'               => 'field_5d7bc34109340',
								'label'             => __( 'Number', 'beeline-plugin' ),
								'name'              => 'team_contact_number',
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
								'placeholder'       => __( '', 'beeline-plugin' ),
								'prepend'           => '',
								'append'            => '',
								'maxlength'         => '',
							],
						],
					],
					[
						'key'               => 'field_5d826a0f1da84',
						'label'             => __( 'Photo', 'beeline-plugin' ),
						'name'              => 'team_photo',
						'type'              => 'image',
						'instructions'      => __( 'Minimum 512 pixels wide by 512 pixels high.', 'beeline-plugin' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'return_format'     => 'array',
						'preview_size'      => 'thumbnail',
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
						'key'               => 'field_5d8269531da82',
						'label'             => __( 'Bio', 'beeline-plugin' ),
						'name'              => 'team_bio',
						'type'              => 'wysiwyg',
						'instructions'      => __( 'Required. If you include headings, make sure to use only h2 or lower; h1 is reserved for the page title (team member name) above.', 'beeline-plugin' ),
						'required'          => 1,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'default_value'     => '',
						'tabs'              => 'all',
						'toolbar'           => 'full',
						'media_upload'      => 1,
						'delay'             => 0,
					],
				],
				'location' => [
					[
						[
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'team',
						],
					],
				],
				'menu_order'            => 0,
				'position'              => 'acf_after_title',
				'style'                 => 'seamless',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => [
					0  => 'the_content',
					1  => 'excerpt',
					2  => 'discussion',
					3  => 'comments',
					4  => 'revisions',
					5  => 'slug',
					6  => 'author',
					7  => 'format',
					8  => 'categories',
					9  => 'tags',
					10 => 'send-trackbacks',
				],
				'active'      => true,
				'description' => __( 'For the Team Members post type.', 'beeline-plugin' ),
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
function blp_fields_post_type_team() {

	return Fields_Post_Type_Team::instance();

}

// Run an instance of the class.
blp_fields_post_type_team();