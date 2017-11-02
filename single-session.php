<?php
get_header();
?>

<div class="title-with-background" style="background-image: url(<?php echo get_template_directory_uri() . '/images/page-title-background.jpg'?>)">
	<div class="row column">
	<?php the_title( '<h1>', '</h1>' ); ?>
	</div>
</div>

<div class="row">
	<div class="column large-3 medium-3 small-3">
		<?php $sessions_meta = get_post_meta( $post->ID, 'sessions_group', true ); ?>

		<div class="session-meta session-date">
		<?php
		$timestamp = $sessions_meta['session_date'];
		if ( ! empty( $timestamp ) ) {
			echo '<i class="fa fa-calendar" aria-hidden="true"></i> ' . esc_html( date_i18n( get_option( 'date_format' ), $timestamp ) );
		}
		?>
		</div>
		<div class="session-meta session-time">
			<?php
			$session_time = $sessions_meta['session_time'];
			if ( ! empty( $session_time ) ) {
				echo '<i class="fa fa-clock-o"></i>' . esc_html( $session_time );
			}
			?>
		</div>
		<div class="session-meta session-location">
			<?php
			$session_location = $sessions_meta['session_location'];
			if ( ! empty( $session_location ) ) {
				echo '<i class="fa fa-location-arrow"></i>' . esc_html( $session_location );
			}
			?>
		</div>
		<div class="session-meta session-speakers">
			<div class="speakers-list-icon">
			<?php
			if ( ! empty( $sessions_meta['session_speakers'] ) ) {
				echo '<i class="fa fa-user"></i>';
			}
			?>
			</div>
			<div class="speakers-list">
			<?php
			foreach ( $sessions_meta['session_speakers'] as $speaker_id ) {
				echo '<div>' . get_the_title( $speaker_id ) . '</div>';
			}
			?>
			</div>
		</div>
	</div>
	<div class="column large-9 medium-9 small-9">
		<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; endif; ?>
	</div>
</div>

<?php
get_footer();
