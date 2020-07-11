var hostorigin = window.location.origin;
var userhomehref = hostorigin + _constantClient.rootdir+"/userhome.php";
var logouthref = hostorigin + _constantClient.rootdir +"/index.php";
var anonymoususerhref = hostorigin + _constantClient.rootdir +"/visitor.php";
var groupchatpagehref = hostorigin +_constantClient.rootdir +"/groupchat.php";
var btnloader = '<span class="spinner-border spinner-border-sm"></span>';
let groupsharelink = hostorigin + _constantClient.rootdir +"/groupvisitor.php?g=";

// ===================== js for userhome.php===============================
if(window.location.pathname==_constantClient.rootdir+"/userhome.php"){
	let wlcmmessage=`<p class="text-center">Welcome to <span style="color: #24305E">GuluGulu</span>,<br>
Are you new here?<br>
Share your profile-link/Username on social media or with friends,<br> 
so your friends could share their thoughts about you.<br>
and the fun part is you won't be able to know who sent you the messages.
</p>`;
	buildModal({type:"alert", content:wlcmmessage});
	$(document).on("click", ".btnGroupChatpage", function () {
	 window.location.href = groupchatpagehref;
	});
	$(document).on("click",".btnInBox", function(){
	 window.location.reload();
	});
$(document).on("click", ".btnSentBox", function () {
	$(".btnInBox").removeClass("active");
	$(".btnSentBox").removeClass("active");
	$(".btnNewMsgBox").removeClass("active");
	$(this).addClass("active");
	$(".newMsgBox").hide();
	$(".inboxsentbox").show();

	let data = { getAllMessageList: true };
	let btnMsgCtrl = $(this);
	$(".errormsg").html("");
	$(".msgBox").html('<center><div class="spinner-border text-danger mt-3"></div></center>');
	$.ajax({
		type: "POST",
		url: "controllers/controller.php",
		data: data,
		success: function (response) {
			$(".msgBox").html(response);
			let abc = $(this).hasClass("btnInBox");
			let bcd = $(this).hasClass("btnSentBox");
			if (btnMsgCtrl.hasClass("btnInBox")) {
				$(".btnInBox").addClass("active");
				$(".btnSentBox").removeClass("active");
				$("#inboxMsg").show();
				$("#sentboxMsg").hide();
			}
			else if (btnMsgCtrl.hasClass("btnSentBox")) {
				$(".btnInBox").removeClass("active");
				$(".btnSentBox").addClass("active");
				$("#inboxMsg").hide();
				$("#sentboxMsg").show();
			}
			
		}
	});
});

$(document).on("click", ".btnCopy", function () {
	var copyText = $(document).find(".profilelink").text();
	let temp = $("<input>");
	$("body").append(temp);
	temp.val(copyText).select();
	document.execCommand("copy");
	temp.remove();
	//$(this).attr("title", 'Copied: ' + copyText);
	$(this).find(".myPlPopup").toggleClass("show");
    setTimeout(function(){
    	$(".myPlPopup").toggleClass("show");
    }, 1000);
	//buildModal({type:"alert", content:"Your Profile Link has been copied."})
});


$(document).on("click",".btnNewMsgBox", function(){
	$(".btnInBox").removeClass("active");
	$(".btnSentBox").removeClass("active");
	$(this).addClass("active");

	$(".inboxsentbox").hide();
	$(".newMsgBox").show();
});
$(document).on("click",".btnpreviewfeedback", function(){
	
	let t=$(this);
	let dataid=t.attr("data-id");
	t.closest("#inboxMsg").find("[dwnld-id]").hide();
	//t.closest("#inboxMsg").find("[dwnld-id='"+dataid+"']").show();
});

generateImageOfMsg();
}

	

