$(document).ready(function() {
	var offset=250, // At what pixels show Back to Top Button
	scrollDuration=300; // Duration of scrolling to top

	var sec = $('section');

	$(window).scroll(function() {
	    if ($(this).scrollTop() > offset) {
	            $('.back-to-top').fadeIn(500); // Time(in Milliseconds) of appearing of the Button when scrolling down.
	    } else {
		$('.back-to-top').fadeOut(500); // Time(in Milliseconds) of disappearing of Button when scrolling up.
		}

		if(screen.width>1024){
			var windscroll = $(window).scrollTop();
			//console.log("windscroll : "+windscroll);
    		if (windscroll >= 100) {
    			var navIndex = 0;
				for(var i=0; i<sec.length; i++){
				    //console.log(sec[i].id);
				    if(['about-us','team','services','portfolio', 'Careers','contact-us'].includes(sec[i].id)){
				        
				        if ($(sec[i]).position().top <= windscroll) {

				        	//console.log(sec[navIndex].id);	
				        	//console.log("in-active : "+$("#main-nav li.active").id);
			                $('#main-nav li.active').removeClass('active');

			                $("#main-nav li").eq(navIndex+1).addClass('active');
			                //console.log("active : "+ (navIndex+1) +" : "+$("#main-nav li").eq(navIndex+1).id);
			                navIndex++;
			            }
				    }
				}
    		}else{
    			$("#main-nav li.active").removeClass('active');
    			$("#main-nav li").first().addClass('active');
    		}

		}
	});

	// Smooth animation when scrolling
	$('.back-to-top').click(function(event) {
	event.preventDefault();
	        $('html, body').animate({
	        scrollTop: 0}, scrollDuration);
	});

	parent.location.hash="";
	$('html, body').animate({scrollTop: 0}, scrollDuration);

});