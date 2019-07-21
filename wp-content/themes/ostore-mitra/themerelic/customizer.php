<?php
    /**
    * oStore Theme Customizer
    *
    * @package oStore
    */

    /**
    * Add postMessage support for site title and description for the Theme Customizer.
    *
    * @param WP_Customize_Manager $wp_customize Theme Customizer object.
    */

    class oStoreCustomizer{
        function __construct(){
            add_action( 'customize_register', array($this,'ostore_general_customize') );
            add_action( 'customize_register', array($this,'ostore_header_customizer') );
            add_action( 'customize_register', array($this,'ostore_slider_customizer') );
            add_action('customize_register',array($this,'ostore_footer_customizer'));
    
        }
        function __destruct() {
            $vars = array_keys(get_defined_vars());
            for ($i = 0; $i < sizeOf($vars); $i++) {
                unset($vars[$i]);
            }
            unset($vars,$i);
        }
        public static function get_instance() {
            static $instance;
            $class = __CLASS__;
            if( ! $instance instanceof $class) {
                $instance = new $class;
            }
            return $instance;
        }

        function ostore_general_customize( $wp_customize ) {
            $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
            $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
            $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

            if ( isset( $wp_customize->selective_refresh ) ) {
                $wp_customize->selective_refresh->add_partial( 'blogname', array(
                    'selector'        => '.site-title a',
                    'render_callback' => 'ostore_customize_partial_blogname',
                ) );
                $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
                    'selector'        => '.site-description',
                    'render_callback' => 'ostore_customize_partial_blogdescription',
                ) );
            }
            /**
            * General Settings Panel
            */
            $wp_customize->add_panel('ostore_general_settings', array(
                'priority' => 3,
                'title' => esc_html__('General Settings', 'ostore')
            ));

            $wp_customize->get_section('title_tagline')->panel = 'ostore_general_settings';
            $wp_customize->get_section('title_tagline' )->priority = 1;

            $wp_customize->get_section('header_image')->panel = 'ostore_general_settings';
            $wp_customize->get_section('header_image' )->priority = 2;

            $wp_customize->get_section('colors')->panel = 'ostore_general_settings';
            $wp_customize->get_section('background_image')->panel = 'ostore_general_settings';
            $wp_customize->get_section('header_image' )->priority = 4;

            /**
             * OStore Important Link
            */
            $wp_customize->add_section( 'ostore_implink_section', array(
                'title'             => esc_html__( 'Important Links', 'ostore' ),
                'priority'          => 1,
            ) );

            $wp_customize->add_setting( 'ostore_imp_links', array(
                'sanitize_callback' => 'ostore_text_sanitize'
            ));

            $wp_customize->add_control( new Ostore_Info_Text( $wp_customize,'ostore_imp_links', array(
                    'settings'      => 'ostore_imp_links',
                    'section'       => 'ostore_implink_section',
                    'description'   => 
                                        '<a class="pro-implink" href="'.esc_url('http://themerelic.com/wordpress-themes/ostore-pro/','ostore').'" target="_blank">'.esc_html__('Buy oStore Pro', 'ostore').'</a>
                                        <a class="pro-implink" href="'.esc_url('http://demo.themerelic.com/ostore/','ostore').'" target="_blank">'.esc_html__('Live Demo', 'ostore').'</a>
                                        <a class="pro-implink" href="'.esc_url('docs.themerelic.com/ostore/','ostore').'" target="_blank">'.esc_html__('Documantaion', 'ostore').'</a>
                                        <a class="pro-implink" href="'.esc_url('http://themerelic.com','ostore').'" target="_blank">'.esc_html__('Support', 'ostore').'</a>
                                        <a class="pro-implink" href="'.esc_url('http://themerelic.com','ostore').'" target="_blank">'.esc_html__('More Theme', 'ostore').'</a>',
                )
            ));
        }
        function ostore_header_customizer( $wp_customize ) {
                
            $customizer = KCustomizer::get_instance($wp_customize);
            
            $default = array(
                
                "sections" => array(
                    array(
                    'section' => array(
                            'id'        => "top_header",
                            'label'     => __("Top Header", "ostore"),
                            'priority'  => 1
                        ),
                        'fields' => array(
                            array(
                                // for settigns
                                'default'   => false,
                                'transport' => 'postMessage',
                                //for control
                                'id'    => "ostore_top_header_enable",
                                'type'  => 'checkbox',
                                'label' => __("Enabel", 'ostore')
                            ),
                            
                            array(
                                // for settigns
                                'default'   => "",
                                'transport' => 'postMessage',
                                //for control
                                'id'    => "ostore_top_header_email",
                                'type'  => 'text',
                                'label' => __("Email", "ostore")
                            ),
                            array(
                                // for settigns
                                'default'   => "",
                                'transport' => 'postMessage',
                                //for control
                                'id'    => "ostore_top_header_address",
                                'type'  => 'text',
                                'label' => __("Address", "ostore")
                            ),
                            array(
                                // for settigns
                                'default'   => "",
                                'transport' => 'postMessage',
                                //for control
                                'id'    => "ostore_top_header_phone_no",
                                'type'  => 'text',
                                'label' => __("Phone No", "ostore")
                            ),
                            array(
                                // for settigns
                                'default'   => "",
                                'transport' => 'postMessage',
                                //for control
                                'id'    => "ostore_top_header_time",
                                'type'  => 'text',
                                'label' => __("Opening Time", "ostore")
                            )
                        )
                    )
                )
            );
            $customizer->prepare( $default );
        }
        

        function ostore_slider_customizer($wp_customize) {
            $customizer = KCustomizer::get_instance($wp_customize);
            $default = array(
                'section' => array(
                        'id'        => "ostore_slider",
                        'label'     => __("Slider", 'ostore'),
                        'priority'  => 2
                    ),
                    'fields' => array(
                        array(
                            // for settigns
                            'default'   => false,
                            'transport' => 'refresh',
                            //for control
                            'id'    => "ostore_slider_enable",
                            'type'  => 'checkbox',
                            'label' => __("Enabel", 'ostore')
                        ),
                        array(
                            // for settigns
                            'default'   => false,
                            'transport' => 'refresh',
                            //for control
                            'id'    => "ostore_slider_category",
                            'type'  => 'category',
                            'label' => __("Slider Category", 'ostore')
                        ),
                        array(
                            // for settigns
                            'default'   => 'default',
                            'transport' => 'refresh',
                            //for control
                            'id'    => "ostore_slider_style",
                            'type'  => 'radio',
                            'label' => __("Slider Style", 'ostore'),
                            'choices'  => array(
                                'default'  => 'Default Slider',
                                'left' => __('Slider & Left Category', 'ostore'),
                                'right'=>  __('Slider & Right Category', 'ostore')
                            )
                        ),
                        array(
                            // for settigns
                            'default'   => '',
                            'transport' => 'refresh',
                            //for control
                            'id'    => "ostore_woo_category_1",
                            'type'  => 'woselect',
                            'label' => __("Select First Category", 'ostore'),
                            'description'  => __("Only works for woocommerce category", 'ostore')
                        ),
                        array(
                            // for settigns
                            'default'   => '',
                            'transport' => 'refresh',
                            //for control
                            'id'    => "ostore_woo_category_2",
                            'type'  => 'woselect',
                            'label' => __("Select Second Category", 'ostore'),
                            'description'  => __("Only works for woocommerce category", 'ostore')
                        ),
                    )
                
                );
            $customizer->prepare( $default );
        }
        
        //Footer Customizer
        function ostore_footer_customizer($wp_customize) {
            $customizer = KCustomizer::get_instance($wp_customize);
            $default = array(
                'panel' => array(
                    'id'            => "os_store_footer",
                    'label'         => __("Footer Settings", 'ostore'),
                    "desc"          => "",
                    "priority"      => 40
                ),
                array(
                    // for settigns
                    'default'   => true,
                    'transport' => 'refresh',
                    'panel'     =>  'os_store_footer',
                    //for control
                    'id'    => "ostore_footer_enable",
                    'type'  => 'checkbox',
                    'label' => __("Enabel", 'ostore')
                ),
                "sections" => array(
                    array(
                    'section' => array(
                            'id'        => "ostore_social_links",
                            'label'     => __("Social Links", 'ostore'),
                            'priority'  => 41,
                            'panel'     =>'os_store_footer'
                        ),
                        'fields' => array(
                            array(
                                // for settigns
                                'default'   => false,
                                'transport' => 'refresh',
                                //for control
                                'id'    => "ostore_social_links_enable",
                                'type'  => 'checkbox',
                                'label' => __("Enabel", 'ostore')
                            ),
                            array(
                                    // for settigns
                                    'default'   => "",
                                    'transport' => 'postMessage',
                                    //for control
                                    'id'    => "facebook_url",
                                    'type'  => 'url',
                                    'label' => __("Facebook URL", 'ostore')
                                ),
                                array(
                                    // for settigns
                                    'default'   => "",
                                    'transport' => 'postMessage',
                                    //for control
                                    'id'    => "google_plus",
                                    'type'  => 'url',
                                    'label' => __("Google Plus", 'ostore')
                                ),
                                array(
                                    // for settigns
                                    'default'   => "",
                                    'transport' => 'postMessage',
                                    //for control
                                    'id'    => "twitter_url",
                                    'type'  => 'url',
                                    'label' => __("Twitter URL", 'ostore')
                                ),
                                array(
                                    // for settigns
                                    'default'   => "",
                                    'transport' => 'postMessage',
                                    //for control
                                    'id'    => "rss_url",
                                    'type'  => 'url',
                                    'label' => __("RSS URL", 'ostore')
                                ),
                                array(
                                    // for settigns
                                    'default'   => "",
                                    'transport' => 'postMessage',
                                    //for control
                                    'id'    => "linkedin_url",
                                    'type'  => 'url',
                                    'label' => __("Linkedin URL", 'ostore')
                                ),
                                array(
                                    // for settigns
                                    'default'   => "",
                                    'transport' => 'postMessage',
                                    //for control
                                    'id'    => "instagram_url",
                                    'type'  => 'url',
                                    'label' => __("Instagram URL", 'ostore')
                                ),
                                
                        )),
                        array(
                        'section' => array(
                            'id'        => "ostore_subscribe",
                            'label'     => "Subscribe Section",
                            'priority'  => 42,
                            'panel'     =>'os_store_footer'
                        ),
                        'fields' => array(
                            array(
                                // for settigns
                                'default'   => false,
                                'transport' => 'refresh',
                                //for control
                                'id'    => "ostore_subscribe_enable",
                                'type'  => 'checkbox',
                                'label' => __("Enabel Subscribe", 'ostore')
                            ),
                            array(
                                // for settigns
                                'default'   => '',
                                'transport' => 'refresh',
                                //for control
                                'id'    => "ostore_subscribe_area",
                                'type'  => 'text',
                                'label' => __("Mailchimp Shortcode", 'ostore')
                            ),
                            array(
                                // for settigns
                                'default'   => 'SIGN UP FOR oStore',
                                'transport' => 'refresh',
                                //for control
                                'id'    => "ostore_subscribe_heading_text",
                                'type'  => 'text',
                                'label' => __("Singup Header Text", 'ostore')
                            ),
                            array(
                                // for settigns
                                'default'   => 'Duis autem vel eum iriureDuis autem',
                                'transport' => 'refresh',
                                //for control
                                'id'    => "ostore_subscribe_short_desc_area",
                                'type'  => 'textarea',
                                'label' => __("Singup Short Descrption", 'ostore')
                            )
                        )),
                        array(
                        'section' => array(
                            'id'        => "ostore_btn_social",
                            'label'     => __("Buttom Footer Section", 'ostore'),
                            'priority'  => 43,
                            'panel'     =>'os_store_footer'
                        ),
                        'fields' => array(
                            array(
                                // for settigns
                                'default'   => false,
                                'transport' => 'refresh',
                                //for control
                                'id'    => "ostore_btn_social_enable",
                                'type'  => 'checkbox',
                                'label' => __("Enabel Social Links Footer", 'ostore')
                            )
                            
                        ))
                        
                    )
                );
                

            $customizer->prepare( $default );
        }
        
        //Social Links
        function ostore_social_links_customizer($wp_customize) {
            $customizer = KCustomizer::get_instance($wp_customize);
            $default = array(
                'section' => array(
                        'id'        => "ostore_social_links",
                        'label'     => __("Social Links", 'ostore'),
                        'priority'  => 4
                    ),
                    'fields' => array(
                        array(
                            // for settigns
                            'default'   => true,
                            'transport' => 'refresh',
                            //for control
                            'id'    => "ostore_social_links_enable",
                            'type'  => 'checkbox',
                            'label' => __("Enabel", 'ostore')
                        ),
                        array(
                                // for settigns
                                'default'   => "www.facebook.com",
                                'transport' => 'postMessage',
                                //for control
                                'id'    => "facebook_url",
                                'type'  => 'url',
                                'label' => __("Facebook URL", 'ostore')
                            ),
                            array(
                                // for settigns
                                'default'   => "www.google-plus.com",
                                'transport' => 'postMessage',
                                //for control
                                'id'    => "google_plus",
                                'type'  => 'url',
                                'label' => __("Google Plus", 'ostore')
                            ),
                            array(
                                // for settigns
                                'default'   => "www.twitter.com",
                                'transport' => 'postMessage',
                                //for control
                                'id'    => "twitter_url",
                                'type'  => 'url',
                                'label' => __("Twitter URL", 'ostore')
                            ),
                            array(
                                // for settigns
                                'default'   => "www.rss.com",
                                'transport' => 'postMessage',
                                //for control
                                'id'    => "rss_url",
                                'type'  => 'url',
                                'label' => __("RSS URL", 'ostore')
                            ),
                            array(
                                // for settigns
                                'default'   => "www.linkedin.com",
                                'transport' => 'postMessage',
                                //for control
                                'id'    => "linkedin_url",
                                'type'  => 'url',
                                'label' => __("Linkedin URL", 'ostore')
                            ),
                            array(
                                // for settigns
                                'default'   => "www.instagram.com",
                                'transport' => 'postMessage',
                                //for control
                                'id'    => "instagram_url",
                                'type'  => 'url',
                                'label' => __("Instagram URL", 'ostore')
                            ),
                            
                    )
                );
            $customizer->prepare( $default );
        }

        function ostore_subscribe_customizer($wp_customize) {
            $customizer = KCustomizer::get_instance($wp_customize);
            $default = array(
                'section' => array(
                        'id'        => "ostore_subscribe",
                        'label'     => "Subscribe Section",
                        'priority'  => 5
                    ),
                    'fields' => array(
                        array(
                            // for settigns
                            'default'   => false,
                            'transport' => 'refresh',
                            //for control
                            'id'    => "ostore_subscribe_enable",
                            'type'  => 'checkbox',
                            'label' => __("Enabel Subscribe", 'ostore')
                        ),
                        array(
                            // for settigns
                            'default'   => '',
                            'transport' => 'refresh',
                            //for control
                            'id'    => "ostore_subscribe_area",
                            'type'  => 'text',
                            'label' => __("Mailchimp Shortcode", 'ostore')
                        ),
                        array(
                            // for settigns
                            'default'   => '',
                            'transport' => 'refresh',
                            //for control
                            'id'    => "ostore_subscribe_heading_text",
                            'type'  => 'text',
                            'label' => __("Singup Header Text", 'ostore')
                        ),
                        array(
                            // for settigns
                            'default'   => '',
                            'transport' => 'refresh',
                            //for control
                            'id'    => "ostore_subscribe_short_desc_area",
                            'type'  => 'textarea',
                            'label' => __("Singup Short Descrption", 'ostore')
                        )
                    )
                
                );
            $customizer->prepare( $default );
        }

        
    }
