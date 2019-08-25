<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="refresh" content="300">
		<meta name="viewport" content="width=device-width, initial-scale=0.5">
		<link rel="stylesheet" type="text/css" href="css/view.css">
		<link rel="stylesheet" type="text/css" href="css/display.css">
		<script src="http://d3js.org/d3.v3.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Farro&display=swap" rel="stylesheet"> 
</head>

<body bgcolor="#f2f2f2">
	
	<section id = "Banner">
 		<div class="container">
  			<img src="img/banner.jpg">
  			<div class="header">Welcome to IoT Temperature </div>
  			<div class="header2">& Humidity Monitor</div>
		</div>
	</section>	 
 

 	<section id = "monitor-table">
		<div>
			<?php
    		//Connect to database and create table
    		$servername = "localhost";
    		$username = "root";
    		$password = "";
    		$dbname = "DHT11db";
 
    		// Create connection
    		$conn = new mysqli($servername, $username, $password, $dbname);
    		// Check connection
    		if ($conn->connect_error) {
        		die("Database Connection failed: " . $conn->connect_error);
        		echo "<a href='install.php'>If first time running click here to install database</a>";
    		}

    		$sql = "SELECT * FROM DHT11logs ORDER BY id DESC ";
    		if ($result=mysqli_query($conn,$sql))
    			{
      			// Fetch one and one row
      			echo "<TABLE id='data_table'>";
      			echo "<TR><TH>Sr.No.</TH><TH>Sensor</TH><TH>Temperature (℃)</TH><TH>Humidity (%)</TH><TH>Date</TH><TH>Time</TH></TR>";
      				while ($row=mysqli_fetch_row($result))
      					{
        				echo "<TR>";
        				echo "<TD>".$row[0]."</TD>";
        				echo "<TD>".$row[1]."</TD>";
        				echo "<TD>".$row[2]."</TD>";
              			echo "<TD>".$row[3]."</TD>";
        				//echo "<TD>".$row[3]."</TD>";
        				echo "<TD>".$row[5]."</TD>";
        				echo "<TD>".$row[6]."</TD>";
        				echo "</TR>";
      					}
      			echo "</TABLE>";
      				// Free result set
      			mysqli_free_result($result);
    			}
 
   	 			mysqli_close($conn);
			?>
		</div>
	</section>
	

	<section id = "monitor-graphs">
		
		<div id="monitor_container">
			<div id="temp_chart"></div>
			<script src="js/temp_script.js"></script>
  			<div id="hum_chart"></div>
  			<script src="js/hum_script.js"></script>
  		</div>
  		<svg width="1903" height="172" style="background: #f2f2f2"></svg>
	</section>	
	
	
	<section id = "About">
		<div class="footer">
  			<img src="img/banner.jpg">
  			<div class="header3">About the project </div>
  			<div class="about_paragraph">In this project sensor data are logged, saved and visualized. DHT11 sensor is connected to ESP8266. The microcontroller is connected to wifi and sends data to the local server using the http POST method. Data is then saved to MYSQL database. PHP scripts retrieve the data from the database and create json files. Those json files are read from js scripts that plots the data using the D3 library.<br> <br>Project made by Siladrok with the help of online guides. <a href="https://circuits4you.com/2018/03/10/esp8266-nodemcu-post-request-data-to-website/"><b>Circuits4you.com guide</b></a> <br>
  			 <a href="https://github.com/Siladrok/Processing3_GUI_DHT11"><b>Click here</b> to visit this project's Github page!</a> </div>
  			
		</div>	
	</section>


</body>
</html>