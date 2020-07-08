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
				let res
				if(typeof(JSON.parse(response)=="object"))
				{
					res=JSON.parse(response);
				}
				if (response == "groupname_exists") {
					let message = '<span class="text-danger error"><small>Group already exists.</small></span>';
					$(".errormsg").removeClass("text-success").addClass("text-danger");
					$("#createGroupForm").find(".errormsg").html(message);
					$(".btncreateGroupSubmit").find(".spinner-border").remove();
				}
				else if (res.message == "inserted") {
					$(".btncreateGroupSubmit").find(".spinner-border").remove();
					let message = '<small>Group created successfully.</small>';
					$("#createGroupForm").find(".errormsg").removeClass("text-danger").addClass("text-success");
					$("#createGroupForm").find(".errormsg").html(message);
					$("#createGroupForm").find(".groupname").val("");
					if(data.mode=="create")
					{
						let group='<li dataid="'+res.groupid.$oid+'" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">\
								    '+data.groupname+'\
								</li>';
					$('.grouplist').prepend(group);
					}
					else if(data.mode=="edit")
					{
						getGroupList();
						displayGroupMessage(groupid);
					}
					
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
	
		let data = { savegroupmsg: true, groupMSG: groupMSG ,groupid : groupid};
		$.ajax({
			type: "POST",
			url: "controllers/controller.php",
			data: data,
			success: function (result) {
					let result2=JSON.parse(result);
				if (result2.response == "inserted") {
					$("#groupMsgForm").find(".txtgrpmsg").val('');
					let Messagebx='\
					<div class="containerr-r" data-id="'+result2._id.$oid+'">\
		      			<span style="margin-right: 1em;float: right;">\
	      						<span class="" style="font-size: .7em;">'+_constantClient.UserName+'</span>, <i class="fas fa-clock" style="font-size: .7em"> '+ calDatetimeDiff(datetime)+' </i> <span class="fa fa-chevron-down restrictElement dropdown" data-toggle="dropdown" style="font-size: .7em;"></span>\
									<div class="dropdown-menu" style="padding:0">\
									  <a class="dropdown-item btnGpMsgDelete" href="#">remove</a>\
									</div>\
	      				</span><br>\
		      			<div class="containerr sendbground">\
		      				<p class="margin_bottom_0">'+groupMSG+'</p>\
		      			</div>\
	      			</div>';
      		         $('.groupmessagelist').append(Messagebx);
      		          restrictedElement();
      		         divScrollBottom($('.groupmessagelist'));
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
	$(".groupmessageBox").html('<center><img src="images/Spin-1s-200px.gif" width="150" height="150" style="margin-top: 7.5em;"></center>');
	$("#groupMsgForm").find(".txtgroupid").val($(this).attr('dataid'));
	$(this).addClass('active');
	let groupid=$(this).attr('dataid');
	let gpname=$(this).text();
	displayGroupMessage2(groupid,function(response){
		if (response) {
				let result=response;
				result=JSON.parse(result);
				let groupmsgbox_header=buildGroupmsgbox_header({groupid:groupid,gpname:gpname,msgskipcount:"0"});
				if(result.length>0)
				{
						let MessageList=buildMessageContainersList(result);
						let groupmessagelist='<div class="anyClass2 groupmessagelist" id="groupmessagelist" style="background-color:#ffff;">\
				      		'+MessageList+'\
				      	</div>';
						$('.groupmessageBox').html(groupmsgbox_header+groupmessagelist);
						divScrollBottom($('.groupmessagelist'));
						
						$(document).find('.groupmessagelist').on("scroll",function(){
							if($(this).scrollTop()==0)
							{
								let groupid=$(document).find(".groupmsgBox-header").attr("groupid");
								$(".groupmessagelist").prepend('<center><img class="loader" src="images/Spin-1s-200px.gif" width="20" height="20" style="margin-top: 1em;"></center>');
								displayGroupMessage2(groupid, function(response){
									if(response){
										let result=JSON.parse(response);
				                        let MessageList=buildMessageContainersList(result);
				                        $(".groupmessagelist").find(".loader").closest("center").remove();
				                        let prevmsgid=$(".groupmessagelist").find("[data-id]:first").attr("data-id");
				                        $(".groupmessagelist").prepend(MessageList);
				                        let cont=$(".groupmessagelist");
				                        let el=$(".groupmessagelist").find('[data-id="'+prevmsgid+'"]');
				                        incGpMsgSkipCount(groupid);
				                        if(MessageList!="")
				                        cont.animate({scrollTop: cont.scrollTop() + (el.offset().top - cont.offset().top)});
				                        restrictedElement();
									}
								});
							}
						});
						restrictedElement();
				}
				else
				{
					let groupmessagelist='<div class="anyClass2 groupmessagelist" id="groupmessagelist" style="background-color:#ffff;">\
				      		<center><p style="margin-top: 10em;">this chat is empty.</p></center>\
				      	</div>';
					$('.groupmessageBox').html(groupmsgbox_header+groupmessagelist);

				}
			}
	});
	$("#groupMsgForm").show();
	if($(window).width()<=576)
	{
		$('.groupmessagecontainer').show();
		$('.grouplist').hide();
	}
})

$(document).find('.groupmessagelist').on("scroll",function(){
	if($(this).scrollTop()==0)
	{
		let groupid=$(document).find(".groupmsgBox-header").attr("groupid");
		$(".groupmessagelist").prepend('<center><img class="loader" src="images/Spin-1s-200px.gif" width="20" height="20" style="margin-top: 1em;"></center>');
		displayGroupMessage2(groupid, function(response){
			if(response){
				let result=JSON.parse(response);
                let MessageList=buildMessageContainersList(result);
                $(".groupmessagelist").find(".loader").closest("center").remove();
                let prevmsgid=$(".groupmessagelist").find("[data-id]:first").attr("data-id");
	            $(".groupmessagelist").prepend(MessageList);
	            let cont=$(".groupmessagelist");
	            let el=$(".groupmessagelist").find('[data-id="'+prevmsgid+'"]');
                incGpMsgSkipCount(groupid);
				if(MessageList!="")
				   cont.animate({scrollTop: cont.scrollTop() + (el.offset().top - cont.offset().top)});
                restrictedElement();
			}
		});
	}
});
$(document).on('click',".groupmessageBox .btnfa-chevron-left", function(){
	if($(window).width()<=576)
	{
		$('.groupmessagecontainer').hide();
		$('.grouplist').show();
	}
})

function displayGroupMessage2(groupid, callback){
	let msgskipcount=$('.groupmsgBox-header[groupid="'+groupid+'"]').attr("data-msgskipcount");
	if(msgskipcount)
	 msgskipcount= parseInt(msgskipcount);
	if(msgskipcount==undefined)
		msgskipcount=0;
	else
		msgskipcount+=1;
	let data = { getGroupMessageList2: true ,groupid:groupid, msgskipcount:msgskipcount};
	$.ajax({
		type: "POST",
		url: "controllers/controller.php",
		data: data,
		success: function (response) {
			callback(response);
		}
	});
}

function incGpMsgSkipCount(groupid){
	let msgskipcount= $('.groupmsgBox-header[groupid="'+groupid+'"]').attr("data-msgskipcount");
	if(msgskipcount)
	 msgskipcount= parseInt(msgskipcount);
	if(msgskipcount==undefined)
		msgskipcount=0;
	else
		msgskipcount+=1;
	$('.groupmsgBox-header[groupid="'+groupid+'"]').attr("data-msgskipcount",msgskipcount);
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
	$(this).find(".myPlPopup").toggleClass("show");
    setTimeout(function(){
    	$(".myPlPopup").toggleClass("show");
    }, 1000);
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


// $(document).find('.anyClass').scroll(function(){
// 	alert("hello32");
// });


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
	form.find(".groupname").val(groupname.trim());
	form.find(".btncreateGroupSubmit").html("update");
	form.find(".usrnmmsg").html("");
	form.find(".errormsg").html("");
	
});
 
$(document).on('click',".kkk", function(){
	// type=["form, notification", alert]
	let modal=buildModal({type:"notification", content:"Your Profile Link has been copied."});
	
 }); 

function buildMessageContainersList(result){
	let MessageList='';
	for(let i=0;i<result.length;i++)
	{	 
		let Messages=JSON.parse(result[i]).Messages;
		if(Messages.From==_constantClient.UserName)
		 MessageList+='\
		<div class="containerr-r" data-id="'+Messages._id.$oid+'">\
  			<span style="margin-right: 1em;float: right;">\
						<span class="" style="font-size: .7em;"> you </span>, <i class="fas fa-clock" style="font-size: .7em"> '+ calDatetimeDiff(Messages.CreateDate)+' </i> <span class="fa fa-chevron-down restrictElement dropdown" data-toggle="dropdown" style="font-size: .7em;"></span>\
						<div class="dropdown-menu" style="padding:0">\
						  <a class="dropdown-item btnGpMsgDelete" href="#">remove</a>\
						</div>\
				</span><br>\
  			<div class="containerr sendbground">\
  				<p class="margin_bottom_0">'+Messages.Message+'</p>\
  			</div>\
			</div>';
	     else
		 MessageList+='\
		<div class="containerr-l" data-id="'+Messages._id.$oid+'">\
				<span style="margin-left: 1em;">\
					<span class="" style="font-size: .7em;">'+Messages.From+'</span>, <i class="fas fa-clock" style="font-size: .7em"> '+ calDatetimeDiff(Messages.CreateDate)+' </i> <span class="fa fa-chevron-down restrictElement dropdown" data-toggle="dropdown" style="font-size: .7em;"></span>\
				<div class="dropdown-menu" style="padding:0">\
				  <a class="dropdown-item btnGpMsgDelete" href="#">remove</a>\
				</div>\
				</span>\
				<div class="containerr recbground">\
					<p class="margin_bottom_0">'+Messages.Message+'</p>\
				</div>\
			</div>';
	}
	return MessageList;
}

function buildGroupmsgbox_header(param){
	let groupmsgbox_header='<div class="groupmsgBox-header" groupid="'+param.groupid+'" data-msgskipcount="'+param.msgskipcount+'" style="width: 100%;\
	    				height: 33px;">\
	    					<div class="d-flex justify-content-between">\
							    <div class="p-1 text-light btnfa-chevron-left" style="width:25px"><span class="fa fa-chevron-left restrictElement"></span></div>\
							    <div class="p-1 text-light hgroupname">'+param.gpname+'</div>\
							    <div class="p-1 text-light dropleft dropdown">\
									<span class="" data-toggle="dropdown"><i class="pr-2 fa fa-cog" aria-hidden="true"></i></span>\
										<div class="dropdown-menu" style=font-size:13px;>\
									    	<span class="dropdown-item btnCopyGrouplink popup" data-toggle="tooltip" data-placement="right" title="copy to clipboard" href="#">Copy Group Link <i class="fa fa-copy" aria-hidden="true"></i><span class="popuptext myPlPopup" id="">Copied</span></span>\
									    	<span class="dropdown-item btnRenameGroup restrictElement" href="#">Rename <i class="fa fa-edit" aria-hidden="true"></i></span>\
									    	<span class="dropdown-item btnDeleteGroup restrictElement" href="#">Delete Group<i class="fa fa-trash" aria-hidden="true"></i></span>\
									    </div>\
									</i>\
								</div>\
							</div>\
						</div>';
	return groupmsgbox_header;
}

