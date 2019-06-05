<!DOCTYPE html>
<html>
<head>
	<title>Projects Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<style type="text/css">
		.projectImg{
			height: 250px;
			width: 250px;
			padding: 10px;
			cursor: pointer;
		}

		ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #111;
}

.active {
  background-color: #4CAF50;
}
	</style>
</head>
<body>
	<ul>
  		<li><a class="active" href="projectsAdmin.php">Home</a></li>
  		<li><a href="approval.php">Requets</a></li>
  		<li style="float:right"><a href="logout.php">LogOut</a></li>
  		<li style="float:right"><a href="notificationAdmin.php">All Notifications</a></li>
	</ul>


	<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "uplabs";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT * FROM project;";
		$result = $conn->query($sql);

		if ($result->num_rows > 0){
			echo "<table><tr>";
			$id=0;
			while($row = $result->fetch_assoc()){
				$title = $row["title"];
				$url = $row["image"];
				echo "<div class='w3-btn w3-col m4 l3'><a onclick='redir()'><img name='".$title."' class='projectImg w3-hover-opacity' id='".$row['pid']."' src='".$url."' alt='Not able to display' /><br>";
				
				echo "<center><b>".$title."<br>Tags </b>: ".$row['tags']."<br>";
				echo "<form method='post' action='delete.php?pid=".$row['pid']."'><input class='w3-button w3-blue w3-round-large' type='submit' name='delete' value='Delete'></form></center></a></div>";
			}
		}
		else{
			echo "<h3>No Projects to Display.</h3>";
		}
	?>

	<script type='text/javascript'>
		function redir() {
			window.open('imgDisplayAdmin.php?pid='+event.srcElement.id,'_self');
		}
	</script>

</body>
</html>