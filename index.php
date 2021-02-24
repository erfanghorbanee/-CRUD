<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 550px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        body {
        background-color: #e6f0ff;
        }
        table tr td:last-child a{
            margin-right: 5px;
            color: #006bb3
;
        }
        table{
            background-color:#F0F8FF ;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
   
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <a href="insert.php" class="btn btn-primary pull-left">Add New Member</a>
                        <br>
                        <br>
                    </div>
                    <?php

                    require_once "setting.php";
                    

                    $sql = "SELECT * FROM students";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                                echo "<table class='table table-bordered'>";
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>Name</th>";
                                            echo "<th>Address</th>";
                                            echo "<th>Student Id</th>";
                                            echo "<th>Option</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";
                                        echo "<td>" . $row['student_id'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='edit.php?id=". $row['id'] ."' data-toggle='tooltip'>Edit</span></a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' data-toggle='tooltip'>Delete</span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                    
                            unset($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }
                    
                    
                
                    unset($pdo);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>