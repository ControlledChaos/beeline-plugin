<?php
/**
 * Team post type singular content
 *
 * @package    Beeline_Plugin
 * @subpackage Frontend
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

// Fields registered by Advanced Custom Fields.
$title   = get_field( 'team_title' );
$summary = get_field( 'team_summary' );
$email   = get_field( 'team_email' );
$numbers = get_field( 'team_contact_numbers' );
$bio     = get_field( 'team_bio' );

$photo   = get_field( 'team_photo' );
$url     = $photo['url'];
$title   = $photo['title'];
$alt     = $photo['alt'];
$size    = 'xlarge-thumbnail';
$thumb   = $photo['sizes'][ $size ];
$width   = $photo['sizes'][ $size . '-width' ];
$height  = $photo['sizes'][ $size . '-height' ];
$default = BLP_URL . '/frontend/assets/images/default-profile-image.jpg';

// Use the profile photo if one is selected.
if ( $thumb ) {
	$src = $thumb;
	$alt = sprintf(
		'%1s%2s',
		get_the_title( $member->ID ),
		__( '&#39;s profile photo', 'beeline-plugin' )
	);
	$image = sprintf(
		'<a href="%1s" data-fancybox data-type="image" data-caption="%2s"><img class="team-photo team-photo-contact" src="%3s" alt="%4s" width="%5s" height="%6s" style="max-width: %7spx" /></a>',
		$url,
		get_the_title(),
		$src,
		$alt,
		$width,
		$height,
		$width
	);
} else {
	$src = $default;
	$alt = sprintf(
		'%1s%2s',
		get_the_title( $member->ID ),
		__( '&#39;s profile photo coming soon', 'beeline-plugin' )
	);
	$image = sprintf(
		'<img class="team-photo team-photo-contact" src="%1s" alt="%2s" width=240px" height="240px" style="max-width: 240px" />',
		$src,
		$alt
	);
}

?>
<div class="team-member-content">
	<div class="team-member-top">
		<div class="team-photo-wrap">
			<figure>
				<?php echo $image; ?>
				<figcaption class="screen-reader-text"><?php echo $alt; ?></figcaption>
			</figure>
		</div>
		<div class="team-info-wrap">
			<h2><?php _e( 'Beeline Team Member', 'beeline-plugin' ); ?></h2>
			<ul>
				<li class="member-name"><?php echo get_the_title(); ?></li>
				<li class="member-title"><?php the_field( 'team_title' ); ?></li>
				<?php if ( have_rows( 'team_contact_numbers' ) ) : ?>
				<ul class="member-numbers">
					<?php while ( have_rows( 'team_contact_numbers' ) ) : the_row(); ?>
					<li class="member-number">
						<?php echo sprintf(
							'<a href="tel:%1s">%2s</a>',
							get_sub_field( 'team_contact_number' ),
							get_sub_field( 'team_contact_number' )
						); ?>
					</li>
					<?php endwhile; ?>
				</ul>
				<?php endif; ?>
				<li class="member-email">
					<?php echo sprintf(
						'<a href="mailto:%1s">%2s</a>',
						get_field( 'team_contact_email' ),
						get_field( 'team_contact_email' )
					); ?>
				</li>
			</ul>
		</div>
	</div>
	<div class="team-member-bio">
		<?php echo $bio; ?>
	</div>
</div>