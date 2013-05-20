api = 2
core = 7.x

; The Panopoly Foundation

projects[panopoly_core][version] = 1.0-rc4
projects[panopoly_core][subdir] = panopoly

projects[panopoly_images][version] = 1.0-rc4
projects[panopoly_images][subdir] = panopoly

projects[panopoly_theme][version] = 1.0-rc4
projects[panopoly_theme][subdir] = panopoly

projects[panopoly_magic][version] = 1.0-rc4
projects[panopoly_magic][subdir] = panopoly

projects[panopoly_widgets][version] = 1.0-rc4
projects[panopoly_widgets][subdir] = panopoly

projects[panopoly_admin][version] = 1.0-rc4
projects[panopoly_admin][subdir] = panopoly

projects[panopoly_users][version] = 1.0-rc4
projects[panopoly_users][subdir] = panopoly

; The Panopoly Toolset

projects[panopoly_pages][version] = 1.0-rc4
projects[panopoly_pages][subdir] = panopoly

projects[panopoly_wysiwyg][version] = 1.0-rc4
projects[panopoly_wysiwyg][subdir] = panopoly

projects[panopoly_search][version] = 1.0-rc4
projects[panopoly_search][subdir] = panopoly

; UCB Modules
projects[smtp][version] = 1.0
projects[smtp][subdir] = contrib

projects[nice_menus][version] = 2.3
projects[nice_menus][subdir] = contrib

projects[ucb_envconf][type] = module
projects[ucb_envconf][subdir] = ucb
projects[ucb_envconf][download][type] = git
projects[ucb_envconf][download][url] = git://github.com/ucbdrupal/ucb_envconf.git
projects[ucb_envconf][download][tag] = 7.x-1.1-beta2
projects[ucb_envconf][download][branch] = 7.x-1.x

projects[ucb_cas][type] = module
projects[ucb_cas][subdir] = ucb
projects[ucb_cas][download][type] = git
projects[ucb_cas][download][url] = git://github.com/ucbdrupal/ucb_cas.git
projects[ucb_cas][download][tag] = 7.x-1.3-beta2
projects[ucb_cas][download][branch] = 7.x-1.x
; TODO - Update CAS to prevent hook_requirements from firing during install

; UCB Theme
projects[berkeley][type] = theme
projects[berkeley][download][type] = git
projects[berkeley][download][url] = git://github.com/ucbdrupal/berkeley.git
projects[berkeley][download][tag] = 7.x-1.0-alpha7
projects[berkeley][download][branch] = 7.x-1.x
