#include <OneWire.h>
#include <DallasTemperature.h>

#define DS18B20 4
OneWire temperature(DS18B20);
DallasTemperature sensor(&temperature)

void setup() {
  Serial.begin(9600);

  sensor.begin();
}

void loop() {
  sensor.requestTemperatures();

  Serial.print("Temperature is: ");
  Serial.print(sensor.getTempCByIndex(0));
  Serial.println(" Celcius");
  delay(5000);
}
