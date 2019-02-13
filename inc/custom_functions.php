<?php 
/*-----------------------------------------------------------------------------------*/
/* Social icons																		*/
/*-----------------------------------------------------------------------------------*/
function idesign_social_icons () {
	
	$socio_list = '';
	$siciocount = 0;
	$services = array ('facebook','twitter','flickr','feed','instagram','googleplus','youtube','pinterest','linkedin');
    
		$socio_list .= '<ul class="social">';	
		foreach ( $services as $service ) :
			
			$active[$service] = esc_url( get_theme_mod('itrans_social_'.$service, '#') );
			if ($active[$service]) { 
				$socio_list .= '<li><a href="'.$active[$service].'" title="'.$service.'" target="_blank"><i class="genericon socico genericon-'.$service.'"></i></a></li>';
				$siciocount++;
			}
			
		endforeach;
		$socio_list .= '</ul>';
		
		if($siciocount>0)
		{	
			return $socio_list;
		} else
		{
			return;
		}
}

/*-----------------------------------------------------------------------------------*/
/* ibanner Slider																		*/
/*-----------------------------------------------------------------------------------*/
function idesign_ibanner_slider () {    
	$arrslidestxt = array();
	$template_dir = get_template_directory_uri();
	$banner_text = get_theme_mod('banner_text', '');
	$slider_height = esc_attr(get_theme_mod('slider_height', 100));
	$slider_reduct = esc_attr(get_theme_mod('slider_reduct', 0));	
	
	$title_font_size = esc_attr(get_theme_mod('title_font_size', 56));
	$title_font_weight = esc_attr(get_theme_mod('title_font_weight', 700));

	$nxs_class = esc_attr(get_theme_mod('itrans_style', 'nxs-design18'));
	
	$upload_dir = wp_upload_dir();
	$upload_base_dir = $upload_dir['basedir'];
	$upload_base_url = $upload_dir['baseurl'];
	
	$shortcut_text = __('Edit Slides', 'i-design');	
	
	//$classes[] = 'nx-fullscreen';	
	
    for( $slideno=1; $slideno<=4; $slideno++ ){
		
			$strret = '';
			
			$slide_title = esc_attr(get_theme_mod('itrans_slide'.$slideno.'_title', __( '<span style="color: #e57e26;">DRAG & DROP</span> PAGE BUILDER', 'i-design' ) ));
			$slide_desc = esc_attr(get_theme_mod('itrans_slide'.$slideno.'_desc', __( 'WooCommerce, Elementor, SIteOrigin Page Builder Support And Free Layouts', 'i-design' )));
			$slide_linktext = esc_attr(get_theme_mod('itrans_slide'.$slideno.'_linktext', __( 'Know More', 'i-design' )));
			$slide_linkurl = esc_url(get_theme_mod('itrans_slide'.$slideno.'_linkurl', esc_url( 'http://www.templatesnext.org/i-design/', 'i-design' )));
			$slide_image = esc_url(get_theme_mod('itrans_slide'.$slideno.'_image', get_template_directory_uri() . '/images/slide'.$slideno.'.jpg'));
			
			$slider_image_id = idesign_get_attachment_id_from_url( $slide_image );			
			$slider_resized_image = wp_get_attachment_image_src( $slider_image_id, 'idesign-slider-thumb' );
			
			
			if ( $slide_image ) {

				if( $slide_image != '' ){
					if( file_exists( str_replace($upload_base_url,$upload_base_dir,$slide_image) ) ){
						$strret .= '<div class="da-img" style="background-image:URL(' . $slider_resized_image[0] .');"><div class="nx-tscreen"></div></div>';
					}
					else
					{
						$slide_image = $template_dir.'/images/slide'.$slideno.'.jpg';
						$strret .= '<div class="da-img noslide-image" style="background-image:URL(' . $slide_image .');"><div class="nx-tscreen"></div></div>';					
					}
				}
				else
				{					
					$slide_image = $template_dir.'/images/no-image.jpg';
					$strret .= '<div class="da-img noslide-image" style="background-image:URL(' . $slide_image .');"><div class="nx-tscreen"></div></div>';
				}
				
				$strret .= '<div class="slider-content-wrap"><div class="nx-slider-container">';
				if( !empty($slide_title) ){$strret .= '<h2 style="font-size: '.$title_font_size.'px; font-weight: '.$title_font_weight.';">'.wp_specialchars_decode($slide_title, $quote_style = ENT_QUOTES).'</h2>';}
				if( !empty($slide_desc) ){
					$strret .= '<p>'.$slide_desc.'</p>';
				} else {
					$strret .= '<div class="clear" style="height:16px;"></div>';
				}
				if( !empty($slide_linktext) ){$strret .= '<a href="'.$slide_linkurl.'" class="da-link">'.$slide_linktext.'</a>';}
				$strret .= '</div></div>';
			}
			
			if ( $strret != '' ){
				$arrslidestxt[$slideno] = $strret;
			}
			
					
	}
	
	$sliderscpeed = intval(esc_attr(get_theme_mod('itrans_sliderspeed', '6'))) * 1000 ;	
	
			
	$itrans_sliderparallax = get_theme_mod('itrans_sliderparallax', 1);
	$itrans_slideroverlay = get_theme_mod('slider_overlay', 1);		
	$ubar_stat = get_theme_mod('slider_ubar', 0);	

	if( $itrans_slideroverlay == 1 )
	{
		$overlayclass = "overlay";
	} else
	{
		$overlayclass = "";
	}
	
	if( $ubar_stat == 0 )
	{
		$ubarclass = "hideubar";
	} else
	{
		$ubarclass = "showubar";
	}		
	
	
	if( count( $arrslidestxt) > 0 ){
		echo '<div class="ibanner ' . $overlayclass . ' ' . $ubarclass . ' '. $nxs_class . '">';
		echo '	<div id="da-slider" class="da-slider" role="banner" data-slider-speed="'.$sliderscpeed.'" data-slider-parallax="'.$itrans_sliderparallax.'" data-edit-slides="'.$shortcut_text.'" data-slider-height="'.$slider_height.'" data-slider-reduct="'.$slider_reduct.'">';
			
		foreach ( $arrslidestxt as $slidetxt ) :
			echo '<div class="nx-slider">';	
			echo	$slidetxt;
			echo '</div>';
		endforeach;
		
		echo '	</div>';
		echo '</div>';
	} else
	{
        echo '<div class="iheader front">';
        echo '    <div class="titlebar">';
        echo '        <h1>';
		
		if ($banner_text) {
			echo esc_html($banner_text);
		} 
        echo '        </h1>';
		echo ' 		  <h2>';

		echo '		</h2>';
        echo '    </div>';
        echo '</div>';
	}
}

