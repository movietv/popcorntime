function seriesInfo(e, s) {
    var a = baseUrl + e + "/season/" + s + apikey + language + ImgLang;
    $.getJSON(a, function(s) {
        $(".episodes").empty();
        for (var a = 0; a < s.episodes.length; a++) {
            var i = (s.name, s.overview, s.season_number);
            $(".poster_path").empty();
            var o = "<div class='poster fadein' style='background-image: url(" + ("https://image.tmdb.org/t/p/w185/" + s.poster_path) + ");'></div>";
            "<div class='poster fadein' style='background-image: url(https://image.tmdb.org/t/p/w185/null);'></div>" == o && (o = "<div class='poster fadein' style='background-image: url(" + PosterNull + ");'></div>"), $(".poster_path").append("" + o);
            var d = s.episodes[a].name;
            "" === d && (d = episodeSlug + "&nbsp;" + s.episodes[a].episode_number);
            var n = s.episodes[a].episode_number;
            s.episodes[a].overview, s.episodes[a].air_date, $(".episodes").append("<div data-episode_id='" + n + "' data-episode_num='" + n + "' onclick='seriesShow(" + e + "," + i + "," + s.episodes[a].episode_number + ")' value='" + s.episodes[a].episode_number + "'class='row episode'><a href='#'><span class='episode_num'>" + n + "</span>&nbsp;&nbsp;<span class='episode_title'>" + d + "</span><div class='pseudo_click_listener'></div></a></div>"), $(".row.episode").click(function(e) {
                e.preventDefault(), $(".row.episode").removeClass("activated"), $(this).addClass("activated")
            }), $('.row.episode[data-episode_id="1"]').addClass("activated")
        }
    })
}
$(".slider .close").click(function() {
    window.location.href = "" + Home
}), $.getJSON(dataUrl, function(e) {
    var s = (e.name, e.episode_run_time, e.overview);
    new Date(e.last_air_date).getFullYear(), e.seasons.length, "" === s && (s = "" + Excerpt), $(".seasons").empty();
    for (var a = 0; a < e.seasons.length; a++) $(".seasons").append("<div class='row season' data-season='" + e.seasons[a].season_number + "' onclick='seriesInfo(" + id + "," + e.seasons[a].season_number + ")' value='" + e.seasons[a].season_number + "'><a href='#'>" + seasonSlug + " " + e.seasons[a].season_number + "</a></div>");
    $(".row.season").click(function(e) {
        e.preventDefault(), $(".season").removeClass("activated"), $(this).addClass("activated")
    }), $('.row.season[data-season="1"]').addClass("activated");
    var i = [];
    $.each(e.images.backdrops, function(e, s) {
        $(".backdrop_img");
        var a = s.file_path;
        i.push("<div class='img' style='background-image: url(https://image.tmdb.org/t/p/original" + a + ");'></div>")
    }), $(i.join("")).appendTo(".backdrop_img"), $(".backdrop_img > div:gt(0)").hide(), setInterval(function() {
        $(".backdrop_img > div:first").fadeOut(5e3).next().fadeIn(500).end().appendTo(".backdrop_img")
    }, 5e3)
});