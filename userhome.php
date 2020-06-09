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
		<div class="container p-3 border-top text-secondary userhome_body">
			<p class="text-center">You are logged in as : <span class="text-info"> 
			<?php echo $_SESSION["LoggedInUserName"]; ?> </span><br>
			
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
				<button type="button" id="btnGroupChatpage" data-toggle="tooltip" data-placement="top" title="Group Chat" class="btn btn-info btn-sm btnGroupChatpage mt-1">
					GroupChat <span class="fas fa-users" aria-hidden="true"></span> 
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
						Hey, what are you waiting for, it's time to do some  
						<span class="text-danger">Gulu-Gulu</span> with your loved ones.
						</p>
						<p>Copy the above profile-link and share on social media, tell your friends to share their thoughts about you secretly. </p>
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
								<span class="fas fa-paper-plane"></span> Send
							</button>
						</div>
					</div>
				</form>
			</div>
			<hr>
		</div>

			<div class="container border-top border-bottom p-3 inboxsentbox text-white userhome_body">
				<div class="">
					<div class="row d-flex justify-content-center">
						<div class="col-lg-8 col-xl-8 col-sm-12 col-md-12 msgBox">
							<div id="inboxMsg" class="">
								<?php  
									@$messages=getAllMessageList();
									//var_dump($messages);
									foreach (@$messages as $msg) {
										if($msg->To==$_SESSION["LoggedInUserName"])
										{
									?>
											
											<p class="text-light border-bottom b-3 p-3 m-4 inbox_content">
												<i class="fas fa-clock" style="font-size: .7em"> <?php
												echo calDatetimeDiff($msg->CreateDate);
												  ?></i><br>
												<?php echo $msg->Message; ?><br>
												<a href="#" class="btnpreviewfeedback" data-id="<?php echo $msg->_id; ?>" ><i class="fa fa-download" style="font-size: 1em;margin-top: -40px;cursor: pointer;float: right;"></i></a>
												      
									    	</p>
											<div class="ppppp" style="width: 100%;text-align: center;">
												<div dwnld-id="<?php echo $msg->_id; ?>" class="card-deck card-text downloadfeedbackbox rounded-lg" style="display: inline-block; width: 60%">
													<div class="card-body text-center" style="min-height: 100px;">
														<p><?php echo $msg->Message; ?></p>
													</div>
													<div class="text-center">
				                                         <span class="dwnld_msg_logo">Gulu<i class="fas fa-comments"></i>Gulu<span>
                                                    </div>
                                                </div>
											</div>
                                                
									 
											<!-- </div> -->
								<?php }} ?> 
								<p class="inbox_content text-light border-bottom pb-3 p-3">
								     hi <span class="text-info"><?php echo $_SESSION["LoggedInUserName"]; ?></span>,<br>
									 Greetings! from <span class="" style="color: #b8f7f6;">Gulu-Gulu</span> team,
									 hope you are enjoying this platform. The messages you will recieve will be displayed here.
									 <br>-thanks and regards

																	        
									    	</p>  
							</div>
							<div id="sentboxMsg" style="display: none;">
								<?php
								    foreach (@$messages as $msg) {
										if($msg->From==$_SESSION["LoggedInUserName"])
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