<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package    Beeline_Plugin
 * @subpackage Admin
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

/**
 * Uninstall avatars.
 *
 * During uninstallation, remove the custom field from the users
 * and delete the local avatars.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function blp_user_avatars_uninstall() {

	$blp_user_avatars = new blp_user_avatars;
	$users            = get_users_of_blog();

	foreach ( $users as $user ) {
		$blp_user_avatars->avatar_delete( $user->user_id );
	}

	delete_option( 'blp_user_avatars_caps' );

}
register_uninstall_hook( __FILE__, 'blp_user_avatars_uninstall' );