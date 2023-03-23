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
$w_class = $_GET['w_class'];

// Execute the SQL query with the specified name
$sql = "SELECT Exercises.e_name AS Workout_Name
        FROM Exercises JOIN Workouts ON Exercises.Workouts_w_id=Workouts.w_id
        WHERE Workouts.workout_class='$w_class'";

$result = mysqli_query($conn, $sql);

// Check if any results were returned
if (mysqli_num_rows($result) > 0) {
    print "<pre>";
    $top_workout_name = str_pad('Workout_Name', 20, ' ');
    print "$top_workout_name\n";
    while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
        $workout_name = str_pad($row['Workout_Name'], 20, ' ');
        print "$workout_name\n";
    }
    print "</pre>";
} else {
    echo "No results found for '$name'";
}


// Close the database connection
mysqli_close($conn);

?>