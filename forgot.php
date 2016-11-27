<?php include("headerinc.php"); ?>
<?php


echo"Enter your username<br>";
echo'<form action="forgot.php" method="post">
		<input type="text" name="username" size="20"/><br>
		<input type="submit" name="submitusername" value="Submit"/>
		</form>';
		
if(isset($_POST['submitusername']))
{
$userchange=$_POST['username'];
$_SESSION['changeuser']=$userchange;

$getques="select * from users where username='$userchange'";
if($result=$con->query($getques))
{
	if($result->num_rows>0)
	{
		while($row=$result->fetch_array())
		{
			$ques=$row[11];
			$ans=$row[12];
		$_SESSION['answer']=$ans;
		
		echo'<p>'.$ques.'</p><br>
		<form action="change.php" method="post">
		<input type="text" name="youranswer" size="20"/><br>
		<input type="submit" name="submit" value="Submit"/>
		</form>';


		}
	}
}
}
	

?>