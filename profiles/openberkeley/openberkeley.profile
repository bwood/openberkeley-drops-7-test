<?php

    
/**
 * Implements hook_install_tasks()
 */
function openberkeley_install_tasks(&$install_state) {
  $tasks = array();
  return $tasks;
}

/**
 * Implements hook_install_tasks_alter()
 */
function openberkeley_install_tasks_alter(&$tasks, $install_state) {

}

/**
 * Implements hook_form_FORM_ID_alter()
 */
function openberkeley_form_install_configure_form_alter(&$form, $form_state) {

  // Hide some messages from various modules that are just too chatty.
  drupal_get_messages('status');
  drupal_get_messages('warning');

  // Set reasonable defaults for site configuration form
  $form['site_information']['site_name']['#default_value'] = 'Panopoly';
  $form['admin_account']['account']['name']['#default_value'] = 'ucbadmin';
  $form['server_settings']['site_default_country']['#default_value'] = 'US';
  $form['server_settings']['date_default_timezone']['#default_value'] = 'America/Los_Angeles'; // West coast, best coast

  // Define a default email address if we can guess a valid one
  if (valid_email_address('admin@' . $_SERVER['HTTP_HOST'])) {
    $form['site_information']['site_mail']['#default_value'] = 'admin@' . $_SERVER['HTTP_HOST'];
    $form['admin_account']['account']['mail']['#default_value'] = 'admin@' . $_SERVER['HTTP_HOST'];
  }
}
