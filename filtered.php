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
  		<li><a href="myProjects.php">My Profile</a></li>
 		
 		<li><a href="uploading.php">Upload</a></li>
 		<li><a><form action='filtered.php' method='post'><input type='text' name='filter' placeholder='Filter by tags' required/>
            <input type='submit' value='filter' />
 		</form></a></li>
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
    
        $search = strtolower($_POST['filter']);
        $search = str_replace(" ",",",$search);
        $searcharr = preg_split( "/[,]+/", $search );
    
		$sql = "SELECT * FROM project;";
		$result = $conn->query($sql);

		if ($result->num_rows > 0){
			$id=0;
			echo "<table><tr>";
			while($row = $result->fetch_assoc()){
				$title = $row["title"];
				$url = $row["image"];
                $tags = strtolower($row['tags']);
                
                $tag_all = preg_split( "/[\s,]+/", $tags );
                       
                foreach($tag_all as $tag)
                {   
                    $flag = 0;
                    for($i=0;$i<count($searcharr);$i++)
                    {
                
                    if(strpos($tag, $searcharr[$i]) !== false)
                    {
                        echo "<div class='w3-btn w3-col m4 l3'><a onclick='redir()'><img name='".$title."' class='projectImg w3-hover-opacity' id='".$row['pid']."' src='".$url."' alt='Not able to display' /><br>";
				
				        echo "<center><b>".$title."<br>Tags </b>: ".$row['tags']."</center></a></div>";
                        
                        $flag = 1;
                        break;
                    }
                    }
                    if( $flag )
                        break;
			     }
            
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