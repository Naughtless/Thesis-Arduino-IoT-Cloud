/* LIBRARIES */
#include "Arduino.h"

// WiFi
#include <SoftwareSerial.h>

// Hard-Coded Sensor "Number"
#define SENSOR_CODE "SE002"



/* SETUP */
void setup() {
  Serial.begin(9600);
  delay(500);

  setupWifi();
  delay(500);
}


/* LOOP */
void loop() {
  // Placeholder data.
  float waterTemp = 69.42;
  float airTemp = 69.42;
  float humidity = 69.42;
  float co2 = 69.42;
  float ph = 69.42;
  float nutrient = 69.42;

  Serial.println("\n=-=-=-=-=\n");

  Serial.println("INFO: Begin data send process.");
  String instructions = 
  (String) "GET /arduino/api.php?"
  + "sensorCode=" + SENSOR_CODE + "&"
  + "waterTemp=" + waterTemp + "&"
  + "airTemp=" + airTemp + "&"
  + "humidity=" + humidity + "&"
  + "co2=" + co2 + "&"
  + "ph=" + ph + "&"
  + "nutrient=" + nutrient;
  
  sendSensorData(instructions, (instructions.length() + 2));
  
  delay(10000);
}
