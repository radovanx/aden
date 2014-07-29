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
        $("table").tablesorter(
                
                {      
                         headers:
                                {   
                                8 : { sorter: "digit"  },
                                9 : { sorter: "digit"  }, 
                                },
                            usNumberFormat:false    
                } 
        );
    });
});


(function(e) {
    var t, n, i, o, r, a, s, l = "Close", c = "BeforeClose", d = "AfterClose", u = "BeforeAppend", p = "MarkupParse", f = "Open", m = "Change", g = "mfp", h = "." + g, v = "mfp-ready", C = "mfp-removing", y = "mfp-prevent-close", w = function() {
    }, b = !!window.jQuery, I = e(window), x = function(e, n) {
        t.ev.on(g + e + h, n)
    }, k = function(t, n, i, o) {
        var r = document.createElement("div");
        return r.className = "mfp-" + t, i && (r.innerHTML = i), o ? n && n.appendChild(r) : (r = e(r), n && r.appendTo(n)), r
    }, T = function(n, i) {
        t.ev.triggerHandler(g + n, i), t.st.callbacks && (n = n.charAt(0).toLowerCase() + n.slice(1), t.st.callbacks[n] && t.st.callbacks[n].apply(t, e.isArray(i) ? i : [i]))
    }, E = function(n) {
        return n === s && t.currTemplate.closeBtn || (t.currTemplate.closeBtn = e(t.st.closeMarkup.replace("%title%", t.st.tClose)), s = n), t.currTemplate.closeBtn
    }, _ = function() {
        e.magnificPopup.instance || (t = new w, t.init(), e.magnificPopup.instance = t)
    }, S = function() {
        var e = document.createElement("p").style, t = ["ms", "O", "Moz", "Webkit"];
        if (void 0 !== e.transition)
            return!0;
        for (; t.length; )
            if (t.pop() + "Transition"in e)
                return!0;
        return!1
    };
    w.prototype = {constructor: w, init: function() {
            var n = navigator.appVersion;
            t.isIE7 = -1 !== n.indexOf("MSIE 7."), t.isIE8 = -1 !== n.indexOf("MSIE 8."), t.isLowIE = t.isIE7 || t.isIE8, t.isAndroid = /android/gi.test(n), t.isIOS = /iphone|ipad|ipod/gi.test(n), t.supportsTransition = S(), t.probablyMobile = t.isAndroid || t.isIOS || /(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent), o = e(document), t.popupsCache = {}
        }, open: function(n) {
            i || (i = e(document.body));
            var r;
            if (n.isObj === !1) {
                t.items = n.items.toArray(), t.index = 0;
                var s, l = n.items;
                for (r = 0; l.length > r; r++)
                    if (s = l[r], s.parsed && (s = s.el[0]), s === n.el[0]) {
                        t.index = r;
                        break
                    }
            } else
                t.items = e.isArray(n.items) ? n.items : [n.items], t.index = n.index || 0;
            if (t.isOpen)
                return t.updateItemHTML(), void 0;
            t.types = [], a = "", t.ev = n.mainEl && n.mainEl.length ? n.mainEl.eq(0) : o, n.key ? (t.popupsCache[n.key] || (t.popupsCache[n.key] = {}), t.currTemplate = t.popupsCache[n.key]) : t.currTemplate = {}, t.st = e.extend(!0, {}, e.magnificPopup.defaults, n), t.fixedContentPos = "auto" === t.st.fixedContentPos ? !t.probablyMobile : t.st.fixedContentPos, t.st.modal && (t.st.closeOnContentClick = !1, t.st.closeOnBgClick = !1, t.st.showCloseBtn = !1, t.st.enableEscapeKey = !1), t.bgOverlay || (t.bgOverlay = k("bg").on("click" + h, function() {
                t.close()
            }), t.wrap = k("wrap").attr("tabindex", -1).on("click" + h, function(e) {
                t._checkIfClose(e.target) && t.close()
            }), t.container = k("container", t.wrap)), t.contentContainer = k("content"), t.st.preloader && (t.preloader = k("preloader", t.container, t.st.tLoading));
            var c = e.magnificPopup.modules;
            for (r = 0; c.length > r; r++) {
                var d = c[r];
                d = d.charAt(0).toUpperCase() + d.slice(1), t["init" + d].call(t)
            }
            T("BeforeOpen"), t.st.showCloseBtn && (t.st.closeBtnInside ? (x(p, function(e, t, n, i) {
                n.close_replaceWith = E(i.type)
            }), a += " mfp-close-btn-in") : t.wrap.append(E())), t.st.alignTop && (a += " mfp-align-top"), t.fixedContentPos ? t.wrap.css({overflow: t.st.overflowY, overflowX: "hidden", overflowY: t.st.overflowY}) : t.wrap.css({top: I.scrollTop(), position: "absolute"}), (t.st.fixedBgPos === !1 || "auto" === t.st.fixedBgPos && !t.fixedContentPos) && t.bgOverlay.css({height: o.height(), position: "absolute"}), t.st.enableEscapeKey && o.on("keyup" + h, function(e) {
                27 === e.keyCode && t.close()
            }), I.on("resize" + h, function() {
                t.updateSize()
            }), t.st.closeOnContentClick || (a += " mfp-auto-cursor"), a && t.wrap.addClass(a);
            var u = t.wH = I.height(), m = {};
            if (t.fixedContentPos && t._hasScrollBar(u)) {
                var g = t._getScrollbarSize();
                g && (m.marginRight = g)
            }
            t.fixedContentPos && (t.isIE7 ? e("body, html").css("overflow", "hidden") : m.overflow = "hidden");
            var C = t.st.mainClass;
            return t.isIE7 && (C += " mfp-ie7"), C && t._addClassToMFP(C), t.updateItemHTML(), T("BuildControls"), e("html").css(m), t.bgOverlay.add(t.wrap).prependTo(t.st.prependTo || i), t._lastFocusedEl = document.activeElement, setTimeout(function() {
                t.content ? (t._addClassToMFP(v), t._setFocus()) : t.bgOverlay.addClass(v), o.on("focusin" + h, t._onFocusIn)
            }, 16), t.isOpen = !0, t.updateSize(u), T(f), n
        }, close: function() {
            t.isOpen && (T(c), t.isOpen = !1, t.st.removalDelay && !t.isLowIE && t.supportsTransition ? (t._addClassToMFP(C), setTimeout(function() {
                t._close()
            }, t.st.removalDelay)) : t._close())
        }, _close: function() {
            T(l);
            var n = C + " " + v + " ";
            if (t.bgOverlay.detach(), t.wrap.detach(), t.container.empty(), t.st.mainClass && (n += t.st.mainClass + " "), t._removeClassFromMFP(n), t.fixedContentPos) {
                var i = {marginRight: ""};
                t.isIE7 ? e("body, html").css("overflow", "") : i.overflow = "", e("html").css(i)
            }
            o.off("keyup" + h + " focusin" + h), t.ev.off(h), t.wrap.attr("class", "mfp-wrap").removeAttr("style"), t.bgOverlay.attr("class", "mfp-bg"), t.container.attr("class", "mfp-container"), !t.st.showCloseBtn || t.st.closeBtnInside && t.currTemplate[t.currItem.type] !== !0 || t.currTemplate.closeBtn && t.currTemplate.closeBtn.detach(), t._lastFocusedEl && e(t._lastFocusedEl).focus(), t.currItem = null, t.content = null, t.currTemplate = null, t.prevHeight = 0, T(d)
        }, updateSize: function(e) {
            if (t.isIOS) {
                var n = document.documentElement.clientWidth / window.innerWidth, i = window.innerHeight * n;
                t.wrap.css("height", i), t.wH = i
            } else
                t.wH = e || I.height();
            t.fixedContentPos || t.wrap.css("height", t.wH), T("Resize")
        }, updateItemHTML: function() {
            var n = t.items[t.index];
            t.contentContainer.detach(), t.content && t.content.detach(), n.parsed || (n = t.parseEl(t.index));
            var i = n.type;
            if (T("BeforeChange", [t.currItem ? t.currItem.type : "", i]), t.currItem = n, !t.currTemplate[i]) {
                var o = t.st[i] ? t.st[i].markup : !1;
                T("FirstMarkupParse", o), t.currTemplate[i] = o ? e(o) : !0
            }
            r && r !== n.type && t.container.removeClass("mfp-" + r + "-holder");
            var a = t["get" + i.charAt(0).toUpperCase() + i.slice(1)](n, t.currTemplate[i]);
            t.appendContent(a, i), n.preloaded = !0, T(m, n), r = n.type, t.container.prepend(t.contentContainer), T("AfterChange")
        }, appendContent: function(e, n) {
            t.content = e, e ? t.st.showCloseBtn && t.st.closeBtnInside && t.currTemplate[n] === !0 ? t.content.find(".mfp-close").length || t.content.append(E()) : t.content = e : t.content = "", T(u), t.container.addClass("mfp-" + n + "-holder"), t.contentContainer.append(t.content)
        }, parseEl: function(n) {
            var i, o = t.items[n];
            if (o.tagName ? o = {el: e(o)} : (i = o.type, o = {data: o, src: o.src}), o.el) {
                for (var r = t.types, a = 0; r.length > a; a++)
                    if (o.el.hasClass("mfp-" + r[a])) {
                        i = r[a];
                        break
                    }
                o.src = o.el.attr("data-mfp-src"), o.src || (o.src = o.el.attr("href"))
            }
            return o.type = i || t.st.type || "inline", o.index = n, o.parsed = !0, t.items[n] = o, T("ElementParse", o), t.items[n]
        }, addGroup: function(e, n) {
            var i = function(i) {
                i.mfpEl = this, t._openClick(i, e, n)
            };
            n || (n = {});
            var o = "click.magnificPopup";
            n.mainEl = e, n.items ? (n.isObj = !0, e.off(o).on(o, i)) : (n.isObj = !1, n.delegate ? e.off(o).on(o, n.delegate, i) : (n.items = e, e.off(o).on(o, i)))
        }, _openClick: function(n, i, o) {
            var r = void 0 !== o.midClick ? o.midClick : e.magnificPopup.defaults.midClick;
            if (r || 2 !== n.which && !n.ctrlKey && !n.metaKey) {
                var a = void 0 !== o.disableOn ? o.disableOn : e.magnificPopup.defaults.disableOn;
                if (a)
                    if (e.isFunction(a)) {
                        if (!a.call(t))
                            return!0
                    } else if (a > I.width())
                        return!0;
                n.type && (n.preventDefault(), t.isOpen && n.stopPropagation()), o.el = e(n.mfpEl), o.delegate && (o.items = i.find(o.delegate)), t.open(o)
            }
        }, updateStatus: function(e, i) {
            if (t.preloader) {
                n !== e && t.container.removeClass("mfp-s-" + n), i || "loading" !== e || (i = t.st.tLoading);
                var o = {status: e, text: i};
                T("UpdateStatus", o), e = o.status, i = o.text, t.preloader.html(i), t.preloader.find("a").on("click", function(e) {
                    e.stopImmediatePropagation()
                }), t.container.addClass("mfp-s-" + e), n = e
            }
        }, _checkIfClose: function(n) {
            if (!e(n).hasClass(y)) {
                var i = t.st.closeOnContentClick, o = t.st.closeOnBgClick;
                if (i && o)
                    return!0;
                if (!t.content || e(n).hasClass("mfp-close") || t.preloader && n === t.preloader[0])
                    return!0;
                if (n === t.content[0] || e.contains(t.content[0], n)) {
                    if (i)
                        return!0
                } else if (o && e.contains(document, n))
                    return!0;
                return!1
            }
        }, _addClassToMFP: function(e) {
            t.bgOverlay.addClass(e), t.wrap.addClass(e)
        }, _removeClassFromMFP: function(e) {
            this.bgOverlay.removeClass(e), t.wrap.removeClass(e)
        }, _hasScrollBar: function(e) {
            return(t.isIE7 ? o.height() : document.body.scrollHeight) > (e || I.height())
        }, _setFocus: function() {
            (t.st.focus ? t.content.find(t.st.focus).eq(0) : t.wrap).focus()
        }, _onFocusIn: function(n) {
            return n.target === t.wrap[0] || e.contains(t.wrap[0], n.target) ? void 0 : (t._setFocus(), !1)
        }, _parseMarkup: function(t, n, i) {
            var o;
            i.data && (n = e.extend(i.data, n)), T(p, [t, n, i]), e.each(n, function(e, n) {
                if (void 0 === n || n === !1)
                    return!0;
                if (o = e.split("_"), o.length > 1) {
                    var i = t.find(h + "-" + o[0]);
                    if (i.length > 0) {
                        var r = o[1];
                        "replaceWith" === r ? i[0] !== n[0] && i.replaceWith(n) : "img" === r ? i.is("img") ? i.attr("src", n) : i.replaceWith('<img src="' + n + '" class="' + i.attr("class") + '" />') : i.attr(o[1], n)
                    }
                } else
                    t.find(h + "-" + e).html(n)
            })
        }, _getScrollbarSize: function() {
            if (void 0 === t.scrollbarSize) {
                var e = document.createElement("div");
                e.id = "mfp-sbm", e.style.cssText = "width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;", document.body.appendChild(e), t.scrollbarSize = e.offsetWidth - e.clientWidth, document.body.removeChild(e)
            }
            return t.scrollbarSize
        }}, e.magnificPopup = {instance: null, proto: w.prototype, modules: [], open: function(t, n) {
            return _(), t = t ? e.extend(!0, {}, t) : {}, t.isObj = !0, t.index = n || 0, this.instance.open(t)
        }, close: function() {
            return e.magnificPopup.instance && e.magnificPopup.instance.close()
        }, registerModule: function(t, n) {
            n.options && (e.magnificPopup.defaults[t] = n.options), e.extend(this.proto, n.proto), this.modules.push(t)
        }, defaults: {disableOn: 0, key: null, midClick: !1, mainClass: "", preloader: !0, focus: "", closeOnContentClick: !1, closeOnBgClick: !0, closeBtnInside: !0, showCloseBtn: !0, enableEscapeKey: !0, modal: !1, alignTop: !1, removalDelay: 0, prependTo: null, fixedContentPos: "auto", fixedBgPos: "auto", overflowY: "auto", closeMarkup: '<button title="%title%" type="button" class="mfp-close">&times;</button>', tClose: "Close (Esc)", tLoading: "Loading..."}}, e.fn.magnificPopup = function(n) {
        _();
        var i = e(this);
        if ("string" == typeof n)
            if ("open" === n) {
                var o, r = b ? i.data("magnificPopup") : i[0].magnificPopup, a = parseInt(arguments[1], 10) || 0;
                r.items ? o = r.items[a] : (o = i, r.delegate && (o = o.find(r.delegate)), o = o.eq(a)), t._openClick({mfpEl: o}, i, r)
            } else
                t.isOpen && t[n].apply(t, Array.prototype.slice.call(arguments, 1));
        else
            n = e.extend(!0, {}, n), b ? i.data("magnificPopup", n) : i[0].magnificPopup = n, t.addGroup(i, n);
        return i
    };
    var P, O, z, M = "inline", B = function() {
        z && (O.after(z.addClass(P)).detach(), z = null)
    };
    e.magnificPopup.registerModule(M, {options: {hiddenClass: "hide", markup: "", tNotFound: "Content not found"}, proto: {initInline: function() {
                t.types.push(M), x(l + "." + M, function() {
                    B()
                })
            }, getInline: function(n, i) {
                if (B(), n.src) {
                    var o = t.st.inline, r = e(n.src);
                    if (r.length) {
                        var a = r[0].parentNode;
                        a && a.tagName && (O || (P = o.hiddenClass, O = k(P), P = "mfp-" + P), z = r.after(O).detach().removeClass(P)), t.updateStatus("ready")
                    } else
                        t.updateStatus("error", o.tNotFound), r = e("<div>");
                    return n.inlineElement = r, r
                }
                return t.updateStatus("ready"), t._parseMarkup(i, {}, n), i
            }}});
    var F, H = "ajax", L = function() {
        F && i.removeClass(F)
    }, A = function() {
        L(), t.req && t.req.abort()
    };
    e.magnificPopup.registerModule(H, {options: {settings: null, cursor: "mfp-ajax-cur", tError: '<a href="%url%">The content</a> could not be loaded.'}, proto: {initAjax: function() {
                t.types.push(H), F = t.st.ajax.cursor, x(l + "." + H, A), x("BeforeChange." + H, A)
            }, getAjax: function(n) {
                F && i.addClass(F), t.updateStatus("loading");
                var o = e.extend({url: n.src, success: function(i, o, r) {
                        var a = {data: i, xhr: r};
                        T("ParseAjax", a), t.appendContent(e(a.data), H), n.finished = !0, L(), t._setFocus(), setTimeout(function() {
                            t.wrap.addClass(v)
                        }, 16), t.updateStatus("ready"), T("AjaxContentAdded")
                    }, error: function() {
                        L(), n.finished = n.loadError = !0, t.updateStatus("error", t.st.ajax.tError.replace("%url%", n.src))
                    }}, t.st.ajax.settings);
                return t.req = e.ajax(o), ""
            }}});
    var j, N = function(n) {
        if (n.data && void 0 !== n.data.title)
            return n.data.title;
        var i = t.st.image.titleSrc;
        if (i) {
            if (e.isFunction(i))
                return i.call(t, n);
            if (n.el)
                return n.el.attr(i) || ""
        }
        return""
    };
    e.magnificPopup.registerModule("image", {options: {markup: '<div class="mfp-figure"><div class="mfp-close"></div><figure><div class="mfp-img"></div><figcaption><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></figcaption></figure></div>', cursor: "mfp-zoom-out-cur", titleSrc: "title", verticalFit: !0, tError: '<a href="%url%">The image</a> could not be loaded.'}, proto: {initImage: function() {
                var e = t.st.image, n = ".image";
                t.types.push("image"), x(f + n, function() {
                    "image" === t.currItem.type && e.cursor && i.addClass(e.cursor)
                }), x(l + n, function() {
                    e.cursor && i.removeClass(e.cursor), I.off("resize" + h)
                }), x("Resize" + n, t.resizeImage), t.isLowIE && x("AfterChange", t.resizeImage)
            }, resizeImage: function() {
                var e = t.currItem;
                if (e && e.img && t.st.image.verticalFit) {
                    var n = 0;
                    t.isLowIE && (n = parseInt(e.img.css("padding-top"), 10) + parseInt(e.img.css("padding-bottom"), 10)), e.img.css("max-height", t.wH - n)
                }
            }, _onImageHasSize: function(e) {
                e.img && (e.hasSize = !0, j && clearInterval(j), e.isCheckingImgSize = !1, T("ImageHasSize", e), e.imgHidden && (t.content && t.content.removeClass("mfp-loading"), e.imgHidden = !1))
            }, findImageSize: function(e) {
                var n = 0, i = e.img[0], o = function(r) {
                    j && clearInterval(j), j = setInterval(function() {
                        return i.naturalWidth > 0 ? (t._onImageHasSize(e), void 0) : (n > 200 && clearInterval(j), n++, 3 === n ? o(10) : 40 === n ? o(50) : 100 === n && o(500), void 0)
                    }, r)
                };
                o(1)
            }, getImage: function(n, i) {
                var o = 0, r = function() {
                    n && (n.img[0].complete ? (n.img.off(".mfploader"), n === t.currItem && (t._onImageHasSize(n), t.updateStatus("ready")), n.hasSize = !0, n.loaded = !0, T("ImageLoadComplete")) : (o++, 200 > o ? setTimeout(r, 100) : a()))
                }, a = function() {
                    n && (n.img.off(".mfploader"), n === t.currItem && (t._onImageHasSize(n), t.updateStatus("error", s.tError.replace("%url%", n.src))), n.hasSize = !0, n.loaded = !0, n.loadError = !0)
                }, s = t.st.image, l = i.find(".mfp-img");
                if (l.length) {
                    var c = document.createElement("img");
                    c.className = "mfp-img", n.img = e(c).on("load.mfploader", r).on("error.mfploader", a), c.src = n.src, l.is("img") && (n.img = n.img.clone()), c = n.img[0], c.naturalWidth > 0 ? n.hasSize = !0 : c.width || (n.hasSize = !1)
                }
                return t._parseMarkup(i, {title: N(n), img_replaceWith: n.img}, n), t.resizeImage(), n.hasSize ? (j && clearInterval(j), n.loadError ? (i.addClass("mfp-loading"), t.updateStatus("error", s.tError.replace("%url%", n.src))) : (i.removeClass("mfp-loading"), t.updateStatus("ready")), i) : (t.updateStatus("loading"), n.loading = !0, n.hasSize || (n.imgHidden = !0, i.addClass("mfp-loading"), t.findImageSize(n)), i)
            }}});
    var W, R = function() {
        return void 0 === W && (W = void 0 !== document.createElement("p").style.MozTransform), W
    };
    e.magnificPopup.registerModule("zoom", {options: {enabled: !1, easing: "ease-in-out", duration: 300, opener: function(e) {
                return e.is("img") ? e : e.find("img")
            }}, proto: {initZoom: function() {
                var e, n = t.st.zoom, i = ".zoom";
                if (n.enabled && t.supportsTransition) {
                    var o, r, a = n.duration, s = function(e) {
                        var t = e.clone().removeAttr("style").removeAttr("class").addClass("mfp-animated-image"), i = "all " + n.duration / 1e3 + "s " + n.easing, o = {position: "fixed", zIndex: 9999, left: 0, top: 0, "-webkit-backface-visibility": "hidden"}, r = "transition";
                        return o["-webkit-" + r] = o["-moz-" + r] = o["-o-" + r] = o[r] = i, t.css(o), t
                    }, d = function() {
                        t.content.css("visibility", "visible")
                    };
                    x("BuildControls" + i, function() {
                        if (t._allowZoom()) {
                            if (clearTimeout(o), t.content.css("visibility", "hidden"), e = t._getItemToZoom(), !e)
                                return d(), void 0;
                            r = s(e), r.css(t._getOffset()), t.wrap.append(r), o = setTimeout(function() {
                                r.css(t._getOffset(!0)), o = setTimeout(function() {
                                    d(), setTimeout(function() {
                                        r.remove(), e = r = null, T("ZoomAnimationEnded")
                                    }, 16)
                                }, a)
                            }, 16)
                        }
                    }), x(c + i, function() {
                        if (t._allowZoom()) {
                            if (clearTimeout(o), t.st.removalDelay = a, !e) {
                                if (e = t._getItemToZoom(), !e)
                                    return;
                                r = s(e)
                            }
                            r.css(t._getOffset(!0)), t.wrap.append(r), t.content.css("visibility", "hidden"), setTimeout(function() {
                                r.css(t._getOffset())
                            }, 16)
                        }
                    }), x(l + i, function() {
                        t._allowZoom() && (d(), r && r.remove(), e = null)
                    })
                }
            }, _allowZoom: function() {
                return"image" === t.currItem.type
            }, _getItemToZoom: function() {
                return t.currItem.hasSize ? t.currItem.img : !1
            }, _getOffset: function(n) {
                var i;
                i = n ? t.currItem.img : t.st.zoom.opener(t.currItem.el || t.currItem);
                var o = i.offset(), r = parseInt(i.css("padding-top"), 10), a = parseInt(i.css("padding-bottom"), 10);
                o.top -= e(window).scrollTop() - r;
                var s = {width: i.width(), height: (b ? i.innerHeight() : i[0].offsetHeight) - a - r};
                return R() ? s["-moz-transform"] = s.transform = "translate(" + o.left + "px," + o.top + "px)" : (s.left = o.left, s.top = o.top), s
            }}});
    var Z = "iframe", q = "//about:blank", D = function(e) {
        if (t.currTemplate[Z]) {
            var n = t.currTemplate[Z].find("iframe");
            n.length && (e || (n[0].src = q), t.isIE8 && n.css("display", e ? "block" : "none"))
        }
    };
    e.magnificPopup.registerModule(Z, {options: {markup: '<div class="mfp-iframe-scaler"><div class="mfp-close"></div><iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe></div>', srcAction: "iframe_src", patterns: {youtube: {index: "youtube.com", id: "v=", src: "//www.youtube.com/embed/%id%?autoplay=1"}, vimeo: {index: "vimeo.com/", id: "/", src: "//player.vimeo.com/video/%id%?autoplay=1"}, gmaps: {index: "//maps.google.", src: "%id%&output=embed"}}}, proto: {initIframe: function() {
                t.types.push(Z), x("BeforeChange", function(e, t, n) {
                    t !== n && (t === Z ? D() : n === Z && D(!0))
                }), x(l + "." + Z, function() {
                    D()
                })
            }, getIframe: function(n, i) {
                var o = n.src, r = t.st.iframe;
                e.each(r.patterns, function() {
                    return o.indexOf(this.index) > -1 ? (this.id && (o = "string" == typeof this.id ? o.substr(o.lastIndexOf(this.id) + this.id.length, o.length) : this.id.call(this, o)), o = this.src.replace("%id%", o), !1) : void 0
                });
                var a = {};
                return r.srcAction && (a[r.srcAction] = o), t._parseMarkup(i, a, n), t.updateStatus("ready"), i
            }}});
    var K = function(e) {
        var n = t.items.length;
        return e > n - 1 ? e - n : 0 > e ? n + e : e
    }, Y = function(e, t, n) {
        return e.replace(/%curr%/gi, t + 1).replace(/%total%/gi, n)
    };
    e.magnificPopup.registerModule("gallery", {options: {enabled: !1, arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>', preload: [0, 2], navigateByImgClick: !0, arrows: !0, tPrev: "Previous (Left arrow key)", tNext: "Next (Right arrow key)", tCounter: "%curr% of %total%"}, proto: {initGallery: function() {
                var n = t.st.gallery, i = ".mfp-gallery", r = Boolean(e.fn.mfpFastClick);
                return t.direction = !0, n && n.enabled ? (a += " mfp-gallery", x(f + i, function() {
                    n.navigateByImgClick && t.wrap.on("click" + i, ".mfp-img", function() {
                        return t.items.length > 1 ? (t.next(), !1) : void 0
                    }), o.on("keydown" + i, function(e) {
                        37 === e.keyCode ? t.prev() : 39 === e.keyCode && t.next()
                    })
                }), x("UpdateStatus" + i, function(e, n) {
                    n.text && (n.text = Y(n.text, t.currItem.index, t.items.length))
                }), x(p + i, function(e, i, o, r) {
                    var a = t.items.length;
                    o.counter = a > 1 ? Y(n.tCounter, r.index, a) : ""
                }), x("BuildControls" + i, function() {
                    if (t.items.length > 1 && n.arrows && !t.arrowLeft) {
                        var i = n.arrowMarkup, o = t.arrowLeft = e(i.replace(/%title%/gi, n.tPrev).replace(/%dir%/gi, "left")).addClass(y), a = t.arrowRight = e(i.replace(/%title%/gi, n.tNext).replace(/%dir%/gi, "right")).addClass(y), s = r ? "mfpFastClick" : "click";
                        o[s](function() {
                            t.prev()
                        }), a[s](function() {
                            t.next()
                        }), t.isIE7 && (k("b", o[0], !1, !0), k("a", o[0], !1, !0), k("b", a[0], !1, !0), k("a", a[0], !1, !0)), t.container.append(o.add(a))
                    }
                }), x(m + i, function() {
                    t._preloadTimeout && clearTimeout(t._preloadTimeout), t._preloadTimeout = setTimeout(function() {
                        t.preloadNearbyImages(), t._preloadTimeout = null
                    }, 16)
                }), x(l + i, function() {
                    o.off(i), t.wrap.off("click" + i), t.arrowLeft && r && t.arrowLeft.add(t.arrowRight).destroyMfpFastClick(), t.arrowRight = t.arrowLeft = null
                }), void 0) : !1
            }, next: function() {
                t.direction = !0, t.index = K(t.index + 1), t.updateItemHTML()
            }, prev: function() {
                t.direction = !1, t.index = K(t.index - 1), t.updateItemHTML()
            }, goTo: function(e) {
                t.direction = e >= t.index, t.index = e, t.updateItemHTML()
            }, preloadNearbyImages: function() {
                var e, n = t.st.gallery.preload, i = Math.min(n[0], t.items.length), o = Math.min(n[1], t.items.length);
                for (e = 1; (t.direction?o:i) >= e; e++)
                    t._preloadItem(t.index + e);
                for (e = 1; (t.direction?i:o) >= e; e++)
                    t._preloadItem(t.index - e)
            }, _preloadItem: function(n) {
                if (n = K(n), !t.items[n].preloaded) {
                    var i = t.items[n];
                    i.parsed || (i = t.parseEl(n)), T("LazyLoad", i), "image" === i.type && (i.img = e('<img class="mfp-img" />').on("load.mfploader", function() {
                        i.hasSize = !0
                    }).on("error.mfploader", function() {
                        i.hasSize = !0, i.loadError = !0, T("LazyLoadError", i)
                    }).attr("src", i.src)), i.preloaded = !0
                }
            }}});
    var U = "retina";
    e.magnificPopup.registerModule(U, {options: {replaceSrc: function(e) {
                return e.src.replace(/\.\w+$/, function(e) {
                    return"@2x" + e
                })
            }, ratio: 1}, proto: {initRetina: function() {
                if (window.devicePixelRatio > 1) {
                    var e = t.st.retina, n = e.ratio;
                    n = isNaN(n) ? n() : n, n > 1 && (x("ImageHasSize." + U, function(e, t) {
                        t.img.css({"max-width": t.img[0].naturalWidth / n, width: "100%"})
                    }), x("ElementParse." + U, function(t, i) {
                        i.src = e.replaceSrc(i, n)
                    }))
                }
            }}}), function() {
        var t = 1e3, n = "ontouchstart"in window, i = function() {
            I.off("touchmove" + r + " touchend" + r)
        }, o = "mfpFastClick", r = "." + o;
        e.fn.mfpFastClick = function(o) {
            return e(this).each(function() {
                var a, s = e(this);
                if (n) {
                    var l, c, d, u, p, f;
                    s.on("touchstart" + r, function(e) {
                        u = !1, f = 1, p = e.originalEvent ? e.originalEvent.touches[0] : e.touches[0], c = p.clientX, d = p.clientY, I.on("touchmove" + r, function(e) {
                            p = e.originalEvent ? e.originalEvent.touches : e.touches, f = p.length, p = p[0], (Math.abs(p.clientX - c) > 10 || Math.abs(p.clientY - d) > 10) && (u = !0, i())
                        }).on("touchend" + r, function(e) {
                            i(), u || f > 1 || (a = !0, e.preventDefault(), clearTimeout(l), l = setTimeout(function() {
                                a = !1
                            }, t), o())
                        })
                    })
                }
                s.on("click" + r, function() {
                    a || o()
                })
            })
        }, e.fn.destroyMfpFastClick = function() {
            e(this).off("touchstart" + r + " click" + r), n && I.off("touchmove" + r + " touchend" + r)
        }
    }(), _()
})(window.jQuery || window.Zepto);

