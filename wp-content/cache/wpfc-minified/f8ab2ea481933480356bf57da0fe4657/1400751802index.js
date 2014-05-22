
// source --> http://www.adenimmo.localhost/wp-includes/js/jquery/jquery.js?ver=1.11.0 
/*! jQuery v1.11.0 | (c) 2005, 2014 jQuery Foundation, Inc. | jquery.org/license */
!function(a, b) {
"object" == typeof module && "object" == typeof module.exports ? module.exports = a.document ? b(a, !0) : function(a) {
if (!a.document)
throw new Error("jQuery requires a window with a document");
return b(a)
} : b(a)
}("undefined" != typeof window ? window : this, function(a, b) {
var c = [], d = c.slice, e = c.concat, f = c.push, g = c.indexOf, h = {}, i = h.toString, j = h.hasOwnProperty, k = "".trim, l = {}, m = "1.11.0", n = function(a, b) {
return new n.fn.init(a, b)
}, o = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, p = /^-ms-/, q = /-([\da-z])/gi, r = function(a, b) {
return b.toUpperCase()
};
n.fn = n.prototype = {jquery: m, constructor: n, selector: "", length: 0, toArray: function() {
return d.call(this)
}, get: function(a) {
return null != a ? 0 > a ? this[a + this.length] : this[a] : d.call(this)
}, pushStack: function(a) {
var b = n.merge(this.constructor(), a);
return b.prevObject = this, b.context = this.context, b
}, each: function(a, b) {
return n.each(this, a, b)
}, map: function(a) {
return this.pushStack(n.map(this, function(b, c) {
return a.call(b, c, b)
}))
}, slice: function() {
return this.pushStack(d.apply(this, arguments))
}, first: function() {
return this.eq(0)
}, last: function() {
return this.eq(-1)
}, eq: function(a) {
var b = this.length, c = +a + (0 > a ? b : 0);
return this.pushStack(c >= 0 && b > c ? [this[c]] : [])
}, end: function() {
return this.prevObject || this.constructor(null)
}, push: f, sort: c.sort, splice: c.splice}, n.extend = n.fn.extend = function() {
var a, b, c, d, e, f, g = arguments[0] || {}, h = 1, i = arguments.length, j = !1;
for ("boolean" == typeof g && (j = g, g = arguments[h] || {}, h++), "object" == typeof g || n.isFunction(g) || (g = {}), h === i && (g = this, h--); i > h; h++)
if (null != (e = arguments[h]))
for (d in e)
a = g[d], c = e[d], g !== c && (j && c && (n.isPlainObject(c) || (b = n.isArray(c))) ? (b ? (b = !1, f = a && n.isArray(a) ? a : []) : f = a && n.isPlainObject(a) ? a : {}, g[d] = n.extend(j, f, c)) : void 0 !== c && (g[d] = c));
return g
}, n.extend({expando: "jQuery" + (m + Math.random()).replace(/\D/g, ""), isReady: !0, error: function(a) {
throw new Error(a)
}, noop: function() {
}, isFunction: function(a) {
return"function" === n.type(a)
}, isArray: Array.isArray || function(a) {
return"array" === n.type(a)
}, isWindow: function(a) {
return null != a && a == a.window
}, isNumeric: function(a) {
return a - parseFloat(a) >= 0
}, isEmptyObject: function(a) {
var b;
for (b in a)
return!1;
return!0
}, isPlainObject: function(a) {
var b;
if (!a || "object" !== n.type(a) || a.nodeType || n.isWindow(a))
return!1;
try {
if (a.constructor && !j.call(a, "constructor") && !j.call(a.constructor.prototype, "isPrototypeOf"))
return!1
} catch (c) {
return!1
}
if (l.ownLast)
for (b in a)
return j.call(a, b);
for (b in a)
;
return void 0 === b || j.call(a, b)
}, type: function(a) {
return null == a ? a + "" : "object" == typeof a || "function" == typeof a ? h[i.call(a)] || "object" : typeof a
}, globalEval: function(b) {
b && n.trim(b) && (a.execScript || function(b) {
a.eval.call(a, b)
})(b)
}, camelCase: function(a) {
return a.replace(p, "ms-").replace(q, r)
}, nodeName: function(a, b) {
return a.nodeName && a.nodeName.toLowerCase() === b.toLowerCase()
}, each: function(a, b, c) {
var d, e = 0, f = a.length, g = s(a);
if (c) {
if (g) {
for (; f > e; e++)
if (d = b.apply(a[e], c), d === !1)
break
} else
for (e in a)
if (d = b.apply(a[e], c), d === !1)
break
} else if (g) {
for (; f > e; e++)
if (d = b.call(a[e], e, a[e]), d === !1)
break
} else
for (e in a)
if (d = b.call(a[e], e, a[e]), d === !1)
break;
return a
}, trim: k && !k.call("\ufeff\xa0") ? function(a) {
return null == a ? "" : k.call(a)
} : function(a) {
return null == a ? "" : (a + "").replace(o, "")
}, makeArray: function(a, b) {
var c = b || [];
return null != a && (s(Object(a)) ? n.merge(c, "string" == typeof a ? [a] : a) : f.call(c, a)), c
}, inArray: function(a, b, c) {
var d;
if (b) {
if (g)
return g.call(b, a, c);
for (d = b.length, c = c?0 > c?Math.max(0, d + c):c:0; d > c; c++)
if (c in b && b[c] === a)
return c
}
return-1
}, merge: function(a, b) {
var c = +b.length, d = 0, e = a.length;
while (c > d)
a[e++] = b[d++];
if (c !== c)
while (void 0 !== b[d])
a[e++] = b[d++];
return a.length = e, a
}, grep: function(a, b, c) {
for (var d, e = [], f = 0, g = a.length, h = !c; g > f; f++)
d = !b(a[f], f), d !== h && e.push(a[f]);
return e
}, map: function(a, b, c) {
var d, f = 0, g = a.length, h = s(a), i = [];
if (h)
for (; g > f; f++)
d = b(a[f], f, c), null != d && i.push(d);
else
for (f in a)
d = b(a[f], f, c), null != d && i.push(d);
return e.apply([], i)
}, guid: 1, proxy: function(a, b) {
var c, e, f;
return"string" == typeof b && (f = a[b], b = a, a = f), n.isFunction(a) ? (c = d.call(arguments, 2), e = function() {
return a.apply(b || this, c.concat(d.call(arguments)))
}, e.guid = a.guid = a.guid || n.guid++, e) : void 0
}, now: function() {
return+new Date
}, support: l}), n.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function(a, b) {
h["[object " + b + "]"] = b.toLowerCase()
});
function s(a) {
var b = a.length, c = n.type(a);
return"function" === c || n.isWindow(a) ? !1 : 1 === a.nodeType && b ? !0 : "array" === c || 0 === b || "number" == typeof b && b > 0 && b - 1 in a
}
var t = function(a) {
var b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s = "sizzle" + -new Date, t = a.document, u = 0, v = 0, w = eb(), x = eb(), y = eb(), z = function(a, b) {
return a === b && (j = !0), 0
}, A = "undefined", B = 1 << 31, C = {}.hasOwnProperty, D = [], E = D.pop, F = D.push, G = D.push, H = D.slice, I = D.indexOf || function(a) {
for (var b = 0, c = this.length; c > b; b++)
if (this[b] === a)
return b;
return-1
}, J = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped", K = "[\\x20\\t\\r\\n\\f]", L = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+", M = L.replace("w", "w#"), N = "\\[" + K + "*(" + L + ")" + K + "*(?:([*^$|!~]?=)" + K + "*(?:(['\"])((?:\\\\.|[^\\\\])*?)\\3|(" + M + ")|)|)" + K + "*\\]", O = ":(" + L + ")(?:\\(((['\"])((?:\\\\.|[^\\\\])*?)\\3|((?:\\\\.|[^\\\\()[\\]]|" + N.replace(3, 8) + ")*)|.*)\\)|)", P = new RegExp("^" + K + "+|((?:^|[^\\\\])(?:\\\\.)*)" + K + "+$", "g"), Q = new RegExp("^" + K + "*," + K + "*"), R = new RegExp("^" + K + "*([>+~]|" + K + ")" + K + "*"), S = new RegExp("=" + K + "*([^\\]'\"]*?)" + K + "*\\]", "g"), T = new RegExp(O), U = new RegExp("^" + M + "$"), V = {ID: new RegExp("^#(" + L + ")"), CLASS: new RegExp("^\\.(" + L + ")"), TAG: new RegExp("^(" + L.replace("w", "w*") + ")"), ATTR: new RegExp("^" + N), PSEUDO: new RegExp("^" + O), CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + K + "*(even|odd|(([+-]|)(\\d*)n|)" + K + "*(?:([+-]|)" + K + "*(\\d+)|))" + K + "*\\)|)", "i"), bool: new RegExp("^(?:" + J + ")$", "i"), needsContext: new RegExp("^" + K + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + K + "*((?:-\\d)?\\d*)" + K + "*\\)|)(?=[^-]|$)", "i")}, W = /^(?:input|select|textarea|button)$/i, X = /^h\d$/i, Y = /^[^{]+\{\s*\[native \w/, Z = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/, $ = /[+~]/, _ = /'|\\/g, ab = new RegExp("\\\\([\\da-f]{1,6}" + K + "?|(" + K + ")|.)", "ig"), bb = function(a, b, c) {
var d = "0x" + b - 65536;
return d !== d || c ? b : 0 > d ? String.fromCharCode(d + 65536) : String.fromCharCode(d >> 10 | 55296, 1023 & d | 56320)
};
try {
G.apply(D = H.call(t.childNodes), t.childNodes), D[t.childNodes.length].nodeType
} catch (cb) {
G = {apply: D.length ? function(a, b) {
F.apply(a, H.call(b))
} : function(a, b) {
var c = a.length, d = 0;
while (a[c++] = b[d++])
;
a.length = c - 1
}}
}
function db(a, b, d, e) {
var f, g, h, i, j, m, p, q, u, v;
if ((b ? b.ownerDocument || b : t) !== l && k(b), b = b || l, d = d || [], !a || "string" != typeof a)
return d;
if (1 !== (i = b.nodeType) && 9 !== i)
return[];
if (n && !e) {
if (f = Z.exec(a))
if (h = f[1]) {
if (9 === i) {
if (g = b.getElementById(h), !g || !g.parentNode)
return d;
if (g.id === h)
return d.push(g), d
} else if (b.ownerDocument && (g = b.ownerDocument.getElementById(h)) && r(b, g) && g.id === h)
return d.push(g), d
} else {
if (f[2])
return G.apply(d, b.getElementsByTagName(a)), d;
if ((h = f[3]) && c.getElementsByClassName && b.getElementsByClassName)
return G.apply(d, b.getElementsByClassName(h)), d
}
if (c.qsa && (!o || !o.test(a))) {
if (q = p = s, u = b, v = 9 === i && a, 1 === i && "object" !== b.nodeName.toLowerCase()) {
m = ob(a), (p = b.getAttribute("id")) ? q = p.replace(_, "\\$&") : b.setAttribute("id", q), q = "[id='" + q + "'] ", j = m.length;
while (j--)
m[j] = q + pb(m[j]);
u = $.test(a) && mb(b.parentNode) || b, v = m.join(",")
}
if (v)
try {
return G.apply(d, u.querySelectorAll(v)), d
} catch (w) {
} finally {
p || b.removeAttribute("id")
}
}
}
return xb(a.replace(P, "$1"), b, d, e)
}
function eb() {
var a = [];
function b(c, e) {
return a.push(c + " ") > d.cacheLength && delete b[a.shift()], b[c + " "] = e
}
return b
}
function fb(a) {
return a[s] = !0, a
}
function gb(a) {
var b = l.createElement("div");
try {
return!!a(b)
} catch (c) {
return!1
} finally {
b.parentNode && b.parentNode.removeChild(b), b = null
}
}
function hb(a, b) {
var c = a.split("|"), e = a.length;
while (e--)
d.attrHandle[c[e]] = b
}
function ib(a, b) {
var c = b && a, d = c && 1 === a.nodeType && 1 === b.nodeType && (~b.sourceIndex || B) - (~a.sourceIndex || B);
if (d)
return d;
if (c)
while (c = c.nextSibling)
if (c === b)
return-1;
return a ? 1 : -1
}
function jb(a) {
return function(b) {
var c = b.nodeName.toLowerCase();
return"input" === c && b.type === a
}
}
function kb(a) {
return function(b) {
var c = b.nodeName.toLowerCase();
return("input" === c || "button" === c) && b.type === a
}
}
function lb(a) {
return fb(function(b) {
return b = +b, fb(function(c, d) {
var e, f = a([], c.length, b), g = f.length;
while (g--)
c[e = f[g]] && (c[e] = !(d[e] = c[e]))
})
})
}
function mb(a) {
return a && typeof a.getElementsByTagName !== A && a
}
c = db.support = {}, f = db.isXML = function(a) {
var b = a && (a.ownerDocument || a).documentElement;
return b ? "HTML" !== b.nodeName : !1
}, k = db.setDocument = function(a) {
var b, e = a ? a.ownerDocument || a : t, g = e.defaultView;
return e !== l && 9 === e.nodeType && e.documentElement ? (l = e, m = e.documentElement, n = !f(e), g && g !== g.top && (g.addEventListener ? g.addEventListener("unload", function() {
k()
}, !1) : g.attachEvent && g.attachEvent("onunload", function() {
k()
})), c.attributes = gb(function(a) {
return a.className = "i", !a.getAttribute("className")
}), c.getElementsByTagName = gb(function(a) {
return a.appendChild(e.createComment("")), !a.getElementsByTagName("*").length
}), c.getElementsByClassName = Y.test(e.getElementsByClassName) && gb(function(a) {
return a.innerHTML = "<div class='a'></div><div class='a i'></div>", a.firstChild.className = "i", 2 === a.getElementsByClassName("i").length
}), c.getById = gb(function(a) {
return m.appendChild(a).id = s, !e.getElementsByName || !e.getElementsByName(s).length
}), c.getById ? (d.find.ID = function(a, b) {
if (typeof b.getElementById !== A && n) {
var c = b.getElementById(a);
return c && c.parentNode ? [c] : []
}
}, d.filter.ID = function(a) {
var b = a.replace(ab, bb);
return function(a) {
return a.getAttribute("id") === b
}
}) : (delete d.find.ID, d.filter.ID = function(a) {
var b = a.replace(ab, bb);
return function(a) {
var c = typeof a.getAttributeNode !== A && a.getAttributeNode("id");
return c && c.value === b
}
}), d.find.TAG = c.getElementsByTagName ? function(a, b) {
return typeof b.getElementsByTagName !== A ? b.getElementsByTagName(a) : void 0
} : function(a, b) {
var c, d = [], e = 0, f = b.getElementsByTagName(a);
if ("*" === a) {
while (c = f[e++])
1 === c.nodeType && d.push(c);
return d
}
return f
}, d.find.CLASS = c.getElementsByClassName && function(a, b) {
return typeof b.getElementsByClassName !== A && n ? b.getElementsByClassName(a) : void 0
}, p = [], o = [], (c.qsa = Y.test(e.querySelectorAll)) && (gb(function(a) {
a.innerHTML = "<select t=''><option selected=''></option></select>", a.querySelectorAll("[t^='']").length && o.push("[*^$]=" + K + "*(?:''|\"\")"), a.querySelectorAll("[selected]").length || o.push("\\[" + K + "*(?:value|" + J + ")"), a.querySelectorAll(":checked").length || o.push(":checked")
}), gb(function(a) {
var b = e.createElement("input");
b.setAttribute("type", "hidden"), a.appendChild(b).setAttribute("name", "D"), a.querySelectorAll("[name=d]").length && o.push("name" + K + "*[*^$|!~]?="), a.querySelectorAll(":enabled").length || o.push(":enabled", ":disabled"), a.querySelectorAll("*,:x"), o.push(",.*:")
})), (c.matchesSelector = Y.test(q = m.webkitMatchesSelector || m.mozMatchesSelector || m.oMatchesSelector || m.msMatchesSelector)) && gb(function(a) {
c.disconnectedMatch = q.call(a, "div"), q.call(a, "[s!='']:x"), p.push("!=", O)
}), o = o.length && new RegExp(o.join("|")), p = p.length && new RegExp(p.join("|")), b = Y.test(m.compareDocumentPosition), r = b || Y.test(m.contains) ? function(a, b) {
var c = 9 === a.nodeType ? a.documentElement : a, d = b && b.parentNode;
return a === d || !(!d || 1 !== d.nodeType || !(c.contains ? c.contains(d) : a.compareDocumentPosition && 16 & a.compareDocumentPosition(d)))
} : function(a, b) {
if (b)
while (b = b.parentNode)
if (b === a)
return!0;
return!1
}, z = b ? function(a, b) {
if (a === b)
return j = !0, 0;
var d = !a.compareDocumentPosition - !b.compareDocumentPosition;
return d ? d : (d = (a.ownerDocument || a) === (b.ownerDocument || b) ? a.compareDocumentPosition(b) : 1, 1 & d || !c.sortDetached && b.compareDocumentPosition(a) === d ? a === e || a.ownerDocument === t && r(t, a) ? -1 : b === e || b.ownerDocument === t && r(t, b) ? 1 : i ? I.call(i, a) - I.call(i, b) : 0 : 4 & d ? -1 : 1)
} : function(a, b) {
if (a === b)
return j = !0, 0;
var c, d = 0, f = a.parentNode, g = b.parentNode, h = [a], k = [b];
if (!f || !g)
return a === e ? -1 : b === e ? 1 : f ? -1 : g ? 1 : i ? I.call(i, a) - I.call(i, b) : 0;
if (f === g)
return ib(a, b);
c = a;
while (c = c.parentNode)
h.unshift(c);
c = b;
while (c = c.parentNode)
k.unshift(c);
while (h[d] === k[d])
d++;
return d ? ib(h[d], k[d]) : h[d] === t ? -1 : k[d] === t ? 1 : 0
}, e) : l
}, db.matches = function(a, b) {
return db(a, null, null, b)
}, db.matchesSelector = function(a, b) {
if ((a.ownerDocument || a) !== l && k(a), b = b.replace(S, "='$1']"), !(!c.matchesSelector || !n || p && p.test(b) || o && o.test(b)))
try {
var d = q.call(a, b);
if (d || c.disconnectedMatch || a.document && 11 !== a.document.nodeType)
return d
} catch (e) {
}
return db(b, l, null, [a]).length > 0
}, db.contains = function(a, b) {
return(a.ownerDocument || a) !== l && k(a), r(a, b)
}, db.attr = function(a, b) {
(a.ownerDocument || a) !== l && k(a);
var e = d.attrHandle[b.toLowerCase()], f = e && C.call(d.attrHandle, b.toLowerCase()) ? e(a, b, !n) : void 0;
return void 0 !== f ? f : c.attributes || !n ? a.getAttribute(b) : (f = a.getAttributeNode(b)) && f.specified ? f.value : null
}, db.error = function(a) {
throw new Error("Syntax error, unrecognized expression: " + a)
}, db.uniqueSort = function(a) {
var b, d = [], e = 0, f = 0;
if (j = !c.detectDuplicates, i = !c.sortStable && a.slice(0), a.sort(z), j) {
while (b = a[f++])
b === a[f] && (e = d.push(f));
while (e--)
a.splice(d[e], 1)
}
return i = null, a
}, e = db.getText = function(a) {
var b, c = "", d = 0, f = a.nodeType;
if (f) {
if (1 === f || 9 === f || 11 === f) {
if ("string" == typeof a.textContent)
return a.textContent;
for (a = a.firstChild; a; a = a.nextSibling)
c += e(a)
} else if (3 === f || 4 === f)
return a.nodeValue
} else
while (b = a[d++])
c += e(b);
return c
}, d = db.selectors = {cacheLength: 50, createPseudo: fb, match: V, attrHandle: {}, find: {}, relative: {">": {dir: "parentNode", first: !0}, " ": {dir: "parentNode"}, "+": {dir: "previousSibling", first: !0}, "~": {dir: "previousSibling"}}, preFilter: {ATTR: function(a) {
return a[1] = a[1].replace(ab, bb), a[3] = (a[4] || a[5] || "").replace(ab, bb), "~=" === a[2] && (a[3] = " " + a[3] + " "), a.slice(0, 4)
}, CHILD: function(a) {
return a[1] = a[1].toLowerCase(), "nth" === a[1].slice(0, 3) ? (a[3] || db.error(a[0]), a[4] = +(a[4] ? a[5] + (a[6] || 1) : 2 * ("even" === a[3] || "odd" === a[3])), a[5] = +(a[7] + a[8] || "odd" === a[3])) : a[3] && db.error(a[0]), a
}, PSEUDO: function(a) {
var b, c = !a[5] && a[2];
return V.CHILD.test(a[0]) ? null : (a[3] && void 0 !== a[4] ? a[2] = a[4] : c && T.test(c) && (b = ob(c, !0)) && (b = c.indexOf(")", c.length - b) - c.length) && (a[0] = a[0].slice(0, b), a[2] = c.slice(0, b)), a.slice(0, 3))
}}, filter: {TAG: function(a) {
var b = a.replace(ab, bb).toLowerCase();
return"*" === a ? function() {
return!0
} : function(a) {
return a.nodeName && a.nodeName.toLowerCase() === b
}
}, CLASS: function(a) {
var b = w[a + " "];
return b || (b = new RegExp("(^|" + K + ")" + a + "(" + K + "|$)")) && w(a, function(a) {
return b.test("string" == typeof a.className && a.className || typeof a.getAttribute !== A && a.getAttribute("class") || "")
})
}, ATTR: function(a, b, c) {
return function(d) {
var e = db.attr(d, a);
return null == e ? "!=" === b : b ? (e += "", "=" === b ? e === c : "!=" === b ? e !== c : "^=" === b ? c && 0 === e.indexOf(c) : "*=" === b ? c && e.indexOf(c) > -1 : "$=" === b ? c && e.slice(-c.length) === c : "~=" === b ? (" " + e + " ").indexOf(c) > -1 : "|=" === b ? e === c || e.slice(0, c.length + 1) === c + "-" : !1) : !0
}
}, CHILD: function(a, b, c, d, e) {
var f = "nth" !== a.slice(0, 3), g = "last" !== a.slice(-4), h = "of-type" === b;
return 1 === d && 0 === e ? function(a) {
return!!a.parentNode
} : function(b, c, i) {
var j, k, l, m, n, o, p = f !== g ? "nextSibling" : "previousSibling", q = b.parentNode, r = h && b.nodeName.toLowerCase(), t = !i && !h;
if (q) {
if (f) {
while (p) {
l = b;
while (l = l[p])
if (h ? l.nodeName.toLowerCase() === r : 1 === l.nodeType)
return!1;
o = p = "only" === a && !o && "nextSibling"
}
return!0
}
if (o = [g ? q.firstChild : q.lastChild], g && t) {
k = q[s] || (q[s] = {}), j = k[a] || [], n = j[0] === u && j[1], m = j[0] === u && j[2], l = n && q.childNodes[n];
while (l = ++n && l && l[p] || (m = n = 0) || o.pop())
if (1 === l.nodeType && ++m && l === b) {
k[a] = [u, n, m];
break
}
} else if (t && (j = (b[s] || (b[s] = {}))[a]) && j[0] === u)
m = j[1];
else
while (l = ++n && l && l[p] || (m = n = 0) || o.pop())
if ((h ? l.nodeName.toLowerCase() === r : 1 === l.nodeType) && ++m && (t && ((l[s] || (l[s] = {}))[a] = [u, m]), l === b))
break;
return m -= e, m === d || m % d === 0 && m / d >= 0
}
}
}, PSEUDO: function(a, b) {
var c, e = d.pseudos[a] || d.setFilters[a.toLowerCase()] || db.error("unsupported pseudo: " + a);
return e[s] ? e(b) : e.length > 1 ? (c = [a, a, "", b], d.setFilters.hasOwnProperty(a.toLowerCase()) ? fb(function(a, c) {
var d, f = e(a, b), g = f.length;
while (g--)
d = I.call(a, f[g]), a[d] = !(c[d] = f[g])
}) : function(a) {
return e(a, 0, c)
}) : e
}}, pseudos: {not: fb(function(a) {
var b = [], c = [], d = g(a.replace(P, "$1"));
return d[s] ? fb(function(a, b, c, e) {
var f, g = d(a, null, e, []), h = a.length;
while (h--)
(f = g[h]) && (a[h] = !(b[h] = f))
}) : function(a, e, f) {
return b[0] = a, d(b, null, f, c), !c.pop()
}
}), has: fb(function(a) {
return function(b) {
return db(a, b).length > 0
}
}), contains: fb(function(a) {
return function(b) {
return(b.textContent || b.innerText || e(b)).indexOf(a) > -1
}
}), lang: fb(function(a) {
return U.test(a || "") || db.error("unsupported lang: " + a), a = a.replace(ab, bb).toLowerCase(), function(b) {
var c;
do
if (c = n ? b.lang : b.getAttribute("xml:lang") || b.getAttribute("lang"))
return c = c.toLowerCase(), c === a || 0 === c.indexOf(a + "-");
while ((b = b.parentNode) && 1 === b.nodeType);
return!1
}
}), target: function(b) {
var c = a.location && a.location.hash;
return c && c.slice(1) === b.id
}, root: function(a) {
return a === m
}, focus: function(a) {
return a === l.activeElement && (!l.hasFocus || l.hasFocus()) && !!(a.type || a.href || ~a.tabIndex)
}, enabled: function(a) {
return a.disabled === !1
}, disabled: function(a) {
return a.disabled === !0
}, checked: function(a) {
var b = a.nodeName.toLowerCase();
return"input" === b && !!a.checked || "option" === b && !!a.selected
}, selected: function(a) {
return a.parentNode && a.parentNode.selectedIndex, a.selected === !0
}, empty: function(a) {
for (a = a.firstChild; a; a = a.nextSibling)
if (a.nodeType < 6)
return!1;
return!0
}, parent: function(a) {
return!d.pseudos.empty(a)
}, header: function(a) {
return X.test(a.nodeName)
}, input: function(a) {
return W.test(a.nodeName)
}, button: function(a) {
var b = a.nodeName.toLowerCase();
return"input" === b && "button" === a.type || "button" === b
}, text: function(a) {
var b;
return"input" === a.nodeName.toLowerCase() && "text" === a.type && (null == (b = a.getAttribute("type")) || "text" === b.toLowerCase())
}, first: lb(function() {
return[0]
}), last: lb(function(a, b) {
return[b - 1]
}), eq: lb(function(a, b, c) {
return[0 > c ? c + b : c]
}), even: lb(function(a, b) {
for (var c = 0; b > c; c += 2)
a.push(c);
return a
}), odd: lb(function(a, b) {
for (var c = 1; b > c; c += 2)
a.push(c);
return a
}), lt: lb(function(a, b, c) {
for (var d = 0 > c ? c + b : c; --d >= 0; )
a.push(d);
return a
}), gt: lb(function(a, b, c) {
for (var d = 0 > c ? c + b : c; ++d < b; )
a.push(d);
return a
})}}, d.pseudos.nth = d.pseudos.eq;
for (b in{radio:!0, checkbox:!0, file:!0, password:!0, image:!0})
d.pseudos[b] = jb(b);
for (b in{submit:!0, reset:!0})
d.pseudos[b] = kb(b);
function nb() {
}
nb.prototype = d.filters = d.pseudos, d.setFilters = new nb;
function ob(a, b) {
var c, e, f, g, h, i, j, k = x[a + " "];
if (k)
return b ? 0 : k.slice(0);
h = a, i = [], j = d.preFilter;
while (h) {
(!c || (e = Q.exec(h))) && (e && (h = h.slice(e[0].length) || h), i.push(f = [])), c = !1, (e = R.exec(h)) && (c = e.shift(), f.push({value: c, type: e[0].replace(P, " ")}), h = h.slice(c.length));
for (g in d.filter)
!(e = V[g].exec(h)) || j[g] && !(e = j[g](e)) || (c = e.shift(), f.push({value: c, type: g, matches: e}), h = h.slice(c.length));
if (!c)
break
}
return b ? h.length : h ? db.error(a) : x(a, i).slice(0)
}
function pb(a) {
for (var b = 0, c = a.length, d = ""; c > b; b++)
d += a[b].value;
return d
}
function qb(a, b, c) {
var d = b.dir, e = c && "parentNode" === d, f = v++;
return b.first ? function(b, c, f) {
while (b = b[d])
if (1 === b.nodeType || e)
return a(b, c, f)
} : function(b, c, g) {
var h, i, j = [u, f];
if (g) {
while (b = b[d])
if ((1 === b.nodeType || e) && a(b, c, g))
return!0
} else
while (b = b[d])
if (1 === b.nodeType || e) {
if (i = b[s] || (b[s] = {}), (h = i[d]) && h[0] === u && h[1] === f)
return j[2] = h[2];
if (i[d] = j, j[2] = a(b, c, g))
return!0
}
}
}
function rb(a) {
return a.length > 1 ? function(b, c, d) {
var e = a.length;
while (e--)
if (!a[e](b, c, d))
return!1;
return!0
} : a[0]
}
function sb(a, b, c, d, e) {
for (var f, g = [], h = 0, i = a.length, j = null != b; i > h; h++)
(f = a[h]) && (!c || c(f, d, e)) && (g.push(f), j && b.push(h));
return g
}
function tb(a, b, c, d, e, f) {
return d && !d[s] && (d = tb(d)), e && !e[s] && (e = tb(e, f)), fb(function(f, g, h, i) {
var j, k, l, m = [], n = [], o = g.length, p = f || wb(b || "*", h.nodeType ? [h] : h, []), q = !a || !f && b ? p : sb(p, m, a, h, i), r = c ? e || (f ? a : o || d) ? [] : g : q;
if (c && c(q, r, h, i), d) {
j = sb(r, n), d(j, [], h, i), k = j.length;
while (k--)
(l = j[k]) && (r[n[k]] = !(q[n[k]] = l))
}
if (f) {
if (e || a) {
if (e) {
j = [], k = r.length;
while (k--)
(l = r[k]) && j.push(q[k] = l);
e(null, r = [], j, i)
}
k = r.length;
while (k--)
(l = r[k]) && (j = e ? I.call(f, l) : m[k]) > -1 && (f[j] = !(g[j] = l))
}
} else
r = sb(r === g ? r.splice(o, r.length) : r), e ? e(null, g, r, i) : G.apply(g, r)
})
}
function ub(a) {
for (var b, c, e, f = a.length, g = d.relative[a[0].type], i = g || d.relative[" "], j = g ? 1 : 0, k = qb(function(a) {
return a === b
}, i, !0), l = qb(function(a) {
return I.call(b, a) > -1
}, i, !0), m = [function(a, c, d) {
return!g && (d || c !== h) || ((b = c).nodeType ? k(a, c, d) : l(a, c, d))
}]; f > j; j++)
if (c = d.relative[a[j].type])
m = [qb(rb(m), c)];
else {
if (c = d.filter[a[j].type].apply(null, a[j].matches), c[s]) {
for (e = ++j; f > e; e++)
if (d.relative[a[e].type])
break;
return tb(j > 1 && rb(m), j > 1 && pb(a.slice(0, j - 1).concat({value: " " === a[j - 2].type ? "*" : ""})).replace(P, "$1"), c, e > j && ub(a.slice(j, e)), f > e && ub(a = a.slice(e)), f > e && pb(a))
}
m.push(c)
}
return rb(m)
}
function vb(a, b) {
var c = b.length > 0, e = a.length > 0, f = function(f, g, i, j, k) {
var m, n, o, p = 0, q = "0", r = f && [], s = [], t = h, v = f || e && d.find.TAG("*", k), w = u += null == t ? 1 : Math.random() || .1, x = v.length;
for (k && (h = g !== l && g); q !== x && null != (m = v[q]); q++) {
if (e && m) {
n = 0;
while (o = a[n++])
if (o(m, g, i)) {
j.push(m);
break
}
k && (u = w)
}
c && ((m = !o && m) && p--, f && r.push(m))
}
if (p += q, c && q !== p) {
n = 0;
while (o = b[n++])
o(r, s, g, i);
if (f) {
if (p > 0)
while (q--)
r[q] || s[q] || (s[q] = E.call(j));
s = sb(s)
}
G.apply(j, s), k && !f && s.length > 0 && p + b.length > 1 && db.uniqueSort(j)
}
return k && (u = w, h = t), r
};
return c ? fb(f) : f
}
g = db.compile = function(a, b) {
var c, d = [], e = [], f = y[a + " "];
if (!f) {
b || (b = ob(a)), c = b.length;
while (c--)
f = ub(b[c]), f[s] ? d.push(f) : e.push(f);
f = y(a, vb(e, d))
}
return f
};
function wb(a, b, c) {
for (var d = 0, e = b.length; e > d; d++)
db(a, b[d], c);
return c
}
function xb(a, b, e, f) {
var h, i, j, k, l, m = ob(a);
if (!f && 1 === m.length) {
if (i = m[0] = m[0].slice(0), i.length > 2 && "ID" === (j = i[0]).type && c.getById && 9 === b.nodeType && n && d.relative[i[1].type]) {
if (b = (d.find.ID(j.matches[0].replace(ab, bb), b) || [])[0], !b)
return e;
a = a.slice(i.shift().value.length)
}
h = V.needsContext.test(a) ? 0 : i.length;
while (h--) {
if (j = i[h], d.relative[k = j.type])
break;
if ((l = d.find[k]) && (f = l(j.matches[0].replace(ab, bb), $.test(i[0].type) && mb(b.parentNode) || b))) {
if (i.splice(h, 1), a = f.length && pb(i), !a)
return G.apply(e, f), e;
break
}
}
}
return g(a, m)(f, b, !n, e, $.test(a) && mb(b.parentNode) || b), e
}
return c.sortStable = s.split("").sort(z).join("") === s, c.detectDuplicates = !!j, k(), c.sortDetached = gb(function(a) {
return 1 & a.compareDocumentPosition(l.createElement("div"))
}), gb(function(a) {
return a.innerHTML = "<a href='#'></a>", "#" === a.firstChild.getAttribute("href")
}) || hb("type|href|height|width", function(a, b, c) {
return c ? void 0 : a.getAttribute(b, "type" === b.toLowerCase() ? 1 : 2)
}), c.attributes && gb(function(a) {
return a.innerHTML = "<input/>", a.firstChild.setAttribute("value", ""), "" === a.firstChild.getAttribute("value")
}) || hb("value", function(a, b, c) {
return c || "input" !== a.nodeName.toLowerCase() ? void 0 : a.defaultValue
}), gb(function(a) {
return null == a.getAttribute("disabled")
}) || hb(J, function(a, b, c) {
var d;
return c ? void 0 : a[b] === !0 ? b.toLowerCase() : (d = a.getAttributeNode(b)) && d.specified ? d.value : null
}), db
}(a);
n.find = t, n.expr = t.selectors, n.expr[":"] = n.expr.pseudos, n.unique = t.uniqueSort, n.text = t.getText, n.isXMLDoc = t.isXML, n.contains = t.contains;
var u = n.expr.match.needsContext, v = /^<(\w+)\s*\/?>(?:<\/\1>|)$/, w = /^.[^:#\[\.,]*$/;
function x(a, b, c) {
if (n.isFunction(b))
return n.grep(a, function(a, d) {
return!!b.call(a, d, a) !== c
});
if (b.nodeType)
return n.grep(a, function(a) {
return a === b !== c
});
if ("string" == typeof b) {
if (w.test(b))
return n.filter(b, a, c);
b = n.filter(b, a)
}
return n.grep(a, function(a) {
return n.inArray(a, b) >= 0 !== c
})
}
n.filter = function(a, b, c) {
var d = b[0];
return c && (a = ":not(" + a + ")"), 1 === b.length && 1 === d.nodeType ? n.find.matchesSelector(d, a) ? [d] : [] : n.find.matches(a, n.grep(b, function(a) {
return 1 === a.nodeType
}))
}, n.fn.extend({find: function(a) {
var b, c = [], d = this, e = d.length;
if ("string" != typeof a)
return this.pushStack(n(a).filter(function() {
for (b = 0; e > b; b++)
if (n.contains(d[b], this))
return!0
}));
for (b = 0; e > b; b++)
n.find(a, d[b], c);
return c = this.pushStack(e > 1 ? n.unique(c) : c), c.selector = this.selector ? this.selector + " " + a : a, c
}, filter: function(a) {
return this.pushStack(x(this, a || [], !1))
}, not: function(a) {
return this.pushStack(x(this, a || [], !0))
}, is: function(a) {
return!!x(this, "string" == typeof a && u.test(a) ? n(a) : a || [], !1).length
}});
var y, z = a.document, A = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/, B = n.fn.init = function(a, b) {
var c, d;
if (!a)
return this;
if ("string" == typeof a) {
if (c = "<" === a.charAt(0) && ">" === a.charAt(a.length - 1) && a.length >= 3 ? [null, a, null] : A.exec(a), !c || !c[1] && b)
return!b || b.jquery ? (b || y).find(a) : this.constructor(b).find(a);
if (c[1]) {
if (b = b instanceof n ? b[0] : b, n.merge(this, n.parseHTML(c[1], b && b.nodeType ? b.ownerDocument || b : z, !0)), v.test(c[1]) && n.isPlainObject(b))
for (c in b)
n.isFunction(this[c]) ? this[c](b[c]) : this.attr(c, b[c]);
return this
}
if (d = z.getElementById(c[2]), d && d.parentNode) {
if (d.id !== c[2])
return y.find(a);
this.length = 1, this[0] = d
}
return this.context = z, this.selector = a, this
}
return a.nodeType ? (this.context = this[0] = a, this.length = 1, this) : n.isFunction(a) ? "undefined" != typeof y.ready ? y.ready(a) : a(n) : (void 0 !== a.selector && (this.selector = a.selector, this.context = a.context), n.makeArray(a, this))
};
B.prototype = n.fn, y = n(z);
var C = /^(?:parents|prev(?:Until|All))/, D = {children: !0, contents: !0, next: !0, prev: !0};
n.extend({dir: function(a, b, c) {
var d = [], e = a[b];
while (e && 9 !== e.nodeType && (void 0 === c || 1 !== e.nodeType || !n(e).is(c)))
1 === e.nodeType && d.push(e), e = e[b];
return d
}, sibling: function(a, b) {
for (var c = []; a; a = a.nextSibling)
1 === a.nodeType && a !== b && c.push(a);
return c
}}), n.fn.extend({has: function(a) {
var b, c = n(a, this), d = c.length;
return this.filter(function() {
for (b = 0; d > b; b++)
if (n.contains(this, c[b]))
return!0
})
}, closest: function(a, b) {
for (var c, d = 0, e = this.length, f = [], g = u.test(a) || "string" != typeof a ? n(a, b || this.context) : 0; e > d; d++)
for (c = this[d]; c && c !== b; c = c.parentNode)
if (c.nodeType < 11 && (g ? g.index(c) > -1 : 1 === c.nodeType && n.find.matchesSelector(c, a))) {
f.push(c);
break
}
return this.pushStack(f.length > 1 ? n.unique(f) : f)
}, index: function(a) {
return a ? "string" == typeof a ? n.inArray(this[0], n(a)) : n.inArray(a.jquery ? a[0] : a, this) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
}, add: function(a, b) {
return this.pushStack(n.unique(n.merge(this.get(), n(a, b))))
}, addBack: function(a) {
return this.add(null == a ? this.prevObject : this.prevObject.filter(a))
}});
function E(a, b) {
do
a = a[b];
while (a && 1 !== a.nodeType);
return a
}
n.each({parent: function(a) {
var b = a.parentNode;
return b && 11 !== b.nodeType ? b : null
}, parents: function(a) {
return n.dir(a, "parentNode")
}, parentsUntil: function(a, b, c) {
return n.dir(a, "parentNode", c)
}, next: function(a) {
return E(a, "nextSibling")
}, prev: function(a) {
return E(a, "previousSibling")
}, nextAll: function(a) {
return n.dir(a, "nextSibling")
}, prevAll: function(a) {
return n.dir(a, "previousSibling")
}, nextUntil: function(a, b, c) {
return n.dir(a, "nextSibling", c)
}, prevUntil: function(a, b, c) {
return n.dir(a, "previousSibling", c)
}, siblings: function(a) {
return n.sibling((a.parentNode || {}).firstChild, a)
}, children: function(a) {
return n.sibling(a.firstChild)
}, contents: function(a) {
return n.nodeName(a, "iframe") ? a.contentDocument || a.contentWindow.document : n.merge([], a.childNodes)
}}, function(a, b) {
n.fn[a] = function(c, d) {
var e = n.map(this, b, c);
return"Until" !== a.slice(-5) && (d = c), d && "string" == typeof d && (e = n.filter(d, e)), this.length > 1 && (D[a] || (e = n.unique(e)), C.test(a) && (e = e.reverse())), this.pushStack(e)
}
});
var F = /\S+/g, G = {};
function H(a) {
var b = G[a] = {};
return n.each(a.match(F) || [], function(a, c) {
b[c] = !0
}), b
}
n.Callbacks = function(a) {
a = "string" == typeof a ? G[a] || H(a) : n.extend({}, a);
var b, c, d, e, f, g, h = [], i = !a.once && [], j = function(l) {
for (c = a.memory && l, d = !0, f = g || 0, g = 0, e = h.length, b = !0; h && e > f; f++)
if (h[f].apply(l[0], l[1]) === !1 && a.stopOnFalse) {
c = !1;
break
}
b = !1, h && (i ? i.length && j(i.shift()) : c ? h = [] : k.disable())
}, k = {add: function() {
if (h) {
var d = h.length;
!function f(b) {
n.each(b, function(b, c) {
var d = n.type(c);
"function" === d ? a.unique && k.has(c) || h.push(c) : c && c.length && "string" !== d && f(c)
})
}(arguments), b ? e = h.length : c && (g = d, j(c))
}
return this
}, remove: function() {
return h && n.each(arguments, function(a, c) {
var d;
while ((d = n.inArray(c, h, d)) > - 1)
h.splice(d, 1), b && (e >= d && e--, f >= d && f--)
}), this
}, has: function(a) {
return a ? n.inArray(a, h) > -1 : !(!h || !h.length)
}, empty: function() {
return h = [], e = 0, this
}, disable: function() {
return h = i = c = void 0, this
}, disabled: function() {
return!h
}, lock: function() {
return i = void 0, c || k.disable(), this
}, locked: function() {
return!i
}, fireWith: function(a, c) {
return!h || d && !i || (c = c || [], c = [a, c.slice ? c.slice() : c], b ? i.push(c) : j(c)), this
}, fire: function() {
return k.fireWith(this, arguments), this
}, fired: function() {
return!!d
}};
return k
}, n.extend({Deferred: function(a) {
var b = [["resolve", "done", n.Callbacks("once memory"), "resolved"], ["reject", "fail", n.Callbacks("once memory"), "rejected"], ["notify", "progress", n.Callbacks("memory")]], c = "pending", d = {state: function() {
return c
}, always: function() {
return e.done(arguments).fail(arguments), this
}, then: function() {
var a = arguments;
return n.Deferred(function(c) {
n.each(b, function(b, f) {
var g = n.isFunction(a[b]) && a[b];
e[f[1]](function() {
var a = g && g.apply(this, arguments);
a && n.isFunction(a.promise) ? a.promise().done(c.resolve).fail(c.reject).progress(c.notify) : c[f[0] + "With"](this === d ? c.promise() : this, g ? [a] : arguments)
})
}), a = null
}).promise()
}, promise: function(a) {
return null != a ? n.extend(a, d) : d
}}, e = {};
return d.pipe = d.then, n.each(b, function(a, f) {
var g = f[2], h = f[3];
d[f[1]] = g.add, h && g.add(function() {
c = h
}, b[1 ^ a][2].disable, b[2][2].lock), e[f[0]] = function() {
return e[f[0] + "With"](this === e ? d : this, arguments), this
}, e[f[0] + "With"] = g.fireWith
}), d.promise(e), a && a.call(e, e), e
}, when: function(a) {
var b = 0, c = d.call(arguments), e = c.length, f = 1 !== e || a && n.isFunction(a.promise) ? e : 0, g = 1 === f ? a : n.Deferred(), h = function(a, b, c) {
return function(e) {
b[a] = this, c[a] = arguments.length > 1 ? d.call(arguments) : e, c === i ? g.notifyWith(b, c) : --f || g.resolveWith(b, c)
}
}, i, j, k;
if (e > 1)
for (i = new Array(e), j = new Array(e), k = new Array(e); e > b; b++)
c[b] && n.isFunction(c[b].promise) ? c[b].promise().done(h(b, k, c)).fail(g.reject).progress(h(b, j, i)) : --f;
return f || g.resolveWith(k, c), g.promise()
}});
var I;
n.fn.ready = function(a) {
return n.ready.promise().done(a), this
}, n.extend({isReady: !1, readyWait: 1, holdReady: function(a) {
a ? n.readyWait++ : n.ready(!0)
}, ready: function(a) {
if (a === !0 ? !--n.readyWait : !n.isReady) {
if (!z.body)
return setTimeout(n.ready);
n.isReady = !0, a !== !0 && --n.readyWait > 0 || (I.resolveWith(z, [n]), n.fn.trigger && n(z).trigger("ready").off("ready"))
}
}});
function J() {
z.addEventListener ? (z.removeEventListener("DOMContentLoaded", K, !1), a.removeEventListener("load", K, !1)) : (z.detachEvent("onreadystatechange", K), a.detachEvent("onload", K))
}
function K() {
(z.addEventListener || "load" === event.type || "complete" === z.readyState) && (J(), n.ready())
}
n.ready.promise = function(b) {
if (!I)
if (I = n.Deferred(), "complete" === z.readyState)
setTimeout(n.ready);
else if (z.addEventListener)
z.addEventListener("DOMContentLoaded", K, !1), a.addEventListener("load", K, !1);
else {
z.attachEvent("onreadystatechange", K), a.attachEvent("onload", K);
var c = !1;
try {
c = null == a.frameElement && z.documentElement
} catch (d) {
}
c && c.doScroll && !function e() {
if (!n.isReady) {
try {
c.doScroll("left")
} catch (a) {
return setTimeout(e, 50)
}
J(), n.ready()
}
}()
}
return I.promise(b)
};
var L = "undefined", M;
for (M in n(l))
break;
l.ownLast = "0" !== M, l.inlineBlockNeedsLayout = !1, n(function() {
var a, b, c = z.getElementsByTagName("body")[0];
c && (a = z.createElement("div"), a.style.cssText = "border:0;width:0;height:0;position:absolute;top:0;left:-9999px;margin-top:1px", b = z.createElement("div"), c.appendChild(a).appendChild(b), typeof b.style.zoom !== L && (b.style.cssText = "border:0;margin:0;width:1px;padding:1px;display:inline;zoom:1", (l.inlineBlockNeedsLayout = 3 === b.offsetWidth) && (c.style.zoom = 1)), c.removeChild(a), a = b = null)
}), function() {
var a = z.createElement("div");
if (null == l.deleteExpando) {
l.deleteExpando = !0;
try {
delete a.test
} catch (b) {
l.deleteExpando = !1
}
}
a = null
}(), n.acceptData = function(a) {
var b = n.noData[(a.nodeName + " ").toLowerCase()], c = +a.nodeType || 1;
return 1 !== c && 9 !== c ? !1 : !b || b !== !0 && a.getAttribute("classid") === b
};
var N = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/, O = /([A-Z])/g;
function P(a, b, c) {
if (void 0 === c && 1 === a.nodeType) {
var d = "data-" + b.replace(O, "-$1").toLowerCase();
if (c = a.getAttribute(d), "string" == typeof c) {
try {
c = "true" === c ? !0 : "false" === c ? !1 : "null" === c ? null : +c + "" === c ? +c : N.test(c) ? n.parseJSON(c) : c
} catch (e) {
}
n.data(a, b, c)
} else
c = void 0
}
return c
}
function Q(a) {
var b;
for (b in a)
if (("data" !== b || !n.isEmptyObject(a[b])) && "toJSON" !== b)
return!1;
return!0
}
function R(a, b, d, e) {
if (n.acceptData(a)) {
var f, g, h = n.expando, i = a.nodeType, j = i ? n.cache : a, k = i ? a[h] : a[h] && h;
if (k && j[k] && (e || j[k].data) || void 0 !== d || "string" != typeof b)
return k || (k = i ? a[h] = c.pop() || n.guid++ : h), j[k] || (j[k] = i ? {} : {toJSON: n.noop}), ("object" == typeof b || "function" == typeof b) && (e ? j[k] = n.extend(j[k], b) : j[k].data = n.extend(j[k].data, b)), g = j[k], e || (g.data || (g.data = {}), g = g.data), void 0 !== d && (g[n.camelCase(b)] = d), "string" == typeof b ? (f = g[b], null == f && (f = g[n.camelCase(b)])) : f = g, f
}
}
function S(a, b, c) {
if (n.acceptData(a)) {
var d, e, f = a.nodeType, g = f ? n.cache : a, h = f ? a[n.expando] : n.expando;
if (g[h]) {
if (b && (d = c ? g[h] : g[h].data)) {
n.isArray(b) ? b = b.concat(n.map(b, n.camelCase)) : b in d ? b = [b] : (b = n.camelCase(b), b = b in d ? [b] : b.split(" ")), e = b.length;
while (e--)
delete d[b[e]];
if (c ? !Q(d) : !n.isEmptyObject(d))
return
}
(c || (delete g[h].data, Q(g[h]))) && (f ? n.cleanData([a], !0) : l.deleteExpando || g != g.window ? delete g[h] : g[h] = null)
}
}
}
n.extend({cache: {}, noData: {"applet ": !0, "embed ": !0, "object ": "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"}, hasData: function(a) {
return a = a.nodeType ? n.cache[a[n.expando]] : a[n.expando], !!a && !Q(a)
}, data: function(a, b, c) {
return R(a, b, c)
}, removeData: function(a, b) {
return S(a, b)
}, _data: function(a, b, c) {
return R(a, b, c, !0)
}, _removeData: function(a, b) {
return S(a, b, !0)
}}), n.fn.extend({data: function(a, b) {
var c, d, e, f = this[0], g = f && f.attributes;
if (void 0 === a) {
if (this.length && (e = n.data(f), 1 === f.nodeType && !n._data(f, "parsedAttrs"))) {
c = g.length;
while (c--)
d = g[c].name, 0 === d.indexOf("data-") && (d = n.camelCase(d.slice(5)), P(f, d, e[d]));
n._data(f, "parsedAttrs", !0)
}
return e
}
return"object" == typeof a ? this.each(function() {
n.data(this, a)
}) : arguments.length > 1 ? this.each(function() {
n.data(this, a, b)
}) : f ? P(f, a, n.data(f, a)) : void 0
}, removeData: function(a) {
return this.each(function() {
n.removeData(this, a)
})
}}), n.extend({queue: function(a, b, c) {
var d;
return a ? (b = (b || "fx") + "queue", d = n._data(a, b), c && (!d || n.isArray(c) ? d = n._data(a, b, n.makeArray(c)) : d.push(c)), d || []) : void 0
}, dequeue: function(a, b) {
b = b || "fx";
var c = n.queue(a, b), d = c.length, e = c.shift(), f = n._queueHooks(a, b), g = function() {
n.dequeue(a, b)
};
"inprogress" === e && (e = c.shift(), d--), e && ("fx" === b && c.unshift("inprogress"), delete f.stop, e.call(a, g, f)), !d && f && f.empty.fire()
}, _queueHooks: function(a, b) {
var c = b + "queueHooks";
return n._data(a, c) || n._data(a, c, {empty: n.Callbacks("once memory").add(function() {
n._removeData(a, b + "queue"), n._removeData(a, c)
})})
}}), n.fn.extend({queue: function(a, b) {
var c = 2;
return"string" != typeof a && (b = a, a = "fx", c--), arguments.length < c ? n.queue(this[0], a) : void 0 === b ? this : this.each(function() {
var c = n.queue(this, a, b);
n._queueHooks(this, a), "fx" === a && "inprogress" !== c[0] && n.dequeue(this, a)
})
}, dequeue: function(a) {
return this.each(function() {
n.dequeue(this, a)
})
}, clearQueue: function(a) {
return this.queue(a || "fx", [])
}, promise: function(a, b) {
var c, d = 1, e = n.Deferred(), f = this, g = this.length, h = function() {
--d || e.resolveWith(f, [f])
};
"string" != typeof a && (b = a, a = void 0), a = a || "fx";
while (g--)
c = n._data(f[g], a + "queueHooks"), c && c.empty && (d++, c.empty.add(h));
return h(), e.promise(b)
}});
var T = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source, U = ["Top", "Right", "Bottom", "Left"], V = function(a, b) {
return a = b || a, "none" === n.css(a, "display") || !n.contains(a.ownerDocument, a)
}, W = n.access = function(a, b, c, d, e, f, g) {
var h = 0, i = a.length, j = null == c;
if ("object" === n.type(c)) {
e = !0;
for (h in c)
n.access(a, b, h, c[h], !0, f, g)
} else if (void 0 !== d && (e = !0, n.isFunction(d) || (g = !0), j && (g ? (b.call(a, d), b = null) : (j = b, b = function(a, b, c) {
return j.call(n(a), c)
})), b))
for (; i > h; h++)
b(a[h], c, g ? d : d.call(a[h], h, b(a[h], c)));
return e ? a : j ? b.call(a) : i ? b(a[0], c) : f
}, X = /^(?:checkbox|radio)$/i;
!function() {
var a = z.createDocumentFragment(), b = z.createElement("div"), c = z.createElement("input");
if (b.setAttribute("className", "t"), b.innerHTML = "  <link/><table></table><a href='/a'>a</a>", l.leadingWhitespace = 3 === b.firstChild.nodeType, l.tbody = !b.getElementsByTagName("tbody").length, l.htmlSerialize = !!b.getElementsByTagName("link").length, l.html5Clone = "<:nav></:nav>" !== z.createElement("nav").cloneNode(!0).outerHTML, c.type = "checkbox", c.checked = !0, a.appendChild(c), l.appendChecked = c.checked, b.innerHTML = "<textarea>x</textarea>", l.noCloneChecked = !!b.cloneNode(!0).lastChild.defaultValue, a.appendChild(b), b.innerHTML = "<input type='radio' checked='checked' name='t'/>", l.checkClone = b.cloneNode(!0).cloneNode(!0).lastChild.checked, l.noCloneEvent = !0, b.attachEvent && (b.attachEvent("onclick", function() {
l.noCloneEvent = !1
}), b.cloneNode(!0).click()), null == l.deleteExpando) {
l.deleteExpando = !0;
try {
delete b.test
} catch (d) {
l.deleteExpando = !1
}
}
a = b = c = null
}(), function() {
var b, c, d = z.createElement("div");
for (b in{submit:!0, change:!0, focusin:!0})
c = "on" + b, (l[b + "Bubbles"] = c in a) || (d.setAttribute(c, "t"), l[b + "Bubbles"] = d.attributes[c].expando === !1);
d = null
}();
var Y = /^(?:input|select|textarea)$/i, Z = /^key/, $ = /^(?:mouse|contextmenu)|click/, _ = /^(?:focusinfocus|focusoutblur)$/, ab = /^([^.]*)(?:\.(.+)|)$/;
function bb() {
return!0
}
function cb() {
return!1
}
function db() {
try {
return z.activeElement
} catch (a) {
}
}
n.event = {global: {}, add: function(a, b, c, d, e) {
var f, g, h, i, j, k, l, m, o, p, q, r = n._data(a);
if (r) {
c.handler && (i = c, c = i.handler, e = i.selector), c.guid || (c.guid = n.guid++), (g = r.events) || (g = r.events = {}), (k = r.handle) || (k = r.handle = function(a) {
return typeof n === L || a && n.event.triggered === a.type ? void 0 : n.event.dispatch.apply(k.elem, arguments)
}, k.elem = a), b = (b || "").match(F) || [""], h = b.length;
while (h--)
f = ab.exec(b[h]) || [], o = q = f[1], p = (f[2] || "").split(".").sort(), o && (j = n.event.special[o] || {}, o = (e ? j.delegateType : j.bindType) || o, j = n.event.special[o] || {}, l = n.extend({type: o, origType: q, data: d, handler: c, guid: c.guid, selector: e, needsContext: e && n.expr.match.needsContext.test(e), namespace: p.join(".")}, i), (m = g[o]) || (m = g[o] = [], m.delegateCount = 0, j.setup && j.setup.call(a, d, p, k) !== !1 || (a.addEventListener ? a.addEventListener(o, k, !1) : a.attachEvent && a.attachEvent("on" + o, k))), j.add && (j.add.call(a, l), l.handler.guid || (l.handler.guid = c.guid)), e ? m.splice(m.delegateCount++, 0, l) : m.push(l), n.event.global[o] = !0);
a = null
}
}, remove: function(a, b, c, d, e) {
var f, g, h, i, j, k, l, m, o, p, q, r = n.hasData(a) && n._data(a);
if (r && (k = r.events)) {
b = (b || "").match(F) || [""], j = b.length;
while (j--)
if (h = ab.exec(b[j]) || [], o = q = h[1], p = (h[2] || "").split(".").sort(), o) {
l = n.event.special[o] || {}, o = (d ? l.delegateType : l.bindType) || o, m = k[o] || [], h = h[2] && new RegExp("(^|\\.)" + p.join("\\.(?:.*\\.|)") + "(\\.|$)"), i = f = m.length;
while (f--)
g = m[f], !e && q !== g.origType || c && c.guid !== g.guid || h && !h.test(g.namespace) || d && d !== g.selector && ("**" !== d || !g.selector) || (m.splice(f, 1), g.selector && m.delegateCount--, l.remove && l.remove.call(a, g));
i && !m.length && (l.teardown && l.teardown.call(a, p, r.handle) !== !1 || n.removeEvent(a, o, r.handle), delete k[o])
} else
for (o in k)
n.event.remove(a, o + b[j], c, d, !0);
n.isEmptyObject(k) && (delete r.handle, n._removeData(a, "events"))
}
}, trigger: function(b, c, d, e) {
var f, g, h, i, k, l, m, o = [d || z], p = j.call(b, "type") ? b.type : b, q = j.call(b, "namespace") ? b.namespace.split(".") : [];
if (h = l = d = d || z, 3 !== d.nodeType && 8 !== d.nodeType && !_.test(p + n.event.triggered) && (p.indexOf(".") >= 0 && (q = p.split("."), p = q.shift(), q.sort()), g = p.indexOf(":") < 0 && "on" + p, b = b[n.expando] ? b : new n.Event(p, "object" == typeof b && b), b.isTrigger = e ? 2 : 3, b.namespace = q.join("."), b.namespace_re = b.namespace ? new RegExp("(^|\\.)" + q.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, b.result = void 0, b.target || (b.target = d), c = null == c ? [b] : n.makeArray(c, [b]), k = n.event.special[p] || {}, e || !k.trigger || k.trigger.apply(d, c) !== !1)) {
if (!e && !k.noBubble && !n.isWindow(d)) {
for (i = k.delegateType || p, _.test(i + p) || (h = h.parentNode); h; h = h.parentNode)
o.push(h), l = h;
l === (d.ownerDocument || z) && o.push(l.defaultView || l.parentWindow || a)
}
m = 0;
while ((h = o[m++]) && !b.isPropagationStopped())
b.type = m > 1 ? i : k.bindType || p, f = (n._data(h, "events") || {})[b.type] && n._data(h, "handle"), f && f.apply(h, c), f = g && h[g], f && f.apply && n.acceptData(h) && (b.result = f.apply(h, c), b.result === !1 && b.preventDefault());
if (b.type = p, !e && !b.isDefaultPrevented() && (!k._default || k._default.apply(o.pop(), c) === !1) && n.acceptData(d) && g && d[p] && !n.isWindow(d)) {
l = d[g], l && (d[g] = null), n.event.triggered = p;
try {
d[p]()
} catch (r) {
}
n.event.triggered = void 0, l && (d[g] = l)
}
return b.result
}
}, dispatch: function(a) {
a = n.event.fix(a);
var b, c, e, f, g, h = [], i = d.call(arguments), j = (n._data(this, "events") || {})[a.type] || [], k = n.event.special[a.type] || {};
if (i[0] = a, a.delegateTarget = this, !k.preDispatch || k.preDispatch.call(this, a) !== !1) {
h = n.event.handlers.call(this, a, j), b = 0;
while ((f = h[b++]) && !a.isPropagationStopped()) {
a.currentTarget = f.elem, g = 0;
while ((e = f.handlers[g++]) && !a.isImmediatePropagationStopped())
(!a.namespace_re || a.namespace_re.test(e.namespace)) && (a.handleObj = e, a.data = e.data, c = ((n.event.special[e.origType] || {}).handle || e.handler).apply(f.elem, i), void 0 !== c && (a.result = c) === !1 && (a.preventDefault(), a.stopPropagation()))
}
return k.postDispatch && k.postDispatch.call(this, a), a.result
}
}, handlers: function(a, b) {
var c, d, e, f, g = [], h = b.delegateCount, i = a.target;
if (h && i.nodeType && (!a.button || "click" !== a.type))
for (; i != this; i = i.parentNode || this)
if (1 === i.nodeType && (i.disabled !== !0 || "click" !== a.type)) {
for (e = [], f = 0; h > f; f++)
d = b[f], c = d.selector + " ", void 0 === e[c] && (e[c] = d.needsContext ? n(c, this).index(i) >= 0 : n.find(c, this, null, [i]).length), e[c] && e.push(d);
e.length && g.push({elem: i, handlers: e})
}
return h < b.length && g.push({elem: this, handlers: b.slice(h)}), g
}, fix: function(a) {
if (a[n.expando])
return a;
var b, c, d, e = a.type, f = a, g = this.fixHooks[e];
g || (this.fixHooks[e] = g = $.test(e) ? this.mouseHooks : Z.test(e) ? this.keyHooks : {}), d = g.props ? this.props.concat(g.props) : this.props, a = new n.Event(f), b = d.length;
while (b--)
c = d[b], a[c] = f[c];
return a.target || (a.target = f.srcElement || z), 3 === a.target.nodeType && (a.target = a.target.parentNode), a.metaKey = !!a.metaKey, g.filter ? g.filter(a, f) : a
}, props: "altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "), fixHooks: {}, keyHooks: {props: "char charCode key keyCode".split(" "), filter: function(a, b) {
return null == a.which && (a.which = null != b.charCode ? b.charCode : b.keyCode), a
}}, mouseHooks: {props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "), filter: function(a, b) {
var c, d, e, f = b.button, g = b.fromElement;
return null == a.pageX && null != b.clientX && (d = a.target.ownerDocument || z, e = d.documentElement, c = d.body, a.pageX = b.clientX + (e && e.scrollLeft || c && c.scrollLeft || 0) - (e && e.clientLeft || c && c.clientLeft || 0), a.pageY = b.clientY + (e && e.scrollTop || c && c.scrollTop || 0) - (e && e.clientTop || c && c.clientTop || 0)), !a.relatedTarget && g && (a.relatedTarget = g === a.target ? b.toElement : g), a.which || void 0 === f || (a.which = 1 & f ? 1 : 2 & f ? 3 : 4 & f ? 2 : 0), a
}}, special: {load: {noBubble: !0}, focus: {trigger: function() {
if (this !== db() && this.focus)
try {
return this.focus(), !1
} catch (a) {
}
}, delegateType: "focusin"}, blur: {trigger: function() {
return this === db() && this.blur ? (this.blur(), !1) : void 0
}, delegateType: "focusout"}, click: {trigger: function() {
return n.nodeName(this, "input") && "checkbox" === this.type && this.click ? (this.click(), !1) : void 0
}, _default: function(a) {
return n.nodeName(a.target, "a")
}}, beforeunload: {postDispatch: function(a) {
void 0 !== a.result && (a.originalEvent.returnValue = a.result)
}}}, simulate: function(a, b, c, d) {
var e = n.extend(new n.Event, c, {type: a, isSimulated: !0, originalEvent: {}});
d ? n.event.trigger(e, null, b) : n.event.dispatch.call(b, e), e.isDefaultPrevented() && c.preventDefault()
}}, n.removeEvent = z.removeEventListener ? function(a, b, c) {
a.removeEventListener && a.removeEventListener(b, c, !1)
} : function(a, b, c) {
var d = "on" + b;
a.detachEvent && (typeof a[d] === L && (a[d] = null), a.detachEvent(d, c))
}, n.Event = function(a, b) {
return this instanceof n.Event ? (a && a.type ? (this.originalEvent = a, this.type = a.type, this.isDefaultPrevented = a.defaultPrevented || void 0 === a.defaultPrevented && (a.returnValue === !1 || a.getPreventDefault && a.getPreventDefault()) ? bb : cb) : this.type = a, b && n.extend(this, b), this.timeStamp = a && a.timeStamp || n.now(), void(this[n.expando] = !0)) : new n.Event(a, b)
}, n.Event.prototype = {isDefaultPrevented: cb, isPropagationStopped: cb, isImmediatePropagationStopped: cb, preventDefault: function() {
var a = this.originalEvent;
this.isDefaultPrevented = bb, a && (a.preventDefault ? a.preventDefault() : a.returnValue = !1)
}, stopPropagation: function() {
var a = this.originalEvent;
this.isPropagationStopped = bb, a && (a.stopPropagation && a.stopPropagation(), a.cancelBubble = !0)
}, stopImmediatePropagation: function() {
this.isImmediatePropagationStopped = bb, this.stopPropagation()
}}, n.each({mouseenter: "mouseover", mouseleave: "mouseout"}, function(a, b) {
n.event.special[a] = {delegateType: b, bindType: b, handle: function(a) {
var c, d = this, e = a.relatedTarget, f = a.handleObj;
return(!e || e !== d && !n.contains(d, e)) && (a.type = f.origType, c = f.handler.apply(this, arguments), a.type = b), c
}}
}), l.submitBubbles || (n.event.special.submit = {setup: function() {
return n.nodeName(this, "form") ? !1 : void n.event.add(this, "click._submit keypress._submit", function(a) {
var b = a.target, c = n.nodeName(b, "input") || n.nodeName(b, "button") ? b.form : void 0;
c && !n._data(c, "submitBubbles") && (n.event.add(c, "submit._submit", function(a) {
a._submit_bubble = !0
}), n._data(c, "submitBubbles", !0))
})
}, postDispatch: function(a) {
a._submit_bubble && (delete a._submit_bubble, this.parentNode && !a.isTrigger && n.event.simulate("submit", this.parentNode, a, !0))
}, teardown: function() {
return n.nodeName(this, "form") ? !1 : void n.event.remove(this, "._submit")
}}), l.changeBubbles || (n.event.special.change = {setup: function() {
return Y.test(this.nodeName) ? (("checkbox" === this.type || "radio" === this.type) && (n.event.add(this, "propertychange._change", function(a) {
"checked" === a.originalEvent.propertyName && (this._just_changed = !0)
}), n.event.add(this, "click._change", function(a) {
this._just_changed && !a.isTrigger && (this._just_changed = !1), n.event.simulate("change", this, a, !0)
})), !1) : void n.event.add(this, "beforeactivate._change", function(a) {
var b = a.target;
Y.test(b.nodeName) && !n._data(b, "changeBubbles") && (n.event.add(b, "change._change", function(a) {
!this.parentNode || a.isSimulated || a.isTrigger || n.event.simulate("change", this.parentNode, a, !0)
}), n._data(b, "changeBubbles", !0))
})
}, handle: function(a) {
var b = a.target;
return this !== b || a.isSimulated || a.isTrigger || "radio" !== b.type && "checkbox" !== b.type ? a.handleObj.handler.apply(this, arguments) : void 0
}, teardown: function() {
return n.event.remove(this, "._change"), !Y.test(this.nodeName)
}}), l.focusinBubbles || n.each({focus: "focusin", blur: "focusout"}, function(a, b) {
var c = function(a) {
n.event.simulate(b, a.target, n.event.fix(a), !0)
};
n.event.special[b] = {setup: function() {
var d = this.ownerDocument || this, e = n._data(d, b);
e || d.addEventListener(a, c, !0), n._data(d, b, (e || 0) + 1)
}, teardown: function() {
var d = this.ownerDocument || this, e = n._data(d, b) - 1;
e ? n._data(d, b, e) : (d.removeEventListener(a, c, !0), n._removeData(d, b))
}}
}), n.fn.extend({on: function(a, b, c, d, e) {
var f, g;
if ("object" == typeof a) {
"string" != typeof b && (c = c || b, b = void 0);
for (f in a)
this.on(f, b, c, a[f], e);
return this
}
if (null == c && null == d ? (d = b, c = b = void 0) : null == d && ("string" == typeof b ? (d = c, c = void 0) : (d = c, c = b, b = void 0)), d === !1)
d = cb;
else if (!d)
return this;
return 1 === e && (g = d, d = function(a) {
return n().off(a), g.apply(this, arguments)
}, d.guid = g.guid || (g.guid = n.guid++)), this.each(function() {
n.event.add(this, a, d, c, b)
})
}, one: function(a, b, c, d) {
return this.on(a, b, c, d, 1)
}, off: function(a, b, c) {
var d, e;
if (a && a.preventDefault && a.handleObj)
return d = a.handleObj, n(a.delegateTarget).off(d.namespace ? d.origType + "." + d.namespace : d.origType, d.selector, d.handler), this;
if ("object" == typeof a) {
for (e in a)
this.off(e, b, a[e]);
return this
}
return(b === !1 || "function" == typeof b) && (c = b, b = void 0), c === !1 && (c = cb), this.each(function() {
n.event.remove(this, a, c, b)
})
}, trigger: function(a, b) {
return this.each(function() {
n.event.trigger(a, b, this)
})
}, triggerHandler: function(a, b) {
var c = this[0];
return c ? n.event.trigger(a, b, c, !0) : void 0
}});
function eb(a) {
var b = fb.split("|"), c = a.createDocumentFragment();
if (c.createElement)
while (b.length)
c.createElement(b.pop());
return c
}
var fb = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video", gb = / jQuery\d+="(?:null|\d+)"/g, hb = new RegExp("<(?:" + fb + ")[\\s/>]", "i"), ib = /^\s+/, jb = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi, kb = /<([\w:]+)/, lb = /<tbody/i, mb = /<|&#?\w+;/, nb = /<(?:script|style|link)/i, ob = /checked\s*(?:[^=]|=\s*.checked.)/i, pb = /^$|\/(?:java|ecma)script/i, qb = /^true\/(.*)/, rb = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g, sb = {option: [1, "<select multiple='multiple'>", "</select>"], legend: [1, "<fieldset>", "</fieldset>"], area: [1, "<map>", "</map>"], param: [1, "<object>", "</object>"], thead: [1, "<table>", "</table>"], tr: [2, "<table><tbody>", "</tbody></table>"], col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"], td: [3, "<table><tbody><tr>", "</tr></tbody></table>"], _default: l.htmlSerialize ? [0, "", ""] : [1, "X<div>", "</div>"]}, tb = eb(z), ub = tb.appendChild(z.createElement("div"));
sb.optgroup = sb.option, sb.tbody = sb.tfoot = sb.colgroup = sb.caption = sb.thead, sb.th = sb.td;
function vb(a, b) {
var c, d, e = 0, f = typeof a.getElementsByTagName !== L ? a.getElementsByTagName(b || "*") : typeof a.querySelectorAll !== L ? a.querySelectorAll(b || "*") : void 0;
if (!f)
for (f = [], c = a.childNodes || a; null != (d = c[e]); e++)
!b || n.nodeName(d, b) ? f.push(d) : n.merge(f, vb(d, b));
return void 0 === b || b && n.nodeName(a, b) ? n.merge([a], f) : f
}
function wb(a) {
X.test(a.type) && (a.defaultChecked = a.checked)
}
function xb(a, b) {
return n.nodeName(a, "table") && n.nodeName(11 !== b.nodeType ? b : b.firstChild, "tr") ? a.getElementsByTagName("tbody")[0] || a.appendChild(a.ownerDocument.createElement("tbody")) : a
}
function yb(a) {
return a.type = (null !== n.find.attr(a, "type")) + "/" + a.type, a
}
function zb(a) {
var b = qb.exec(a.type);
return b ? a.type = b[1] : a.removeAttribute("type"), a
}
function Ab(a, b) {
for (var c, d = 0; null != (c = a[d]); d++)
n._data(c, "globalEval", !b || n._data(b[d], "globalEval"))
}
function Bb(a, b) {
if (1 === b.nodeType && n.hasData(a)) {
var c, d, e, f = n._data(a), g = n._data(b, f), h = f.events;
if (h) {
delete g.handle, g.events = {};
for (c in h)
for (d = 0, e = h[c].length; e > d; d++)
n.event.add(b, c, h[c][d])
}
g.data && (g.data = n.extend({}, g.data))
}
}
function Cb(a, b) {
var c, d, e;
if (1 === b.nodeType) {
if (c = b.nodeName.toLowerCase(), !l.noCloneEvent && b[n.expando]) {
e = n._data(b);
for (d in e.events)
n.removeEvent(b, d, e.handle);
b.removeAttribute(n.expando)
}
"script" === c && b.text !== a.text ? (yb(b).text = a.text, zb(b)) : "object" === c ? (b.parentNode && (b.outerHTML = a.outerHTML), l.html5Clone && a.innerHTML && !n.trim(b.innerHTML) && (b.innerHTML = a.innerHTML)) : "input" === c && X.test(a.type) ? (b.defaultChecked = b.checked = a.checked, b.value !== a.value && (b.value = a.value)) : "option" === c ? b.defaultSelected = b.selected = a.defaultSelected : ("input" === c || "textarea" === c) && (b.defaultValue = a.defaultValue)
}
}
n.extend({clone: function(a, b, c) {
var d, e, f, g, h, i = n.contains(a.ownerDocument, a);
if (l.html5Clone || n.isXMLDoc(a) || !hb.test("<" + a.nodeName + ">") ? f = a.cloneNode(!0) : (ub.innerHTML = a.outerHTML, ub.removeChild(f = ub.firstChild)), !(l.noCloneEvent && l.noCloneChecked || 1 !== a.nodeType && 11 !== a.nodeType || n.isXMLDoc(a)))
for (d = vb(f), h = vb(a), g = 0; null != (e = h[g]); ++g)
d[g] && Cb(e, d[g]);
if (b)
if (c)
for (h = h || vb(a), d = d || vb(f), g = 0; null != (e = h[g]); g++)
Bb(e, d[g]);
else
Bb(a, f);
return d = vb(f, "script"), d.length > 0 && Ab(d, !i && vb(a, "script")), d = h = e = null, f
}, buildFragment: function(a, b, c, d) {
for (var e, f, g, h, i, j, k, m = a.length, o = eb(b), p = [], q = 0; m > q; q++)
if (f = a[q], f || 0 === f)
if ("object" === n.type(f))
n.merge(p, f.nodeType ? [f] : f);
else if (mb.test(f)) {
h = h || o.appendChild(b.createElement("div")), i = (kb.exec(f) || ["", ""])[1].toLowerCase(), k = sb[i] || sb._default, h.innerHTML = k[1] + f.replace(jb, "<$1></$2>") + k[2], e = k[0];
while (e--)
h = h.lastChild;
if (!l.leadingWhitespace && ib.test(f) && p.push(b.createTextNode(ib.exec(f)[0])), !l.tbody) {
f = "table" !== i || lb.test(f) ? "<table>" !== k[1] || lb.test(f) ? 0 : h : h.firstChild, e = f && f.childNodes.length;
while (e--)
n.nodeName(j = f.childNodes[e], "tbody") && !j.childNodes.length && f.removeChild(j)
}
n.merge(p, h.childNodes), h.textContent = "";
while (h.firstChild)
h.removeChild(h.firstChild);
h = o.lastChild
} else
p.push(b.createTextNode(f));
h && o.removeChild(h), l.appendChecked || n.grep(vb(p, "input"), wb), q = 0;
while (f = p[q++])
if ((!d || -1 === n.inArray(f, d)) && (g = n.contains(f.ownerDocument, f), h = vb(o.appendChild(f), "script"), g && Ab(h), c)) {
e = 0;
while (f = h[e++])
pb.test(f.type || "") && c.push(f)
}
return h = null, o
}, cleanData: function(a, b) {
for (var d, e, f, g, h = 0, i = n.expando, j = n.cache, k = l.deleteExpando, m = n.event.special; null != (d = a[h]); h++)
if ((b || n.acceptData(d)) && (f = d[i], g = f && j[f])) {
if (g.events)
for (e in g.events)
m[e] ? n.event.remove(d, e) : n.removeEvent(d, e, g.handle);
j[f] && (delete j[f], k ? delete d[i] : typeof d.removeAttribute !== L ? d.removeAttribute(i) : d[i] = null, c.push(f))
}
}}), n.fn.extend({text: function(a) {
return W(this, function(a) {
return void 0 === a ? n.text(this) : this.empty().append((this[0] && this[0].ownerDocument || z).createTextNode(a))
}, null, a, arguments.length)
}, append: function() {
return this.domManip(arguments, function(a) {
if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
var b = xb(this, a);
b.appendChild(a)
}
})
}, prepend: function() {
return this.domManip(arguments, function(a) {
if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
var b = xb(this, a);
b.insertBefore(a, b.firstChild)
}
})
}, before: function() {
return this.domManip(arguments, function(a) {
this.parentNode && this.parentNode.insertBefore(a, this)
})
}, after: function() {
return this.domManip(arguments, function(a) {
this.parentNode && this.parentNode.insertBefore(a, this.nextSibling)
})
}, remove: function(a, b) {
for (var c, d = a ? n.filter(a, this) : this, e = 0; null != (c = d[e]); e++)
b || 1 !== c.nodeType || n.cleanData(vb(c)), c.parentNode && (b && n.contains(c.ownerDocument, c) && Ab(vb(c, "script")), c.parentNode.removeChild(c));
return this
}, empty: function() {
for (var a, b = 0; null != (a = this[b]); b++) {
1 === a.nodeType && n.cleanData(vb(a, !1));
while (a.firstChild)
a.removeChild(a.firstChild);
a.options && n.nodeName(a, "select") && (a.options.length = 0)
}
return this
}, clone: function(a, b) {
return a = null == a ? !1 : a, b = null == b ? a : b, this.map(function() {
return n.clone(this, a, b)
})
}, html: function(a) {
return W(this, function(a) {
var b = this[0] || {}, c = 0, d = this.length;
if (void 0 === a)
return 1 === b.nodeType ? b.innerHTML.replace(gb, "") : void 0;
if (!("string" != typeof a || nb.test(a) || !l.htmlSerialize && hb.test(a) || !l.leadingWhitespace && ib.test(a) || sb[(kb.exec(a) || ["", ""])[1].toLowerCase()])) {
a = a.replace(jb, "<$1></$2>");
try {
for (; d > c; c++)
b = this[c] || {}, 1 === b.nodeType && (n.cleanData(vb(b, !1)), b.innerHTML = a);
b = 0
} catch (e) {
}
}
b && this.empty().append(a)
}, null, a, arguments.length)
}, replaceWith: function() {
var a = arguments[0];
return this.domManip(arguments, function(b) {
a = this.parentNode, n.cleanData(vb(this)), a && a.replaceChild(b, this)
}), a && (a.length || a.nodeType) ? this : this.remove()
}, detach: function(a) {
return this.remove(a, !0)
}, domManip: function(a, b) {
a = e.apply([], a);
var c, d, f, g, h, i, j = 0, k = this.length, m = this, o = k - 1, p = a[0], q = n.isFunction(p);
if (q || k > 1 && "string" == typeof p && !l.checkClone && ob.test(p))
return this.each(function(c) {
var d = m.eq(c);
q && (a[0] = p.call(this, c, d.html())), d.domManip(a, b)
});
if (k && (i = n.buildFragment(a, this[0].ownerDocument, !1, this), c = i.firstChild, 1 === i.childNodes.length && (i = c), c)) {
for (g = n.map(vb(i, "script"), yb), f = g.length; k > j; j++)
d = i, j !== o && (d = n.clone(d, !0, !0), f && n.merge(g, vb(d, "script"))), b.call(this[j], d, j);
if (f)
for (h = g[g.length - 1].ownerDocument, n.map(g, zb), j = 0; f > j; j++)
d = g[j], pb.test(d.type || "") && !n._data(d, "globalEval") && n.contains(h, d) && (d.src ? n._evalUrl && n._evalUrl(d.src) : n.globalEval((d.text || d.textContent || d.innerHTML || "").replace(rb, "")));
i = c = null
}
return this
}}), n.each({appendTo: "append", prependTo: "prepend", insertBefore: "before", insertAfter: "after", replaceAll: "replaceWith"}, function(a, b) {
n.fn[a] = function(a) {
for (var c, d = 0, e = [], g = n(a), h = g.length - 1; h >= d; d++)
c = d === h ? this : this.clone(!0), n(g[d])[b](c), f.apply(e, c.get());
return this.pushStack(e)
}
});
var Db, Eb = {};
function Fb(b, c) {
var d = n(c.createElement(b)).appendTo(c.body), e = a.getDefaultComputedStyle ? a.getDefaultComputedStyle(d[0]).display : n.css(d[0], "display");
return d.detach(), e
}
function Gb(a) {
var b = z, c = Eb[a];
return c || (c = Fb(a, b), "none" !== c && c || (Db = (Db || n("<iframe frameborder='0' width='0' height='0'/>")).appendTo(b.documentElement), b = (Db[0].contentWindow || Db[0].contentDocument).document, b.write(), b.close(), c = Fb(a, b), Db.detach()), Eb[a] = c), c
}
!function() {
var a, b, c = z.createElement("div"), d = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;padding:0;margin:0;border:0";
c.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", a = c.getElementsByTagName("a")[0], a.style.cssText = "float:left;opacity:.5", l.opacity = /^0.5/.test(a.style.opacity), l.cssFloat = !!a.style.cssFloat, c.style.backgroundClip = "content-box", c.cloneNode(!0).style.backgroundClip = "", l.clearCloneStyle = "content-box" === c.style.backgroundClip, a = c = null, l.shrinkWrapBlocks = function() {
var a, c, e, f;
if (null == b) {
if (a = z.getElementsByTagName("body")[0], !a)
return;
f = "border:0;width:0;height:0;position:absolute;top:0;left:-9999px", c = z.createElement("div"), e = z.createElement("div"), a.appendChild(c).appendChild(e), b = !1, typeof e.style.zoom !== L && (e.style.cssText = d + ";width:1px;padding:1px;zoom:1", e.innerHTML = "<div></div>", e.firstChild.style.width = "5px", b = 3 !== e.offsetWidth), a.removeChild(c), a = c = e = null
}
return b
}
}();
var Hb = /^margin/, Ib = new RegExp("^(" + T + ")(?!px)[a-z%]+$", "i"), Jb, Kb, Lb = /^(top|right|bottom|left)$/;
a.getComputedStyle ? (Jb = function(a) {
return a.ownerDocument.defaultView.getComputedStyle(a, null)
}, Kb = function(a, b, c) {
var d, e, f, g, h = a.style;
return c = c || Jb(a), g = c ? c.getPropertyValue(b) || c[b] : void 0, c && ("" !== g || n.contains(a.ownerDocument, a) || (g = n.style(a, b)), Ib.test(g) && Hb.test(b) && (d = h.width, e = h.minWidth, f = h.maxWidth, h.minWidth = h.maxWidth = h.width = g, g = c.width, h.width = d, h.minWidth = e, h.maxWidth = f)), void 0 === g ? g : g + ""
}) : z.documentElement.currentStyle && (Jb = function(a) {
return a.currentStyle
}, Kb = function(a, b, c) {
var d, e, f, g, h = a.style;
return c = c || Jb(a), g = c ? c[b] : void 0, null == g && h && h[b] && (g = h[b]), Ib.test(g) && !Lb.test(b) && (d = h.left, e = a.runtimeStyle, f = e && e.left, f && (e.left = a.currentStyle.left), h.left = "fontSize" === b ? "1em" : g, g = h.pixelLeft + "px", h.left = d, f && (e.left = f)), void 0 === g ? g : g + "" || "auto"
});
function Mb(a, b) {
return{get: function() {
var c = a();
if (null != c)
return c ? void delete this.get : (this.get = b).apply(this, arguments)
}}
}
!function() {
var b, c, d, e, f, g, h = z.createElement("div"), i = "border:0;width:0;height:0;position:absolute;top:0;left:-9999px", j = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;padding:0;margin:0;border:0";
h.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", b = h.getElementsByTagName("a")[0], b.style.cssText = "float:left;opacity:.5", l.opacity = /^0.5/.test(b.style.opacity), l.cssFloat = !!b.style.cssFloat, h.style.backgroundClip = "content-box", h.cloneNode(!0).style.backgroundClip = "", l.clearCloneStyle = "content-box" === h.style.backgroundClip, b = h = null, n.extend(l, {reliableHiddenOffsets: function() {
if (null != c)
return c;
var a, b, d, e = z.createElement("div"), f = z.getElementsByTagName("body")[0];
if (f)
return e.setAttribute("className", "t"), e.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", a = z.createElement("div"), a.style.cssText = i, f.appendChild(a).appendChild(e), e.innerHTML = "<table><tr><td></td><td>t</td></tr></table>", b = e.getElementsByTagName("td"), b[0].style.cssText = "padding:0;margin:0;border:0;display:none", d = 0 === b[0].offsetHeight, b[0].style.display = "", b[1].style.display = "none", c = d && 0 === b[0].offsetHeight, f.removeChild(a), e = f = null, c
}, boxSizing: function() {
return null == d && k(), d
}, boxSizingReliable: function() {
return null == e && k(), e
}, pixelPosition: function() {
return null == f && k(), f
}, reliableMarginRight: function() {
var b, c, d, e;
if (null == g && a.getComputedStyle) {
if (b = z.getElementsByTagName("body")[0], !b)
return;
c = z.createElement("div"), d = z.createElement("div"), c.style.cssText = i, b.appendChild(c).appendChild(d), e = d.appendChild(z.createElement("div")), e.style.cssText = d.style.cssText = j, e.style.marginRight = e.style.width = "0", d.style.width = "1px", g = !parseFloat((a.getComputedStyle(e, null) || {}).marginRight), b.removeChild(c)
}
return g
}});
function k() {
var b, c, h = z.getElementsByTagName("body")[0];
h && (b = z.createElement("div"), c = z.createElement("div"), b.style.cssText = i, h.appendChild(b).appendChild(c), c.style.cssText = "-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;position:absolute;display:block;padding:1px;border:1px;width:4px;margin-top:1%;top:1%", n.swap(h, null != h.style.zoom ? {zoom: 1} : {}, function() {
d = 4 === c.offsetWidth
}), e = !0, f = !1, g = !0, a.getComputedStyle && (f = "1%" !== (a.getComputedStyle(c, null) || {}).top, e = "4px" === (a.getComputedStyle(c, null) || {width: "4px"}).width), h.removeChild(b), c = h = null)
}}
(), n.swap = function(a, b, c, d) {
var e, f, g = {};
for (f in b)
g[f] = a.style[f], a.style[f] = b[f];
e = c.apply(a, d || []);
for (f in b)
a.style[f] = g[f];
return e
};
var Nb = /alpha\([^)]*\)/i, Ob = /opacity\s*=\s*([^)]*)/, Pb = /^(none|table(?!-c[ea]).+)/, Qb = new RegExp("^(" + T + ")(.*)$", "i"), Rb = new RegExp("^([+-])=(" + T + ")", "i"), Sb = {position: "absolute", visibility: "hidden", display: "block"}, Tb = {letterSpacing: 0, fontWeight: 400}, Ub = ["Webkit", "O", "Moz", "ms"];
function Vb(a, b) {
if (b in a)
return b;
var c = b.charAt(0).toUpperCase() + b.slice(1), d = b, e = Ub.length;
while (e--)
if (b = Ub[e] + c, b in a)
return b;
return d
}
function Wb(a, b) {
for (var c, d, e, f = [], g = 0, h = a.length; h > g; g++)
d = a[g], d.style && (f[g] = n._data(d, "olddisplay"), c = d.style.display, b ? (f[g] || "none" !== c || (d.style.display = ""), "" === d.style.display && V(d) && (f[g] = n._data(d, "olddisplay", Gb(d.nodeName)))) : f[g] || (e = V(d), (c && "none" !== c || !e) && n._data(d, "olddisplay", e ? c : n.css(d, "display"))));
for (g = 0; h > g; g++)
d = a[g], d.style && (b && "none" !== d.style.display && "" !== d.style.display || (d.style.display = b ? f[g] || "" : "none"));
return a
}
function Xb(a, b, c) {
var d = Qb.exec(b);
return d ? Math.max(0, d[1] - (c || 0)) + (d[2] || "px") : b
}
function Yb(a, b, c, d, e) {
for (var f = c === (d ? "border" : "content") ? 4 : "width" === b ? 1 : 0, g = 0; 4 > f; f += 2)
"margin" === c && (g += n.css(a, c + U[f], !0, e)), d ? ("content" === c && (g -= n.css(a, "padding" + U[f], !0, e)), "margin" !== c && (g -= n.css(a, "border" + U[f] + "Width", !0, e))) : (g += n.css(a, "padding" + U[f], !0, e), "padding" !== c && (g += n.css(a, "border" + U[f] + "Width", !0, e)));
return g
}
function Zb(a, b, c) {
var d = !0, e = "width" === b ? a.offsetWidth : a.offsetHeight, f = Jb(a), g = l.boxSizing() && "border-box" === n.css(a, "boxSizing", !1, f);
if (0 >= e || null == e) {
if (e = Kb(a, b, f), (0 > e || null == e) && (e = a.style[b]), Ib.test(e))
return e;
d = g && (l.boxSizingReliable() || e === a.style[b]), e = parseFloat(e) || 0
}
return e + Yb(a, b, c || (g ? "border" : "content"), d, f) + "px"
}
n.extend({cssHooks: {opacity: {get: function(a, b) {
if (b) {
var c = Kb(a, "opacity");
return"" === c ? "1" : c
}
}}}, cssNumber: {columnCount: !0, fillOpacity: !0, fontWeight: !0, lineHeight: !0, opacity: !0, order: !0, orphans: !0, widows: !0, zIndex: !0, zoom: !0}, cssProps: {"float": l.cssFloat ? "cssFloat" : "styleFloat"}, style: function(a, b, c, d) {
if (a && 3 !== a.nodeType && 8 !== a.nodeType && a.style) {
var e, f, g, h = n.camelCase(b), i = a.style;
if (b = n.cssProps[h] || (n.cssProps[h] = Vb(i, h)), g = n.cssHooks[b] || n.cssHooks[h], void 0 === c)
return g && "get"in g && void 0 !== (e = g.get(a, !1, d)) ? e : i[b];
if (f = typeof c, "string" === f && (e = Rb.exec(c)) && (c = (e[1] + 1) * e[2] + parseFloat(n.css(a, b)), f = "number"), null != c && c === c && ("number" !== f || n.cssNumber[h] || (c += "px"), l.clearCloneStyle || "" !== c || 0 !== b.indexOf("background") || (i[b] = "inherit"), !(g && "set"in g && void 0 === (c = g.set(a, c, d)))))
try {
i[b] = "", i[b] = c
} catch (j) {
}
}
}, css: function(a, b, c, d) {
var e, f, g, h = n.camelCase(b);
return b = n.cssProps[h] || (n.cssProps[h] = Vb(a.style, h)), g = n.cssHooks[b] || n.cssHooks[h], g && "get"in g && (f = g.get(a, !0, c)), void 0 === f && (f = Kb(a, b, d)), "normal" === f && b in Tb && (f = Tb[b]), "" === c || c ? (e = parseFloat(f), c === !0 || n.isNumeric(e) ? e || 0 : f) : f
}}), n.each(["height", "width"], function(a, b) {
n.cssHooks[b] = {get: function(a, c, d) {
return c ? 0 === a.offsetWidth && Pb.test(n.css(a, "display")) ? n.swap(a, Sb, function() {
return Zb(a, b, d)
}) : Zb(a, b, d) : void 0
}, set: function(a, c, d) {
var e = d && Jb(a);
return Xb(a, c, d ? Yb(a, b, d, l.boxSizing() && "border-box" === n.css(a, "boxSizing", !1, e), e) : 0)
}}
}), l.opacity || (n.cssHooks.opacity = {get: function(a, b) {
return Ob.test((b && a.currentStyle ? a.currentStyle.filter : a.style.filter) || "") ? .01 * parseFloat(RegExp.$1) + "" : b ? "1" : ""
}, set: function(a, b) {
var c = a.style, d = a.currentStyle, e = n.isNumeric(b) ? "alpha(opacity=" + 100 * b + ")" : "", f = d && d.filter || c.filter || "";
c.zoom = 1, (b >= 1 || "" === b) && "" === n.trim(f.replace(Nb, "")) && c.removeAttribute && (c.removeAttribute("filter"), "" === b || d && !d.filter) || (c.filter = Nb.test(f) ? f.replace(Nb, e) : f + " " + e)
}}), n.cssHooks.marginRight = Mb(l.reliableMarginRight, function(a, b) {
return b ? n.swap(a, {display: "inline-block"}, Kb, [a, "marginRight"]) : void 0
}), n.each({margin: "", padding: "", border: "Width"}, function(a, b) {
n.cssHooks[a + b] = {expand: function(c) {
for (var d = 0, e = {}, f = "string" == typeof c ? c.split(" ") : [c]; 4 > d; d++)
e[a + U[d] + b] = f[d] || f[d - 2] || f[0];
return e
}}, Hb.test(a) || (n.cssHooks[a + b].set = Xb)
}), n.fn.extend({css: function(a, b) {
return W(this, function(a, b, c) {
var d, e, f = {}, g = 0;
if (n.isArray(b)) {
for (d = Jb(a), e = b.length; e > g; g++)
f[b[g]] = n.css(a, b[g], !1, d);
return f
}
return void 0 !== c ? n.style(a, b, c) : n.css(a, b)
}, a, b, arguments.length > 1)
}, show: function() {
return Wb(this, !0)
}, hide: function() {
return Wb(this)
}, toggle: function(a) {
return"boolean" == typeof a ? a ? this.show() : this.hide() : this.each(function() {
V(this) ? n(this).show() : n(this).hide()
})
}});
function $b(a, b, c, d, e) {
return new $b.prototype.init(a, b, c, d, e)
}
n.Tween = $b, $b.prototype = {constructor: $b, init: function(a, b, c, d, e, f) {
this.elem = a, this.prop = c, this.easing = e || "swing", this.options = b, this.start = this.now = this.cur(), this.end = d, this.unit = f || (n.cssNumber[c] ? "" : "px")
}, cur: function() {
var a = $b.propHooks[this.prop];
return a && a.get ? a.get(this) : $b.propHooks._default.get(this)
}, run: function(a) {
var b, c = $b.propHooks[this.prop];
return this.pos = b = this.options.duration ? n.easing[this.easing](a, this.options.duration * a, 0, 1, this.options.duration) : a, this.now = (this.end - this.start) * b + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), c && c.set ? c.set(this) : $b.propHooks._default.set(this), this
}}, $b.prototype.init.prototype = $b.prototype, $b.propHooks = {_default: {get: function(a) {
var b;
return null == a.elem[a.prop] || a.elem.style && null != a.elem.style[a.prop] ? (b = n.css(a.elem, a.prop, ""), b && "auto" !== b ? b : 0) : a.elem[a.prop]
}, set: function(a) {
n.fx.step[a.prop] ? n.fx.step[a.prop](a) : a.elem.style && (null != a.elem.style[n.cssProps[a.prop]] || n.cssHooks[a.prop]) ? n.style(a.elem, a.prop, a.now + a.unit) : a.elem[a.prop] = a.now
}}}, $b.propHooks.scrollTop = $b.propHooks.scrollLeft = {set: function(a) {
a.elem.nodeType && a.elem.parentNode && (a.elem[a.prop] = a.now)
}}, n.easing = {linear: function(a) {
return a
}, swing: function(a) {
return.5 - Math.cos(a * Math.PI) / 2
}}, n.fx = $b.prototype.init, n.fx.step = {};
var _b, ac, bc = /^(?:toggle|show|hide)$/, cc = new RegExp("^(?:([+-])=|)(" + T + ")([a-z%]*)$", "i"), dc = /queueHooks$/, ec = [jc], fc = {"*": [function(a, b) {
var c = this.createTween(a, b), d = c.cur(), e = cc.exec(b), f = e && e[3] || (n.cssNumber[a] ? "" : "px"), g = (n.cssNumber[a] || "px" !== f && +d) && cc.exec(n.css(c.elem, a)), h = 1, i = 20;
if (g && g[3] !== f) {
f = f || g[3], e = e || [], g = +d || 1;
do
h = h || ".5", g /= h, n.style(c.elem, a, g + f);
while (h !== (h = c.cur() / d) && 1 !== h && --i)
}
return e && (g = c.start = +g || +d || 0, c.unit = f, c.end = e[1] ? g + (e[1] + 1) * e[2] : +e[2]), c
}]};
function gc() {
return setTimeout(function() {
_b = void 0
}), _b = n.now()
}
function hc(a, b) {
var c, d = {height: a}, e = 0;
for (b = b?1:0; 4 > e; e += 2 - b)
c = U[e], d["margin" + c] = d["padding" + c] = a;
return b && (d.opacity = d.width = a), d
}
function ic(a, b, c) {
for (var d, e = (fc[b] || []).concat(fc["*"]), f = 0, g = e.length; g > f; f++)
if (d = e[f].call(c, b, a))
return d
}
function jc(a, b, c) {
var d, e, f, g, h, i, j, k, m = this, o = {}, p = a.style, q = a.nodeType && V(a), r = n._data(a, "fxshow");
c.queue || (h = n._queueHooks(a, "fx"), null == h.unqueued && (h.unqueued = 0, i = h.empty.fire, h.empty.fire = function() {
h.unqueued || i()
}), h.unqueued++, m.always(function() {
m.always(function() {
h.unqueued--, n.queue(a, "fx").length || h.empty.fire()
})
})), 1 === a.nodeType && ("height"in b || "width"in b) && (c.overflow = [p.overflow, p.overflowX, p.overflowY], j = n.css(a, "display"), k = Gb(a.nodeName), "none" === j && (j = k), "inline" === j && "none" === n.css(a, "float") && (l.inlineBlockNeedsLayout && "inline" !== k ? p.zoom = 1 : p.display = "inline-block")), c.overflow && (p.overflow = "hidden", l.shrinkWrapBlocks() || m.always(function() {
p.overflow = c.overflow[0], p.overflowX = c.overflow[1], p.overflowY = c.overflow[2]
}));
for (d in b)
if (e = b[d], bc.exec(e)) {
if (delete b[d], f = f || "toggle" === e, e === (q ? "hide" : "show")) {
if ("show" !== e || !r || void 0 === r[d])
continue;
q = !0
}
o[d] = r && r[d] || n.style(a, d)
}
if (!n.isEmptyObject(o)) {
r ? "hidden"in r && (q = r.hidden) : r = n._data(a, "fxshow", {}), f && (r.hidden = !q), q ? n(a).show() : m.done(function() {
n(a).hide()
}), m.done(function() {
var b;
n._removeData(a, "fxshow");
for (b in o)
n.style(a, b, o[b])
});
for (d in o)
g = ic(q ? r[d] : 0, d, m), d in r || (r[d] = g.start, q && (g.end = g.start, g.start = "width" === d || "height" === d ? 1 : 0))
}
}
function kc(a, b) {
var c, d, e, f, g;
for (c in a)
if (d = n.camelCase(c), e = b[d], f = a[c], n.isArray(f) && (e = f[1], f = a[c] = f[0]), c !== d && (a[d] = f, delete a[c]), g = n.cssHooks[d], g && "expand"in g) {
f = g.expand(f), delete a[d];
for (c in f)
c in a || (a[c] = f[c], b[c] = e)
} else
b[d] = e
}
function lc(a, b, c) {
var d, e, f = 0, g = ec.length, h = n.Deferred().always(function() {
delete i.elem
}), i = function() {
if (e)
return!1;
for (var b = _b || gc(), c = Math.max(0, j.startTime + j.duration - b), d = c / j.duration || 0, f = 1 - d, g = 0, i = j.tweens.length; i > g; g++)
j.tweens[g].run(f);
return h.notifyWith(a, [j, f, c]), 1 > f && i ? c : (h.resolveWith(a, [j]), !1)
}, j = h.promise({elem: a, props: n.extend({}, b), opts: n.extend(!0, {specialEasing: {}}, c), originalProperties: b, originalOptions: c, startTime: _b || gc(), duration: c.duration, tweens: [], createTween: function(b, c) {
var d = n.Tween(a, j.opts, b, c, j.opts.specialEasing[b] || j.opts.easing);
return j.tweens.push(d), d
}, stop: function(b) {
var c = 0, d = b ? j.tweens.length : 0;
if (e)
return this;
for (e = !0; d > c; c++)
j.tweens[c].run(1);
return b ? h.resolveWith(a, [j, b]) : h.rejectWith(a, [j, b]), this
}}), k = j.props;
for (kc(k, j.opts.specialEasing); g > f; f++)
if (d = ec[f].call(j, a, k, j.opts))
return d;
return n.map(k, ic, j), n.isFunction(j.opts.start) && j.opts.start.call(a, j), n.fx.timer(n.extend(i, {elem: a, anim: j, queue: j.opts.queue})), j.progress(j.opts.progress).done(j.opts.done, j.opts.complete).fail(j.opts.fail).always(j.opts.always)
}
n.Animation = n.extend(lc, {tweener: function(a, b) {
n.isFunction(a) ? (b = a, a = ["*"]) : a = a.split(" ");
for (var c, d = 0, e = a.length; e > d; d++)
c = a[d], fc[c] = fc[c] || [], fc[c].unshift(b)
}, prefilter: function(a, b) {
b ? ec.unshift(a) : ec.push(a)
}}), n.speed = function(a, b, c) {
var d = a && "object" == typeof a ? n.extend({}, a) : {complete: c || !c && b || n.isFunction(a) && a, duration: a, easing: c && b || b && !n.isFunction(b) && b};
return d.duration = n.fx.off ? 0 : "number" == typeof d.duration ? d.duration : d.duration in n.fx.speeds ? n.fx.speeds[d.duration] : n.fx.speeds._default, (null == d.queue || d.queue === !0) && (d.queue = "fx"), d.old = d.complete, d.complete = function() {
n.isFunction(d.old) && d.old.call(this), d.queue && n.dequeue(this, d.queue)
}, d
}, n.fn.extend({fadeTo: function(a, b, c, d) {
return this.filter(V).css("opacity", 0).show().end().animate({opacity: b}, a, c, d)
}, animate: function(a, b, c, d) {
var e = n.isEmptyObject(a), f = n.speed(b, c, d), g = function() {
var b = lc(this, n.extend({}, a), f);
(e || n._data(this, "finish")) && b.stop(!0)
};
return g.finish = g, e || f.queue === !1 ? this.each(g) : this.queue(f.queue, g)
}, stop: function(a, b, c) {
var d = function(a) {
var b = a.stop;
delete a.stop, b(c)
};
return"string" != typeof a && (c = b, b = a, a = void 0), b && a !== !1 && this.queue(a || "fx", []), this.each(function() {
var b = !0, e = null != a && a + "queueHooks", f = n.timers, g = n._data(this);
if (e)
g[e] && g[e].stop && d(g[e]);
else
for (e in g)
g[e] && g[e].stop && dc.test(e) && d(g[e]);
for (e = f.length; e--; )
f[e].elem !== this || null != a && f[e].queue !== a || (f[e].anim.stop(c), b = !1, f.splice(e, 1));
(b || !c) && n.dequeue(this, a)
})
}, finish: function(a) {
return a !== !1 && (a = a || "fx"), this.each(function() {
var b, c = n._data(this), d = c[a + "queue"], e = c[a + "queueHooks"], f = n.timers, g = d ? d.length : 0;
for (c.finish = !0, n.queue(this, a, []), e && e.stop && e.stop.call(this, !0), b = f.length; b--; )
f[b].elem === this && f[b].queue === a && (f[b].anim.stop(!0), f.splice(b, 1));
for (b = 0; g > b; b++)
d[b] && d[b].finish && d[b].finish.call(this);
delete c.finish
})
}}), n.each(["toggle", "show", "hide"], function(a, b) {
var c = n.fn[b];
n.fn[b] = function(a, d, e) {
return null == a || "boolean" == typeof a ? c.apply(this, arguments) : this.animate(hc(b, !0), a, d, e)
}
}), n.each({slideDown: hc("show"), slideUp: hc("hide"), slideToggle: hc("toggle"), fadeIn: {opacity: "show"}, fadeOut: {opacity: "hide"}, fadeToggle: {opacity: "toggle"}}, function(a, b) {
n.fn[a] = function(a, c, d) {
return this.animate(b, a, c, d)
}
}), n.timers = [], n.fx.tick = function() {
var a, b = n.timers, c = 0;
for (_b = n.now(); c < b.length; c++)
a = b[c], a() || b[c] !== a || b.splice(c--, 1);
b.length || n.fx.stop(), _b = void 0
}, n.fx.timer = function(a) {
n.timers.push(a), a() ? n.fx.start() : n.timers.pop()
}, n.fx.interval = 13, n.fx.start = function() {
ac || (ac = setInterval(n.fx.tick, n.fx.interval))
}, n.fx.stop = function() {
clearInterval(ac), ac = null
}, n.fx.speeds = {slow: 600, fast: 200, _default: 400}, n.fn.delay = function(a, b) {
return a = n.fx ? n.fx.speeds[a] || a : a, b = b || "fx", this.queue(b, function(b, c) {
var d = setTimeout(b, a);
c.stop = function() {
clearTimeout(d)
}
})
}, function() {
var a, b, c, d, e = z.createElement("div");
e.setAttribute("className", "t"), e.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", a = e.getElementsByTagName("a")[0], c = z.createElement("select"), d = c.appendChild(z.createElement("option")), b = e.getElementsByTagName("input")[0], a.style.cssText = "top:1px", l.getSetAttribute = "t" !== e.className, l.style = /top/.test(a.getAttribute("style")), l.hrefNormalized = "/a" === a.getAttribute("href"), l.checkOn = !!b.value, l.optSelected = d.selected, l.enctype = !!z.createElement("form").enctype, c.disabled = !0, l.optDisabled = !d.disabled, b = z.createElement("input"), b.setAttribute("value", ""), l.input = "" === b.getAttribute("value"), b.value = "t", b.setAttribute("type", "radio"), l.radioValue = "t" === b.value, a = b = c = d = e = null
}();
var mc = /\r/g;
n.fn.extend({val: function(a) {
var b, c, d, e = this[0];
{
if (arguments.length)
return d = n.isFunction(a), this.each(function(c) {
var e;
1 === this.nodeType && (e = d ? a.call(this, c, n(this).val()) : a, null == e ? e = "" : "number" == typeof e ? e += "" : n.isArray(e) && (e = n.map(e, function(a) {
return null == a ? "" : a + ""
})), b = n.valHooks[this.type] || n.valHooks[this.nodeName.toLowerCase()], b && "set"in b && void 0 !== b.set(this, e, "value") || (this.value = e))
});
if (e)
return b = n.valHooks[e.type] || n.valHooks[e.nodeName.toLowerCase()], b && "get"in b && void 0 !== (c = b.get(e, "value")) ? c : (c = e.value, "string" == typeof c ? c.replace(mc, "") : null == c ? "" : c)
}
}}), n.extend({valHooks: {option: {get: function(a) {
var b = n.find.attr(a, "value");
return null != b ? b : n.text(a)
}}, select: {get: function(a) {
for (var b, c, d = a.options, e = a.selectedIndex, f = "select-one" === a.type || 0 > e, g = f ? null : [], h = f ? e + 1 : d.length, i = 0 > e ? h : f ? e : 0; h > i; i++)
if (c = d[i], !(!c.selected && i !== e || (l.optDisabled ? c.disabled : null !== c.getAttribute("disabled")) || c.parentNode.disabled && n.nodeName(c.parentNode, "optgroup"))) {
if (b = n(c).val(), f)
return b;
g.push(b)
}
return g
}, set: function(a, b) {
var c, d, e = a.options, f = n.makeArray(b), g = e.length;
while (g--)
if (d = e[g], n.inArray(n.valHooks.option.get(d), f) >= 0)
try {
d.selected = c = !0
} catch (h) {
d.scrollHeight
}
else
d.selected = !1;
return c || (a.selectedIndex = -1), e
}}}}), n.each(["radio", "checkbox"], function() {
n.valHooks[this] = {set: function(a, b) {
return n.isArray(b) ? a.checked = n.inArray(n(a).val(), b) >= 0 : void 0
}}, l.checkOn || (n.valHooks[this].get = function(a) {
return null === a.getAttribute("value") ? "on" : a.value
})
});
var nc, oc, pc = n.expr.attrHandle, qc = /^(?:checked|selected)$/i, rc = l.getSetAttribute, sc = l.input;
n.fn.extend({attr: function(a, b) {
return W(this, n.attr, a, b, arguments.length > 1)
}, removeAttr: function(a) {
return this.each(function() {
n.removeAttr(this, a)
})
}}), n.extend({attr: function(a, b, c) {
var d, e, f = a.nodeType;
if (a && 3 !== f && 8 !== f && 2 !== f)
return typeof a.getAttribute === L ? n.prop(a, b, c) : (1 === f && n.isXMLDoc(a) || (b = b.toLowerCase(), d = n.attrHooks[b] || (n.expr.match.bool.test(b) ? oc : nc)), void 0 === c ? d && "get"in d && null !== (e = d.get(a, b)) ? e : (e = n.find.attr(a, b), null == e ? void 0 : e) : null !== c ? d && "set"in d && void 0 !== (e = d.set(a, c, b)) ? e : (a.setAttribute(b, c + ""), c) : void n.removeAttr(a, b))
}, removeAttr: function(a, b) {
var c, d, e = 0, f = b && b.match(F);
if (f && 1 === a.nodeType)
while (c = f[e++])
d = n.propFix[c] || c, n.expr.match.bool.test(c) ? sc && rc || !qc.test(c) ? a[d] = !1 : a[n.camelCase("default-" + c)] = a[d] = !1 : n.attr(a, c, ""), a.removeAttribute(rc ? c : d)
}, attrHooks: {type: {set: function(a, b) {
if (!l.radioValue && "radio" === b && n.nodeName(a, "input")) {
var c = a.value;
return a.setAttribute("type", b), c && (a.value = c), b
}
}}}}), oc = {set: function(a, b, c) {
return b === !1 ? n.removeAttr(a, c) : sc && rc || !qc.test(c) ? a.setAttribute(!rc && n.propFix[c] || c, c) : a[n.camelCase("default-" + c)] = a[c] = !0, c
}}, n.each(n.expr.match.bool.source.match(/\w+/g), function(a, b) {
var c = pc[b] || n.find.attr;
pc[b] = sc && rc || !qc.test(b) ? function(a, b, d) {
var e, f;
return d || (f = pc[b], pc[b] = e, e = null != c(a, b, d) ? b.toLowerCase() : null, pc[b] = f), e
} : function(a, b, c) {
return c ? void 0 : a[n.camelCase("default-" + b)] ? b.toLowerCase() : null
}
}), sc && rc || (n.attrHooks.value = {set: function(a, b, c) {
return n.nodeName(a, "input") ? void(a.defaultValue = b) : nc && nc.set(a, b, c)
}}), rc || (nc = {set: function(a, b, c) {
var d = a.getAttributeNode(c);
return d || a.setAttributeNode(d = a.ownerDocument.createAttribute(c)), d.value = b += "", "value" === c || b === a.getAttribute(c) ? b : void 0
}}, pc.id = pc.name = pc.coords = function(a, b, c) {
var d;
return c ? void 0 : (d = a.getAttributeNode(b)) && "" !== d.value ? d.value : null
}, n.valHooks.button = {get: function(a, b) {
var c = a.getAttributeNode(b);
return c && c.specified ? c.value : void 0
}, set: nc.set}, n.attrHooks.contenteditable = {set: function(a, b, c) {
nc.set(a, "" === b ? !1 : b, c)
}}, n.each(["width", "height"], function(a, b) {
n.attrHooks[b] = {set: function(a, c) {
return"" === c ? (a.setAttribute(b, "auto"), c) : void 0
}}
})), l.style || (n.attrHooks.style = {get: function(a) {
return a.style.cssText || void 0
}, set: function(a, b) {
return a.style.cssText = b + ""
}});
var tc = /^(?:input|select|textarea|button|object)$/i, uc = /^(?:a|area)$/i;
n.fn.extend({prop: function(a, b) {
return W(this, n.prop, a, b, arguments.length > 1)
}, removeProp: function(a) {
return a = n.propFix[a] || a, this.each(function() {
try {
this[a] = void 0, delete this[a]
} catch (b) {
}
})
}}), n.extend({propFix: {"for": "htmlFor", "class": "className"}, prop: function(a, b, c) {
var d, e, f, g = a.nodeType;
if (a && 3 !== g && 8 !== g && 2 !== g)
return f = 1 !== g || !n.isXMLDoc(a), f && (b = n.propFix[b] || b, e = n.propHooks[b]), void 0 !== c ? e && "set"in e && void 0 !== (d = e.set(a, c, b)) ? d : a[b] = c : e && "get"in e && null !== (d = e.get(a, b)) ? d : a[b]
}, propHooks: {tabIndex: {get: function(a) {
var b = n.find.attr(a, "tabindex");
return b ? parseInt(b, 10) : tc.test(a.nodeName) || uc.test(a.nodeName) && a.href ? 0 : -1
}}}}), l.hrefNormalized || n.each(["href", "src"], function(a, b) {
n.propHooks[b] = {get: function(a) {
return a.getAttribute(b, 4)
}}
}), l.optSelected || (n.propHooks.selected = {get: function(a) {
var b = a.parentNode;
return b && (b.selectedIndex, b.parentNode && b.parentNode.selectedIndex), null
}}), n.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function() {
n.propFix[this.toLowerCase()] = this
}), l.enctype || (n.propFix.enctype = "encoding");
var vc = /[\t\r\n\f]/g;
n.fn.extend({addClass: function(a) {
var b, c, d, e, f, g, h = 0, i = this.length, j = "string" == typeof a && a;
if (n.isFunction(a))
return this.each(function(b) {
n(this).addClass(a.call(this, b, this.className))
});
if (j)
for (b = (a || "").match(F) || []; i > h; h++)
if (c = this[h], d = 1 === c.nodeType && (c.className ? (" " + c.className + " ").replace(vc, " ") : " ")) {
f = 0;
while (e = b[f++])
d.indexOf(" " + e + " ") < 0 && (d += e + " ");
g = n.trim(d), c.className !== g && (c.className = g)
}
return this
}, removeClass: function(a) {
var b, c, d, e, f, g, h = 0, i = this.length, j = 0 === arguments.length || "string" == typeof a && a;
if (n.isFunction(a))
return this.each(function(b) {
n(this).removeClass(a.call(this, b, this.className))
});
if (j)
for (b = (a || "").match(F) || []; i > h; h++)
if (c = this[h], d = 1 === c.nodeType && (c.className ? (" " + c.className + " ").replace(vc, " ") : "")) {
f = 0;
while (e = b[f++])
while (d.indexOf(" " + e + " ") >= 0)
d = d.replace(" " + e + " ", " ");
g = a ? n.trim(d) : "", c.className !== g && (c.className = g)
}
return this
}, toggleClass: function(a, b) {
var c = typeof a;
return"boolean" == typeof b && "string" === c ? b ? this.addClass(a) : this.removeClass(a) : this.each(n.isFunction(a) ? function(c) {
n(this).toggleClass(a.call(this, c, this.className, b), b)
} : function() {
if ("string" === c) {
var b, d = 0, e = n(this), f = a.match(F) || [];
while (b = f[d++])
e.hasClass(b) ? e.removeClass(b) : e.addClass(b)
} else
(c === L || "boolean" === c) && (this.className && n._data(this, "__className__", this.className), this.className = this.className || a === !1 ? "" : n._data(this, "__className__") || "")
})
}, hasClass: function(a) {
for (var b = " " + a + " ", c = 0, d = this.length; d > c; c++)
if (1 === this[c].nodeType && (" " + this[c].className + " ").replace(vc, " ").indexOf(b) >= 0)
return!0;
return!1
}}), n.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function(a, b) {
n.fn[b] = function(a, c) {
return arguments.length > 0 ? this.on(b, null, a, c) : this.trigger(b)
}
}), n.fn.extend({hover: function(a, b) {
return this.mouseenter(a).mouseleave(b || a)
}, bind: function(a, b, c) {
return this.on(a, null, b, c)
}, unbind: function(a, b) {
return this.off(a, null, b)
}, delegate: function(a, b, c, d) {
return this.on(b, a, c, d)
}, undelegate: function(a, b, c) {
return 1 === arguments.length ? this.off(a, "**") : this.off(b, a || "**", c)
}});
var wc = n.now(), xc = /\?/, yc = /(,)|(\[|{)|(}|])|"(?:[^"\\\r\n]|\\["\\\/bfnrt]|\\u[\da-fA-F]{4})*"\s*:?|true|false|null|-?(?!0\d)\d+(?:\.\d+|)(?:[eE][+-]?\d+|)/g;
n.parseJSON = function(b) {
if (a.JSON && a.JSON.parse)
return a.JSON.parse(b + "");
var c, d = null, e = n.trim(b + "");
return e && !n.trim(e.replace(yc, function(a, b, e, f) {
return c && b && (d = 0), 0 === d ? a : (c = e || b, d += !f - !e, "")
})) ? Function("return " + e)() : n.error("Invalid JSON: " + b)
}, n.parseXML = function(b) {
var c, d;
if (!b || "string" != typeof b)
return null;
try {
a.DOMParser ? (d = new DOMParser, c = d.parseFromString(b, "text/xml")) : (c = new ActiveXObject("Microsoft.XMLDOM"), c.async = "false", c.loadXML(b))
} catch (e) {
c = void 0
}
return c && c.documentElement && !c.getElementsByTagName("parsererror").length || n.error("Invalid XML: " + b), c
};
var zc, Ac, Bc = /#.*$/, Cc = /([?&])_=[^&]*/, Dc = /^(.*?):[ \t]*([^\r\n]*)\r?$/gm, Ec = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/, Fc = /^(?:GET|HEAD)$/, Gc = /^\/\//, Hc = /^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/, Ic = {}, Jc = {}, Kc = "*/".concat("*");
try {
Ac = location.href
} catch (Lc) {
Ac = z.createElement("a"), Ac.href = "", Ac = Ac.href
}
zc = Hc.exec(Ac.toLowerCase()) || [];
function Mc(a) {
return function(b, c) {
"string" != typeof b && (c = b, b = "*");
var d, e = 0, f = b.toLowerCase().match(F) || [];
if (n.isFunction(c))
while (d = f[e++])
"+" === d.charAt(0) ? (d = d.slice(1) || "*", (a[d] = a[d] || []).unshift(c)) : (a[d] = a[d] || []).push(c)
}
}
function Nc(a, b, c, d) {
var e = {}, f = a === Jc;
function g(h) {
var i;
return e[h] = !0, n.each(a[h] || [], function(a, h) {
var j = h(b, c, d);
return"string" != typeof j || f || e[j] ? f ? !(i = j) : void 0 : (b.dataTypes.unshift(j), g(j), !1)
}), i
}
return g(b.dataTypes[0]) || !e["*"] && g("*")
}
function Oc(a, b) {
var c, d, e = n.ajaxSettings.flatOptions || {};
for (d in b)
void 0 !== b[d] && ((e[d] ? a : c || (c = {}))[d] = b[d]);
return c && n.extend(!0, a, c), a
}
function Pc(a, b, c) {
var d, e, f, g, h = a.contents, i = a.dataTypes;
while ("*" === i[0])
i.shift(), void 0 === e && (e = a.mimeType || b.getResponseHeader("Content-Type"));
if (e)
for (g in h)
if (h[g] && h[g].test(e)) {
i.unshift(g);
break
}
if (i[0]in c)
f = i[0];
else {
for (g in c) {
if (!i[0] || a.converters[g + " " + i[0]]) {
f = g;
break
}
d || (d = g)
}
f = f || d
}
return f ? (f !== i[0] && i.unshift(f), c[f]) : void 0
}
function Qc(a, b, c, d) {
var e, f, g, h, i, j = {}, k = a.dataTypes.slice();
if (k[1])
for (g in a.converters)
j[g.toLowerCase()] = a.converters[g];
f = k.shift();
while (f)
if (a.responseFields[f] && (c[a.responseFields[f]] = b), !i && d && a.dataFilter && (b = a.dataFilter(b, a.dataType)), i = f, f = k.shift())
if ("*" === f)
f = i;
else if ("*" !== i && i !== f) {
if (g = j[i + " " + f] || j["* " + f], !g)
for (e in j)
if (h = e.split(" "), h[1] === f && (g = j[i + " " + h[0]] || j["* " + h[0]])) {
g === !0 ? g = j[e] : j[e] !== !0 && (f = h[0], k.unshift(h[1]));
break
}
if (g !== !0)
if (g && a["throws"])
b = g(b);
else
try {
b = g(b)
} catch (l) {
return{state: "parsererror", error: g ? l : "No conversion from " + i + " to " + f}
}
}
return{state: "success", data: b}
}
n.extend({active: 0, lastModified: {}, etag: {}, ajaxSettings: {url: Ac, type: "GET", isLocal: Ec.test(zc[1]), global: !0, processData: !0, async: !0, contentType: "application/x-www-form-urlencoded; charset=UTF-8", accepts: {"*": Kc, text: "text/plain", html: "text/html", xml: "application/xml, text/xml", json: "application/json, text/javascript"}, contents: {xml: /xml/, html: /html/, json: /json/}, responseFields: {xml: "responseXML", text: "responseText", json: "responseJSON"}, converters: {"* text": String, "text html": !0, "text json": n.parseJSON, "text xml": n.parseXML}, flatOptions: {url: !0, context: !0}}, ajaxSetup: function(a, b) {
return b ? Oc(Oc(a, n.ajaxSettings), b) : Oc(n.ajaxSettings, a)
}, ajaxPrefilter: Mc(Ic), ajaxTransport: Mc(Jc), ajax: function(a, b) {
"object" == typeof a && (b = a, a = void 0), b = b || {};
var c, d, e, f, g, h, i, j, k = n.ajaxSetup({}, b), l = k.context || k, m = k.context && (l.nodeType || l.jquery) ? n(l) : n.event, o = n.Deferred(), p = n.Callbacks("once memory"), q = k.statusCode || {}, r = {}, s = {}, t = 0, u = "canceled", v = {readyState: 0, getResponseHeader: function(a) {
var b;
if (2 === t) {
if (!j) {
j = {};
while (b = Dc.exec(f))
j[b[1].toLowerCase()] = b[2]
}
b = j[a.toLowerCase()]
}
return null == b ? null : b
}, getAllResponseHeaders: function() {
return 2 === t ? f : null
}, setRequestHeader: function(a, b) {
var c = a.toLowerCase();
return t || (a = s[c] = s[c] || a, r[a] = b), this
}, overrideMimeType: function(a) {
return t || (k.mimeType = a), this
}, statusCode: function(a) {
var b;
if (a)
if (2 > t)
for (b in a)
q[b] = [q[b], a[b]];
else
v.always(a[v.status]);
return this
}, abort: function(a) {
var b = a || u;
return i && i.abort(b), x(0, b), this
}};
if (o.promise(v).complete = p.add, v.success = v.done, v.error = v.fail, k.url = ((a || k.url || Ac) + "").replace(Bc, "").replace(Gc, zc[1] + "//"), k.type = b.method || b.type || k.method || k.type, k.dataTypes = n.trim(k.dataType || "*").toLowerCase().match(F) || [""], null == k.crossDomain && (c = Hc.exec(k.url.toLowerCase()), k.crossDomain = !(!c || c[1] === zc[1] && c[2] === zc[2] && (c[3] || ("http:" === c[1] ? "80" : "443")) === (zc[3] || ("http:" === zc[1] ? "80" : "443")))), k.data && k.processData && "string" != typeof k.data && (k.data = n.param(k.data, k.traditional)), Nc(Ic, k, b, v), 2 === t)
return v;
h = k.global, h && 0 === n.active++ && n.event.trigger("ajaxStart"), k.type = k.type.toUpperCase(), k.hasContent = !Fc.test(k.type), e = k.url, k.hasContent || (k.data && (e = k.url += (xc.test(e) ? "&" : "?") + k.data, delete k.data), k.cache === !1 && (k.url = Cc.test(e) ? e.replace(Cc, "$1_=" + wc++) : e + (xc.test(e) ? "&" : "?") + "_=" + wc++)), k.ifModified && (n.lastModified[e] && v.setRequestHeader("If-Modified-Since", n.lastModified[e]), n.etag[e] && v.setRequestHeader("If-None-Match", n.etag[e])), (k.data && k.hasContent && k.contentType !== !1 || b.contentType) && v.setRequestHeader("Content-Type", k.contentType), v.setRequestHeader("Accept", k.dataTypes[0] && k.accepts[k.dataTypes[0]] ? k.accepts[k.dataTypes[0]] + ("*" !== k.dataTypes[0] ? ", " + Kc + "; q=0.01" : "") : k.accepts["*"]);
for (d in k.headers)
v.setRequestHeader(d, k.headers[d]);
if (k.beforeSend && (k.beforeSend.call(l, v, k) === !1 || 2 === t))
return v.abort();
u = "abort";
for (d in{success:1, error:1, complete:1})
v[d](k[d]);
if (i = Nc(Jc, k, b, v)) {
v.readyState = 1, h && m.trigger("ajaxSend", [v, k]), k.async && k.timeout > 0 && (g = setTimeout(function() {
v.abort("timeout")
}, k.timeout));
try {
t = 1, i.send(r, x)
} catch (w) {
if (!(2 > t))
throw w;
x(-1, w)
}
} else
x(-1, "No Transport");
function x(a, b, c, d) {
var j, r, s, u, w, x = b;
2 !== t && (t = 2, g && clearTimeout(g), i = void 0, f = d || "", v.readyState = a > 0 ? 4 : 0, j = a >= 200 && 300 > a || 304 === a, c && (u = Pc(k, v, c)), u = Qc(k, u, v, j), j ? (k.ifModified && (w = v.getResponseHeader("Last-Modified"), w && (n.lastModified[e] = w), w = v.getResponseHeader("etag"), w && (n.etag[e] = w)), 204 === a || "HEAD" === k.type ? x = "nocontent" : 304 === a ? x = "notmodified" : (x = u.state, r = u.data, s = u.error, j = !s)) : (s = x, (a || !x) && (x = "error", 0 > a && (a = 0))), v.status = a, v.statusText = (b || x) + "", j ? o.resolveWith(l, [r, x, v]) : o.rejectWith(l, [v, x, s]), v.statusCode(q), q = void 0, h && m.trigger(j ? "ajaxSuccess" : "ajaxError", [v, k, j ? r : s]), p.fireWith(l, [v, x]), h && (m.trigger("ajaxComplete", [v, k]), --n.active || n.event.trigger("ajaxStop")))
}
return v
}, getJSON: function(a, b, c) {
return n.get(a, b, c, "json")
}, getScript: function(a, b) {
return n.get(a, void 0, b, "script")
}}), n.each(["get", "post"], function(a, b) {
n[b] = function(a, c, d, e) {
return n.isFunction(c) && (e = e || d, d = c, c = void 0), n.ajax({url: a, type: b, dataType: e, data: c, success: d})
}
}), n.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function(a, b) {
n.fn[b] = function(a) {
return this.on(b, a)
}
}), n._evalUrl = function(a) {
return n.ajax({url: a, type: "GET", dataType: "script", async: !1, global: !1, "throws": !0})
}, n.fn.extend({wrapAll: function(a) {
if (n.isFunction(a))
return this.each(function(b) {
n(this).wrapAll(a.call(this, b))
});
if (this[0]) {
var b = n(a, this[0].ownerDocument).eq(0).clone(!0);
this[0].parentNode && b.insertBefore(this[0]), b.map(function() {
var a = this;
while (a.firstChild && 1 === a.firstChild.nodeType)
a = a.firstChild;
return a
}).append(this)
}
return this
}, wrapInner: function(a) {
return this.each(n.isFunction(a) ? function(b) {
n(this).wrapInner(a.call(this, b))
} : function() {
var b = n(this), c = b.contents();
c.length ? c.wrapAll(a) : b.append(a)
})
}, wrap: function(a) {
var b = n.isFunction(a);
return this.each(function(c) {
n(this).wrapAll(b ? a.call(this, c) : a)
})
}, unwrap: function() {
return this.parent().each(function() {
n.nodeName(this, "body") || n(this).replaceWith(this.childNodes)
}).end()
}}), n.expr.filters.hidden = function(a) {
return a.offsetWidth <= 0 && a.offsetHeight <= 0 || !l.reliableHiddenOffsets() && "none" === (a.style && a.style.display || n.css(a, "display"))
}, n.expr.filters.visible = function(a) {
return!n.expr.filters.hidden(a)
};
var Rc = /%20/g, Sc = /\[\]$/, Tc = /\r?\n/g, Uc = /^(?:submit|button|image|reset|file)$/i, Vc = /^(?:input|select|textarea|keygen)/i;
function Wc(a, b, c, d) {
var e;
if (n.isArray(b))
n.each(b, function(b, e) {
c || Sc.test(a) ? d(a, e) : Wc(a + "[" + ("object" == typeof e ? b : "") + "]", e, c, d)
});
else if (c || "object" !== n.type(b))
d(a, b);
else
for (e in b)
Wc(a + "[" + e + "]", b[e], c, d)
}
n.param = function(a, b) {
var c, d = [], e = function(a, b) {
b = n.isFunction(b) ? b() : null == b ? "" : b, d[d.length] = encodeURIComponent(a) + "=" + encodeURIComponent(b)
};
if (void 0 === b && (b = n.ajaxSettings && n.ajaxSettings.traditional), n.isArray(a) || a.jquery && !n.isPlainObject(a))
n.each(a, function() {
e(this.name, this.value)
});
else
for (c in a)
Wc(c, a[c], b, e);
return d.join("&").replace(Rc, "+")
}, n.fn.extend({serialize: function() {
return n.param(this.serializeArray())
}, serializeArray: function() {
return this.map(function() {
var a = n.prop(this, "elements");
return a ? n.makeArray(a) : this
}).filter(function() {
var a = this.type;
return this.name && !n(this).is(":disabled") && Vc.test(this.nodeName) && !Uc.test(a) && (this.checked || !X.test(a))
}).map(function(a, b) {
var c = n(this).val();
return null == c ? null : n.isArray(c) ? n.map(c, function(a) {
return{name: b.name, value: a.replace(Tc, "\r\n")}
}) : {name: b.name, value: c.replace(Tc, "\r\n")}
}).get()
}}), n.ajaxSettings.xhr = void 0 !== a.ActiveXObject ? function() {
return!this.isLocal && /^(get|post|head|put|delete|options)$/i.test(this.type) && $c() || _c()
} : $c;
var Xc = 0, Yc = {}, Zc = n.ajaxSettings.xhr();
a.ActiveXObject && n(a).on("unload", function() {
for (var a in Yc)
Yc[a](void 0, !0)
}), l.cors = !!Zc && "withCredentials"in Zc, Zc = l.ajax = !!Zc, Zc && n.ajaxTransport(function(a) {
if (!a.crossDomain || l.cors) {
var b;
return{send: function(c, d) {
var e, f = a.xhr(), g = ++Xc;
if (f.open(a.type, a.url, a.async, a.username, a.password), a.xhrFields)
for (e in a.xhrFields)
f[e] = a.xhrFields[e];
a.mimeType && f.overrideMimeType && f.overrideMimeType(a.mimeType), a.crossDomain || c["X-Requested-With"] || (c["X-Requested-With"] = "XMLHttpRequest");
for (e in c)
void 0 !== c[e] && f.setRequestHeader(e, c[e] + "");
f.send(a.hasContent && a.data || null), b = function(c, e) {
var h, i, j;
if (b && (e || 4 === f.readyState))
if (delete Yc[g], b = void 0, f.onreadystatechange = n.noop, e)
4 !== f.readyState && f.abort();
else {
j = {}, h = f.status, "string" == typeof f.responseText && (j.text = f.responseText);
try {
i = f.statusText
} catch (k) {
i = ""
}
h || !a.isLocal || a.crossDomain ? 1223 === h && (h = 204) : h = j.text ? 200 : 404
}
j && d(h, i, j, f.getAllResponseHeaders())
}, a.async ? 4 === f.readyState ? setTimeout(b) : f.onreadystatechange = Yc[g] = b : b()
}, abort: function() {
b && b(void 0, !0)
}}
}
});
function $c() {
try {
return new a.XMLHttpRequest
} catch (b) {
}
}
function _c() {
try {
return new a.ActiveXObject("Microsoft.XMLHTTP")
} catch (b) {
}
}
n.ajaxSetup({accepts: {script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"}, contents: {script: /(?:java|ecma)script/}, converters: {"text script": function(a) {
return n.globalEval(a), a
}}}), n.ajaxPrefilter("script", function(a) {
void 0 === a.cache && (a.cache = !1), a.crossDomain && (a.type = "GET", a.global = !1)
}), n.ajaxTransport("script", function(a) {
if (a.crossDomain) {
var b, c = z.head || n("head")[0] || z.documentElement;
return{send: function(d, e) {
b = z.createElement("script"), b.async = !0, a.scriptCharset && (b.charset = a.scriptCharset), b.src = a.url, b.onload = b.onreadystatechange = function(a, c) {
(c || !b.readyState || /loaded|complete/.test(b.readyState)) && (b.onload = b.onreadystatechange = null, b.parentNode && b.parentNode.removeChild(b), b = null, c || e(200, "success"))
}, c.insertBefore(b, c.firstChild)
}, abort: function() {
b && b.onload(void 0, !0)
}}
}
});
var ad = [], bd = /(=)\?(?=&|$)|\?\?/;
n.ajaxSetup({jsonp: "callback", jsonpCallback: function() {
var a = ad.pop() || n.expando + "_" + wc++;
return this[a] = !0, a
}}), n.ajaxPrefilter("json jsonp", function(b, c, d) {
var e, f, g, h = b.jsonp !== !1 && (bd.test(b.url) ? "url" : "string" == typeof b.data && !(b.contentType || "").indexOf("application/x-www-form-urlencoded") && bd.test(b.data) && "data");
return h || "jsonp" === b.dataTypes[0] ? (e = b.jsonpCallback = n.isFunction(b.jsonpCallback) ? b.jsonpCallback() : b.jsonpCallback, h ? b[h] = b[h].replace(bd, "$1" + e) : b.jsonp !== !1 && (b.url += (xc.test(b.url) ? "&" : "?") + b.jsonp + "=" + e), b.converters["script json"] = function() {
return g || n.error(e + " was not called"), g[0]
}, b.dataTypes[0] = "json", f = a[e], a[e] = function() {
g = arguments
}, d.always(function() {
a[e] = f, b[e] && (b.jsonpCallback = c.jsonpCallback, ad.push(e)), g && n.isFunction(f) && f(g[0]), g = f = void 0
}), "script") : void 0
}), n.parseHTML = function(a, b, c) {
if (!a || "string" != typeof a)
return null;
"boolean" == typeof b && (c = b, b = !1), b = b || z;
var d = v.exec(a), e = !c && [];
return d ? [b.createElement(d[1])] : (d = n.buildFragment([a], b, e), e && e.length && n(e).remove(), n.merge([], d.childNodes))
};
var cd = n.fn.load;
n.fn.load = function(a, b, c) {
if ("string" != typeof a && cd)
return cd.apply(this, arguments);
var d, e, f, g = this, h = a.indexOf(" ");
return h >= 0 && (d = a.slice(h, a.length), a = a.slice(0, h)), n.isFunction(b) ? (c = b, b = void 0) : b && "object" == typeof b && (f = "POST"), g.length > 0 && n.ajax({url: a, type: f, dataType: "html", data: b}).done(function(a) {
e = arguments, g.html(d ? n("<div>").append(n.parseHTML(a)).find(d) : a)
}).complete(c && function(a, b) {
g.each(c, e || [a.responseText, b, a])
}), this
}, n.expr.filters.animated = function(a) {
return n.grep(n.timers, function(b) {
return a === b.elem
}).length
};
var dd = a.document.documentElement;
function ed(a) {
return n.isWindow(a) ? a : 9 === a.nodeType ? a.defaultView || a.parentWindow : !1
}
n.offset = {setOffset: function(a, b, c) {
var d, e, f, g, h, i, j, k = n.css(a, "position"), l = n(a), m = {};
"static" === k && (a.style.position = "relative"), h = l.offset(), f = n.css(a, "top"), i = n.css(a, "left"), j = ("absolute" === k || "fixed" === k) && n.inArray("auto", [f, i]) > -1, j ? (d = l.position(), g = d.top, e = d.left) : (g = parseFloat(f) || 0, e = parseFloat(i) || 0), n.isFunction(b) && (b = b.call(a, c, h)), null != b.top && (m.top = b.top - h.top + g), null != b.left && (m.left = b.left - h.left + e), "using"in b ? b.using.call(a, m) : l.css(m)
}}, n.fn.extend({offset: function(a) {
if (arguments.length)
return void 0 === a ? this : this.each(function(b) {
n.offset.setOffset(this, a, b)
});
var b, c, d = {top: 0, left: 0}, e = this[0], f = e && e.ownerDocument;
if (f)
return b = f.documentElement, n.contains(b, e) ? (typeof e.getBoundingClientRect !== L && (d = e.getBoundingClientRect()), c = ed(f), {top: d.top + (c.pageYOffset || b.scrollTop) - (b.clientTop || 0), left: d.left + (c.pageXOffset || b.scrollLeft) - (b.clientLeft || 0)}) : d
}, position: function() {
if (this[0]) {
var a, b, c = {top: 0, left: 0}, d = this[0];
return"fixed" === n.css(d, "position") ? b = d.getBoundingClientRect() : (a = this.offsetParent(), b = this.offset(), n.nodeName(a[0], "html") || (c = a.offset()), c.top += n.css(a[0], "borderTopWidth", !0), c.left += n.css(a[0], "borderLeftWidth", !0)), {top: b.top - c.top - n.css(d, "marginTop", !0), left: b.left - c.left - n.css(d, "marginLeft", !0)}
}
}, offsetParent: function() {
return this.map(function() {
var a = this.offsetParent || dd;
while (a && !n.nodeName(a, "html") && "static" === n.css(a, "position"))
a = a.offsetParent;
return a || dd
})
}}), n.each({scrollLeft: "pageXOffset", scrollTop: "pageYOffset"}, function(a, b) {
var c = /Y/.test(b);
n.fn[a] = function(d) {
return W(this, function(a, d, e) {
var f = ed(a);
return void 0 === e ? f ? b in f ? f[b] : f.document.documentElement[d] : a[d] : void(f ? f.scrollTo(c ? n(f).scrollLeft() : e, c ? e : n(f).scrollTop()) : a[d] = e)
}, a, d, arguments.length, null)
}
}), n.each(["top", "left"], function(a, b) {
n.cssHooks[b] = Mb(l.pixelPosition, function(a, c) {
return c ? (c = Kb(a, b), Ib.test(c) ? n(a).position()[b] + "px" : c) : void 0
})
}), n.each({Height: "height", Width: "width"}, function(a, b) {
n.each({padding: "inner" + a, content: b, "": "outer" + a}, function(c, d) {
n.fn[d] = function(d, e) {
var f = arguments.length && (c || "boolean" != typeof d), g = c || (d === !0 || e === !0 ? "margin" : "border");
return W(this, function(b, c, d) {
var e;
return n.isWindow(b) ? b.document.documentElement["client" + a] : 9 === b.nodeType ? (e = b.documentElement, Math.max(b.body["scroll" + a], e["scroll" + a], b.body["offset" + a], e["offset" + a], e["client" + a])) : void 0 === d ? n.css(b, c, g) : n.style(b, c, d, g)
}, b, f ? d : void 0, f, null)
}
})
}), n.fn.size = function() {
return this.length
}, n.fn.andSelf = n.fn.addBack, "function" == typeof define && define.amd && define("jquery", [], function() {
return n
});
var fd = a.jQuery, gd = a.$;
return n.noConflict = function(b) {
return a.$ === n && (a.$ = gd), b && a.jQuery === n && (a.jQuery = fd), n
}, typeof b === L && (a.jQuery = a.$ = n), n
});
jQuery.noConflict();

