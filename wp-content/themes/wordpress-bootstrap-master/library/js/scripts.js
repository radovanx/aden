/* imgsizer (flexible images for fluid sites) */
var imgSizer = {Config: {imgCache: [], spacer: "/path/to/your/spacer.gif"}, collate: function(aScope) {
        var isOldIE = (document.all && !window.opera && !window.XDomainRequest) ? 1 : 0;
        if (isOldIE && document.getElementsByTagName) {
            var c = imgSizer;
            var imgCache = c.Config.imgCache;
            var images = (aScope && aScope.length) ? aScope : document.getElementsByTagName("img");
            for (var i = 0; i < images.length; i++) {
                images[i].origWidth = images[i].offsetWidth;
                images[i].origHeight = images[i].offsetHeight;
                imgCache.push(images[i]);
                c.ieAlpha(images[i]);
                images[i].style.width = "100%";
            }
            if (imgCache.length) {
                c.resize(function() {
                    for (var i = 0; i < imgCache.length; i++) {
                        var ratio = (imgCache[i].offsetWidth / imgCache[i].origWidth);
                        imgCache[i].style.height = (imgCache[i].origHeight * ratio) + "px";
                    }
                });
            }
        }
    }, ieAlpha: function(img) {
        var c = imgSizer;
        if (img.oldSrc) {
            img.src = img.oldSrc;
        }
        var src = img.src;
        img.style.width = img.offsetWidth + "px";
        img.style.height = img.offsetHeight + "px";
        img.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + src + "', sizingMethod='scale')"
        img.oldSrc = src;
        img.src = c.Config.spacer;
    }, resize: function(func) {
        var oldonresize = window.onresize;
        if (typeof window.onresize != 'function') {
            window.onresize = func;
        } else {
            window.onresize = function() {
                if (oldonresize) {
                    oldonresize();
                }
                func();
            }
        }
    }}

// add twitter bootstrap classes and color based on how many times tag is used
function addTwitterBSClass(thisObj) {
    var title = jQuery(thisObj).attr('title');
    if (title) {
        var titles = title.split(' ');
        if (titles[0]) {
            var num = parseInt(titles[0]);
            if (num > 0)
                jQuery(thisObj).addClass('label label-default');
            if (num == 2)
                jQuery(thisObj).addClass('label label-info');
            if (num > 2 && num < 4)
                jQuery(thisObj).addClass('label label-success');
            if (num >= 5 && num < 10)
                jQuery(thisObj).addClass('label label-warning');
            if (num >= 10)
                jQuery(thisObj).addClass('label label-important');
        }
    }
    else
        jQuery(thisObj).addClass('label');
    return true;
}

// as the page loads, call these scripts
jQuery(document).ready(function($) {

    // modify tag cloud links to match up with twitter bootstrap
    $("#tag-cloud a").each(function() {
        addTwitterBSClass(this);
        return true;
    });

    $("p.tags a").each(function() {
        addTwitterBSClass(this);
        return true;
    });

    $("ol.commentlist a.comment-reply-link").each(function() {
        $(this).addClass('btn btn-success btn-mini');
        return true;
    });

    $('#cancel-comment-reply-link').each(function() {
        $(this).addClass('btn btn-danger btn-mini');
        return true;
    });

    $('article.post').hover(function() {
        $('a.edit-post').show();
    }, function() {
        $('a.edit-post').hide();
    });

    // Input placeholder text fix for IE
    // $('[placeholder]').focus(function() {
    //   var input = $(this);
    //   if (input.val() == input.attr('placeholder')) {
    // 	input.val('');
    // 	input.removeClass('placeholder');
    //   }
    // }).blur(function() {
    //   var input = $(this);
    //   if (input.val() == '' || input.val() == input.attr('placeholder')) {
    // 	input.addClass('placeholder');
    // 	input.val(input.attr('placeholder'));
    //   }
    // }).blur();

    // Prevent submission of empty form
    $('[placeholder]').parents('form').submit(function() {
        $(this).find('[placeholder]').each(function() {
            var input = $(this);
            if (input.val() == input.attr('placeholder')) {
                input.val('');
            }
        })
    });

    // $('#s').focus(function(){
    // 	if( $(window).width() < 940 ){
    // 		$(this).animate({ width: '200px' });
    // 	}
    // });

    // $('#s').blur(function(){
    // 	if( $(window).width() < 940 ){
    // 		$(this).animate({ width: '100px' });
    // 	}
    // });

    $('.alert-message').alert();

    $('.dropdown-toggle').dropdown();

});
/*!
 * TableSorter 2.16.4 min - Client-side table sorting with ease!
 * Copyright (c) 2007 Christian Bach
 */
