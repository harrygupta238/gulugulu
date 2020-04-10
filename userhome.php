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
			href="https://fonts.googleapis.com/css?family=Acme&display=swap"
			rel="stylesheet"
		/>
		<link
			href="https://fonts.googleapis.com/css?family=Fredoka+One&display=swap"
			rel="stylesheet"
		/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
		<div
			class="container bg-dark p-3 border text-center text-white"
			style=""
		>
			
			<h1>
				<span class="text-danger"><a href="index.php" class="text-danger" style="text-decoration: none;">Gulu-Gulu</a></span>
			</h1>
			<p>You are logged in as : <span class="text-info"> <?php echo $_SESSION["username"]; ?> <br>
				<button type="button" id="logout" class="btn btn-outline-info btn-sm btnHome mt-1">
					<span class="fas fa-sign-out-alt" aria-hidden="true"></span> Logout
				</button>
				<button type="button" id="btnGroupChatpage" class="btn btn-outline-info btn-sm btnGroupChatpage mt-1">
					<span class="fas fa-users" aria-hidden="true"></span> GroupChat
				</button>
			</p>
		</div>
		<div class="container bg-dark p-3 border-top text-white">
			<div class="container">
				<div class="row d-flex justify-content-center">
					<div class=" col-lg-8 col-xl-8 col-sm-12 col-md-12">
						<p class="bg-light text-dark p-3">
							<span id="profilelink"><span id="profilelinkorigin"></span><span id="un"><?php echo $_SESSION["username"]; ?></span></span>    
							<button data-toggle="tooltip" data-placement="right" title="copy to clipboard" type="button" class="btn btn-outline-danger btnCopy btn-sm">
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
							<button type="submit" class="btn btn-danger btnMsgSubmit">
								<span class="fas fa-paper-plane"></span> Send
							</button>
						</div>
					</div>
				</form>
			</div>
			<hr class="bg-warning">
			</div>
			<div class="container border-bottom bg-dark p-3 text-white">
				<div class="container">
					<div class="row d-flex mb-3 justify-content-center text-center">
						<div class="col-lg-8 col-xl-8 col-sm-12 col-md-12">
							<button type="button" class="btn btn-outline-danger active btnInBox">
								<span class="fas fa-envelope"> </span> Inbox
							</button>
							<button type="button" class="btn btn-outline-danger btnSentBox">
								<span class="fas fa-envelope"> </span> Sent
							</button>
							<button type="button" class="btn btn-outline-light btnInBox">
								<span class="fas fa-sync-alt"> </span>
							</button>
						</div>
					</div>
					<div class="row d-flex justify-content-center">
						<div class="col-lg-8 col-xl-8 col-sm-12 col-md-12 msgBox">
							<div id="inboxMsg">
								<?php  
									@$messages=getAllMessageList();
									//var_dump($messages);
									foreach (@$messages as $msg) {
										if($msg->To==$_SESSION["username"])
										{
									?>
											
											<p class="bg-light text-dark border-bottom b-3 p-3">
												<i class="fas fa-clock" style="font-size: .7em"> <?php echo date("M d, Y H:i:s a",strtotime($msg->CreateDate));  ?></i><br>
												<?php echo $msg->Message; ?><br>
												
												      
									    	</p>
								<?php }} ?> 
								<p class="bg-light text-dark border-bottom b-3 p-3">
								     hi <span class="text-info"><?php echo $_SESSION["username"]; ?></span>,<br>
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
			<div class="container bg-dark border p-3 text-white text-center">
				<p>
			Copyright &copy; 2020 All Rights Reserved by Spot<span class="text-danger">Chitt</span>
				</p>
			</div>
			<script type="text/javascript" src="js/controls.js"></script>
		</body>
	</html>
