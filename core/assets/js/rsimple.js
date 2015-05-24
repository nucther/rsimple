(function($){

	$.rsimple = $.rsimple || {};

	$(document).ready(
		function(){
			$.fn.isOnScreen = function() {
				if ( !window ) {
                    return;
                }
			}
			$.rsimple.tabControl();
			//$.rsimple.initFields();
			$.rsimple.saveUpdate();
		}
	);

	$.rsimple.tabControl = function(){
		$('.rsimple .content .section').hide();
		$('.rsimple .content .section:first').show();
		$('.rsimple .menu li:first').addClass('active');

		$('.rsimple .menu li a').on(
			'click', function(){
				$('.rsimple .menu li').removeClass('active');
				$(this).parent().addClass('active')
				
				var target = $(this).attr('href');
				$('.rsimple .content .section').hide();

				$( target ).fadeIn(
					'medium', function(){

					}
				);
				return false;
			}
		);
	}

	$.rsimple.initFields = function(){
		$('.rsimple_fields').each(
			function(){
				var type = $(this).attr('data-type');
				console.log(type);
				if(rsimple.fields[type]){
					console.log(type);
					rsimple.fields[type].init();
				}
			}
		);
	}

	$.rsimple.saveUpdate = function(){
		$('.save').on({
			click: function(){
				var datas = $('#rsimple').serialize();				
				$.ajax({
					method:"POST",
					url: ajaxurl,
					data: datas,
					dataType: 'json',
					success: function(data){
						$(document).scrollTop(0);
						if(data.status){
							$('.message').html('Settings saved');
							$('.message').removeClass('error');
							$('.message').slideDown('slow').delay(10000).slideUp();
						} else {
							$('.message').html('Error save settings.');
							$('.message').addClass('errors');
							$('.message').slideDown('slow').delay(10000).slideUp();
						}						
					}
				});
			}
		});
	}

}(jQuery));

jQuery.noConflict();