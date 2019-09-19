<?php
/**
 * Contact page content
 *
 * @package    WordPress/ClassicPress
 * @subpackage Beeline_Theme
 * @since      1.0.0
 */

// Add a hook for styles or scripts from themes.
do_action( 'blp_contact_page' );
?>
<div class="contact-wrap">
	<div class="contact-info">
		<?php the_field( 'bl_contact_info' ); ?>
	</div>
	<div class="profile-grid-wrap contact-list">
	<?php

	$team = get_field( 'bl_contact_team_member' );

	if ( $team ): ?>
		<ul class="profile-grid">
		<?php foreach( $team as $member ) : ?>
			<li>
				<article class="team-profile">
					<?php
					// Team member profile photo.
					$photo   = get_field( 'team_photo', $member->ID );
					$url     = $photo['url'];
					$title   = $photo['title'];
					$alt     = $photo['alt'];
					$size    = 'thumbnail';
					$thumb   = $photo['sizes'][ $size ];
					$width   = $photo['sizes'][ $size . '-width' ];
					$height  = $photo['sizes'][ $size . '-height' ];
					$default = BLP_URL . '/frontend/assets/images/default-profile-image.jpg';

					// Use the profile photo if one is selected.
					if ( $thumb ) {
						$src = $thumb;
					} else {
						$src = $default;
					}

					?>
					<a class="team-photo-link team-photo-link-contact" href="<?php the_permalink( $member->ID ); ?>">
						<img class="team-photo team-photo-contact" src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" style="max-width: <?php echo get_option( 'thumbnail_size_w' ); ?>px" />
					</a>
					<ul>
						<li class="contact-name"><a href="<?php echo get_permalink( $member->ID ); ?>"><?php echo get_the_title( $member->ID ); ?></a></li>
						<li class="contact-title"><?php the_field( 'team_title', $member->ID ); ?></li>
						<?php if ( have_rows( 'team_contact_numbers', $member->ID ) ) : ?>
						<ul class="contact-numbers">
							<?php while ( have_rows( 'team_contact_numbers', $member->ID ) ) : the_row(); ?>
							<li class="contact-number">
								<?php echo sprintf(
									'<a href="tel:%1s">%2s</a>',
									get_sub_field( 'team_contact_number', $member->ID ),
									get_sub_field( 'team_contact_number', $member->ID )
								); ?>
							</li>
							<?php endwhile; ?>
						</ul>
						<?php endif; ?>
						<li class="contact-email">
							<?php echo sprintf(
								'<a href="mailto:%1s">%2s</a>',
								get_field( 'team_contact_email', $member->ID ),
								get_field( 'team_contact_email', $member->ID )
							); ?>
						</li>
					</ul>
				</article>
			</li>
		<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	</div>
	<?php if ( get_field( 'bl_contact_shortcode' ) ) : ?>
	<div class="contact-form">
		<?php the_field( 'bl_contact_message_form' ); ?>
		<?php echo do_shortcode( get_field( 'bl_contact_shortcode' ) ); ?>
	</div>
	<?php endif; ?>
</div>