oStoreCustomizer::get_instance();




//add the customizer 
function customize_logo_slider( $wp_customize ) {

//add the custom_info  section
			$wp_customize->add_section('logo_slider',array(
				'title'		=>esc_html__('Logo Slider','ostore'),
				'description'=>esc_html__('logo Slider Section Hear','ostore'),
				'priority'	=>35,		
			));

            //Logo Slider On Checkbox            
            $wp_customize->add_setting('logo_slider_on', array(
            'default' => '',
            'type' => 'theme_mod',
            'sanitize_callback' => 'ostore_sanitize_checkbox'
            ));  
	        $wp_customize->add_control( 'logo_slider_on', array(
                'label' => esc_html__('Enable', 'ostore'),
                'description'=>esc_html__('Enable and Disable Logo Slider','ostore'),
                'section' => 'logo_slider',
                'type'     =>'checkbox',
                'priority'=>36
	        ));

            //Add the tile
            $wp_customize->add_setting('logo_slider_title', array(
                'default' => '',
                'type' => 'theme_mod',
                'sanitize_callback' => 'ostore_text_sanitize'
                
                ));  
            $wp_customize->add_control( 'logo_slider_title', array(
                'label' => esc_html__('Clints Logo Title', 'ostore'),
                'description'=>esc_html__('Client Logo Title Hear','ostore'),
                'section' => 'logo_slider',
                'type'     =>'text',
                'priority'=>37
                    
            ));

            //Add the Short Description
            $wp_customize->add_setting('logo_slider_short_dec', array(
                'default' => '',
                'type' => 'theme_mod',
                'sanitize_callback' => 'ostore_text_sanitize'
                ));  
            $wp_customize->add_control( 'logo_slider_short_dec', array(
                'label' => esc_html__('Clints Logo Description Hear', 'ostore'),
                'description'=>esc_html__('Client Logo Description Hear Hear','ostore'),
                'section' => 'logo_slider',
                'type'     =>'textarea',
                'priority'=>38
                    
            ));

            //Logo Side Add Image Multiple Image Slect
            $wp_customize->add_setting('logo_slide_add', array(
            'default' => '',
            'type' => 'theme_mod',
            'sanitize_callback' => 'esc_url_raw'
            ));

	        $wp_customize->add_control(new Multi_Image_Custom_Control(
	            $wp_customize, 'logo_slide_add', array(
	                'label' => esc_html__('Logo Slider Image', 'ostore'),
                    'desciption'=>esc_html__('Add the Logo Slider Image','ostore'),
	                'section' => 'logo_slider',
	                'settings' => 'logo_slide_add',
	                'priority'=>39
	            )
	        ));

            ################################################################
            //add the custom_info  section
			$wp_customize->add_section('payment_logo_slider',array(
				'title'		=>esc_html__('Payment Logo ','ostore'),
				'description'=>esc_html__('Payment logo  Section Hear','ostore'),
				'priority'	=>40,		
			));

            $wp_customize->add_setting('payment_enable',array(
                'default'   =>  '',
                'type'      =>  'theme_mod',
                'sanitize_callback' => 'ostore_sanitize_checkbox'
            ));
            $wp_customize->add_control('payment_enable',array(
                'label'     =>  esc_html__( 'Payment Enable','ostore'),
                'description'=>'',
                'section'   => 'payment_logo_slider',
                'type'      =>  'checkbox'
            ));

            $wp_customize->add_setting('payment_logo_add', array(
            'default' => '',
            'type' => 'theme_mod',
            'sanitize_callback' => 'esc_url_raw'
            ));

	        $wp_customize->add_control(new Multi_Image_Custom_Control(
	            $wp_customize, 'payment_logo_add', array(
	                'label' => esc_html__('Payment Logo Image', 'ostore'),
                    'desciption'=>esc_html__('Payment Logo Image','ostore'),
	                'section' => 'payment_logo_slider',
	                'settings' => 'payment_logo_add',
	                'priority'=>41
	            )
	        ));

		}
