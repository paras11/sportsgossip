<?php include("headerinc.php"); 


?>
<?php
    
	//$showusername=$_SESSION['u_s'][2];
	$showusername=$_GET['user'];
 	
	$check = "SELECT * FROM users WHERE username='$showusername'";
	if (($result=$con->query($check))) 
	{   if($result->num_rows>0)
		{
		while($rows=$result->fetch_array())
		{
	$showusername=$rows[1];
	$first=$rows[2];
	$second=$rows[3];
	
     
	}
	}
	
	else{
		echo "no user exists";
		exit();
	}
	
	}

	
?>


<div>
<div class="textheader"><b><?php echo $showusername;?>'s profile</b></div>
<?php
$picq="select * from users where username='$showusername'";
if($result=$con->query($picq))
{
	while($rows=$result->fetch_array())
	$pic=$rows[9];


}
if($pic=="")
	echo'<img id="profileimage" src="default.png" height="200"  alt="'.$showusername.'Profile"title="'.$showusername.'  Profile"/> ';
else{
	echo'<img id="profileimage" src="img/'.$pic.'" height="200"  alt="'.$showusername.'Profile"title="'.$showusername.'  Profile"/> ';
	
}
?>

</div>



<div class="categories">

<?php
echo '<a href="userprofile.php?cat=football&user='.$showusername.'"><img id="football" src="football.png" /></a>
<a href="userprofile.php?cat=golf&user='.$showusername.'"><img id="golf" src="golf.png" /></a>
<a href="userprofile.php?cat=basketball&user='.$showusername.'"><img id="basketball"src="basketball.png" /></a>
<a href="userprofile.php?cat=baseball&user='.$showusername.'"><img id="baseball"src="baseball.png" /></a>
<a href="userprofile.php?cat=cricket&user='.$showusername.'"><img id="baseball"src="cricket.png" /></a>';
?>
</div>
<br>



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
			{   $id=$row[0];
				$allpost=$row[1];
				$dateadded=$row[2];
				$postedby=$row[3];
				$takepic="select * from users where username='$showusername'";
				if($r=$con->query($takepic))
				{  while($ro=$r->fetch_array())
					$pic=$ro[9];
				}
			echo '<div class="profileposts">';
			
			echo'<div style="float:left; margin-right:5px;">';
			if($pic=="")
			{ echo'<img src="default.png" height="70"/>';}
		else
		{
			echo'<img src= "img/'.$pic.'"   height="70"/>';
		}
		echo'</div>';
		    echo '<u><b><a href=userprofile.php?cat=&user='.$postedby.'>'.$postedby.'</a></b></u><br>';
			echo $allpost.'<div id="mark" > Posted on <br>'.$dateadded.'</div>';
			
			echo'<br><br><br><div class="options"><a href="javascript:;" onClick="javascript:toggle'.$id.'()"><img src="post.png" height="17"/> Show Comments</a><a href="javascript:;" onClick="javascript:togglebox'.$id.'()"><img src="post.png" height="17"/>Reply</a><br>';
			echo'<script language="javascript">
         function toggle'.$id.'() {
           var ele = document.getElementById("toggleComment'.$id.'");
           var text = document.getElementById("displayComment'.$id.'");
           if (ele.style.display == "block") {
              ele.style.display = "none";
           }
           else
           {
             ele.style.display = "block";
           }
         }
</script>';
echo'<script language="javascript">
         function togglebox'.$id.'() {
           var ele = document.getElementById("toggleBox'.$id.'");
           var text = document.getElementById("displayBox'.$id.'");
           if (ele.style.display == "block") {
              ele.style.display = "none";
           }
           else
           {
             ele.style.display = "block";
           }
         }
</script>';
			$getcomments="select * from post_comments where posted_id='$id'";	
			
			
					echo'<div id="toggleComment'.$id.'" style="display:none;">';
					    echo'<iframe class="cframe"src="comment_frame.php?id='.$id.'" frameborder="0" width="560px" > </iframe>';
					echo'</div>';
					
			$getc="select * from posts where added_by='$postedby'";				
					echo'<div id="toggleBox'.$id.'" style="display:none;">';
					    echo'<iframe class="rframe" src="box_frame.php?id='.$id.'" frameborder="0"; width="560px" > </iframe>';
					echo'</div>';
			
			
			
			echo"</div>";
			
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
			{    $id=$row[0];
				$allpost=$row[1];
				$dateadded=$row[2];
				$postedby=$row[3];
				$takepic="select * from users where username='$showusername'";
				if($r=$con->query($takepic))
				{  while($ro=$r->fetch_array())
					$pic=$ro[9];
				}
				
			echo '<div class="profileposts">';
			
			echo'<div style="float:left; margin-right:5px;">';
			if($pic=="")
			{ echo'<img src="default.png" height="70"/>';}
		else
		{
			echo'<img src= "img/'.$pic.'"   height="70"/>';
		}
		echo'</div>';
		echo '<u><b><a href=userprofile.php?cat=&user='.$postedby.'>'.$postedby.'</a></b></u><br>';
			
			echo $allpost.'<div id="mark" ><br>'.$dateadded.'</div>';
			
			echo'<br><br><br><div class="options"><a href="javascript:;" onClick="javascript:toggle'.$id.'()"><img src="post.png" height="17"/> Show Comments</a><a href="javascript:;" onClick="javascript:togglebox'.$id.'()"><img src="post.png" height="17"/>Reply</a><br>';
			echo'<script language="javascript">
         function toggle'.$id.'() {
           var ele = document.getElementById("toggleComment'.$id.'");
           var text = document.getElementById("displayComment'.$id.'");
           if (ele.style.display == "block") {
              ele.style.display = "none";
           }
           else
           {
             ele.style.display = "block";
           }
         }
</script>';
echo'<script language="javascript">
         function togglebox'.$id.'() {
           var ele = document.getElementById("toggleBox'.$id.'");
           var text = document.getElementById("displayBox'.$id.'");
           if (ele.style.display == "block") {
              ele.style.display = "none";
           }
           else
           {
             ele.style.display = "block";
           }
         }
</script>';
			$getcomments="select * from post_comments where posted_id='$id'";	
			
			
					echo'<div id="toggleComment'.$id.'" style="display:none;">';
					    echo'<iframe class="cframe"src="comment_frame.php?id='.$id.'" frameborder="0" width="560px" > </iframe>';
					echo'</div>';
					
			$getc="select * from posts where added_by='$postedby'";				
					echo'<div id="toggleBox'.$id.'" style="display:none;">';
					    echo'<iframe class="rframe" src="box_frame.php?id='.$id.'" frameborder="0"; width="560px" > </iframe>';
					echo'</div>';
			
			
			echo'</div>';
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
			echo"<script language='javascript'> alert('you have already sent request to this user');</script>";
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
	$already=0;
	$fquery="select * from users where username='$user'";
   if($result=$con->query($fquery))
{
	while($row=$result->fetch_array())
	{   
		$list=$row[10];
	}
	$a=explode(',',$list);
	foreach($a as $t)
	{
		
		if($t==$showusername){
			$already=1;
		
		}
	}
}
if($already==0)	{
echo'<form  method="post">';

echo'<br>';
echo'<div class="myname"><b>'.$first.'&nbsp;'.$second.'</b></div>';

echo'<br><br><br>';
echo $errormsg;
echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=submit value="Add as Friend" name="addfriend"/>
</form>';
}
else{
	echo'<div class="myname"><b>'.$first.'&nbsp;'.$second.'</b></div>';
	echo"<br><br><br><br><br><br>&nbsp;<text style='border:1px solid black; background-color:#47630D; text-align:center; border:1px solid #00508D;
    font-size:17px;
    color:white;
    padding:5px 70px; margin-left:1px; margin-top:5px;'>Friends</text>";
}
}
?>


<div class="profileleftsidecontentbio">
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

<div class="textheaderfriend"><?php echo $showusername;?>'s Friends</div>

<div class="profileleftsidecontentfriend">
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
		           echo'<a href=userprofile.php?cat=&user='.$t.'><img src="default.png" height="40" title="'.$t.'" /></a>&nbsp;';
					}
					else{
						echo'<a href=userprofile.php?cat=&user='.$t.'><img src="img/'.$ppic.'" height="40" title="'.$t.'"/></a>&nbsp;';
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