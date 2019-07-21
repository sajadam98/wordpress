<?php
 /**
** Adds logo_slider_widget widget.
**/
add_action('widgets_init', 'hot_deal_widget');
function hot_deal_widget() {
    /**
     * Check if WooCommerce is active
     **/
    if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        return;
    }
    register_widget('ostore_hot_deal_widget_area');
}

class ostore_hot_deal_widget_area extends WP_Widget {

    /**
    * Register widget with WordPress.
    **/
    protected $kwidget; 
    public function __construct() {
        parent::__construct(
            'ostore_hot_deal_widget_area', 'OS: HOT DEAL Products', array(
            'description' => __('Display Hot Deal Products Display', 'ostore')
        ));

        $this->kwidget = KWidget::get_instance();
    }
    
    /*
    * prepare fields array
    */
    private function widget_fields() {
        return array( 
			'ostore_hot_deal_title' => array(
                'name' => 'ostore_hot_deal_title',
                'title' => __('Title', 'ostore'),
                'type' => 'text',
                'desc' => ""
			),

			'ostore_hot_deal_desc' => array(
                'name' => 'ostore_hot_deal_desc',
                'title' => __('Very Short Description', 'ostore'),
                'type' => 'textarea',
                'rows'  => 4
			),
			'hot_deal_category_collection' => array(
                'name' => 'hot_deal_category_collection',
                'title' => __('Select Hot Deal Category', 'ostore'),
                'desc'  => __("only shows scheduled products from category", 'ostore'),
                'type'  => 'womulticategory'
			)               
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
        $hot_deal_title = sanitize_text_field( $instance['ostore_hot_deal_title'] ); 
        $hot_deal_short_desc = esc_textarea( $instance['ostore_hot_deal_desc'] );
        $hot_deal_category_collection_id = $instance['hot_deal_category_collection'];
        $categories_id = array();
        if(!empty($hot_deal_category_collection_id)){
            foreach ($hot_deal_category_collection_id as $key => $value) {
                $categories_id[$key] = intval($key);
            }
        }


        $product_args = array(
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
            'posts_per_page' => 4
        );
        
        echo $before_widget; 
        ?>
        <section id="hot-deal" class="ostore-hot-deal">
        <div class="container">
        <?php ostore_title($hot_deal_title,$hot_deal_short_desc) ?>
            <?php
                $query = new WP_Query( $product_args );
                if( $query->have_posts() ) {  while( $query->have_posts() ) { $query->the_post();
            ?>
            <div class="col-md-3 col-sm-6 ostore-hot-deal">
            
            <div <?php post_class('product-item product-hot-item'); ?> >
                <div class="item-inner fadeInUp">
                    <div class="product-thumbnail">
                    <div class="icon-hot-label hot-right"><?php esc_html_e('Hot','ostore'); ?></div>
                        <div class="pr-img-area">
                        <figure>
                            <a href="<?php the_permalink(); ?>">
                            <?php echo get_the_post_thumbnail(get_the_ID(), 'shop_catalog', array( 'class' => 'first-img' ) ); ?> 
                            </a>
                        </figure>
                        <button type="button" class="add-to-cart-mt"> <i class="fa fa-shopping-cart"></i><span><?php woocommerce_template_loop_add_to_cart(); ?> </span> </button>
                    </div>
                            <?php
                                $product_id = get_the_ID();
                                $sale_price_dates_to    = ( $date = get_post_meta( $product_id, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';
                                $price_sale = get_post_meta( $product_id, '_sale_price', true );
                                $date = date_create($sale_price_dates_to);
                                $new_date = date_format($date,"Y/m/d H:i");
                            ?>
                                <div class="box-timer pcountdown-cnt-list-slider">
                                <div class="countbox_1 timer-grid  countdown_<?php echo esc_attr($product_id); ?>">
                                    <div class="day box-time-date"><span class="days"><?php esc_html_e('00','ostore'); ?></span><?php esc_html_e('Days','ostore'); ?></div>
                                    <div class="hour box-time-date"><span class="hours"><?php esc_html_e('00','ostore'); ?></span><?php esc_html_e('Hours','ostore'); ?></div>
                                    <div class="min box-time-date"><span class="minutes"><?php esc_html_e('00','ostore'); ?></span><?php esc_html_e('Mins','ostore'); ?></div>
                                    <div class="sec box-time-date"><span class="seconds"><?php esc_html_e('00','ostore'); ?></span><?php esc_html_e('Secs','ostore'); ?></div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                jQuery(document).ready(function($) {
                                    setTimeout(function(){
                                        jQuery(".countdown_<?php echo esc_attr($product_id); ?>").countdown({
                                            date: "<?php echo esc_attr($new_date); ?>",
                                            offset: -8,
                                            day: "Day",
                                            days: "Days"
                                        }, function () {
                                            console.log("done");
                                            
                                        });
                                    })
                                    
                                }, 900);
                            </script>
                        <?php //} } ?>
                    <div class="pr-info-area">
                    <div class="pr-button">
                	    <div class="mt-button add_to_wishlist-1">
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
                    <div class="item-info">
                        <div class="info-inner">
                        <div class="item-title"> <a  href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </div>
                        <div class="item-content">
                        <div class="rating">
                                <span> <?php ostore_get_star_rating() ?> </span>  
                            </div>
                            <div class="item-price">
                            <div class="price-box"> <span class="regular-price"> <span class="price"><?php woocommerce_template_loop_price(); ?></span> </span> </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <?php 
                }
            }else{
                echo "<p>".esc_html('No products found!','ostore')."</p>";
            }
            ?>
            </section>
        <?php      
        echo $after_widget;
    }
}