/*! UIkit 3.5.7 | https://www.getuikit.com | (c) 2014 - 2020 YOOtheme | MIT License */

!function(t, e) {
    "object" == typeof exports && "undefined" != typeof module ? module.exports = e() : "function" == typeof define && define.amd ? define("uikit", e) : (t = "undefined" != typeof globalThis ? globalThis : t || self).UIkit = e()
}(this, function() {
    "use strict";
    var t = Object.prototype
      , n = t.hasOwnProperty;
    function l(t, e) {
        return n.call(t, e)
    }
    var e = {}
      , i = /([a-z\d])([A-Z])/g;
    function d(t) {
        return t in e || (e[t] = t.replace(i, "$1-$2").toLowerCase()),
        e[t]
    }
    var r = /-(\w)/g;
    function f(t) {
        return t.replace(r, o)
    }
    function o(t, e) {
        return e ? e.toUpperCase() : ""
    }
    function p(t) {
        return t.length ? o(0, t.charAt(0)) + t.slice(1) : ""
    }
    var s = String.prototype
      , a = s.startsWith || function(t) {
        return 0 === this.lastIndexOf(t, 0)
    }
    ;
    function w(t, e) {
        return a.call(t, e)
    }
    var u = s.endsWith || function(t) {
        return this.substr(-t.length) === t
    }
    ;
    function h(t, e) {
        return u.call(t, e)
    }
    function c(t, e) {
        return !!~this.indexOf(t, e)
    }
    var g = Array.prototype
      , m = s.includes || c
      , v = g.includes || c;
    function b(t, e) {
        return t && (D(t) ? m : v).call(t, e)
    }
    var x = g.findIndex || function(t) {
        for (var e = arguments, n = 0; n < this.length; n++)
            if (t.call(e[1], this[n], n, this))
                return n;
        return -1
    }
    ;
    function y(t, e) {
        return x.call(t, e)
    }
    var k = Array.isArray;
    function $(t) {
        return "function" == typeof t
    }
    function I(t) {
        return null !== t && "object" == typeof t
    }
    var S = t.toString;
    function T(t) {
        return "[object Object]" === S.call(t)
    }
    function E(t) {
        return I(t) && t === t.window
    }
    function _(t) {
        return I(t) && 9 === t.nodeType
    }
    function C(t) {
        return I(t) && !!t.jquery
    }
    function A(t) {
        return I(t) && 1 <= t.nodeType
    }
    function N(t) {
        return I(t) && 1 === t.nodeType
    }
    function M(t) {
        return S.call(t).match(/^\[object (NodeList|HTMLCollection)\]$/)
    }
    function z(t) {
        return "boolean" == typeof t
    }
    function D(t) {
        return "string" == typeof t
    }
    function B(t) {
        return "number" == typeof t
    }
    function P(t) {
        return B(t) || D(t) && !isNaN(t - parseFloat(t))
    }
    function O(t) {
        return !(k(t) ? t.length : I(t) && Object.keys(t).length)
    }
    function H(t) {
        return void 0 === t
    }
    function L(t) {
        return z(t) ? t : "true" === t || "1" === t || "" === t || "false" !== t && "0" !== t && t
    }
    function j(t) {
        var e = Number(t);
        return !isNaN(e) && e
    }
    function F(t) {
        return parseFloat(t) || 0
    }
    function W(t) {
        return A(t) ? t : M(t) || C(t) ? t[0] : k(t) ? W(t[0]) : null
    }
    function V(t) {
        return A(t) ? [t] : M(t) ? g.slice.call(t) : k(t) ? t.map(W).filter(Boolean) : C(t) ? t.toArray() : []
    }
    function R(t) {
        return E(t) ? t : (t = W(t)) ? (_(t) ? t : t.ownerDocument).defaultView : window
    }
    function q(t) {
        return k(t) ? t : D(t) ? t.split(/,(?![^(]*\))/).map(function(t) {
            return P(t) ? j(t) : L(t.trim())
        }) : [t]
    }
    function U(t) {
        return t ? h(t, "ms") ? F(t) : 1e3 * F(t) : 0
    }
    function Y(t, n) {
        return t === n || I(t) && I(n) && Object.keys(t).length === Object.keys(n).length && K(t, function(t, e) {
            return t === n[e]
        })
    }
    function X(t, e, n) {
        return t.replace(new RegExp(e + "|" + n,"g"), function(t) {
            return t === e ? n : e
        })
    }
    var G = Object.assign || function(t) {
        for (var e = [], n = arguments.length - 1; 0 < n--; )
            e[n] = arguments[n + 1];
        t = Object(t);
        for (var i = 0; i < e.length; i++) {
            var r = e[i];
            if (null !== r)
                for (var o in r)
                    l(r, o) && (t[o] = r[o])
        }
        return t
    }
    ;
    function J(t) {
        return t[t.length - 1]
    }
    function K(t, e) {
        for (var n in t)
            if (!1 === e(t[n], n))
                return !1;
        return !0
    }
    function Z(t, r) {
        return t.sort(function(t, e) {
            var n = t[r];
            void 0 === n && (n = 0);
            var i = e[r];
            return void 0 === i && (i = 0),
            i < n ? 1 : n < i ? -1 : 0
        })
    }
    function Q(t, n) {
        var i = new Set;
        return t.filter(function(t) {
            var e = t[n];
            return !i.has(e) && (i.add(e) || !0)
        })
    }
    function tt(t, e, n) {
        return void 0 === e && (e = 0),
        void 0 === n && (n = 1),
        Math.min(Math.max(j(t) || 0, e), n)
    }
    function et() {}
    function nt(t, e) {
        return t.left < e.right && t.right > e.left && t.top < e.bottom && t.bottom > e.top
    }
    function it(t, e) {
        return t.x <= e.right && t.x >= e.left && t.y <= e.bottom && t.y >= e.top
    }
    var rt = {
        ratio: function(t, e, n) {
            var i = "width" === e ? "height" : "width"
              , r = {};
            return r[i] = t[e] ? Math.round(n * t[i] / t[e]) : t[i],
            r[e] = n,
            r
        },
        contain: function(n, i) {
            var r = this;
            return K(n = G({}, n), function(t, e) {
                return n = n[e] > i[e] ? r.ratio(n, e, i[e]) : n
            }),
            n
        },
        cover: function(n, i) {
            var r = this;
            return K(n = this.contain(n, i), function(t, e) {
                return n = n[e] < i[e] ? r.ratio(n, e, i[e]) : n
            }),
            n
        }
    };
    function ot(t, e, n) {
        if (I(e))
            for (var i in e)
                ot(t, i, e[i]);
        else {
            if (H(n))
                return (t = W(t)) && t.getAttribute(e);
            V(t).forEach(function(t) {
                $(n) && (n = n.call(t, ot(t, e))),
                null === n ? at(t, e) : t.setAttribute(e, n)
            })
        }
    }
    function st(t, e) {
        return V(t).some(function(t) {
            return t.hasAttribute(e)
        })
    }
    function at(t, e) {
        t = V(t),
        e.split(" ").forEach(function(e) {
            return t.forEach(function(t) {
                return t.hasAttribute(e) && t.removeAttribute(e)
            })
        })
    }
    function ut(t, e) {
        for (var n = 0, i = [e, "data-" + e]; n < i.length; n++)
            if (st(t, i[n]))
                return ot(t, i[n])
    }
    var ht = "undefined" != typeof window
      , ct = ht && /msie|trident/i.test(window.navigator.userAgent)
      , lt = ht && "rtl" === ot(document.documentElement, "dir")
      , dt = ht && "ontouchstart"in window
      , ft = ht && window.PointerEvent
      , pt = ht && (dt || window.DocumentTouch && document instanceof DocumentTouch || navigator.maxTouchPoints)
      , gt = ft ? "pointerdown" : dt ? "touchstart" : "mousedown"
      , mt = ft ? "pointermove" : dt ? "touchmove" : "mousemove"
      , vt = ft ? "pointerup" : dt ? "touchend" : "mouseup"
      , wt = ft ? "pointerenter" : dt ? "" : "mouseenter"
      , bt = ft ? "pointerleave" : dt ? "" : "mouseleave"
      , xt = ft ? "pointercancel" : "touchcancel";
    function yt(t, e) {
        return W(t) || It(t, $t(t, e))
    }
    function kt(t, e) {
        var n = V(t);
        return n.length && n || St(t, $t(t, e))
    }
    function $t(t, e) {
        return void 0 === e && (e = document),
        Ct(t) || _(e) ? e : e.ownerDocument
    }
    function It(t, e) {
        return W(Tt(t, e, "querySelector"))
    }
    function St(t, e) {
        return V(Tt(t, e, "querySelectorAll"))
    }
    function Tt(t, s, e) {
        if (void 0 === s && (s = document),
        !t || !D(t))
            return null;
        var a;
        Ct(t = t.replace(_t, "$1 *")) && (a = [],
        t = t.match(At).map(function(t) {
            return t.replace(/,$/, "").trim()
        }).map(function(t, e) {
            var n, i, r, o = s;
            return "!" === t[0] && (n = t.substr(1).trim().split(" "),
            o = Bt(Pt(s), n[0]),
            t = n.slice(1).join(" ").trim()),
            "-" === t[0] && (i = t.substr(1).trim().split(" "),
            r = (o || s).previousElementSibling,
            o = zt(r, t.substr(1)) ? r : null,
            t = i.slice(1).join(" ")),
            o ? (o.id || (o.id = "uk-" + Date.now() + e,
            a.push(function() {
                return at(o, "id")
            })),
            "#" + Ht(o.id) + " " + t) : null
        }).filter(Boolean).join(","),
        s = document);
        try {
            return s[e](t)
        } catch (t) {
            return null
        } finally {
            a && a.forEach(function(t) {
                return t()
            })
        }
    }
    var Et = /(^|[^\\],)\s*[!>+~-]/
      , _t = /([!>+~-])(?=\s+[!>+~-]|\s*$)/g;
    function Ct(t) {
        return D(t) && t.match(Et)
    }
    var At = /.*?[^\\](?:,|$)/g;
    var Nt = ht ? Element.prototype : {}
      , Mt = Nt.matches || Nt.webkitMatchesSelector || Nt.msMatchesSelector || et;
    function zt(t, e) {
        return V(t).some(function(t) {
            return Mt.call(t, e)
        })
    }
    var Dt = Nt.closest || function(t) {
        var e = this;
        do {
            if (zt(e, t))
                return e
        } while (e = Pt(e))
    }
    ;
    function Bt(t, e) {
        return w(e, ">") && (e = e.slice(1)),
        N(t) ? Dt.call(t, e) : V(t).map(function(t) {
            return Bt(t, e)
        }).filter(Boolean)
    }
    function Pt(t) {
        return (t = W(t)) && N(t.parentNode) && t.parentNode
    }
    var Ot = ht && window.CSS && CSS.escape || function(t) {
        return t.replace(/([^\x7f-\uFFFF\w-])/g, function(t) {
            return "\\" + t
        })
    }
    ;
    function Ht(t) {
        return D(t) ? Ot.call(null, t) : ""
    }
    var Lt = {
        area: !0,
        base: !0,
        br: !0,
        col: !0,
        embed: !0,
        hr: !0,
        img: !0,
        input: !0,
        keygen: !0,
        link: !0,
        menuitem: !0,
        meta: !0,
        param: !0,
        source: !0,
        track: !0,
        wbr: !0
    };
    function jt(t) {
        return V(t).some(function(t) {
            return Lt[t.tagName.toLowerCase()]
        })
    }
    function Ft(t) {
        return V(t).some(function(t) {
            return t.offsetWidth || t.offsetHeight || t.getClientRects().length
        })
    }
    var Wt = "input,select,textarea,button";
    function Vt(t) {
        return V(t).some(function(t) {
            return zt(t, Wt)
        })
    }
    function Rt(t, e) {
        return V(t).filter(function(t) {
            return zt(t, e)
        })
    }
    function qt(t, e) {
        return D(e) ? zt(t, e) || !!Bt(t, e) : t === e || (_(e) ? e.documentElement : W(e)).contains(W(t))
    }
    function Ut(t, e) {
        for (var n = []; t = Pt(t); )
            e && !zt(t, e) || n.push(t);
        return n
    }
    function Yt(t, e) {
        var n = (t = W(t)) ? V(t.children) : [];
        return e ? Rt(n, e) : n
    }
    function Xt() {
        for (var t = [], e = arguments.length; e--; )
            t[e] = arguments[e];
        var n, i, r = Qt(t), o = r[0], s = r[1], a = r[2], u = r[3], h = r[4], o = ie(o);
        return 1 < u.length && (n = u,
        u = function(t) {
            return k(t.detail) ? n.apply(void 0, [t].concat(t.detail)) : n(t)
        }
        ),
        h && h.self && (i = u,
        u = function(t) {
            if (t.target === t.currentTarget || t.target === t.current)
                return i.call(null, t)
        }
        ),
        a && (u = function(t, i, r) {
            var o = this;
            return function(n) {
                t.forEach(function(t) {
                    var e = ">" === i[0] ? St(i, t).reverse().filter(function(t) {
                        return qt(n.target, t)
                    })[0] : Bt(n.target, i);
                    e && (n.delegate = t,
                    n.current = e,
                    r.call(o, n))
                })
            }
        }(o, a, u)),
        h = te(h),
        s.split(" ").forEach(function(e) {
            return o.forEach(function(t) {
                return t.addEventListener(e, u, h)
            })
        }),
        function() {
            return Gt(o, s, u, h)
        }
    }
    function Gt(t, e, n, i) {
        void 0 === i && (i = !1),
        i = te(i),
        t = ie(t),
        e.split(" ").forEach(function(e) {
            return t.forEach(function(t) {
                return t.removeEventListener(e, n, i)
            })
        })
    }
    function Jt() {
        for (var t = [], e = arguments.length; e--; )
            t[e] = arguments[e];
        var n = Qt(t)
          , i = n[0]
          , r = n[1]
          , o = n[2]
          , s = n[3]
          , a = n[4]
          , u = n[5]
          , h = Xt(i, r, o, function(t) {
            var e = !u || u(t);
            e && (h(),
            s(t, e))
        }, a);
        return h
    }
    function Kt(t, n, i) {
        return ie(t).reduce(function(t, e) {
            return t && e.dispatchEvent(Zt(n, !0, !0, i))
        }, !0)
    }
    function Zt(t, e, n, i) {
        var r;
        return void 0 === e && (e = !0),
        void 0 === n && (n = !1),
        D(t) && ((r = document.createEvent("CustomEvent")).initCustomEvent(t, e, n, i),
        t = r),
        t
    }
    function Qt(t) {
        return $(t[2]) && t.splice(2, 0, !1),
        t
    }
    function te(t) {
        return t && ct && !z(t) ? !!t.capture : t
    }
    function ee(t) {
        return t && "addEventListener"in t
    }
    function ne(t) {
        return ee(t) ? t : W(t)
    }
    function ie(t) {
        return k(t) ? t.map(ne).filter(Boolean) : D(t) ? St(t) : ee(t) ? [t] : V(t)
    }
    function re(t) {
        return "touch" === t.pointerType || !!t.touches
    }
    function oe(t) {
        var e = t.touches
          , n = t.changedTouches
          , i = e && e[0] || n && n[0] || t;
        return {
            x: i.clientX,
            y: i.clientY
        }
    }
    function se() {
        var n = this;
        this.promise = new ae(function(t, e) {
            n.reject = e,
            n.resolve = t
        }
        )
    }
    var ae = ht && window.Promise || ce
      , ue = 2
      , he = ht && window.setImmediate || setTimeout;
    function ce(t) {
        this.state = ue,
        this.value = void 0,
        this.deferred = [];
        var e = this;
        try {
            t(function(t) {
                e.resolve(t)
            }, function(t) {
                e.reject(t)
            })
        } catch (t) {
            e.reject(t)
        }
    }
    ce.reject = function(n) {
        return new ce(function(t, e) {
            e(n)
        }
        )
    }
    ,
    ce.resolve = function(n) {
        return new ce(function(t, e) {
            t(n)
        }
        )
    }
    ,
    ce.all = function(o) {
        return new ce(function(n, t) {
            var i = []
              , r = 0;
            0 === o.length && n(i);
            for (var e = 0; e < o.length; e += 1)
                ce.resolve(o[e]).then(function(e) {
                    return function(t) {
                        i[e] = t,
                        (r += 1) === o.length && n(i)
                    }
                }(e), t)
        }
        )
    }
    ,
    ce.race = function(i) {
        return new ce(function(t, e) {
            for (var n = 0; n < i.length; n += 1)
                ce.resolve(i[n]).then(t, e)
        }
        )
    }
    ;
    var le = ce.prototype;
    function de(s, a) {
        return new ae(function(t, e) {
            var n = G({
                data: null,
                method: "GET",
                headers: {},
                xhr: new XMLHttpRequest,
                beforeSend: et,
                responseType: ""
            }, a);
            n.beforeSend(n);
            var i = n.xhr;
            for (var r in n)
                if (r in i)
                    try {
                        i[r] = n[r]
                    } catch (t) {}
            for (var o in i.open(n.method.toUpperCase(), s),
            n.headers)
                i.setRequestHeader(o, n.headers[o]);
            Xt(i, "load", function() {
                0 === i.status || 200 <= i.status && i.status < 300 || 304 === i.status ? ("json" === n.responseType && D(i.response) && (i = G(function(t) {
                    var e = {};
                    for (var n in t)
                        e[n] = t[n];
                    return e
                }(i), {
                    response: JSON.parse(i.response)
                })),
                t(i)) : e(G(Error(i.statusText), {
                    xhr: i,
                    status: i.status
                }))
            }),
            Xt(i, "error", function() {
                return e(G(Error("Network Error"), {
                    xhr: i
                }))
            }),
            Xt(i, "timeout", function() {
                return e(G(Error("Network Timeout"), {
                    xhr: i
                }))
            }),
            i.send(n.data)
        }
        )
    }
    function fe(i, r, o) {
        return new ae(function(t, e) {
            var n = new Image;
            n.onerror = function(t) {
                return e(t)
            }
            ,
            n.onload = function() {
                return t(n)
            }
            ,
            o && (n.sizes = o),
            r && (n.srcset = r),
            n.src = i
        }
        )
    }
    function pe(t) {
        var e;
        "loading" === document.readyState ? e = Xt(document, "DOMContentLoaded", function() {
            e(),
            t()
        }) : t()
    }
    function ge(t, e) {
        return e ? V(t).indexOf(W(e)) : Yt(Pt(t)).indexOf(t)
    }
    function me(t, e, n, i) {
        void 0 === n && (n = 0),
        void 0 === i && (i = !1);
        var r = (e = V(e)).length;
        return t = P(t) ? j(t) : "next" === t ? n + 1 : "previous" === t ? n - 1 : ge(e, t),
        i ? tt(t, 0, r - 1) : (t %= r) < 0 ? t + r : t
    }
    function ve(t) {
        return (t = Ne(t)).innerHTML = "",
        t
    }
    function we(t, e) {
        return t = Ne(t),
        H(e) ? t.innerHTML : be(t.hasChildNodes() ? ve(t) : t, e)
    }
    function be(e, t) {
        return e = Ne(e),
        ke(t, function(t) {
            return e.appendChild(t)
        })
    }
    function xe(e, t) {
        return e = Ne(e),
        ke(t, function(t) {
            return e.parentNode.insertBefore(t, e)
        })
    }
    function ye(e, t) {
        return e = Ne(e),
        ke(t, function(t) {
            return e.nextSibling ? xe(e.nextSibling, t) : be(e.parentNode, t)
        })
    }
    function ke(t, e) {
        return (t = D(t) ? Ce(t) : t) ? "length"in t ? V(t).map(e) : e(t) : null
    }
    function $e(t) {
        V(t).map(function(t) {
            return t.parentNode && t.parentNode.removeChild(t)
        })
    }
    function Ie(t, e) {
        for (e = W(xe(t, e)); e.firstChild; )
            e = e.firstChild;
        return be(e, t),
        e
    }
    function Se(t, e) {
        return V(V(t).map(function(t) {
            return t.hasChildNodes ? Ie(V(t.childNodes), e) : be(t, e)
        }))
    }
    function Te(t) {
        V(t).map(Pt).filter(function(t, e, n) {
            return n.indexOf(t) === e
        }).forEach(function(t) {
            xe(t, t.childNodes),
            $e(t)
        })
    }
    le.resolve = function(t) {
        var e = this;
        if (e.state === ue) {
            if (t === e)
                throw new TypeError("Promise settled with itself.");
            var n = !1;
            try {
                var i = t && t.then;
                if (null !== t && I(t) && $(i))
                    return void i.call(t, function(t) {
                        n || e.resolve(t),
                        n = !0
                    }, function(t) {
                        n || e.reject(t),
                        n = !0
                    })
            } catch (t) {
                return void (n || e.reject(t))
            }
            e.state = 0,
            e.value = t,
            e.notify()
        }
    }
    ,
    le.reject = function(t) {
        var e = this;
        if (e.state === ue) {
            if (t === e)
                throw new TypeError("Promise settled with itself.");
            e.state = 1,
            e.value = t,
            e.notify()
        }
    }
    ,
    le.notify = function() {
        var o = this;
        he(function() {
            if (o.state !== ue)
                for (; o.deferred.length; ) {
                    var t = o.deferred.shift()
                      , e = t[0]
                      , n = t[1]
                      , i = t[2]
                      , r = t[3];
                    try {
                        0 === o.state ? $(e) ? i(e.call(void 0, o.value)) : i(o.value) : 1 === o.state && ($(n) ? i(n.call(void 0, o.value)) : r(o.value))
                    } catch (t) {
                        r(t)
                    }
                }
        })
    }
    ,
    le.then = function(n, i) {
        var r = this;
        return new ce(function(t, e) {
            r.deferred.push([n, i, t, e]),
            r.notify()
        }
        )
    }
    ,
    le.catch = function(t) {
        return this.then(void 0, t)
    }
    ;
    var Ee = /^\s*<(\w+|!)[^>]*>/
      , _e = /^<(\w+)\s*\/?>(?:<\/\1>)?$/;
    function Ce(t) {
        var e = _e.exec(t);
        if (e)
            return document.createElement(e[1]);
        var n = document.createElement("div");
        return Ee.test(t) ? n.insertAdjacentHTML("beforeend", t.trim()) : n.textContent = t,
        1 < n.childNodes.length ? V(n.childNodes) : n.firstChild
    }
    function Ae(t, e) {
        if (N(t))
            for (e(t),
            t = t.firstElementChild; t; ) {
                var n = t.nextElementSibling;
                Ae(t, e),
                t = n
            }
    }
    function Ne(t, e) {
        return D(t) ? ze(t) ? W(Ce(t)) : It(t, e) : W(t)
    }
    function Me(t, e) {
        return D(t) ? ze(t) ? V(Ce(t)) : St(t, e) : V(t)
    }
    function ze(t) {
        return "<" === t[0] || t.match(/^\s*</)
    }
    function De(t) {
        for (var e = [], n = arguments.length - 1; 0 < n--; )
            e[n] = arguments[n + 1];
        je(t, e, "add")
    }
    function Be(t) {
        for (var e = [], n = arguments.length - 1; 0 < n--; )
            e[n] = arguments[n + 1];
        je(t, e, "remove")
    }
    function Pe(t, e) {
        ot(t, "class", function(t) {
            return (t || "").replace(new RegExp("\\b" + e + "\\b","g"), "")
        })
    }
    function Oe(t) {
        for (var e = [], n = arguments.length - 1; 0 < n--; )
            e[n] = arguments[n + 1];
        e[0] && Be(t, e[0]),
        e[1] && De(t, e[1])
    }
    function He(t, e) {
        return e && V(t).some(function(t) {
            return t.classList.contains(e.split(" ")[0])
        })
    }
    function Le(t) {
        for (var i, r = [], e = arguments.length - 1; 0 < e--; )
            r[e] = arguments[e + 1];
        r.length && (i = D(J(r = Fe(r))) ? [] : r.pop(),
        r = r.filter(Boolean),
        V(t).forEach(function(t) {
            for (var e = t.classList, n = 0; n < r.length; n++)
                We.Force ? e.toggle.apply(e, [r[n]].concat(i)) : e[(H(i) ? !e.contains(r[n]) : i) ? "add" : "remove"](r[n])
        }))
    }
    function je(t, n, i) {
        (n = Fe(n).filter(Boolean)).length && V(t).forEach(function(t) {
            var e = t.classList;
            We.Multiple ? e[i].apply(e, n) : n.forEach(function(t) {
                return e[i](t)
            })
        })
    }
    function Fe(t) {
        return t.reduce(function(t, e) {
            return t.concat.call(t, D(e) && b(e, " ") ? e.trim().split(" ") : e)
        }, [])
    }
    var We = {
        get Multiple() {
            return this.get("_multiple")
        },
        get Force() {
            return this.get("_force")
        },
        get: function(t) {
            var e;
            return l(this, t) || ((e = document.createElement("_").classList).add("a", "b"),
            e.toggle("c", !1),
            this._multiple = e.contains("b"),
            this._force = !e.contains("c")),
            this[t]
        }
    }
      , Ve = {
        "animation-iteration-count": !0,
        "column-count": !0,
        "fill-opacity": !0,
        "flex-grow": !0,
        "flex-shrink": !0,
        "font-weight": !0,
        "line-height": !0,
        opacity: !0,
        order: !0,
        orphans: !0,
        "stroke-dasharray": !0,
        "stroke-dashoffset": !0,
        widows: !0,
        "z-index": !0,
        zoom: !0
    };
    function Re(t, e, r) {
        return V(t).map(function(n) {
            if (D(e)) {
                if (e = Je(e),
                H(r))
                    return Ue(n, e);
                r || B(r) ? n.style[e] = P(r) && !Ve[e] ? r + "px" : r : n.style.removeProperty(e)
            } else {
                if (k(e)) {
                    var i = qe(n);
                    return e.reduce(function(t, e) {
                        return t[e] = i[Je(e)],
                        t
                    }, {})
                }
                I(e) && K(e, function(t, e) {
                    return Re(n, e, t)
                })
            }
            return n
        })[0]
    }
    function qe(t, e) {
        return (t = W(t)).ownerDocument.defaultView.getComputedStyle(t, e)
    }
    function Ue(t, e, n) {
        return qe(t, n)[e]
    }
    var Ye = {};
    function Xe(t) {
        var e, n = document.documentElement;
        return ct ? (t in Ye || (De(e = be(n, document.createElement("div")), "uk-" + t),
        Ye[t] = Ue(e, "content", ":before").replace(/^["'](.*)["']$/, "$1"),
        $e(e)),
        Ye[t]) : qe(n).getPropertyValue("--uk-" + t)
    }
    var Ge = {};
    function Je(t) {
        return Ge[t] || (Ge[t] = function(t) {
            t = d(t);
            var e = document.documentElement.style;
            if (t in e)
                return t;
            var n, i = Ke.length;
            for (; i--; )
                if ((n = "-" + Ke[i] + "-" + t)in e)
                    return n
        }(t) || t)
    }
    var Ke = ["webkit", "moz", "ms"];
    function Ze(t, s, a, u) {
        return void 0 === a && (a = 400),
        void 0 === u && (u = "linear"),
        ae.all(V(t).map(function(o) {
            return new ae(function(n, i) {
                for (var t in s) {
                    var e = Re(o, t);
                    "" === e && Re(o, t, e)
                }
                var r = setTimeout(function() {
                    return Kt(o, "transitionend")
                }, a);
                Jt(o, "transitionend transitioncanceled", function(t) {
                    var e = t.type;
                    clearTimeout(r),
                    Be(o, "uk-transition"),
                    Re(o, {
                        transitionProperty: "",
                        transitionDuration: "",
                        transitionTimingFunction: ""
                    }),
                    ("transitioncanceled" === e ? i : n)()
                }, {
                    self: !0
                }),
                De(o, "uk-transition"),
                Re(o, G({
                    transitionProperty: Object.keys(s).map(Je).join(","),
                    transitionDuration: a + "ms",
                    transitionTimingFunction: u
                }, s))
            }
            )
        }))
    }
    var Qe = {
        start: Ze,
        stop: function(t) {
            return Kt(t, "transitionend"),
            ae.resolve()
        },
        cancel: function(t) {
            Kt(t, "transitioncanceled")
        },
        inProgress: function(t) {
            return He(t, "uk-transition")
        }
    }
      , tn = "uk-animation-";
    function en(t, e, s, a, u) {
        return void 0 === s && (s = 200),
        ae.all(V(t).map(function(o) {
            return new ae(function(n, i) {
                Kt(o, "animationcanceled");
                var r = setTimeout(function() {
                    return Kt(o, "animationend")
                }, s);
                Jt(o, "animationend animationcanceled", function(t) {
                    var e = t.type;
                    clearTimeout(r),
                    ("animationcanceled" === e ? i : n)(),
                    Re(o, "animationDuration", ""),
                    Pe(o, tn + "\\S*")
                }, {
                    self: !0
                }),
                Re(o, "animationDuration", s + "ms"),
                De(o, e, tn + (u ? "leave" : "enter")),
                w(e, tn) && De(o, a && "uk-transform-origin-" + a, u && tn + "reverse")
            }
            )
        }))
    }
    var nn = new RegExp(tn + "(enter|leave)")
      , rn = {
        in: en,
        out: function(t, e, n, i) {
            return en(t, e, n, i, !0)
        },
        inProgress: function(t) {
            return nn.test(ot(t, "class"))
        },
        cancel: function(t) {
            Kt(t, "animationcanceled")
        }
    }
      , on = {
        width: ["x", "left", "right"],
        height: ["y", "top", "bottom"]
    };
    function sn(t, e, c, l, d, n, i, r) {
        c = mn(c),
        l = mn(l);
        var f = {
            element: c,
            target: l
        };
        if (!t || !e)
            return f;
        var o, p = un(t), g = un(e), m = g;
        return gn(m, c, p, -1),
        gn(m, l, g, 1),
        d = vn(d, p.width, p.height),
        n = vn(n, g.width, g.height),
        d.x += n.x,
        d.y += n.y,
        m.left += d.x,
        m.top += d.y,
        i && (o = [un(R(t))],
        r && o.unshift(un(r)),
        K(on, function(t, s) {
            var a = t[0]
              , u = t[1]
              , h = t[2];
            !0 !== i && !b(i, a) || o.some(function(i) {
                var t = c[a] === u ? -p[s] : c[a] === h ? p[s] : 0
                  , e = l[a] === u ? g[s] : l[a] === h ? -g[s] : 0;
                if (m[u] < i[u] || m[u] + p[s] > i[h]) {
                    var n = p[s] / 2
                      , r = "center" === l[a] ? -g[s] / 2 : 0;
                    return "center" === c[a] && (o(n, r) || o(-n, -r)) || o(t, e)
                }
                function o(e, t) {
                    var n = F((m[u] + e + t - 2 * d[a]).toFixed(4));
                    if (n >= i[u] && n + p[s] <= i[h])
                        return m[u] = n,
                        ["element", "target"].forEach(function(t) {
                            f[t][a] = e ? f[t][a] === on[s][1] ? on[s][2] : on[s][1] : f[t][a]
                        }),
                        !0
                }
            })
        })),
        an(t, m),
        f
    }
    function an(n, i) {
        if (!i)
            return un(n);
        var r = un(n)
          , o = Re(n, "position");
        ["left", "top"].forEach(function(t) {
            var e;
            t in i && (e = Re(n, t),
            Re(n, t, i[t] - r[t] + F("absolute" === o && "auto" === e ? hn(n)[t] : e)))
        })
    }
    function un(t) {
        if (!t)
            return {};
        var e, n, i = R(t), r = i.pageYOffset, o = i.pageXOffset;
        if (E(t)) {
            var s = t.innerHeight
              , a = t.innerWidth;
            return {
                top: r,
                left: o,
                height: s,
                width: a,
                bottom: r + s,
                right: o + a
            }
        }
        Ft(t) || "none" !== Re(t, "display") || (e = ot(t, "style"),
        n = ot(t, "hidden"),
        ot(t, {
            style: (e || "") + ";display:block !important;",
            hidden: null
        }));
        var u = (t = W(t)).getBoundingClientRect();
        return H(e) || ot(t, {
            style: e,
            hidden: n
        }),
        {
            height: u.height,
            width: u.width,
            top: u.top + r,
            left: u.left + o,
            bottom: u.bottom + r,
            right: u.right + o
        }
    }
    function hn(t, e) {
        e = e || (W(t) || {}).offsetParent || R(t).document.documentElement;
        var n = an(t)
          , i = an(e);
        return {
            top: n.top - i.top - F(Re(e, "borderTopWidth")),
            left: n.left - i.left - F(Re(e, "borderLeftWidth"))
        }
    }
    function cn(t) {
        var e = [0, 0];
        t = W(t);
        do {
            if (e[0] += t.offsetTop,
            e[1] += t.offsetLeft,
            "fixed" === Re(t, "position")) {
                var n = R(t);
                return e[0] += n.pageYOffset,
                e[1] += n.pageXOffset,
                e
            }
        } while (t = t.offsetParent);
        return e
    }
    var ln = fn("height")
      , dn = fn("width");
    function fn(i) {
        var r = p(i);
        return function(t, e) {
            if (H(e)) {
                if (E(t))
                    return t["inner" + r];
                if (_(t)) {
                    var n = t.documentElement;
                    return Math.max(n["offset" + r], n["scroll" + r])
                }
                return (e = "auto" === (e = Re(t = W(t), i)) ? t["offset" + r] : F(e) || 0) - pn(t, i)
            }
            Re(t, i, e || 0 === e ? +e + pn(t, i) + "px" : "")
        }
    }
    function pn(n, t, e) {
        return void 0 === e && (e = "border-box"),
        Re(n, "boxSizing") === e ? on[t].slice(1).map(p).reduce(function(t, e) {
            return t + F(Re(n, "padding" + e)) + F(Re(n, "border" + e + "Width"))
        }, 0) : 0
    }
    function gn(o, s, a, u) {
        K(on, function(t, e) {
            var n = t[0]
              , i = t[1]
              , r = t[2];
            s[n] === r ? o[i] += a[e] * u : "center" === s[n] && (o[i] += a[e] * u / 2)
        })
    }
    function mn(t) {
        var e = /left|center|right/
          , n = /top|center|bottom/;
        return 1 === (t = (t || "").split(" ")).length && (t = e.test(t[0]) ? t.concat("center") : n.test(t[0]) ? ["center"].concat(t) : ["center", "center"]),
        {
            x: e.test(t[0]) ? t[0] : "center",
            y: n.test(t[1]) ? t[1] : "center"
        }
    }
    function vn(t, e, n) {
        var i = (t || "").split(" ")
          , r = i[0]
          , o = i[1];
        return {
            x: r ? F(r) * (h(r, "%") ? e / 100 : 1) : 0,
            y: o ? F(o) * (h(o, "%") ? n / 100 : 1) : 0
        }
    }
    function wn(t) {
        switch (t) {
        case "left":
            return "right";
        case "right":
            return "left";
        case "top":
            return "bottom";
        case "bottom":
            return "top";
        default:
            return t
        }
    }
    function bn(t, e, n) {
        return void 0 === e && (e = "width"),
        void 0 === n && (n = window),
        P(t) ? +t : h(t, "vh") ? xn(ln(R(n)), t) : h(t, "vw") ? xn(dn(R(n)), t) : h(t, "%") ? xn(un(n)[e], t) : F(t)
    }
    function xn(t, e) {
        return t * F(e) / 100
    }
    var yn = {
        reads: [],
        writes: [],
        read: function(t) {
            return this.reads.push(t),
            In(),
            t
        },
        write: function(t) {
            return this.writes.push(t),
            In(),
            t
        },
        clear: function(t) {
            return Tn(this.reads, t) || Tn(this.writes, t)
        },
        flush: kn
    };
    function kn(t) {
        void 0 === t && (t = 1),
        Sn(yn.reads),
        Sn(yn.writes.splice(0, yn.writes.length)),
        yn.scheduled = !1,
        (yn.reads.length || yn.writes.length) && In(t + 1)
    }
    var $n = 4;
    function In(t) {
        yn.scheduled || (yn.scheduled = !0,
        t && t < $n ? ae.resolve().then(function() {
            return kn(t)
        }) : requestAnimationFrame(function() {
            return kn()
        }))
    }
    function Sn(t) {
        for (var e; e = t.shift(); )
            e()
    }
    function Tn(t, e) {
        var n = t.indexOf(e);
        return !!~n && !!t.splice(n, 1)
    }
    function En() {}
    En.prototype = {
        positions: [],
        init: function() {
            var e, t = this;
            this.positions = [],
            this.unbind = Xt(document, "mousemove", function(t) {
                return e = oe(t)
            }),
            this.interval = setInterval(function() {
                e && (t.positions.push(e),
                5 < t.positions.length && t.positions.shift())
            }, 50)
        },
        cancel: function() {
            this.unbind && this.unbind(),
            this.interval && clearInterval(this.interval)
        },
        movesTo: function(t) {
            if (this.positions.length < 2)
                return !1;
            var n = t.getBoundingClientRect()
              , e = n.left
              , i = n.right
              , r = n.top
              , o = n.bottom
              , s = this.positions[0]
              , a = J(this.positions)
              , u = [s, a];
            return !it(a, n) && [[{
                x: e,
                y: r
            }, {
                x: i,
                y: o
            }], [{
                x: e,
                y: o
            }, {
                x: i,
                y: r
            }]].some(function(t) {
                var e = function(t, e) {
                    var n = t[0]
                      , i = n.x
                      , r = n.y
                      , o = t[1]
                      , s = o.x
                      , a = o.y
                      , u = e[0]
                      , h = u.x
                      , c = u.y
                      , l = e[1]
                      , d = l.x
                      , f = l.y
                      , p = (f - c) * (s - i) - (d - h) * (a - r);
                    if (0 == p)
                        return !1;
                    var g = ((d - h) * (r - c) - (f - c) * (i - h)) / p;
                    if (g < 0)
                        return !1;
                    return {
                        x: i + g * (s - i),
                        y: r + g * (a - r)
                    }
                }(u, t);
                return e && it(e, n)
            })
        }
    };
    var _n = {};
    function Cn(t, e, n) {
        return _n.computed($(t) ? t.call(n, n) : t, $(e) ? e.call(n, n) : e)
    }
    function An(t, e) {
        return t = t && !k(t) ? [t] : t,
        e ? t ? t.concat(e) : k(e) ? e : [e] : t
    }
    function Nn(e, n, i) {
        var r = {};
        if ($(n) && (n = n.options),
        n.extends && (e = Nn(e, n.extends, i)),
        n.mixins)
            for (var t = 0, o = n.mixins.length; t < o; t++)
                e = Nn(e, n.mixins[t], i);
        for (var s in e)
            u(s);
        for (var a in n)
            l(e, a) || u(a);
        function u(t) {
            r[t] = (_n[t] || function(t, e) {
                return H(e) ? t : e
            }
            )(e[t], n[t], i)
        }
        return r
    }
    function Mn(t, e) {
        var n;
        void 0 === e && (e = []);
        try {
            return t ? w(t, "{") ? JSON.parse(t) : e.length && !b(t, ":") ? ((n = {})[e[0]] = t,
            n) : t.split(";").reduce(function(t, e) {
                var n = e.split(/:(.*)/)
                  , i = n[0]
                  , r = n[1];
                return i && !H(r) && (t[i.trim()] = r.trim()),
                t
            }, {}) : {}
        } catch (t) {
            return {}
        }
    }
    function zn(t) {
        if (On(t) && jn(t, {
            func: "playVideo",
            method: "play"
        }),
        Pn(t))
            try {
                t.play().catch(et)
            } catch (t) {}
    }
    function Dn(t) {
        On(t) && jn(t, {
            func: "pauseVideo",
            method: "pause"
        }),
        Pn(t) && t.pause()
    }
    function Bn(t) {
        On(t) && jn(t, {
            func: "mute",
            method: "setVolume",
            value: 0
        }),
        Pn(t) && (t.muted = !0,
        ot(t, "muted", ""))
    }
    function Pn(t) {
        return t && "VIDEO" === t.tagName
    }
    function On(t) {
        return t && "IFRAME" === t.tagName && (Hn(t) || Ln(t))
    }
    function Hn(t) {
        return !!t.src.match(/\/\/.*?youtube(-nocookie)?\.[a-z]+\/(watch\?v=[^&\s]+|embed)|youtu\.be\/.*/)
    }
    function Ln(t) {
        return !!t.src.match(/vimeo\.com\/video\/.*/)
    }
    function jn(t, e) {
        (function(e) {
            if (e[Wn])
                return e[Wn];
            var n, i = Hn(e), r = Ln(e), o = ++Vn;
            return e[Wn] = new ae(function(t) {
                i && Jt(e, "load", function() {
                    function t() {
                        return Fn(e, {
                            event: "listening",
                            id: o
                        })
                    }
                    n = setInterval(t, 100),
                    t()
                }),
                Jt(window, "message", t, !1, function(t) {
                    var e = t.data;
                    try {
                        return (e = JSON.parse(e)) && (i && e.id === o && "onReady" === e.event || r && Number(e.player_id) === o)
                    } catch (t) {}
                }),
                ot(e, "src", e.src + (b(e.src, "?") ? "&" : "?") + (i ? "enablejsapi=1" : "api=1&player_id=" + o))
            }
            ).then(function() {
                return clearInterval(n)
            })
        }
        )(t).then(function() {
            return Fn(t, e)
        })
    }
    function Fn(t, e) {
        try {
            t.contentWindow.postMessage(JSON.stringify(G({
                event: "command"
            }, e)), "*")
        } catch (t) {}
    }
    _n.events = _n.created = _n.beforeConnect = _n.connected = _n.beforeDisconnect = _n.disconnected = _n.destroy = An,
    _n.args = function(t, e) {
        return !1 !== e && An(e || t)
    }
    ,
    _n.update = function(t, e) {
        return Z(An(t, $(e) ? {
            read: e
        } : e), "order")
    }
    ,
    _n.props = function(t, e) {
        return k(e) && (e = e.reduce(function(t, e) {
            return t[e] = String,
            t
        }, {})),
        _n.methods(t, e)
    }
    ,
    _n.computed = _n.methods = function(t, e) {
        return e ? t ? G({}, t, e) : e : t
    }
    ,
    _n.data = function(e, n, t) {
        return t ? Cn(e, n, t) : n ? e ? function(t) {
            return Cn(e, n, t)
        }
        : n : e
    }
    ;
    var Wn = "_ukPlayer"
      , Vn = 0;
    function Rn(u, h, c) {
        if (void 0 === h && (h = 0),
        void 0 === c && (c = 0),
        !Ft(u))
            return !1;
        var l = Jn(u);
        return l.every(function(t, e) {
            var n = an(l[e + 1] || u)
              , i = an(Gn(t))
              , r = i.top
              , o = i.left
              , s = i.bottom
              , a = i.right;
            return nt(n, {
                top: r - h,
                left: o - c,
                bottom: s + h,
                right: a + c
            })
        })
    }
    function qn(t, e) {
        (t = (E(t) || _(t) ? Kn : W)(t)).scrollTop = e
    }
    function Un(t, e) {
        void 0 === e && (e = {});
        var c = e.offset;
        if (void 0 === c && (c = 0),
        Ft(t)) {
            for (var l = Jn(t).concat(t), n = ae.resolve(), i = function(h) {
                n = n.then(function() {
                    return new ae(function(n) {
                        var t, i = l[h], e = l[h + 1], r = i.scrollTop, o = Math.ceil(hn(e, Gn(i)).top - c), s = (t = Math.abs(o),
                        40 * Math.pow(t, .375)), a = Date.now(), u = function() {
                            var t, e = (t = tt((Date.now() - a) / s),
                            .5 * (1 - Math.cos(Math.PI * t)));
                            qn(i, r + o * e),
                            1 != e ? requestAnimationFrame(u) : n()
                        };
                        u()
                    }
                    )
                })
            }, r = 0; r < l.length - 1; r++)
                i(r);
            return n
        }
    }
    function Yn(t, e) {
        if (void 0 === e && (e = 0),
        !Ft(t))
            return 0;
        var n = J(Xn(t))
          , i = n.scrollHeight
          , r = n.scrollTop
          , o = an(Gn(n)).height
          , s = cn(t)[0] - r - cn(n)[0]
          , a = Math.min(o, s + r);
        return tt(-1 * (s - a) / Math.min(an(t).height + e + a, i - (s + r), i - o))
    }
    function Xn(t, e) {
        void 0 === e && (e = /auto|scroll/);
        var n = Kn(t)
          , i = Ut(t).filter(function(t) {
            return t === n || e.test(Re(t, "overflow")) && t.scrollHeight > Math.round(an(t).height)
        }).reverse();
        return i.length ? i : [n]
    }
    function Gn(t) {
        return t === Kn(t) ? window : t
    }
    function Jn(t) {
        return Xn(t, /auto|scroll|hidden/)
    }
    function Kn(t) {
        var e = R(t).document;
        return e.scrollingElement || e.documentElement
    }
    var Zn = ht && window.IntersectionObserver || function() {
        function t(e, t) {
            var n = this;
            void 0 === t && (t = {});
            var i = t.rootMargin;
            void 0 === i && (i = "0 0"),
            this.targets = [];
            var r, o = (i || "0 0").split(" ").map(F), s = o[0], a = o[1];
            this.offsetTop = s,
            this.offsetLeft = a,
            this.apply = function() {
                r = r || requestAnimationFrame(function() {
                    return setTimeout(function() {
                        var t = n.takeRecords();
                        t.length && e(t, n),
                        r = !1
                    })
                })
            }
            ,
            this.off = Xt(window, "scroll resize load", this.apply, {
                passive: !0,
                capture: !0
            })
        }
        return t.prototype.takeRecords = function() {
            var n = this;
            return this.targets.filter(function(t) {
                var e = Rn(t.target, n.offsetTop, n.offsetLeft);
                if (null === t.isIntersecting || e ^ t.isIntersecting)
                    return t.isIntersecting = e,
                    !0
            })
        }
        ,
        t.prototype.observe = function(t) {
            this.targets.push({
                target: t,
                isIntersecting: null
            }),
            this.apply()
        }
        ,
        t.prototype.disconnect = function() {
            this.targets = [],
            this.off()
        }
        ,
        t
    }();
    function Qn(t) {
        return !(!w(t, "uk-") && !w(t, "data-uk-")) && f(t.replace("data-uk-", "").replace("uk-", ""))
    }
    function ti(t) {
        this._init(t)
    }
    var ei, ni, ii, ri, oi, si, ai, ui, hi;
    function ci(t, e) {
        if (t)
            for (var n in t)
                t[n]._connected && t[n]._callUpdate(e)
    }
    function li(t, e) {
        var n = {}
          , i = t.args;
        void 0 === i && (i = []);
        var r = t.props;
        void 0 === r && (r = {});
        var o = t.el;
        if (!r)
            return n;
        for (var s in r) {
            var a = d(s)
              , u = ut(o, a);
            H(u) || (u = r[s] === Boolean && "" === u || fi(r[s], u),
            ("target" !== a || u && !w(u, "_")) && (n[s] = u))
        }
        var h = Mn(ut(o, e), i);
        for (var c in h) {
            var l = f(c);
            void 0 !== r[l] && (n[l] = fi(r[l], h[c]))
        }
        return n
    }
    function di(e, n, i) {
        T(n) || (n = {
            name: i,
            handler: n
        });
        var t = n.name
          , r = n.el
          , o = n.handler
          , s = n.capture
          , a = n.passive
          , u = n.delegate
          , h = n.filter
          , c = n.self
          , r = $(r) ? r.call(e) : r || e.$el;
        k(r) ? r.forEach(function(t) {
            return di(e, G({}, n, {
                el: t
            }), i)
        }) : !r || h && !h.call(e) || e._events.push(Xt(r, t, u ? D(u) ? u : u.call(e) : null, D(o) ? e[o] : o.bind(e), {
            passive: a,
            capture: s,
            self: c
        }))
    }
    function fi(t, e) {
        return t === Boolean ? L(e) : t === Number ? j(e) : "list" === t ? q(e) : t ? t(e) : e
    }
    ti.util = Object.freeze({
        __proto__: null,
        ajax: de,
        getImage: fe,
        transition: Ze,
        Transition: Qe,
        animate: en,
        Animation: rn,
        attr: ot,
        hasAttr: st,
        removeAttr: at,
        data: ut,
        addClass: De,
        removeClass: Be,
        removeClasses: Pe,
        replaceClass: Oe,
        hasClass: He,
        toggleClass: Le,
        positionAt: sn,
        offset: an,
        position: hn,
        offsetPosition: cn,
        height: ln,
        width: dn,
        boxModelAdjust: pn,
        flipPosition: wn,
        toPx: bn,
        ready: pe,
        index: ge,
        getIndex: me,
        empty: ve,
        html: we,
        prepend: function(e, t) {
            return (e = Ne(e)).hasChildNodes() ? ke(t, function(t) {
                return e.insertBefore(t, e.firstChild)
            }) : be(e, t)
        },
        append: be,
        before: xe,
        after: ye,
        remove: $e,
        wrapAll: Ie,
        wrapInner: Se,
        unwrap: Te,
        fragment: Ce,
        apply: Ae,
        $: Ne,
        $$: Me,
        inBrowser: ht,
        isIE: ct,
        isRtl: lt,
        hasTouch: pt,
        pointerDown: gt,
        pointerMove: mt,
        pointerUp: vt,
        pointerEnter: wt,
        pointerLeave: bt,
        pointerCancel: xt,
        on: Xt,
        off: Gt,
        once: Jt,
        trigger: Kt,
        createEvent: Zt,
        toEventTargets: ie,
        isTouch: re,
        getEventPos: oe,
        fastdom: yn,
        isVoidElement: jt,
        isVisible: Ft,
        selInput: Wt,
        isInput: Vt,
        filter: Rt,
        within: qt,
        parents: Ut,
        children: Yt,
        hasOwn: l,
        hyphenate: d,
        camelize: f,
        ucfirst: p,
        startsWith: w,
        endsWith: h,
        includes: b,
        findIndex: y,
        isArray: k,
        isFunction: $,
        isObject: I,
        isPlainObject: T,
        isWindow: E,
        isDocument: _,
        isJQuery: C,
        isNode: A,
        isElement: N,
        isNodeCollection: M,
        isBoolean: z,
        isString: D,
        isNumber: B,
        isNumeric: P,
        isEmpty: O,
        isUndefined: H,
        toBoolean: L,
        toNumber: j,
        toFloat: F,
        toNode: W,
        toNodes: V,
        toWindow: R,
        toList: q,
        toMs: U,
        isEqual: Y,
        swap: X,
        assign: G,
        last: J,
        each: K,
        sortBy: Z,
        uniqueBy: Q,
        clamp: tt,
        noop: et,
        intersectRect: nt,
        pointInRect: it,
        Dimensions: rt,
        MouseTracker: En,
        mergeOptions: Nn,
        parseOptions: Mn,
        play: zn,
        pause: Dn,
        mute: Bn,
        Promise: ae,
        Deferred: se,
        IntersectionObserver: Zn,
        query: yt,
        queryAll: kt,
        find: It,
        findAll: St,
        matches: zt,
        closest: Bt,
        parent: Pt,
        escape: Ht,
        css: Re,
        getStyles: qe,
        getStyle: Ue,
        getCssVar: Xe,
        propName: Je,
        isInView: Rn,
        scrollTop: qn,
        scrollIntoView: Un,
        scrolledOver: Yn,
        scrollParents: Xn,
        getViewport: Gn
    }),
    ti.data = "__uikit__",
    ti.prefix = "uk-",
    ti.options = {},
    ti.version = "3.5.7",
    ii = (ei = ti).data,
    ei.use = function(t) {
        if (!t.installed)
            return t.call(null, this),
            t.installed = !0,
            this
    }
    ,
    ei.mixin = function(t, e) {
        (e = (D(e) ? ei.component(e) : e) || this).options = Nn(e.options, t)
    }
    ,
    ei.extend = function(t) {
        t = t || {};
        function e(t) {
            this._init(t)
        }
        return ((e.prototype = Object.create(this.prototype)).constructor = e).options = Nn(this.options, t),
        e.super = this,
        e.extend = this.extend,
        e
    }
    ,
    ei.update = function(t, e) {
        Ut(t = t ? W(t) : document.body).reverse().forEach(function(t) {
            return ci(t[ii], e)
        }),
        Ae(t, function(t) {
            return ci(t[ii], e)
        })
    }
    ,
    Object.defineProperty(ei, "container", {
        get: function() {
            return ni || document.body
        },
        set: function(t) {
            ni = Ne(t)
        }
    }),
    (ri = ti).prototype._callHook = function(t) {
        var e = this
          , n = this.$options[t];
        n && n.forEach(function(t) {
            return t.call(e)
        })
    }
    ,
    ri.prototype._callConnected = function() {
        this._connected || (this._data = {},
        this._computeds = {},
        this._frames = {
            reads: {},
            writes: {}
        },
        this._initProps(),
        this._callHook("beforeConnect"),
        this._connected = !0,
        this._initEvents(),
        this._initObserver(),
        this._callHook("connected"),
        this._callUpdate())
    }
    ,
    ri.prototype._callDisconnected = function() {
        this._connected && (this._callHook("beforeDisconnect"),
        this._observer && (this._observer.disconnect(),
        this._observer = null),
        this._unbindEvents(),
        this._callHook("disconnected"),
        this._connected = !1)
    }
    ,
    ri.prototype._callUpdate = function(t) {
        var o = this;
        void 0 === t && (t = "update");
        var s = t.type || t;
        b(["update", "resize"], s) && this._callWatches();
        var e = this.$options.update
          , n = this._frames
          , a = n.reads
          , u = n.writes;
        e && e.forEach(function(t, e) {
            var n = t.read
              , i = t.write
              , r = t.events;
            "update" !== s && !b(r, s) || (n && !b(yn.reads, a[e]) && (a[e] = yn.read(function() {
                var t = o._connected && n.call(o, o._data, s);
                !1 === t && i ? yn.clear(u[e]) : T(t) && G(o._data, t)
            })),
            i && !b(yn.writes, u[e]) && (u[e] = yn.write(function() {
                return o._connected && i.call(o, o._data, s)
            })))
        })
    }
    ,
    ri.prototype._callWatches = function() {
        var u, h = this, c = this._frames;
        c._watch || (u = !l(c, "_watch"),
        c._watch = yn.read(function() {
            if (h._connected) {
                var t = h.$options.computed
                  , e = h._computeds;
                for (var n in t) {
                    var i = l(e, n)
                      , r = e[n];
                    delete e[n];
                    var o = t[n]
                      , s = o.watch
                      , a = o.immediate;
                    s && (u && a || i && !Y(r, h[n])) && s.call(h, h[n], r)
                }
                c._watch = null
            }
        }))
    }
    ,
    si = 0,
    (oi = ti).prototype._init = function(t) {
        (t = t || {}).data = function(t, e) {
            var n = t.data
              , i = (t.el,
            e.args)
              , r = e.props;
            void 0 === r && (r = {});
            if (n = k(n) ? O(i) ? void 0 : n.slice(0, i.length).reduce(function(t, e, n) {
                return T(e) ? G(t, e) : t[i[n]] = e,
                t
            }, {}) : n)
                for (var o in n)
                    H(n[o]) ? delete n[o] : n[o] = r[o] ? fi(r[o], n[o]) : n[o];
            return n
        }(t, this.constructor.options),
        this.$options = Nn(this.constructor.options, t, this),
        this.$el = null,
        this.$props = {},
        this._uid = si++,
        this._initData(),
        this._initMethods(),
        this._initComputeds(),
        this._callHook("created"),
        t.el && this.$mount(t.el)
    }
    ,
    oi.prototype._initData = function() {
        var t = this.$options.data;
        for (var e in void 0 === t && (t = {}),
        t)
            this.$props[e] = this[e] = t[e]
    }
    ,
    oi.prototype._initMethods = function() {
        var t = this.$options.methods;
        if (t)
            for (var e in t)
                this[e] = t[e].bind(this)
    }
    ,
    oi.prototype._initComputeds = function() {
        var t = this.$options.computed;
        if (this._computeds = {},
        t)
            for (var e in t)
                !function(i, r, o) {
                    Object.defineProperty(i, r, {
                        enumerable: !0,
                        get: function() {
                            var t = i._computeds
                              , e = i.$props
                              , n = i.$el;
                            return l(t, r) || (t[r] = (o.get || o).call(i, e, n)),
                            t[r]
                        },
                        set: function(t) {
                            var e = i._computeds;
                            e[r] = o.set ? o.set.call(i, t) : t,
                            H(e[r]) && delete e[r]
                        }
                    })
                }(this, e, t[e])
    }
    ,
    oi.prototype._initProps = function(t) {
        var e;
        for (e in t = t || li(this.$options, this.$name))
            H(t[e]) || (this.$props[e] = t[e]);
        var n = [this.$options.computed, this.$options.methods];
        for (e in this.$props)
            e in t && function(t, e) {
                return t.every(function(t) {
                    return !t || !l(t, e)
                })
            }(n, e) && (this[e] = this.$props[e])
    }
    ,
    oi.prototype._initEvents = function() {
        var n = this;
        this._events = [];
        var t = this.$options.events;
        t && t.forEach(function(t) {
            if (l(t, "handler"))
                di(n, t);
            else
                for (var e in t)
                    di(n, t[e], e)
        })
    }
    ,
    oi.prototype._unbindEvents = function() {
        this._events.forEach(function(t) {
            return t()
        }),
        delete this._events
    }
    ,
    oi.prototype._initObserver = function() {
        var t, r = this, e = this.$options, o = e.attrs, n = e.props, i = e.el;
        !this._observer && n && !1 !== o && (o = k(o) ? o : Object.keys(n),
        this._observer = new MutationObserver(function(t) {
            var i = li(r.$options, r.$name);
            t.some(function(t) {
                var e = t.attributeName
                  , n = e.replace("data-", "");
                return (n === r.$name ? o : [f(n), f(e)]).some(function(t) {
                    return !H(i[t]) && i[t] !== r.$props[t]
                })
            }) && r.$reset()
        }
        ),
        t = o.map(d).concat(this.$name),
        this._observer.observe(i, {
            attributes: !0,
            attributeFilter: t.concat(t.map(function(t) {
                return "data-" + t
            }))
        }))
    }
    ,
    ui = (ai = ti).data,
    hi = {},
    ai.component = function(s, t) {
        var e = d(s);
        if (s = f(e),
        !t)
            return T(hi[s]) && (hi[s] = ai.extend(hi[s])),
            hi[s];
        ai[s] = function(t, n) {
            for (var e = arguments.length, i = Array(e); e--; )
                i[e] = arguments[e];
            var r = ai.component(s);
            return r.options.functional ? new r({
                data: T(t) ? t : [].concat(i)
            }) : t ? Me(t).map(o)[0] : o(t);
            function o(t) {
                var e = ai.getComponent(t, s);
                if (e) {
                    if (!n)
                        return e;
                    e.$destroy()
                }
                return new r({
                    el: t,
                    data: n
                })
            }
        }
        ;
        var n = T(t) ? G({}, t) : t.options;
        return n.name = s,
        n.install && n.install(ai, n, s),
        ai._initialized && !n.functional && yn.read(function() {
            return ai[s]("[uk-" + e + "],[data-uk-" + e + "]")
        }),
        hi[s] = T(t) ? n : t
    }
    ,
    ai.getComponents = function(t) {
        return t && t[ui] || {}
    }
    ,
    ai.getComponent = function(t, e) {
        return ai.getComponents(t)[e]
    }
    ,
    ai.connect = function(t) {
        if (t[ui])
            for (var e in t[ui])
                t[ui][e]._callConnected();
        for (var n = 0; n < t.attributes.length; n++) {
            var i = Qn(t.attributes[n].name);
            i && i in hi && ai[i](t)
        }
    }
    ,
    ai.disconnect = function(t) {
        for (var e in t[ui])
            t[ui][e]._callDisconnected()
    }
    ,
    function(i) {
        var r = i.data;
        i.prototype.$create = function(t, e, n) {
            return i[t](e, n)
        }
        ,
        i.prototype.$mount = function(t) {
            var e = this.$options.name;
            t[r] || (t[r] = {}),
            t[r][e] || ((t[r][e] = this).$el = this.$options.el = this.$options.el || t,
            qt(t, document) && this._callConnected())
        }
        ,
        i.prototype.$reset = function() {
            this._callDisconnected(),
            this._callConnected()
        }
        ,
        i.prototype.$destroy = function(t) {
            void 0 === t && (t = !1);
            var e = this.$options
              , n = e.el
              , i = e.name;
            n && this._callDisconnected(),
            this._callHook("destroy"),
            n && n[r] && (delete n[r][i],
            O(n[r]) || delete n[r],
            t && $e(this.$el))
        }
        ,
        i.prototype.$emit = function(t) {
            this._callUpdate(t)
        }
        ,
        i.prototype.$update = function(t, e) {
            void 0 === t && (t = this.$el),
            i.update(t, e)
        }
        ,
        i.prototype.$getComponent = i.getComponent;
        var e = {};
        Object.defineProperties(i.prototype, {
            $container: Object.getOwnPropertyDescriptor(i, "container"),
            $name: {
                get: function() {
                    var t = this.$options.name;
                    return e[t] || (e[t] = i.prefix + d(t)),
                    e[t]
                }
            }
        })
    }(ti);
    var pi = {
        connected: function() {
            He(this.$el, this.$name) || De(this.$el, this.$name)
        }
    }
      , gi = {
        props: {
            cls: Boolean,
            animation: "list",
            duration: Number,
            origin: String,
            transition: String
        },
        data: {
            cls: !1,
            animation: [!1],
            duration: 200,
            origin: !1,
            transition: "linear",
            initProps: {
                overflow: "",
                height: "",
                paddingTop: "",
                paddingBottom: "",
                marginTop: "",
                marginBottom: ""
            },
            hideProps: {
                overflow: "hidden",
                height: 0,
                paddingTop: 0,
                paddingBottom: 0,
                marginTop: 0,
                marginBottom: 0
            }
        },
        computed: {
            hasAnimation: function(t) {
                return !!t.animation[0]
            },
            hasTransition: function(t) {
                var e = t.animation;
                return this.hasAnimation && !0 === e[0]
            }
        },
        methods: {
            toggleElement: function(t, n, i) {
                var r = this;
                return ae.all(V(t).map(function(e) {
                    return new ae(function(t) {
                        return r._toggleElement(e, n, i).then(t, et)
                    }
                    )
                }))
            },
            isToggled: function(t) {
                var e = V(t || this.$el);
                return this.cls ? He(e, this.cls.split(" ")[0]) : !st(e, "hidden")
            },
            updateAria: function(t) {
                !1 === this.cls && ot(t, "aria-hidden", !this.isToggled(t))
            },
            _toggleElement: function(t, e, n) {
                var i = this;
                if (e = z(e) ? e : rn.inProgress(t) ? He(t, "uk-animation-leave") : Qe.inProgress(t) ? "0px" === t.style.height : !this.isToggled(t),
                !Kt(t, "before" + (e ? "show" : "hide"), [this]))
                    return ae.reject();
                var o, r = ($(n) ? n : !1 !== n && this.hasAnimation ? this.hasTransition ? mi(this) : (o = this,
                function(t, e) {
                    rn.cancel(t);
                    var n = o.animation
                      , i = o.duration
                      , r = o._toggle;
                    return e ? (r(t, !0),
                    rn.in(t, n[0], i, o.origin)) : rn.out(t, n[1] || n[0], i, o.origin).then(function() {
                        return r(t, !1)
                    })
                }
                ) : this._toggle)(t, e);
                Kt(t, e ? "show" : "hide", [this]);
                return (r || ae.resolve()).then(function() {
                    Kt(t, e ? "shown" : "hidden", [i]),
                    i.$update(t)
                })
            },
            _toggle: function(t, e) {
                var n;
                t && (e = Boolean(e),
                this.cls ? (n = b(this.cls, " ") || e !== He(t, this.cls)) && Le(t, this.cls, b(this.cls, " ") ? void 0 : e) : (n = e === st(t, "hidden")) && ot(t, "hidden", e ? null : ""),
                Me("[autofocus]", t).some(function(t) {
                    return Ft(t) ? t.focus() || !0 : t.blur()
                }),
                this.updateAria(t),
                n && (Kt(t, "toggled", [this]),
                this.$update(t)))
            }
        }
    };
    function mi(t) {
        var s = t.isToggled
          , a = t.duration
          , u = t.initProps
          , h = t.hideProps
          , c = t.transition
          , l = t._toggle;
        return function(t, e) {
            var n = Qe.inProgress(t)
              , i = t.hasChildNodes ? F(Re(t.firstElementChild, "marginTop")) + F(Re(t.lastElementChild, "marginBottom")) : 0
              , r = Ft(t) ? ln(t) + (n ? 0 : i) : 0;
            Qe.cancel(t),
            s(t) || l(t, !0),
            ln(t, ""),
            yn.flush();
            var o = ln(t) + (n ? 0 : i);
            return ln(t, r),
            (e ? Qe.start(t, G({}, u, {
                overflow: "hidden",
                height: o
            }), Math.round(a * (1 - r / o)), c) : Qe.start(t, h, Math.round(a * (r / o)), c).then(function() {
                return l(t, !1)
            })).then(function() {
                return Re(t, u)
            })
        }
    }
    var vi = {
        mixins: [pi, gi],
        props: {
            targets: String,
            active: null,
            collapsible: Boolean,
            multiple: Boolean,
            toggle: String,
            content: String,
            transition: String,
            offset: Number
        },
        data: {
            targets: "> *",
            active: !1,
            animation: [!0],
            collapsible: !0,
            multiple: !1,
            clsOpen: "uk-open",
            toggle: "> .uk-accordion-title",
            content: "> .uk-accordion-content",
            transition: "ease",
            offset: 0
        },
        computed: {
            items: {
                get: function(t, e) {
                    return Me(t.targets, e)
                },
                watch: function(t, e) {
                    var n, i = this;
                    t.forEach(function(t) {
                        return wi(Ne(i.content, t), !He(t, i.clsOpen))
                    }),
                    e || He(t, this.clsOpen) || (n = !1 !== this.active && t[Number(this.active)] || !this.collapsible && t[0]) && this.toggle(n, !1)
                },
                immediate: !0
            }
        },
        events: [{
            name: "click",
            delegate: function() {
                return this.targets + " " + this.$props.toggle
            },
            handler: function(t) {
                t.preventDefault(),
                this.toggle(ge(Me(this.targets + " " + this.$props.toggle, this.$el), t.current))
            }
        }],
        methods: {
            toggle: function(t, r) {
                var o = this
                  , e = [this.items[me(t, this.items)]]
                  , n = Rt(this.items, "." + this.clsOpen);
                this.multiple || b(n, e[0]) || (e = e.concat(n)),
                !this.collapsible && n.length < 2 && !Rt(e, ":not(." + this.clsOpen + ")").length || e.forEach(function(t) {
                    return o.toggleElement(t, !He(t, o.clsOpen), function(e, n) {
                        Le(e, o.clsOpen, n);
                        var i = Ne((e._wrapper ? "> * " : "") + o.content, e);
                        if (!1 !== r && o.hasTransition)
                            return e._wrapper || (e._wrapper = Ie(i, "<div" + (n ? " hidden" : "") + ">")),
                            wi(i, !1),
                            mi(o)(e._wrapper, n).then(function() {
                                var t;
                                wi(i, !n),
                                delete e._wrapper,
                                Te(i),
                                n && (Rn(t = Ne(o.$props.toggle, e)) || Un(t, {
                                    offset: o.offset
                                }))
                            });
                        wi(i, !n)
                    })
                })
            }
        }
    };
    function wi(t, e) {
        ot(t, "hidden", e ? "" : null)
    }
    var bi = {
        mixins: [pi, gi],
        args: "animation",
        props: {
            close: String
        },
        data: {
            animation: [!0],
            selClose: ".uk-alert-close",
            duration: 150,
            hideProps: G({
                opacity: 0
            }, gi.data.hideProps)
        },
        events: [{
            name: "click",
            delegate: function() {
                return this.selClose
            },
            handler: function(t) {
                t.preventDefault(),
                this.close()
            }
        }],
        methods: {
            close: function() {
                var t = this;
                this.toggleElement(this.$el).then(function() {
                    return t.$destroy(!0)
                })
            }
        }
    }
      , xi = {
        args: "autoplay",
        props: {
            automute: Boolean,
            autoplay: Boolean
        },
        data: {
            automute: !1,
            autoplay: !0
        },
        computed: {
            inView: function(t) {
                return "inview" === t.autoplay
            }
        },
        connected: function() {
            this.inView && !st(this.$el, "preload") && (this.$el.preload = "none"),
            this.automute && Bn(this.$el)
        },
        update: {
            read: function() {
                return {
                    visible: Ft(this.$el) && "hidden" !== Re(this.$el, "visibility"),
                    inView: this.inView && Rn(this.$el)
                }
            },
            write: function(t) {
                var e = t.visible
                  , n = t.inView;
                !e || this.inView && !n ? Dn(this.$el) : (!0 === this.autoplay || this.inView && n) && zn(this.$el)
            },
            events: ["resize", "scroll"]
        }
    }
      , yi = {
        mixins: [pi, xi],
        props: {
            width: Number,
            height: Number
        },
        data: {
            automute: !0
        },
        update: {
            read: function() {
                var t = this.$el
                  , e = function(t) {
                    for (; t = Pt(t); )
                        if ("static" !== Re(t, "position"))
                            return t
                }(t) || t.parentNode
                  , n = e.offsetHeight
                  , i = e.offsetWidth
                  , r = rt.cover({
                    width: this.width || t.naturalWidth || t.videoWidth || t.clientWidth,
                    height: this.height || t.naturalHeight || t.videoHeight || t.clientHeight
                }, {
                    width: i + (i % 2 ? 1 : 0),
                    height: n + (n % 2 ? 1 : 0)
                });
                return !(!r.width || !r.height) && r
            },
            write: function(t) {
                var e = t.height
                  , n = t.width;
                Re(this.$el, {
                    height: e,
                    width: n
                })
            },
            events: ["resize"]
        }
    };
    var ki, $i = {
        props: {
            pos: String,
            offset: null,
            flip: Boolean,
            clsPos: String
        },
        data: {
            pos: "bottom-" + (lt ? "right" : "left"),
            flip: !0,
            offset: !1,
            clsPos: ""
        },
        computed: {
            pos: function(t) {
                var e = t.pos;
                return (e + (b(e, "-") ? "" : "-center")).split("-")
            },
            dir: function() {
                return this.pos[0]
            },
            align: function() {
                return this.pos[1]
            }
        },
        methods: {
            positionAt: function(t, e, n) {
                var i;
                Pe(t, this.clsPos + "-(top|bottom|left|right)(-[a-z]+)?");
                var r = this.offset
                  , o = this.getAxis();
                P(r) || (r = (i = Ne(r)) ? an(i)["x" === o ? "left" : "top"] - an(e)["x" === o ? "right" : "bottom"] : 0);
                var s = sn(t, e, "x" === o ? wn(this.dir) + " " + this.align : this.align + " " + wn(this.dir), "x" === o ? this.dir + " " + this.align : this.align + " " + this.dir, "x" === o ? "" + ("left" === this.dir ? -r : r) : " " + ("top" === this.dir ? -r : r), null, this.flip, n).target
                  , a = s.x
                  , u = s.y;
                this.dir = "x" === o ? a : u,
                this.align = "x" === o ? u : a,
                Le(t, this.clsPos + "-" + this.dir + "-" + this.align, !1 === this.offset)
            },
            getAxis: function() {
                return "top" === this.dir || "bottom" === this.dir ? "y" : "x"
            }
        }
    }, Ii = {
        mixins: [$i, gi],
        args: "pos",
        props: {
            mode: "list",
            toggle: Boolean,
            boundary: Boolean,
            boundaryAlign: Boolean,
            delayShow: Number,
            delayHide: Number,
            clsDrop: String
        },
        data: {
            mode: ["click", "hover"],
            toggle: "- *",
            boundary: ht && window,
            boundaryAlign: !1,
            delayShow: 0,
            delayHide: 800,
            clsDrop: !1,
            animation: ["uk-animation-fade"],
            cls: "uk-open"
        },
        computed: {
            boundary: function(t, e) {
                return yt(t.boundary, e)
            },
            clsDrop: function(t) {
                return t.clsDrop || "uk-" + this.$options.name
            },
            clsPos: function() {
                return this.clsDrop
            }
        },
        created: function() {
            this.tracker = new En
        },
        connected: function() {
            De(this.$el, this.clsDrop);
            var t = this.$props.toggle;
            this.toggle = t && this.$create("toggle", yt(t, this.$el), {
                target: this.$el,
                mode: this.mode
            }),
            this.toggle || Kt(this.$el, "updatearia")
        },
        disconnected: function() {
            this.isActive() && (ki = null)
        },
        events: [{
            name: "click",
            delegate: function() {
                return "." + this.clsDrop + "-close"
            },
            handler: function(t) {
                t.preventDefault(),
                this.hide(!1)
            }
        }, {
            name: "click",
            delegate: function() {
                return 'a[href^="#"]'
            },
            handler: function(t) {
                var e = t.defaultPrevented
                  , n = t.current.hash;
                e || !n || qt(n, this.$el) || this.hide(!1)
            }
        }, {
            name: "beforescroll",
            handler: function() {
                this.hide(!1)
            }
        }, {
            name: "toggle",
            self: !0,
            handler: function(t, e) {
                t.preventDefault(),
                this.isToggled() ? this.hide(!1) : this.show(e, !1)
            }
        }, {
            name: "toggleshow",
            self: !0,
            handler: function(t, e) {
                t.preventDefault(),
                this.show(e)
            }
        }, {
            name: "togglehide",
            self: !0,
            handler: function(t) {
                t.preventDefault(),
                this.hide()
            }
        }, {
            name: wt,
            filter: function() {
                return b(this.mode, "hover")
            },
            handler: function(t) {
                re(t) || this.clearTimers()
            }
        }, {
            name: bt,
            filter: function() {
                return b(this.mode, "hover")
            },
            handler: function(t) {
                !re(t) && t.relatedTarget && this.hide()
            }
        }, {
            name: "toggled",
            self: !0,
            handler: function() {
                this.isToggled() && (this.clearTimers(),
                this.position())
            }
        }, {
            name: "show",
            self: !0,
            handler: function() {
                var o = this;
                (ki = this).tracker.init(),
                Kt(this.$el, "updatearia"),
                Jt(this.$el, "hide", Xt(document, gt, function(t) {
                    var r = t.target;
                    return !qt(r, o.$el) && Jt(document, vt + " " + xt + " scroll", function(t) {
                        var e = t.defaultPrevented
                          , n = t.type
                          , i = t.target;
                        e || n !== vt || r !== i || o.toggle && qt(r, o.toggle.$el) || o.hide(!1)
                    }, !0)
                }), {
                    self: !0
                }),
                Jt(this.$el, "hide", Xt(document, "keydown", function(t) {
                    27 === t.keyCode && (t.preventDefault(),
                    o.hide(!1))
                }), {
                    self: !0
                })
            }
        }, {
            name: "beforehide",
            self: !0,
            handler: function() {
                this.clearTimers()
            }
        }, {
            name: "hide",
            handler: function(t) {
                var e = t.target;
                this.$el === e ? (ki = this.isActive() ? null : ki,
                Kt(this.$el, "updatearia"),
                this.tracker.cancel()) : ki = null === ki && qt(e, this.$el) && this.isToggled() ? this : ki
            }
        }, {
            name: "updatearia",
            self: !0,
            handler: function(t, e) {
                t.preventDefault(),
                this.updateAria(this.$el),
                (e || this.toggle) && (ot((e || this.toggle).$el, "aria-expanded", this.isToggled()),
                Le(this.toggle.$el, this.cls, this.isToggled()))
            }
        }],
        update: {
            write: function() {
                this.isToggled() && !rn.inProgress(this.$el) && this.position()
            },
            events: ["resize"]
        },
        methods: {
            show: function(t, e) {
                var n, i = this;
                if (void 0 === t && (t = this.toggle),
                void 0 === e && (e = !0),
                this.isToggled() && t && this.toggle && t.$el !== this.toggle.$el && this.hide(!1),
                this.toggle = t,
                this.clearTimers(),
                !this.isActive()) {
                    if (ki) {
                        if (e && ki.isDelaying)
                            return void (this.showTimer = setTimeout(this.show, 10));
                        for (; ki && n !== ki && !qt(this.$el, ki.$el); )
                            (n = ki).hide(!1)
                    }
                    this.showTimer = setTimeout(function() {
                        return !i.isToggled() && i.toggleElement(i.$el, !0)
                    }, e && this.delayShow || 0)
                }
            },
            hide: function(t) {
                var e = this;
                void 0 === t && (t = !0);
                function n() {
                    return e.toggleElement(e.$el, !1, !1)
                }
                var i, r;
                this.clearTimers(),
                this.isDelaying = (i = this.$el,
                r = [],
                Ae(i, function(t) {
                    return "static" !== Re(t, "position") && r.push(t)
                }),
                r.some(function(t) {
                    return e.tracker.movesTo(t)
                })),
                t && this.isDelaying ? this.hideTimer = setTimeout(this.hide, 50) : t && this.delayHide ? this.hideTimer = setTimeout(n, this.delayHide) : n()
            },
            clearTimers: function() {
                clearTimeout(this.showTimer),
                clearTimeout(this.hideTimer),
                this.showTimer = null,
                this.hideTimer = null,
                this.isDelaying = !1
            },
            isActive: function() {
                return ki === this
            },
            position: function() {
                Be(this.$el, this.clsDrop + "-stack"),
                Le(this.$el, this.clsDrop + "-boundary", this.boundaryAlign);
                var t, e = an(this.boundary), n = this.boundaryAlign ? e : an(this.toggle.$el);
                "justify" === this.align ? (t = "y" === this.getAxis() ? "width" : "height",
                Re(this.$el, t, n[t])) : this.$el.offsetWidth > Math.max(e.right - n.left, n.right - e.left) && De(this.$el, this.clsDrop + "-stack"),
                this.positionAt(this.$el, this.boundaryAlign ? this.boundary : this.toggle.$el, this.boundary)
            }
        }
    };
    var Si = {
        mixins: [pi],
        args: "target",
        props: {
            target: Boolean
        },
        data: {
            target: !1
        },
        computed: {
            input: function(t, e) {
                return Ne(Wt, e)
            },
            state: function() {
                return this.input.nextElementSibling
            },
            target: function(t, e) {
                var n = t.target;
                return n && (!0 === n && this.input.parentNode === e && this.input.nextElementSibling || yt(n, e))
            }
        },
        update: function() {
            var t, e, n, i = this.target, r = this.input;
            !i || i[e = Vt(i) ? "value" : "textContent"] !== (n = r.files && r.files[0] ? r.files[0].name : zt(r, "select") && (t = Me("option", r).filter(function(t) {
                return t.selected
            })[0]) ? t.textContent : r.value) && (i[e] = n)
        },
        events: [{
            name: "change",
            handler: function() {
                this.$update()
            }
        }, {
            name: "reset",
            el: function() {
                return Bt(this.$el, "form")
            },
            handler: function() {
                this.$update()
            }
        }]
    }
      , Ti = {
        update: {
            read: function(t) {
                var e = Rn(this.$el);
                if (!e || t.isInView === e)
                    return !1;
                t.isInView = e
            },
            write: function() {
                this.$el.src = "" + this.$el.src
            },
            events: ["scroll", "resize"]
        }
    }
      , Ei = {
        props: {
            margin: String,
            firstColumn: Boolean
        },
        data: {
            margin: "uk-margin-small-top",
            firstColumn: "uk-first-column"
        },
        update: {
            read: function() {
                var n, t = _i(this.$el.children);
                return {
                    rows: t,
                    columns: (n = [[]],
                    t.forEach(function(t) {
                        return Ci(t, "left", "right").forEach(function(t, e) {
                            return n[e] = n[e] ? n[e].concat(t) : t
                        })
                    }),
                    lt ? n.reverse() : n)
                }
            },
            write: function(t) {
                var n = this
                  , i = t.columns;
                t.rows.forEach(function(t, e) {
                    return t.forEach(function(t) {
                        Le(t, n.margin, 0 !== e),
                        Le(t, n.firstColumn, b(i[0], t))
                    })
                })
            },
            events: ["resize"]
        }
    };
    function _i(t) {
        return Ci(t, "top", "bottom")
    }
    function Ci(t, e, n) {
        for (var i = [[]], r = 0; r < t.length; r++) {
            var o = t[r];
            if (Ft(o))
                for (var s = Ai(o), a = i.length - 1; 0 <= a; a--) {
                    var u = i[a];
                    if (!u[0]) {
                        u.push(o);
                        break
                    }
                    var h = void 0
                      , h = u[0].offsetParent === o.offsetParent ? Ai(u[0]) : (s = Ai(o, !0),
                    Ai(u[0], !0));
                    if (s[e] >= h[n] - 1 && s[e] !== h[e]) {
                        i.push([o]);
                        break
                    }
                    if (s[n] - 1 > h[e] || s[e] === h[e]) {
                        u.push(o);
                        break
                    }
                    if (0 === a) {
                        i.unshift([o]);
                        break
                    }
                }
        }
        return i
    }
    function Ai(t, e) {
        var n;
        void 0 === e && (e = !1);
        var i = t.offsetTop
          , r = t.offsetLeft
          , o = t.offsetHeight
          , s = t.offsetWidth;
        return e && (i = (n = cn(t))[0],
        r = n[1]),
        {
            top: i,
            left: r,
            bottom: i + o,
            right: r + s
        }
    }
    var Ni = {
        extends: Ei,
        mixins: [pi],
        name: "grid",
        props: {
            masonry: Boolean,
            parallax: Number
        },
        data: {
            margin: "uk-grid-margin",
            clsStack: "uk-grid-stack",
            masonry: !1,
            parallax: 0
        },
        connected: function() {
            this.masonry && De(this.$el, "uk-flex-top uk-flex-wrap-top")
        },
        update: [{
            write: function(t) {
                var e = t.columns;
                Le(this.$el, this.clsStack, e.length < 2)
            },
            events: ["resize"]
        }, {
            read: function(t) {
                var e = t.columns
                  , n = t.rows
                  , i = Yt(this.$el);
                if (!i.length || !this.masonry && !this.parallax)
                    return !1;
                var r, o, s, a, u, h = i.some(Qe.inProgress), c = !1, l = e.map(function(t) {
                    return t.reduce(function(t, e) {
                        return t + e.offsetHeight
                    }, 0)
                }), d = (r = i,
                o = this.margin,
                F((s = r.filter(function(t) {
                    return He(t, o)
                })[0]) ? Re(s, "marginTop") : Re(r[0], "paddingLeft")) * (n.length - 1)), f = Math.max.apply(Math, l) + d;
                this.masonry && (e = e.map(function(t) {
                    return Z(t, "offsetTop")
                }),
                a = e,
                u = n.map(function(t) {
                    return Math.max.apply(Math, t.map(function(t) {
                        return t.offsetHeight
                    }))
                }),
                c = a.map(function(n) {
                    var i = 0;
                    return n.map(function(t, e) {
                        return i += e ? u[e - 1] - n[e - 1].offsetHeight : 0
                    })
                }));
                var p = Math.abs(this.parallax);
                return {
                    padding: p = p && l.reduce(function(t, e, n) {
                        return Math.max(t, e + d + (n % 2 ? p : p / 8) - f)
                    }, 0),
                    columns: e,
                    translates: c,
                    height: !h && (this.masonry ? f : "")
                }
            },
            write: function(t) {
                var e = t.height
                  , n = t.padding;
                Re(this.$el, "paddingBottom", n || ""),
                !1 !== e && Re(this.$el, "height", e)
            },
            events: ["resize"]
        }, {
            read: function(t) {
                var e = t.height;
                return {
                    scrolled: !!this.parallax && Yn(this.$el, e ? e - ln(this.$el) : 0) * Math.abs(this.parallax)
                }
            },
            write: function(t) {
                var e = t.columns
                  , i = t.scrolled
                  , r = t.translates;
                !1 === i && !r || e.forEach(function(t, n) {
                    return t.forEach(function(t, e) {
                        return Re(t, "transform", i || r ? "translateY(" + ((r && -r[n][e]) + (i ? n % 2 ? i : i / 8 : 0)) + "px)" : "")
                    })
                })
            },
            events: ["scroll", "resize"]
        }]
    };
    var Mi = ct ? {
        props: {
            selMinHeight: String
        },
        data: {
            selMinHeight: !1,
            forceHeight: !1
        },
        computed: {
            elements: function(t, e) {
                var n = t.selMinHeight;
                return n ? Me(n, e) : [e]
            }
        },
        update: [{
            read: function() {
                Re(this.elements, "height", "")
            },
            order: -5,
            events: ["resize"]
        }, {
            write: function() {
                var n = this;
                this.elements.forEach(function(t) {
                    var e = F(Re(t, "minHeight"));
                    e && (n.forceHeight || Math.round(e + pn(t, "height", "content-box")) >= t.offsetHeight) && Re(t, "height", e)
                })
            },
            order: 5,
            events: ["resize"]
        }]
    } : {}
      , zi = {
        mixins: [Mi],
        args: "target",
        props: {
            target: String,
            row: Boolean
        },
        data: {
            target: "> *",
            row: !0,
            forceHeight: !0
        },
        computed: {
            elements: function(t, e) {
                return Me(t.target, e)
            }
        },
        update: {
            read: function() {
                return {
                    rows: (this.row ? _i(this.elements) : [this.elements]).map(Di)
                }
            },
            write: function(t) {
                t.rows.forEach(function(t) {
                    var n = t.heights;
                    return t.elements.forEach(function(t, e) {
                        return Re(t, "minHeight", n[e])
                    })
                })
            },
            events: ["resize"]
        }
    };
    function Di(t) {
        var e;
        if (t.length < 2)
            return {
                heights: [""],
                elements: t
            };
        var n = Bi(t)
          , i = n.heights
          , r = n.max
          , o = t.some(function(t) {
            return t.style.minHeight
        })
          , s = t.some(function(t, e) {
            return !t.style.minHeight && i[e] < r
        });
        return o && s && (Re(t, "minHeight", ""),
        e = Bi(t),
        i = e.heights,
        r = e.max),
        {
            heights: i = t.map(function(t, e) {
                return i[e] === r && F(t.style.minHeight).toFixed(2) !== r.toFixed(2) ? "" : r
            }),
            elements: t
        }
    }
    function Bi(t) {
        var e = t.map(function(t) {
            return an(t).height - pn(t, "height", "content-box")
        });
        return {
            heights: e,
            max: Math.max.apply(null, e)
        }
    }
    var Pi = {
        mixins: [Mi],
        props: {
            expand: Boolean,
            offsetTop: Boolean,
            offsetBottom: Boolean,
            minHeight: Number
        },
        data: {
            expand: !1,
            offsetTop: !1,
            offsetBottom: !1,
            minHeight: 0
        },
        update: {
            read: function(t) {
                var e = t.minHeight;
                if (!Ft(this.$el))
                    return !1;
                var n = ""
                  , i = pn(this.$el, "height", "content-box");
                if (this.expand) {
                    if (this.$el.dataset.heightExpand = "",
                    Ne("[data-height-expand]") !== this.$el)
                        return !1;
                    n = ln(window) - (Oi(document.documentElement) - Oi(this.$el)) - i || ""
                } else {
                    var r, n = "calc(100vh";
                    this.offsetTop && (n += 0 < (r = an(this.$el).top) && r < ln(window) / 2 ? " - " + r + "px" : ""),
                    !0 === this.offsetBottom ? n += " - " + Oi(this.$el.nextElementSibling) + "px" : P(this.offsetBottom) ? n += " - " + this.offsetBottom + "vh" : this.offsetBottom && h(this.offsetBottom, "px") ? n += " - " + F(this.offsetBottom) + "px" : D(this.offsetBottom) && (n += " - " + Oi(yt(this.offsetBottom, this.$el)) + "px"),
                    n += (i ? " - " + i + "px" : "") + ")"
                }
                return {
                    minHeight: n,
                    prev: e
                }
            },
            write: function(t) {
                var e = t.minHeight
                  , n = t.prev;
                Re(this.$el, {
                    minHeight: e
                }),
                e !== n && this.$update(this.$el, "resize"),
                this.minHeight && F(Re(this.$el, "minHeight")) < this.minHeight && Re(this.$el, "minHeight", this.minHeight)
            },
            events: ["resize"]
        }
    };
    function Oi(t) {
        return t && an(t).height || 0
    }
    var Hi = {
        args: "src",
        props: {
            id: Boolean,
            icon: String,
            src: String,
            style: String,
            width: Number,
            height: Number,
            ratio: Number,
            class: String,
            strokeAnimation: Boolean,
            focusable: Boolean,
            attributes: "list"
        },
        data: {
            ratio: 1,
            include: ["style", "class", "focusable"],
            class: "",
            strokeAnimation: !1
        },
        beforeConnect: function() {
            this.class += " uk-svg"
        },
        connected: function() {
            var t, e = this;
            !this.icon && b(this.src, "#") && (t = this.src.split("#"),
            this.src = t[0],
            this.icon = t[1]),
            this.svg = this.getSvg().then(function(t) {
                return e.applyAttributes(t),
                e.svgEl = function(t, e) {
                    if (jt(e) || "CANVAS" === e.tagName) {
                        ot(e, "hidden", !0);
                        var n = e.nextElementSibling;
                        return Vi(t, n) ? n : ye(e, t)
                    }
                    var i = e.lastElementChild;
                    return Vi(t, i) ? i : be(e, t)
                }(t, e.$el)
            }, et)
        },
        disconnected: function() {
            var e = this;
            jt(this.$el) && ot(this.$el, "hidden", null),
            this.svg && this.svg.then(function(t) {
                return (!e._connected || t !== e.svgEl) && $e(t)
            }, et),
            this.svg = this.svgEl = null
        },
        update: {
            read: function() {
                return !!(this.strokeAnimation && this.svgEl && Ft(this.svgEl))
            },
            write: function() {
                var t, e;
                t = this.svgEl,
                (e = Wi(t)) && t.style.setProperty("--uk-animation-stroke", e)
            },
            type: ["resize"]
        },
        methods: {
            getSvg: function() {
                var e = this;
                return function(n) {
                    if (Li[n])
                        return Li[n];
                    return Li[n] = new ae(function(e, t) {
                        n ? w(n, "data:") ? e(decodeURIComponent(n.split(",")[1])) : de(n).then(function(t) {
                            return e(t.response)
                        }, function() {
                            return t("SVG not found.")
                        }) : t()
                    }
                    )
                }(this.src).then(function(t) {
                    return function(t, e) {
                        e && b(t, "<symbol") && (t = function(t, e) {
                            if (!Fi[t]) {
                                var n;
                                for (Fi[t] = {},
                                ji.lastIndex = 0; n = ji.exec(t); )
                                    Fi[t][n[3]] = '<svg xmlns="http://www.w3.org/2000/svg"' + n[1] + "svg>"
                            }
                            return Fi[t][e]
                        }(t, e) || t);
                        return (t = Ne(t.substr(t.indexOf("<svg")))) && t.hasChildNodes() && t
                    }(t, e.icon) || ae.reject("SVG not found.")
                })
            },
            applyAttributes: function(n) {
                var i = this;
                for (var t in this.$options.props)
                    this[t] && b(this.include, t) && ot(n, t, this[t]);
                for (var e in this.attributes) {
                    var r = this.attributes[e].split(":", 2)
                      , o = r[0]
                      , s = r[1];
                    ot(n, o, s)
                }
                this.id || at(n, "id");
                var a = ["width", "height"]
                  , u = [this.width, this.height];
                u.some(function(t) {
                    return t
                }) || (u = a.map(function(t) {
                    return ot(n, t)
                }));
                var h = ot(n, "viewBox");
                h && !u.some(function(t) {
                    return t
                }) && (u = h.split(" ").slice(2)),
                u.forEach(function(t, e) {
                    (t = (0 | t) * i.ratio) && ot(n, a[e], t),
                    t && !u[1 ^ e] && at(n, a[1 ^ e])
                }),
                ot(n, "data-svg", this.icon || this.src)
            }
        }
    }
      , Li = {};
    var ji = /<symbol([^]*?id=(['"])(.+?)\2[^]*?<\/)symbol>/g
      , Fi = {};
    function Wi(t) {
        return Math.ceil(Math.max.apply(Math, [0].concat(Me("[stroke]", t).map(function(t) {
            try {
                return t.getTotalLength()
            } catch (t) {
                return 0
            }
        }))))
    }
    function Vi(t, e) {
        return ot(t, "data-svg") === ot(e, "data-svg")
    }
    var Ri = {
        spinner: '<svg width="30" height="30" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><circle fill="none" stroke="#000" cx="15" cy="15" r="14"/></svg>',
        totop: '<svg width="18" height="10" viewBox="0 0 18 10" xmlns="http://www.w3.org/2000/svg"><polyline fill="none" stroke="#000" stroke-width="1.2" points="1 9 9 1 17 9 "/></svg>',
        marker: '<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><rect x="9" y="4" width="1" height="11"/><rect x="4" y="9" width="11" height="1"/></svg>',
        "close-icon": '<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg"><line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"/><line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"/></svg>',
        "close-large": '<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><line fill="none" stroke="#000" stroke-width="1.4" x1="1" y1="1" x2="19" y2="19"/><line fill="none" stroke="#000" stroke-width="1.4" x1="19" y1="1" x2="1" y2="19"/></svg>',
        "navbar-toggle-icon": '<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><rect y="9" width="20" height="2"/><rect y="3" width="20" height="2"/><rect y="15" width="20" height="2"/></svg>',
        "overlay-icon": '<svg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><rect x="19" y="0" width="1" height="40"/><rect x="0" y="19" width="40" height="1"/></svg>',
        "pagination-next": '<svg width="7" height="12" viewBox="0 0 7 12" xmlns="http://www.w3.org/2000/svg"><polyline fill="none" stroke="#000" stroke-width="1.2" points="1 1 6 6 1 11"/></svg>',
        "pagination-previous": '<svg width="7" height="12" viewBox="0 0 7 12" xmlns="http://www.w3.org/2000/svg"><polyline fill="none" stroke="#000" stroke-width="1.2" points="6 1 1 6 6 11"/></svg>',
        "search-icon": '<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><circle fill="none" stroke="#000" stroke-width="1.1" cx="9" cy="9" r="7"/><path fill="none" stroke="#000" stroke-width="1.1" d="M14,14 L18,18 L14,14 Z"/></svg>',
        "search-large": '<svg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><circle fill="none" stroke="#000" stroke-width="1.8" cx="17.5" cy="17.5" r="16.5"/><line fill="none" stroke="#000" stroke-width="1.8" x1="38" y1="39" x2="29" y2="30"/></svg>',
        "search-navbar": '<svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><circle fill="none" stroke="#000" stroke-width="1.1" cx="10.5" cy="10.5" r="9.5"/><line fill="none" stroke="#000" stroke-width="1.1" x1="23" y1="23" x2="17" y2="17"/></svg>',
        "slidenav-next": '<svg width="14px" height="24px" viewBox="0 0 14 24" xmlns="http://www.w3.org/2000/svg"><polyline fill="none" stroke="#000" stroke-width="1.4" points="1.225,23 12.775,12 1.225,1 "/></svg>',
        "slidenav-next-large": '<svg width="25px" height="40px" viewBox="0 0 25 40" xmlns="http://www.w3.org/2000/svg"><polyline fill="none" stroke="#000" stroke-width="2" points="4.002,38.547 22.527,20.024 4,1.5 "/></svg>',
        "slidenav-previous": '<svg width="14px" height="24px" viewBox="0 0 14 24" xmlns="http://www.w3.org/2000/svg"><polyline fill="none" stroke="#000" stroke-width="1.4" points="12.775,1 1.225,12 12.775,23 "/></svg>',
        "slidenav-previous-large": '<svg width="25px" height="40px" viewBox="0 0 25 40" xmlns="http://www.w3.org/2000/svg"><polyline fill="none" stroke="#000" stroke-width="2" points="20.527,1.5 2,20.024 20.525,38.547 "/></svg>'
    }
      , qi = {
        install: function(r) {
            r.icon.add = function(t, e) {
                var n, i = D(t) ? ((n = {})[t] = e,
                n) : t;
                K(i, function(t, e) {
                    Ri[e] = t,
                    delete Ki[e]
                }),
                r._initialized && Ae(document.body, function(t) {
                    return K(r.getComponents(t), function(t) {
                        t.$options.isIcon && t.icon in i && t.$reset()
                    })
                })
            }
        },
        extends: Hi,
        args: "icon",
        props: ["icon"],
        data: {
            include: ["focusable"]
        },
        isIcon: !0,
        beforeConnect: function() {
            De(this.$el, "uk-icon")
        },
        methods: {
            getSvg: function() {
                var t = function(t) {
                    if (!Ri[t])
                        return null;
                    Ki[t] || (Ki[t] = Ne((Ri[function(t) {
                        return lt ? X(X(t, "left", "right"), "previous", "next") : t
                    }(t)] || Ri[t]).trim()));
                    return Ki[t].cloneNode(!0)
                }(this.icon);
                return t ? ae.resolve(t) : ae.reject("Icon not found.")
            }
        }
    }
      , Ui = {
        args: !1,
        extends: qi,
        data: function(t) {
            return {
                icon: d(t.constructor.options.name)
            }
        },
        beforeConnect: function() {
            De(this.$el, this.$name)
        }
    }
      , Yi = {
        extends: Ui,
        beforeConnect: function() {
            De(this.$el, "uk-slidenav")
        },
        computed: {
            icon: function(t, e) {
                var n = t.icon;
                return He(e, "uk-slidenav-large") ? n + "-large" : n
            }
        }
    }
      , Xi = {
        extends: Ui,
        computed: {
            icon: function(t, e) {
                var n = t.icon;
                return He(e, "uk-search-icon") && Ut(e, ".uk-search-large").length ? "search-large" : Ut(e, ".uk-search-navbar").length ? "search-navbar" : n
            }
        }
    }
      , Gi = {
        extends: Ui,
        computed: {
            icon: function() {
                return "close-" + (He(this.$el, "uk-close-large") ? "large" : "icon")
            }
        }
    }
      , Ji = {
        extends: Ui,
        connected: function() {
            var e = this;
            this.svg.then(function(t) {
                return 1 !== e.ratio && Re(Ne("circle", t), "strokeWidth", 1 / e.ratio)
            }, et)
        }
    }
      , Ki = {};
    var Zi = {
        args: "dataSrc",
        props: {
            dataSrc: String,
            dataSrcset: Boolean,
            sizes: String,
            width: Number,
            height: Number,
            offsetTop: String,
            offsetLeft: String,
            target: String
        },
        data: {
            dataSrc: "",
            dataSrcset: !1,
            sizes: !1,
            width: !1,
            height: !1,
            offsetTop: "50vh",
            offsetLeft: 0,
            target: !1
        },
        computed: {
            cacheKey: function(t) {
                var e = t.dataSrc;
                return this.$name + "." + e
            },
            width: function(t) {
                var e = t.width
                  , n = t.dataWidth;
                return e || n
            },
            height: function(t) {
                var e = t.height
                  , n = t.dataHeight;
                return e || n
            },
            sizes: function(t) {
                var e = t.sizes
                  , n = t.dataSizes;
                return e || n
            },
            isImg: function(t, e) {
                return or(e)
            },
            target: {
                get: function(t) {
                    var e = t.target;
                    return [this.$el].concat(kt(e, this.$el))
                },
                watch: function() {
                    this.observe()
                }
            },
            offsetTop: function(t) {
                return bn(t.offsetTop, "height")
            },
            offsetLeft: function(t) {
                return bn(t.offsetLeft, "width")
            }
        },
        connected: function() {
            ar[this.cacheKey] ? Qi(this.$el, ar[this.cacheKey], this.dataSrcset, this.sizes) : this.isImg && this.width && this.height && Qi(this.$el, function(t, e, n) {
                var i;
                n && (i = rt.ratio({
                    width: t,
                    height: e
                }, "width", bn(er(n))),
                t = i.width,
                e = i.height);
                return 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="' + t + '" height="' + e + '"></svg>'
            }(this.width, this.height, this.sizes)),
            this.observer = new Zn(this.load,{
                rootMargin: this.offsetTop + "px " + this.offsetLeft + "px"
            }),
            requestAnimationFrame(this.observe)
        },
        disconnected: function() {
            this.observer.disconnect()
        },
        update: {
            read: function(t) {
                var e = this
                  , n = t.image;
                if (n || "complete" !== document.readyState || this.load(this.observer.takeRecords()),
                this.isImg)
                    return !1;
                n && n.then(function(t) {
                    return t && "" !== t.currentSrc && Qi(e.$el, sr(t))
                })
            },
            write: function(t) {
                var e, n, i, r, o;
                this.dataSrcset && 1 !== window.devicePixelRatio && (!(e = Re(this.$el, "backgroundSize")).match(/^(auto\s?)+$/) && F(e) !== t.bgSize || (t.bgSize = (n = this.dataSrcset,
                i = this.sizes,
                r = bn(er(i)),
                (o = (n.match(rr) || []).map(F).sort(function(t, e) {
                    return t - e
                })).filter(function(t) {
                    return r <= t
                })[0] || o.pop() || ""),
                Re(this.$el, "backgroundSize", t.bgSize + "px")))
            },
            events: ["resize"]
        },
        methods: {
            load: function(t) {
                var e = this;
                t.some(function(t) {
                    return H(t.isIntersecting) || t.isIntersecting
                }) && (this._data.image = fe(this.dataSrc, this.dataSrcset, this.sizes).then(function(t) {
                    return Qi(e.$el, sr(t), t.srcset, t.sizes),
                    ar[e.cacheKey] = sr(t),
                    t
                }, function(t) {
                    return Kt(e.$el, new t.constructor(t.type,t))
                }),
                this.observer.disconnect())
            },
            observe: function() {
                var e = this;
                this._connected && !this._data.image && this.target.forEach(function(t) {
                    return e.observer.observe(t)
                })
            }
        }
    };
    function Qi(t, e, n, i) {
        or(t) ? (i && (t.sizes = i),
        n && (t.srcset = n),
        e && (t.src = e)) : e && !b(t.style.backgroundImage, e) && (Re(t, "backgroundImage", "url(" + Ht(e) + ")"),
        Kt(t, Zt("load", !1)))
    }
    var tr = /\s*(.*?)\s*(\w+|calc\(.*?\))\s*(?:,|$)/g;
    function er(t) {
        var e, n;
        for (tr.lastIndex = 0; e = tr.exec(t); )
            if (!e[1] || window.matchMedia(e[1]).matches) {
                e = w(n = e[2], "calc") ? n.substring(5, n.length - 1).replace(nr, function(t) {
                    return bn(t)
                }).replace(/ /g, "").match(ir).reduce(function(t, e) {
                    return t + +e
                }, 0) : n;
                break
            }
        return e || "100vw"
    }
    var nr = /\d+(?:\w+|%)/g
      , ir = /[+-]?(\d+)/g;
    var rr = /\s+\d+w\s*(?:,|$)/g;
    function or(t) {
        return "IMG" === t.tagName
    }
    function sr(t) {
        return t.currentSrc || t.src
    }
    var ar, ur = "__test__";
    try {
        (ar = window.sessionStorage || {})[ur] = 1,
        delete ar[ur]
    } catch (t) {
        ar = {}
    }
    var hr = {
        props: {
            media: Boolean
        },
        data: {
            media: !1
        },
        computed: {
            matchMedia: function() {
                var t = function(t) {
                    if (D(t)) {
                        if ("@" === t[0])
                            t = F(Xe("breakpoint-" + t.substr(1)));
                        else if (isNaN(t))
                            return t
                    }
                    return !(!t || isNaN(t)) && "(min-width: " + t + "px)"
                }(this.media);
                return !t || window.matchMedia(t).matches
            }
        }
    };
    var cr = {
        mixins: [pi, hr],
        props: {
            fill: String
        },
        data: {
            fill: "",
            clsWrapper: "uk-leader-fill",
            clsHide: "uk-leader-hide",
            attrFill: "data-fill"
        },
        computed: {
            fill: function(t) {
                return t.fill || Xe("leader-fill-content")
            }
        },
        connected: function() {
            var t = Se(this.$el, '<span class="' + this.clsWrapper + '">');
            this.wrapper = t[0]
        },
        disconnected: function() {
            Te(this.wrapper.childNodes)
        },
        update: {
            read: function(t) {
                var e = t.changed
                  , n = t.width
                  , i = n;
                return {
                    width: n = Math.floor(this.$el.offsetWidth / 2),
                    fill: this.fill,
                    changed: e || i !== n,
                    hide: !this.matchMedia
                }
            },
            write: function(t) {
                Le(this.wrapper, this.clsHide, t.hide),
                t.changed && (t.changed = !1,
                ot(this.wrapper, this.attrFill, new Array(t.width).join(t.fill)))
            },
            events: ["resize"]
        }
    }
      , lr = {
        props: {
            container: Boolean
        },
        data: {
            container: !0
        },
        computed: {
            container: function(t) {
                var e = t.container;
                return !0 === e && this.$container || e && Ne(e)
            }
        }
    }
      , dr = []
      , fr = {
        mixins: [pi, lr, gi],
        props: {
            selPanel: String,
            selClose: String,
            escClose: Boolean,
            bgClose: Boolean,
            stack: Boolean
        },
        data: {
            cls: "uk-open",
            escClose: !0,
            bgClose: !0,
            overlay: !0,
            stack: !1
        },
        computed: {
            panel: function(t, e) {
                return Ne(t.selPanel, e)
            },
            transitionElement: function() {
                return this.panel
            },
            bgClose: function(t) {
                return t.bgClose && this.panel
            }
        },
        beforeDisconnect: function() {
            this.isToggled() && this.toggleElement(this.$el, !1, !1)
        },
        events: [{
            name: "click",
            delegate: function() {
                return this.selClose
            },
            handler: function(t) {
                t.preventDefault(),
                this.hide()
            }
        }, {
            name: "toggle",
            self: !0,
            handler: function(t) {
                t.defaultPrevented || (t.preventDefault(),
                this.isToggled() === b(dr, this) && this.toggle())
            }
        }, {
            name: "beforeshow",
            self: !0,
            handler: function(t) {
                if (b(dr, this))
                    return !1;
                !this.stack && dr.length ? (ae.all(dr.map(function(t) {
                    return t.hide()
                })).then(this.show),
                t.preventDefault()) : dr.push(this)
            }
        }, {
            name: "show",
            self: !0,
            handler: function() {
                var o = this;
                dn(window) - dn(document) && this.overlay && Re(document.body, "overflowY", "scroll"),
                this.stack && Re(this.$el, "zIndex", F(Re(this.$el, "zIndex")) + dr.length),
                De(document.documentElement, this.clsPage),
                this.bgClose && Jt(this.$el, "hide", Xt(document, gt, function(t) {
                    var r = t.target;
                    J(dr) !== o || o.overlay && !qt(r, o.$el) || qt(r, o.panel) || Jt(document, vt + " " + xt + " scroll", function(t) {
                        var e = t.defaultPrevented
                          , n = t.type
                          , i = t.target;
                        e || n !== vt || r !== i || o.hide()
                    }, !0)
                }), {
                    self: !0
                }),
                this.escClose && Jt(this.$el, "hide", Xt(document, "keydown", function(t) {
                    27 === t.keyCode && J(dr) === o && (t.preventDefault(),
                    o.hide())
                }), {
                    self: !0
                })
            }
        }, {
            name: "hidden",
            self: !0,
            handler: function() {
                var e = this;
                dr.splice(dr.indexOf(this), 1),
                dr.length || Re(document.body, "overflowY", ""),
                Re(this.$el, "zIndex", ""),
                dr.some(function(t) {
                    return t.clsPage === e.clsPage
                }) || Be(document.documentElement, this.clsPage)
            }
        }],
        methods: {
            toggle: function() {
                return this.isToggled() ? this.hide() : this.show()
            },
            show: function() {
                var e = this;
                return this.container && this.$el.parentNode !== this.container ? (be(this.container, this.$el),
                new ae(function(t) {
                    return requestAnimationFrame(function() {
                        return e.show().then(t)
                    })
                }
                )) : this.toggleElement(this.$el, !0, pr(this))
            },
            hide: function() {
                return this.toggleElement(this.$el, !1, pr(this))
            }
        }
    };
    function pr(t) {
        var s = t.transitionElement
          , a = t._toggle;
        return function(r, o) {
            return new ae(function(n, i) {
                return Jt(r, "show hide", function() {
                    r._reject && r._reject(),
                    r._reject = i,
                    a(r, o);
                    var t = Jt(s, "transitionstart", function() {
                        Jt(s, "transitionend transitioncancel", n, {
                            self: !0
                        }),
                        clearTimeout(e)
                    }, {
                        self: !0
                    })
                      , e = setTimeout(function() {
                        t(),
                        n()
                    }, U(Re(s, "transitionDuration")))
                })
            }
            )
        }
    }
    var gr = {
        install: function(t) {
            var a = t.modal;
            function e(t, e, n, i) {
                e = G({
                    bgClose: !1,
                    escClose: !0,
                    labels: a.labels
                }, e);
                var r = a.dialog(t(e), e)
                  , o = new se
                  , s = !1;
                return Xt(r.$el, "submit", "form", function(t) {
                    t.preventDefault(),
                    o.resolve(i && i(r)),
                    s = !0,
                    r.hide()
                }),
                Xt(r.$el, "hide", function() {
                    return !s && n(o)
                }),
                o.promise.dialog = r,
                o.promise
            }
            a.dialog = function(t, e) {
                var n = a('<div class="uk-modal"> <div class="uk-modal-dialog">' + t + "</div> </div>", e);
                return n.show(),
                Xt(n.$el, "hidden", function() {
                    return ae.resolve().then(function() {
                        return n.$destroy(!0)
                    })
                }, {
                    self: !0
                }),
                n
            }
            ,
            a.alert = function(n, t) {
                return e(function(t) {
                    var e = t.labels;
                    return '<div class="uk-modal-body">' + (D(n) ? n : we(n)) + '</div> <div class="uk-modal-footer uk-text-right"> <button class="uk-button uk-button-primary uk-modal-close" autofocus>' + e.ok + "</button> </div>"
                }, t, function(t) {
                    return t.resolve()
                })
            }
            ,
            a.confirm = function(n, t) {
                return e(function(t) {
                    var e = t.labels;
                    return '<form> <div class="uk-modal-body">' + (D(n) ? n : we(n)) + '</div> <div class="uk-modal-footer uk-text-right"> <button class="uk-button uk-button-default uk-modal-close" type="button">' + e.cancel + '</button> <button class="uk-button uk-button-primary" autofocus>' + e.ok + "</button> </div> </form>"
                }, t, function(t) {
                    return t.reject()
                })
            }
            ,
            a.prompt = function(n, i, t) {
                return e(function(t) {
                    var e = t.labels;
                    return '<form class="uk-form-stacked"> <div class="uk-modal-body"> <label>' + (D(n) ? n : we(n)) + '</label> <input class="uk-input" value="' + (i || "") + '" autofocus> </div> <div class="uk-modal-footer uk-text-right"> <button class="uk-button uk-button-default uk-modal-close" type="button">' + e.cancel + '</button> <button class="uk-button uk-button-primary">' + e.ok + "</button> </div> </form>"
                }, t, function(t) {
                    return t.resolve(null)
                }, function(t) {
                    return Ne("input", t.$el).value
                })
            }
            ,
            a.labels = {
                ok: "Ok",
                cancel: "Cancel"
            }
        },
        mixins: [fr],
        data: {
            clsPage: "uk-modal-page",
            selPanel: ".uk-modal-dialog",
            selClose: ".uk-modal-close, .uk-modal-close-default, .uk-modal-close-outside, .uk-modal-close-full"
        },
        events: [{
            name: "show",
            self: !0,
            handler: function() {
                He(this.panel, "uk-margin-auto-vertical") ? De(this.$el, "uk-flex") : Re(this.$el, "display", "block"),
                ln(this.$el)
            }
        }, {
            name: "hidden",
            self: !0,
            handler: function() {
                Re(this.$el, "display", ""),
                Be(this.$el, "uk-flex")
            }
        }]
    };
    var mr = {
        extends: vi,
        data: {
            targets: "> .uk-parent",
            toggle: "> a",
            content: "> ul"
        }
    }
      , vr = {
        mixins: [pi, Mi],
        props: {
            dropdown: String,
            mode: "list",
            align: String,
            offset: Number,
            boundary: Boolean,
            boundaryAlign: Boolean,
            clsDrop: String,
            delayShow: Number,
            delayHide: Number,
            dropbar: Boolean,
            dropbarMode: String,
            dropbarAnchor: Boolean,
            duration: Number
        },
        data: {
            dropdown: ".uk-navbar-nav > li",
            align: lt ? "right" : "left",
            clsDrop: "uk-navbar-dropdown",
            mode: void 0,
            offset: void 0,
            delayShow: void 0,
            delayHide: void 0,
            boundaryAlign: void 0,
            flip: "x",
            boundary: !0,
            dropbar: !1,
            dropbarMode: "slide",
            dropbarAnchor: !1,
            duration: 200,
            forceHeight: !0,
            selMinHeight: ".uk-navbar-nav > li > a, .uk-navbar-item, .uk-navbar-toggle"
        },
        computed: {
            boundary: function(t, e) {
                var n = t.boundary
                  , i = t.boundaryAlign;
                return !0 === n || i ? e : n
            },
            dropbarAnchor: function(t, e) {
                return yt(t.dropbarAnchor, e)
            },
            pos: function(t) {
                return "bottom-" + t.align
            },
            dropbar: {
                get: function(t) {
                    var e = t.dropbar;
                    return e ? (e = this._dropbar || yt(e, this.$el) || Ne("+ .uk-navbar-dropbar", this.$el)) || (this._dropbar = Ne("<div></div>")) : null
                },
                watch: function(t) {
                    De(t, "uk-navbar-dropbar")
                },
                immediate: !0
            },
            dropdowns: {
                get: function(t, e) {
                    return Me(t.dropdown + " ." + t.clsDrop, e)
                },
                watch: function(t) {
                    var e = this;
                    this.$create("drop", t.filter(function(t) {
                        return !e.getDropdown(t)
                    }), G({}, this.$props, {
                        boundary: this.boundary,
                        pos: this.pos,
                        offset: this.dropbar || this.offset
                    }))
                },
                immediate: !0
            }
        },
        disconnected: function() {
            this.dropbar && $e(this.dropbar),
            delete this._dropbar
        },
        events: [{
            name: "mouseover",
            delegate: function() {
                return this.dropdown
            },
            handler: function(t) {
                var e = t.current
                  , n = this.getActive();
                n && n.toggle && !qt(n.toggle.$el, e) && !n.tracker.movesTo(n.$el) && n.hide(!1)
            }
        }, {
            name: "mouseleave",
            el: function() {
                return this.dropbar
            },
            handler: function() {
                var t = this.getActive();
                t && !this.dropdowns.some(function(t) {
                    return zt(t, ":hover")
                }) && t.hide()
            }
        }, {
            name: "beforeshow",
            capture: !0,
            filter: function() {
                return this.dropbar
            },
            handler: function() {
                this.dropbar.parentNode || ye(this.dropbarAnchor || this.$el, this.dropbar)
            }
        }, {
            name: "show",
            filter: function() {
                return this.dropbar
            },
            handler: function(t, e) {
                var n = e.$el
                  , i = e.dir;
                "slide" === this.dropbarMode && De(this.dropbar, "uk-navbar-dropbar-slide"),
                this.clsDrop && De(n, this.clsDrop + "-dropbar"),
                "bottom" === i && this.transitionTo(n.offsetHeight + F(Re(n, "marginTop")) + F(Re(n, "marginBottom")), n)
            }
        }, {
            name: "beforehide",
            filter: function() {
                return this.dropbar
            },
            handler: function(t, e) {
                var n = e.$el
                  , i = this.getActive();
                zt(this.dropbar, ":hover") && i && i.$el === n && t.preventDefault()
            }
        }, {
            name: "hide",
            filter: function() {
                return this.dropbar
            },
            handler: function(t, e) {
                var n = e.$el
                  , i = this.getActive();
                (!i || i && i.$el === n) && this.transitionTo(0)
            }
        }],
        methods: {
            getActive: function() {
                var t = this.dropdowns.map(this.getDropdown).filter(function(t) {
                    return t && t.isActive()
                })[0];
                return t && b(t.mode, "hover") && qt(t.toggle.$el, this.$el) && t
            },
            transitionTo: function(t, e) {
                var n = this
                  , i = this.dropbar
                  , r = Ft(i) ? ln(i) : 0;
                return Re(e = r < t && e, "clip", "rect(0," + e.offsetWidth + "px," + r + "px,0)"),
                ln(i, r),
                Qe.cancel([e, i]),
                ae.all([Qe.start(i, {
                    height: t
                }, this.duration), Qe.start(e, {
                    clip: "rect(0," + e.offsetWidth + "px," + t + "px,0)"
                }, this.duration)]).catch(et).then(function() {
                    Re(e, {
                        clip: ""
                    }),
                    n.$update(i)
                })
            },
            getDropdown: function(t) {
                return this.$getComponent(t, "drop") || this.$getComponent(t, "dropdown")
            }
        }
    }
      , wr = {
        mixins: [fr],
        args: "mode",
        props: {
            mode: String,
            flip: Boolean,
            overlay: Boolean
        },
        data: {
            mode: "slide",
            flip: !1,
            overlay: !1,
            clsPage: "uk-offcanvas-page",
            clsContainer: "uk-offcanvas-container",
            selPanel: ".uk-offcanvas-bar",
            clsFlip: "uk-offcanvas-flip",
            clsContainerAnimation: "uk-offcanvas-container-animation",
            clsSidebarAnimation: "uk-offcanvas-bar-animation",
            clsMode: "uk-offcanvas",
            clsOverlay: "uk-offcanvas-overlay",
            selClose: ".uk-offcanvas-close",
            container: !1
        },
        computed: {
            clsFlip: function(t) {
                var e = t.flip
                  , n = t.clsFlip;
                return e ? n : ""
            },
            clsOverlay: function(t) {
                var e = t.overlay
                  , n = t.clsOverlay;
                return e ? n : ""
            },
            clsMode: function(t) {
                var e = t.mode;
                return t.clsMode + "-" + e
            },
            clsSidebarAnimation: function(t) {
                var e = t.mode
                  , n = t.clsSidebarAnimation;
                return "none" === e || "reveal" === e ? "" : n
            },
            clsContainerAnimation: function(t) {
                var e = t.mode
                  , n = t.clsContainerAnimation;
                return "push" !== e && "reveal" !== e ? "" : n
            },
            transitionElement: function(t) {
                return "reveal" === t.mode ? this.panel.parentNode : this.panel
            }
        },
        events: [{
            name: "click",
            delegate: function() {
                return 'a[href^="#"]'
            },
            handler: function(t) {
                var e = t.current.hash;
                !t.defaultPrevented && e && Ne(e, document.body) && this.hide()
            }
        }, {
            name: "touchstart",
            passive: !0,
            el: function() {
                return this.panel
            },
            handler: function(t) {
                var e = t.targetTouches;
                1 === e.length && (this.clientY = e[0].clientY)
            }
        }, {
            name: "touchmove",
            self: !0,
            passive: !1,
            filter: function() {
                return this.overlay
            },
            handler: function(t) {
                t.cancelable && t.preventDefault()
            }
        }, {
            name: "touchmove",
            passive: !1,
            el: function() {
                return this.panel
            },
            handler: function(t) {
                var e, n, i, r, o;
                1 === t.targetTouches.length && (e = event.targetTouches[0].clientY - this.clientY,
                i = (n = this.panel).scrollTop,
                ((r = n.scrollHeight) <= (o = n.clientHeight) || 0 === i && 0 < e || r - i <= o && e < 0) && t.cancelable && t.preventDefault())
            }
        }, {
            name: "show",
            self: !0,
            handler: function() {
                "reveal" !== this.mode || He(this.panel.parentNode, this.clsMode) || (Ie(this.panel, "<div>"),
                De(this.panel.parentNode, this.clsMode)),
                Re(document.documentElement, "overflowY", this.overlay ? "hidden" : ""),
                De(document.body, this.clsContainer, this.clsFlip),
                Re(document.body, "touch-action", "pan-y pinch-zoom"),
                Re(this.$el, "display", "block"),
                De(this.$el, this.clsOverlay),
                De(this.panel, this.clsSidebarAnimation, "reveal" !== this.mode ? this.clsMode : ""),
                ln(document.body),
                De(document.body, this.clsContainerAnimation),
                this.clsContainerAnimation && (br().content += ",user-scalable=0")
            }
        }, {
            name: "hide",
            self: !0,
            handler: function() {
                Be(document.body, this.clsContainerAnimation),
                Re(document.body, "touch-action", "")
            }
        }, {
            name: "hidden",
            self: !0,
            handler: function() {
                var t;
                this.clsContainerAnimation && ((t = br()).content = t.content.replace(/,user-scalable=0$/, "")),
                "reveal" === this.mode && Te(this.panel),
                Be(this.panel, this.clsSidebarAnimation, this.clsMode),
                Be(this.$el, this.clsOverlay),
                Re(this.$el, "display", ""),
                Be(document.body, this.clsContainer, this.clsFlip),
                Re(document.documentElement, "overflowY", "")
            }
        }, {
            name: "swipeLeft swipeRight",
            handler: function(t) {
                this.isToggled() && h(t.type, "Left") ^ this.flip && this.hide()
            }
        }]
    };
    function br() {
        return Ne('meta[name="viewport"]', document.head) || be(document.head, '<meta name="viewport">')
    }
    var xr = {
        mixins: [pi],
        props: {
            selContainer: String,
            selContent: String
        },
        data: {
            selContainer: ".uk-modal",
            selContent: ".uk-modal-dialog"
        },
        computed: {
            container: function(t, e) {
                return Bt(e, t.selContainer)
            },
            content: function(t, e) {
                return Bt(e, t.selContent)
            }
        },
        connected: function() {
            Re(this.$el, "minHeight", 150)
        },
        update: {
            read: function() {
                return !(!this.content || !this.container) && {
                    current: F(Re(this.$el, "maxHeight")),
                    max: Math.max(150, ln(this.container) - (an(this.content).height - ln(this.$el)))
                }
            },
            write: function(t) {
                var e = t.current
                  , n = t.max;
                Re(this.$el, "maxHeight", n),
                Math.round(e) !== Math.round(n) && Kt(this.$el, "resize")
            },
            events: ["resize"]
        }
    }
      , yr = {
        props: ["width", "height"],
        connected: function() {
            De(this.$el, "uk-responsive-width")
        },
        update: {
            read: function() {
                return !!(Ft(this.$el) && this.width && this.height) && {
                    width: dn(this.$el.parentNode),
                    height: this.height
                }
            },
            write: function(t) {
                ln(this.$el, rt.contain({
                    height: this.height,
                    width: this.width
                }, t).height)
            },
            events: ["resize"]
        }
    }
      , kr = {
        props: {
            offset: Number
        },
        data: {
            offset: 0
        },
        methods: {
            scrollTo: function(t) {
                var e = this;
                t = t && Ne(t) || document.body,
                Kt(this.$el, "beforescroll", [this, t]) && Un(t, {
                    offset: this.offset
                }).then(function() {
                    return Kt(e.$el, "scrolled", [e, t])
                })
            }
        },
        events: {
            click: function(t) {
                t.defaultPrevented || (t.preventDefault(),
                this.scrollTo(Ht(decodeURIComponent(this.$el.hash)).substr(1)))
            }
        }
    }
      , $r = "_ukScrollspy"
      , Ir = {
        args: "cls",
        props: {
            cls: String,
            target: String,
            hidden: Boolean,
            offsetTop: Number,
            offsetLeft: Number,
            repeat: Boolean,
            delay: Number
        },
        data: function() {
            return {
                cls: !1,
                target: !1,
                hidden: !0,
                offsetTop: 0,
                offsetLeft: 0,
                repeat: !1,
                delay: 0,
                inViewClass: "uk-scrollspy-inview"
            }
        },
        computed: {
            elements: {
                get: function(t, e) {
                    var n = t.target;
                    return n ? Me(n, e) : [e]
                },
                watch: function(t) {
                    this.hidden && Re(Rt(t, ":not(." + this.inViewClass + ")"), "visibility", "hidden")
                },
                immediate: !0
            }
        },
        update: [{
            read: function(t) {
                var e = this;
                t.update && this.elements.forEach(function(t) {
                    t[$r] || (t[$r] = {
                        cls: ut(t, "uk-scrollspy-class") || e.cls
                    }),
                    t[$r].show = Rn(t, e.offsetTop, e.offsetLeft)
                })
            },
            write: function(i) {
                var r = this;
                if (!i.update)
                    return this.$emit(),
                    i.update = !0;
                this.elements.forEach(function(e) {
                    function t(t) {
                        Re(e, "visibility", !t && r.hidden ? "hidden" : ""),
                        Le(e, r.inViewClass, t),
                        Le(e, n.cls),
                        Kt(e, t ? "inview" : "outview"),
                        n.inview = t,
                        r.$update(e)
                    }
                    var n = e[$r];
                    !n.show || n.inview || n.queued ? !n.show && n.inview && !n.queued && r.repeat && t(!1) : (n.queued = !0,
                    i.promise = (i.promise || ae.resolve()).then(function() {
                        return new ae(function(t) {
                            return setTimeout(t, r.delay)
                        }
                        )
                    }).then(function() {
                        t(!0),
                        setTimeout(function() {
                            n.queued = !1,
                            r.$emit()
                        }, 300)
                    }))
                })
            },
            events: ["scroll", "resize"]
        }]
    }
      , Sr = {
        props: {
            cls: String,
            closest: String,
            scroll: Boolean,
            overflow: Boolean,
            offset: Number
        },
        data: {
            cls: "uk-active",
            closest: !1,
            scroll: !1,
            overflow: !0,
            offset: 0
        },
        computed: {
            links: {
                get: function(t, e) {
                    return Me('a[href^="#"]', e).filter(function(t) {
                        return t.hash
                    })
                },
                watch: function(t) {
                    this.scroll && this.$create("scroll", t, {
                        offset: this.offset || 0
                    })
                },
                immediate: !0
            },
            targets: function() {
                return Me(this.links.map(function(t) {
                    return Ht(t.hash).substr(1)
                }).join(","))
            },
            elements: function(t) {
                var e = t.closest;
                return Bt(this.links, e || "*")
            }
        },
        update: [{
            read: function() {
                var n = this
                  , t = this.targets.length;
                if (!t || !Ft(this.$el))
                    return !1;
                var e = J(Xn(this.targets[0]))
                  , i = e.scrollTop
                  , r = e.scrollHeight
                  , o = Gn(e)
                  , s = r - an(o).height
                  , a = !1;
                return i === s ? a = t - 1 : (this.targets.every(function(t, e) {
                    if (hn(t, o).top - n.offset <= 0)
                        return a = e,
                        !0
                }),
                !1 === a && this.overflow && (a = 0)),
                {
                    active: a
                }
            },
            write: function(t) {
                var e = t.active;
                this.links.forEach(function(t) {
                    return t.blur()
                }),
                Be(this.elements, this.cls),
                !1 !== e && Kt(this.$el, "active", [e, De(this.elements[e], this.cls)])
            },
            events: ["scroll", "resize"]
        }]
    }
      , Tr = {
        mixins: [pi, hr],
        props: {
            top: null,
            bottom: Boolean,
            offset: String,
            animation: String,
            clsActive: String,
            clsInactive: String,
            clsFixed: String,
            clsBelow: String,
            selTarget: String,
            widthElement: Boolean,
            showOnUp: Boolean,
            targetOffset: Number
        },
        data: {
            top: 0,
            bottom: !1,
            offset: 0,
            animation: "",
            clsActive: "uk-active",
            clsInactive: "",
            clsFixed: "uk-sticky-fixed",
            clsBelow: "uk-sticky-below",
            selTarget: "",
            widthElement: !1,
            showOnUp: !1,
            targetOffset: !1
        },
        computed: {
            offset: function(t) {
                return bn(t.offset)
            },
            selTarget: function(t, e) {
                var n = t.selTarget;
                return n && Ne(n, e) || e
            },
            widthElement: function(t, e) {
                return yt(t.widthElement, e) || this.placeholder
            },
            isActive: {
                get: function() {
                    return He(this.selTarget, this.clsActive)
                },
                set: function(t) {
                    t && !this.isActive ? (Oe(this.selTarget, this.clsInactive, this.clsActive),
                    Kt(this.$el, "active")) : t || He(this.selTarget, this.clsInactive) || (Oe(this.selTarget, this.clsActive, this.clsInactive),
                    Kt(this.$el, "inactive"))
                }
            }
        },
        connected: function() {
            this.placeholder = Ne("+ .uk-sticky-placeholder", this.$el) || Ne('<div class="uk-sticky-placeholder"></div>'),
            this.isFixed = !1,
            this.isActive = !1
        },
        disconnected: function() {
            this.isFixed && (this.hide(),
            Be(this.selTarget, this.clsInactive)),
            $e(this.placeholder),
            this.placeholder = null,
            this.widthElement = null
        },
        events: [{
            name: "load hashchange popstate",
            el: ht && window,
            handler: function() {
                var i, r = this;
                !1 !== this.targetOffset && location.hash && 0 < window.pageYOffset && ((i = Ne(location.hash)) && yn.read(function() {
                    var t = an(i).top
                      , e = an(r.$el).top
                      , n = r.$el.offsetHeight;
                    r.isFixed && t <= e + n && e <= t + i.offsetHeight && qn(window, t - n - (P(r.targetOffset) ? r.targetOffset : 0) - r.offset)
                }))
            }
        }],
        update: [{
            read: function(t, e) {
                var n = t.height;
                if (this.inactive = !this.matchMedia || !Ft(this.$el),
                this.inactive)
                    return !1;
                this.isActive && "update" !== e && (this.hide(),
                n = this.$el.offsetHeight,
                this.show()),
                n = this.isActive ? n : this.$el.offsetHeight,
                this.topOffset = an(this.isFixed ? this.placeholder : this.$el).top,
                this.bottomOffset = this.topOffset + n;
                var i = Er("bottom", this);
                return this.top = Math.max(F(Er("top", this)), this.topOffset) - this.offset,
                this.bottom = i && i - this.$el.offsetHeight,
                this.width = an(Ft(this.widthElement) ? this.widthElement : this.$el).width,
                {
                    height: n,
                    top: cn(this.placeholder)[0],
                    margins: Re(this.$el, ["marginTop", "marginBottom", "marginLeft", "marginRight"])
                }
            },
            write: function(t) {
                var e = t.height
                  , n = t.margins
                  , i = this.placeholder;
                Re(i, G({
                    height: e
                }, n)),
                qt(i, document) || (ye(this.$el, i),
                ot(i, "hidden", "")),
                this.isActive = !!this.isActive
            },
            events: ["resize"]
        }, {
            read: function(t) {
                var e = t.scroll;
                return void 0 === e && (e = 0),
                this.scroll = window.pageYOffset,
                {
                    dir: e <= this.scroll ? "down" : "up",
                    scroll: this.scroll
                }
            },
            write: function(t, e) {
                var n = this
                  , i = Date.now()
                  , r = t.initTimestamp;
                void 0 === r && (r = 0);
                var o = t.dir
                  , s = t.lastDir
                  , a = t.lastScroll
                  , u = t.scroll
                  , h = t.top;
                if (!((t.lastScroll = u) < 0 || u === a && "scroll" === e || this.showOnUp && "scroll" !== e && !this.isFixed || ((300 < i - r || o !== s) && (t.initScroll = u,
                t.initTimestamp = i),
                t.lastDir = o,
                this.showOnUp && !this.isFixed && Math.abs(t.initScroll - u) <= 30 && Math.abs(a - u) <= 10)))
                    if (this.inactive || u < this.top || this.showOnUp && (u <= this.top || "down" === o && "scroll" === e || "up" === o && !this.isFixed && u <= this.bottomOffset)) {
                        if (!this.isFixed)
                            return void (rn.inProgress(this.$el) && u < h && (rn.cancel(this.$el),
                            this.hide()));
                        this.isFixed = !1,
                        this.animation && u > this.topOffset ? (rn.cancel(this.$el),
                        rn.out(this.$el, this.animation).then(function() {
                            return n.hide()
                        }, et)) : this.hide()
                    } else
                        this.isFixed ? this.update() : this.animation ? (rn.cancel(this.$el),
                        this.show(),
                        rn.in(this.$el, this.animation).catch(et)) : this.show()
            },
            events: ["resize", "scroll"]
        }],
        methods: {
            show: function() {
                this.isFixed = !0,
                this.update(),
                ot(this.placeholder, "hidden", null)
            },
            hide: function() {
                this.isActive = !1,
                Be(this.$el, this.clsFixed, this.clsBelow),
                Re(this.$el, {
                    position: "",
                    top: "",
                    width: ""
                }),
                ot(this.placeholder, "hidden", "")
            },
            update: function() {
                var t = 0 !== this.top || this.scroll > this.top
                  , e = Math.max(0, this.offset);
                P(this.bottom) && this.scroll > this.bottom - this.offset && (e = this.bottom - this.scroll),
                Re(this.$el, {
                    position: "fixed",
                    top: e + "px",
                    width: this.width
                }),
                this.isActive = t,
                Le(this.$el, this.clsBelow, this.scroll > this.bottomOffset),
                De(this.$el, this.clsFixed)
            }
        }
    };
    function Er(t, e) {
        var n = e.$props
          , i = e.$el
          , r = e[t + "Offset"]
          , o = n[t];
        if (o)
            return D(o) && o.match(/^-?\d/) ? r + bn(o) : an(!0 === o ? i.parentNode : yt(o, i)).bottom
    }
    var _r, Cr, Ar, Nr = {
        mixins: [gi],
        args: "connect",
        props: {
            connect: String,
            toggle: String,
            active: Number,
            swiping: Boolean
        },
        data: {
            connect: "~.uk-switcher",
            toggle: "> * > :first-child",
            active: 0,
            swiping: !0,
            cls: "uk-active",
            clsContainer: "uk-switcher",
            attrItem: "uk-switcher-item"
        },
        computed: {
            connects: {
                get: function(t, e) {
                    return kt(t.connect, e)
                },
                watch: function(t) {
                    var e = this;
                    t.forEach(function(t) {
                        return e.updateAria(t.children)
                    }),
                    this.swiping && Re(t, "touch-action", "pan-y pinch-zoom")
                },
                immediate: !0
            },
            toggles: {
                get: function(t, e) {
                    return Me(t.toggle, e).filter(function(t) {
                        return !zt(t, ".uk-disabled *, .uk-disabled, [disabled]")
                    })
                },
                watch: function(t) {
                    var e = this.index();
                    this.show(~e && e || t[this.active] || t[0])
                },
                immediate: !0
            },
            children: function() {
                var t = this;
                return Yt(this.$el).filter(function(e) {
                    return t.toggles.some(function(t) {
                        return qt(t, e)
                    })
                })
            }
        },
        events: [{
            name: "click",
            delegate: function() {
                return this.toggle
            },
            handler: function(t) {
                b(this.toggles, t.current) && (t.preventDefault(),
                this.show(t.current))
            }
        }, {
            name: "click",
            el: function() {
                return this.connects
            },
            delegate: function() {
                return "[" + this.attrItem + "],[data-" + this.attrItem + "]"
            },
            handler: function(t) {
                t.preventDefault(),
                this.show(ut(t.current, this.attrItem))
            }
        }, {
            name: "swipeRight swipeLeft",
            filter: function() {
                return this.swiping
            },
            el: function() {
                return this.connects
            },
            handler: function(t) {
                var e = t.type;
                this.show(h(e, "Left") ? "next" : "previous")
            }
        }],
        methods: {
            index: function() {
                var e = this;
                return y(this.children, function(t) {
                    return He(t, e.cls)
                })
            },
            show: function(t) {
                var n = this
                  , i = this.index()
                  , r = me(t, this.toggles, i);
                i !== r && (this.children.forEach(function(t, e) {
                    Le(t, n.cls, r === e),
                    ot(n.toggles[e], "aria-expanded", r === e)
                }),
                this.connects.forEach(function(t) {
                    var e = t.children;
                    return n.toggleElement(V(e).filter(function(t, e) {
                        return e !== r && n.isToggled(t)
                    }), !1, 0 <= i).then(function() {
                        return n.toggleElement(e[r], !0, 0 <= i)
                    })
                }))
            }
        }
    }, Mr = {
        mixins: [pi],
        extends: Nr,
        props: {
            media: Boolean
        },
        data: {
            media: 960,
            attrItem: "uk-tab-item"
        },
        connected: function() {
            var t = He(this.$el, "uk-tab-left") ? "uk-tab-left" : !!He(this.$el, "uk-tab-right") && "uk-tab-right";
            t && this.$create("toggle", this.$el, {
                cls: t,
                mode: "media",
                media: this.media
            })
        }
    }, zr = {
        mixins: [hr, gi],
        args: "target",
        props: {
            href: String,
            target: null,
            mode: "list",
            queued: Boolean
        },
        data: {
            href: !1,
            target: !1,
            mode: "click",
            queued: !0
        },
        computed: {
            target: {
                get: function(t, e) {
                    var n = t.href
                      , i = t.target;
                    return (i = kt(i || n, e)).length && i || [e]
                },
                watch: function() {
                    Kt(this.target, "updatearia", [this])
                },
                immediate: !0
            }
        },
        events: [{
            name: wt + " " + bt,
            filter: function() {
                return b(this.mode, "hover")
            },
            handler: function(t) {
                re(t) || this.toggle("toggle" + (t.type === wt ? "show" : "hide"))
            }
        }, {
            name: "click",
            filter: function() {
                return b(this.mode, "click") || pt && b(this.mode, "hover")
            },
            handler: function(t) {
                var e;
                (Bt(t.target, 'a[href="#"], a[href=""]') || (e = Bt(t.target, "a[href]")) && (this.cls && !He(this.target, this.cls.split(" ")[0]) || !Ft(this.target) || e.hash && zt(this.target, e.hash))) && t.preventDefault(),
                this.toggle()
            }
        }],
        update: {
            read: function() {
                return !(!b(this.mode, "media") || !this.media) && {
                    match: this.matchMedia
                }
            },
            write: function(t) {
                var e = t.match
                  , n = this.isToggled(this.target);
                (e ? !n : n) && this.toggle()
            },
            events: ["resize"]
        },
        methods: {
            toggle: function(t) {
                var e, n = this;
                Kt(this.target, t || "toggle", [this]) && (this.queued ? (e = this.target.filter(this.isToggled),
                this.toggleElement(e, !1).then(function() {
                    return n.toggleElement(n.target.filter(function(t) {
                        return !b(e, t)
                    }), !0)
                })) : this.toggleElement(this.target))
            }
        }
    };
    K(Object.freeze({
        __proto__: null,
        Accordion: vi,
        Alert: bi,
        Cover: yi,
        Drop: Ii,
        Dropdown: Ii,
        FormCustom: Si,
        Gif: Ti,
        Grid: Ni,
        HeightMatch: zi,
        HeightViewport: Pi,
        Icon: qi,
        Img: Zi,
        Leader: cr,
        Margin: Ei,
        Modal: gr,
        Nav: mr,
        Navbar: vr,
        Offcanvas: wr,
        OverflowAuto: xr,
        Responsive: yr,
        Scroll: kr,
        Scrollspy: Ir,
        ScrollspyNav: Sr,
        Sticky: Tr,
        Svg: Hi,
        Switcher: Nr,
        Tab: Mr,
        Toggle: zr,
        Video: xi,
        Close: Gi,
        Spinner: Ji,
        SlidenavNext: Yi,
        SlidenavPrevious: Yi,
        SearchIcon: Xi,
        Marker: Ui,
        NavbarToggleIcon: Ui,
        OverlayIcon: Ui,
        PaginationNext: Ui,
        PaginationPrevious: Ui,
        Totop: Ui
    }), function(t, e) {
        return ti.component(e, t)
    }),
    ti.use(function(r) {
        ht && pe(function() {
            var e;
            r.update(),
            Xt(window, "load resize", function() {
                return r.update(null, "resize")
            }),
            Xt(document, "loadedmetadata load", function(t) {
                var e = t.target;
                return r.update(e, "resize")
            }, !0),
            Xt(window, "scroll", function(t) {
                e || (e = !0,
                yn.write(function() {
                    return e = !1
                }),
                r.update(null, t.type))
            }, {
                passive: !0,
                capture: !0
            });
            var n, i = 0;
            Xt(document, "animationstart", function(t) {
                var e = t.target;
                (Re(e, "animationName") || "").match(/^uk-.*(left|right)/) && (i++,
                Re(document.body, "overflowX", "hidden"),
                setTimeout(function() {
                    --i || Re(document.body, "overflowX", "")
                }, U(Re(e, "animationDuration")) + 100))
            }, !0),
            Xt(document, gt, function(t) {
                var s, a;
                n && n(),
                re(t) && (s = oe(t),
                a = "tagName"in t.target ? t.target : t.target.parentNode,
                n = Jt(document, vt + " " + xt, function(t) {
                    var e = oe(t)
                      , r = e.x
                      , o = e.y;
                    (a && r && 100 < Math.abs(s.x - r) || o && 100 < Math.abs(s.y - o)) && setTimeout(function() {
                        var t, e, n, i;
                        Kt(a, "swipe"),
                        Kt(a, "swipe" + (t = s.x,
                        e = s.y,
                        n = r,
                        i = o,
                        Math.abs(t - n) >= Math.abs(e - i) ? 0 < t - n ? "Left" : "Right" : 0 < e - i ? "Up" : "Down"))
                    })
                }))
            }, {
                passive: !0
            })
        })
    }),
    Cr = (_r = ti).connect,
    Ar = _r.disconnect,
    ht && window.MutationObserver && yn.read(function() {
        document.body && Ae(document.body, Cr);
        new MutationObserver(function(t) {
            var r = [];
            t.forEach(function(t) {
                return n = r,
                i = (e = t).target,
                void (("attributes" !== e.type ? function(t) {
                    for (var e = t.addedNodes, n = t.removedNodes, i = 0; i < e.length; i++)
                        Ae(e[i], Cr);
                    for (var r = 0; r < n.length; r++)
                        Ae(n[r], Ar);
                    return 1
                }
                : function(t) {
                    var e = t.target
                      , n = t.attributeName;
                    if ("href" === n)
                        return 1;
                    var i = Qn(n);
                    if (!(i && i in _r))
                        return;
                    if (st(e, n))
                        return _r[i](e),
                        1;
                    var r = _r.getComponent(e, i);
                    if (r)
                        return r.$destroy(),
                        1
                }
                )(e) && !n.some(function(t) {
                    return t.contains(i)
                }) && n.push(i.contains ? i : i.parentNode));
                var e, n, i
            }),
            r.forEach(function(t) {
                return _r.update(t)
            })
        }
        ).observe(document, {
            childList: !0,
            subtree: !0,
            characterData: !0,
            attributes: !0
        }),
        _r._initialized = !0
    });
    var Dr = {
        mixins: [pi],
        props: {
            date: String,
            clsWrapper: String
        },
        data: {
            date: "",
            clsWrapper: ".uk-countdown-%unit%"
        },
        computed: {
            date: function(t) {
                var e = t.date;
                return Date.parse(e)
            },
            days: function(t, e) {
                return Ne(t.clsWrapper.replace("%unit%", "days"), e)
            },
            hours: function(t, e) {
                return Ne(t.clsWrapper.replace("%unit%", "hours"), e)
            },
            minutes: function(t, e) {
                return Ne(t.clsWrapper.replace("%unit%", "minutes"), e)
            },
            seconds: function(t, e) {
                return Ne(t.clsWrapper.replace("%unit%", "seconds"), e)
            },
            units: function() {
                var e = this;
                return ["days", "hours", "minutes", "seconds"].filter(function(t) {
                    return e[t]
                })
            }
        },
        connected: function() {
            this.start()
        },
        disconnected: function() {
            var e = this;
            this.stop(),
            this.units.forEach(function(t) {
                return ve(e[t])
            })
        },
        events: [{
            name: "visibilitychange",
            el: ht && document,
            handler: function() {
                document.hidden ? this.stop() : this.start()
            }
        }],
        update: {
            write: function() {
                var t, e, i = this, r = (t = this.date,
                {
                    total: e = t - Date.now(),
                    seconds: e / 1e3 % 60,
                    minutes: e / 1e3 / 60 % 60,
                    hours: e / 1e3 / 60 / 60 % 24,
                    days: e / 1e3 / 60 / 60 / 24
                });
                r.total <= 0 && (this.stop(),
                r.days = r.hours = r.minutes = r.seconds = 0),
                this.units.forEach(function(t) {
                    var e = (e = String(Math.floor(r[t]))).length < 2 ? "0" + e : e
                      , n = i[t];
                    n.textContent !== e && ((e = e.split("")).length !== n.children.length && we(n, e.map(function() {
                        return "<span></span>"
                    }).join("")),
                    e.forEach(function(t, e) {
                        return n.children[e].textContent = t
                    }))
                })
            }
        },
        methods: {
            start: function() {
                this.stop(),
                this.date && this.units.length && (this.$update(),
                this.timer = setInterval(this.$update, 1e3))
            },
            stop: function() {
                this.timer && (clearInterval(this.timer),
                this.timer = null)
            }
        }
    };
    var Br, Pr = "uk-animation-target", Or = {
        props: {
            animation: Number
        },
        data: {
            animation: 150
        },
        methods: {
            animate: function(t, i) {
                var n = this;
                void 0 === i && (i = this.$el),
                function() {
                    if (Br)
                        return;
                    (Br = be(document.head, "<style>").sheet).insertRule("." + Pr + " > * {\n            margin-top: 0 !important;\n            transform: none !important;\n        }", 0)
                }();
                var r = Yt(i)
                  , o = r.map(function(t) {
                    return Hr(t, !0)
                })
                  , e = ln(i)
                  , s = window.pageYOffset;
                t(),
                Qe.cancel(i),
                r.forEach(Qe.cancel),
                Lr(i),
                this.$update(i, "resize"),
                yn.flush();
                var a = ln(i)
                  , u = (r = r.concat(Yt(i).filter(function(t) {
                    return !b(r, t)
                }))).map(function(t, e) {
                    return !!(t.parentNode && e in o) && (o[e] ? Ft(t) ? jr(t) : {
                        opacity: 0
                    } : {
                        opacity: Ft(t) ? 1 : 0
                    })
                })
                  , o = u.map(function(t, e) {
                    var n = r[e].parentNode === i && (o[e] || Hr(r[e]));
                    return n && (t ? "opacity"in t || (n.opacity % 1 ? t.opacity = 1 : delete n.opacity) : delete n.opacity),
                    n
                });
                return De(i, Pr),
                r.forEach(function(t, e) {
                    return o[e] && Re(t, o[e])
                }),
                Re(i, {
                    height: e,
                    display: "block"
                }),
                qn(window, s),
                ae.all(r.map(function(t, e) {
                    return ["top", "left", "height", "width"].some(function(t) {
                        return o[e][t] !== u[e][t]
                    }) && Qe.start(t, u[e], n.animation, "ease")
                }).concat(e !== a && Qe.start(i, {
                    height: a
                }, this.animation, "ease"))).then(function() {
                    r.forEach(function(t, e) {
                        return Re(t, {
                            display: 0 === u[e].opacity ? "none" : "",
                            zIndex: ""
                        })
                    }),
                    Lr(i),
                    n.$update(i, "resize"),
                    yn.flush()
                }, et)
            }
        }
    };
    function Hr(t, e) {
        var n = Re(t, "zIndex");
        return !!Ft(t) && G({
            display: "",
            opacity: e ? Re(t, "opacity") : "0",
            pointerEvents: "none",
            position: "absolute",
            zIndex: "auto" === n ? ge(t) : n
        }, jr(t))
    }
    function Lr(t) {
        Re(t.children, {
            height: "",
            left: "",
            opacity: "",
            pointerEvents: "",
            position: "",
            top: "",
            width: ""
        }),
        Be(t, Pr),
        Re(t, {
            height: "",
            display: ""
        })
    }
    function jr(t) {
        var e = an(t)
          , n = e.height
          , i = e.width
          , r = hn(t);
        return {
            top: r.top,
            left: r.left,
            height: n,
            width: i
        }
    }
    var Fr = {
        mixins: [Or],
        args: "target",
        props: {
            target: Boolean,
            selActive: Boolean
        },
        data: {
            target: null,
            selActive: !1,
            attrItem: "uk-filter-control",
            cls: "uk-active",
            animation: 250
        },
        computed: {
            toggles: {
                get: function(t, e) {
                    t.attrItem;
                    return Me("[" + this.attrItem + "],[data-" + this.attrItem + "]", e)
                },
                watch: function() {
                    var e, n = this;
                    this.updateState(),
                    !1 !== this.selActive && (e = Me(this.selActive, this.$el),
                    this.toggles.forEach(function(t) {
                        return Le(t, n.cls, b(e, t))
                    }))
                },
                immediate: !0
            },
            children: {
                get: function(t, e) {
                    return Me(t.target + " > *", e)
                },
                watch: function(t, e) {
                    var n, i;
                    i = e,
                    (n = t).length === i.length && n.every(function(t) {
                        return ~i.indexOf(t)
                    }) || this.updateState()
                }
            }
        },
        events: [{
            name: "click",
            delegate: function() {
                return "[" + this.attrItem + "],[data-" + this.attrItem + "]"
            },
            handler: function(t) {
                t.preventDefault(),
                this.apply(t.current)
            }
        }],
        methods: {
            apply: function(t) {
                this.setState(Rr(t, this.attrItem, this.getState()))
            },
            getState: function() {
                var n = this;
                return this.toggles.filter(function(t) {
                    return He(t, n.cls)
                }).reduce(function(t, e) {
                    return Rr(e, n.attrItem, t)
                }, {
                    filter: {
                        "": ""
                    },
                    sort: []
                })
            },
            setState: function(n, i) {
                var r = this;
                void 0 === i && (i = !0),
                n = G({
                    filter: {
                        "": ""
                    },
                    sort: []
                }, n),
                Kt(this.$el, "beforeFilter", [this, n]),
                this.toggles.forEach(function(t) {
                    return Le(t, r.cls, !!function(t, e, n) {
                        var i = n.filter;
                        void 0 === i && (i = {
                            "": ""
                        });
                        var r = n.sort
                          , o = r[0]
                          , s = r[1]
                          , a = Wr(t, e)
                          , u = a.filter;
                        void 0 === u && (u = "");
                        var h = a.group;
                        void 0 === h && (h = "");
                        var c = a.sort
                          , l = a.order;
                        void 0 === l && (l = "asc");
                        return H(c) ? h in i && u === i[h] || !u && h && !(h in i) && !i[""] : o === c && s === l
                    }(t, r.attrItem, n))
                }),
                ae.all(Me(this.target, this.$el).map(function(t) {
                    var e = Yt(t);
                    return i ? r.animate(function() {
                        return Vr(n, t, e)
                    }, t) : Vr(n, t, e)
                })).then(function() {
                    return Kt(r.$el, "afterFilter", [r])
                })
            },
            updateState: function() {
                var t = this;
                yn.write(function() {
                    return t.setState(t.getState(), !1)
                })
            }
        }
    };
    function Wr(t, e) {
        return Mn(ut(t, e), ["filter"])
    }
    function Vr(t, e, n) {
        var i, r, o = (i = t.filter,
        r = "",
        K(i, function(t) {
            return r += t || ""
        }),
        r);
        n.forEach(function(t) {
            return Re(t, "display", o && !zt(t, o) ? "none" : "")
        });
        var s, a, u, h = t.sort, c = h[0], l = h[1];
        c && (a = c,
        u = l,
        Y(s = G([], n).sort(function(t, e) {
            return ut(t, a).localeCompare(ut(e, a), void 0, {
                numeric: !0
            }) * ("asc" === u || -1)
        }), n) || be(e, s))
    }
    function Rr(t, e, n) {
        var i = Wr(t, e)
          , r = i.filter
          , o = i.group
          , s = i.sort
          , a = i.order;
        return void 0 === a && (a = "asc"),
        (r || H(s)) && (o ? r ? (delete n.filter[""],
        n.filter[o] = r) : (delete n.filter[o],
        (O(n.filter) || ""in n.filter) && (n.filter = {
            "": r || ""
        })) : n.filter = {
            "": r || ""
        }),
        H(s) || (n.sort = [s, a]),
        n
    }
    var qr = {
        slide: {
            show: function(t) {
                return [{
                    transform: Yr(-100 * t)
                }, {
                    transform: Yr()
                }]
            },
            percent: Ur,
            translate: function(t, e) {
                return [{
                    transform: Yr(-100 * e * t)
                }, {
                    transform: Yr(100 * e * (1 - t))
                }]
            }
        }
    };
    function Ur(t) {
        return Math.abs(Re(t, "transform").split(",")[4] / t.offsetWidth) || 0
    }
    function Yr(t, e) {
        return void 0 === t && (t = 0),
        void 0 === e && (e = "%"),
        t += t ? e : "",
        ct ? "translateX(" + t + ")" : "translate3d(" + t + ", 0, 0)"
    }
    function Xr(t) {
        return "scale3d(" + t + ", " + t + ", 1)"
    }
    var Gr = G({}, qr, {
        fade: {
            show: function() {
                return [{
                    opacity: 0
                }, {
                    opacity: 1
                }]
            },
            percent: function(t) {
                return 1 - Re(t, "opacity")
            },
            translate: function(t) {
                return [{
                    opacity: 1 - t
                }, {
                    opacity: t
                }]
            }
        },
        scale: {
            show: function() {
                return [{
                    opacity: 0,
                    transform: Xr(.8)
                }, {
                    opacity: 1,
                    transform: Xr(1)
                }]
            },
            percent: function(t) {
                return 1 - Re(t, "opacity")
            },
            translate: function(t) {
                return [{
                    opacity: 1 - t,
                    transform: Xr(1 - .2 * t)
                }, {
                    opacity: t,
                    transform: Xr(.8 + .2 * t)
                }]
            }
        }
    });
    function Jr(t, e, n) {
        Kt(t, Zt(e, !1, !1, n))
    }
    var Kr = {
        mixins: [{
            props: {
                autoplay: Boolean,
                autoplayInterval: Number,
                pauseOnHover: Boolean
            },
            data: {
                autoplay: !1,
                autoplayInterval: 7e3,
                pauseOnHover: !0
            },
            connected: function() {
                this.autoplay && this.startAutoplay()
            },
            disconnected: function() {
                this.stopAutoplay()
            },
            update: function() {
                ot(this.slides, "tabindex", "-1")
            },
            events: [{
                name: "visibilitychange",
                el: ht && document,
                filter: function() {
                    return this.autoplay
                },
                handler: function() {
                    document.hidden ? this.stopAutoplay() : this.startAutoplay()
                }
            }],
            methods: {
                startAutoplay: function() {
                    var t = this;
                    this.stopAutoplay(),
                    this.interval = setInterval(function() {
                        return (!t.draggable || !Ne(":focus", t.$el)) && (!t.pauseOnHover || !zt(t.$el, ":hover")) && !t.stack.length && t.show("next")
                    }, this.autoplayInterval)
                },
                stopAutoplay: function() {
                    this.interval && clearInterval(this.interval)
                }
            }
        }, {
            props: {
                draggable: Boolean
            },
            data: {
                draggable: !0,
                threshold: 10
            },
            created: function() {
                var i = this;
                ["start", "move", "end"].forEach(function(t) {
                    var n = i[t];
                    i[t] = function(t) {
                        var e = oe(t).x * (lt ? -1 : 1);
                        i.prevPos = e !== i.pos ? i.pos : i.prevPos,
                        i.pos = e,
                        n(t)
                    }
                })
            },
            events: [{
                name: gt,
                delegate: function() {
                    return this.selSlides
                },
                handler: function(t) {
                    var e;
                    !this.draggable || !re(t) && (!(e = t.target).children.length && e.childNodes.length) || Bt(t.target, Wt) || 0 < t.button || this.length < 2 || this.start(t)
                }
            }, {
                name: "dragstart",
                handler: function(t) {
                    t.preventDefault()
                }
            }],
            methods: {
                start: function() {
                    this.drag = this.pos,
                    this._transitioner ? (this.percent = this._transitioner.percent(),
                    this.drag += this._transitioner.getDistance() * this.percent * this.dir,
                    this._transitioner.cancel(),
                    this._transitioner.translate(this.percent),
                    this.dragging = !0,
                    this.stack = []) : this.prevIndex = this.index,
                    Xt(document, mt, this.move, {
                        passive: !1
                    }),
                    Xt(document, vt + " " + xt, this.end, !0),
                    Re(this.list, "userSelect", "none")
                },
                move: function(t) {
                    var e = this
                      , n = this.pos - this.drag;
                    if (!(0 == n || this.prevPos === this.pos || !this.dragging && Math.abs(n) < this.threshold)) {
                        Re(this.list, "pointerEvents", "none"),
                        t.cancelable && t.preventDefault(),
                        this.dragging = !0,
                        this.dir = n < 0 ? 1 : -1;
                        for (var i = this.slides, r = this.prevIndex, o = Math.abs(n), s = this.getIndex(r + this.dir, r), a = this._getDistance(r, s) || i[r].offsetWidth; s !== r && a < o; )
                            this.drag -= a * this.dir,
                            r = s,
                            o -= a,
                            s = this.getIndex(r + this.dir, r),
                            a = this._getDistance(r, s) || i[r].offsetWidth;
                        this.percent = o / a;
                        var u, h = i[r], c = i[s], l = this.index !== s, d = r === s;
                        [this.index, this.prevIndex].filter(function(t) {
                            return !b([s, r], t)
                        }).forEach(function(t) {
                            Kt(i[t], "itemhidden", [e]),
                            d && (u = !0,
                            e.prevIndex = r)
                        }),
                        (this.index === r && this.prevIndex !== r || u) && Kt(i[this.index], "itemshown", [this]),
                        l && (this.prevIndex = r,
                        this.index = s,
                        d || Kt(h, "beforeitemhide", [this]),
                        Kt(c, "beforeitemshow", [this])),
                        this._transitioner = this._translate(Math.abs(this.percent), h, !d && c),
                        l && (d || Kt(h, "itemhide", [this]),
                        Kt(c, "itemshow", [this]))
                    }
                },
                end: function() {
                    var t;
                    Gt(document, mt, this.move, {
                        passive: !1
                    }),
                    Gt(document, vt + " " + xt, this.end, !0),
                    this.dragging && (this.dragging = null,
                    this.index === this.prevIndex ? (this.percent = 1 - this.percent,
                    this.dir *= -1,
                    this._show(!1, this.index, !0),
                    this._transitioner = null) : (t = (lt ? this.dir * (lt ? 1 : -1) : this.dir) < 0 == this.prevPos > this.pos,
                    this.index = t ? this.index : this.prevIndex,
                    t && (this.percent = 1 - this.percent),
                    this.show(0 < this.dir && !t || this.dir < 0 && t ? "next" : "previous", !0))),
                    Re(this.list, {
                        userSelect: "",
                        pointerEvents: ""
                    }),
                    this.drag = this.percent = null
                }
            }
        }, {
            data: {
                selNav: !1
            },
            computed: {
                nav: function(t, e) {
                    return Ne(t.selNav, e)
                },
                selNavItem: function(t) {
                    var e = t.attrItem;
                    return "[" + e + "],[data-" + e + "]"
                },
                navItems: function(t, e) {
                    return Me(this.selNavItem, e)
                }
            },
            update: {
                write: function() {
                    var n = this;
                    this.nav && this.length !== this.nav.children.length && we(this.nav, this.slides.map(function(t, e) {
                        return "<li " + n.attrItem + '="' + e + '"><a href></a></li>'
                    }).join("")),
                    Le(Me(this.selNavItem, this.$el).concat(this.nav), "uk-hidden", !this.maxIndex),
                    this.updateNav()
                },
                events: ["resize"]
            },
            events: [{
                name: "click",
                delegate: function() {
                    return this.selNavItem
                },
                handler: function(t) {
                    t.preventDefault(),
                    this.show(ut(t.current, this.attrItem))
                }
            }, {
                name: "itemshow",
                handler: "updateNav"
            }],
            methods: {
                updateNav: function() {
                    var n = this
                      , i = this.getValidIndex();
                    this.navItems.forEach(function(t) {
                        var e = ut(t, n.attrItem);
                        Le(t, n.clsActive, j(e) === i),
                        Le(t, "uk-invisible", n.finite && ("previous" === e && 0 === i || "next" === e && i >= n.maxIndex))
                    })
                }
            }
        }],
        props: {
            clsActivated: Boolean,
            easing: String,
            index: Number,
            finite: Boolean,
            velocity: Number,
            selSlides: String
        },
        data: function() {
            return {
                easing: "ease",
                finite: !1,
                velocity: 1,
                index: 0,
                prevIndex: -1,
                stack: [],
                percent: 0,
                clsActive: "uk-active",
                clsActivated: !1,
                Transitioner: !1,
                transitionOptions: {}
            }
        },
        connected: function() {
            this.prevIndex = -1,
            this.index = this.getValidIndex(this.index),
            this.stack = []
        },
        disconnected: function() {
            Be(this.slides, this.clsActive)
        },
        computed: {
            duration: function(t, e) {
                var n = t.velocity;
                return Zr(e.offsetWidth / n)
            },
            list: function(t, e) {
                return Ne(t.selList, e)
            },
            maxIndex: function() {
                return this.length - 1
            },
            selSlides: function(t) {
                return t.selList + " " + (t.selSlides || "> *")
            },
            slides: {
                get: function() {
                    return Me(this.selSlides, this.$el)
                },
                watch: function() {
                    this.$reset()
                }
            },
            length: function() {
                return this.slides.length
            }
        },
        events: {
            itemshown: function() {
                this.$update(this.list)
            }
        },
        methods: {
            show: function(t, e) {
                var n = this;
                if (void 0 === e && (e = !1),
                !this.dragging && this.length) {
                    var i = this.stack
                      , r = e ? 0 : i.length
                      , o = function() {
                        i.splice(r, 1),
                        i.length && n.show(i.shift(), !0)
                    };
                    if (i[e ? "unshift" : "push"](t),
                    !e && 1 < i.length)
                        2 === i.length && this._transitioner.forward(Math.min(this.duration, 200));
                    else {
                        var s, a, u = this.getIndex(this.index), h = He(this.slides, this.clsActive) && this.slides[u], c = this.getIndex(t, this.index), l = this.slides[c];
                        if (h !== l) {
                            if (this.dir = (a = u,
                            "next" !== (s = t) && ("previous" === s || s < a) ? -1 : 1),
                            this.prevIndex = u,
                            this.index = c,
                            h && !Kt(h, "beforeitemhide", [this]) || !Kt(l, "beforeitemshow", [this, h]))
                                return this.index = this.prevIndex,
                                void o();
                            var d = this._show(h, l, e).then(function() {
                                return h && Kt(h, "itemhidden", [n]),
                                Kt(l, "itemshown", [n]),
                                new ae(function(t) {
                                    yn.write(function() {
                                        i.shift(),
                                        i.length ? n.show(i.shift(), !0) : n._transitioner = null,
                                        t()
                                    })
                                }
                                )
                            });
                            return h && Kt(h, "itemhide", [this]),
                            Kt(l, "itemshow", [this]),
                            d
                        }
                        o()
                    }
                }
            },
            getIndex: function(t, e) {
                return void 0 === t && (t = this.index),
                void 0 === e && (e = this.index),
                tt(me(t, this.slides, e, this.finite), 0, this.maxIndex)
            },
            getValidIndex: function(t, e) {
                return void 0 === t && (t = this.index),
                void 0 === e && (e = this.prevIndex),
                this.getIndex(t, e)
            },
            _show: function(t, e, n) {
                if (this._transitioner = this._getTransitioner(t, e, this.dir, G({
                    easing: n ? e.offsetWidth < 600 ? "cubic-bezier(0.25, 0.46, 0.45, 0.94)" : "cubic-bezier(0.165, 0.84, 0.44, 1)" : this.easing
                }, this.transitionOptions)),
                !n && !t)
                    return this._translate(1),
                    ae.resolve();
                var i = this.stack.length;
                return this._transitioner[1 < i ? "forward" : "show"](1 < i ? Math.min(this.duration, 75 + 75 / (i - 1)) : this.duration, this.percent)
            },
            _getDistance: function(t, e) {
                return this._getTransitioner(t, t !== e && e).getDistance()
            },
            _translate: function(t, e, n) {
                void 0 === e && (e = this.prevIndex),
                void 0 === n && (n = this.index);
                var i = this._getTransitioner(e !== n && e, n);
                return i.translate(t),
                i
            },
            _getTransitioner: function(t, e, n, i) {
                return void 0 === t && (t = this.prevIndex),
                void 0 === e && (e = this.index),
                void 0 === n && (n = this.dir || 1),
                void 0 === i && (i = this.transitionOptions),
                new this.Transitioner(B(t) ? this.slides[t] : t,B(e) ? this.slides[e] : e,n * (lt ? -1 : 1),i)
            }
        }
    };
    function Zr(t) {
        return .5 * t + 300
    }
    var Qr = {
        mixins: [Kr],
        props: {
            animation: String
        },
        data: {
            animation: "slide",
            clsActivated: "uk-transition-active",
            Animations: qr,
            Transitioner: function(o, s, a, t) {
                var e = t.animation
                  , u = t.easing
                  , n = e.percent
                  , i = e.translate
                  , r = e.show;
                void 0 === r && (r = et);
                var h = r(a)
                  , c = new se;
                return {
                    dir: a,
                    show: function(t, e, n) {
                        var i = this;
                        void 0 === e && (e = 0);
                        var r = n ? "linear" : u;
                        return t -= Math.round(t * tt(e, -1, 1)),
                        this.translate(e),
                        Jr(s, "itemin", {
                            percent: e,
                            duration: t,
                            timing: r,
                            dir: a
                        }),
                        Jr(o, "itemout", {
                            percent: 1 - e,
                            duration: t,
                            timing: r,
                            dir: a
                        }),
                        ae.all([Qe.start(s, h[1], t, r), Qe.start(o, h[0], t, r)]).then(function() {
                            i.reset(),
                            c.resolve()
                        }, et),
                        c.promise
                    },
                    stop: function() {
                        return Qe.stop([s, o])
                    },
                    cancel: function() {
                        Qe.cancel([s, o])
                    },
                    reset: function() {
                        for (var t in h[0])
                            Re([s, o], t, "")
                    },
                    forward: function(t, e) {
                        return void 0 === e && (e = this.percent()),
                        Qe.cancel([s, o]),
                        this.show(t, e, !0)
                    },
                    translate: function(t) {
                        this.reset();
                        var e = i(t, a);
                        Re(s, e[1]),
                        Re(o, e[0]),
                        Jr(s, "itemtranslatein", {
                            percent: t,
                            dir: a
                        }),
                        Jr(o, "itemtranslateout", {
                            percent: 1 - t,
                            dir: a
                        })
                    },
                    percent: function() {
                        return n(o || s, s, a)
                    },
                    getDistance: function() {
                        return o && o.offsetWidth
                    }
                }
            }
        },
        computed: {
            animation: function(t) {
                var e = t.animation
                  , n = t.Animations;
                return G(n[e] || n.slide, {
                    name: e
                })
            },
            transitionOptions: function() {
                return {
                    animation: this.animation
                }
            }
        },
        events: {
            "itemshow itemhide itemshown itemhidden": function(t) {
                var e = t.target;
                this.$update(e)
            },
            beforeitemshow: function(t) {
                De(t.target, this.clsActive)
            },
            itemshown: function(t) {
                De(t.target, this.clsActivated)
            },
            itemhidden: function(t) {
                Be(t.target, this.clsActive, this.clsActivated)
            }
        }
    }
      , to = {
        mixins: [lr, fr, gi, Qr],
        functional: !0,
        props: {
            delayControls: Number,
            preload: Number,
            videoAutoplay: Boolean,
            template: String
        },
        data: function() {
            return {
                preload: 1,
                videoAutoplay: !1,
                delayControls: 3e3,
                items: [],
                cls: "uk-open",
                clsPage: "uk-lightbox-page",
                selList: ".uk-lightbox-items",
                attrItem: "uk-lightbox-item",
                selClose: ".uk-close-large",
                selCaption: ".uk-lightbox-caption",
                pauseOnHover: !1,
                velocity: 2,
                Animations: Gr,
                template: '<div class="uk-lightbox uk-overflow-hidden"> <ul class="uk-lightbox-items"></ul> <div class="uk-lightbox-toolbar uk-position-top uk-text-right uk-transition-slide-top uk-transition-opaque"> <button class="uk-lightbox-toolbar-icon uk-close-large" type="button" uk-close></button> </div> <a class="uk-lightbox-button uk-position-center-left uk-position-medium uk-transition-fade" href uk-slidenav-previous uk-lightbox-item="previous"></a> <a class="uk-lightbox-button uk-position-center-right uk-position-medium uk-transition-fade" href uk-slidenav-next uk-lightbox-item="next"></a> <div class="uk-lightbox-toolbar uk-lightbox-caption uk-position-bottom uk-text-center uk-transition-slide-bottom uk-transition-opaque"></div> </div>'
            }
        },
        created: function() {
            var t = Ne(this.template)
              , e = Ne(this.selList, t);
            this.items.forEach(function() {
                return be(e, "<li>")
            }),
            this.$mount(be(this.container, t))
        },
        computed: {
            caption: function(t, e) {
                t.selCaption;
                return Ne(".uk-lightbox-caption", e)
            }
        },
        events: [{
            name: mt + " " + gt + " keydown",
            handler: "showControls"
        }, {
            name: "click",
            self: !0,
            delegate: function() {
                return this.selSlides
            },
            handler: function(t) {
                t.defaultPrevented || this.hide()
            }
        }, {
            name: "shown",
            self: !0,
            handler: function() {
                this.showControls()
            }
        }, {
            name: "hide",
            self: !0,
            handler: function() {
                this.hideControls(),
                Be(this.slides, this.clsActive),
                Qe.stop(this.slides)
            }
        }, {
            name: "hidden",
            self: !0,
            handler: function() {
                this.$destroy(!0)
            }
        }, {
            name: "keyup",
            el: ht && document,
            handler: function(t) {
                if (this.isToggled(this.$el) && this.draggable)
                    switch (t.keyCode) {
                    case 37:
                        this.show("previous");
                        break;
                    case 39:
                        this.show("next")
                    }
            }
        }, {
            name: "beforeitemshow",
            handler: function(t) {
                this.isToggled() || (this.draggable = !1,
                t.preventDefault(),
                this.toggleElement(this.$el, !0, !1),
                this.animation = Gr.scale,
                Be(t.target, this.clsActive),
                this.stack.splice(1, 0, this.index))
            }
        }, {
            name: "itemshow",
            handler: function() {
                we(this.caption, this.getItem().caption || "");
                for (var t = -this.preload; t <= this.preload; t++)
                    this.loadItem(this.index + t)
            }
        }, {
            name: "itemshown",
            handler: function() {
                this.draggable = this.$props.draggable
            }
        }, {
            name: "itemload",
            handler: function(t, r) {
                var o = this
                  , i = r.source
                  , e = r.type
                  , s = r.alt;
                void 0 === s && (s = "");
                var a, u, n, h = r.poster, c = r.attrs;
                void 0 === c && (c = {}),
                this.setItem(r, "<span uk-spinner></span>"),
                i && (u = {
                    frameborder: "0",
                    allow: "autoplay",
                    allowfullscreen: "",
                    style: "max-width: 100%; box-sizing: border-box;",
                    "uk-responsive": "",
                    "uk-video": "" + this.videoAutoplay
                },
                "image" === e || i.match(/\.(jpe?g|png|gif|svg|webp)($|\?)/i) ? fe(i, c.srcset, c.size).then(function(t) {
                    var e = t.width
                      , n = t.height;
                    return o.setItem(r, eo("img", G({
                        src: i,
                        width: e,
                        height: n,
                        alt: s
                    }, c)))
                }, function() {
                    return o.setError(r)
                }) : "video" === e || i.match(/\.(mp4|webm|ogv)($|\?)/i) ? (Xt(n = eo("video", G({
                    src: i,
                    poster: h,
                    controls: "",
                    playsinline: "",
                    "uk-video": "" + this.videoAutoplay
                }, c)), "loadedmetadata", function() {
                    ot(n, {
                        width: n.videoWidth,
                        height: n.videoHeight
                    }),
                    o.setItem(r, n)
                }),
                Xt(n, "error", function() {
                    return o.setError(r)
                })) : "iframe" === e || i.match(/\.(html|php)($|\?)/i) ? this.setItem(r, eo("iframe", G({
                    src: i,
                    frameborder: "0",
                    allowfullscreen: "",
                    class: "uk-lightbox-iframe"
                }, c))) : (a = i.match(/\/\/(?:.*?youtube(-nocookie)?\..*?[?&]v=|youtu\.be\/)([\w-]{11})[&?]?(.*)?/)) ? this.setItem(r, eo("iframe", G({
                    src: "https://www.youtube" + (a[1] || "") + ".com/embed/" + a[2] + (a[3] ? "?" + a[3] : ""),
                    width: 1920,
                    height: 1080
                }, u, c))) : (a = i.match(/\/\/.*?vimeo\.[a-z]+\/(\d+)[&?]?(.*)?/)) && de("https://vimeo.com/api/oembed.json?maxwidth=1920&url=" + encodeURI(i), {
                    responseType: "json",
                    withCredentials: !1
                }).then(function(t) {
                    var e = t.response
                      , n = e.height
                      , i = e.width;
                    return o.setItem(r, eo("iframe", G({
                        src: "https://player.vimeo.com/video/" + a[1] + (a[2] ? "?" + a[2] : ""),
                        width: i,
                        height: n
                    }, u, c)))
                }, function() {
                    return o.setError(r)
                }))
            }
        }],
        methods: {
            loadItem: function(t) {
                void 0 === t && (t = this.index);
                var e = this.getItem(t);
                this.getSlide(e).childElementCount || Kt(this.$el, "itemload", [e])
            },
            getItem: function(t) {
                return void 0 === t && (t = this.index),
                this.items[me(t, this.slides)]
            },
            setItem: function(t, e) {
                Kt(this.$el, "itemloaded", [this, we(this.getSlide(t), e)])
            },
            getSlide: function(t) {
                return this.slides[this.items.indexOf(t)]
            },
            setError: function(t) {
                this.setItem(t, '<span uk-icon="icon: bolt; ratio: 2"></span>')
            },
            showControls: function() {
                clearTimeout(this.controlsTimer),
                this.controlsTimer = setTimeout(this.hideControls, this.delayControls),
                De(this.$el, "uk-active", "uk-transition-active")
            },
            hideControls: function() {
                Be(this.$el, "uk-active", "uk-transition-active")
            }
        }
    };
    function eo(t, e) {
        var n = Ce("<" + t + ">");
        return ot(n, e),
        n
    }
    var no, io = {
        install: function(t, e) {
            t.lightboxPanel || t.component("lightboxPanel", to);
            G(e.props, t.component("lightboxPanel").options.props)
        },
        props: {
            toggle: String
        },
        data: {
            toggle: "a"
        },
        computed: {
            toggles: {
                get: function(t, e) {
                    return Me(t.toggle, e)
                },
                watch: function() {
                    this.hide()
                }
            }
        },
        disconnected: function() {
            this.hide()
        },
        events: [{
            name: "click",
            delegate: function() {
                return this.toggle + ":not(.uk-disabled)"
            },
            handler: function(t) {
                t.preventDefault(),
                this.show(t.current)
            }
        }],
        methods: {
            show: function(t) {
                var n, e = this, i = Q(this.toggles.map(ro), "source");
                return N(t) && (n = ro(t).source,
                t = y(i, function(t) {
                    var e = t.source;
                    return n === e
                })),
                this.panel = this.panel || this.$create("lightboxPanel", G({}, this.$props, {
                    items: i
                })),
                Xt(this.panel.$el, "hidden", function() {
                    return e.panel = !1
                }),
                this.panel.show(t)
            },
            hide: function() {
                return this.panel && this.panel.hide()
            }
        }
    };
    function ro(e) {
        var n = {};
        return ["href", "caption", "type", "poster", "alt", "attrs"].forEach(function(t) {
            n["href" === t ? "source" : t] = ut(e, t)
        }),
        n.attrs = Mn(n.attrs),
        n
    }
    var oo = {
        functional: !0,
        args: ["message", "status"],
        data: {
            message: "",
            status: "",
            timeout: 5e3,
            group: null,
            pos: "top-center",
            clsContainer: "uk-notification",
            clsClose: "uk-notification-close",
            clsMsg: "uk-notification-message"
        },
        install: function(r) {
            r.notification.closeAll = function(n, i) {
                Ae(document.body, function(t) {
                    var e = r.getComponent(t, "notification");
                    !e || n && n !== e.group || e.close(i)
                })
            }
        },
        computed: {
            marginProp: function(t) {
                return "margin" + (w(t.pos, "top") ? "Top" : "Bottom")
            },
            startProps: function() {
                var t = {
                    opacity: 0
                };
                return t[this.marginProp] = -this.$el.offsetHeight,
                t
            }
        },
        created: function() {
            var t = Ne("." + this.clsContainer + "-" + this.pos, this.$container) || be(this.$container, '<div class="' + this.clsContainer + " " + this.clsContainer + "-" + this.pos + '" style="display: block"></div>');
            this.$mount(be(t, '<div class="' + this.clsMsg + (this.status ? " " + this.clsMsg + "-" + this.status : "") + '"> <a href class="' + this.clsClose + '" data-uk-close></a> <div>' + this.message + "</div> </div>"))
        },
        connected: function() {
            var t, e = this, n = F(Re(this.$el, this.marginProp));
            Qe.start(Re(this.$el, this.startProps), ((t = {
                opacity: 1
            })[this.marginProp] = n,
            t)).then(function() {
                e.timeout && (e.timer = setTimeout(e.close, e.timeout))
            })
        },
        events: ((no = {
            click: function(t) {
                Bt(t.target, 'a[href="#"],a[href=""]') && t.preventDefault(),
                this.close()
            }
        })[wt] = function() {
            this.timer && clearTimeout(this.timer)
        }
        ,
        no[bt] = function() {
            this.timeout && (this.timer = setTimeout(this.close, this.timeout))
        }
        ,
        no),
        methods: {
            close: function(t) {
                function e() {
                    var t = n.$el.parentNode;
                    Kt(n.$el, "close", [n]),
                    $e(n.$el),
                    t && !t.hasChildNodes() && $e(t)
                }
                var n = this;
                this.timer && clearTimeout(this.timer),
                t ? e() : Qe.start(this.$el, this.startProps).then(e)
            }
        }
    };
    var so = ["x", "y", "bgx", "bgy", "rotate", "scale", "color", "backgroundColor", "borderColor", "opacity", "blur", "hue", "grayscale", "invert", "saturate", "sepia", "fopacity", "stroke"]
      , ao = {
        mixins: [hr],
        props: so.reduce(function(t, e) {
            return t[e] = "list",
            t
        }, {}),
        data: so.reduce(function(t, e) {
            return t[e] = void 0,
            t
        }, {}),
        computed: {
            props: function(g, m) {
                var v = this;
                return so.reduce(function(t, e) {
                    if (H(g[e]))
                        return t;
                    var n, i, r = e.match(/color/i), o = r || "opacity" === e, s = g[e].slice(0);
                    o && Re(m, e, ""),
                    s.length < 2 && s.unshift(("scale" === e ? 1 : o ? Re(m, e) : 0) || 0);
                    var a, u, h, c, l, d, f = s.reduce(function(t, e) {
                        return D(e) && e.replace(/-|\d/g, "").trim() || t
                    }, "");
                    if (r ? (a = m.style.color,
                    s = s.map(function(t) {
                        return Re(Re(m, "color", t), "color").split(/[(),]/g).slice(1, -1).concat(1).slice(0, 4).map(F)
                    }),
                    m.style.color = a) : w(e, "bg") ? (u = "bgy" === e ? "height" : "width",
                    s = s.map(function(t) {
                        return bn(t, u, v.$el)
                    }),
                    Re(m, "background-position-" + e[2], ""),
                    i = Re(m, "backgroundPosition").split(" ")["x" === e[2] ? 0 : 1],
                    n = v.covers ? (h = Math.min.apply(Math, s),
                    c = Math.max.apply(Math, s),
                    l = s.indexOf(h) < s.indexOf(c),
                    d = c - h,
                    s = s.map(function(t) {
                        return t - (l ? h : c)
                    }),
                    (l ? -d : 0) + "px") : i) : s = s.map(F),
                    "stroke" === e) {
                        if (!s.some(function(t) {
                            return t
                        }))
                            return t;
                        var p = Wi(v.$el);
                        Re(m, "strokeDasharray", p),
                        "%" === f && (s = s.map(function(t) {
                            return t * p / 100
                        })),
                        s = s.reverse(),
                        e = "strokeDashoffset"
                    }
                    return t[e] = {
                        steps: s,
                        unit: f,
                        pos: n,
                        bgPos: i,
                        diff: d
                    },
                    t
                }, {})
            },
            bgProps: function() {
                var e = this;
                return ["bgx", "bgy"].filter(function(t) {
                    return t in e.props
                })
            },
            covers: function(t, e) {
                return i = (n = e).style.backgroundSize,
                r = "cover" === Re(Re(n, "backgroundSize", ""), "backgroundSize"),
                n.style.backgroundSize = i,
                r;
                var n, i, r
            }
        },
        disconnected: function() {
            delete this._image
        },
        update: {
            read: function(t) {
                var e, n, i, u, h, c, l = this;
                t.active = this.matchMedia,
                t.active && (t.image || !this.covers || !this.bgProps.length || (e = Re(this.$el, "backgroundImage").replace(/^none|url\(["']?(.+?)["']?\)$/, "$1")) && ((n = new Image).src = e,
                (t.image = n).naturalWidth || (n.onload = function() {
                    return l.$update()
                }
                )),
                (i = t.image) && i.naturalWidth && (u = {
                    width: this.$el.offsetWidth,
                    height: this.$el.offsetHeight
                },
                h = {
                    width: i.naturalWidth,
                    height: i.naturalHeight
                },
                c = rt.cover(h, u),
                this.bgProps.forEach(function(t) {
                    var e, n = l.props[t], i = n.diff, r = n.bgPos, o = n.steps, s = "bgy" === t ? "height" : "width", a = c[s] - u[s];
                    a < i ? u[s] = c[s] + i - a : i < a && ((e = u[s] / bn(r, s, l.$el)) && (l.props[t].steps = o.map(function(t) {
                        return t - (a - i) / e
                    }))),
                    c = rt.cover(h, u)
                }),
                t.dim = c))
            },
            write: function(t) {
                var e = t.dim;
                t.active ? e && Re(this.$el, {
                    backgroundSize: e.width + "px " + e.height + "px",
                    backgroundRepeat: "no-repeat"
                }) : Re(this.$el, {
                    backgroundSize: "",
                    backgroundRepeat: ""
                })
            },
            events: ["resize"]
        },
        methods: {
            reset: function() {
                var n = this;
                K(this.getCss(0), function(t, e) {
                    return Re(n.$el, e, "")
                })
            },
            getCss: function(l) {
                var d = this.props;
                return Object.keys(d).reduce(function(t, e) {
                    var n = d[e]
                      , i = n.steps
                      , r = n.unit
                      , o = n.pos
                      , s = function(t, e, n) {
                        void 0 === n && (n = 2);
                        var i = uo(t, e)
                          , r = i[0]
                          , o = i[1]
                          , s = i[2];
                        return (B(r) ? r + Math.abs(r - o) * s * (r < o ? 1 : -1) : +o).toFixed(n)
                    }(i, l);
                    switch (e) {
                    case "x":
                    case "y":
                        r = r || "px",
                        t.transform += " translate" + p(e) + "(" + F(s).toFixed("px" === r ? 0 : 2) + r + ")";
                        break;
                    case "rotate":
                        r = r || "deg",
                        t.transform += " rotate(" + (s + r) + ")";
                        break;
                    case "scale":
                        t.transform += " scale(" + s + ")";
                        break;
                    case "bgy":
                    case "bgx":
                        t["background-position-" + e[2]] = "calc(" + o + " + " + s + "px)";
                        break;
                    case "color":
                    case "backgroundColor":
                    case "borderColor":
                        var a = uo(i, l)
                          , u = a[0]
                          , h = a[1]
                          , c = a[2];
                        t[e] = "rgba(" + u.map(function(t, e) {
                            return t += c * (h[e] - t),
                            3 === e ? F(t) : parseInt(t, 10)
                        }).join(",") + ")";
                        break;
                    case "blur":
                        r = r || "px",
                        t.filter += " blur(" + (s + r) + ")";
                        break;
                    case "hue":
                        r = r || "deg",
                        t.filter += " hue-rotate(" + (s + r) + ")";
                        break;
                    case "fopacity":
                        r = r || "%",
                        t.filter += " opacity(" + (s + r) + ")";
                        break;
                    case "grayscale":
                    case "invert":
                    case "saturate":
                    case "sepia":
                        r = r || "%",
                        t.filter += " " + e + "(" + (s + r) + ")";
                        break;
                    default:
                        t[e] = s
                    }
                    return t
                }, {
                    transform: "",
                    filter: ""
                })
            }
        }
    };
    function uo(t, e) {
        var n = t.length - 1
          , i = Math.min(Math.floor(n * e), n - 1)
          , r = t.slice(i, i + 2);
        return r.push(1 === e ? 1 : e % (1 / n) * n),
        r
    }
    var ho = {
        mixins: [ao],
        props: {
            target: String,
            viewport: Number,
            easing: Number
        },
        data: {
            target: !1,
            viewport: 1,
            easing: 1
        },
        computed: {
            target: function(t, e) {
                var n = t.target;
                return function t(e) {
                    return e ? "offsetTop"in e ? e : t(e.parentNode) : document.body
                }(n && yt(n, e) || e)
            }
        },
        update: {
            read: function(t, e) {
                var n = t.percent;
                if ("scroll" !== e && (n = !1),
                t.active) {
                    var i, r, o = n;
                    return i = Yn(this.target) / (this.viewport || 1),
                    r = this.easing,
                    {
                        percent: n = tt(i * (1 - (r - r * i))),
                        style: o !== n && this.getCss(n)
                    }
                }
            },
            write: function(t) {
                var e = t.style;
                t.active ? e && Re(this.$el, e) : this.reset()
            },
            events: ["scroll", "resize"]
        }
    };
    var co = {
        update: {
            write: function() {
                var t;
                this.stack.length || this.dragging || (t = this.getValidIndex(this.index),
                ~this.prevIndex && this.index === t || this.show(t))
            },
            events: ["resize"]
        }
    };
    function lo(t, e, n) {
        var i, r = go(t, e);
        return n ? r - (i = t,
        an(e).width / 2 - an(i).width / 2) : Math.min(r, fo(e))
    }
    function fo(t) {
        return Math.max(0, po(t) - an(t).width)
    }
    function po(t) {
        return vo(t).reduce(function(t, e) {
            return an(e).width + t
        }, 0)
    }
    function go(t, e) {
        return (hn(t).left + (lt ? an(t).width - an(e).width : 0)) * (lt ? -1 : 1)
    }
    function mo(t, e, n) {
        Kt(t, Zt(e, !1, !1, n))
    }
    function vo(t) {
        return Yt(t)
    }
    var wo = {
        mixins: [pi, Kr, co],
        props: {
            center: Boolean,
            sets: Boolean
        },
        data: {
            center: !1,
            sets: !1,
            attrItem: "uk-slider-item",
            selList: ".uk-slider-items",
            selNav: ".uk-slider-nav",
            clsContainer: "uk-slider-container",
            Transitioner: function(r, i, o, t) {
                var e = t.center
                  , s = t.easing
                  , a = t.list
                  , u = new se
                  , n = r ? lo(r, a, e) : lo(i, a, e) + an(i).width * o
                  , h = i ? lo(i, a, e) : n + an(r).width * o * (lt ? -1 : 1);
                return {
                    dir: o,
                    show: function(t, e, n) {
                        void 0 === e && (e = 0);
                        var i = n ? "linear" : s;
                        return t -= Math.round(t * tt(e, -1, 1)),
                        this.translate(e),
                        r && this.updateTranslates(),
                        e = r ? e : tt(e, 0, 1),
                        mo(this.getItemIn(), "itemin", {
                            percent: e,
                            duration: t,
                            timing: i,
                            dir: o
                        }),
                        r && mo(this.getItemIn(!0), "itemout", {
                            percent: 1 - e,
                            duration: t,
                            timing: i,
                            dir: o
                        }),
                        Qe.start(a, {
                            transform: Yr(-h * (lt ? -1 : 1), "px")
                        }, t, i).then(u.resolve, et),
                        u.promise
                    },
                    stop: function() {
                        return Qe.stop(a)
                    },
                    cancel: function() {
                        Qe.cancel(a)
                    },
                    reset: function() {
                        Re(a, "transform", "")
                    },
                    forward: function(t, e) {
                        return void 0 === e && (e = this.percent()),
                        Qe.cancel(a),
                        this.show(t, e, !0)
                    },
                    translate: function(t) {
                        var e = this.getDistance() * o * (lt ? -1 : 1);
                        Re(a, "transform", Yr(tt(e - e * t - h, -po(a), an(a).width) * (lt ? -1 : 1), "px")),
                        this.updateTranslates(),
                        r && (t = tt(t, -1, 1),
                        mo(this.getItemIn(), "itemtranslatein", {
                            percent: t,
                            dir: o
                        }),
                        mo(this.getItemIn(!0), "itemtranslateout", {
                            percent: 1 - t,
                            dir: o
                        }))
                    },
                    percent: function() {
                        return Math.abs((Re(a, "transform").split(",")[4] * (lt ? -1 : 1) + n) / (h - n))
                    },
                    getDistance: function() {
                        return Math.abs(h - n)
                    },
                    getItemIn: function(t) {
                        void 0 === t && (t = !1);
                        var e = this.getActives()
                          , n = Z(vo(a), "offsetLeft")
                          , i = ge(n, e[0 < o * (t ? -1 : 1) ? e.length - 1 : 0]);
                        return ~i && n[i + (r && !t ? o : 0)]
                    },
                    getActives: function() {
                        var n = lo(r || i, a, e);
                        return Z(vo(a).filter(function(t) {
                            var e = go(t, a);
                            return n <= e && e + an(t).width <= an(a).width + n
                        }), "offsetLeft")
                    },
                    updateTranslates: function() {
                        var n = this.getActives();
                        vo(a).forEach(function(t) {
                            var e = b(n, t);
                            mo(t, "itemtranslate" + (e ? "in" : "out"), {
                                percent: e ? 1 : 0,
                                dir: t.offsetLeft <= i.offsetLeft ? 1 : -1
                            })
                        })
                    }
                }
            }
        },
        computed: {
            avgWidth: function() {
                return po(this.list) / this.length
            },
            finite: function(t) {
                return t.finite || Math.ceil(po(this.list)) < an(this.list).width + vo(this.list).reduce(function(t, e) {
                    return Math.max(t, an(e).width)
                }, 0) + this.center
            },
            maxIndex: function() {
                if (!this.finite || this.center && !this.sets)
                    return this.length - 1;
                if (this.center)
                    return J(this.sets);
                Re(this.slides, "order", "");
                for (var t = fo(this.list), e = this.length; e--; )
                    if (go(this.list.children[e], this.list) < t)
                        return Math.min(e + 1, this.length - 1);
                return 0
            },
            sets: function(t) {
                var o = this
                  , e = t.sets
                  , s = an(this.list).width / (this.center ? 2 : 1)
                  , a = 0
                  , u = s
                  , h = 0;
                return !O(e = e && this.slides.reduce(function(t, e, n) {
                    var i, r = an(e).width;
                    return a < h + r && (!o.center && n > o.maxIndex && (n = o.maxIndex),
                    b(t, n) || (i = o.slides[n + 1],
                    o.center && i && r < u - an(i).width / 2 ? u -= r : (u = s,
                    t.push(n),
                    a = h + s + (o.center ? r / 2 : 0)))),
                    h += r,
                    t
                }, [])) && e
            },
            transitionOptions: function() {
                return {
                    center: this.center,
                    list: this.list
                }
            }
        },
        connected: function() {
            Le(this.$el, this.clsContainer, !Ne("." + this.clsContainer, this.$el))
        },
        update: {
            write: function() {
                var n = this;
                Me("[" + this.attrItem + "],[data-" + this.attrItem + "]", this.$el).forEach(function(t) {
                    var e = ut(t, n.attrItem);
                    n.maxIndex && Le(t, "uk-hidden", P(e) && (n.sets && !b(n.sets, F(e)) || e > n.maxIndex))
                }),
                !this.length || this.dragging || this.stack.length || (this.reorder(),
                this._translate(1));
                var e = this._getTransitioner(this.index).getActives();
                this.slides.forEach(function(t) {
                    return Le(t, n.clsActive, b(e, t))
                }),
                this.sets && !b(this.sets, F(this.index)) || this.slides.forEach(function(t) {
                    return Le(t, n.clsActivated, b(e, t))
                })
            },
            events: ["resize"]
        },
        events: {
            beforeitemshow: function(t) {
                !this.dragging && this.sets && this.stack.length < 2 && !b(this.sets, this.index) && (this.index = this.getValidIndex());
                var e = Math.abs(this.index - this.prevIndex + (0 < this.dir && this.index < this.prevIndex || this.dir < 0 && this.index > this.prevIndex ? (this.maxIndex + 1) * this.dir : 0));
                if (!this.dragging && 1 < e) {
                    for (var n = 0; n < e; n++)
                        this.stack.splice(1, 0, 0 < this.dir ? "next" : "previous");
                    t.preventDefault()
                } else
                    this.duration = Zr(this.avgWidth / this.velocity) * (an(this.dir < 0 || !this.slides[this.prevIndex] ? this.slides[this.index] : this.slides[this.prevIndex]).width / this.avgWidth),
                    this.reorder()
            },
            itemshow: function() {
                ~this.prevIndex && De(this._getTransitioner().getItemIn(), this.clsActive)
            }
        },
        methods: {
            reorder: function() {
                var n = this;
                if (this.finite)
                    Re(this.slides, "order", "");
                else {
                    var i = 0 < this.dir && this.slides[this.prevIndex] ? this.prevIndex : this.index;
                    if (this.slides.forEach(function(t, e) {
                        return Re(t, "order", 0 < n.dir && e < i ? 1 : n.dir < 0 && e >= n.index ? -1 : "")
                    }),
                    this.center)
                        for (var t = this.slides[i], e = an(this.list).width / 2 - an(t).width / 2, r = 0; 0 < e; ) {
                            var o = this.getIndex(--r + i, i)
                              , s = this.slides[o];
                            Re(s, "order", i < o ? -2 : -1),
                            e -= an(s).width
                        }
                }
            },
            getValidIndex: function(t, e) {
                if (void 0 === t && (t = this.index),
                void 0 === e && (e = this.prevIndex),
                t = this.getIndex(t, e),
                !this.sets)
                    return t;
                var n;
                do {
                    if (b(this.sets, t))
                        return t;
                    n = t,
                    t = this.getIndex(t + this.dir, e)
                } while (t !== n);
                return t
            }
        }
    }
      , bo = {
        mixins: [ao],
        data: {
            selItem: "!li"
        },
        computed: {
            item: function(t, e) {
                return yt(t.selItem, e)
            }
        },
        events: [{
            name: "itemshown",
            self: !0,
            el: function() {
                return this.item
            },
            handler: function() {
                Re(this.$el, this.getCss(.5))
            }
        }, {
            name: "itemin itemout",
            self: !0,
            el: function() {
                return this.item
            },
            handler: function(t) {
                var e = t.type
                  , n = t.detail
                  , i = n.percent
                  , r = n.duration
                  , o = n.timing
                  , s = n.dir;
                Qe.cancel(this.$el),
                Re(this.$el, this.getCss(yo(e, s, i))),
                Qe.start(this.$el, this.getCss(xo(e) ? .5 : 0 < s ? 1 : 0), r, o).catch(et)
            }
        }, {
            name: "transitioncanceled transitionend",
            self: !0,
            el: function() {
                return this.item
            },
            handler: function() {
                Qe.cancel(this.$el)
            }
        }, {
            name: "itemtranslatein itemtranslateout",
            self: !0,
            el: function() {
                return this.item
            },
            handler: function(t) {
                var e = t.type
                  , n = t.detail
                  , i = n.percent
                  , r = n.dir;
                Qe.cancel(this.$el),
                Re(this.$el, this.getCss(yo(e, r, i)))
            }
        }]
    };
    function xo(t) {
        return h(t, "in")
    }
    function yo(t, e, n) {
        return n /= 2,
        xo(t) ? e < 0 ? 1 - n : n : e < 0 ? n : 1 - n
    }
    var ko, $o, Io = G({}, qr, {
        fade: {
            show: function() {
                return [{
                    opacity: 0,
                    zIndex: 0
                }, {
                    zIndex: -1
                }]
            },
            percent: function(t) {
                return 1 - Re(t, "opacity")
            },
            translate: function(t) {
                return [{
                    opacity: 1 - t,
                    zIndex: 0
                }, {
                    zIndex: -1
                }]
            }
        },
        scale: {
            show: function() {
                return [{
                    opacity: 0,
                    transform: Xr(1.5),
                    zIndex: 0
                }, {
                    zIndex: -1
                }]
            },
            percent: function(t) {
                return 1 - Re(t, "opacity")
            },
            translate: function(t) {
                return [{
                    opacity: 1 - t,
                    transform: Xr(1 + .5 * t),
                    zIndex: 0
                }, {
                    zIndex: -1
                }]
            }
        },
        pull: {
            show: function(t) {
                return t < 0 ? [{
                    transform: Yr(30),
                    zIndex: -1
                }, {
                    transform: Yr(),
                    zIndex: 0
                }] : [{
                    transform: Yr(-100),
                    zIndex: 0
                }, {
                    transform: Yr(),
                    zIndex: -1
                }]
            },
            percent: function(t, e, n) {
                return n < 0 ? 1 - Ur(e) : Ur(t)
            },
            translate: function(t, e) {
                return e < 0 ? [{
                    transform: Yr(30 * t),
                    zIndex: -1
                }, {
                    transform: Yr(-100 * (1 - t)),
                    zIndex: 0
                }] : [{
                    transform: Yr(100 * -t),
                    zIndex: 0
                }, {
                    transform: Yr(30 * (1 - t)),
                    zIndex: -1
                }]
            }
        },
        push: {
            show: function(t) {
                return t < 0 ? [{
                    transform: Yr(100),
                    zIndex: 0
                }, {
                    transform: Yr(),
                    zIndex: -1
                }] : [{
                    transform: Yr(-30),
                    zIndex: -1
                }, {
                    transform: Yr(),
                    zIndex: 0
                }]
            },
            percent: function(t, e, n) {
                return 0 < n ? 1 - Ur(e) : Ur(t)
            },
            translate: function(t, e) {
                return e < 0 ? [{
                    transform: Yr(100 * t),
                    zIndex: 0
                }, {
                    transform: Yr(-30 * (1 - t)),
                    zIndex: -1
                }] : [{
                    transform: Yr(-30 * t),
                    zIndex: -1
                }, {
                    transform: Yr(100 * (1 - t)),
                    zIndex: 0
                }]
            }
        }
    }), So = {
        mixins: [pi, Qr, co],
        props: {
            ratio: String,
            minHeight: Number,
            maxHeight: Number
        },
        data: {
            ratio: "16:9",
            minHeight: !1,
            maxHeight: !1,
            selList: ".uk-slideshow-items",
            attrItem: "uk-slideshow-item",
            selNav: ".uk-slideshow-nav",
            Animations: Io
        },
        update: {
            read: function() {
                var t = this.ratio.split(":").map(Number)
                  , e = t[0]
                  , n = (n = t[1]) * this.list.offsetWidth / e || 0;
                return this.minHeight && (n = Math.max(this.minHeight, n)),
                this.maxHeight && (n = Math.min(this.maxHeight, n)),
                {
                    height: n - pn(this.list, "height", "content-box")
                }
            },
            write: function(t) {
                var e = t.height;
                0 < e && Re(this.list, "minHeight", e)
            },
            events: ["resize"]
        }
    }, To = {
        mixins: [pi, Or],
        props: {
            group: String,
            threshold: Number,
            clsItem: String,
            clsPlaceholder: String,
            clsDrag: String,
            clsDragState: String,
            clsBase: String,
            clsNoDrag: String,
            clsEmpty: String,
            clsCustom: String,
            handle: String
        },
        data: {
            group: !1,
            threshold: 5,
            clsItem: "uk-sortable-item",
            clsPlaceholder: "uk-sortable-placeholder",
            clsDrag: "uk-sortable-drag",
            clsDragState: "uk-drag",
            clsBase: "uk-sortable",
            clsNoDrag: "uk-sortable-nodrag",
            clsEmpty: "uk-sortable-empty",
            clsCustom: "",
            handle: !1,
            pos: {}
        },
        created: function() {
            var n = this;
            ["init", "start", "move", "end"].forEach(function(t) {
                var e = n[t];
                n[t] = function(t) {
                    G(n.pos, oe(t)),
                    e(t)
                }
            })
        },
        events: {
            name: gt,
            passive: !1,
            handler: "init"
        },
        computed: {
            target: function() {
                return (this.$el.tBodies || [this.$el])[0]
            },
            items: function() {
                return Yt(this.target)
            },
            isEmpty: {
                get: function() {
                    return O(this.items)
                },
                watch: function(t) {
                    Le(this.target, this.clsEmpty, t)
                },
                immediate: !0
            },
            handles: {
                get: function(t, e) {
                    var n = t.handle;
                    return n ? Me(n, e) : this.items
                },
                watch: function(t, e) {
                    Re(e, {
                        touchAction: "",
                        userSelect: ""
                    }),
                    Re(t, {
                        touchAction: pt ? "none" : "",
                        userSelect: "none"
                    })
                },
                immediate: !0
            }
        },
        update: {
            write: function() {
                if (this.drag && Pt(this.placeholder)) {
                    var t = this.pos
                      , e = t.x
                      , n = t.y
                      , i = this.origin
                      , r = i.offsetTop
                      , o = i.offsetLeft
                      , s = this.drag
                      , a = s.offsetHeight
                      , u = s.offsetWidth
                      , h = an(window)
                      , c = h.right
                      , l = h.bottom
                      , d = document.elementFromPoint(e, n);
                    Re(this.drag, {
                        top: tt(n - r, 0, l - a),
                        left: tt(e - o, 0, c - u)
                    });
                    var f = this.getSortable(d)
                      , p = this.getSortable(this.placeholder)
                      , g = f !== p;
                    if (f && !qt(d, this.placeholder) && (!g || f.group && f.group === p.group)) {
                        if (d = f.target === d.parentNode && d || f.items.filter(function(t) {
                            return qt(d, t)
                        })[0],
                        g)
                            p.remove(this.placeholder);
                        else if (!d)
                            return;
                        f.insert(this.placeholder, d),
                        b(this.touched, f) || this.touched.push(f)
                    }
                }
            },
            events: ["move"]
        },
        methods: {
            init: function(t) {
                var e = t.target
                  , n = t.button
                  , i = t.defaultPrevented
                  , r = this.items.filter(function(t) {
                    return qt(e, t)
                })[0];
                !r || i || 0 < n || Vt(e) || qt(e, "." + this.clsNoDrag) || this.handle && !qt(e, this.handle) || (t.preventDefault(),
                this.touched = [this],
                this.placeholder = r,
                this.origin = G({
                    target: e,
                    index: ge(r)
                }, this.pos),
                Xt(document, mt, this.move),
                Xt(document, vt, this.end),
                this.threshold || this.start(t))
            },
            start: function(t) {
                var e, n, i;
                this.drag = (e = this.$container,
                n = this.placeholder,
                ot(i = be(e, n.outerHTML.replace(/(^<)(?:li|tr)|(?:li|tr)(\/>$)/g, "$1div$2")), "style", ot(i, "style") + ";margin:0!important"),
                Re(i, G({
                    boxSizing: "border-box",
                    width: n.offsetWidth,
                    height: n.offsetHeight,
                    overflow: "hidden"
                }, Re(n, ["paddingLeft", "paddingRight", "paddingTop", "paddingBottom"]))),
                ln(i.firstElementChild, ln(n.firstElementChild)),
                i);
                var r, o, s = this.placeholder.getBoundingClientRect(), a = s.left, u = s.top;
                G(this.origin, {
                    offsetLeft: this.pos.x - a,
                    offsetTop: this.pos.y - u
                }),
                De(this.drag, this.clsDrag, this.clsCustom),
                De(this.placeholder, this.clsPlaceholder),
                De(this.items, this.clsItem),
                De(document.documentElement, this.clsDragState),
                Kt(this.$el, "start", [this, this.placeholder]),
                r = this.pos,
                o = Date.now(),
                ko = setInterval(function() {
                    var t = r.x
                      , a = r.y;
                    a += window.pageYOffset;
                    var u = .3 * (Date.now() - o);
                    o = Date.now(),
                    Xn(document.elementFromPoint(t, r.y)).some(function(t) {
                        var e = t.scrollTop
                          , n = t.scrollHeight
                          , i = an(Gn(t))
                          , r = i.top
                          , o = i.bottom
                          , s = i.height;
                        if (r < a && a < r + 30)
                            e -= u;
                        else {
                            if (!(a < o && o - 30 < a))
                                return;
                            e += u
                        }
                        if (0 < e && e < n - s)
                            return qn(t, e),
                            !0
                    })
                }, 15),
                this.move(t)
            },
            move: function(t) {
                this.drag ? this.$emit("move") : (Math.abs(this.pos.x - this.origin.x) > this.threshold || Math.abs(this.pos.y - this.origin.y) > this.threshold) && this.start(t)
            },
            end: function(t) {
                var e, n;
                Gt(document, mt, this.move),
                Gt(document, vt, this.end),
                Gt(window, "scroll", this.scroll),
                this.drag && (clearInterval(ko),
                e = this.getSortable(this.placeholder),
                this === e ? this.origin.index !== ge(this.placeholder) && Kt(this.$el, "moved", [this, this.placeholder]) : (Kt(e.$el, "added", [e, this.placeholder]),
                Kt(this.$el, "removed", [this, this.placeholder])),
                Kt(this.$el, "stop", [this, this.placeholder]),
                $e(this.drag),
                this.drag = null,
                n = this.touched.map(function(t) {
                    return t.clsPlaceholder + " " + t.clsItem
                }).join(" "),
                this.touched.forEach(function(t) {
                    return Be(t.items, n)
                }),
                Be(document.documentElement, this.clsDragState))
            },
            insert: function(n, i) {
                var r = this;
                De(this.items, this.clsItem);
                function t() {
                    var t, e;
                    i ? (!qt(n, r.target) || (e = i,
                    (t = n).parentNode === e.parentNode && ge(t) > ge(e)) ? xe : ye)(i, n) : be(r.target, n)
                }
                this.animation ? this.animate(t) : t()
            },
            remove: function(t) {
                qt(t, this.target) && (this.animation ? this.animate(function() {
                    return $e(t)
                }) : $e(t))
            },
            getSortable: function(t) {
                return t && (this.$getComponent(t, "sortable") || this.getSortable(t.parentNode))
            }
        }
    };
    var Eo = []
      , _o = {
        mixins: [lr, gi, $i],
        args: "title",
        props: {
            delay: Number,
            title: String
        },
        data: {
            pos: "top",
            title: "",
            delay: 0,
            animation: ["uk-animation-scale-up"],
            duration: 100,
            cls: "uk-active",
            clsPos: "uk-tooltip"
        },
        beforeConnect: function() {
            this._hasTitle = st(this.$el, "title"),
            ot(this.$el, {
                title: "",
                "aria-expanded": !1
            })
        },
        disconnected: function() {
            this.hide(),
            ot(this.$el, {
                title: this._hasTitle ? this.title : null,
                "aria-expanded": null
            })
        },
        methods: {
            show: function() {
                var e = this;
                !this.isActive() && this.title && (Eo.forEach(function(t) {
                    return t.hide()
                }),
                Eo.push(this),
                this._unbind = Xt(document, vt, function(t) {
                    return !qt(t.target, e.$el) && e.hide()
                }),
                clearTimeout(this.showTimer),
                this.showTimer = setTimeout(this._show, this.delay))
            },
            hide: function() {
                var t = this;
                this.isActive() && !zt(this.$el, "input:focus") && this.toggleElement(this.tooltip, !1, !1).then(function() {
                    Eo.splice(Eo.indexOf(t), 1),
                    clearTimeout(t.showTimer),
                    t.tooltip = $e(t.tooltip),
                    t._unbind()
                })
            },
            _show: function() {
                var e = this;
                this.tooltip = be(this.container, '<div class="' + this.clsPos + '"> <div class="' + this.clsPos + '-inner">' + this.title + "</div> </div>"),
                Xt(this.tooltip, "toggled", function() {
                    var t = e.isToggled(e.tooltip);
                    ot(e.$el, "aria-expanded", t),
                    t && (e.positionAt(e.tooltip, e.$el),
                    e.origin = "y" === e.getAxis() ? wn(e.dir) + "-" + e.align : e.align + "-" + wn(e.dir))
                }),
                this.toggleElement(this.tooltip, !0)
            },
            isActive: function() {
                return b(Eo, this)
            }
        },
        events: (($o = {
            focus: "show",
            blur: "hide"
        })[wt + " " + bt] = function(t) {
            re(t) || (t.type === wt ? this.show() : this.hide())
        }
        ,
        $o[gt] = function(t) {
            re(t) && (this.isActive() ? this.hide() : this.show())
        }
        ,
        $o)
    }
      , Co = {
        props: {
            allow: String,
            clsDragover: String,
            concurrent: Number,
            maxSize: Number,
            method: String,
            mime: String,
            msgInvalidMime: String,
            msgInvalidName: String,
            msgInvalidSize: String,
            multiple: Boolean,
            name: String,
            params: Object,
            type: String,
            url: String
        },
        data: {
            allow: !1,
            clsDragover: "uk-dragover",
            concurrent: 1,
            maxSize: 0,
            method: "POST",
            mime: !1,
            msgInvalidMime: "Invalid File Type: %s",
            msgInvalidName: "Invalid File Name: %s",
            msgInvalidSize: "Invalid File Size: %s Kilobytes Max",
            multiple: !1,
            name: "files[]",
            params: {},
            type: "",
            url: "",
            abort: et,
            beforeAll: et,
            beforeSend: et,
            complete: et,
            completeAll: et,
            error: et,
            fail: et,
            load: et,
            loadEnd: et,
            loadStart: et,
            progress: et
        },
        events: {
            change: function(t) {
                zt(t.target, 'input[type="file"]') && (t.preventDefault(),
                t.target.files && this.upload(t.target.files),
                t.target.value = "")
            },
            drop: function(t) {
                No(t);
                var e = t.dataTransfer;
                e && e.files && (Be(this.$el, this.clsDragover),
                this.upload(e.files))
            },
            dragenter: function(t) {
                No(t)
            },
            dragover: function(t) {
                No(t),
                De(this.$el, this.clsDragover)
            },
            dragleave: function(t) {
                No(t),
                Be(this.$el, this.clsDragover)
            }
        },
        methods: {
            upload: function(t) {
                var i = this;
                if (t.length) {
                    Kt(this.$el, "upload", [t]);
                    for (var e = 0; e < t.length; e++) {
                        if (this.maxSize && 1e3 * this.maxSize < t[e].size)
                            return void this.fail(this.msgInvalidSize.replace("%s", this.maxSize));
                        if (this.allow && !Ao(this.allow, t[e].name))
                            return void this.fail(this.msgInvalidName.replace("%s", this.allow));
                        if (this.mime && !Ao(this.mime, t[e].type))
                            return void this.fail(this.msgInvalidMime.replace("%s", this.mime))
                    }
                    this.multiple || (t = [t[0]]),
                    this.beforeAll(this, t);
                    var r = function(t, e) {
                        for (var n = [], i = 0; i < t.length; i += e) {
                            for (var r = [], o = 0; o < e; o++)
                                r.push(t[i + o]);
                            n.push(r)
                        }
                        return n
                    }(t, this.concurrent)
                      , o = function(t) {
                        var e = new FormData;
                        for (var n in t.forEach(function(t) {
                            return e.append(i.name, t)
                        }),
                        i.params)
                            e.append(n, i.params[n]);
                        de(i.url, {
                            data: e,
                            method: i.method,
                            responseType: i.type,
                            beforeSend: function(t) {
                                var e = t.xhr;
                                e.upload && Xt(e.upload, "progress", i.progress),
                                ["loadStart", "load", "loadEnd", "abort"].forEach(function(t) {
                                    return Xt(e, t.toLowerCase(), i[t])
                                }),
                                i.beforeSend(t)
                            }
                        }).then(function(t) {
                            i.complete(t),
                            r.length ? o(r.shift()) : i.completeAll(t)
                        }, function(t) {
                            return i.error(t)
                        })
                    };
                    o(r.shift())
                }
            }
        }
    };
    function Ao(t, e) {
        return e.match(new RegExp("^" + t.replace(/\//g, "\\/").replace(/\*\*/g, "(\\/[^\\/]+)*").replace(/\*/g, "[^\\/]+").replace(/((?!\\))\?/g, "$1.") + "$","i"))
    }
    function No(t) {
        t.preventDefault(),
        t.stopPropagation()
    }
    return K(Object.freeze({
        __proto__: null,
        Countdown: Dr,
        Filter: Fr,
        Lightbox: io,
        LightboxPanel: to,
        Notification: oo,
        Parallax: ho,
        Slider: wo,
        SliderParallax: bo,
        Slideshow: So,
        SlideshowParallax: bo,
        Sortable: To,
        Tooltip: _o,
        Upload: Co
    }), function(t, e) {
        return ti.component(e, t)
    }),
    ti
});
