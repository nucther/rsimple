(function($){
	$.rsimple_ace_editor = $.rsimple_ace_editor || {};

	$(document).ready(function(){
		$.rsimple_ace_editor.init();
	});

	$.rsimple_ace_editor.init = function( ace_obj){
		if(! ace_obj){
			ace_obj  = $(document).find('.ace-editor');
		}


		ace_obj.each(
			function( index, element ){				
				var area = element;
				var editor = $(element).data('editor');
				var target = $(element);

				var editor = ace.edit( editor );
				editor.setTheme("ace/theme/"+ $(element).data('theme') );
				editor.getSession().setMode("ace/mode/"+ $(element).data('mode'));

				editor.on(
					'change', function(e){
						$('#' + area.id).val( editor.getSession().getValue() );
						editor.resize();
					}
				);
			}
		);
	}

})(jQuery);