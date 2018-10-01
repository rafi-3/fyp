<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $detail = $location = $date = $category = $status = "";
$name_err = $detail_err = $location_err = $date_err = $category_err = $status_err =  "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
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
    $response2 = 'hello';
    if(empty($input_location)){
        $location_err = "Please write full location.";
        $response3 = 'hello';
    } else{
        $location = $input_location;
    }
//    validate img
    
//    category
//     if (empty($_POST["category"])) {
//     $category_err = "Choose a category";
//   } else {
//     $category = test_input($_POST["category"]);
//   }

       $category = test_input($_POST["category"]);
    
     //    status
if (empty($_POST["status"])) {
    $status_err = "Choose a status";
  } else {
    $status = test_input($_POST["status"]);
  }
    
    // Validate date
    if (isset($_POST["submit"])){

 // getting current Date Time OOP way
 $currentDateTime = new \DateTime();

 //set timeZone
 $currentDateTime->setTimezone(new \DateTimeZone('America/New_York'));
 $date = $currentDateTime->format('l-j-M-Y H:i:s A');

    }


    // Check input errors before inserting in database
    if(empty($name_err) && empty($detail_err) && empty($location_err) && empty($status_err )){
        // Prepare an insert statement
        $sql = "INSERT INTO komplen (name, detail, date, location, category, status) VALUES (:name, :detail, :date, :location, :category, :status)";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":detail", $param_detail);
            $stmt->bindParam(":location", $param_location);
            $stmt->bindParam(":date", $param_date);
            //$stmt->bindParam(":img", $param_img);
            $stmt->bindParam(":category", $param_category);
            $stmt->bindParam(":status", $param_status);
            
            // Set parameters
            $param_name = $name;
            $param_detail = $detail;
            $param_location = $location;
            $param_date = $date;
            //$param_img = $img;
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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Komplen</title>
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
                        <h2>Create Komplen</h2>
                    </div>
                    <p>Please fill this form and submit to add new Komplen record to the database.</p>

                    <!--                    name-->
                    <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $name; ?>">
                            <span class="help-block">
                                <?php echo $name_err;?></span>
                        </div>
                        <!--                        detail-->
                        <div class="form-group <?php echo (!empty($detail_err)) ? 'has-error' : ''; ?>">
                            <textarea name="detail" class="form-control" placeholder="Detail"><?php echo $detail; ?></textarea>
                            <span class="help-block">
                                <?php echo $detail_err;?></span>
                        </div>
                        
-->
                        <!--                        location-->
                        <div class="form-group <?php echo (!empty($location_err)) ? 'has-error' : ''; ?>">
                            <textarea name="location" class="form-control" placeholder="Location"><?php echo $location; ?></textarea>
                            <span class="help-block">
                                <?php echo $location_err;?></span>
                        </div>


                        
-->
                        <!--                        category-->
                        <div class="form-group <?php echo (!empty($category_err)) ? 'has-error' : ''; ?>">
                            <select>
                                <option name="category" value="water_work" selected>Water Works & Drain</option>
                                <option name="category" value="animal_pest">Animal & Pest</option>
                                <option name="category" value="road_footpath">Road & Footpath</option>
                                <option name="category" value="environment_cleanliness">Environment & Cleanliness</option>
                                <option name="category" value="trees_greenery">Trees & Greenery</option>
                                <option name="category" value="other_comment">Other & Comment</option>
                            </select>
                            <span class="help-block">
                                <?php echo $category_err;?></span>
                        </div>
                        <!--                        status-->
                        <div class="form-group <?php echo (!empty($status_err)) ? 'has-error' : ''; ?>">
                            <select>
                                <option value="pending" selected>Pending</option>
                            </select>
                        </div>
                        <!--
<input type="radio" name="category" <?php if (isset($category) && $category=="Water Works & Drain") echo "checked";?> value="Water Works & Drain">Water Works & Drain
<input type="radio" name="category" <?php if (isset($category) && $category=="Animal & Pest") echo "checked";?> value="Animal & Pest">
<input type="radio" name="category" <?php if (isset($category) && $category=="Road & Footpath") echo "checked";?> value="Road & Footpath">Road & Footpath
<input type="radio" name="category" <?php if (isset($category) && $category=="Environment & Cleanliness") echo "checked";?> value="Environment & Cleanliness">Environment & Cleanliness
<input type="radio" name="category" <?php if (isset($category) && $category=="Trees & Greenery") echo "checked";?> value="Trees & Greenery">Trees & Greenery
<input type="radio" name="category" <?php if (isset($category) && $category=="Other & Comment") echo "checked";?> value="Other & Comment">Other & Comment
                       <span class="error">* <?php echo $category_err;?></span>
-->
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="welcome.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
