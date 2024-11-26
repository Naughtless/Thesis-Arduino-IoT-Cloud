#include <EEPROM.h>
#include "GravityTDS.h"

#define TDS_PIN A1
GravityTDS gtds;

float temperature = 25; // This is a placeholder. The temperature should be measured independently by a temperature sensor.
float tdsValue = 0;

void setup() {
  Serial.begin(115200);
  gtds.setPin(TDS_PIN);
  gtds.setAref(5.0);
  gtds.setAdcRange(1024);
  gtds.begin();
}

void loop() {
  gtds.setTemperature(temperature);
  gtds.update();
  tdsValue = gtds.getTdsValue();

  Serial.print(tdsValue, 0);
  Serial.println(" ppm");
  delay(5000);
}
