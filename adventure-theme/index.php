<?php
    /*
     *Template Name: Home Page
     *
     */
    
    get_header();
?>
<div class="home">
    <div class="hero-image" style="background-image: linear-gradient(-35deg, <?php echo get_theme_mod('dark_color', '#0F5154'); ?>25, <?php echo get_theme_mod('dark_color', '#0F5154'); ?>95), url(<?php the_field('hero_photo'); ?>);">
        <div class="hero-overlay">
            <?php the_field('hero_overlay'); ?>
        </div>
    </div>
    <div class="about-row" id="about">
      <div class="about-info">
        <?php the_field('about_me'); ?>
      </div>
      <div class="about-image" style="background-image: url(<?php the_field('about_image'); ?>);"></div>
    </div>
    <div class="map-section" id="locations" ng-controller="postsCtrl">
      <div class="title"></div>
      <div class="map" ng-init="initMap();">
        <div id="map"></div>
      </div>
      <div class="locations-grid container">
<?php   $args = array (
            'posts_per_page' => 24
        );

        $the_query = new WP_Query( $args );

        if ( $the_query->have_posts() ) :
                echo '<ul>';
                
                while ( $the_query->have_posts() ):
                    $the_query->the_post();
 ?>
        <li class="location-tile">
            <a class="location-link" href="<?php the_permalink(); ?>">
                <div class="location-hover" >
                    <div class="location-info">
                        <h2><?php the_title(); ?></h2>
                        <h4><?php the_date('F Y'); ?></h4>
                    </div>
                </div>
                <div class="location-image" style="background-image: url(<?php the_field('thumbnail_image'); ?>"></div>
            </a>
        </li>
 <?php          endwhile;
                echo '</ul>';

                wp_reset_postdata();
        endif;
?>
      </div>
    </div>
</div>
<?php get_footer(); ?>