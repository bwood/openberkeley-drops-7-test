<?php
/**
 * @file
 * openberkeley_core_override.features.features_overrides.inc
 */

/**
 * Implements hook_features_override_default_overrides().
 */
function openberkeley_core_override_features_override_default_overrides() {
  // This code is only used for UI in features. Exported alters hooks do the magic.
  $overrides = array();

  // Exported overrides for: views_view
  $overrides["views_view.panopoly_taxonomy.display|default|display_options|fields|field_featured_image|click_sort_column"]["DELETED"] = TRUE;
  $overrides["views_view.panopoly_taxonomy.display|default|display_options|fields|field_featured_image|settings"]["DELETED"] = TRUE;

 return $overrides;
}
