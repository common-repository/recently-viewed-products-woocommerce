
jQuery(document).ready(function(){

	jQuery('#recently-viewed-slider').slick({
	  infinite: false,
	  slidesToShow: 4,
	  slidesToScroll:1,
	  arrows: false,
	  dots: true,
	  responsive: [
		{
			breakpoint: 1200,
			settings: {
			  slidesToShow: 4,
			  slidesToScroll: 1
			}
		  },
		  {
			breakpoint: 992,
			settings: {
			  slidesToShow: 3,
			  slidesToScroll: 1
			}
		  },
		  {
			breakpoint: 768,
			settings: {
			  slidesToShow: 2,
			  slidesToScroll: 1
			}
		  },
		  {
			breakpoint: 576,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1
			}
		}  
	  ]
	});
});