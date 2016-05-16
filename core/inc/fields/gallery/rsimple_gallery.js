(function($){
  $.rsimple_gallery = $.rsimple_gallery || {};

  $(document).ready(
    function(){
      $.rsimple_gallery.init();
    }
  );

  $.rsimple_gallery.init = function( media_obj ){
    if(! media_obj){
			media_obj = $(document).find('.rsimple-gallery');
		}

    media_obj.each(
      function(){
        $(this).find('a').on({
          click: function( event ){
            var target = $(this).parent().parent().find('.gallery-lists');
            var id = $(this).data('name');
            var num = target.find('.glist').length;
            var frame;

            if( $(this).hasClass('gallery-image-btn') ){
              if(frame){
                frame.open();
                return;
              }

              frame = wp.media(
                {
                  multiple: true,
                  model: 'PostImage',
                }
              );

              frame.on(
                'select', function(){
                  var attachement = frame.state().get('selection').toJSON();

                  frame.close();
                  var html ='';
                  for(i=0; i < attachement.length; i++){
                    num = num + 1;
                    img = typeof attachement[i].sizes.thumbnail !== 'undefined' ? attachement[i].sizes.thumbnail.url : attachement[i].url;
                      html +='<div class="glist">';
                      html +='<img src="'+ img +'">';
                      html +='<input type="hidden" name="'+ id +'['+ num +'][id]" value="'+ attachement[i].id +'">';
                      html +='<b>Description</b><br>';
                      html +='<textarea name="'+ id +'['+ num +'][desc]"></textarea>';
                      html +='<div class="close"></div></div>';
                  }
                  target.append(html);
                }
              )
              frame.open();
            }

            if( $(this).hasClass('add-prev')){
              var targetVId = $(this).parent().find('.video-target');
              if(frame){
                frame.open();
                return;
              }

              frame = wp.media(
                {
                  multiple: true,
                  model: 'PostImage',
                }
              );

              frame.on(
                'select', function(){
                  var attachement = frame.state().get('selection').first().toJSON();
                  console.log(attachement);
                  frame.close();
                  img = typeof attachement.sizes.thumbnail !== 'undefined' ? attachement.sizes.thumbnail.url : attachement.url;
                  var html ='<img src="'+ img +'"><input type="hidden" name="gal-imgID" value="'+ attachement.id +'">';              
                  targetVId.append(html);
                }
              )
              frame.open();

            }

          }

        });

        $(this).find('.close').live('click',function(){
          $(this).parent().remove();
        });

        $(this).find('.gallery-video-btn').on('click',function(){
          var target = $(this).parent().parent().find('.video-add');
          console.log( target.css('display') );
          if(target.css('display') =='none'){
            target.fadeIn('slow');
          } else {
            target.fadeOut('slow');
          }

        });

        $(this).find('.add-to-list').on('click',function(){
          var parent = $(this).parent().parent(),
              imgID= parent.find('input').val(),
              img = parent.find('img').attr('src'),
              vid = parent.find('textarea').val(),
              total = parent.parent().parent().find('.glist').length,
              target = parent.parent().parent().find('.gallery-lists'),
              id = $(this).data('id'),
              num = num + 1;

          html ='<div class="glist">';
          html +='<img src="'+ img +'">';
          html +='<input type="hidden" name="'+ id +'['+ num +'][id]" value="'+ imgID +'">';
          html +='<input type="hidden" name="'+ id +'['+ num +'][type]" value="video">';
          html +='<b>Video Embeded</b><br>';
          html +='<textarea name="'+ id +'['+ num +'][desc]">'+ vid +'</textarea>';
          html +='<div class="close"></div></div>';
          target.append(html);
          parent.hide();
          parent.find('textarea').val(' ');
          parent.find('.video-target').html('');
          return false;
        });

        $(this).find('.gallery-lists').sortable();
      }
    );
  }
})(jQuery);
