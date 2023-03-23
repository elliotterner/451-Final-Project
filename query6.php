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
            People.weight AS Current_Weight,
            CASE 
                WHEN Personal_Goals.weight - People.weight <= 0 
                THEN 'Completed Goal' 
                ELSE Personal_Goals.weight - People.weight 
            END AS Pounds_Until_Goal
        FROM People JOIN Personal_Goals ON People.p_id=Personal_Goals.People_p_id
        WHERE CONCAT(People.fname, ' ', People.lname)='$name';";

$result = mysqli_query($conn, $sql);

// Check if any results were returned
if (mysqli_num_rows($result) > 0) {
    print "<pre>";
    $top_full_name = str_pad("Name", 20, ' ');
    $top_goal_weight = str_pad('Goal_Weight', 20, ' ');
    $top_c_weight = str_pad('Current_Weight', 20, ' ');
    $top_u_goal = str_pad('Pounds_Until_Goal', 20, ' ');
    print "$top_full_name$top_goal_weight$top_c_weight$top_u_goal\n";
    while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
        $full_name = str_pad($row["Name"], 20, ' ');
        $goal_weight = str_pad($row['Goal_Weight'], 20, ' ');
        $c_weight = str_pad($row['Current_Weight'], 20, ' ');
        $u_goal = str_pad($row['Pounds_Until_Goal'], 20, ' ');
        print "$full_name$goal_weight$c_weight$u_goal\n";
    }
    print "</pre>";
} else {
    echo "No results found for '$name'";
}


// Close the database connection
mysqli_close($conn);

?>