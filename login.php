<html>
	<head>
		<title>Log In</title>

		<style type="text/css">
			body{
				background-image: url("https://images.fridaymagazine.ae/1_2138767/imagesList_0/1270494007_main.jpg");
				background-repeat: no-repeat;
				background-size: cover;
			}

			.log{
				background-color: rgb(210,205,203,0.6);
				text-align: center;
				padding: 50px;
				margin: 0 auto;
				margin-top: 50px;
				font-size: 20px;
				width: 400px;
				bottom : 300px;
                border-radius: 30px;
			}

			.button{
				background-color: #008CBA;
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
			.sai{
			     color: red;
				 font-size : 28px;
				 }
			.faculty{
			    bottom : 270px ;
			    color : #111111 ;
				text-align: center;
			}
			.w3-myfont {
  				font-family: "Comic Sans MS", cursive, sans-serif;
			}
		     			
		</style>
	</head>

	<body>
		<button onclick="window.open('loginAdmin.php','_self');">Admin</button>
		<div>
		    <center>
		        <h1>Welcome to Uplabs</h1>
		    </center>
		</div>
		<?php
			if(isset($_POST['submit']))
			{
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

				$sql = "SELECT * FROM ulogin";
				$result = $conn->query($sql);

				$user = $_POST["user"];
				$pass = $_POST["pass"];

				if ($result->num_rows > 0) {
				    // output data of each row
				    $found = FALSE;
				    while($row = $result->fetch_assoc()) {
				        if($user == $row["email"]) {
				            $found = TRUE;
				        	if($pass == $row["password"]) {
                                $_SESSION["user"] = $row["uname"];
				        		header("Location:projects.php");
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

		 
		<form class="log"  action="login.php" method="POST">
			 <h2 class="faculty">LOGIN</h2>
		 
			E-Mail ID : <input type="text" name="user" placeholder="Enter email" required><br><br>
			Password : <input type="Password" name="pass" placeholder="Enter password" required><br><br>
			<input type="submit" name="submit" value="LogIn" class="button">

			<br><br><a href="forgetPass.php">Forgot Password?</a>
			<br><br>Don't have an account? <a href="signup.php">SignUp</a>
			
		</form>
          	
	</body>
</html>