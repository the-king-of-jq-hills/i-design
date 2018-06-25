<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */


add_filter( 'rwmb_meta_boxes', 'idesign_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
function idesign_register_meta_boxes( $meta_boxes )
{
	/**
	 * Prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'idesign_';
	
	$idesign_template_url = get_template_directory_uri();

	// 1st meta box
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id' => 'heading',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Page Heading Options', 'i-design' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post', 'page' ),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			// Hide Title
			/*
			array(
				'name' => __( 'Titlebar/Image Header Type', 'i-amaze' ),
				'id'   => "{$prefix}hidetitle",
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 0,
				'class' => 'hide-ttl',
			),
			*/
			array(
				'name'            => __( 'Titlebar/Image Header/Slider Type', 'i-design' ),
				'id'              => "{$prefix}header_type",
				'type'            => 'select',
				'std'  			  => '1',
				'options'         => array(
					'1'     => __( 'Normal Page Title Bar', 'i-design' ),
					'2'    	=> __( 'Default Image/Video Header', 'i-design' ),
					'3' 	=> __( 'I-Design Theme Slider', 'i-design' ),
					'0' 	=> __( 'None', 'i-design' ),
				),
				// Allow to select multiple value?
				'multiple'        => false,
				// Placeholder text
				'placeholder'     => 'Select Header Type',
				// Display "Select All / None" button?
				'select_all_none' => true,
				'desc'  => __( 'If 3rd party shortcode use, this setting will be overridden.', 'i-design' )
			),
			
			// hide breadcrum
			array(
				'name' => __( 'Hide breadcrumb', 'i-design' ),
				'id'   => "{$prefix}hide_breadcrumb",
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 0,
				'desc'  => __( 'Only appears on titlebar when plugin Breadcrumb NavXT is active.', 'i-design' )
			),
			
			// 3rd part slider
			array(
				// Field name - Will be used as label
				'name'  => __( 'Other Slider Plugin Shortcode', 'i-design' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}other_slider",
				// Field description (optional)
				'desc'  => __( 'Enter a 3rd party slider shortcode, ex. meta slider, smart slider 2, wow slider, etc. Only works with TemplatesNext Themes.', 'i-design' ),
				'type'  => 'textarea',
				// Default value (optional)
				'std'   => '',
				// CLONES: Add to make the field cloneable (i.e. have multiple value)
				//'clone' => true,
				'class' => 'cust-ttl',
			),			
			

		)
	);
	
	
	/**/
	
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id' => 'portfoliometa',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Portfolio Meta', 'i-design' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'portfolio' ),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			// Side bar

			// ITEM DETAILS OPTIONS SECTION
			array(
				'type' => 'heading',
				'name' => __( 'Portfolio Additinal Details', 'i-design' ),
				'id'   => 'fake_id_pf1', // Not used but needed for plugin
			),
			// Slide duration
			array(
				'name'  => __( 'Subtitle', 'i-design' ),
				'id'    => "{$prefix}portfolio_subtitle",
				'desc'  => __( 'Enter a subtitle for use within the portfolio item index (optional).', 'i-design' ),				
				'type'  => 'text',
			),
			
			array(
				'name'  => __( 'Portfolio Link(External)', 'i-design' ),
				'id'    => "{$prefix}portfolio_url",
				'desc'  => __( 'Enter an external link for the item (optional) (NOTE: INCLUDE HTTP://).', 'i-design' ),				
				'type'  => 'text',
			),

		)
	);	
	

	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id' => 'miscellaneous',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Opther Page Options', 'i-design' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' => array( 'post', 'page', 'portfolio', 'team', 'product' ),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'low',

		// Auto save: true, false (default). Optional.
		'autosave' => true,

		// List of meta fields
		'fields' => array(
			/*
			// Show Alternate main navigation
			array(
				'name' => __( 'Show Alternate Main Navigation', 'i-design' ),
				'id'   => "{$prefix}alt_navigation",
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 0,
				'desc' => __('Turn on the alternate main navigation', 'i-design'),
			),
			*/
			
			// Remove top and bottom page padding/margin
			array(
				'name' => __( 'Remove Top and Bottom Padding/Margin', 'i-design' ),
				'id'   => "{$prefix}page_nopad",
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 0,
				'desc' => __('Remove the spaces/padding from top and bottom of the page/post', 'i-design'),
			),
			// Hide page header
			array(
				'name' => __( 'Show Transparent Header', 'i-design' ),
				'id'   => "{$prefix}trans_header",
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 0,
				'desc' => __('Show transparent header on pages/posts. This will hide the page/post titlebar as well', 'i-design'),
			),			
			// Hide page header
			array(
				'name' => __( 'Hide Page Header', 'i-design' ),
				'id'   => "{$prefix}no_page_header",
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 0,
				'desc' => __('In case you are building the page without the top navigation and logo', 'i-design'),
			),
			
			// Hide page header
			array(
				'name' => __( 'Hide Top Utilitybar', 'i-design' ),
				'id'   => "{$prefix}no_ubar",
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 0,
				'desc' => __('Hide top bar with email and social links', 'i-design'),
			),
			// Hide page header
			array(
				'name' => __( 'Hide Footer Widget Area', 'i-design' ),
				'id'   => "{$prefix}no_footer",
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 0,
				'desc' => __('Hide bottom footer widget area', 'i-design'),
			),														

			// Custom page primary color			
			array(
				'name'  => __( 'Custom Primary Color', 'i-design' ),
				'id'    => "{$prefix}page_color",
				'type'  => 'color',
				'std'   => '',
				'desc' => __('Choose a custom primary color for this page', 'i-design'),
			),
			/*
			// Custom page primary color			
			array(
				'name'  => __( 'Content Link Color', 'i-design' ),
				'id'    => "{$prefix}link_color",
				'type'  => 'color',
				'std'   => '',
				'desc' => __('Choose a custom link color for this page', 'i-design'),
			),			
			*/
			/* requires meta-box update  */
			/*
			// Custom page logo normal			
			array(
				'name'  => __( 'Custom Page Logo Normal', 'i-design' ),
				'id'    => "{$prefix}page_logo_normal",
				'type'  => 'single_image',
			),
			// Custom page logo transparent
			array(
				'name'  => __( 'Custom Page Logo Reverse', 'i-design' ),
				'id'    => "{$prefix}page_logo_trans",
				'type'  => 'single_image',
			),
			*/
						
			// additional page class			
			array(
				'name'  => __( 'Additional Page Class', 'i-design' ),
				'id'    => "{$prefix}page_class",
				'type'  => 'text',
				'std'   => '',
				'desc' => __('Enter an additional page class, will be added to body. "hideubar" for top social/contact bar, "boxed" for boxed page for wide layout.', 'i-design'),
			),
						
		)
	);				
	
	return $meta_boxes;
}

	function idesign_get_category_list_key_array($category_name) {
			
		$get_category = get_categories( array( 'taxonomy' => $category_name	));
		$category_list = array( 'all' => __( 'Select Category', 'i-design' ));
		
		foreach( $get_category as $category ){
			if (isset($category->slug)) {
			$category_list[$category->slug] = $category->cat_name;
			}
		}
			
		return $category_list;
	}	

