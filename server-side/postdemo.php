<?php
//Creates new record as per request
    //Connect to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dht11db";
 
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }
 
    //Get current date and time
    date_default_timezone_set('Europe/Athens');
    $d = date("Y-m-d");
    //echo " Date:".$d."<BR>";
    $t = date("H:i:s");
 
    if((!empty($_POST['temp'])) && (!empty($_POST['hum'])) && (!empty($_POST['station'])))
    {
    	
        $temp = $_POST['temp'];
        $hum = $_POST['hum'];
    	$station = $_POST['station'];
 
	    $sql = "INSERT INTO dht11logs (station, temp, hum, Date, Time)
		
		VALUES ('".$station."', '".$temp."', '".$hum."', '".$d."', '".$t."')";
 
		if ($conn->query($sql) === TRUE) {
		    echo "OK";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
 
 
	$conn->close();
?>
