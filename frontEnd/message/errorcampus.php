<?php

if(isset($_GET['addedcampus'])) {
    echo '<script>
    Swal.fire({
        title: "Good job!",
        text: "Successfully addedd campus",
        icon: "success"
      });

    </script>';

}
if(isset($_GET['updateCampus'])) {
  echo '<script>
  Swal.fire({
      title: "Good job!",
      text: "Successfully update campus",
      icon: "success"
    });

  </script>';

}
if(isset($_GET['alreadyIn'])) {
  echo '<script>
  Swal.fire({
      title: "Error",
      text: "Campus already in the database",
      icon: "error"
    });

  </script>';

}
if(isset($_GET['Alreadyname'])) {
  echo '<script>
  Swal.fire({
      title: "Error",
      text: "Campus name already in the list",
      icon: "error"
    });

  </script>';

}
if(isset($_GET['Alreadycode'])) {
  echo '<script>
  Swal.fire({
      title: "Error",
      text: "Campus code already in the list",
      icon: "error"
    });

  </script>';

}
?>