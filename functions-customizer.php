<?php

require_once('functions-image-reload.php');
function allow_users_who_can_edit_posts_to_customize( $caps, $cap, $user_id ) {
  $required_cap = 'edit_posts';
  if ( 'customize' === $cap && user_can( $user_id, $required_cap ) ) {
    $caps = array( $required_cap );
  }
  return $caps;
}
add_filter( 'map_meta_cap', 'allow_users_who_can_edit_posts_to_customize', 10, 3 );


function add_to_author_profile( $contactmethods ) {
  
  $contactmethods['rss_url'] = 'RSS URL';
  $contactmethods['google_profile'] = 'Google Profile URL';
  $contactmethods['twitter_profile'] = 'Twitter Profile URL';
  $contactmethods['facebook_profile'] = 'Facebook Profile URL';
  $contactmethods['linkedin_profile'] = 'Linkedin Profile URL';
  
  return $contactmethods;
}
add_filter( 'user_contactmethods', 'add_to_author_profile', 10, 1);

function wpt_register_theme_customizer( $wp_customize ) {

	add_theme_support('post-thumbnails');

	//var_dump( $wp_customize );

	// Customize title and tagline sections and labels
	$wp_customize->get_section('title_tagline')->title = __('Site Name and Description', 'thylacine');
	$wp_customize->get_control('blogname')->label = __('Site Name', 'thylacine');
	$wp_customize->get_control('blogdescription')->label = __('Site Description', 'thylacine');
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	// Customize the Front Page Settings
	$wp_customize->get_section('static_front_page')->title = __('Homepage Preferences', 'thylacine');
	$wp_customize->get_section('static_front_page')->priority = 20;
	$wp_customize->get_control('show_on_front')->label = __('Choose Homepage Preference', 'thylacine');
	$wp_customize->get_control('page_on_front')->label = __('Select Homepage', 'thylacine');
	$wp_customize->get_control('page_for_posts')->label = __('Select Blog Homepage', 'thylacine');

	// Customize Background Settings
	$wp_customize->get_section('background_image')->title = __('Background Styles', 'thylacine');
	$wp_customize->get_control('background_color')->section = 'background_image';

	// Customize Header Image Settings
	$wp_customize->add_section( 'header_text_styles' , array(
		'title'      => __('Header Text Styles','thylacine'),
		'priority'   => 30
	) );
	$wp_customize->get_control('display_header_text')->section = 'header_text_styles';
	$wp_customize->get_control('header_textcolor')->section = 'header_text_styles';
  $wp_customize->get_control('header_textcolor')->label = __('Site Title Color', 'thylacine');
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
  $wp_customize->get_setting( 'header_textcolor' )->default= '#27ae60';

  // Add Custom Logo Settings
  $wp_customize->add_section( 'custom_logo' , array(
    'title'      => __('Change Your Logo','thylacine'),
    'panel'      => 'general_settings',
    'priority'   => 20
  ) );
  $wp_customize->add_setting(
      'wpt_logo',
      array(
          'default'         => get_template_directory_uri() . '/img/logo.png',
          'transport'       => 'postMessage'
      )
  );
  $wp_customize->add_control(
       new My_Customize_Image_Reloaded_Control(
           $wp_customize,
           'custom_logo',
           array(
               'label'      => __( 'Change Logo', 'thylacine' ),
               'section'    => 'custom_logo',
               'settings'   => 'wpt_logo',
               'context'    => 'wpt-custom-logo'
           )
       )
   );
  // Add Custom Footer Text
  $wp_customize->add_section( 'custom_footer_text' , array(
    'title'      => __('Change Footer Text','thylacine'),
    'panel'      => 'general_settings',
  ) );
  $wp_customize->add_setting(
      'wpt_footer_text',
      array(
          'default'           => __( '<p><p>&copy; Copyright 2016 <strong>Your Name</strong>, Thylacine Theme. <strong>DNAatWork.io<strong>.</p><i>Change your footers html. </i><code> Appearance => Customize => General Settings => Change Footer Text </code>', 'thylacine' ),
          'transport' => 'refresh', // or postMessage
      )
  );
  $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'custom_footer_text',
            array(
                'label'          => __( 'Footer Text', 'thylacine' ),
                'section'        => 'custom_footer_text',
                'settings'       => 'wpt_footer_text',
                'type'           => 'textarea'
            )
        )
   );

	// custom home primary HTML
	$wp_customize->add_section( 'custom_home_html_field' , array(
    'title'      => __('Home Page','thylacine'),
    'panel'      => 'design_settings',
  ) );
  $wp_customize->add_setting(
      'wpt_custom_home_html',
      array(
				'default'           => __( '<div class="container"> <div class="jumbotron_demo"> <h1>Home Page - Primary <strong>Jumbotron</strong> </h1> <p class="text-white" >Notice, this section is within a <b>Jumbotron</b> class. This section can be replaced with HTML code to whatever your heart desires. </p> <code> Appearance => Customize => Design Setting => Home Page - Primary HTML</code><br></br> <p class="text-white">Replace the background image for this section in the <i>Edit Page</i> section and upload the image using the <i>Set featured Image</i>. </p><code> Pages => Customize => All Pages => <i>Select Your Page</i> => Set Featured Image </code> </div> <blockquote><p class="text-white">FYI, yes this section is above the body area. This is to allow use of full-width images.<p></blockquote> </div>', 'thylacine' ),
				'transport'   => 'refresh'
      )
  );
  $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'custom_home_html',
            array(
                'label'          => __( 'Home Page - Primary HTML', 'thylacine' ),
                'section'        => 'custom_home_html_field',
                'settings'       => 'wpt_custom_home_html',
                'type'           => 'textarea'
            )
        )
   );
	 // custom home secondary HTML
   $wp_customize->add_setting(
       'wpt_custom_home_secondary_html',
       array(
				 'default'           => __( '<div class="container"> <div class="jumbotron_demo"> <h1>Home Page - Secondary <strong>Jumbotron</strong> </h1> <p class="text-white">Notice, this section is within a <b>Jumbotron</b> class. This section can be replaced with HTML code once more to whatever your heart desires. FYI, yes this section is below the body area. This is to allow use of full-width images. </p> <code> Appearance => Customize => Design Setting => Home Page - Secondary HTML</code><br></br> <p class="text-white">Replace the background image for this section in the theme <i>customize</i> section and upload a new image using the <i>Home Page - Secondary Image</i> select area. </p><code> Appearance => Customize => Design Setting => Home Page - Secondary Image</code> </div><blockquote><p class="text-white">FYI, yes this section is below the body area. This is to allow use of full-width images.<p></blockquote> </div>', 'thylacine' ),
				'transport'   => 'refresh'
       )
   );
   $wp_customize->add_control(
         new WP_Customize_Control(
             $wp_customize,
             'custom_home_html_bottom',
             array(
                 'label'          => __( 'Home Page - Secondary HTML', 'thylacine' ),
                 'section'        => 'custom_home_html_field',
                 'settings'       => 'wpt_custom_home_secondary_html',
                 'type'           => 'textarea'
             )
         )
    );
		$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';

		// Add home page second image Settings
		$wp_customize->add_setting(
			 'wpt_custom_home_image',
			 array(
					 'default'         => get_template_directory_uri() . '/img/dummie_photo.png',
					 'transport'       => 'refresh'
			 )
		);
		$wp_customize->add_control(
				new My_Customize_Image_Reloaded_Control(
						$wp_customize,
						'custom_home_secondary',
						array(
								'label'      => __( 'Home Page - Secondary Image', 'thylacine' ),
								'section'    => 'custom_home_html_field',
								'settings'   => 'wpt_custom_home_image',
								'context'    => 'wpt-custom-logo'
						)
				)
		 );
	 // custom page HTML
 	$wp_customize->add_section( 'custom_page_html_field' , array(
     'title'      => __('Custom Page HTML','thylacine'),
     'panel'      => 'design_settings',
     'priority'   => 2000
   ) );
   $wp_customize->add_setting(
       'wpt_custom_page_html',
       array(
				 'default'     => __( '<div class="container"> <div class="jumbotron_demo"> <h1>Custom Page - Primary <strong>Jumbotron</strong> </h1> <p class="text-white" >Notice, this section is within a <b>Jumbotron</b> class. This section can be replaced with HTML code to whatever your heart desires. </p> <code> Appearance => Customize => Design Setting => Custom Page => Add custom html here</code><br></br> </div> <blockquote><p class="text-white">FYI, yes this section is above the body area. This is to allow use of full-width images.<p></blockquote> </div>', 'thylacine' ),
				 'transport'   => 'refresh',
				 )
   );
   $wp_customize->add_control(
         new WP_Customize_Control(
             $wp_customize,
             'custom_page_html',
             array(
                 'label'          => __( 'Add custom html here', 'thylacine' ),
                 'section'        => 'custom_page_html_field',
                 'settings'       => 'wpt_custom_page_html',
                 'type'           => 'textarea'
             )
         )
    );
  // Colors Style Settings
  $wp_customize->add_section( 'color_styles' , array(
    'title'      => __('Colors','thylacine'),
    'panel'      => 'design_settings',
  ) );

  // Colors Defualt
  $wp_customize->add_setting(
      'wpt_color_styles_defualt',
      array(
          'default'         => '#3e3f3a',
          'transport'       => 'refresh'
      )
  );
  $wp_customize->add_control(
       new WP_Customize_Color_Control(
           $wp_customize,
           'custom_color_styles_defualt',
           array(
               'label'      => __( 'Default - Color', 'thylacine' ),
               'section'    => 'color_styles',
               'settings'   => 'wpt_color_styles_defualt',
           )
       )
   );
   // Colors Primary
   $wp_customize->add_setting(
       'wpt_color_styles_primary',
       array(

           'default'         => '#27ae60',
           'transport'       => 'refresh'
       )
   );
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'custom_color_styles_primary',
            array(
                'label'      => __( 'Primary - Color', 'thylacine' ),
                'section'    => 'color_styles',
                'settings'   => 'wpt_color_styles_primary',
            )
        )
    );
    // Colors Success
    $wp_customize->add_setting(
        'wpt_color_styles_success',
        array(
            'default'         => '#2980b9',
            'transport'       => 'refresh'
        )
    );
    $wp_customize->add_control(
         new WP_Customize_Color_Control(
             $wp_customize,
             'custom_color_styles_success',
             array(
                 'label'      => __( 'Success - Color', 'thylacine' ),
                 'section'    => 'color_styles',
                 'settings'   => 'wpt_color_styles_success'
             )
         )
     );
    // Colors Info
    $wp_customize->add_setting(
        'wpt_color_styles_info',
        array(
            'default'         => '#f1c40f',
            'transport'       => 'refresh'
        )
    );
    $wp_customize->add_control(
         new WP_Customize_Color_Control(
             $wp_customize,
             'custom_color_styles_info',
             array(
                 'label'      => __( 'Info - Color', 'thylacine' ),
                 'section'    => 'color_styles',
                 'settings'   => 'wpt_color_styles_info'
             )
         )
     );
    // Colors Warning
    $wp_customize->add_setting(
        'wpt_color_styles_warning',
        array(
            'default'         => '#d35400',
            'transport'       => 'refresh'
        )
    );
    $wp_customize->add_control(
         new WP_Customize_Color_Control(
             $wp_customize,
             'custom_color_styles_warning',
             array(
                 'label'      => __( 'Info - Color', 'thylacine' ),
                 'section'    => 'color_styles',
                 'settings'   => 'wpt_color_styles_warning'
             )
         )
     );
    // Colors Danger
    $wp_customize->add_setting(
        'wpt_color_styles_danger',
        array(
            'default'         => '#c0392b',
            'transport'       => 'refresh'
        )
    );
    $wp_customize->add_control(
         new WP_Customize_Color_Control(
             $wp_customize,
             'custom_color_styles_danger',
             array(
                 'label'      => __( 'Warning - Color', 'thylacine' ),
                 'section'    => 'color_styles',
                 'settings'   => 'wpt_color_styles_danger'
             )
         )
     );
    // unvisited link 
    $wp_customize->add_setting(
        'wpt_color_styles_link',
        array(
            'default'         => '#27ae60',
            'transport'       => 'refresh'
        )
    );
    $wp_customize->add_control(
         new WP_Customize_Color_Control(
             $wp_customize,
             'custom_color_styles_link',
             array(
                 'label'      => __( 'Unvisited Link - Color', 'thylacine' ),
                 'section'    => 'color_styles',
                 'settings'   => 'wpt_color_styles_link'
             )
         )
     );
    // visited link
    $wp_customize->add_setting(
        'wpt_color_styles_visited_link',
        array(
            'default'         => '#95a5a6',
            'transport'       => 'refresh'
        )
    );
    $wp_customize->add_control(
         new WP_Customize_Color_Control(
             $wp_customize,
             'custom_color_styles_visited_link',
             array(
                 'label'      => __( 'Visited Link - Color', 'thylacine' ),
                 'section'    => 'color_styles',
                 'settings'   => 'wpt_color_styles_visited_link'
             )
         )
     );
    // mouse over link
    $wp_customize->add_setting(
        'wpt_color_styles_mouse_over_link',
        array(
            'default'         => '#27ae60',
            'transport'       => 'refresh'
        )
    );
    $wp_customize->add_control(
         new WP_Customize_Color_Control(
             $wp_customize,
             'custom_color_styles_mouse_over_link',
             array(
                 'label'      => __( 'Mouse Over Link - Color', 'thylacine' ),
                 'section'    => 'color_styles',
                 'settings'   => 'wpt_color_styles_mouse_over_link'
             )
         )
     );
    // Selected Link
    $wp_customize->add_setting(
        'wpt_color_styles_selected_link',
        array(
            'default'         => '#2c3e50',
            'transport'       => 'refresh'
        )
    );
    $wp_customize->add_control(
         new WP_Customize_Color_Control(
             $wp_customize,
             'custom_color_styles_selected_link',
             array(
                 'label'      => __( 'Selected Link - Color', 'thylacine' ),
                 'section'    => 'color_styles',
                 'settings'   => 'wpt_color_styles_selected_link'
             )
         )
     );
  // Navbar Style Settings
  $wp_customize->add_section( 'navbar_styles' , array(
    'title'      => __('Navbar Styles','thylacine'),
    'panel'      => 'design_settings',
    'priority'   => 100
  ) );
  // Navbar 1 Background Color - Base
  $wp_customize->add_setting(
      'wpt_nav_background_color',
      array(
          'default'         => '#FFF',
          'transport'       => 'refresh'
      )
  );
  $wp_customize->add_control(
       new WP_Customize_Color_Control(
           $wp_customize,
           'custom_nav_background_color',
           array(
               'label'      => __( 'Navbar - Background Color', 'thylacine' ),
               'section'    => 'navbar_styles',
               'settings'   => 'wpt_nav_background_color',
           )
       )
   );
   // Navbar 1 Border Color - Base
   $wp_customize->add_setting(
       'wpt_nav_border_color',
       array(

           'default'         => '#27ae60',
           'transport'       => 'refresh'
       )
   );
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'custom_nav_border_color',
            array(
                'label'      => __( 'Navbar - Border Color', 'thylacine' ),
                'section'    => 'navbar_styles',
                'settings'   => 'wpt_nav_border_color',
            )
        )
    );
    // Navbar 1 Hover Color Button - Base
    $wp_customize->add_setting(
        'wpt_nav_hover_button_color',
        array(
            'default'         => '#27ae60',
            'transport'       => 'refresh'
        )
    );
    $wp_customize->add_control(
         new WP_Customize_Color_Control(
             $wp_customize,
             'custom_nav_hover_button_color',
             array(
                 'label'      => __( 'Navbar - Hover Color Button', 'thylacine' ),
                 'section'    => 'navbar_styles',
                 'settings'   => 'wpt_nav_hover_button_color'
             )
         )
     );
     // Navbar 1 Hover Text Button - Base
     $wp_customize->add_setting(
         'wpt_nav_hover_text_color',
         array(
             'default'         => '#ecf0f1',
             'transport'       => 'refresh'
         )
     );
     $wp_customize->add_control(
          new WP_Customize_Color_Control(
              $wp_customize,
              'custom_nav_hover_text_color',
              array(
                  'label'      => __( 'Navbar - Hover Text Color', 'thylacine' ),
                  'section'    => 'navbar_styles',
                  'settings'   => 'wpt_nav_hover_text_color',
                  //issue disapeared when using 'refresh' instead of 'post maessage' //'description' => __( 'Note: After changing the link hover color, the theme must be saved and the page refreshed. After that, the settings will be displayed correctly.', 'thylacine' ),
              )
          )
      );
     // Navbar 1 Active Button Color
     $wp_customize->add_setting(
         'wpt_nav_active_button_color',
         array(
             'default'         => '#27ae60',
             'transport'       => 'refresh'
         )
     );
     $wp_customize->add_control(
          new WP_Customize_Color_Control(
              $wp_customize,
              'custom_nav_active_button_color',
              array(
                  'label'      => __( 'Navbar - Active Button Color', 'thylacine' ),
                  'section'    => 'navbar_styles',
                  'settings'   => 'wpt_nav_active_button_color',
                  //issue disapeared when using 'refresh' instead of 'post maessage' //'description' => __( 'Note: After changing the link hover color, the theme must be saved and the page refreshed. After that, the settings will be displayed correctly.', 'thylacine' ),
              )
          )
      );
     // Navbar 1 General Text 
     $wp_customize->add_setting(
         'wpt_nav_general_text_color',
         array(
             'default'         => '#27ae60',
             'transport'       => 'refresh'
         )
     );
     $wp_customize->add_control(
          new WP_Customize_Color_Control(
              $wp_customize,
              'custom_nav_general_text_color',
              array(
                  'label'      => __( 'Navbar - Text Color', 'thylacine' ),
                  'section'    => 'navbar_styles',
                  'settings'   => 'wpt_nav_general_text_color',
              )
          )
      );

  // Add P, H1, H2, H3, H4, H5, H6. Typography Style Settings
  $wp_customize->add_section( 'typography_styles' , array(
    'title'      => __('Typography','thylacine'),
    'panel'      => 'design_settings',
    'priority'   => 100
  ) );
  // Typography - Base
  $wp_customize->add_setting(
      'wpt_b_color',
      array(

          'default'         => '#7f8c8d',
          'transport'       => 'postMessage'
      )
  );
  $wp_customize->add_control(
       new WP_Customize_Color_Control(
           $wp_customize,
           'custom_b_color',
           array(
               'label'      => __( 'Base - Font Color', 'thylacine' ),
               'section'    => 'typography_styles',
               'settings'   => 'wpt_b_color',
           )
       )
   );
  $wp_customize->add_setting(
      'wpt_b_font_size',
      array(
        'default'         => '1.0000em',
        'transport'       => 'refresh'
      )
  );
  $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'custom_b_font_size',
            array(
                'label'          => __( 'Base - Font Size', 'thylacine' ),
                'section'        => 'typography_styles',
                'settings'       => 'wpt_b_font_size',
                'type'           => 'select',
                'choices'        => array(
                   '0.5000em'	=>	'0.5000 em (~8  px)',
                   '0.5625em'	=>	'0.5625 em (~9  px)',
                   '0.6250em'	=>	'0.6250	em (~10 px)',
                   '0.6875em'	=>	'0.6875 em (~11 px)',
                   '0.7500em'	=>	'0.7500	em (~12 px)',
                   '0.8125em'	=>	'0.8125 em (~13 px)',
                   '0.8750em'	=>	'0.8750 em (~14 px)',
                   '0.9375em'	=>	'0.9375 em (~15 px)',
                   '1.0000em'	=>	'1.0000 em (~16 px) [Base]',
                   '1.1250em'	=>	'1.1250 em (~18 px)',
                   '1.2500em'	=>	'1.2500 em (~20 px)',
                   '1.3750em'	=>	'1.3750 em (~22 px)',
                   '1.5000em'	=>	'1.5000 em (~24 px)',
                   '1.6250em'	=>	'1.6250 em (~26 px)',
                   '1.7500em'	=>	'1.7500 em (~28 px)',
                   '1.8750em'	=>	'1.8750 em (~30 px)',
                   '2.0000em'	=>	'2.0000 em (~32 px)',
                   '2.1250em'	=>	'2.1250 em (~34 px)',
                   '2.2500em'	=>	'2.2500 em (~36 px)',
                   '2.3750em'	=>	'2.3750 em (~38 px)',
                   '2.5000em'	=>	'2.5000	em (~40 px)',
                )
            )
        )
   );// Typography - H1
   $wp_customize->add_setting(
       'wpt_HS1_color',
       array(

           'default'         => '#7f8c8d',
           'transport'       => 'postMessage'
       )
   );
   $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'custom_HS1_color',
            array(
                'label'      => __( 'H1 - Font Color', 'thylacine' ),
                'section'    => 'typography_styles',
                'settings'   => 'wpt_HS1_color',
            )
        )
    );
   $wp_customize->add_setting(
       'wpt_HS1_font_size',
       array(
         'default'         => '2.5630em',
         'transport'       => 'refresh'
       )
   );
   $wp_customize->add_control(
         new WP_Customize_Control(
             $wp_customize,
             'custom_HS1_font_size',
             array(
                 'label'          => __( 'H1 - Font Size', 'thylacine' ),
                 'section'        => 'typography_styles',
                 'settings'       => 'wpt_HS1_font_size',
                 'type'           => 'select',
                 'choices'        => array(
                    '0.5000em'	=>	'0.5000 em (~8  px)',
                    '0.5625em'	=>	'0.5625 em (~9  px)',
                    '0.6250em'	=>	'0.6250	em (~10 px)',
                    '0.6875em'	=>	'0.6875 em (~11 px)',
                    '0.7500em'	=>	'0.7500	em (~12 px)',
                    '0.8125em'	=>	'0.8125 em (~13 px)',
                    '0.8750em'	=>	'0.8750 em (~14 px)',
                    '0.9375em'	=>	'0.9375 em (~15 px)',
                    '1.0000em'	=>	'1.0000 em (~16 px)',
                    '1.1250em'	=>	'1.1250 em (~18 px)',
                    '1.2500em'	=>	'1.2500 em (~20 px)',
                    '1.3750em'	=>	'1.3750 em (~22 px)',
                    '1.5000em'	=>	'1.5000 em (~24 px)',
                    '1.6250em'	=>	'1.6250 em (~26 px)',
                    '1.7500em'	=>	'1.7500 em (~28 px)',
                    '1.8750em'	=>	'1.8750 em (~30 px)',
                    '2.0000em'	=>	'2.0000 em (~32 px)',
                    '2.1250em'	=>	'2.1250 em (~34 px)',
                    '2.2500em'	=>	'2.2500 em (~36 px)',
                    '2.3750em'	=>	'2.3750 em (~38 px)',
                    '2.5000em'	=>	'2.5000	em (~40 px)',
                    '2.5630em'	=>	'2.5630	em (~41 px) [Base]',
                 )
             )
         )
    );
    // Typography - H2
    $wp_customize->add_setting(
        'wpt_h2_color',
        array(
            'default'         => '#7f8c8d',
            'transport'       => 'postMessage'
        )
    );
    $wp_customize->add_control(
         new WP_Customize_Color_Control(
             $wp_customize,
             'custom_h2_color',
             array(
                 'label'      => __( 'H2 - Font Color', 'thylacine' ),
                 'section'    => 'typography_styles',
                 'settings'   => 'wpt_h2_color'
             )
         )
     );
    $wp_customize->add_setting(
        'wpt_h2_font_size',
        array(
          'default'         => '2.1250em',
          'transport'       => 'refresh'
        )
    );
    $wp_customize->add_control(
          new WP_Customize_Control(
              $wp_customize,
              'custom_h2_font_size',
              array(
                  'label'          => __( 'H2 - Font Size', 'thylacine' ),
                  'section'        => 'typography_styles',
                  'settings'       => 'wpt_h2_font_size',
                  'type'           => 'select',
                  'choices'        => array(
                     '0.5000em'	=>	'0.5000 em (~8  px)',
                     '0.5625em'	=>	'0.5625 em (~9  px)',
                     '0.6250em'	=>	'0.6250	em (~10 px)',
                     '0.6875em'	=>	'0.6875 em (~11 px)',
                     '0.7500em'	=>	'0.7500	em (~12 px)',
                     '0.8125em'	=>	'0.8125 em (~13 px)',
                     '0.8750em'	=>	'0.8750 em (~14 px)',
                     '0.9375em'	=>	'0.9375 em (~15 px)',
                     '1.0000em'	=>	'1.0000 em (~16 px)',
                     '1.1250em'	=>	'1.1250 em (~18 px)',
                     '1.2500em'	=>	'1.2500 em (~20 px)',
                     '1.3750em'	=>	'1.3750 em (~22 px)',
                     '1.5000em'	=>	'1.5000 em (~24 px)',
                     '1.6250em'	=>	'1.6250 em (~26 px)',
                     '1.7500em'	=>	'1.7500 em (~28 px)',
                     '1.8750em'	=>	'1.8750 em (~30 px)',
                     '2.0000em'	=>	'2.0000 em (~32 px)',
                     '2.1250em'	=>	'2.1250 em (~34 px) [Base]',
                     '2.2500em'	=>	'2.2500 em (~36 px)',
                     '2.3750em'	=>	'2.3750 em (~38 px)',
                     '2.5000em'	=>	'2.5000	em (~40 px)'
                  )
              )
          )
     );
     // Typography - H3
     $wp_customize->add_setting(
         'wpt_h3_color',
         array(
             'default'         => '#7f8c8d',
             'transport'       => 'postMessage'
         )
     );
     $wp_customize->add_control(
          new WP_Customize_Color_Control(
              $wp_customize,
              'custom_h3_color',
              array(
                  'label'      => __( 'H3 - Font Color', 'thylacine' ),
                  'section'    => 'typography_styles',
                  'settings'   => 'wpt_h3_color'
              )
          )
      );
     $wp_customize->add_setting(
         'wpt_h3_font_size',
         array(
           'default'         => '1.7500em',
           'transport'       => 'refresh'
         )
     );
     $wp_customize->add_control(
           new WP_Customize_Control(
               $wp_customize,
               'custom_h3_font_size',
               array(
                   'label'          => __( 'H3 - Font Size', 'thylacine' ),
                   'section'        => 'typography_styles',
                   'settings'       => 'wpt_h3_font_size',
                   'type'           => 'select',
                   'choices'        => array(
                      '0.5000em'	=>	'0.5000 em (~8  px)',
                      '0.5625em'	=>	'0.5625 em (~9  px)',
                      '0.6250em'	=>	'0.6250	em (~10 px)',
                      '0.6875em'	=>	'0.6875 em (~11 px)',
                      '0.7500em'	=>	'0.7500	em (~12 px)',
                      '0.8125em'	=>	'0.8125 em (~13 px)',
                      '0.8750em'	=>	'0.8750 em (~14 px)',
                      '0.9375em'	=>	'0.9375 em (~15 px)',
                      '1.0000em'	=>	'1.0000 em (~16 px)',
                      '1.1250em'	=>	'1.1250 em (~18 px)',
                      '1.2500em'	=>	'1.2500 em (~20 px)',
                      '1.3750em'	=>	'1.3750 em (~22 px)',
                      '1.5000em'	=>	'1.5000 em (~24 px)',
                      '1.6250em'	=>	'1.6250 em (~26 px)',
                      '1.7500em'	=>	'1.7500 em (~28 px) [Base]',
                      '1.8750em'	=>	'1.8750 em (~30 px)',
                      '2.0000em'	=>	'2.0000 em (~32 px)',
                      '2.1250em'	=>	'2.1250 em (~34 px)',
                      '2.2500em'	=>	'2.2500 em (~36 px)',
                      '2.3750em'	=>	'2.3750 em (~38 px)',
                      '2.5000em'	=>	'2.5000	em (~40 px)'
                   )
               )
           )
      );
      // Typography - H4
      $wp_customize->add_setting(
          'wpt_h4_color',
          array(
              'default'         => '#7f8c8d',
              'transport'       => 'postMessage'
          )
      );
      $wp_customize->add_control(
           new WP_Customize_Color_Control(
               $wp_customize,
               'custom_h4_color',
               array(
                   'label'      => __( 'H4 - Font Color', 'thylacine' ),
                   'section'    => 'typography_styles',
                   'settings'   => 'wpt_h4_color'
               )
           )
       );
      $wp_customize->add_setting(
          'wpt_h4_font_size',
          array(
            'default'         => '1.2500em',
            'transport'       => 'refresh'
          )
      );
      $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'custom_h4_font_size',
                array(
                    'label'          => __( 'H4 - Font Size', 'thylacine' ),
                    'section'        => 'typography_styles',
                    'settings'       => 'wpt_h4_font_size',
                    'type'           => 'select',
                    'choices'        => array(
                       '0.5000em'	=>	'0.5000 em (~8  px)',
                       '0.5625em'	=>	'0.5625 em (~9  px)',
                       '0.6250em'	=>	'0.6250	em (~10 px)',
                       '0.6875em'	=>	'0.6875 em (~11 px)',
                       '0.7500em'	=>	'0.7500	em (~12 px)',
                       '0.8125em'	=>	'0.8125 em (~13 px)',
                       '0.8750em'	=>	'0.8750 em (~14 px)',
                       '0.9375em'	=>	'0.9375 em (~15 px)',
                       '1.0000em'	=>	'1.0000 em (~16 px)',
                       '1.1250em'	=>	'1.1250 em (~18 px)',
                       '1.2500em'	=>	'1.2500 em (~20 px) [Base]',
                       '1.3750em'	=>	'1.3750 em (~22 px)',
                       '1.5000em'	=>	'1.5000 em (~24 px)',
                       '1.6250em'	=>	'1.6250 em (~26 px)',
                       '1.7500em'	=>	'1.7500 em (~28 px)',
                       '1.8750em'	=>	'1.8750 em (~30 px)',
                       '2.0000em'	=>	'2.0000 em (~32 px)',
                       '2.1250em'	=>	'2.1250 em (~34 px)',
                       '2.2500em'	=>	'2.2500 em (~36 px)',
                       '2.3750em'	=>	'2.3750 em (~38 px)',
                       '2.5000em'	=>	'2.5000	em (~40 px)'
                    )
                )
            )
       );
       // Typography - H5
       $wp_customize->add_setting(
           'wpt_h5_color',
           array(
               'default'         => '#7f8c8d',
               'transport'       => 'postMessage'
           )
       );
       $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'custom_h5_color',
                array(
                    'label'      => __( 'H5 - Font Color', 'thylacine' ),
                    'section'    => 'typography_styles',
                    'settings'   => 'wpt_h5_color'
                )
            )
        );
       $wp_customize->add_setting(
           'wpt_h5_font_size',
           array(
             'default'         => '1.0000em',
             'transport'       => 'refresh'
           )
       );
       $wp_customize->add_control(
             new WP_Customize_Control(
                 $wp_customize,
                 'custom_h5_font_size',
                 array(
                     'label'          => __( 'H5 - Font Size', 'thylacine' ),
                     'section'        => 'typography_styles',
                     'settings'       => 'wpt_h5_font_size',
                     'type'           => 'select',
                     'choices'        => array(
                        '0.5000em'	=>	'0.5000 em (~8  px)',
                        '0.5625em'	=>	'0.5625 em (~9  px)',
                        '0.6250em'	=>	'0.6250	em (~10 px)',
                        '0.6875em'	=>	'0.6875 em (~11 px)',
                        '0.7500em'	=>	'0.7500	em (~12 px)',
                        '0.8125em'	=>	'0.8125 em (~13 px)',
                        '0.8750em'	=>	'0.8750 em (~14 px)',
                        '0.9375em'	=>	'0.9375 em (~15 px)',
                        '1.0000em'	=>	'1.0000 em (~16 px) [Base]',
                        '1.1250em'	=>	'1.1250 em (~18 px)',
                        '1.2500em'	=>	'1.2500 em (~20 px)',
                        '1.3750em'	=>	'1.3750 em (~22 px)',
                        '1.5000em'	=>	'1.5000 em (~24 px)',
                        '1.6250em'	=>	'1.6250 em (~26 px)',
                        '1.7500em'	=>	'1.7500 em (~28 px)',
                        '1.8750em'	=>	'1.8750 em (~30 px)',
                        '2.0000em'	=>	'2.0000 em (~32 px)',
                        '2.1250em'	=>	'2.1250 em (~34 px)',
                        '2.2500em'	=>	'2.2500 em (~36 px)',
                        '2.3750em'	=>	'2.3750 em (~38 px)',
                        '2.5000em'	=>	'2.5000	em (~40 px)'
                     )
                 )
             )
        );
        // Typography - H6
        $wp_customize->add_setting(
            'wpt_h6_color',
            array(
                'default'         => '#7f8c8d',
                'transport'       => 'postMessage'
            )
        );
        $wp_customize->add_control(
             new WP_Customize_Color_Control(
                 $wp_customize,
                 'custom_h6_color',
                 array(
                     'label'      => __( 'H6 - Font Color', 'thylacine' ),
                     'section'    => 'typography_styles',
                     'settings'   => 'wpt_h6_color'
                 )
             )
         );
        $wp_customize->add_setting(
            'wpt_h6_font_size',
            array(
              'default'         => '0.8750em',
              'transport'       => 'refresh'
            )
        );
        $wp_customize->add_control(
              new WP_Customize_Control(
                  $wp_customize,
                  'custom_h6_font_size',
                  array(
                      'label'          => __( 'H6 - Font Size', 'thylacine' ),
                      'section'        => 'typography_styles',
                      'settings'       => 'wpt_h6_font_size',
                      'type'           => 'select',
                      'choices'        => array(
                         '0.5000em'	=>	'0.5000 em (~8  px)',
                         '0.5625em'	=>	'0.5625 em (~9  px)',
                         '0.6250em'	=>	'0.6250	em (~10 px)',
                         '0.6875em'	=>	'0.6875 em (~11 px)',
                         '0.7500em'	=>	'0.7500	em (~12 px)',
                         '0.8125em'	=>	'0.8125 em (~13 px)',
                         '0.8750em'	=>	'0.8750 em (~14 px) [Base]',
                         '0.9375em'	=>	'0.9375 em (~15 px)',
                         '1.0000em'	=>	'1.0000 em (~16 px)',
                         '1.1250em'	=>	'1.1250 em (~18 px)',
                         '1.2500em'	=>	'1.2500 em (~20 px)',
                         '1.3750em'	=>	'1.3750 em (~22 px)',
                         '1.5000em'	=>	'1.5000 em (~24 px)',
                         '1.6250em'	=>	'1.6250 em (~26 px)',
                         '1.7500em'	=>	'1.7500 em (~28 px)',
                         '1.8750em'	=>	'1.8750 em (~30 px)',
                         '2.0000em'	=>	'2.0000 em (~32 px)',
                         '2.1250em'	=>	'2.1250 em (~34 px)',
                         '2.2500em'	=>	'2.2500 em (~36 px)',
                         '2.3750em'	=>	'2.3750 em (~38 px)',
                         '2.5000em'	=>	'2.5000	em (~40 px)'
                      )
                  )
              )
         );
         // Typography - PRE
         $wp_customize->add_setting(
             'wpt_pre_color',
             array(
                 'default'         => '#7f8c8d',
                 'transport'       => 'postMessage'
             )
         );
         $wp_customize->add_control(
              new WP_Customize_Color_Control(
                  $wp_customize,
                  'custom_pre_color',
                  array(
                      'label'      => __( 'Preformated - Font Color', 'thylacine' ),
                      'section'    => 'typography_styles',
                      'settings'   => 'wpt_pre_color'
                  )
              )
          );
         $wp_customize->add_setting(
             'wpt_pre_font_size',
             array(
               'default'         => '1.0000em',
               'transport'       => 'refresh'
             )
         );
         $wp_customize->add_control(
               new WP_Customize_Control(
                   $wp_customize,
                   'custom_pre_font_size',
                   array(
                       'label'          => __( 'Preformated - Font Size', 'thylacine' ),
                       'section'        => 'typography_styles',
                       'settings'       => 'wpt_pre_font_size',
                       'type'           => 'select',
                       'choices'        => array(
                          '0.5000em'	=>	'0.5000 em (~8  px)',
                          '0.5625em'	=>	'0.5625 em (~9  px)',
                          '0.6250em'	=>	'0.6250	em (~10 px)',
                          '0.6875em'	=>	'0.6875 em (~11 px)',
                          '0.7500em'	=>	'0.7500	em (~12 px)',
                          '0.8125em'	=>	'0.8125 em (~13 px)',
                          '0.8750em'	=>	'0.8750 em (~14 px)',
                          '0.9375em'	=>	'0.9375 em (~15 px)',
                          '1.0000em'	=>	'1.0000 em (~16 px) [Base]',
                          '1.1250em'	=>	'1.1250 em (~18 px)',
                          '1.2500em'	=>	'1.2500 em (~20 px)',
                          '1.3750em'	=>	'1.3750 em (~22 px)',
                          '1.5000em'	=>	'1.5000 em (~24 px)',
                          '1.6250em'	=>	'1.6250 em (~26 px)',
                          '1.7500em'	=>	'1.7500 em (~28 px)',
                          '1.8750em'	=>	'1.8750 em (~30 px)',
                          '2.0000em'	=>	'2.0000 em (~32 px)',
                          '2.1250em'	=>	'2.1250 em (~34 px)',
                          '2.2500em'	=>	'2.2500 em (~36 px)',
                          '2.3750em'	=>	'2.3750 em (~38 px)',
                          '2.5000em'	=>	'2.5000	em (~40 px)'
                       )
                   )
               )
          );

  // Add Custom CSS Textfield
  $wp_customize->add_section( 'custom_css_field' , array(
    'title'      => __('Custom CSS','thylacine'),
		'panel'      => 'design_settings',
    'priority'   => 2000
  ) );
  $wp_customize->add_setting(
      'wpt_custom_css',
      array(
          'sanitize_callback' => 'sanitize_textarea'
      )
  );
  $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'custom_css',
            array(
                'label'          => __( 'Add custom CSS here', 'thylacine' ),
                'section'        => 'custom_css_field',
                'settings'       => 'wpt_custom_css',
                'type'           => 'textarea'
            )
        )
   );
  // Create custom panels
  $wp_customize->add_panel( 'general_settings', array(
      'priority' => 10,
      'theme_supports' => '',
      'title' => __( 'General Settings', 'thylacine' ),
      'description' => __( 'Controls the basic settings for the theme.', 'thylacine' ),
  ) );
  $wp_customize->add_panel( 'design_settings', array(
      'priority' => 20,
      'theme_supports' => '',
      'title' => __( 'Design Settings', 'thylacine' ),
      'description' => __( 'Controls the basic design settings for the theme.', 'thylacine' ),
  ) );

  // Assign sections to panels
  $wp_customize->get_section('title_tagline')->panel = 'general_settings';
  $wp_customize->get_section('nav')->panel = 'general_settings';
  $wp_customize->get_section('static_front_page')->panel = 'general_settings';
  $wp_customize->get_section('header_text_styles')->panel = 'design_settings';
  $wp_customize->get_section('background_image')->panel = 'design_settings';
  $wp_customize->get_section('header_image')->panel = 'design_settings';

}
add_action( 'customize_register', 'wpt_register_theme_customizer' );


