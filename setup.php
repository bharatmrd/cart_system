<?php
$servername = "localhost";
$username = "root";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$dbname = "cart";
// Create database
$sql = "CREATE DATABASE " . $dbname;
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();
// Create table
$creattable = $sql = "CREATE TABLE item_details (
					itemno INT(16) NOT NULL, 
					quantity INT(1) NOT NULL,
					size VARCHAR(1) NOT NULL
					)";


$conn1 = new mysqli($servername, $username, $password, $dbname);

if ($conn1->query($creattable) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $conn1->error;
}
$conn1->close();
?>
