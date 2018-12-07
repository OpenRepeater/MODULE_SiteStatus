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
		'1' => [
			'label' => 'Digital Sensor 1',
			'type' => 'door',
			'gpio' => '496',
			'active' => 'low'
		],
		'2' => [
			'label' => 'Digital Sensor 2',
			'type' => 'fuel',
			'gpio' => '507',
			'active' => 'low'
		]
	],
	'analog' => [
		'1' => [
			'label' => 'Analog Sensor 1',
			'type' => 'temperature',
			'gpio' => '1000',
			'hysterisis' => '45'
		],
		'2' => [
			'label' => 'Analog Sensor 2',
			'type' => 'battery_voltage',
			'gpio' => '1001',
			'hysterisis' => '45'
		]
	]
];
?>
