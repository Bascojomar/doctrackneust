

<html>
    <head>
    <script>
        function navigateToDifferentPage() {
            var result = confirm("The system detect you account currently login to another device");
            if (result) {
                // Redirect to a different page if "OK" is clicked
                window.location.href = "endsession.php"; // Replace with your desired URL
            } else {
                // Do something else if "Cancel" is clicked
                window.location.href = "endsession.php"; 
            }
        }

        
       
    </script>
</body>
    </head>

<?php
include "database.php";
session_start();

//session for scode
$sc = $_SESSION['scode'];


// sessionphpverify
include "sessionverify.php";


//userId
$id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE user_id = '$id'";
$result = $conn->query($sql);



    if($result && $result->num_rows > 0){
        //swal alert
      
    $user_data = $result->fetch_assoc(); 

    //sessionCode
    $cses = $user_data['sessionCode'];




    if($cses != $sc){
        
        echo '<script>
        window.onload = navigateToDifferentPage;
    </script>';

        // $_SESSION = array();



        // // Destroy the session
        // session_destroy();
        
        // // Redirect to the login page or another appropriate page
        // header("Location: ../index.php");
    

    }
    }



?>
</html>
