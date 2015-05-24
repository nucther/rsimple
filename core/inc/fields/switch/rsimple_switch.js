/*global wp, rsimple*/

/**
 * Field Switch 
 * date: 2015.04.30
 */

(function( $ ){
	"use strict";

	//rsimple.fields = rsimple.fields || {};
	//rsimple.fields.switch = rsimple.fields.switch || {};
	$.rsimple_switch = $.rsimple_switch ||{};

	$(document).ready(function(){
		$.rsimple_switch.init();
	});

	$.rsimple_switch.init = function( switch_obj ){		
		if(!switch_obj){
			switch_obj = $(document).find('.rsimple-switch');
		}

		$(switch_obj).each(
			function(){
				var obj = $(this);
				var en = $(this).children('.switch_enable');
				var ds = $(this).children('.switch_disable');
				var inp = $(this).children('input');

				if( inp.val() == 1){
					en.addClass('selected');
				} else{
					ds.addClass('selected');
				}

				en.on('click', function(){
					ds.removeClass('selected');
					$(this).addClass('selected');
					inp.val(1).change();
				});

				ds.on('click', function(){
					en.removeClass('selected');
					$(this).addClass('selected');
					inp.val(0).change();
				});
			}
		)
	}

})(jQuery);