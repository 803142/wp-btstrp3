 <?php
/*
Display by Category - home.php WordPress template.

This custom template incorporates a custom post loop which displays
posts organized by category.  Layout based on the WordPress Default
(Kubrick) 1.5 theme templates.

Kaf Oseo (http://szub.net)
*/
?>
<?php get_header(); ?>

    <div id="content" class="narrowcolumn">

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
    <?php if($first) { echo ' | '; } $first++; ?><a href="#cat-<?php echo $current_cat; ?>"><?php echo get_the_category_by_id($current_cat); ?></a>
<?php endforeach; ?>
    </p>

<?php
/* start of 'display by category' loop */
    foreach($cats as $current_cat) :
?>
        <h2 style="text-align: center; background-color: #48b; margin: 0 -20px 0 -20px;" id="cat-<?php echo $current_cat; ?>"><a style="color: #fff;" href="<?php echo get_category_link($current_cat); ?>" title="View all posts in <?php echo get_the_category_by_id($current_cat); ?>"><?php echo get_the_category_by_id($current_cat); ?></a></h2>
<?php
/* post loop for each category listing */
        foreach($posts as $post) :
            the_post();
            $category = get_the_category();
            if($current_cat == $category[0]->cat_ID) : // if post is in correct category
?>
            <div class="post" id="post-<?php the_ID(); ?>">
                <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
                <small><?php the_time('F jS, Y') ?> <!-- by <?php the_author() ?> --></small>

                <div class="entry">
                    <?php the_content('Read the rest of this entry &raquo;'); ?>
                </div>

                <p class="postmetadata"><?php edit_post_link('Edit','','<strong>|</strong>'); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
            </div>
<?php
            endif; // end 'if post in correct category'
        endforeach; // end post loop

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

    </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?> 