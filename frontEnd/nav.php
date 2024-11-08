<?php
if (isset($_SESSION['user_id'])) {
    // Retrieve user data from the database
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE user_id = '$user_id'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user_data = $result->fetch_assoc();

        $accesstype = $user_data['accesstype'];

        $office_id = OfficeName($user_data['offices']);



        if($accesstype == 1){
            echo '  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar"
            style="background: #17399D;">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="home">
    <div class="sidebar-brand-icon">
        <img src="../img/neustlogo.png" style="height:45px;">
    </div>
    <div class="sidebar-brand-text mx-3">
    <img src="../img/doctrack.png" style="height:25px;">
    </div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="home">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard </span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
   Document
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Document</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Document Component:</h6>
            <a class="collapse-item" href="document">New Document</a>
            <a class="collapse-item" href="receivedDoc">Document Recieved</a>
            <a class="collapse-item" href="doneDocu">Done Document</a>
        </div>
    </div>
</li>   
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Setting</span>
    </a>
    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Document Setting:</h6>
            <a class="collapse-item" href="cards.html">Archived Title</a>
            <a class="collapse-item" href="doctype">Document Type</a>
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Records</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Document Record:</h6>
            <a class="collapse-item" href="recordDocument">Pending Document</a>
            <a class="collapse-item" href="recordOnprocess">On Process Document</a>
            <a class="collapse-item" href="recordArchive">Released Document</a>

        </div>
    </div>
</li>
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Setting
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwoS"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Setup</span>
    </a>
    <div id="collapseTwoS" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Setting Components:</h6>
            <a class="collapse-item" href="users">User</a>
            <a class="collapse-item" href="campus">Campus</a>
            <a class="collapse-item" href="offices">Offices</a>
            <a class="collapse-item" href="cards.html">Access</a>
            <a class="collapse-item" href="officesignatory">Office Signatory</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->


</ul>
 ';
        }
        elseif($accesstype == 4){
            echo '<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" 
            style="background: #17399D;">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="home">
    <div class="sidebar-brand-icon">
        <img src="../img/neustlogo.png" style="height:45px;">
    </div>
    <div class="sidebar-brand-text mx-3">
    <img src="../img/doctrack.png" style="height:25px;">
    </div>
</a> 

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="home">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
   Document
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Document</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Document Component:</h6>
            <a class="collapse-item" href="document">New Document</a>
            <a class="collapse-item" href="receivedDoc">Document Recieved</a>
            <a class="collapse-item" href="doneDocu">Done Document</a>
        </div>
    </div>
</li>

';
if($office_id == 'President Office'){
echo'

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Announcement</span>
    </a>
    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Document Component:</h6>
            <a class="collapse-item" href="createAnn">Create Attachment</a>
            <a class="collapse-item" href="viewAnn">View Attachment</a>
            <a class="collapse-item" href="releaseAnn">Released Attachment</a>
        </div>
    </div>
</li>';
}

if($office_id == 'Procurment Offices'){
echo'

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Procure</span>
    </a>
    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Document Component:</h6>
            <a class="collapse-item" href="createAnn">Create PR</a>
            <a class="collapse-item" href="viewAnn">View Product</a>
        </div>
    </div>
</li>';

}
echo'



<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->


</ul>';
        } elseif ($accesstype == 6) {
            echo '  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background: #17399D;">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="home">
    <div class="sidebar-brand-icon">
        <img src="../img/neustlogo.png" style="height:45px;">
    </div>
    <div class="sidebar-brand-text mx-3">
    <img src="../img/doctrack.png" style="height:25px;">
    </div>
</a> 

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
<a class="nav-link" href="home">
<i class="fas fa-fw fa-tachometer-alt"></i>
<span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
Document
</div>


<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
aria-expanded="true" aria-controls="collapseUtilities">
<i class="fas fa-fw fa-wrench"></i>
<span>Records</span>
</a>
<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
data-parent="#accordionSidebar">
<div class="bg-white py-2 collapse-inner rounded">
    <h6 class="collapse-header">Document Record:</h6>
    <a class="collapse-item" href="recordDocument">Pending Document</a>
            <a class="collapse-item" href="recordOnprocess">On Process Document</a>
            <a class="collapse-item" href="recordArchive">Released Document</a>

</div>
</div>
</li>
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
Setting
</div>



<!-- Divider -->

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
<button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->


</ul>
';
        }
        elseif ($accesstype == 2 ) {
            echo '  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="home">
    <div class="sidebar-brand-icon">
        <img src="../img/neustlogo.png" style="height:45px;">
    </div>
    <div class="sidebar-brand-text mx-3">
    <img src="../img/doctrack.png" style="height:25px;">
    </div>
</a> 

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
<a class="nav-link" href="home">
<i class="fas fa-fw fa-tachometer-alt"></i>
<span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
Document
</div>


<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
aria-expanded="true" aria-controls="collapseUtilities">
<i class="fas fa-fw fa-wrench"></i>
<span>Records</span>
</a>
<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
data-parent="#accordionSidebar">
<div class="bg-white py-2 collapse-inner rounded">
    <h6 class="collapse-header">Document Record:</h6>
    <a class="collapse-item" href="recordDocument">Pending Document</a>
            <a class="collapse-item" href="recordOnprocess">On Process Document</a>
            <a class="collapse-item" href="recordArchive">Archived Document</a>

</div>
</div>
</li>
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
Setting
</div>



<!-- Divider -->

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
<button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->


</ul>
';
        }
       
    }
}

?>