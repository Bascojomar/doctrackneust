<?php

if(isset($_GET['addedsignatory'])) {
    echo '<script>
    Swal.fire({
        title: "Good job!",
        text: "Successfully added signatory",
        icon: "success"
      });

    </script>';

}
if(isset($_GET['updatesign'])) {
  echo '<script>
  Swal.fire({
      title: "Good job!",
      text: "Successfully update",
      icon: "success"
    });

  </script>';

}
if(isset($_GET['alreadyIn'])) {
  echo '<script>
  Swal.fire({
      title: "Error",
      text: "Signatory already in the database",
      icon: "error"
    });

  </script>';

}
if(isset($_GET['xPosition'])) {
  echo '<script>
  Swal.fire({
      title: "Error",
      text: "already in the list",
      icon: "error"
    });

  </script>';

}

?>