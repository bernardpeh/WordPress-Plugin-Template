# Introduction # 

WordPress Plugin Template is an object oriented boilerplate for creating a simple wordpress plugin quickly. Kickstart the creation of the plugin with a shell script. Originally forked from (https://github.com/hlashbrooke/WordPress-Plugin-Template)

## Installation ##

```
git clone git@github.com:bernardpeh/WordPress-Plugin-Template.git
cd Wordpress-Plugin_Template
# edit plugin headers of WordPress-Plugin-Template/Class-WordPress-Plugin-Template.php
./setup/setup.sh (follow the prompt)
```

Once the setup script is completed, copy the generated directory to your wordpress plugin folder. Activate your plugin just like any other plugin.

## What the Plugin Does ##

* creates a simple wordpress plugin skeleton which can be extended easily
* adds a menu item under wp-admin -> settings
* creates a few form items which can be saved.
* creates new post tpye (optional - disabled at the moment)
* supports localisation
* supports uninstall.

## To-Do ##

* Like to have views for the plugin rather than putting html in the logic.
* Like to have an option to create menu group
* Like to create a wizard type bash script which can configure more things

## Contribute ##

If you like to contribute to this project, shoot me a pull request.