// Add theme support for Custom Header Image
$defaults = array(
  'default-image'          => get_template_directory_uri() . '/img/header-image.png',
	'width'                  => 1200,
	'height'                 => 280,
	'flex-height'            => true,
  'wp-head-callback'       => 'wpt_style_header'
);
add_theme_support( 'custom-header', $defaults );


// Callback function for updating header styles
function wpt_style_header() {

  $text_color = get_header_textcolor();

  ?>

  <style type="text/css">
.navbar-toggle {
    color: <?php echo get_theme_mod('wpt_nav_hover_button_color'); ?>;
}

.navbar-default .navbar-toggle:focus, .navbar-default .navbar-toggle:hover {
    color: <?php echo get_theme_mod('wpt_nav_hover_text_color'); ?>;
    background-color: <?php echo get_theme_mod('wpt_nav_hover_button_color'); ?>;

}
  #navbar-main a.navbar-brand.site-title {
    color: #<?php echo esc_attr( $text_color ); ?>;
  }

  <?php if(display_header_text() != true): ?>
  .site-title, .site-description {
    display: none;
  }
  <?php endif; ?>
  .navbar-default {
    background-color: <?php echo get_theme_mod('wpt_nav_background_color'); ?>;
    border-color: <?php echo get_theme_mod('wpt_nav_border_color'); ?>;
  }
  .navbar-default .navbar-nav>li>a:hover {
    color: <?php echo get_theme_mod('wpt_nav_hover_text_color'); ?>;
    background-color: <?php echo get_theme_mod('wpt_nav_hover_button_color'); ?>;
  }

  .navbar-default .navbar-nav>li>a {
    color: <?php echo get_theme_mod('wpt_nav_general_text_color'); ?>;
    }
    .navbar-default .navbar-nav>.active, .navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>.active>a:hover {
    background: <?php echo get_theme_mod('wpt_nav_active_button_color'); ?>;
  }
 .label-default {
    background-color: <?php echo get_theme_mod('wpt_color_styles_default'); ?>;
  }
  .alert-defualt {
    background-color: <?php echo get_theme_mod('wpt_color_styles_default'); ?>;
  }
  .label-primary {
    background-color: <?php echo get_theme_mod('wpt_color_styles_primary'); ?>;
}
.alert-primary {
    background-color: <?php echo get_theme_mod('wpt_color_styles_primary'); ?>;
  }
