<?php 
session_start();
require 'controllers/functions.php';
$auth=checkAuth();
if($auth==false)
{
	header("Location: index.php");
}
 ?>
 		<!-- including the  header file: -->
		 <?php include("header.php"); ?>
		
		
		<div class="container p-3 border-top text-secondary userhome_body">
           
		<div>
			<p class="text-center">You are logged in as : <span class="text-success"> 
			<?php echo $_SESSION["username"]; ?> <br>
				<button type="button" id="logout" class="btn btn-danger btn-sm btnHome mt-1">
					<span class="fas fa-sign-out-alt" aria-hidden="true"></span> Logout
				</button>
				<button type="button" id="btnGroupChatpage" class="btn btn-info btn-sm btnGroupChatpage mt-1">
					<span class="fas fa-users" aria-hidden="true"></span> GroupChat
				</button>
			</p>
		</div>


			<div class="container">
				<div class="row d-flex justify-content-center">
					<div id="copy_content" class="col-lg-8 col-xl-8 col-sm-12 col-md-12">
						<p id="copy_link" class="bg-white p-5">
							<span id="profilelink"><span id="profilelinkorigin"></span><span id="un"><?php echo $_SESSION["username"]; ?></span></span>    
							<button data-toggle="tooltip" data-placement="right" title="copy to clipboard" type="button" class="btn btn-dark btnCopy btn-sm float-right">
								Copy  <span class="fas fa-copy" aria-hidden="true"></span>
							</button>
						</p>
						
						<p>copy the above profile-link and share on social media, tell your friends to share their thoughts about you secretly. </p>
						<p>
						Hey, what are you waiting for, it's time to do some  
						<span class="text-danger">Gulu-Gulu</span> with your loved ones.
						</p>
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
							<label for="uname">Username:</label>
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
							<label for="pwd">Message:</label>
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
			<div class="container border-bottom p-3 text-white userhome_body">
				<div class="container">
					<div class="row d-flex mb-3 justify-content-center text-center">
						<div class="col-lg-8 col-xl-8 col-sm-12 col-md-12">
							<button type="button" class="btn btn-primary active btnInBox">
								<span class="fas fa-envelope"> </span> Inbox
							</button>
							<button type="button" class="btn btn-warning btnSentBox">
								<span class="fas fa-envelope"> </span> Sent
							</button>
							<button type="button" class="btn btn-dark btnInBox">
								<span class="fas fa-sync-alt"> </span>
							</button>
						</div>
					</div>
					<div class="row d-flex justify-content-center">
						<div class="col-lg-8 col-xl-8 col-sm-12 col-md-12 msgBox">
							<div id="inboxMsg" class="bg-light pt-4">
								<?php  
									@$messages=getAllMessageList();
									//var_dump($messages);
									foreach (@$messages as $msg) {
										if($msg->To==$_SESSION["username"])
										{
									?>
											
											<p class="text-dark border-bottom b-3 p-3 m-4 inbox_content">
												<i class="fas fa-clock" style="font-size: .7em"> <?php echo date("M d, Y H:i:s a",strtotime($msg->CreateDate));  ?></i><br>
												<?php echo $msg->Message; ?><br>
												
												      
									    	</p>
								<?php }} ?> 
								<p class="inbox_content text-dark border-bottom pb-3 p-3">
								     hi <span class="text-success"><?php echo $_SESSION["username"]; ?></span>,<br>
									 Greetings! from <span class="text-danger">Gulu-Gulu</span> team,
									 hope you are enjoying this platform. The messages you will recieve will be displayed here.
									 <br>-thanks and regards

																	        
									    	</p>  
							</div>
							<div id="sentboxMsg" style="display: none;">
								<?php
								    foreach (@$messages as $msg) {
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
				       </div>
					</div>
				</div>
			</div>

		</div>

		
			<!-- footer addede -->
			<?php include("footer.php"); ?>
			<script type="text/javascript" src="js/controls.js"></script>
		</body>
	</html>
