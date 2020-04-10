<?php 
session_start();
require 'controllers/functions.php';
$auth=checkAuth();
if($auth==false)
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
			href="https://fonts.googleapis.com/css?family=Fredoka+One&display=swap"
			rel="stylesheet"
		/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
		<style type="text/css">
			.anyClass {
  height:452px;
  overflow-y: scroll;
}
			* {
				font-family: "Fredoka One";
			  }
			  body 
			  {
				margin: 0px;
				background-color: #ffffff;;
			  }
			  
			  
			  .formwidth {
				    width: 55%;
				    background-color: #ffffff;;
				    padding: 1em;
				     border: .1px grey;
 					 box-shadow: inset 0px 0px 0px 0px #efefe8;
 					 border-radius: 3px;
				  }
				  .usrnmmsg {
				    position: absolute;
				    z-index: 10000;
				    font-size: 12px;
				    margin-top: -17px;
				    margin-left: 12px;
				}
				.logoimg
				  {
				  	width: 4em;
				  }
				@media screen and (max-width: 720px) {
				  .formwidth {
				    width: 91%;
				  }
				  .logoimg
				  {
				  	width: 3em;
				  }
				}
				.containerr {
				  border: 2px solid #dedede;
				  background-color: #f1f1f1;
				  border-radius: 5px;
				  padding: 10px;
				  margin: 10px 0;
				}

				.darker {
				  border-color: #ccc;
				  background-color: #ddd;
				}

				.containerr::after {
				  content: "";
				  clear: both;
				  display: table;
				}

				.containerr img {
				  float: left;
				  max-width: 60px;
				  width: 100%;
				  margin-right: 20px;
				  border-radius: 50%;
				}

				.containerr img.right {
				  float: right;
				  margin-left: 20px;
				  margin-right:0;
				}

				.time-right {
				  float: right;
				  color: #aaa;
				}

				.time-left {
				  float: left;
				  color: #999;
				}
				
		</style>
	</head>
	<body>
		<div class="container bg-dark p-3 border text-center text-white">
			<h1>
				<span class="text-light">Gulu Gulu</span>
			</h1>
			<p style="font-size: 0.7em;">
				Protect your identity. Send messages to your friends secretly.
			</p>
		</div>
		<div class="container p-3 text-center text-secondary" style="margin-bottom: -2em;background-color: #f0ededa3">
			<p>
				<button type="button" class="btn btn-outline-secondary btn-sm btnHome">
				<span class="fas fa-user"></span>	Home
				</button>
				<button type="button" class="btn btn-outline-secondary btn-sm btnNewGroup">
				<span class="fas fa-user"></span>	Create New Group
				</button>
			</p>
			
		</div>
		<div id="IndexDynamicContent" style="display:none;">
			<div class="container  p-3 border-bottom text-secondary loginContent" style="background-color: #f0ededa3">
				<div class="container formwidth" >
					<div class="text-center">
						<span>
							<h6 >
								<u>New Group</u>
							</h6>
						</span>
					</div>
					<form action="#" class="needs-validation" id="createGroupForm" method="post">
						<div class="row d-flex justify-content-center">
							<div class="form-group col-lg-8 col-xl-8 col-sm-12 col-md-12" >
								<span class="text-danger errormsg"></span><br>
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
							<div class="form-group col-lg-4 col-xl-4 col-sm-4 col-md-4">
								<button type="submit" class="btn btn-secondary btn-sm btncreateGroupSubmit">
									Submit
								</button>
								<button type="submit" class="btn btn-secondary btn-sm btnCancelNewGroup">
									Cancel
								</button>
								
							</div><br>
							 
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="container  p-3 border-bottom text-secondary loginContent" style="background-color: #f0ededa3">
			<div class="row">
			      <div class="col-sm-4">
			      	  <ul class="list-group grouplist anyClass">
			           	
			          </ul>
			      </div>
			      <div class="col-sm-8" style="background-color: ghostwhite;">
			      	<div class="anyClass">
			      		<div class="containerr">
						  <img src="images/pp.jpg" alt="Avatar" style="width:100%;">
						  <p>Hello. How are you today?</p>
						  <span class="time-right">11:00</span>
						</div>

						<div class="containerr darker">
						  <img src="images/pp.jpg" alt="Avatar" class="right" style="width:100%;">
						  <p>Hey! I'm fine. Thanks for asking!</p>
						  <span class="time-left">11:01</span>
						</div>

						<div class="containerr">
						  <img src="images/pp.jpg" alt="Avatar" style="width:100%;">
						  <p>Sweet! So, what do you wanna do today?</p>
						  <span class="time-right">11:02</span>
						</div>

						<div class="containerr darker">
						  <img src="images/pp.jpg" alt="Avatar" class="right" style="width:100%;">
						  <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
						  <span class="time-left">11:05</span>
						</div>
						<div class="containerr">
						  <img src="images/pp.jpg" alt="Avatar" style="width:100%;">
						  <p>Hello. How are you today?</p>
						  <span class="time-right">11:00</span>
						</div>

						<div class="containerr darker">
						  <img src="images/pp.jpg" alt="Avatar" class="right" style="width:100%;">
						  <p>Hey! I'm fine. Thanks for asking!</p>
						  <span class="time-left">11:01</span>
						</div>

						<div class="containerr">
						  <img src="images/pp.jpg" alt="Avatar" style="width:100%;">
						  <p>Sweet! So, what do you wanna do today?</p>
						  <span class="time-right">11:02</span>
						</div>

						<div class="containerr darker">
						  <img src="images/pp.jpg" alt="Avatar" class="right" style="width:100%;">
						  <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
						  <span class="time-left">11:05</span>
						</div>
						<div class="containerr">
						  <img src="images/pp.jpg" alt="Avatar" style="width:100%;">
						  <p>Hello. How are you today?</p>
						  <span class="time-right">11:00</span>
						</div>

						<div class="containerr darker">
						  <img src="images/pp.jpg" alt="Avatar" class="right" style="width:100%;">
						  <p>Hey! I'm fine. Thanks for asking!</p>
						  <span class="time-left">11:01</span>
						</div>

						<div class="containerr">
						  <img src="images/pp.jpg" alt="Avatar" style="width:100%;">
						  <p>Sweet! So, what do you wanna do today?</p>
						  <span class="time-right">11:02</span>
						</div>

						<div class="containerr darker">
						  <img src="images/pp.jpg" alt="Avatar" class="right" style="width:100%;">
						  <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
						  <span class="time-left">11:05</span>
						</div>
			      	</div>
			      	<div class="row d-flex border-top pt-2 justify-content-center">
							<div class="form-group col-lg-11 col-xl-11 col-sm-11 col-md-11">
								<input
							type="text"
							class="form-control password"
							minlength="6"
							placeholder="Type Your Message here.."
							name="pswd"
							required
							/>
							</div>
							<div class="form-group col-lg-1 col-xl-1 col-sm-1 col-md-1" style="margin-left: -1.5em;">
								<button type="submit" class="btn btn-secondary btnMsgSubmit">
									<span class="fas fa-paper-plane"></span>
								</button>
							</div>

						</div>
			      </div>
	    	</div>
		</div>
		<div class="container bg-dark border p-3 text-light text-center">
			<p>
			Copyright &copy; 2020 All Rights Reserved by GuluGulu.
			</p>
		</div>
		<script type="text/javascript" src="js/controls.js"></script>
	</body>
</html>
