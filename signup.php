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
			
			.login{
			    bottom : 270px ;
			    color : #111111 ;
				text-align: center;
			} 
			td{
				padding:5px;
			}
		     			
		</style>
	</head>

	<body>
		
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
                session_start();
				$conn = new mysqli($servername, $username, $password, $dbname);

				// Check connection
				if ($conn->connect_error) {
				    die("Connection failed: " . $conn->connect_error);
				}
				//echo "Connected successfully";

				$flag=0;

				$user = $_POST["user"];
				$pass = $_POST["pass"];
				$email=$_POST["email"];
				$copass=$_POST["conpass"];
				if($pass != $copass)
				{
                    echo "\n<center><h3>Both Passwords are not same!!</h3></center>";
                    $flag=1;
				}
				
				function valid_email($str)
				{
						return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
						$flag=1;
				}

				if(!valid_email($email))
				{
					echo "\n<center><h3>Invalid E-Mail Address!!</h3></center>";
					$flag=1;
				}
				else{

   					$q1="SELECT * FROM ulogin WHERE uname= '".$user."' ;";
   					$q2="SELECT * FROM ulogin WHERE email='".$email."';";
   					
   					$r1=$conn->query($q1);
   					$r2=$conn->query($q2);
   					
   					if($r1->num_rows!=0 )
   					{
                		echo "\n<center><h3>Username already exists. Use another Username.</h3></center>"; 
                		$flag=1;
                	}
   				    
   				    if($r2->num_rows!=0)
   				    {	
   				    	echo "\n<center><h3>E-Mail ID already exists. Use another E_Mail ID.</h3></center>";
   				      	$flag=1;
   				  	}

   				  	if($flag==0)
   				  	{
   				  		$q3="INSERT INTO ulogin VALUES('".$email."','".$pass."','".$user."')";
   				  		if($conn->query($q3))
   				  		{   
   				  			$_SESSION["user"]=$user;
   				  			header("location:projects.php");
   				  			exit();
   				  		}

   				  	}	
				}

				
				$conn->close();
			}
		?>

		 
		<form class="log"  action="signup.php" method="POST">
			 <h2 class="login">SIGN UP</h2>
		<center> <table><tr>
			<td>Username :</td><td> <input type="text" name="user" placeholder="Enter Username" required></td></tr>
			<tr><td>Email : </td><td><input type="text" name="email" placeholder="Enter email" required></td></tr>
			<tr><td>Password :</td><td> <input type="password" name="pass" placeholder="Enter password" required></td></tr>
			<tr><td>Conform Password :</td><td> <input type="Password" name="conpass" placeholder="conform password" required></td></tr></table><br><br>
			<input type="submit" name="submit" value="SignUp" class="button">
        </center>
			<br><br>Already have an account? <a href="login.php">LogIn</a>
			
		</form>
          	
	</body>
</html>