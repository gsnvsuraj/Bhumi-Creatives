<!DOCTYPE html>
<html>
<head>
	<title>My Projects</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<style type="text/css">
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
    
        .projectImg{
           height: 250px;
			width: 250px;
			padding: 10px;
			cursor: zoom-in;
		}

		.projectImgApp{
           height: 250px;
			width: 250px;
			padding: 10px;
		}
	</style>
</head>
<body>
	<ul>
  		<li><a href="projects.php">Home</a></li>
  		<li><a class="active" href="myProjects.php">My Projects</a></li>
 		<li><a href="uploading.php">Upload</a></li>
  		<li style="float:right"><a href="logout.php">LogOut</a></li>
  		<li style="float:right"><a href="notification.php">Notification</a></li>
	</ul>

	<a href="resetPassPro.php" style="float: right"><button>Reset Password</button></a>

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

	if ( isset($_SESSION['msg']) )
	{
    	echo "<div class='w3-panel w3-green w3-card-4 w3-display-container w3-margin'>
    		<span onclick=\"this.parentElement.style.display='none'\"
			class='w3-button w3-display-topright'>&times;</span> 
    		<h3>Success!</h3>
  			<p>".$_SESSION['msg']."</p>
			</div>";
		unset($_SESSION['msg']);
	}

	$sql = "SELECT * FROM project WHERE uname='".$user."';";
	$result = $conn->query($sql);

		if ($result->num_rows > 0){
              $id=0;
			echo "<h2>Your Projects are -</h2>";
			while($row = $result->fetch_assoc()){
				$title = $row["title"];
				$url = $row["image"];
				echo "<div class='w3-btn w3-col m4 l3'><a onclick='redir()'><img name='".$title."' class='projectImg w3-hover-opacity' id='".$row['pid']."' src='".$url."' alt='Not able to display' /><br>";
				
				echo "<center><b>".$title."<br>Tags </b>: ".$row['tags']."</center></a></div>";
			}
		}
		else{
			echo "<h3 class='w3-container'>No Projects submitted by you.</h3>";
		}

		$sql = "SELECT * FROM approval WHERE user='".$user."';";
		$result = $conn->query($sql);

		if ($result->num_rows > 0){
              $id=0;
			echo "<h2 class='w3-container'>Your Pending Approvals are -</h2>";
			while($row = $result->fetch_assoc()){
				$title = $row["title"];
				$url = $row["image"];
				echo "<div class='w3-btn w3-col m4 l3'><a><img name='".$title."' class='projectImgApp' id='".$row['pid']."' src='".$url."' alt='Not able to display' /><br>";
				
				echo "<center><b>".$title."<br>Tags </b>: ".$row['tags']."</center></a></div>";
			}
		}
		else{
			echo "<h3 class='w3-container'>No Pending Approvals.</h3>";
		}
	?>

	<script type='text/javascript'>
		function redir() {
			window.open('imgDisplay.php?pid='+event.srcElement.id,'_self');
		}
	</script>

</body>
</html>