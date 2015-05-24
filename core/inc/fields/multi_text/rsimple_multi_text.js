(function($){

	$.rsimple_multi_text = $.rsimple_multi_text || {};

	$(document).ready(
		function(){
			$.rsimple_multi_text.init();
		}
	);

	$.rsimple_multi_text.init  = function( multiText_obj ){
		if(! multiText_obj){
			multiText_obj = $(document).find('.rsimple-multi_text');
		}

		multiText_obj.each(
			function(){
				var target = $(this).parent().find('.rsimple-target');
				var id = $(this).data('id');

				$(this).find('.multi_text_btn').on( 'click', function(){					
					target.append('<span class="text"><input type="text" name="'+ id +'[]" value="">&nbsp;<a class="remove">Remove</a></span>');
				});

				$(this).find('.remove').live( 'click', function(){
					$(this).parent().remove();
				});
			}
		);

	};

})(jQuery);