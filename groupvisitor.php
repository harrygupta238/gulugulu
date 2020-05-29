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
	$auth=checkAuth();
	if($auth==true)
	{
		header("Location: groupchat.php");
	} 
	    include("headerlink.php");
		include("header.php");  
 ?>
 
			<div class="container p-3 text-center text-secondary" style="margin-bottom: -2em;background-color: #f0ededa3">
				<!-- <div class="d-flex justify-content-center ">
				    <div class="p-2 "> <p>Admin: <span class="text-success"><?php echo  $res[0]->Owner; ?></span></p></div>
				    <div class="p-2 "><button type="button" class="btn btn-success btn-sm btnHome">
				<span class="fas fa-home"></span>
				</button></div>
				    <div class="p-2 "><p>You: <span class="text-success genVisitorUsername"><?php echo  @$_COOKIE["RandomUserName"]; ?></span></p></div>
				  </div> -->
				  <div class="d-flex justify-content-between ">
				    <div class="p-2 "> <p>Admin: <span class="text-success"><?php echo  $res[0]->Owner; ?></span></p></div>
				    <div class="p-2 "><button type="button" class="btn btn-success btn-sm btnHome">
				<span class="fas fa-home"></span>
				</button></div>
				    <div class="p-2 "><p>You: <span class="text-success genVisitorUsername"><?php echo  @$_COOKIE["RandomUserName"]; ?></span></p></div>
				  </div>
			<p>
				<!-- <div class="row">
					<div class="col-md-3 col-sm-3 col-xs-3"><p>Admin: <span class="text-success"><?php echo  $res[0]->Owner; ?></span></p></div>
					<div class="col-md-6 col-sm-6 col-xs-6"><button type="button" class="btn btn-success btn-sm btnHome">
				<span class="fas fa-home"></span>
				</button></div>
					<div class="col-md-3 col-sm-3 col-xs-3"><p>You: <span class="text-success genVisitorUsername"><?php echo  @$_COOKIE["RandomUserName"]; ?></span></p></div>
				</div> -->
				<!-- <p>Group: <?php // echo  $res[0]->GroupName; ?></p> -->
				
				<!-- <button type="button" class="btn btn-outline-secondary btn-sm btnNewGroup">
				<span class="fas fa-user"></span>	Create New Group
				</button> -->
			</p>
			
		</div>
		<div id="IndexDynamicContent" style="display:none;">
			<div class="container  p-3 border-bottom text-secondary loginContent" style="background-color: #f0ededa3">
				<div class="container formwidth" >
					<div class="text-center">
						<span>
							<h6 >
								<u>New Group</u>
							</h6>
						</span>
					</div>
					<form action="#" class="needs-validation" id="createGroupForm" method="post">
						<div class="row d-flex justify-content-center">
							<div class="form-group col-lg-8 col-xl-8 col-sm-12 col-md-12" >
								<span class="text-danger errormsg"></span><br>
								<input
							type="text"
							class="form-control groupname"
							placeholder="Enter Group Name"
							maxlength="25"
							name="uname"
							required
						/><span class="usrnmmsg"></span>
							</div>
						</div>
						
						<div class="row d-flex justify-content-center text-center">
							<div class="form-group col-lg-4 col-xl-4 col-sm-4 col-md-4">
								<button type="submit" class="btn btn-secondary btn-sm btncreateGroupSubmit">
									Submit
								</button>
								<button type="submit" class="btn btn-secondary btn-sm btnCancelNewGroup">
									Cancel
								</button>
							</div><br>
							 
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="container  p-3 border-bottom text-secondary loginContent" style="background-color: #f0ededa3">
			<div class="row">
			      <div class="col-sm-12" style="padding-left: 0px;
    padding-right: 0px;background-color: ghostwhite;">
    				<div class="groupmessageBox border-bottom">
    					<div class="groupmsgBox-header" groupid="<?php echo @$gid; ?>"  style="background-color: #dae0e5!important;width: 100%;
	    				height: 33px;">
	    					<div class="d-flex justify-content-between bg-secondary">
							    <div class="p-1 text-light"></div>
							    <div class="p-1 text-light"><?php echo  $res[0]->GroupName; ?></div>
							    <div class="p-1 text-light"><i class="pr-2 fa fa-cog" aria-hidden="true"></i></div>
							</div>
						</div>
				      	<div class="anyClass groupmessagelist" id="groupmessagelist">
				      		<?php 
			      		if($res!="-")
			      		{
			      			$Messages=$res[0]->Messages;
			      			foreach ($Messages as $message) {
			      				if($message->From==@$_COOKIE['RandomUserName'])
			      				{
			      				# code...
			      	 ?>

			      		<div class="containerr-r">
			      			<span style="margin-right: 1em;float: right;">
		      						<span class="text-success" style="font-size: .7em;"><?php echo $message->From;?></span>, <i class="fas fa-clock" style="font-size: .7em"> <?php echo calDatetimeDiff($message->CreateDate); ?></i>
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
		      						<span class="text-success" style="font-size: .7em;"><?php echo $message->From;?></span>, <i class="fas fa-clock" style="font-size: .7em"> <?php echo calDatetimeDiff($message->CreateDate); ?></i>
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
			      	<!-- <div class="row pl-2 pr-2 d-flex border-top pt-2 justify-content-center">
			      			<div class="form-group col-lg-10 col-xl-10 col-sm-10 col-md-10">
			      				<input type="hidden" name="" class="txtgroupid" value="<?php //echo @$gid; ?>">
								<input
								type="text"
								class="form-control txtgrpmsg"
								placeholder="Type Your Message here.."
								name="pswd"
								required
								/>
							</div>
							<div class="form-group col-lg-2 col-xl-2 col-sm-2 col-md-2" style="margin-left: -1.5em;">
								<button type="submit" class="btn btn-secondary btngroupMsgFormSubmit">
									<span class="fas fa-paper-plane"></span>
								</button>
								<span class="btn btn-secondary btnGroupRefreshMsg">
									<span class="fas fa-sync-alt"> </span>
								</span>
							</div>
						</div> -->
						<div class="row d-flex pt-2 justify-content-center" style="
						    width: 100%;
						    margin-left: 0px;
						    height: auto;">
			      				 <input type="hidden" name="" class="txtgroupid">
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
		</script>
				<!-- including the footer: -->
			<?php include("footer.php"); ?>
