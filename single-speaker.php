<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package The_Keynote
 */

get_header(); ?>

<div class="title-with-background" style="background-image: url(<?php echo get_template_directory_uri() . '/images/page-title-background.jpg'?>)">
	<div class="row column">
	<?php the_title( '<h1>', '</h1>' ); ?>
	</div>
</div>

<div class="row single-speaker-row">
	<div class="column large-3 medium-2 small-12">
		<div class="blue-title">
			<?php the_title( '<span>', '</span>' ); ?>
		</div>
	</div>
	<div id="primary" class="content-area column large-9 medium-10 small-12">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

			<h4 class="bio">Biography</h4>

			<div class="speaker-image">
				<?php the_post_thumbnail(); ?>
			</div>

			<div class="meta-after-image">
				<?php the_title( '<strong>', '</strong>' ); ?>
				<br>
				<?php
				$sessions_group = get_post_meta( get_the_ID(), 'sessions_group', true );
				?>
				<strong><?php echo esc_html( $sessions_group['speaker_position'] ); ?></strong>
				<br>
				<strong><?php echo esc_html( $sessions_group['speaker_position_2'] ); ?></strong>
			</div>

			<div class="speaker-description">
				<?php the_content(); ?>
			</div>

			<div class="speaker-for-session">
			<div class="row">
			<?php
			$speaker_id    = $post->ID;
			$session_args  = array(
				'post_type' => 'session',
			);

			$session_query = new WP_Query( $session_args );

			if ( $session_query->have_posts() ) {
				while ( $session_query->have_posts() ) {
					$session_query->the_post();

					$sessions_group = get_post_meta( get_the_ID(), 'sessions_group_session_speakers', true );
					$sessions_time  = get_post_meta( get_the_ID(), 'sessions_group_session_time', true );

					if ( in_array( $speaker_id, $sessions_group, true ) ) {
						echo '<div class="column large-6">';
						echo '<div class="speaker-session-container">';
						echo '<div class="black-session-title">';
						echo '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
						echo '</div>';
						echo '<div class="black-session-time"><i class="fa fa-clock-o"></i>' . esc_html( $sessions_time ) . '</div>';
						echo '</div>';
						echo '</div>';
					}
				}

				wp_reset_postdata();
			}
			?>
			</div>
			</div>
	
		<?php endwhile; wp_reset_postdata(); endif ?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div>

<?php
get_footer();
