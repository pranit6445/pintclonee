<?php
// Include the database connection
include('dbconn.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $Title = trim($_POST['Title'] ?? '');
    $Description = trim($_POST['Description'] ?? '');
    $Link = trim($_POST['Link'] ?? '');
    $Media = $_FILES['Media'] ?? null;

    // Validate required fields
    if (empty($Title) || empty($Description) || empty($Link) || empty($Media['name'])) {
        echo "All fields are required.";
        exit;
    }

    // Define the upload directory
    $uploadDir = 'uploads/';
    
    // Ensure the uploads directory exists and is writable
    if (!is_dir($uploadDir) && !mkdir($uploadDir, 0777, true)) {
        echo "Failed to create uploads directory.";
        exit;
    }

    if (!is_writable($uploadDir)) {
        echo "Uploads directory is not writable.";
        exit;
    }

    // Generate a unique filename to avoid overwriting files
    $uploadFile = $uploadDir . uniqid() . '-' . basename($Media['name']);

    // Validate the file type
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'video/mp4'];
    if (!in_array($Media['type'], $allowedTypes)) {
        echo "Invalid file type. Please upload a valid image or video.";
        exit;
    }

    // Move the uploaded file to the target directory
    if (!move_uploaded_file($Media['tmp_name'], $uploadFile)) {
        echo "Failed to upload file.";
        exit;
    }

    // Insert the form data into the database using prepared statements
    $stmt = $conn->prepare("INSERT INTO content (Title, Description, Link, Media) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        echo "Database error: " . $conn->error;
        exit;
    }

    $stmt->bind_param("ssss", $Title, $Description, $Link, $uploadFile);

    // Execute the query and check the result
    if ($stmt->execute()) {
        echo "Form submitted successfully! Pin created and file uploaded to: " . htmlspecialchars($uploadFile);
        header("Location: profil.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
