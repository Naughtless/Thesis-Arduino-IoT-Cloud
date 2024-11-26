/* PINS */
#define PIN_WATERTEMP 8
OneWire temperature(PIN_WATERTEMP);
DallasTemperature sensorTemperature(&temperature); 


/* FUNCTIONS */
void setupWaterTemperature() {
  Serial.print("Sensor: WT... ");
  
  sensorTemperature.begin();
  delay(50);
  
  Serial.println("Ready!");
}

float getWaterTemp() {
  sensorTemperature.requestTemperatures();
  return sensorTemperature.getTempCByIndex(0);
}
