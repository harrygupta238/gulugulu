var protocol = 'ws://'; 
if (window.location.protocol === 'https:') {
            protocol = 'wss://';
   }

 //var wsUri =protocol+ "ec2-3-16-124-106.us-east-2.compute.amazonaws.com/controllers/php-socket.php";
var wsUri =protocol+ "localhost:8090/controllers/php-socket.php";

		var websocket = new WebSocket(wsUri); 
	//var websocket = new WebSocket("wss://localhost:8090/controllers/php-socket.php"); 
		websocket.onopen = function(event) { 
			//showMessage("<div class='chat-connection-ack'>Connection is established!</div>");
			console.log("Connection is established between socket and server!");	
		}
		websocket.onmessage = function(event) {
			var Data = JSON.parse(event.data);
			console.log(Data);
			switch (Data.MessageType) {
		        case "OneWayFeedback":
		        	if(_constantClient.UserName==Data.To){
		        		MessageHtml=`<p class="text-dark border-bottom b-3 p-3 m-4 inbox_content" style="background-color:#b8f7f6;">
												<i class="fas fa-clock" style="font-size: .7em"> 1m ago</i><br>
												${Data.Message}<br>  
									    	</p>`;
						$('#inboxMsg').prepend(MessageHtml);
						restrictedElement();
						if($(window).width()<720)
						{
							
	                        $(".ppppp").hide();
						}
		        	}
		            break;
		        case "GroupChat":
		        		debugger;
		        	let isGroupChatBoxOpen = $(".groupmessageBox").find("[groupid='"+ Data.GroupID +"']").length;
		        		if(isGroupChatBoxOpen>0 && Data.SenderUserName!=_constantClient.UserName)
		        		{
		        			MessageHtml='\
		        			<div class="containerr-l" data-id="'+Data.MessageID+'">\
		      					<span style="margin-left: 1em;">\
		      						<span class="" style="font-size: .7em;">'+Data.SenderUserName+'</span>, <i class="fas fa-clock" style="font-size: .7em"> 1m ago </i> <span class="fa fa-chevron-down restrictElement dropdown" data-toggle="dropdown" style="font-size: .7em;"></span>\
									<div class="dropdown-menu" style="padding:0">\
									  <a class="dropdown-item btnGpMsgDelete" href="#">remove</a>\
									</div>\
		      					</span>\
		      					<div class="containerr recbground">\
		      						<p class="margin_bottom_0">'+Data.Message+'</p>\
		      					</div>\
		      				</div>';
		            		$('.groupmessagelist').append(MessageHtml);
		            		
		            		restrictedElement();
		            		divScrollBottom($('.groupmessagelist'));
		        		}
		           		
		            break;
		        case "OneToOneChat":
		            //val = { $oid: val }
		            break;
		        default:
                    //showMessage("<div class='"+Data.message_type+"'>"+Data.message+"</div>");
                    break;
		    }

			
		};
		
		websocket.onerror = function(event){
			console.log(event);
			console.log(event+"<div class='error'>Problem due to some Error</div>");

		};
		websocket.onclose = function(event){
			console.log("<div class='chat-connection-ack'>Connection Closed</div>");
		}; 
		
		$('#frmChat').on("submit",function(event){
			event.preventDefault();
			$('#chat-user').attr("type","hidden");		
			var messageJSON = {
				chat_user: $('#chat-user').val(),
				chat_message: $('#chat-message').val()
			};
			websocket.send(JSON.stringify(messageJSON));
		});
