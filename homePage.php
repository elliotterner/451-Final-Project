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
	
	<div class="inner">
		<!--
		Sidebar
		-->
		<div id="sidebar">
			<h2>About 451 Fitness Tracker</h2>
			<p>
				451 Fitness Tracker is a easy-to-use application that helps you track 
				your fitness progress. Whether you want to lose weight, build muscle or simply 
				stay healthy, our app has everything you need to reach your fitness goals.
			</p>
			
			<hr class="divider">

			<p>
			<a href="homePage.txt" >Contents</a> of the PHP page that 
			gets called.
			(And the <a href="connectionData.txt" >connection data</a>,
			kept separately for security reasons.)
			</p>
		</div> <!-- End of Side Bar -->

		<!--
		Safe sleeping site content
		-->
		<div id="content">
			<h2>Applications</h2>
			<ol>
				<li>View Users Completed Exercises</li>
				<form action="query1.php" method="GET">
					<p><label class="queries" for="name">Enter a name (ie John Doe):</label>
					<input type="text" name="name" id="name"></p>
					<button type="submit" style="margin-bottom:20px;">Submit</button>
				</form>
				<a href="query1.txt" >Contents</a> of the PHP page that gets called.

				<hr class="divider">

				<li>View all exercises in a Specified class</li>
				<form action="query2.php" method="GET">
					<p><label class="queries" for="w_class">Enter Workout Class (ie Upper Body):</label>
					<input type="text" name="w_class" id="w_class"></p>
					<button type="submit" style="margin-bottom:20px;">Submit</button>
				</form>
				<a href="query2.txt" >Contents</a> of the PHP page that gets called.

				<hr class="divider">

				<li>View a specific exercise</li>
				<form action="query3.php" method="GET">
					<p><label class="queries" for="name">Enter a name (ie David Brown):</label>
					<input type="text" name="name" id="name"></p>
					<p><label class="queries" for="e_name">Enter Exercise Name (ie Leg Press):</label>
					<input type="text" name="e_name" id="e_name"></p>
					<button type="submit" style="margin-bottom:20px;">Submit</button>
				</form>
				<a href="query3.txt" >Contents</a> of the PHP page that gets called.

				<hr class="divider">

				<li>View who holds the max weight for a specific exercise</li>
				<form action="query4.php" method="GET">
					<p><label class="queries" for="e_name">Enter Workout Name (ie Leg Press):</label>
					<input type="text" name="e_name" id="e_name"></p>
					<button type="submit" style="margin-bottom:20px;">Submit</button>
				</form>
				<a href="query4.txt" >Contents</a> of the PHP page that gets called.

				<hr class="divider">

				<li>View Users Goals</li>
				<form action="query5.php" method="GET">
					<p><label class="queries" for="name">Enter a Name (ie John Doe):</label>
					<input type="text" name="name" id="name"></p>
					<button type="submit" style="margin-bottom:20px;">Submit</button>
				</form>
				<a href="query5.txt" >Contents</a> of the PHP page that gets called.

				<hr class="divider">

				<li>View how close User is to their personal goal weight</li>
				<form action="query6.php" method="GET">
					<p><label class="queries" for="name">Enter a Name (ie John Doe):</label>
					<input type="text" name="name" id="name"></p>
					<button type="submit" style="margin-bottom:20px;">Submit</button>
				</form>
					<a href="query6.txt" >Contents</a> of the PHP page that gets called.

				<hr class="divider">

				<li>View how close User is to their goal reps and weight</li>
				<form action="query7.php" method="GET">
					<p><label class="queries" for="name">Enter a Name (ie Ethan Rivera):</label>
					<input type="text" name="name" id="name"></p>
					<button type="submit" style="margin-bottom:20px;">Submit</button>
				</form>
					<a href="query7.txt" >Contents</a> of the PHP page that gets called.

				<hr class="divider">

				<li>View sum of daily food intake</li>
				<form action="query8.php" method="GET">
					<p><label class="queries" for="name">Enter a Name (ie John Doe):</label>
					<input type="text" name="name" id="name"></p>
					<p><label class="queries" for="date">Enter Date (ie 2023-03-21):</label>
					<input type="text" name="date" id="date"></p>
					<button type="submit" style="margin-bottom:20px;">Submit</button>
				</form>
					<a href="query8.txt" >Contents</a> of the PHP page that gets called.

				<hr class="divider">

				<li>View how close user is to goal daily food intake</li>
				<form action="query9.php" method="GET">
					<p><label class="queries" for="name">Enter a Name (ie John Doe):</label>
					<input type="text" name="name" id="name"></p>
					<p><label class="queries" for="date">Enter Date (ie 2023-03-21):</label>
					<input type="text" name="date" id="date"></p>
					<button type="submit" style="margin-bottom:20px;">Submit</button>
				</form>
					<a href="query9.txt" >Contents</a> of the PHP page that gets called.
				
				<hr class="divider">

				<li>View specific users Max lifts</li>
				<form action="query10.php" method="GET">
					<p><label class="queries" for="name">Enter a Name (ie John Doe):</label>
					<input type="text" name="name" id="name"></p>
					<button type="submit" style="margin-bottom:20px;">Submit</button>
				</form>
				<a href="query10.txt" >Contents</a> of the PHP page that gets called.
			</ol>
		</div> <!-- End of content-->
	</div> <!-- End of Inner -->
</body>
</html>