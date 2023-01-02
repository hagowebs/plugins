<?php

/*
Plugin Name: Hago Webs SEO 
Description: Este plugin inserta los metadatos básicos de SEO en tu sitio web.
Author: Emilio González Maldonado
Version: 1.0
Author URI: https://hagowebs.com/
*/

function hagowebs_seo() {
	if (is_front_page()):
		while (have_posts()): the_post();
			echo '
			<meta name="title" content="'; bloginfo('name'); echo '">
			<meta name="description" content="'; bloginfo('description'); echo '">
			<meta name="robots" content="index,follow">
			<meta property="og:title" content="'; bloginfo('name'); echo '">
			<meta property="og:url" content="'; the_permalink(); echo '">
			<meta property="og:type" content="website">
			<meta property="og:description" content="'; bloginfo('description'); echo '">
			'; if (has_post_thumbnail()):
				echo '<meta property="og:image" content="';
				$thumb_id  = get_post_thumbnail_id();
				$thumb_url = wp_get_attachment_image_src($thumb_id, 'medium', true);
				echo $thumb_url[0];
				echo '">';
			endif; echo '
			<meta property="og:locale" content="'; echo get_locale(); echo '">
			<meta property="og:site_name" content="'; bloginfo('name'); echo '">
			<link rel="canonical" href="'; the_permalink(); echo '">';
		endwhile;
	elseif (is_page() || is_single()):
		while (have_posts()): the_post();
			echo '
			<meta name="title" content="'; the_title(); echo ' - '; bloginfo('name'); echo '">
			<meta name="description" content="'; echo (get_the_excerpt()); echo '">
			<meta name="robots" content="index,follow">
			<meta property="og:title" content="'; the_title(); echo ' - '; bloginfo('name'); echo '">
			<meta property="og:url" content="'; the_permalink(); echo '">
			<meta property="og:type" content="article">
			<meta property="og:description" content="'; echo (get_the_excerpt()); echo '">
			'; if (has_post_thumbnail()):
				echo '<meta property="og:image" content="';
				$thumb_id  = get_post_thumbnail_id();
				$thumb_url = wp_get_attachment_image_src($thumb_id, 'medium', true);
				echo $thumb_url[0];
				echo '">';
			endif; echo '
			<meta property="og:locale" content="'; echo get_locale(); echo '">
			<meta property="og:site_name" content="'; bloginfo('name'); echo '">
			<link rel="canonical" href="'; the_permalink(); echo '">';
		endwhile;
	endif;
}

add_action( 'wp_head', 'hagowebs_seo' );