// ===================== js for index.php===============================
if(window.location.pathname==_constantClient.rootdir+"/index.php" || window.location.pathname==_constantClient.rootdir+"/"){

$(document).on("click", ".btnLogin", function () {
	//$(".defaultContent").hide();
	$(".signupContent").hide();
	$(".loginContent").show();

	//$(".btnHome").removeClass("active");
	$(".btnSignup").removeClass("active");
	$(".btnLogin").addClass("active");
	$(".errormsg").html("");
});

$(document).on("click", ".btnSignup", function () {
	//$(".defaultContent").hide();
	$(".loginContent").hide();
	$(".signupContent").show();

	//$(".btnHome").removeClass("active");
	$(".btnSignup").addClass("active");
	$(".btnLogin").removeClass("active");
	$(".errormsg").html("");
});
$(document).on("click", ".btnGoAnonymous", function () {
	window.location.href = anonymoususerhref;
});
$("#signupForm").submit(function (e) {
	e.preventDefault();
	$(".btnSignupSubmit").find(".spinner-border").remove();
	let el = $("#signupForm").find(".error").length;
	if (el > 0) {
		return;
	}
	let username = $("#signupForm").find(".username").val().toLowerCase().trim();
	let password = $("#signupForm").find(".password").val();
	let cpassword = $(".cpassword").val();
	if (password != cpassword) {
		let message = '<span class="text-danger error"><small>Password does not match.</small></span>';
		$("#signupForm").find(".cpassword").after(message);
		return;
	}
	else {
		$(".btnSignupSubmit").append(btnloader);
		let data = { signup: true, username: username, password: password };
		$.ajax({
			type: "POST",
			url: "controllers/controller.php",
			data: data,
			success: function (response) {
				if (response == "username_exists") {
					let message = '<span class="text-danger error"><small>Username already taken.</small></span>';
					$("#signupForm").find(".usrnmmsg").html(message);
					$(".btnSignupSubmit").find(".spinner-border").remove();
				}
				else if (response == "inserted") {
					$(".btnSignupSubmit").find(".spinner-border").remove();
					window.location.href = userhomehref;
				}
				else if (response == "insert_failed") {
					let message = '<small>Signup failed.</small>';
					$("#signupForm").find(".errormsg").html(message);
					$(".btnSignupSubmit").find(".spinner-border").remove();
					//$(".errormsg").addClass('error');
				}
			}
		});
	}
});


$("#loginForm").submit(function (e) {
	e.preventDefault();
	$(".btnLoginSubmit").find(".spinner-border").remove();
	$(".error").remove();
	let username = $(this).find(".username").val().toLowerCase().trim();
	let password = $(this).find(".password").val();
	$(".btnLoginSubmit").append(btnloader);
	let data = { login: true, username: username, password: password };
	$.ajax({
		type: "POST",
		url: "controllers/controller.php",
		data: data,
		success: function (response) {
			if (response == "failed") {
				let message = '<small>Username or Password is incorrect.</small>';
				$(".errormsg").html(message);
				$(".btnLoginSubmit").find(".spinner-border").remove();
				//$(".errormsg").addClass('error');
			}
			else if (response == "success") {
				window.location.href = userhomehref;
			}
		},
		error: function (err) {
			console.log("error :" + err);
		}
	});
});

$(document).on("input", "#signupForm .username", function () {
	$(".error, .text-success").remove();

	let username = $(this).val().toLowerCase().trim();
	if(username=="")
		return;
	let usernameCtrl = $(this);

	validateUserName(username, usernameCtrl, function (isValid) {
		if (isValid == false) {
			return;
		} else if (isValid == true) {

		}
	});
});
function validateUserName(username, usernameCtrl, callback) {
	let isValid = true;
	if (username.includes(" ")) {

		let message = '<span class="text-danger error"><small>Space not allowed in username.</small></span>';
		usernameCtrl.closest(".row").find(".usrnmmsg").html(message);
		isValid = false;
		//callback(isValid);
		return isValid;
	}
	else if (username.length < 6) {
		let message = '<span class="text-danger error"><small>Username must contain more than 6 charecters.</small></span>';
		usernameCtrl.closest(".row").find(".usrnmmsg").html(message);
		isValid = false;
		//callback(isValid);
		return isValid;
	}
	let data = { username_validation: true, username: username };

	let loader = '<div class="spinner-border spinner-border-sm text-danger mt-3"></div>';
	usernameCtrl.closest(".row").find(".usrnmmsg").html(loader);
	$.ajax({
		type: "POST",
		url: "controllers/controller.php",
		data: data,
		success: function (response) {
			if (response == "+") {

				let message = '<span class="text-danger error"><small>Username already taken.</small></span>';
				usernameCtrl.closest(".row").find(".usrnmmsg").html(message);
				isValid = false;
				callback(isValid);
			}
			else if (response == "-") {
				let message = '<span class="text-success"><small>Valid.</small></span>';
				usernameCtrl.closest(".row").find(".usrnmmsg").html(message);
				isValid = true;
				callback(isValid);
			}
		}
	});
}
$(document).on("input", ".password, .cpassword", function () {
	$(this).closest('.form-group').find(".error").remove();
});

}

// ===================== js for multiple pages ===============================
$(document).on("click", "#logout", function () {
	$("#logout").append(btnloader);
	let data = { logout: true };
	$.ajax({
		type: "POST",
		url: "controllers/controller.php",
		data: data,
		success: function (response) {
			if (response) {
				window.location.href = logouthref;
			}
		},
		error: function (error) {
			console.log(error);
		}
	});
});



