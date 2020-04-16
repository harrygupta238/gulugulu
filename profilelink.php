<?php 
session_start();
$un=$_GET["u"];
//echo $a;
require 'controllers/functions.php';
setVisitorCookie();
$res=validate_username($un);
if($res=="-")
{
	header("Location: index.php");
}
        include("headerlink.php");
		include("header.php"); 

 ?>
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
			<script type="text/javascript" src="js/constantclient.js"></script>
	</body>
</html>
