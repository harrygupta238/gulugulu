 const _constantClient={};
_constantClient.rootdir="/gulugulu";
_constantClient.OneWayFeedback="OneWayFeedback";
_constantClient.GroupChat="GroupChat";
_constantClient.OneToOneChat="OneToOneChat";
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
			let profilelink = window.location.origin + _constantClient.rootdir +"/profilelink.php?u="+_constantClient.UserName;
			$(".profilelink").prepend(profilelink);
			
		}
	});
}
getLoggedinUserData();

function calDatetimeDiff(dt1) 
 {
 let dt3=new Date(dt1);
  let dt2=new Date();
  var diff =(dt2.getTime() - dt3.getTime()) / 1000;//seconds

  //diff /= 60;
  if(diff<60)
  return Math.abs(Math.round(diff))+"s ago";
  else if(diff/60<60) //minutes
  return Math.abs(Math.round(diff/60))+"m ago";
  else if(diff/3600<24) //hours
  return Math.abs(Math.round(diff/3600))+"h ago";
  else if(diff/86400<30) //days
  return Math.abs(Math.round(diff/86400))+"d ago";
  else  //months
  return Math.abs(Math.round(diff/2592000))+"month ago";
  
 }


