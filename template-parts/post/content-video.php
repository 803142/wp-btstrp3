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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope  itemtype="http://schema.org/TechArticle">

    <?php $a=wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'thumbnail');?>
	
	<?php if ( !is_single() ) : ?>
	 <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
                <?php the_title('<h3 itemprop="headline">', '</h3>'); ?>                   
                </a>
		<div class="row">		
            
        <div class="col-md-4 " >
		<small style="position: absolute;" class="label label-default" itemprop="datePublished"><?php the_time('d-m-Y') ?>
                 <!-- by <?php the_author() ?> --></small>
        
		<img class="img-responsive mw-100" <?php echo 'src="'.$a[0] ?> " alt="" itemprop="image">
		</div>	
	    	
	
		<div class="col-md-8">
	<?php else : ?>	
	<?php the_title( '<h3 itemprop="headline">', '</h3>' ); ?>
		<div class="row" >
		<div class="col-xs-6" >
		<ul class="nav nav-pills navbar-left navbar-default">
		<li class="btn " itemprop="datePublished"><?php the_time('d-m-Y') ?>

                 <!-- by <?php the_author() ?> --></li>

        <?php  if (get_post_format()=='video'):?><li class="btn btn-video" ></li><?php endif; ?>
        </ul>
                 </div>
                 <div class="col-xs-6" ><?php get_template_part( 'sharebutton' ) ?></div>
                 </div>
        
        <img class="img-thumbnail center-block" <?php echo 'src="'.$a[0] ?> " alt="" itemprop="image">
		
		
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
