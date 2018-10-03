<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $title = $detail = $location = $date = $status = "";
$name_err = $title_err = $detail_err = $location_err = $date_err = $status_err =  "";
 
// Processing form data when form is submitted
if(isset($_POST["no"]) && !empty($_POST["no"])){
    // Get hidden input value
    $id = $_POST["no"];
    
    // Validate name
    $input_name = trim($_POST["by_comp"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    //    validate title
    $input_title = trim($_POST["title_sub"]);
    if(empty($input_title)){
        $detail_err = "Please write full title.";     
    } else{
        $title = $input_title;
    }
    
    //     Validate detail/description
    $input_detail = trim($_POST["description_sub"]);
    if(empty($input_detail)){
        $detail_err = "Please write full description.";     
    } else{
        $detail = $input_detail;
    }
    
    //    validate location
    $input_location = trim($_POST["location_comp"]);
    if(empty($input_location)){
        $location_err = "Please write full location.";
    } else{
        $location = $input_location;
    }

    //    status
    $input_status = trim($_POST["status"]);
    if (empty($input_status)) {
    $status_err = "Choose a status";
    } else {
    $status = $input_status;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($title_err) && empty($detail_err) && empty($location_err) && empty($date_err) && empty($status_err)){
        // Prepare an update statement
         $sql ="UPDATE kb_complaint SET title_sub=:title_sub ,image_comp=:image_comp , description_comp=:description_comp ,location_comp=:location_comp , date_comp=:date_comp , by_comp=:by_comp, status=:status  WHERE no=:no";
        
       if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":by_comp", $param_name);
            $stmt->bindParam(":title_sub", $param_title);
            $stmt->bindParam(":description_comp", $param_detail);
            $stmt->bindParam(":location_comp", $param_location);
            $stmt->bindParam(":date_comp", $param_date);
            $stmt->bindParam(":image_comp", $param_img);
            $stmt->bindParam(":status", $param_status);
            
            // Set parameters
            $param_name = $name;
            $param_title = $title;
            $param_detail = $detail;
            $param_location = $location;
            $param_date = $date;
            $param_img = $img;
            $param_status = $status;
            
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
        $id =  trim($_GET["no"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM kb_complaint WHERE no = :no";
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":no", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    // Retrieve individual field value
                    $by_comp = $row["by_comp"];
                    $title_sub = $row["title_sub"];
                    $description_sub = $row["description_comp"];
                    $date_comp = $row["date_comp"];
                    $location_comp = $row["location_comp"];
                    $image_comp = $row["image_comp"];
                    $status = $row["status"];
                    
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
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }

    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Komplen</h2>
                    </div>
                    <p>Please update status/image and submit to update Komplen.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                         <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control-static" value="<?php echo $row["by_comp"] ?>">
                        </div>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="name" class="form-control-static" value="<?php echo $row["title_sub"] ?>">
                        </div>
                        <div class="form-group">
                            <label>Detail</label>
                            <input type="text" name="name" class="form-control-static" value="<?php echo $row["description_comp"] ?>">
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input type="text" name="name" class="form-control-static" value="<?php echo $row["date_comp"] ?>">
                        </div>
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" name="name" class="form-control-static" value="<?php echo $row["location_comp"] ?>">
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="text" name="name" class="form-control-static" value="<?php echo $row["image_comp"] ?>">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select>
                                <option name="status" value="pending">Pending</option>
                                <option name="status" value="resolved">Resolved</option>
                            </select>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
