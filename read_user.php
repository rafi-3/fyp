<?php
// Check existence of id parameter before processing further
if(isset($_GET["no"]) && !empty(trim($_GET["no"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM kb_user WHERE no = :no";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":no", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["no"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);         
                // Retrieve individual field value
                $full_name = $row["full_name"];
                $user_name = $row["user_name"];
                $nr_ic = $row["nr_ic"];
                $phone_no = $row["phone_no"];
                $email_add = $row["email_add"];
                $image_pro = $row["image_pro"];
                $complaint_no = $row["complaint_no"];
                    
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);

    // Close connection
    unset($pdo);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View User</title>
    <link rel="shortcut icon" href="img/icon(G).ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="kb.css">
</head>

<body>
    <div class="w3-card-4 w3-display-middle">
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div div class="w3-container w3-theme">
                            <h3>User details</h3>
                        </div>
                         <div class="form-group">
                            <img class="form-control-static" width="20%" src="data:image/jpeg;base64,'.base64_encode($image_pro).'"/>
                                
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <p class="form-control-static">
                                <?php echo $row["full_name"]; ?>
                            </p>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <p class="form-control-static">
                                <?php echo $row["user_name"]; ?>
                            </p>
                        </div>
                        <div class="form-group">
                            <label>NRIC</label>
                            <p class="form-control-static">
                                <?php echo $row["nr_ic"]; ?>
                            </p>
                        </div>
                        <div class="form-group">
                            <label>Contact detail</label>
                            <p class="form-control-static">
                                <?php echo $row["phone_no"]; ?>
                            </p>
                        </div>
                        <div class="form-group">
                            <label>Email address</label>
                            <p class="form-control-static">
                                <?php echo $row["email_add"]; ?>
                            </p>
                        </div>
                        <div class="form-group">
                            <label>Complaint number</label>
                            <p class="form-control-static">
                                <?php echo $row["complaint_no"]; ?>
                            </p>
                        </div>
                        <p><a href="superadmin.php" class="w3-button w3-theme" >Back</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
