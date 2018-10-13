<?php
// Check existence of id parameter before processing further
if(isset($_GET["no"]) && !empty(trim($_GET["no"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM kb_complaint WHERE no = :no";
    
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
                $category_main = $row["category_main"];
                $by_comp = $row["by_comp"];
                $title_sub = $row["title_sub"];
                $description_sub = $row["description_comp"];
                $date_comp = $row["date_comp"];
                $location_comp = $row["location_comp"];
                $image_comp = $row["image_comp"];
                $status = $row["status"];
                    
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
    <title>View Complaint</title>
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
                            <h3><?php echo $row["title_sub"]; ?></h3>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <p class="form-control-static">
                                <?php echo $row["by_comp"]; ?>
                            </p>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <p class="form-control-static">
                                <?php echo $row["description_comp"]; ?>
                            </p>
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <p class="form-control-static">
                                <?php echo $row["date_comp"]; ?>
                            </p>
                        </div>
                        <div class="form-group">
                            <label>Location</label>
                            <p class="form-control-static">
                                <?php echo $row["location_comp"]; ?>
                            </p>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <p class="form-control-static">
                                <?php echo $row["image_comp"]; ?>
                            </p>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <p class="form-control-static">
                                <?php echo $row["status"]; ?>
                            </p>
                        </div>
                        <p><a href="welcome.php" class="w3-button w3-theme" >Back</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
