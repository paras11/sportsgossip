<?php include("headerinc.php"); 


?>
<?php
    
	$showusername=$_SESSION['"s'.$postedby.'"'];
	
 	
	$check = "SELECT * FROM users WHERE username='$showusername'";
	if (($result=$con->query($check))) 
	{   if($result->num_rows>0)
		{
		while($rows=$result->fetch_array())
		{
	$showusername=$rows[1];
	
     
	}
	}
	
	else{
		echo "no user exists";
		exit();
	}
	
	}

	
?>


<div>
<?php
$picq="select * from users where username='$user'";
if($result=$con->query($picq))
{
	while($rows=$result->fetch_array())
	$pic=$rows[9];


}
if($pic=="")
	echo'<img id="profileimage" src="default.png" height="200"  alt="'.$showusername.'Profile"title="'.$showusername.'  Profile"/> ';
?>

</div>


<div class="categories">


<a href="userprofile.php?cat=football"><img id="football" src="football.png" /></a>
<a href="userprofile.php?cat=golf"><img id="golf" src="golf.png" /></a>
<a href="userprofile.php?cat=basketball"><img id="basketball"src="basketball.png" /></a>
<a href="userprofile.php?cat=baseball"><img id="baseball"src="baseball.png" /></a>
<a href="userprofile.php?cat=cricket"><img id="baseball"src="cricket.png" /></a>
</div>
<br><br>



<?php
$category=$_GET['cat'];

$allposts="";

if($category==null)
{
	$showpost="select * from posts where added_by='$showusername' order by id DESC";
	
if($result=$con->query($showpost))
	{
		if($result->num_rows>0)
		{ while($row=$result->fetch_array())
			{
				$allpost=$row[1];
				$dateadded=$row[2];
				$postedby=$row[3];
			echo '<div class="profileposts">';
			
			echo'<div style="float:left; margin-right:5px;"><img src="default.png" height="70"/></div>';
			echo '<u>'.$postedby.'</u><br>';
			echo $allpost.'<div id="mark" > Posted on <br>'.$dateadded.'</div>';
			echo'</div>';
			}
		}
		else{
			echo"<div class='noprofileposts'>No posts by user.</div>";
		}
	}
}
	

else{
$showpost="select * from posts where user_posted_to='$category' and added_by='$showusername' order by id DESC";
	
if($result=$con->query($showpost))
	{
		if($result->num_rows>0)
		{ while($row=$result->fetch_array())
			{
				$allpost=$row[1];
				$dateadded=$row[2];
				$postedby=$row[3];
			echo '<div class="profileposts">';
			
			echo'<div style="float:left; margin-right:5px;"><img src="default.png" height="70"/></div>';
			echo '<u>'.$postedby.'</u><br>';
			echo $allpost.'<div id="mark" ><br>'.$dateadded.'</div>';
			echo'</div>';
			}
		}
		
		else{
			echo"<div class='noprofileposts'>No posts by user</div>";
		}
	}
	else{
	echo"query problem";
	}
}
?>

<?php 
$errormsg="";
if(isset($_POST["addfriend"]))
{   
	$friend_request=$_POST["addfriend"];
	$user_to=$showusername;
	$user_from=$user;
	$alreadycheck="select * from friend_requests where user_from='$user_from' and user_to='$user_to' ";
	if($result=$con->query($alreadycheck))
	{
		if($result->num_rows>0)
		{
			echo"you have already sent request to this user";
		}
		
	else{ 
	
	    if($user_to==$user_from)
		      $errormsg="u cant send friend request to youself ";
	   else{
		$create_request="insert into friend_requests values('0','$user_from','$user_to')";
		if($result=$con->query($create_request)){
			echo"request has been sent";
		     }
		else{
			echo"error";
		    }
	       }
	   }
		
		
		
		
	}
	
	
}
else{
	
}
?>
<br>
<?php 
if($user)
{
echo'<form  method="post">';
echo $errormsg;
echo'<br>';

echo'<input type=submit value="Add as Friend" name="addfriend"/>
</form>';
}
?>

<div class="textheader"><?php echo $showusername;?>'s profile</div>
<div class="profileleftsidecontent">
<?php
$about_query="select * from users where username='$showusername'";
if($result=$con->query($about_query))
	{
		if($result->num_rows>0)
		{ while($row=$result->fetch_array())
			{
				$about=$row[8];
				echo $about;
			}
		}
	}
?>
</div>

<div class="textheader"><?php echo $showusername;?>'s followers</div>

<div class="profileleftsidecontent">
<?php
$fquery="select * from users where username='$showusername'";
if($result=$con->query($fquery))
{
	while($row=$result->fetch_array())
	{   
		$list=$row[10];
	}
	$a=explode(',',$list);
	foreach($a as $t)
	{   $getpic="select * from users where username='$t'";
	    if($result=$con->query($getpic))
		{     while($row=$result->fetch_array())
		       {   $ppic=$row[9];
		           if($ppic==""){
		           echo'<img src="default.png" height="40" title="'.$t.'" />&nbsp;';
					}
					else{
						echo'<img src='.$ppic.' height="40" title="'.$t.'"/>&nbsp;';
					}
		       }
		}
	}
}

?>

</div>

</div>
<div class="searchwidget">
<form  method="post" action="search.php">
<input type="text" name="searchbox" /><br>
<input type="submit" name="search" value="find"/>
</form>

</div>
</body>
</html>