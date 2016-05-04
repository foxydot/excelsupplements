<?php

add_action('msdlab_before_product_loop','msdlab_product_display_changes');

function msdlab_product_display_changes(){
    global $post;
    $brand = false;
    remove_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail');
    woocommerce_template_loop_product_link_open();
    if (class_exists('MultiPostThumbnails')){
        if((bool) MultiPostThumbnails::has_post_thumbnail('product','brand-image',$post->ID)){
            msdlab_template_loop_product_brand_thumbnail();
        } else {
            woocommerce_template_loop_product_thumbnail();            
        }
    }
    woocommerce_template_loop_product_link_close();
	remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
	remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price');
	add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_single_excerpt');
}

function msdlab_template_loop_product_brand_thumbnail(){
    global $post;
    if (class_exists('MultiPostThumbnails')){
        MultiPostThumbnails::the_post_thumbnail('product','brand-image',$post->ID);
    }
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
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10);

remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);
add_action('woocommerce_single_product_summary','woocommerce_template_single_price',20);

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['description'] );          // Remove the description tab
    //unset( $tabs['reviews'] );          // Remove the reviews tab
    //unset( $tabs['additional_information'] );   // Remove the additional information tab

    return $tabs;

}
//add_filter('loop_shop_columns','msdlab_change_cols');
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
add_filter('woocommerce_product_single_add_to_cart_text','msdlab_change_text');
add_filter('woocommerce_product_add_to_cart_text','msdlab_change_text');
add_filter('woocommerce_subcategory_link_button_text','msdlab_change_text');


function msdlab_change_text($text){
    //if($text == "Select options"){
        $text = "Buy now";
    //}
    return $text;
}

remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);
remove_action('woocommerce_after_single_product_summary','woocommerce_upsell_display',15);
remove_action('woocommerce_after_single_product_summary','woocommerce_output_related_products',20);
/**
 * Use WC 2.0 variable price format, now include sale price strikeout
 *
 * @param  string $price
 * @param  object $product
 * @return string
 */
function wc_wc20_variation_price_format( $price, $product ) {
    // Main Price
    $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
    $price = $prices[0] !== $prices[1] ? sprintf( __( 'Starting at: %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

    // Sale Price
    $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
    sort( $prices );
    $saleprice = $prices[0] !== $prices[1] ? sprintf( __( 'Starting at: %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

    if ( $price !== $saleprice ) {
        $price = '<del>' . $saleprice . '</del> <ins>' . $price . '</ins>';
    }
    
    return $price;
}
add_filter( 'woocommerce_variable_sale_price_html', 'wc_wc20_variation_price_format', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'wc_wc20_variation_price_format', 10, 2 );

if (class_exists('MultiPostThumbnails')) {
    new MultiPostThumbnails(
        array(
            'label' => 'Brand Image',
            'id' => 'brand-image',
            'post_type' => 'product'
        )
    );
}

add_action( 'pre_get_posts', 'custom_pre_get_posts_query' );

function custom_pre_get_posts_query( $q ) {

    if ( ! $q->is_main_query() ) return;
    if ( ! $q->is_post_type_archive() ) return;
    
    if ( ! is_admin() && is_shop() ) {

        $q->set( 'tax_query', array(array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => array( 'supplements' ), // Don't display products in the knives category on the shop page
            'operator' => 'IN'
        )));
    
    }

    remove_action( 'pre_get_posts', 'custom_pre_get_posts_query' );

}

add_filter( 'get_terms', 'get_subcategory_terms', 10, 3 );
 
function get_subcategory_terms( $terms, $taxonomies, $args ) {
 
  $new_terms = array();
 
  // if a product category and on the shop page
  if ( in_array( 'product_cat', $taxonomies ) && ! is_admin() && is_shop() ) {
 
    foreach ( $terms as $key => $term ) {
 
      if ( ! in_array( $term->slug, array( 'supplements' ) ) ) {
        $new_terms[] = $term;
      }
 
    }
 
    $terms = $new_terms;
  }
 
  return $terms;
}

remove_action('woocommerce_sidebar','woocommerce_get_sidebar');
add_action('woocommerce_sidebar','msdlab_do_page_footer_sidebar');

add_action('woocommerce_after_subcategory_title','msdlab_subcategory_description');
add_action('woocommerce_after_subcategory_title','msdlab_subcategory_link_button');

function msdlab_subcategory_description($category){
    print term_description($category->term_id,'product_cat');
}
function msdlab_subcategory_link_button($category){
    print '<a class="button" href="' . get_term_link( $category->slug, 'product_cat' ) . '">' . apply_filters('woocommerce_subcategory_link_button_text','Browse') . '</a>';
}


add_shortcode('woocart-items','msdlab_woocart_items_handler');
function msdlab_woocart_items_handler(){
    return '<span class="item-count">' . WC()->cart->get_cart_contents_count() . '</span>';
}
remove_action('woocommerce_cart_collaterals','woocommerce_cross_sell_display');
add_action('woocommerce_after_cart','woocommerce_cross_sell_display');
add_filter( 'woocommerce_cross_sells_total', 'db_cross_sells_columns' );
add_filter('woocommerce_cross_sells_columns','db_cross_sells_columns');
function db_cross_sells_columns( $columns ) {
return 4;
}

remove_action('woocommerce_single_variation','woocommerce_single_variation',10);
add_action('woocommerce_single_variation','woocommerce_single_variation',50);
