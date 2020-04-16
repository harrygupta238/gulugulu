/*-------------------------------------------GroupChat js------------------------------------------------------ */
$(document).on("click", ".btnNewGroup", function () {
	$("#createGroupForm").find(".groupname").val("");
	$(".usrnmmsg").html("");
	$(".errormsg").html("");
	$("#IndexDynamicContent").show();
});
$(document).on("click", ".btnCancelNewGroup", function () {
	$("#createGroupForm").find(".groupname").val("");
	$(".usrnmmsg").html("");
	$(".errormsg").html("");
	$("#IndexDynamicContent").hide();
});


$("#createGroupForm").submit(function (e) {
	e.preventDefault();
	let el = $("#createGroupForm").find(".error").length;
	if (el > 0) {
		return;
	}
	let groupname = $("#createGroupForm").find(".groupname").val().toLowerCase().trim();
		$(".btncreateGroupSubmit").append(btnloader);
		let data = { creategroup: true, groupname: groupname };
		$.ajax({
			type: "POST",
			url: "controllers/controller.php",
			data: data,
			success: function (response) {
				if (response == "groupname_exists") {
					let message = '<span class="text-danger error"><small>Group already exists.</small></span>';
					$(".errormsg").removeClass("text-success").addClass("text-danger");
					$("#createGroupForm").find(".errormsg").html(message);
					$(".btncreateGroupSubmit").find(".spinner-border").remove();
				}
				else if (response == "inserted") {
					$(".btncreateGroupSubmit").find(".spinner-border").remove();
					let message = '<small>Group created successfully.</small>';
					$("#createGroupForm").find(".errormsg").removeClass("text-danger").addClass("text-success");
					$("#createGroupForm").find(".errormsg").html(message);
					$("#createGroupForm").find(".groupname").val("");
					getGroupList();
					$("#IndexDynamicContent").hide();
				}
				else if (response == "insert_failed") {
					let message = '<small>Group creation failed.</small>';
					$(".errormsg").removeClass("text-success").addClass("text-danger");
					$("#createGroupForm").find(".errormsg").html(message);
					$(".btncreateGroupSubmit").find(".spinner-border").remove();
					//$(".errormsg").addClass('error');
				}
			}
		});
});

function getGroupList(){
	let data = { getGroupList: true };
	$('.grouplist li:first').before('<center><div class="spinner-border text-danger mt-3"></div></center>');
	$.ajax({
		type: "POST",
		url: "controllers/controller.php",
		data: data,
		success: function (response) {
			if (response!="null") {

				response=JSON.parse(response);

				let grouplistdata='';
				for(let i=0;i<response.length;i++)
				{
					let data=response[i];
					//console.log(data);
					let dataid=JSON.stringify(data._id.$oid);
					//console.log(dataid);
					grouplistdata+='<li dataid='+dataid+' class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">'+data.GroupName+'<span class="badge badge-warning badge-pill mr-0">12</span><div class="dropdown dropright"><span  class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span><div class="dropdown-menu"><a class="dropdown-item" href="#">share <i class="fa fa-share" aria-hidden="true"></i></a><a class="dropdown-item" href="#">rename <i class="fa fa-edit" aria-hidden="true"></i></a><a class="dropdown-item" href="#"><i class="fa fa-trash" aria-hidden="true"></i></a></div></div> </li>';
					$('.grouplist').html(grouplistdata);
				}
			}
		}
	});
}
if($('.grouplist').length>0)
getGroupList();

$("#groupMsgForm").submit(function (e) {
	e.preventDefault();
	let el = $("#groupMsgForm").find(".error").length;
	if (el > 0) {
		return;
	}
	let groupMSG = $("#groupMsgForm").find(".txtgrpmsg").val();
	let groupid = $("#groupMsgForm").find(".txtgroupid").val();
	
		let data = { savegroupmsg: true, groupMSG: groupMSG ,groupid : groupid};
		$.ajax({
			type: "POST",
			url: "controllers/controller.php",
			data: data,
			success: function (response) {
				if (response == "inserted") {
					displayGroupMessage(groupid);
					$("#groupMsgForm").find(".txtgrpmsg").val('');
				}
			}
		});
});

$(document).on('click',".grouplist li", function(){
	$('.grouplist li').removeClass('active');
	$("#groupMsgForm").find(".txtgroupid").val($(this).attr('dataid'));
	$(this).addClass('active');
	displayGroupMessage($(this).attr('dataid'));
})

function displayGroupMessage(groupid){
	let data = { getGroupMessageList: true ,groupid:groupid};
	$.ajax({
		type: "POST",
		url: "controllers/controller.php",
		data: data,
		success: function (response) {
			if (response) {
				let result=response;
				result=JSON.parse(result);
				if(result[0].Messages!=undefined)
				{
					let Messages=result[0].Messages;
					if(result && result.length>0)
					{
						let MessageList='';
						for(let i=0;i<Messages.length;i++)
						{	 if(Messages[i].From==_constantClient.UserName)
							 MessageList+='<div class="containerr darker"><img src="images/pp.jpg" alt="Avatar" style="width:100%;"><p>'+Messages[i].Message+'</p><span class="time-right">'+Messages[i].CreateDate+'</span></div>';
						     else
							 MessageList+='<div class="containerr"><img src="images/pp.jpg" alt="Avatar" style="width:100%;"><p>'+Messages[i].Message+'</p><span class="time-right">'+Messages[i].CreateDate+'</span></div>';
						}
						$('.groupmessagelist').html(MessageList);
					}
				}
				else
				{
					$('.groupmessagelist').html('<center><p style="margin-top: 10em;">this chat is empty.</p></center>');
				}
						
				// <div class="containerr darker">
						//   <img src="images/pp.jpg" alt="Avatar" class="right" style="width:100%;">
						//   <p>Hey! I'm fine. Thanks for asking!</p>
						//   <span class="time-left">11:01</span>
						// </div>`;
			}
		}
	});
}

