<?php
// Setup Ajax action hook
add_action( 'wp_ajax_category_tab_products','ganesh_store_category_tab_products');
if ( ! function_exists( 'ganesh_store_category_tab_products' ) ) {  
	function ganesh_store_category_tab_products(){
		$tab_category_id = $_POST['post_id']; 
		$tab_product_count = $_POST['post_id1']; 
		$html = ob_start();
	?>
	    <div class="tabs-panel is-active" id="<?php  ?>">
		    <div class="container-grid grid-x grid-margin-x ">
				<?php 
				/*Loop the Products */
                $product_args = array(
                        'post_type' => 'product',
                        'tax_query' => array(
                            array(
                                'taxonomy'  => 'product_cat',
                                'field'     => 'term_id', 
                                'terms'     => $tab_category_id                                                                 
                            )),
                        'posts_per_page' => $tab_product_count
                    );
                    $query = new WP_Query($product_args);
                    if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                        
                        echo wc_get_template_part( 'content', 'product' ); 
                    } } wp_reset_postdata(); 
                    ?>
			</div>
		</div>
    <?php
    
    $html = ob_get_contents();
    ob_end_clean();
    echo $html;
    	exit;
	}
}