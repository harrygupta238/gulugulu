 const _constantClient={};

function getLoggedinUserData(){
	let data = { getLoggedinUserData: true };
	$.ajax({
		type: "POST",
		url: "controllers/controller.php",
		data: data,
		success: function (response) {
			let userdata=JSON.parse(response);
			if(userdata.type=='loggedin')
			{	
			_constantClient.UserID=userdata._id.$oid;
			_constantClient.UserName=userdata.username;
			_constantClient.UserType='loggedin';
			}
			else if(userdata.type=='visitor')
			{
				_constantClient.UserName=userdata.username;
				_constantClient.UserType='visitor';
			}
			
			
		}
	});
}
getLoggedinUserData();
_constantClient.rootdir="/gulugulu";
_constantClient.OneWayFeedback="OneWayFeedback";
_constantClient.GroupChat="GroupChat";
_constantClient.OneToOneChat="OneToOneChat";

