<?php
/**
 * Template Name: Left Sidebar
 *
 * @package The_Keynote
 */

get_header(); ?>

	<?php get_sidebar(); ?>
	<div id="primary" class="content-area large-8 small-12 column">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