/**
 * BxSlider v4.1.2 - Fully loaded, responsive content slider
 * http://bxslider.com
 *
 * Copyright 2014, Steven Wanderski - http://stevenwanderski.com - http://bxcreative.com
 * Written while drinking Belgian ales and listening to jazz
 *
 * Released under the MIT license - http://opensource.org/licenses/MIT
 */
!function(t) {
    var e = {}, s = {mode: "horizontal", slideSelector: "", infiniteLoop: !0, hideControlOnEnd: !1, speed: 500, easing: null, slideMargin: 0, startSlide: 0, randomStart: !1, captions: !1, ticker: !1, tickerHover: !1, adaptiveHeight: !1, adaptiveHeightSpeed: 500, video: !1, useCSS: !0, preloadImages: "visible", responsive: !0, slideZIndex: 50, touchEnabled: !0, swipeThreshold: 50, oneToOneTouch: !0, preventDefaultSwipeX: !0, preventDefaultSwipeY: !1, pager: !0, pagerType: "full", pagerShortSeparator: " / ", pagerSelector: null, buildPager: null, pagerCustom: null, controls: !0, nextText: "Next", prevText: "Prev", nextSelector: null, prevSelector: null, autoControls: !1, startText: "Start", stopText: "Stop", autoControlsCombine: !1, autoControlsSelector: null, auto: !1, pause: 4e3, autoStart: !0, autoDirection: "next", autoHover: !1, autoDelay: 0, minSlides: 1, maxSlides: 1, moveSlides: 0, slideWidth: 0, onSliderLoad: function() {
        }, onSlideBefore: function() {
        }, onSlideAfter: function() {
        }, onSlideNext: function() {
        }, onSlidePrev: function() {
        }, onSliderResize: function() {
        }};
    t.fn.bxSlider = function(n) {
        if (0 == this.length)
            return this;
        if (this.length > 1)
            return this.each(function() {
                t(this).bxSlider(n)
            }), this;
        var o = {}, r = this;
        e.el = this;
        var a = t(window).width(), l = t(window).height(), d = function() {
            o.settings = t.extend({}, s, n), o.settings.slideWidth = parseInt(o.settings.slideWidth), o.children = r.children(o.settings.slideSelector), o.children.length < o.settings.minSlides && (o.settings.minSlides = o.children.length), o.children.length < o.settings.maxSlides && (o.settings.maxSlides = o.children.length), o.settings.randomStart && (o.settings.startSlide = Math.floor(Math.random() * o.children.length)), o.active = {index: o.settings.startSlide}, o.carousel = o.settings.minSlides > 1 || o.settings.maxSlides > 1, o.carousel && (o.settings.preloadImages = "all"), o.minThreshold = o.settings.minSlides * o.settings.slideWidth + (o.settings.minSlides - 1) * o.settings.slideMargin, o.maxThreshold = o.settings.maxSlides * o.settings.slideWidth + (o.settings.maxSlides - 1) * o.settings.slideMargin, o.working = !1, o.controls = {}, o.interval = null, o.animProp = "vertical" == o.settings.mode ? "top" : "left", o.usingCSS = o.settings.useCSS && "fade" != o.settings.mode && function() {
                var t = document.createElement("div"), e = ["WebkitPerspective", "MozPerspective", "OPerspective", "msPerspective"];
                for (var i in e)
                    if (void 0 !== t.style[e[i]])
                        return o.cssPrefix = e[i].replace("Perspective", "").toLowerCase(), o.animProp = "-" + o.cssPrefix + "-transform", !0;
                return!1
            }(), "vertical" == o.settings.mode && (o.settings.maxSlides = o.settings.minSlides), r.data("origStyle", r.attr("style")), r.children(o.settings.slideSelector).each(function() {
                t(this).data("origStyle", t(this).attr("style"))
            }), c()
        }, c = function() {
            r.wrap('<div class="bx-wrapper"><div class="bx-viewport"></div></div>'), o.viewport = r.parent(), o.loader = t('<div class="bx-loading" />'), o.viewport.prepend(o.loader), r.css({width: "horizontal" == o.settings.mode ? 100 * o.children.length + 215 + "%" : "auto", position: "relative"}), o.usingCSS && o.settings.easing ? r.css("-" + o.cssPrefix + "-transition-timing-function", o.settings.easing) : o.settings.easing || (o.settings.easing = "swing"), f(), o.viewport.css({width: "100%", overflow: "hidden", position: "relative"}), o.viewport.parent().css({maxWidth: p()}), o.settings.pager || o.viewport.parent().css({margin: "0 auto 0px"}), o.children.css({"float": "horizontal" == o.settings.mode ? "left" : "none", listStyle: "none", position: "relative"}), o.children.css("width", u()), "horizontal" == o.settings.mode && o.settings.slideMargin > 0 && o.children.css("marginRight", o.settings.slideMargin), "vertical" == o.settings.mode && o.settings.slideMargin > 0 && o.children.css("marginBottom", o.settings.slideMargin), "fade" == o.settings.mode && (o.children.css({position: "absolute", zIndex: 0, display: "none"}), o.children.eq(o.settings.startSlide).css({zIndex: o.settings.slideZIndex, display: "block"})), o.controls.el = t('<div class="bx-controls" />'), o.settings.captions && P(), o.active.last = o.settings.startSlide == x() - 1, o.settings.video && r.fitVids();
            var e = o.children.eq(o.settings.startSlide);
            "all" == o.settings.preloadImages && (e = o.children), o.settings.ticker ? o.settings.pager = !1 : (o.settings.pager && T(), o.settings.controls && C(), o.settings.auto && o.settings.autoControls && E(), (o.settings.controls || o.settings.autoControls || o.settings.pager) && o.viewport.after(o.controls.el)), g(e, h)
        }, g = function(e, i) {
            var s = e.find("img, iframe").length;
            if (0 == s)
                return i(), void 0;
            var n = 0;
            e.find("img, iframe").each(function() {
                t(this).one("load", function() {
                    ++n == s && i()
                }).each(function() {
                    this.complete && t(this).load()
                })
            })
        }, h = function() {
            if (o.settings.infiniteLoop && "fade" != o.settings.mode && !o.settings.ticker) {
                var e = "vertical" == o.settings.mode ? o.settings.minSlides : o.settings.maxSlides, i = o.children.slice(0, e).clone().addClass("bx-clone"), s = o.children.slice(-e).clone().addClass("bx-clone");
                r.append(i).prepend(s)
            }
            o.loader.remove(), S(), "vertical" == o.settings.mode && (o.settings.adaptiveHeight = !0), o.viewport.height(v()), r.redrawSlider(), o.settings.onSliderLoad(o.active.index), o.initialized = !0, o.settings.responsive && t(window).bind("resize", Z), o.settings.auto && o.settings.autoStart && H(), o.settings.ticker && L(), o.settings.pager && q(o.settings.startSlide), o.settings.controls && W(), o.settings.touchEnabled && !o.settings.ticker && O()
        }, v = function() {
            var e = 0, s = t();
            if ("vertical" == o.settings.mode || o.settings.adaptiveHeight)
                if (o.carousel) {
                    var n = 1 == o.settings.moveSlides ? o.active.index : o.active.index * m();
                    for (s = o.children.eq(n), i = 1; i <= o.settings.maxSlides - 1; i++)
                        s = n + i >= o.children.length ? s.add(o.children.eq(i - 1)) : s.add(o.children.eq(n + i))
                } else
                    s = o.children.eq(o.active.index);
            else
                s = o.children;
            return"vertical" == o.settings.mode ? (s.each(function() {
                e += t(this).outerHeight()
            }), o.settings.slideMargin > 0 && (e += o.settings.slideMargin * (o.settings.minSlides - 1))) : e = Math.max.apply(Math, s.map(function() {
                return t(this).outerHeight(!1)
            }).get()), e
        }, p = function() {
            var t = "100%";
            return o.settings.slideWidth > 0 && (t = "horizontal" == o.settings.mode ? o.settings.maxSlides * o.settings.slideWidth + (o.settings.maxSlides - 1) * o.settings.slideMargin : o.settings.slideWidth), t
        }, u = function() {
            var t = o.settings.slideWidth, e = o.viewport.width();
            return 0 == o.settings.slideWidth || o.settings.slideWidth > e && !o.carousel || "vertical" == o.settings.mode ? t = e : o.settings.maxSlides > 1 && "horizontal" == o.settings.mode && (e > o.maxThreshold || e < o.minThreshold && (t = (e - o.settings.slideMargin * (o.settings.minSlides - 1)) / o.settings.minSlides)), t
        }, f = function() {
            var t = 1;
            if ("horizontal" == o.settings.mode && o.settings.slideWidth > 0)
                if (o.viewport.width() < o.minThreshold)
                    t = o.settings.minSlides;
                else if (o.viewport.width() > o.maxThreshold)
                    t = o.settings.maxSlides;
                else {
                    var e = o.children.first().width();
                    t = Math.floor(o.viewport.width() / e)
                }
            else
                "vertical" == o.settings.mode && (t = o.settings.minSlides);
            return t
        }, x = function() {
            var t = 0;
            if (o.settings.moveSlides > 0)
                if (o.settings.infiniteLoop)
                    t = o.children.length / m();
                else
                    for (var e = 0, i = 0; e < o.children.length; )
                        ++t, e = i + f(), i += o.settings.moveSlides <= f() ? o.settings.moveSlides : f();
            else
                t = Math.ceil(o.children.length / f());
            return t
        }, m = function() {
            return o.settings.moveSlides > 0 && o.settings.moveSlides <= f() ? o.settings.moveSlides : f()
        }, S = function() {
            if (o.children.length > o.settings.maxSlides && o.active.last && !o.settings.infiniteLoop) {
                if ("horizontal" == o.settings.mode) {
                    var t = o.children.last(), e = t.position();
                    b(-(e.left - (o.viewport.width() - t.width())), "reset", 0)
                } else if ("vertical" == o.settings.mode) {
                    var i = o.children.length - o.settings.minSlides, e = o.children.eq(i).position();
                    b(-e.top, "reset", 0)
                }
            } else {
                var e = o.children.eq(o.active.index * m()).position();
                o.active.index == x() - 1 && (o.active.last = !0), void 0 != e && ("horizontal" == o.settings.mode ? b(-e.left, "reset", 0) : "vertical" == o.settings.mode && b(-e.top, "reset", 0))
            }
        }, b = function(t, e, i, s) {
            if (o.usingCSS) {
                var n = "vertical" == o.settings.mode ? "translate3d(0, " + t + "px, 0)" : "translate3d(" + t + "px, 0, 0)";
                r.css("-" + o.cssPrefix + "-transition-duration", i / 1e3 + "s"), "slide" == e ? (r.css(o.animProp, n), r.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function() {
                    r.unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd"), D()
                })) : "reset" == e ? r.css(o.animProp, n) : "ticker" == e && (r.css("-" + o.cssPrefix + "-transition-timing-function", "linear"), r.css(o.animProp, n), r.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function() {
                    r.unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd"), b(s.resetValue, "reset", 0), N()
                }))
            } else {
                var a = {};
                a[o.animProp] = t, "slide" == e ? r.animate(a, i, o.settings.easing, function() {
                    D()
                }) : "reset" == e ? r.css(o.animProp, t) : "ticker" == e && r.animate(a, speed, "linear", function() {
                    b(s.resetValue, "reset", 0), N()
                })
            }
        }, w = function() {
            for (var e = "", i = x(), s = 0; i > s; s++) {
                var n = "";
                o.settings.buildPager && t.isFunction(o.settings.buildPager) ? (n = o.settings.buildPager(s), o.pagerEl.addClass("bx-custom-pager")) : (n = s + 1, o.pagerEl.addClass("bx-default-pager")), e += '<div class="bx-pager-item"><a href="" data-slide-index="' + s + '" class="bx-pager-link">' + n + "</a></div>"
            }
            o.pagerEl.html(e)
        }, T = function() {
            o.settings.pagerCustom ? o.pagerEl = t(o.settings.pagerCustom) : (o.pagerEl = t('<div class="bx-pager" />'), o.settings.pagerSelector ? t(o.settings.pagerSelector).html(o.pagerEl) : o.controls.el.addClass("bx-has-pager").append(o.pagerEl), w()), o.pagerEl.on("click", "a", I)
        }, C = function() {
            o.controls.next = t('<a class="bx-next" href="">' + o.settings.nextText + "</a>"), o.controls.prev = t('<a class="bx-prev" href="">' + o.settings.prevText + "</a>"), o.controls.next.bind("click", y), o.controls.prev.bind("click", z), o.settings.nextSelector && t(o.settings.nextSelector).append(o.controls.next), o.settings.prevSelector && t(o.settings.prevSelector).append(o.controls.prev), o.settings.nextSelector || o.settings.prevSelector || (o.controls.directionEl = t('<div class="bx-controls-direction" />'), o.controls.directionEl.append(o.controls.prev).append(o.controls.next), o.controls.el.addClass("bx-has-controls-direction").append(o.controls.directionEl))
        }, E = function() {
            o.controls.start = t('<div class="bx-controls-auto-item"><a class="bx-start" href="">' + o.settings.startText + "</a></div>"), o.controls.stop = t('<div class="bx-controls-auto-item"><a class="bx-stop" href="">' + o.settings.stopText + "</a></div>"), o.controls.autoEl = t('<div class="bx-controls-auto" />'), o.controls.autoEl.on("click", ".bx-start", k), o.controls.autoEl.on("click", ".bx-stop", M), o.settings.autoControlsCombine ? o.controls.autoEl.append(o.controls.start) : o.controls.autoEl.append(o.controls.start).append(o.controls.stop), o.settings.autoControlsSelector ? t(o.settings.autoControlsSelector).html(o.controls.autoEl) : o.controls.el.addClass("bx-has-controls-auto").append(o.controls.autoEl), A(o.settings.autoStart ? "stop" : "start")
        }, P = function() {
            o.children.each(function() {
                var e = t(this).find("img:first").attr("title");
                void 0 != e && ("" + e).length && t(this).append('<div class="bx-caption"><span>' + e + "</span></div>")
            })
        }, y = function(t) {
            o.settings.auto && r.stopAuto(), r.goToNextSlide(), t.preventDefault()
        }, z = function(t) {
            o.settings.auto && r.stopAuto(), r.goToPrevSlide(), t.preventDefault()
        }, k = function(t) {
            r.startAuto(), t.preventDefault()
        }, M = function(t) {
            r.stopAuto(), t.preventDefault()
        }, I = function(e) {
            o.settings.auto && r.stopAuto();
            var i = t(e.currentTarget), s = parseInt(i.attr("data-slide-index"));
            s != o.active.index && r.goToSlide(s), e.preventDefault()
        }, q = function(e) {
            var i = o.children.length;
            return"short" == o.settings.pagerType ? (o.settings.maxSlides > 1 && (i = Math.ceil(o.children.length / o.settings.maxSlides)), o.pagerEl.html(e + 1 + o.settings.pagerShortSeparator + i), void 0) : (o.pagerEl.find("a").removeClass("active"), o.pagerEl.each(function(i, s) {
                t(s).find("a").eq(e).addClass("active")
            }), void 0)
        }, D = function() {
            if (o.settings.infiniteLoop) {
                var t = "";
                0 == o.active.index ? t = o.children.eq(0).position() : o.active.index == x() - 1 && o.carousel ? t = o.children.eq((x() - 1) * m()).position() : o.active.index == o.children.length - 1 && (t = o.children.eq(o.children.length - 1).position()), t && ("horizontal" == o.settings.mode ? b(-t.left, "reset", 0) : "vertical" == o.settings.mode && b(-t.top, "reset", 0))
            }
            o.working = !1, o.settings.onSlideAfter(o.children.eq(o.active.index), o.oldIndex, o.active.index)
        }, A = function(t) {
            o.settings.autoControlsCombine ? o.controls.autoEl.html(o.controls[t]) : (o.controls.autoEl.find("a").removeClass("active"), o.controls.autoEl.find("a:not(.bx-" + t + ")").addClass("active"))
        }, W = function() {
            1 == x() ? (o.controls.prev.addClass("disabled"), o.controls.next.addClass("disabled")) : !o.settings.infiniteLoop && o.settings.hideControlOnEnd && (0 == o.active.index ? (o.controls.prev.addClass("disabled"), o.controls.next.removeClass("disabled")) : o.active.index == x() - 1 ? (o.controls.next.addClass("disabled"), o.controls.prev.removeClass("disabled")) : (o.controls.prev.removeClass("disabled"), o.controls.next.removeClass("disabled")))
        }, H = function() {
            o.settings.autoDelay > 0 ? setTimeout(r.startAuto, o.settings.autoDelay) : r.startAuto(), o.settings.autoHover && r.hover(function() {
                o.interval && (r.stopAuto(!0), o.autoPaused = !0)
            }, function() {
                o.autoPaused && (r.startAuto(!0), o.autoPaused = null)
            })
        }, L = function() {
            var e = 0;
            if ("next" == o.settings.autoDirection)
                r.append(o.children.clone().addClass("bx-clone"));
            else {
                r.prepend(o.children.clone().addClass("bx-clone"));
                var i = o.children.first().position();
                e = "horizontal" == o.settings.mode ? -i.left : -i.top
            }
            b(e, "reset", 0), o.settings.pager = !1, o.settings.controls = !1, o.settings.autoControls = !1, o.settings.tickerHover && !o.usingCSS && o.viewport.hover(function() {
                r.stop()
            }, function() {
                var e = 0;
                o.children.each(function() {
                    e += "horizontal" == o.settings.mode ? t(this).outerWidth(!0) : t(this).outerHeight(!0)
                });
                var i = o.settings.speed / e, s = "horizontal" == o.settings.mode ? "left" : "top", n = i * (e - Math.abs(parseInt(r.css(s))));
                N(n)
            }), N()
        }, N = function(t) {
            speed = t ? t : o.settings.speed;
            var e = {left: 0, top: 0}, i = {left: 0, top: 0};
            "next" == o.settings.autoDirection ? e = r.find(".bx-clone").first().position() : i = o.children.first().position();
            var s = "horizontal" == o.settings.mode ? -e.left : -e.top, n = "horizontal" == o.settings.mode ? -i.left : -i.top, a = {resetValue: n};
            b(s, "ticker", speed, a)
        }, O = function() {
            o.touch = {start: {x: 0, y: 0}, end: {x: 0, y: 0}}, o.viewport.bind("touchstart", X)
        }, X = function(t) {
            if (o.working)
                t.preventDefault();
            else {
                o.touch.originalPos = r.position();
                var e = t.originalEvent;
                o.touch.start.x = e.changedTouches[0].pageX, o.touch.start.y = e.changedTouches[0].pageY, o.viewport.bind("touchmove", Y), o.viewport.bind("touchend", V)
            }
        }, Y = function(t) {
            var e = t.originalEvent, i = Math.abs(e.changedTouches[0].pageX - o.touch.start.x), s = Math.abs(e.changedTouches[0].pageY - o.touch.start.y);
            if (3 * i > s && o.settings.preventDefaultSwipeX ? t.preventDefault() : 3 * s > i && o.settings.preventDefaultSwipeY && t.preventDefault(), "fade" != o.settings.mode && o.settings.oneToOneTouch) {
                var n = 0;
                if ("horizontal" == o.settings.mode) {
                    var r = e.changedTouches[0].pageX - o.touch.start.x;
                    n = o.touch.originalPos.left + r
                } else {
                    var r = e.changedTouches[0].pageY - o.touch.start.y;
                    n = o.touch.originalPos.top + r
                }
                b(n, "reset", 0)
            }
        }, V = function(t) {
            o.viewport.unbind("touchmove", Y);
            var e = t.originalEvent, i = 0;
            if (o.touch.end.x = e.changedTouches[0].pageX, o.touch.end.y = e.changedTouches[0].pageY, "fade" == o.settings.mode) {
                var s = Math.abs(o.touch.start.x - o.touch.end.x);
                s >= o.settings.swipeThreshold && (o.touch.start.x > o.touch.end.x ? r.goToNextSlide() : r.goToPrevSlide(), r.stopAuto())
            } else {
                var s = 0;
                "horizontal" == o.settings.mode ? (s = o.touch.end.x - o.touch.start.x, i = o.touch.originalPos.left) : (s = o.touch.end.y - o.touch.start.y, i = o.touch.originalPos.top), !o.settings.infiniteLoop && (0 == o.active.index && s > 0 || o.active.last && 0 > s) ? b(i, "reset", 200) : Math.abs(s) >= o.settings.swipeThreshold ? (0 > s ? r.goToNextSlide() : r.goToPrevSlide(), r.stopAuto()) : b(i, "reset", 200)
            }
            o.viewport.unbind("touchend", V)
        }, Z = function() {
            var e = t(window).width(), i = t(window).height();
            (a != e || l != i) && (a = e, l = i, r.redrawSlider(), o.settings.onSliderResize.call(r, o.active.index))
        };
        return r.goToSlide = function(e, i) {
            if (!o.working && o.active.index != e)
                if (o.working = !0, o.oldIndex = o.active.index, o.active.index = 0 > e ? x() - 1 : e >= x() ? 0 : e, o.settings.onSlideBefore(o.children.eq(o.active.index), o.oldIndex, o.active.index), "next" == i ? o.settings.onSlideNext(o.children.eq(o.active.index), o.oldIndex, o.active.index) : "prev" == i && o.settings.onSlidePrev(o.children.eq(o.active.index), o.oldIndex, o.active.index), o.active.last = o.active.index >= x() - 1, o.settings.pager && q(o.active.index), o.settings.controls && W(), "fade" == o.settings.mode)
                    o.settings.adaptiveHeight && o.viewport.height() != v() && o.viewport.animate({height: v()}, o.settings.adaptiveHeightSpeed), o.children.filter(":visible").fadeOut(o.settings.speed).css({zIndex: 0}), o.children.eq(o.active.index).css("zIndex", o.settings.slideZIndex + 1).fadeIn(o.settings.speed, function() {
                        t(this).css("zIndex", o.settings.slideZIndex), D()
                    });
                else {
                    o.settings.adaptiveHeight && o.viewport.height() != v() && o.viewport.animate({height: v()}, o.settings.adaptiveHeightSpeed);
                    var s = 0, n = {left: 0, top: 0};
                    if (!o.settings.infiniteLoop && o.carousel && o.active.last)
                        if ("horizontal" == o.settings.mode) {
                            var a = o.children.eq(o.children.length - 1);
                            n = a.position(), s = o.viewport.width() - a.outerWidth()
                        } else {
                            var l = o.children.length - o.settings.minSlides;
                            n = o.children.eq(l).position()
                        }
                    else if (o.carousel && o.active.last && "prev" == i) {
                        var d = 1 == o.settings.moveSlides ? o.settings.maxSlides - m() : (x() - 1) * m() - (o.children.length - o.settings.maxSlides), a = r.children(".bx-clone").eq(d);
                        n = a.position()
                    } else if ("next" == i && 0 == o.active.index)
                        n = r.find("> .bx-clone").eq(o.settings.maxSlides).position(), o.active.last = !1;
                    else if (e >= 0) {
                        var c = e * m();
                        n = o.children.eq(c).position()
                    }
                    if ("undefined" != typeof n) {
                        var g = "horizontal" == o.settings.mode ? -(n.left - s) : -n.top;
                        b(g, "slide", o.settings.speed)
                    }
                }
        }, r.goToNextSlide = function() {
            if (o.settings.infiniteLoop || !o.active.last) {
                var t = parseInt(o.active.index) + 1;
                r.goToSlide(t, "next")
            }
        }, r.goToPrevSlide = function() {
            if (o.settings.infiniteLoop || 0 != o.active.index) {
                var t = parseInt(o.active.index) - 1;
                r.goToSlide(t, "prev")
            }
        }, r.startAuto = function(t) {
            o.interval || (o.interval = setInterval(function() {
                "next" == o.settings.autoDirection ? r.goToNextSlide() : r.goToPrevSlide()
            }, o.settings.pause), o.settings.autoControls && 1 != t && A("stop"))
        }, r.stopAuto = function(t) {
            o.interval && (clearInterval(o.interval), o.interval = null, o.settings.autoControls && 1 != t && A("start"))
        }, r.getCurrentSlide = function() {
            return o.active.index
        }, r.getCurrentSlideElement = function() {
            return o.children.eq(o.active.index)
        }, r.getSlideCount = function() {
            return o.children.length
        }, r.redrawSlider = function() {
            o.children.add(r.find(".bx-clone")).outerWidth(u()), o.viewport.css("height", v()), o.settings.ticker || S(), o.active.last && (o.active.index = x() - 1), o.active.index >= x() && (o.active.last = !0), o.settings.pager && !o.settings.pagerCustom && (w(), q(o.active.index))
        }, r.destroySlider = function() {
            o.initialized && (o.initialized = !1, t(".bx-clone", this).remove(), o.children.each(function() {
                void 0 != t(this).data("origStyle") ? t(this).attr("style", t(this).data("origStyle")) : t(this).removeAttr("style")
            }), void 0 != t(this).data("origStyle") ? this.attr("style", t(this).data("origStyle")) : t(this).removeAttr("style"), t(this).unwrap().unwrap(), o.controls.el && o.controls.el.remove(), o.controls.next && o.controls.next.remove(), o.controls.prev && o.controls.prev.remove(), o.pagerEl && o.settings.controls && o.pagerEl.remove(), t(".bx-caption", this).remove(), o.controls.autoEl && o.controls.autoEl.remove(), clearInterval(o.interval), o.settings.responsive && t(window).unbind("resize", Z))
        }, r.reloadSlider = function(t) {
            void 0 != t && (n = t), r.destroySlider(), d()
        }, d(), this
    }
}(jQuery); 
/*
 jQuery(document).ready(function($) {
 $('.parent-container').magnificPopup({
 delegate: 'a', // child items selector, by clicking on it popup will open
 type: 'image',
 gallery: {enabled: true}
 // other options
 });
 });
 */ 
jQuery(document).ready(function($) { 
    $('.bxslider').bxSlider({
        minSlides: 4,
        maxSlides: 5,
        slideWidth: 150,
        slideMargin: 18,
        pager: false,
        prevText: '',
        nextText: '',
    });
});