<?php
// Include setting file
require_once "setting.php";
 
// Define variables and initialize with empty values
$name = $address = $student_id = "";
$name_err = $address_err = $student_id_err = "";
 
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
    
    // Validate address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }
    
    // Validate student_id
    $input_student_id = trim($_POST["student_id"]);
    if(empty($input_student_id)){
        $student_id_err = "Please enter the student id.";     
    } elseif(!ctype_digit($input_student_id)){
        $student_id_err = "Please enter a positive integer value.";
    } else{
        $student_id = $input_student_id;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($student_id_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO students (name, address, student_id) VALUES (:name, :address, :student_id)";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":address", $param_address);
            $stmt->bindParam(":student_id", $param_student_id);
            
            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_student_id = $student_id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
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
    <title>Insert</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
        body {
            background-color: #e6f0ff;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <br>
                    <br>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                            <span class="help-block"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($student_id_err)) ? 'has-error' : ''; ?>">
                            <label>Student Id</label>
                            <input type="text" name="student_id" class="form-control" value="<?php echo $student_id; ?>">
                            <span class="help-block"><?php echo $student_id_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Insert">
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>