/*-----------------------------------------------------------------------------------*/
/* find attachment id from url																	*/
/*-----------------------------------------------------------------------------------*/
function idesign_get_attachment_id_from_url( $attachment_url = '' ) {

    global $wpdb;
    $attachment_id = false;

    // If there is no url, return.
    if ( '' == $attachment_url )
        return;

    // Get the upload directory paths
    $upload_dir_paths = wp_upload_dir();

    // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
    if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

        // If this is the URL of an auto-generated thumbnail, get the URL of the original image
        $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

        // Remove the upload path base directory from the attachment URL
        $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

        // Finally, run a custom database query to get the attachment ID from the modified attachment URL
        $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

    }

    return $attachment_id;
}


/*
 * add body class for i-design wpr menu
 *
 * @since i-design 1.0.1
 */
add_filter( 'body_class', 'idesign_slider_body_class' );
function idesign_slider_body_class( $classes ) {

	$hide_front_slider = get_theme_mod('slider_stat', 1);
	if ( ( is_home() && $hide_front_slider == 0 ) || ( is_front_page() && $hide_front_slider == 0 )  ) {
		$classes[] = 'home-slider-off';	
	}

	if ( is_home() && !is_front_page() && $hide_front_slider == 0 ) {
		$classes[] = 'nx-blog-only';	
	}	

	return $classes;
}

