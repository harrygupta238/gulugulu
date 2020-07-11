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
			<p class="text-center">You are logged in as : <span class="text-info"> 
			<?php echo $_SESSION["lggedinusrnm"]; ?> </span><br>
			
			<span class="text-center"> Click button to copy your profile link:
				<span class="profilelink bg-white" style="padding:5px;display: none">
			    </span>
				<span class="btn btn-dark btnCopy btn-sm ml-1 popup" data-toggle="tooltip" data-placement="right" title="copy to clipboard">
					<span class="fas fa-copy" aria-hidden="true"></span>
					<span class="popuptext myPlPopup" id="">Copied</span>
				</span>
				 
			</span><br>

				<button type="button" data-toggle="tooltip" data-placement="top" title="Home" class="btn btn-info btn-sm btnHome">
				<span class="fas fa-home"></span>
				</button>
				<button type="button" data-toggle="tooltip" data-placement="top" title="New Group" class="btn btn-info btn-sm btnNewGroup">
				<span class="fas fa-plus"></span> New Group
				</button>
				<button type="button" id="logout" data-toggle="tooltip" data-placement="top" title="logout" class="btn btn-danger btn-sm btnHome">
				 <span class="fas fa-sign-out-alt" aria-hidden="true"></span> 
				</button>
			</p>
			
		</div>
		<div id="IndexDynamicContent" style="display:none;">
			<div class="container  p-3 border-bottom text-secondary loginContent" style="background-color: #f0ededa3">
				<div class="container formwidth" >
					<div class="text-center">
						<span>
							<h6>
								New Group
							</h6>
						</span>
					</div>
					<form action="#" class="needs-validation" id="createGroupForm" method="post">
						<div class="row d-flex justify-content-center">
							<div class="form-group col-lg-9 col-xl-9 col-sm-12 col-md-12" >
								<span class="text-danger errormsg"></span><br>
								<input type="hidden" name="mode" value="create">
								<input type="hidden" name="groupid">
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
							
								<div class="row" style="display: contents;">
									
										<button type="submit" class="btn btn-primary btn-sm btncreateGroupSubmit m-1">
									Submit
								</button>
								<button type="submit" class="btn btn-danger btn-sm btnCancelNewGroup m-1">
									Cancel
								</button>
									
							
							</div><br>
							 
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="container  p-3 border-bottom text-secondary loginContent" style="background-color:#f0ededa3">
			<div class="row">
			      <div class="col-sm-3">
			      	  <ul class="list-group grouplist anyClass">
			      	  			<center><p style="margin-top: 10em;">You have no groups.</p></center>
			          </ul>
			      </div>
			      <div class="col-sm-9 groupmessagecontainer" style="padding-left: 0px;
                       padding-right: 0px;background-color: ghostwhite;">
    				<div class="groupmessageBox border-bottom">
    					<center><p style="padding-top: 11em;">Group's Messages will be displayed here.</p></center>
			      	</div>
			      	<form action="#" class="needs-validation" id="groupMsgForm" method="post" style="display: none;">
			      	<div class="row d-flex pt-2 justify-content-center" style="
						    width: 100%;
						    margin-left: 0px;
						    height: auto;">
			      				 <input type="hidden" name="" class="txtgroupid">
								<input
							type="text"
							class="form-control txtgrpmsg"
							placeholder="Type Your Message here.."
							name="pswd"
							required></input>
							
							
								<button type="submit" class="btn btn-primary btngroupMsgFormSubmit">
									<span class="fas fa-paper-plane"></span>
								</button>
							
					</div>
				</form>
			      </div>
	    	</div>
		</div>
		
		<script type="text/javascript" src="js/controls.js"></script>
		<script type="text/javascript" src="js/groupchat.js"></script>
		<?php include("footer.php"); ?>