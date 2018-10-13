<?php
// Initialize the session
session_start();
 

    require_once 'config.php';
//
//$sql = "SELECT permission FROM kb_admin WHERE username =:username ";
//$stmt = $pdo->prepare($sql);
//
//// Check if the user is logged in, if not then redirect him to login page
//if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//    if(isset($_SESSION['permission'] && $_SESSION['permission'] != "super_admin")){
//              header("location:superadmin.php");
//         } else if(isset($_SESSION['permission'] && $_SESSION['permission'] != "admin")){
//              header("location:welcome.php");
//
//         }
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: index.php");
        exit;
    }
?>

!DOCTYPE html>
<html>
<title>KomplenBiskita</title>
<link rel="shortcut icon" href="img/icon(G).ico">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<link rel="stylesheet" href="kb.css">

<body>
    <!--    top navigation bar and user information-->
    <div class="w3-top w3-mobile">
        <div class="w3-bar w3-theme w3-mobile">
            <a href="superadmin.php" title="Refresh"><img src="img/smallheading(T).png" width="20%" class="w3-mobile"></a>
            <a href="welcome.php" class="w3-bar-item w3-button w3-theme w3-right w3-mobile"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
        </div>
        
        <!--tab menu-->
        <div class="tab w3-mobile">
            <button class="tablinks w3-mobile" onclick="openCity(event, 'kb_user')" id="defaultOpen">Client</button>
            <button class="tablinks w3-mobile" onclick="openCity(event, 'kb_admin')">Admin</button>

        </div>
    </div>

    <br><br><br>

    
    <!--    tab contents -->

    <div id="kb_user" class="tabcontent">
        <div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header clearfix">
                            <h2 class="pull-left">Client</h2>
                        </div>
                        <?php
                    // Attempt select query execution
                    $sql = "SELECT * FROM kb_user";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='w3-table w3-striped w3-mobile'>";
                                echo "<thead>";
                                    echo "<tr>";
                                       echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Username</th>";
                                        echo "<th>NRIC</th>";
                                        echo "<th>Phone Number </th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['no'] . "</td>";
                                        echo "<td>" . $row['full_name'] . "</td>";
                                        echo "<td>" . $row['user_name'] . "</td>";
                                        echo "<td>" . $row['nr_ic'] . "</td>";
                                        echo "<td>" . $row['phone_no'] . "</td>";
                                        echo "<td>";
                                    //                                            view full details 
                                            echo "<a href='read_user.php?no=". $row['no'] ."' title='View User' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                    //                                           delete row
                                            echo "<a href='delete_user.php?no=". $row['no'] ."' title='Delete User' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
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
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <!--        end of kb_user-->
    </div>
    <div id="kb_admin" class="tabcontent">
        <div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header clearfix">
                            <h2 class="pull-left w3-mobile">Admin</h2>
                            <a href="register.php" class="w3-button w3-theme pull-right w3-mobile">Add New Admin</a>
                        </div>
                        <?php
                    // Attempt select query execution
                    $sql = "SELECT * FROM kb_admin";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='w3-table w3-striped w3-mobile'>";
                                echo "<thead>";
                                    echo "<tr>";
                                       echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Username</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['username'] . "</td>";
                                        echo "<td>";
//                                            edit komplen
                                            echo "<a href='resetpassword_admin.php?id=". $row['id'] ."' title='Reset Password' data-toggle='tooltip'><span class='glyphicon glyphicon-refresh'></span></a>";
//                                           delete row
                                            echo "<a href='delete_admin.php?id=". $row['id'] ."' title='Delete User' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
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
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <!--        end of kb_admin-->
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
