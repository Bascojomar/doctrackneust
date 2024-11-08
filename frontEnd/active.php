

<style>
    

        .sidebara {
            width: 250px;
            height: 310px;
            background-color: #f4f4f4;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            right: 0;
            bottom: 0;
            display:; /* Initially hidden */
            padding: 20px;
            overflow-y: auto; /* Add vertical scroll */
            
        }
        .toggle-btn {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            position: fixed;
            bottom: 30px;  /* Position at the bottom */
            right: 10px;   /* Position at the right */
            border-radius: 5px;
            width: 200px;
        }

        .toggle-btn:hover {
            background-color: #0056b3;
        }

        .close-btn {
            background-color: #FF0000;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .close-btn:hover {
            background-color: #cc0000;
        }
        .profile-pic-container {
            position: relative; /* Ensure relative positioning for absolute positioning */
            display: inline-block; /* Ensure inline block for dimensions to work */
        }

        .profile-pic {
            width: 40px; /* Adjust size as needed */
            height: 40px; /* Adjust size as needed */
            border-radius: 50%; /* Rounded shape to create a circle */
            border: 2px solid #00FF00; /* Green border color */
            box-shadow: 0 0 0 4px rgba(0, 255, 0, 0.1); /* Green shadow effect */
        }

        .active-status {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 10px;
            height: 10px;
            background-color: #00FF00; /* Green status indicator */
            border-radius: 50%; /* Rounded shape to create a circle */
            border: 2px solid #fff; /* White border */
        }

        /* Additional styles for layout */
        .active-user {
            margin-bottom: 12px; /* Space between users */
        }

        .resize{
            margin-top: 8px;
            font-size: 12px;
        }

        .sidebara {
    /* Your existing styles */
    /* Ensure that it does not scroll */
    overflow-y: hidden;
    margin-top:-20px;
    border-radius: 4px 0px 4px 0px;
}

.cont {
    /* Set a fixed height and allow vertical scrolling */
    height: 200px; /* Adjust the height as needed */
    overflow-y: auto;
}

.x{
   position: relative;
   right: -35px;
   border: none;
   border-radius: 20px;
   font-size: 20px;
}

.online{
    font-size: 15px;
}
    </style>


<div class="containera">
    <button class="toggle-btn" onclick="toggleSidebar()">Online Users</button>
    <div class="sidebara" id="sidebar">
        <button class="refresh-btn text-center" onclick="refreshContent()">
            <i class="fas fa-sync-alt icon"></i> Refresh Content
        </button>
        <button class="x" onclick="toggleSidebar()"><i class="fa fa-caret-down" aria-hidden="true"></i></button> 

            <?php
                $sql = "SELECT COUNT(*) AS online_user_count
                        FROM users
                        WHERE is_online = 1 AND dateDeleted IS NULL";

                $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $onlineUserCount = $row['online_user_count'];
                    echo '<h5 class="my-3 online">Online Users - ' . $onlineUserCount .'</h5>';
            ?>

        <hr class="sidebar-divider">
        <div class="cont" id="cont">
            <div class="active-user-container" id="active-user-container">
                <?php
                $sql = "SELECT * FROM users where is_online = 1 and dateDeleted is null";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '
                        <div class="active-user">
                            <div class="row">
                                <div class="col-3"> 
                                    <div class="profile-pic-container">
                                        <img src="../img/profile/'.$row['pic'].'" alt="Profile Picture" class="profile-pic">
                                        <span class="active-status"></span>
                                    </div>
                                </div>
                                <div class="col-9 resize"> 
                                    <div class="user-name">'.$row['fullname'].'</div>
                                </div>
                            </div>
                        </div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    </div>


<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const btn = document.querySelector('.toggle-btn');
        
        if (sidebar.style.display === 'none' || sidebar.style.display === '') {
            sidebar.style.display = 'block';
            btn.textContent = 'Close';
        } else {
            sidebar.style.display = 'none';
            btn.textContent = 'Online Users';
        }
    }

    // Initialize the sidebar as hidden
    window.onload = () => {
        document.getElementById('sidebar').style.display = 'none';
    };

    
    // Function to refresh the content of a specific div
    function refreshContent() {
        const contentDiv = document.getElementById('active-user-container');
        
        // Simulated content update (replace with actual dynamic content)
        const updatedContent = `
             <?php

$sql = "SELECT * FROM users where is_online = 1  and dateDeleted is null  ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {

         echo '
                        <div class="active-user">
                            <div class="row">
                                <div class="col-3"> 
                                    <div class="profile-pic-container">
                                        <img src="../img/profile/'.$row['pic'].'" alt="Profile Picture" class="profile-pic">
                                        <span class="active-status"></span>
                                    </div>
                                </div>
                                <div class="col-9 resize"> 
                                    <div class="user-name">'.$row['fullname'].'</div>
                                </div>
                            </div>
                        </div>';

    }
}


    ?>
        `;
        
        // Update the innerHTML of the div with the new content
        contentDiv.innerHTML = updatedContent;
    }

</script>
