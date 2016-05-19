<?php
    define('_LIMIT_',10);
    /* google maps defines */
    define('MAP_LAT'    , 48.85680934671159 );
    define('MAP_LNG'    , 2.353348731994629 );
    define('MAP_CLAT'   , 48.85700699730661 );
    define('MAP_CLNG'   , 2.354121208190918 );
    define('MAP_ZOOM'   , 15 );
	define('DEFAULT_AVATAR'   , get_template_directory_uri()."/images/default_avatar.jpg" );
    define( '_TN_'      , wp_get_theme() );
    
    
	define('BRAND'      , '' );
	define('ZIP_NAME'   , 'conference' );
  
	define('EXCERPT_CHAR_LEN'   , '600' );

	include 'lib/php/main.php';
    include 'lib/php/actions.register.php';
    include 'lib/php/menu.register.php';

    $content_width = 600;

    if( function_exists( 'add_theme_support' ) ){
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'post-thumbnails' );
    }

    if( function_exists( 'add_image_size' ) ){
        add_image_size( 'slideshow'         , 920   , 300   , true );
        add_image_size( '62x62'     		, 62    , 62    , true );
        add_image_size( '150xXXX'           , 150   , 999   );
        add_image_size( '300xXXX'           , 300   , 999   ); /*used for animated sponsors widget*/
        add_image_size( '600x200'           , 600   , 200   , true );
		add_image_size( '200x100'           , 200   , 100   , true ); /*gallery size*/
		add_image_size( '440x220'           , 440   , 220   , true ); /*used for 2 col gallery*/
        add_image_size( '280x140'           , 280   , 140   , true ); /*used for 3 col gallery*/
		
    }
    
	
    add_theme_support( 'custom-background' );
       

	add_editor_style('editor-style.css');
	
    /* Localization */
    load_theme_textdomain( 'cosmotheme' );
    load_theme_textdomain( 'cosmotheme' , get_template_directory() . '/languages' );
    
    if ( function_exists( 'load_child_theme_textdomain' ) ){
        load_child_theme_textdomain( 'cosmotheme' );
    }

    $pg = get_pages();
    $do = true;
	$do_cart_page = true;
    foreach( $pg as $p ){
        if( $p -> post_title == 'Registration' ){
            $do = false;
            break;
        }
    }

    foreach( $pg as $p ){
        if( $p -> post_title == 'Shopping cart' ){
            $do_cart_page = false;
            break;
        }
    }
    
    if( $do ){
        $pages = array(
            'post_title' => 'Registration',
            'post_content' => '',
            'post_status' => 'publish',
            'post_type' => 'page'
        );

        wp_insert_post($pages);
    }

    /*create Shopping cart page*/	
    if( $do_cart_page ){
        $pages = array(
            'post_title' => 'Shopping cart',
            'post_content' => '',
            'post_status' => 'publish',
            'post_type' => 'page'
        );

        wp_insert_post($pages);
    }

	if(is_admin() && ini_get('allow_url_fopen') == '1'){
		/*New version check*/	
		if( options::logic( 'cosmothemes' , 'show_new_version' ) ){
			function versionNotify(){
				echo api_call::compareVersions(); 
			}
		
			// Add hook for admin <head></head>
			add_action('admin_head', 'versionNotify');
		}

		/*Cosmo news*/
		if( options::logic( 'cosmothemes' , 'show_cosmo_news' ) && !isset($_GET['post_id'])  && !isset($_GET['post'])){
			function doCosmoNews(){
				  
			}
		
			// Add hook for admin <head></head>
			add_action('admin_head', 'doCosmoNews');
		}	
	}

    /* Cosmothemes Backend link */
    function de_cosmotheme() {
        global $wp_admin_bar;
        if ( !is_super_admin() || !is_admin_bar_showing() ){
            return;
        }
		
		$current_theme_name = wp_get_theme();
        
        $wp_admin_bar -> add_menu( array(
            'id' => 'cosmothemes',
            'parent' => '',
            'title' => $current_theme_name,
            'href' => admin_url( 'admin.php?page=cosmothemes__general' )
            ) );
    }
    add_action('admin_bar_menu', 'de_cosmotheme');



    add_editor_style('editor-style.css');

    function load_scripts() {
        wp_register_style( 'default_stylesheet',get_stylesheet_directory_uri() . '/style.css' );
        wp_enqueue_style( 'default_stylesheet' );

        wp_register_style( 'shortcode',get_template_directory_uri() . '/lib/css/shortcode.css' );
        wp_enqueue_style( 'shortcode' );


        $protocol = is_ssl() ? 'https' : 'http';
        wp_enqueue_style( 'cosmo-oswald', "$protocol://fonts.googleapis.com/css?family=Oswald&v2' rel='stylesheet' type='text/css" );

        
        if( options::get_value( 'general' , 'logo_type' ) == 'text' ) {
            $logo_font = str_replace(' ' , '+' , trim( options::get_value( 'general' , 'logo_font_family' ) ) );
            wp_enqueue_style( 'logo_gfont', "$protocol://fonts.googleapis.com/css?family=$logo_font' rel='stylesheet' type='text/css" );
        }

        wp_enqueue_script( 'hoverIntent' , get_template_directory_uri() . '/js/jquery.hoverIntent.js' , array( 'jquery' ),false,true );
        wp_enqueue_script( 'superfish' , get_template_directory_uri() . '/js/jquery.superfish.js' , array( 'jquery' ),false,true );
        wp_enqueue_script( 'supersubs' , get_template_directory_uri() . '/js/jquery.supersubs.js' , array( 'jquery' ),false,true );
        wp_enqueue_script( 'mosaic' , get_template_directory_uri() . '/js/jquery.mosaic.1.0.1.min.js' , array( 'jquery' ),false,true );
        wp_enqueue_script( 'lightbox' , get_template_directory_uri() . '/js/jquery.lightbox.js' , array( 'jquery' ),false,true );
        wp_enqueue_script( 'slides' , get_template_directory_uri() . '/js/slides.min.jquery.js' , array( 'jquery' ),false,true );
        wp_enqueue_script( 'settings_slider' , get_template_directory_uri() . '/js/settings.slider.js' , array( 'jquery' ),false,true );
        wp_enqueue_script( 'mobilyblocks' , get_template_directory_uri() . '/js/mobilyblocks.js' , array( 'jquery' ),false,true );
        wp_enqueue_script( 'jquery_tipsy' , get_template_directory_uri() . '/js/jquery.tipsy.js' , array( 'jquery' ),false,true );
        wp_enqueue_script( 'prettyPhoto' , get_template_directory_uri() . '/js/jquery.prettyPhoto.js' , array( 'jquery' ),false,true );
        wp_enqueue_script( 'prettyPhoto_settings' , get_template_directory_uri() . '/js/prettyPhoto.settings.js' , array( 'jquery' ),false,true );
        wp_enqueue_script( 'tabs_pack' , get_template_directory_uri() . '/js/jquery.tabs.pack.js' , array( 'jquery' ),false,true );
        
        wp_enqueue_script( 'functions' , get_template_directory_uri() . '/js/functions.js' , array( 'jquery' ),false,true );
        wp_enqueue_script( 'meta' , get_template_directory_uri() . '/lib/js/meta.js' , array( 'jquery' ),false,true );
        wp_enqueue_script( 'actions' , get_template_directory_uri() . '/lib/js/actions.js' , array( 'jquery' ),false,true );
        
        
        if ( is_singular() ){ 
            wp_enqueue_script( "comment-reply" );
        }

        
    }

    add_action('wp_enqueue_scripts', 'load_scripts');


    /**
     * As WP 4.0 added wp_texturize, we'll need the next function to disable texturizing the shortcodes.
     */
    
    function disable_texturize_for_shortcodes( $shortcodes ) {
        global $shortcode_tags;

        foreach ($shortcode_tags as $key => $value) {
            $shortcodes[] = $key;
        }
        

        return $shortcodes;
    }
    add_filter( 'no_texturize_shortcodes', 'disable_texturize_for_shortcodes' );



    
?>