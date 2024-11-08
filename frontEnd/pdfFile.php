<?php
session_start();

include "../backEnd/database.php";
include "../backEnd/function.php";

// Step 2: Retrieve the file path of the PDF file from the database based on an ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute SQL query to fetch the file path from the database
    $sql = 'SELECT newUpload FROM documenttransac WHERE docu_id='.$id;
    $result = mysqli_query($conn, $sql);
    
    // Check if a record is found
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        echo $row[0];
        // Step 3: Output the PDF file with appropriate headers
        $pdfFilePath = '../pdf/'.$row['newUpload'];
        header("Content-type: application/pdf");
        readfile($pdfFilePath);
    } else {
        echo "PDF file not found for ID: $id";
    }
} else {
    echo "No ID specified!";
}
                        
// Close connection
$stmt->close();
//  $conn->close();
?>
