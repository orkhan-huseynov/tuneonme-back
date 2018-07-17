$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    $("#search_user_button").on("click", function () {
        search_user_action();
    });
    $("#search_user_form").on("submit", function () {
        search_user_action();
    });

    function search_user_action() {
        $(".search_user_result").html("<i class='fa fa-circle-o-notch fa-spin'>");
        $(".search_user_result").slideDown('fast');

        var pid = $("#search_user_pid").val();
        if (pid != undefined && pid != "") {
            $.get("/home/get_by_id/" + pid, function (data) {
                if (data.ResponseCode != 1) {
                    $(".search_user_result").html("Not found");
                } else {
                    var responseContent = data.ResponseContent;
                    var user_name_lastname = responseContent.name + "&nbsp;" + responseContent.lastname;
                    var user_id = responseContent.id;

                    $(".search_user_result").html('<a id="bind_to_user_link" href="javascript:void(0);" data-user_name="' + user_name_lastname + '" data-user_id="' + user_id + '">' + user_name_lastname + '</a>');
                }
            });
        } else {
            $(".search_user_result").html("Enter personal ID");
        }
    }

    $(document).on("click", "#bind_to_user_link", function () {
        var user_name_lastname = $(this).data("user_name");
        $("#bindToUserLabel").text($("#bindToUserLabel").text().replace("%user_name%", user_name_lastname));
        $("#bind_to_user_modal").modal('show');
    });

    $("#bind_to_user_modal__confirm").on("click", function () {
        $(this).addClass("disabled");
        $(this).text('Sending...');

        var connect_user_id = $("#bind_to_user_link").data("user_id");
        var connect_user_name_lastname = $("#bind_to_user_link").data("user_name");

        $("#bindToUserResultLabel").text($("#bindToUserResultLabel").text().replace("%user_name%", connect_user_name_lastname));

        if (connect_user_id > 0) {
            $.get("/home/send_request/" + connect_user_id, function (data) {
                if (data.ResponseCode != 1) {
                    var response_message = "Error sending request. " + data.ResponseContent;
                } else {
                    var response_message = "Connection request successfuly sent. Please wait for " + connect_user_name_lastname + " to respond.";
                }

                $("#bindToUserResultModalBody").text($("#bindToUserResultModalBody").text().replace("%modal_body%", response_message));
                $("#bind_to_user_modal").modal('hide');
                $("#bind_to_user_result_modal").modal('show');
            });
        } else {
            alert("Error sending request. User to connect is not defined.");
        }
    });

    $("#delete_user_modal_link").on("click", function () {
        var user_name_lastname = $(this).data("user_name");
        $("#deleteUserModalLabel").text($("#deleteUserModalLabel").text().replace("%user_name%", user_name_lastname));
        $("#deleteUserModalBody").text($("#deleteUserModalBody").text().replace("%user_name%", user_name_lastname));
        $("#delete_user_modal").modal('show');
    });

    $("#delete_user_modal__exterminate").on("click", function () {
        $(this).addClass("disabled");
        $(this).text('Exterminating...');

        var user_name_lastname = $("#delete_user_modal_link").data("user_name");

        var user_to_delete_id = $(this).data("user_to_delete");
        if (user_to_delete_id > 0) {
            $.get("/home/exterminate_user/" + user_to_delete_id, function (data) {
                if (data.ResponseCode != 1) {
                    var response_message = "Error exterminating user. " + data.ResponseContent;
                } else {
                    var response_message = user_name_lastname + " successfuly exterminated. You can now connect to another user and start all over.";
                }

                $("#deleteUserResultModalLabel").text($("#deleteUserResultModalLabel").text().replace("%user_name%", user_name_lastname));
                $("#deleteUserResultModalBody").text($("#deleteUserResultModalBody").text().replace("%modal_body%", response_message));
                $("#delete_user_modal").modal('hide');
                $("#delete_user_result_modal").modal('show');
            });
        } else {
            alert("Error exterminating user. User id is not defined.");
        }
    });

    $("#accept_request_link").on('click', function () {
        var from_user_id = $(this).data("from_user_id");
        var from_user_name = $(this).data("user_name");

        if (from_user_id > 0) {
            $.get("/home/accept_request/" + from_user_id, function (data) {
                if (data.ResponseCode != 1) {
                    var response_message = "Error accepting request. " + data.ResponseContent;
                } else {
                    var response_message = "Connection request from " + from_user_name + " successfuly accepted. You can now start your competition!";
                }

                $("#acceptRequestResultModalLabel").text($("#acceptRequestResultModalLabel").text().replace("%user_name%", from_user_name));
                $("#acceptRequestResultModalBody").text($("#acceptRequestResultModalBody").text().replace("%modal_body%", response_message));
                $("#accept_request_result_modal").modal('show');
            });
        }
    });

    //Modal hidden handlers	
    $('#bind_to_user_result_modal').on('hidden.bs.modal', function (e) {
        var base_url = $("#body").data("base_url");
        if (base_url != undefined) {
            window.location = base_url;
        }
    });

    $('#delete_user_result_modal').on('hidden.bs.modal', function (e) {
        var base_url = $("#body").data("base_url");
        if (base_url != undefined) {
            window.location = base_url;
        }
    });

    $('#accept_request_result_modal').on('hidden.bs.modal', function (e) {
        var base_url = $("#body").data("base_url");
        if (base_url != undefined) {
            window.location = base_url;
        }
    });
    
    //Notifications
    $("#notification_bell_toggle").on('click', function(e) {
		if($(".connection_requests_container").is(':visible')){
			$(".connection_requests_container").fadeOut('fast');
		}
		
        load_notifications();
        $(".notifications_container").fadeToggle('fast');
        e.stopPropagation();
    });
    
    
    $("#body").click(function(){
        $(".notifications_container").fadeOut('fast');
		$(".connection_requests_container").fadeOut('fast');
    });
    
    function load_notifications(){
        var base_url = $("#body").data("base_url");
        
        if($(".notifications_container").is(':visible') == false){
            $(".notifications_container .panel_body").html('<div class="center_contents"><i class="fa fa-circle-o-notch fa-spin"></div>');
            
            $.get("/get_notifications", function(data){
				if(data.length == 0){
					$(".notifications_container .panel_body").html('<div class="center_contents">No notifications</div>');
				}else{
					$(".notifications_container .panel_body").html('');
					jQuery.each(data, function(i, val){
						var notification_id = val.id;
						var notification_text = val.notification_text;
						var viewed = val.viewed;
						var notification_date = prettyDate(val.created_at);
						
						var notification_item = '<a href="' + base_url + '/notification/' + notification_id + '"><div class="notification_item ' + (viewed ? '' : 'unread') + '"><div class="notification_item__text">' + notification_text + '</div><div class="notification_item__date">' + notification_date + '</div></div></a>';
						
						$(".notifications_container .panel_body").append(notification_item);
					});
					
					//mark as viewed
					$.get("/mark_notifications_viewed", function(data){
						$("#notifications-bell").data("count", 0).removeClass("icon_badge");
					});
				}
            });
        }
    }
		   
    //Connection requests
	$("#connection_requests_toggle").on('click', function(e) {
		if($(".notifications_container").is(':visible')){
			$(".notifications_container").fadeOut('fast');
		}
		
		load_connection_requests();		
		$(".connection_requests_container").fadeToggle('fast');
		e.stopPropagation();
	});
	
	function load_connection_requests(){
		var base_url = $("#body").data("base_url");
		
		if($(".connection_requests_container").is(':visible') == false){
			$(".connection_requests_container .panel_body").html('<div class="center_contents"><i class="fa fa-circle-o-notch fa-spin"></div>');
            
            $.get("/connection_request/get_requests", function(data){
				if(data.length == 0){
					$(".connection_requests_container .panel_body").html('<div class="center_contents">No requests</div>');
				}else{
					$(".connection_requests_container .panel_body").html('');
					jQuery.each(data, function(i, val){
						var connection_request_id = val.id;
						var connection_request_text = val.name_lastname;
						var connection_request_date = val.created_at;
						
						var connection_request_item = '<a href="' + base_url + '/connection_request/' + connection_request_id + '"><div class="connection_request_item"><div class="connection_request__text"><strong>' + connection_request_text + '</strong></div><div class="connection_request__actions"><a class="btn btn-success" href="' + base_url + '/connection_request/accept/' + connection_request_id + '">Accept</a><a class="btn btn-danger" href="' + base_url + '/connection_request/delete/' + connection_request_id + '">Delete</a></div><div class="connection_request__date">' + connection_request_date + '</div></div></a>';
						
						$(".connection_requests_container .panel_body").append(connection_request_item);
					});
				}
            });
		}
	}
    
    function prettyDate(time) {
        var date = new Date((time || "").replace(/-/g, "/").replace(/[TZ]/g, " ")),
            diff = (((new Date()).getTime() - date.getTime()) / 1000),
            day_diff = Math.floor(diff / 86400);

        if (isNaN(day_diff) || day_diff < 0 || day_diff >= 31) return;

        return day_diff == 0 && (
        diff < 60 && "just now" || diff < 120 && "1 minute ago" || diff < 3600 && Math.floor(diff / 60) + " minutes ago" || diff < 7200 && "1 hour ago" || diff < 86400 && Math.floor(diff / 3600) + " hours ago") || day_diff == 1 && "Yesterday" || day_diff < 7 && day_diff + " days ago" || day_diff < 31 && Math.ceil(day_diff / 7) + " weeks ago";
    }
	
	$("#btn_accept_level_item").on('click', function(){
		$("#level_item_radio_accepted").prop('checked', true);
		$("#level_item_accept_decline_form").submit();		
	});
	
	$("#btn_decline_level_item").on('click', function(){
		$("#level_item_radio_declined").prop('checked', true);
		$("#level_item_accept_decline_form").submit();
	});
        
    $('#userpic-file-input').on('change', function(){
        var base_url = $("#body").data("base_url");
        
        if(typeof(FileReader) != "undefined"){
            var image_holder = $(".profile_pic_container");
            image_holder.empty();
            
            var reader = new FileReader();
            reader.onload = function(e){
                $("<div />", {
                    "style": "background-image:url('" + e.target.result + "');width:150px;height:150px;background-size:cover;background-position:50% 50%;",
                    "class": "thumb-image img-circle",
                    "id": "userpic_placeholder_div"
                }).appendTo(image_holder);
                image_holder.addClass("spin_loader");                
            };
            
            //$("#userpic_placeholder_div").html('<img src="' + base_url + '/images/main_loader.gif" />');
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
            
            var form = document.forms.namedItem("profile_pic_form");
            var formdata = new FormData(form);
            
            $.ajax({
                async: true,
                dataType: "json",
                contentType: false,
                url: $('#profile-pic-form').attr('action'), 
                type: 'POST',
                data: formdata,
                processData: false
            }).done(function(data){
                console.log("Success: Files sent!");
                console.log(data);
                $('<i class="fa fa-check userpic_loader_done" aria-hidden="true"></i>').appendTo('#userpic_placeholder_div');
                setTimeout(function(){
                    $("#userpic_placeholder_div i").fadeOut();
                }, 1000);
                image_holder.removeClass("spin_loader");
            }).fail(function(data){
                console.log("An error occurred, the files couldn't be sent!");
                console.log(data.responseText);
                $('<i class="fa fa-times userpic_loader_fail" aria-hidden="true"></i>').appendTo('#userpic_placeholder_div');
                setTimeout(function(){
                    $("#userpic_placeholder_div i").fadeOut();
                }, 1000);
                image_holder.removeClass("spin_loader");
            });
        }
    });
});

$(window).on('load', function() {
    $(".se-pre-con").fadeOut("slow");;
});