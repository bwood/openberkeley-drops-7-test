BERKELEY THEME (A Zen 5 Sub-Theme)
----------------------

This is the Berkeley theme, developed by
IST Drupal <ist-drupal@lists.berkeley.edu> at UC Berkeley
for use with websites based on the Berkeley distribution.

*** REQUIRED DEPENDENCIES ***

The Berkeley theme requires Zen 7.x-5.x, available at http://drupal.org/project/zen.

If you want to use the drop-down menu functionality, you must download the Nice Menus
module, available at http://drupal.org/project/nice_menus. You can then enable this
functionality at appearance/settings/berkeley.

*** Important Theming Notes ***
*
* In Drupal 7, the theme system caches which template files and which theme
* functions should be called. This means that if you add a new theme,
* preprocess or process function to your template.php file or add a new template
* (.tpl.php) file to your sub-theme, you will need to rebuild the "theme
* registry." See http://drupal.org/node/173880#theme-registry
*
* Drupal 7 also stores a cache of the data in .info files. If you modify any
* lines in your sub-theme's .info file, you MUST refresh Drupal 7's cache by
* simply visiting the Appearance page at admin/appearance (or using Drush).
*

NOTES:

1. This Zen5-based theme uses Sass/Compass. If you want to edit the included Sass files
and recompile the existing css files, get the latest version of Sass (3.2 or later).
You do not need Sass to use this theme if you will not be changing the Sass files.

  For more information on using Sass/Compass, read sass/README.txt

2. Theme configuration settings can be set at admin/appearance/settings/berkeley.

3. Site information can be set at admin/config/system/site-information.

4. Sass files (.scss) are used to generate the associated css files.

  To edit the original .scss files:
  - Delete all CSS files by running: compass clean
  - Edit the config.rb file and change #environment = :development
  - Regenerate all the CSS files by running: compass watch (or compass compile)


5. Moving to Production

  When ready to move to production, do the following (see sass/README.txt):

  - Delete all CSS files by running: compass clean
  - Edit the config.rb file to change environment to Production and turn off Firesass:
    - #environment = :development
    - environment = :production
    - firesass = false
    - #firesass = true
  - Regenerate all the CSS files by running: compass compile
  - Turn on CSS and JS aggregation (admin/config/development/performance)

6. Adding custom styles

  If you want to add custom CSS styles but do not need to override any PHP files,
  do the following:

  a. If using Sass/Compass:

     1. In the berkeley.info file, uncomment stylesheets[all][] = css/styles.css
        (remove the semi-colon)
     2. Create a new styles.scss file in the sass directory (sass/styles.scss)
     3. Add the following to the top of the file: @import "base";
     4. Add your custom styles to the sass/styles.scss file
     5. When you run compass watch (or compass compile), it will generate styles.css
     6. See the README.txt file in the SASS folder to learn more about using Sass and Compass

  b. If you don't want to use Sass/Compass:

     1. In the berkeley.info file, uncomment stylesheets[all][] = css/local.css
        (remove the semi-colon)
     2. Create a new local.css file in the css directory (css/local.css)
     3. Add your custom styles to the css/local.css
     4. Note: Do not create a sass/local.scss file, or it will remove any styles
        in the local.css when you run compass watch or compass compile

7. Updating the Berkeley theme

  Updating the Berkeley theme is similar to the process for updating any Drupal theme. We recommend the following process:

  a. Backup your current version of the Berkeley theme and any subtheme files in case you made any changes to the version used by your website.

  b. Download the new release of the theme.

  c. Upload and overwrite your current theme files with the updated ones. IMPORTANT: If you have made any downstream updates, you will need to re-apply your changes after the theme upgrade. For example:

    1. berkeley.info: If you've added stylesheets (e.g., css/styles.css or css/local.css), you will need to re-add these to the berkeley.info file.

    2. styles.scss or local.css: If these files exist in your pre-updated Berkeley theme, you will want to add them back after updating the theme.

    3. config.rb: If you've launched your production website and edited the environment in your config.rb file to minify the css files, you will want to re-apply your changes to config.rb (or keep your version of this file if no other changes), run "compass clean" and then "compass watch" to regenerate the minified css files.

  d. Note on Sub-themes. If properly created, your sub-theme should not be under the Berkeley theme folder and should still work properly after updating the Berkeley theme.

  e. Make sure to try the theme update on a local or development site first. If using CSS or JS aggregation, you will need to clear all caches (admin/config/development/performance) to clear the theme registry. You may also need to re-save the theme settings (visit admin/appearance/settings/berkeley and click "Save Configuration").

  f. Before updating the theme on a live website, we recommend putting your site in offline (maintenance) mode and creating a backup of the files and database.


