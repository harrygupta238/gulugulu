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
		<div class="profilelink_page container p-3 border-top text-center">
			<div class="container">
				<div class="row d-flex justify-content-center">
					<div class=" col-lg-8 col-xl-8 col-sm-12 col-md-12">
					
						<p>
							<button type="button" class="btn btn-primary btnplinkhome btn-sm">
							<span class="fas fa-home"></span>	Home
							</button>
						</p>  
          
					<p class="text-secondary">
						So, what are you waiting for, it's time to do some  <span class="text-danger">GuluGulu</span> with your loved ones.
					</p>
					<p class="text-secondary">
						Don't worry your friend will not be able to see who shared this message to him/her.
					</p>
					<p class="text-secondary">Your message will be sent to : <span class="text-success"><?php echo $un; ?></span></p>	
					</div>
				</div>
			</div>
		</div>
			<div class="profilelink_page container p-3 border-bottom">
				<div class="container">
				<form action="#" class="needs-validation" id="sndmsgForm" method="post">
					<div class="row d-flex justify-content-center">
						<div class="form-group col-lg-8 col-xl-8 col-sm-12 col-md-12" >
							<span class="text-danger errormsg"></span><br>
						
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
						<!-- <label for="pwd">Message:</label> -->
						 <textarea class="form-control message" rows="5" id="comment" placeholder="Write the message you want to share.."></textarea>
						
					</div>					
					</div>
					<div class="row d-flex justify-content-center text-center">
						<div class="form-group col-lg-4 col-xl-4 col-sm-4 col-md-4">
							<button type="submit" class="btn btn-danger btnMsgSubmit btn-sm">
								<span class="fas fa-paper-plane"></span> Send
							</button>
						</div>
					</div>
				</form>
			</div>
			
								
			<?php include("footer.php");  ?>
			<script type="text/javascript" src="js/controls.js"></script>
			
	</body>
</html>
