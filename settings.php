<?php
/* 
 *	Settings Page for Module 
 *	
 *	This is included into a full page wrapper to be displayed. 
 */
?>

<!-- BEGIN FORM CONTENTS -->
	<fieldset>
		<legend>Module Settings</legend>
	
		  <div class="control-group"> <!-- DigitalPath -->
			<label class="control-label" for="DigitalPath">Digital GPIO Path</label>
			<div class="controls">
			  <div class="input-append">
				<input id="DigitalPath" name="DigitalPath" size="10" type="text" value="<?php echo $moduleSettings['DigitalPath']; ?>" required>
			  </div>
			</div>
		    <span class="help-inline">This is the base linux path that is used to read the value of a GPIO input pin.</span>
		  </div>
	
		  <div class="control-group"> <!-- AnalogPath -->
			<label class="control-label" for="AnalogPath">Analog GPIO Path</label>
			<div class="controls">
			  <div class="input-append">
				<input id="AnalogPath" name="AnalogPath" size="254" type="text" value="/sys/bus/iio/devices/iio:device0/in_voltage" required>
			  </div>
			</div>
		    <span class="help-inline">This is the base linux path that is used to read the value of a analog sensor input pin.  Do not include the actual input number, but find the path that gets right up to the numeric portion of the file name.  Example "ADC_1" should stop at "ADC_"</span>
		  </div>
	
		  <div class="control-group"> <!-- Number of Digital Sensors -->
			<label class="control-label" for="DIGITAL_SENSORS_COUNT">Digital Sensor Count</label>
			<div class="controls">
			  <input class="input-xlarge" id="DIGITAL_SENSORS_COUNT" type="text" name="DIGITAL_SENSORS_COUNT" value="0">
			</div>
		    <span class="help-inline">Define the number of digital sensors that are being used.  This number is the physical number of sensors, so counting starts at 1.  Set to 0 to disable the digital sensors portion of the module</span>
		  </div>
	
		  <div class="control-group"> <!-- Number of Analog Sensors --> 
			<label class="control-label" for="ANALOG_SENSORS_COUNT">Analog Sensors Count</label>
			<div class="controls">
			  <input class="input-xlarge" id="ANALOG_SENSORS_COUNT" type="text" name="ANALOG_SENSORS_COUNT" value="0" required>
			</div>
		    <span class="help-inline">Define the number of Analog sensors that are being used.  This number is the physical number of sensors, so counting starts at 1.  Set to 0 to disable the Analog sensors portion of the module</span>
		  </div>
	
	
	
	<legend>Configure Digital Sensors</legend>
	<!-- Note the user will be thinking in terms of real numbers, but the software counts starting at 0
	so the sensor ID numbers will be N-1 from the number the user sees -->
		
		  <div class="control-group">
				  <div class="control-group"> <!-- Number of Analog Sensors --> 
			<label class="control-label" for="DIGITAL_0_GPIO">DIGITAL SENSOR 1 GPIO NUMBER</label>
			<div class="controls">
			  <input class="input-xlarge" id="DIGITAL_0" type="text" name="DIGITAL_0" value="496" required>
			</div>
		    <span class="help-inline">Define what GPIO pin digital sensor 1 will use</span>
		  </div>
		
		<!-- BLAH BLAH BLAH -->
			<label class="control-label" for="Digital Sensor 1 Type">Define what type of sensor is attached to digital Sensor 1</label>
			<div class="controls">
			  <input type="radio" name="DIGITAL_TYPE_1" value="DOOR_ACTIVE_HIGH" <?php if ($moduleSettings['relays_off_deactivation'] == "1") { echo 'checked="checked"'; } ?>><span> DOOR_ACTIVE_HIGH </span>
			  <input type="radio" name="DIGITAL_TYPE_1" value="DOOR_ACTIVE_LOW" <?php if ($moduleSettings['relays_off_deactivation'] == "0") { echo 'checked="checked"'; } ?>><span> DOOR_ACTIVE_LOW </span> </br>
			  <input type="radio" name="DIGITAL_TYPE_1" value="FUEL_ACTIVE_HIGH" <?php if ($moduleSettings['relays_off_deactivation'] == "1") { echo 'checked="checked"'; } ?>><span> FUEL_ACTIVE_HIGH </span>
			  <input type="radio" name="DIGITAL_TYPE_1" value="FUEL_ACTIVE_LOW" <?php if ($moduleSettings['relays_off_deactivation'] == "0") { echo 'checked="checked"'; } ?>><span> FUEL_ACTIVE_LOW </span> </br>
			  
			</div>
		    <span class="help-inline">Select the appropriate sensor type to configure the behavior and vocalizatoin of events for tihs sensor</span>
		  </div>
		  
	
	<div id="relaysWrap">
	<?php 
	$idNum = 1; // This will be replaced by a loop to load exsiting values 
	
	if ($moduleSettings['relay']) {
		ksort($moduleSettings['relay']);
		foreach($moduleSettings['relay'] as $cur_parent_array => $cur_child_array) { ?>
	
	
			<p class="relayRow<?php if ($idNum == 1) { echo ' first'; } else { echo ' additional'; } ?>">
				<span class="num">
					<input type="hidden" name="relayNum[]" value="<?php echo $idNum; ?>">
					<?php echo $idNum; ?>
				</span>
				
				<span>									
					<input id="relayLabel<?php echo $idNum; ?>" type="text" name="relayLabel[]" placeholder="Relay Label" value="<?php echo $cur_child_array['label']; ?>" class="relayLabel" required>
					<input id="relayGPIO<?php echo $idNum; ?>" type="text" name="relayGPIO[]" placeholder="GPIO"  value="<?php echo $cur_child_array['gpio']; ?>" class="relayGPIO" required>
				</span>
	
				<?php if ($idNum == 1) { 
					echo '<a href="#" id="addRelay" title="Add a relay"><i class="icon-plus-sign"></i></a>';
				} else {
					echo '<a href="#" id="removeRelay" title="Remove this relay"><i class="icon-minus-sign"></i></a>';
				} ?>
			</p>
	
	
		<?php 
		$idNum++;
		}	
	} else {
		echo "there are no relays...";
	}
	?>
	
	</div>
	
	<div id="relayCount"></div>
	
	<hr>
	
	
	
		  <div class="control-group">
			<label class="control-label" for="relays_gpio_active_state"> Global Relay Active High or Low State: </label>
			<div class="controls">
			  <input type="radio" name="relays_gpio_active_state" value="high" <?php if ($moduleSettings['relays_gpio_active_state'] == "high") { echo 'checked="checked"'; } ?>><span> Active High </span>
			  <input type="radio" name="relays_gpio_active_state" value="low" <?php if ($moduleSettings['relays_gpio_active_state'] == "low") { echo 'checked="checked"'; } ?>><span> Active Low </span>
			</div>
			  <span class="help-inline">This setting is dependent upon they hardware/circuit design your are using. Active High enables relays with +3.3 volts on selected GPIO pins. Active Low enables relays by setting selected GPIO pins to ground (0 volts). All relay pins will operate in the same manner.</span>
		  </div>
	
	</fieldset>					
	
<!-- END FORM CONTENTS -->