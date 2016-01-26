<?php

add_action('msdlab_before_product_loop','msdlab_move_product_thumbnail');
add_action('msdlab_before_product_loop','woocommerce_template_loop_product_thumbnail');

function msdlab_move_product_thumbnail(){
	remove_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail');
	remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
	//remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price');
	add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_single_excerpt');
}

function woocommerce_template_product_description() {
woocommerce_get_template( 'single-product/tabs/description.php' );
}
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_product_description', 20 );

function msdlab_remove_description_header($content){
    //ts_data($content);
    return false;
}
add_filter('woocommerce_product_description_heading','msdlab_remove_description_header');

remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);
add_action('woocommerce_single_product_summary','woocommerce_template_single_price',20);

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['description'] );          // Remove the description tab
    unset( $tabs['reviews'] );          // Remove the reviews tab
    unset( $tabs['additional_information'] );   // Remove the additional information tab

    return $tabs;

}
add_filter('loop_shop_columns','msdlab_change_cols');
function msdlab_change_cols($data){
    //global $template;
    //$template_file_name      = basename( $template );
    //if($template_file_name == 'archive-product.php'){
        return 2;
    //}
    return $data;
}
// Display 24 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 24;' ), 20 );
