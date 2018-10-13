<?php
// Initialize the session
session_start();
 

require_once 'config.php';
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<title>KomplenBiskita</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<link rel="stylesheet" href="kb.css">
<link rel="shortcut icon" href="img/icon(G).ico">

<body>
    <!--    top navigation bar and user information-->
    <div class="w3-top w3-mobile">
        <div class="w3-bar w3-theme w3-mobile">
            <a href="welcome.php" title="Refresh"><img src="img/smallheading(T).png" width="20%" class="w3-mobile"></a>
            <div class="w3-dropdown-hover w3-right">
                <button class="w3-button"><i class="material-icons">account_circle</i></button>
                <div class="w3-dropdown-content w3-bar-block w3-border" style="right:0">
                    <p>Hi, <b>
                            <?php echo htmlspecialchars($_SESSION["username"]); ?></b>!</p>
                    <a href="resetpassword.php" class="w3-bar-item w3-button">Reset password</a>
                    <a href="superadmin.php" class="w3-bar-item w3-button">Super Admin</a>
                    <a href="logout.php" class="w3-bar-item w3-button w3-theme">Logout</a>
                    <p>version 0.4</p>
                </div>
            </div>
        </div>
        <!--tab menu-->
        <div class="tab">
            <button class="tablinks w3-mobile" onclick="openCity(event, 'WaterWorks')" id="defaultOpen">Water Works & Drain</button>
            <button class="tablinks w3-mobile" onclick="openCity(event, 'AnimalPest')">Animal & Pest</button>
            <button class="tablinks w3-mobile" onclick="openCity(event, 'RoadFootpath')">Road & Footpath</button>
            <button class="tablinks w3-mobile" onclick="openCity(event, 'EnvironmentCleanliness')">Environment & Cleanliness</button>
            <button class="tablinks w3-mobile" onclick="openCity(event, 'TreesGreenery')">Trees & Greenery</button>
            <button class="tablinks w3-mobile" onclick="openCity(event, 'OtherComment')">Other & Comment</button>
        </div>
    </div>

   <br><br><br>
    <!--    tab contents -->

    <div id="WaterWorks" class="tabcontent">
        <div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header clearfix">
                            <h2 class="pull-left">Water Works & Drain</h2>
                        </div>
                        <?php
                    // Attempt select query execution
                    $sql = "SELECT * FROM kb_complaint WHERE category_main='Water works & drains'";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='w3-table w3-striped w3-mobile'>";
                                echo "<thead>";
                                    echo "<tr>";
                                       echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Title</th>";
                                        echo "<th>Date/Time</th>";
                                        echo "<th>location</th>";
                                        echo "<th>Action</th>";
                                        echo "<th>Status</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['no'] . "</td>";
                                        echo "<td>" . $row['by_comp'] . "</td>";
                                        echo "<td>" . $row['title_sub'] . "</td>";
                                        echo "<td>" . $row['date_comp'] . "</td>";
                                        echo "<td>" . $row['location_comp'] . "</td>";
                                        echo "<td>";
