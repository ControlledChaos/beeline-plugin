<?php
/**
 * About page site settings output.
 *
 * Uses the universal slug partial for admin pages. Set this
 * slug in the core plugin file.
 *
 * @package    Beeline_Plugin
 * @subpackage Admin\Partials
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

namespace Beeline_Plugin\Admin\Partials;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} ?>
<h3><?php _e( 'Website settings', 'beeline-plugin' ); ?></h3>
<?php echo sprintf(
	'<p>%1s <a href="%2s">%3s</a> %4s</p>',
	__( 'The plugin is equipped with', 'beeline-plugin' ),
	esc_url( admin_url( '?page=' . BLP_ADMIN_SLUG . '-settings' ) ),
	__( 'an admin page', 'beeline-plugin' ),
	__( 'for customizing the user interface of WordPress/ClassicPress, as well as other useful features.', 'beeline-plugin' )
 ); ?>
<h3><?php _e( 'Clean Up the Admin', 'beeline-plugin' ); ?></h3>
<ul>
	<li><?php _e( 'Remove dashboard widgets: WordPress/ClassicPress news, quick press', 'beeline-plugin' ); ?></li>
	<li><?php _e( 'Make Menus and Widgets top level menu items', 'beeline-plugin' ); ?></li>
	<li><?php _e( 'Remove select admin menu items', 'beeline-plugin' ); ?></li>
	<li><?php _e( 'Remove WordPress/ClassicPress logo from admin bar', 'beeline-plugin' ); ?></li>
	<li><?php _e( 'Remove access to theme and plugin editors', 'beeline-plugin' ); ?></li>
</ul>
<h3><?php _e( 'Enchance the Admin', 'beeline-plugin' ); ?></h3>
<ul>
	<li><?php _e( 'Add three admin bar menus', 'beeline-plugin' ); ?></li>
	<li><?php _e( 'Add custom post types to the At a Glance widget', 'beeline-plugin' ); ?></li>
	<li><?php _e( 'Custom admin footer message', 'beeline-plugin' ); ?></li>
</ul>