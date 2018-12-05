<?php
/*
* This is a custom form processor, it takes an input array submitted by this
* module's settings form and does some extra preprocessing before the array gets
* passed back to the Modules Class to be serialized and saved into the database.
* Data comes into this file as '$inputArray' and MUST be passed back out as
* '$outputArray' in order for the data to be saved.
*/

### Data comes in as '$inputArray' ###	

// Process submitted post varialbes
foreach($inputArray as $key=>$value){  
	if(in_array($key, array("digitalNum", "digitalLabel", "digitalType", "digitalGPIO", "digitalActive"))){
		// Process through submitted digital sensor sub arrays and store for later nesting
		$digitalPostArray[$key]=$value;
		
	} else if(in_array($key, array("analogNum", "analogLabel", "analogType", "analogGPIO", "analogHysterisis"))){
		// Process through submitted analog sensor sub arrays and store for later nesting
		$analogPostArray[$key]=$value;
		
	} else {
		// Process non-array based variables normally and add to options array.
		$moduleOptions[$key]=$value;			
	}
}


// LOOP: Process saved digital sub arrays into nested array and update gpio pins
foreach($digitalPostArray['digitalNum'] as $key=>$value){
	$digitalNested[$value] = [
		'label' => $digitalPostArray['digitalLabel'][$key],
		'type' => $digitalPostArray['digitalType'][$key],
		'gpio' => $digitalPostArray['digitalGPIO'][$key],
		'active' => $digitalPostArray['digitalActive'][$key]

	];

	// Also build array to update GPIO Pins DB table for pin registration with OS
	$gpio_array[] = [
		'gpio_num' => $digitalPostArray['digitalGPIO'][$key],
		'direction' => 'in',
		'active' => $digitalPostArray['digitalActive'][$key],
		'description' => 'DIGITAL SENSOR: ' . $digitalPostArray['digitalLabel'][$key]
	];
}


// LOOP: Process saved analog sub arrays into nested array and update gpio pins
foreach($analogPostArray['analogNum'] as $key=>$value){
	$analogNested[$value] = [
		'label' => $analogPostArray['analogLabel'][$key],
		'type' => $analogPostArray['analogType'][$key],
		'gpio' => $analogPostArray['analogGPIO'][$key],
		'hysterisis' => $analogPostArray['analogHysterisis'][$key]
	];

	// Also build array to update GPIO Pins DB table for pin registration with OS
/*
	$gpio_array[] = [
		'gpio_num' => $analogPostArray['analogGPIO'][$key],
		'direction' => 'in',
		'active' => 'analog',
		'description' => 'ANALOG SENSOR: ' . $analogPostArray['analogLabel'][$key]
	];
*/
}


// Update GPIO pins table with new pins.
$mod_name = $modules[$moduleID]['svxlinkName'];
$this->update_gpios($mod_name, $gpio_array);	
	

// add nested sensor array into options array.
$moduleOptions['digital'] = $digitalNested; 
$moduleOptions['analog'] = $analogNested; 


// Pass NEW array back out as $outputArray
$outputArray = $moduleOptions;
	
### Data MUST leave as '$outputArray' ###
?>
