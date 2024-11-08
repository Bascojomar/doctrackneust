<?php

if(isset($_GET['addedoffices'])) {
    echo '<script>
    Swal.fire({
        title: "Good job!",
        text: "Successfully added office",
        icon: "success"
      });

    </script>';

}
if(isset($_GET['updateoffices'])) {
  echo '<script>
  Swal.fire({
      title: "Good job!",
      text: "Successfully update offices",
      icon: "success"
    });

  </script>';

}
if(isset($_GET['alreadyIn'])) {
  echo '<script>
  Swal.fire({
      title: "Error",
      text: "Office already in the database",
      icon: "error"
    });

  </script>';

}
if(isset($_GET['Alreadyname'])) {
  echo '<script>
  Swal.fire({
      title: "Error",
      text: "Office name already in the list",
      icon: "error"
    });

  </script>';

}
if(isset($_GET['Alreadycode'])) {
  echo '<script>
  Swal.fire({
      title: "Error",
      text: "Office code already in the list",
      icon: "error"
    });

  </script>';

}
?>