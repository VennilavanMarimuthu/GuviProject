<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$cacheKey = "user_profile_" . $user_id;

$cachedProfile = $redis->get($cacheKey);

if ($cachedProfile) {
    echo $cachedProfile;
} else {
    $userDetails = $mongoDB->userDetails->findOne(['userId' => $user_id]);

    if ($userDetails) {
        $profileData = json_encode([
            'name' => $userDetails->name,
            'username' => $_SESSION['username'],
            'phone' => $userDetails->phone,
            'dob' => $userDetails->dob,
            'age' => $userDetails->age
        ]);

        $redis->set($cacheKey, $profileData, 3600); 

        echo $profileData;
    } else {
        echo "Error retrieving profile data";
    }
}
?>
