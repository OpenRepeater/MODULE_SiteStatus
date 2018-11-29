# MODULE_SiteStatus

This module is useful for monitoring the general status of a repeater site remotely.  Through the use of Digital and Analog sensors, you can be audibly notified of events and things of interest from a maintenance perspective.

Some simple examples of digital events (On/Off, Open/shut)
  Door open/close
  Generator active/standby
  Priamry power available (vs running on generator)
  water sensor
  fire sensor
  etc

Some simple examples of Analog events (sliding scale inputs)
  Fuel levels for generator
  battery voltage
  temperature
  primary power supply voltage 
  etc.
  
This module has been designed specifically for the ICS-PI-REPEATER-1X/2X hardware platforms but is easily configurable to adapt to 
other hardware interface types. It may be necessary to update some file paths, or other considerations that are specific to your hardware
if not using the PI-REPEATER-1X/2X platforms, then agian it also may just work as is.
