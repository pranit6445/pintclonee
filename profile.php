<?php
session_start(); // Start session

// Redirect to login if not signed in
if (!isset($_SESSION['user_name'])) {
    header("Location: login.html");
    exit();
}

include('dbconn.php'); // Include database connection

// Fetch session values
$username = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinterest Profile Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="profilstyle.css">
</head>
<body>
    <div class="profile-container">
        <div class="header">
            <div class="profile-pic" style="background-image: url('https://via.placeholder.com/100');"></div>
            <div class="profile-info">
                <h1 id="username"><?php echo htmlspecialchars($username); ?></h1>
                <p id="name"><?php echo htmlspecialchars($username); ?></p>
                <div class="stats">
                    <span><b id="followers">0</b> Followers</span>
                    <span><b id="following">0</b> Following</span>
                </div>
            </div>
            <div class="actions">
                <button class="button edit-button">Edit Profile</button>
                <a href="logout.php" class="button logout-button">Logout</a>
            </div>
        </div>
    </div>

    <script src="profile.js"></script>
</body>
</html>
