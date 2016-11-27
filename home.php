<?php
error_reporting(0);
 
 include("headerinc.php");
 if(!isset($_SESSION['user_login']))
{
	header("location:index.php");
}
else{
	echo "<div id='welcome'>Welcome ". $user." !</div>";


	
}
 

?>
<div class="categories">


<a href="home.php?cat=newsfeed"><img id="baseball" src="newsfeed.png" /></a>
<a href="home.php?cat=upcoming"><img id="baseball" src="upcoming.png" /></a>
<a href="home.php?cat=results"><img id="baseball"src="trophy.png" /></a>
<a href="home.php?cat=onthisday"><img id="baseball"src="2.png" /></a>
<a href="home.php?cat=polls"><img id="baseball"src="results.png" /></a>

</div>

<?php 
$category=@$_GET["cat"];
$allposts="";
$_SESSION['u_s']=array();
$myq="select * from users";
if($myresult=$con->query($myq))
{
	
	while($myrow=$myresult->fetch_array())
	{
		$_SESSION['u_s'][]=$myrow[1];
	}
}
if($category==null||$category=="newsfeed")
{
	$showpost="select * from posts where added_by!='$user' order by id DESC";   //user ==username in home page
	echo'<div class="homepostsheading">';
	echo'Newsfeed</div>';
if($result=$con->query($showpost))
	{
		if($result->num_rows>0)
		{   
	           while($row=$result->fetch_array())
			{   $id=$row[0];
				$allpost=$row[1];
				$dateadded=$row[2];
				$postedby=$row[3];
				$allow=0;
				$afriend="select * from users where username='$user'";
				if($checking=$con->query($afriend))
				{
					while($frow=$checking->fetch_array())
					{
						
					$list=$frow[10];
	                  }
	                $a=explode(',',$list);
	                foreach($a as $t)
	               {
		
		                if($t==$postedby){
			                 $allow=1;
		
		                     }
	                 }
				} 
				if($allow==1)
				{
				$getuserpic="select * from users where username='$postedby'";
				
				if($got=$con->query($getuserpic))
				{  while($rows=$got->fetch_array())
				    $pic=$rows[9];
				}
				//$_SESSION['u_s'][]=$postedby;
			echo '<div class="homeposts" >';
			echo'<div style="float:left; margin-right:5px;">';
			if($pic=="")
				echo'<img src="default.png" height="70" style="border:1px solid #ccc;"/>';
			else{
				echo'<img src="img/'.$pic.'" height="70" style="border:1px solid #ccc;"/>';
			}
			echo'</div>';
			echo '<u><b><a href=userprofile.php?cat=&user='.$postedby.'>'.$postedby.'</a></b></u><br>';
			echo $allpost.'<div id=mark> Posted on <br>'.$dateadded.'</div>';
			
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
		}
	}
}
	

else{
	if($category=="results"){
$showpost="select * from results order by id DESC ";
	echo'<div class="homepostsheading">';
	echo'Results</div>';
if($result=$con->query($showpost))
	{
		if($result->num_rows>0)
		{ while($row=$result->fetch_array())
			{   $id=$row[0];
				$allpost=$row[1];
				$dateadded=$row[2];
				$postedtype=$row[3];
			echo '<div class="homeposts">';
			echo '<u><b>'.$postedtype.'</b></u><br>';
			echo $allpost.'<div id="mark" ><br>'.$dateadded.'</div>';
			
			
			
			
			
			
			echo'</div>';
			}
		}
	}
	}
	
	if($category=="upcoming"){
		
$showpost="select * from events where status='0' ";
	echo'<div class="homepostsheading">';
	echo'Upcoming Events</div>';
if($result=$con->query($showpost))
	{
		if($result->num_rows>0)
		{ while($row=$result->fetch_array())
			{   
				$postedtype=$row[1];
				$date=$row[2];
				$body=$row[3];
			echo '<div class="homeposts">';
			echo '<u><b>'.$postedtype.'</b></u><br>';
			echo $body.' <i>Starting from</i> <b>'.$date.'</b>';
			
			
			
			
			
			
			echo'</div>';
			}
		}
	}
	}
	
	if($category=="onthisday"){
		$d=date("Y-m-d");
$showpost="select * from history where date='$d' ";
    
	echo'<div class="homepostsheading">';
	echo'On This Day</div>';
if($result=$con->query($showpost))
	{
		if($result->num_rows>0)
		{ while($row=$result->fetch_array())
			{   
				$allpost=$row[1];
				
			echo '<div class="homeposts">';
			
			echo $allpost.'<div id="mark" ></div>';
			
			
			
			
			
			
			echo'</div>';
			}
		}
	}
	}
	
	if($category=="polls"){
		
$showpost="select * from polls  ";
    
	echo'<div class="homepostsheading">';
	echo'Polls Statistics</div>';
if($result=$con->query($showpost))
	{
		if($result->num_rows>0)
		{ while($row=$result->fetch_array())
			{   $yes=$row[2];
		        $no=$row[3];
				$allpost=$row[1];
				$total=$yes+$no;
				$yesper=($yes/$total)*100;
				$noper=($no/$total)*100;
				
			echo '<div class="homeposts">';
			
			echo '<b>'.$allpost.'</b><br><div id="mark" ></div>';
			echo  "YES: ".$yesper."%<br>";
			echo "NO: ".$noper."%<br>";
			
			
			
			
			
			echo'</div>';
			}
		}
	}
	}
}
?>


</div>
<div class="homeleft">
<?php
$picq="select * from users where username='$user'";
if($result=$con->query($picq))
{
	while($rows=$result->fetch_array())
	{$pic=$rows[9];
    $fname=$rows[2];
	$sname=$rows[3];
	}

}
if($pic=="")
	echo'<img class="homepic" style="border:1px solid #ccc;" src="default.png" height="55"  alt="'.$user.'Profile"title="'.$user.'  Profile"/> ';
else{
	
	echo'<img class="homepic" style="border:1px solid #ccc;" src="img/'.$pic.'" height="55"  alt="'.$user.'Profile"title="'.$user.'  Profile"/> ';
}
?>

<div class="textheaderhome"><?php echo $fname."&nbsp;".$sname; echo"<h6 style='margin-top:2px;'>@".$user."</h6>";?></div>
<br><br><br><br>

<div class="homeleftcontents">

<a href="account_settings.php"><img src="post.png"height="17"/>Edit Profile</a><br>

<a href="friend_requests.php"><img src="friend.png"height="17"/>Friend requests</a><br>
<a href="polls.php"><img src="polls.png" height="17"/>Polls</a><br>


</div >
<div class="homeleftcontents">
<a href="home.php?cat=upcoming"><img src="events.png"height="17"/>Upcoming Events</a>
</div>
<div class="homeleftcontents">
<a href="home.php?cat=onthisday"><img src="day.png" height="17"/>On this day</a>
</div>

<div class="searchwidgethome">
<form  method="post" action="search.php">
<input type="text" name="searchbox" /><br>
<input type="submit" name="search" value="find"/>
</form>

</div>


</div>