function idesign_get_video_id( $video_url ){
	
	if( (preg_match('/http:\/\/(www\.)*youtube\.com\/.*/',$video_url)) || (preg_match('/http:\/\/(www\.)*youtu\.be\/.*/',$video_url)) )
	{
		$video_id = ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_url, $match ) ) ? $match[1] : false;
		return $video_id;
	} else
	{
		return false;
	}
}


/* Calling Theme Welcome on activation */
require_once( get_template_directory() . '/inc/theme-welcome/theme-welcome.php' );
include get_template_directory() . '/inc/txoc/txoc.php';

/* activating all site origin widgets bundle */
function idesign_filter_active_widgets($active){
    $active['features'] = true;
    $active['icon'] = true;
	
    $active['button'] = true;	
    $active['layout-slider'] = true;	
    $active['social-media-buttons'] = true;	
    $active['call-to-action'] = true;
    $active['google-maps'] = true;	
    //$active['image'] = true;	
    //$active['post-carousel'] = true;	
    //$active['taxonomy'] = true;
    $active['contact'] = true;	
    $active['headline'] = true;	
    $active['image-grid'] = true;	
    $active['price-table'] = true;	
    //$active['testimonial'] = true;	
    $active['editor'] = true;	
    $active['hero'] = true;	
    $active['image-slider'] = true;
    $active['simple-masonry'] = true;
    $active['video'] = true;		
	
    return $active;
}
add_filter('siteorigin_widgets_active_widgets', 'idesign_filter_active_widgets');



/* Demo import by One Click Demo Import */
// include get_template_directory() . '/inc/one-click-demo-import/one-click-demo-import.php';

