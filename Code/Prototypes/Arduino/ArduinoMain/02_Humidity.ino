/* PINS */
#define PIN_HUMIDITY 9
#define DHT_TYPE DHT11
DHT sensorHumidity(PIN_HUMIDITY, DHT_TYPE);


/* FUNCTIONS */
void setupHumidity() {
  Serial.print("Sensor: Humidity... ");
  
  sensorHumidity.begin();

  Serial.println("Ready!");
}

float getAirTemp() {
  return sensorHumidity.readTemperature();
}

float getHumidity() {
  return sensorHumidity.readHumidity();
}
