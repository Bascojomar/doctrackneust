<?php

if(isset($_GET['added'])) {
    echo '<script>
    Swal.fire({
        title: "Good job!",
        text: "Successfully added signatory",
        icon: "success"
      });

    </script>';

}

if(isset($_GET['updated'])) {
    echo '<script>
    Swal.fire({
        title: "Good job!",
        text: "Successfully updated signatory",
        icon: "success"
      });

    </script>';

}

?>