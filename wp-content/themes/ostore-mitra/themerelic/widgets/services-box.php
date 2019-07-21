<?php
 /**
** Adds ostore_service_box_widget widget.
**/
add_action('widgets_init', 'ostore_service_box_widget');
function ostore_service_box_widget() {
    register_widget('ostore_service_box_widget_area');
}

class ostore_service_box_widget_area extends WP_Widget {

    /**
    * Register widget with WordPress.
    **/
    protected $kwidget; 
    public function __construct() {
        parent::__construct(
            'ostore_service_box_widget_area', 'OS: Service Box', array(
            'description' => __('widget that show service box section', 'ostore')
        ));

        $this->kwidget = KWidget::get_instance();
    }
    /*
    * prepare fields array
    */
    private function widget_fields() {
    return array( 
        
            'ostore_service_box_1_title' => array(
                'name' => 'ostore_service_box_1_title',
                'title' => __('Box 1 Title', 'ostore'),
                'type' => 'text',           
            ),
            'ostore_service_box_1_desc' => array(
                'name' => 'ostore_service_box_1_desc',
                'title' => __('Box 1 Very Short Description', 'ostore'),
                'type' => 'textarea',
                'rows'  => 4
            ),
            'ostore_service_box_1_icon' => array(
                'name' => 'ostore_service_box_1_icon',
                'title' => __('Box 1 Font Awesome Icon', 'ostore'),
                'type' => 'fa-icons'
            ),
            //Service box 2
            'ostore_service_box_2_title' => array(
                'name' => 'ostore_service_box_2_title',
                'title' => __('Box 2 Title', 'ostore'),
                'type' => 'text',
            ),
            'ostore_service_box_2_desc' => array(
                'name' => 'ostore_service_box_2_desc',
                'title' => __('Box 2 Short Description', 'ostore'),
                'type' => 'textarea',
                'rows'  => 4
            ),
            'ostore_service_box_2_icon' => array(
                'name' => 'ostore_service_box_2_icon',
                'title' => __('Box 2 Font Awesome Icon', 'ostore'),
                'type' => 'fa-icons'
            ),
            //Service Box 3
            
            'ostore_service_box_3_title' => array(
                'name' => 'ostore_service_box_3_title',
                'title' => __('Box 3 Title', 'ostore'),
                'type' => 'text',
            ),
            'ostore_service_box_3_desc' => array(
                'name' => 'ostore_service_box_3_desc',
                'title' => __('Box 3 Short Description', 'ostore'),
                'type' => 'textarea',
                'rows'  => 4
            ),
            'ostore_service_box_3_icon' => array(
                'name' => 'ostore_service_box_3_icon',
                'title' => __('Box 3 Font Awesome Icon', 'ostore'),
                'type' => 'fa-icons'
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
        $service_box_text_1 = sanitize_text_field( $instance['ostore_service_box_1_title'] );
        $service_box_text_2 = sanitize_text_field( $instance['ostore_service_box_2_title'] );
        $service_box_text_3 = sanitize_text_field( $instance['ostore_service_box_3_title'] );

        $service_box_desc_1 = esc_textarea( $instance['ostore_service_box_1_desc'] );
        $service_box_desc_2 = esc_textarea( $instance['ostore_service_box_2_desc'] );
        $service_box_desc_3 = esc_textarea( $instance['ostore_service_box_3_desc'] );

        $service_box_icon_1 = esc_attr( $instance['ostore_service_box_1_icon'] );
        $service_box_icon_2 = esc_attr( $instance['ostore_service_box_2_icon'] );
        $service_box_icon_3 = esc_attr( $instance['ostore_service_box_3_icon'] );
        echo $before_widget; 
        ?>  
        <div class="row column-no-padding ">
        <?php
            //Service Box first 
            ostore_services_area($service_box_icon_1,$service_box_text_1, $service_box_desc_1); 
            //Service Box Second
            ostore_services_area($service_box_icon_2,$service_box_text_2, $service_box_desc_2);
            //Service Box Third
            ostore_services_area($service_box_icon_3,$service_box_text_3, $service_box_desc_3);
        ?>
        </div>
        <?php       
        echo $after_widget;
    }
}