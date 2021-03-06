<?php
/**
 * Template Name: Speakers Listing
 *
 * @package The_Keynote
 */
get_header();

$speakers_args = array(
	'post_type' => 'speaker',
	'orderby'   => 'menu_order',
	'order'     => 'DESC',
);

$speaker_query = new WP_Query( $speakers_args );
?>

<div class="speakers-list-row row">
<?php
$count = 0;
if ( $speaker_query->have_postS() ) :
	while ( $speaker_query->have_posts() ) :
		$speaker_query->the_post();
?>

	<div class="column large-4 medium-6 small-12 end">
		<div class="speaker-box">
			<?php the_post_thumbnail(); ?>
			<div class="speaker-name">
				<?php the_title(); ?>
			</div>

			<div class="company">
			<?php
			$sessions_group = get_post_meta( get_the_ID(), 'sessions_group', true );
			echo esc_html( $sessions_group['company'] );
			?>
			</div>

			<a class="view-more-link" href="<?php the_permalink(); ?>"><?php echo esc_html__( 'View Profile', 'thekeynote' ); ?></a>
		</div>
	</div>
<?php $count++; ?>
<?php
		endwhile;
	endif;
?>
</div>
<?php
get_footer();
