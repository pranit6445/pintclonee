<?php
// Include the database connection
include('dbconn.php');

// Fetch pins from the database
$query = "SELECT * FROM content"; // Query to select all pins from the content table
$result = $conn->query($query);

// Check if any pins exist
if ($result->num_rows > 0) {
    // If there are pins, loop through and display them
    $pins = [];
    while ($row = $result->fetch_assoc()) {
        $pins[] = $row;
    }
} else {
    $pins = []; // If no pins found, set to an empty array
}

// Close the database connection
$conn->close();
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
<form>
    <div class="profile-container">
        <div class="header">
            <div class="profile-pic" style="background-image: url('https://via.placeholder.com/100');"></div>
            <div class="profile-info">
                <h1 id="username">Username</h1>
                <p id="name">Name</p>
                <div class="stats">
                    <span><b id="followers"></b> Followers</span>
                    <span><b id="following"></b> Following</span>
                </div>
            </div>
            <div class="actions">
                <button class="button edit-button" onclick="editProfile()">Edit Profile</button>
                <a href="index.html">
                    <button class="button logout-button" onclick="logout()">Logout</button>
                </a>
            </div>
        </div>

        <div class="pins-section">
            <h2>Saved Pins</h2>
            <!-- <div class="pins" id="pins">
              Dynamically generated pins will be displayed here -->
                <?php if (!empty($pins)): ?>
                    <?php foreach ($pins as $pin): ?>
                        <div class="pin-card">
                            <div class="pin-media">
                                <?php if (strpos($pin['Media'], '.mp4') !== false): ?>
                                    <video controls class="pin-media-file">
                                        <source src="<?php echo $pin['Media']; ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                <?php else: ?>
                                    <img src="<?php echo $pin['Media']; ?>" alt="Pin" class="pin-media-file">
                                <?php endif; ?>
                            </div>
                            <div class="pin-info">
                                <h3 class="pin-title"><?php echo $pin['Title']; ?></h3>
                                <p class="pin-description"><?php echo $pin['Description']; ?></p>
                                <a href="<?php echo $pin['Link']; ?>" target="_blank" class="pin-link">Visit Link</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No pins found. Upload some pins!</p>
                <?php endif; ?>
            </div>
        </div> 
    </div>
</form>

<script src="profile.js"></script>

</body>
</html>
