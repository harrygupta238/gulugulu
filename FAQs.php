<?php 
session_start();
require 'controllers/functions.php';
        setVisitorCookie();
		include("headerlink.php");
		include("header.php");
 ?>
 <div class="container p-3 text-center text-secondary" style="background-color: rgba(240, 237, 237, 0.65)">
			
    <div class="p-2 "><button type="button" class="btn btn-info btn-sm btnHome">
				<span class="fas fa-home"></span>
				</button></div>
  </div>
		<div id="visitor_body_part" class="container p-3 border-top text-secondary">
			<div class="container">
				<div class="row d-flex justify-content-center">
					<div class=" col-lg-8 col-xl-8 col-sm-12 col-md-12">
					
						<p class="text-dark">What is GuluGulu?</p>
						<p>GuluGulu is an online platform for Anonymous Messaging and Chat Rooms. It is created by <a href="https://www.facebook.com/harry.gupta.315" target="_blank">Krishna Nand</a> with help of his friends <a href="https://www.instagram.com/aadi_0204/?hl=en" target="_blank">Vishal Gupta</a>, <a href="https://www.facebook.com/profile.php?id=100003515278231" target="_blank">Vishal Kumar</a> and <a href="https://www.facebook.com/profile.php?id=100009409841899">Niray Kumar Ray.</a> </p>

						<p class="text-dark">What is purpose of GuluGulu?</p>
						<p>The purpose of GuluGulu is to provide an online platform where people can share anonymous feedbacks with each other. </p>
						<p>Feedback promotes personal and professional growth.</p>
						<p>Feedback is about listening actively, taking the time to analyze, and then thinking of the best possible solution to perform better. It provides positive criticism and allows to see what everyone can change to improve their focus and results</p>

						<p class="text-dark">How GuluGulu can help?</p>
						<p>Have you seen the letter-box in every school/colleges or any organization..which is used as complaint-box or feedback-box against the Organization. Well!, In the mordern digital world, GuluGulu is replacement of that letter-box. So when you join the GuluGulu, you can create your own letter-box so others can drop messages in you box,or you can drop your messages in other's letter-boxes. You can ask/share your feedbacks, views or opinions with your friends, colleagues or family members. </p>

						<p class="text-dark">What are GuluGulu's key features?</p>
						<p>The fun feature of GuluGulu is anonymousity, means you can send messages to others without disclosing your identity.</p>
						<p>GuluGulu two key features are :<br>
							1. Anonymous Messaging<br>
							2. Chat Rooms<br>
						</p>
						<p class="text-dark">What is Anonymous Messaging feature?</p>
						<p>In this feature people can send messages to GuluGulu registered users, these messages will be anonymous, and recievers won't know the sender's identity.</p>
						<p>GuluGulu users can recieve messages from other GuluGulu users as well as users not registered on GuluGulu. </p>
						<p>Users not registered on our platform can only send messages to other GuluGulu users and can not recieve messages.</p>

						<p class="text-dark">What is Chat Rooms?</p>
						<p>Chat Room is an online place where people can communicate with each other and discuss their ideas over common subjects. </p>
						<p>In this feature, GuluGulu users can create multiple Chat Rooms for unique topics and invite others to participate in by sending them  Chat Room's unique link.</p>
						<p>Users not registered on GuluGulu can also participate in Chat Rooms. </p>
						<p class="text-dark">Who can use GuluGulu?</p>
						<p>Everyone.</p>
						<p class="text-dark">Can GuluGulu benefit Companies or large scale  organizations? </p>
						<p>Companies or large scale organizations such as Schools/Colleges/Banks etc. always requires a better feedback system, through which their students or employees can share concerns/feedbacks regarding the organization without disclosing their identity, for such organizations GuluGulu is a better option for them.</p>
						
					</div>
				</div>
				
			</div>
			<!-- <hr class="bg-warning"> -->
			</div>
			<script type="text/javascript" src="js/controls.js"></script>
			
			<!-- including the footer: -->
		<?php include("footer.php"); ?>
