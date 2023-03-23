<!DOCTYPE html>
<html>
<head>
	<title>451 Fitness Tracker</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<link rel="stylesheet" type="text/css" href="styles2.css">
</head>
<body>
<header>
	<h1>451 Fitness Tracker</h1>
	<nav>
		<ul>
			<li><a href="homePage.php">Home</a></li>
			<li><a href="insert.php">Log New Fitness Data</a></li>
			<li><a href="edit.php">Edit Exisiting Data</a></li>
		</ul>
	</nav>
</header>

    <form method="post" type="dropdown"style="border: 1px solid #ddd; padding: 20px; border-radius: 10px;">
    <select name="table" style="padding: 10px; font-size: 16px; border: none; background-color: #f7f7f7; border-radius: 5px;">
        <option value="" disabled selected>Select a table</option>
        <?php
        // Connect to database
        //$con = mysqli_connect("ix.cs.uoregon.edu", "final_guest", "password","workout", "3561");
        $con = mysqli_connect("ix.cs.uoregon.edu", "final_guest", "password", "workout", "3286");

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
    <input type="submit" value="Select Table" style="padding: 10px 20px; font-size: 16px; border: none; background-color: #4CAF50; color: white; border-radius: 5px; cursor: pointer;">
    </form>


	<?php
	// Check if form has been submitted
	if (isset($_POST['table'])) {
		// Get selected table from form data
		$table = $_POST['table'];

		// Connect to database
		//$con = mysqli_connect("ix.cs.uoregon.edu", "final_guest", "password", "workout", "3561");
        $con = mysqli_connect("ix.cs.uoregon.edu", "final_guest", "password", "workout", "3286");

		// Build query to get column names from selected table
		$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='$table' ORDER BY ORDINAL_POSITION";


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

		// Display column names at the top in a table
		echo "<table>";
		echo "<thead>";
		echo "<tr>";
		foreach ($columns as $column) {
			echo "<th>$column</th>";
		}
		echo "<th>Edit</th>";
		echo "</tr>";
		echo "</thead>";

		// Display row data below column names in a table
		echo "<tbody>";
		while ($row = mysqli_fetch_array($result)) {
			echo "<tr>";
			foreach ($columns as $column) {
				echo "<td>" . $row[$column] . "</td>";
			}
			echo '<td><a href="editDB.php?table=' . $table . '&Getid=' . $row[0] . '">Edit</a></td>';
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";

		// Close database connection
		mysqli_close($con);
	}
	?>
</body>
</html>
