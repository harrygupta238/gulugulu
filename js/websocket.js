

		var websocket = new WebSocket("ws://localhost:8090/gulugulu/controllers/php-socket.php"); 
		websocket.onopen = function(event) { 
			//showMessage("<div class='chat-connection-ack'>Connection is established!</div>");
			console.log("Connection is established between socket and server!");	
		}
		websocket.onmessage = function(event) {
			var Data = JSON.parse(event.data);
			console.log(Data);
			switch (Data.MessageType) {
		        case "OneWayFeedback":
		            //val = { $numberLong: val }
		            break;
		        case "GroupChat":
		        		debugger;
		        	let isGroupChatBoxOpen = $(".groupmessageBox").find("[groupid='"+ Data.GroupID +"']").length;
		        		if(isGroupChatBoxOpen>0 && Data.SenderUserName!=_constantClient.UserName)
		        		{
		        			MessageHtml='<div class="containerr" data-id="'+Data.MessageID+'">\
		            				<img src="images/pp.jpg" alt="Avatar" style="width:100%;">\
		            					<p>'+Data.Message+'</p>\
		            					<span class="time-right">'+Data.MessageTime+'</span>\
		            					<span class="fas fa-trash btnGpMsgDelete restrictVisitor"></span>\
		            			</div>';
		            		$('.groupmessagelist').append(MessageHtml);
		            		restrictVisitor();
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
			console.log("<div class='error'>Problem due to some Error</div>");

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
