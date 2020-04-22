<?php 
session_start();
require 'controllers/functions.php';
$auth=checkAuth();
if($auth==false)
{
	header("Location: index.php");
}  
		include("headerlink.php");
		include("header.php"); 
 ?>

		
		<div class="container p-3 text-center text-secondary" style="margin-bottom: -2em;background-color: #f0ededa3">
			<p>
				<button type="button" class="btn btn-outline-secondary btn-sm btnHome">
				<span class="fas fa-home"></span>
				</button>
				<button type="button" class="btn btn-outline-secondary btn-sm btnNewGroup">
				<span class="fas fa-plus"></span> New Group
				</button>
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
			      <div class="col-sm-4">
			      	  <ul class="list-group grouplist anyClass">
			      	  			<center><p style="margin-top: 10em;">You have no groups.</p></center>
			          </ul>
			      </div>
			      <div class="col-sm-8 groupmessagecontainer" style="padding-left: 0px;
    padding-right: 0px;background-color: ghostwhite;">
    				<div class="groupmessageBox border-bottom">
    					<center><p style="padding-top: 11em;">Group's Messages will be displayed here.</p></center>
				      <!-- 	<div class="groupmsgBox-header" style="background-color: #dae0e5!important;width: 100%;
	    				height: 33px;">
	    					<div class="d-flex justify-content-between bg-secondary">
							    <div class="p-1 text-light"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
							    <div class="p-1 text-light">Group Name will be display here</div>
							    <div class="p-1 text-light"><i class="fa fa-cog" aria-hidden="true"></i></div>
							</div>
						</div>
	    				
				      	<div class="anyClass groupmessagelist" id="groupmessagelist">
				      		

				      	</div> -->
			      	</div>
			      	<form action="#" class="needs-validation" id="groupMsgForm" method="post">
			      	<div class="row d-flex pt-2 justify-content-center">
			      			<div class="form-group col-lg-10 col-xl-10 col-sm-10 col-md-10">
			      				<input type="hidden" name="" class="txtgroupid">
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
		
		<?php include("footer.php"); ?>