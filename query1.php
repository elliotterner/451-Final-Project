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
               Exercises.e_name AS Workout_Name, 
               Exercise_Session.sets,
               Exercise_Session.reps,
               Exercise_Session.weight
        FROM People JOIN Exercise_Session ON People.p_id=Exercise_Session.People_p_id
            JOIN Exercises ON Exercise_Session.Exercises_e_id=Exercises.e_id
        WHERE CONCAT(People.fname, ' ', People.lname)='$name'";

$result = mysqli_query($conn, $sql);

// Check if any results were returned

if (mysqli_num_rows($result) > 0) {
    print "<pre>";
    $top_full_name = str_pad("Name", 20, ' ');
    $top_workout_name = str_pad('Workout_Name', 20, ' ');
    $top_sets = str_pad('sets', 20, ' ');
    $top_reps = str_pad('reps', 20, ' ');
    $top_weight = str_pad('weight', 20, ' ');
    print "$top_full_name$top_workout_name$top_sets$top_reps$top_weight\n";
    while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
        $full_name = str_pad($row['Name'], 20, ' ');
        $workout_name = str_pad($row['Workout_Name'], 20, ' ');
        $sets = str_pad($row['sets'], 20, ' ');
        $reps = str_pad($row['reps'], 20, ' ');
        $weight = str_pad($row['weight'], 20, ' ');
        print "$full_name$workout_name$sets$reps$weight\n";
    }
    print "</pre>";
} else {
    echo "No results found for '$name'";
}


// Close the database connection
mysqli_close($conn);

?>