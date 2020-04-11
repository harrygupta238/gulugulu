

		<!-- including the  header file: -->
		<?php include("header.php"); ?>

		<div id="IndexDynamicContent">
			<div class="container  p-3 border-bottom text-secondary signupContent" style="display:none;background-color: #f0ededa3">
				<div class="container formwidth">
					<div class="text-center">
						<span>
							<h5 >
								<u>Signup</u>
							</h5>
						</span>
					</div>
					<form action="#" class="needs-validation" id="signupForm" method="post">
						<div class="row d-flex justify-content-center">
							<div class="form-group col-lg-8 col-xl-8 col-sm-12 col-md-12" >
								<span class="text-danger errormsg"></span><br>
								
								<input type="text" class="form-control username" minlength="6" placeholder="Enter username"	name="uname"  autocomplete="off" required/>
								<span class="usrnmmsg"></span>
							</div>
						</div>
						<div class="row d-flex justify-content-center">
							<div class="form-group col-lg-8 col-xl-8 col-sm-12 col-md-12">
								
								<input
							type="password"
							class="form-control password"
							minlength="6"
							placeholder="Enter password"
							name="pswd"
							autocomplete="off"
							required
						/>
								
							</div>
						</div>
						<div class="row d-flex justify-content-center">
							<div class="form-group col-lg-8 col-xl-8 col-sm-12 col-md-12">
								
								<input
							type="password"
							class="form-control cpassword"
							minlength="6"
							placeholder="Confirm password"
							name="pswd"
							required
						/>
							</div>
						</div>
						<div class="row d-flex justify-content-center text-center">
							<div class="form-group col-lg-4 col-xl-4 col-sm-4 col-md-4">
								<button type="submit" class="btn btn-primary btn-sm btnSignupSubmit">
									Submit
								</button><br>
							</div>
							
						</div>
						<div class="row d-flex justify-content-center text-center">
							<span> Already registered? <a href="#" class="btnLogin">login</a> here.</span>
						</div>
					</form>
				</div>
			</div>
			<div class="container  p-3 border-bottom text-secondary loginContent" style="background-color: #f0ededa3">
				<div class="container formwidth" >
					<div class="text-center">
						<span>
							<h5 >
								<u>Login</u>
							</h5>
						</span>
					</div>
					<form action="#" class="needs-validation" id="loginForm" method="post">
						<div class="row d-flex justify-content-center">
							<div class="form-group col-lg-8 col-xl-8 col-sm-12 col-md-12" >
								<span class="text-danger errormsg"></span><br>
								
								<input
							type="text"
							class="form-control username"
							placeholder="Enter username"
							minlength="6"
							name="uname"
							required
						/>
							</div>
						</div>
						<div class="row d-flex justify-content-center">
							<div class="form-group col-lg-8 col-xl-8 col-sm-12 col-md-12">
								<input
							type="password"
							class="form-control password"
							minlength="6"
							placeholder="Enter password"
							name="pswd"
							required
						/>
							</div>
						</div>
						<div class="row d-flex justify-content-center text-center">
							<div class="form-group col-lg-4 col-xl-4 col-sm-4 col-md-4">
								<button type="submit" class="btn btn-primary btn-sm btnLoginSubmit">
						Submit
					</button><br>
							</div><br>
							 
						</div>
						<div class="row d-flex justify-content-center text-center">
							<p> Not registered? <a href="#" class="btnSignup">sign up</a> here.</p>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="container p-3 text-center text-secondary" style="background-color: #f0ededa3">
			<p>don't want to login or register? Click the below button to visit.</p>
			<p>
				<button type="button" class="btn btn btn-warning btn-sm btnGoAnonymous">
				<span class="fas fa-user"></span>	Visitor
				</button>
			</p>
			
		</div>
	
		<!-- including the footer: -->
		<?php include("footer.php"); ?>
		<script type="text/javascript" src="js/controls.js"></script>

