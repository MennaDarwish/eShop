$(document).ready(function($){

	$("#navbar-cart").on("click", function() {
		if ( $('#navbar-cart').hasClass('opened') ){
			console.log("closed");
			$(".navbar-cart-open").fadeOut();
			$("#navbar-cart").removeClass('opened');
		}
		else {
			$('#navbar-cart').addClass('opened');
			console.log("opened");
			$(".navbar-cart-open").fadeIn();
		} 
	});
	
});