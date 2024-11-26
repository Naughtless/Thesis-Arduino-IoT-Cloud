/* LIBRARIES */
#include "Arduino.h"

// WiFi
#include <SoftwareSerial.h>

// Temperature
#include "OneWire.h"
#include "DallasTemperature.h"

// Humidity
#include "DHT.h"

// CO2
#include "MHZ19.h"

// Nutrients
#include "EEPROM.h"
#include "GravityTDS.h"

// Hard-Coded Sensor "Number"
#define SENSOR_CODE "SE001"



/* SETUP */
void setup() {
  Serial.begin(9600);
  delay(500);

  setupWifi();
  delay(500);
  
  setupWaterTemperature();
  delay(100);
  
  setupHumidity();
  delay(100);
  
  setupCO2();
  delay(100);
  
  setupPH();
  delay(100);
  
  setupNutrient();
  delay(100);
}


/* LOOP */
void loop() {
  // Get Data
  delay(834);
  float waterTemp = getWaterTemp();
  
  delay(834);
  float airTemp = getAirTemp();
  
  delay(833);
  float humidity = getHumidity();
  
  delay(833);
  float co2 = getCO2();
  
  delay(833);
  float ph = getPH();
  
  delay(833);
  float nutrient = getNutrient(waterTemp);

  /*
  2x834 + 4x833 = 5000ms -> 5 seconds.
  */
  
//  Serial.println("[1]   WT: " + (String) waterTemp + "°C");
//  Serial.println("[2A]  AT: " + (String) airTemp + "°C");
//  Serial.println("[2B] HUM: " + (String) humidity + "%");
//  Serial.println("[3]  CO2: " + (String) co2 + "ppm");
//  Serial.println("[4]   pH: " + (String) ph + "pH");
//  Serial.println("[5]  TDS: " + (String) nutrient + "ppm");

  Serial.println("=-=-=-=-=");

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
  
  delay(5000);
}
