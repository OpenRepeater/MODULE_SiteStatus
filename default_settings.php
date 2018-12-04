<?php
/*
* This is the file that gets called for this module when OpenRepeater first
* installs the mdoule. It adds the default settings for the module defined in
* the PHP array below into the database in the moduleOptions field in the
* modules table. This information is serialized in the database. The variables
* that should be defined here are the same variables that are used in the
* settings form. Again, it is what is stored in the database as options and
* not the variables that the SVXLink code expects to see in the generated 
* config file for the module.
*/

$default_settings = [
    'digital_path' => '/sys/class/gpio/gpio',
    'analog_path' => '/sys/bus/iio/devices/iio:device0/in_voltage',
	'digital' => [
		'0' => [
			'label' => 'Digital Sensor 0',
			'gpio' => '496',
			'active' => 'low',
			'type' => 'door'
		],
		'1' => [
			'label' => 'Digital Sensor 1',
			'gpio' => '507',
			'active' => 'low',
			'type' => 'fuel'
		]
	],
	'analog' => [
		'0' => [
			'label' => 'Analog Sensor 0',
			'gpio' => '1000',
			'type' => 'temperature',
			'hysterisis' => '45'
		],
		'1' => [
			'label' => 'Analog Sensor 1',
			'gpio' => '1001',
			'type' => 'battery_voltage',
			'hysterisis' => '45'
		]
	]
];
?>

temperature
battery_voltage