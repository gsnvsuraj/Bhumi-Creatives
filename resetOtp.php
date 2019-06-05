<!DOCTYPE html>
<html>
<head>
	<title>Reset OTP</title>

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

		if(isset($_POST['subOtp']))
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

			if($_SESSION['otp'] == $_POST['otp'])
			{
				header('location:resetPass.php');
				exit();
			}
			else{
				echo "<center><h3>Incorrect OTP. Try again!!</h3></center>";
			}
		}
	?>

	<center>

		<form method="post" action="resetOtp.php" class="log">
			<h2>Reset OTP</h2>
			OTP : <input type="text" name="otp" maxlength="6" pattern="\d{6}" placeholder="Enter 6 digit OTP" required/><br><br>
			<input type="submit" name="subOtp" value="Submit OTP" class="button" />
		</form>
	</center>

</body>
</html>