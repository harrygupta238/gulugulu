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
			}
			else if(userdata.type=='visitor')
			{
				_constantClient.UserName=userdata.username;
			}
			
			
		}
	});
}
getLoggedinUserData();