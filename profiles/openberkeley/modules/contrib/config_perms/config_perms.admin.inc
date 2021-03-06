<?php
// $Id$

/**
 * @file
 * Admin pages
 */

/**
 * Administration form
 */
function config_perms_admin_form($form, &$form_state, $type = '') {
  $form['perms'] = array(
    '#type' => 'fieldset',
    '#title' => t('Custom Permissions'),
    '#description' => '<p>' . t("Please note that the order in which permissions are granted are as follows:") . '</p>' .
      "<ul>" .
        "<li>" . t("User 1 still maintains full control") .
       // "<li>" . t("Any role with 'administer site configuration' will have access to all permissions listed above") .
        "<li>" . t("Nothing will be available under Site building if 'display site building menu' is not checked") .
        "<li>" . t("Nothing will be available under Site configuration if 'display site configuration menu' is not checked") .
        "<li>" . t("You can use * as wildcard for paths.") .
        //"<li>" . t("Any role without 'administer site configuration' will be granted access to whatever permissions checked in the config_perms section of the permissions page.") .
      "</ul>",
    //'<p>'. t("So in other words, if you want grant roles only a few of theses items, uncheck 'administer site configuration', check one or both of the display permissions, and check whatever you want them to have access to.") .'</p>',
    '#collapsible' => 1,
    '#collapsed' => 0,
  );

  // Get perms.
  $perms = config_perms_perms(NULL, TRUE);

  $form['perms']['local'] = array(
    '#theme' => 'config_perms_form',
    '#tree' => TRUE,
    '#prefix' => '<div id="config_perms-wrapper">',
    '#suffix' => '</div>',
  );
  
  foreach ($perms as $key => $perm) {
    $form['perms']['local'][$key] = array('#tree' => TRUE);
    $form['perms']['local'][$key]['pid'] = array(
      '#type' => 'hidden',
      '#default_value' => check_plain($perm->pid),
    );
    $form['perms']['local'][$key]['machine_name'] = array(
      '#type' => 'hidden',
      '#default_value' => check_plain($perm->machine_name),
    );
    $form['perms']['local'][$key]['status'] = array(
      '#type' => 'checkbox',
      '#default_value' => check_plain($perm->status),
    );
    $form['perms']['local'][$key]['remove'] = array(
      '#type' => 'checkbox',
      '#default_value' => 0,
    );
    $form['perms']['local'][$key]['name'] = array(
      '#type' => 'textfield',
      '#default_value' => check_plain($perm->name),
      '#size' => 30,
    );
    $form['perms']['local'][$key]['path'] = array(
      '#type' => 'textarea',
      '#default_value' => config_perms_parse_path($perm->path),
      '#size' => 50,
      '#rows' => 1,
    );
  }

  if (empty($form_state['num_new'])) {
    $form_state['num_new'] = 0;
  }

  for ($i = 0; $i < $form_state['num_new']; $i++) {
    $form['perms']['local'][$key + $i]['status'] = array(
      '#type' => 'checkbox',
      '#default_value' => check_plain($perm->status),
      //'#attributes' => $attributes,
    );
    $form['perms']['local'][$key + $i]['remove'] = array(
      '#type' => 'checkbox',
      '#default_value' => 0,
    );
    $form['perms']['local'][$key + $i]['name'] = array(
      '#type' => 'textfield',
      '#default_value' => '',
      '#size' => 30,
    );
    $form['perms']['local'][$key + $i]['path'] = array(
      '#type' => 'textarea',
      '#default_value' => '',
      '#rows' => 2,
      '#size' => 50,
    );
  }
  
  $form['perms']['add']['status'] = array(
    '#name' => 'status',
    '#id' => 'edit-local-status',
    '#type' => 'submit',
    '#value' => t('Add permission'),
    '#submit' => array('config_perms_admin_form_add_submit'),
    '#ajax' => array(
      'callback' => 'config_perms_admin_form_add_callback',
      'wrapper' => 'config_perms-wrapper',
    ),
  );
  
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save'),
  );

  return $form;
}


/**
 * Administration form theme function
 */
function theme_config_perms_form($variables) {
  $form = $variables['form'];
  $header = array(t('Enabled'), t('Delete'), t('Name'), t('Path(s)'));
  $rows = array();
  foreach (element_children($form) as $key) {
    $row = array();
    $row[] = drupal_render($form[$key]['status']);
    $row[] = drupal_render($form[$key]['remove']);
    $row[] = drupal_render($form[$key]['name']);
    $row[] = drupal_render($form[$key]['path']);
    $rows[] = array('data' => $row, 'id' => array($key));
  }
  $output = theme('table', array('header' => $header, 'rows' => $rows));
  $output .= drupal_render_children($form);
  return $output;
}

/**
 * Submit for add button
 */
function config_perms_admin_form_add_submit($form, &$form_state) {
  $form_state['num_new']++;
  $form_state['rebuild'] = TRUE;
}

/**
 * Callback for add button
 */
function config_perms_admin_form_add_callback($form, $form_state) {
  return $form['perms']['local'];
}

/**
 * Validate handler
 */
function config_perms_admin_form_validate($form, &$form_state) {
  $values = $form_state['values'];
  $perms = config_perms_perms();

  foreach ($values['local'] as $key => $perm) {
    $perm = (object)$perm;
    
    if(array_key_exists(config_perms_generate_machine_name($perm->name), $perms) && !isset($perm->pid)) {
      form_set_error("local][". $key ."", t("A permission with that name already exists."));
    }
  }
}

/**
 * Submit handler.
 */
function config_perms_admin_form_submit($form, &$form_state) {
  $values = $form_state['values'];

  foreach ($values['local'] as $key => $data) {
    if ($data['remove'] && !empty($data['pid'])) { // Delete
      config_perms_delete((object) $data);
    }
    elseif (!empty($data['name']) && !empty($data['path'])) { // Update || Insert
      $data['path'] = config_perms_parse_path($data['path']);
      config_perms_save((object) $data);
    }
  }

  // Rebuild menu and cache
  config_perms_cache_rebuild();
  menu_rebuild();
  
  drupal_set_message(t('The permissions have been saved.'));
}
