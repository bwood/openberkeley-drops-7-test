ucb_envconf-7.x-1.x
===================

PURPOSE
-------

UCB Environment Configurations (ucb_envconf) is a small module that
defines configuration depending on the environment (dev/test/live) of
the site. When developing a Drupal site in a dev/test/live environment
the developer will often load her dev site with the live database.
(Consider the Pantheon dashboard funtion "Sync content and pull
code.")  Unless the developer manually updates certain settings, the
dev site will receive some settings that should be specific to
production.

ucb_envconf automatically forces certain settings to their correct
values based on the site's environment. It does this via hook_boot().
The module takes pains to do as little as possible in hook_boot so as
not to negatively affect site performance.

Basically: 

if ($site_env == 'live') {
  $conf['cas_server'] = 'auth.berkeley.edu';
} 
elseif ($site_env == 'dev') OR ($site_env == 'test') {
  $conf['cas_server'] = 'auth-test.berkeley.edu';
}

There are a number of different ways that this goal might be achieved:

1. Insert conditional logic into settings.php
2. Use a module like this one
3. Write a Rule triggered by cron

We chose #2 because

- We can limit user confusion by doing form_alters explaining about
  hard-coded variables which don't change when admin forms are
  submitted.

- Users can easily disable the module if they don't like the
  functionality. They don't have to go edit code in settings.php. They
  don't have to disable rules.

Notes
-----

drush @somealias vget cas_server

Because this module applies configuration on hook_boot() and because
hook_boot doesn't run when you issue 'drush vget', you will encounter
situations where 'drush vget' reports the wrong value.  If you visit
the corresponding admin page, you should see the right value.

Theorectically you could get the correct value with 

drush @somealias php-eval "echo variable_get('cas_server', NULL);"
