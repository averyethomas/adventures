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
function social_nav()
{
    wp_nav_menu(
    array(
        'theme_location'  => 'social-menu',
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
            'main-menu'	  => __( 'Main Menu' ),
	    'footer-menu' => __( 'Footer Menu' ),
	    'social-menu' => __( 'Social Menu' )
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
		body .home .map-section .locations-grid .location-tile .location-link .location-hover{ background: <?php echo get_theme_mod('dark_color', '#0F5154'); ?>25;}
		body .home .map-section .locations-grid .location-tile .location-link .location-hover:hover{ background: linear-gradient( <?php echo get_theme_mod('dark_color', '#0F5154'); ?>30, <?php echo get_theme_mod('dark_color', '#0F5154'); ?>75 75%);}
		body .single .map-button{border: 3px solid <?php echo get_theme_mod('dark_color', '#0F5154'); ?>;}
		body .single .map-button:hover{border: 3px solid <?php echo get_theme_mod('highlight_color', '#87b401'); ?>;}
		body footer{ background-color: <?php echo get_theme_mod('dark_color', '#0F5154'); ?>;}


	</style>
	<?php
}

add_action( 'wp_head', 'mytheme_customize_css');

//REQUIRED PLUGINS

require_once get_template_directory() . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'adventure_theme_register_required_plugins' );

function adventure_theme_register_required_plugins(){
	
	$plugins = array(
		array(
			'name' => 'Advanced Custom Fields Pro',
			'slug' => 'advanced-custom-fields-pro',
			'source' => get_template_directory() . '/plugins/advanced-custom-fields-pro.zip',
			'required' => true,
		),
		array(
			'name' => 'ACF to REST API',
			'slug' => 'acf-to-rest-api',
			'required' => true,
		),
		array(
			'name' => 'Compress JPEG & PNG Images',
			'slug' => 'tiny-compress-images',
			'required' => false,
		),
	);
	
	$config = array(
		'id'           => 'adventure-theme',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);
	
	tgmpa( $plugins, $config );

};

function dec_latlng($dec){
	$vars = explode('.', $dec);
	$deg = $vars[0];
	$tempma = '0.' . $vars[1];
	
	$tempma = $tempma * 3600;
	$min = floor($tempma / 60);
	$sec = $tempma - ($min * 60);
	
	return array('deg' => $deg, 'min' => $min, 'sec' => $sec);
}

function full_latlng($lat, $lng){

	$latpos = (strpos($lat, '-') !== false) ? 'S' : 'N';
	$lat = dec_latlng($lat);
		
	$lngpos = (strpos($lng, '-') !== false) ? 'W' : 'E';
	$lng = dec_latlng($lng);
	
	return abs($lat['deg']) . '&deg ' . $lat['min'] . '&apos; ' . round($lat['sec'], 2) . '&quot ' . $latpos . ' | ' . abs($lng['deg']) . '&deg ' . $lng['min'] . '&apos; ' . round($lng['sec'], 2) . '&quot ' .  $lngpos;
 }
?>