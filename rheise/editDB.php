<!DOCTYPE html>
<html>
<head>
	<title>451 Fitness Tracker</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<header>
		<h1>451 Fitness Tracker</h1>
		<a href="homePage.php">Home</a>
	</header>
	
	<main>
		<?php
		//connect to DB
		//$con = mysqli_connect("ix.cs.uoregon.edu", "final_guest", "password", "workout", "3561");
        $con = mysqli_connect("ix.cs.uoregon.edu", "final_guest", "password", "workout", "3286");

	//retrieve table name from query string
	$table = $_GET['table'];

	//query database for column names
    $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='$table' ORDER BY ORDINAL_POSITION";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);

	//get ID column name
	$id_col = $row[0];

	//retrieve ID from query string
	$id = $_GET['Getid'];

	//query database for item with ID
	$query = "SELECT * FROM $table WHERE $id_col='$id'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);

	//get column names and values
	$columns = array();
	$values = array();
	foreach($row as $key => $value) {
		if(!is_numeric($key)) {
			$columns[] = $key;
			$values[] = $value;
		}
	}

	//create form with input fields for each column
	echo "<form type='edit' action='update.php?Gettable=$table&Getid=$id&Getid_col=$id_col' method='POST'>";
	for($i = 0; $i < count($columns); $i++) {
		$column_name = $columns[$i];
		$value = $values[$i];
		echo "<label for='$column_name'>$column_name:</label><br>";
		echo "<input type='text' id='$column_name' name='$column_name' value='$value'><br><br>";
	}
	echo "<button type='submit' name='update'>Update</button>";
	echo "</form>";

	//close database connection
	mysqli_close($con);
	?>
	</main>
	
</body>
</html>

