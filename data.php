<?php
require 'connect.php';

//Create arrays of random data

$temperatures = array();
$temperature_averages = array();
$date_times = array();

for ($x = 1; $x <= 60; $x++) {
    $random = rand(-20, 90);
    array_push($temperatures, $random);
    $date = date("H:i:s");
    $time = strtotime($date);
    $time = $time + ($x*60);
    $date = date("H:i:s", $time);
    array_push($date_times, $date);
}

for ($y = 0; $y <= 11; $y++) {
    $hour_temperature = array();
    for ($x = 0; $x <= 60; $x++) {
        $random = rand(-20, 90);
        array_push($hour_temperature, $random);
    }
    $average = round(array_sum($hour_temperature) / count($hour_temperature), 1);
    array_push($temperature_averages, $average);
}

//Create querys

$query = 'INSERT INTO temperature (`date_time`, `temperature`) VALUES ';
$query_parts = array();
for ($x = 0; $x < count($date_times); $x++) {
    $query_parts[] = "('" . $date_times[$x] . "', '" . $temperatures[$x] . "')";
}
$query .= implode(',', $query_parts);

$query2 = "INSERT INTO past_hours_averages (`average`) VALUES ";

$query_parts2 = array();
for ($x = 0; $x < count($temperature_averages); $x++) {
    $query_parts2[] = "('" . $temperature_averages[$x] . "')";
}
$query2 .= implode(',', $query_parts2);

//Create truncate table querys

$empty = 'TRUNCATE TABLE temperature';
$empty_average = 'TRUNCATE TABLE past_hours_averages';

//open connection to mysql db
$connection = mysqli_connect("localhost", "root", "", "temperature") or die("Error " . mysqli_error($connection));

//Truncate old data and insert new data

$truncate = mysqli_query($connection, $empty) or die("Error in Truncating " . mysqli_error($connection));
$truncate_average = mysqli_query($connection, $empty_average) or die("Error in Truncating " . mysqli_error($connection));
$insert = mysqli_query($connection, $query) or die("Error in Inserting " . mysqli_error($connection));
$insert2 = mysqli_query($connection, $query2) or die("Error in Inserting " . mysqli_error($connection));

//Fetch new data from database
$sql = "SELECT date_time FROM temperature";
$result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

$sql2 = "SELECT temperature FROM temperature";
$result2 = mysqli_query($connection, $sql2) or die("Error in Selecting " . mysqli_error($connection));

$sql3 = "SELECT average FROM past_hours_averages";
$result3 = mysqli_query($connection, $sql3) or die("Error in Selecting " . mysqli_error($connection));

//create an array
$emparray = array();
while($row =mysqli_fetch_assoc($result))
{
    $emparray[] = $row['date_time'];
}
$data = json_encode($emparray);

//create an array
$emparray2 = array();
while($row2 =mysqli_fetch_assoc($result2))
{
    $emparray2[] = (int)$row2['temperature'];
}
$data2 = json_encode($emparray2);

//create an array
$emparray3 = array();
while($row3 =mysqli_fetch_assoc($result3))
{
    $emparray3[] = $row3['average'];
}
$data3 = json_encode($emparray3);

//close the db connection
mysqli_close($connection);

?>

