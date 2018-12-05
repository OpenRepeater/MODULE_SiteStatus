<?php
/*
* This is the file that gets called for this module when OpenRepeater rebuilds
* the configuration files for SVXLink. Settings for the config file are created
* as a PHP associative array, when the file is called it will convert it into
* the requiried INI format and write the config file to the appropriate location
* with the correct naming.
*/

$options = unserialize($cur_mod['moduleOptions']);

################################################################################
# This first part here starts the php array with 4 values that are common to 
# all modules. 
################################################################################

// Common variables
$module_config_array['Module'.$cur_mod['svxlinkName']] = [
	'NAME' => $cur_mod['svxlinkName'],
	'PLUGIN_NAME' => 'Tcl',
	'ID' => $cur_mod['svxlinkID'],
	'TIMEOUT' => '200',				
];


################################################################################
# This next part here appends more values onto to the array above.
################################################################################

// Extract sensor sub arrays into their own array
foreach($options as $key=>$value){  
	if(in_array($key, array("digital", "analog"))) {
		// Process through submitted sensor sub arrays and store for later
 		$sensorArray[$key]=$value;
 	}
}


// Add standard variables to the config
$module_config_array['Module'.$cur_mod['svxlinkName']] += [
	'DIGITAL_GPIO_PATH' => $options['digital_path'],
	'DIGITAL_SENSORS_COUNT' => count($sensorArray['digital']),
	'ANALOG_GPIO_PATH' => $options['analog_path'],
	'ANALOG_SENSORS_COUNT' => count($sensorArray['analog']),
];


// Loop through Digital sensors in sub array and add to config
foreach($sensorArray['digital'] as $key=>$value){  
	$offset_key = $key - 1;
	$module_config_array['Module'.$cur_mod['svxlinkName']] += [
		'DIGITAL_'.$offset_key => $value['gpio'],
		'DIGITAL_TYPE_'.$offset_key => strtoupper( $value['type'] . '_ACTIVE_' . $value['active'] ),
	];
}


// Loop through Analog sensors in sub array and add to config
foreach($sensorArray['analog'] as $key=>$value){  
	$offset_key = $key - 1;
	$module_config_array['Module'.$cur_mod['svxlinkName']] += [
		'ANALOG_'.$offset_key => $value['gpio'],
		'ANALOG_TYPE_'.$offset_key => strtoupper( $value['type'] ),
		'ANALOG_HYSTERISIS_'.$offset_key => $value['hysterisis'],
	];
}

?>