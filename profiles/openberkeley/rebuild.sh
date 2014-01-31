#!/bin/sh
# Script to rebuild the Open Berkeley installation profile
# This command expects to be run within the Open Berkeley profile.
# To use this command you must have `drush make` and `git` installed.

if [ -f openberkeley.make ]; then

  echo ' ___   ___   ___'
  echo '|___| |   | |   |'
  echo ' ___  |   | |___|'
  echo '|   | |   |  ___ '
  echo '|   | |___| |___|'
  echo '|   |  _________ '
  echo '|___| |_________|'
  echo ''
  echo '================='
  echo '  Open Berkeley  '
  echo '================='

  echo "\nThis command can be used to rebuild the installation profile in place.\n"
  echo "  [1] Rebuild profile in place in release mode (latest stable release)"
  echo "  [2] Rebuild profile in place in development mode (latest dev code)"
  echo "  [3] Check to see if drush is installed"
  echo "Selection: \c"
  read SELECTION

  if [ $SELECTION = "1" ]; then

    echo "Building Open Berkeley install profile in release mode..."
    drush make --no-core --contrib-destination=. openberkeley.make

  elif [ $SELECTION = "2" ]; then

    echo "We don't have an Open Berkeley install in development mode yet (latest dev code)..."

  elif [ $SELECTION = "3" ]; then

    echo "Checking to see if drush is installed..."
    drush --version

  else
   echo "Invalid selection."
  fi
else
  echo 'Could not locate file "openberkeley.make"'
fi
