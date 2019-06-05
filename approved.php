<!DOCTYPE html>
<html>
<head>
	<title>Approvals</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<style type="text/css">
		.projectImg{
			height: 250px;
			width: 250px;
			padding: 10px;
			cursor: pointer;
		}
        #imager{
            width:800px;
            height:800px;
        
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
        .but{
            text-decoration: none;
        }
	</style>
</head>
<body>
	<ul>
  		<li><a href="projectsAdmin.php">Home</a></li>
  		<li><a class="active" href="approval.php">Requets</a></li>
  		<li style="float:right"><a href="logout.php">LogOut</a></li>
        <li style="float:right"><a href="notificationAdmin.php">All Notifications</a></li>
	</ul>


	<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "uplabs";
		// Create connection
		$con = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($con->connect_error) {
			die("Connection failed: " . $con->connect_error);
		}
    
        $stat = $_GET['stat'];
        $pid  = $_GET['pid'];
        
        $sql = "SELECT * FROM approval WHERE pid ='".$pid."';";
        $result = $con->query($sql);
        $row2 = $result->fetch_assoc();
        
        if($stat == 'D')
        {
            $query2="insert into notification values('".$row2['user']."','".$row2['title']." has been declined',CURDATE(),'unread');";
            $con->query($query2);
            
            $query3="delete from approval where pid='".$pid."';";
            $con->query($query3);

            if (!unlink($row2['image']))
                echo ("Error deleting image");
            
            if (!unlink($row2['source_file']))
                echo ("Error deleting source");

        }
        
        if($stat == 'A')
        {
            $query2="insert into notification values('".$row2['user']."','".$row2['title']." has been approved',CURDATE(),'unread');";
            $con->query($query2);
            
            $query4="insert into project values('".$pid."','".$row2['user']."','".$row2['title']."','".$row2['image']."','".$row2['city']."','".$row2['tags']."','".$row2['source_file']."',0) ;";
            $con->query($query4);

            $query5="delete from approval where pid='".$pid."';";
            $con->query($query5);
        }
		$sql = "SELECT * FROM approval;";
		$result = $con->query($sql);

		if ($result->num_rows > 0){
      echo "<table><tr>";
      $id=0;
			while($row = $result->fetch_assoc()){
				$title = $row["title"];
				$url = $row["image"];
        if($id%2==0)
        { $id=0;
          echo "<tr></tr>";
        }
				echo "<td><img name='".$title."' class='projectImg' id='".$url."' src='".$url."' alt='Not able to display' />";
				echo "<br><center>".$title."<br>TAGS:".$row['tags']."</center></td>";
                echo "<td><button><a class='but' href='approved.php?pid=".$row['pid']."&stat=A'>APPROVE</a></button><button><a class='but' href='approved.php?pid=".$row['pid']."&stat=D'>DECLINE</a></button><div></td>";
                $id=$id+1;
			}echo "</tr></table>";
		}
		else{
			echo "<h3>No Projects to Display.</h3>";
		}
	?>

	
</body>
</html>