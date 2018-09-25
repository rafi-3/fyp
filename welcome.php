<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
 
<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <p>
        <a href="resetpassword.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>
-->

<!DOCTYPE html>
<html>
<title>KomplenBiskita</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
 /*colour*/
.w3-theme {color:#fff !important; background-color:#009e74 !important}
body {font-family: Arial;}

/* Style the tab */
.tab {
    overflow: hidden;
    /*border: 1px solid #ccc;*/
    background-color: #009e74;
}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
   /* border: 1px solid #ccc;*/
    border-top: none;
}
</style>

<body>
<div class="w3-top">
  <!-- <div class="w3-bar w3-theme">
    <p><img src="img/smallheading(W).png" width="20%"></p>
    <p class="w3-bar-item w3-button w3-right"><i class="material-icons">person</i></p>
  </div> -->
  <div class="w3-bar w3-theme">
    <a href="welcome.php" ><img src="img/smallheading(W).png" width="20%"></a>
    <div class="w3-dropdown-hover w3-right">
      <button class="w3-button"><i class="material-icons">person</i></button>
        <div class="w3-dropdown-content w3-bar-block w3-border" style="right:0">
          <p>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>!</p>
          <a href="resetpassword.php" class="w3-bar-item w3-button">Reset password</a>
          <a href="logout.php" class="w3-bar-item w3-button w3-theme">Logout</a>
          <p>version 0.2(db)</p>
        </div>
    </div>
  </div>
</div>

<br><br>

<div class="tab">
        <button class="tablinks" onclick="openCity(event, 'WaterWorks')" id="defaultOpen">Water Works & Drain</button>
        <button class="tablinks" onclick="openCity(event, 'AnimalPest')">Animal & Pest</button>
        <button class="tablinks" onclick="openCity(event, 'RoadFootpath')">Road & Footpath</button>
        <button class="tablinks" onclick="openCity(event, 'EnvironmentCleanliness')">Environment & Cleanliness</button>
        <button class="tablinks" onclick="openCity(event, 'TreesGreenery')">Trees & Greenery</button>
        <button class="tablinks" onclick="openCity(event, 'OtherComment')">Other & Comment</button>
      </div>
      <!-- New! -->
      <div id="WaterWorks" class="tabcontent">
        <h3>Water Works & Drain</h3>
            <table class="w3-table w3-striped">
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Location</th>
                <th>More Details</th>
              </tr>
              <tr>
                <td>Jack</td>
                <td>Paip pacah pancut pancut</td>
                <td>Muara</td>
                <td><a href="">></a></td>
              </tr>
              <tr>
                <td>Eve</td>
                <td>Aing kamah</td>
                <td>Sg.7</td>
                <td><a href="">></a></td>
              </tr>
              <tr>
                <td>Adam Sandler</td>
                <td>Paip bocor</td>
                <td>Masjid Kapok</td>
                <td><a href="">></a></td>
              </tr>
          </table>
      </div>

      <div id="AnimalPest" class="tabcontent">
        <h3>Animal & Pest</h3>
            <table class="w3-table w3-striped">
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Location</th>
                <th>More Details</th>
              </tr>
              <tr>
                <td>Jill</td>
                <td>babi hutan makan ubi</td>
                <td>Muara</td>
                <td><a href="">></a></td>
              </tr>
              <tr>
                <td>Eve</td>
                <td>Anjing menyalak tangah malam</td>
                <td>Sg.7</td>
                <td><a href="">></a></td>
              </tr>
              <tr>
                <td>Adam</td>
                <td>tikus berkeliaran</td>
                <td>Masjid Kapok</td>
                <td><a href="">></a></td>
              </tr>
          </table>
      </div>

      <div id="RoadFootpath" class="tabcontent">
        <h3>Road & Footpath</h3>
          <table class="w3-table w3-striped">
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Location</th>
                <th>More Details</th>
              </tr>
          </table>
      </div>

      <div id="EnvironmentCleanliness" class="tabcontent">
        <h3>Water Works & Drain</h3>
          <table class="w3-table w3-striped">
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Location</th>
                <th>More Details</th>
              </tr>
          </table>
      </div>

      <div id="TreesGreenery" class="tabcontent">
        <h3>Animal & Pest</h3>
          <table class="w3-table w3-striped">
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Location</th>
                <th>More Details</th>
              </tr>
          </table>
      </div>

      <div id="OtherComment" class="tabcontent">
        <h3>Road & Footpath</h3>
          <table class="w3-table w3-striped">
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Location</th>
                <th>More Details</th>
              </tr>
          </table>
      </div>



<script>
function openLink(evt, animName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
     tablinks[i].className = tablinks[i].className.replace(" w3-white", "");
  }
  document.getElementById(animName).style.display = "block";
  evt.currentTarget.className += " w3-white";
}

function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

</body>
</html>
