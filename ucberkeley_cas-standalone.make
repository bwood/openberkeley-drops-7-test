api = 2
core = 7.x

; phpCAS library
libraries[phpcas][download][type] = "get"
libraries[phpcas][download][url] = "http://downloads.jasig.org/cas-clients/php/current/CAS-1.3.2.tgz"

; CAS
projects[cas][type] = module
projects[cas][version] = 1.3
projects[cas][patch][1394666] = "https://drupal.org/files/cas-library-detection-1394666-15.patch"
projects[cas][patch][2057881] = "https://drupal.org/files/cas-profile_install-2057881-1.patch"

; CAS Attributes
projects[cas_attributes][type] = module
projects[cas_attributes][version] = 1.0-beta2

; LDAP
projects[ldap][type] = module
projects[ldap][version] = 1.0-beta12

; UC Berkeley CAS Feature
; TODO: update dl options
; specify type=module to prevent "No release history was found for the requested project (ucberkeley_cas)."
projects[ucberkeley_cas][type] = "module"
projects[ucberkeley_cas][download][type] = "git"
projects[ucberkeley_cas][download][url] = "git@github.com:ucb-ist-drupal/ucberkeley_cas-7.git"
projects[ucberkeley_cas][download][branch] = "master"
projects[ucberkeley_cas][download][tag] = "7.x-2.1-beta3"
