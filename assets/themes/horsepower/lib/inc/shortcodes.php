<?php
add_shortcode('button','msdlab_button_function');
function msdlab_button_function($atts, $content = null){	
	extract( shortcode_atts( array(
      'url' => null,
	  'target' => '_self'
      ), $atts ) );
	$ret = '<div class="button-wrapper">
<a class="button" href="'.$url.'" target="'.$target.'">'.remove_wpautop($content).'</a>
</div>';
	return $ret;
}
add_shortcode('hero','msdlab_landing_page_hero');
function msdlab_landing_page_hero($atts, $content = null){
	$ret = '<div class="hero">'.remove_wpautop($content).'</div>';
	return $ret;
}
add_shortcode('callout','msdlab_landing_page_callout');
function msdlab_landing_page_callout($atts, $content = null){
	$ret = '<div class="callout">'.remove_wpautop($content).'</div>';
	return $ret;
}
function column_shortcode($atts, $content = null){
	extract( shortcode_atts( array(
	'cols' => '3',
	'position' => '',
	), $atts ) );
	switch($cols){
		case 5:
			$classes[] = 'one-fifth';
			break;
		case 4:
			$classes[] = 'one-fouth';
			break;
		case 3:
			$classes[] = 'one-third';
			break;
		case 2:
			$classes[] = 'one-half';
			break;
	}
	switch($position){
		case 'first':
		case '1':
			$classes[] = 'first';
		case 'last':
			$classes[] = 'last';
	}
	return '<div class="'.implode(' ',$classes).'">'.$content.'</div>';
}
add_shortcode('mailto','msdlab_mailto_function');
function msdlab_mailto_function($atts, $content){
    extract( shortcode_atts( array(
    'email' => '',
    ), $atts ) );
    $content = trim($content);
    if($email == '' && preg_match('|[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}|i', $content, $matches)){
        $email = $matches[0];
    }
    $email = antispambot($email);
    return '<a href="mailto:'.$email.'">'.$content.'</a>';
}
add_shortcode('columns','column_shortcode');

add_shortcode('sitemap','msdlab_sitemap');

add_shortcode('page-widget','msdlab_page_widget');
function msdlab_page_widget($atts){
    extract( shortcode_atts( array(
        'slug' => false,
        'id' => false
    ), $atts ) );
    if(!$slug && !$id){
        return;
    }
    $args=array(
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'posts_per_page' => 1
    );
    if($slug){
        $args['name'] = $slug;
    } elseif($id){
        $args['id'] = $id;
    }
    $posts = get_posts($args);
    $post = $posts[0];
    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'page_banner' );
    $background = $featured_image[0];
    $background_style = strlen($background)>0?' style = "background-image:url('.$background.')"':'';
    $ret = '<div class="page-widget-background"'.$background_style.'>
        <div class="page-widget-info">
            <a class="entry-title" href="'.get_the_permalink($post->ID).'">'.$post->post_title.'</a>
            <a class="entry-content" href="'.get_the_permalink($post->ID).'">'.msdlab_get_excerpt($post->ID,50,false).'</a>
        </div>
    </div>';
    return $ret;
}
