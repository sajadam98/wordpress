<?php
/**
 * The search form containing the search form html
 *
 *
 * @package oStore
 */
 ?>
<div class="block clearfix">
<form role="search"  method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
    <div class="form-group has-feedback">
        <input  type="search" class="form-control" placeholder="<?php echo esc_html_e( 'Search', 'ostore' ) ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s">
        <i class="fa fa-search form-control-feedback"></i>
    </div>
</form>
</div>