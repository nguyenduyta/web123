/**
 * @author Namla
 */
$('#supportLink').click(function (e) {
           e.preventDefault();
           if ($(this).hasClass('disabled')){
                $(this).removeClass('disabled');
                return false; // Do something else in here if required
            }
               
            else{
                $(this).addClass('disabled');
                window.location.href = $(this).attr('href');
            }         
        });
$(window).ready(function(){
	$(".download_1").click(function(e){
		 e.preventDefault();
		var r=confirm("Bạn đồng ý với chính sách và điều khoản của chúng tôi. Tải game về ?");
		if(r==false) return false;
		else window.location.href = $(this).attr('href');
	});
});
function comment(product_id,user_id){
	var comment=$("#comment").val();
	var count= Number($("#count_comment").val());
	var arr =  $(".star-rating-on");
	var star= arr.length;
	if(comment==' ' || comment==0) alert("Nội dung nhập vào không chính xác!");
	else{
		$.ajax({
			url: '/default/index/comment',
			data: 'product_id= '+product_id+"&user_id="+user_id+"&comment="+comment+"&star="+star+"&count="+count,
			type: 'POST',
			 processData: false,
			success: function(data){
				if(count==0) $("#count_comment").after(data);
				else $("#comment_more").before(data);
				$("#count_comment").val((1+count));
				$("#comment").val('');
			}
		});
		
	}
}
function CommentFBAdd(product_id,comment,commentID,user_id,fb_name){
	$.ajax({
		url: "/default/index/comment-fb-add",
		data: "product_id="+product_id+"&comment="+comment+"&user_id="+user_id+"&facebook="+commentID+"&fb_name="+fb_name,
		type: "POST",
		success: function(data){
			console.log("add-success");
			console.log(data);
		},
		error: function(){
			console.log("error");
		}
	});
}
function CommentFBRemove(commentID){
	$.ajax({
		url: "/default/index/comment-fb-remove",
		data: "facebook="+commentID,
		type: "POST",
		success: function(data){
			console.log("remove success");
		},
		error: function(){
			console.log("error");
		}
	});
}
function moreProduct(page,category,url,tag){
    $.ajax({
       url: url,
       data: {page:page, category:category, tag:tag},
       type: 'GET' ,
       success: function(data){
            $('#product_more').before(data);
            $('.seemore:first').remove();
            $('#product_more:first').remove();
       }
    });
}

function moreSearch(page,search_key,url){
    $.ajax({
       url: url,
       data: {page:page, search_key:search_key},
       type: 'GET' ,
       success: function(data){
            $('#product_more').before(data);
            $('.seemore:first').remove();
            $('#product_more:first').remove();
       }
    });
}
function moreComment(page,url){
    $.ajax({
        url: url,
        data: "page="+page+"&more=1",
        type:'POST',
        success:function(data){
            $('.comment').before(data);
            $('.seemore:first').remove();
            $('#comment_more:first').remove();
        },
        error:function(data){
            alert("error");
        }
    });
}

function submitForm(id){
    $("#"+id).submit();
}
function checkLogin(url){
    var name=$("#user_name").val();
    var pass=$("#pass").val();
    if( name=="" || name==0){
        $(".message").html("Tên đăng nhập không chính xác");
        $("#user_name").focus();
        return false;
    }
    if( pass =="" || pass==0){
        $(".message").html("Mật khẩu không được để rỗng");
        $("#pass").focus();
        return false;
    }
    if($("#rememberme").attr('checked')) rememberme=1;else rememberme=0;
    $.ajax({
        url:"/index/login",
        type:"POST",
        data: "user_name="+name+"&pass="+pass+"&rememberme="+rememberme,
        success: function(data){
            var r=data.split("|");
            if(r[0]==1){
                window.location.href=url;
                //$(".message").html(data);
            }
            else{
                $(".message").html(r[1]);
                return false;
            }
        },
        error:function(){
            alert("ERROR");
            return false;
        }
        
    });
    return false;
}
function checkRegister(){
    var user_name= $("#user_name").val();
    var pass=$("#pass").val();
    var re_pass=$("#retype_pass").val();
    var gender=document.getElementsByName("gender");
    if(gender[0].checked==true) gender="1";else gender=0;
    if(user_name==0||user_name==''){
        alert("Tên không chính xác");
        $("#user_name").focus();
        return false;
    }
    if(pass==0||pass==''){
        alert("Mật khẩu không được để rỗng");
        $("#pass").focus;
        return false;
    }
    $.ajax({
        url:"/index/register",
        type:"POST",
        data:"user_name="+user_name+"&pass="+pass+"&retype_pass="+re_pass+"&gender="+gender,
        success:function(data){
            var r=data.split("|");
            if(r[0]==1){
                window.location="/index";
            }
            else{
                $(".message").html(r[1]);
                return false;
            }
        },
        error:function(){
            alert("Error loading from sever");
            return false;
        }
    });
    return false;
}

