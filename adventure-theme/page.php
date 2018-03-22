<?php
    /*
     *Template Name: Single Page
     *
     */
    
    get_header();
    
    while ( have_posts() ) : the_post();
?>

<div ng-cloak class="content-container container single-page">
    <h1><?php the_title(); ?></h1>
    <div class="content">
<?php   the_content(); 
        if( have_rows('intro_images') ):
            while( have_rows('intro_images') ): the_row(); 
                  if( get_row_layout() == 'single' ):
                        $image = get_sub_field('image');
                        echo '<div class="single">';
                        echo '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" />';
                        echo '</div>';
                  endif;
                  if( get_row_layout() == 'double' ):
                        $imageLeft = get_sub_field('image_left');
                        $imageRight = get_sub_field('image_right');
                        echo '<div class="double">';
                        echo '<img src="' . $imageLeft['url'] . '" alt="' . $imageLeft['alt'] . '" />';
                        echo '<img src="' . $imageRight['url'] . '" alt="' . $imageRight['alt'] . '" />';                              
                        echo '</div>';
                  endif;
                  if( get_row_layout() == 'triple' ):
                        $imageLeft = get_sub_field('image_left');
                        $imageRight = get_sub_field('image_right');
                        $imageCenter = get_sub_field('image_center');
                        echo '<div class="triple">';
                        echo '<img src="' . $imageLeft['url'] . '" alt="' . $imageLeft['alt'] . '" />';
                        echo '<img src="' . $imageCenter['url'] . '" alt="' . $imageCenter['alt'] . '" />';                              
                        echo '<img src="' . $imageRight['url'] . '" alt="' . $imageRight['alt'] . '" />';                              
                        echo '</div>';
                  endif;
                  if( get_row_layout() == 'tall' ):
                        $image = get_sub_field('image');
                        echo '<div class="single">';
                        echo '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" />';
                        echo '</div>';
                  endif;
            endwhile;
      endif; 
?>
    </div>
</div>
<?php   endwhile;
        get_footer();
?>
