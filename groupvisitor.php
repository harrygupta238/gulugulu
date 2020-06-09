<?php 
	
	session_start();
	$gid=$_GET["g"];
	require 'controllers/functions.php';
	setVisitorCookie();

	$res=validate_groupid(new MongoDB\BSON\ObjectID($gid));
	if($res=="-")
	{
		header("Location: index.php");
	}
	if(@$_SESSION["LoggedInUserName"])
	{
		if($res[0]->Owner==$_SESSION["LoggedInUserName"])
		{
			header("Location: groupchat.php");
		}
	}
	
	// $auth=checkAuth();
	// if($auth==true)
	// {
	// 	header("Location: groupchat.php");
	// } 
	    include("headerlink.php");
		include("header.php");  
 ?>
 
			<div class="container p-3 text-center text-secondary" style="margin-bottom: -2em;background-color: #f0ededa3">
			<div class="d-flex justify-content-between mb-3">
    <div class="p-2 "><p>Admin: <span class="text-info spnGroupAdmin"><?php echo  $res[0]->Owner; ?></span></p></div>
    <div class="p-2 "><button type="button" class="btn btn-info btn-sm btnHome">
				<span class="fas fa-home"></span>
				</button></div>
    <div class="p-2 "><p>You: <span class="text-info genVisitorUsername"><?php if(@$_SESSION["LoggedInUserName"]){echo @$_SESSION["LoggedInUserName"];}else {echo @$_COOKIE["RandomUserName"];} ?></span></p></div>
  </div>
		</div>
		
		<div class="container  p-3 border-bottom text-secondary loginContent" style="background-color: #f0ededa3">
			<div class="row">
			      <div class="col-sm-12" style="padding-left: 0px;
    padding-right: 0px;background-color: ghostwhite;">
    				<div class="groupmessageBox border-bottom">
    					<div class="groupmsgBox-header" groupid="<?php echo @$gid; ?>"  style="width: 100%;
	    				height: 33px;">
	    					<div class="d-flex justify-content-between">
							    <div class="p-1 text-light" style="width:25px"></div>
							    <div class="p-1 text-light"><?php echo  $res[0]->GroupName; ?></div>
							    <div class="p-1 text-light dropleft dropdown">
									<span class="" data-toggle="dropdown"><i class="pr-2 fa fa-cog" aria-hidden="true"></i></span>
										<div class="dropdown-menu" style=font-size:13px;>
									    	<a class="dropdown-item btnCopyGrouplink popup" data-toggle="tooltip" data-placement="right" title="copy to clipboard" href="#">Copy Group Link <i class="fa fa-copy" aria-hidden="true"></i><span class="popuptext myPlPopup" id="">Copied</span></a>
									    </div>
									</i>
								</div>
							</div>
						</div>
				      	<div class="anyClass groupmessagelist" id="groupmessagelist" style="background-color:#ffff;">
				      		<?php 
			      		if($res!="-")
			      		{
			      			if(@$_SESSION["LoggedInUserName"])
			      				{$username= $_SESSION["LoggedInUserName"];}
			      			else {$username= @$_COOKIE["RandomUserName"];}
			      			$Messages=@$res[0]->Messages;
			      			foreach ($Messages as $message) {
			      				if($message->From==$username)
			      				{
			      				# code...
			      	 ?>

			      		<div class="containerr-r">
			      			<span style="margin-right: 1em;float: right;">
		      						<span class="" style="font-size: .7em;"><?php echo $message->From;?></span>, <i class="fas fa-clock" style="font-size: .7em"> <?php echo calDatetimeDiff($message->CreateDate); ?></i>
		      				</span><br>
			      			<div class="containerr sendbground">
			      				<p class="margin_bottom_0"><?php echo $message->Message; ?></p>
			      			</div>
			      		</div>
		      		<?php 
		      					}
		      				    else
		      				    {
		      		?>      
		      				
		      				<div class="containerr-l">
		      					<span style="margin-left: 1em;">
		      						<span class="" style="font-size: .7em;"><?php echo $message->From;?></span>, <i class="fas fa-clock" style="font-size: .7em"> <?php echo calDatetimeDiff($message->CreateDate); ?></i>
		      					</span>
		      					<div class="containerr recbground">
		      						<p class="margin_bottom_0"><?php echo $message->Message; ?>
		      						</p>
		      					</div>
		      				</div>
		      		<?php

		      				    }
		      				}
		      			}
		      		 ?>

				      	</div> 
			      	</div>
			      	<form action="#" class="needs-validation" id="groupMsgForm" method="post">
			      	<div class="row d-flex pt-2 justify-content-center" style="
						    width: 100%;
						    margin-left: 0px;
						    height: auto;">
			      				 <input type="hidden" name="" class="txtgroupid" value="<?php echo @$gid; ?>">
								<textarea
							type="text"
							class="form-control txtgrpmsg"
							placeholder="Type Your Message here.."
							name="pswd"
							required></textarea>
							
							
								<button type="submit" class="btn btn-primary btngroupMsgFormSubmit">
									<span class="fas fa-paper-plane"></span>
								</button>
							
					</div>
			      </div>
	    	</div>
		</div>
		<script type="text/javascript" src="js/controls.js"></script>
		<script type="text/javascript" src="js/groupchat.js"></script>
		<script type="text/javascript">
			if($(".genVisitorUsername").html()=="")
				window.location.reload();
			restrictedElement();
		</script>
				<!-- including the footer: -->
			<?php include("footer.php"); ?>