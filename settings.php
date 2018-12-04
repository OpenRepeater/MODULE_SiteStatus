<?php
/* 
 *	Settings Page for Module 
 *	
 *	This is included into a full page wrapper to be displayed. 
 */

// print_r($moduleSettings);
?>


<!-- BEGIN FORM CONTENTS -->
<fieldset>
	<input type="hidden" name="digital_path" value="<?php echo $moduleSettings['digital_path']; ?>">
	<input type="hidden" name="analog_path" value="<?php echo $moduleSettings['analog_path']; ?>">
					  

<!-- *************************************************************************** -->
	<legend>Configure Digital Sensors</legend>
	<p>(May still add a toggle variable here to turn this section on & off)</p>
	<p>Some simple examples of digital events (On/Off, Open/shut) - Door open/close, Generator active/standby, Primary power available (vs running on generator),   water sensor, fire sensor</p>

	<div id="digitalWrap">
	<?php 
	$digitalTypesArray = [
		'door' => 'Door',
		'fuel' => 'Fuel',
		'water' => 'Water',
		'fire' => 'Fire',
		'solar' => 'Solar Charging',
		'battery' => 'Battery'
	];
// 	echo json_encode($digitalTypesArray);

	$idNumDigital = 0; // This will be replaced by a loop to load exsiting values 
	
	if ($moduleSettings['digital']) {
		ksort($moduleSettings['digital']);
		foreach($moduleSettings['digital'] as $cur_parent_array => $cur_child_array) { ?>
	
	
			<p class="sensorRow<?php if ($idNumDigital == 1) { echo ' first'; } else { echo ' additional'; } ?>">
				<span class="num">
					<input type="hidden" name="digitalNum[]" value="<?php echo $idNumDigital; ?>">
					<?php echo $idNumDigital; ?>
				</span>
				
				<span>									
					<input id="digitalLabel<?php echo $idNumDigital; ?>" type="text" name="digitalLabel[]" placeholder="Digital Label" value="<?php echo $cur_child_array['label']; ?>" class="digitalLabel" required>
					
					<select id="digitalType<?php echo $idNumDigital; ?>" name="digitalType[]" class="digitalType" required>
						<option>Select Type</option>
						<?php 
						foreach($digitalTypesArray as $value => $label) {
							if($cur_child_array['type'] == $value) { $sel_option = 'selected'; } else { $sel_option = ''; }
							echo '<option value="'.$value.'" '.$sel_option.'>'.$label.'</option>';
						}
						?>	
					</select>

					<input id="digitalGPIO<?php echo $idNumDigital; ?>" type="text" name="digitalGPIO[]" placeholder="GPIO"  value="<?php echo $cur_child_array['gpio']; ?>" class="digitalGPIO" required>

					<select id="digitalActive<?php echo $idNumDigital; ?>" name="digitalActive[]" class="digitalActive" required>
						<?php 
						if($cur_child_array['active'] == 'low') { 
							echo '<option value="low" selected>Active Low</option>';
							echo '<option value="high">Active High</option>';
						} else {
							echo '<option value="low">Active Low</option>';
							echo '<option value="high" selected>Active High</option>';
						}
						?>	
					</select>
				</span>
	
				<?php if ($idNumDigital == 0) { 
					echo '<a href="#" id="addDigital" title="Add a digital sensor"><i class="icon-plus-sign"></i></a>';
				} else {
					echo '<a href="#" id="removeDigital" title="Remove this digital sensor"><i class="icon-minus-sign"></i></a>';
				} ?>
			</p>
	
	
		<?php 
		$idNumDigital++;
		}	
	} else {
		echo "there are no digital sensors...";
	}
	?>
	
	</div>
	
	<div id="digitalCount"></div>

	<br>

<!-- *************************************************************************** -->

	<legend>Configure Analog Sensors</legend>
	<p>(May still add a toggle variable here to turn this section on & off)</p>
	<p>Some simple examples of Analog events (sliding scale inputs) - Fuel levels for generator, battery voltage, temperature, primary power supply voltage</p>

	<div id="analogWrap">
	<?php 
	$analogTypesArray = [
		'temperature' => 'Temperature',
		'battery_voltage' => 'Battery Voltage'
	];

	$idNumAnalog = 0; // This will be replaced by a loop to load exsiting values 
	
	if ($moduleSettings['analog']) {
		ksort($moduleSettings['analog']);
		foreach($moduleSettings['analog'] as $cur_parent_array => $cur_child_array) { ?>
	
	
			<p class="sensorRow<?php if ($idNumAnalog == 1) { echo ' first'; } else { echo ' additional'; } ?>">
				<span class="num">
					<input type="hidden" name="analogNum[]" value="<?php echo $idNumAnalog; ?>">
					<?php echo $idNumAnalog; ?>
				</span>
				
				<span>									
					<input id="analogLabel<?php echo $idNumAnalog; ?>" type="text" name="analogLabel[]" placeholder="Analog Label" value="<?php echo $cur_child_array['label']; ?>" class="analogLabel" required>

					<select id="analogType<?php echo $idNumDigital; ?>" name="analogType[]" class="analogType" required>
						<option>Select Type</option>
						<?php 
						foreach($analogTypesArray as $value => $label) {
							if($cur_child_array['type'] == $value) { $sel_option = 'selected'; } else { $sel_option = ''; }
							echo '<option value="'.$value.'" '.$sel_option.'>'.$label.'</option>';
						}
						?>	
					</select>

					<input id="analogGPIO<?php echo $idNumAnalog; ?>" type="text" name="analogGPIO[]" placeholder="GPIO"  value="<?php echo $cur_child_array['gpio']; ?>" class="analogGPIO" required>

					<input id="analogHysterisis<?php echo $idNumAnalog; ?>" type="number" name="analogHysterisis[]" placeholder="Hysterisis"  value="<?php echo $cur_child_array['hysterisis']; ?>" class="analogHysterisis" required>
				</span>
	
				<?php if ($idNumAnalog == 0) { 
					echo '<a href="#" id="addAnalog" title="Add a analog sensor"><i class="icon-plus-sign"></i></a>';
				} else {
					echo '<a href="#" id="removeAnalog" title="Remove this analog sensor"><i class="icon-minus-sign"></i></a>';
				} ?>
			</p>
	
	
		<?php 
		$idNumAnalog++;
		}	
	} else {
		echo "there are no analog sensors...";
	}
	?>
	
	</div>
	
	<div id="analogCount"></div>

	<br>

<!-- *************************************************************************** -->
		
</fieldset>					
	
<!-- END FORM CONTENTS -->