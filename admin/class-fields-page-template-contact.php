<?php
/**
 * Fields page templates class
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
 * Fields page templates class
 *
 * @since  1.0.0
 * @access public
 */
final class Fields_Page_Templates {

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

			// Register contact page template fields.
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
	 * Register contact page template fields
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	private function contact_template_fields() {

		if ( function_exists( 'acf_add_local_field_group' ) ) :

			// Convert slug to ID for location value.
			$slug = get_page_by_path( 'contact' );
			$id   = $slug->ID;

			acf_add_local_field_group( [
				'key'    => 'group_5d7bb8902c1b4',
				'title'  => __( 'Contact Page', 'beeline-plugin' ),
				'fields' => [
					[
						'key'               => 'field_5d7c0409ac6cb',
						'label'             => __( 'Contact Information', 'beeline-plugin' ),
						'name'              => 'bl_contact_info',
						'type'              => 'wysiwyg',
						'instructions'      => __( 'Use for any message or contact details other than individual contact information. See below to add individual contacts.', 'beeline-plugin' ),
						'required'          => 0,
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
					[
						'key'               => 'field_5d82aa93507ed',
						'label'             => __( 'Contact', 'beeline-plugin' ),
						'name'              => 'bl_contact_team_member',
						'type'              => 'post_object',
						'instructions'      => __( '', 'beeline-plugin' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'post_type'         => [
							0 => 'team',
						],
						'taxonomy'          => '',
						'allow_null'        => 0,
						'multiple'          => 1,
						'return_format'     => 'object',
						'ui'                => 1,
					],
					[
						'key'               => 'field_5d82a92ef80f1',
						'label'             => __( 'Contact Form Shortcode', 'beeline-plugin' ),
						'name'              => 'bl_contact_shortcode',
						'type'              => 'text',
						'instructions'      => __( 'Paste the form shortcode from the "Contact" menu at left.', 'beeline-plugin' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'default_value'     => '',
						'placeholder'       => '[contact-form-7 id="00" title="Example Form Title"]',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					],
					[
						'key'               => 'field_5d82a967f80f2',
						'label'             => __( 'Contact Form Message', 'beeline-plugin' ),
						'name'              => 'bl_contact_message_form',
						'type'              => 'wysiwyg',
						'instructions'      => __( 'Use for any message regarding the contact form.', 'beeline-plugin' ),
						'required'          => 0,
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
							'param'    => 'page_template',
							'operator' => '==',
							'value'    => 'page-contact.php',
						],
					],
					[
						[
							'param'    => 'page_template',
							'operator' => '==',
							'value'    => 'page-templates/contact-page.php',
						],
					],
					[
						[
							'param'    => 'page',
							'operator' => '==',
							'value'    => $id,
						],
					]
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
					5 => 'author',
					6 => 'format',
					7 => 'categories',
					8 => 'tags',
					9 => 'send-trackbacks',
				],
				'active'      => true,
				'description' => __( 'For the contact page template and/or contact page slug.', 'beeline-plugin' ),
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
function blp_fields_page_templates() {

	return Fields_Page_Templates::instance();

}

// Run an instance of the class.
blp_fields_page_templates();