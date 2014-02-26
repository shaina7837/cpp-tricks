<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package cpp-tricks
 */

get_header(); 
	do_action( 'before' ); ?>
	<div class="home-background"><?php the_post_thumbnail( 'single-post-thumbnail' ); ?>
</div>
	<div class="polythene-cover"></div>
        <div class="half-page cover">
                <div class="cover-logo-container">
                        <div class="logo">
                                }
                        </div><!--logo-->
                        <h1 class="name">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                        </h1>
                </div><!--cover-logo-container-->

                <?php
                $latestPost = get_posts('numberposts=1&order=DEC&orderby=date');
                foreach ($latestPost as $post): setup_postdata($post);
                ?>
                <div class="cover-post-title">
                <div class="cover-post-meta"><?php the_time(get_option('date_format')) ?></div>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<div class="cover-post-excerpt"><?php echo substr(get_the_excerpt(), 0,100); ?></div>
                
                </div><!--cover-post-title-->
                <?php endforeach; ?>
        </div><!--half-page cover-->

	<div id="content" class="site-content">

	<div id="primary" class="half-page first-page">
		<main id="main" class="site-main" role="main">
		
		<h2 class="serif-title first-page-title">
			Recent Posts
		</h2>
		<div class="post-list">
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				
			<!--		/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */-->
				
					<h3><a href='<?php the_permalink(); ?>' class="post-title"><?php the_title(); ?></a></h3>
					<p class="post-meta"><?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?> by <?php the_author() ?></p>
					<?php //get_template_part( 'content', get_post_format() );// ?>
				

			<?php endwhile; ?>
		</div><!--post-list-->
			<?php cpp_tricks_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	</div><!--half-page first-page-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
