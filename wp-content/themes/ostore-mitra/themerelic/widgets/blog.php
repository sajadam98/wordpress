<?php
 /**
** Adds Blog widget.
**/
add_action('widgets_init', 'blog_widget');
function blog_widget() {
	register_widget('blog_widget_area');
}
class blog_widget_area extends WP_Widget {

    /**
    * Register widget with WordPress.
    **/
    protected $kwidget; 
    public function __construct() {
    	parent::__construct(
    		'blog_widget_area', 'OS: Home Blog Slider', array(
    			'description' => esc_html__('Blog Description', 'ostore')
    		));

    	$this->kwidget = KWidget::get_instance();
    }
    
    /*
    * prepare fields array
    */
    private function widget_fields() {
    	return array( 
    		'ostore_home_blog_title' => array(
    			'name' => 'ostore_home_blog_title',
    			'title' => __('Title', 'ostore'),
    			'type' => 'text',
    			'desc' => ""
    		),
    		'ostore_home_blog_desc' => array(
    			'name' => 'ostore_home_blog_desc',
    			'title' => __('Very Short Description', 'ostore'),
    			'type' => 'textarea',
    			'rows'  => 4
    		),  
    		'category_home_blog' => array(
    			'name' => 'category_home_blog',
    			'title' => __('Select Lists Collection Category', 'ostore'),
    			'type' => 'category',
    			'desc' => 'for multiple category chose pro version'
    		),
    		'ostore_home_blog_number' => array(
    			'name' => 'ostore_home_blog_number',
    			'title' => __('Number of post', 'ostore'),
    			'type' => 'number',
    			"default" => 4

    		),
    		'ostore_home_select_view' => array(
    			'name' => 'ostore_home_select_view',
    			'title' => __('Select View', 'ostore'),
    			'type' => 'select',
    			'options'=> array(
    				'grid'=> __('Grid View', 'ostore'),
    				'list'=> __('List View', 'ostore')
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
        $home_blog_title = sanitize_text_field($instance['ostore_home_blog_title']); 
        $home_blog_short_desc = wp_kses_post( $instance['ostore_home_blog_desc'] );
        $home_blog_category_id = intval($instance['category_home_blog']);
        $home_blog_product_count = intval($instance['ostore_home_blog_number']);
        $home_ostore_home_select_view = sanitize_text_field( $instance['ostore_home_select_view']);

        echo $before_widget; 
        ?>
        <?php if($home_ostore_home_select_view=='grid'){ ?>
        <section class="blog_post bounceInUp animated">
        	<div class="container"> 
        		<!-- row -->
        		<div class="row item wow zoomIn"> 
        			<!-- Center colunm-->
        			<div class="col-xs-12 col-sm-12">
						<?php ostore_title($home_blog_title,$home_blog_short_desc); ?>
        				<ul class="blog-posts blog-wrapper">
        					<?php 
        					$args = array('post_type'=>'post','posts_per_page'=>$home_blog_product_count,'cat'=>$home_blog_category_id);
        					$query = new WP_Query( $args ); 
        					?>
        					<!-- Item -->
        					<?php while($query->have_posts()): $query->the_post(); ?>
        						<li class="post-item  col-md-4 col-sm-12">
        							<article class="entry"> 
        								<div class="row">
        									<?php if(has_post_thumbnail()): ?>
        									<div class="col-md-12 col-sm-6">
        										<div class="entry-thumb image-hover2"> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <figure><?php  the_post_thumbnail('ostore-blog-image'); ?> </figure> </a> </div>
        									</div>
        									<?php endif; ?>
        									<div class="col-md-12 col-sm-6">
        										<div class="content-meta ostore-home-blog-meta">
        											<h3 class="entry-title">
        											    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        											</h3>
        											<div class="entry-meta-data ">
        											    <span class="author"> <i class="fa fa-user"></i>&nbsp; <?php esc_attr_e('By:', 'ostore'); ?>
        											    <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><?php echo  esc_html(get_the_author()); ?></a>
        											    </span>  
        											    <span class="comment-count"> 
        											        <a href="javascript:void()"><i class="fa fa-comment"></i>&nbsp;
        											        <?php printf( esc_html( _n( '%d Comment', '%d Comments', get_comments_number(), 'ostore'  ) ), esc_html(number_format_i18n(get_comments_number()))); ?>
        											        </a> 
        											     </span> 
        											     <span class="date">
        											         <i class="fa fa-calendar"></i>&nbsp; <?php the_date(get_option('date_format')); ?>
        											     </span> 
        											 </div>

        											<div class="entry-excerpt"><?php echo esc_html(substr(get_the_excerpt(),0,120)); ?></div>
        											<div class="entry-more"> <a href="<?php the_permalink(); ?>" class="readMore"><?php esc_html_e('Read more','ostore'); ?>&nbsp; <i class="fa fa-angle-double-right"></i></a> </div>
        										</div>
        									</div>
        								</article>

        							</li>
        						<?php endwhile; ?>

        					</ul>
        				</div>
        			</div>       <!-- ./ Center colunm --> 
        		</div>
        		<!-- ./row--> 
        	</div>
        </section>
        <?php }else{ ?>
        <!-- Main Container -->
        <section class="blog_post bounceInUp animated">
        	<div class="container">
        		<!-- row -->
        		<div class="row"> 
        			<!-- Center colunm-->
        			<div class="center_column col-xs-12 col-sm-12" id="center_column">
        				<div class="heading">  
        					<?php if(!empty($home_blog_title)): ?><div class="hr-title ostore-tab-hr-title hr-long center"><span><?php echo esc_html($home_blog_title); ?></span> </div><?php endif; ?>
        					<?php if(!empty($home_blog_short_desc)): ?> <p class="ostore-hot-deal-desc"><?php echo esc_html($home_blog_short_desc); ?></p> <?php endif; ?>
        				</div>
        				<ul class="blog-posts">
        					<?php 
        					$args = array('post_type'=>'post','posts_per_page'=>$home_blog_product_count,'cat'=>$home_blog_category_id);
        					$query = new WP_Query( $args ); 
        					while($query->have_posts()): $query->the_post(); ?>
        					<li class="post-item wow fadeInUp">
        						<article class="entry">
        							<div class="row">
										<?php
											$col = 8;
											if(has_post_thumbnail()): ?>
												<div class="col-sm-12 col-md-4">
													<div class="entry-thumb image-hover2"> <a href="<?php the_permalink(); ?>">
														<figure class="ostore-img">
															<?php  the_post_thumbnail('ostore-blog-image'); ?>
														</figure>
													</a> </div>
												</div>
											<?php else: $col = 12; endif; ?>
        								<div class="col-sm-12 col-md-<?php echo esc_attr($col); ?>">
        									<div class="list-blog-post">
        										<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        										<div class="entry-meta-data"> <span class="author"> <i class="fa fa-user"></i>&nbsp; <?php esc_attr_e('By:', 'ostore');?> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><?php echo esc_html(get_the_author()); ?></a></span> <span class="cat">  <span class="comment-count"> <a href=""><i class="fa fa-comment"></i>&nbsp;<?php printf( esc_html( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'ostore' ), esc_html(number_format_i18n( get_comments_number() ) ));	 ?></span></a> <span class="date"><i class="fa fa-calendar"></i>&nbsp; <?php the_date(get_option('date_format')); ?></span> </div>
        										<div class="entry-excerpt"><?php echo wp_kses_post(get_the_excerpt()); ?></div>
        										<div class="entry-more"> <a href="<?php the_permalink(); ?>" class="button"> <?php esc_html_e('Continus reading','ostore'); ?> &nbsp; <i class="fa fa-angle-double-right"></i></a> </div>
        									</div>
        								</div>
        							</div>
        						</article>
        					</li> 
        				<?php endwhile; ?>

        			</ul>  
        		</div>
        		<!-- ./ Center colunm --> 
        	</div>
        	<!-- ./row--> 
        </div>
    </section>
    <!-- Main Container End --> 
    <?php }        
    echo $after_widget;
}
}