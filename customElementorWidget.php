<?php 

/**
 
 * @package Dimitri Kilibarda
 
 */
 
/*
 
Plugin Name: Custom Elementor Control
 
Plugin URI: https://wpinaday.nl
 
Description: Door deze elementror custom control kan je makkelijke wordpress berichten selecteren en op je website zetten. Veder kunt u de titel en eerste tekst bewerken.
 
Version: 1.0
 
Author: Dimitri
 
Author URI: https://wpinaday.nl
 
License: GPLv2 or later
 
Text Domain: Custom Elementor Widget
 
*/

//in dit bestand maak ik me WYSIWYG widget dit heeft niks temaken met me bericht ophalen widget

//hier registreren we de contol (contro2 select)
add_action( 'elementor/controls/controls_registered', function() {
	//hier pakken we het bestand post_select.php en besvestigen we de class Post_Select in een nieuwe methode die Elementor maakt genoemd register_control
	require_once get_stylesheet_directory() . '/custom_controls/post_select.php';
	\Elementor\Plugin::instance()->controls_manager->register_control('wpc-post-select', new \WPC\Post_Select);

});

//hier registreren we onze widget bij Elementor door de functie register_widget_type
add_action( 'elementor/widgets/widgets_registered', function() {

	require_once get_stylesheet_directory() . '/custom_components/single_post.php';
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \WPC\Single_Post() );

} );


add_action('wp_ajax_get_posts', function() {
   
	$posts = get_posts();

    $response = [];
    foreach($posts as $post){
        $response[] = [
			//het id bewaren we zodat we alle infomatie van het bericht via de id kunnen oproepen 
            "id" => $post->ID,
			//text is er dat wij makkelijk kunnen zien over welk bericht het gaat
			"text" => $post->post_title,
			
        ];
    }

    wp_send_json($response);

});
