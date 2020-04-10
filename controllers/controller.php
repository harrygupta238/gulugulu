<?php 
date_default_timezone_set('Asia/Kolkata');
session_start();
include 'functions.php';
if(isset($_POST["username_validation"]))
{
	$username=$_POST["username"];
	$response=validate_username($username);
	if($response)
	{
		echo $response;	
	}
}



if(isset($_POST["signup"]))
{
	$username=$_POST["username"];
	$password=$_POST["password"];
	$user =
	  [
	  	'_id'=> new MongoDB\BSON\ObjectID,
	    'UserName'=> $username,
	    'Password'=> $password,
	    "CreateDate"=> date('Y-m-d H:i:s')
	  ];
	$response=signup($user);
	if($response)
	{
		echo $response;
	}
}


if(isset($_POST["login"]))
{
	$username=$_POST["username"];
	$password=$_POST["password"];
	$user =
	  [
	    'UserName'=> $username,
	    'Password'=> $password
	  ];
	$response=login($user);
	if($response)
	{
		echo $response;
	}
}


if(isset($_POST["logout"]))
{
	logout();
	echo true;
}


if(isset($_POST["sendMsg"]))
{
	$toUsername=$_POST["toUsername"];
	$message=$_POST["message"];
	if(isset($_SESSION["username"]))
	{
		$fromUsername=$_SESSION["username"];
	}
	else
	{
		$fromUsername="Anonymous";
	}
	$messageData =
	  [
	  	'_id'=> new MongoDB\BSON\ObjectID,
	    'To'=> $toUsername,
	    'From'=>$fromUsername,
	    "Message"=>$message,
	    "CreateDate"=> date('Y-m-d H:i:s')
	  ];
	$response=saveMessage($messageData);
	if($response)
	{
		echo $response;
	}
}


if(isset($_POST["getAllMessageList"]))
{

	$messages=getAllMessageList();
?>
	<div id="inboxMsg"> 
<?php
		foreach ($messages as $msg) {
			if($msg->To==$_SESSION["username"])
			{
		?>
				
				<p class="bg-light text-dark border-bottom b-3 p-3">
					<i class="fas fa-clock" style="font-size: .7em"> <?php echo date("M d, Y H:i:s a",strtotime($msg->CreateDate));  ?></i><br>
					<?php echo $msg->Message; ?><br>					        
		    	</p>
	<?php }} ?> 
	<p class="bg-light text-dark border-bottom b-3 p-3">
	     hi <span class="text-info"><?php echo $_SESSION["username"]; ?></span>,<br>
		 Greetings! from <span class="text-danger">Gulu-Gulu</span> team,
		 hope you are enjoying this platform. The messages you will recieve will be displayed here.
		 <br>-thanks and regards							        
		    	</p>  
</div>
<div id="sentboxMsg">
	<?php
	    foreach ($messages as $msg) {
			if($msg->From==$_SESSION["username"])
			{
	    ?>
	    <p class="bg-light text-dark border-bottom b-3 p-3">
	    	<i class="fas fa-clock" style="font-size: .7em"> <?php echo date("M d, Y H:i:s a",strtotime($msg->CreateDate));  ?></i><br>
	    	To : <span class="text-info"><?php echo $msg->To; ?></span><br>
			Message :	<?php echo $msg->Message; ?><br>					        
		    	</p>
	    <?php }} ?>
</div>
<?php

}
if(isset($_POST["creategroup"]))
{
	$groupname=$_POST["groupname"];
	if(isset($_SESSION["username"]))
	{
		$owner=$_SESSION["username"];
	}
	else
	{
		$owner="Anonymous";
	}
	$group =
	  [
	  	'_id'=> new MongoDB\BSON\ObjectID,
	    'GroupName'=> $groupname,
	    "Owner"=>$owner,
	    "CreateDate"=> date('Y-m-d H:i:s'),
	    "IsActive"=>true
	  ];
	$response=createGroup($group);
	if($response)
	{
		echo $response;
	}
}
if(isset($_POST["getGroupList"]))
{
	$response=getGroupList();
	echo json_encode($response);
	//echo json_decode(json_encode($response), FALSE);
}

?>