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
            Exercises.e_name AS Exercise_name,
            Goals.reps AS Goal_Reps,
            Goals.weight AS Goal_Weight,
            Exercise_Max.reps AS Current_Rep_Max,
            Exercise_Max.weight AS Current_Weight_Max,
            CASE 
                WHEN Goals.reps - Exercise_Max.reps <= 0 
                THEN 'Completed Goal' 
                ELSE Goals.reps - Exercise_Max.reps 
            END AS Reps_Until_Goal,
            CASE 
                WHEN Goals.weight - Exercise_Max.weight <= 0 
                THEN 'Completed Goal' 
                ELSE Goals.weight - Exercise_Max.weight 
            END AS Weight_Until_Goal
            FROM People JOIN Goals ON People.p_id=Goals.People_p_id
                JOIN Exercises ON Goals.Exercises_e_id=Exercises.e_id
                JOIN Exercise_Max ON People.p_id=Exercise_Max.People_p_id
        WHERE CONCAT(People.fname, ' ', People.lname)='$name';";

$result = mysqli_query($conn, $sql);

// Check if any results were returned
if (mysqli_num_rows($result) > 0) {
    print "<pre>";
    $top_full_name = str_pad("Name", 20, ' ');
    $top_e_name = str_pad('Exercise_name', 20, ' ');
    $top_g_reps = str_pad('Goal_Reps', 20, ' ');
    $top_g_weight = str_pad('Goal_Weight', 20, ' ');
    $top_c_rep_max = str_pad('Current_Rep_Max', 20, ' ');
    $top_c_weight_max = str_pad('Current_Weight_Max', 20, ' ');
    $top_r_until_goal = str_pad('Reps_Until_Goal', 20, ' ');
    $top_w_unitl_goal = str_pad('Weight_Until_Goal', 20, ' ');

    print "$top_full_name$top_e_name$top_g_reps$top_g_weight$top_c_rep_max$top_c_weight_max$top_r_until_goal$top_w_unitl_goal\n";

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
        $full_name = str_pad($row["Name"], 20, ' ');
        $e_name = str_pad($row['Exercise_name'], 20, ' ');
        $g_reps = str_pad($row['Goal_Reps'], 20, ' ');
        $g_weight = str_pad($row['Goal_Weight'], 20, ' ');
        $c_rep_max = str_pad($row['Current_Rep_Max'], 20, ' ');
        $c_weight_max = str_pad($row['Current_Weight_Max'], 20, ' ');
        $r_until_goal = str_pad($row['Reps_Until_Goal'], 20, ' ');
        $w_unitl_goal = str_pad($row['Weight_Until_Goal'], 20, ' ');

        print "$full_name$e_name$g_reps$g_weight$c_rep_max$c_weight_max$r_until_goal$w_unitl_goal\n";

    }
    print "</pre>";
} else {
    echo "No results found for '$name'";
}


// Close the database connection
mysqli_close($conn);

?>