.label-success {
    background-color: <?php echo get_theme_mod('wpt_color_styles_success'); ?>;
}
.alert-sucess {
    background-color: <?php echo get_theme_mod('wpt_color_styles_success'); ?>;
  }
.label-info {
    background-color: <?php echo get_theme_mod('wpt_color_styles_info'); ?>;
}
.alert-info {
    background-color: <?php echo get_theme_mod('wpt_color_styles_info'); ?>;
  }
.label-warning {
    background-color: <?php echo get_theme_mod('wpt_color_styles_warning'); ?>;
}
.alert-warning {
    background-color: <?php echo get_theme_mod('wpt_color_styles_warning'); ?>;
  }
.label-danger {
    background-color: <?php echo get_theme_mod('wpt_color_styles_danger'); ?>;
}
.alert-danger {
    background-color: <?php echo get_theme_mod('wpt_color_styles_danger'); ?>;
  }
.list-group-item.active>.badge, .nav-pills>.active>a>.badge {
    background-color: <?php echo get_theme_mod('wpt_color_styles_success'); ?>;
}
 p {
    font-size: <?php echo get_theme_mod('wpt_b_font_size'); ?>;
    color: <?php echo get_theme_mod('wpt_b_color'); ?>;
  }
  h1 {
    font-size: <?php echo get_theme_mod('wpt_HS1_font_size'); ?>;
    color: <?php echo get_theme_mod('wpt_HS1_color'); ?>;
  }
  h2 {
    font-size: <?php echo get_theme_mod('wpt_h2_font_size'); ?>;
    color: <?php echo get_theme_mod('wpt_h2_color'); ?>;
  }
  h3 {
    font-size: <?php echo get_theme_mod('wpt_h3_font_size'); ?>;
    color: <?php echo get_theme_mod('wpt_h3_color'); ?>;
  }
  h4 {
    font-size: <?php echo get_theme_mod('wpt_h4_font_size'); ?>;
    color: <?php echo get_theme_mod('wpt_h4_color'); ?>;
  }
  h5 {
    font-size: <?php echo get_theme_mod('wpt_h5_font_size'); ?>;
    color: <?php echo get_theme_mod('wpt_h5_color'); ?>;
  }
  h6 {
    font-size: <?php echo get_theme_mod('wpt_h6_font_size'); ?>;
    color: <?php echo get_theme_mod('wpt_h6_color'); ?>;
  }
  pre {
    font-size: <?php echo get_theme_mod('wpt_pre_font_size'); ?>;
    color: <?php echo get_theme_mod('wpt_pre_color'); ?>;
  }

  <?php if( get_theme_mod('wpt_custom_css') != '' ) {
    echo get_theme_mod('wpt_custom_css');
  } ?>
a:link {
    color: <?php echo get_theme_mod('wpt_color_styles_link'); ?>;
}

a:visited {
    color: <?php echo get_theme_mod('wpt_color_styles_visited_link'); ?>;
}

a:hover {
    color: <?php echo get_theme_mod('wpt_color_styles_mouse_over_link'); ?>;
}
a:active {
    color: <?php echo get_theme_mod('wpt_color_styles_selected_link'); ?>;
}
.jumbotron-color {
  background-color: <?php echo get_theme_mod('wpt_color_styles_primary'); ?>;
}
input#submit {
      background-color: <?php echo get_theme_mod('wpt_color_styles_primary'); ?>;
}

  </style>
  <?php

}


// Add theme support for Custom Backgrounds
$defaults = array(
  'default-color' => '#efefef',
  'default-image' => get_template_directory_uri() . '/img/background-image.png',
);
add_theme_support( 'custom-background', $defaults );


// Sanitize text
function sanitize_text( $text ) {

    return sanitize_text_field( $text );

}

// Sanitize textarea
function sanitize_textarea( $text ) {

    return esc_textarea( $text );

}


// Custom js for theme customizer


?>
