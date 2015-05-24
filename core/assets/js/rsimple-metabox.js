(function($){

	$.metabox = $.metabox || {};

	$(document).ready(
		function(){
			$.metabox.init();
		}
	);

	$.metabox.init = function(){
		var target_select = $('select#page_template');

		target_select.live('change', function(){
			var this_value = $(this).val();
			this_value = this_value.replace('/','-').replace('.','-');			

			//console.log('test'+ this_value);

			$(document).find('.rsimple-condition-page').hide();
			$(document).find('.rsimple-'+ this_value).show();
		});

		target_select.trigger('change');
	}

})(jQuery);