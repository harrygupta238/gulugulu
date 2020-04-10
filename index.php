<?php 
session_start();
require 'controllers/functions.php';
$auth=checkAuth();
if($auth==true)
{
	header("Location: userhome.php");
}  
 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Gulu-Gulu</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link
			rel="stylesheet"
			href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
		/>
		<link
			href="https://fonts.googleapis.com/css?family=Fredoka+One&display=swap"
			rel="stylesheet"
		/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
		<!-- adding the  style file -->
		<link rel="stylesheet" type="text/css" href="css/style.css">

	</head>
	<body>
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
								<button type="submit" class="btn btn-warning btn-sm btnSignupSubmit">
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
								<span>Login	</span>
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
				<button type="button" class="btn btn-info btn-sm btnGoAnonymous">
				<span class="fas fa-user"></span>	Visitor
				</button>
			</p>
		</div>

		<!-- including the footer file: -->
		<?php include("footer.php"); ?>
		
		<script type="text/javascript" src="js/controls.js"></script>
	</body>
</html>