function idesign_import_files() {
  return array(
  	/**/
		array(
		  'import_file_name'             	=> 'Restaurant',
		  'import_file_url'            		=> 'http://wp-demos.com/downloads/demos/i-design/elementor/restaurant.xml',
		  //'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-design/elementor/restaurant.wie',
		  'import_customizer_file_url' 		=> 'http://wp-demos.com/downloads/demos/i-design/elementor/restaurant.dat',
		  'import_preview_image_url'     	=> '//wp-demos.com/downloads/demos/i-design/elementor/restaurant.jpg',
		  'import_notice'                	=> __( 'This process involves transfer of data and media from server to server and might take some time.', 'i-design' ),
		  'preview_url'                		=> 'http://www.wp-demos.com/i-spirit/i-design-restaurant/',
		  'required_plugin'					=> array(
												'elementor',
												'essential-addons-for-elementor-lite',
												'contact-form-7',
											),
		  'categories'                 		=> array( 'Free', 'Elementor' ),	  
		),
		array(
		  'import_file_name'             	=> 'Small Business',
		  'import_file_url'            		=> 'http://wp-demos.com/downloads/demos/i-design/elementor/small-business.xml',
		  //'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-design/elementor/small-business.wie',
		  'import_customizer_file_url' 		=> 'http://wp-demos.com/downloads/demos/i-design/elementor/small-business.dat',
		  'import_preview_image_url'     	=> '//wp-demos.com/downloads/demos/i-design/elementor/business.jpg',
		  'import_notice'                	=> __( 'This process involves transfer of data and media from server to server and might take some time.', 'i-design' ),
		  'preview_url'                		=> 'http://www.wp-demos.com/i-spirit/i-design-smallbusiness/',
		  'required_plugin'					=> array(
												'elementor',
												'essential-addons-for-elementor-lite',
												'contact-form-7',
											),
		  'categories'                 		=> array( 'Free', 'Elementor' ),	  
		),		
		array(
		  'import_file_name'             	=> 'Personal',
		  'import_file_url'            		=> 'http://wp-demos.com/downloads/demos/i-design/elementor/personal.xml',
		  //'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-design/elementor/personal.wie',
		  'import_customizer_file_url' 		=> 'http://wp-demos.com/downloads/demos/i-design/elementor/personal.dat',
		  'import_preview_image_url'     	=> '//wp-demos.com/downloads/demos/i-design/elementor/personal.jpg',
		  'import_notice'                	=> __( 'This process involves transfer of data and media from server to server and might take some time.', 'i-design' ),
		  'preview_url'                		=> 'http://www.wp-demos.com/i-spirit/i-design-personal/',
		  'required_plugin'					=> array(
												'elementor',
												'essential-addons-for-elementor-lite',
												'contact-form-7',
											),
		  'categories'                 		=> array( 'Free', 'Elementor' ),	  
		),
		array(
		  'import_file_name'             	=> 'MAX Store',
		  'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-shop.wie',
		  'import_preview_image_url'     	=> '//wp-demos.com/downloads/demos/i-design/elementor/maxstore.jpg',
		  'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-design' ),
		  'preview_url'                		=> 'http://www.wp-demos.com/i-spirit/maxstore/',
		  'required_plugin'					=> '',
		  'categories'                 		=> array( 'Premium', 'WooCommerce', 'Elementor' ),										
		),	
	
    array(
      'import_file_name'             	=> 'Agency 1',
      'import_file_url'            		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-agency.xml',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-agency.wie',
      'import_customizer_file_url' 		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-agency-1.dat',
      'import_preview_image_url'     	=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/thumb-agency-1.jpg',
      'import_notice'                	=> __( 'Please make sure you have plugin "TemplatesNext ToolKit" and "Contact Form 7" installed and active before you start the import process. <br> This process involves transfer of data and media from server to server and might take some time.', 'i-design' ),
	  'preview_url'                		=> 'http://wp-demos.com/agency/',
	  'required_plugin'					=> array(
											'siteorigin-panels',
											'so-widgets-bundle',
	  									),
	  'categories'                 		=> array( 'Free', 'SiteOrigin Page Builder' ),		  
    ),
	
    array(
      'import_file_name'             	=> 'Agency 2',
      'import_file_url'            		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-agency.xml',
      'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-design/creative/i-design-creative.wie',
      'import_customizer_file_url' 		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-agency-2.dat',
      'import_preview_image_url'     	=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/thumb-agency-2.jpg',
      'import_notice'                	=> __( 'Please make sure you have plugin "TemplatesNext ToolKit" and "Contact Form 7" installed and active before you start the import process. <br> This process involves transfer of data and media from server to server and might take some time.', 'i-design' ),
	  'preview_url'                		=> 'http://wp-demos.com/agency/agency-2-pb/',
	  'required_plugin'					=> array(
											'siteorigin-panels',
											'so-widgets-bundle',
											'contact-form-7',											
	  									),
	  'categories'                 		=> array( 'Free', 'SiteOrigin Page Builder' ),		  
    ),
	
    array(
      'import_file_name'             	=> 'Agency 3',
      'import_file_url'            		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-agency.xml',
      'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-design/creative/i-design-creative.wie',
      'import_customizer_file_url' 		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-agency-3.dat',
      'import_preview_image_url'     	=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/thumb-agency-3.jpg',
      'import_notice'                	=> __( 'Please make sure you have plugin "TemplatesNext ToolKit" and "Contact Form 7" installed and active before you start the import process. <br> This process involves transfer of data and media from server to server and might take some time.', 'i-design' ),
	  'preview_url'                		=> 'http://wp-demos.com/agency/agency-3/',
	  'required_plugin'					=> array(
											'siteorigin-panels',
											'so-widgets-bundle',
	  									),
	  'categories'                 		=> array( 'Free', 'SiteOrigin Page Builder' ),		  
    ),	
	
    array(
      'import_file_name'             	=> 'Business Home 1',
      'import_file_url'            		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-agency.xml',
      'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-design/creative/i-design-creative.wie',
      'import_customizer_file_url' 		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-business-1.dat',
      'import_preview_image_url'     	=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/thumb-business-1.jpg',
      'import_notice'                	=> __( 'Please make sure you have plugin "TemplatesNext ToolKit" and "Contact Form 7" installed and active before you start the import process. <br> This process involves transfer of data and media from server to server and might take some time.', 'i-design' ),
	  'preview_url'                		=> 'http://wp-demos.com/agency/business-home-1-pb/',
	  'required_plugin'					=> array(
											'siteorigin-panels',
											'so-widgets-bundle',
											'contact-form-7',											
	  									),
	  'categories'                 		=> array( 'Free', 'SiteOrigin Page Builder' ),		  
    ),
	
    array(
      'import_file_name'             	=> 'Fashion Shop 1',
      'import_file_url'            		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-shop.xml',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-shop.wie',
      'import_customizer_file_url' 		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-fashion-shop.dat',
      'import_preview_image_url'     	=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/thumb-fashion-shop.jpg',
      'import_notice'                	=> __( 'Please make sure you have plugin "TemplatesNext ToolKit" and "WooCommerce" installed and active before you start the import process. <br> This process involves transfer of data and media from server to server and might take some time.', 'i-design' ),
	  'preview_url'                		=> 'http://www.wp-demos.com/shop/',
	  'required_plugin'					=> array(
											'breadcrumb-navxt',
											'siteorigin-panels',
											'so-widgets-bundle',
											'contact-form-7',
	  									),
	  'categories'                 		=> array( 'Free','WooCommerce', 'SiteOrigin Page Builder' ),	  
    ),
	
    array(
      'import_file_name'             	=> 'Shop Shaurya',
      'import_file_url'            		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-shop.xml',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-shop.wie',
      'import_customizer_file_url' 		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-shop-shaurya.dat',
      'import_preview_image_url'     	=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/thumb-shaurya.jpg',
      'import_notice'                	=> __( 'Please make sure you have plugin "TemplatesNext ToolKit" and "WooCommerce" installed and active before you start the import process. <br> This process involves transfer of data and media from server to server and might take some time.', 'i-design' ),
	  'preview_url'                		=> 'http://wp-demos.com/shop/shop-shaurya/',
	  'required_plugin'					=> array(
											'breadcrumb-navxt',
											'siteorigin-panels',
											'so-widgets-bundle',
											'contact-form-7',
	  									),
	  'categories'                 		=> array( 'Free','WooCommerce', 'SiteOrigin Page Builder' ),	  	  
    ),	
	
    array(
      'import_file_name'             	=> 'Craft-18 Shop',
      'import_file_url'            		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-shop.xml',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-shop.wie',
      'import_customizer_file_url' 		=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/i-design-craft-18.dat',
      'import_preview_image_url'     	=> 'https://raw.githubusercontent.com/TemplatesNext/i-design-demo/master/thumb-craft-18.jpg',
      'import_notice'                	=> __( 'Please make sure you have plugin "TemplatesNext ToolKit" and "WooCommerce" installed and active before you start the import process. <br> This process involves transfer of data and media from server to server and might take some time.', 'i-design' ),
	  'preview_url'                		=> 'http://wp-demos.com/shop/shop-blank/',
	  'required_plugin'					=> array(
											'breadcrumb-navxt',
											'siteorigin-panels',
											'so-widgets-bundle',
											'contact-form-7',
	  									),
	  'categories'                 		=> array( 'Free','WooCommerce', 'SiteOrigin Page Builder' ),	  
    ),

    array(
      'import_file_name'             	=> 'Agency 4',
      'import_file_url'            		=> 'http://wp-demos.com/downloads/demos/i-design/creative/i-design-creative.xml',
      'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-design/creative/i-design-creative.wie',
      'import_customizer_file_url' 		=> 'http://wp-demos.com/downloads/demos/i-design/creative/i-design-creative.dat',
      'import_preview_image_url'     	=> 'http://www.wp-demos.com/images/small-images/agency-4.jpg',
      'import_notice'                	=> __( 'This process involves transfer of data and media from server to server and might take some time.', 'i-design' ),
	  'preview_url'                		=> 'http://wp-demos.com/creative/',
	  'required_plugin'					=> array(
											'siteorigin-panels',
											'so-widgets-bundle',
	  									),
	  'categories'                 		=> array( 'Free', 'SiteOrigin Page Builder' ),	  
    ),
    array(
      'import_file_name'             	=> 'School',
      'import_file_url'            		=> 'http://wp-demos.com/downloads/demos/i-design/creative/i-design-creative.xml',
      'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-design/creative/i-design-creative.wie',
      'import_customizer_file_url' 		=> 'http://wp-demos.com/downloads/demos/i-design/creative/i-design-creative.dat',
      'import_preview_image_url'     	=> 'http://www.wp-demos.com/images/small-images/school.jpg',
      'import_notice'                	=> __( 'This process involves transfer of data and media from server to server and might take some time.', 'i-design' ),
	  'preview_url'                		=> 'http://wp-demos.com/creative/graceland-school/',
	  'required_plugin'					=> array(
											'siteorigin-panels',
											'so-widgets-bundle',
	  									),
	  'categories'                 		=> array( 'Free', 'SiteOrigin Page Builder' ),	  
    ),
    array(
      'import_file_name'             	=> 'Charity',
      'import_file_url'            		=> 'http://wp-demos.com/downloads/demos/i-design/creative/i-design-creative.xml',
      'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-design/creative/i-design-creative.wie',
      'import_customizer_file_url' 		=> 'http://wp-demos.com/downloads/demos/i-design/creative/i-design-creative.dat',
      'import_preview_image_url'     	=> 'http://www.wp-demos.com/images/small-images/ngo-charity.jpg',
      'import_notice'                	=> __( 'This process involves transfer of data and media from server to server and might take some time.', 'i-design' ),
	  'preview_url'                		=> 'http://wp-demos.com/creative/visionale/',
	  'required_plugin'					=> array(
											'siteorigin-panels',
											'so-widgets-bundle',
	  									),
	  'categories'                 		=> array( 'Free', 'SiteOrigin Page Builder' ),	  
    ),
    array(
      'import_file_name'             	=> 'Computer',
      'import_file_url'            		=> 'http://wp-demos.com/downloads/demos/i-design/creative/i-design-creative.xml',
      'import_widget_file_url'     		=> 'http://wp-demos.com/downloads/demos/i-design/creative/i-design-creative.wie',
      'import_customizer_file_url' 		=> 'http://wp-demos.com/downloads/demos/i-design/creative/i-design-creative.dat',
      'import_preview_image_url'     	=> 'http://www.wp-demos.com/images/small-images/computer.jpg',
      'import_notice'                	=> __( 'This process involves transfer of data and media from server to server and might take some time.', 'i-design' ),
	  'preview_url'                		=> 'http://wp-demos.com/creative/computers-1/',
	  'required_plugin'					=> array(
											'siteorigin-panels',
											'so-widgets-bundle',
	  									),
	  'categories'                 		=> array( 'Free', 'SiteOrigin Page Builder' ),	  
    ),	
	
	
    array(
      'import_file_name'             	=> 'Classic 1',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-excel-demo/master/i-excel-shop.wie',
      'import_preview_image_url'     	=> 'http://www.wp-demos.com/images/small-images/classic-1.jpg',
      'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-design' ),
	  'preview_url'                		=> 'http://www.wp-demos.com/ispirit/classic/',
	  'required_plugin'					=> '',
	  'categories'                 		=> array( 'Premium', 'WPBakery Page Builder' ),										
    ),
	
    array(
      'import_file_name'             	=> 'Modern 1',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-excel-demo/master/i-excel-shop.wie',
      'import_preview_image_url'     	=> 'http://www.wp-demos.com/images/small-images/modern-1.jpg',
      'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-design' ),
	  'preview_url'                		=> 'http://www.wp-demos.com/ispirit/modern/',
	  'required_plugin'					=> '',
	  'categories'                 		=> array( 'Premium', 'WPBakery Page Builder' ),										
    ),	
    array(
      'import_file_name'             	=> 'Flat 1',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-excel-demo/master/i-excel-shop.wie',
      'import_preview_image_url'     	=> 'http://www.wp-demos.com/images/small-images/flat-1.jpg',
      'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-design' ),
	  'preview_url'                		=> 'http://www.wp-demos.com/ispirit/flat/',
	  'required_plugin'					=> '',
	  'categories'                 		=> array( 'Premium', 'WPBakery Page Builder' ),										
    ),			
	
    array(
      'import_file_name'             	=> 'Shop 1',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-excel-demo/master/i-excel-shop.wie',
      'import_preview_image_url'     	=> 'http://www.wp-demos.com/images/small-images/shop-1.jpg',
      'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-design' ),
	  'preview_url'                		=> 'http://www.wp-demos.com/ispirit/shop/',
	  'required_plugin'					=> '',
	  'categories'                 		=> array( 'Premium','WooCommerce', 'WPBakery Page Builder' ),										
    ),
    array(
      'import_file_name'             	=> 'Modern 2',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-excel-demo/master/i-excel-shop.wie',
      'import_preview_image_url'     	=> 'http://www.wp-demos.com/images/small-images/modern-2.jpg',
      'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-design' ),
	  'preview_url'                		=> 'http://www.wp-demos.com/ispirit/modern/home-visual-composer/',
	  'required_plugin'					=> '',
	  'categories'                 		=> array( 'Premium', 'WPBakery Page Builder' ),										
    ),	
    array(
      'import_file_name'             	=> 'Classic MAX',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-excel-demo/master/i-excel-shop.wie',
      'import_preview_image_url'     	=> 'http://www.wp-demos.com/images/small-images/classic-max.jpg',
      'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-design' ),
	  'preview_url'                		=> 'http://www.wp-demos.com/ispirit/classic/classic-max',
	  'required_plugin'					=> '',
	  'categories'                 		=> array( 'Premium', 'WPBakery Page Builder' ),										
    ),	
    array(
      'import_file_name'             	=> 'Classic 2',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-excel-demo/master/i-excel-shop.wie',
      'import_preview_image_url'     	=> 'http://www.wp-demos.com/images/small-images/classic-2.jpg',
      'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-design' ),
	  'preview_url'                		=> 'http://www.wp-demos.com/ispirit/classic/nx-front/',
	  'required_plugin'					=> '',
	  'categories'                 		=> array( 'Premium', 'WPBakery Page Builder' ),										
    ),
	
    array(
      'import_file_name'             	=> 'Shop 2',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-excel-demo/master/i-excel-shop.wie',
      'import_preview_image_url'     	=> 'http://www.wp-demos.com/images/small-images/shop-2.jpg',
      'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-design' ),
	  'preview_url'                		=> 'http://www.wp-demos.com/ispirit/shop/nx-shop/',
	  'required_plugin'					=> '',
	  'categories'                 		=> array( 'Premium','WooCommerce', 'WPBakery Page Builder' ),										
    ),	
    array(
      'import_file_name'             	=> 'Flat 2',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-excel-demo/master/i-excel-shop.wie',
      'import_preview_image_url'     	=> 'http://www.wp-demos.com/images/small-images/flat-2.jpg',
      'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-design' ),
	  'preview_url'                		=> 'http://www.wp-demos.com/ispirit/flat/home-fullscreen-image-slider/',
	  'required_plugin'					=> '',
	  'categories'                 		=> array( 'Premium', 'WPBakery Page Builder' ),										
    ),	
    array(
      'import_file_name'             	=> 'Modern MAX',
      'import_widget_file_url'     		=> 'https://raw.githubusercontent.com/TemplatesNext/i-excel-demo/master/i-excel-shop.wie',
      'import_preview_image_url'     	=> 'http://www.wp-demos.com/images/small-images/modern-max.jpg',
      'import_notice'                	=> __( 'This demo design is only available with premium theme I-SPIRIT.', 'i-design' ),
	  'preview_url'                		=> 'http://www.wp-demos.com/ispirit/modern/home-halfscreen-slider-3/',
	  'required_plugin'					=> '',
	  'categories'                 		=> array( 'Premium', 'WPBakery Page Builder' ),										
    ),	
			
		
  );
}
add_filter( 'pt-ocdi/import_files', 'idesign_import_files' );

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

