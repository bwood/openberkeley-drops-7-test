api = 2
core = 7.x

;;;;;;;;;;;;;;;;;;;;;;;;;;
;;; UCB Custom Modules ;;;
;;;;;;;;;;;;;;;;;;;;;;;;;;

projects[ucb_envconf][type] = module
projects[ucb_envconf][subdir] = ucb
projects[ucb_envconf][download][type] = git
projects[ucb_envconf][download][url] = git://github.com/ucbdrupal/ucb_envconf.git
projects[ucb_envconf][download][tag] = 7.x-1.1-beta2
projects[ucb_envconf][download][branch] = 7.x-1.x

; NOTE: enabling ucb_cas breaks install, but if you let ucb_envconf enable it (dependency), it works
; projects[ucb_cas][type] = module
; projects[ucb_cas][subdir] = ucb
; projects[ucb_cas][download][type] = git
; projects[ucb_cas][download][url] = git://github.com/ucbdrupal/ucb_cas.git
; projects[ucb_cas][download][tag] = 7.x-1.3-beta2
; projects[ucb_cas][download][branch] = 7.x-1.x
;; TODO - Update CAS to prevent hook_requirements from firing during install

projects[ucb_openberkeley][type] = module
projects[ucb_openberkeley][subdir] = ucb
projects[ucb_openberkeley][download][type] = git
projects[ucb_openberkeley][download][url] = git://github.com/ucbdrupal/ucb_openberkeley.git
; head ;projects[ucb_openberkeley][download][tag] =
; master ;projects[ucb_openberkeley][download][branch] = 7.x-1.x


;;;;;;;;;;;;;;;;;
;;; UCB Theme ;;;
;;;;;;;;;;;;;;;;;

projects[berkeley][type] = theme
projects[berkeley][download][type] = git
projects[berkeley][download][url] = git://github.com/ucbdrupal/berkeley.git
projects[berkeley][download][branch] = 7.x-1.x
;projects[berkeley][download][tag] = 7.x-1.0-alpha8
projects[berkeley][download][revision] = cf624c2

;;;;;;;;;;;;;;;;;;;;;;;;;;;
;;; UCB Contrib Modules ;;;
;;;;;;;;;;;;;;;;;;;;;;;;;;;

; ******************************
; ***** OB not in Panopoly *****

; Backup and Migrate - Used for local backups
projects[backup_migrate][version] = 2.7
projects[backup_migrate][subdir] = contrib

; Bundle Copy - Used for exporting content types in D7
projects[bundle_copy][version] = 1.1
projects[bundle_copy][subdir] = contrib

; Config Perms - Used for custom permissions added to Total Control dashboard
projects[config_perms][version] = 2.0
projects[config_perms][subdir] = contrib
projects[config_perms][patch][1217478] = https://drupal.org/files/issues/0001-Fixed-undefined-index-notice-issue-number-1217478.patch
projects[config_perms][patch][1441692] = https://drupal.org/files/non-property-fix_1441692.patch

; Diff - Used to display diffs in revisions
projects[diff][version] = 3.2
projects[diff][subdir] = contrib

; Email - Provides field type for email addresses
projects[email][version] = 1.2
projects[email][subdir] = contrib

; Entity View Mode - Used for View Modes (image styles)
projects[entity_view_mode][version] = 1.0-rc1
projects[entity_view_mode][subdir] = contrib

; External Link - extlink and mailto icons and behavior
projects[extlink][version] = 1.13
projects[extlink][subdir] = contrib

; FAQ Module 
projects[faq][version] = 1.0-rc2
projects[faq][subdir] = contrib
projects[faq][patch][1828758] = https://drupal.org/files/1828758-1-category-descriptions-dont-respect-text-formats.patch
; 1572414: later patch available
projects[faq][patch][1572414] = https://drupal.org/files/faq-view_question-1572414-2.patch

; Google Analytics
projects[google_analytics][version] = 1.4
projects[google_analytics][subdir] = contrib

