jQuery(document).ready(function($) {

	if($('.offerstack-slider').length > 0) {

		var slideNo = 1;

		$('.offer-slide-no').on('click', function() {
			$('.offerstack-slide').removeClass('offer-slide-show');
			$('.offerstack-slide').addClass('offer-slide-hide');
			$('.offerstack-slider .offer-slide-'+ $(this).data('offerpageno')).addClass('offer-slide-show');

			$('.offer-slide-no').removeClass('selected-slide');
			$(this).addClass('selected-slide');

			slideNo = $(this).data('offerpageno');
		})
		
		setInterval(function(){ 
			if($('.offerstack-widget:hover').length == 0) {
				$('.offerstack-slide').removeClass('offer-slide-show');
				$('.offerstack-slide').addClass('offer-slide-hide');
				$('.offerstack-slider .offer-slide-' + slideNo).addClass('offer-slide-show');

				$('.offer-slide-no').removeClass('selected-slide');
				$('.offer-pagination li').eq(slideNo - 1).addClass('selected-slide');

				slideNo++;
				if(slideNo > 3)
					slideNo = 1;		
			}
		}, 3000);
	}		
});