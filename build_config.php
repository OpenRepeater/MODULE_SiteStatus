<?php
/*
* This is the file that gets called for this module when OpenRepeater rebuilds the configuration files for SVXLink.
* Settings for the config file are created as a PHP associative array, when the file is called it will convert it into
* the requiried INI format and write the config file to the appropriate location with the correct naming.
*/

$options = unserialize($cur_mod['moduleOptions']);


################################################################################
# This is a stripped down file to the basics required create the PHP array that
# will be used by ORP to write the config file in INI formate for the some of the
# variables at the top in consturcting the array are pulled from the initiating
# loop. I would start by transposing the values out of your ModuleSiteStatus.conf
# to hard coded array items first and verify the svxlink side works first, then
# you can focus on adding in dynamic values and additional logic and loops if 
# required. This way we can see exactly what the data needs to look like.
################################################################################

################################################################################
# This first part here starts the php array with 4 values that are common to 
# all modules. 
################################################################################

// Build Config

// The first line creates the first level of array and [ModuleSiteStatus] section
// Anything inside the sub array are items that will appear under [ModuleSiteStatus]
$module_config_array['Module'.$cur_mod['svxlinkName']] = [
	'NAME' => $cur_mod['svxlinkName'],
	'PLUGIN_NAME' => 'Tcl',
	'ID' => $cur_mod['svxlinkID'],
	'TIMEOUT' => '200',				
];

################################################################################
# This next part here appends more values onto to the array above.
# that is what the '+=' it appends. Add as many hardcoded variables you want
# to show in your INI when rebuilt.
################################################################################
$module_config_array['Module'.$cur_mod['svxlinkName']] += [ 
	'DIGITAL_GPIO_PATH' => '/sys/class/gpio/gpio',
	'DIGITAL_SENSORS_COUNT' => '1',
	'ANALOG_GPIO_PATH' => '/sys/bus/iio/devices/iio:device0/in_voltage',
	'ANALOG_SENSORS_COUNT' => '1',
	'DIGITAL_0' => '496',
	'DIGITAL_TYPE_0' => 'DOOR_ACTIVE_HIGH',
	'ANALOG_0' => '0',
	'ANALOG_TYPE_0' => 'TEMPERATURE',
	'ANALOG_HYSTERISIS_0' => '45',
];

?>