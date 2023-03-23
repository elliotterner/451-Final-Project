<?php

// Establish a database connection (replace the placeholders with actual values)
include('connectionData.txt');
$conn = mysqli_connect($server, $user, $pass, $dbname, $port);
#$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the name parameter from the GET request
$name = $_GET['name'];

// Execute the SQL query with the specified name
$sql = "SELECT CONCAT(People.fname, ' ', People.lname) AS Name, 
            Personal_Goals.weight AS Goal_Weight,
            Exercises.e_name AS Exercise_Name,
            Goals.reps AS Goal_Reps
        FROM People JOIN Personal_Goals ON People.p_id=Personal_Goals.People_p_id
            JOIN Goals ON People.p_id=Goals.People_p_id
            JOIN Exercises ON Goals.Exercises_e_id=Exercises.e_id
        WHERE CONCAT(People.fname, ' ', People.lname)='$name';";

$result = mysqli_query($conn, $sql);

// Check if any results were returned
if (mysqli_num_rows($result) > 0) {
    print "<pre>";
    $top_full_name = str_pad("Name", 20, ' ');
    $top_goal_weight = str_pad('Goal_Weight', 20, ' ');
    $top_e_name = str_pad('Exercise_Name', 20, ' ');
    $top_goal_reps = str_pad('Goal_Reps', 20, ' ');
    print "$top_full_name$top_goal_weight$top_e_name$top_goal_reps\n";
    while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
        $full_name = str_pad($row["Name"], 20, ' ');
        $goal_weight = str_pad($row['Goal_Weight'], 20, ' ');
        $e_name = str_pad($row['Exercise_Name'], 20, ' ');
        $goal_reps = str_pad($row['Goal_Reps'], 20, ' ');
        print "$full_name$goal_weight$e_name$goal_reps\n";
    }
    print "</pre>";
} else {
    echo "No results found for '$name'";
}


// Close the database connection
mysqli_close($conn);

?>