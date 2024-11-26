<?php
/*
| In order to insert data into the website, one should do so using this format:
| /WebsiteMain/arduino/api.php?sensorCode=CODE_HERE&waterTemp=E&airTemp=X&humidity=A&co2=M&ph=P&nutrient=LE
| localhost/arduino/api.php?sensorCode=CODE_HERE&waterTemp=E&airTemp=X&humidity=A&co2=M&ph=P&nutrient=LE
*/


# Attempt to retrieve $_GET data from the arduino.
$sensorCode = $_GET['sensorCode'] ?? null;
$waterTemp = $_GET['waterTemp'] ?? null;
$airTemp = $_GET['airTemp'] ?? null;
$humidity = $_GET['humidity'] ?? null;
$co2 = $_GET['co2'] ?? null;
$ph = $_GET['ph'] ?? null;
$nutrient = $_GET['nutrient'] ??  null;


# Debug
echo $waterTemp.$airTemp.$humidity.$co2.$ph.$nutrient;


# Checker. If ALL data is null, then do not insert.
if(is_null($waterTemp) and is_null($airTemp) and is_null($humidity) and is_null($co2) and is_null($ph) and is_null($nutrient)) {
    die("WARNING - No data inserted!");
}


# Insert data into database.
require_once __DIR__.'/../database/DatabaseConnection.php';
require_once __DIR__.'/../database/config.php';

$connection = new DatabaseConnection(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_SCHEMA);

$query = "
    INSERT INTO master 
    VALUES(
           CURTIME(),
           "."'"."$sensorCode"."'".",
           "."'"."$waterTemp"."'".", 
           "."'"."$airTemp"."'".", 
           "."'"."$humidity"."'".", 
           "."'"."$co2"."'".", 
           "."'"."$ph"."'".", 
           "."'"."$nutrient"."'"."
    );
";

echo '<br><br>';
echo $query;

$connection->executeUpdate($query);

$connection->close();