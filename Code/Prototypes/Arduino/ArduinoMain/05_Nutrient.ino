/* PINS */
#define PIN_NUTRIENT A1 // ANALOG
GravityTDS sensorNutrient;

/* PARAMETERS */
// ADC is 1024
// AREF is 5


/* FUNCTIONS */
void setupNutrient() {
  Serial.print("Sensor: Nutrient... ");
  
  sensorNutrient.setPin(PIN_NUTRIENT);
  sensorNutrient.setAref(5);
  sensorNutrient.setAdcRange(1024);
  sensorNutrient.begin();
  
  Serial.println("Ready!");
}

float getNutrient(float waterTemperature) {
  sensorNutrient.setTemperature(waterTemperature);
  sensorNutrient.update();
  
  return sensorNutrient.getTdsValue();
}
