<?php include ("headerinc.php"); ?>
<?php

$ques = "SELECT * FROM polls ";
if($result=$con->query($ques)) {
	

if ($result->num_rows == 0) {
 echo "no ques for polls";
 
}
else
{
 while ($row=$result->fetch_array()) {
	 $allowed=1;
  $id = $row[0]; 
  $body = $row[1];
 $yes=$row[2];
 $no=$row[3];
 $list=$row[4];
  
  echo $body.'<br />';

?>
<?php
if (isset($_POST['yes'.$id])) {
 
  $yes=$yes+1;
  
   $a_explode="";
  $a_explode = explode(',',$list);
  $a_count = count($a_explode);




  if ($list == "") {
     $a_count = count(NULL);
  }
 
  
  if ($a_count == NULL) {
   $add= "UPDATE polls SET yes='$yes' , user_array=CONCAT(user_array,'$user') WHERE id='$id'";
   if($con->query($add))
   {
	  
   }
  }
  
 
  if ($a_count >= 1) {
	  
   $add = "UPDATE polls SET yes='$yes' , user_array=CONCAT(user_array,',$user') WHERE id='$id'";
   if($con->query($add))
   {    
	    
   }
  }
  
  


}
if (isset($_POST['no'.$id])) {
 
  $no=$no+1;
  
   $a_explode="";
  $a_explode = explode(',',$list);
  $a_count = count($a_explode);




  if ($list == "") {
     $a_count = count(NULL);
  }
 
  
  if ($a_count == NULL) {
   $add= "UPDATE polls SET no='$no' , user_array=CONCAT(user_array,'$user') WHERE id='$id'";
   if($con->query($add))
   {
	  
   }
  }
  
 
  if ($a_count >= 1) {
	  
   $add = "UPDATE polls SET no='$no' , user_array=CONCAT(user_array,',$user') WHERE id='$id'";
   if($con->query($add))
   {    
	   
   }
  }
  
  


}

?>
<?php

$q="select * from polls where id='$id'";
if($r=$con->query($q)){
	while($line=$r->fetch_array())
	{ $userlist=$line[4];
	}
	$a=explode(',',$userlist);
foreach($a as $t)
{   
	if($t==$user)
	{
		$allowed=0;
		
}
}
 }
if($allowed==1)
{
echo'<form action="newpoll.php" method="POST">
<input type="submit" name="yes'.$id.'" value="yes">
<input type="submit" name="no'.$id.'" value="no">
</form>';
}
else{
	echo"Answered<br><br>";
}
?>
<?php
  }
  }
}
?>