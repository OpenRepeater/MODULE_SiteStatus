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
	'DIGITAL_GPIO_PATH' => $options['DigitalPath'],
	'DIGITAL_SENSORS_COUNT' => $options['DIGITAL_SENSORS_COUNT'],
	'ANALOG_GPIO_PATH' => $options['AnalogPath'],
	'ANALOG_SENSORS_COUNT' => $options['ANALOG_SENSORS_COUNT'],

	'DIGITAL_0' => $options['DIGITAL_0_GPIO'],
	'DIGITAL_TYPE_0' => 'DOOR_ACTIVE_HIGH',
	
	'DIGITAL_1' => '496',
	'DIGITAL_TYPE_1' => 'FUEL_ACTIVE_HIGH',
	'DIGITAL_2' => '496',
	'DIGITAL_TYPE_2' => 'DOOR_ACTIVE_HIGH', 
	'DIGITAL_3' => '496',
	'DIGITAL_TYPE_3' => 'FUEL_ACTIVE_HIGH',
	'DIGITAL_4' => '496',
	'DIGITAL_TYPE_4' => 'DOOR_ACTIVE_HIGH',
	'ANALOG_0' => '0',
	'ANALOG_TYPE_0' => 'TEMPERATURE',
	'ANALOG_HYSTERISIS_0' => '45',
	'ANALOG_1' => '1',
	'ANALOG_TYPE_1' => 'TEMPERATURE',
	'ANALOG_HYSTERSIS_1' => '45',
	'ANALOG_2' => '2',
	'ANALOG_TYPE_2' => 'TEMPERATURE',
	'ANALOG_HYSTERISIS_2' => '45',
	'ANALOG_3' => '3',
	'ANALOG_TYPE_3' => 'TEMPERATURE',
	'ANALOG_HYSTERISIS_3' => '45',
	'ANALOG_4' => '4',
	'ANALOG_TYPE_4' => 'TEMPERATURE',
	'ANALOG_HYSTERISIS_4' => '45',
];

?>