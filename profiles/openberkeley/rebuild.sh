#!/bin/sh
# Script to rebuild the Open Berkeley installation profile
# This command expects to be run within the Open Berkeley profile (./rebuild.sh from profiles/openberkeley)
# To use this command you must have `drush make` and `git` installed.

if [ -f openberkeley.make ]; then
  echo '   ____                       ____               __          __'
  echo '  / __ \ ____   ___   ____   / __ ) ___   _____ / /__ ___   / /___   __  __'
  echo ' / / / // __ \ / _ \ / __ \ / __  |/ _ \ / ___// //_// _ \ / // _ \ / / / /'
  echo '/ /_/ // /_/ //  __// / / // /_/ //  __// /   / ,<  /  __// //  __// /_/ /'
  echo '\____// .___/ \___//_/ /_//_____/ \___//_/   /_/|_| \___//_/ \___/ \__, /'
  echo '     /_/                                                          /____/'
  echo "\nThis command can be used to rebuild the installation profile in place.\n"
  echo "  [1] Rebuild profile in place in release mode (latest stable release)"
  echo "  [2] Clean and rebuild profile in place in release mode (latest stable release)"
  # echo "  [3] Rebuild profile in place in development mode (latest dev code)"
  # echo "  [4] Check to see if drush is installed"
  echo "\nSelection: \c"
  read SELECTION

  # a space delimited bash array
  cleanup_dirs=( libraries modules themes );

  if [ $SELECTION = "1" ]; then

    echo "Building Open Berkeley install profile in release mode..."
    drush make --no-core --contrib-destination=. openberkeley.make

  elif [ $SELECTION = "2" ]; then
    echo "Cleaning and rebuilding Open Berkeley install profile in release mode..."

    for dir in "${cleanup_dirs[@]}"
    do
      if [ -d "$dir" ] && [ -w "$dir" ]; then
        echo "Removing $dir..."
        rm -rf $dir/* # pesky dotfiles can thwart us...
        rmdir $dir
      else
        echo "Either not a directory or not writable: $dir"
      fi
    done
    drush make --no-core --contrib-destination=. openberkeley.make

  else
   echo "Invalid selection."
  fi
else
  echo 'Could not locate file "openberkeley.make"'
fi