// source --> http://www.adenimmo.localhost/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1 
/*! jQuery Migrate v1.2.1 | (c) 2005, 2013 jQuery Foundation, Inc. and other contributors | jquery.org/license */
jQuery.migrateMute === void 0 && (jQuery.migrateMute = !0), function(e, t, n) {
function r(n) {
var r = t.console;
i[n] || (i[n] = !0, e.migrateWarnings.push(n), r && r.warn && !e.migrateMute && (r.warn("JQMIGRATE: " + n), e.migrateTrace && r.trace && r.trace()))
}
function a(t, a, i, o) {
if (Object.defineProperty)
try {
return Object.defineProperty(t, a, {configurable: !0, enumerable: !0, get: function() {
return r(o), i
}, set: function(e) {
r(o), i = e
}}), n
} catch (s) {
}
e._definePropertyBroken = !0, t[a] = i
}
var i = {};
e.migrateWarnings = [], !e.migrateMute && t.console && t.console.log && t.console.log("JQMIGRATE: Logging is active"), e.migrateTrace === n && (e.migrateTrace = !0), e.migrateReset = function() {
i = {}, e.migrateWarnings.length = 0
}, "BackCompat" === document.compatMode && r("jQuery is not compatible with Quirks Mode");
var o = e("<input/>", {size: 1}).attr("size") && e.attrFn, s = e.attr, u = e.attrHooks.value && e.attrHooks.value.get || function() {
return null
}, c = e.attrHooks.value && e.attrHooks.value.set || function() {
return n
}, l = /^(?:input|button)$/i, d = /^[238]$/, p = /^(?:autofocus|autoplay|async|checked|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped|selected)$/i, f = /^(?:checked|selected)$/i;
a(e, "attrFn", o || {}, "jQuery.attrFn is deprecated"), e.attr = function(t, a, i, u) {
var c = a.toLowerCase(), g = t && t.nodeType;
return u && (4 > s.length && r("jQuery.fn.attr( props, pass ) is deprecated"), t && !d.test(g) && (o ? a in o : e.isFunction(e.fn[a]))) ? e(t)[a](i) : ("type" === a && i !== n && l.test(t.nodeName) && t.parentNode && r("Can't change the 'type' of an input or button in IE 6/7/8"), !e.attrHooks[c] && p.test(c) && (e.attrHooks[c] = {get: function(t, r) {
var a, i = e.prop(t, r);
return i === !0 || "boolean" != typeof i && (a = t.getAttributeNode(r)) && a.nodeValue !== !1 ? r.toLowerCase() : n
}, set: function(t, n, r) {
var a;
return n === !1 ? e.removeAttr(t, r) : (a = e.propFix[r] || r, a in t && (t[a] = !0), t.setAttribute(r, r.toLowerCase())), r
}}, f.test(c) && r("jQuery.fn.attr('" + c + "') may use property instead of attribute")), s.call(e, t, a, i))
}, e.attrHooks.value = {get: function(e, t) {
var n = (e.nodeName || "").toLowerCase();
return"button" === n ? u.apply(this, arguments) : ("input" !== n && "option" !== n && r("jQuery.fn.attr('value') no longer gets properties"), t in e ? e.value : null)
}, set: function(e, t) {
var a = (e.nodeName || "").toLowerCase();
return"button" === a ? c.apply(this, arguments) : ("input" !== a && "option" !== a && r("jQuery.fn.attr('value', val) no longer sets properties"), e.value = t, n)
}};
var g, h, v = e.fn.init, m = e.parseJSON, y = /^([^<]*)(<[\w\W]+>)([^>]*)$/;
e.fn.init = function(t, n, a) {
var i;
return t && "string" == typeof t && !e.isPlainObject(n) && (i = y.exec(e.trim(t))) && i[0] && ("<" !== t.charAt(0) && r("$(html) HTML strings must start with '<' character"), i[3] && r("$(html) HTML text after last tag is ignored"), "#" === i[0].charAt(0) && (r("HTML string cannot start with a '#' character"), e.error("JQMIGRATE: Invalid selector string (XSS)")), n && n.context && (n = n.context), e.parseHTML) ? v.call(this, e.parseHTML(i[2], n, !0), n, a) : v.apply(this, arguments)
}, e.fn.init.prototype = e.fn, e.parseJSON = function(e) {
return e || null === e ? m.apply(this, arguments) : (r("jQuery.parseJSON requires a valid JSON string"), null)
}, e.uaMatch = function(e) {
e = e.toLowerCase();
var t = /(chrome)[ \/]([\w.]+)/.exec(e) || /(webkit)[ \/]([\w.]+)/.exec(e) || /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(e) || /(msie) ([\w.]+)/.exec(e) || 0 > e.indexOf("compatible") && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(e) || [];
return{browser: t[1] || "", version: t[2] || "0"}
}, e.browser || (g = e.uaMatch(navigator.userAgent), h = {}, g.browser && (h[g.browser] = !0, h.version = g.version), h.chrome ? h.webkit = !0 : h.webkit && (h.safari = !0), e.browser = h), a(e, "browser", e.browser, "jQuery.browser is deprecated"), e.sub = function() {
function t(e, n) {
return new t.fn.init(e, n)
}
e.extend(!0, t, this), t.superclass = this, t.fn = t.prototype = this(), t.fn.constructor = t, t.sub = this.sub, t.fn.init = function(r, a) {
return a && a instanceof e && !(a instanceof t) && (a = t(a)), e.fn.init.call(this, r, a, n)
}, t.fn.init.prototype = t.fn;
var n = t(document);
return r("jQuery.sub() is deprecated"), t
}, e.ajaxSetup({converters: {"text json": e.parseJSON}});
var b = e.fn.data;
e.fn.data = function(t) {
var a, i, o = this[0];
return!o || "events" !== t || 1 !== arguments.length || (a = e.data(o, t), i = e._data(o, t), a !== n && a !== i || i === n) ? b.apply(this, arguments) : (r("Use of jQuery.fn.data('events') is deprecated"), i)
};
var j = /\/(java|ecma)script/i, w = e.fn.andSelf || e.fn.addBack;
e.fn.andSelf = function() {
return r("jQuery.fn.andSelf() replaced by jQuery.fn.addBack()"), w.apply(this, arguments)
}, e.clean || (e.clean = function(t, a, i, o) {
a = a || document, a = !a.nodeType && a[0] || a, a = a.ownerDocument || a, r("jQuery.clean() is deprecated");
var s, u, c, l, d = [];
if (e.merge(d, e.buildFragment(t, a).childNodes), i)
for (c = function(e) {
return!e.type || j.test(e.type) ? o ? o.push(e.parentNode ? e.parentNode.removeChild(e) : e) : i.appendChild(e) : n
}, s = 0; null != (u = d[s]); s++)
e.nodeName(u, "script") && c(u) || (i.appendChild(u), u.getElementsByTagName !== n && (l = e.grep(e.merge([], u.getElementsByTagName("script")), c), d.splice.apply(d, [s + 1, 0].concat(l)), s += l.length));
return d
});
var Q = e.event.add, x = e.event.remove, k = e.event.trigger, N = e.fn.toggle, T = e.fn.live, M = e.fn.die, S = "ajaxStart|ajaxStop|ajaxSend|ajaxComplete|ajaxError|ajaxSuccess", C = RegExp("\\b(?:" + S + ")\\b"), H = /(?:^|\s)hover(\.\S+|)\b/, A = function(t) {
return"string" != typeof t || e.event.special.hover ? t : (H.test(t) && r("'hover' pseudo-event is deprecated, use 'mouseenter mouseleave'"), t && t.replace(H, "mouseenter$1 mouseleave$1"))
};
e.event.props && "attrChange" !== e.event.props[0] && e.event.props.unshift("attrChange", "attrName", "relatedNode", "srcElement"), e.event.dispatch && a(e.event, "handle", e.event.dispatch, "jQuery.event.handle is undocumented and deprecated"), e.event.add = function(e, t, n, a, i) {
e !== document && C.test(t) && r("AJAX events should be attached to document: " + t), Q.call(this, e, A(t || ""), n, a, i)
}, e.event.remove = function(e, t, n, r, a) {
x.call(this, e, A(t) || "", n, r, a)
}, e.fn.error = function() {
var e = Array.prototype.slice.call(arguments, 0);
return r("jQuery.fn.error() is deprecated"), e.splice(0, 0, "error"), arguments.length ? this.bind.apply(this, e) : (this.triggerHandler.apply(this, e), this)
}, e.fn.toggle = function(t, n) {
if (!e.isFunction(t) || !e.isFunction(n))
return N.apply(this, arguments);
r("jQuery.fn.toggle(handler, handler...) is deprecated");
var a = arguments, i = t.guid || e.guid++, o = 0, s = function(n) {
var r = (e._data(this, "lastToggle" + t.guid) || 0) % o;
return e._data(this, "lastToggle" + t.guid, r + 1), n.preventDefault(), a[r].apply(this, arguments) || !1
};
for (s.guid = i; a.length > o; )
a[o++].guid = i;
return this.click(s)
}, e.fn.live = function(t, n, a) {
return r("jQuery.fn.live() is deprecated"), T ? T.apply(this, arguments) : (e(this.context).on(t, this.selector, n, a), this)
}, e.fn.die = function(t, n) {
return r("jQuery.fn.die() is deprecated"), M ? M.apply(this, arguments) : (e(this.context).off(t, this.selector || "**", n), this)
}, e.event.trigger = function(e, t, n, a) {
return n || C.test(e) || r("Global events are undocumented and deprecated"), k.call(this, e, t, n || document, a)
}, e.each(S.split("|"), function(t, n) {
e.event.special[n] = {setup: function() {
var t = this;
return t !== document && (e.event.add(document, n + "." + e.guid, function() {
e.event.trigger(n, null, t, !0)
}), e._data(this, n, e.guid++)), !1
}, teardown: function() {
return this !== document && e.event.remove(document, n + "." + e._data(this, n)), !1
}}
})
}(jQuery, window);
// source --> http://www.adenimmo.localhost/wp-content/plugins/estateprogram/public/assets/js/public.js?ver=1.0.0 
(function($) {
"use strict";
$(function() {
$('.add-to-preference').live("click", function() {
var element = $(this).find('i');
var this_element = $(this);
var data = {
action: 'add_to_preference',
flat_id: $(this).attr("data-flat_id")
};
var confirm_remove = $('.apartment-list').hasClass("confirm-remove");
var remove_row = $('.apartment-list').hasClass("remove-favorite-row");
if (confirm_remove) {
$('#removePreferenceModal').modal({backdrop: 'static', keyboard: false}).one('click', '#delete', function() {
$.post(estateprogram.ajaxurl, data, function(response) {
if (1 == response) {
element.removeClass('fa-star-o blue').addClass('fa-star red');
} else {
if (remove_row) {
console.log('remove');
this_element.closest('.apartment-row').remove();
} else {
element.removeClass('fa-star red').addClass('fa-star-o blue');
}
}
}).fail(function() {
//alert( "error" );
})
});
} else {
$.post(estateprogram.ajaxurl, data, function(response) {
if (1 == response) {
element.removeClass('fa-star-o blue').addClass('fa-star red');
this_element.find('.fav-label').html(estateprogram.added);
} else {
if (remove_row) {
console.log('removing..');
//element.closest('tr').remove();
element.closest('.apartment-row').remove();
} else {
element.removeClass('fa-star red').addClass('fa-star-o blue');
this_element.find('.fav-label').html(estateprogram.removed);
}
}
}).fail(function() {
//alert( "error" );
})
}
});
});
}(jQuery));

