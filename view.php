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
		<nav>
			<ul>
				<li><a href="#">Update</a></li>
				<li><a href="#">View</a></li>
			</ul>
		</nav>
	</header>

    <form method="post">
		<select name="table">
			<option value="" disabled selected>Select a table</option>
			<?php
			// Connect to database
			$con = mysqli_connect("ix.cs.uoregon.edu", "final_guest", "password","workout", "3561");

			// Get list of tables from database
			$query = "SHOW TABLES";
			$result = mysqli_query($con, $query);

			// Loop through tables and create options for dropdown
			while ($row = mysqli_fetch_array($result)) {
				echo '<option value="' . $row[0] . '">' . $row[0] . '</option>';
			}

			// Close database connection
			mysqli_close($con);
			?>
		</select>
		<input type="submit" value="Select Table">
	</form>

	<?php
	// Check if form has been submitted
	if (isset($_POST['table'])) {
		// Get selected table from form data
		$table = $_POST['table'];

		// Connect to database
		$con = mysqli_connect("ix.cs.uoregon.edu", "final_guest", "password", "workout", "3561");

		// Build query to get column names from selected table
		$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='$table'";

		// Execute query to get column names
		$result = mysqli_query($con, $query);

		// Store column names in an array
		$columns = array();
		while ($row = mysqli_fetch_array($result)) {
			$columns[] = $row['COLUMN_NAME'];
		}

		// Build query using selected table and column names
		$query = "SELECT * FROM $table";

		// Execute query and display results
		$result = mysqli_query($con, $query);

		// Display column names at the top
		foreach ($columns as $column) {
			echo $column . ' ';
		}
		echo '<br>';

		// Display row data below column names
		while ($row = mysqli_fetch_array($result)) {
			foreach ($columns as $column) {
				echo $row[$column] . ' ';
			}
			echo '<br>';
		}

		// Close database connection
		mysqli_close($con);
	}
	?>
	

	
</body>
</html>