<?php
// Assuming you have already established a database connection
include "../backEnd/database.php";
include "../backEnd/function.php";
// Perform the query to fetch user data including usernames and profile picture paths
$query = "SELECT fullname, pic FROM users";
$result = mysqli_query($connection, $query);

if (!$result) {
    // Handle query error
    die('Query error: ' . mysqli_error($connection));
}

// Fetch user data into an array
$users = array();
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

// Free result set
mysqli_free_result($result);

// Close connection
mysqli_close($connection);

// Send the user data as JSON
header('Content-Type: application/json');
echo json_encode($users);
?>