function del_input(id){
    document.getElementById(id).value = "";
}
// display menu top
function display_hover(){
    if($("#menu_hover").css("display") == "block")
        $("#menu_hover").css("display", "none");
    if($("#menu_hover").css("display") == "none")
        $("#menu_hover").css("display", "block");
}
// add like
function addLike(){
		      var data = "id="+$('#id_product').val();
		  	  var url = "/default/index/addlike";	    
			  	 	$.ajax({ 
			  	    	url : url,
			  	    	type: 'POST',
			  	    	cache : false,
			  	    	data : data,
			  	    	success:function(html){
			  	    	     if(html == "error"){
			  	    	        alert("Bạn đã like rồi :)"); 
			  	    	     }else{
			  	    			$(".like_span").html('Thích ('+html+')');                              
                                }
			  	    	},
			  	    	error : function (data){ 
			  	    		console.log(data);
			  	    	}
			  	    });
	}
// add like
function addShare(){
		      var data = "id="+$('#id_product').val();
		  	  var url = "/default/index/addshare";	    
			  	 	$.ajax({ 
			  	    	url : url,
			  	    	type: 'POST',
			  	    	cache : false,
			  	    	data : data,
			  	    	success:function(html){
			  	    			$(".share_span").html('Chia sẻ ('+html+')');
                                $("#product_shares").val(html);
			  	    	}
			  	    });
}

    
// display menu when hover
function display(div){
    $("#"+div).css("display", "block");
}
function disable(div){
    $("#"+div).css("display", "none");
}