add_action( 'customize_register', 'customize_logo_slider' );


if (!class_exists('WP_Customize_Image_Control')) {
    return null;
}
class Multi_Image_Custom_Control extends WP_Customize_Control
{
    public function enqueue()
    {
        wp_enqueue_style('multi-image-style', get_template_directory_uri().'/themerelic/customizer/custom.css');
        wp_enqueue_script('multi-image-script', get_template_directory_uri().'/themerelic/customizer/custom.js', array( 'jquery' ), rand(), true);
    }

    public function render_content()
{ ?>
    <div class="payment_wraper">
        <label>
        <span class='customize-control-title'><?php esc_html_e('Image','ostore'); ?></span>
        </label>
        <div>
        <ul class='images'></ul>
        </div>
        <div class='actions'>
        <a class="button-secondary upload"><?php esc_html_e('Add','ostore'); ?></a>
        </div>

        <input class="wp-editor-area images-input" type="hidden" <?php esc_url($this->link()); ?>>
    </div>
    <?php
    }
}

/**
 * Ostore Text Info Control
 */
class Ostore_Info_Text extends WP_Customize_Control{
    public function render_content(){  ?>
        <span class="customize-control-title">
            <?php echo esc_html( $this->label ); ?>
        </span>
        <?php if($this->description){ ?>
            <span class="description customize-control-description">
            <?php echo wp_kses_post($this->description); ?>
            </span>
        <?php }
    }
}

    /**
     * Text fields sanitization
    */
    function ostore_text_sanitize( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }

	function ostore_array_sanitize($values){
		if(is_array($values)){
			return $values;
		}
		return array();
	}

	function ostore_sanitize_checkbox( $checked ) {
        // Boolean check.
        return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}