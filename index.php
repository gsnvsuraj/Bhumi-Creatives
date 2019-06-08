<html>
	<head>
		<title>Log In</title>
        <link rel="stylesheet" href="styles/login.css">
        <link rel="stylesheet" type="text/css" href="styles/styles.css">
        <link rel="icon" type="image/ico" href="images/logo.png" />
	</head>

	<body>
		<button onclick="window.open('loginAdmin.php','_self');">Admin</button>
		<div>
		    <center>
		        <h1 class="loginName">Welcome to Creatives</h1>
		    </center>
		</div>
		
		<?php
			if(isset($_POST['submit']))
			{
				include 'connection.php';
				
				session_start();

				$sql = "SELECT * FROM ulogin";
				$result = $conn->query($sql);

				$user = mysqli_real_escape_string($conn, $_POST['user']);
				$pass = mysqli_real_escape_string($conn, $_POST['pass']);

				if ($result->num_rows > 0)
				{
				   
				    $found = FALSE;
				    while($row = $result->fetch_assoc())
				    {
				        if($user == $row["email"]) {
				            $found = TRUE;

				            $salted = '24@fu'.$pass.'45&deo';
							$hashed = hash('sha512', $salted);
				        	
				        	if($hashed == $row["password"])
				        	{
				        		
				        		if($row['verified'] != 'yes')
				        		{
				        			echo "\n<center><h3>Verify your account using the mail sent to your E-Mail.</h3></center>";
				        		}
				        		else
				        		{
                                	$_SESSION["user"] = $row["uname"];
				        			header("Location:projects.php");
				        			exit();
				        		}
				        	
				        	}
				        	else
				        	{
				        		echo "\n<center><h3>Incorrect password</h3></center>";
				        	}
				        }
				    }
				    if( $found == FALSE )
				    {
				    	echo "\n<center><h3>This E-Mail does not exist. Try signing up!!</h3></center>";
				    }

				}
				else
				{
				    echo "0 results";
				}
				$conn->close();
			}
		?>

		 
		<form class="log"  action="index.php" method="POST">
			 <h2 class="login">LOGIN</h2>
		 
			E-Mail ID : <input type="text" name="user" placeholder="Enter email" required><br><br>
			Password : <input type="Password" name="pass" placeholder="Enter password" required><br><br>
			<input type="submit" name="submit" value="LogIn" class="button">

			<br><br><a href="forgetPass.php">Forgot Password?</a>
			<br><br>Don't have an account? <a href="signup.php">SignUp</a>
			
		</form>
          	
	</body>
</html>