/*
 * MovingBoxes demo script
 */

$(window).load(function(){
	 /*
 * MovingBoxes demo script
 */
	
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
	     // Report events to firebug console
	 	$('.mb-slider').bind('initialized.movingBoxes initChange.movingBoxes beforeAnimation.movingBoxes completed.movingBoxes',function(e, slider, tar){
	 		// show object ID + event in the firebug console
	 		// namespaced events: e.g. e.type = "completed", e.namespace = "movingBoxes"
	 		if (window.console && window.console.log){
	 			var txt = slider.$el[0].id + ': ' + e.type + ', now on panel #' + slider.curPanel + ', targeted panel is ' + tar;
	 			console.log( txt );
	 		}
	 	});
	 
	//FlexSlider();
});
//$(window).ready(function(){
//	FlexSlider();
//});
function FlexSlider(){
	 $('.flexslider').flexslider({
		    animation: "slide"
	 });
	 //var width=$("#intro1")[0].naturalWidth;
	 if($("#intro1")[0].naturalWidth==0){
		 var img=new Image();
        
		 //get width imgae
		  img.src=$("#intro1").attr("src").toString();
          $("#scroller").css("width",img.width);
	       $("#scroller").css("height",img.height);
		 
	}else {
		$("#scroller").css("width",$("#intro1")[0].naturalWidth);
		$("#scroller").css("height",$("#intro1")[0].naturalHeight);
	}
}