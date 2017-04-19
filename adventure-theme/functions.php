<?php
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M' );
@ini_set( 'max_execution_time', '300' );
class wp_ng_theme {
	function enqueue_scripts() {
		wp_enqueue_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.map', array('jquery'), '1.0', false);
		wp_enqueue_script( 'angular-core', 'https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.7/angular.min.js', array( 'jquery' ), '1.0', false );
		wp_enqueue_script( 'angular-resource', 'https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.0-rc.0/angular-resource.min.js', array('angular-core'), '1.0', false);
		wp_enqueue_script( 'angular-sanitize', 'https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.0-rc.0/angular-sanitize.min.js', array('angular-core'), '1.0', false);
		wp_enqueue_script( 'ngScripts', get_template_directory_uri() . '/scripts/app.js', array( ), '1.0', false );
		wp_localize_script( 'ngScripts', 'appInfo',
			array(
				'api_url'			 => rest_get_url_prefix() . '/wp/v2/',
				'template_directory' => get_template_directory_uri() . '/',
				'nonce'				 => wp_create_nonce( 'wp_rest' ),
				'is_admin'			 => current_user_can('administrator')
			)
		);
	}
}
$ngTheme = new wp_ng_theme();
add_action( 'wp_enqueue_scripts', array( $ngTheme, 'enqueue_scripts' ) );

// NAVIGATION
function main_nav()
{
    wp_nav_menu(
    array(
        'theme_location'  => 'main-menu',
        'menu'            => '',
        'container'       => false,
        'container_class' => '',
        'container_id'    => '',
        'menu_class'      => 'menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '%3$s',
        'depth'           => 0,
        'walker'          => ''
        )
    );
}
function footer_nav()
{
    wp_nav_menu(
    array(
        'theme_location'  => 'footer-menu',
        'menu'            => '',
        'container'       => false,
        'container_class' => '',
        'container_id'    => '',
        'menu_class'      => 'menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '%3$s',
        'depth'           => 0,
        'walker'          => ''
        )
    );
}
function register_main_menu()
{
    register_nav_menus(
        array(
            'main-menu' => __( 'Main Menu' ), // Main Navigation
	    'footer-menu' => __( 'Footer Menu' ), //Footer Navigation
        )
    );
}
add_action( 'init', 'register_main_menu' );

require get_template_directory() . '/customizer.php';

//CUSTOM CSS
function mytheme_customize_css(){
	?>
	<style type="text/css">
		body h1{ color: <?php echo get_theme_mod('dark_color', '#0F5154'); ?>;}
		body h2{ color: <?php echo get_theme_mod('light_color', '#4b8287'); ?>;}
		body h3{ color: <?php echo get_theme_mod('dark_color', '#0F5154'); ?>;}
		body h4{ color: <?php echo get_theme_mod('light_color', '#4b8287'); ?>;}
		body h5{ color: <?php echo get_theme_mod('overlay_text_color', '#FFFFFF'); ?>;}
		body a{ color: <?php echo get_theme_mod('light_color', '#4b8287'); ?>;}
		body a:hover{ color: <?php echo get_theme_mod('highlight_color', '#87b401'); ?>;}
		body p{ color: <?php echo get_theme_mod('dark_color', '#0F5154'); ?>;}
		body .mobile-nav a svg{ fill: <?php echo get_theme_mod('dark_color', '#0F5154'); ?>;}
		body .mobile-nav p span, body .mobile-nav p span::before, body .mobile-nav p span::after{background: <?php echo get_theme_mod('dark_color', '#0F5154'); ?>;}
		body .nav{ background-color: <?php echo get_theme_mod('dark_color', '#0F5154'); ?>;}
		@media all and (min-width: 768px){
			body .nav ul li a:hover{ color: <?php echo get_theme_mod('highlight_color', '#87b401'); ?>;}
			body .nav ul li a{ color: <?php echo get_theme_mod('dark_color', '#0F5154'); ?>;}
		}
		body .nav ul li a svg{ fill: <?php echo get_theme_mod('dark_color', '#0F5154'); ?>;}
		body .nav ul li a svg:hover{ fill: <?php echo get_theme_mod('highlight_color', '#87b401'); ?>;}
		body .home .hero-image .hero-overlay h1{ color: <?php echo get_theme_mod('overlay_text_color', '#FFFFFF'); ?>; }
		body .home .hero-image .hero-overlay ul li{ border-right: 1px solid <?php echo get_theme_mod('overlay_text_color', '#FFFFFF'); ?>; }
		body .home .hero-image .hero-overlay h3{ color: <?php echo get_theme_mod('overlay_text_color', '#FFFFFF'); ?>; }
		body .home .map-section .title{ background-color: <?php echo get_theme_mod('dark_color', '#0F5154'); ?>;}
		body .home .map-section .locations-grid .location-tile .location-hover{ background-color: <?php echo get_theme_mod('dark_color', '#0F5154'); ?>;}
		body .single .map-button{border: 3px solid <?php echo get_theme_mod('dark_color', '#0F5154'); ?>;}
		body .single .map-button:hover{border: 3px solid <?php echo get_theme_mod('highlight_color', '#87b401'); ?>;}
		body footer{ background-color: <?php echo get_theme_mod('dark_color', '#0F5154'); ?>;}


	</style>
	<?php
}

add_action( 'wp_head', 'mytheme_customize_css');

?>