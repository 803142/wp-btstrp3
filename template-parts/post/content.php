<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php $a=wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'thumbnail');?>
	
	<?php if ( !is_single() ) : ?>
	<div class="row">		
            <?php the_title( '<h3 >', '</h3>' ); ?>
            <div class="col-md-4 ">
		<img class="img-responsive mw-100" <?php echo 'src="'.$a[0] ?> " alt="">
	</div>	
	    	
	
	<div class="col-md-8">
		
        <?php endif; ?>
        	
	<!-- .entry-content -->

			<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( '<h4 class="card-title"> "%s"</h4>', '803142' ),
				get_the_title()
			) );
			wp_link_pages( array(
				'before'      => '<div class="caption">' . __( 'Pages:', '803142' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );
			?>
            <?php if ( !is_single() ) : ?>
			</div></div>
            <?php endif; ?>
			
			<hr>
</article><!-- #post-## -->
