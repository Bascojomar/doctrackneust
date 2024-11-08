<?php
// Start the session

// Check if a unique session ID has already been set
if (!isset($_SESSION['session_id'])) {
    // Generate a unique session ID and store it in the session
    $_SESSION['session_id'] = session_id();
}

// Set a persistent cookie with a unique ID if it doesn't exist
if (!isset($_COOKIE['persistent_id'])) {
    $persistentId = uniqid('', true);
    setcookie('persistent_id', $persistentId, time() + (86400 * 365), "/"); // 1 year expiry
} else {
    // Retrieve the persistent ID from the cookie
    $persistentId = $_COOKIE['persistent_id'];
}

// Retrieve the session ID
$sessionId = $_SESSION['session_id'];

// Display both IDs

$sessionCode = $sessionId . $persistentId;


?>
