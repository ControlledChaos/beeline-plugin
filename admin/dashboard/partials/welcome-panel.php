<?php
/**
 * Custom welcome panel output.
 *
 * Provided are several widget areas and hooks for adding content.
 * The `do_action` hooks are named and placed to be similar to the
 * before and after pseudoelements in CSS.
 *
 * @package    Beeline_Plugin
 * @subpackage Admin\Dashboard
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

namespace Beeline_Plugin\Admin\Dashboard;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Get the current user name for the greeting.
$current_user = wp_get_current_user();
$user_name    = $current_user->display_name;

// Add a filterable description.
$about_desc = apply_filters( 'beeline_welcome_about', __( 'Following are some handy links to help you publish content and manage the website.', 'beeline-plugin' ) );

// Get pages by slug.
$about_page  = get_page_by_path( 'about' );
$contact_page = get_page_by_path( 'contact' );

if ( $about_page ) {
    $about_link   = admin_url( 'post.php?post=' . $about_page->ID . '&action=edit' );
} else {
    $about_link = '';
}

if ( $contact_page ) {
    $contact_link   = admin_url( 'post.php?post=' . $contact_page->ID . '&action=edit' );
} else {
    $contact_link = '';
} ?>
<?php echo sprintf(
	'<h2>%1s %2s.</h2>',
	esc_html__( 'Welcome,', 'beeline-plugin' ),
	$user_name
); ?>
<p class="description about-description"><?php echo $about_desc; ?></p>
<div class="beeline-dashboard-summary">
    <?php wp_dashboard_right_now(); ?>
</div>
<?php
if ( has_header_image() ) {
	// the_header_image_tag();
} ?>
<div class="beeline-dashboard-post-managment">
    <header class="beeline-dashboard-section-header">
        <h3><?php _e( 'Manage Content', 'beeline-plugin' ); ?></h3>
	</header>
    <ul class="beeline-dashboard-post-type-actions">
		<li>
            <h4><?php _e( 'Media', 'beeline-plugin' ); ?></h4>
            <div class="beeline-dashboard-content-actions-icon front-icon"><span class="dashicons dashicons-format-image"></span></div>
            <p>
                <a href="<?php echo admin_url( 'media-new.php' ); ?>"><?php _e( 'Add New', 'beeline-plugin' ); ?></a>
                <a href="<?php echo admin_url( 'upload.php' ); ?>"><?php _e( 'Manage', 'beeline-plugin' ); ?></a>
            </p>
		</li>
        <li>
            <h4><?php _e( 'Clients', 'beeline-plugin' ); ?></h4>
            <div class="beeline-dashboard-post-type-actions-icon clients-icon"><span class="dashicons dashicons-archive"></span></div>
            <p>
                <a href="<?php echo admin_url( 'post-new.php?post_type=client' ); ?>"><?php _e( 'Add New', 'beeline-plugin' ); ?></a>
                <a href="<?php echo admin_url( 'edit.php?post_type=client' ); ?>"><?php _e( 'View List', 'beeline-plugin' ); ?></a>
            </p>
        </li>
		<li>
            <h4><?php _e( 'Client Types', 'beeline-plugin' ); ?></h4>
            <div class="beeline-dashboard-post-type-actions-icon client-types-icon"><span class="dashicons dashicons-category"></span></div>
            <p>
                <a href="<?php echo admin_url( 'edit-tags.php?taxonomy=client_type&post_type=client' ); ?>"><?php _e( 'Manage Types', 'beeline-plugin' ); ?></a>
            </p>
        </li>
		<li>
            <h4><?php _e( 'Team', 'beeline-plugin' ); ?></h4>
            <div class="beeline-dashboard-post-type-actions-icon team-icon"><span class="dashicons dashicons-groups"></span></div>
            <p>
                <a href="<?php echo admin_url( 'post-new.php?post_type=team' ); ?>"><?php _e( 'Add New', 'beeline-plugin' ); ?></a>
                <a href="<?php echo admin_url( 'edit.php?post_type=team' ); ?>"><?php _e( 'View List', 'beeline-plugin' ); ?></a>
            </p>
        </li>
		<li>
            <h4><?php _e( 'Contact', 'beeline-plugin' ); ?></h4>
            <div class="beeline-dashboard-content-actions-icon email-icon"><span class="dashicons dashicons-email"></span></div>
            <p>
                <a href="<?php echo admin_url( 'admin.php?page=wpcf7' ); ?>"><?php _e( 'Forms', 'beeline-plugin' ); ?></a>
				<a href="<?php echo $contact_link; ?>"><?php _e( 'Page', 'beeline-plugin' ); ?></a>
            </p>
        </li>
		<li>
            <h4><?php _e( 'About', 'beeline-plugin' ); ?></h4>
            <div class="beeline-dashboard-content-actions-icon about-icon"><span class="dashicons dashicons-flag"></span></div>
            <p>
                <a href="<?php echo $about_link; ?>"><?php _e( 'Edit Content', 'beeline-plugin' ); ?></a>
            </p>
        </li>
		<li>
            <h4><?php _e( 'News Posts', 'beeline-plugin' ); ?></h4>
            <div class="beeline-dashboard-post-type-actions-icon posts-icon"><span class="dashicons dashicons-megaphone"></span></div>
            <p>
                <a href="<?php echo admin_url( 'post-new.php' ); ?>"><?php _e( 'Add New', 'beeline-plugin' ); ?></a>
                <a href="<?php echo admin_url( 'edit.php' ); ?>"><?php _e( 'View List', 'beeline-plugin' ); ?></a>
            </p>
		</li>
		<li>
            <h4><?php _e( 'Users', 'beeline-plugin' ); ?></h4>
            <div class="beeline-dashboard-content-actions-icon users-icon"><span class="dashicons dashicons-admin-users"></span></div>
            <p>
                <a href="<?php echo admin_url( 'edit-comments.php' ); ?>"><?php _e( 'Comments', 'beeline-plugin' ); ?></a>
				<a href="<?php echo admin_url( 'users.php' ); ?>"><?php _e( 'Profiles', 'beeline-plugin' ); ?></a>
            </p>
        </li>
    </ul>
</div>