$(document).on("click", ".btnHome", function () {
	window.location.href = userhomehref;
});


function isUsernameExist(username, callback) {
	let data = { username_validation: true, username: username };
	$.ajax({
		type: "POST",
		url: "controllers/controller.php",
		data: data,
		success: function (response) {
			if (response) {
				callback(response);
			}
		}
	});
}




$(document).on("input", "#sndmsgForm .username", function () {
	$(this).closest('.form-group').find(".error, .succes").remove();
	let username = $(this).val().toLowerCase().trim();
	let usernameCtrl = $(this);
	let loader = '<div class="spinner-border spinner-border-sm text-danger mt-3"></div>';
	usernameCtrl.closest(".row").find(".usrnmmsg").html(loader);
	isUsernameExist(username, function (response) {
		if (response == "+") {
			let message = '<span class="text-success succes"><small>Valid.</small></span>';
			usernameCtrl.closest(".row").find(".usrnmmsg").html(message);
		}
		else if (response == "-") {
			let message = '<span class="text-danger error"><small>Invalid Username.</small></span>';
			usernameCtrl.closest(".row").find(".usrnmmsg").html(message);
		}
	});

});

$("#contactusForm").submit(function (e) {
	e.preventDefault();
	$(".btncontactusSubmit").find(".spinner-border").remove();
	let el = $(this).find(".error").length;
	if (el > 0) {
		return;
	}
	let formcontainer=$("#contactusForm");
	let email = $(this).find(".email").val().toLowerCase().trim();
	let phone = $(this).find(".phone").val();
	let message = $(this).find(".message").val();
	//alert(toUsername+" "+message);
	$(".btncontactusSubmit").append(btnloader);
	let data = { contactusForm: true, email: email,phone:phone, message: message };
	$.ajax({
		type: "POST",
		url: "controllers/controller.php",
		data: data,
		success: function (result) {
			 result=JSON.parse(result);
			if (result.response == "failed") {
				let message = '<p><small>Message sending failed, Please try again.</small></p>';
				$(".errormsg").removeClass("text-success").addClass("text-danger");
				buildModal({type:"alert",content:message});
				$(".btncontactusSubmit").find(".spinner-border").remove();
			}
			else if (result.response == "inserted") {
				
				let message = '<p>Sent Successfully. Thanks for showing interest in Us.</p>';
				$(".errormsg").removeClass("text-danger").addClass("text-success");
				buildModal({type:"alert",content:message});
				$(".btncontactusSubmit").find(".spinner-border").remove();
				formcontainer.find(".form-control").val("");

			}
		},
		error: function (err) {
			console.log("error :" + err);
		}
	});
});

$("#sndmsgForm").submit(function (e) {
	e.preventDefault();
	$(".btnMsgSubmit").find(".spinner-border").remove();
	let el = $(this).find(".error").length;
	if (el > 0) {
		return;
	}
	let toUsername = $(this).find(".username").val().toLowerCase().trim();
	let message = $(this).find(".message").val();
	//alert(toUsername+" "+message);
	$(".btnMsgSubmit").append(btnloader);
	let data = { sendMsg: true, toUsername: toUsername, message: message };
	$.ajax({
		type: "POST",
		url: "controllers/controller.php",
		data: data,
		success: function (result) {
			 result=JSON.parse(result);
			if (result.response == "failed") {
				let message = '<p><small>Message sending failed, Please try again.</small></p>';
				$(".errormsg").removeClass("text-success").addClass("text-danger");
				buildModal({type:"alert",content:message});
				$(".btnMsgSubmit").find(".spinner-border").remove();
			}
			else if (result.response == "inserted") {
				
				let message = '<p>Your message successfully sent to : ' + toUsername + '</p>';
				$(".errormsg").removeClass("text-danger").addClass("text-success");
				buildModal({type:"alert",content:message});
				var messageJSON = {
						MessageType: _constantClient.OneWayFeedback,
						MessageID:result._id.$oid,
						MessageTime: result.CreateDate,
						To : result.To,
						From : result.From,
						Message: result.Message
					};
				websocket.send(JSON.stringify(messageJSON));
				$(".btnMsgSubmit").find(".spinner-border").remove();
				$("#sndmsgForm").find(".message").val("");
			}
		},
		error: function (err) {
			console.log("error :" + err);
		}
	});
});


$(document).on("click", ".btnplinkhome", function () {
	window.location.href = logouthref;
});

