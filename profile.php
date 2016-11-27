<?php include("headerinc.php"); 
error_reporting(0);

?>
<?php
    
	$username=$_SESSION['user_login'];
 	
	$check = "SELECT * FROM users WHERE username='$username'";
	if (($result=$con->query($check))) 
	{   if($result->num_rows>0)
		{
		while($rows=$result->fetch_array())
		{
	$username=$rows[1];
	
     
	}
	}
	
	else{
		echo "no user exists";
		exit();
	}
	
	}

	
?>

<?php
$picq="select * from users where username='$username'";
if($result=$con->query($picq))
{
	while($rows=$result->fetch_array())
	$pic=$rows[9];


}
if($pic=="")
	echo'<img id="profileimage" style="border:1px solid #ccc;"src="default.png" height="200"  alt="'.$username.'Profile" title="'.$username.'  Profile"/> ';
else{
	
	echo'<img id="profileimage" src="img/'.$pic.'" height="200"/>';
}
?>

<br>



<div class="profilecategories">


<a href="profile.php?cat=football"><img id="baseball" src="football.png" /></a>
<a href="profile.php?cat=golf"><img id="baseball" src="golf.png" /></a>
<a href="profile.php?cat=basketball"><img id="baseball"src="basketball.png" /></a>
<a href="profile.php?cat=baseball"><img id="baseball"src="baseball.png" /></a>
<a href="profile.php?cat=cricket"><img id="baseball"src="cricket.png" /></a>
</div>
<br><br>
<div class="postform" >
<form  method="POST">
<textarea id="post" name="post" rows="5" cols="80"></textarea><br>

<input id="postbutton" type="submit"  name="send" value="Post"  />
</form>

<br>


</div>


<?php
$category=$_GET['cat'];

$allposts="";

if($category==null)
{
	$showpost="select * from posts where added_by='$username' order by id DESC";
	echo'<div class="profilepostsheading">';
	echo 'Your Posts</div>';
if($result=$con->query($showpost))
	{
		if($result->num_rows>0)
		{ while($row=$result->fetch_array())
			{    $id=$row[0];
				$allpost=$row[1];
				$dateadded=$row[2];
				$postedby=$row[3];
				$getuserpic="select * from users where username='$postedby'";
				if($got=$con->query($getuserpic))
				{  while($rows=$got->fetch_array())
				    $pic=$rows[9];
				}
				
			
			echo '<div class="profileposts">';
			
			echo'<div style="float:left; margin-right:5px;">';
			if($pic=="")
			echo'<img src="default.png" height="70"/>';
		else{
			echo'<img src="img/'.$pic.'" height="70"/>';
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
					    echo'<iframe src="comment_frame.php?id='.$id.'" frameborder="0" width="550px" max-height="20px"> </iframe>';
					echo'</div>';
					
			$getc="select * from posts where added_by='$postedby'";				
					echo'<div id="toggleBox'.$id.'" style="display:none;">';
					    echo'<iframe src="box_frame.php?id='.$id.'" frameborder="0" width="550px" max-height="20px"> </iframe>';
					echo'</div>';
					
					
					  
			
			
			echo'</div>';
			
			echo'</div>';
			}
			
		}
	}
}
	

else{
$showpost="select * from posts where user_posted_to='$category' order by id DESC";

	echo'<div class="profilepostsheading">';
	echo $category.'</div>';
if($result=$con->query($showpost))
	{
		if($result->num_rows>0)
		{ while($row=$result->fetch_array())
			{   $id=$row[0];
				$allpost=$row[1];
				$dateadded=$row[2];
				$postedby=$row[3];
				$getuserpic="select * from users where username='$postedby'";
				if($got=$con->query($getuserpic))
				{  while($rows=$got->fetch_array())
				    $pic=$rows[9];
				}
			echo '<div class="profileposts">';
			
			echo'<div style="float:left; margin-right:5px;">';
			if($pic=="")
			echo'<img src="default.png" height="70"/>';
		else{
			echo'<img src="img/'.$pic.'" height="70"/>';
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
					    echo'<iframe class="cframe" src="comment_frame.php?id='.$id.'" > </iframe>';
					echo'</div>';
					
			$getc="select * from posts where added_by='$postedby'";				
					echo'<div id="toggleBox'.$id.'" style="display:none;">';
					    echo'<iframe class="gframe" src="box_frame.php?id='.$id.'" > </iframe>';
					echo'</div>';
					
			
			
			
			
			
			echo'</div>';
			echo'</div>';
			}
		}
	}
}
?>
<?php
if(isset($_POST['send']))
{   $body=$_POST['post'];
    $d=date("Y-m-d");
	
	if(!empty($body)){
	$postit="insert into posts values('0','$body','$d','$user','$category')";
	if($con->query($postit))
	{
		header("location:#");
	}
	else{
		//echo"query error";
	}
	}
	else{
		echo"please write something ";
	}
	
}


?>






<div class="profileleftsidecontentbio">
<?php
$about_query="select * from users where username='$username'";
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


<div class="textheaderfriend"><b><?php echo $username;?>'s Friends</b></div>
<div class="profileleftsidecontentfriends">
<?php
$fquery="select * from users where username='$username'";
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

</body>
</html>