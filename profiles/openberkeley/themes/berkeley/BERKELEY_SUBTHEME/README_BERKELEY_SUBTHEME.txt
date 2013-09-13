Creating your Berkeley Sub-Theme
========================================

Note: If you only want to add CSS styles, you do not need to create a sub-theme. See the main README instructions above for adding custom styles to the styles.scss (if using Sass) or local.css files in the Berkeley theme folder.

If you want to override php files or templates, you can create a Berkeley Sub-Theme as follows:

In the Berkeley folder, copy the BERKELEY_SUBTHEME folder to sites/all/themes and rename it with your desired sub-theme name. IMPORTANT: The name of your sub-theme must start with an alphabetic character and can only contain lowercase letters, numbers and underscores. For example:

Copy “sites/all/themes/berkeley/BERKELEY_SUBTHEME”
To  “sites/all/themes/foo”

Rename “BERKELEY_SUBTHEME.info.txt” as “foo.info” and update the name and description if you'd like.

In template.php and theme-settings.php: Replace ALL occurrences of "BERKELEY_SUBTHEME" with “foo”

Set the default theme at admin/appearance.

On the settings page for your sub-theme (admin/appearance/settings/YOUR_SUBTHEME_NAME), under "Accessibility and support settings," uncheck "Add Respond.js JavaScript to add basic CSS3 media query support to IE 6-8." Leaving this checked may cause issues with IE8 and under. The Berkeley theme does not try to add media query support for <IE8; instead, it uses a fixed width for older IE versions.


*** NOTES ***
*
* The Berkeley theme is a sub-theme of Zen, so if you create your own Berkeley sub-theme make sure to grab the BERKELEY-SUBTHEME folder as a starting point. You could also create your own Zen sub-theme if you want to start from scratch with a new custom theme. See the READMEs in the Zen folder for details.
*
* More on sub-theming from drupal.org: http://drupal.org/node/225125
*
* From Zen documentation:
* In Drupal 7, the theme system caches which template files and which theme
* functions should be called. This means that if you add a new theme,
* preprocess or process function to your template.php file or add a new template
* (.tpl.php) file to your sub-theme, you will need to rebuild the "theme
* registry." See http://drupal.org/node/173880#theme-registry
*
* Drupal 7 also stores a cache of the data in .info files. If you modify any
* lines in your sub-theme's .info file, you MUST refresh Drupal 7's cache by
* simply visiting the Appearance page at admin/appearance.
*
