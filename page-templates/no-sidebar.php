<?php
/**
 * Template Name: No Sidebar
 *
 * @package The_Keynote
 */

get_header(); ?>

<div class="row">
	<div id="primary" class="content-area column large-12 medium-12 small-12">
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
</div>

<?php
get_footer();
