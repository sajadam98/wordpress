<?php
/**
 * Woo Commerce Add Content Primary Div Function
**/
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
if (!function_exists('ostore_woocommerce_output_content_wrapper')) {
    function ostore_woocommerce_output_content_wrapper(){ ?>
    <div class="main-container">
        <div class="container">
        <div class="row">
            <div class="col-main col-md-9 col-sm-12">
            <?php   }
        }
        add_action( 'woocommerce_before_main_content', 'ostore_woocommerce_output_content_wrapper', 10 );


        remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
        if (!function_exists('ostore_woocommerce_output_content_wrapper_end')) {
            function ostore_woocommerce_output_content_wrapper_end(){ ?>
        </div>
        <?php get_sidebar('woocommerce'); ?>
    </div><!-- row -->
</div><!-- container -->
</div><!-- main-container -->
<?php   }
}
add_action( 'woocommerce_after_main_content', 'ostore_woocommerce_output_content_wrapper_end', 10 );


/**
 * WooCommerce Manage Product Div Structure
**/
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );


if (!function_exists('ostore_woocommerce_before_shop_loop_item')) {
    function ostore_woocommerce_before_shop_loop_item(){ ?>
    <div class="product-item">
        <div class="item-inner">
           <div class="product-thumbnail">
                <?php global $post, $product; 
                if ( $product->is_on_sale() ) :
                    echo apply_filters( 'woocommerce_sale_flash', '<div class="icon-sale-label sale-left">' . __( 'Sale', 'ostore' ) . '</div>', $post, $product ); ?>
                <?php endif; ?>
                <?php
                global $product_label_custom;
                if ($product_label_custom != ''){
                    echo '<div class="icon-new-label new-right">'.$product_label_custom.'</div>';
                }
                ?>
            
                <div class="pr-img-area">
                    <figure>
                        <a href="<?php the_permalink(); ?>">
                            <?php echo get_the_post_thumbnail(get_the_ID(), 'shop_catalog', array( 'class' => 'first-img' ) ); ?> 
                        </a>
                    </figure>
                    <button type="button" class="add-to-cart-mt"> <i class="fa fa-shopping-cart"></i><span><?php woocommerce_template_loop_add_to_cart(); ?> </span> </button>

                </div>
            
                <div class="pr-info-area">
                   <div class="pr-button">
                        <div class="mt-button add_to_wishlist">
                            <?php if(function_exists( 'ostore_wishlist_products' )) { ostore_wishlist_products(); } ?> 
                        </div>
                        <div class="mt-button add_to_compare"> 
                            <?php if(function_exists( 'ostore_add_compare_link' )) { ostore_add_compare_link(); } ?>                                   
                        </div>
                        <div class="mt-button quick-view"> 
                            <?php if(function_exists( 'ostore_quickview' )) { ostore_quickview(); } ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-wrap">
            <div class="item-info clearfix">
                <div class="info-inner">
                    <div class="item-title"> 
                        <h3>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                    </div>

                    <div class="item-content">

                      <div class="item-price"><?php woocommerce_template_loop_price(); ?></div>
                </div>
            </div>
        </div>
<?php  }
}
add_action( 'woocommerce_before_shop_loop_item', 'ostore_woocommerce_before_shop_loop_item', 9 );

add_action( 'woocommerce_before_single_product_summary', 'ostore_woocommerce_single_product_sale_flash', 10 );
if( !function_exists('ostore_woocommerce_single_product_sale_flash')){
    function ostore_woocommerce_single_product_sale_flash(){
        global $post, $product; if ( $product->is_on_sale() ) :
        echo (apply_filters( 'woocommerce_sale_flash', '<div class="icon-sale-label sale-left">' . __( 'Sale', 'ostore' ) . '</div>', $post, $product ));
    endif;
}
}

if (!function_exists('ostore_woocommerce_after_shop_loop_item')) {
    function ostore_woocommerce_after_shop_loop_item(){ ?>
</div>
<!-- End info wrap -->
</div>
</div>
<?php  }
}
add_action( 'woocommerce_after_shop_loop_item', 'ostore_woocommerce_after_shop_loop_item', 11 );


remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
add_filter( 'woocommerce_show_page_title', '__return_false' );


/**
 *
**/

