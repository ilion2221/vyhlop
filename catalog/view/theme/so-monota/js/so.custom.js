/* Add Custom Code Jquery
 ========================================================*/
$(document).ready(function(){
	// Fix hover on IOS
	$('body').bind('touchstart', function() {}); 
	




// FB like index 3
	(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

	
	// Messenger Top Link
	if ($('.list-msg').length) {
		$('.list-msg').owlCarousel2({
			pagination: false,
			center: false,
			nav: false,
			dots: false,
			loop: true,
			slideBy: 1,
			autoplay: true,
			margin: 30,
			autoplayTimeout: 4500,
			autoplayHoverPause: true,
			autoplaySpeed: 1200,
			startPosition: 0, 
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				768:{
					items:1
				},
				1200:{
					items:1
				}
			}
		});
	}

	// Close pop up countdown
	 $( "#so_popup_countdown .customer a" ).click(function() {
	  $('body').toggleClass('hidden-popup-countdown');
	 });
	// =========================================

	// video

	$(document).ready(function() {
	    $('.home7-video').magnificPopup({
	      type: 'iframe',
	      iframe: {
	      patterns: {
	         youtube: {
	          index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
	          id: 'v=', // String that splits URL in a two parts, second part should be %id%
	          src: '//www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe. 
	          },
	        }
	      }
	    });
	});

	// click header search header 
	jQuery(document).ready(function($){
		$( ".search-header-w .icon-search" ).click(function() {
		$('#sosearchpro .search').slideToggle(200);
		$(this).toggleClass('active');
		});
	});
	jQuery(document).ready(function($){
		$( ".search-header-w .ico-search" ).click(function() {
		$('#sosearchpro').slideToggle(200);
		$(this).toggleClass('active');
		});
	});
	
	// slider categories
	jQuery(document).ready(function($) {
	    var slidercate = $(".slider-cates .cat-wrap");
	    slidercate.owlCarousel2({    
	    margin:30,
	    nav:true,
	    loop:false,
	    dots: false,
	    navText: ['',''],
	    responsive:{
	            0:{
	                items:1
	            },
	            480:{
	                items:2
	            },
	            768:{
	                items:4
	            },
	            992:{
	                items:4
	            },
	            1200:{
	                items:5
	            },
	        },
	    })
	});

	jQuery(document).ready(function($) {
	    var slidercate = $(".slider-cates5 .cat-wrap");
	    slidercate.owlCarousel2({    
	    margin:30,
	    nav:true,
	    loop:false,
	    dots: false,
	    navText: ['',''],
	    responsive:{
	            0:{
	                items:1
	            },
	            480:{
	                items:2
	            },
	            768:{
	                items:3
	            },
	            992:{
	                items:5
	            },
	            1200:{
	                items:6
	            },
	        },
	    })
	});
	jQuery(document).ready(function($) {
	    var slidercate = $(".slider-cates10 .cat-wrap");
	    slidercate.owlCarousel2({    
	    margin: 30,
	    nav:true,
	    loop:true,
	    dots: false,
	    navText: ['',''],
	    responsive:{
	            0:{
	                items:1
	            },
	            480:{
	                items:2
	            },
	            768:{
	                items:3
	            },
	            992:{
	                items:5
	            },
	            1200:{
	                items:7
	            },
	        },
	    })
	});
	// slick testimonials

		$('.client-main').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: true,
			fade: true,
			//rtl: true,
			prevArrow: '<div class="slick-prev" aria-label="Previous"><span>Previous</span></div>',
			nextArrow: '<div class="slick-next" aria-label="Next"><span>Next</span></div>',
			asNavFor: '.client-image'
		});
		
		$('.client-image').slick({
			slidesToShow: 5,
			slidesToScroll: 1,
			asNavFor: '.client-main',
			dots: false,
			arrows: false,
			//rtl: true,
			centerMode: true,
			centerPadding: 0,
			focusOnSelect: true,
			
			responsive: [
				{
				  breakpoint: 767,
				  settings: {
					slidesToShow: 4,
				  }
				},
				{
				  breakpoint: 560,
				  settings: {
					slidesToShow: 3,
				  }
				}
			]
		});


	// custom to show footer center
	$(".description-toggle").click(function () {
		if($('.showmore').hasClass('active'))
			$('.showmore').removeClass('active');
		else
			$('.showmore').addClass('active');
	}); 


	$(".content-product-content .button-toggle").click(function () {
		if($(this).children('.showmore').hasClass('active')) $(this).children().removeClass('active');
		else $(this).children().addClass('active');
		
		
		
		if($(this).prev().hasClass('showdown')) $(this).prev().removeClass('showdown').addClass('showup');
		else $(this).prev().removeClass('showup').addClass('showdown');
	}); 

	$(".clearable").each(function() {
  
	  var $inp = $(this).find("input:text"),
	      $cle = $(this).find(".clearable__clear");

	  $inp.on("input", function(){
	    $cle.toggle(!!this.value);
	  });
	  
	  $cle.on("touchstart click", function(e) {
	    e.preventDefault();
	    $inp.val("").trigger("input");
	  });
	  
	});

});
