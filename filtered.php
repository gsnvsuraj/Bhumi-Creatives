<!DOCTYPE html>
<html>
<head>
	<title>Projects</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
 	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
	<link rel="stylesheet" type="text/css" href="styles/projects.css">
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
    
        $search = strtolower($_POST['filter']);
        $search = str_replace(" ",",",$search);
        $searcharr = preg_split( "/[,]+/", $search );
    
		$sql = "SELECT * FROM project;";
		$result = $conn->query($sql);

		if ($result->num_rows > 0)
		{
			echo "<center><form class='example' action='filtered.php' method='POST' style='margin:auto;max-width:300px'>
  <input type='text' placeholder='Search..' name='filter' required>
  <button type='submit'><i class='fa fa-search'></i></button>
</form></center>";
			$found = 0;
			while($row = $result->fetch_assoc())
			{
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
                        	echo "<div class='w3-btn w3-col m4 l3'><a onclick='redir()'><img name='".$title."' class='projectImg' id='".$row['pid']."' src='".$url."' alt='Not able to display' /><br>";
				
				        	echo "<center><b>".$title."<br>Tags </b>: ".$row['tags']."</center></a></div>";
                        
                        	$flag = 1;
                        	$found = 1;
                        	break;
                    	}
                	}
                	if( $flag )
                    	break;
				}
            }

            if( $found == 0 )
            	echo "<center><h4>There's no result for the filter tags. Try something else :)</h4></center>";
		}
		else{
			echo "<h3>No Projects to Display.</h3>";
		}


		$conn->close();
	?>

	<script type='text/javascript'>
		function redir() {
			window.open('imgDisplay.php?pid='+event.srcElement.id,'_self');
		}
	</script>

</body>
</html>