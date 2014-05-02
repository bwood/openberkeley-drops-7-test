<?php
/**
 * Berkeley Theme - template.php
 */

/**
 * Override forms via hook_form_alter()
 * Use devel and dpm($form) to find information about specific form
 */
 function berkeley_form_alter(&$form, &$form_state, $form_id) {

  //Changes to FAQ form
  if (module_exists('faq') && $form_id == 'faq_node_form') {
    // Detailed question description
    $form['title']['#description'] = t('Question to be answered. This will appear in all question listings.');
    $form['detailed_question']['#title'] = t('Question (Long Form) - Optional');
    $form['detailed_question']['#description'] = t('Optional. If you have a long question, indicate a short name above
     and use this field instead for the full question.');
  }

  // Add default text to the search block form
  if ($form_id == 'search_block_form') {
    // HTML5 placeholder attribute
    $form['search_block_form']['#attributes']['placeholder'] = t('Search this site...');
  }

  //Changes to Site Information Form (admin/config/system/site-information)
  else if ($form_id == 'system_site_information_settings') {
    //Rename Site Slogan as Parent Organization
    $form['site_information']['site_slogan']['#title'] = t('Parent Organization (Optional)');
    $form['site_information']['site_slogan']['#description'] = t("This is an optional field.
      Leave blank if you don't want to include a parent organization. Can be toggled in theme settings.");
  }

  //Changes to Theme Settings Form (admin/appearance/settings)
  else if ($form_id == 'system_theme_settings') {

    //Rename Site Slogan as Parent Organization
    $form['theme_settings']['toggle_slogan']['#title'] = t('Parent Organization');

    //Note regarding logo size
    $form['theme_settings']['toggle_logo']['#title'] = t('Logo (Should be smaller than 80x80 if using Berkeley theme)');
    $form['logo']['settings']['logo_path']['#title'] = t('Path to custom logo (Should be smaller than 80x80 if using Berkeley theme)');
    $form['logo']['settings']['logo_upload']['#title'] = t('Upload logo image (Should be smaller than 80x80 if using Berkeley theme)');

    //Changes to default nice menu settings

    if (module_exists('nice_menus')) {

      $form['berkeley_nice_menus'] = array(
        '#type'         => 'fieldset',
        '#title'        => t('Berkeley with Nice Menus'),
        '#collapsible'  => TRUE,
        '#collapsed'    => TRUE,
      );

      $form['berkeley_nice_menus']['main_menu_nice_menus'] = array(
        '#type'           => 'checkbox',
        '#title'          => t('Use Drop-Down Menus for Main Menu'),
        '#default_value'  => theme_get_setting('main_menu_nice_menus'),
        '#description'    => t('Check this box if you want to use drop-down menus for your main menu.
                            This requires the Nice Menus module (http://drupal.org/project/nice_menus): nice_menus-7.x-2.3 or later.
                            Set Menu Depth below.
                            Note: Typically, drop-down menus work best if you keep them simple (e.g., avoid many levels).
                            See <a href="@href"> Drop-Down Menus: Use Sparingly</a>.',
                            array('@href' => 'http://www.useit.com/alertbox/20001112.html',)),
        '#weight'         => 50,
      );


      //Move nice menus element into fieldset at bottom of form
      $form['berkeley_nice_menus']['nice_menus_custom_css'] = $form['nice_menus_custom_css'];
      unset($form['nice_menus_custom_css']);

      $form['berkeley_nice_menus']['nice_menus_custom_css']['#title'] =
        t('Path to custom CSS file for Nice Menus');

      $form['berkeley_nice_menus']['nice_menus_custom_css']['#description'] =
        t('The Berkeley theme includes default styling for Nice Menus.
        To override the default Nice Menus CSS layout, enter the path to your custom CSS file.
        It should be a relative path from the root of your Drupal install (e.g. sites/all/themes/example/mymenu.css).');

      $form['berkeley_nice_menus']['nice_menus_custom_css']['#weight'] = 100;

      $form['berkeley_nice_menus']['nice_menus_custom_css']['#states'] = array(
        'visible'      => array(
          // Display only when "Use Drop-Down Menus for Main Menu" is checked. See http://api.drupal.org/api/examples/form_example%21form_example_states.inc/function/form_example_states_form/7
          ':input[name="main_menu_nice_menus"]' => array('checked' => TRUE),
        ),
      );

      $nice_menus_depth_options = array(
        t('Nice Menu Depth') => array(
          '-1'    => t('Display all children (-1)'),
          '0'     => t('Display no children (0)'),
          '1'     => t('Display 1 child (1)'),
          '2'     => t('Display 2 children (2)'),
          '3'     => t('Display 3 children (3)'),
          '4'     => t('Display 4 children (4)'),
          '5'     => t('Display 5 children (5)'),
        ),
      );

      //Nice menus depth
      $form['berkeley_nice_menus']['nice_menus_depth'] = array(
        '#type' => 'select',
        '#title' => t('Menu Depth'),
        '#options' => $nice_menus_depth_options,
        '#description' => t('The depth of the menu, i.e., the number of child levels starting with the parent selected above. Leave set to -1 to display all children and use 0 to display no children.'),
        '#default_value' => theme_get_setting('nice_menus_depth'),
        '#weight'         => 60,
        '#states'        => array(
          'visible'      => array(
            // Display only when "Use Drop-Down Menus for Main Menu" is checked.  See http://api.drupal.org/api/examples/form_example%21form_example_states.inc/function/form_example_states_form/7
            ':input[name="main_menu_nice_menus"]' => array('checked' => TRUE),
          ),
        ),
      );

    }

  }
 }


/**
 * Override or insert variables into the maintenance page template.
 */
/* -- Delete this line if you want to use this function
function berkeley_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  berkeley_preprocess_html($variables, $hook);
  berkeley_preprocess_page($variables, $hook);
}
// */

/**
 * Override or insert variables into the html templates.
 */
/* -- Delete this line if you want to use this function
function berkeley_preprocess_html(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
  //$variables['classes_array'] = array_diff($variables['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the page templates.
 */
function berkeley_preprocess_page(&$variables, $hook) {

  //Set options for drupal_add_css (http://api.drupal.org/api/drupal/includes%21common.inc/function/drupal_add_css/7)
  $options = array(
    'type'  => 'inline',
    'group' => CSS_THEME,
  );

  //Get theme setting for header image
  $image_file = theme_get_setting('berkeley_header_image');

  //Build full path to image
  $image_path = '/' . drupal_get_path('theme', 'berkeley') . '/header-images';
  $image_path .= "/$image_file";

  //Add selected header image as css background
  $header_bkd_selector = '#topwrapper';
  $topwrapper_color = '#012545';
  $attributes = 'no-repeat center top';
  $height = '260px';
  $css = "$header_bkd_selector {background:url('$image_path') $attributes; height:$height;
                      -webkit-background-size: cover;
                      -moz-background-size: cover;
                      -o-background-size: cover;
                      background-size: cover;
                    }";
  drupal_add_css($css, $options);

  // Set up variables for standard theme images and text
  global $base_url;
  $site_path = $base_url . base_path();

  $variables['berkeley'] = t('<a href="@href"><img alt="@alt" id="berkeley-img" src="@src" width="@width" height="@height" /></a>', array(
    '@href'   => $site_path,
    '@alt'    => 'University of California, Berkeley',
    '@src'    => '/' . drupal_get_path('theme', 'berkeley') . '/images/berkeley.png',
    '@width'  => '204',
    '@height' => '70',
  ));
  $variables['divider'] = t('<img alt="@alt" id="divider-img" src="@src" width="@width" height="@height" />', array(
    '@alt'    => '',
    '@src'    => '/' . drupal_get_path('theme', 'berkeley') . '/images/divider-gold.png',
    '@width'  => '5',
    '@height' => '122',
  ));
  $variables['ucbseal'] = t('<a href="@href"><img alt="@alt" id="ucbseal-img" src="@src" width="@width" height="@height" /></a>', array(
    '@href'   => 'http://www.berkeley.edu',
    '@alt'    => 'University of California, Berkeley',
    '@src'    => '/' . drupal_get_path('theme', 'berkeley') . '/images/uc-seal.png',
    '@width'  => '290',
    '@height' => '60',
  ));

  // If Quick Links is enabled but Javascript is disabled, link to node provided in theme setting
  if (theme_get_setting('include_quick_links')) {
    $css = "#secondary-menu, .lt-ie9 #secondary-menu {right: 228px;}";
    drupal_add_css($css, $options);
    $variables['quicklinks_link'] = t('<a href="@href" id="quick-links">Quick Links</a>', array(
      '@href'   => $site_path . theme_get_setting('quicklinks_link'),
    ));
  }

  // Setup the social links
  // Current options: facebook, twitter, linkedin, foursquare, youtube, googleplus, flickr, rss
  // In Drupal 7, class element must be array even if single element: http://api.drupal.org/api/drupal/includes%21common.inc/function/l/7#comment-2608

  $social_links = array();

  if (theme_get_setting('facebook_link')) {
    $facebook_link = "http://www.facebook.com/" . theme_get_setting('facebook_link');
    $social_links[] = l('Facebook', $facebook_link, array('attributes' => array('class' => array('facebook-link'))));
  }

  if (theme_get_setting('twitter_link')) {
    $twitter_link = "http://twitter.com/" . theme_get_setting('twitter_link');
    $social_links[] = l('Twitter', $twitter_link, array('attributes' => array('class' => array('twitter-link'))));
  }

  if (theme_get_setting('linkedin_link')) {
    $linkedin_link = theme_get_setting('linkedin_link');
    $social_links[] = l('LinkedIn', $linkedin_link, array('attributes' => array('class' => array('linkedin-link'))));
  }

  if (theme_get_setting('foursquare_link')) {
    $foursquare_link = theme_get_setting('foursquare_link');
    $social_links[] = l('Foursquare', $foursquare_link, array('attributes' => array('class' => array('foursquare-link'))));
  }

  if (theme_get_setting('youtube_link')) {
    $youtube_link = "http://www.youtube.com/user/" . theme_get_setting('youtube_link');
    $social_links[] = l('YouTube', $youtube_link, array('attributes' => array('class' => array('youtube-link'))));
  }

  if (theme_get_setting('googleplus_link')) {
    $googleplus_link = "https://plus.google.com/" . theme_get_setting('googleplus_link');
    $social_links[] = l('GooglePlus', $googleplus_link, array('attributes' => array('class' => array('googleplus-link'))));
  }

  if (theme_get_setting('flickr_link')) {
    $flickr_link = theme_get_setting('flickr_link');
    $social_links[] = l('Flickr', $flickr_link, array('attributes' => array('class' => array('flickr-link'))));
  }
  if (theme_get_setting('rss_link')) {
    $rss_link = theme_get_setting('rss_link');
    $social_links[] = l('Rss', $rss_link, array('attributes' => array('class' => array('rss-link'))));
  }

  $variables['include_social'] = theme_get_setting('include_social_media') ? TRUE : FALSE;

  $variables['social_links'] = theme('item_list', array('items' => $social_links));

  // AddThis widget (optional theme setting). See https://www.addthis.com/get/sharing
  if (theme_get_setting('sharing_addthis')) {
    $variables['addthis'] = t('<a class="@class" href="@href"><img alt="@alt" id="addthis-img" src="@src"
                             width="@width" height="@height" style="@style"/></a>
                             <script type="text/javascript" src="@jssrc"></script>',
                             array(
    '@class'  => 'addthis_button',
    '@href'   => 'http://www.addthis.com/bookmark.php?v=250&amp;pubid=xa-4fe4f0ce09ef8296',
    '@alt'    => 'Bookmark and Share',
    '@src'    => 'https://s7.addthis.com/static/btn/sm-share-en.gif',
    '@width'  => '83',
    '@height' => '16',
    '@style'  => 'border:0',
    '@jssrc'  => 'http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4fe4f0ce09ef8296',
  ));
  }

  $variables['copyright'] = t('Copyright © UC Regents. All rights reserved.');

  // Add font-related styles based on base font family selection
  $base_font_family = theme_get_setting('berkeley_base_font_family');
  if ($base_font_family == 'Custom') { // Custom
    $style = theme_get_setting('custom_base_font_family');
  }
  else {
    $style = $base_font_family;
  }
  $text_selector = 'html, button, input, select, textarea';
  $css = "$text_selector {font-family: $style;}";
  drupal_add_css($css, $options);

  // Adjust font size based on selection
  $base_font_size = theme_get_setting('berkeley_font_size');
  $css = "html {font-size: $base_font_size;}";
  drupal_add_css($css, $options);

  // Add font-related styles based on heading font family selection
  $heading_font_family = theme_get_setting('berkeley_heading_font_family');
  if ($heading_font_family == 'Custom') { // Custom
    $style = theme_get_setting('custom_heading_font_family');
  }
  else {
    $style = $heading_font_family;
  }
  $heading_selector = 'h1, h2, h3, h4, h5, h6';
  $css = "$heading_selector {font-family: $style;}";
  drupal_add_css($css, $options);


 /**
  * Use lowercase for headings if selected; site name and slogan are not overridden
  */
  /*
  if (theme_get_setting('berkeley_lowercase_headings')) {
    $headings = 'h1, h2, h3, h4, h5, h6';
    $state = 'lowercase';
    $css = "$headings {text-transform: $state;}";
    drupal_add_css($css, $options);
  }
  */

  // Set up the search box functionality (adapted from OpenAcademy)
  $search_box_form = drupal_get_form('search_form');
  $search_box_form['basic']['keys']['#title'] = '';
  $search_box_form['basic']['keys']['#attributes'] = array('placeholder' => 'Search');
  $search_box_form['basic']['submit']['#value'] = t('Submit Search');
  $search_box = drupal_render($search_box_form);
  $variables['search_box'] = (user_access('search content')) ? $search_box : NULL;

  // Adjust navigation if extended menu items is checked
  if (theme_get_setting('extended_menu_items')) {
    //Build path to css
    $css_file = drupal_get_path('theme', 'berkeley') . '/css/extended_menu_items.css';
    drupal_add_css($css_file, array('group' => CSS_THEME));
  }

  // Adjust styling if long sitename is checked
  if (theme_get_setting('long_sitename')) {
    //Build path to css
    $css_file = drupal_get_path('theme', 'berkeley') . '/css/long_sitename.css';
    drupal_add_css($css_file, array('group' => CSS_THEME));
  }

  /**
   * Open Berkeley styling
   */

  //Add standard styling for News Archive view
  if (theme_get_setting('openberkeley_newsarchive')) {
    //Build path to css
    $css_file = drupal_get_path('theme', 'berkeley') . '/css/openberkeley/openberkeley_newsarchive.css';
    drupal_add_css($css_file, array('group' => CSS_THEME));
  }

  //Add standard styling for FAQ -- requires FAQ module: http://drupal.org/project/faq
  if (theme_get_setting('openberkeley_faq') && module_exists('faq')) {
    //Build path to css
    $css_file = drupal_get_path('theme', 'berkeley') . '/css/openberkeley/openberkeley_faq.css';
    drupal_add_css($css_file, array('group' => CSS_THEME));
  }

  /** End Open Berkeley styling **/

  // Add user's custom CSS for Nice Menus if specified.
  if ($custom_nice_menu = theme_get_setting('nice_menus_custom_css')) {
    drupal_add_css('$custom_nice_menu');
  }
  else {
    $nice_menus_path = drupal_get_path('theme', 'berkeley') . '/css/nice_menus_default.css';
    drupal_add_css($nice_menus_path, array('group' => CSS_THEME));
  }

}

/**
 * Override or insert variables into the node templates.
 */
/* -- Delete this line if you want to use this function
function berkeley_preprocess_node(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // berkeley_preprocess_node_page() or berkeley_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 */
/* -- Delete this line if you want to use this function
function berkeley_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the region templates.
 */
/* -- Delete this line if you want to use this function
function berkeley_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--sidebar.tpl.php template for sidebars.
  //if (strpos($variables['region'], 'sidebar_') === 0) {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('region__sidebar'));
  //}
}
// */

/**
 * Override or insert variables into the block templates.
 */
/* -- Delete this line if you want to use this function
function berkeley_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];

  // By default, Zen will use the block--no-wrapper.tpl.php for the main
  // content. This optional bit of code undoes that:
  //if ($variables['block_html_id'] == 'block-system-main') {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('block__no_wrapper'));
  //}
}
// */

