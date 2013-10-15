#!/bin/bash

if [ $# -ne 1 ]
then
  echo "
  This simple script sets up the naming convention of all files and classes within this directory to the name of the plugin you specify. 
  Do not call this script from outside the setup dir. Use UNDERSCORE instead of dash for spacing and Camelcase. Eg,
        
  Usage: ./setup MY_Cool_Project
    "
  exit;
fi

FILE_NAME=`echo $1 | sed 's/_/-/g'`
CLASS_FILE_NAME=class-$FILE_NAME
OBJ_NAME=$1;
PLUGIN_NAME=`echo $1 | sed 's/_/ /g'`

# rename the main file
mv ../WordPress-Plugin-Template/WordPress-Plugin-Template.php ../WordPress-Plugin-Template/$FILE_NAME.php

# rename classes file
mv ../WordPress-Plugin-Template/classes/Class-WordPress-Plugin-Template.php  ../WordPress-Plugin-Template/classes/$CLASS_FILE_NAME.php
mv ../WordPress-Plugin-Template/classes/Class-WordPress-Plugin-Template-Settings.php ../WordPress-Plugin-Template/classes/$CLASS_FILE_NAME-Settings.php
mv ../WordPress-Plugin-Template/classes/post-types/Class-WordPress-Plugin-Template-Post-Type.php ../WordPress-Plugin-Template/classes/post-types/$CLASS_FILE_NAME-Post_Type.php

find ../ -name '*.php' -type f | while read s; do sed -e "s/WordPress Plugin Template/$PLUGIN_NAME/g" -e "s/Class-WordPress-Plugin-Template/$CLASS_FILE_NAME/g" -e "s/WordPress_Plugin_Template/$OBJ_NAME/g" -i $s; done

# rename this project dir
mv ../WordPress-Plugin-Template ../$FILE_NAME

echo 'All done. Now copy this dir to your wordpress dir and activate it.'

exit 0
