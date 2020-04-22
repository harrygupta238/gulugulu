var hostorigin = window.location.origin;
var userhomehref = hostorigin + _constantClient.rootdir+"/userhome.php";
var logouthref = hostorigin + _constantClient.rootdir +"/index.php";
var anonymoususerhref = hostorigin + _constantClient.rootdir +"/visitor.php";
var groupchatpagehref = hostorigin +_constantClient.rootdir +"/groupchat.php";
var btnloader = '<span class="spinner-border spinner-border-sm"></span>';
let profilelink = hostorigin + _constantClient.rootdir +"/profilelink.php?u=";
let groupsharelink = hostorigin + _constantClient.rootdir +"/groupvisitor.php?g=";


$("#profilelinkorigin").text(profilelink);
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

// $(document).on("click", ".btnHome", function () {
// 	$(".loginContent").hide();
// 	$(".signupContent").hide();
// 	//$(".defaultContent").show();

// 	//$(".btnHome").addClass("active");
// 	$(".btnSignup").removeClass("active");
// 	$(".btnLogin").removeClass("active");
// 	$(".errormsg").html("");
// });

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

$(document).on("click", ".btnGoAnonymous", function () {
	window.location.href = anonymoususerhref;
});

$(document).on("click", ".btnGroupChatpage", function () {
	window.location.href = groupchatpagehref;
});
$(document).on("click", ".btnHome", function () {
	window.location.href = userhomehref;
});
$("#signupForm").submit(function (e) {
	e.preventDefault();
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

// function redirectToUserHome(page)
// {
// 	let data={redirectToUserHome:true};
// 	$.ajax({
// 	    type: "POST",
// 	    url: "controllers/controller.php",
// 	    data: data,
// 	    success: function(response) {
// 	    	 if(response=="failed")
// 	    	{
// 	    		let message='<small>Username or Password is incorrect.</small>';
// 	    		$(".errormsg").html(message);
// 	    	}
// 	    	else if(response=="success")
// 	    	{
// 	    		window.location.href = window.location.href+"/userhome.php";
// 	    	}
// 	    },
// 	    error: function(err){
// 	    	console.log("error :"+err)
// 	    }
// 	  });
// }

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

// $(document).on("click",".btnSentBox", function(){
// 	$(".btnInBox").removeClass("active");
// 	$(".btnSentBox").addClass("active");

// 	$("#inboxMsg").hide();
// 	$("#sentboxMsg").show();
// });

// $(document).on("click",".btnInBox", function(){
// 	$(".btnInBox").addClass("active");
// 	$(".btnSentBox").removeClass("active");
// 	$("#inboxMsg").show();
// 	$("#sentboxMsg").hide();
// });
$(document).on("click", ".btnInBox, .btnSentBox", function () {
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


$("#sndmsgForm").submit(function (e) {
	e.preventDefault();
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
		success: function (response) {
			if (response == "failed") {
				let message = '<small>Message sending failed, please try again.</small>';
				$(".errormsg").removeClass("text-success").addClass("text-danger");
				$(".errormsg").html(message);
				$(".btnMsgSubmit").find(".spinner-border").remove();
			}
			else if (response == "inserted") {
				let message = 'Your message successfully sent to : ' + toUsername + '';
				$(".errormsg").removeClass("text-danger").addClass("text-success");
				$(".errormsg").html(message);
				$(".btnMsgSubmit").find(".spinner-border").remove();
				$("#sndmsgForm").find(".message").val("");
			}
		},
		error: function (err) {
			console.log("error :" + err);
		}
	});
});

$(document).on("click", ".btnCopy", function () {
	var copyText = $("#profilelink").text();
	let temp = $("<input>");
	$("body").append(temp);
	temp.val(copyText).select();
	document.execCommand("copy");
	temp.remove();
	$(this).attr("title", 'Copied: ' + copyText);
});

$(document).on("click", ".btnplinkhome", function () {
	window.location.href = logouthref;
});
//$(location).attr('href',url);
$(document).on("click", ".btnPopup", function () {
	
		let abc=$("<div id='pop-window'></div>");
		abc.appendTo('body');
		$("#pop-window").html('<div class="popcontent"><div class="d-flex justify-content-center">\
  <div class="spinner-border" role="status">\
    <span class="sr-only">Loading...</span>\
  </div>\
</div></div>');
});