if( !function_exists( 'ostore_woocommerce_result_count' )){
    function ostore_woocommerce_result_count(){
        echo '<div class="toolbar">';
    }
}

add_action( 'woocommerce_before_shop_loop','ostore_woocommerce_result_count', 14 );

if( !function_exists( 'ostore_woocommerce_catalog_ordering' )){
    function ostore_woocommerce_catalog_ordering(){
        echo '</div>';
    }
}
add_action( 'woocommerce_before_shop_loop','ostore_woocommerce_catalog_ordering', 36);


/**
 * WooCommerce Breadcrumbs Section
**/
if( !function_exists( 'ostore_woocommerce_breadcrumb' )){
    function ostore_woocommerce_breadcrumb(){
        do_action( 'breadcrumb-woocommerce' );
    }
}
add_action( 'woocommerce_before_main_content','ostore_woocommerce_breadcrumb', 9 );



/**
 * WooCommerce Number of row filter Function
**/

add_filter('loop_shop_columns', 'ostore_loop_columns');
if (!function_exists('ostore_loop_columns')) {
    function ostore_loop_columns() {
        return 3;
    }
}

add_action( 'body_class', 'ostore_woo_body_class');
if (!function_exists('ostore_woo_body_class')) {
    function ostore_woo_body_class( $class ) {
        $class[] = 'columns-'.ostore_loop_columns();
        return $class;
    }
}

/**
 * Woo Commerce Number of Columns filter Function
**/
add_filter( 'loop_shop_per_page', 'ostore_new_loop_shop_per_page', 20 );
function ostore_new_loop_shop_per_page( $cols ) {
    // $cols contains the current number of products per page based on the value stored on Options -> Reading
    // Return the number of products you wanna show per page.
    return 12;
}

/**
 * Tabs Category Products Ajax Function
**/
if ( ! function_exists( 'ostore_tabs_ajax_action' ) ) {
    function ostore_tabs_ajax_action() {
        $cat_slug    = $_POST['category_slug'];
        $product_num    = $_POST['product_num'];
        ob_start();
        ?>
        <div class="tab-pane active in" id="<?php echo esc_attr( $cat_slug ); ?>">
            <div class="new-arrivals-pro">
                <div class="slider-items-products">
                    <div id="tabs-slider" class="product-flexslider hidden-buttons">
                    <div class="slider-items slider-width-col4">
                        <?php 
                        $product_args = array(
                        'post_type' => 'product',
                        'tax_query' => array(
                            array(
                                'taxonomy'  => 'product_cat',
                                'field'     => 'slug', 
                                'terms'     => $cat_slug                                                                 
                            )),
                        'posts_per_page' => $product_num
                    );
                        $query = new WP_Query($product_args);

                        if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                            ?>
                            <?php wc_get_template_part( 'content', 'product' ); ?>
                            
                            <?php } } wp_reset_query(); ?>
                    </div>
                    </div>
                </div>
        </div>
    </div>

<?php
$sv_html = ob_get_contents();
ob_get_clean();
echo $sv_html;
die();
}
}
add_action( 'wp_ajax_ostore_tabs_ajax_action', 'ostore_tabs_ajax_action' );
add_action( 'wp_ajax_nopriv_ostore_tabs_ajax_action', 'ostore_tabs_ajax_action' );

