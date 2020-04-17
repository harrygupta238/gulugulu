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
			<p>
				<button type="button" class="btn btn-outline-secondary btn-sm btnHome">
				<span class="fas fa-user"></span>	Home
				</button>
				<p>Group: <?php echo  $res[0]->GroupName; ?></p>
				<p>This Group is Created By: <?php echo  $res[0]->Owner; ?></p>
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
			     <!--  <div class="col-sm-4">
			      	  <ul class="list-group grouplist anyClass">
			      	  			<center><p style="margin-top: 10em;">You have no groups.</p></center>
			          </ul>
			      </div> -->
			      <div class="col-sm-12" style="background-color: ghostwhite;">
			      	<div class="anyClass groupmessagelist">
			      		<!-- <center><p style="margin-top: 10em;">Group's Messages will be displayed here.</p></center> -->
			      	<?php 
			      		if($res!="-")
			      		{
			      			$Messages=$res[0]->Messages;
			      			foreach ($Messages as $message) {
			      				if($message->From==@$_COOKIE['RandomUserName'])
			      				{
			      				# code...
			      	 ?>
			      		<div class="containerr darker"><img src="images/pp.jpg" alt="Avatar" style="width:100%;"><p><?php echo $message->Message; ?></p><span class="time-right"><?php echo $message->CreateDate; ?></span></div>

			      		<!-- <div class="containerr"><img src="images/pp.jpg" alt="Avatar" style="width:100%;"><p>krishna nand</p><span class="time-right">2020-04-11 20:31:44</span></div> -->
		      		<?php 
		      					}
		      				    else
		      				    {
		      		?>
		      				<div class="containerr"><img src="images/pp.jpg" alt="Avatar" style="width:100%;"><p><?php echo $message->Message; ?></p><span class="time-right"><?php echo $message->CreateDate; ?></span></div>
		      		<?php

		      				    }
		      				}
		      			}
		      		 ?>
			      	</div>
			      	<form action="#" class="needs-validation" id="groupMsgForm" method="post">
			      	<div class="row d-flex border-top pt-2 justify-content-center">
			      			<div class="form-group col-lg-10 col-xl-10 col-sm-10 col-md-10">
			      				<input type="hidden" name="" class="txtgroupid" value="<?php echo @$gid; ?>">
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
						</div>
			      </div>
	    	</div>
		</div>
		<script type="text/javascript" src="js/controls.js"></script>
		<script type="text/javascript" src="js/groupchat.js"></script>
			
				<!-- including the footer: -->
			<?php include("footer.php"); ?>