; Link Checker
projects[linkchecker][version] = 1.1
projects[linkchecker][subdir] = contrib

; Navigation 404
projects[navigation404][version] = 1.0
projects[navigation404][subdir] = contrib

; Nice Menus - used with Berkeley Theme
projects[nice_menus][version] = 2.5
projects[nice_menus][subdir] = contrib

; Pathologic - Used for dev/test/live/localhost paths
projects[pathologic][version] = 2.11
projects[pathologic][subdir] = contrib

; Redirect - Combined path redirect and global redirect for D7
projects[redirect][version] = 1.0-rc1
projects[redirect][subdir] = contrib

; Security Review - Part of go-live process
projects[security_review][version] = 1.0
projects[security_review][subdir] = contrib

; SMTP
projects[smtp][version] = 1.0
projects[smtp][subdir] = contrib

; Total Control - Used for Site Builder dashboard
projects[total_control][version] = 2.4
projects[total_control][subdir] = contrib

; Zen - Base theme for Berkeley Theme
projects[zen][version] = 5.4
projects[zen][type] = theme

; ***** End OB not in Panopoly *****
; **********************************


; *******************************************
; ***** Updates Different from Panopoly *****

; OPENUCB-227 - Security update for Entity API
projects[entity][version] = 1.2
projects[entity][subdir] = contrib

; OPENUCB-214 - Security update for Entity Reference	
projects[entityreference][version] = 1.1
projects[entityreference][subdir] = contrib

; OPENUCB-217 - Update Features and add Features Override
projects[features][version] = 2.0
projects[features][subdir] = contrib

; OPENUCB-217 - Update Features and add Features Override
projects[features_override][version] = 2.0-rc1
projects[features_override][subdir] = contrib

; OPENUCB-225 - Media module Wysiwyg integration (File Entity should be updated with Media)
projects[file_entity][version] = 2.0-alpha3
projects[file_entity][subdir] = contrib

; OPENUCB-225 - Media module Wysiwyg integration (media-7.x-2.0-alpha3+26-dev on 12/3/13)
projects[media][version] = 2.x-dev
projects[media][subdir] = contrib
projects[media][type] = module
projects[media][download][type] = git
projects[media][download][revision] = 8fe0f7d
projects[media][download][branch] = 7.x-2.x
projects[media][patch][2126755] = https://drupal.org/files/issues/media-improved-macro-handling-2126755-19.patch

; ***** End Updates Different from Panopoly *****
; ***********************************************


; ****************************
; *****Panopoly Features *****

; Use Drush 6 to run make file. See https://github.com/drush-ops/drush/issues/15

; Previously, makefiles were parsed bottom-up, and that in Drush concurrency might
; interfere with recursion.
; Therefore PANOPOLY needs to be listed AT THE BOTTOM of this makefile,
; so we can patch or update certain projects fetched by Panopoly's makefiles.

; The Panopoly Foundation

projects[panopoly_core][version] = 1.0-rc5
projects[panopoly_core][subdir] = panopoly

projects[panopoly_images][version] = 1.0-rc5
projects[panopoly_images][subdir] = panopoly

projects[panopoly_theme][version] = 1.0-rc5
projects[panopoly_theme][subdir] = panopoly

projects[panopoly_magic][version] = 1.0-rc5
projects[panopoly_magic][subdir] = panopoly

projects[panopoly_widgets][version] = 1.0-rc5
projects[panopoly_widgets][subdir] = panopoly

projects[panopoly_admin][version] = 1.0-rc5
projects[panopoly_admin][subdir] = panopoly

projects[panopoly_users][version] = 1.0-rc5
projects[panopoly_users][subdir] = panopoly

; The Panopoly Toolset

projects[panopoly_pages][version] = 1.0-rc5
projects[panopoly_pages][subdir] = panopoly

projects[panopoly_wysiwyg][version] = 1.0-rc5
projects[panopoly_wysiwyg][subdir] = panopoly

projects[panopoly_search][version] = 1.0-rc5
projects[panopoly_search][subdir] = panopoly

