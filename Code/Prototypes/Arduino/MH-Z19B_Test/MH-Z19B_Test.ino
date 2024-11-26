#include <Arduino.h>
#include "MHZ19.h"
#include <SoftwareSerial.h>

#define RXP 3
#define TXP 2

MHZ19 sensor;
SoftwareSerial mySerial(RXP, TXP);

void setup() {
  Serial.begin(9600);
  
  mySerial.begin(9600);
  sensor.begin(mySerial);
  
  sensor.autoCalibration();
}

void loop() {
  int co2 = sensor.getCO2();
  int8_t temp = sensor.getTemperature();

  Serial.print("CO2 Levels: ");
  Serial.print(co2);
  Serial.println(" ppm");

  Serial.print("Temperature: ");
  Serial.print(temp);
  Serial.println(" Celcius");

  delay(5000);
}
