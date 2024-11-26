#include <Arduino.h>

int phSensor = A0;
int samples = 10;

float adc_resolution = 1024.0;

void setup() {
  Serial.begin(9600);
  delay(100);
}

float ph(float voltage) {
  return 7 + ((2.5 - voltage) / 0.18);
}

void loop() {
  int measuring = 0;

  for(int i = 0 ; i < samples ; ++i) {
    measuring += analogRead(phSensor);
    delay(10);
  }

  float voltage = 5 / adc_resolution * measuring / samples;

  Serial.print("pH: ");
  Serial.println(ph(voltage)); // Voltage is 5V.
  delay(5000);
}
