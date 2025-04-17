<?php
include 'dbconn.php'; // Ensure this file has a valid `$conn` variable for database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve input data safely
    $Email = isset($_POST['Email']) ? trim($_POST['Email']) : null;
    $Password = isset($_POST['Password']) ? trim($_POST['Password']) : null;

    // Validate inputs
    if (empty($Email) || empty($Password)) {
        header("location:imaggall.html");
    }

    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    try {
        // Prepare the SQL query
        $stmt = $conn->prepare("SELECT * FROM signin1 WHERE Email = ?");
        if (!$stmt) {
            throw new Exception("Failed to prepare SQL statement: " . $conn->error);
        }

        // Bind parameters and execute
        $stmt->bind_param("s", $Email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a matching user is found
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($Password, $user['Password'])) {
                // Start a session and store user data
                session_start();
                $_SESSION['user_id'] = $user['id']; // Replace 'id' with your table's primary key column name
                $_SESSION['user_name'] = $user['Name'];
                $_SESSION['user_email'] = $user['Email'];

                // Redirect on success
                header("Location: imaggall.html");
                exit();
            } else {
                die("Incorrect password. Please try again.");
            }
        } else {
            die("No account found with this email. Please register first.");
        }
    } catch (Exception $e) {
        // Handle exceptions gracefully
        die("An error occurred: " . $e->getMessage());
    } finally {
        // Close statement and connection
        if (isset($stmt)) $stmt->close();
        $conn->close();
    }
} else {
    // If the script is accessed without a POST request
    die("Invalid request method.");
}
?>
