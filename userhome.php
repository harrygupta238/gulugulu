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
		<div class="container p-3 border-top border-bottom text-secondary userhome_body">
			<p class="text-center">You : <span class="text-info"> 
			<?php echo $_SESSION["lggedinusrnm"]; ?> </span><br>
			
			<span class="text-center"> Click button to copy your profile link:
				<span class="profilelink bg-white" style="padding:5px;display: none">
			    </span>
				<span class="btn btn-dark btnCopy btn-sm ml-1 popup" data-toggle="tooltip" data-placement="right" title="copy to clipboard">
					<span class="fas fa-copy" aria-hidden="true"></span>
					<span class="popuptext myPlPopup" id="">Copied</span>
				</span>
				 
			</span><br>
				
			    <button type="button" data-toggle="tooltip" data-placement="top" title="New Message"  class="btn btn-info btn-sm mt-1 btnNewMsgBox">
					<span class="fas fa-edit" aria-hidden="true"></span> 
				</button>
				<button type="button" data-toggle="tooltip" data-placement="top" title="Inbox Messages"  class="btn active btn-info btn-sm mt-1 btnInBox">
					Inbox <span class="fas fa-envelope" aria-hidden="true"></span> 
				</button>
				<button type="button" data-toggle="tooltip" data-placement="top" title="Sent Messages"  class="btn btn-info btn-sm mt-1 btnSentBox">
					Sent  
				</button>
				<button type="button" id="btnGroupChatpage" data-toggle="tooltip" data-placement="top" title="Chat Rooms" class="btn btn-info btn-sm btnGroupChatpage mt-1">
					Chat Rooms <span class="fas fa-users" aria-hidden="true"></span> 
				</button>
				<button type="button" id="logout" data-toggle="tooltip" data-placement="top" title="logout" class="btn btn-danger btn-sm btnHome mt-1">
				 <span class="fas fa-sign-out-alt" aria-hidden="true"></span> 
				</button>
				
			</p>
		</div>
		<div class="container p-3 border-top text-secondary newMsgBox userhome_body" style="display: none;">
			<div class="container">
				<div class="row d-flex justify-content-center">
					<div id="copy_content" class="col-lg-8 col-xl-8 col-sm-12 col-md-12">
						
						<p>
						Enter the username of your friend in username field, and fill up the message box with your message you want to tell your friend secretly.
						</p>
						<p>
						Don't worry your friend will not be able to see who shared this message to him/her.
						</p>
					</div>
				</div>
				<form action="#" class="needs-validation" id="sndmsgForm" method="post">
					<div class="row d-flex justify-content-center">
						<div class="form-group col-lg-8 col-xl-8 col-sm-12 col-md-12" >
							<span class="text-danger errormsg"></span><br>
							<!-- <label for="uname">Username:</label> -->
							<input
							type="text"
							class="form-control username"
							id="uname"
							placeholder="Enter username"
							autocomplete="off"
							name="uname"
							required
							/>
							<span class="usrnmmsg"></span>
						</div>
					</div>
					<div class="row d-flex justify-content-center">
						<div class="form-group col-lg-8 col-xl-8 col-sm-12 col-md-12">
							<!-- <label for="pwd">Message:</label> -->
							<textarea class="form-control message" rows="5" id="comment" placeholder="Write the message you want to share.."></textarea>
						</div>
					</div>
					<div class="row d-flex justify-content-center text-center">
						<div class="form-group col-lg-4 col-xl-4 col-sm-4 col-md-4">
							<button type="submit" class="btn btn-primary btnMsgSubmit">
								 Send <span class="fas fa-paper-plane"></span>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>

			<div class="container border-bottom p-3 inboxsentbox text-secondary  userhome_body">
				<div class="">
					<div class="row d-flex justify-content-center">
						<div class="col-lg-8 col-xl-8 col-sm-12 col-md-12 msgBox">
							
							<div id="inboxMsg" class="text-white">
								<?php  
									@$messages=getAllMessageList();
									//var_dump($messages);
									foreach (@$messages as $msg) {
										if($msg->To==$_SESSION["lggedinusrnm"])
										{
									?>
											
											<p class="text-light border-bottom b-3 p-3 m-4 inbox_content">
												<i class="fas fa-clock" style="font-size: .7em"> <?php
												echo calDatetimeDiff($msg->CreateDate);
												  ?></i><a href="#" class="btnpreviewfeedback float-right" data-id="<?php echo $msg->_id; ?>" ><i class="fa fa-download" style="font-size: 1em;margin-top: 0px;    color: aqua;cursor: pointer;float: right;"></i></a><br>
												<?php echo $msg->Message; ?><br>  
									    	</p>
											<div class="InboxImgContainer" style="width: 100%;text-align: center;">
												<div dwnld-id="<?php echo $msg->_id; ?>" class="card-deck card-text downloadfeedbackbox rounded-lg" style="display: inline-block;">
													<div class="card-body text-center">
														<p><?php echo $msg->Message; ?></p>
													</div>
													<div class="text-center ml-1">
														<span style="font-size:10px">Recieved on</span>
				                                         <span class="dwnld_msg_logo"> Gulu<i class="fas fa-comments"></i>Gulu<span>
                                                    </div>
                                                    
                                                </div>
											</div> 
                                                
									 
											
								<?php }} ?> 
								<p class="inbox_content text-light border-bottom pb-3 p-3">
								     hi <span class="" style="color:aqua;"><?php echo $_SESSION["lggedinusrnm"]; ?></span>,<br>
									 Greetings! from <span class="" style="color:aqua;">GuluGulu</span> team,
									 hope you are enjoying this platform. The messages you will recieve will be displayed here.
									 <br>-thanks and regards

																	        
									    	</p>  
							</div>
							<div id="sentboxMsg" style="display: none;">
								<?php
								    foreach (@$messages as $msg) {
										if($msg->From==$_SESSION["lggedinusrnm"])
										{
								    ?>
								    <p class="sent_content text-dark border-bottom b-3 p-3">
								    	<i class="fas fa-clock" style="font-size: .7em"> <?php echo calDatetimeDiff($msg->CreateDate);  ?></i><br>
								    	To : <span class="text-success"><?php echo $msg->To; ?></span><br>
										Message :	<?php echo $msg->Message; ?><br>					

									    	</p>
								    <?php }} ?>
							</div>
				       </div>
					</div>
				</div>
			</div>
			<script type="text/javascript" src="js/controls.js"></script>
			<?php include('footer.php'); ?>