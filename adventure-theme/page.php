<?php
    /*
     *Template Name: Single Page
     *
     */
    
    get_header();
    
    while ( have_posts() ) : the_post();
?>

<div ng-cloak class="content-container container">
    <h1><?php the_title(); ?></h1>
    <div class="content">
        <?php the_content(); ?>
    </div>
</div>

<?php   endwhile;
        get_footer();
?>
