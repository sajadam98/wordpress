<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package oStore
 */
?>
	</div><!-- #content -->

  <?php 
  $subscribe_enable = get_theme_mod('ostore_subscribe_enable',false);
  $social_links_enable = get_theme_mod('ostore_social_links_enable',false);
  if( $subscribe_enable == true or $social_links_enable == true) : ?>
	<!-- Footer -->
  <div class="footer-newsletter">
    <div class="container">
      
      <div class="row">
        <?php 
        $subscribe_enable = get_theme_mod('ostore_subscribe_enable');
        if($subscribe_enable==true){
          ostore_subscription();
        } 
        if($social_links_enable==true){ ?>
          <div class="social col-md-4 col-sm-5">
              <?php ostore_social_links(); ?>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
  
  <footer class="ostore-footer">
    <?php if( is_active_sidebar('first_footer') OR 
      is_active_sidebar('second_footer') OR is_active_sidebar('third_footer') OR
      is_active_sidebar('forth_footer') OR is_active_sidebar("fifth_footer")): ?>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-xs-12 col-lg-4">
              <?php dynamic_sidebar( 'first_footer' ); ?>
        </div>
        <div class="col-sm-6 col-md-3 col-xs-12 col-lg-2 collapsed-block">
            <?php dynamic_sidebar( 'second_footer' ); ?>
        </div>
        <div class="col-sm-6 col-md-3 col-xs-12 col-lg-2 collapsed-block">
            <?php dynamic_sidebar( 'third_footer' ); ?>
        </div>
        <div class="col-sm-6 col-md-3 col-xs-12 col-lg-2 collapsed-block">
            <?php dynamic_sidebar( 'forth_footer' ); ?>
        </div>
        <div class="col-sm-6 col-md-3 col-xs-12 col-lg-2 collapsed-block">
            <?php dynamic_sidebar( 'fifth_footer' ); ?>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <div class="footer-coppyright">
      <div class="container">
        <div class="row">
          <?php do_action('ostore_footer_copyright_section'); 
          if(get_theme_mod('ostore_btn_social_enable')==1): ?>
            <div class="footer-social col-sm-4 col-xs-12">
              <?php do_action("ostore_footer_social_links"); ?>
            </div>
          <?php endif;
            do_action('ostore_footer_payment_logo');
          ?>
        </div>
      </div>
    </div>
  </footer>
  
  <a href="#" class="totop"><i class="fa fa-angle-up"></i></a> 
</div>
<?php wp_footer(); ?>
</body>
</html>