function idesign_after_import_setup($selected_import) {
	
	if ( 'Restaurant' === $selected_import['import_file_name'] ) {

		$main_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
	
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Home' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}		
		
	} elseif ( 'Small Business' === $selected_import['import_file_name'] ) {

		$main_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
	
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Front Page' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}		
		
	} elseif ( 'Personal' === $selected_import['import_file_name'] ) {

		$main_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
	
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Home' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}		
		
	} elseif ( 'Agency 1' === $selected_import['import_file_name'] ) {

		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'i-craft Main Nav', 'nav_menu' );
	
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Agency 1' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}		
		
	} elseif ( 'Agency 2' === $selected_import['import_file_name'] ) {
	
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'i-craft Main Nav', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Agency 2' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}			
	
	} elseif ( 'Agency 3' === $selected_import['import_file_name'] ) {
	
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'i-craft Main Nav', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Agency 3' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}			
	
	} elseif ( 'Business Home 1' === $selected_import['import_file_name'] ) {

		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'i-craft Main Nav', 'nav_menu' );
	
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Business Home 1' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}		
		
	} elseif ( 'Fashion Shop 1' === $selected_import['import_file_name'] ) {
	
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'i-craft Main Nav', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Fashion Shop 1' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}			
	
	} elseif ( 'Shop Shaurya' === $selected_import['import_file_name'] ) {
	
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'i-craft Main Nav', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Shop Shaurya' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}			
	
	} elseif ( 'Craft-18 Shop' === $selected_import['import_file_name'] ) {
	
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'i-craft Main Nav', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Craft-18 Shop' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}	
	} 
	
	elseif ( 'Agency 4' === $selected_import['import_file_name'] ) {
	
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Agency 4 PB' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}	
	} elseif ( 'School' === $selected_import['import_file_name'] ) {
	
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Graceland School' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}	
	} elseif ( 'Charity' === $selected_import['import_file_name'] ) {
	
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Vision Eartth' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}	
	} elseif ( 'Computer' === $selected_import['import_file_name'] ) {
	
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'Main Navigation', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);
		
		$front_page_id = get_page_by_title( 'Computers 1' );
       	if ( isset( $front_page_id->ID ) ) {
			update_option( 'page_on_front', $front_page_id->ID );
        	update_option( 'show_on_front', 'page' );
       	}	
	}

}
add_action( 'pt-ocdi/after_import', 'idesign_after_import_setup' );

/* Delete The default Hello World Post before import */
/* Resetting default Widgets */
function ispirit_before_content_import( $selected_import ) {
	wp_delete_post(1);
	update_option( 'sidebars_widgets', array() );
}
add_action( 'pt-ocdi/before_content_import', 'ispirit_before_content_import' );


/* change title for page and menu */
function idesign_plugin_page_setup( $default_settings ) {
    $default_settings['page_title']  = esc_html__( 'i-Design One Click Demo Setup', 'i-design' );
    $default_settings['menu_title']  = esc_html__( 'Theme Demo Setup' ,'i-design' );
    return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'idesign_plugin_page_setup' );

