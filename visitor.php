<?php 
session_start();
require 'controllers/functions.php';
 $auth=checkAuth();
		if($auth==true)
		{
			header("Location: userhome.php");
		}
setVisitorCookie();
		include("headerlink.php");
		include("header.php");
 ?>
		<div id="visitor_body_part" class="container p-3 border-top text-secondary">
			<div class="container">
				<div class="row d-flex justify-content-center">
					<div class=" col-lg-8 col-xl-8 col-sm-12 col-md-12">
					<p class="text-center p-3">You are logged in as : <span class="text-info">Visitor  &nbsp;&nbsp;<button type="button" id="logout" data-toggle="tooltip" data-placement="top" title="logout" class="btn btn-danger btn-sm btnHome mt-1">
				 <span class="fas fa-sign-out-alt" aria-hidden="true"></span> 
				</button></span></p>
						<p>
						Hey, What are you waiting for, it's time to do some  
							<span class="" style="color: #24305E">GuluGulu</span> with your loved ones.
					
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
							<button type="submit" class="btn btn-primary btn-sm btnMsgSubmit">
								<span class="fas fa-paper-plane"></span> Send
							</button>
						</div>
					</div>
				</form>
			</div>
			<!-- <hr class="bg-warning"> -->
			</div>
			<script type="text/javascript" src="js/controls.js"></script>
			
			<!-- including the footer: -->
		<?php include("footer.php"); ?>
