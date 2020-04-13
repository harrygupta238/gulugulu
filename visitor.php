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
			href="https://fonts.googleapis.com/css?family=Acme&display=swap"
			rel="stylesheet"
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
		<div
		<!-- including the  header file: -->
		<?php include("header.php"); ?>
			
		</div>

		<div id="visitor_body_part" class="container p-3 border-top text-secondary">
			<div class="container bg-white">
				<div class="row d-flex justify-content-center">
					<div class=" col-lg-8 col-xl-8 col-sm-12 col-md-12">
					<p class="text-center p-3">You are logged in as : <span class="text-info">Visitor  &nbsp;&nbsp;<button type="button" id="logout" class="btn btn-danger btn-sm btnplinkhome mt-1">
					<span class="fas fa-sign-out"></span>logout
				</button></span></p>
						<p>
						Hey, What are you waiting for, it's time to do some  
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
							<button type="submit" class="btn btn-danger btnMsgSubmit">
								<span class="fas fa-paper-plane"></span> Send
							</button>
						</div>
					</div>
				</form>
			</div>
			<!-- <hr class="bg-warning"> -->
			</div>
			<!-- including the footer: -->
		<?php include("footer.php"); ?>
			<script type="text/javascript" src="js/controls.js"></script>
		</body>
	</html>
