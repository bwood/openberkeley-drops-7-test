api = 2
core = 7.x

;;;;;;;;;;;;;;;;;;;
;;; UCB Modules ;;;
;;;;;;;;;;;;;;;;;;;

projects[ucb_envconf][type] = module
projects[ucb_envconf][subdir] = ucb
projects[ucb_envconf][download][type] = git
projects[ucb_envconf][download][url] = git://github.com/ucbdrupal/ucb_envconf.git
projects[ucb_envconf][download][tag] = 7.x-1.1-beta2
projects[ucb_envconf][download][branch] = 7.x-1.x

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

;;;;;;;;;;;;;;;;;;;;;;;;;;;;
;;; UCB-Selected Contrib ;;;
;;;;;;;;;;;;;;;;;;;;;;;;;;;;

; alphabetical by module machine name

projects[backup_migrate][version] = 2.7
projects[backup_migrate][subdir] = contrib

projects[bundle_copy][version] = 1.1
projects[bundle_copy][subdir] = contrib

projects[config_perms][version] = 2.0
projects[config_perms][subdir] = contrib
projects[config_perms][patch][1217478] = https://drupal.org/files/issues/0001-Fixed-undefined-index-notice-issue-number-1217478.patch
projects[config_perms][patch][1441692] = https://drupal.org/files/non-property-fix_1441692.patch

projects[diff][version] = 3.2
projects[diff][subdir] = contrib

projects[email][version] = 1.2
projects[email][subdir] = contrib

projects[entity][version] = 1.2
projects[entity][subdir] = contrib

projects[entityreference][version] = 1.1
projects[entityreference][subdir] = contrib

projects[entity_view_mode][version] = 1.0-rc1
projects[entity_view_mode][subdir] = contrib

projects[extlink][version] = 1.13
projects[extlink][subdir] = contrib

projects[features][version] = 2.0
projects[features][subdir] = contrib

projects[features_override][version] = 2.0-rc1
projects[features_override][subdir] = contrib

projects[file_entity][version] = 2.0-alpha2
projects[file_entity][subdir] = contrib
projects[file_entity][patch][2073001] = https://drupal.org/files/2073001-11-file-displays-weight.patch

projects[faq][version] = 1.0-rc2
projects[faq][subdir] = contrib
projects[faq][patch][1828758] = https://drupal.org/files/1828758-1-category-descriptions-dont-respect-text-formats.patch
; 1572414: later patch available
projects[faq][patch][1572414] = https://drupal.org/files/faq-view_question-1572414-2.patch

projects[google_analytics][version] = 1.3
projects[google_analytics][subdir] = contrib

projects[linkchecker][version] = 1.1
projects[linkchecker][subdir] = contrib

projects[media][version] = 2.0-alpha2
projects[media][subdir] = contrib

projects[navigation404][version] = 1.0
projects[navigation404][subdir] = contrib

projects[nice_menus][version] = 2.5
projects[nice_menus][subdir] = contrib

projects[pathologic][version] = 2.11
projects[pathologic][subdir] = contrib

projects[redirect][version] = 1.0-rc1
projects[redirect][subdir] = contrib

projects[security_review][version] = 1.0
projects[security_review][subdir] = contrib

projects[smtp][version] = 1.0
projects[smtp][subdir] = contrib

projects[total_control][version] = 2.4
projects[total_control][subdir] = contrib

projects[zen][version] = 5.4
projects[zen][type] = theme



