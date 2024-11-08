<?php
 if(isset($_GET['removeUser'])) {
    echo '<script>
    let timerInterval;
Swal.fire({
  title: "User remove successfully ",
 
  timer: 1000,
  timerProgressBar: true,
  didOpen: () => {
    Swal.showLoading();
    const timer = Swal.getPopup().querySelector("b");
    timerInterval = setInterval(() => {
      timer.textContent = `${Swal.getTimerLeft()}`;
    }, 100);
  },
  willClose: () => {
    clearInterval(timerInterval);
  }
}).then((result) => {
  /* Read more about handling dismissals below */
  if (result.dismiss === Swal.DismissReason.timer) {
    console.log("I was closed by the timer");
  }
});
    
    </script>';
} 
if(isset($_GET['addeduser'])) {
    echo '<script>
    Swal.fire({
        title: "Good job!",
        text: "Successfully added user",
        icon: "success"
      });

    </script>';

}
if(isset($_GET['updateUsers'])) {
    echo '<script>
    Swal.fire({
        title: "Good job!",
        text: "Successfully update user",
        icon: "success"
      });

    </script>';

}
if(isset($_GET['notmatch'])) {
    echo '<script>
    Swal.fire({
        title: "Error",
        text: "New password and Comfirm password not Match",
        icon: "error"
      });

    </script>';

}
if(isset($_GET['oldpass'])) {
    echo '<script>
    Swal.fire({
        title: "Error",
        text: "Old password not match",
        icon: "error"
      });

    </script>';

}
if(isset($_GET['updatepassword'])) {
    echo '<script>
    Swal.fire({
        title: "Good job!",
        text: "Successfully update password",
        icon: "success"
      });

    </script>';

}
?>