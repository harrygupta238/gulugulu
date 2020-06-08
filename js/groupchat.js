/*-------------------------------------------GroupChat js------------------------------------------------------ */


$(document).on("click", ".btnNewGroup", function () {
	let form=$(document).find("#IndexDynamicContent");
	form.find("h6").html("New Group");
	form.find("[name='mode']").val("create");
	form.find(".groupname").val("");
	form.find("[name='groupid']").val("");
	form.find(".btncreateGroupSubmit").html("submit");
	form.find(".usrnmmsg").html("");
	form.find(".errormsg").html("");
	form.show();
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
	let mode = $("#createGroupForm").find("[name='mode']").val();
	let groupid = $("#createGroupForm").find("[name='groupid']").val();
	
		$(".btncreateGroupSubmit").append(btnloader);
		let data = { creategroup: true, groupname: groupname , mode : mode,groupid:groupid};
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
					displayGroupMessage(groupid);
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
					// grouplistdata+='<li dataid='+dataid+' class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">\
					// 			    '+data.GroupName+'<span class="badge badge-warning badge-pill mr-0">12</span>\
					// 			</li>';
					grouplistdata+='<li dataid='+dataid+' class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">\
								    '+data.GroupName+'\
								</li>';
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
	//$(".groupmessageBox").append(`<center><span class="spinner-border spinner-border-sm"></span></center>`);
	let datetime=new Date();
	let Messagebx='\
				<div class="containerr-r" data-id="">\
	      			<span style="margin-right: 1em;float: right;">\
      						<span class="" style="font-size: .7em;">'+_constantClient.UserName+'</span>, <i class="fas fa-clock" style="font-size: .7em"> '+ calDatetimeDiff(datetime)+' </i> <span class="fa fa-chevron-down restrictVisitor dropdown" data-toggle="dropdown" style="font-size: .7em;"></span>\
								<div class="dropdown-menu" style="padding:0">\
								  <a class="dropdown-item btnGpMsgDelete" href="#">remove</a>\
								</div>\
      				</span><br>\
	      			<div class="containerr sendbground">\
	      				<p class="margin_bottom_0">'+groupMSG+'</p>\
	      			</div>\
      			</div>';
      		$('.groupmessagelist').append(Messagebx);
      		divScrollBottom($('.groupmessagelist'));
		let data = { savegroupmsg: true, groupMSG: groupMSG ,groupid : groupid};
		$.ajax({
			type: "POST",
			url: "controllers/controller.php",
			data: data,
			success: function (result) {
					let result2=JSON.parse(result);
				if (result2.response == "inserted") {
					$("#groupMsgForm").find(".txtgrpmsg").val('');
					displayGroupMessage(groupid);
					var messageJSON = {
						MessageType: _constantClient.GroupChat,
						MessageID:result2._id.$oid,
						MessageTime: result2.CreateDate,
						GroupID : groupid,
						SenderUserName:_constantClient.UserName,
						Message: groupMSG
					};
					websocket.send(JSON.stringify(messageJSON));
				}
			}
		});
});

$(document).on('click',".grouplist li", function(){

	$('.grouplist li').removeClass('active');
	$('.groupMenuDrpdown').hide();
	$(this).find('.groupMenuDrpdown').show();
	$(".groupmessageBox").html('<center><img src="images/Spin-1s-200px.gif" width="200" height="200" style="margin-top: 5em;"></center>');
	$("#groupMsgForm").find(".txtgroupid").val($(this).attr('dataid'));
	$(this).addClass('active');
	displayGroupMessage($(this).attr('dataid'));
	$("#groupMsgForm").show();
	if($(window).width()<=576)
	{
		$('.groupmessagecontainer').show();
		$('.grouplist').hide();
	}
})
$(document).on('click',".groupmessageBox .btnfa-chevron-left", function(){
	if($(window).width()<=576)
	{
		$('.groupmessagecontainer').hide();
		$('.grouplist').show();
	}
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
				let groupmsgbox_header='<div class="groupmsgBox-header" groupid="'+groupid+'" style="width: 100%;\
	    				height: 33px;">\
	    					<div class="d-flex justify-content-between">\
							    <div class="p-1 text-light btnfa-chevron-left" style="width:25px"><span class="fa fa-chevron-left restrictVisitor"></span></div>\
							    <div class="p-1 text-light hgroupname">'+result[0].GroupName+'</div>\
							    <div class="p-1 text-light dropleft dropdown">\
									<span class="" data-toggle="dropdown"><i class="fa fa-cog" aria-hidden="true"></i></span>\
										<div class="dropdown-menu" style=font-size:13px;>\
									    	<a class="dropdown-item btnCopyGrouplink" data-toggle="tooltip" data-placement="right" title="copy to clipboard" href="#">Copy Group Link <i class="fa fa-copy" aria-hidden="true"></i></a>\
									    	<a class="dropdown-item btnRenameGroup" href="#">Rename <i class="fa fa-edit" aria-hidden="true"></i></a>\
									    	<a class="dropdown-item btnDeleteGroup" href="#">Delete Group<i class="fa fa-trash" aria-hidden="true"></i></a>\
									    </div>\
									</i>\
								</div>\
							</div>\
						</div>';
				if(result[0].Messages!=undefined)
				{
					let Messages=result[0].Messages;
					if(result && result.length>0)
					{ 
						
						let MessageList='';
						for(let i=0;i<Messages.length;i++)
						{	 
							if(Messages[i].From==_constantClient.UserName)
							 MessageList+='\
							<div class="containerr-r" data-id="'+Messages[i]._id.$oid+'">\
				      			<span style="margin-right: 1em;float: right;">\
			      						<span class="" style="font-size: .7em;">'+Messages[i].From+'</span>, <i class="fas fa-clock" style="font-size: .7em"> '+ calDatetimeDiff(Messages[i].CreateDate)+' </i> <span class="fa fa-chevron-down restrictVisitor dropdown" data-toggle="dropdown" style="font-size: .7em;"></span>\
											<div class="dropdown-menu" style="padding:0">\
											  <a class="dropdown-item btnGpMsgDelete" href="#">remove</a>\
											</div>\
			      				</span><br>\
				      			<div class="containerr sendbground">\
				      				<p class="margin_bottom_0">'+Messages[i].Message+'</p>\
				      			</div>\
			      			</div>';
						     else
							 MessageList+='\
							<div class="containerr-l" data-id="'+Messages[i]._id.$oid+'">\
		      					<span style="margin-left: 1em;">\
		      						<span class="" style="font-size: .7em;">'+Messages[i].From+'</span>, <i class="fas fa-clock" style="font-size: .7em"> '+ calDatetimeDiff(Messages[i].CreateDate)+' </i> <span class="fa fa-chevron-down restrictVisitor dropdown" data-toggle="dropdown" style="font-size: .7em;"></span>\
									<div class="dropdown-menu" style="padding:0">\
									  <a class="dropdown-item btnGpMsgDelete" href="#">remove</a>\
									</div>\
		      					</span>\
		      					<div class="containerr recbground">\
		      						<p class="margin_bottom_0">'+Messages[i].Message+'</p>\
		      					</div>\
		      				</div>';
						}
						let groupmessagelist='<div class="anyClass groupmessagelist" id="groupmessagelist" style="background-color:#ffff;">\
				      		'+MessageList+'\
				      	</div>';
						$('.groupmessageBox').html(groupmsgbox_header+groupmessagelist);
						divScrollBottom($('.groupmessagelist'));
						restrictVisitor();
					}
				}
				else
				{
					let groupmessagelist='<div class="anyClass groupmessagelist" id="groupmessagelist" style="background-color:#ffff;">\
				      		<center><p style="margin-top: 10em;">this chat is empty.</p></center>\
				      	</div>';
					$('.groupmessageBox').html(groupmsgbox_header+groupmessagelist);

				}
			}
		}
	});
}

