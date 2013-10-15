#!/bin/bash

if [ $# -ne 1 ]
then
  echo "
  This simple script sets up the naming convention of all files and classes within this directory to the name of the plugin you specify. 
  Do not call this script from outside the setup dir. Use UNDERSCORE instead of dash for spacing. Eg,
        
  Usage: ./setup my_project
    "
  exit;
fi

FILE_NAME=`echo $1 | sed 's/_/-/g'`
CLASS_FILE_NAME=class-$FILE_NAME
CLASS_FILE_NAME_SETTINGS=class-$FILE_NAME-settings
CLASS_FILE_NAME_POST_TYPE=class-$FILE_NAME-post_type
CLASS_PREFIX=$1;
PLUGIN_NAME=`echo $1 | sed 's/_/ /g'`

# rename the main file
# mv ../wordpress-plugin-template.php ../$FILE_NAME.php

# rename classes file
# mv ../classes/class-wordpress-plugin-template.php  ../classes/$CLASS_FILE_NAME.php
# mv ../classes/class-wordpress-plugin-template-settings.php ../classes/$CLASS_FILE_NAME_SETTINGS.php
# mv ../classes/post-types/class-wordpress-plugin-template-post_type.php ../classes/post-types/$CLASS_FILE_NAME_POST_TYPE.php

# find ../ -name '*.php' -type f | while read s; do sed "s/WordPress Plugin Template/$PLUGIN_NAME/g" $s; done


