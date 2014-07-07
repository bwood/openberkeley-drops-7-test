<?php
/**
 * @file
 * openberkeley_core_override.features.inc
 */

/**
 * Implements hook_views_default_views_alter().
 */
function openberkeley_core_override_views_default_views_alter(&$data) {
  if (isset($data['panopoly_taxonomy'])) {
    unset($data['panopoly_taxonomy']->display['default']->display_options['fields']['field_featured_image']['click_sort_column']);
    unset($data['panopoly_taxonomy']->display['default']->display_options['fields']['field_featured_image']['settings']);
  }
}
