#include <ESP8266WiFi.h>
#include <WiFiClient.h> 
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
#include "DHT.h"

//Define the data pin
uint8_t DHTPIN = D2;
#define DHTTYPE DHT11

/* Set these to your desired credentials. */

const char *ssid = "";  //ENTER YOUR WIFI SETTINGS
const char *password = "";
  

// Initialize DHT sensor.
DHT dht(DHTPIN, DHTTYPE);



void setup() 
{
  delay(1000);
  Serial.begin(115200);
  WiFi.mode(WIFI_OFF);        //Prevents reconnection issue (taking too long to connect)
  delay(1000);
  WiFi.mode(WIFI_STA);        //This line hides the viewing of ESP as wifi hotspot
  
  WiFi.begin(ssid, password);     //Connect to your WiFi router
  Serial.println("");

  Serial.print("Connecting");
  // Wait for connection
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  //If connection successful show IP address in serial monitor
  Serial.println("");
  Serial.print("Connected to ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());  //IP address assigned to your ESP
  dht.begin();
}
 

void loop() {
  HTTPClient http;    //Declare object of class HTTPClient

  String tempData,humData, station, postData;
  
  float t = dht.readTemperature(); //Read Temperature
  float h = dht.readHumidity();   //Read Humidity
  
  // Check if any reads failed and exit early
  if (isnan(h) || isnan(t)) 
    {
    return;
    }
  
  tempData = String(t);   //String to interger conversion
  humData = String(h);
  station = "DHT11";

  //Post Data
  postData = "temp=" + tempData + "&hum=" +humData + "&station=" + station ;
  
  http.begin("");               															                              //Specify request destination
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");                      //Specify content-type header

  int httpCode = http.POST(postData);   //Send the request
  String payload = http.getString();    //Get the response payload
  
  Serial.print("Temperature Reading: ");
  Serial.println(t);                          //Print the Temperature
  Serial.print("Humidity Reading: ");
  Serial.println(h);                          //Print the Humidity
  Serial.println(httpCode);                   //Print HTTP return code
  Serial.println(payload);                    //Print request response payload

  http.end();  //Close connection
  
  delay(900000);  //Post Data every 15 mins
}
