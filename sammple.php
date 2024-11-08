<?php
// Start the session
session_start();

// Set a timeout period in seconds (e.g., 300 seconds = 5 minutes)
$timeout_duration = 60;

// Check if the last activity timestamp is set
if (isset($_SESSION['LAST_ACTIVITY'])) {
    // Calculate the session's lifetime
    $elapsed_time = time() - $_SESSION['LAST_ACTIVITY'];
    // If the session has expired, destroy it and redirect to the login page
    if ($elapsed_time > $timeout_duration) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }
}

// Update the last activity timestamp
$_SESSION['LAST_ACTIVITY'] = time();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <title>Auto Logout Example</title>
    <script>
        let logoutTimer;
        let warningTimer;
        const logoutTime = 10000; // 5 minutes in milliseconds
        const warningTime = 9000; // 4 minutes in milliseconds

        function resetLogoutTimer() {
            clearTimeout(logoutTimer);
            clearTimeout(warningTimer);
            warningTimer = setTimeout(showWarning, warningTime);
            logoutTimer = setTimeout(logoutUser, logoutTime);
        }

        function showWarning() {
            Swal.fire({
  title: "Good job!",
  text: "You clicked the button!",
  icon: "success"
});
        }

        function logoutUser() {
            alert("You have been logged out due to inactivity.");
            window.location.href = 'logout.php'; // Redirect to logout URL
        }

        document.onload = resetLogoutTimer;
        document.onmousemove = resetLogoutTimer;
        document.onkeypress = resetLogoutTimer;
    </script>
</head>
<body>
    <h1>Welcome to the Auto Logout Example</h1>
    <p>Interact with the page to stay logged in.</p>
</body>
</html>
