// Module JavaScript for UI elements


// Variables
/*
var maxSysRelays = 8;
var minReqRelays = 1;
*/


// Sub Functions
function digitalTemplate(n, typeArray) {
	var html_digital = '<p class="sensorRow additional">'+
	'<span class="num">'+
	'  <input type="hidden" name="digitalNum[]" value="' + n +'">' + n +
	'</span>'+
	'<span>'+
	'  <input id="digitalLabel' + n +'" type="text" name="digitalLabel[]" placeholder="Digital Label" class="digitalLabel" Value="Digital Sensor '+n+'" required>'+
	'  <select id="digitalType' + n +'" name="digitalType[]" class="digitalType" required>'+
	'   <option>Select Type</option>';

	for (var key in typeArray) {
	    if (typeArray.hasOwnProperty(key)) {
	        html_digital += '   <option value="' + key + '">' + typeArray[key] + '</option>';
	    }
	}

	html_digital += '  </select>'+
	'  <input id="digitalGPIO0' + n +'" type="text" name="digitalGPIO[]" placeholder="GPIO" class="digitalGPIO" required>'+
	'  <select id="digitalActive0" name="digitalActive[]" class="digitalActive" required>'+
	'   <option value="low">Active Low</option><option value="high">Active High</option>'+
	'  </select>'+
	'</span>'+
	'<a href="#" id="removeDigital" title="Remove this digital sensor"><i class="icon-minus-sign"></i></a>'+
	'</p>';
	return html_digital;
}


function analogTemplate(n, typeArray) {
	var html_analog = '<p class="sensorRow additional">'+
	'<span class="num">'+
	'  <input type="hidden" name="analogNum[]" value="' + n +'">' + n +
	'</span>'+
	'<span>'+
	'  <input id="analogLabel' + n +'" type="text" name="analogLabel[]" placeholder="Analog Label" class="analogLabel" Value="Analog Sensor '+n+'" required>'+
	'  <select id="analogType' + n +'" name="analogType[]" class="analogType" required>'+
	'	<option>Select Type</option>';

	for (var key in typeArray) {
	    if (typeArray.hasOwnProperty(key)) {
	        html_analog += '   <option value="' + key + '">' + typeArray[key] + '</option>';
	    }
	}

	html_analog += '  </select>'+
	'  <input id="analogGPIO' + n +'" type="text" name="analogGPIO[]" placeholder="GPIO" class="analogGPIO" required>'+
	'  <input id="analogHysterisis' + n +'" type="number" name="analogHysterisis[]" placeholder="Hysterisis"  value="0" class="analogHysterisis" required>'+
	'</span>'+
	'<a href="#" id="removeAnalog" title="Remove this analog sensor"><i class="icon-minus-sign"></i></a>'+
	'</p>';
	return html_analog;
}


function updateDigitalCount(n) {
	if(n==1) {
	    $('#digitalCount').html( n + ' Digital Sensor' ); // singular
	} else {
	    $('#digitalCount').html( n + ' Digital Sensors' ); // plural
	}
}

function updateAnalogCount(n) {
	if(n==1) {
	    $('#analogCount').html( n + ' Analog Sensor' ); // singular
	} else {
	    $('#analogCount').html( n + ' Analog Sensors' ); // plural
	}
}

/*
function checkMaxRelay(currentRelays, sysMax, inRelays, outRelays) {
	if (currentRelays >= inRelays || currentRelays >=outRelays) {
		alert("Sorry, but you cannot add anymore relays because you do not have the required audio inputs and outputs required to suprelay these relays. The system has detected that you have "+inRelays+" audio input channel(s) and "+outRelays+" audio output channel(s). Please add more suprelayed audio devices first to be able to add more relays.");
		return false;
	}
	if (currentRelays >= sysMax) {
		alert("Sorry, but you cannot add anymore relays because you already have the maximum number of relays the system will suprelay.");
		return false;
	}
	return true;
}
*/

/*
function checkMinRelay(currentRelays, minRelays) {
	if (currentRelays <= minRelays) {
		alert("Sorry, but you cannot remove any more relays because this system requires a minimum of "+minRelays+" relay(s).");
		return false;
	}
	return true;
}
*/



// Main Scripts
$(window).load(function(){
$(function() {
        // Get Digital Types
        var digitalTypeArray = $('#digitalTypeArray').text();
		var digitalTypeArray = JSON.parse(digitalTypeArray);
		
		// Get Analog Types
		var analogTypeArray = $('#analogTypeArray').text();
		var analogTypeArray = JSON.parse(analogTypeArray);

/*
        var inputRelays = $('#detectedRX').val();
		var outputRelays = $('#detectedTX').val();
*/

        var d = $('#digitalWrap p').size();
		updateDigitalCount(d);

        var a = $('#analogWrap a').size();
		updateAnalogCount(a);
        

        $('#addDigital').live('click', function() {
//             if(checkMaxRelay(d, maxSysRelays, inputRelays, outputRelays)) {
	                d++;
	                $(digitalTemplate(d, digitalTypeArray)).appendTo('#digitalWrap');
					updateDigitalCount(d);
// 				}
                return false;
        });
        
        $('#removeDigital').live('click', function() { 
//                 if(checkMinRelay(d, minReqRelays)) {
                        $(this).parents('p').remove();
                        d--;
						updateDigitalCount(d);
//                 }
                return false;
        });


        $('#addAnalog').live('click', function() {
//                 if(checkMaxRelay(a, maxSysRelays, inputRelays, outputRelays)) {
	                a++;
	                $(analogTemplate(a, analogTypeArray)).appendTo('#analogWrap');
					updateAnalogCount(a);
// 				}
                return false;
        });
        
        $('#removeAnalog').live('click', function() { 
//                 if(checkMinRelay(i, minReqRelays)) {
                        $(this).parents('p').remove();
                        a--;
						updateAnalogCount(a);
//                 }
                return false;
        });


});

});//]]> 
