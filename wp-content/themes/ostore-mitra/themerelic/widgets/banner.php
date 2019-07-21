<?php
// Register the news section
function ostore_banner_widget() { 
  register_widget( 'ostore_banner' );
}
add_action( 'widgets_init', 'ostore_banner_widget' );

class ostore_banner extends WP_Widget {
  // Set up the news section widget 
  public function __construct() {
     parent::__construct(
            'ostore_banner', esc_html__('OS : Home Banner ', 'ostore'), array(
            'description' => esc_html__('Ostore Banner Section', 'ostore')
        ));
    }

    // Create the News section widget output.
  public function widget( $args, $instance ) {
      $banner_title = $instance[ 'title' ];
      $banner_desc = $instance['banner_description'];
      $banner_img_id = $instance[ 'background-img-id' ];
      $banner_img_url = wp_get_attachment_image_src( $banner_img_id, 'homepage-thumb' );
      $banner_btn_url = $instance[ 'banner_btn_url' ];
      echo $args['before_widget']; ?>
        <!-- .fullwidth -->
        <div class="discount parallax_3" style="background-image:url(<?php echo esc_url($banner_img_url[0]); ?>);">
            <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix text-center">
                  <div class="discount-info"> 
                    <span class="discount-info_small_txt wow fadeInUp text-center" data-wow-delay="0.6s" data-wow-duration="2s"><?php echo esc_html($banner_desc); ?></span> 
                    <span class="discount-info_shadow_txt wow fadeIn text-center" data-wow-delay="0.8s" data-wow-duration="2s"><?php echo esc_html($banner_title); ?></span> 
                    <a href="<?php echo esc_url($banner_btn_url); ?>" class="view" >
                      <?php esc_html_e('VIEW COLLECTION','ostore'); ?>
                    </a> 
                  </div>
                </div>
            </div>
            </div>
        </div>
        <!--news start-->
      <?php echo $args['after_widget'];
  }

  // Apply settings to the widget instance News Main Slider.
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance = $old_instance;
    $instance[ 'title' ] =  sanitize_text_field($new_instance[ 'title' ]) ;
    $instance['banner_description'] =  wp_kses_post($new_instance['banner_description' ]) ;
    
    $instance[ 'background-img-id' ] =  absint($new_instance[ 'background-img-id' ]) ;
    $instance[ 'banner_btn_url' ] =  esc_url_raw($new_instance[ 'banner_btn_url' ]) ;
    return $instance;
  }

  // Create the admin area widget settings form News Banner Promo Slider.
  public function form( $instance ) {
 
  $title = isset($instance['title']) ? $instance['title'] : '';
  $banner_description = isset($instance['banner_description']) ? $instance['banner_description'] : '';
  $background_img_id =  isset($instance['background-img-id']) ? $instance['background-img-id'] : '';
  $background_img_src = wp_get_attachment_image_src( $background_img_id, 'homepage-thumb' ); 
  $banner_btn_url = isset($instance['banner_btn_url']) ? $instance['banner_btn_url'] : '';
?>

  <table class="news_widget">
    <tr>
      <td>
      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:','ostore'); ?></label>
      </p>
      </td>
      <td>
        <input type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr( $title ); ?>" />
      </td>
    </tr>

    <tr>
      <td>
      <p>
        <label for="<?php echo esc_attr($this->get_field_id('banner_description')); ?>"><?php esc_html_e('Description:','ostore'); ?></label>
      </p>
      </td>
      <td>
      <input type="textarea" cols="35"  id="<?php echo esc_attr($this->get_field_id( 'banner_description' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'banner_description' )); ?>" value="<?php echo esc_textarea($banner_description); ?>" />
      </td>
    </tr>
    
    <tr>
      <td colspan="2">
        <label for="<?php echo esc_attr($this->get_field_id( 'background-img-id' )); ?>"><p><?php esc_html_e('Background:','ostore'); ?><p></label>
        <div id="bg-img-container" class="bg-img-container" style="text-align: center;" >
            <img src="<?php echo esc_url($background_img_src[0]); ?>" style="max-height:200px;"/>
        </div>
        <p>
        <input type="button" id="category_background" class ="category_background" value="<?php esc_attr_e("Add/Chnage Image", "ostore");?>" />
        <input type="button" class="category_background_remove" value="<?php esc_attr_e( 'Remove', 'ostore' ); ?>" />
        </p>
        <input type="hidden" id="<?php echo esc_attr($this->get_field_id( 'background-img-id' )); ?>" class="background-img-id" name="<?php echo esc_attr($this->get_field_name( 'background-img-id' )); ?>" value="<?php echo intval( $background_img_id ); ?>" />
      </td>
    </tr>

    <tr>
      <td>
      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'banner_btn_url' )); ?>"><?php esc_html_e('Button URL:','ostore'); ?></label>
      </p>
      </td>
      <td>
      <input type="text" id="<?php echo esc_attr($this->get_field_id( 'banner_btn_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'banner_btn_url' )); ?>" value="<?php echo esc_url( $banner_btn_url ); ?>" />
      </td>
    </tr>

 </table>

  <?php 
  }
}