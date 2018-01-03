<?php
 function custom_admin_js() {
    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script>
	$(\'input[name=Movie]\').click(function() {
	var coc = $(\'input[name=Checkbx2]\').get(0).value;
	// Send Request
    $.getJSON("'.apiurl.'/?i=" + coc, function(data) {
	    var valDir = "";
		var valAct = "";
		$.each(data, function(key, val) {
			  $(\'input[name=\' +key+ \']\').val(val); 
			  if(key == "Director"){
				$.each( data.Director, function( i, item ) {
				valDir += item + ",";
			  });
			  }
			  if(key == "Actors"){
				$.each( data.Actors, function( i, item ) {
				valAct += item + ",";
			  });
			  }
			  if(key == "Country"){
				$(\'#new-tag-'.country.'\').val(val);
			  }
			  if(key == "Year"){
				$(\'#new-tag-'.year.'\').val(val);
			  }
		});
		//$(\'#new-tag-'.director.'\').val(valDir);
		$(\'#new-tag-'.actors.'\').val(valAct);
		alert(\'OTTIMO!\');
	}); 
});
</script>

<script>
	$(\'input[name=Movie]\').click(function() {
	var input = $(\'input[name=Checkbx2]\').get(0).value;
	var url = "https://api.themoviedb.org/3/movie/";
	var agregar = "?append_to_response=credits,images,trailers";
	var idioma = "&language='.apilanguage.'&include_image_language='.apilanguage.',null";
	var apikey = "&api_key='.apikey.'";
	// Send Request
    $.getJSON( url + input + agregar + idioma + apikey, function(tmdbdata) {   
		var valTit = "";
		var valPlo = "";
		var valImg = "";
		var valBac = "";
		$.each(tmdbdata, function(key, val) {
			$(\'input[name=\' +key+ \']\').val(val); 
			  
			  if(key == "title"){
				valTit+= ""+val+"";
			  }
			  if(key == "overview"){
				valPlo+= ""+val+"";
			  }
			  if(key == "poster_path"){
				valImg+= "https://image.tmdb.org/t/p/w185"+val+"";
			  }
			  if(key == "backdrop_path"){
				valBac+= "https://image.tmdb.org/t/p/w780"+val+"";
			  }
if(key == "genres"){
			var genr = "";
			var genr1_arr=[];
			jQuery.each( tmdbdata.genres, function( i, item ) {
       	 		genr += "" + item.name + ", ";
				genr1 = item.name;
				jQuery(\'input[name=newcategory]\').val( genr1 );
				jQuery(\'#category-add-submit\').trigger("click");
				jQuery(\'#category-add-submit\').prop("disabled", false);
				jQuery(\'input[name=newcategory]\').val("");
				genr1_arr.push(genr1);
				});
			jQuery(\'input[name=\' +key+ \']\').val( genr );
			jQuery(\'#categorychecklist .selectit\').each(function(){
					jQuery(this).children(\'input[type=checkbox]\').prop("checked",false);	
			});
			jQuery(\'#categorychecklist .selectit\').each(function(){
					gen = jQuery.trim(jQuery(this).text());
					if(jQuery.inArray(gen,genr1_arr) !== -1)
					{
						console.log("Perfect!");
						jQuery(this).children(\'input[type=checkbox]\').prop("checked",true);
					}
				});
		}	
if(key == "trailers"){
			var tral = "";
			$.each( tmdbdata.trailers.youtube, function( i, item ) {
       	 		tral += "[" + item.source + "]";
    		});
			$(\'input[name="youtube_id"]\').val( tral.slice(0,13) );
}
if(key == "images"){
			var imgt = "";
			$.each( tmdbdata.images.backdrops, function( i, item ) {
				imgt += "https://image.tmdb.org/t/p/w300" + item.file_path + "\n";	
    		});
			$(\'textarea[name="images"]\').val( imgt );
}

$.getJSON( url + input + "/credits?" + apikey, function(tmdbdata) {
	$.each(tmdbdata, function(key, val) {
		if(key == "cast"){
			var valCast = "";
			var cast = tmdbdata.cast;
			$.each(cast.slice(0,8), function( i, item ) {
			//valCast += "" + item.profile_path + ", "; //
			valCast += "https://image.tmdb.org/t/p/w185" + item.profile_path + "\n";	
		});
			$(\'textarea[name="cast"]\').val( valCast );
		} else if (key == "crew") {
            var crew_d = crew_w = crew_a = "";
            $.each(tmdbdata.crew, function(i, item) {
			
                if (item.department == "Directing") {
			if(i>0) return false;
            crew_d += "https://image.tmdb.org/t/p/w185" + item.profile_path + "\n";
			crew_w += item.name + ",";
                }
            });
			$(\'#new-tag-'.director.'\').val(crew_w);
            $(\'textarea[name="crew"]\').val(crew_d);
        }
	});
});
		});
		$(\'#title\').val(valTit);
		$(\'#excerpt\').val(valPlo);
		$(\'#bptfu_input\').val(valImg);
		$(\'input[name="Poster"]\').val(valImg);
	}); 
});
</script>
	
	
	

	
	
	
	
	
	
	
	
	

<script>
	$(\'input[name=TV]\').click(function() {
	var input = $(\'input[name=Checkbx3]\').get(0).value;
	var imdb_id = $(\'input[name=imdb_id]\').get(0).value;
	var url = "https://api.themoviedb.org/3/tv/";
	var agregar = "?append_to_response=credits,external_ids,images,trailers,content_ratings";
	var idioma = "&language='.apilanguage.'&include_image_language='.apilanguage.',null";
	var apikey = "&api_key='.apikey.'";
	// Send Request
    $.getJSON( url + input + agregar + idioma + apikey, function(tmdbdata) {   
		var valNam = "";
		var valPlo = "";
		var valImg = "";
		var valBac = "";
		var valEpi = "";
		var valImd = "";
		$.each(tmdbdata, function(key, val) {
			$(\'input[name=\' +key+ \']\').val(val); 
			  
			  if(key == "title"){
				valTit+= ""+val+"";
			  }
			  if(key == "name"){
				valNam+= ""+val+"";
			  }
			  if(key == "overview"){
				valPlo+= ""+val+"";
			  }
			  if(key == "poster_path"){
				valImg+= "https://image.tmdb.org/t/p/w185"+val+"";
			  }
			  if(key == "backdrop_path"){
				valBac+= "https://image.tmdb.org/t/p/w780"+val+"";
			  }
        if (key == "networks") {
            var net = "";
            $.each(tmdbdata.networks, function(i, item) {
                net += item.name + ",";
            });
            $(\'#new-tag-'.network.'\').val(net);
        }
		if(key == "episode_run_time"){
				$.each( tmdbdata.episode_run_time, function( i, item ) {
				if(i>0) return false;
				valEpi+= item + " min";
			  });
			  $(\'input[name="Runtime"]\').val( valEpi );
			  }
        if (key == "created_by") {
            var crea = crea_2 = "";
            $.each(tmdbdata.created_by, function(i, item) {
                crea += item.name + ",";
                crea_2 += "https://image.tmdb.org/t/p/w185" + item.profile_path + "\n";
            });
            $(\'#new-tag-'.creator.'\').val(crea);
			$(\'textarea[name="crew"]\').val(crea_2);
        }
if(key == "genres"){
			var genr = "";
			var genr1_arr=[];
			jQuery.each( tmdbdata.genres, function( i, item ) {
       	 		genr += "" + item.name + ", ";
				genr1 = item.name;
			    genrtv = "'.tvshows.'";
                if (genr1 === "Action & Adventure") {
                 genr1 = "'.Adventure.'";
                }
				else if (genr1 === "Sci-Fi & Fantasy") {
				 genr1 = "'.SciFi.'";
                }
				jQuery(\'input[name=newcategory]\').val( genr1 );
				jQuery(\'input[name=newcategory]\').val( genrtv );
				jQuery(\'#category-add-submit\').trigger("click");
				jQuery(\'#category-add-submit\').prop("disabled", false);
				jQuery(\'input[name=newcategory]\').val("");
				jQuery(\'input[name=newcategory]\').val( genrtv );
				genr1_arr.push(genr1);
				genr1_arr.push(genrtv);
				});

			jQuery(\'input[name=\' +key+ \']\').val( genrtv );
			jQuery(\'input[name=\' +key+ \']\').val( genr );
			jQuery(\'#categorychecklist .selectit\').each(function(){
					jQuery(this).children(\'input[type=checkbox]\').prop("checked",false);	
			});
			jQuery(\'#categorychecklist .selectit\').each(function(){
					gen = jQuery.trim(jQuery(this).text());
					if(jQuery.inArray(gen,genr1_arr) !== -1)
					{
						jQuery(this).children(\'input[type=checkbox]\').prop("checked",true);
					}
				});
		}	


if(key == "images"){
			var imgt = "";
			$.each( tmdbdata.images.backdrops, function( i, item ) {
				imgt += "https://image.tmdb.org/t/p/w300" + item.file_path + "\n";	
    		});
			$(\'textarea[name="images"]\').val( imgt );
}
if(key == "external_ids"){
          var imdb_id = tmdbdata.external_ids.imdb_id;
		  $(\'input[name="imdb_id"]\').val( imdb_id );
}
if(key == "credits"){
			var valCast = valCast2 = "";
			var cast = tmdbdata.credits.cast;
			$.each(cast.slice(0,4), function( i, item ) {
			valCast += "https://image.tmdb.org/t/p/w185" + item.profile_path + "\n";
			valCast2 += "" + item.name + ", ";
		});
			$(\'textarea[name="cast"]\').val( valCast );
			$(\'#new-tag-'.actors.'\').val(valCast2);
		} else {
			var crew_d = crew_w = crew_a = "";
            $.each(tmdbdata.credits.crew, function(i, item) {
			
            if (item.department == "Writing") {
			//if(i>0) return false;
            crew_d += "https://image.tmdb.org/t/p/w185" + item.profile_path + "\n";
			crew_w += item.name + ",";
                }
            });
			$(\'#new-tag-'.director.'\').val(crew_w);
            //$(\'textarea[name="crew"]\').val(crew_d);
}





if(key == "first_air_date"){
			$(\'input[name=" +key+ "]\').val( val.slice(0,4) );
			$(\'#new-tag-'.year.'\').val( val.slice(0,4) ); //año
		}


$.getJSON( url + input + "/videos?" + apikey, function(tmdbdata) {
	$.each(tmdbdata, function(key, val) {
			var tral = "";
			$.each( tmdbdata.results, function( i, item ) {
       	 		tral += "[" + item.key + "]";
    		});
			$(\'input[name=youtube_id]\').val( tral.slice(0,13) );
	});
});

$.getJSON("http://www.omdbapi.com/?apikey='.omdb.'&plot=full&type=series&i=" + imdb_id, function(data) {
	    var valDir = "";
		var valAct = "";
		$.each(data, function(key, val) {
			  $(\'input[name=\' +key+ \']\').val(val); 
			  if(key == "Director"){
				valDir+= " "+val+",";
			  }
			  if(key == "Actors"){
				valAct+= " "+val+",";
			  }
			  if(key == "Country"){
				//$(\'#new-tag-'.country.'\').val(val);
			  }
			  if(key == "Year"){
				//$(\'#new-tag-'.year.'\').val( val.slice(0,4) ); 
			  }

		});
		//$(\'#new-tag-'.director.'\').val(valDir);
		//$(\'#new-tag-'.actors.'\').val(valAct);

	});





});
		$(\'#title\').val(valNam);
		$(\'#excerpt\').val(valPlo);
		$(\'#bptfu_input\').val(valImg);
		
	}); 
	alert(\'Great!\');
});
</script>';
}
?>