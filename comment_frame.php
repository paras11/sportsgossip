<style>
*{
	
	font-style:verdana;
	font-weight:17px;
}
</style>


<?php
$getid=$_GET['id'];
$con=new mysqli("localhost","root","","sports");
$getcomments="select * from post_comments where posted_id='$getid'";
if($result=$con->query($getcomments))
{
	if($result->num_rows>0)
	{   echo'<hr>';
		while($row=$result->fetch_array())
		{   $postedby=$row[2];
			$comment=$row[1];
			$postedby=$row[2];
				$getuserpic="select * from users where username='$postedby'";
				if($got=$con->query($getuserpic))
				{  while($rows=$got->fetch_array())
				    $pic=$rows[9];
				}
			echo'<div class="cposts">	';
			
			
            
			echo'<div style="float:left; margin-right:5px;">';
			if($pic=="")
			echo'<img src="default.png" height="37"/>';
		else{
			echo'<img src="img/'.$pic.'" height="37"/>';
		}
			echo'</div>';
			echo '<b>'.$postedby.'</b><br>'.$comment.'<br><hr>';
			echo'</div>';
		}
	}
	else{
		
		echo "No comments here";
	}
	
}

?>