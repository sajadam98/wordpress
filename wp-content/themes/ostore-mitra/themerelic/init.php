<?php
/**
 * oStore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package oStore
 */
if( !function_exists('ostore_file_directory') ){

    function ostore_file_directory( $file_path ){
        if( file_exists( trailingslashit( get_stylesheet_directory() ) . $file_path) ) {
            return trailingslashit( get_stylesheet_directory() ) . $file_path;
        }
        else{
            return trailingslashit( get_template_directory() ) . $file_path;
        }
    }
}

/**
 * Load KCustomizer Class for customizer 
 */
require ostore_file_directory('themerelic/KCustomizer.php');

/**
 * Load Header Class File 
 */
require ostore_file_directory('themerelic/hooks/woocommerce.php');
require ostore_file_directory('themerelic/hooks/ostore-hook.php');
/**
* Customizer
**/
require ostore_file_directory('themerelic/customizer.php');

require ostore_file_directory('themerelic/KWidget.php');

/**
* Widgets
**/
require ostore_file_directory('themerelic/widgets/category-collections.php');
require ostore_file_directory('themerelic/widgets/tab.php');
require ostore_file_directory('themerelic/widgets/blog.php');
require ostore_file_directory('themerelic/widgets/hot-deal.php');
require ostore_file_directory('themerelic/widgets/services-box.php');
require ostore_file_directory('themerelic/widgets/hlp-products.php');
require ostore_file_directory('themerelic/widgets/banner.php');