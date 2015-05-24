(function($){
	$.rsimple_image_select = $.rsimple_image_select || {};

	$(document).ready( function(){
		$.rsimple_image_select.init();
	});

	$.rsimple_image_select.init = function(imageselect_obj){
		if(! imageselect_obj){
			imageselect_obj = $(document).find('.rsimple-image_select');
		}

		imageselect_obj.each(
			function(index, element){
				var input = $(this).find('input[type="radio"]');
				var img = $(this).find('img');

				img.on(
					'click', function(){						
						input.each( function(){ $(this).parent().removeClass('image_checked'); });
						$(this).parent().addClass('image_checked');
					}
				);				

			}
		);
	}
})(jQuery);