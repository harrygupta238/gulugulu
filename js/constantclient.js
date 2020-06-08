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


 function buildModal(param)
 {	
 	let modal;
 	if(param.type=="alert"){
 		 modal=$(`<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <p>${param.content}</p>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				     
				    </div>
				  </div>
				</div>`);
    }
 	else if(param.type=="form"){

 		 modal=$(`<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h6 class="modal-title" id="exampleModalLongTitle">${param.title}</h6>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        ${param.body}
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <button type="button" class="btn btn-primary">Submit</button>
				      </div>
								     
				    </div>
				  </div>
				</div>`);
 	}
 	$("body").append(modal);
 	addStyleInModal(modal);
 	return modal;
 }

function addStyleInModal(modal)
{
	modal.removeAttr("aria-hidden");
	modal.attr("aria-modal","true");
	modal.css({"padding-right":"15px","display":"block"});
	modal.addClass("show");
	$("body").append('<div class="modal-backdrop fade show"></div>').addClass("modal-open");
	modal.on("click",".close",function(){
		modal.remove();
		$("body").find(".modal-backdrop").remove();
		$("body").removeClass("modal-open").removeAttr("style");	
	});
}


