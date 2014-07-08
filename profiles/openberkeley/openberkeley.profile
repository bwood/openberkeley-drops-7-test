<?php
/**
 * Implements hook_install_tasks()
 */
function openberkeley_install_tasks(&$install_state) {
  $tasks = array();

  // Add our custom CSS file for the installation process
  // drupal_add_css(drupal_get_path('profile', 'panopoly') . '/panopoly.css');
  // Should we want to style the installer, we'd alter the above

  //$tasks = $tasks + array("openberkeley_add_admin_form" => array("display_name" => "Setup UC Berkeley Administrator", "type" => "form"));
  require_once(drupal_get_path('module', 'cas') . '/cas.user.inc');
  $tasks = $tasks + array("cas_add_user_form" => array("display_name" => "Setup UC Berkeley Administrator", "type" => "form"));

  // Add the Panopoly theme selection to the installation process
  require_once(drupal_get_path('module', 'panopoly_theme') . '/panopoly_theme.profile.inc');
  $tasks = $tasks + panopoly_theme_profile_theme_selection_install_task($install_state);

  return $tasks;
}

/**
 * Implements hook_install_tasks_alter()
 */
function openberkeley_install_tasks_alter(&$tasks, $install_state) {
  // Magically go one level deeper in solving years of dependency problems
  require_once(drupal_get_path('module', 'panopoly_core') . '/panopoly_core.profile.inc');
  $tasks['install_load_profile']['function'] = 'panopoly_core_install_load_profile';

  // If we only offer one language, define a callback to set this
  require_once(drupal_get_path('module', 'panopoly_core') . '/panopoly_core.profile.inc'); //Fixme: Needed a 2nd time? -bw
  if (!(count(install_find_locales($install_state['parameters']['profile'])) > 1)) {
    $tasks['install_select_locale']['function'] = 'panopoly_core_install_locale_selection';
  }

  $tasks['install_finished']['function'] = 'openberkeley_finished';
}

/**
 * Implements hook_form_FORM_ID_alter()
 */
function openberkeley_form_install_configure_form_alter(&$form, $form_state) {

  // Hide some messages from various modules that are just too chatty.
  drupal_get_messages('status');
  drupal_get_messages('warning');

  // Set reasonable defaults for site configuration form
  $form['admin_account']['account']['name']['#default_value'] = 'ucbadmin';
  $form['admin_account']['account']['name']['#description'] = "<strong><font color=\"red\">For security reasons, do not use a name like 'admin' or 'root' here.</font></strong> (UC Berkeley IST suggests using 'ucbadmin'). " . $form['admin_account']['account']['name']['#description'];
  $form['server_settings']['site_default_country']['#default_value'] = 'US';
  $form['server_settings']['date_default_timezone']['#default_value'] = 'America/Los_Angeles'; // West coast, best coast

  // Add the Pathologic paths stuff from openberkeley_wysiwyg_override.
  openberkeley_wysiwyg_override_form_system_site_information_settings_alter($form, $form_state);
}

/*
function openberkeley_add_admin_form() {
  require_once(drupal_get_path('module', 'cas') . '/cas.user.inc');
  return drupal_get_form('cas_add_user_form');
}
*/

/**
 * Implements hook_form_FORM_ID_alter()
 */
function openberkeley_form_cas_add_user_form_alter(&$form, $form_state) {
  $form['account']['cas_name']['#required'] = FALSE;
  $form['account']['cas_name_txt']['#weight'] = -15;
  $form['account']['cas_name_txt']['#markup'] = "In this step we will setup the administrator account that you will use.  If you don't know your CAS User ID, follow these instructions: <p><em>" . $form['account']['cas_name_txt']['#markup'] . "</em></p>";
  $form['account']['cas_name']['#title'] = "Your CAS User ID";
  $form['actions']['submit']['#value'] = "Create CalNet Administrator";
  $form['actions']['skip'] = array(
    '#type' => "submit",
    '#value' => t('Skip this step'),
  );
  // Position the two buttons inline
  $form['#attached']['css']['#edit-skip.form-submit { display:inline; }'] = array( 'type' => 'inline');
  $form['#attached']['css']['#edit-submit.form-submit { display:inline; }'] = array( 'type' => 'inline');

  // Replace the cas validate/submit handlers with ours
  $form['#validate'] = array('openberkeley_add_admin_form_validate');
  $form['#submit'] = array('openberkeley_add_admin_form_submit');
}

/**
 * Implementation of hook_cas_user_presave()
 * Assign the administrator role to the new CAS user.
 */
