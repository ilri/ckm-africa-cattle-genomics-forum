<?php
function my_theme_enqueue_styles() {
    $parent_style = 'parent-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ));

}
// Add the child theme's styles & javas
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

// Add the child theme's javascript
wp_enqueue_script('set_default_filter', get_stylesheet_directory_uri() . '/set_default_filter.js', array("jquery"));

?>
