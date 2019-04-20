<?php
	
include get_template_directory() . '/inc/theme-welcome/tw-functions.php';

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
	
	$logo_url = get_template_directory_uri() . '/inc/theme-welcome/i-design-welcome.jpg';
	$page_settings_url = get_template_directory_uri() . '/inc/theme-welcome/images/static-front-page-settings.png';	
	$page_settings_url_2 = get_template_directory_uri() . '/inc/theme-welcome/images/page-builder-page-settings.png';		
	$img_url = get_template_directory_uri() . '/inc/theme-welcome/images/';
	$ocdi_tab = 'themes.php?page=welcome-screen-about&tab=idesign_ocdi#ocdi-tab';
	$active_tab = 'idesign_about';
	
	/* Urls */
	$reviewURL = esc_url('//wordpress.org/support/theme/i-design/reviews/?filter=5');
	$goPremiumURL = esc_url('//templatesnext.org/ispirit/landing/?ref=idesignw');
	$videoguide = esc_url('//www.templatesnext.org/i-design-documentation/');
	$supportforum = esc_url('//templatesnext.org/ispirit/landing/forums/'); 
	$toolkit = esc_url('//www.templatesnext.org/i-design/?ref=idtw#tx-demos');
	$fb_page = esc_url('//www.facebook.com/templatesnext/');
	$pb_tutorial = esc_url('//siteorigin.com/page-builder/documentation/');
	
	$demo_import = esc_url('customize.php');		
	
	$intro_video_url = esc_url( 'https://www.youtube.com/embed/M_-HUs4EN-8?rel=0&amp;controls=1&amp;showinfo=0&amp;color=white&quot;theme=light' );
	$intro_video = '<iframe width="100%" src="'. $intro_video_url . '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';	


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
                <div class="nx-info-desc">
                    <p>                   	
                        <?php esc_attr_e( 'I-DESIGN is extremely flexible and customizable theme. It has more premium features than most of the top selling premium WordPress themes. Some of these features are :', 'i-design' ); ?>
                    </p>
                    <div class="nx-admin-row">
                        <div class="one-three-col">
                            <ul class="nx-features">                    	
                                <li><?php esc_attr_e( 'Maintenance Mode.', 'i-design' ); ?></li>
                                <li><?php esc_attr_e( 'Page Preloader.', 'i-design' ); ?></li>
                                <li><?php esc_attr_e( 'Google Fonts.', 'i-design' ); ?></li>
                            </ul>
                        </div>
                        <div class="one-three-col">
                            <ul class="nx-features">
                                <li><?php esc_attr_e( 'Built in 18+ custom shortcodes.', 'i-design' ); ?></li>
                                <li><?php esc_attr_e( 'Page Options &amp; templates.', 'i-design' ); ?></li>
                                <li><?php esc_attr_e( 'WooCommerce Wishlist & product compare.', 'i-design' ); ?></li>                                
                            </ul>
                        </div>                        
                        <div class="one-three-col">
                            <ul class="nx-features">    
                                <li><?php esc_attr_e( 'WooCommerce Products Crousels.', 'i-design' ); ?></li>
                                <li><?php esc_attr_e( 'Normal and transparent header.', 'i-design' ); ?></li>                    
                            </ul>
                        </div>
                    </div>
                    <p>
						<?php esc_attr_e( 'These features are free and will remain free. Install plugin &quot;TemplatesNext ToolKit&quot; to activate all the features.', 'i-design' ); ?>
                    </p>

                    <a class="button button-primary button-hero" target="_blank" href="<?php echo $toolkit; ?>">
                    <?php esc_attr_e( 'Live Demos', 'i-design' ); ?>
                    </a>                    
                    <a class="button button-primary button-hero" target="_blank" href="<?php echo $goPremiumURL; ?>">
                    	<?php esc_attr_e( 'Go Premium', 'i-design' ); ?>
                    </a>  
                </div>
                <div class="tx-wspace-24"></div> 
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
                    <!-- 
                    <a href="?page=welcome-screen-about&tab=idesign_ocdi" class="nav-tab <?php echo $active_tab == 'idesign_ocdi' ? 'nav-tab-active' : ''; ?> nx-kick">
                    	<?php _e( 'One Click Demo Import', 'i-design' ); ?>
                    </a>
                    -->
                    <a href="?page=welcome-screen-about&tab=idesign_pro" class="nav-tab <?php echo $active_tab == 'idesign_pro' ? 'nav-tab-active' : ''; ?> nx-plug">
                    	<?php _e( 'Go Premium', 'i-design' ); ?>
                    </a>
                    <a href="?page=welcome-screen-about&tab=idesign_plugins" class="nav-tab <?php echo $active_tab == 'idesign_plugins' ? 'nav-tab-active' : ''; ?> nx-kick">
                    	<?php _e( 'Useful Plugins', 'i-design' ); ?>
                    </a>
                    <a href="?page=welcome-screen-about&tab=idesign_faq" class="nav-tab <?php echo $active_tab == 'idesign_faq' ? 'nav-tab-active' : ''; ?> nx-plug">
                    	<?php _e( 'FAQs/Support', 'i-design' ); ?>
                    </a>
                    <!-- 
                    <a href="?page=welcome-screen-about&tab=idesign_vid" class="nav-tab <?php echo $active_tab == 'idesign_vid' ? 'nav-tab-active' : ''; ?> nx-plug">
                    	<?php _e( 'Video Guide', 'i-design' ); ?>
                    </a> 
                    -->                                       
                </h2>
                
                <?php
					if( $active_tab == 'idesign_about' ) {
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
									printf( __( '<a href="%scustomize.php?autofocus[section]=title_tagline" target="_blank">Customize Option</a>', 'i-design' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Set Theme Color', 'i-design' ));
									echo '</h3>';
									printf( esc_html__( 'Change theme color', 'i-design' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=colors" target="_blank">Customize Option</a>', 'i-design' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Email And Phone', 'i-design' ));
									echo '</h3>';
									printf( esc_html__( 'Add your phone and email or empty the fields to remove them', 'i-design' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=basic" target="_blank">Customize Option</a>', 'i-design' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Add Social Media Links', 'i-design' ));
									echo '</h3>';
									printf( esc_html__( 'Add social media links or empty the fields to remove the icons', 'i-design' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=social" target="_blank">Customize Option</a>', 'i-design' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Turn ON/OFF Preloader', 'i-design' ));
									echo '</h3>';
									printf( esc_html__( 'Turn on or off page preloader, by default it is on', 'i-design' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=basic" target="_blank">Customize Option</a>', 'i-design' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Activate The Slider', 'i-design' ));
									echo '</h3>';
									printf( esc_html__( 'Activate theme slider on default home page', 'i-design' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=blogpage" target="_blank">Customize Option</a>', 'i-design' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Edit Slider', 'i-design' ));
									echo '</h3>';
									printf( esc_html__( 'Adjust slider settings, edit slides, etc.', 'i-design' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[panel]=slider" target="_blank">Customize Option</a>', 'i-design' ), admin_url() );
									echo '</div>';								
									echo '</li>';

									echo '<li>';
									echo '<h3>';
									printf( esc_html__( 'Set Fonts', 'i-design' ));
									echo '</h3>';
									printf( esc_html__( 'Choose your fonts', 'i-design' ) );
									echo '<div class="nx-customizer-link">';
									printf( __( '<a href="%scustomize.php?autofocus[section]=typography" target="_blank">Customize Option</a>', 'i-design' ), admin_url() );
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
									printf( __( '<a href="%sthemes.php?page=welcome-screen-about&tab=idesign_plugins" target="_blank">Customize Option</a>', 'i-design' ), admin_url() );
									echo '</div>';								
									echo '</li>';									
                            ?>
                        </ul>                                                                    
        			</div>
                    <div>
                    	<h3 style="margin: 16px 0px 6px 0px;">
                        <a href="<?php echo $page_settings_url; ?>" class="nx-colorbox"><?php echo esc_attr__('Ideal Static Front Page Settings.', 'i-design'); ?></a>
                        </h3>
                    	<h3 style="margin: 16px 0px 6px 0px;">
                        <a href="<?php echo $page_settings_url_2; ?>" class="nx-colorbox"><?php echo esc_attr__('Ideal Page Settings For Page Builders Using Full Width Layout.', 'i-design'); ?></a>
                        </h3>
                        
                    </div>
				<?php		
					} elseif ( $active_tab == 'idesign_plugins' ) {
				?>     
                	<div class="nx-tab-content" id="ocdi-tab"> 
                		<p>&nbsp;</p>
                        <p>
                        	<?php esc_attr_e( 'These are the few plugins we love to use and listed for you. Choose the plugin you want. ', 'i-design'); ?>
                            <?php esc_attr_e( 'Apart from &quot;TemplatesNext ToolKit&quot; all the plugins listed below are optional and free.', 'i-design'); ?>
                            
                        </p>
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
					} elseif ( $active_tab == 'idesign_ocdi' ) {
				?>     
                	<div class="nx-tab-content"> 
                		<p>&nbsp;</p>
                        <p style="font-weight: 600; color: #272727;">
                            <?php _e( 'Following plugins were used while creating the &quot;One Click Demo&quot;s. <br>Once you are done with installing and activating the plugins go to', 'i-design' ); ?>
                            <a class="" href="<?php echo admin_url(); ?>themes.php?page=pt-one-click-demo-import">
                            <?php _e( 'I-Design Demo Setup', 'i-design' ); ?>
                            </a>                             
                        </p>                       
                        <ol>
							<?php
			
								foreach ($tx_plugins as $plugin) {
									
									$pluginLocation = rawurlencode($plugin['slug'].'/'.$plugin['pluginfile']);
									$pluginLink = idesign_plugin_activation( $pluginLocation, $plugin['slug'], $plugin['pluginfile'] );
									$nonce_install = idesign_plugin_install($plugin['slug']);
															
									if (!empty($plugin['ocdi']))
									{
										echo '<li><b>'.$plugin['title'].'</b><br />';
										echo $plugin['desc'].'<br />';
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
									
								}
                            ?>                    
                        </ol>
        			</div>                     
				<?php					
					} elseif ( $active_tab == 'idesign_faq' ) {
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
					} elseif ( $active_tab == 'idesign_pro' ) {
				?>     
                	<div class="nx-tab-content"> 
                		<p>&nbsp;</p>
                        <p class="go-pro-desc">	
							<?php esc_attr_e( 'We have only one premium theme I-SPIRIT, and it combines all the features of other free themes plus several additional premium features.', 'i-design'); ?>
                        	<?php esc_attr_e( 'With only one premium theme I-SPIRIT we have ensured that you receive maximum quality, support and regular updates.', 'i-design'); ?> 
                        </p>
                        <p>&nbsp;</p>
                        <div class="nx-price-table">
                        	<div class="nx-pt-row th-title">
                            	<div class="nx-pt-cell"></div>
                            	<div class="nx-pt-cell"><span class="th-name"><?php esc_attr_e( 'I-DESIGN', 'i-design'); ?></span></div>
                            	<div class="nx-pt-cell"><span class="th-name"><?php esc_attr_e( 'I-SPIRIT', 'i-design'); ?></span></div>
                                <div class="nx-pt-cell"><span class="th-name"><?php esc_attr_e( 'I-SPIRIT', 'i-design'); ?></span><span class="th-variation"><?php esc_attr_e( 'Developers Version', 'i-design'); ?></span></div>
                            </div>
                        	<div class="nx-pt-row th-price">
                            	<div class="nx-pt-cell"></div>
                            	<div class="nx-pt-cell"><span class="th-price"><?php esc_attr_e( 'FREE', 'i-design'); ?></span></div>
                            	<div class="nx-pt-cell"><span class="th-price"><?php esc_attr_e( '$48 USD', 'i-design'); ?></span><span class="th-usage"><?php esc_attr_e( 'Single Website', 'i-design'); ?></span></div>
                                <div class="nx-pt-cell"><span class="th-price"><?php esc_attr_e( '$320 USD', 'i-design'); ?></span><span class="th-usage"><?php esc_attr_e( 'Unlimited Websites', 'i-design'); ?></span></div>
                            </div>
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Page Preloader', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                            </div>
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Maintenance Mode', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                            </div>
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Updates', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Lifetime', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Lifetime', 'i-design'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'Lifetime', 'i-design'); ?></div>
                            </div>                            
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Google Fonts', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Top 20', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'All', 'i-design'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'All', 'i-design'); ?></div>
                            </div>
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Shortcodes', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( '18+', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( '65+', 'i-design'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( '65+', 'i-design'); ?></div>
                            </div>
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Header Style', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( '2', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( '6', 'i-design'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( '6', 'i-design'); ?></div>
                            </div>
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'WooCommerce Ready', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                            </div>  
                            
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'RTL Ready', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                            </div>
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Translation Ready', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                            </div>
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Slider Revolution', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'NO', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                            </div>
                        	<div class="nx-pt-row th-iteme">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'WPBakery Page Builder', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'NO', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                            </div>                            
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'White Label', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'NO', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                            </div>
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Premium Support', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'NO', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                            </div>
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'Custom Header', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'NO', 'i-design'); ?></div>
                            	<div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                                <div class="nx-pt-cell"><?php esc_attr_e( 'YES', 'i-design'); ?></div>
                            </div>   
                        	<div class="nx-pt-row th-item">
                            	<div class="nx-pt-cell"></div>
                            	<div class="nx-pt-cell"></div>
                            	<div class="nx-pt-cell"><a href="<?php echo $goPremiumURL; ?>" target="_blank" class="button button-primary button-hero th-price-button"><?php esc_attr_e( 'More Details', 'i-design'); ?></a></div>
                                <div class="nx-pt-cell"><a href="<?php echo $goPremiumURL; ?>" target="_blank" class="button button-primary button-hero th-price-button"><?php esc_attr_e( 'More Details', 'i-design'); ?></a></div>
                            </div>                                                                                                                                                                                                    
                        </div>
        			</div>      
                        
				<?php	
					} elseif ( $active_tab == 'idesign_vid' ) {
				?>     
                	<div class="nx-tab-content"> 
                		<p>&nbsp;</p>
                        <h2>Video Guide</h2>

                        <p><a href="#media-popup" data-media="//www.youtube.com/embed/b0cqdFTwmm8?autoplay=1">click me</a></p>
                            
                        <div class="popup" id="media-popup">
                        	<div class="nx-videowrapper">
                            	<iframe width="560" height="315" src="" frameborder="0" autoplay="1" allowfullscreen></iframe>
                                <div class="clvideo"><a href="#">Close Video</a></div>
                            </div>
                        </div>                       

        			</div>      
                        
				<?php	
					}
				?>
  
                <div class="tx-wspace-24"></div>
                <div class="tx-wspace-24"></div> 
                
                <div class="tx-wspace-12"></div>
                <div class="nx-admin-row">
                	<div class="one-four-col">
                    	<a href="<?php echo $videoguide; ?>" target="_blank">
                            <div class="nx-dash"><span class="dashicons dashicons-video-alt2"></span></div>
                            <h3 class="tx-admin-link"><?php esc_attr_e( 'Documentation', 'i-design' ); ?></h3>
                        </a>
                    </div>
                	<div class="one-four-col">
                    	<a href="<?php echo $supportforum; ?>" target="_blank">
                            <div class="nx-dash"><span class="dashicons dashicons-format-chat"></span></div>
                            <h3 class="tx-admin-link"><?php esc_attr_e( 'Support Forum', 'i-design' ); ?></h3>
                        </a>
                    </div>
                	<div class="one-four-col">
                    	<a href="<?php echo $toolkit; ?>" target="_blank">
                            <div class="nx-dash"><span class="dashicons dashicons-welcome-view-site"></span></div>
                            <h3 class="tx-admin-link"><?php esc_attr_e( 'Live Demos', 'i-design' ); ?></h3>
                        </a>
                    </div>
                	<div class="one-four-col">
                    	<a href="<?php echo $fb_page; ?>" target="_blank">
                            <div class="nx-dash"><span class="dashicons dashicons-facebook-alt"></span></div>
                            <h3 class="tx-admin-link"><?php esc_attr_e( 'Community', 'i-design' ); ?></h3>
                        </a>
                    </div>                                                            
                </div>                
 	
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
	
	
	$activation_button = idesign_customizer_activate_notice ();
	wp_localize_script('nx-welcome-script', 'recomended_notice', $activation_button);	
}
