<?php
//Database info
$servername = "oniddb.cws.oregonstate.edu";
$username = "leebran-db";
$password = "oUQk7V9tWXZH65Xd";
$dbname = "leebran-db";

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Prepare and bind
$stmt = $conn->prepare("INSERT INTO userprofiles (firstname, lastname, username, email, password) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $firstname, $lastname, $username, $email, $hashed_password);

//Set parameters and execute
$firstname = $_POST[firstname];
$lastname = $_POST[lastname];
$username = $_POST[username];
$email = $_POST[email];
$password = $_POST[password];
$hashed_password = base64_encode(hash('sha256',$password));

$stmt->execute();

//Redirect to login page after registration
header("Location: http://people.oregonstate.edu/~leebran/CS%20290%20Final%20Project/");

$stmt->close();
$conn->close();
?>