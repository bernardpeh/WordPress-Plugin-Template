#!/bin/bash

if [ `dirname $0` != "./setup" ]
then
  echo "
  Please run this script one level above the setup dir. After you download the files,
  cd WordPress-Plugin-Template
  ./setup/setup.sh
  "
  exit 1;
fi

if [ $# -ne 3 ]
then
  echo "
  This simple script sets up the naming convention of all files and classes within this directory to the name of the plugin you specify. 
  Run the command using using this convention:
    
  Usage: ./setup/setup.sh MY_Cool_Project my_page_name My_Page_Title
    "
  exit 1;
fi


FILE_NAME=`echo $1 | sed 's/_/-/g'`
CLASS_FILE_NAME=Class-$FILE_NAME
OBJ_NAME=$1
PLUGIN_NAME=`echo $1 | sed 's/_/ /g'`
PAGE_SLUG=$2
PAGE_TITLE=`echo $3 | sed 's/_/ /g'`

# rename the main file
mv WordPress-Plugin-Template/WordPress-Plugin-Template.php WordPress-Plugin-Template/$FILE_NAME.php

# rename classes file
mv WordPress-Plugin-Template/classes/Class-WordPress-Plugin-Template.php  WordPress-Plugin-Template/classes/$CLASS_FILE_NAME.php
mv WordPress-Plugin-Template/classes/Class-WordPress-Plugin-Template-Settings.php WordPress-Plugin-Template/classes/$CLASS_FILE_NAME-Settings.php
mv WordPress-Plugin-Template/classes/post-types/Class-WordPress-Plugin-Template-Post-Type.php WordPress-Plugin-Template/classes/post-types/$CLASS_FILE_NAME-Post-Type.php

find . -name '*.php' -type f | while read s; do sed -e "s/WordPress Plugin Template/$PLUGIN_NAME/g" -e "s/Class-WordPress-Plugin-Template/$CLASS_FILE_NAME/g" -e "s/WordPress_Plugin_Template/$OBJ_NAME/g" -i $s; done

# replace page slug and title
sed -e "s/PAGE_SLUG/$PAGE_SLUG/g" -e "s/PAGE_TITLE/$PAGE_TITLE/g" -i WordPress-Plugin-Template/classes/$CLASS_FILE_NAME-Settings.php

# finally, rename this project dir
mv WordPress-Plugin-Template $FILE_NAME

echo "All done. Now copy the $FILE_NAME dir to your wordpress plugin dir and activate it."

exit 0
