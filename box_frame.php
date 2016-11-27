<?php
session_start();
if(!isset($_SESSION['user_login']))
{
	$user="";
}
else{
	$user=$_SESSION['user_login'];
	
}
$postedby_user="";
$getid=$_GET['id'];
//$_SESSION['id']=$getid;

$con=new mysqli("localhost","root","","sports");

echo'<form  method="post">';
echo'<textarea name="postcomment" rows=3 cols=70></textarea><br>';
echo'<input type="submit" name="postcommentbutton"/>';
echo'</form>';
if(isset($_POST['postcommentbutton']))
{    
//$getid=$_SESSION['id'];
	$reply=$_POST['postcomment'];
	{  $postdetails="select * from posts where id='$getid'";
	if($res=$con->query($postdetails)){
		if($res->num_rows>0)
		{
		
		while($row=$res->fetch_array())
		{
			//$postedby_user=$row[1];
		}
		}
		else{
			echo "no record";
		}
		if(!empty($reply))
		{
			$cmd="insert into post_comments values(0,'$reply','$user','$getid','$getid')";
			if($con->query($cmd)==true)
			{
				echo"<script>alert('Replied Succesfully');</script>";
				//echo $postedby_user;
			
			}
			
			
		}
		else{
			echo"post cant b empty";
		}
		
		
	   }
	   else{
		   echo"query";
	   }
	}
	
	
	
	
	
}

?>