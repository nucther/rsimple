(function($){
	$.rsimple_media = $.rsimple_media || {};

	$(document).ready(
		function(){
			$.rsimple_media.init();
		}
	);

	$.rsimple_media.init = function( media_obj ){
		if(! media_obj){
			media_obj = $(document).find('.rsimple-media');
		}

		media_obj.each(
			function(){			
				
				$(this).find('a').on({
					click: function( event ){												
						var current = event.currentTarget;
						var parent = $(this).parent().find('.rsimple-target');	
						var name = $(current).data('name');

						if( $(current).hasClass('media-remove-btn') ){							
							parent.html('');
							return;
						}

						var frame;

						if(frame){
							frame.open();
							return;
						}

						frame = wp.media(
						{
							multiple: false,
							model: 'PostImage',
						});

						frame.on(
							'select', function(){
								var attachement = frame.state().get('selection').first();

								frame.close();
								preview_img = typeof attachement.attributes.sizes.thumbnail !== 'undefined' ? attachement.attributes.sizes.thumbnail.url : attachement.attributes.url;
								//Insert to panel
								parent.html('<img src="'+ preview_img +'"><input type="hidden" name="'+ name +'[id]" value="'+ attachement.attributes.id +'"><input type="hidden" name="'+ name +'[url]" value="'+ attachement.attributes.url +'">');
							}
						);

						frame.open();

					}
				});
			}
		);
	}
})(jQuery);