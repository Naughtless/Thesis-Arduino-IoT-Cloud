/* PINS */
#define PIN_WIFI_RX 2
#define PIN_WIFI_TX 3

SoftwareSerial wifi(PIN_WIFI_RX, PIN_WIFI_TX);


/* PARAMETERS */
String wifiName = "Helios";
String wifiPassword = "jasondavid";

String host = "13.212.254.69";
String port = "80";


/* FUNCTIONS */
void setupWifi() {
  Serial.println("SETUP: WiFi...");
  wifi.begin(115200);

  delay(1000);

  Serial.println("WiFi: [AT+RST]");
  runCommand("AT+RST", "OK"); // Reset module.
  Serial.println("WiFi: [AT+CWMODE=1]");
  runCommand("AT+CWMODE=1", "OK"); // Set to station mode.
  Serial.println("WiFi: [AT+CWJAP=\"" + wifiName + "\",\"" + wifiPassword + "\"]");
  runCommand("AT+CWJAP=\"" + wifiName + "\",\"" + wifiPassword + "\"", "OK"); // Connect to WiFi.
  Serial.println("WiFi: [AT+CIPMUX=1]"); 
  runCommand("AT+CIPMUX=1", "OK"); // Set to multi-connection mode.

  Serial.println("WiFi: Ready!");
}

void sendSensorData(String inst, int len) {
  Serial.print("INSTR: ");
  Serial.print(inst);
  Serial.println();

  Serial.println("WiFi: [AT+CIPSTART=0,\"TCP\",\"" + host + "\"," + port + "]");
  runCommand("AT+CIPSTART=0,\"TCP\",\"" + host + "\"," + port, "OK");             // AT+CIPSTART=0,"TCP","192.168.18.117",80
  
  Serial.println("WiFi: [AT+CIPSEND=0," + (String) len + "]");
  runCommand("AT+CIPSEND=0," + (String) len, ">");                                // AT+CIPSEND=0,102
  
  Serial.println("WiFi: SENDING PACKAGE!");
  runCommand(inst, "");                                                           // GET /arduino/api.php?sensorCode=1&waterTemp=ARD&airTemp=ARD&humidity=ARD&co2=ARD&ph=ARD&nutrient=ARD

  Serial.println("WiFi: [AT+CIPCLOSE=0]");
  runCommand("AT+CIPCLOSE=0", "");
  
  delay(1000);
}

void runCommand(String command, String expectedResponse) {
  /* Send Command */
  wifi.println(command);

  /* Compile Response */
  boolean keyFound = false;
  String finalResponse = "";
  do {
    if(wifi.available()) {
      String currentResponse = wifi.readStringUntil('\n');
      currentResponse.trim();
      int nli = currentResponse.indexOf("\n");
      if(nli > 0) currentResponse.remove(nli);
      finalResponse += currentResponse;
//      Serial.println("WiFi: Current response: " + currentResponse);

      if(finalResponse.indexOf(expectedResponse) > 0) {
        keyFound = true;
        Serial.println("WiFi: Keyword found!");
      }
    }
    else {
      Serial.println("WiFi: SoftwareSerial n/a. Keyword n/a. Assume OK!\nWiFi: Delay 10s.");
      delay(10000);
      keyFound = true;
    }
    Serial.println("WiFi: (R) " + finalResponse);
    delay(200);
  } while(!keyFound);
  
  Serial.println("\n");
}
