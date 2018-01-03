//var encodeUrl = "https://jsonp.afeld.me/?callback=&url="+encodeURIComponent(soundUrl)+"";
    //$.getJSON(encodeUrl, function(data) {
        //var soundID = data[0].id;
       //$("div.title_info.genre").append("&nbsp;&nbsp;<a target='_blank' rel='nofollow' href='http://thesoundtrackdb.com/#/soundtracks/"+soundID+"'>Soundtrack</a>");
    //});
function string_to_slug(e) {
    e = (e = e.replace(/^\s+|\s+$/g, "")).toLowerCase();
    for (var t = "אבהגטיכךלםןמעףצפשתüûסח·/_,:;", a = 0, i = t.length; a < i; a++) e = e.replace(new RegExp(t.charAt(a), "g"), "aaaaeeeeiiiioooouuuunc------".charAt(a));
    return e = e.replace(/[^a-z0-9 -]/g, "").replace(/\s+/g, "-").replace(/-+/g, "-")
}

function setURL(e) {
    document.getElementById("link").href = e
}

function hide_me(e) {
    var t = document.getElementById("player"),
        a = document.getElementById("cls_btn");
    return t.style.display = "none", a.style.display = "none", void 0 == e && window.open(sponsor_url, "_blank"), !1
}
    player = "<div id='player'><div class='bottone'><a href='" + watch + "' target='_blank'><img src='http://oi63.tinypic.com/wapyqr.jpg' /></a><a href='#' target='_blank' id='cls_btn' onClick='hide_me();return false;'><img style='border:none;' src='http://i65.tinypic.com/2vlwrdf_th.png'/></a></div></div>";
function _share(e) {
    switch (e) {
        default:
            case "fb":
            var t = screen.height / 2 - 175,
            a = screen.width / 2 - 260;window.open("http://www.facebook.com/sharer.php?s=100&p[url]=" + encodeURIComponent(location.href), "sharer", "top=" + t + ",left=" + a + ",toolbar=0,status=0,width=520,height=350");
        break;
        case "tw":
                var i = ($(window).width() - 575) / 2,
                o = ($(window).height() - 400) / 2,
                n = "http://twitter.com/share?text=" + encodeURIComponent(location.href),
                r = "status=1,width=575,height=400,top=" + o + ",left=" + i;window.open(n, "twitter", r);
            break;
        case "goo":
                window.open("https://plus.google.com/share?url=" + encodeURIComponent(location.href), "gplusshare", "width=600,height=400,left=" + (screen.availWidth / 2 - 225) + ",top=" + (screen.availHeight / 2 - 150))
    }
}
$.getJSON(tmdb, function(e) {
    var t = e.credits.cast,
        a = [];
    $.each(t.slice(0, 7), function(e, t) {
        var i = string_to_slug(t.name),
            o = "https://image.tmdb.org/t/p/w185/" + t.profile_path;
        "https://image.tmdb.org/t/p/w185/null" === o && (o = noImg), a.push('<div class="actor"><a href="' + site + "/" + actPerm + "/" + i + '/"  rel="tag"><img src="' + o + '" alt="' + t.name + '" title="' + t.name + '"></a></div>')
    }), $(a.join("")).appendTo(".actors")
}), $.getJSON(path, function(e) {
    var t = e.crew,
        a = [];
    $.each(t, function(e, t) {
        if ("Directing" == t.department) {
            var i = string_to_slug(t.name),
                o = "https://image.tmdb.org/t/p/w185/" + t.profile_path;
            "https://image.tmdb.org/t/p/w185/null" === o && (o = noImg), a.push('<div class="actor"><a href="' + site + "/" + dirPerm + "/" + i + '/" rel="tag"><img style="opacity:1;" src="' + o + '" title="' + t.name + '" alt="' + t.name + '"></a></div>')
        }
    }), $(a.join("")).slice(0, 1).prependTo(".actors")
}), $.getJSON(images, function(e) {
    var t = [];
    $.each(e.backdrops, function(e, a) {
        $(".backdrop_img");
        var i = a.file_path;
        t.push("<div class='img' style='background-image: url(https://image.tmdb.org/t/p/original" + i + ");'></div>")
    }), $(t.join("")).appendTo(".backdrop_img"), $(".backdrop_img > div:gt(0)").hide(), setInterval(function() {
        $(".backdrop_img > div:first").fadeOut(5e3).next().fadeIn(500).end().appendTo(".backdrop_img")
    }, 5e3)
}), $(function() {
    $(".stop").click(function() {
        $("#link").attr("href", $("link").attr("href"))
    })
}), $(".quality_selector").click(function(e) {
    e.preventDefault(), $(".quality_selector").removeClass("activated"), $(this).addClass("activated")
});
var tmdb = apiUrl + movie + "?api_key=" + apiKey + "&append_to_response=" + response,
    path = apiUrl + movie + "/" + response + "?&api_key=" + apiKey,
    noImg = "https://via.placeholder.com/54x75?text=no+image",
    images = apiUrl + movie + "/images?api_key=" + apiKey,
    player = "<div id='player'><div class='bottone'><a href='" + watch + "' target='_blank'><img src='http://oi63.tinypic.com/wapyqr.jpg' /></a><a href='#' target='_blank' id='cls_btn' onClick='hide_me();return false;'><img style='border:none;' src='http://i65.tinypic.com/2vlwrdf_th.png'/></a></div></div>";
$(".slider .close").click(function() {
    window.location.href = site
});

setTimeout(function() {
    document.getElementById("share_cont").className = "share_on"
}, 1e3);
$(".slider .close").click(function() {
    window.location.href = site
});