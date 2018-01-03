/****
@since 1.2.0
***/
jQuery( document ).ready(function( $ ) {
	var delay = (function(){
		var timer = 0;
		return function(callback, ms){
			clearTimeout (timer);
			timer = setTimeout(callback, ms);
		}
	})();
	var searchRequest = false,
		enterActive = true;
	$('input[name="s"]').on("input", function() {
		var s = this.value;
		delay(function(){
		if( s.length <= 2 ) {
			$(mtvSearch.area).hide();
			$(mtvSearch.form).find('i').removeClass('icon-magnifying-glass').removeClass('');
			return;
		}
		if(!searchRequest) {
	    	searchRequest = true;
			$(mtvSearch.form).find('i').addClass('fa fa-refresh').addClass('');
			$(mtvSearch.area).find('ul').addClass('process').addClass('noselect');
			$.ajax({
		      type:'GET',
		      url: mtvSearch.api,
		      data: 'keyword=' + s + '&nonce=' + mtvSearch.nonce,
		      dataType: "json",
		      success: function(data){
				if( data['error'] ) {
					$(mtvSearch.area).hide();
					return;
				}
				$(mtvSearch.area).show();
					var res = '<span class="icon-search-1">' + s + '</span>',
						moreReplace = mtvSearch.more.replace('%s', res),
						moreText = '<li class="ctsx"><a class="more" href="javascript:;" onclick="document.getElementById(\'searchform\').submit();">' + moreReplace + '</a></li>';
						moreText2 = '';
					var items = [];
					$.each( data, function( key, val ) {
					  	name = '';
					  	date = '';
					  	imdb = '';
					  	if( val['extra']['date'] !== false )
					  		date = "<span class='release'>(" + val['extra']['date'] + ")</span>";

					  	if( val['extra']['names'] !== false )
					  		name = val['extra']['names'];

					  	if( val['extra']['imdb'] !== false )
					  		imdb = "<div class='imdb'><span class='fa fa-star'></span> " + val['extra']['imdb'] + "</div>";

					   	items.push("<li id='" + key + "'><a href='" + val['url'] + "' class='clearfix'><div class='poster'><img src='" + val['img'] + "' /></div><div class='title'>" + val['title'] + "</div>" + imdb + "</a></li>");
					});
					$(mtvSearch.area).html('<ul>' + items.join("") + moreText + '</ul>');
				},
				complete: function() {
			      	searchRequest = false;
			      	enterActive = false;
					$(mtvSearch.form).find('i').removeClass('fa fa-refresh').removeClass('');
					$(mtvSearch.area).find('ul').removeClass('process').removeClass('noselect');
				}
		   	});
		}	 
		}, 500 ); 
	});
	$(document).on("keypress", "#search-form", function(event) { 
		if( enterActive ) {
			return event.keyCode != 13;
		}
	});
	$(document).click(function() {
		var target = $(event.target);
		if ($(event.target).closest('input[name="s"]').length == 0) {
			$(mtvSearch.area).hide();
		} else {
			$(mtvSearch.area).show();
		}
		if ($(event.target).closest('.lglossary').length == 0) {
			 $('.item-container').show();
			$('.items_glossary').hide();
			
			$('.lglossary').removeClass('active')
		} else {
			$('.items_glossary').show();
		}
	});
    // Glosarry Ajax
    $(document).on('click', '.lglossary', function() {
        var term = $(this).data('glossary')
        var type = $(this).data('type')
        $('.lglossary').removeClass('active')
        $(this).addClass('active')
        $('.items_glossary').show()
		$('.item-container').hide();
        $('.items_glossary').html( '<div class="load"><div id="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>')
        $.ajax({
            type:'GET',
            url: mtvSearch.glossary,
            data: 'term=' + term + '&nonce=' + mtvSearch.nonce + '&type=' + type,
            dataType: "json",
            success: function(data){
                if( data['error'] ) {
					$('.item-container').show()
					$('.items_glossary').hide()
                    $('.lglossary').removeClass('active')
					return;
				}
                $('.items_glossary').show();
                var items = [];
                $.each( data, function( key, val ) {
					imdb = '';
					if( val['imdb'] !== false )
						imdb = "";

					items.push("<div class='item' id='" + key + "'><div class='item-inner'><div class='movie-options'><div class='favorites-add'><i style='font-style:italic;font-size: 18px;font-weight: bold;'>HD</i></div></div><a href='" + val['url'] + "'><div class='movie-play'><i class='icon-controller-play'></i></div><img src='" + val['img'] + "'></a></div><div class='item-details imdb_r'><h2 class='movie-title'>" + val['title'] + "</h2> <div class='b'><div class='bar'> <span title='"+ val['imdb'] +"' style='width: "+ val['imdb']*10 +"%'></span></div><span class='movie-date'>" + val['year'] + "</span></div></div></div>");
                });
				$('.items_glossary').html('<div class="items animation-2">' + items.join("") +'</div>');
            }
        });
    });
    $(document).keyup(function(e) {
        if (e.keyCode == 27) {
		    $('.item-container').show()
            $('.items_glossary').hide()
            $('.items_glossary').html(' ')
            $('.lglossary').removeClass('active')
        }
    });
});