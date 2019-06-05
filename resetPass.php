<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>

	<style type="text/css">
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
	</style>
</head>
<body>

	<?php
		if(isset($_POST['subPass']))
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

			$user = $_SESSION['user'];

			$pass = $_POST['pass'];
			$conPass = $_POST['conPass'];

			if($pass == $conPass)
			{
				$sql = "UPDATE ulogin SET password='".$pass."' WHERE uname='".$user."';";
				$result = $conn->query($sql);

        		header('location:login.php');
        		exit();
			}
			else{
				echo "<center><h3>Both Passwords not same.Try again !!</h3></center>";
			}
		}

	?>

	<center>
		<form method="post" action="resetPass.php" class="log">
			<h3>RESET PASSWORD</h3>
			<br>New Password : <input type="password" name="pass" placeholder="Enter Password" required/><br><br>
			Confirm New Password : <input type="password" name="conPass" placeholder="Enter Confirm Password" required/><br><br>
			<input type="submit" name="subPass" value="Change Password" class="button" />
		</form>
	</center>

</body>
</html>