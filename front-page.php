<?php get_header(); ?>

<div id="content" class="container">

<?php
/* start of The Loop, Display by Category style */
    if (have_posts()) :
?>

<?php
/* collect categories */
        foreach($posts as $post) :
            $category = get_the_category();
            $cats[$category[0]->cat_ID] = $category[0]->cat_name;
        endforeach;

/* uncomment next line to have categories sort alphabetically */
//    uasort($cats, strcasecmp);

    $cats = array_flip($cats);
?>
<p style="text-align: center; font-size: 90%;">
<strong>Categories on this page:</strong><br />
<?php
/* displays category anchor link 'navigation bar' */
    foreach($cats as $current_cat) :
?>
    <?php if($first) { echo ' | '; } $first++; ?><a href="category/<?php echo get_cat_slug($current_cat); ?>"><?php echo get_the_category_by_id($current_cat); ?></a>
<?php endforeach; ?>
    </p>

<?php
/* start of 'display by category' loop */
    foreach($cats as $current_cat) :
?>
        <h2  id="cat-<?php echo $current_cat; ?>"><a  href="<?php echo get_category_link($current_cat); ?>" title="View all posts in <?php echo get_the_category_by_id($current_cat); ?>"><?php echo get_the_category_by_id($current_cat); ?></a></h2>

<?php/* post loop for each category listing */?>

<div class="row">
<?php       $row3=0;
            foreach($posts as $post) :
            $row3++;
            if ($row3==4):?> </div><div class="row"><?php $row3=0;
            endif ;
            the_post();
            $a=wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'thumbnail');
            $category = get_the_category();
            if($current_cat == $category[0]->cat_ID) : // if post is in correct category
?>
            
              <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                <small style="position: absolute;" class="label label-default label-date"><?php the_time('d-m-Y') ?>
                 <!-- by <?php the_author() ?> --></small>
                <small class="label label-danger label-cat">
                <a  href="<?php echo get_category_link($current_cat);  ?>" style="color:white;" title="View all posts in <?php echo get_the_category_by_id($current_cat); ?>"><?php echo get_the_category_by_id($current_cat); ?></a>
                </small>
                <img class="img-responsive mw-100" <?php echo 'src="'.$a[0] ?> " alt="">
                <div class="caption">
                <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
                <?php the_title('<h3 itemprop="headline">', '</h3>'); ?>                   
                </a>
                    <?php the_excerpt(); ?>
                <?php /*get_template_part( 'sharebutton' )*/ ?></p>
        </div>
                    
                
            </div>
            </div>
<?php
            endif; // end 'if post in correct category'
        endforeach; // end post loop
?>
</div>
<?php
        rewind_posts(); // reset loop for next category
    endforeach; // end 'display by category' loop
?>

        <div class="navigation">
            <div class="alignleft"><?php next_posts_link('&laquo; Previous Entries') ?></div>
            <div class="alignright"><?php previous_posts_link('Next Entries &raquo;') ?></div>
        </div>

    <?php else : // if no posts ?>

        <h2 class="center">Not Found</h2>
        <p class="center">Sorry, but you are looking for something that isn't here.</p>
        <?php include (TEMPLATEPATH . "/searchform.php"); ?>

    <?php endif; // end of The Loop, organized by category style ?>
    <?php get_sidebar(); ?>
    </div>



<?php get_footer(); ?> 