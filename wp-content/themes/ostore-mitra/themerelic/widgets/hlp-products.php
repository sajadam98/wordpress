<?php
 /**
** Adds oStore_category_collection_widget widget.
**/
add_action('widgets_init', 'ostore_hlp_products_widget');
function ostore_hlp_products_widget() {
    /**
     * Check if WooCommerce is active
     **/
    if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        return;
    }
        
    register_widget('ostore_hlp_products_widget_area');
}
class ostore_hlp_products_widget_area extends WP_Widget {

    /**
    * Register widget with WordPress.
    **/
    protected $kwidget; 
    public function __construct() {
        parent::__construct(
            'ostore_hlp_products_widget_area', 'OS: HLP Products', array(
            'description' => __('widget that show Hot Deal , Latest Products and Popular Products section', 'ostore')
        ));

        $this->kwidget = KWidget::get_instance();
    }
    
    /*
    * prepare fields array
    */
    private function widget_fields() {
    return array( 
        'ostore_hlp_products_style' => array(
            'name' => 'ostore_hlp_products_style',
            'title' => __('HLP Products Style', 'ostore'),
            'type' => 'select',
            'options' => array(
                'style1' => __("Style 1", 'ostore'),
                'style2' => __("Style 2", 'ostore')
            )
            ),
            'ostore_hot_deal_cat' => array(
            'name' => 'ostore_hot_deal_cat',
            'title' => __('HLP Category', 'ostore'),
            'type' => 'womulticategory',
            'desc' => "Hot, Latest and Popular"
            ),
                        
        );
    } 
    /**
    * Update Form Vlaue 
    */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $widget_fields = $this->widget_fields();
        foreach ($widget_fields as $widget_field) {
            extract($widget_field);
            $instance[$name] = $this->kwidget->update($widget_field, $new_instance[$name]);
        }
        return $instance;
    }

    /**
    * Backend Form 
    **/
    public function form($instance) {
        $widget_fields = $this->widget_fields();
        foreach ($widget_fields as $widget_field) {
            extract($widget_field);
            $widgets_field_value = !empty($instance[$name]) ? $instance[$name] : '';
            $this->kwidget->prepare($this, $widget_field, $widgets_field_value);
        }
    }

    /**
    * Display section(frontend)
    */
    public function widget($args, $instance) {
        extract($args);
        extract($instance);

        /**
        * wp query for first block
        **/  
        $hlp_style = sanitize_text_field( $instance['ostore_hlp_products_style'] );
        $categories_hot_deal = $instance['ostore_hot_deal_cat'];
        if(!is_array($categories_hot_deal )){
            $categories_hot_deal  = array();
        }
        $default_cat_query = new WP_Query($args);

        $categories_id = array();
        foreach ($categories_hot_deal as $key => $tempval) {
            $categories_id[$key] = intval($key);
        }

        $hot_deal_product_args = array(
            'post_type' => 'product',
            'tax_query' => array(
                array('taxonomy'  => 'product_cat',
                    'field'     => 'term_id',
                    'terms'     => $categories_id,
                )
            ),
            'meta_query'     => array(
                array(
                    'key'           => '_sale_price_dates_to',
                    'value'         => 0,
                    'compare'       => '>',
                    'type'          => 'numeric'
                )
            ),
            'posts_per_page' => 2
        );

        echo $before_widget;

        ?>
            <section class="ostore_hlp_product_area">
                <!-- End page header-->
                <div class="container">
                <div class="row">
                    <!-- Start Hot Deal Product -->
                    <?php if($hlp_style=='style1'){  
                        do_action('ostore_hlp_hot_deal_product',$hot_deal_product_args); 
                    } ?> 
                    <!-- Statrt Latest Products -->
                    <div class="col-md-4 col-sm-6 col-lg-4">
                    <div <?php post_class('panel_product ostore-hlp-panel-products'); ?> >
                        <h2 class="ostore_hlp_title"><?php esc_html_e('Lastest Products','ostore'); ?></h2>

                        <?php
                            $latest_product_args = array(
                                'post_type' => 'product',                             
                                'posts_per_page' => 4
                            );
                            $query = new WP_Query($latest_product_args);
                            if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                        ?>
                        <div class="ostore_hlp_single_panel_product">
                        <div class="ostore_hlp_panel_left">
                            <div class="panelp_img"> <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('ostore-hlp-products'); ?></a> </div>
                        </div>
                        <div class="osote_hlp_panel_right">
                            <div class="ostore_hlp_des fix">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="price">
                                <div class="price-box"> <span class="regular-price"> <span class="price"><?php woocommerce_template_loop_price(); ?></span> </span> </div>
                                <div class="rating">
                                    <span><?php  ostore_get_star_rating(); ?></span>  
                                </div>
                                <div class="ostore_hlp_actions"> 
                                    <?php 
                                        if(function_exists( 'ostore_wishlist' )) { ostore_wishlist_products(); } 
                                        if(function_exists('ostore_quickview')){ostore_quickview();} 
                                        if(function_exists('ostore_add_compare_link')){ostore_add_compare_link();} 
                                    ?>
                                </div>
                                
                            </div>
                            </div>
                        </div>
                        </div>
                        <?php }} ?>
                        
                    </div>
                    </div><!-- End Latest Product -->
                    <!-- Start Hot Deal Product -->
                    <!-- Start Hot Deal Product -->
                    <?php if($hlp_style=='style2'){  
                         do_action('ostore_hlp_hot_deal_product',$hot_deal_product_args); 
                     } ?>  
                    <!-- End Hot Deal Poduct -->
                    <div class="col-md-4 col-sm-12 col-lg-4">
                    <div <?php post_class('panel_product ostore-hlp-panel-products'); ?>  >
                        <h2 class="ostore_hlp_title popular"><?php esc_html_e('Popular Products','ostore'); ?></h2>
                        <?php
                            $ostore_hotdeal_label = esc_html__('New', 'ostore');
                            $upsell_product = array(
                                'post_type'         => 'product',
                                'meta_key'          => 'total_sales',
                                'orderby'           => 'meta_value_num',
                                'posts_per_page'    => 4
                            );
                            $query = new WP_Query($upsell_product);
                            if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                        ?>
                        <div class="ostore_hlp_single_panel_product">
                        <div class="ostore_hlp_panel_left">
                            <div class="panelp_img"> <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('ostore-hlp-products'); ?></a> </div>
                        </div>
                        <div class="osote_hlp_panel_right">
                            <div class="ostore_hlp_des fix popular-product">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="ostore-hlp-desc hidden-lg hidden-md hidden-xs"><p><?php the_excerpt(); ?></p></div>
                            <div class="price">
                                <div class="price-box"> <span class="regular-price"> <span class="price"><?php woocommerce_template_loop_price(); ?></span> </span> </div>
                                <div class="rating">
                                    <span><?php  ostore_get_star_rating()  ?></span>  
                                </div>
                                <div class="ostore_hlp_actions"> 
                                    <?php 
                                        if(function_exists( 'ostore_wishlist_products' )) { ostore_wishlist_products(); }  
                                        if(function_exists('ostore_quickview')){ostore_quickview();} 
                                        if(function_exists('ostore_add_compare_link')){ostore_add_compare_link();} 
                                    ?>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <?php }} ?>
                    </div>
                    </div>
                    
                </div>
                </div>
            </section>        
        <?php        
        echo $after_widget;
    }
}