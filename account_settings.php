<?php
include("headerinc.php");
if ($user) {

}
else
{
 die ("You must be logged in to view this page!");
}
?>
<?php
$senddata=@$_POST['senddata'];
$senddata_about=@$_POST['senddata_about'];
$sendimage=@$_POST['submitimage'];

$getinfo="select * from users where username='$user'";
if($result=$con->query($getinfo))
  {
	  if($result->num_rows>0)
	  {
		  while($row=$result->fetch_array())
		  {
			  $db_firstname=$row[2];
			  $db_lastname=$row[3];
			  $db_bio=$row[8];
		  }
	  }
  }
if($senddata)
  {
	$old_password=@$_POST["oldpassword"];
	$new_password=@$_POST["newpassword"];
	$repeat_password=@$_POST["newpassword2"];
	
	if($new_password==$repeat_password)
	{
	$dbpass="select * from users where username='$user'";
	if($result=$con->query($dbpass))
	{
		if($result->num_rows>0)
		{ while($row=$result->fetch_array())
			{
				$oldpass=$row[5];
				echo"$oldpass";
				
			
	        
		if($oldpass==$old_password)
		{ 
	        $cmdpass="update users set password='$new_password' where username='$user'";
			if($con->query($cmdpass)==true)
			echo"succesfully updated";
		}
		else
		{
			echo"old password incorrect";
		}
			}
	}
	}
	}
	
}

  

			
 if($senddata_about)	
			 {  
		        $first_name=@$_POST["fname"];
	            $last_name=@$_POST["lname"];
				$bio=@$_POST["aboutyou"];
				$cmd2="update users set first_name='$first_name' ,last_name='$last_name',bio='$bio' where username='$user'";
				if($result=$con->query($cmd2))	
					echo"profile updated";
				 
			 }				 
			  
		  
if(isset($_FILES['image']))
{
	
	$errors=array();
	$filename=$_FILES['image']['name'];
	$filesize=$_FILES['image']['size'];
	$file_tmp=$_FILES['image']['tmp_name'];
	$filetype=$_FILES['image']['type'];
	$fileext=explode('.',$filename);
	$ext=strtolower($fileext[1]);
	$exp=array("jpeg","jpg","png");
	if(in_array($ext,$exp)==false)
	{
		$errors[]="not allowed";
		
	}
if($filesize>2097152)
{
	$errors[]="file size error";

	
}
if(empty($errors)==true)
{
	
	if(move_uploaded_file($file_tmp,"img/".$filename))
	{
		$update="update users set profile_pic='$filename' where username='$user'";
		if($updated=$con->query($update))
		{
	echo"<scipt>alert('successfully updated');</script>";	
	
		}
	
	}
	
else{
	echo "<script>alert('error in updating');</script>";
	
}
}	
else{
	
	print_r($errors);
	}
	
	
}
	  
	  

	
  
?>
<h2>Edit Your Profile Below :</h2>

<p style="font-family:verdana; font-weight:18px;"><b>UPDATE PROFILE PIC</b></p>
<?php
$getpp="select * from users where username='$user'";
if($results=$con->query($getpp))
{
	while($row=$results->fetch_array())
	{
		$pic=$row[9];
	}
	if($pic=="")
	{
		echo'<img src="default.png" />';
		
	}
	else{
		echo$pic."<br>";
		echo"<img src='img/".$pic."'/>";
	}
}
else{
	echo"query error";
}


?>
<form action="account_settings.php" method="post" enctype="multipart/form-data">
<input type="file" name="image"/>
<input type="submit" name="b1" value="submit"/>
</form>



<hr>
<form class="fbutton" action="#" method="post">
<p>CHANGE PASSWORD:</p>
<hr>
Old Password&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <input type="password" name="oldpassword" id="oldpassword" size="30"/><br>
New Password &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="newpassword" id="newpassword" size="30"/><br>
Confirm Password&nbsp;<input type="password" name="newpassword2" id="newpassword" size="30"/><br><br>
<input type="submit" name="senddata" id="senddata" value="Save Changes"/>
<hr>
<p>Update profile information:</p>
First name:<input type="text" name="fname" id="fname" size="40" value="<?php echo$db_firstname;?>"/><br>
Last  name:<input type="text" name="lname" id="lname" size="40"value="<?php echo$db_lastname;?>"/><br>
About you:<br><textarea name="aboutyou" id="aboutyou" cols="80" rows="8"><?php echo$db_bio;?></textarea><br><br>

<input type="submit" name="senddata_about" id="senddata" value="Save Changes"/>
</form>

</div>
</body>
</html>