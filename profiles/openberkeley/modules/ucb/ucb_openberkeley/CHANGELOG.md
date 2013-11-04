ucb_openberkeley-7.x-1.0-dev
=======================
* OPENUCB-152: get admin role programmatically.
* OPENUCB-152: fix warning: variable passed to each() is not an array.
** https://jira.berkeley.edu/browse/OPENUCB-152?focusedCommentId=155176&page=com.atlassian.jira.plugin.system.issuetabpanels:comment-tabpanel#comment-155176

ucb_openberkeley-7.x-1.0-alpha4
=======================
* OPENUCB-152: Prevent a site builder from assigning the administrator role.
** if total_control is not present the form_alter will never fire, so no dependency is added on total_control.

ucb_openberkeley-7.x-1.0-alpha3
=======================
* update hook_wysiwyg_editor_settings_alter() to fix issues with panopoly_wysiwyg rc5 and allow overrides (OPENUCB-131)

ucb_openberkeley-7.x-1.0-alpha2
=======================
* update hook_wysiwyg_editor_settings_alter() to fix issue with panopoly_wysiwyg rc4


ucb_openberkeley-7.x-1.0-alpha1
=======================
* implement hook_wysiwyg_editor_settings_alter() to sort wysiwyg/tinymce buttons
* implement hook_module_implements_alter() to change order of hook execution
