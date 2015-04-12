// Scroll to element function
function scrollToElement(selector, time, verticalOffset) {

    time = typeof(time) != 'undefined' ? time : 1000;

    verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;

    element = $(selector);
    offset = element.offset();
    offsetTop = offset.top + verticalOffset;
    $('html, body').animate({
        scrollTop: offsetTop
    }, time);
}



// Photoswipe
(function(window, $, PhotoSwipe){

	$(document).ready(function(){
		
		if($('.photoSwipe a').length > 0){
		
				var options = {
				
					// Customizing toolbar
					getToolbar: function(){
						return '<div class="ps-toolbar-previous"><div class="ps-toolbar-content"></div></div><div class="ps-toolbar-play"><div class="ps-toolbar-content"></div></div><div class="ps-toolbar-next"><div class="ps-toolbar-content"></div></div>';
					},
							
					getImageCaption: function(el){
						var captionText, captionEl, captionBack;
						
						// Get the caption from the alt tag
						if (el.nodeName === "IMG"){
							captionText = el.getAttribute('alt'); 
						}
						var i, j, childEl;
						for (i=0, j=el.childNodes.length; i<j; i++){
							childEl = el.childNodes[i];
							if (el.childNodes[i].nodeName === 'IMG'){
								captionText = childEl.getAttribute('alt'); 
							}
						}
						
						// Return a DOM element with custom styling
						captionBack = document.createElement('a');
						captionBack.setAttribute('id', 'ps-custom-back');
						
						captionEl = document.createElement('div');
						captionEl.appendChild(captionBack);
						
						captionBack = document.createElement('span');
						captionBack.innerHTML=captionText;
						captionEl.appendChild(captionBack);
						return captionEl;
					},
					
					enableMouseWheel: false,
					captionAndToolbarOpacity: 1,
					
				
				}
			
			
				// Creating Photoswipe instance
				instance = PhotoSwipe.attach(window.document.querySelectorAll('.photoSwipe a'), options );
			
				var activatedClasses = false;
				// Adding listener to custom back button
				instance.addEventHandler(PhotoSwipe.EventTypes.onShow, function(e){
					$('.ps-caption').addClass('activeState');
					$('.ps-toolbar').addClass('activeState');
					
					if ("ontouchstart" in document.documentElement) {
						$(document).on('touchstart touchend', '#ps-custom-back' , function(e){
						e.preventDefault();
							$('.ps-caption').removeClass('activeState');
							$('.ps-toolbar').removeClass('activeState');
							$('.ps-document-overlay').addClass('activeState');
							$('.ps-carousel').addClass('activeState');
							console.log('activated');
							setTimeout(function(){
								instance.hide(0);
							}, 400);
						});	
					} else {
						$(document).on('click', '#ps-custom-back' , function(){
							$('.ps-caption').removeClass('activeState');
							$('.ps-toolbar').removeClass('activeState');
							$('.ps-document-overlay').addClass('activeState');
							$('.ps-carousel').addClass('activeState');
							console.log('activated');
							setTimeout(function(){
								instance.hide(0);
							}, 400);
						});	
					}
				});	
			}
			
						
	}, false);	
}(window, window.jQuery, window.Code.PhotoSwipe));





