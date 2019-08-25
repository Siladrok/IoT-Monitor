# IoT Temperature & Humidity Monitor

In this project sensor data are logged, saved to a database and visualized. 

DHT11 sensor is connected to ESP8266. The microcontroller is connected to wifi and sends data to the local server using the http POST method. Data is then saved to MySQL database. PHP scripts retrieve the data from the database and create json files. Those json files are read from js scripts that plot the data using the D3 library.


![IoT Monitor Demo](demo/demo.gif)

Before making the project read this guide: 

https://circuits4you.com/2018/03/10/esp8266-nodemcu-post-request-data-to-website/

# Description:

install.php:  Installs the database (needs to run once)

postdemo.php: Handles the post request made by the ESP module

home.php:     Is the home page

temp2json:    Takes data from database formats them in json

hum2json:     Takes data from database formats them in json 

temp_script:  Reads the json data and plots the temp bar graph

hum_script:   Reads the json data and plots the hum bar graph


# Steps to run this project:

1. Setup a server with Apache, PHP, and MySQL, I used wamp server: http://www.wampserver.com/en/
2. Run install.php (Need to make changes to servername, username, password to each php file!)
3. Connect the sensor to the ESP wifi module
![Breadboard](demo/breadboard.png)
4. Modify the code with your ssid, password and post request destination (should be the localhost/postdemo.php)
5. Upload code with the Arduino IDE

If you are getting errors while trying to post data, disable your firewall or make an exception!

