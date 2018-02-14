<?php
    /*
     *Template Name: Sitemap Page
     *
     */
    
    get_header();
    
    while ( have_posts() ) : the_post();
?>

<div class="content-container container">
    <h1><?php the_title(); ?></h1>
    <div class="content">
        <h3>Pages</h3>
        <ul>
 <?php  wp_list_pages(
            array(
                'exclude' => '',
                'title_li' => '',
	    )
	);
 ?>          
        </ul>

        <h3>Posts</h3>
        <ul>
<?php   $sitemaploopposts = new WP_Query( array( 
                        'post_type' => 'post', 
                        'posts_per_page' => -1, 
                        'post_status' => 'publish' 
        ));
        while ( $sitemaploopposts->have_posts() ) : $sitemaploopposts->the_post();
?>
            <li>
                <a href="<?php echo get_permalink($post->ID); ?>" rel="dofollow" title="<?php the_title(); ?>"><?php the_title(); ?></a>
            </li>
                        
<?php   endwhile;
        wp_reset_query();
?>            
        </ul>
    </div>
</div>

<?php   endwhile;
        get_footer();
?>
