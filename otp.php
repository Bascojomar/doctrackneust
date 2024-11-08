<?php
include "backend/database.php";
session_start();
if(!isset($_SESSION['user_id']))
{
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>eDoctrack | Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .bg-login-images {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 40px;
            padding-left: 90px;
        }

        .bg-login-images .center-image {
            max-width: 70%;
            height: auto;
        }
        body {
            background-color: #f4f4f4;
        }

        .otp-input {
            width: 50px;
            height: 50px;
            font-size: 24px;
            text-align: center;
        }
        .is-invalid {
            border: 1px solid red; /* Red border */
        }
        .small-timer {
            font-size: 12px;
        }.centered-button {
            display: flex;
            justify-content: center;
        }
    </style>
    <script>
  // Check if session storage exists
  if (window.sessionStorage) {
    // Check if the page was refreshed
    if (!sessionStorage.getItem("loaded")) {
      // Set a flag indicating that the page was loaded
      sessionStorage.setItem("loaded", "true");
    } else {
      // Remove the flag to prevent redirecting on next refresh
      sessionStorage.removeItem("loaded");
      // Redirect to a new page
      window.location.href = "backend/session.php";
    }
  }
</script>

  <script>
    
window.onload = function() {
    // Set the duration of the timer in milliseconds (e.g., 5000 milliseconds = 5 seconds)
    var duration = 60000; // 5 seconds

    // Function to update the timer display
    function updateTimerDisplay(remainingTime) {
    var minutes = Math.floor(remainingTime / 60000); // Convert milliseconds to minutes
    var seconds = Math.ceil((remainingTime % 60000) / 1000); // Convert remaining milliseconds to seconds

    // Format the time as "m:ss" or "mm:ss"
    var formattedTime = minutes + ":" + (seconds < 10 ? "0" : "") + seconds;

    document.getElementById('timer').textContent = formattedTime;
}
    // Function to redirect the user to another page
    function redirectToPage() {
        window.location.href = "backEnd/session.php"; // Change "another-page.html" to the desired URL
    }

    // Start the timer
    var remainingTime = duration;
    updateTimerDisplay(remainingTime);
    var timerInterval = setInterval(function() {
        remainingTime -= 1000;
        updateTimerDisplay(remainingTime);
        if (remainingTime <= 0) {
            clearInterval(timerInterval);
            redirectToPage();
        }
    }, 1000);
};
</script>
</head>

<body class="bg-gradient-primary">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-images">
                            <img src="img/neustlogo.png" class="center-image">
                        </div>
                        <div class="col-lg-6">
                            <br>
                            <h2 class="text-center">Enter OTP</h2>
                            <p class="text-center">Please enter the OTP sent to your email.</p>
                            <form id="otpForm" action="backEnd/next_page.php" method="POST">
                                <div class="form-row justify-content-center">
                                    <input type="text" name="id" value="<?php echo $_SESSION['user_id']; ?>" hidden >
                                    <input type="text" class="form-control otp-input" maxlength="1" id="digit1" name="sub1" oninput="moveToNext(this, 'digit2')" autofocus>
                                    <input type="text" class="form-control otp-input" maxlength="1" id="digit2" name="sub2" oninput="moveToNext(this, 'digit3')">
                                    <input type="text" class="form-control otp-input" maxlength="1" id="digit3" name="sub3" oninput="moveToNext(this, 'digit4')">
                                    <input type="text" class="form-control otp-input" maxlength="1" id="digit4" name="sub4" oninput="moveToNext(this, 'digit5')">
                                    <input type="text" class="form-control otp-input" maxlength="1" id="digit5" name="sub5" oninput="moveToNext(this, 'digit6')">
                                    <input type="text" class="form-control otp-input" maxlength="1" id="digit6" name="sub6">
                                </div>
                                <div class="form-group centered-button mt-3">
                                    <button class="btn btn-primary btn-user btn-sm" type="submit" name="sub" value="sub">Send Email</button>
                                </div>
                            </form>
                            <p class="text-center small-timer"><span id="timer"></span>:00</p>
                            <p style="color: red; text-align: center; font-style: italic; font-size: 8pt;">
                                Note: Press F5 and Refresh, the OTP will be end of session
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

</body>

</html>
