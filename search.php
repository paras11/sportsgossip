<?php include("headerinc.php");?>

<?php
if(isset($_POST["search"]))
{
	$search_username=$_POST["searchbox"];
	//$_SESSION['u_s']=$search_username;
	$search_query="select * from users where username='$search_username'";
	if($result=$con->query($search_query))
	{
		if($result->num_rows>0)
		{
			while($row=$result->fetch_array())
			{    
				$search_fname=$row[2];
				$search_lname=$row[3];
$search_pp=$row[9];
				echo'<div id="result">';
echo'<img src="img/'.$search_pp.'" height="80"/><br>';

				echo$search_fname." ";
				echo$search_lname;

				echo'<br><a href=userprofile.php?cat=&user='.$search_username.'> visit profile</a>';
				echo'</div>';
				
				
			}
		}
		else{
			echo'<div class="result">';
		echo"No such user exists</div>";
	}
	}
	
	
	
}
?>
</div>
</body>
</html>