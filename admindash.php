<?php
session_start();
include 'db_connection.php';

// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: index.html"); // Redirect to login if not logged in
    exit();
}

// Fetch data from the signup table
$sql = "SELECT * FROM singin1";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Admin Dashboard</h1>
        <h2 class="text-xl font-semibold text-gray-600 mb-2">Total Users: <?php echo $result->num_rows; ?></h2>
        <table class="table-auto w-full bg-white shadow-lg rounded-lg">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Name</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Date Signed Up</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td class="px-4 py-2 border"><?php echo $row['id']; ?></td>
                    <td class="px-4 py-2 border"><?php echo $row['name']; ?></td>
                    <td class="px-4 py-2 border"><?php echo $row['email']; ?></td>
                    <td class="px-4 py-2 border"><?php echo $row['created_at']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