/*****************************************
 * WooCommerce Single Page
*******************************************/
if( !function_exists('ostore_woocommerce_single_product_image')){
    
        function ostore_woocommerce_single_product_image(){
            global $post, $product;
            $columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
            $thumbnail_size    = apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' );
            $post_thumbnail_id = get_post_thumbnail_id( $post->ID );
            $full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, $thumbnail_size );
            $placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
            $wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
                'woocommerce-product-gallery',
                'woocommerce-product-gallery--' . $placeholder,
                'woocommerce-product-gallery--columns-' . absint( $columns ),
                'images',
            ) );
            ?>
            <div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
                <figure class="woocommerce-product-gallery__wrapper">
                    <?php
                    $attributes = array(
                        'title'                   => get_post_field( 'post_title', $post_thumbnail_id ),
                        'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
                        'data-src'                => $full_size_image[0],
                        'data-large_image'        => $full_size_image[0],
                        'data-large_image_width'  => $full_size_image[1],
                        'data-large_image_height' => $full_size_image[2],
    
                    );
    
                    if ( has_post_thumbnail() ) {
                        $html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'slider-widget' ) . '" class="woocommerce-product-gallery__image "><a href="' . get_the_post_thumbnail_url( $post->ID, 'slider-widget' )  . '" class=" ">';
                        $html .= '<img id="zoom_mw" src="'.get_the_post_thumbnail_url( $post->ID, 'shop_single', $attributes ).'" data-zoom-image="'.get_the_post_thumbnail_url( $post->ID, 'slider-widget' ).'" >';
                        $html .= '</a></div>';
                    } else {
                        $html  = '<div class="woocommerce-product-gallery__image--placeholder">';
                        $html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html_e( 'Awaiting product image', 'ostore' ) );
                        $html .= '</div>';
                    }
    
                    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );
    
                    do_action( 'woocommerce_product_thumbnails' );
                    ?>
                </figure>
            </div>
        <?php
        }
    }
    
    add_action( 'woocommerce_before_single_product_summary', 'ostore_woocommerce_single_product_image', 20 );

/**
 * Product Wishlist Button Function
**/
if (defined( 'YITH_WCWL' )) { 

    function ostore_wishlist_products() {      
      global $product;
      $url = add_query_arg( 'add_to_wishlist', $product->get_id() );
      $id =  $product->get_id();
      $wishlist_url = YITH_WCWL()->get_wishlist_url(); ?>

      <div class="add-to-wishlist-custom add-to-wishlist-<?php echo esc_attr( $id ); ?>">

        <a href="<?php echo esc_url( $url ); ?>" data-toggle="tooltip" data-placement="top" rel="nofollow" data-product-id="<?php echo esc_attr( $id ); ?>" data-product-type="simple" title="<?php __( 'Add to Wishlist', 'ostore' ); ?>" class="add_to_wishlist">
            <i class="fa fa-heart"></i>
        </a>
    </div>
    <?php
}




/**
 * Wishlist Header Count Ajax Function
**/
if ( ! function_exists( 'ostore_wishlist' ) ) {
    function ostore_wishlist() {
        if ( function_exists( 'YITH_WCWL' ) ) {
            global $product;
            $url = add_query_arg( 'add_to_wishlist', $product->get_id() );
            $id =  $product->get_id();
            $wishlist_url = YITH_WCWL()->get_wishlist_url();

            ?>
            <a href="<?php echo esc_url($wishlist_url ); ?>" title="Wishlist" data-toggle="tooltip">
                <div class="count">                            
                    <i class="fa fa-heart"></i>
                    <span class="hidden-xs"><?php esc_attr_e('Wishlist', 'ostore'); ?></span>
                    <span class="badge bigcounter"><?php echo esc_html(yith_wcwl_count_products()); ?></span>
                </div>
            </a>
            <?php
        }
    }
}
add_action( 'wp_ajax__wcwl_update_single_product_list', 'ostore_wishlist' );
add_action( 'wp_ajax_nopriv__wcwl_update_single_product_list', 'ostore_wishlist' );
}

/*
*Top Header Wishlist function
*/
if(!function_exists('ostore_top_wishlist')){
    function ostore_top_wishlist() {
        if (!defined( 'YITH_WCWL' )) return;
        ?>
        <div class="wishlist-wrapper">
            <a class="quick-wishlist" href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url()); ?>" title="<?php echo esc_attr("Wishlist", "ostore"); ?>">
                <i class="fa fa-heart"></i>
                <sup> <?php $wishlist_count = YITH_WCWL()->count_products();
                    echo esc_html($wishlist_count); ?>
                </sup>
            </a>
        </div>
    <?php 
    }
}

