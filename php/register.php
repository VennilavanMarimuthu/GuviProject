<?php
require 'connection.php';

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$stmt = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $password);

if ($stmt->execute()) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];

    $age = date_diff(date_create($dob), date_create('today'))->y;

    $mongoDB->userDetails->insertOne([
        'userId' => $stmt->insert_id,
        'name' => $name,
        'phone' => $phone,
        'dob' => $dob,
        'age' => $age
    ]);

    echo "Registration successful";
} else {
    echo "Error: " . $stmt->error;
}
?>