function loadAjax(link,type){
	$("[id *=content_info]").hide();
	$("[id *=content_vote]").hide();
	$("[id *=content_highscore]").hide();
	$("[id *=content_event]").hide();
	$("[id *=content_trophy]").hide();
	$(".link_info").css('color','black');
    $(".link_vote").css('color','black');
    $(".link_high").css('color','black');
    $(".link_event").css('color','black');
    $(".link_trophy").css('color','black');
	if(type==1) {
		content=$("#content_info").html();
		$("#content_info").show();
		$(".link_info").css("color","#83A913");
	}
	if(type==2) {
		content=$("#content_vote").html();
		$("#content_vote").show();
		$('.link_vote').css("color","#83A913");
	}
	if(type==3) {
		content=$("#content_highscore").html();
		$("#content_highscore").show();
		$('.link_high').css("color","#83A913");
	}
	if(type==4) {
		content=$("#content_event").html();
		$("#content_event").show();
		$('.link_event').css("color","#83A913");
	}
	if(type==5) {
		content=$("#content_trophy").html();
		$("#content_trophy").show();
		$('.link_trophy').css("color","#83A913");
	}
	if(content == null){
    $.ajax({
       url:link,
       type:"POST",
       data:"test=1",
       success:function(data){
            $("#loadAjax").append(data);
            //var star=$("#star").val();  
            //$("#rating :radio.star").rating();
            if(type != 3) $("#1").css("color","black");
            $("#2").css("color","black");
            $("#3").css("color","black");
            if(type==1) {
            	$('#slider-one').movingBoxes({
            		startPanel   : 0,      // start with this panel
            		reducedSize  : 0.8,    // non-current panel size: 80% of panel size
            		wrap         : true,   // if true, the panel will "wrap" (it really rewinds/fast forwards) at the ends
            		buildNav     : true,   // if true, navigation links will be added
            		navFormatter : function(){ return "&#9679;"; }, // function which returns the navigation text for each panel
                    initAnimation: false
            		// width and panelWidth options removed in v2.2.2, but still backwards compatible
            		// width        : 300,    // overall width of movingBoxes (not including navigation arrows)
            		// panelWidth   : 0.5,    // current panel width

                });
            	$("#content_info").show();
            }
            if(type==2) {
//            	FB.XFBML.parse();
//            	 FB.Event.subscribe('comment.create', function(response) {
//     	            var commentQuery = FB.Data.query("SELECT text, fromid FROM comment WHERE post_fbid='"+response.commentID+"' AND object_id IN (SELECT comments_fbid FROM link_stat WHERE url='"+response.href+"')");
//     	            var userQuery = FB.Data.query("SELECT uid,name FROM user WHERE uid in (select fromid from {0})", commentQuery);
//     	
//     	            FB.Data.waitOn([commentQuery, userQuery], function() {
//     	                var commentRow = commentQuery.value[0];
//     	                var userRow = userQuery.value[0];
//     	                //console.log(userRow.name+" (id: "+commentRow.fromid+") posted the comment: "+commentRow.text);
//     	                CommentFBAdd($("#product_id").val(),commentRow.text,userRow.id,userRow.uid,userRow.name);
//     	            });
//     	        });  
//            	 FB.Event.subscribe('comment.remove', function(response) {
// 					CommentFBRemove(response.commentID);
//            	 });
                 $("#rating :radio.star").rating();
            	 $("#content_vote").show();
            }
            if(type==4) {
            	$('.link_event').css("color","#83A913");
            	$("#content_event").show();
            }
            if(type==3||type==31||type==32||type==33) {
            	$('.link_high').css("color","#83A913");
            	FB.XFBML.parse();
            	$("#content_highscore").show();
            }
            if(type==31) $('#1').css("color","#83A913");
            if(type==32) $('#2').css("color","#83A913");
            if(type==33) $('#3').css("color","#83A913");
            if(type==5) {
            	$('.link_trophy').css("color","#83A913");
            	$("#content_trophy").show();
            }
            
        },
       error:function(){
        alert("Error loading from sever");
       }
    });
	}
}
function menu_hover(){
    $("#menu_hover").css("z-index","999");
    var display=$("#menu_hover").css("display").toString();
    if(display=="block") $("#menu_hover").css("display","none");
    else $("#menu_hover").css("display","block");
        
}
function category(){
    var display=$("#category").css("display").toString();
    $("#menu_hover").css("display","none");
    if(display=="block"){
    	$("#category").css("display","none");
    }
    else{
    	$("#category").css("margin-top","1px");
    	$("#category").css("display","block");
    	$(".poster").css("border-bottom","1px solid #D9DBDD");
    }
}
function requires_login(){
    alert("Bạn cần đăng nhập bằng tài khoản Qplay hoặc Gmail để tải. Nếu chưa có bạn vui lòng đăng ký");
    load_bottom('t_login','/index/login-form?label=Đăng nhập tài khoản Yoctity để tải game free','t_search','/index/search-form');
}
function requires_login2(url){
	alert("Đăng nhập để nhận thẻ game");
	load_bottom('t_login','/index/login-form?label=Đăng nhập tài khoản Qplay để nhận thẻ game&url1='+url,'t_search','/index/search-form');
	$("#menu_hover").css("display","none");
}
function load_bottom(object_off,url,object_on,url2){
    var data=url.split("?");
    if(data[1]){
        $.ajax({
            url:url,
            data: data[1],
            type: "POST",
            success:function(data){
                $("#bottom_header").html(data);
            }
        });
    }else{
        $("#bottom_header").load(url);
    }
    $("."+object_off).attr('onclick',"hide_bottom('"+object_off+"','"+url+"','"+object_on+"','"+url2+"')");
    $("."+object_on).attr('onclick',"load_bottom('"+object_on+"','"+url2+"','"+object_off+"','"+url+"')");
    $("#menu_hover").css("display","none");
   // $("#category").css("display","none");
}
function hide_bottom(object_off,url,object_on,url2){
    $("#bottom_header").html("");
    $("."+object_off).attr('onclick',"load_bottom('"+object_off+"','"+url+"','"+object_on+"','"+url2+"')");
}
function load_bottom2(url){
    $("#bottom_header").load(url);
}
function loadValue(product_id){
    var product_id=$("#product_coupon_id").val();
    $.ajax({
        url:"/index/loadvalue",
        data:"product_coupon_id="+product_id,
        type:"POST",
        success:function(data){
            $("#value").val((data));
            $("#product_id").val(product_id);
        },
        error:function(data){
            alert(data);
        }
    });
}
function show_object(object,link){
	$("#"+object).show();
	$("#"+link).attr("onclick","hide_object('"+object+"','"+link+"')");
}
function hide_object(object,link){
	$("#"+object).hide();
	$("#"+link).attr("onclick","show_object('"+object+"','"+link+"')");
}
function edit_profile(){
	var avatar=$("#avatar").val();
	var email=$("#email").val();
	var tel=$("#mobile").val();
	var data="avatar="+avatar+"&email="+email+"&mobile="+tel;
	var r = confirm("Bạn chắc chắn muốn lưu thay đổi!");
	if(r==true){
		$.ajax({
			url: "/index/edit-profile",
			type: "POST",
			data: data,
			success: function(data){
				$("#l_avatar").attr("src",avatar);
				$("#l_email").html(email);
				$("#l_mobile").html(tel);
				$("#edit_profile").hide();
			},
			error: function(data){
				alert("Error loading from sever!");
			}
		});
	}
}
function select_ava(i){
	$("#img_avatar").attr("src",i);
	$("#avatar").val(i);
}
function show_list_avatar(){
	
}

