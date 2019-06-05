<!DOCTYPE html>
<html>
<head>
	<title>Image</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<style type="text/css">
		#top {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

.topnav {
  float: left;
}

.topnav a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.topnav a:hover:not(.active) {
  background-color: #111;
}

.active {
  background-color: #4CAF50;
}
		.disImg{
			height: 400px;
			width: 400px;
		}

		.button{
				background-color: #4CAF50;
				border: none;
				color: white;
				padding: 12px 28px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 16px;
				margin: 4px 2px;
				cursor: pointer;
			}
	</style>
</head>
<body>
	<ul id="top">
      <li class="topnav"><a class="active" href="projects.php">Home</a></li>
      <li class="topnav"><a href="myProjects.php">My Projects</a></li>
    
    <li class="topnav"><a href="uploading.php">Upload</a></li>
      <li  class="topnav" style="float:right"><a href="logout.php">LogOut</a></li>
      <li class="topnav" style="float:right"><a href="notification.php">Notification</a></li>
  </ul>

	<?php
		session_start();

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

		$user = $_SESSION['user'];
		$pid = $_GET['pid'];

		$sql = "SELECT * FROM project WHERE pid='".$pid."';";
		$result = $conn->query($sql);

		$url = null;
		if($row = $result->fetch_assoc())
		{	
			$url = $row['image'];
			$title = $row['title'];
			$doneby = $row['uname'];
			$tags = $row['tags'];
		}

		echo "<div class='w3-cell-row' style='width:100%;padding:20px;'><div class='w3-container w3-cell w3-mobile w3-col m6 l6 w3-image'><img src='".$url."' class='disImg' alt='Not Able to Display' /></div>";

		echo "<div class=' w3-container w3-cell w3-mobile w3-cell-middle w3-col m6 l6'><center><h2>".$title."</h2>by ".$doneby."<br><br><br><b>Tags</b> : ".$tags."<br><br><br>".$row['downloads']." Downloads<br><br>";
        
        $q1="select count(uname) from likes where pid='".$row['pid']."';";
        $rs1=$conn->query($q1);
        if($row=$rs1->fetch_assoc()){
            
            echo $row['count(uname)']." Likes<br><br><br>";
        }
    
		echo "<form action='download.php?pid=".$pid."&type=i' method='post'><button class='button'>Download Now</button></form><br>";
        echo "<form action='download.php?pid=".$pid."&type=s' method='post'><button class='button'>Download Source File</button></form></center></div></div>";

		?>

</body>
</html>