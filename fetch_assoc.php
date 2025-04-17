<?php
// Include the database connection
include('dbconn.php');

// SQL query to fetch all pins from the 'content' table
$sql = "SELECT * FROM content";
$result = $conn->query($sql);

// Check if any records are found
if ($result->num_rows > 0) {
    // Loop through each record and display as a card
    while ($row = $result->fetch_assoc()) {
        // Each $row is an associative array containing 'Title', 'Description', 'Link', and 'Media'
        echo '<div class="pin-card">';
        echo '<img src="' . $row['Media'] . '" alt="Pin Image" class="pin-media">'; // Display the media (image or video)
        echo '<div class="pin-info">';
        echo '<h3 class="pin-title">' . $row['Title'] . '</h3>';
        echo '<p class="pin-description">' . $row['Description'] . '</p>';
        echo '<a href="' . $row['Link'] . '" target="_blank" class="pin-link">View Pin</a>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No pins found.";
}

// Close the database connection
$conn->close();
?>
