<html>
	<head>
		<title>Admin Log In</title>
        <link rel="stylesheet" href="styles/login.css">
		<link rel="stylesheet" type="text/css" href="styles/styles.css">
	</head>

	<body>
		<button onclick="window.open('index.php','_self');">User</button>
		<div>
		    <center>
		        <h1 class="loginName">Welcome to Creatives Admin</h1>
		    </center>
		</div>
		<?php
			if(isset($_POST['submit']))
			{
				include 'connection.php';

				session_start();

				$sql = "SELECT * FROM admin";
				$result = $conn->query($sql);

				$user = $_POST["user"];
				$pass = $_POST["pass"];

				if ($result->num_rows > 0) {
				    // output data of each row
				    $found = FALSE;
				    while($row = $result->fetch_assoc()) {
				        if($user == $row["uname"]) {
				            $found = TRUE;
				        	if($pass == $row["password"]) {
                                $_SESSION["user"] = "admin";
                                
				        		header("Location:projectsAdmin.php");
				        		exit();
				        	}
				        	else {
				        		echo "\n<center><h3>Incorrect password</h3></center>";
				        	}
				        }
				    }
				    if( $found == FALSE ) {
				    	echo "\n<center><h3>Invalid User. Try again!!</h3></center>";
				    }

				} else {
				    echo "0 results";
				}
				$conn->close();
			}
		?>

		 
		<form class="log"  action="loginAdmin.php" method="POST">
			 <h2 class="login">LOGIN</h2>
		 
			E-Mail ID : <input type="text" name="user" placeholder="Enter email" required><br><br>
			Password : <input type="Password" name="pass" placeholder="Enter password" required><br><br>
			<input type="submit" name="submit" value="LogIn" class="button">
			
		</form>
          	
	</body>
</html>