function openberkeley_cas_user_presave(&$edit, $account) {
  $role = user_role_load_by_name("administrator");
  //user_multiple_role_edit(array($account->uid), 'add_role', $role->rid);
  $account->roles = array($role->rid => $role->name);
  variable_set('openberkeley_cas_admin', TRUE);
}

/**
 * Validate handler for cas_user_add_form
 * @param $form
 * @param $form_state
 */
function openberkeley_add_admin_form_validate($form, &$form_state) {
  if ($form_state['values']['op'] != 'Skip this step') {
    if (preg_match('/[^\d,]+/', $form_state['values']['cas_name']) != 0) {
      form_set_error('cas_name', "CAS User ID should be a numeric value.");
    }
    $uids = explode(',', $form_state['values']['cas_name']);
    foreach ($uids as $uid) {
      if (empty($uid)) {
        continue;
      }
      _cas_name_element_validate($uid, $form_state);
    }

  }
}

/**
 * Submit handler for cas_user_add_form
 * @param $form
 * @param $form_state
 */
function openberkeley_add_admin_form_submit($form, &$form_state) {
  if ($form_state['values']['op'] != 'Skip this step') {
    // If 111,222,333 submitted, three cas admins will be created.
    $fs = $form_state;
    $uids = explode(',', $form_state['values']['cas_name']);
    foreach ($uids as $uid) {
      if (empty($uid)) {
        continue;
      }
      $fs['values']['cas_name'] = trim($uid);
      cas_add_user_form_submit($form, $fs);
    }

  }
}

/**
 * Implements hook_form_FORM_ID_alter()
 */
function openberkeley_form_panopoly_theme_selection_form_alter(&$form, $form_state) {

  // Create a list of theme options, minus the admin and testing themes
  $themes = array();
  foreach (system_rebuild_theme_data() as $theme) {
    if (!in_array($theme->name, array('test_theme', 'update_test_basetheme', 'update_test_subtheme', 'block_test_theme', 'stark', 'seven'))) {
      if ($theme->name == 'berkeley') {
        $berkeley = theme('image', array('path' => $theme->info['screenshot'])) . '<strong>' . $theme->info['name'] . '</strong><br><p><em>' . $theme->info['description'] . '</em></p><p class="clearfix"></p>';
      }
      else {
        $themes[$theme->name] = theme('image', array('path' => $theme->info['screenshot'])) . '<strong>' . $theme->info['name'] . '</strong><br><p><em>' . $theme->info['description'] . '</em></p><p class="clearfix"></p>';
      }
    }
  }

  // Berkeley theme comes first!
  openberkeley_array_unshift_assoc($themes, 'berkeley', $berkeley);

  $form['theme_wrapper']['theme'] = array(
    '#type' => 'radios',
    '#options' => $themes,
    '#default_value' => 'berkeley',
  );

}

function openberkeley_array_unshift_assoc(&$arr, $key, $val) {
  $arr = array_reverse($arr, TRUE);
  $arr[$key] = $val;
  $arr = array_reverse($arr, TRUE);
  return $arr;
}


function openberkeley_finished($install_state) {
  global $user;

  install_finished($install_state);

  drupal_set_title("Open Berkeley Installation is Complete!");

  // grant the Administrator role all permissions.
  $role = user_role_load_by_name("administrator");
  $permissions = array_keys(module_invoke_all('permission'));
  user_role_grant_permissions($role->rid, $permissions);

  // If appropriate link user to /cas to login as their cas-authed admin user
  if (variable_get('openberkeley_cas_admin', FALSE)) {
    if (user_is_logged_in()) {
      //logout of user1
      watchdog('user', 'Open Berkeley installation complete. Session closed for %name.', array('%name' => $user->name));
      // user_logout(); //does drupal_goto() which we don't want.
      module_invoke_all('user_logout', $user);
      // if using drush site-install, session_destroy() will complain about no
      // session, so skip it
      if (!defined('DRUSH_VERSION')) {
        // Destroy the current session, and reset $user to the anonymous user.
        session_destroy();
      }
    }
    $out = "<p>Congratulations.  You've installed Open Berkeley!</p><p>" . l("Please login as your CalNet-enabled administrator", "cas") . ".</p>";
    variable_del('openberkeley_cas_admin');
  }
  else {
    $out = "<p>Congratulations.  You've installed Open Berkeley!</p><p>" . l("Visit your site.", "<front>") . "</p>";
  }
  return $out;
}
