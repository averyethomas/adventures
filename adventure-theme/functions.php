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

//REQUIRED PLUGINS

require_once get_template_directory() . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'adventure_theme_register_required_plugins' );

function adventure_theme_register_required_plugins(){
	
	$plugins = array(
		array(
			'name' => 'Advanced Custom Fields Pro',
			'slug' => 'advanced-custom-fields-pro',
			'source' => get_template_directory() . 'plugins/advanced-custom-fields-pro.zip',
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

}


if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_58cc37276c1be',
	'title' => 'Home Page',
	'fields' => array (
		array (
			'key' => 'field_58cfeb5154565',
			'label' => 'Hero Photo',
			'name' => 'hero_photo',
			'type' => 'image',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'url',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array (
			'key' => 'field_58cfeb8254566',
			'label' => 'Hero Overlay',
			'name' => 'hero_overlay',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '<h1>adventure</h1><ul><li><h5><i>noun</i><h5></li><li><h5>ad&#183;ven&#183;ture</h5></li><li><h5>&#92;ed&hyphen;&#39;ven&hyphen;cher&#92;</h5></li></ul><h3>an exciting or remarkable experience</h3>',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
		array (
			'key' => 'field_58cc3736f7d44',
			'label' => 'About Me',
			'name' => 'about_me',
			'type' => 'textarea',
			'instructions' => '<h1>HELLO.</h1><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ac laoreet nibh. Vestibulum ipsum ex, efficitur in tortor nec, tincidunt maximus mauris. Curabitur eget lacus luctus, hendrerit mi at, ultricies lorem. Nulla scelerisque tortor nec blandit iaculis. Suspendisse condimentum scelerisque diam viarius ipsum. </p><p>Duis iaculis massa eu arcu convallis tristique. Curabitur vestibulum ante eu mi interdum, nec aliquet augue scelerisque. In at fermentum dui. Pretium scelerisque. Cras sed velit eget est convallis lacinia nec eget lorem. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => 'wpautop',
		),
		array (
			'key' => 'field_58cfec9754567',
			'label' => 'About Image',
			'name' => 'about_image',
			'type' => 'image',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'url',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array (
			'key' => 'field_58cfed421e10b',
			'label' => 'Map Section Title',
			'name' => 'map_section_title',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'WHERE I\'VE BEEN',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'page_type',
				'operator' => '==',
				'value' => 'front_page',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array (
		0 => 'the_content',
	),
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group( array (
	'key' => 'group_58cc2ad132c13',
	'title' => 'Location Post',
	'fields' => array (
		array (
			'key' => 'field_58d13ac8e34db',
			'label' => 'Title',
			'name' => 'title',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array (
			'key' => 'field_58cc2c6dbc5d5',
			'label' => 'Lat',
			'name' => 'lat',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array (
			'key' => 'field_58cc2c7ebc5d6',
			'label' => 'Long',
			'name' => 'long',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array (
			'key' => 'field_58d016c2eb8b4',
			'label' => 'Thumbnail Image',
			'name' => 'thumbnail_image',
			'type' => 'image',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'url',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array (
			'key' => 'field_58cc2b27f60dc',
			'label' => 'Intro',
			'name' => 'intro',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
		array (
			'key' => 'field_58cc2b41f60dd',
			'label' => 'Intro Images',
			'name' => 'intro_images',
			'type' => 'flexible_content',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'button_label' => 'Add Row',
			'min' => '',
			'max' => '',
			'layouts' => array (
				array (
					'key' => '58cc2b509c0ab',
					'name' => 'single',
					'label' => 'Single',
					'display' => 'block',
					'sub_fields' => array (
						array (
							'key' => 'field_58cc2b58f60df',
							'label' => 'Image',
							'name' => 'image',
							'type' => 'image',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'url',
							'preview_size' => 'thumbnail',
							'library' => 'all',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => '',
						),
					),
					'min' => '',
					'max' => '',
				),
				array (
					'key' => '58cc2b53f60de',
					'name' => 'double',
					'label' => 'Double',
					'display' => 'block',
					'sub_fields' => array (
						array (
							'key' => 'field_58cc2b66f60e0',
							'label' => 'Image Left',
							'name' => 'image_left',
							'type' => 'image',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'url',
							'preview_size' => 'thumbnail',
							'library' => 'all',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => '',
						),
						array (
							'key' => 'field_58cc2b73f60e1',
							'label' => 'Image Right',
							'name' => 'image_right',
							'type' => 'image',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'url',
							'preview_size' => 'thumbnail',
							'library' => 'all',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => '',
						),
					),
					'min' => '',
					'max' => '',
				),
			),
		),
		array (
			'key' => 'field_58cc2ba8f60e2',
			'label' => 'Locations',
			'name' => 'locations',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'row',
			'button_label' => '',
			'sub_fields' => array (
				array (
					'key' => 'field_58cc2bd2f60e3',
					'label' => 'Name',
					'name' => 'name',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array (
					'key' => 'field_58cc2bdbf60e4',
					'label' => 'Lat',
					'name' => 'lat',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array (
					'key' => 'field_58cc2be2f60e5',
					'label' => 'Long',
					'name' => 'long',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array (
					'key' => 'field_58cc2c01f60e6',
					'label' => 'Text',
					'name' => 'text',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => '',
					'new_lines' => 'wpautop',
				),
				array (
					'key' => 'field_58cc2c10f60e7',
					'label' => 'Images',
					'name' => 'images',
					'type' => 'flexible_content',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'button_label' => 'Add Row',
					'min' => '',
					'max' => '',
					'layouts' => array (
						array (
							'key' => '58cc2c1b626aa',
							'name' => 'single',
							'label' => 'Single',
							'display' => 'block',
							'sub_fields' => array (
								array (
									'key' => 'field_58cc2c21f60e8',
									'label' => 'image',
									'name' => 'image',
									'type' => 'image',
									'instructions' => '',
									'required' => 0,
									'conditional_logic' => 0,
									'wrapper' => array (
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'return_format' => 'url',
									'preview_size' => 'thumbnail',
									'library' => 'all',
									'min_width' => '',
									'min_height' => '',
									'min_size' => '',
									'max_width' => '',
									'max_height' => '',
									'max_size' => '',
									'mime_types' => '',
								),
							),
							'min' => '',
							'max' => '',
						),
						array (
							'key' => '58cc2c32f60e9',
							'name' => 'double',
							'label' => 'Double',
							'display' => 'row',
							'sub_fields' => array (
								array (
									'key' => 'field_58cc2c36f60ea',
									'label' => 'Image Left',
									'name' => 'image_left',
									'type' => 'image',
									'instructions' => '',
									'required' => 0,
									'conditional_logic' => 0,
									'wrapper' => array (
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'return_format' => 'url',
									'preview_size' => 'thumbnail',
									'library' => 'all',
									'min_width' => '',
									'min_height' => '',
									'min_size' => '',
									'max_width' => '',
									'max_height' => '',
									'max_size' => '',
									'mime_types' => '',
								),
								array (
									'key' => 'field_58cc2c46f60eb',
									'label' => 'Image Right',
									'name' => 'image_right',
									'type' => 'image',
									'instructions' => '',
									'required' => 0,
									'conditional_logic' => 0,
									'wrapper' => array (
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'return_format' => 'url',
									'preview_size' => 'thumbnail',
									'library' => 'all',
									'min_width' => '',
									'min_height' => '',
									'min_size' => '',
									'max_width' => '',
									'max_height' => '',
									'max_size' => '',
									'mime_types' => '',
								),
							),
							'min' => '',
							'max' => '',
						),
						array (
							'key' => '58fa5b87bf2aa',
							'name' => 'tall',
							'label' => 'Tall',
							'display' => 'row',
							'sub_fields' => array (
								array (
									'key' => 'field_58fa5b8dbf2ab',
									'label' => 'image',
									'name' => 'image',
									'type' => 'image',
									'instructions' => '',
									'required' => 0,
									'conditional_logic' => 0,
									'wrapper' => array (
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'return_format' => 'url',
									'preview_size' => 'thumbnail',
									'library' => 'all',
									'min_width' => '',
									'min_height' => '',
									'min_size' => '',
									'max_width' => '',
									'max_height' => '',
									'max_size' => '',
									'mime_types' => '',
								),
							),
							'min' => '',
							'max' => '',
						),
						array (
							'key' => '58ff5159458d7',
							'name' => 'triple',
							'label' => 'Triple',
							'display' => 'row',
							'sub_fields' => array (
								array (
									'key' => 'field_58ff515f458d8',
									'label' => 'image left',
									'name' => 'image_left',
									'type' => 'image',
									'instructions' => '',
									'required' => 0,
									'conditional_logic' => 0,
									'wrapper' => array (
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'return_format' => 'url',
									'preview_size' => 'thumbnail',
									'library' => 'all',
									'min_width' => '',
									'min_height' => '',
									'min_size' => '',
									'max_width' => '',
									'max_height' => '',
									'max_size' => '',
									'mime_types' => '',
								),
								array (
									'key' => 'field_58ff5175458d9',
									'label' => 'image center',
									'name' => 'image_center',
									'type' => 'image',
									'instructions' => '',
									'required' => 0,
									'conditional_logic' => 0,
									'wrapper' => array (
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'return_format' => 'url',
									'preview_size' => 'thumbnail',
									'library' => 'all',
									'min_width' => '',
									'min_height' => '',
									'min_size' => '',
									'max_width' => '',
									'max_height' => '',
									'max_size' => '',
									'mime_types' => '',
								),
								array (
									'key' => 'field_58ff5182458da',
									'label' => 'image right',
									'name' => 'image_right',
									'type' => 'image',
									'instructions' => '',
									'required' => 0,
									'conditional_logic' => 0,
									'wrapper' => array (
										'width' => '',
										'class' => '',
										'id' => '',
									),
									'return_format' => 'url',
									'preview_size' => 'thumbnail',
									'library' => 'all',
									'min_width' => '',
									'min_height' => '',
									'min_size' => '',
									'max_width' => '',
									'max_height' => '',
									'max_size' => '',
									'mime_types' => '',
								),
							),
							'min' => '',
							'max' => '',
						),
					),
				),
			),
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array (
		0 => 'the_content',
	),
	'active' => 1,
	'description' => '',
));

endif;


?>