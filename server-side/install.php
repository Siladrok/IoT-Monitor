<?php
//Create Data base if not exists
	$servername = "localhost";
	$username = "root";
	$password = "";

	// Create connection
	$conn = new mysqli($servername, $username, $password);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	// Create database
	$sql = "CREATE DATABASE DHT11db";
	if ($conn->query($sql) === TRUE) {
	    echo "Database created successfully";
	} else {
	    echo "Error creating database: " . $conn->error;
	}

	$conn->close();

	echo "<br>";
//Connect to database and create table
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "DHT11db";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	//Sr No, Station, Status(OK, NM, WM, ACK) Date, Time
	//1         A          NM                 12-5-18    12:15:00 am
	// sql to create table
	$sql = "CREATE TABLE DHT11logs (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	station VARCHAR(30),
	temp    VARCHAR(30),
	hum     VARCHAR(30),
	remark  VARCHAR(50),
	`Date`  DATE NULL,
	`Time`  TIME NULL, 
	`TimeStamp` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table logs created successfully";
	} else {
	    echo "Error creating table: " . $conn->error;
	}

	$conn->close();
?>
