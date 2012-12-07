<?php

/**
 * Berkeley Theme - theme-settings.php
 */

/**
 * Implements hook_form_system_theme_settings_alter().
 *
 * @param $form
 *   Nested array of form elements that comprise the form.
 * @param $form_state
 *   A keyed array containing the current state of the form.
 */
function berkeley_form_system_theme_settings_alter(&$form, &$form_state, $form_id = NULL)  {
  // Work-around for a core bug affecting admin themes. See issue #943212.
  if (isset($form_id)) {
    return;
  }

  // Collapse fieldsets for standard theme settings
  $form['theme_settings']['#collapsible'] = TRUE;
  $form['theme_settings']['#collapsed'] = TRUE;
  $form['logo']['#collapsible'] = TRUE;
  $form['logo']['#collapsed'] = TRUE;
  $form['favicon']['#collapsible'] = TRUE;
  $form['favicon']['#collapsed'] = TRUE;
  $form['breadcrumb']['#collapsible'] = TRUE;
  $form['breadcrumb']['#collapsed'] = TRUE;
  $form['support']['#collapsible'] = TRUE;
  $form['support']['#collapsed'] = TRUE;
  $form['themedev']['#collapsible'] = TRUE;
  $form['themedev']['#collapsed'] = TRUE;

  // Create the form using Forms API: http://api.drupal.org/api/7
  $form['berkeley_settings'] = array(
    "#type"  => "fieldset",
    "#title" => "Berkeley Settings",
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  // Manually set Berkeley header images - see below for alternate option
  $header_options = array(
    t('Berkeley Headers')  => array(
      'header-abstract.png'         => t('Abstract'),
      'header-aerial.png'           => t('Aerial'),
      'header-arch-detail-1.png'    => t('Architectural Details 1'),
      'header-arch-detail-2.png'    => t('Architectural Details 2'),
      'header-arch-detail-3.png'    => t('Architectural Details 3'),
      'header-arch-detail-4.png'    => t('Architectural Details 4'),
      'header-arch-detail-5.png'    => t('Architectural Details 5'),
      'header-arch-detail-6.png'    => t('Architectural Details 6'),
      'header-bas-relief-1.png'     => t('Bas Relief 1'),
      'header-bas-relief-2.png'     => t('Bas Relief 2'),
      'header-bas-relief-3.png'     => t('Bas Relief 3'),
      'header-campanile-1.png'      => t('Campanile 1'),
      'header-campanile-2.png'      => t('Campanile 2'),
      'header-campanile-3.png'      => t('Campanile 3'),
      'header-library.png'          => t('Campus Library'),
      'header-campus-path.png'      => t('Campus Path'),
      'header-campus-trees-1.png'   => t('Campus Trees 1'),
      'header-campus-trees-2.png'   => t('Campus Trees 2'),
      'header-campus-trees-3.png'   => t('Campus Trees 3'),
      'header-campus-trees-4.png'   => t('Campus Trees 4'),
      'header-campus-trees-5.png'   => t('Campus Trees 5'),
      'header-center-gradient.png'  => t('Center Gradient'),
      'header-hearst-mining.png'    => t('Hearst Mining'),
      'header-molecules.png'        => t('Molecules'),
      'header-mosaic.png'           => t('Mosaic'),
      'header-sathergate-1.png'     => t('Sather Gate 1'),
      'header-sathergate-2.png'     => t('Sather Gate 2'),
      'header-south-hall.png'       => t('South Hall'),
      'header-sproul.png'           => t('Sproul'),
      'header-students.png'         => t('Students'),
      'header-three-arches.png'     => t('Three Arches'),
    ),
  );

  /* Delete this line for alternate option to get available images in 'header-images' directory
  $header_options = berkeley_get_available_images();
  //Or could change 'header-images' directory in berkeley_get_available_images function
  //and merge with original $header_options:
  //$header_options = array_merge($header_options, berkeley_get_available_images());
  //*/

  // Select Header Image
  $form['berkeley_settings']['berkeley_header_image'] = array(
    '#type'          => 'select',
    '#title'         => t('Header Image for Berkeley'),
    '#options'       => $header_options,
    '#description'   => t("Select the header image you would like to use."),
    '#default_value' => theme_get_setting('berkeley_header_image'),
    '#ajax'          => array(
      'callback'     => 'berkeley_image_preview_callback',
      'wrapper'      => 'header_image_div',
     ),
  );

  // Header Image Preview
  $form['berkeley_settings']['berkeley_header_image_preview'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Preview of Header Image for Berkeley'),
    'image'          => berkeley_image_preview_initial(),
    '#collapsible'   => TRUE,
    '#collapsed'     => FALSE,
  );

  $form['berkeley_settings']['font_handling'] = array(
    '#type' => 'fieldset',
    '#title' => t('Font Handling'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  // Font Handling - adapted from http://drupal.org/project/mayo
  // Font stacks - see http://drupal.org/project/zen and http://unitinteractive.com/blog/2008/06/26/better-css-font-stacks/

  $font_options = array(
    t('Berkeley Font Families') => array(
      '"Helvetica Neue",Helvetica,Arial,sans-serif;'                    => t('Helvetica Neue'),
      'Helvetica, "Helvetica Neue", Arial, "Nimbus Sans L", sans-serif' => t('Helvetica'),
      'Verdana, Tahoma, "DejaVu Sans", sans-serif'                      => t('Verdana'),
      'Geneva, “Lucida Sans”, “Lucida Grande”, Verdana, sans-serif'     => t('Geneva'),
      'Times New Roman", Times, Georgia, "DejaVu Serif", serif'         => t('Times New Roman'),
      'Custom'                                                          => t('Custom'),
    ),
  );

  // Select Base Font Family
  $form['berkeley_settings']['font_handling']['berkeley_base_font_family'] = array(
    '#type'          => 'select',
    '#title'         => t('Base font family'),
    '#options'       => $font_options,
    '#description'   => t("Select the font family you would like to use."),
    '#default_value' => theme_get_setting('berkeley_base_font_family'),
  );

  // Allow user to input custom base font family
  $form['berkeley_settings']['font_handling']['custom_base_font_family'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Custom base font family'),
    '#default_value' => theme_get_setting('custom_base_font_family'),
    '#size'          => 80,
    '#description'   => t('Enter the base font-family you want to use. See above base font family options for example formatting.'),
    '#states'        => array(
      'visible'      => array(
        // Display only when Custom font family selected. See http://api.drupal.org/api/examples/form_example%21form_example_states.inc/function/form_example_states_form/7
        ':input[name="berkeley_base_font_family"]' => array('value' => 'Custom'),
      ),
    ),
  );

  // Font size options
  $fontsize_options = array(
    t('Berkeley Font Sizes') => array(
      '75%'    => '75% (=12px)',
      '81.25%' => '81.25% (=13px)',
      '87.5%'  => '87.5% (=14px)',
      '93.75%' => '93.75% (=15px)',
      '100%'   => '100% (=16px)',
      '112.5%' => '112.5% (=18px)'
    ),
  );

  // Select Font Size
  $form['berkeley_settings']['font_handling']['berkeley_font_size'] = array(
    '#type'          => 'select',
    '#title'         => t('Base font size'),
    '#options'       => $fontsize_options,
    '#description'   => t("Select the font size you would like to use. Base font size = 16px = 100% = 1em."),
    '#default_value' => theme_get_setting('berkeley_font_size'),
  );

  // Select Heading Font Family
  $form['berkeley_settings']['font_handling']['berkeley_heading_font_family'] = array(
    '#type'          => 'select',
    '#title'         => t('Heading font family'),
    '#options'       => $font_options,
    '#description'   => t("Select the font family you would like to use for headings."),
    '#default_value' => theme_get_setting('berkeley_heading_font_family'),
  );

  // Allow user to input custom font family
  $form['berkeley_settings']['font_handling']['custom_heading_font_family'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Custom heading font family'),
    '#default_value' => theme_get_setting('custom_heading_font_family'),
    '#size'          => 80,
    '#description'   => t('Enter the heading font-family you want to use. See above heading font family options for example formatting.'),
    '#states'        => array(
      'visible'      => array(
        // Display only when Custom font family selected. See http://api.drupal.org/api/examples/form_example%21form_example_states.inc/function/form_example_states_form/7
        ':input[name="berkeley_heading_font_family"]' => array('value' => 'Custom'),
      ),
    ),
  );


  //Use lowercase for headings - if used, uncomment here, in template.php, and .info file
  /*
  $form['berkeley_settings']['font_handling']['berkeley_lowercase_headings'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Lowercase Headings'),
    '#default_value' => theme_get_setting('berkeley_lowercase_headings'),
    '#description'   => t('Check this box to use lowercase headings. Note: Site Name and
                           Parent Organization will not be affected and will be displayed
                           as entered at <a href="@href">Site Information Settings.</a>', array(
                           '@href' => '/admin/config/system/site-information',)),
  );
  */

  // Quick Links
  $form['berkeley_settings']['quick_links'] = array(
    '#type' => 'fieldset',
    '#title' => t('Quick Links'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#description'   => t('If you would like to include a Quick Links widget at the top of the page,
                           check the following box. You can then add blocks to this region via
                           the <a href="@href">Blocks configuration page</a>.',
                           array('@href' => '/admin/structure/block',)),
  );

  //Optional Quick Links widget
  $form['berkeley_settings']['quick_links']['include_quick_links'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Include Quick Links'),
    '#default_value' => theme_get_setting('include_quick_links'),
  );

  // Define the link for Quick Links without Javascript enabled
  $form['berkeley_settings']['quick_links']['quicklinks_link'] = array(
    '#type' => 'textfield',
    '#title' => 'If Javascript is disabled, link to:',
    '#default_value' => theme_get_setting('quicklinks_link'),
    '#description'   => t('Enter the node you would like to link to if the user has Javascript disabled. Example: node/1'),
    '#states'        => array(
      'visible'      => array(
        // Display only when "Include Quick Links" is checked. See http://api.drupal.org/api/examples/form_example%21form_example_states.inc/function/form_example_states_form/7
        ':input[name="include_quick_links"]' => array('checked' => TRUE),
      ),
    ),
  );

  // Define the social media links
  $form['berkeley_settings']['social_media'] = array(
    '#type' => 'fieldset',
    '#title' => t('Social Media Links in Footer'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#description'   => t('If you would like to include links to your social media pages,
                           check the following box and then enter the appropriate information
                           in the optional fields below.'),
  );

  //Social media option
  $form['berkeley_settings']['social_media']['include_social_media'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Include Social Media Links'),
    '#default_value' => theme_get_setting('include_social_media'),
  );

  // Define the facebook link
  $form['berkeley_settings']['social_media']['facebook_link'] = array(
    '#type' => 'textfield',
    '#title' => 'Facebook',
    '#default_value' => theme_get_setting('facebook_link'),
    '#description'   => t('Enter your Facebook username.'),
    '#states'        => array(
      'visible'      => array(
        // Display only when "Include Social Media Links" is checked. See http://api.drupal.org/api/examples/form_example%21form_example_states.inc/function/form_example_states_form/7
        ':input[name="include_social_media"]' => array('checked' => TRUE),
      ),
    ),
  );

  // Define the twitter link
  $form['berkeley_settings']['social_media']['twitter_link'] = array(
    '#type' => 'textfield',
    '#title' => 'Twitter',
    '#default_value' => theme_get_setting('twitter_link'),
    '#description'   => t('Enter your Twitter username.'),
    '#states'        => array(
      'visible'      => array(
        // Display only when "Include Social Media Links" is checked. See http://api.drupal.org/api/examples/form_example%21form_example_states.inc/function/form_example_states_form/7
        ':input[name="include_social_media"]' => array('checked' => TRUE),
      ),
    ),
  );

  // Define the linkedin link
  $form['berkeley_settings']['social_media']['linkedin_link'] = array(
    '#type' => 'textfield',
    '#title' => 'LinkedIn',
    '#default_value' => theme_get_setting('linkedin_link'),
    '#description'   => t('Enter your LinkedIn URL. Example: http://www.linkedin.com/company/uc-berkeley'),
    '#states'        => array(
      'visible'      => array(
        // Display only when "Include Social Media Links" is checked. See http://api.drupal.org/api/examples/form_example%21form_example_states.inc/function/form_example_states_form/7
        ':input[name="include_social_media"]' => array('checked' => TRUE),
      ),
    ),
  );

  // Define the foursquare link
  $form['berkeley_settings']['social_media']['foursquare_link'] = array(
    '#type' => 'textfield',
    '#title' => 'Foursquare',
    '#default_value' => theme_get_setting('foursquare_link'),
    '#description'   => t('Enter your Foursquare URL. Example: https://foursquare.com/cal'),
    '#states'        => array(
      'visible'      => array(
        // Display only when "Include Social Media Links" is checked. See http://api.drupal.org/api/examples/form_example%21form_example_states.inc/function/form_example_states_form/7
        ':input[name="include_social_media"]' => array('checked' => TRUE),
      ),
    ),
  );

  // Define the youtube link
  $form['berkeley_settings']['social_media']['youtube_link'] = array(
    '#type' => 'textfield',
    '#title' => 'YouTube',
    '#default_value' => theme_get_setting('youtube_link'),
    '#description'   => t('Enter your YouTube Username.'),
    '#states'        => array(
      'visible'      => array(
        // Display only when "Include Social Media Links" is checked. See http://api.drupal.org/api/examples/form_example%21form_example_states.inc/function/form_example_states_form/7
        ':input[name="include_social_media"]' => array('checked' => TRUE),
      ),
    ),
  );

  // Define the google+ link
  $form['berkeley_settings']['social_media']['googleplus_link'] = array(
    '#type' => 'textfield',
    '#title' => 'Google+',
    '#default_value' => theme_get_setting('googleplus_link'),
    '#description'   => t('Enter your Google+ User ID Number.'),
    '#states'        => array(
      'visible'      => array(
        // Display only when "Include Social Media Links" is checked. See http://api.drupal.org/api/examples/form_example%21form_example_states.inc/function/form_example_states_form/7
        ':input[name="include_social_media"]' => array('checked' => TRUE),
      ),
    ),
  );

  // Define the google+ link
  $form['berkeley_settings']['social_media']['flickr_link'] = array(
    '#type' => 'textfield',
    '#title' => 'Flickr',
    '#default_value' => theme_get_setting('flickr_link'),
    '#description'   => t('Enter your Flickr URL. Example: http://www.flickr.com/photos/berkeleylab'),
    '#states'        => array(
      'visible'      => array(
        // Display only when "Include Social Media Links" is checked. See http://api.drupal.org/api/examples/form_example%21form_example_states.inc/function/form_example_states_form/7
        ':input[name="include_social_media"]' => array('checked' => TRUE),
      ),
    ),
  );

  // Define the rss link
  $form['berkeley_settings']['social_media']['rss_link'] = array(
    '#type' => 'textfield',
    '#title' => 'Rss',
    '#default_value' => theme_get_setting('rss_link'),
    '#description'   => t('Enter the full path to your primary RSS feed. Example: http://events.berkeley.edu/index.php/rss/sn/pubaff/type/day/tab/all_events.html'),
    '#states'        => array(
      'visible'      => array(
        // Display only when "Include Social Media Links" is checked. See http://api.drupal.org/api/examples/form_example%21form_example_states.inc/function/form_example_states_form/7
        ':input[name="include_social_media"]' => array('checked' => TRUE),
      ),
    ),
  );

  //Optional AddThis widget
  $form['berkeley_settings']['social_media']['sharing_addthis'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Sharing and Bookmarking'),
    '#default_value' => theme_get_setting('sharing_addthis'),
    '#description'   => t('Check this box to include a <a href="@href"> sharing and bookmarking widget</a>.',
                        array('@href' => 'http://www.addthis.com/',)),
  );

  // Extended main menu
  $form['berkeley_settings']['extended_menu'] = array(
    '#type' => 'fieldset',
    '#title' => t('Extended Main Menu'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#description'   => t('This theme is designed to work with a limited number of main menu items (e.g., fewer than 6),
                           with words that are short and meaningful.
                           If you need to slightly extend the number of main menu items, check the following box.'),
  );

  //Optional Extended Main Menu Items
  $form['berkeley_settings']['extended_menu']['extended_menu_items'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Extend number of main menu items'),
    '#default_value' => theme_get_setting('extended_menu_items'),
  );

  /**
   * Options for Open Berkeley
   */

  // Open Berkeley section
  $form['berkeley_settings']['openberkeley'] = array(
    '#type' => 'fieldset',
    '#title' => t('Open Berkeley'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#description'   => t('This theme is designed to work with the Open Berkeley distribution.
                           For more information about Open Berkeley, contact <a href="@href">IST Drupal</a>.
                           Check the appropriate items below to apply standard styling.',
                           array('@href' => 'mailto:ist-drupal@lists.berkeley.edu',)),
  );

  //Standard styling for News Archive view
  $form['berkeley_settings']['openberkeley']['openberkeley_newsarchive'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Add standard styling for News Archive view'),
    '#default_value' => theme_get_setting('openberkeley_newsarchive'),
  );

  //Standard styling for FAQ
  if (module_exists('faq')) {
    $form['berkeley_settings']['openberkeley']['openberkeley_faq'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Add standard styling for FAQ (requires <a href="@href">FAQ module</a>)',
                        array('@href' => 'http://drupal.org/project/faq',)),
    '#default_value' => theme_get_setting('openberkeley_faq'),
  );
  }

  // Remove some of the base theme's settings.
  /* -- Delete this line if you want to turn off this setting.
  unset($form['themedev']['zen_wireframes']); // We don't need to toggle wireframes on this site.
  // */

  // We are editing the $form in place, so we don't need to return anything.
}


/**
 * Display the initial header image
 */
function berkeley_image_preview_initial() {

  //Get theme setting for header image
  $image_file = theme_get_setting('berkeley_header_image');

  return berkeley_image_preview($image_file);

}

/**
 * Ajax callback for selected header image
 */
function berkeley_image_preview_callback($form, $form_state) {

  //Get current header image from $form_state
  $image_file = $form_state['values']['berkeley_header_image'];

  return berkeley_image_preview($image_file);

}

/**
 * Preview the selected header image
 */
function berkeley_image_preview($image_file) {

  $image_preview = array();

  //Build full path to image
  $image_path = '/' . drupal_get_path('theme', 'berkeley') . '/header-images';
  $image_path .= "/$image_file";

  $variables = array(
    'path' => "$image_path",
    'alt' => 'Preview of header image',
    'title' => 'Preview of header image',
    'width' => '100%',
    'height' => '50%',
    //'attributes' => array('class' => 'some-img', 'id' => 'my-img'),
  );

  // Image preview
  $image_preview = array(
    '#markup' => theme('image', $variables),
    '#prefix' => '<div id="header_image_div">',
    '#suffix' => '</div>',

  );

  return $image_preview;
}

/**
 * Get a list of all available images in 'header-images' directory - adapted from http://drupal.org/project/noggin
 */
function berkeley_get_available_images() {
  // Search for png and jpg files by default
  $allowed_extensions = array('jpg', 'png');
  // Path to theme
  $theme_path = drupal_get_path('theme', 'berkeley');
  // Build the available images array
  $images = array();
  foreach ($allowed_extensions as $extension) {
    $files = drupal_system_listing("/\.$extension$/", "$theme_path/header-images", 'name', 0);
    foreach ($files as $name => $image) {
      $images["$image->filename"] = $image->filename;
    }
  }
  if (count($images)) {
    $options['Available Images'] = $images;
  }
  return $options;
}

