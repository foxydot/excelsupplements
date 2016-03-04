<?php

add_action('msdlab_before_product_loop','msdlab_move_product_thumbnail');
add_action('msdlab_before_product_loop','woocommerce_template_loop_product_thumbnail');

function msdlab_move_product_thumbnail(){
	remove_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail');
	remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
	remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price');
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

function woocommerce_template_loop_category_title( $category ) {
        ?>
        <h3>
            <?php
                echo $category->name;

                if ( $category->count > 0 )
                    //echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
            ?>
        </h3>
        <?php
    }
/**
     * Show subcategory thumbnails.
     *
     * @param mixed $category
     * @subpackage  Loop
     */
    function woocommerce_subcategory_thumbnail( $category ) {
        $small_thumbnail_size   = apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' );
        $dimensions             = wc_get_image_size( $small_thumbnail_size );
        $thumbnail_id           = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );

        if ( $thumbnail_id ) {
            $image = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size  );
            $image = $image[0];
        } else {
            $image = wc_placeholder_img_src();
        }

        if ( $image ) {
            // Prevent esc_url from breaking spaces in urls for image embeds
            // Ref: http://core.trac.wordpress.org/ticket/23605
            $image = str_replace( ' ', '%20', $image );

            echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_attr( $dimensions['height'] ) . '" class="pull-left product-image" />';
        }
    }
    
add_filter('woocommerce_product_add_to_cart_text','msdlab_change_text');
function msdlab_change_text($text){
    if($text == "Select options"){
        $text = "Buy now";
    }
    return $text;
}
