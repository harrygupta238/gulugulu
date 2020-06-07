<?php 
date_default_timezone_set('Asia/Kolkata');
session_start();
include 'functions.php';
// $datetime1 = new DateTime();
// $datetime2 = new DateTime('2020-05-16 17:13:00');
// $interval = $datetime1->diff($datetime2);
// var_dump($interval);
// $elapsed = $interval->format('%hh ago');
// echo $elapsed;

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
	if(isset($_SESSION["LoggedInUserName"]))
	{
		$fromUsername=$_SESSION["LoggedInUserName"];
	}
	else if($_COOKIE["RandomUserName"])
	{
		$fromUsername=$_COOKIE["RandomUserName"];
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
			if($msg->To==$_SESSION["LoggedInUserName"])
			{
		?>
				
				<p class="text-light border-bottom b-3 p-3 inbox_content">
					<i class="fas fa-clock" style="font-size: .7em"> <?php echo calDatetimeDiff($msg->CreateDate);  ?></i><br>
					<?php echo $msg->Message; ?><br>
					<a href="#" class="btnpreviewfeedback" data-id="<?php echo $msg->_id; ?>" ><i class="fa fa-download" style="font-size: 1em;margin-top: -40px;cursor: pointer;float: right;"></i></a>					        
		    	</p>
		    	<div class="ppppp" style="width: 100%;text-align: center;display: none;">
					<div dwnld-id="<?php echo $msg->_id; ?>" class="card-deck card-text downloadfeedbackbox rounded-lg" style="display: inline-block; width: 60%">
						<div class="card-body text-center" style="min-height: 100px;">
							<p><?php echo $msg->Message; ?></p>
						</div>
						<div class="text-center">
                             <span class="dwnld_msg_logo">Gulu<i class="fas fa-comments"></i>Gulu<span>
                        </div>
                    </div>
				</div>
	<?php }} ?> 
	<p class="inbox_content text-light border-bottom b-3 p-3">
	     hi <span class="text-info"><?php echo $_SESSION["LoggedInUserName"]; ?></span>,<br>
		 Greetings! from <span class="text-warning">Gulu-Gulu</span> team,
		 hope you are enjoying this platform. The messages you will recieve will be displayed here.
		 <br>-thanks and regards							        
		    	</p>  
</div>
<div id="sentboxMsg">
	<?php
	    foreach ($messages as $msg) {
			if($msg->From==$_SESSION["LoggedInUserName"])
			{
	    ?>
	    <p class="sent_content text-dark border-bottom b-3 p-3">
	    	<i class="fas fa-clock" style="font-size: .7em"> <?php echo calDatetimeDiff($msg->CreateDate);  ?></i><br>
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
	$groupid=$_POST["groupid"];
	$mode=$_POST["mode"];
	if(isset($_SESSION["LoggedInUserName"]))
		{
			$owner=$_SESSION["LoggedInUserName"];
		}
		else if($_COOKIE["RandomUserName"])
		{
			$owner=$_COOKIE["RandomUserName"];
		}
		else
		{
			$owner="Anonymous";
		}
	if($mode=="create")
	{
		
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
	else if($mode=="edit")
	{
		$group =
		  [
		  	'_id'=> new MongoDB\BSON\ObjectID($groupid),
		    'GroupName'=> $groupname,
		    "Owner"=>$owner
		  ];
		$response=updateGroupName($group);
	    echo $response;
	}

}

if(isset($_POST["getGroupList"]))
{
	$response=getGroupList();
	echo json_encode($response);
	//echo json_decode(json_encode($response), FALSE);
}

if(isset($_POST["savegroupmsg"]))
{
	$groupMSG=$_POST["groupMSG"];
	$groupid=$_POST["groupid"];
	if(isset($_SESSION["LoggedInUserName"]))
	{
		$owner=$_SESSION["LoggedInUserName"];
	}
	else if($_COOKIE["RandomUserName"])
	{
		$owner=$_COOKIE["RandomUserName"];
	}
	else
	{
		$owner="Anonymous";
	}
	$groupMSGObj =
	  [
	  	'_id'=> new MongoDB\BSON\ObjectID,
	    'Message'=> $groupMSG,
	    "From"=>$owner,
	    "CreateDate"=> date('Y-m-d H:i:s')
	  ];	 
	$response=saveGroupMessage($groupMSGObj, $groupid);
	if($response)
	{
		$groupMSGObj["response"]=$response;
		echo json_encode($groupMSGObj);
	}
}

if(isset($_POST["getGroupMessageList"]))
{
	$groupid=$_POST["groupid"];
	$response=getGroupMessageList(new MongoDB\BSON\ObjectID($groupid));
	echo json_encode($response);
	//echo json_decode(json_encode($response), FALSE);
}

if(isset($_POST["getLoggedinUserData"]))
{
	if(isset($_SESSION['LoggedInUserName']))
	{
		$userdata =
	  [
	  	'_id'=> $_SESSION["userid"],
	    'username'=> $_SESSION["LoggedInUserName"],
	    'type'=>'loggedin'
	 
	  ];
	  echo json_encode($userdata);

	}
	else if(isset($_COOKIE["RandomUserName"]))
	{
		$userdata =
	  [
	  	'type'=>'visitor',
	    'username'=> $_COOKIE["RandomUserName"]
	 
	  ];
	  echo json_encode($userdata);
	}
	else
	{
		echo "";
	}
}	

if(isset($_POST["deleteGroupById"]))
{
	$groupid=$_POST["groupid"];
	$response=deleteGroupByID(new MongoDB\BSON\ObjectID($groupid));
	echo $response;
}

if(isset($_POST["deleteGroupMsgById"]))
{
	$groupid=$_POST["groupid"];
	$msgid=$_POST["msgid"];
	$response=deleteGroupMsgByID(new MongoDB\BSON\ObjectID($groupid),new MongoDB\BSON\ObjectID($msgid));
	echo $response;
}

if(isset($_POST["updateGroupName"]))
{
	$groupid=$_POST["groupid"];
	$gname=$_POST["gname"];
	$response=updateGroupName(new MongoDB\BSON\ObjectID($groupid),$gname);
	echo $response;
}

?>
