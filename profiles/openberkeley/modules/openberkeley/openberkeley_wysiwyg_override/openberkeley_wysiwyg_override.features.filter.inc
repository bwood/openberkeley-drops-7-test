<?php
/**
 * @file
 * openberkeley_wysiwyg_override.features.filter.inc
 */

/**
 * Implements hook_filter_default_formats().
 */
function openberkeley_wysiwyg_override_filter_default_formats() {
  $formats = array();

  // Exported format: Editor.
  $formats['editor'] = array(
    'format' => 'editor',
    'name' => 'Editor',
    'cache' => 1,
    'status' => 1,
    'weight' => -10,
    'filters' => array(
      'media_filter' => array(
        'weight' => -50,
        'status' => 1,
        'settings' => array(),
      ),
      'wysiwyg' => array(
        'weight' => -48,
        'status' => 1,
        'settings' => array(
          'valid_elements' => 'a[name|href|target<_blank|title|style|class],
        div[class|style|align<center?justify?left?right],
        br,em,i,strong,cite,code,blockquote,ul,ol,li,dl,dt,dd,
        table,tbody,tr,th[rowspan|colspan|scope|width|style],td[rowspan|colspan|scope|width|style],sup,
        span[class|style],p[style],
        h1,h2,h3,h4,h5,h6,
        img[!src|title|alt|style|width|height|class],
        @[class|style],
        hr',
          'allow_comments' => 0,
          'nofollow_policy' => 'disabled',
          'nofollow_domains' => array(),
          'style_color' => array(
            'color' => 'color',
            'background' => 0,
            'background-color' => 0,
            'background-image' => 0,
            'background-repeat' => 0,
            'background-attachment' => 0,
            'background-position' => 0,
          ),
          'style_font' => array(
            'font' => 0,
            'font-family' => 0,
            'font-size' => 0,
            'font-size-adjust' => 0,
            'font-stretch' => 0,
            'font-style' => 0,
            'font-variant' => 0,
            'font-weight' => 0,
          ),
          'style_text' => array(
            'text-align' => 'text-align',
            'text-decoration' => 'text-decoration',
            'text-indent' => 0,
            'text-transform' => 0,
            'letter-spacing' => 0,
            'word-spacing' => 0,
            'white-space' => 0,
            'direction' => 0,
            'unicode-bidi' => 0,
          ),
          'style_box' => array(
            'margin-right' => 'margin-right',
            'margin-left' => 'margin-left',
            'padding-right' => 'padding-right',
            'padding-left' => 'padding-left',
            'margin' => 0,
            'margin-top' => 0,
            'margin-bottom' => 0,
            'padding' => 0,
            'padding-top' => 0,
            'padding-bottom' => 0,
          ),
          'style_border-1' => array(
            'border' => 0,
            'border-top' => 0,
            'border-right' => 0,
            'border-bottom' => 0,
            'border-left' => 0,
            'border-width' => 0,
            'border-top-width' => 0,
            'border-right-width' => 0,
            'border-bottom-width' => 0,
            'border-left-width' => 0,
          ),
          'style_border-2' => array(
            'border-color' => 0,
            'border-top-color' => 0,
            'border-right-color' => 0,
            'border-bottom-color' => 0,
            'border-left-color' => 0,
            'border-style' => 0,
            'border-top-style' => 0,
            'border-right-style' => 0,
            'border-bottom-style' => 0,
            'border-left-style' => 0,
          ),
          'style_dimension' => array(
            'width' => 'width',
            'height' => 0,
            'line-height' => 0,
            'max-height' => 0,
            'max-width' => 0,
            'min-height' => 0,
            'min-width' => 0,
          ),
          'style_positioning' => array(
            'bottom' => 0,
            'clip' => 0,
            'left' => 0,
            'overflow' => 0,
            'right' => 0,
            'top' => 0,
            'vertical-align' => 0,
            'z-index' => 0,
          ),
          'style_layout' => array(
            'display' => 'display',
            'float' => 'float',
            'clear' => 0,
            'position' => 0,
            'visibility' => 0,
          ),
          'style_list' => array(
            'list-style' => 0,
            'list-style-image' => 0,
            'list-style-position' => 0,
            'list-style-type' => 0,
          ),
          'style_table' => array(
            'border-collapse' => 0,
            'border-spacing' => 0,
            'caption-side' => 0,
            'empty-cells' => 0,
            'table-layout' => 0,
          ),
          'style_user' => array(
            'cursor' => 0,
            'outline' => 0,
            'outline-width' => 0,
            'outline-style' => 0,
            'outline-color' => 0,
            'zoom' => 0,
          ),
          'rule_valid_classes' => array(
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
          ),
          'rule_valid_ids' => array(),
          'rule_style_urls' => array(),
        ),
      ),
      'filter_htmlcorrector' => array(
        'weight' => -47,
        'status' => 1,
        'settings' => array(),
      ),
      'filter_autop' => array(
        'weight' => -45,
        'status' => 1,
        'settings' => array(),
      ),
      'filter_url' => array(
        'weight' => -44,
        'status' => 1,
        'settings' => array(
          'filter_url_length' => 72,
        ),
      ),
      'pathologic' => array(
        'weight' => -39,
        'status' => 1,
        'settings' => array(
          'local_paths' => 'http://dev-EXAMPLE.pantheon.berkeley.edu/
http://test-EXAMPLE.pantheon.berkeley.edu/
http://live-EXAMPLE.pantheon.berkeley.edu/
http://EXAMPLE.localhost/
http://EXAMPLE.berkeley.edu/',
          'protocol_style' => 'full',
        ),
      ),
    ),
  );

  return $formats;
}
