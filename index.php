
<?php
include("headerinc.php");
if(!isset($_SESSION['user_login']))
{
	
}
else{
	header("location:home.php");
}
?>
<div id="indexwrapper">
<br>
<div class="frontform">
<table id="t"  >
   <tr>
       <td width="100%" valign="top">
	   <br><br>
           <h1>Login Here !</h1><br>
		   <div class="login">
        <form class="f" method="post" action="index.php">
            <input type="text" placeholder="Username" name="user_login" size="30"/><br>
            <input type="password" placeholder="Password" name="password_login" size="30"/><br>
			<p style="margin-top:5px;margin-left:30%;"><a href="forgot.php">Forgot Password</a></p><br>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="login" value="login" />
        </form>

    </div>
		   </td>
       
   </tr>
   </table>
   <br>
   <br>
   <hr>
   <br>
   <table id="t"  >
   <tr >
   <td  width="100%" valign="top">
  <h1><b>Sign Up!</b></h1>
		   <form name="f" method="post" action="index.php">
					<input type="text" name="fname" placeholder="First Name " size="25"/><br><br>
					 <input type="text" name="lname" placeholder="Last Name"size="25"/><br><br>
				  <input type="text" name="email" placeholder=" Email Address"size="25"/><br><br>
				  <input type="text" name="email2" placeholder="Confirm Email Address"size="25"/><br><br>
					  <input type="text" name="user" placeholder="Choose Username"size="25"/><br><br>
					 <input type="password" name="pass" placeholder="Choose Password"size="25"/><br><br>
				 <input type="password" name="pass2" placeholder="Retype Password"size="25"/><br><br>
				 <input type="text" name="securityques" placeholder="Security Question"size="25"/><br><br>
				 <input type="text" name="securityans" placeholder="Security Answer"size="25"/><br><br>
				 <input type="submit" name="reg" value="sign up"/>
				 </form>
       </td>
   </tr>
</table>
</div>
</div>
</div>


  <?php

if(isset($_POST['reg']))
{
	$fn=$_POST["fname"];
$ln=$_POST["lname"];
$em=$_POST["email"];
$em2=$_POST["email2"];
$pswd=$_POST["pass"];
$pswd2=$_POST["pass2"];
$un=$_POST["user"];
$sq=$_POST["securityques"];
$sa=$_POST["securityans"];
$d=date("Y-m-d");

if($con==true)
{  $usernamecheck="select * from users where username='$un'";
    if($result=$con->query($usernamecheck))
	{
		if($result->num_rows>0)
		{
			echo"username already exists";
		}
		else{     if($pswd==$pswd2 &&strlen($pswd)>5)  {
                    if($em==$em2)
   { if(!empty($sq)){
	$cmd="insert into users values('0','$un','$fn','$ln','$em','$pswd','$d','0','','','','$sq','$sa')";
	if($con->query($cmd)==true)
	 {
		echo"successfully registered";
	 }
	else{
		echo"query error";
	    }
   }
   else{
	   echo"enter security question";
   }
   }
   else{
	   echo"email dont match";
       }
		}
		else{
			echo"password incorrect";
		}
	}                           
	}
}
   else{
	   echo"connection error";
 

        }
}


if(isset($_POST["login"]))
{
	$user_login=$_POST["user_login"];
	$password_login=$_POST["password_login"];
	 $cmd1 = "SELECT id FROM users WHERE username='$user_login' AND password='$password_login' ";
	 
	 if($result=$con->query($cmd1))
	 {
	if ($result->num_rows>0)
	{
		while($row = $result->fetch_array())
		{ 
             $id = $row["id"];
	    }
		
		 $_SESSION["user_login"] = $user_login;
		 header('location:home.php');
         exit();
		
	}
	else{
		echo"incorrect details";
		exit();
	}
	
	 }
	 else{
		 echo"incorrect query";
	 }
}
?>

</body>
</html>
