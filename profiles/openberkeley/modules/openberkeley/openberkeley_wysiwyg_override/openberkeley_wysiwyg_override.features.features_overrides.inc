<?php
/**
 * @file
 * openberkeley_wysiwyg_override.features.features_overrides.inc
 */

/**
 * Implements hook_features_override_default_overrides().
 */
function openberkeley_wysiwyg_override_features_override_default_overrides() {
  // This code is only used for UI in features. Exported alters hooks do the magic.
  $overrides = array();

  // Exported overrides for: filter
  $overrides["filter.panopoly_html_text.filters|caption_filter"]["DELETED"] = TRUE;
  $overrides["filter.panopoly_html_text.filters|filter_autop|weight"] = -44;
  $overrides["filter.panopoly_html_text.filters|filter_html"] = array(
    'settings' => array(
      'allowed_html' => '<a> <em> <strong> <cite> <code> <ul> <ol> <li> <dl> <dt> <dd> <img> <p> <br> <table> <tbody> <tr> <th> <td> <sup> <blockquote> <h1> <h2> <h3> <h4> <h5> <span> <div> <input> <iframe>',
      'filter_html_help' => 1,
      'filter_html_nofollow' => 0,
    ),
    'status' => 1,
    'weight' => -47,
  );
  $overrides["filter.panopoly_html_text.filters|filter_url|weight"] = -45;
  $overrides["filter.panopoly_html_text.filters|image_resize_filter"]["DELETED"] = TRUE;
  $overrides["filter.panopoly_html_text.filters|media_filter|weight"] = -43;
  $overrides["filter.panopoly_html_text.filters|pathologic"] = array(
    'settings' => array(
      'local_paths' => 'http://dev-EXAMPLE.pantheon.berkeley.edu/
              http://test-EXAMPLE.pantheon.berkeley.edu/
              http://live-EXAMPLE.pantheon.berkeley.edu/
              http://EXAMPLE.localhost/
              http://EXAMPLE.berkeley.edu/',
      'protocol_style' => 'full',
    ),
    'status' => 1,
    'weight' => -40,
  );
  $overrides["filter.panopoly_html_text.filters|wysiwyg"]["DELETED"] = TRUE;
  $overrides["filter.panopoly_wysiwyg_text.filters|caption_filter"] = array(
    'settings' => array(),
    'status' => 1,
    'weight' => -48,
  );
  $overrides["filter.panopoly_wysiwyg_text.filters|filter_autop"] = array(
    'settings' => array(),
    'status' => 1,
    'weight' => -45,
  );
  $overrides["filter.panopoly_wysiwyg_text.filters|filter_url"] = array(
    'status' => 1,
    'weight' => -44,
  );
  $overrides["filter.panopoly_wysiwyg_text.filters|image_resize_filter"] = array(
    'settings' => array(
      'image_locations' => array(
        'local' => 'local',
        'remote' => 'remote',
      ),
      'link' => 0,
      'link_class' => '',
      'link_rel' => '',
    ),
    'status' => 1,
    'weight' => -50,
  );
  $overrides["filter.panopoly_wysiwyg_text.filters|media_filter"] = array(
    'settings' => array(),
    'status' => 1,
    'weight' => -49,
  );
  $overrides["filter.panopoly_wysiwyg_text.filters|wysiwyg|settings|rule_valid_classes"] = array(
    0 => 'wysiwyg-break',
    2 => 'image-right',
    4 => 'image-center',
    6 => 'image-left',
    8 => 'jquery-colexp',
    10 => 'jquery-collapse',
    12 => 'jquery-expand',
    14 => 'jquery-intro',
    16 => 'jquery-group',
    18 => 'jquery-subgroup',
    20 => 'jquery-title',
    22 => 'jquery-body',
    24 => 'img-no-border',
  );
  $overrides["filter.panopoly_wysiwyg_text.filters|wysiwyg|settings|style_border-1"] = array(
    'border' => 0,
    'border-bottom' => 0,
    'border-bottom-width' => 0,
    'border-left' => 0,
    'border-left-width' => 0,
    'border-right' => 0,
    'border-right-width' => 0,
    'border-top' => 0,
    'border-top-width' => 0,
    'border-width' => 0,
  );
  $overrides["filter.panopoly_wysiwyg_text.filters|wysiwyg|settings|style_border-2"] = array(
    'border-bottom-color' => 0,
    'border-bottom-style' => 0,
    'border-color' => 0,
    'border-left-color' => 0,
    'border-left-style' => 0,
    'border-right-color' => 0,
    'border-right-style' => 0,
    'border-style' => 0,
    'border-top-color' => 0,
    'border-top-style' => 0,
  );
  $overrides["filter.panopoly_wysiwyg_text.filters|wysiwyg|settings|style_box"] = array(
    'margin' => 0,
    'margin-bottom' => 0,
    'margin-left' => 'margin-left',
    'margin-right' => 'margin-right',
    'margin-top' => 0,
    'padding' => 0,
    'padding-bottom' => 0,
    'padding-left' => 'padding-left',
    'padding-right' => 'padding-right',
    'padding-top' => 0,
  );
  $overrides["filter.panopoly_wysiwyg_text.filters|wysiwyg|settings|style_color"] = array(
    'background' => 0,
    'background-attachment' => 0,
    'background-color' => 0,
    'background-image' => 0,
    'background-position' => 0,
    'background-repeat' => 0,
    'color' => 'color',
  );
  $overrides["filter.panopoly_wysiwyg_text.filters|wysiwyg|settings|style_dimension"] = array(
    'height' => 0,
    'line-height' => 0,
    'max-height' => 0,
    'max-width' => 0,
    'min-height' => 0,
    'min-width' => 0,
    'width' => 'width',
  );
  $overrides["filter.panopoly_wysiwyg_text.filters|wysiwyg|settings|style_font"] = array(
    'font' => 0,
    'font-family' => 0,
    'font-size' => 0,
    'font-size-adjust' => 0,
    'font-stretch' => 0,
    'font-style' => 0,
    'font-variant' => 0,
    'font-weight' => 0,
  );
  $overrides["filter.panopoly_wysiwyg_text.filters|wysiwyg|settings|style_layout"] = array(
    'clear' => 0,
    'display' => 'display',
    'float' => 'float',
    'position' => 0,
    'visibility' => 0,
  );
  $overrides["filter.panopoly_wysiwyg_text.filters|wysiwyg|settings|style_list"] = array(
    'list-style' => 0,
    'list-style-image' => 0,
    'list-style-position' => 0,
    'list-style-type' => 0,
  );
  $overrides["filter.panopoly_wysiwyg_text.filters|wysiwyg|settings|style_positioning"] = array(
    'bottom' => 0,
    'clip' => 0,
    'left' => 0,
    'overflow' => 0,
    'right' => 0,
    'top' => 0,
    'vertical-align' => 0,
    'z-index' => 0,
  );
  $overrides["filter.panopoly_wysiwyg_text.filters|wysiwyg|settings|style_table"] = array(
    'border-collapse' => 0,
    'border-spacing' => 0,
    'caption-side' => 0,
    'empty-cells' => 0,
    'table-layout' => 0,
  );
  $overrides["filter.panopoly_wysiwyg_text.filters|wysiwyg|settings|style_text"] = array(
    'direction' => 0,
    'letter-spacing' => 0,
    'text-align' => 'text-align',
    'text-decoration' => 'text-decoration',
    'text-indent' => 0,
    'text-transform' => 0,
    'unicode-bidi' => 0,
    'white-space' => 0,
    'word-spacing' => 0,
  );
  $overrides["filter.panopoly_wysiwyg_text.filters|wysiwyg|settings|style_user"] = array(
    'cursor' => 0,
    'outline' => 0,
    'outline-color' => 0,
    'outline-style' => 0,
    'outline-width' => 0,
    'zoom' => 0,
  );
  $overrides["filter.panopoly_wysiwyg_text.filters|wysiwyg|settings|valid_elements"] = 'a[name|href|target<_blank|title|style|class],
              div[class|style|align<center?justify?left?right],
              br,em,i,strong,cite,code,blockquote,ul,ol,li,dl,dt,dd,
              table,tbody,tr,th[rowspan|colspan|scope|width|style],td[rowspan|colspan|scope|width|style],sup,
              span[class|style],p[style],
              h1,h2,h3,h4,h5,h6,
              img[!src|title|alt|style|width|height|class],
              @[class|style],
              hr';
  $overrides["filter.panopoly_wysiwyg_text.filters|wysiwyg|weight"] = -48;

  // Exported overrides for: wysiwyg
  $overrides["wysiwyg.panopoly_html_text.settings|apply_source_formatting"] = 1;
  $overrides["wysiwyg.panopoly_html_text.settings|block_formats"] = 'h2,h3,h4,h5,h6';
  $overrides["wysiwyg.panopoly_html_text.settings|buttons|default|link"]["DELETED"] = TRUE;
  $overrides["wysiwyg.panopoly_html_text.settings|buttons|linkit"] = array(
    'linkit' => 1,
  );
  $overrides["wysiwyg.panopoly_wysiwyg_text.settings|apply_source_formatting"] = 1;
  $overrides["wysiwyg.panopoly_wysiwyg_text.settings|block_formats"] = 'h2,h3,h4,h5,h6';
  $overrides["wysiwyg.panopoly_wysiwyg_text.settings|buttons|captionfilter"]["DELETED"] = TRUE;
  $overrides["wysiwyg.panopoly_wysiwyg_text.settings|buttons|default|anchor"] = 1;
  $overrides["wysiwyg.panopoly_wysiwyg_text.settings|buttons|default|code"] = 1;
  $overrides["wysiwyg.panopoly_wysiwyg_text.settings|buttons|default|sup"] = 1;
  $overrides["wysiwyg.panopoly_wysiwyg_text.settings|buttons|default|underline"]["DELETED"] = TRUE;
  $overrides["wysiwyg.panopoly_wysiwyg_text.settings|buttons|linkit"]["DELETED"] = TRUE;
  $overrides["wysiwyg.panopoly_wysiwyg_text.settings|buttons|table"] = array(
    'tablecontrols' => 1,
  );

 return $overrides;
}