//                                            view full details 
                                            echo "<a href='read.php?no=". $row['no'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
//                                            edit komplen
                                            echo "<a href='update.php?no=". $row['no'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
//                                           delete row
                                            echo "<a href='delete.php?no=". $row['no'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
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
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <!--        end of water_work-->
    </div>

    <div id="AnimalPest" class="tabcontent">
        <div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header clearfix">
                            <h2 class="pull-left">Animal & Pest</h2>
                        </div>
                        <?php
                    // Attempt select query execution
                    $sql = "SELECT * FROM kb_complaint WHERE category_main='Animal & pest'";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='w3-table w3-striped w3-mobile'>";
                                echo "<thead>";
                                    echo "<tr>";
                                       echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Title</th>";
                                        echo "<th>Date/Time</th>";
                                        echo "<th>location</th>";
                                        echo "<th>Action</th>";
                                        echo "<th>Status</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['no'] . "</td>";
                                        echo "<td>" . $row['by_comp'] . "</td>";
                                        echo "<td>" . $row['title_sub'] . "</td>";
                                        echo "<td>" . $row['date_comp'] . "</td>";
                                        echo "<td>" . $row['location_comp'] . "</td>";
                                        echo "<td>";
//                                            view full details 
                                            echo "<a href='read.php?no=". $row['no'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
//                                            edit komplen
                                            echo "<a href='update.php?no=". $row['no'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
//                                           delete row
                                            echo "<a href='delete.php?nono=". $row['no'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
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
                    // Attempt select query execution
                    $sql = "SELECT * FROM kb_complaint WHERE category_main='Road & Footpath'";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='w3-table w3-striped w3-mobile'>";
                                echo "<thead>";
                                    echo "<tr>";
                                       echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Title</th>";
                                        echo "<th>Date/Time</th>";
                                        echo "<th>location</th>";
                                        echo "<th>Action</th>";
                                        echo "<th>Status</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['no'] . "</td>";
                                        echo "<td>" . $row['by_comp'] . "</td>";
                                        echo "<td>" . $row['title_sub'] . "</td>";
                                        echo "<td>" . $row['date_comp'] . "</td>";
                                        echo "<td>" . $row['location_comp'] . "</td>";
                                        echo "<td>";
//                                            view full details 
                                            echo "<a href='read.php?no=". $row['no'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
//                                            edit komplen
                                            echo "<a href='update.php?no=". $row['no'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
//                                           delete row
                                            echo "<a href='delete.php?no=". $row['no'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
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
                    // Attempt select query execution
                    $sql = "SELECT * FROM kb_complaint WHERE category_main='Environment & cleanliness'";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='w3-table w3-striped w3-mobile'>";
                                echo "<thead>";
                                    echo "<tr>";
                                       echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Title</th>";
                                        echo "<th>Date/Time</th>";
                                        echo "<th>location</th>";
                                        echo "<th>Action</th>";
                                        echo "<th>Status</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['no'] . "</td>";
                                        echo "<td>" . $row['by_comp'] . "</td>";
                                        echo "<td>" . $row['title_sub'] . "</td>";
                                        echo "<td>" . $row['date_comp'] . "</td>";
                                        echo "<td>" . $row['location_comp'] . "</td>";
                                        echo "<td>";
//                                            view full details 
                                            echo "<a href='read.php?no=". $row['no'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
//                                            edit komplen
                                            echo "<a href='update.php?no=". $row['no'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
//                                           delete row
                                            echo "<a href='delete.php?no=". $row['no'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
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
                            <h2 class="pull-left">Tree & Greenery</h2>
                        </div>
                        <?php
                    // Attempt select query execution
                    $sql = "SELECT * FROM kb_complaint WHERE category_main='Tree & greenery'";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='w3-table w3-striped w3-mobile'>";
                                echo "<thead>";
                                    echo "<tr>";
                                       echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Title</th>";
                                        echo "<th>Date/Time</th>";
                                        echo "<th>location</th>";
                                        echo "<th>Action</th>";
                                        echo "<th>Status</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['no'] . "</td>";
                                        echo "<td>" . $row['by_comp'] . "</td>";
                                        echo "<td>" . $row['title_sub'] . "</td>";
                                        echo "<td>" . $row['date_comp'] . "</td>";
                                        echo "<td>" . $row['location_comp'] . "</td>";
                                        echo "<td>";
//                                            view full details 
                                            echo "<a href='read.php?no=". $row['no'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
//                                            edit komplen
                                            echo "<a href='update.php?no=". $row['no'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
//                                           delete row
                                            echo "<a href='delete.php?no=". $row['no'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
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
                    // Attempt select query execution
                    $sql = "SELECT * FROM kb_complaint WHERE category_main='Other & comment'";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='w3-table w3-striped w3-mobile'>";
                                echo "<thead>";
                                    echo "<tr>";
                                       echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Title</th>";
                                        echo "<th>Date/Time</th>";
                                        echo "<th>location</th>";
                                        echo "<th>Action</th>";
                                        echo "<th>Status</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['no'] . "</td>";
                                        echo "<td>" . $row['by_comp'] . "</td>";
                                        echo "<td>" . $row['title_sub'] . "</td>";
                                        echo "<td>" . $row['date_comp'] . "</td>";
                                        echo "<td>" . $row['location_comp'] . "</td>";
                                        echo "<td>";
//                                            view full details 
                                            echo "<a href='read.php?no=". $row['no'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
//                                            edit komplen
                                            echo "<a href='update.php?no=". $row['no'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
//                                           delete row
                                            echo "<a href='delete.php?no=". $row['no'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
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
