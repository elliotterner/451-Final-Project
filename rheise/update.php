<?php
//connect to DB
//$con = mysqli_connect("ix.cs.uoregon.edu", "final_guest", "password", "workout", "3561");
$con = mysqli_connect("ix.cs.uoregon.edu", "final_guest", "password", "workout", "3286");

//retrieve table name, id, and id column name from query string
$table = $_GET['Gettable'];
$id = $_GET['Getid'];
$id_col = $_GET['Getid_col'];

//update row with new values from form
if(isset($_POST['update'])) {
    $update_values = array();
    foreach($_POST as $key => $value) {
        if($key != 'update') {
            $update_values[] = "$key='$value'";
        }
    }
    $update_query = "UPDATE $table SET " . implode(", ", $update_values) . " WHERE $id_col='$id'";
    mysqli_query($con, $update_query);
}

//close database connection
mysqli_close($con);

header("location:view.php");
?>

