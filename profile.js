// Function to handle the edit profile action
function editProfile() {
    // Prompt user to edit profile information
    const username = prompt("Edit your username:");
    const name = prompt("Edit your name:");

    // Check if the user entered any new details
    if (username && name) {
        document.getElementById("username").textContent = username;
        document.getElementById("name").textContent = name;
        alert("Profile updated successfully!");
    } else {
        alert("No changes made to the profile.");
    }
}

// Function to handle the logout action
function logout() {
    // Confirm the logout action
    const confirmLogout = confirm("Are you sure you want to log out?");

    if (confirmLogout) {
        // If confirmed, you can redirect to a logout page or clear the session
        // Here we simulate a logout by redirecting to the homepage or login page.
        window.location.href = "index.html"; // Adjust this to your actual logout URL
    } else {
        // If not confirmed, do nothing
        console.log("Logout canceled.");
    }
}
document.addEventListener("DOMContentLoaded", function () {
    // Get username from local storage (assuming it's stored during login)
    const username = localStorage.getItem("username");
    const name = localStorage.getItem("name"); // If you store full name too
    const followers = localStorage.getItem("followers") || 0;
    const following = localStorage.getItem("following") || 0;

    // Check if username exists
    if (username) {
        document.getElementById("username").textContent = username;
    } else {
        document.getElementById("username").textContent = "Guest";
    }

    if (name) {
        document.getElementById("name").textContent = name;
    }

    document.getElementById("followers").textContent = followers;
    document.getElementById("following").textContent = following;
});

