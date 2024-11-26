/* PINS */
#define PIN_CO2 10

/*
 * Sensor is in PWM mode.
 */


/* PARAMETERS */
float sensorRange = 5000.0; // MH-Z19B, PPM Range is from 0 ~ 5000. https://www.winsen-sensor.com/d/files/infrared-gas-sensor/mh-z19b-co2-ver1_0.pdf


/* FUNCTIONS */
void setupCO2() {
  Serial.print("Sensor: CO2... ");
  
  pinMode(PIN_CO2, INPUT);

  Serial.println("Ready!");
}

float getCO2() {  
  // Algorithm source: https://iotspace.dev/arduino-co2-sensor-mh-z19-beispiel-und-sketch/
  unsigned long pwmFreq = pulseIn(PIN_CO2, HIGH, 2000000) / 1000;
  float pulseRate = pwmFreq / 1004.0;
  float co2ppm = sensorRange * pulseRate; 

  return co2ppm;
}
