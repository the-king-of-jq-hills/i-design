<?php


if (isset($_GET['activated']) && is_admin()) {
	set_transient( '_welcome_screen_activation_redirect', true, 30 );
}

add_action( 'admin_init', 'welcome_screen_do_activation_redirect' );
function welcome_screen_do_activation_redirect() {
  // Bail if no activation redirect
    if ( ! get_transient( '_welcome_screen_activation_redirect' ) ) {
    return;
  }

  // Delete the redirect transient
  delete_transient( '_welcome_screen_activation_redirect' );

  // Bail if activating from network, or bulk
  if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
    return;
  }

  // Redirect to bbPress about page
  wp_safe_redirect( add_query_arg( array( 'page' => 'welcome-screen-about' ), admin_url( 'themes.php' ) ) );

}

add_action('admin_menu', 'welcome_screen_pages');

function welcome_screen_pages() {
	add_theme_page(
		'Welcome To Welcome i-design',
		'About i-design',
		'read',
		'welcome-screen-about',
		'welcome_screen_content',
		'dashicons-awards', 
		6 		
	);
}

function welcome_screen_content() {
	
	include get_template_directory() . '/inc/theme-welcome/tw-content.php';
	include get_template_directory() . '/inc/theme-welcome/tw-functions.php';	
	
	$logo_url = get_template_directory_uri() . '/inc/theme-welcome/i-design-welcome.jpg';
	$img_url = get_template_directory_uri() . '/inc/theme-welcome/images/';
	$active_tab = 'idesign_about';
	
	/* Urls */
	$reviewURL = esc_url('//wordpress.org/support/theme/i-design/reviews/?filter=5');
	$goPremiumURL = esc_url('//templatesnext.org/ispirit/landing/');
	$videoguide = esc_url('//www.templatesnext.org/i-design-documentation/');
	$supportforum = esc_url('//templatesnext.org/ispirit/landing/forums/'); 
	$toolkit = esc_url('//www.templatesnext.org/icreate/templatesnext-toolkit/');
	$fb_page = esc_url('//www.facebook.com/templatesnext/');
	$pb_tutorial = esc_url('https://siteorigin.com/page-builder/documentation/');


	$ocdi_buttont = "";
	if ( class_exists('OCDI_Plugin') ) {
		$ocdi_buttont = "button-enabled";
	} else
	{
		$ocdi_buttont = "button-disabled";
	} 	
	$details_theme = wp_get_theme();
	$name_version = $details_theme->get( 'Name' ) . " - " . $details_theme->get( 'Version' );
  	?>
  	<div class="wrapp">
        <div class="nx-info-wrap-2 welcome-panel">
        	
        	<div class="nx-info-wrap">
            	
                <div class="nx-welcome"><?php _e( 'Welcome To ', 'i-design' ); echo $name_version; ?></div>
                <div class="tx-wspace-24"></div>
                <div class="tx-wspace-24"></div>                
                <div class="welcome-logo"><img src="<?php echo $logo_url; ?>" alt="" class="welcome-logo-img" width="" /></div>
                <div class="nx-info-desc">
                    <p>
						<?php _e( 'Congratulations! You are about to use one of the most popular and easy to customize WordPress theme.', 'i-design' ); ?>
                    </p>
                    <p>
                    	<a class="" href="<?php echo admin_url(); ?>themes.php?page=tgmpa-install-plugins">
                        <?php _e( 'Install Recommended Plugins', 'i-design' ); ?>
                        </a> 
                        <?php _e( 'and <b>Kick start your website in one click</b>, Setup any one of our demo websites and edit/remove/add contents.', 'i-design' ); ?>
					</p>
                    <a class="button button-primary button-hero" href="<?php echo $reviewURL; ?>">
                    <?php _e( 'Post Your Review', 'i-design' ); ?>
                    </a>  
                    <a class="button button-primary button-hero" href="<?php echo $goPremiumURL; ?>">
                    	<?php _e( 'Go Premium', 'i-design' ); ?>
                    </a>  
                </div>
                <div class="tx-wspace-12"></div>
                <div class="nx-admin-row">
                	<div class="one-four-col">
                    	<a href="<?php echo $videoguide; ?>" target="_blank">
                            <div class="nx-dash"><span class="dashicons dashicons-video-alt2"></span></div>
                            <h3 class="tx-admin-link"><?php _e( 'Documentation', 'i-design' ); ?></h3>
                        </a>
                    </div>
                	<div class="one-four-col">
                    	<a href="<?php echo $supportforum; ?>" target="_blank">
                            <div class="nx-dash"><span class="dashicons dashicons-format-chat"></span></div>
                            <h3 class="tx-admin-link"><?php _e( 'Support Forum', 'i-design' ); ?></h3>
                        </a>
                    </div>
                	<div class="one-four-col">
                    	<a href="<?php echo $toolkit; ?>" target="_blank">
                            <div class="nx-dash"><span class="dashicons dashicons-migrate"></span></div>
                            <h3 class="tx-admin-link"><?php _e( 'TemplatesNext Toolkit', 'i-design' ); ?></h3>
                        </a>
                    </div>
                	<div class="one-four-col">
                    	<a href="<?php echo $fb_page; ?>" target="_blank">
                            <div class="nx-dash"><span class="dashicons dashicons-facebook-alt"></span></div>
                            <h3 class="tx-admin-link"><?php _e( 'Community', 'i-design' ); ?></h3>
                        </a>
                    </div>                                                            
                </div>
                <div class="tx-wspace-24"></div>
                <?php
					if( isset( $_GET[ 'tab' ] ) ) {
						$active_tab = $_GET[ 'tab' ];
					}
				?>
                <h2 class="nav-tab-wrapper">
                    <a href="?page=welcome-screen-about&tab=idesign_about" class="nav-tab <?php echo $active_tab == 'idesign_about' ? 'nav-tab-active' : ''; ?>">
                   		<?php _e( 'Setting Up i-design', 'i-design' ); ?>
                    </a>
                    <a href="?page=welcome-screen-about&tab=idesign_plugins" class="nav-tab <?php echo $active_tab == 'idesign_plugins' ? 'nav-tab-active' : ''; ?> nx-kick">
                    	<?php _e( 'Plugins', 'i-design' ); ?>
                    </a>
                    <a href="?page=welcome-screen-about&tab=idesign_faq" class="nav-tab <?php echo $active_tab == 'idesign_faq' ? 'nav-tab-active' : ''; ?> nx-plug">
                    	<?php _e( 'FAQs/Support', 'i-design' ); ?>
                    </a>
                </h2>
                
                <?php
					if( $active_tab == 'idesign_about' )
					{
				?> 
                	<div class="nx-tab-content">
                		<p>&nbsp;</p>
                        <ul class="nx-welcome">
  							<?php
									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Upload Logos', 'i-design' ));
									echo '</h3>';
									printf( esc_html__( 'Start with uploading your logos', 'i-design' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=title_tagline" target="_blank">Customizer Option</a>', 'i-design' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Set Theme Color', 'i-design' ));
									echo '</h3>';
									printf( esc_html__( 'Change theme color', 'i-design' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=colors" target="_blank">Customizer Option</a>', 'i-design' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Email And Phone', 'i-design' ));
									echo '</h3>';
									printf( esc_html__( 'Add your phone and email or empty the fields to remove them', 'i-design' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=basic" target="_blank">Customizer Option</a>', 'i-design' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Add Social Media Links', 'i-design' ));
									echo '</h3>';
									printf( esc_html__( 'Add social media links or empty the fields to remove the icons', 'i-design' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=social" target="_blank">Customizer Option</a>', 'i-design' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Turn ON/OFF Preloader', 'i-design' ));
									echo '</h3>';
									printf( esc_html__( 'Turn on or off page preloader, by default it is on', 'i-design' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=basic" target="_blank">Customizer Option</a>', 'i-design' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Activate The Slider', 'i-design' ));
									echo '</h3>';
									printf( esc_html__( 'Activate theme slider on default home page', 'i-design' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=blogpage" target="_blank">Customizer Option</a>', 'i-design' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Edit Slider', 'i-design' ));
									echo '</h3>';
									printf( esc_html__( 'Adjust slider settings, edit slides, etc.', 'i-design' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[panel]=slider" target="_blank">Customizer Option</a>', 'i-design' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Set Fonts', 'i-design' ));
									echo '</h3>';
									printf( esc_html__( 'Choose your fonts', 'i-design' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=typography" target="_blank">Customizer Option</a>', 'i-design' ), admin_url() );
									echo '</div>';								
									echo '</li>';
									
									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Choose Your Plugins', 'i-design' ));
									echo '</h3>';
									printf( esc_html__( 'I-DESIGN supports most of the popular plugins. We have listed some of the most popular plugins with high ratings. ', 'i-design' ) );
									printf( esc_html__( 'It is not neccssery to install and activate all the plugins recommendded. ', 'i-design' ) );
									printf( esc_html__( 'You need the correct set of plugins suiteable for your job.', 'i-design' ) );																		
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%sthemes.php?page=welcome-screen-about&tab=idesign_plugins" target="_blank">Customizer Option</a>', 'i-design' ), admin_url() );
									echo '</div>';								
									echo '</li>';									
                            ?>
                        </ul>                                                                        
        			</div>
				<?php		
					} elseif ( $active_tab == 'idesign_plugins' )
					{
				?>     
                	<div class="nx-tab-content"> 
                		<p>&nbsp;</p>
                        <ol>
							<?php
			
								foreach ($tx_plugins as $plugin) {
									
									$pluginLocation = rawurlencode($plugin['slug'].'/'.$plugin['pluginfile']);
									$pluginLink = idesign_plugin_activation( $pluginLocation, $plugin['slug'], $plugin['pluginfile'] );
									$nonce_install = idesign_plugin_install($plugin['slug']);
															
									
									echo '<li><b>'.$plugin['name'].'</b><br />';
									echo $plugin['desc'].'<br />';
									echo _e( 'Plugin URL : ', 'i-design' ).'<a href="'.$plugin['pluginurl'].'" target="_blank">'.$plugin['pluginurl'].'</a><br />';
									if(!empty($plugin['tutorial']))
									{
										echo _e( 'Tutorial : ', 'i-design' ).'<a href="'.$plugin['tutorial'].'" target="_blank">'.$plugin['tutorial'].'</a><br />';   
									}
									
									$pluginTitle = $plugin['title'];
									if ( is_plugin_active( $plugin['slug'].'/'.$plugin['pluginfile'] ) ) {
										echo '<a href="#" class="button disabled">' . __( 'Plugin installed and active', 'i-design' ) . '</a>';  
									} elseif( idesign_is_plugin_installed($pluginTitle) == false )
									{
										echo '<a data-slug="' . $plugin['slug'] . '" data-active-lebel="' . __( 'Installing...', 'i-design' ) . '" class="install-now button" href="' . esc_url( $nonce_install ) . '" data-name="' . $plugin['slug'] . '" aria-label="Install ' . $plugin['slug'] . '">' . __( 'Install and activate', 'i-design' ) . '</a>';
									} else
									{
										echo '<a class="button activate-now button-primary" data-active-lebel="' . __( 'Activating...', 'i-design' ) . '" data-slug="' . $plugin['slug'] . '" href="' . esc_url( $pluginLink ) . '" aria-label="Activate ' . $plugin['slug'] . '">Activate</a>';
									}
									
									echo '</li>';
									
								}
                            ?>                    
                        </ol>
        			</div>       
                        
				<?php	
					} elseif ( $active_tab == 'idesign_faq' )
					{
				?>     
                	<div class="nx-tab-content"> 
                		<p>&nbsp;</p>
                        <?php
							foreach ($tx_faqs as $faq) {
								echo '<b>'._e( 'Q. ', 'i-design' ).$faq['question'].'</b><br />';
								echo _e( 'A. ', 'i-design' ).$faq['answeer'].'<br /><br />';									   
							}
                        ?>                    
                        
        			</div>      
                        
				<?php	
					}
				?>
  
                <div class="tx-wspace-24"></div><div class="tx-wspace-24"></div>    
 	
            </div>

                <div id="dashboard_right_now" class="postbox" style="display: block; float: right; width: 33%; max-width: 320px; margin: 16px;">
                    <h2 class="hndle nxw-title" style="padding: 12px 24px;"><span><?php echo $review_pop['title']; ?></span></h2>
                    <div class="inside">
                        <div class="main" style="padding: 24px;">
							<?php echo $review_pop['desc']; ?>
                    		<a class="button button-primary button-hero" target="_blank" href="<?php echo $reviewURL; ?>">
                            	<?php echo $review_pop['link']; ?>
                            </a> 
                            <?php echo $review_pop['conclusion']; ?>
                        </div>
                    </div>
                </div>   

            <div class="tx-wspace"></div>
        
            
            
        </div>
        
  	</div>
  
  	<?php
}

add_action( 'admin_head', 'welcome_screen_remove_menus' );
function welcome_screen_remove_menus() {
    remove_submenu_page( 'index.php', 'welcome-screen-about' );
}


// Add Stylesheet
add_action( 'admin_enqueue_scripts', 'idesign_welcome_scripts' );
function idesign_welcome_scripts() {
	wp_enqueue_style( 'nx-welcome-style', get_template_directory_uri() . '/inc/theme-welcome/css/nx-welcome.css', array(), '1.01' );
	wp_enqueue_script( 'nx-welcome-script', get_template_directory_uri() . '/inc/theme-welcome/js/nx-welcome.js' );
}
