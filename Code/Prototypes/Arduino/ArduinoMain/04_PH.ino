/* PINS */
#define PIN_PH A0 // ANALOG


/* PARAMETERS */
// ADC is 1024
// SAMPLES is 10


/* FUNCTIONS */
void setupPH() {
  // NO SETUP NECESSARY.
  Serial.println("Sensor: pH... Ready!");
}

float getPH() {
  int measurings = 0;

  for(int i = 0 ; i < 10 ; ++i) {
    measurings += analogRead(PIN_PH);
    delay(10);
  }

  float voltage = 5 / 1023.0 * measurings / 10;

  return calcPH(voltage);

//  return voltage;
}

float calcPH(float voltage) {
  return 7 + ((2.5 - voltage) / 0.18);
}
