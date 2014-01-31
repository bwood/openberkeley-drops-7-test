api = 2
core = 7.x

; If using Open Berkeley on Pantheon, don't run this makefile
; Instead, core updates should be pulled from populist/panopoly-drops-7 or pantheon-systems/drops-7
projects[drupal][version] = 7.26

includes[] = drupal-org-core.make
; includes[] = drupal-org.make (If packaging for drupal.org, openberkeley.make would be renamed to drupal-org.make)
includes[] = openberkeley.make
