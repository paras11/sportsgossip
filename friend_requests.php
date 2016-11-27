<?php include ("headerinc.php"); ?>
<?php
//Find Friend Requests
$friendRequests = "SELECT * FROM friend_requests WHERE user_to='$user'";
if($result=$con->query($friendRequests)) {
	

if ($result->num_rows == 0) {
 echo "You have no friend Requests at this time.";
 $user_from = "";
}
else
{
 while ($row=$result->fetch_array()) {
  $id = $row[0]; 
  $user_to = $row[2];
  $user_from = $row[1];
  
  echo '' . $user_from . ' wants to be friends'.'<br />';

?>
<?php
if (isset($_POST['acceptrequest'.$user_from])) {
  //Get friend array for logged in user
  $get_friend_check = "SELECT * FROM users WHERE username='$user'";
  if($results=$con->query($get_friend_check)){
  while($row=$results->fetch_array()){
  $friend_array = $row[10];
  $friendArray_explode = explode(",",$friend_array);
  $friendArray_count = count($friendArray_explode);
  }
  }

  //Get friend array for person who sent request
  $get_friend_check_friend = "SELECT * FROM users WHERE username='$user_from'";
  if($results=$con->query($get_friend_check_friend)){
  while($row=$results->fetch_array()){
  $friend_array_friend = $row[10];
  $friendArray_explode_friend = explode(",",$friend_array_friend);
  $friendArray_count_friend = count($friendArray_explode_friend);
  }
  }

  if ($friend_array == "") {
     $friendArray_count = count(NULL);
  }
  if ($friend_array_friend == "") {
     $friendArray_count_friend = count(NULL);
  }
  if ($friendArray_count == NULL) {
   $add_friend_query = "UPDATE users SET friend_array=CONCAT(friend_array,'$user_from') WHERE username='$user'";
   if($con->query($add_friend_query))
   {
	  echo"added " ;
   }
  }
  if ($friendArray_count_friend == NULL) {
   $add_friend_query = "UPDATE users SET friend_array=CONCAT(friend_array,'$user_to') WHERE username='$user_from'";
   if($con->query($add_friend_query))
   {
	   echo"added ";
   }
  }
  if ($friendArray_count >= 1) {
   $add_friend_query = "UPDATE users SET friend_array=CONCAT(friend_array,',$user_from') WHERE username='$user'";
   if($con->query($add_friend_query))
   {
	    echo"added";
   }
  }
  if ($friendArray_count_friend >= 1) {
   $add_friend_query = "UPDATE users SET friend_array=CONCAT(friend_array,',$user_to') WHERE username='$user_from'";
   if($con->query($add_friend_query)){
	   echo"added";
   }
  }
  
  $delete_request = "DELETE FROM friend_requests WHERE user_to='$user_to'&&user_from='$user_from'";
  if($con->query($delete_request)){
	  
  echo "You are now friends!";
  header("Location: friend_requests.php");
  }

}
if (isset($_POST['ignorerequest'.$user_from])) {
$ignore_request ="DELETE FROM friend_requests WHERE user_to='$user_to'&&user_from='$user_from'";
if($con->query($ignore_request)){
  echo "Request Ignored!";
  header("Location: friend_requests.php");
}
}
?>
<form action="friend_requests.php" method="POST">
<input type="submit" name="acceptrequest<?php echo $user_from; ?>" value="Accept Request">
<input type="submit" name="ignorerequest<?php echo $user_from; ?>" value="Ignore Request">
</form>
<?php
  }
  }
}
?>