/**
 *  Add the Link to Compare Function
**/
if( defined( 'YITH_WOOCOMPARE' ) ){

    function ostore_add_compare_link2( $product_id = false, $args = array() ) {
        extract( $args );

        if ( ! $product_id ) {
            global $product;
            $product_id = ! is_null( $product ) ? yit_get_prop( $product, 'id', true ) : 0;
        }

        // return if product doesn't exist
        if ( empty( $product_id ) || apply_filters( 'yith_woocompare_remove_compare_link_by_cat', false, $product_id ) )
            return;
        
        $is_button = ! isset( $button_or_link ) || ! $button_or_link ? get_option( 'yith_woocompare_is_button' ) : $button_or_link;
        $compare = new YITH_Woocompare_Frontend();
        if ( ! isset( $button_text ) || $button_text == 'default' ) {
            $button_text = get_option( 'yith_woocompare_button_text', __( 'Compare', 'ostore' ) );
            do_action ( 'wpml_register_single_string', 'Plugins', 'plugin_yit_compare_button_text', $button_text );
            $button_text = apply_filters( 'wpml_translate_single_string', $button_text, 'Plugins', 'plugin_yit_compare_button_text' );
        }
        printf( '<a href="%s" class="%s" data-product_id="%d" rel="nofollow"><i class="fa fa-signal"></i></a>', esc_url( $compare->add_product_url( intval($product_id) ) ), 'compare' . ( $is_button == 'button' ? ' button' : '' ), intval($product_id), esc_html($button_text) );
        
    }
    
    function ostore_add_compare_link( $product_id = false, $args = array() ) {
        extract( $args );

        if ( ! $product_id ) {
            global $product;
            $productid = $product->get_id();
            $product_id = isset( $productid ) ? $productid : 0;
        }
        
        $is_button = ! isset( $button_or_link ) || ! $button_or_link ? get_option( 'yith_woocompare_is_button' ) : $button_or_link;

        if ( ! isset( $button_text ) || $button_text == 'default' ) {
            $button_text = get_option( 'yith_woocompare_button_text', esc_html__( 'Compare', 'ostore' ) );
            yit_wpml_register_string( 'Plugins', 'plugin_yit_compare_button_text', $button_text );
            $button_text = yit_wpml_string_translate( 'Plugins', 'plugin_yit_compare_button_text', $button_text );
        }
        printf( '<a title="'. esc_attr( 'Add to Compare', 'ostore' ) .'" href="%s" class="%s" data-product_id="%d" rel="nofollow"><i class="fa fa-signal"></i></a>', '#', 'compare', intval($product_id));
    }


    remove_action( 'woocommerce_after_shop_loop_item',  array( 'YITH_Woocompare_Frontend', 'add_compare_link' ), 20 );



}


/**
 *  Add the Link to Quick View Function
**/

if( defined( 'YITH_WCQV' ) ){
    function ostore_quickview(){
        global $product;
        $quick_view = YITH_WCQV_Frontend();
        remove_action( 'woocommerce_after_shop_loop_item', array( $quick_view, '_add_quick_view_button' ), 15 );
        echo '<a title="'. esc_attr( 'Quick View', 'ostore' ) .'" href="#" class="yith-wcqv-button" data-product_id="' . get_the_ID() . '"> 
        <i class="fa fa-search"></i> 
        </a>';
    }
}

if ( ! function_exists( 'ostore_cart_link' ) ) {
    function ostore_cart_link(){ ?>
        <a class="mini-cart-link cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>">
            <i class="fa fa-shopping-cart"></i>
            <sup><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></sup>
        </a>
    
    <?php
    }
}

 /**
* Cart Function Area
*/
function ostore_top_cart() { ?>
<div class="top-cart-contain">
    <div class="mini-cart">
        <div data-toggle="collapse" data-hover="collapse" class="top_add_cart pull-right" data-target="#top-add-cart">

            <a class="mini-cart-link" id="AddItemCount">
                <i class="fa fa-shopping-cart"></i>
                <sup><?php echo intval(WC()->cart->get_cart_contents_count()); ?></sup>
            </a>
            
        </div>
        <div id="top-add-cart" class="collapse">
            <div class="top-cart-content">
                <div class="block-subtitle"><?php esc_html_e('اخرین محصولات اضافه شده','ostore'); ?></div>
                <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
            </div>
        </div>
    </div>
</div>
<?php 
}




function ostore_woocommerce_header_add_to_cart_fragment($fragments) {
    ob_start();
    ?>
        <a id="AddItemCount" class="mini-cart-link" >
            <i class="fa fa-shopping-cart"></i>
            <sup ><?php echo intval(WC()->cart->get_cart_contents_count()); ?></sup>
        </a>
    <?php
    $fragments['#AddItemCount'] = ob_get_clean();
    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'ostore_woocommerce_header_add_to_cart_fragment');
