<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>

	<link rel="stylesheet" type="text/css" href="styles/styles.css">
	<link rel="icon" type="image/ico" href="images/logo.png" />
</head>
<body>

	<?php
		session_start();

		if(isset($_SESSION['user']))
			$user = $_SESSION['user'];
		else
			header("Location:index.php");

		if(isset($_POST['subPass']))
		{
			include 'connection.php';

			$pass = mysqli_real_escape_string($conn, $_POST['pass']);
			$conPass = $_POST['conPass'];

			if($pass == $conPass)
			{
				$salted = '24@fu'.$pass.'45&deo';
				$hashed = hash('sha512', $salted);

				$sql = "UPDATE ulogin SET password='".$hashed."' WHERE uname='".$user."';";
				$result = $conn->query($sql);

        		$_SESSION['msg'] = "Your Password has been changed successfully.";
        		header('location:myProfile.php');
        		exit();
			}
			else{
				echo "<center><h3>Both Passwords not same.Try again !!</h3></center>";
			}
			$conn->close();
		}

	?>

	<center>
		<form method="post" action="resetPassPro.php" class="log">
			<h3>RESET PASSWORD</h3>
			<br>New Password : <input type="password" name="pass" placeholder="Enter Password" required/><br><br>
			Confirm New Password : <input type="password" name="conPass" placeholder="Enter Confirm Password" required/><br><br>
			<input type="submit" name="subPass" value="Change Password" class="button" />
		</form>
	</center>

</body>
</html>