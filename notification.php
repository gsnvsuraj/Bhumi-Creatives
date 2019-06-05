<!DOCTYPE html>
<html>
<head>
	<title>Projects</title>
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
  		<li><a href="projects.php">Home</a></li>
  		<li><a href="myProjects.php">My Projects</a></li>
 		
 		<li><a href="uploading.php">Upload</a></li>
 		<li style="float:right"><a href="logout.php">LogOut</a></li>
 		<li style="float:right"><a class="active" href="notification.php">Notification</a></li>
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

		session_start();

		if(isset($_SESSION['user']))
			$user = $_SESSION['user'];
		else
			header("Location:login.php");

		$sql = "SELECT * FROM notification WHERE uname='".$user."';";
		$result = $conn->query($sql) or die($conn->error);

		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$message = $row['message'];
				$dates = $row['dateCheck'];
				
				echo "<br>".$dates."<br><b>Message</b> - ".$message."<br><br>";

				$sql = "UPDATE notification SET status='read' WHERE uname='".$user."';";
				$result1 = $conn->query($sql);
			}
		}
		else{
			echo "<h3>No Notifications to Display.</h3>";
		}
	?>

</body>
</html>