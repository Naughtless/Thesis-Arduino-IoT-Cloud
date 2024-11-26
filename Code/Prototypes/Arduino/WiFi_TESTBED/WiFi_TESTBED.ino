#include <SoftwareSerial.h>
SoftwareSerial wifi(2, 3); // RX, TX

const char* wifiName = "Helios";
const char* wifiPassword = "jasondavid";

const char* host = "192.168.18.117";
const char* port = "80";

void setup() {
  Serial.begin(9600);
  wifi.begin(115200);
//  wifi.begin(9600);

//  cli();
}

void loop() {
  /* Command Input */
  Serial.print("Command: ");
  while(Serial.available() == 0) {}
  String command = Serial.readString();
  Serial.println("User input: " + command);
  Serial.println("\n");

  /* Expected Response Input */
  Serial.print("Expected response?: ");
  while(Serial.available() == 0) {}
  String expectedResponse = Serial.readString();
  expectedResponse.trim();
  Serial.println("User input: " + expectedResponse);
  Serial.println("\n");

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
      Serial.println("Current line response: " + currentResponse);

      if(finalResponse.indexOf(expectedResponse) > 0) {
        keyFound = true;
        Serial.println("INFO: Keyword found!");
      }
    }
    else {
      Serial.println("INFO: SoftwareSerial no longer available. Keyword not found. Assuming command OK!\nINFO: Delaying for 5 seconds...");
      delay(5000);
      keyFound = true;
    }
    Serial.println("FINAL line response: " + finalResponse);
    delay(200);
  } while(!keyFound);
  
  delay(1000);
  Serial.println("\n");
}

void serialDump() {
  char temp;
  while(wifi.available()) {
    temp = wifi.read();
    Serial.print(temp);
    delay(5);
  }
}
