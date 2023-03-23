<?php

// Check if form has been submitted
if (isset($_POST['update'])) {
	// Get selected table from URL parameter
	$table = $_GET['Gettable'];

	// Connect to database
	$con = mysqli_connect("ix.cs.uoregon.edu", "final_guest", "password", "workout", "3286");

	// Build query to insert new row into selected table
	$query = "INSERT INTO $table (";

	// Get column names from table
	$column_query = "SHOW COLUMNS FROM $table";
	$column_result = mysqli_query($con, $column_query);

	$first = true;
	while ($column_row = mysqli_fetch_array($column_result)) {
		if (!$first) {
			$query .= ", ";
		}
		$query .= $column_row['Field'];
		$first = false;
	}

	$query .= ") VALUES (";

	// Get values from form input fields
	$value_query = "";
	$first = true;
	foreach ($_POST as $key => $value) {
		if ($key != "update") {
			if (!$first) {
				$value_query .= ", ";
			}
			$value_query .= "'" . mysqli_real_escape_string($con, $value) . "'";
			$first = false;
		}
	}

	$query .= $value_query . ")";

	// Execute query to insert new row into selected table
	mysqli_query($con, $query);

	// Close database connection
	mysqli_close($con);

	// Redirect user to home page
	header("Location: homePage.php");
	exit;
}

?>