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
            Exercise_Session.sets AS Sets,
            Exercise_Session.reps AS Reps,
            Exercise_Session.weight AS Weight,
            Exercise_Session.date AS Date_Completed
        FROM People JOIN Exercise_Session ON People.p_id=Exercise_Session.People_p_id
        JOIN Exercises ON Exercise_Session.Exercises_e_id=Exercises.e_id
        WHERE Exercise_Session.weight = (
            SELECT MAX(weight)
            FROM Exercise_Session
            WHERE Exercises_e_id = Exercises.e_id)
        AND CONCAT(People.fname, ' ', People.lname)='$name'
        ORDER BY Weight DESC;";

$result = mysqli_query($conn, $sql);

// Check if any results were returned
if (mysqli_num_rows($result) > 0) {
    print "<pre>";
    $top_full_name = str_pad("Name", 20, ' ');
    $top_w_name = str_pad('Workout_Name', 20, ' ');
    $top_sets = str_pad('Sets', 20, ' ');
    $top_reps = str_pad('Reps', 20, ' ');
    $top_weight = str_pad('Weight', 20, ' ');
    $top_date = str_pad('Date_Completed', 20, ' ');
    print "$top_full_name$top_w_name$top_sets$top_reps$top_weight$top_date\n";

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
        $full_name = str_pad($row["Name"], 20, ' ');
        $w_name = str_pad($row['Workout_Name'], 20, ' ');
        $sets = str_pad($row['Sets'], 20, ' ');
        $reps = str_pad($row['Reps'], 20, ' ');
        $weight = str_pad($row['Weight'], 20, ' ');
        $date = str_pad($row['Date_Completed'], 20, ' ');
        print "$full_name$w_name$sets$reps$weight$date\n";

    }
    print "</pre>";
} else {
    echo "No results found for '$name'";
}


// Close the database connection
mysqli_close($conn);

?>