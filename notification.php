<!DOCTYPE html>
<html>
<head>
	<title>Projects</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

 	<link rel="stylesheet" type="text/css" href="styles/styles.css">

</head>
<body>

	<?php
		include 'header.php';
		include 'connection.php';

		session_start();

		if(isset($_SESSION['user']))
			$user = $_SESSION['user'];
		else
			header("Location:index.php");

		$sql = "SELECT * FROM notification WHERE uname='".$user."';";
		$result = $conn->query($sql) or die($conn->error);

		if ($result->num_rows > 0){
			echo "<h3 class='w3-container'>Notifications are -</h3>";
			while($row = $result->fetch_assoc()){
				$message = $row['message'];
				$dates = $row['dateCheck'];
				
				echo "<br><div class='w3-container'>".$dates."<br><b>Message</b> - ".$message."</div><br><br>";

				$sql = "UPDATE notification SET status='read' WHERE uname='".$user."';";
				$result1 = $conn->query($sql);
			}
		}
		else{
			echo "<h3 class='w3-container'>No Notifications to Display.</h3>";
		}
		$conn->close();
	?>

</body>
</html>