<?php
    //Db info
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "DHT11db";

    
    $rows_req = 45;         //Number of rows request for the graph
    $num_col_req =2;        //Number of colums needed from each row
    $num_rows = 0;          //Number of total rows in the table
    
    //Connection to mysql
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    //Check if there are are more rows requested than available in table
    $sql = "SELECT * FROM DHT11logs ORDER BY id DESC LIMIT 1";
    $myquery = mysqli_query($conn,$sql);
    $row = mysqli_fetch_row($myquery);
    $num_rows = $row[0];                //Checking the id of the last row to count the rows
    if($rows_req > $num_rows){
        $rows_req = $num_rows;
    }

    //Connect to db and echo a json file from the last rows requested
    $sql = "SELECT * FROM DHT11logs ORDER BY id DESC LIMIT $rows_req";
    $myquery = mysqli_query($conn,$sql);

    $elements_cntr = 0;
    if ($myquery=mysqli_query($conn,$sql))
    {
        $data = array();

        //Echo "[" to start the json file - format is strict        
        echo "[";
        while ($row = mysqli_fetch_row($myquery))
            {
            $data[]= $row[6];               //push in data[] the timestamp
            $data[]= floatval($row[2]);     //push in data[] the temperature as float
            
            //Encode them as json
            $arr = array('timestamp' => $data[$elements_cntr], 'temperature' => $data[$elements_cntr+1]);
            echo json_encode($arr);
            
            //Dont echo "," on the final element of the json file - format is strict  
            if ($elements_cntr < ($num_col_req * $rows_req)-2)
                {
                echo ",";
                }
            
            $elements_cntr = $elements_cntr + $num_col_req;
            }
    
        echo "]";

        mysqli_free_result($myquery);
    }
  
    //close connection
    mysqli_close($conn);
    





?>