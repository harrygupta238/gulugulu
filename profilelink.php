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
		<div class="container p-3 border-top text-center" style="background-color: rgba(240, 237, 237, 0.65)">
			<div class="container">
				<div class="row d-flex justify-content-center">
					<div class=" col-lg-8 col-xl-8 col-sm-12 col-md-12">
						<p>
							<button type="button" class="btn btn-primary btnplinkhome btn-sm">
							<span class="fas fa-home"></span>
							</button>
						</p>  
						
						<p class="text-secondary">Your message will be sent to : <span class="text-success"><?php echo $un; ?></span></p>
						<p class="text-secondary">Don't worry your friend will not be able to see who shared this message to him/her.</p>
							
						<form action="#" class="needs-validation" id="sndmsgForm" method="post">
					<div class="row d-flex justify-content-center">
						<div class="form-group col-lg-8 col-xl-8 col-sm-12 col-md-12" >
							<span class="text-danger errormsg"></span>
						
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
							
							<button type="submit" class="btn btn-sm btn-primary btnMsgSubmit">
								 Send <span class="fas fa-paper-plane"></span>
							</button>
						</div>
					</div>
				</form>
					</div>
				</div>
			</div>
		</div>
		<div class=" container p-3 border-bottom" style="background-color: rgba(240, 237, 237, 0.65)">
			<div class="container">
				<p class="text-secondary text-center">
					Write some appealing message here..
				</p>
			</div>
		</div>
				<script type="text/javascript" src="js/controls.js"></script>				
			<?php include("footer.php");  ?>
			
