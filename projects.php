<!DOCTYPE html>
<html>
<head>
	<title>Projects</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<style type="text/css">
		.likes{
		}

		.projectImg{
			height: 250px;
			width: 250px;
			padding: 10px;
			cursor: zoom-in;
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
  		<li><a class="active" href="projects.php">Home</a></li>
  		<li><a href="myProjects.php">My Projects</a></li>
 		
 		<li><a href="uploading.php">Upload</a></li>
 		<li><form action='filtered.php' method='post'><a><input type='text' name='filter' placeholder='Filter by tags' required/>
            <input type='submit' value='Filter' /></a>
 		</form></li>
  		<li style="float:right"><a href="logout.php">LogOut</a></li>
  		<li style="float:right"><a href="notification.php">Notification</a></li>
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

		$sql = "SELECT * FROM project;";
		$result = $conn->query($sql);

		if ($result->num_rows > 0){
			$id=0;
			echo "<table><tr>";
			while($row = $result->fetch_assoc()){
				$title = $row["title"];
				$url = $row["image"];
				echo "<div class='w3-btn w3-col m4 l3'><div class='w3-display-container'><a onclick='redir()'><img name='".$title."' class='projectImg w3-hover-opacity' id='".$row['pid']."' src='".$url."' alt='Not able to display' /><div class='w3-display-topright w3-padding'>";
                
                $q1="SELECT * from likes where pid='".$row['pid']."'AND uname='".$user."';";
                $rs1=$conn->query($q1);
                
                if($rs1->num_rows !=0)
                    echo "<button ><a href='like.php?desid=".$row['pid']."&status=1' style='text-decoration:none'><img src='https://banner2.kisspng.com/20180624/vaf/kisspng-facebook-like-button-social-media-youtube-fb-like-5b301a8bc72301.5391674615298791798157.jpg' height=20px class='likes'></a></button></div></div><br>";          
                else
				    echo "<button ><a href='like.php?desid=".$row['pid']."&status=0' style='text-decoration:none'><img src='http://www.logospng.com/images/3/like-facebook-black-clipart-best-3881.png' height=20px class='likes'></a></button></div></div><br>";

				echo "<center><b>".$title."<br>Tags </b>: ".$row['tags']."</center></a></div>";
			}
		}
		else{
			echo "<h3>No Projects to Display.</h3>";
		}
	?>
	

	<script type='text/javascript'>
		function redir() {
			window.open('imgDisplay.php?pid='+event.srcElement.id,'_self');
		}
	</script>

</body>
</html>