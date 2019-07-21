<?php
/**
** Adds oStore_category_collection_widget widget.
**/
add_action('widgets_init', 'ostore_category_collection_widget');
function ostore_category_collection_widget() {
    /**
     * Check if WooCommerce is active
     **/
    if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        return;
    }
        
    register_widget('ostore_category_collection_widget_area');
}
class ostore_category_collection_widget_area extends WP_Widget {
    /**
    * Register widget with WordPress.
    **/
    protected $kwidget; 
    public function __construct() {
        parent::__construct(
            'ostore_category_collection_widget_area', 'OS: Woo Category Collection', array(
            'description' => __('Widget that show woocommerce category collection with feature image', 'ostore')
        ));

        $this->kwidget = KWidget::get_instance();
    }
    
    /*
    * prepare fields array
    */
    private function widget_fields() {
        return array( 
            
            'ostore_collection_title' => array(
                'name' => 'ostore_collection_title',
                'title' => __('Title', 'ostore'),
                'type' => 'text'
            ),

            'ostore_collection_desc' => array(
                'name' => 'ostore_collection_desc',
                'title' => __('Very Short Description', 'ostore'),
                'type' => 'textarea',
                'rows'  => 4
            ),
            
            'ostore_category_collection' => array(
                'name' => 'ostore_category_collection',
                'title' => __('Select Lists Collection Category', 'ostore'),
                'type' => 'womulticategory'
            ),
            'ostore_collection_option' => array(
                'name' => 'ostore_collection_option',
                'title' => __('Collection Show Style', 'ostore'),
                'type' => 'radio',
                'options' => array(
                    'style1' => __("Style 1", 'ostore'),
                    'style2' => __("Style 2", 'ostore'),
                )
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
        $collection_title = sanitize_text_field( $instance['ostore_collection_title']); 
        $collection_desc = wp_kses_post( $instance['ostore_collection_desc'] );
        $ostore_collection_id = $instance['ostore_category_collection'];
        $ostore_collection_style = sanitize_text_field( $instance['ostore_collection_option'] );
        echo $before_widget; 
    
        if($ostore_collection_style == 'style1'): ?>
            <div class="ostore-bottom-banner-section">   
                <div class="container">
                <div class="row">
                <?php ostore_title($collection_title,$collection_desc); ?>
                <?php  foreach($ostore_collection_id as $ostore_cat => $cat_name){ 
                    $term = get_term_by( 'id', intval($ostore_cat), 'product_cat');
                    //Category Image
                    $thumbnail_id = get_woocommerce_term_meta( intval($ostore_cat), 'thumbnail_id', true );
                    $image = wp_get_attachment_url( $thumbnail_id );
                ?>
                    <div class="col-md-4 col-sm-4"> 
                        <a href="<?php echo esc_url(get_term_link(intval($ostore_cat), 'product_cat')); ?>" class="ostore-bottom-banner-img">
                            <div class="overimg">
                                <img src="<?php echo esc_url($image); ?>" alt=""  />
                            </div>
                            <span class="ostore-banner-overly"></span>
                            <div class="bottom-img-info">
                                <h3><?php echo esc_html( $term->name ); ?></h3>
                                <h6><?php echo wp_kses_post(substr($term->description,0,40) ); ?></h6>
                                <span class="shop-now-btn"><?php esc_html_e('View more','ostore'); ?></span>
                            </div>
                        </a>
                    </div>
                <?php  } ?>    
                </div>
                </div>
            </div>
        
        <?php else: ?>
        <!-- end main container --> 
        <div class="ostore-bottom-banner-section">   
                <div class="container">
                <div class="row">
                <div class="heading">  
                <?php if(!empty($collection_title)): ?><div class="hr-title hr-long center"><span><?php echo esc_html($collection_title); ?></span> </div><?php endif; ?>
                    <?php if(!empty($collection_desc)): ?> <p class="ostore-hot-deal-desc"><?php echo esc_html($collection_desc); ?></p> <?php endif; ?>
                </div>
                <?php  
                $count = 0 ;
                foreach($ostore_collection_id as $ostore_cat => $cat_name){ 
                    $term = get_term_by( 'id', intval($ostore_cat), 'product_cat');
                    
                    //Category Image
                    $thumbnail_id = get_woocommerce_term_meta( $ostore_cat, 'thumbnail_id', true );
                    $image = wp_get_attachment_url( $thumbnail_id );
                ?>
                <?php if($count % 6 == 0): ?>
                <div class="col-md-8 ">    
                <?php else: ?> 
                    <div class="col-md-4 col-sm-6 ">
                <?php endif; ?>
                    <a href="<?php echo esc_url(get_term_link($ostore_cat, 'product_cat')); ?>" class="ostore-bottom-banner-img">
                    <div class="overimg"> 
                        <img src="<?php echo esc_url( $image ); ?>" class="catgory-collection-img" alt=""  />
                    </div>
                    <span class="ostore-banner-overly"></span>
                        <div class="bottom-img-info">
                            <h3><?php echo esc_html( $term->name ); ?></h3>
                            <h6><?php echo wp_kses_post(substr($term->description,0,100)); ?></h6>
                            <span class="shop-now-btn"><?php esc_html_e('View more','ostore'); ?></span> </div>
                        </a>
                    </div>
                <?php $count++;  } ?>    
                </div>
                </div>
            </div>
        
        <?php endif;          
        echo $after_widget;
    }
}
