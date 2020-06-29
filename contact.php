<?php 
session_start();
require 'controllers/functions.php';
        setVisitorCookie();
		include("headerlink.php");
		include("header.php");
 ?>
		<div id="visitor_body_part" class="text-center container p-3 border-top text-secondary">
			<div class="container">
				<div class="row d-flex justify-content-center">
					<div class=" col-lg-8 col-xl-8 col-sm-12 col-md-12">
						
						<p>Please reach out to us for any queries or feedback .  </p>
						<p><i class="fa fa-envelope" aria-hidden="true"></i>: krishnanand8081@gmail.com, gulugulu.2g@gmail.com</p>
						<p>Mobile : +91-7906307683, +91-7895344376</p>
						<p>Or you can contact us through below form:</p>
						<form action="#" class="needs-validation" id="sndmsgForm" method="post">
					<div class="row d-flex justify-content-center">
						<div class="form-group col-lg-8 col-xl-8 col-sm-12 col-md-12" >
							<span class="text-danger errormsg"></span>
							<!-- <label for="uname">Username:</label> -->
							<input
							type="email"
							class="form-control email"
							id="uname"
							placeholder="Email"
							autocomplete="off"
							name="uname"
							required
							/>
							
						</div>
						<div class="form-group col-lg-8 col-xl-8 col-sm-12 col-md-12" >
							<span class="text-danger errormsg"></span>
							<!-- <label for="uname">Username:</label> -->
							<input
							type="text"
							class="form-control phone"
							id="uname"
							placeholder="Mobile No."
							autocomplete="off"
							name="uname"
							required
							/>
						</div>
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
				</div>
				
			</div>
			<!-- <hr class="bg-warning"> -->
			</div>
			<script type="text/javascript" src="js/controls.js"></script>
			
			<!-- including the footer: -->
		<?php include("footer.php"); ?>