$(document).on('click',".btnGroupRefreshMsg", function(){
	let groupid=$(this).closest(".row").find(".txtgroupid").val();
	if(groupid)
		displayGroupMessage(groupid);
});

$(document).on('click',".btnCopyGrouplink", function(e){
	e.stopImmediatePropagation();
	let groupid=$(this).closest("[groupid]").attr("groupid");
	var copyText = groupsharelink+groupid;
	let temp = $("<input>");
	$("body").append(temp);
	temp.val(copyText).select();
	document.execCommand("copy");
	temp.remove();
	$(this).attr("title", 'Copied: ' + copyText);
	buildModal({type:"alert",content:"Group Link has been copied. Invite your friends to join this Groupchat."});
});

$(document).on('click',".btnDeleteGroup", function(e){
	e.stopImmediatePropagation();
	let groupid=$(this).closest("[groupid]").attr("groupid");
	if(groupid)
		deleteGroupById(groupid);
});

function deleteGroupById(groupid ) {
	let data = { deleteGroupById: true , groupid:groupid};
	$.ajax({
		type: "POST",
		url: "controllers/controller.php",
		data: data,
		success: function (response) {
			if (response=="deleted") {
				getGroupList();
				$(".groupmessageBox").html(`<center><p style="padding-top: 11em;">Group's Messages will be displayed here.</p></center>`);
			}
			else if(response=="delete_failed")
			{
				alert("something went wrong.");
			}
		},
		error: function (error) {
			console.log(error);
		}
	});
}
function divScrollBottom(div){
     div.scrollTop(div[0].scrollHeight);
}

if($('.groupmessagelist').length>0)
 divScrollBottom($('.groupmessagelist'));

	$(document).on('click',".btnGpMsgDelete", function(){
		let groupid=$(this).closest(".groupmessageBox").find(".groupmsgBox-header").attr("groupid");
		let msgid=$(this).closest("[data-id]").attr("data-id");
		let data = { deleteGroupMsgById: true , groupid:groupid,msgid:msgid};
		$.ajax({
			type: "POST",
			url: "controllers/controller.php",
			data: data,
			success: function (response) {
				if (response=="deleted") {
					displayGroupMessage(groupid);
				}
				else if(response=="delete_failed")
				{
					alert("something went wrong.");
				}
			},
			error: function (error) {
				console.log(error);
			}
		});
	});

$(document).on('click',".btnRenameGroup", function(){

	//alert("hello");
    let groupid=$(this).closest(".groupmessageBox").find(".groupmsgBox-header").attr("groupid");
	let groupname=$(this).closest(".groupmessageBox").find(".hgroupname").text();
	let form=$(document).find("#IndexDynamicContent");
	form.show();
	form.find("h6").html("Update Group Name");
	form.find("[name='mode']").val("edit");
	form.find("[name='groupid']").val(groupid);
	form.find(".groupname").val(groupname);
	form.find(".btncreateGroupSubmit").html("update");
	form.find(".usrnmmsg").html("");
	form.find(".errormsg").html("");
	
});
 
$(document).on('click',".kkk", function(){
	// type=["form, notification", alert]
	let modal=buildModal({type:"notification", content:"Your Profile Link has been copied."});
	
 }); 

