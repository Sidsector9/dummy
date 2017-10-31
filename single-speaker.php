<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package The_Keynote
 */

get_header(); ?>

<div class="row">
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
	
		<?php endwhile; endif ?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div>

<?php
get_footer();
