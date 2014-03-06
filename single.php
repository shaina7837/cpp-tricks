<?php
/**
 * The Template for displaying all single posts.
 *
 * @package cpp-tricks
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
			<div class="featured-image"><?php the_post_thumbnail( 'single-post-thumbnail' ); ?></div>

			<div class="single-post-header" style="background:url('<?php //the_post_thumbnail( 'single-post-thumbnail'); ?>')">

			<div class="single-post-title"><?php the_title(); ?></div>
			<div class="single-post-meta"><?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?> by <?php the_author() ?></div> 
			</div>
			<div class="single-post-content">
				<div class="text"><?php the_content(); ?></div><!--text-->
			</div><!--single-post-content-->
			
			<?php cpp_tricks_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
