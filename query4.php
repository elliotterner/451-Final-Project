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
$e_name = $_GET['e_name'];

// Execute the SQL query with the specified name
$sql = "SELECT CONCAT(People.fname, ' ', People.lname) AS Name, 
            People.gender AS Gender,
            Exercises.e_name AS Workout_Name, 
            Exercise_Session.sets AS Sets,
            Exercise_Session.reps AS Reps,
            Exercise_Session.weight AS Weight,
            Exercise_Session.date AS Date_Completed
        FROM People JOIN Exercise_Session ON People.p_id=Exercise_Session.People_p_id
            JOIN Exercises ON Exercise_Session.Exercises_e_id=Exercises.e_id
        WHERE Exercises.e_name='$e_name'
            AND Exercise_Session.weight = (
            SELECT MAX(weight)
            FROM Exercise_Session
            WHERE Exercises_e_id = Exercises.e_id)
        ORDER BY Weight DESC;";

$result = mysqli_query($conn, $sql);

// Check if any results were returned
if (mysqli_num_rows($result) > 0) {
    print "<pre>";
    $top_full_name = str_pad("Name", 20, ' ');
    $top_gender = str_pad("Gender", 20, ' ');
    $top_workout_name = str_pad('Workout_Name', 20, ' ');
    $top_sets = str_pad('Sets', 20, ' ');
    $top_reps = str_pad('Reps', 20, ' ');
    $top_weight = str_pad('Weight', 20, ' ');
    $top_date = str_pad('Date_Completed', 20, ' ');
    print "$top_full_name$top_gender$top_workout_name$top_sets$top_weight$top_date\n";
    while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
        $full_name = str_pad($row['Name'], 20, ' ');
        $gender = str_pad($row['Gender'], 20, ' ');
        $workout_name = str_pad($row['Workout_Name'], 20, ' ');
        $sets = str_pad($row['Sets'], 20, ' ');
        $reps = str_pad($row['Reps'], 20, ' ');
        $weight = str_pad($row['Weight'], 20, ' ');
        $date = str_pad($row['Date_Completed'], 20, ' ');
        print "$full_name$gender$workout_name$sets$weight$date\n";
    }
    print "</pre>";
} else {
    echo "No results found for '$e_name'";
}


// Close the database connection
mysqli_close($conn);

?>