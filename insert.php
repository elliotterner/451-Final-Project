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

        ?>
        <p style="text-align:center;">Please make sure to add a valid ID number associated with your new entry</p>
        <?php
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

        	//create form with input fields for each column
        echo "<form type='edit' action='insertComplete.php?Gettable=$table' method='POST' style = 'display: block;
        margin: auto;'>";
        for($i = 0; $i < count($columns); $i++) {
            $column_name = $columns[$i];
            echo "<label for='$column_name'>$column_name:</label><br>";
            echo "<input type='text' id='$column_name' name='$column_name'><br><br>";
        }
        echo "<button type='submit' name='update'>Update</button>";
        echo "</form>";
	}
	?>
</body>
</html>