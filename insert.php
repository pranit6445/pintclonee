<?php
session_start(); // Start session

include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize input
    $Name = trim($_POST['Name']);
    $Email = trim($_POST['Email']);
    $Birth_Date = trim($_POST['Birth_Date']);
    $Password = trim($_POST['Password']);

    // Validate input
    if (empty($Name) || empty($Email) || empty($Birth_Date) || empty($Password)) {
        die("All fields are required.");
    }

    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    $Birth_Date = date('Y-m-d', strtotime($Birth_Date));

    // Check for duplicate Email
    $checkEmail = $conn->prepare("SELECT * FROM signin1 WHERE Email = ?");
    $checkEmail->bind_param("s", $Email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if ($result->num_rows > 0) {
        die("This email is already registered.");
    } else {
        // Hash the password
        $hashedPassword = password_hash($Password, PASSWORD_BCRYPT);

        // Insert data using prepared statement
        $stmt = $conn->prepare("INSERT INTO signin1 (Name, Email, Birth_Date, Password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $Name, $Email, $Birth_Date, $hashedPassword);

        if ($stmt->execute()) {
            // **Store Name & Email in Session**
            $_SESSION['user_name'] = $Name;
            $_SESSION['user_email'] = $Email;

            // Redirect to Profile Page
            header("Location: .html");
            exit();
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }
        $stmt->close();
    }
    $checkEmail->close();
}

$conn->close();
?>