/*
 * 21/11/2012 @namla
 */
function getListEvent(){
	$.ajax({
		url:"/index/list-event",
		data: "",
		type: "POST",
		success: function(data){
			
            $("#frameUpdate").hide();
            $("#frameHighScore").hide();
            $("#frameTrophy").hide();
            $("#frameEvent").show();
            $("#frameEvent").html(data);
            
            $(".arrowEvent").show();
            
            $("#aEvent").attr("onclick","showHideFrame('aEvent','frameEvent')");
            
            $(".fa_event").removeClass("fa_eventActive");
            $(".fa_trophy").removeClass("fa_trophyActive");
            $(".fa_highscore").removeClass("fa_highscoreActive");
            $(".fa_update").removeClass("fa_updateActive");
            
            $(".fa_event").addClass("fa_eventActive");
			
		},
		error: function(data){
			alert("Lỗi từ phía sever, bạn vui lòng thử lại!");
		}
	});
}
function getListHighScore(){
	$.ajax({
		url:"/index/list-high-score",
		data: "",
		type: "POST",
		success: function(data){
            $("#frameUpdate").hide();
            
            $("#frameTrophy").hide();
            $("#frameEvent").hide();
            $("#frameHighScore").show();
			$("#frameHighScore").html(data);
            $(".arrowEvent").show();
            $("#aHighScore").attr("onclick","showHideFrame('aHighScore','frameHighScore')");
            
             $(".fa_event").removeClass("fa_eventActive");
            $(".fa_trophy").removeClass("fa_trophyActive");
            $(".fa_highscore").removeClass("fa_highscoreActive");
            $(".fa_update").removeClass("fa_updateActive");
            
            $(".fa_highscore").addClass("fa_highscoreActive");
			
		},
		error: function(data){
			alert("Lỗi từ phía sever, bạn vui lòng thử lại!");
		}
	});
}
function getListComment(){
	$.ajax({
		url:"/index/list-comment",
		data: "",
		type: "POST",
		success: function(data){
            $("#frameUpdate").hide();
            $("#frameHighScore").hide();
            
            $("#frameEvent").hide();
            $("#frameComment").show();
          
			$("#frameComment").html(data);
            $(".arrowEvent").show();
            $("#aComment").attr("onclick","showHideFrame('aComment','frameComment')");
            
             $(".fa_event").removeClass("fa_eventActive");
            $(".fa_comment").removeClass("fa_commentActive");
            $(".fa_highscore").removeClass("fa_highscoreActive");
            $(".fa_update").removeClass("fa_updateActive");
            
            $(".fa_comment").addClass("fa_commentActive");
		},
		error: function(data){
			alert("Lỗi từ phía sever, bạn vui lòng thử lại!");
		}
	});
}
function getListTrophy(){
	$.ajax({
		url:"/index/list-trophy",
		data: "",
		type: "POST",
		success: function(data){
            $("#frameUpdate").hide();
            $("#frameHighScore").hide();
            
            $("#frameEvent").hide();
            $("#frameTrophy").show();
          
			$("#frameTrophy").html(data);
            $(".arrowEvent").show();
            $("#aTrophy").attr("onclick","showHideFrame('aTrophy','frameTrophy')");
            
             $(".fa_event").removeClass("fa_eventActive");
            $(".fa_trophy").removeClass("fa_trophyActive");
            $(".fa_highscore").removeClass("fa_highscoreActive");
            $(".fa_update").removeClass("fa_updateActive");
            
            $(".fa_trophy").addClass("fa_trophyActive");
		},
		error: function(data){
			alert("Lỗi từ phía sever, bạn vui lòng thử lại!");
		}
	});
}
function getListUpdate(){
	$.ajax({
		url:"/index/list-update",
		data: "",
		type: "POST",
		success: function(data){
		 
            $("#frameHighScore").hide();
            $("#frameTrophy").hide();
            $("#frameEvent").hide();
            $("#frameUpdate").show();
			$("#frameUpdate").html(data);
            $(".arrowEvent").show();
            $("#aUpdate").attr("onclick","showHideFrame('aUpdate','frameUpdate')");
            //$('.uiScroll').tinyscrollbar();
            //$("#disableFrame").addClass("disableFrame");
            //$("#disableFrame").attr("onclick","hideFrame('aUpdate',''frameUpdate)");
            //$("body").attr("onclick","hideFrame('aUpdate','frameUpdate')");
            //$("body").css('cursor',"pointer");
            
             $(".fa_event").removeClass("fa_eventActive");
            $(".fa_trophy").removeClass("fa_trophyActive");
            $(".fa_highscore").removeClass("fa_highscoreActive");
            $(".fa_update").removeClass("fa_updateActive");
            
            $(".fa_update").addClass("fa_updateActive");
			
		},
		error: function(data){
			alert("Lỗi từ phía sever, bạn vui lòng thử lại!");
		}
	});
}
function hideFrame(frame){
	$("#"+frame).hide();
	$(".fa_event").removeClass("fa_eventActive");
    $(".fa_comment").removeClass("fa_commentActive");
    $(".fa_highscore").removeClass("fa_highscoreActive");
    $(".fa_update").removeClass("fa_updateActive");
}
function showFrame(a,frame){
    $("#"+frame).show();
    $("#"+a).attr("onclick","hideFrame('"+a+"','"+frame+"')");
}
function showHideFrame(a,frame){
	var display=$("#"+frame).css('display').toString();
	$("#frameUpdate").hide();
	$("#frameHighScore").hide();
	$("#frameComment").hide();
	$("#frameEvent").hide();
    
     $(".fa_event").removeClass("fa_eventActive");
            $(".fa_comment").removeClass("fa_commentActive");
            $(".fa_highscore").removeClass("fa_highscoreActive");
            $(".fa_update").removeClass("fa_updateActive");
    var name=a.slice(1).toLowerCase();
	if(display=='block'){
		$("#"+frame).hide();
        $(".fa_"+name).removeClass("fa_"+name+"Active");
    }
	else {
       //$("body").css('cursor',"pointer");
       $("#"+frame).show();
       $(".fa_"+name).addClass("fa_"+name+"Active");
       //$("#"+a).addClass("")
	}
}
function none(){
    
}
function redirectEvent(){
	
}
function redirectComment(url,product_id){
	window.location= url;
//	$(document).ready(function(){
//			loadAjax('/index/vote?id='+product_id,'2');
//	});
}
function seemoreFrame(){
	$("#uiScroll").removeClass("uiScroll");
	$("#uiScroll").css("max-height","none");
	$("#seemore").hide();
}
function collapseFrame(){
	$("#uiScroll").addClass("uiScroll");
	$("#uiScroll").css("max-height","342px");
	$("#seemore").show();
}
