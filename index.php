<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

      <!-- Main hero unit for a primary marketing message or call to action -->
     
      	<div class="container">
      	<?php if ( is_home() && ! is_front_page() ) : ?>
			
			<h1 ><?php single_post_title(); ?></h1>
			
		<?php else : ?>
			
			<h2 ><?php _e( 'Posts', '803142' ); ?></h2>
			
		<?php endif; ?>
		
        <?php
			if ( have_posts() ) :

				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/post/content', get_post_format() );

				endwhile;

				
			else :

				echo 'empty';

			endif;
			?>
		
			
      </div>

<?php get_footer(); ?>
