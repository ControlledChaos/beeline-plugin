<?php
/**
 * Contact page content
 *
 * @package    WordPress/ClassicPress
 * @subpackage Beeline_Theme
 * @since      1.0.0
 */

// Begin contacts repeater fields.
if ( have_rows( 'bl_contacts' ) ) : ?>
<style>
.contacts-list span {
	display: block;
}
</style>
<ul class="contacts-list">
	<?php while ( have_rows( 'bl_contacts' ) ) : the_row(); ?>
	<li>
		<p>
			<span class="contact-name"><?php the_sub_field( 'bl_contact_name' ); ?></span>
			<span class="contact-title"><?php the_sub_field( 'bl_contact_title' ); ?></span>
		<?php if ( have_rows( 'bl_contact_numbers' ) ) : ?>
			<?php while ( have_rows( 'bl_contact_numbers' ) ) : the_row(); ?>
			<span class="contact-number">
				<?php echo sprintf(
					'<a href="tel:%1s">%2s</a>',
					get_sub_field( 'bl_contact_number' ),
					get_sub_field( 'bl_contact_number' )
				); ?>
			</span>
			<?php endwhile; ?>
		<?php endif; ?>
			<span class="contact-email">
				<?php echo sprintf(
					'<a href="mailto:%1s">%2s</a>',
					get_sub_field( 'bl_contact_email' ),
					get_sub_field( 'bl_contact_email' )
				); ?>
			</span>
		</p>
	</li>
	<?php endwhile; ?>
</ul>

<?php else :
	echo sprintf(
		'<h2>%1s</h2>',
		__( 'No contact information found.', 'beeline-plugin' )
	);
endif;