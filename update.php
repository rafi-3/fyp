<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $detail = $location = $date = $category = $status = "";
$name_err = $detail_err = $location_err = $date_err = $category_err = $status_err =  "";
 
// Processing form data when form is submitted
if(isset($_POST["no"]) && !empty($_POST["no"])){
    // Get hidden input value
    $id = $_POST["no"];
    
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    //     Validate detail
    $input_detail = trim($_POST["detail"]);
    if(empty($input_detail)){
        $detail_err = "Please write full detail.";     
    } else{
        $detail = $input_detail;
        $response = 'hello';
    }
    
    //    validate location
    $input_location = trim($_POST["location"]);
    if(empty($input_location)){
        $location_err = "Please write full location.";
    } else{
        $location = $input_location;
    }

    //    category
    $input_category = trim($_POST["category"]);
    if (empty($_POST["category"])) {
        $category_err = "Choose a category";
    } else {
        $category = test_input($_POST["category"]);
    }

    //    status
    $input_status = trim($_POST["status"]);
    if (empty($_POST["status"])) {
    $status_err = "Choose a status";
    } else {
    $status = test_input($_POST["status"]);
    }
    
    // Check input errors before inserting in database
    if(empty($name_err)){
        // Prepare an insert statement
         $sql =" UPDATE komplen SET name=:name, detail=:detail, date=:date, location=:location , img=:img, category=:category, status=:status WHERE id=:id";
 
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":detail", $param_detail);
            $stmt->bindParam(":location", $param_location);
            $stmt->bindParam(":date", $param_date);
            $stmt->bindParam(":img", $param_img);
            $stmt->bindParam(":category", $param_category);
            $stmt->bindParam(":status", $param_status);
            
            // Set parameters
            $param_name = $name;
            $param_detail = $detail;
            $param_location = $location;
            $param_date = $date;
            $param_img = $img;
            $param_category = $category;
            $param_status = $status;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
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
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM komplen WHERE id = :id";
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    // Retrieve individual field value
                    $param_name = $row["name"];
                    $param_detail = $row["detail"];
                    $param_location = $row["location"];
                    $param_date = $row["date"];
                    $param_category = $row["category"];
                    $param_status = $row["status"];

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
        .wrapper{
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
                        <input type="text" name="name" class="form-control-static" value="<?php echo $row["name"] ?>">
                    </div>
                    <div class="form-group">
                        <label>Detail</label>
                        <input type="text" name="name" class="form-control-static" value="<?php echo $row["detail"] ?>">
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="text" name="name" class="form-control-static" value="<?php echo $row["date"] ?>">
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" name="name" class="form-control-static" value="<?php echo $row["location"] ?>">
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="text" name="name" class="form-control-static" value="<?php echo $row["img"] ?>">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select>
                            <option value="pending" selected>Pending</option>
                            <option value="resolved">Resolved</option>
                        </select>
                    </div>    
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>