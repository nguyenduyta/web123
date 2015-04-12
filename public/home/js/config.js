/**
 * Date 19/12/2014
 * Author: KhoiPK
 */
$(document).ready(function(){
	//Xử lý active Menutop
	$('#menu ul.menu-top a').click(function(){
		$('#menu ul.menu-top a').removeClass('active');
		$(this).addClass('active');
	})
	/*****Xử lý Menu Tab**********************/
	//Khoa hoc
	$(".menu-khoahoc").click(function(){
		$("#tab-khoahoc").slideToggle(500);
		$("#tab-chuyende").hide();
		$("#tab-project").hide();
	})
	//Chuyen de
	$(".menu-chuyende").click(function(){
		$("#tab-chuyende").slideToggle(500);
		$("#tab-khoahoc").hide();
		$("#tab-project").hide();
	})
	//Project
	$('.menu-project').click(function(){
		$("#tab-project").slideToggle(500);
		$("#tab-khoahoc").hide();
		$("#tab-chuyende").hide();
	})
	//Tab .tab-once
	$('.tab-once ul li a:last').css('border','none');
	$('ul.post-news li:last').css('border','none');
	//listArticleCourse
	$("#listArticleCourse li:last").css("border","none");
	$("#ulchuyen-de li:last").css("border","none");
	$("div.article-course ul li:last").css("border","none");
	$("ul.ultoppic li:last").css("border","none");
	$("ul#ul_comment li:last").css("border","none");
	
	//Show video
	$("a.video_course").click(function(){
		var video_link = $(this).attr('url');
		var html ='<iframe width="645" height="500" src="//www.youtube.com/embed/'+video_link+'?autoplay=1" frameborder="0" allowfullscreen></iframe>';
		$("#videoshow").html(html);
	})
})
