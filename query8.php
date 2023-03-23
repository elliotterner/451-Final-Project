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
$date = $_GET['date'];

// Execute the SQL query with the specified name
$sql = "SELECT CONCAT(People.fname, ' ', People.lname) AS Name, 
            SUM(Daily_Food_Intake.calories) AS Calories,
            SUM(Daily_Food_Intake.protein) AS Protein,
            SUM(Daily_Food_Intake.fat) AS Fat,
            SUM(Daily_Food_Intake.carbs) AS Carbs
        FROM  People JOIN Daily_Food_Intake ON People.p_id=Daily_Food_Intake.People_p_id
        WHERE CONCAT(People.fname, ' ', People.lname)='$name' and Daily_Food_Intake.date='$date'
        GROUP BY CONCAT(People.fname, ' ', People.lname);";

$result = mysqli_query($conn, $sql);

// Check if any results were returned
if (mysqli_num_rows($result) > 0) {
    print "<pre>";
    $top_full_name = str_pad("Name", 20, ' ');
    $top_calories = str_pad('Calories', 20, ' ');
    $top_protein = str_pad('Protein', 20, ' ');
    $top_fat = str_pad('Fat', 20, ' ');
    $top_carbs = str_pad('Carbs', 20, ' ');

    print "$top_full_name$top_calories$top_protein$top_fat$top_carbs\n";

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
        $full_name = str_pad($row["Name"], 20, ' ');
        $calories = str_pad($row['Calories'], 20, ' ');
        $protein = str_pad($row['Protein'], 20, ' ');
        $fat = str_pad($row['Fat'], 20, ' ');
        $carbs = str_pad($row['Carbs'], 20, ' ');
    
        print "$full_name$calories$protein$fat$carbs\n";
    
    
    }
    print "</pre>";
} else {
    echo "No results found for '$name'";
}


// Close the database connection
mysqli_close($conn);

?>