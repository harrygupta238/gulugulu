<?php 
session_start();
$un=$_GET["u"];
//echo $a;
require 'controllers/functions.php';
$res=validate_username($un);
if($res=="-")
{
	header("Location: index.php");
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
		<style type="text/css">
			* {
				font-family: "Fredoka One";
			}
			body {
				margin: 0px;
			}
		</style>
	</head>
	<body>
		<div class="container bg-dark p-3 border text-center text-white">
			<h1>Welcome to</h1>
			<h1><span class="text-danger">Gulu-Gulu</span></h1>
			<p>
				Send messages to your friends secretly. To recieve messages
				signup and get your profile share-link.
			</p>
		</div>
		<div class="container bg-dark p-3 border-top text-white text-center">
			<div class="container">
				<div class="row d-flex justify-content-center">
					<div class=" col-lg-8 col-xl-8 col-sm-12 col-md-12">
						<h4>
						Gulu-Gulu is a platform, where people can share their
						feelings with their friends secretly.
						</h4>
						<p>
							<!-- <button type="button" class="btn btn-outline-danger btnplinkhome">
								Signup
							</button> -->
							<button type="button" class="btn btn-outline-danger btnplinkhome">
							<span class="fas fa-home"></span>	Home
							</button>
						</p>
					<p>
						So, what are you waiting for, it's time to do some  <span class="text-danger">Gulu-Gulu</span> with your loved ones.
					</p>
					<p>
						Don't worry your friend will not be able to see who shared this message to him/her.
					</p>
					<p>Your message will be sent to : <span class="text-info"><?php echo $un; ?></span></p>	
					</div>
				</div>
			</div>
		</div>
			<div class="container bg-dark p-3 border-bottom text-white">
				<div class="container">
				<form action="#" class="needs-validation" id="sndmsgForm" method="post">
					<div class="row d-flex justify-content-center">
						<div class="form-group col-lg-8 col-xl-8 col-sm-12 col-md-12" >
							<span class="text-danger errormsg"></span><br>
						<!-- <label for="uname">Username:</label> -->
							<input
								type="hidden"
								class="form-control username"
								id="uname"
								placeholder="krishna235"
								name="uname"
								required
								value="<?php echo $un; ?>"
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
			<div
				class="container bg-dark p-3 my-3  text-center text-white"
				style="font-family: 'Fredoka One';"
			>
				<ul class="list-group">
					<li class="list-group-item list-group-item-danger">
						* To recieve messages you must signup and get your
						profile share-link.
					</li>
					<li class="list-group-item list-group-item-danger">
						* Share your profile link on social media or with your friends so your<br>
						friends can share their feelings with you secretly.
					</li>
					<li class="list-group-item list-group-item-danger">
						* Use Gulu-Gulu to share your feelings to your friends
						secretly.
					</li>
				</ul>
			</div>
			</div>
								
			<div class="container bg-dark border p-3 text-white text-center">
				<p>
					Copyright &copy; 2020 All Rights Reserved by Spot<span class="text-danger">Chitt</span>
				</p>
			</div>
			<script type="text/javascript" src="js/controls.js"></script>
	</body>
</html>
