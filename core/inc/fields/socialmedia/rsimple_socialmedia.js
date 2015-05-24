(function($){
	$.rsimple_socialmedia = $.rsimple_socialmedia || {};

	$(document).ready(function(){
		$.rsimple_socialmedia.init();
	});

	$.rsimple_socialmedia.init = function( socialmedia_obj ){
		if(! socialmedia_obj ){
			socialmedia_obj  = $(document).find('.rsimple-socialmedia');
		}

		socialmedia_obj.each(function(){
			$(this).find('.lists > span').live('click', function(){
					var source = $('.target-clone'),
					target = $('.rsimple-target ul'),
					icon = $(this).data('icon'),
					deflt = $(this).data('default'),
					id = uniqid();

				var x = source.clone()
				.find('*').each(function(){

					var attrclass = $(this).attr('class');
					if( attrclass ) $(this).attr('class', attrclass.replace('#',icon));

					if($(this).attr('type') == 'hidden') $(this).attr('value', icon);

					if($(this).attr('type') == 'text') $(this).attr('value',deflt);

					var attrname = $(this).attr('name');
					if(attrname){
						$(this).attr('name', attrname.replace('#','').replace('$$',id));			
					}

				}).end();

				target.append( x.html() );
				return false;
			});
		});

		jQuery('.remove-social').live('click',function(){
			jQuery(this).parent().remove();
		});
	}

	uniqid = function(){
		var newDate = new Date;
		return newDate.getTime();
	}

})(jQuery);