jQuery(document).ready(function($) {
	
	// Content Loaded
	$(window).load(function(){  
	    window.scrollTo(0, 1);
	
		//Loading Animations
		$('.siteLoader').addClass('activeState');
		setTimeout(function(){
			$('#header').addClass('activeState');
			$('#content').addClass('activeState');
	    },350);
	   	
		if($('.gallery').length > 0){
			$('.gallery').flexslider({
		        animation: "slide", // Set "fade" or "slide" for your desire effect
		        directionNav: false,
		        animationLoop: true,
		        controlNav: false,
		        smoothHeight: true,
		        slideshow: true,
		        slideshowSpeed: 4000,
		        animationDuration: 600,
		    });
		}
    });
    
    
    
    
    
    // OffLoad animations
    $('#listMenu a, #blogList a, #topBarIconBackList').click(function(e) {
	    e.preventDefault();
	    var anchor = $(this), h;
	    h = anchor.attr('href');
	    if($('#contentWrapper').hasClass('activeState')){
			$('#contentWrapper').removeClass('activeState');
			console.log("Menu has CLASS");
			setTimeout(function(){
				$('#content').removeClass('activeState');
				$('#header').removeClass('activeState');
		        setTimeout(function(){
			        window.location = h;
			    },400);
		    },400);
	    }else{
			console.log("Normal Anchor");
			$('#content').removeClass('activeState');
			$('#header').removeClass('activeState');
	        setTimeout(function(){
		        window.location = h;
		    },400);
	    }
	});
	
	
	
	
	    
    // Contact Form
    $('#contactform').submit(function(){

		var action = $(this).attr('action');

		$("#message").slideUp(750,function() {
		$('#message').hide();

 		$('#submit')
			.before('<img src="images/ajax-loader.gif" class="loader" />')
			.attr('disabled','disabled');

		$.post(action, {
			name: $('#name').val(),
			email: $('#email').val(),
			phone: $('#phone').val(),
			subject: $('#subject').val(),
			comments: $('#comments').val(),
			verify: $('#verify').val()
		},
			function(data){
				document.getElementById('message').innerHTML = data;
				$('#message').slideDown('slow');
				$('#contactform img.loader').fadeOut('slow',function(){$(this).remove()});
				$('#submit').removeAttr('disabled');
				if(data.match('success') != null) $('#contactform').slideUp('slow');

			}
		);

		});

		return false;

	});

	
	
	
	
	
	//if mobile phone else - Desktop 
	if ("ontouchstart" in document.documentElement) {
		
		var shareToggling = true;
		$('.ShareDialogTrigger').bind('touchstart touchon', function() {
			if(shareToggling){
				$(this).next().show(0).addClass('activeState');
				shareToggling = false;
			}else{
				$(this).next().removeClass('activeState').delay(400).hide(0);
				shareToggling = true;
			}
		});
		
		var menuToggling = true;
		$('#topBarIconMenu').bind('touchstart touchon', function(e) {
			e.preventDefault();
			if(menuToggling){
				$('#contentWrapper').addClass('activeState');
				$('#sidebar').addClass('activeState');
				menuToggling = false;
			}else{
				$('#contentWrapper').removeClass('activeState');
				setTimeout(function(){
					$('#sidebar').removeClass('activeState');
		        },400);
				menuToggling = true;
			}
		});		
		
		$('#mapOverlay').bind('touchstart touchon', function(e) {
			e.preventDefault();
			scrollToElement('#contactMap', 400);
			$('#contactMap').addClass('activeState');
		});
		
		$('#mapOverlayClose').bind('touchstart touchon', function(e) {
			e.preventDefault();
			$('#contactMap').removeClass('activeState');
		});
		
		
		
		// Icon Active States
		$('#mapOverlayClose, .shareDialogIconList li, #topBarIconMenu, #topBarIconBackList, #topBarIconShare, #listMenu li, .hover, #blogList li, #contactInfoMetaShare, #contactInfoMetaMail, #contactInfoMetaCall').bind('touchstart touchend', function() {
			$(this).toggleClass('activeState');
		});
		
		// Photoswipe hovers
		$(document).on('touchstart touchend', '.ps-toolbar-next, .ps-toolbar-previous, .ps-toolbar-play, #ps-custom-back' , function(){
			$(this).toggleClass('activeState');
		});
		
	} else {
		var shareToggling = true;
		$('.ShareDialogTrigger').bind('click', function() {
			if(shareToggling){
				$(this).next().show(0).addClass('activeState');
				shareToggling = false;
			}else{
				$(this).next().removeClass('activeState').delay(400).hide(0);
				shareToggling = true;
			}
		});
		
		var menuToggling = true;
		$('#topBarIconMenu').bind('click', function(e) {
			e.preventDefault();
			if(menuToggling){
				$('#contentWrapper').addClass('activeState');
				$('#sidebar').addClass('activeState');
				menuToggling = false;
			}else{
				$('#contentWrapper').removeClass('activeState');
				setTimeout(function(){
					$('#sidebar').removeClass('activeState');
		        },400);
				menuToggling = true;
			}
		});
		
		$('#mapOverlay').bind('click', function(e) {
			e.preventDefault();
			scrollToElement('#contactMap', 400);
			$('#contactMap').addClass('activeState');
		});
		
		$('#mapOverlayClose').bind('click', function(e) {
			e.preventDefault();
			$('#contactMap').removeClass('activeState');
		});
		
		
		
		// Icon Active States
		$('#mapOverlayClose, .shareDialogIconList li, #topBarIconMenu, #topBarIconBackList, #topBarIconShare, #listMenu li, .hover, #blogList li, #contactInfoMetaShare, #contactInfoMetaMail, #contactInfoMetaCall').bind('hover', function() {
			$(this).toggleClass('activeState');
		});
		
		// Photoswipe hovers
		$(document).on('hover', '.ps-toolbar-next, .ps-toolbar-previous, .ps-toolbar-play, #ps-custom-back' , function(){
			$(this).toggleClass('activeState');
		});
	}
});