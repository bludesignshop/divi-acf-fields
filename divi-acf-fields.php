<?php
/**
 * Plugin Name: Divi ACF Gallery and oEmbed ACF fields 
 * Plugin URI: https://github.com/eduard-ungureanu/divi-acf-fields
 * Description: Allows the usage of ACF Gallery and oEmebed fields type to be display inside Divi's Code Module
 * Version: 1.0.0
 * Author: Eduard Ungureanu
 * Author URI: https://divi.tech
 */

 /*
 * Usage [dt-yt-acf-video acf_id='my-video']
 * - my-video - is the ACF oEmbed field's name;
 */

add_shortcode('dt-yt-acf-video', 'dt_show_video');
function dt_show_video($atts = '') {
	global $post;
	$wporg_atts = shortcode_atts([
		'acf_id' => '',
  	], 
  	$atts);

	$custom_fields = get_post_custom($post->ID);
	$video_custom_field = $custom_fields[$wporg_atts['acf_id']];
    
	foreach ( $video_custom_field as $key => $value ) {
		$video_url = explode('?v=', $value);
		$video_id = $video_url[1];
  	}
	
	return '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$video_id.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}

 /*
 * Usage [dt-acf-gallery acf_id='my_gallery']
 * - my_gallery - is the ACF Gallery field's name;
 */

add_shortcode('dt-acf-gallery', 'dt_show_gallery');
function dt_show_gallery($atts = '') {
	global $post;
	$dt_atts = shortcode_atts([
		'acf_id' => '',
		'columns' => 4,
  	], $atts);
	
	$output='';

	$images = get_field($dt_atts['acf_id']);

	if ($images) :
		$output .= "<style>
			.dt-acf-gallery {
				--columns: ".$dt_atts['columns'].";
				--gutter: 20px;
			}
			#et-main-area .dt-acf-gallery {
				padding: 0;
				margin: 0;
				list-style-type: none;
				display: grid;
				grid-template-columns: repeat(var(--columns), 1fr);
				grid-gap: var(--gutter);
			}
		</style>";
		$output .= '<ul class="dt-acf-gallery">';
			foreach ($images as $image) :
				$output .= '<li class="dt-acf-gallery-item">';
					$output .= '<a class="dt-acf-gallery-item-link" href="'.$image['url'].'" title="'.$image['title'].'">';
						$output .= '<picture>';
							$output .= '<source srcset="'.esc_url($image['sizes']['large']).'" media="(min-width: 981px)">';
							$output .= '<source srcset="'.esc_url($image['sizes']['et-pb-image--responsive--tablet']).'" media="(min-width: 768px) and (max-width: 980px">';
							$output .= '<source srcset="'.esc_url($image['sizes']['et-pb-image--responsive--phone']).'" media="(max-width: 767px)">';
							$output .= '<img class="dt-acf-gallery-image" src="'.esc_url($image['sizes']['large']).'" alt="'.esc_attr($image['alt']).'"/>';
						$output .= '</picture>';
					$output .= '</a>';
				$output .= '</li>';
			endforeach;
		$output .= '</ul>';
		$output .= '<script>
			jQuery(function ($) {
				$(document).ready(function () {
					$(".dt-acf-gallery-item").magnificPopup({
						delegate: "a",
						type: "image",
						gallery: {
							enabled: true
						}
					});
				})
			})
		</script>';
	endif;
	return $output;
} 