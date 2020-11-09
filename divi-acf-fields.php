<?php
/**
 * Plugin Name: Divi ACF Gallery and oEmbed ACF fields 
 * Plugin URI: https://divi.tech
 * Description: Allows the usage of ACF Gallery and oEmebed fields type to be display inside Divi's Code Module
 * Version: 1.0.0
 * Author: Eduard Ungureanu
 * Author URI: https://divi.tech
 */

 /*
 * Usage [dt-yt-acf-video acf_id='my-video']
 * - my-video - is the ACF oEmbed field's ID;
 */

add_shortcode('dt-yt-acf-video', 'dt_show_video');
function dt_show_video($atts = '') {
    global $post;
    
    $wporg_atts = shortcode_atts([
		'acf_id' => '',
	], $atts);
	   
    $custom_fields = get_post_custom($post->ID);
    $video_custom_field = $custom_fields[$wporg_atts['acf_id']];
    
    foreach ( $video_custom_field as $key => $value ) {
    	$video_url = explode('?v=', $value);
    	$video_id = $video_url[1];
  	}
  	
    
    return '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$video_id.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}