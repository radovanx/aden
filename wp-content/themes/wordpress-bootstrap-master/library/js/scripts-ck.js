/* imgsizer (flexible images for fluid sites) */function addTwitterBSClass(e) {
    var t = $(e).attr("title");
    if (t) {
        var n = t.split(" ");
        if (n[0]) {
            var r = parseInt(n[0]);
            r > 0 && $(e).addClass("label");
            r == 2 && $(e).addClass("label label-info");
            r > 2 && r < 4 && $(e).addClass("label label-success");
            r >= 5 && r < 10 && $(e).addClass("label label-warning");
            r >= 10 && $(e).addClass("label label-important")
        }
    } else
        $(e).addClass("label");
    return!0
}
var imgSizer = {Config: {imgCache: [], spacer: "/path/to/your/spacer.gif"}, collate: function(e) {
        var t = document.all && !window.opera && !window.XDomainRequest ? 1 : 0;
        if (t && document.getElementsByTagName) {
            var n = imgSizer, r = n.Config.imgCache, i = e && e.length ? e : document.getElementsByTagName("img");
            for (var s = 0; s < i.length; s++) {
                i[s].origWidth = i[s].offsetWidth;
                i[s].origHeight = i[s].offsetHeight;
                r.push(i[s]);
                n.ieAlpha(i[s]);
                i[s].style.width = "100%"
            }
            r.length && n.resize(function() {
                for (var e = 0; e < r.length; e++) {
                    var t = r[e].offsetWidth / r[e].origWidth;
                    r[e].style.height = r[e].origHeight * t + "px"
                }
            })
        }
    }, ieAlpha: function(e) {
        var t = imgSizer;
        e.oldSrc && (e.src = e.oldSrc);
        var n = e.src;
        e.style.width = e.offsetWidth + "px";
        e.style.height = e.offsetHeight + "px";
        e.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + n + "', sizingMethod='scale')";
        e.oldSrc = n;
        e.src = t.Config.spacer
    }, resize: function(e) {
        var t = window.onresize;
        typeof window.onresize != "function" ? window.onresize = e : window.onresize = function() {
            t && t();
            e()
        }
    }};
jQuery(document).ready(function(e) {
    e("#tag-cloud a").each(function() {
        addTwitterBSClass(this);
        return!0
    });
    e("p.tags a").each(function() {
        addTwitterBSClass(this);
        return!0
    });
    e("ol.commentlist a.comment-reply-link").each(function() {
        e(this).addClass("btn btn-success btn-mini");
        return!0
    });
    e("#cancel-comment-reply-link").each(function() {
        e(this).addClass("btn btn-danger btn-mini");
        return!0
    });
    e("article.post").hover(function() {
        e("a.edit-post").show()
    }, function() {
        e("a.edit-post").hide()
    });
    e("[placeholder]").parents("form").submit(function() {
        e(this).find("[placeholder]").each(function() {
            var t = e(this);
            t.val() == t.attr("placeholder") && t.val("")
        })
    });
    e(".alert-message").alert();
    e(".dropdown-toggle").dropdown()
});