!function(g) {
    g.extend({tablesorter: new function() {
            function d() {
                var b = arguments[0], a = 1 < arguments.length ? Array.prototype.slice.call(arguments) : b;
                if ("undefined" !== typeof console && "undefined" !== typeof console.log)
                    console[/error/i.test(b) ? "error" : /warn/i.test(b) ? "warn" : "log"](a);
                else
                    alert(a)
            }
            function u(b, a) {
                d(b + " (" + ((new Date).getTime() - a.getTime()) + "ms)")
            }
            function n(b) {
                for (var a in b)
                    return!1;
                return!0
            }
            function p(b, a, c) {
                if (!a)
                    return"";
                var h = b.config, e = h.textExtraction || "", f = "", f = "basic" === e ? g(a).attr(h.textAttribute) || a.textContent || a.innerText || g(a).text() || "" : "function" === typeof e ? e(a, b, c) : "object" === typeof e && e.hasOwnProperty(c) ? e[c](a, b, c) : a.textContent || a.innerText || g(a).text() || "";
                return g.trim(f)
            }
            function s(b) {
                var a = b.config, c = a.$tbodies = a.$table.children("tbody:not(." + a.cssInfoBlock + ")"), h, e, t, k, l, m, g, n, w = 0, q = "", r = c.length;
                if (0 === r)
                    return a.debug ? d("Warning: *Empty table!* Not building a parser cache") : "";
                a.debug && (n = new Date, d("Detecting parsers for each column"));
                for (e = []; w < r; ) {
                    h = c[w].rows;
                    if (h[w])
                        for (t = h[w].cells.length, k = 0; k < t; k++) {
                            l = a.$headers.filter(":not([colspan])");
                            l = l.add(a.$headers.filter('[colspan="1"]')).filter('[data-column="' + k + '"]:last');
                            m = a.$headers.index(l);
                            m = a.headers[m];
                            g = f.getParserById(f.getData(l, m, "sorter"));
                            a.empties[k] = f.getData(l, m, "empty") || a.emptyTo || (a.emptyToBottom ? "bottom" : "top");
                            a.strings[k] = f.getData(l, m, "string") || a.stringTo || "max";
                            if (!g)
                                a:{
                                    l = b;
                                    m = h;
                                    g = -1;
                                    for (var s = k, A = void 0, x = f.parsers.length, y = !1, F = "", A = !0; "" === F && A; )
                                        g++, m[g] ? (y = m[g].cells[s], F = p(l, y, s), l.config.debug && d("Checking if value was empty on row " + g + ", column: " + s + ': "' + F + '"')) : A = !1;
                                    for (; 0 <= --x; )
                                        if ((A = f.parsers[x]) && "text" !== A.id && A.is && A.is(F, l, y)) {
                                            g = A;
                                            break a
                                        }
                                    g = f.getParserById("text")
                                }
                            a.debug && (q += "column:" + k + "; parser:" + g.id + "; string:" + a.strings[k] + "; empty: " + a.empties[k] + "\n");
                            e.push(g)
                        }
                    w += e.length ? r : 1
                }
                a.debug && (d(q ? q : "No parsers detected"), u("Completed detecting parsers", n));
                a.parsers = e
            }
            function x(b) {
                var a, c, h, e, t, k, l, m, z, n, w, q = b.config, r = q.$table.children("tbody"), s = q.parsers;
                q.cache = {};
                if (!s)
                    return q.debug ? d("Warning: *Empty table!* Not building a cache") : "";
                q.debug && (m = new Date);
                q.showProcessing && f.isProcessing(b, !0);
                for (t = 0; t < r.length; t++)
                    if (w = [], a = q.cache[t] = {normalized: []}, !r.eq(t).hasClass(q.cssInfoBlock)) {
                        z = r[t] && r[t].rows.length || 0;
                        for (h = 0; h < z; ++h)
                            if (n = {child: []}, k = g(r[t].rows[h]), l = [], k.hasClass(q.cssChildRow) && 0 !== h)
                                c = a.normalized.length - 1, a.normalized[c][q.columns].$row = a.normalized[c][q.columns].$row.add(k), k.prev().hasClass(q.cssChildRow) || k.prev().addClass(f.css.cssHasChild), n.child[c] = g.trim(k[0].textContent || k[0].innerText || k.text() || "");
                            else {
                                n.$row = k;
                                n.order = h;
                                for (e = 0; e < q.columns; ++e)
                                    "undefined" === typeof s[e] ? q.debug && d("No parser found for cell:", k[0].cells[e], "does it have a header?") : (c = p(b, k[0].cells[e], e), c = s[e].format(c, b, k[0].cells[e], e), l.push(c), "numeric" === (s[e].type || "").toLowerCase() && (w[e] = Math.max(Math.abs(c) || 0, w[e] || 0)));
                                l[q.columns] = n;
                                a.normalized.push(l)
                            }
                        a.colMax = w
                    }
                q.showProcessing && f.isProcessing(b);
                q.debug && u("Building cache for " + z + " rows", m)
            }
            function y(b, a) {
                var c = b.config, h = c.widgetOptions, e = b.tBodies, t = [], k = c.cache, d, m, z, p, w, q;
                if (n(k))
                    return c.appender ? c.appender(b, t) : b.isUpdating ? c.$table.trigger("updateComplete", b) : "";
                c.debug && (q = new Date);
                for (w = 0; w < e.length; w++)
                    if (d = g(e[w]), d.length && !d.hasClass(c.cssInfoBlock)) {
                        z = f.processTbody(b, d, !0);
                        d = k[w].normalized;
                        m = d.length;
                        for (p = 0; p < m; p++)
                            t.push(d[p][c.columns].$row), c.appender && (!c.pager || c.pager.removeRows && h.pager_removeRows || c.pager.ajax) || z.append(d[p][c.columns].$row);
                        f.processTbody(b, z, !1)
                    }
                c.appender && c.appender(b, t);
                c.debug && u("Rebuilt table", q);
                a || c.appender || f.applyWidget(b);
                b.isUpdating && c.$table.trigger("updateComplete", b)
            }
            function C(b) {
                return/^d/i.test(b) || 1 === b
            }
            function D(b) {
                var a, c, h, e, t, k, l, m = b.config;
                m.headerList = [];
                m.headerContent = [];
                m.debug && (l = new Date);
                m.columns = f.computeColumnIndex(m.$table.children("thead, tfoot").children("tr"));
                e = m.cssIcon ? '<i class="' + (m.cssIcon === f.css.icon ? f.css.icon : m.cssIcon + " " + f.css.icon) + '"></i>' : "";
                m.$headers = g(b).find(m.selectorHeaders).each(function(b) {
                    c = g(this);
                    a = m.headers[b];
                    m.headerContent[b] = g(this).html();
                    t = m.headerTemplate.replace(/\{content\}/g, g(this).html()).replace(/\{icon\}/g, e);
                    m.onRenderTemplate && (h = m.onRenderTemplate.apply(c, [b, t])) && "string" === typeof h && (t = h);
                    g(this).html('<div class="' + f.css.headerIn + '">' + t + "</div>");
                    m.onRenderHeader && m.onRenderHeader.apply(c, [b]);
                    this.column = parseInt(g(this).attr("data-column"), 10);
                    this.order = C(f.getData(c, a, "sortInitialOrder") || m.sortInitialOrder) ? [1, 0, 2] : [0, 1, 2];
                    this.count = -1;
                    this.lockedOrder = !1;
                    k = f.getData(c, a, "lockedOrder") || !1;
                    "undefined" !== typeof k && !1 !== k && (this.order = this.lockedOrder = C(k) ? [1, 1, 1] : [0, 0, 0]);
                    c.addClass(f.css.header + " " + m.cssHeader);
                    m.headerList[b] = this;
                    c.parent().addClass(f.css.headerRow + " " + m.cssHeaderRow).attr("role", "row");
                    m.tabIndex && c.attr("tabindex", 0)
                }).attr({scope: "col", role: "columnheader"});
                B(b);
                m.debug && (u("Built headers:", l), d(m.$headers))
            }
            function E(b, a, c) {
                var h = b.config;
                h.$table.find(h.selectorRemove).remove();
                s(b);
                x(b);
                H(h.$table, a, c)
            }
            function B(b) {
                var a, c, h = b.config;
                h.$headers.each(function(e, t) {
                    c = g(t);
                    a = "false" === f.getData(t, h.headers[e], "sorter");
                    t.sortDisabled = a;
                    c[a ? "addClass" : "removeClass"]("sorter-false").attr("aria-disabled", "" + a);
                    b.id && (a ? c.removeAttr("aria-controls") : c.attr("aria-controls", b.id))
                })
            }
            function G(b) {
                var a, c, h = b.config, e = h.sortList, t = e.length, d = f.css.sortNone + " " + h.cssNone, l = [f.css.sortAsc + " " + h.cssAsc, f.css.sortDesc + " " + h.cssDesc], m = ["ascending", "descending"], n = g(b).find("tfoot tr").children().add(h.$extraHeaders).removeClass(l.join(" "));
                h.$headers.removeClass(l.join(" ")).addClass(d).attr("aria-sort", "none");
                for (a = 0; a < t; a++)
                    if (2 !== e[a][1] && (b = h.$headers.not(".sorter-false").filter('[data-column="' + e[a][0] + '"]' + (1 === t ? ":last" : "")), b.length)) {
                        for (c = 0; c < b.length; c++)
                            b[c].sortDisabled || b.eq(c).removeClass(d).addClass(l[e[a][1]]).attr("aria-sort", m[e[a][1]]);
                        n.length && n.filter('[data-column="' + e[a][0] + '"]').removeClass(d).addClass(l[e[a][1]])
                    }
                h.$headers.not(".sorter-false").each(function() {
                    var b = g(this), a = this.order[(this.count + 1) % (h.sortReset ? 3 : 2)], a = b.text() + ": " + f.language[b.hasClass(f.css.sortAsc) ? "sortAsc" : b.hasClass(f.css.sortDesc) ? "sortDesc" : "sortNone"] + f.language[0 === a ? "nextAsc" : 1 === a ? "nextDesc" : "nextNone"];
                    b.attr("aria-label", a)
                })
            }
            function L(b) {
                if (b.config.widthFixed && 0 === g(b).find("colgroup").length) {
                    var a = g("<colgroup>"), c = g(b).width();
                    g(b.tBodies[0]).find("tr:first").children("td:visible").each(function() {
                        a.append(g("<col>").css("width", parseInt(g(this).width() / c * 1E3, 10) / 10 + "%"))
                    });
                    g(b).prepend(a)
                }
            }
            function M(b, a, c) {
                var h, e, f, d = b.config;
                b = a || d.sortList;
                d.sortList = [];
                g.each(b, function(b, a) {
                    h = [parseInt(a[0], 10), parseInt(a[1], 10)];
                    if (f = d.$headers.filter('[data-column="' + h[0] + '"]:last')[0])
                        d.sortList.push(h), e = g.inArray(h[1], f.order), c && (f.count += 1), f.count = 0 <= e ? e : h[1] % (d.sortReset ? 3 : 2)
                })
            }
            function N(b, a) {
                return b && b[a] ? b[a].type || "" : ""
            }
            function O(b, a, c) {
                var h, e, d, k = b.config, l = !c[k.sortMultiSortKey], m = k.$table;
                m.trigger("sortStart", b);
                a.count = c[k.sortResetKey] ? 2 : (a.count + 1) % (k.sortReset ? 3 : 2);
                k.sortRestart && (e = a, k.$headers.each(function() {
                    this === e || !l && g(this).is("." + f.css.sortDesc + ",." + f.css.sortAsc) || (this.count = -1)
                }));
                e = a.column;
                if (l) {
                    k.sortList = [];
                    if (null !== k.sortForce)
                        for (h = k.sortForce, c = 0; c < h.length; c++)
                            h[c][0] !== e && k.sortList.push(h[c]);
                    h = a.order[a.count];
                    if (2 > h && (k.sortList.push([e, h]), 1 < a.colSpan))
                        for (c = 1; c < a.colSpan; c++)
                            k.sortList.push([e + c, h])
                } else {
                    if (k.sortAppend && 1 < k.sortList.length)
                        for (c = 0; c < k.sortAppend.length; c++)
                            d = f.isValueInArray(k.sortAppend[c][0], k.sortList), 0 <= d && k.sortList.splice(d, 1);
                    if (0 <= f.isValueInArray(e, k.sortList))
                        for (c = 0; c < k.sortList.length; c++)
                            d = k.sortList[c], h = k.$headers.filter('[data-column="' + d[0] + '"]:last')[0], d[0] === e && (d[1] = h.order[a.count], 2 === d[1] && (k.sortList.splice(c, 1), h.count = -1));
                    else if (h = a.order[a.count], 2 > h && (k.sortList.push([e, h]), 1 < a.colSpan))
                        for (c = 1; c < a.colSpan; c++)
                            k.sortList.push([e + c, h])
                }
                if (null !== k.sortAppend)
                    for (h = k.sortAppend, c = 0; c < h.length; c++)
                        h[c][0] !== e && k.sortList.push(h[c]);
                m.trigger("sortBegin", b);
                setTimeout(function() {
                    G(b);
                    I(b);
                    y(b);
                    m.trigger("sortEnd", b)
                }, 1)
            }
            function I(b) {
                var a, c, h, e, d, k, g, m, z, p, w, q = 0, r = b.config, s = r.textSorter || "", v = r.sortList, x = v.length, y = b.tBodies.length;
                if (!r.serverSideSorting && !n(r.cache)) {
                    r.debug && (d = new Date);
                    for (c = 0; c < y; c++)
                        k = r.cache[c].colMax, g = r.cache[c].normalized, g.sort(function(c, d) {
                            for (a = 0; a < x; a++) {
                                e = v[a][0];
                                m = v[a][1];
                                q = 0 === m;
                                if (r.sortStable && c[e] === d[e] && 1 === x)
                                    break;
                                (h = /n/i.test(N(r.parsers, e))) && r.strings[e] ? (h = "boolean" === typeof r.string[r.strings[e]] ? (q ? 1 : -1) * (r.string[r.strings[e]] ? -1 : 1) : r.strings[e] ? r.string[r.strings[e]] || 0 : 0, z = r.numberSorter ? r.numberSorter(c[e], d[e], q, k[e], b) : f["sortNumeric" + (q ? "Asc" : "Desc")](c[e], d[e], h, k[e], e, b)) : (p = q ? c : d, w = q ? d : c, z = "function" === typeof s ? s(p[e], w[e], q, e, b) : "object" === typeof s && s.hasOwnProperty(e) ? s[e](p[e], w[e], q, e, b) : f["sortNatural" + (q ? "Asc" : "Desc")](c[e], d[e], e, b, r));
                                if (z)
                                    return z
                            }
                            return c[r.columns].order - d[r.columns].order
                        });
                    r.debug && u("Sorting on " + v.toString() + " and dir " + m + " time", d)
                }
            }
            function J(b, a) {
                b[0].isUpdating && b.trigger("updateComplete");
                g.isFunction(a) && a(b[0])
            }
            function H(b, a, c) {
                var h = b[0].config.sortList;
                !1 !== a && !b[0].isProcessing && h.length ? b.trigger("sorton", [h, function() {
                        J(b, c)
                    }, !0]) : (J(b, c), f.applyWidget(b[0], !1))
            }
            function K(b) {
                var a = b.config, c = a.$table;
                c.unbind("sortReset update updateRows updateCell updateAll addRows updateComplete sorton appendCache updateCache applyWidgetId applyWidgets refreshWidgets destroy mouseup mouseleave ".split(" ").join(a.namespace + " ")).bind("sortReset" + a.namespace, function(c, e) {
                    c.stopPropagation();
                    a.sortList = [];
                    G(b);
                    I(b);
                    y(b);
                    g.isFunction(e) && e(b)
                }).bind("updateAll" + a.namespace, function(c, e, d) {
                    c.stopPropagation();
                    b.isUpdating = !0;
                    f.refreshWidgets(b, !0, !0);
                    f.restoreHeaders(b);
                    D(b);
                    f.bindEvents(b, a.$headers, !0);
                    K(b);
                    E(b, e, d)
                }).bind("update" + a.namespace + " updateRows" + a.namespace, function(a, c, d) {
                    a.stopPropagation();
                    b.isUpdating = !0;
                    B(b);
                    E(b, c, d)
                }).bind("updateCell" + a.namespace, function(h, e, d, f) {
                    h.stopPropagation();
                    b.isUpdating = !0;
                    c.find(a.selectorRemove).remove();
                    var l, m;
                    l = c.find("tbody");
                    m = g(e);
                    h = l.index(g.fn.closest ? m.closest("tbody") : m.parents("tbody").filter(":first"));
                    var n = g.fn.closest ? m.closest("tr") : m.parents("tr").filter(":first");
                    e = m[0];
                    l.length && 0 <= h && (l = l.eq(h).find("tr").index(n), m = m.index(), a.cache[h].normalized[l][a.columns].$row = n, e = a.cache[h].normalized[l][m] = a.parsers[m].format(p(b, e, m), b, e, m), "numeric" === (a.parsers[m].type || "").toLowerCase() && (a.cache[h].colMax[m] = Math.max(Math.abs(e) || 0, a.cache[h].colMax[m] || 0)), H(c, d, f))
                }).bind("addRows" + a.namespace, function(h, e, d, f) {
                    h.stopPropagation();
                    b.isUpdating = !0;
                    if (n(a.cache))
                        B(b), E(b, d, f);
                    else {
                        e = g(e);
                        var l, m, u, x, w = e.filter("tr").length, q = c.find("tbody").index(e.parents("tbody").filter(":first"));
                        a.parsers && a.parsers.length || s(b);
                        for (h = 0; h < w; h++) {
                            m = e[h].cells.length;
                            x = [];
                            u = {child: [], $row: e.eq(h), order: a.cache[q].normalized.length};
                            for (l = 0; l < m; l++)
                                x[l] = a.parsers[l].format(p(b, e[h].cells[l], l), b, e[h].cells[l], l), "numeric" === (a.parsers[l].type || "").toLowerCase() && (a.cache[q].colMax[l] = Math.max(Math.abs(x[l]) || 0, a.cache[q].colMax[l] || 0));
                            x.push(u);
                            a.cache[q].normalized.push(x)
                        }
                        H(c, d, f)
                    }
                }).bind("updateComplete" + a.namespace, function() {
                    b.isUpdating = !1
                }).bind("sorton" + a.namespace, function(a, e, d, k) {
                    var l = b.config;
                    a.stopPropagation();
                    c.trigger("sortStart", this);
                    M(b, e, !0);
                    G(b);
                    l.delayInit && n(l.cache) && x(b);
                    c.trigger("sortBegin", this);
                    I(b);
                    y(b, k);
                    c.trigger("sortEnd", this);
                    f.applyWidget(b);
                    g.isFunction(d) && d(b)
                }).bind("appendCache" + a.namespace, function(a, c, d) {
                    a.stopPropagation();
                    y(b, d);
                    g.isFunction(c) && c(b)
                }).bind("updateCache" + a.namespace, function(c, e) {
                    a.parsers && a.parsers.length || s(b);
                    x(b);
                    g.isFunction(e) && e(b)
                }).bind("applyWidgetId" + a.namespace, function(c, e) {
                    c.stopPropagation();
                    f.getWidgetById(e).format(b, a, a.widgetOptions)
                }).bind("applyWidgets" + a.namespace, function(a, c) {
                    a.stopPropagation();
                    f.applyWidget(b, c)
                }).bind("refreshWidgets" + a.namespace, function(a, c, d) {
                    a.stopPropagation();
                    f.refreshWidgets(b, c, d)
                }).bind("destroy" + a.namespace, function(a, c, d) {
                    a.stopPropagation();
                    f.destroy(b, c, d)
                })
            }
            var f = this;
            f.version = "2.16.4";
            f.parsers = [];
            f.widgets = [];
            f.defaults = {theme: "default", widthFixed: !1, showProcessing: !1, headerTemplate: "{content}", onRenderTemplate: null, onRenderHeader: null, cancelSelection: !0, tabIndex: !0, dateFormat: "mmddyyyy", sortMultiSortKey: "shiftKey", sortResetKey: "ctrlKey", usNumberFormat: !0, delayInit: !1, serverSideSorting: !1, headers: {}, ignoreCase: !0, sortForce: null, sortList: [], sortAppend: null, sortStable: !1, sortInitialOrder: "asc", sortLocaleCompare: !1, sortReset: !1, sortRestart: !1, emptyTo: "bottom", stringTo: "max", textExtraction: "basic", textAttribute: "data-text", textSorter: null, numberSorter: null, widgets: [], widgetOptions: {zebra: ["even", "odd"]}, initWidgets: !0, initialized: null, tableClass: "", cssAsc: "", cssDesc: "", cssNone: "", cssHeader: "", cssHeaderRow: "", cssProcessing: "", cssChildRow: "tablesorter-childRow", cssIcon: "tablesorter-icon", cssInfoBlock: "tablesorter-infoOnly", selectorHeaders: "> thead th, > thead td", selectorSort: "th, td", selectorRemove: ".remove-me", debug: !1, headerList: [], empties: {}, strings: {}, parsers: []};
            f.css = {table: "tablesorter", cssHasChild: "tablesorter-hasChildRow", childRow: "tablesorter-childRow", header: "tablesorter-header", headerRow: "tablesorter-headerRow", headerIn: "tablesorter-header-inner", icon: "tablesorter-icon", info: "tablesorter-infoOnly", processing: "tablesorter-processing", sortAsc: "tablesorter-headerAsc", sortDesc: "tablesorter-headerDesc", sortNone: "tablesorter-headerUnSorted"};
            f.language = {sortAsc: "Ascending sort applied, ", sortDesc: "Descending sort applied, ", sortNone: "No sort applied, ", nextAsc: "activate to apply an ascending sort", nextDesc: "activate to apply a descending sort", nextNone: "activate to remove the sort"};
            f.log = d;
            f.benchmark = u;
            f.construct = function(b) {
                return this.each(function() {
                    var a = g.extend(!0, {}, f.defaults, b);
                    !this.hasInitialized && f.buildTable && "TABLE" !== this.tagName ? f.buildTable(this, a) : f.setup(this, a)
                })
            };
            f.setup = function(b, a) {
                if (!b || !b.tHead || 0 === b.tBodies.length || !0 === b.hasInitialized)
                    return a.debug ? d("ERROR: stopping initialization! No table, thead, tbody or tablesorter has already been initialized") : "";
                var c = "", h = g(b), e = g.metadata;
                b.hasInitialized = !1;
                b.isProcessing = !0;
                b.config = a;
                g.data(b, "tablesorter", a);
                a.debug && g.data(b, "startoveralltimer", new Date);
                a.supportsDataObject = function(a) {
                    a[0] = parseInt(a[0], 10);
                    return 1 < a[0] || 1 === a[0] && 4 <= parseInt(a[1], 10)
                }(g.fn.jquery.split("."));
                a.string = {max: 1, min: -1, emptyMin: 1, emptyMax: -1, zero: 0, none: 0, "null": 0, top: !0, bottom: !1};
                /tablesorter\-/.test(h.attr("class")) || (c = "" !== a.theme ? " tablesorter-" + a.theme : "");
                a.$table = h.addClass(f.css.table + " " + a.tableClass + c).attr({role: "grid"});
                a.namespace = a.namespace ? "." + a.namespace.replace(/\W/g, "") : ".tablesorter" + Math.random().toString(16).slice(2);
                a.$tbodies = h.children("tbody:not(." + a.cssInfoBlock + ")").attr({"aria-live": "polite", "aria-relevant": "all"});
                a.$table.find("caption").length && a.$table.attr("aria-labelledby", "theCaption");
                a.widgetInit = {};
                a.textExtraction = a.$table.attr("data-text-extraction") || a.textExtraction || "basic";
                D(b);
                L(b);
                s(b);
                a.delayInit || x(b);
                f.bindEvents(b, a.$headers, !0);
                K(b);
                a.supportsDataObject && "undefined" !== typeof h.data().sortlist ? a.sortList = h.data().sortlist : e && h.metadata() && h.metadata().sortlist && (a.sortList = h.metadata().sortlist);
                f.applyWidget(b, !0);
                0 < a.sortList.length ? h.trigger("sorton", [a.sortList, {}, !a.initWidgets, !0]) : (G(b), a.initWidgets && f.applyWidget(b, !1));
                a.showProcessing && h.unbind("sortBegin" + a.namespace + " sortEnd" + a.namespace).bind("sortBegin" + a.namespace + " sortEnd" + a.namespace, function(c) {
                    clearTimeout(a.processTimer);
                    f.isProcessing(b);
                    "sortBegin" === c.type && (a.processTimer = setTimeout(function() {
                        f.isProcessing(b, !0)
                    }, 500))
                });
                b.hasInitialized = !0;
                b.isProcessing = !1;
                a.debug && f.benchmark("Overall initialization time", g.data(b, "startoveralltimer"));
                h.trigger("tablesorter-initialized", b);
                "function" === typeof a.initialized && a.initialized(b)
            };
            f.computeColumnIndex = function(b) {
                var a = [], c = 0, h, e, d, f, l, m, n, u, p, q;
                for (h = 0; h < b.length; h++)
                    for (l = b[h].cells, e = 0; e < l.length; e++) {
                        d = l[e];
                        f = g(d);
                        m = d.parentNode.rowIndex;
                        f.index();
                        n = d.rowSpan || 1;
                        u = d.colSpan || 1;
                        "undefined" === typeof a[m] && (a[m] = []);
                        for (d = 0; d < a[m].length + 1; d++)
                            if ("undefined" === typeof a[m][d]) {
                                p = d;
                                break
                            }
                        c = Math.max(p, c);
                        f.attr({"data-column": p});
                        for (d = m; d < m + n; d++)
                            for ("undefined" === typeof a[d] && (a[d] = []), q = a[d], f = p; f < p + u; f++)
                                q[f] = "x"
                    }
                return c + 1
            };
            f.isProcessing = function(b, a, c) {
                b = g(b);
                var d = b[0].config;
                b = c || b.find("." + f.css.header);
                a ? ("undefined" !== typeof c && 0 < d.sortList.length && (b = b.filter(function() {
                    return this.sortDisabled ? !1 : 0 <= f.isValueInArray(parseFloat(g(this).attr("data-column")), d.sortList)
                })), b.addClass(f.css.processing + " " + d.cssProcessing)) : b.removeClass(f.css.processing + " " + d.cssProcessing)
            };
            f.processTbody = function(b, a, c) {
                b = g(b)[0];
                if (c)
                    return b.isProcessing = !0, a.before('<span class="tablesorter-savemyplace"/>'), c = g.fn.detach ? a.detach() : a.remove();
                c = g(b).find("span.tablesorter-savemyplace");
                a.insertAfter(c);
                c.remove();
                b.isProcessing = !1
            };
            f.clearTableBody = function(b) {
                g(b)[0].config.$tbodies.empty()
            };
            f.bindEvents = function(b, a, c) {
                b = g(b)[0];
                var d, e = b.config;
                !0 !== c && (e.$extraHeaders = e.$extraHeaders ? e.$extraHeaders.add(a) : a);
                a.find(e.selectorSort).add(a.filter(e.selectorSort)).unbind(["mousedown", "mouseup", "sort", "keyup", ""].join(e.namespace + " ")).bind(["mousedown", "mouseup", "sort", "keyup", ""].join(e.namespace + " "), function(c, f) {
                    var l;
                    l = c.type;
                    if (!(1 !== (c.which || c.button) && !/sort|keyup/.test(l) || "keyup" === l && 13 !== c.which || "mouseup" === l && !0 !== f && 250 < (new Date).getTime() - d)) {
                        if ("mousedown" === l)
                            return d = (new Date).getTime(), "INPUT" === c.target.tagName ? "" : !e.cancelSelection;
                        e.delayInit && n(e.cache) && x(b);
                        l = g.fn.closest ? g(this).closest("th, td")[0] : /TH|TD/.test(this.tagName) ? this : g(this).parents("th, td")[0];
                        l = e.$headers[a.index(l)];
                        l.sortDisabled || O(b, l, c)
                    }
                });
                e.cancelSelection && a.attr("unselectable", "on").bind("selectstart", !1).css({"user-select": "none", MozUserSelect: "none"})
            };
            f.restoreHeaders = function(b) {
                var a = g(b)[0].config;
                a.$table.find(a.selectorHeaders).each(function(b) {
                    g(this).find("." + f.css.headerIn).length && g(this).html(a.headerContent[b])
                })
            };
            f.destroy = function(b, a, c) {
                b = g(b)[0];
                if (b.hasInitialized) {
                    f.refreshWidgets(b, !0, !0);
                    var d = g(b), e = b.config, t = d.find("thead:first"), k = t.find("tr." + f.css.headerRow).removeClass(f.css.headerRow + " " + e.cssHeaderRow), l = d.find("tfoot:first > tr").children("th, td");
                    !1 === a && 0 <= g.inArray("uitheme", e.widgets) && (d.trigger("applyWidgetId", ["uitheme"]), d.trigger("applyWidgetId", ["zebra"]));
                    t.find("tr").not(k).remove();
                    d.removeData("tablesorter").unbind("sortReset update updateAll updateRows updateCell addRows updateComplete sorton appendCache updateCache applyWidgetId applyWidgets refreshWidgets destroy mouseup mouseleave keypress sortBegin sortEnd ".split(" ").join(e.namespace + " "));
                    e.$headers.add(l).removeClass([f.css.header, e.cssHeader, e.cssAsc, e.cssDesc, f.css.sortAsc, f.css.sortDesc, f.css.sortNone].join(" ")).removeAttr("data-column").removeAttr("aria-label").attr("aria-disabled", "true");
                    k.find(e.selectorSort).unbind(["mousedown", "mouseup", "keypress", ""].join(e.namespace + " "));
                    f.restoreHeaders(b);
                    d.toggleClass(f.css.table + " " + e.tableClass + " tablesorter-" + e.theme, !1 === a);
                    b.hasInitialized = !1;
                    delete b.config.cache;
                    "function" === typeof c && c(b)
                }
            };
            f.regex = {chunk: /(^([+\-]?(?:0|[1-9]\d*)(?:\.\d*)?(?:[eE][+\-]?\d+)?)?$|^0x[0-9a-f]+$|\d+)/gi, chunks: /(^\\0|\\0$)/, hex: /^0x[0-9a-f]+$/i};
            f.sortNatural = function(b, a) {
                if (b === a)
                    return 0;
                var c, d, e, g, k, l;
                d = f.regex;
                if (d.hex.test(a)) {
                    c = parseInt(b.match(d.hex), 16);
                    e = parseInt(a.match(d.hex), 16);
                    if (c < e)
                        return-1;
                    if (c > e)
                        return 1
                }
                c = b.replace(d.chunk, "\\0$1\\0").replace(d.chunks, "").split("\\0");
                d = a.replace(d.chunk, "\\0$1\\0").replace(d.chunks, "").split("\\0");
                l = Math.max(c.length, d.length);
                for (k = 0; k < l; k++) {
                    e = isNaN(c[k]) ? c[k] || 0 : parseFloat(c[k]) || 0;
                    g = isNaN(d[k]) ? d[k] || 0 : parseFloat(d[k]) || 0;
                    if (isNaN(e) !== isNaN(g))
                        return isNaN(e) ? 1 : -1;
                    typeof e !== typeof g && (e += "", g += "");
                    if (e < g)
                        return-1;
                    if (e > g)
                        return 1
                }
                return 0
            };
            f.sortNaturalAsc = function(b, a, c, d, e) {
                if (b === a)
                    return 0;
                c = e.string[e.empties[c] || e.emptyTo];
                return"" === b && 0 !== c ? "boolean" === typeof c ? c ? -1 : 1 : -c || -1 : "" === a && 0 !== c ? "boolean" === typeof c ? c ? 1 : -1 : c || 1 : f.sortNatural(b, a)
            };
            f.sortNaturalDesc = function(b, a, c, d, e) {
                if (b === a)
                    return 0;
                c = e.string[e.empties[c] || e.emptyTo];
                return"" === b && 0 !== c ? "boolean" === typeof c ? c ? -1 : 1 : c || 1 : "" === a && 0 !== c ? "boolean" === typeof c ? c ? 1 : -1 : -c || -1 : f.sortNatural(a, b)
            };
            f.sortText = function(b, a) {
                return b > a ? 1 : b < a ? -1 : 0
            };
            f.getTextValue = function(b, a, c) {
                if (c) {
                    var d = b ? b.length : 0, e = c + a;
                    for (c = 0; c < d; c++)
                        e += b.charCodeAt(c);
                    return a * e
                }
                return 0
            };
            f.sortNumericAsc = function(b, a, c, d, e, g) {
                if (b === a)
                    return 0;
                g = g.config;
                e = g.string[g.empties[e] || g.emptyTo];
                if ("" === b && 0 !== e)
                    return"boolean" === typeof e ? e ? -1 : 1 : -e || -1;
                if ("" === a && 0 !== e)
                    return"boolean" === typeof e ? e ? 1 : -1 : e || 1;
                isNaN(b) && (b = f.getTextValue(b, c, d));
                isNaN(a) && (a = f.getTextValue(a, c, d));
                return b - a
            };
            f.sortNumericDesc = function(b, a, c, d, e, g) {
                if (b === a)
                    return 0;
                g = g.config;
                e = g.string[g.empties[e] || g.emptyTo];
                if ("" === b && 0 !== e)
                    return"boolean" === typeof e ? e ? -1 : 1 : e || 1;
                if ("" === a && 0 !== e)
                    return"boolean" === typeof e ? e ? 1 : -1 : -e || -1;
                isNaN(b) && (b = f.getTextValue(b, c, d));
                isNaN(a) && (a = f.getTextValue(a, c, d));
                return a - b
            };
            f.sortNumeric = function(b, a) {
                return b - a
            };
            f.characterEquivalents = {a: "\u00e1\u00e0\u00e2\u00e3\u00e4\u0105\u00e5", A: "\u00c1\u00c0\u00c2\u00c3\u00c4\u0104\u00c5", c: "\u00e7\u0107\u010d", C: "\u00c7\u0106\u010c", e: "\u00e9\u00e8\u00ea\u00eb\u011b\u0119", E: "\u00c9\u00c8\u00ca\u00cb\u011a\u0118", i: "\u00ed\u00ec\u0130\u00ee\u00ef\u0131", I: "\u00cd\u00cc\u0130\u00ce\u00cf", o: "\u00f3\u00f2\u00f4\u00f5\u00f6", O: "\u00d3\u00d2\u00d4\u00d5\u00d6", ss: "\u00df", SS: "\u1e9e", u: "\u00fa\u00f9\u00fb\u00fc\u016f", U: "\u00da\u00d9\u00db\u00dc\u016e"};
            f.replaceAccents = function(b) {
                var a, c = "[", d = f.characterEquivalents;
                if (!f.characterRegex) {
                    f.characterRegexArray = {};
                    for (a in d)
                        "string" === typeof a && (c += d[a], f.characterRegexArray[a] = RegExp("[" + d[a] + "]", "g"));
                    f.characterRegex = RegExp(c + "]")
                }
                if (f.characterRegex.test(b))
                    for (a in d)
                        "string" === typeof a && (b = b.replace(f.characterRegexArray[a], a));
                return b
            };
            f.isValueInArray = function(b, a) {
                var c, d = a.length;
                for (c = 0; c < d; c++)
                    if (a[c][0] === b)
                        return c;
                return-1
            };
            f.addParser = function(b) {
                var a, c = f.parsers.length, d = !0;
                for (a = 0; a < c; a++)
                    f.parsers[a].id.toLowerCase() === b.id.toLowerCase() && (d = !1);
                d && f.parsers.push(b)
            };
            f.getParserById = function(b) {
                var a, c = f.parsers.length;
                for (a = 0; a < c; a++)
                    if (f.parsers[a].id.toLowerCase() === b.toString().toLowerCase())
                        return f.parsers[a];
                return!1
            };
            f.addWidget = function(b) {
                f.widgets.push(b)
            };
            f.getWidgetById = function(b) {
                var a, c, d = f.widgets.length;
                for (a = 0; a < d; a++)
                    if ((c = f.widgets[a]) && c.hasOwnProperty("id") && c.id.toLowerCase() === b.toLowerCase())
                        return c
            };
            f.applyWidget = function(b, a) {
                b = g(b)[0];
                var c = b.config, d = c.widgetOptions, e = [], n, k, l;
                !1 !== a && b.hasInitialized && (b.isApplyingWidgets || b.isUpdating) || (c.debug && (n = new Date), c.widgets.length && (b.isApplyingWidgets = !0, c.widgets = g.grep(c.widgets, function(a, b) {
                    return g.inArray(a, c.widgets) === b
                }), g.each(c.widgets || [], function(a, b) {
                    (l = f.getWidgetById(b)) && l.id && (l.priority || (l.priority = 10), e[a] = l)
                }), e.sort(function(a, b) {
                    return a.priority < b.priority ? -1 : a.priority === b.priority ? 0 : 1
                }), g.each(e, function(e, f) {
                    if (f) {
                        if (a || !c.widgetInit[f.id])
                            f.hasOwnProperty("options") && (d = b.config.widgetOptions = g.extend(!0, {}, f.options, d)), f.hasOwnProperty("init") && f.init(b, f, c, d), c.widgetInit[f.id] = !0;
                        !a && f.hasOwnProperty("format") && f.format(b, c, d, !1)
                    }
                })), setTimeout(function() {
                    b.isApplyingWidgets = !1
                }, 0), c.debug && (k = c.widgets.length, u("Completed " + (!0 === a ? "initializing " : "applying ") + k + " widget" + (1 !== k ? "s" : ""), n)))
            };
            f.refreshWidgets = function(b, a, c) {
                b = g(b)[0];
                var h, e = b.config, n = e.widgets, k = f.widgets, l = k.length;
                for (h = 0; h < l; h++)
                    k[h] && k[h].id && (a || 0 > g.inArray(k[h].id, n)) && (e.debug && d('Refeshing widgets: Removing "' + k[h].id + '"'), k[h].hasOwnProperty("remove") && e.widgetInit[k[h].id] && (k[h].remove(b, e, e.widgetOptions), e.widgetInit[k[h].id] = !1));
                !0 !== c && f.applyWidget(b, a)
            };
            f.getData = function(b, a, c) {
                var d = "";
                b = g(b);
                var e, f;
                if (!b.length)
                    return"";
                e = g.metadata ? b.metadata() : !1;
                f = " " + (b.attr("class") || "");
                "undefined" !== typeof b.data(c) || "undefined" !== typeof b.data(c.toLowerCase()) ? d += b.data(c) || b.data(c.toLowerCase()) : e && "undefined" !== typeof e[c] ? d += e[c] : a && "undefined" !== typeof a[c] ? d += a[c] : " " !== f && f.match(" " + c + "-") && (d = f.match(RegExp("\\s" + c + "-([\\w-]+)"))[1] || "");
                return g.trim(d)
            };
            f.formatFloat = function(b, a) {
                if ("string" !== typeof b || "" === b)
                    return b;
                var c;
                b = (a && a.config ? !1 !== a.config.usNumberFormat : "undefined" !== typeof a ? a : 1) ? b.replace(/,/g, "") : b.replace(/[\s|\.]/g, "").replace(/,/g, ".");
                /^\s*\([.\d]+\)/.test(b) && (b = b.replace(/^\s*\(([.\d]+)\)/, "-$1"));
                c = parseFloat(b);
                return isNaN(c) ? g.trim(b) : c
            };
            f.isDigit = function(b) {
                return isNaN(b) ? /^[\-+(]?\d+[)]?$/.test(b.toString().replace(/[,.'"\s]/g, "")) : !0
            }
        }});
    var p = g.tablesorter;
    g.fn.extend({tablesorter: p.construct});
    p.addParser({id: "text", is: function() {
            return!0
        }, format: function(d, u) {
            var n = u.config;
            d && (d = g.trim(n.ignoreCase ? d.toLocaleLowerCase() : d), d = n.sortLocaleCompare ? p.replaceAccents(d) : d);
            return d
        }, type: "text"});
    p.addParser({id: "digit", is: function(d) {
            return p.isDigit(d)
        }, format: function(d, u) {
            var n = p.formatFloat((d || "").replace(/[^\w,. \-()]/g, ""), u);
            return d && "number" === typeof n ? n : d ? g.trim(d && u.config.ignoreCase ? d.toLocaleLowerCase() : d) : d
        }, type: "numeric"});
    p.addParser({id: "currency", is: function(d) {
            return/^\(?\d+[\u00a3$\u20ac\u00a4\u00a5\u00a2?.]|[\u00a3$\u20ac\u00a4\u00a5\u00a2?.]\d+\)?$/.test((d || "").replace(/[+\-,. ]/g, ""))
        }, format: function(d, u) {
            var n = p.formatFloat((d || "").replace(/[^\w,. \-()]/g, ""), u);
            return d && "number" === typeof n ? n : d ? g.trim(d && u.config.ignoreCase ? d.toLocaleLowerCase() : d) : d
        }, type: "numeric"});
    p.addParser({id: "ipAddress", is: function(d) {
            return/^\d{1,3}[\.]\d{1,3}[\.]\d{1,3}[\.]\d{1,3}$/.test(d)
        }, format: function(d, g) {
            var n, v = d ? d.split(".") : "", s = "", x = v.length;
            for (n = 0; n < x; n++)
                s += ("00" + v[n]).slice(-3);
            return d ? p.formatFloat(s, g) : d
        }, type: "numeric"});
    p.addParser({id: "url", is: function(d) {
            return/^(https?|ftp|file):\/\//.test(d)
        }, format: function(d) {
            return d ? g.trim(d.replace(/(https?|ftp|file):\/\//, "")) : d
        }, type: "text"});
    p.addParser({id: "isoDate", is: function(d) {
            return/^\d{4}[\/\-]\d{1,2}[\/\-]\d{1,2}/.test(d)
        }, format: function(d, g) {
            return d ? p.formatFloat("" !== d ? (new Date(d.replace(/-/g, "/"))).getTime() || d : "", g) : d
        }, type: "numeric"});
    p.addParser({id: "percent", is: function(d) {
            return/(\d\s*?%|%\s*?\d)/.test(d) && 15 > d.length
        }, format: function(d, g) {
            return d ? p.formatFloat(d.replace(/%/g, ""), g) : d
        }, type: "numeric"});
    p.addParser({id: "usLongDate", is: function(d) {
            return/^[A-Z]{3,10}\.?\s+\d{1,2},?\s+(\d{4})(\s+\d{1,2}:\d{2}(:\d{2})?(\s+[AP]M)?)?$/i.test(d) || /^\d{1,2}\s+[A-Z]{3,10}\s+\d{4}/i.test(d)
        }, format: function(d, g) {
            return d ? p.formatFloat((new Date(d.replace(/(\S)([AP]M)$/i, "$1 $2"))).getTime() || d, g) : d
        }, type: "numeric"});
    p.addParser({id: "shortDate", is: function(d) {
            return/(^\d{1,2}[\/\s]\d{1,2}[\/\s]\d{4})|(^\d{4}[\/\s]\d{1,2}[\/\s]\d{1,2})/.test((d || "").replace(/\s+/g, " ").replace(/[\-.,]/g, "/"))
        }, format: function(d, g, n, v) {
            if (d) {
                n = g.config;
                var s = n.$headers.filter("[data-column=" + v + "]:last");
                v = s.length && s[0].dateFormat || p.getData(s, n.headers[v], "dateFormat") || n.dateFormat;
                d = d.replace(/\s+/g, " ").replace(/[\-.,]/g, "/");
                "mmddyyyy" === v ? d = d.replace(/(\d{1,2})[\/\s](\d{1,2})[\/\s](\d{4})/, "$3/$1/$2") : "ddmmyyyy" === v ? d = d.replace(/(\d{1,2})[\/\s](\d{1,2})[\/\s](\d{4})/, "$3/$2/$1") : "yyyymmdd" === v && (d = d.replace(/(\d{4})[\/\s](\d{1,2})[\/\s](\d{1,2})/, "$1/$2/$3"))
            }
            return d ? p.formatFloat((new Date(d)).getTime() || d, g) : d
        }, type: "numeric"});
    p.addParser({id: "time", is: function(d) {
            return/^(([0-2]?\d:[0-5]\d)|([0-1]?\d:[0-5]\d\s?([AP]M)))$/i.test(d)
        }, format: function(d, g) {
            return d ? p.formatFloat((new Date("2000/01/01 " + d.replace(/(\S)([AP]M)$/i, "$1 $2"))).getTime() || d, g) : d
        }, type: "numeric"});
    p.addParser({id: "metadata", is: function() {
            return!1
        }, format: function(d, p, n) {
            d = p.config;
            d = d.parserMetadataName ? d.parserMetadataName : "sortValue";
            return g(n).metadata()[d]
        }, type: "numeric"});
    p.addWidget({id: "zebra", priority: 90, format: function(d, u, n) {
            var v, s, x, y, C, D, E = RegExp(u.cssChildRow, "i"), B = u.$tbodies;
            u.debug && (C = new Date);
            for (d = 0; d < B.length; d++)
                v = B.eq(d), D = v.children("tr").length, 1 < D && (x = 0, v = v.children("tr:visible").not(u.selectorRemove), v.each(function() {
                    s = g(this);
                    E.test(this.className) || x++;
                    y = 0 === x % 2;
                    s.removeClass(n.zebra[y ? 1 : 0]).addClass(n.zebra[y ? 0 : 1])
                }));
            u.debug && p.benchmark("Applying Zebra widget", C)
        }, remove: function(d, p, n) {
            var v;
            p = p.$tbodies;
            var s = (n.zebra || ["even", "odd"]).join(" ");
            for (n = 0; n < p.length; n++)
                v = g.tablesorter.processTbody(d, p.eq(n), !0), v.children().removeClass(s), g.tablesorter.processTbody(d, v, !1)
        }})
}(jQuery);

jQuery(document).ready(function($) {
    $(function() {
        $("table").tablesorter();
    });
});
// Magnific Popup v0.9.9 by Dmitry Semenov
// http://bit.ly/magnific-popup#build=inline+image+ajax+iframe+gallery+retina+imagezoom+fastclick
(function(a) {
    var b = "Close", c = "BeforeClose", d = "AfterClose", e = "BeforeAppend", f = "MarkupParse", g = "Open", h = "Change", i = "mfp", j = "." + i, k = "mfp-ready", l = "mfp-removing", m = "mfp-prevent-close", n, o = function() {
    }, p = !!window.jQuery, q, r = a(window), s, t, u, v, w, x = function(a, b) {
        n.ev.on(i + a + j, b)
    }, y = function(b, c, d, e) {
        var f = document.createElement("div");
        return f.className = "mfp-" + b, d && (f.innerHTML = d), e ? c && c.appendChild(f) : (f = a(f), c && f.appendTo(c)), f
    }, z = function(b, c) {
        n.ev.triggerHandler(i + b, c), n.st.callbacks && (b = b.charAt(0).toLowerCase() + b.slice(1), n.st.callbacks[b] && n.st.callbacks[b].apply(n, a.isArray(c) ? c : [c]))
    }, A = function(b) {
        if (b !== w || !n.currTemplate.closeBtn)
            n.currTemplate.closeBtn = a(n.st.closeMarkup.replace("%title%", n.st.tClose)), w = b;
        return n.currTemplate.closeBtn
    }, B = function() {
        a.magnificPopup.instance || (n = new o, n.init(), a.magnificPopup.instance = n)
    }, C = function() {
        var a = document.createElement("p").style, b = ["ms", "O", "Moz", "Webkit"];
        if (a.transition !== undefined)
            return!0;
        while (b.length)
            if (b.pop() + "Transition"in a)
                return!0;
        return!1
    };
    o.prototype = {constructor: o, init: function() {
            var b = navigator.appVersion;
            n.isIE7 = b.indexOf("MSIE 7.") !== -1, n.isIE8 = b.indexOf("MSIE 8.") !== -1, n.isLowIE = n.isIE7 || n.isIE8, n.isAndroid = /android/gi.test(b), n.isIOS = /iphone|ipad|ipod/gi.test(b), n.supportsTransition = C(), n.probablyMobile = n.isAndroid || n.isIOS || /(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent), t = a(document), n.popupsCache = {}
        }, open: function(b) {
            s || (s = a(document.body));
            var c;
            if (b.isObj === !1) {
                n.items = b.items.toArray(), n.index = 0;
                var d = b.items, e;
                for (c = 0; c < d.length; c++) {
                    e = d[c], e.parsed && (e = e.el[0]);
                    if (e === b.el[0]) {
                        n.index = c;
                        break
                    }
                }
            } else
                n.items = a.isArray(b.items) ? b.items : [b.items], n.index = b.index || 0;
            if (n.isOpen) {
                n.updateItemHTML();
                return
            }
            n.types = [], v = "", b.mainEl && b.mainEl.length ? n.ev = b.mainEl.eq(0) : n.ev = t, b.key ? (n.popupsCache[b.key] || (n.popupsCache[b.key] = {}), n.currTemplate = n.popupsCache[b.key]) : n.currTemplate = {}, n.st = a.extend(!0, {}, a.magnificPopup.defaults, b), n.fixedContentPos = n.st.fixedContentPos === "auto" ? !n.probablyMobile : n.st.fixedContentPos, n.st.modal && (n.st.closeOnContentClick = !1, n.st.closeOnBgClick = !1, n.st.showCloseBtn = !1, n.st.enableEscapeKey = !1), n.bgOverlay || (n.bgOverlay = y("bg").on("click" + j, function() {
                n.close()
            }), n.wrap = y("wrap").attr("tabindex", -1).on("click" + j, function(a) {
                n._checkIfClose(a.target) && n.close()
            }), n.container = y("container", n.wrap)), n.contentContainer = y("content"), n.st.preloader && (n.preloader = y("preloader", n.container, n.st.tLoading));
            var h = a.magnificPopup.modules;
            for (c = 0; c < h.length; c++) {
                var i = h[c];
                i = i.charAt(0).toUpperCase() + i.slice(1), n["init" + i].call(n)
            }
            z("BeforeOpen"), n.st.showCloseBtn && (n.st.closeBtnInside ? (x(f, function(a, b, c, d) {
                c.close_replaceWith = A(d.type)
            }), v += " mfp-close-btn-in") : n.wrap.append(A())), n.st.alignTop && (v += " mfp-align-top"), n.fixedContentPos ? n.wrap.css({overflow: n.st.overflowY, overflowX: "hidden", overflowY: n.st.overflowY}) : n.wrap.css({top: r.scrollTop(), position: "absolute"}), (n.st.fixedBgPos === !1 || n.st.fixedBgPos === "auto" && !n.fixedContentPos) && n.bgOverlay.css({height: t.height(), position: "absolute"}), n.st.enableEscapeKey && t.on("keyup" + j, function(a) {
                a.keyCode === 27 && n.close()
            }), r.on("resize" + j, function() {
                n.updateSize()
            }), n.st.closeOnContentClick || (v += " mfp-auto-cursor"), v && n.wrap.addClass(v);
            var l = n.wH = r.height(), m = {};
            if (n.fixedContentPos && n._hasScrollBar(l)) {
                var o = n._getScrollbarSize();
                o && (m.marginRight = o)
            }
            n.fixedContentPos && (n.isIE7 ? a("body, html").css("overflow", "hidden") : m.overflow = "hidden");
            var p = n.st.mainClass;
            return n.isIE7 && (p += " mfp-ie7"), p && n._addClassToMFP(p), n.updateItemHTML(), z("BuildControls"), a("html").css(m), n.bgOverlay.add(n.wrap).prependTo(n.st.prependTo || s), n._lastFocusedEl = document.activeElement, setTimeout(function() {
                n.content ? (n._addClassToMFP(k), n._setFocus()) : n.bgOverlay.addClass(k), t.on("focusin" + j, n._onFocusIn)
            }, 16), n.isOpen = !0, n.updateSize(l), z(g), b
        }, close: function() {
            if (!n.isOpen)
                return;
            z(c), n.isOpen = !1, n.st.removalDelay && !n.isLowIE && n.supportsTransition ? (n._addClassToMFP(l), setTimeout(function() {
                n._close()
            }, n.st.removalDelay)) : n._close()
        }, _close: function() {
            z(b);
            var c = l + " " + k + " ";
            n.bgOverlay.detach(), n.wrap.detach(), n.container.empty(), n.st.mainClass && (c += n.st.mainClass + " "), n._removeClassFromMFP(c);
            if (n.fixedContentPos) {
                var e = {marginRight: ""};
                n.isIE7 ? a("body, html").css("overflow", "") : e.overflow = "", a("html").css(e)
            }
            t.off("keyup" + j + " focusin" + j), n.ev.off(j), n.wrap.attr("class", "mfp-wrap").removeAttr("style"), n.bgOverlay.attr("class", "mfp-bg"), n.container.attr("class", "mfp-container"), n.st.showCloseBtn && (!n.st.closeBtnInside || n.currTemplate[n.currItem.type] === !0) && n.currTemplate.closeBtn && n.currTemplate.closeBtn.detach(), n._lastFocusedEl && a(n._lastFocusedEl).focus(), n.currItem = null, n.content = null, n.currTemplate = null, n.prevHeight = 0, z(d)
        }, updateSize: function(a) {
            if (n.isIOS) {
                var b = document.documentElement.clientWidth / window.innerWidth, c = window.innerHeight * b;
                n.wrap.css("height", c), n.wH = c
            } else
                n.wH = a || r.height();
            n.fixedContentPos || n.wrap.css("height", n.wH), z("Resize")
        }, updateItemHTML: function() {
            var b = n.items[n.index];
            n.contentContainer.detach(), n.content && n.content.detach(), b.parsed || (b = n.parseEl(n.index));
            var c = b.type;
            z("BeforeChange", [n.currItem ? n.currItem.type : "", c]), n.currItem = b;
            if (!n.currTemplate[c]) {
                var d = n.st[c] ? n.st[c].markup : !1;
                z("FirstMarkupParse", d), d ? n.currTemplate[c] = a(d) : n.currTemplate[c] = !0
            }
            u && u !== b.type && n.container.removeClass("mfp-" + u + "-holder");
            var e = n["get" + c.charAt(0).toUpperCase() + c.slice(1)](b, n.currTemplate[c]);
            n.appendContent(e, c), b.preloaded = !0, z(h, b), u = b.type, n.container.prepend(n.contentContainer), z("AfterChange")
        }, appendContent: function(a, b) {
            n.content = a, a ? n.st.showCloseBtn && n.st.closeBtnInside && n.currTemplate[b] === !0 ? n.content.find(".mfp-close").length || n.content.append(A()) : n.content = a : n.content = "", z(e), n.container.addClass("mfp-" + b + "-holder"), n.contentContainer.append(n.content)
        }, parseEl: function(b) {
            var c = n.items[b], d;
            c.tagName ? c = {el: a(c)} : (d = c.type, c = {data: c, src: c.src});
            if (c.el) {
                var e = n.types;
                for (var f = 0; f < e.length; f++)
                    if (c.el.hasClass("mfp-" + e[f])) {
                        d = e[f];
                        break
                    }
                c.src = c.el.attr("data-mfp-src"), c.src || (c.src = c.el.attr("href"))
            }
            return c.type = d || n.st.type || "inline", c.index = b, c.parsed = !0, n.items[b] = c, z("ElementParse", c), n.items[b]
        }, addGroup: function(a, b) {
            var c = function(c) {
                c.mfpEl = this, n._openClick(c, a, b)
            };
            b || (b = {});
            var d = "click.magnificPopup";
            b.mainEl = a, b.items ? (b.isObj = !0, a.off(d).on(d, c)) : (b.isObj = !1, b.delegate ? a.off(d).on(d, b.delegate, c) : (b.items = a, a.off(d).on(d, c)))
        }, _openClick: function(b, c, d) {
            var e = d.midClick !== undefined ? d.midClick : a.magnificPopup.defaults.midClick;
            if (!e && (b.which === 2 || b.ctrlKey || b.metaKey))
                return;
            var f = d.disableOn !== undefined ? d.disableOn : a.magnificPopup.defaults.disableOn;
            if (f)
                if (a.isFunction(f)) {
                    if (!f.call(n))
                        return!0
                } else if (r.width() < f)
                    return!0;
            b.type && (b.preventDefault(), n.isOpen && b.stopPropagation()), d.el = a(b.mfpEl), d.delegate && (d.items = c.find(d.delegate)), n.open(d)
        }, updateStatus: function(a, b) {
            if (n.preloader) {
                q !== a && n.container.removeClass("mfp-s-" + q), !b && a === "loading" && (b = n.st.tLoading);
                var c = {status: a, text: b};
                z("UpdateStatus", c), a = c.status, b = c.text, n.preloader.html(b), n.preloader.find("a").on("click", function(a) {
                    a.stopImmediatePropagation()
                }), n.container.addClass("mfp-s-" + a), q = a
            }
        }, _checkIfClose: function(b) {
            if (a(b).hasClass(m))
                return;
            var c = n.st.closeOnContentClick, d = n.st.closeOnBgClick;
            if (c && d)
                return!0;
            if (!n.content || a(b).hasClass("mfp-close") || n.preloader && b === n.preloader[0])
                return!0;
            if (b !== n.content[0] && !a.contains(n.content[0], b)) {
                if (d && a.contains(document, b))
                    return!0
            } else if (c)
                return!0;
            return!1
        }, _addClassToMFP: function(a) {
            n.bgOverlay.addClass(a), n.wrap.addClass(a)
        }, _removeClassFromMFP: function(a) {
            this.bgOverlay.removeClass(a), n.wrap.removeClass(a)
        }, _hasScrollBar: function(a) {
            return(n.isIE7 ? t.height() : document.body.scrollHeight) > (a || r.height())
        }, _setFocus: function() {
            (n.st.focus ? n.content.find(n.st.focus).eq(0) : n.wrap).focus()
        }, _onFocusIn: function(b) {
            if (b.target !== n.wrap[0] && !a.contains(n.wrap[0], b.target))
                return n._setFocus(), !1
        }, _parseMarkup: function(b, c, d) {
            var e;
            d.data && (c = a.extend(d.data, c)), z(f, [b, c, d]), a.each(c, function(a, c) {
                if (c === undefined || c === !1)
                    return!0;
                e = a.split("_");
                if (e.length > 1) {
                    var d = b.find(j + "-" + e[0]);
                    if (d.length > 0) {
                        var f = e[1];
                        f === "replaceWith" ? d[0] !== c[0] && d.replaceWith(c) : f === "img" ? d.is("img") ? d.attr("src", c) : d.replaceWith('<img src="' + c + '" class="' + d.attr("class") + '" />') : d.attr(e[1], c)
                    }
                } else
                    b.find(j + "-" + a).html(c)
            })
        }, _getScrollbarSize: function() {
            if (n.scrollbarSize === undefined) {
                var a = document.createElement("div");
                a.id = "mfp-sbm", a.style.cssText = "width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;", document.body.appendChild(a), n.scrollbarSize = a.offsetWidth - a.clientWidth, document.body.removeChild(a)
            }
            return n.scrollbarSize
        }}, a.magnificPopup = {instance: null, proto: o.prototype, modules: [], open: function(b, c) {
            return B(), b ? b = a.extend(!0, {}, b) : b = {}, b.isObj = !0, b.index = c || 0, this.instance.open(b)
        }, close: function() {
            return a.magnificPopup.instance && a.magnificPopup.instance.close()
        }, registerModule: function(b, c) {
            c.options && (a.magnificPopup.defaults[b] = c.options), a.extend(this.proto, c.proto), this.modules.push(b)
        }, defaults: {disableOn: 0, key: null, midClick: !1, mainClass: "", preloader: !0, focus: "", closeOnContentClick: !1, closeOnBgClick: !0, closeBtnInside: !0, showCloseBtn: !0, enableEscapeKey: !0, modal: !1, alignTop: !1, removalDelay: 0, prependTo: null, fixedContentPos: "auto", fixedBgPos: "auto", overflowY: "auto", closeMarkup: '<button title="%title%" type="button" class="mfp-close">&times;</button>', tClose: "Close (Esc)", tLoading: "Loading..."}}, a.fn.magnificPopup = function(b) {
        B();
        var c = a(this);
        if (typeof b == "string")
            if (b === "open") {
                var d, e = p ? c.data("magnificPopup") : c[0].magnificPopup, f = parseInt(arguments[1], 10) || 0;
                e.items ? d = e.items[f] : (d = c, e.delegate && (d = d.find(e.delegate)), d = d.eq(f)), n._openClick({mfpEl: d}, c, e)
            } else
                n.isOpen && n[b].apply(n, Array.prototype.slice.call(arguments, 1));
        else
            b = a.extend(!0, {}, b), p ? c.data("magnificPopup", b) : c[0].magnificPopup = b, n.addGroup(c, b);
        return c
    };
    var D = "inline", E, F, G, H = function() {
        G && (F.after(G.addClass(E)).detach(), G = null)
    };
    a.magnificPopup.registerModule(D, {options: {hiddenClass: "hide", markup: "", tNotFound: "Content not found"}, proto: {initInline: function() {
                n.types.push(D), x(b + "." + D, function() {
                    H()
                })
            }, getInline: function(b, c) {
                H();
                if (b.src) {
                    var d = n.st.inline, e = a(b.src);
                    if (e.length) {
                        var f = e[0].parentNode;
                        f && f.tagName && (F || (E = d.hiddenClass, F = y(E), E = "mfp-" + E), G = e.after(F).detach().removeClass(E)), n.updateStatus("ready")
                    } else
                        n.updateStatus("error", d.tNotFound), e = a("<div>");
                    return b.inlineElement = e, e
                }
                return n.updateStatus("ready"), n._parseMarkup(c, {}, b), c
            }}});
    var I = "ajax", J, K = function() {
        J && s.removeClass(J)
    }, L = function() {
        K(), n.req && n.req.abort()
    };
    a.magnificPopup.registerModule(I, {options: {settings: null, cursor: "mfp-ajax-cur", tError: '<a href="%url%">The content</a> could not be loaded.'}, proto: {initAjax: function() {
                n.types.push(I), J = n.st.ajax.cursor, x(b + "." + I, L), x("BeforeChange." + I, L)
            }, getAjax: function(b) {
                J && s.addClass(J), n.updateStatus("loading");
                var c = a.extend({url: b.src, success: function(c, d, e) {
                        var f = {data: c, xhr: e};
                        z("ParseAjax", f), n.appendContent(a(f.data), I), b.finished = !0, K(), n._setFocus(), setTimeout(function() {
                            n.wrap.addClass(k)
                        }, 16), n.updateStatus("ready"), z("AjaxContentAdded")
                    }, error: function() {
                        K(), b.finished = b.loadError = !0, n.updateStatus("error", n.st.ajax.tError.replace("%url%", b.src))
                    }}, n.st.ajax.settings);
                return n.req = a.ajax(c), ""
            }}});
    var M, N = function(b) {
        if (b.data && b.data.title !== undefined)
            return b.data.title;
        var c = n.st.image.titleSrc;
        if (c) {
            if (a.isFunction(c))
                return c.call(n, b);
            if (b.el)
                return b.el.attr(c) || ""
        }
        return""
    };
    a.magnificPopup.registerModule("image", {options: {markup: '<div class="mfp-figure"><div class="mfp-close"></div><figure><div class="mfp-img"></div><figcaption><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></figcaption></figure></div>', cursor: "mfp-zoom-out-cur", titleSrc: "title", verticalFit: !0, tError: '<a href="%url%">The image</a> could not be loaded.'}, proto: {initImage: function() {
                var a = n.st.image, c = ".image";
                n.types.push("image"), x(g + c, function() {
                    n.currItem.type === "image" && a.cursor && s.addClass(a.cursor)
                }), x(b + c, function() {
                    a.cursor && s.removeClass(a.cursor), r.off("resize" + j)
                }), x("Resize" + c, n.resizeImage), n.isLowIE && x("AfterChange", n.resizeImage)
            }, resizeImage: function() {
                var a = n.currItem;
                if (!a || !a.img)
                    return;
                if (n.st.image.verticalFit) {
                    var b = 0;
                    n.isLowIE && (b = parseInt(a.img.css("padding-top"), 10) + parseInt(a.img.css("padding-bottom"), 10)), a.img.css("max-height", n.wH - b)
                }
            }, _onImageHasSize: function(a) {
                a.img && (a.hasSize = !0, M && clearInterval(M), a.isCheckingImgSize = !1, z("ImageHasSize", a), a.imgHidden && (n.content && n.content.removeClass("mfp-loading"), a.imgHidden = !1))
            }, findImageSize: function(a) {
                var b = 0, c = a.img[0], d = function(e) {
                    M && clearInterval(M), M = setInterval(function() {
                        if (c.naturalWidth > 0) {
                            n._onImageHasSize(a);
                            return
                        }
                        b > 200 && clearInterval(M), b++, b === 3 ? d(10) : b === 40 ? d(50) : b === 100 && d(500)
                    }, e)
                };
                d(1)
            }, getImage: function(b, c) {
                var d = 0, e = function() {
                    b && (b.img[0].complete ? (b.img.off(".mfploader"), b === n.currItem && (n._onImageHasSize(b), n.updateStatus("ready")), b.hasSize = !0, b.loaded = !0, z("ImageLoadComplete")) : (d++, d < 200 ? setTimeout(e, 100) : f()))
                }, f = function() {
                    b && (b.img.off(".mfploader"), b === n.currItem && (n._onImageHasSize(b), n.updateStatus("error", g.tError.replace("%url%", b.src))), b.hasSize = !0, b.loaded = !0, b.loadError = !0)
                }, g = n.st.image, h = c.find(".mfp-img");
                if (h.length) {
                    var i = document.createElement("img");
                    i.className = "mfp-img", b.img = a(i).on("load.mfploader", e).on("error.mfploader", f), i.src = b.src, h.is("img") && (b.img = b.img.clone()), i = b.img[0], i.naturalWidth > 0 ? b.hasSize = !0 : i.width || (b.hasSize = !1)
                }
                return n._parseMarkup(c, {title: N(b), img_replaceWith: b.img}, b), n.resizeImage(), b.hasSize ? (M && clearInterval(M), b.loadError ? (c.addClass("mfp-loading"), n.updateStatus("error", g.tError.replace("%url%", b.src))) : (c.removeClass("mfp-loading"), n.updateStatus("ready")), c) : (n.updateStatus("loading"), b.loading = !0, b.hasSize || (b.imgHidden = !0, c.addClass("mfp-loading"), n.findImageSize(b)), c)
            }}});
    var O, P = function() {
        return O === undefined && (O = document.createElement("p").style.MozTransform !== undefined), O
    };
    a.magnificPopup.registerModule("zoom", {options: {enabled: !1, easing: "ease-in-out", duration: 300, opener: function(a) {
                return a.is("img") ? a : a.find("img")
            }}, proto: {initZoom: function() {
                var a = n.st.zoom, d = ".zoom", e;
                if (!a.enabled || !n.supportsTransition)
                    return;
                var f = a.duration, g = function(b) {
                    var c = b.clone().removeAttr("style").removeAttr("class").addClass("mfp-animated-image"), d = "all " + a.duration / 1e3 + "s " + a.easing, e = {position: "fixed", zIndex: 9999, left: 0, top: 0, "-webkit-backface-visibility": "hidden"}, f = "transition";
                    return e["-webkit-" + f] = e["-moz-" + f] = e["-o-" + f] = e[f] = d, c.css(e), c
                }, h = function() {
                    n.content.css("visibility", "visible")
                }, i, j;
                x("BuildControls" + d, function() {
                    if (n._allowZoom()) {
                        clearTimeout(i), n.content.css("visibility", "hidden"), e = n._getItemToZoom();
                        if (!e) {
                            h();
                            return
                        }
                        j = g(e), j.css(n._getOffset()), n.wrap.append(j), i = setTimeout(function() {
                            j.css(n._getOffset(!0)), i = setTimeout(function() {
                                h(), setTimeout(function() {
                                    j.remove(), e = j = null, z("ZoomAnimationEnded")
                                }, 16)
                            }, f)
                        }, 16)
                    }
                }), x(c + d, function() {
                    if (n._allowZoom()) {
                        clearTimeout(i), n.st.removalDelay = f;
                        if (!e) {
                            e = n._getItemToZoom();
                            if (!e)
                                return;
                            j = g(e)
                        }
                        j.css(n._getOffset(!0)), n.wrap.append(j), n.content.css("visibility", "hidden"), setTimeout(function() {
                            j.css(n._getOffset())
                        }, 16)
                    }
                }), x(b + d, function() {
                    n._allowZoom() && (h(), j && j.remove(), e = null)
                })
            }, _allowZoom: function() {
                return n.currItem.type === "image"
            }, _getItemToZoom: function() {
                return n.currItem.hasSize ? n.currItem.img : !1
            }, _getOffset: function(b) {
                var c;
                b ? c = n.currItem.img : c = n.st.zoom.opener(n.currItem.el || n.currItem);
                var d = c.offset(), e = parseInt(c.css("padding-top"), 10), f = parseInt(c.css("padding-bottom"), 10);
                d.top -= a(window).scrollTop() - e;
                var g = {width: c.width(), height: (p ? c.innerHeight() : c[0].offsetHeight) - f - e};
                return P() ? g["-moz-transform"] = g.transform = "translate(" + d.left + "px," + d.top + "px)" : (g.left = d.left, g.top = d.top), g
            }}});
    var Q = "iframe", R = "//about:blank", S = function(a) {
        if (n.currTemplate[Q]) {
            var b = n.currTemplate[Q].find("iframe");
            b.length && (a || (b[0].src = R), n.isIE8 && b.css("display", a ? "block" : "none"))
        }
    };
    a.magnificPopup.registerModule(Q, {options: {markup: '<div class="mfp-iframe-scaler"><div class="mfp-close"></div><iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe></div>', srcAction: "iframe_src", patterns: {youtube: {index: "youtube.com", id: "v=", src: "//www.youtube.com/embed/%id%?autoplay=1"}, vimeo: {index: "vimeo.com/", id: "/", src: "//player.vimeo.com/video/%id%?autoplay=1"}, gmaps: {index: "//maps.google.", src: "%id%&output=embed"}}}, proto: {initIframe: function() {
                n.types.push(Q), x("BeforeChange", function(a, b, c) {
                    b !== c && (b === Q ? S() : c === Q && S(!0))
                }), x(b + "." + Q, function() {
                    S()
                })
            }, getIframe: function(b, c) {
                var d = b.src, e = n.st.iframe;
                a.each(e.patterns, function() {
                    if (d.indexOf(this.index) > -1)
                        return this.id && (typeof this.id == "string" ? d = d.substr(d.lastIndexOf(this.id) + this.id.length, d.length) : d = this.id.call(this, d)), d = this.src.replace("%id%", d), !1
                });
                var f = {};
                return e.srcAction && (f[e.srcAction] = d), n._parseMarkup(c, f, b), n.updateStatus("ready"), c
            }}});
    var T = function(a) {
        var b = n.items.length;
        return a > b - 1 ? a - b : a < 0 ? b + a : a
    }, U = function(a, b, c) {
        return a.replace(/%curr%/gi, b + 1).replace(/%total%/gi, c)
    };
    a.magnificPopup.registerModule("gallery", {options: {enabled: !1, arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>', preload: [0, 2], navigateByImgClick: !0, arrows: !0, tPrev: "Previous (Left arrow key)", tNext: "Next (Right arrow key)", tCounter: "%curr% of %total%"}, proto: {initGallery: function() {
                var c = n.st.gallery, d = ".mfp-gallery", e = Boolean(a.fn.mfpFastClick);
                n.direction = !0;
                if (!c || !c.enabled)
                    return!1;
                v += " mfp-gallery", x(g + d, function() {
                    c.navigateByImgClick && n.wrap.on("click" + d, ".mfp-img", function() {
                        if (n.items.length > 1)
                            return n.next(), !1
                    }), t.on("keydown" + d, function(a) {
                        a.keyCode === 37 ? n.prev() : a.keyCode === 39 && n.next()
                    })
                }), x("UpdateStatus" + d, function(a, b) {
                    b.text && (b.text = U(b.text, n.currItem.index, n.items.length))
                }), x(f + d, function(a, b, d, e) {
                    var f = n.items.length;
                    d.counter = f > 1 ? U(c.tCounter, e.index, f) : ""
                }), x("BuildControls" + d, function() {
                    if (n.items.length > 1 && c.arrows && !n.arrowLeft) {
                        var b = c.arrowMarkup, d = n.arrowLeft = a(b.replace(/%title%/gi, c.tPrev).replace(/%dir%/gi, "left")).addClass(m), f = n.arrowRight = a(b.replace(/%title%/gi, c.tNext).replace(/%dir%/gi, "right")).addClass(m), g = e ? "mfpFastClick" : "click";
                        d[g](function() {
                            n.prev()
                        }), f[g](function() {
                            n.next()
                        }), n.isIE7 && (y("b", d[0], !1, !0), y("a", d[0], !1, !0), y("b", f[0], !1, !0), y("a", f[0], !1, !0)), n.container.append(d.add(f))
                    }
                }), x(h + d, function() {
                    n._preloadTimeout && clearTimeout(n._preloadTimeout), n._preloadTimeout = setTimeout(function() {
                        n.preloadNearbyImages(), n._preloadTimeout = null
                    }, 16)
                }), x(b + d, function() {
                    t.off(d), n.wrap.off("click" + d), n.arrowLeft && e && n.arrowLeft.add(n.arrowRight).destroyMfpFastClick(), n.arrowRight = n.arrowLeft = null
                })
            }, next: function() {
                n.direction = !0, n.index = T(n.index + 1), n.updateItemHTML()
            }, prev: function() {
                n.direction = !1, n.index = T(n.index - 1), n.updateItemHTML()
            }, goTo: function(a) {
                n.direction = a >= n.index, n.index = a, n.updateItemHTML()
            }, preloadNearbyImages: function() {
                var a = n.st.gallery.preload, b = Math.min(a[0], n.items.length), c = Math.min(a[1], n.items.length), d;
                for (d = 1; d <= (n.direction?c:b); d++)
                    n._preloadItem(n.index + d);
                for (d = 1; d <= (n.direction?b:c); d++)
                    n._preloadItem(n.index - d)
            }, _preloadItem: function(b) {
                b = T(b);
                if (n.items[b].preloaded)
                    return;
                var c = n.items[b];
                c.parsed || (c = n.parseEl(b)), z("LazyLoad", c), c.type === "image" && (c.img = a('<img class="mfp-img" />').on("load.mfploader", function() {
                    c.hasSize = !0
                }).on("error.mfploader", function() {
                    c.hasSize = !0, c.loadError = !0, z("LazyLoadError", c)
                }).attr("src", c.src)), c.preloaded = !0
            }}});
    var V = "retina";
    a.magnificPopup.registerModule(V, {options: {replaceSrc: function(a) {
                return a.src.replace(/\.\w+$/, function(a) {
                    return"@2x" + a
                })
            }, ratio: 1}, proto: {initRetina: function() {
                if (window.devicePixelRatio > 1) {
                    var a = n.st.retina, b = a.ratio;
                    b = isNaN(b) ? b() : b, b > 1 && (x("ImageHasSize." + V, function(a, c) {
                        c.img.css({"max-width": c.img[0].naturalWidth / b, width: "100%"})
                    }), x("ElementParse." + V, function(c, d) {
                        d.src = a.replaceSrc(d, b)
                    }))
                }
            }}}), function() {
        var b = 1e3, c = "ontouchstart"in window, d = function() {
            r.off("touchmove" + f + " touchend" + f)
        }, e = "mfpFastClick", f = "." + e;
        a.fn.mfpFastClick = function(e) {
            return a(this).each(function() {
                var g = a(this), h;
                if (c) {
                    var i, j, k, l, m, n;
                    g.on("touchstart" + f, function(a) {
                        l = !1, n = 1, m = a.originalEvent ? a.originalEvent.touches[0] : a.touches[0], j = m.clientX, k = m.clientY, r.on("touchmove" + f, function(a) {
                            m = a.originalEvent ? a.originalEvent.touches : a.touches, n = m.length, m = m[0];
                            if (Math.abs(m.clientX - j) > 10 || Math.abs(m.clientY - k) > 10)
                                l = !0, d()
                        }).on("touchend" + f, function(a) {
                            d();
                            if (l || n > 1)
                                return;
                            h = !0, a.preventDefault(), clearTimeout(i), i = setTimeout(function() {
                                h = !1
                            }, b), e()
                        })
                    })
                }
                g.on("click" + f, function() {
                    h || e()
                })
            })
        }, a.fn.destroyMfpFastClick = function() {
            a(this).off("touchstart" + f + " click" + f), c && r.off("touchmove" + f + " touchend" + f)
        }
    }(), B()
})(window.jQuery || window.Zepto)

//AUTOCOMPLETE 
jQuery(function() {
    if (typeof availableCity === 'undefined'){
        var nothere = ""
    } else {
        jQuery("#City").autocomplete({
            source: availableCity
        });
    }
});