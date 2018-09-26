<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>

<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <title>Welcome</title>-->
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">-->
<!--    <style type="text/css">-->
<!--        body{ font: 14px sans-serif; text-align: center; }-->
<!--    </style>-->
<!--</head>-->
<!--<body>-->
<!--    <div class="page-header">-->
<!--        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>-->
<!--    </div>-->
<!--    <p>-->
<!--        <a href="resetpassword.php" class="btn btn-warning">Reset Your Password</a>-->
<!--        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>-->
<!--    </p>-->
<!--</body>-->
<!--</html>-->
<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html>
<title>KomplenBiskita</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<style>
    /*colour*/
    .w3-theme {
        color: #fff !important;
        background-color: #009e74 !important
    }

    body {
        font-family: Arial;
    }

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

    .page-header h2 {
        margin-top: 0;
    }

    table tr td:last-child a {
        margin-right: 15px;
    }

</style>

<body>
    <div class="w3-top">
        <!-- <div class="w3-bar w3-theme">
    <p><img src="img/smallheading(W).png" width="20%"></p>
    <p class="w3-bar-item w3-button w3-right"><i class="material-icons">person</i></p>
  </div> -->
        <div class="w3-bar w3-theme">
            <a href="welcome.php"><img src="img/smallheading(W).png" width="20%"></a>
            <!--<p>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</p>-->
            <div class="w3-dropdown-hover w3-right">
                <button class="w3-button"><i class="material-icons">person</i></button>
                <div class="w3-dropdown-content w3-bar-block w3-border" style="right:0">
                    <p>Hi, <b>
                            <?php echo htmlspecialchars($_SESSION["username"]); ?></b>!</p>
                    <a href="resetpassword.php" class="w3-bar-item w3-button">Reset password</a>
                    <a href="logout.php" class="w3-bar-item w3-button w3-theme">Logout</a>
                    <p>version 0.3(full-db)</p>
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
        <div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header clearfix">
                            <h2 class="pull-left">Water Works & Drain</h2>
                        </div>
                        <?php
                    // Include config file
                    // require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM komplen WHERE category='water_work'";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='w3-table w3-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                       echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Date/Time</th>";
                                        echo "<th>location</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['date'] . "</td>";
                                        echo "<td>" . $row['location'] . "</td>";
                                        echo "<td>";
//                                            view full details 
                                            echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
//                                           delete row
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            unset($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }
                    
                    // Close connection
                   // unset($pdo);
                    ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div id="AnimalPest" class="tabcontent">

        <div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header clearfix">
                            <h2 class="pull-left">Water Works & Drain</h2>
                        </div>
                        <?php
                    // Include config file
                    // require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM komplen WHERE category='animal_pest'";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='w3-table w3-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                       echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Date/Time</th>";
                                        echo "<th>location</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['date'] . "</td>";
                                        echo "<td>" . $row['location'] . "</td>";
                                        echo "<td>";
//                                            view full details 
                                            echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
//                                           delete row
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            unset($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }
                    
                    // Close connection
                   // unset($pdo);
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <!--end of animal_pest-->
    </div>

    <div id="RoadFootpath" class="tabcontent">

        <div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header clearfix">
                            <h2 class="pull-left">Road & Footpath</h2>
                        </div>
                        <?php
                    // Include config file
                    // require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM komplen WHERE category='road_footpath'";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='w3-table w3-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                       echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Date/Time</th>";
                                        echo "<th>location</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['date'] . "</td>";
                                        echo "<td>" . $row['location'] . "</td>";
                                        echo "<td>";
//                                            view full details 
                                            echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
//                                           delete row
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            unset($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }
                    
                    // Close connection
                   // unset($pdo);
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <!--end of road_footpath-->
    </div>

    <div id="EnvironmentCleanliness" class="tabcontent">
        <div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header clearfix">
                            <h2 class="pull-left">Environment & Cleanliness</h2>
                        </div>
                        <?php
                    // Include config file
                    // require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM komplen WHERE category='environment_cleanliness'";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='w3-table w3-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                       echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Date/Time</th>";
                                        echo "<th>location</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['date'] . "</td>";
                                        echo "<td>" . $row['location'] . "</td>";
                                        echo "<td>";
//                                            view full details 
                                            echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
//                                           delete row
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            unset($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }
                    
                    // Close connection
                   // unset($pdo);
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <!--end of environment_cleanliness-->
    </div>

    <div id="TreesGreenery" class="tabcontent">
        <div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header clearfix">
                            <h2 class="pull-left">Trees & Greenery</h2>
                        </div>
                        <?php
                    // Include config file
                    // require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM komplen WHERE category='trees_greenery'";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='w3-table w3-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                       echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Date/Time</th>";
                                        echo "<th>location</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['date'] . "</td>";
                                        echo "<td>" . $row['location'] . "</td>";
                                        echo "<td>";
//                                            view full details 
                                            echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
//                                           delete row
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            unset($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }
                    
                    // Close connection
                   // unset($pdo);
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <!--end of trees_greenery-->
    </div>

    <div id="OtherComment" class="tabcontent">

        <div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header clearfix">
                            <h2 class="pull-left">Other & Comment</h2>
                        </div>
                        <?php
                    // Include config file
                    // require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM komplen WHERE category='other_comment'";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='w3-table w3-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                       echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Date/Time</th>";
                                        echo "<th>location</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['date'] . "</td>";
                                        echo "<td>" . $row['location'] . "</td>";
                                        echo "<td>";
//                                            view full details 
                                            echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
//                                           delete row
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            unset($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }
                    
                    // Close connection
                   // unset($pdo);
                    ?>
                    </div>
                </div>
            </div>
        </div>

        <!--end of other_comment  -->
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
