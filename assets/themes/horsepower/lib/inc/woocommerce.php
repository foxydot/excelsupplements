<?php

add_action('msdlab_before_product_loop','msdlab_move_product_thumbnail');
add_action('msdlab_before_product_loop','woocommerce_template_loop_product_thumbnail');

function msdlab_move_product_thumbnail(){
	remove_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail');
	remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
	remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price');
	add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_single_excerpt');
}