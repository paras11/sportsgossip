

<?php include("connect.php");

session_start();
if(!isset($_SESSION['user_login']))
{
	$user="";
}
else{
	$user=$_SESSION['user_login'];
	
}



?>
<html>
<head>
    
    <title> SportsGossip</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css"/>
	

</head>
<body>
<div class="headerMenu">
    

         <a href="home.php"><img id="imge" src="ball3.jpg" /></a>
		  <img id="gossip" src="2.gif" height="91"/><img id="sport" src="sport.png" height="85"/> 
		 
		 <div id="menu">
		 <?php
		 if(!$user)
		 {
		echo'	 <a href="#" ></a>';
			
		 
		 }
		 else 
		 { 
		 echo'<a href="home.php" >Home</a>
		     <a href=profile.php?cat=>Profile</a>
			  <a href="account_settings.php" >Settings</a>
			  <a href="logout.php" >Logout</a>';
			
		 }?>
		 </div>
		 <div id="menu2">
		 <?php
		 if($user){
		       $headq="select * from users where username='$user'";
			  if($res=$con->query($headq))
			  {  while($row=$res->fetch_array())
				  $p=$row[9];
				  
			  }
			  if($p=="")
			  {
				  
			  }
			  else{
				  echo'<img src="img/'.$p.'"  />';
			  }
		 }
		 ?>
		 </div>
    
   
</div>
<?php
if(!$user){
echo'<div class="intro" ><b>Bringing Sports Fans Together</b><br>

Join your friends and other fans with custom news, live scores 
and predictions - all completely free!</div>';
}
if($user)
{
	
echo'	<div class="searchwidget">
<form  method="post" action="search.php">
<input type="text" name="searchbox" /><br>
<input type="submit" name="search" value="find"/>
</form>

</div>';
}

?>
<div class="wrapper">

<br>
<br>
