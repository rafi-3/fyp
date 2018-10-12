<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$title_sub = $image_comp = $description_comp = $location_comp = $date_comp = $by_comp = $status_new = "";
$title_sub_err = $image_comp_err = $description_comp_err = $location_comp_err = $date_comp_err = $by_comp_err = $status_new_err = "";

// Processing form data when form is submitted
if(isset($_POST["no"]) && !empty($_POST["no"])){

    // Get hidden input value
    $no = $_POST["no"];

    //    Validate status
   $input_status = trim($_POST["status_new"]);
   if (empty($input_status)) {
   $status_new_err = "Choose a status";
   } else {
   $status_new = $input_status;
   }
    
    // Check input errors before inserting in database
    if(empty($status_new_err)){
        // Prepare an update statement
        //  $sql = "UPDATE kb_complaint SET title_sub=:title_sub, image_comp=:image_comp, description_comp=:description_comp, location_comp=:location_comp, date_comp=:date_comp, by_comp=:by_comp, status=:status WHERE no=:no";
         $sql = "UPDATE kb_complaint SET status=:status WHERE no=:no";
        
       if($stmt = $pdo->prepare($sql)){
           // Bind variables to the prepared statement as parameters=
           $stmt->bindParam(":status", $param_status);
           $stmt->bindParam(":no", $param_no);
        //    $stmt->bindParam(":title_sub", $param_title);
        //    $stmt->bindParam(":image_comp", $param_image);
        //    $stmt->bindParam(":description_comp", $param_description);
        //    $stmt->bindParam(":location_comp", $param_location);
        //    $stmt->bindParam(":date_comp", $param_date);
        //    $stmt->bindParam(":by_comp", $param_by);
        //    $stmt->bindParam(":status", $param_status);
        //    $stmt->bindParam(":no", $param_no);
            
            // Set parameters
            $param_status = $status_new;
            $param_no = $no;
            // $param_title = $title_sub;
            // $param_image = $image_comp;
            // $param_description = $description_comp;
            // $param_location = $location_comp;
            // $param_date = $date_comp;
            // $param_by = $by_comp;
            // $param_status = $status_new;
            // $param_no = $no;

            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: welcome.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
       // Close statement
        unset($stmt);
    }
    // Close connection
    unset($pdo);
} else{
    // Check existence of id parameter before processing further
   if(isset($_GET["no"]) && !empty(trim($_GET["no"]))){
        // Get URL parameter
        $no =  trim($_GET["no"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM  kb_complaint WHERE no = :no";
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":no", $param_no);
            
            // Set parameters
            $param_no = $no;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    // Retrieve individual field value
                    $by_comp = $row["by_comp"];
                    $title_sub = $row["title_sub"];
                    $description_comp = $row["description_comp"];
                    $date_comp = $row["date_comp"];
                    $location_comp = $row["location_comp"];
                    $image_comp = $row["image_comp"];
                    $status_new = $row["status"];
                    
                } else{
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Status</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 350px;
            padding: 20px;
        }

        .w3-theme {
            color: #fff !important;
            background-color: #009e74 !important
        }

    </style>
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
                        <p>Please update status/image and submit to update Komplen.</p>
                        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                            <div class="form-group <?php echo (!empty($by_comp_err)) ? 'has-error' : ''; ?>">
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
                            <div class="form-group  <?php echo (!empty($status_new_err)) ? 'has-error' : ''; ?>">
                                <label>Status</label>
                                <select name="status_new">
                                    <option value="Pending" <?php if($status_new=="Pending" ) echo 'selected="selected"' ; ?> >Pending</option>
                                    <option value="Verified" <?php if($status_new=="Verified" ) echo 'selected="selected"' ; ?> >Verified</option>
                                    <option value="Resolved" <?php if($status_new=="Resolved" ) echo 'selected="selected"' ; ?> >Resolved</option>
                                </select>
                                <span class="help-block">
                                    <?php echo $status_new_err;?></span>
                            </div>

                            <input type="hidden" name="no" value="<?php echo $no; ?>" />
                            <input type="submit" class="w3-button w3-theme" value="Submit">
                            <a href="index.php" class="btn btn-default">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