// source --> http://www.adenimmo.localhost/wp-content/plugins/pdfgenerator/public/assets/js/public.js?ver=1.0.0 
(function($) {
"use strict";
$(function() {
// Place your public-facing JavaScript here
});
}(jQuery));
// source --> http://www.adenimmo.localhost/wp-content/plugins/recommendation/public/assets/js/public.js?ver=1.0.0 
(function($) {
"use strict";
$(function() {
// Place your public-facing JavaScript here
});
}(jQuery));
// source --> http://www.adenimmo.localhost/wp-content/themes/wordpress-bootstrap-master/library/js/scripts.js?ver=1.2 
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
/*! Magnific Popup - v0.9.9 - 2013-12-27
* http://dimsemenov.com/plugins/magnific-popup/
* Copyright (c) 2013 Dmitry Semenov; */
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
slideMargin: 0,
pager: false,
prevText: '',
nextText: '',
});
});
// source --> http://www.adenimmo.localhost/wp-content/themes/wordpress-bootstrap-master/library/js/modernizr.full.min.js?ver=1.2 
/* Modernizr 2.0.6 (Custom Build) | MIT & BSD
* Contains: fontface | backgroundsize | borderimage | borderradius | boxshadow | flexbox | hsla | multiplebgs | opacity | rgba | textshadow | cssanimations | csscolumns | generatedcontent | cssgradients | cssreflections | csstransforms | csstransforms3d | csstransitions | applicationcache | canvas | canvastext | draganddrop | hashchange | history | audio | video | indexeddb | input | inputtypes | localstorage | postmessage | sessionstorage | websockets | websqldatabase | webworkers | geolocation | inlinesvg | smil | svg | svgclippaths | touch | webgl | iepp | respond | mq | cssclasses | addtest | prefixed | teststyles | testprop | testallprops | hasevent | prefixes | domprefixes | load
*/
;
window.Modernizr = function(a, b, c) {
function I() {
e.input = function(a) {
for (var b = 0, c = a.length; b < c; b++)
t[a[b]] = a[b]in l;
return t
}("autocomplete autofocus list placeholder max min multiple pattern required step".split(" ")), e.inputtypes = function(a) {
for (var d = 0, e, f, h, i = a.length; d < i; d++)
l.setAttribute("type", f = a[d]), e = l.type !== "text", e && (l.value = m, l.style.cssText = "position:absolute;visibility:hidden;", /^range$/.test(f) && l.style.WebkitAppearance !== c ? (g.appendChild(l), h = b.defaultView, e = h.getComputedStyle && h.getComputedStyle(l, null).WebkitAppearance !== "textfield" && l.offsetHeight !== 0, g.removeChild(l)) : /^(search|tel)$/.test(f) || (/^(url|email)$/.test(f) ? e = l.checkValidity && l.checkValidity() === !1 : /^color$/.test(f) ? (g.appendChild(l), g.offsetWidth, e = l.value != m, g.removeChild(l)) : e = l.value != m)), s[a[d]] = !!e;
return s
}("search tel url email datetime date month week time datetime-local number range color".split(" "))
}
function G(a, b) {
var c = a.charAt(0).toUpperCase() + a.substr(1), d = (a + " " + p.join(c + " ") + c).split(" ");
return F(d, b)
}
function F(a, b) {
for (var d in a)
if (k[a[d]] !== c)
return b == "pfx" ? a[d] : !0;
return!1
}
function E(a, b) {
return!!~("" + a).indexOf(b)
}
function D(a, b) {
return typeof a === b
}
function C(a, b) {
return B(o.join(a + ";") + (b || ""))
}
function B(a) {
k.cssText = a
}
var d = "2.0.6", e = {}, f = !0, g = b.documentElement, h = b.head || b.getElementsByTagName("head")[0], i = "modernizr", j = b.createElement(i), k = j.style, l = b.createElement("input"), m = ":)", n = Object.prototype.toString, o = " -webkit- -moz- -o- -ms- -khtml- ".split(" "), p = "Webkit Moz O ms Khtml".split(" "), q = {svg: "http://www.w3.org/2000/svg"}, r = {}, s = {}, t = {}, u = [], v = function(a, c, d, e) {
var f, h, j, k = b.createElement("div");
if (parseInt(d, 10))
while (d--)
j = b.createElement("div"), j.id = e ? e[d] : i + (d + 1), k.appendChild(j);
f = ["&shy;", "<style>", a, "</style>"].join(""), k.id = i, k.innerHTML += f, g.appendChild(k), h = c(k, a), k.parentNode.removeChild(k);
return!!h
}, w = function(b) {
if (a.matchMedia)
return matchMedia(b).matches;
var c;
v("@media " + b + " { #" + i + " { position: absolute; } }", function(b) {
c = (a.getComputedStyle ? getComputedStyle(b, null) : b.currentStyle).position == "absolute"
});
return c
}, x = function() {
function d(d, e) {
e = e || b.createElement(a[d] || "div"), d = "on" + d;
var f = d in e;
f || (e.setAttribute || (e = b.createElement("div")), e.setAttribute && e.removeAttribute && (e.setAttribute(d, ""), f = D(e[d], "function"), D(e[d], c) || (e[d] = c), e.removeAttribute(d))), e = null;
return f
}
var a = {select: "input", change: "input", submit: "form", reset: "form", error: "img", load: "img", abort: "img"};
return d
}(), y, z = {}.hasOwnProperty, A;
!D(z, c) && !D(z.call, c) ? A = function(a, b) {
return z.call(a, b)
} : A = function(a, b) {
return b in a && D(a.constructor.prototype[b], c)
};
var H = function(c, d) {
var f = c.join(""), g = d.length;
v(f, function(c, d) {
var f = b.styleSheets[b.styleSheets.length - 1], h = f.cssRules && f.cssRules[0] ? f.cssRules[0].cssText : f.cssText || "", i = c.childNodes, j = {};
while (g--)
j[i[g].id] = i[g];
e.touch = "ontouchstart"in a || j.touch.offsetTop === 9, e.csstransforms3d = j.csstransforms3d.offsetLeft === 9, e.generatedcontent = j.generatedcontent.offsetHeight >= 1, e.fontface = /src/i.test(h) && h.indexOf(d.split(" ")[0]) === 0
}, g, d)
}(['@font-face {font-family:"font";src:url("https://")}', ["@media (", o.join("touch-enabled),("), i, ")", "{#touch{top:9px;position:absolute}}"].join(""), ["@media (", o.join("transform-3d),("), i, ")", "{#csstransforms3d{left:9px;position:absolute}}"].join(""), ['#generatedcontent:after{content:"', m, '";visibility:hidden}'].join("")], ["fontface", "touch", "csstransforms3d", "generatedcontent"]);
r.flexbox = function() {
function c(a, b, c, d) {
a.style.cssText = o.join(b + ":" + c + ";") + (d || "")
}
function a(a, b, c, d) {
b += ":", a.style.cssText = (b + o.join(c + ";" + b)).slice(0, -b.length) + (d || "")
}
var d = b.createElement("div"), e = b.createElement("div");
a(d, "display", "box", "width:42px;padding:0;"), c(e, "box-flex", "1", "width:10px;"), d.appendChild(e), g.appendChild(d);
var f = e.offsetWidth === 42;
d.removeChild(e), g.removeChild(d);
return f
}, r.canvas = function() {
var a = b.createElement("canvas");
return!!a.getContext && !!a.getContext("2d")
}, r.canvastext = function() {
return!!e.canvas && !!D(b.createElement("canvas").getContext("2d").fillText, "function")
}, r.webgl = function() {
return!!a.WebGLRenderingContext
}, r.touch = function() {
return e.touch
}, r.geolocation = function() {
return!!navigator.geolocation
}, r.postmessage = function() {
return!!a.postMessage
}, r.websqldatabase = function() {
var b = !!a.openDatabase;
return b
}, r.indexedDB = function() {
for (var b = -1, c = p.length; ++b < c; )
if (a[p[b].toLowerCase() + "IndexedDB"])
return!0;
return!!a.indexedDB
}, r.hashchange = function() {
return x("hashchange", a) && (b.documentMode === c || b.documentMode > 7)
}, r.history = function() {
return!!a.history && !!history.pushState
}, r.draganddrop = function() {
return x("dragstart") && x("drop")
}, r.websockets = function() {
for (var b = -1, c = p.length; ++b < c; )
if (a[p[b] + "WebSocket"])
return!0;
return"WebSocket"in a
}, r.rgba = function() {
B("background-color:rgba(150,255,150,.5)");
return E(k.backgroundColor, "rgba")
}, r.hsla = function() {
B("background-color:hsla(120,40%,100%,.5)");
return E(k.backgroundColor, "rgba") || E(k.backgroundColor, "hsla")
}, r.multiplebgs = function() {
B("background:url(https://),url(https://),red url(https://)");
return/(url\s*\(.*?){3}/.test(k.background)
}, r.backgroundsize = function() {
return G("backgroundSize")
}, r.borderimage = function() {
return G("borderImage")
}, r.borderradius = function() {
return G("borderRadius")
}, r.boxshadow = function() {
return G("boxShadow")
}, r.textshadow = function() {
return b.createElement("div").style.textShadow === ""
}, r.opacity = function() {
C("opacity:.55");
return/^0.55$/.test(k.opacity)
}, r.cssanimations = function() {
return G("animationName")
}, r.csscolumns = function() {
return G("columnCount")
}, r.cssgradients = function() {
var a = "background-image:", b = "gradient(linear,left top,right bottom,from(#9f9),to(white));", c = "linear-gradient(left top,#9f9, white);";
B((a + o.join(b + a) + o.join(c + a)).slice(0, -a.length));
return E(k.backgroundImage, "gradient")
}, r.cssreflections = function() {
return G("boxReflect")
}, r.csstransforms = function() {
return!!F(["transformProperty", "WebkitTransform", "MozTransform", "OTransform", "msTransform"])
}, r.csstransforms3d = function() {
var a = !!F(["perspectiveProperty", "WebkitPerspective", "MozPerspective", "OPerspective", "msPerspective"]);
a && "webkitPerspective"in g.style && (a = e.csstransforms3d);
return a
}, r.csstransitions = function() {
return G("transitionProperty")
}, r.fontface = function() {
return e.fontface
}, r.generatedcontent = function() {
return e.generatedcontent
}, r.video = function() {
var a = b.createElement("video"), c = !1;
try {
if (c = !!a.canPlayType) {
c = new Boolean(c), c.ogg = a.canPlayType('video/ogg; codecs="theora"');
var d = 'video/mp4; codecs="avc1.42E01E';
c.h264 = a.canPlayType(d + '"') || a.canPlayType(d + ', mp4a.40.2"'), c.webm = a.canPlayType('video/webm; codecs="vp8, vorbis"')
}
} catch (e) {
}
return c
}, r.audio = function() {
var a = b.createElement("audio"), c = !1;
try {
if (c = !!a.canPlayType)
c = new Boolean(c), c.ogg = a.canPlayType('audio/ogg; codecs="vorbis"'), c.mp3 = a.canPlayType("audio/mpeg;"), c.wav = a.canPlayType('audio/wav; codecs="1"'), c.m4a = a.canPlayType("audio/x-m4a;") || a.canPlayType("audio/aac;")
} catch (d) {
}
return c
}, r.localstorage = function() {
try {
return!!localStorage.getItem
} catch (a) {
return!1
}
}, r.sessionstorage = function() {
try {
return!!sessionStorage.getItem
} catch (a) {
return!1
}
}, r.webworkers = function() {
return!!a.Worker
}, r.applicationcache = function() {
return!!a.applicationCache
}, r.svg = function() {
return!!b.createElementNS && !!b.createElementNS(q.svg, "svg").createSVGRect
}, r.inlinesvg = function() {
var a = b.createElement("div");
a.innerHTML = "<svg/>";
return(a.firstChild && a.firstChild.namespaceURI) == q.svg
}, r.smil = function() {
return!!b.createElementNS && /SVG/.test(n.call(b.createElementNS(q.svg, "animate")))
}, r.svgclippaths = function() {
return!!b.createElementNS && /SVG/.test(n.call(b.createElementNS(q.svg, "clipPath")))
};
for (var J in r)
A(r, J) && (y = J.toLowerCase(), e[y] = r[J](), u.push((e[y] ? "" : "no-") + y));
e.input || I(), e.addTest = function(a, b) {
if (typeof a == "object")
for (var d in a)
A(a, d) && e.addTest(d, a[d]);
else {
a = a.toLowerCase();
if (e[a] !== c)
return;
b = typeof b == "boolean" ? b : !!b(), g.className += " " + (b ? "" : "no-") + a, e[a] = b
}
return e
}, B(""), j = l = null, a.attachEvent && function() {
var a = b.createElement("div");
a.innerHTML = "<elem></elem>";
return a.childNodes.length !== 1
}() && function(a, b) {
function s(a) {
var b = -1;
while (++b < g)
a.createElement(f[b])
}
a.iepp = a.iepp || {};
var d = a.iepp, e = d.html5elements || "abbr|article|aside|audio|canvas|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video", f = e.split("|"), g = f.length, h = new RegExp("(^|\\s)(" + e + ")", "gi"), i = new RegExp("<(/*)(" + e + ")", "gi"), j = /^\s*[\{\}]\s*$/, k = new RegExp("(^|[^\\n]*?\\s)(" + e + ")([^\\n]*)({[\\n\\w\\W]*?})", "gi"), l = b.createDocumentFragment(), m = b.documentElement, n = m.firstChild, o = b.createElement("body"), p = b.createElement("style"), q = /print|all/, r;
d.getCSS = function(a, b) {
if (a + "" === c)
return"";
var e = -1, f = a.length, g, h = [];
while (++e < f) {
g = a[e];
if (g.disabled)
continue;
b = g.media || b, q.test(b) && h.push(d.getCSS(g.imports, b), g.cssText), b = "all"
}
return h.join("")
}, d.parseCSS = function(a) {
var b = [], c;
while ((c = k.exec(a)) != null)
b.push(((j.exec(c[1]) ? "\n" : c[1]) + c[2] + c[3]).replace(h, "$1.iepp_$2") + c[4]);
return b.join("\n")
}, d.writeHTML = function() {
var a = -1;
r = r || b.body;
while (++a < g) {
var c = b.getElementsByTagName(f[a]), d = c.length, e = -1;
while (++e < d)
c[e].className.indexOf("iepp_") < 0 && (c[e].className += " iepp_" + f[a])
}
l.appendChild(r), m.appendChild(o), o.className = r.className, o.id = r.id, o.innerHTML = r.innerHTML.replace(i, "<$1font")
}, d._beforePrint = function() {
p.styleSheet.cssText = d.parseCSS(d.getCSS(b.styleSheets, "all")), d.writeHTML()
}, d.restoreHTML = function() {
o.innerHTML = "", m.removeChild(o), m.appendChild(r)
}, d._afterPrint = function() {
d.restoreHTML(), p.styleSheet.cssText = ""
}, s(b), s(l);
d.disablePP || (n.insertBefore(p, n.firstChild), p.media = "print", p.className = "iepp-printshim", a.attachEvent("onbeforeprint", d._beforePrint), a.attachEvent("onafterprint", d._afterPrint))
}(a, b), e._version = d, e._prefixes = o, e._domPrefixes = p, e.mq = w, e.hasEvent = x, e.testProp = function(a) {
return F([a])
}, e.testAllProps = G, e.testStyles = v, e.prefixed = function(a) {
return G(a, "pfx")
}, g.className = g.className.replace(/\bno-js\b/, "") + (f ? " js " + u.join(" ") : "");
return e
}(this, this.document), function(a, b) {
function u() {
r(!0)
}
a.respond = {}, respond.update = function() {
}, respond.mediaQueriesSupported = b;
if (!b) {
var c = a.document, d = c.documentElement, e = [], f = [], g = [], h = {}, i = 30, j = c.getElementsByTagName("head")[0] || d, k = j.getElementsByTagName("link"), l = [], m = function() {
var b = k, c = b.length, d = 0, e, f, g, i;
for (; d < c; d++)
e = b[d], f = e.href, g = e.media, i = e.rel && e.rel.toLowerCase() === "stylesheet", !!f && i && !h[f] && (!/^([a-zA-Z]+?:(\/\/)?(www\.)?)/.test(f) || f.replace(RegExp.$1, "").split("/")[0] === a.location.host ? l.push({href: f, media: g}) : h[f] = !0);
n()
}, n = function() {
if (l.length) {
var a = l.shift();
s(a.href, function(b) {
o(b, a.href, a.media), h[a.href] = !0, n()
})
}
}, o = function(a, b, c) {
var d = a.match(/@media[^\{]+\{([^\{\}]+\{[^\}\{]+\})+/gi), g = d && d.length || 0, b = b.substring(0, b.lastIndexOf("/")), h = function(a) {
return a.replace(/(url\()['"]?([^\/\)'"][^:\)'"]+)['"]?(\))/g, "$1" + b + "$2$3")
}, i = !g && c, j = 0, k, l, m, n, o;
b.length && (b += "/"), i && (g = 1);
for (; j < g; j++) {
k = 0, i ? (l = c, f.push(h(a))) : (l = d[j].match(/@media ([^\{]+)\{([\S\s]+?)$/) && RegExp.$1, f.push(RegExp.$2 && h(RegExp.$2))), n = l.split(","), o = n.length;
for (; k < o; k++)
m = n[k], e.push({media: m.match(/(only\s+)?([a-zA-Z]+)(\sand)?/) && RegExp.$2, rules: f.length - 1, minw: m.match(/\(min\-width:[\s]*([\s]*[0-9]+)px[\s]*\)/) && parseFloat(RegExp.$1), maxw: m.match(/\(max\-width:[\s]*([\s]*[0-9]+)px[\s]*\)/) && parseFloat(RegExp.$1)})
}
r()
}, p, q, r = function(a) {
var b = "clientWidth", h = d[b], l = c.compatMode === "CSS1Compat" && h || c.body[b] || h, m = {}, n = c.createDocumentFragment(), o = k[k.length - 1], s = (new Date).getTime();
if (a && p && s - p < i)
clearTimeout(q), q = setTimeout(r, i);
else {
p = s;
for (var t in e) {
var u = e[t];
if (!u.minw && !u.maxw || (!u.minw || u.minw && l >= u.minw) && (!u.maxw || u.maxw && l <= u.maxw))
m[u.media] || (m[u.media] = []), m[u.media].push(f[u.rules])
}
for (var t in g)
g[t] && g[t].parentNode === j && j.removeChild(g[t]);
for (var t in m) {
var v = c.createElement("style"), w = m[t].join("\n");
v.type = "text/css", v.media = t, v.styleSheet ? v.styleSheet.cssText = w : v.appendChild(c.createTextNode(w)), n.appendChild(v), g.push(v)
}
j.insertBefore(n, o.nextSibling)
}
}, s = function(a, b) {
var c = t();
if (!!c) {
c.open("GET", a, !0), c.onreadystatechange = function() {
c.readyState == 4 && (c.status == 200 || c.status == 304) && b(c.responseText)
};
if (c.readyState == 4)
return;
c.send()
}
}, t = function() {
var a = !1, b = [function() {
return new ActiveXObject("Microsoft.XMLHTTP")
}, function() {
return new XMLHttpRequest
}], c = b.length;
while (c--) {
try {
a = b[c]()
} catch (d) {
continue
}
break
}
return function() {
return a
}
}();
m(), respond.update = m, a.addEventListener ? a.addEventListener("resize", u, !1) : a.attachEvent && a.attachEvent("onresize", u)
}
}(this, Modernizr.mq("only all")), function(a, b, c) {
function k(a) {
return!a || a == "loaded" || a == "complete"
}
function j() {
var a = 1, b = -1;
while (p.length - ++b)
if (p[b].s && !(a = p[b].r))
break;
a && g()
}
function i(a) {
var c = b.createElement("script"), d;
c.src = a.s, c.onreadystatechange = c.onload = function() {
!d && k(c.readyState) && (d = 1, j(), c.onload = c.onreadystatechange = null)
}, m(function() {
d || (d = 1, j())
}, H.errorTimeout), a.e ? c.onload() : n.parentNode.insertBefore(c, n)
}
function h(a) {
var c = b.createElement("link"), d;
c.href = a.s, c.rel = "stylesheet", c.type = "text/css";
if (!a.e && (w || r)) {
var e = function(a) {
m(function() {
if (!d)
try {
a.sheet.cssRules.length ? (d = 1, j()) : e(a)
} catch (b) {
b.code == 1e3 || b.message == "security" || b.message == "denied" ? (d = 1, m(function() {
j()
}, 0)) : e(a)
}
}, 0)
};
e(c)
} else
c.onload = function() {
d || (d = 1, m(function() {
j()
}, 0))
}, a.e && c.onload();
m(function() {
d || (d = 1, j())
}, H.errorTimeout), !a.e && n.parentNode.insertBefore(c, n)
}
function g() {
var a = p.shift();
q = 1, a ? a.t ? m(function() {
a.t == "c" ? h(a) : i(a)
}, 0) : (a(), j()) : q = 0
}
function f(a, c, d, e, f, h) {
function i() {
!o && k(l.readyState) && (r.r = o = 1, !q && j(), l.onload = l.onreadystatechange = null, m(function() {
u.removeChild(l)
}, 0))
}
var l = b.createElement(a), o = 0, r = {t: d, s: c, e: h};
l.src = l.data = c, !s && (l.style.display = "none"), l.width = l.height = "0", a != "object" && (l.type = d), l.onload = l.onreadystatechange = i, a == "img" ? l.onerror = i : a == "script" && (l.onerror = function() {
r.e = r.r = 1, g()
}), p.splice(e, 0, r), u.insertBefore(l, s ? null : n), m(function() {
o || (u.removeChild(l), r.r = r.e = o = 1, j())
}, H.errorTimeout)
}
function e(a, b, c) {
var d = b == "c" ? z : y;
q = 0, b = b || "j", C(a) ? f(d, a, b, this.i++, l, c) : (p.splice(this.i++, 0, a), p.length == 1 && g());
return this
}
function d() {
var a = H;
a.loader = {load: e, i: 0};
return a
}
var l = b.documentElement, m = a.setTimeout, n = b.getElementsByTagName("script")[0], o = {}.toString, p = [], q = 0, r = "MozAppearance"in l.style, s = r && !!b.createRange().compareNode, t = r && !s, u = s ? l : n.parentNode, v = a.opera && o.call(a.opera) == "[object Opera]", w = "webkitAppearance"in l.style, x = w && "async"in b.createElement("script"), y = r ? "object" : v || x ? "img" : "script", z = w ? "img" : y, A = Array.isArray || function(a) {
return o.call(a) == "[object Array]"
}, B = function(a) {
return Object(a) === a
}, C = function(a) {
return typeof a == "string"
}, D = function(a) {
return o.call(a) == "[object Function]"
}, E = [], F = {}, G, H;
H = function(a) {
function f(a) {
var b = a.split("!"), c = E.length, d = b.pop(), e = b.length, f = {url: d, origUrl: d, prefixes: b}, g, h;
for (h = 0; h < e; h++)
g = F[b[h]], g && (f = g(f));
for (h = 0; h < c; h++)
f = E[h](f);
return f
}
function e(a, b, e, g, h) {
var i = f(a), j = i.autoCallback;
if (!i.bypass) {
b && (b = D(b) ? b : b[a] || b[g] || b[a.split("/").pop().split("?")[0]]);
if (i.instead)
return i.instead(a, b, e, g, h);
e.load(i.url, i.forceCSS || !i.forceJS && /css$/.test(i.url) ? "c" : c, i.noexec), (D(b) || D(j)) && e.load(function() {
d(), b && b(i.origUrl, h, g), j && j(i.origUrl, h, g)
})
}
}
function b(a, b) {
function c(a) {
if (C(a))
e(a, h, b, 0, d);
else if (B(a))
for (i in a)
a.hasOwnProperty(i) && e(a[i], h, b, i, d)
}
var d = !!a.test, f = d ? a.yep : a.nope, g = a.load || a.both, h = a.callback, i;
c(f), c(g), a.complete && b.load(a.complete)
}
var g, h, i = this.yepnope.loader;
if (C(a))
e(a, 0, i, 0);
else if (A(a))
for (g = 0; g < a.length; g++)
h = a[g], C(h) ? e(h, 0, i, 0) : A(h) ? H(h) : B(h) && b(h, i);
else
B(a) && b(a, i)
}, H.addPrefix = function(a, b) {
F[a] = b
}, H.addFilter = function(a) {
E.push(a)
}, H.errorTimeout = 1e4, b.readyState == null && b.addEventListener && (b.readyState = "loading", b.addEventListener("DOMContentLoaded", G = function() {
b.removeEventListener("DOMContentLoaded", G, 0), b.readyState = "complete"
}, 0)), a.yepnope = d()
}(this, this.document), Modernizr.load = function() {
yepnope.apply(window, [].slice.call(arguments, 0))
};