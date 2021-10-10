var befxl_cnf = {}; !
function() {
    for (var t = beshare_opt.split("|"), e = ["ver", "dir", "uid", "api", "pid"], n = 0; n < e.length; n++) befxl_cnf[e[n]] = t[n]
} (),
//点赞
jQuery.fn.postLike = function() {
	if (jQuery(this).hasClass("active")) {
		UIkit.notification("您已赞过啦！");
		return false
	} else {
		return false
	}
};
jQuery(document).on("click", ".AoTon-btn-like",
function() {
	jQuery(this).postLike()
});
jQuery(document).ready(function(c) {
    var t = function(t) {
        var o, e = t || c(".AoTon-btn-like"),
        n = befxl_cnf.uid || 0,
        a = n ? "AoTon_LOCAL_DATA_" + n: "AoTon_LOCAL_DATA_VISITOR",
        r = localStorage.getItem(a) ? JSON.parse(localStorage.getItem(a)) : {};
        r.post_liked_items || (r.post_liked_items = []),
        o = r.post_liked_items,
        0 < e.length && e.each(function() {
            var t = c(this),
            e = befxl_cnf.pid,
            n = t.data("count");
            e && -1 < o.indexOf(e) && (t.addClass("active"), t.find(".like-number").eq(0).html("" + n + ""))
        }),
        e.on("click",
        function() {
            var n = c(this),
            i = befxl_cnf.pid,
            t = decodeURIComponent(befxl_cnf.api);
            n.hasClass("active") || c.post(t, {
                action: "beshare_ajax",
                do: "like",
                post_id: i
            },
            function(t) {
                if (t) {
                    var e = 1 < t ? 999 < t ? "" + parseInt(t / 1e3) + "K+": " " + t + "": "";
                    n.find(".like-number").eq(0).html(e),
                    n.addClass("active"),
                    o.indexOf(i) < 0 && o.push(i),
                    localStorage.setItem(a, JSON.stringify(r))
                }
            })
        })
    },
    i = {
        bySocial: function(t) {
            c(".use-beshare-social-btn").on("click",
            function() {
                shar.open({
                    title: "分享本文",
                    content: AoTon_beshare_html,
                    className: "shar-beshare-share",
                    success: function() {
                        c(".AoTon-share-list .share-logo").on("click",
                        function() {
                            var t = c(this).attr("data-cmd"),
                            e = encodeURI(document.title),
                            n = c('meta[name="description"]').attr("content"),
                            i = c(".AoTon-share-list").attr("data-cover"),
                            o = c("[AoTon-share-url]").length ? c("[AoTon-share-url]").attr("AoTon-share-url") : window.location.href;
                            switch (i = i ? encodeURI(i) : "", t) {
                            case "weibo":
                                window.open("https://service.weibo.com/share/share.php?url=" + o + "&title=" + e + "&pic=" + i + "&searchPic=true", "_blank");
                                break;
                            case "qzone":
                                window.open("http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=" + o + "&title=" + e + "&summary=" + n + "&pics=" + i, "_blank");
                                break;
                            case "qq":
                                window.open("http://connect.qq.com/widget/shareqq/index.html?url=" + o + "&title=" + e + "&summary=" + n + "&pics=" + i, "_blank");
                                break;
                            case "weixin":
                                shar.open({
                                    title:
                                    "本页二维码",
                                    content: '<div class="qrbox" id="J_shareQrBox"><canvas width="200" id="J_shareQrImg"></canvas><p>用手机扫码打开本页</p></div>',
                                    className: "shar-qrbox",
                                    success: function() {
                                        new QRious({
                                            element: document.getElementById("J_shareQrImg"),
                                            level: "H",
                                            size: 200,
                                            value: o
                                        })
                                    }
                                })
                            }
                        })
                    }
                })
            })
        },
        poster: function() {
            c(document).on("click", ".use-beshare-poster-btn",
            function() {
                var n = c("[AoTon-share-url]").length ? c("[AoTon-share-url]").attr("AoTon-share-url") : window.location.href;
                shar.open({
                    type: "shar-share-poster",
                    content: '<div class="share-box"><div class="poster-loading">&nbsp;&nbsp;</div></div><div class="poster-tips bgt">将海报发送给好友分享本文</div>',
                    success: function() {
                        c.ajax({
                            url: decodeURIComponent(befxl_cnf.api),
                            data: {
                                id: befxl_cnf.pid,
                                action: "beshare_ajax",
                                do: "AoTon_share_poster"
                            },
                            method: "POST",
                            dataType: "json",
                            timeout: 6e4,
                            success: function(t) {
                                t.callback = function(t) {
                                    c(".share-box").html('<img src="' + t + '">'),
                                    /MicroMessenger/i.test(navigator.userAgent) && c(".poster-tips").show()
                                };
                                var e = new QRious({
                                    value: n,
                                    padding: 5,
                                    size: 110
                                });
                                t.qrcode = e.toDataURL(),
                                t.head && t.logo && t.qrcode ? i.canvas(t) : shar.alert("" + (t.head ? "": "无法获取文章图片") + "<br>" + (t.logo ? "": "无法获取LOGO") + "<br>" + (t.qrcode ? "": "无法获取二维码"),
                                function() {
                                    shar.closeAll()
                                })
                            },
                            error: function() {
                                shar.alert("生成海报失败",
                                function() {
                                    shar.closeAll()
                                })
                            }
                        })
                    }
                })
            })
        },
        canvas: function(d) {
            var s = document.createElement("canvas"),
            u = s.getContext("2d"),
            w = 720,
            l = 1100;
            s.width = w,
            s.height = 1e4;
            switch (u.fillStyle = "#fff", u.fillRect(0, 0, s.width, s.height)) {
            default:
                f = {
                    padding_left: 40,
                    padding_year: 43,
                    padding_cat: 68,
                    padding_left_logo: 60,
                    padding_top: 0,
                    head_width: w,
                    main_width: 640,
                    name_width: 100,
                    with_content: 1,
                    with_domain: 0
                };
                n(0,
                function(t) {
                    p(t,
                    function(t) {}),
                    y(t,
                    function(t) {}),
                    k(t,
                    function(t) {}),
                    x(t,
                    function(t) {}),
                    i(t,
                    function(t) {}),
                    o(t,
                    function(t) {}),
                    r(t,
                    function(t, e) {
                        c(t, e)
                    }),
                    q(t),
                    z(t),
                    j(t)
                })
            }
            function e(t) {
                var e = f.bgi;
                if (!e) return t && t(),
                !1;
                var n = new Image;
                n.crossOrigin = "anonymous",
                n.src = decodeURIComponent(befxl_cnf.dir) + "" + e,
                n.onerror = function(t) {
                    shar.alert("无法获取背景图",
                    function() {
                        shar.closeAll()
                    })
                },
                n.onload = function() {
                    u.drawImage(this, 0, 0, w, n.height, 0, 0, w, l),
                    t && t()
                }
            }
            function n(s, l) {
                var h = new Image;
                h.crossOrigin = "anonymous",
                d.head.match(/^\/\//) && (d.head = window.location.protocol + d.head),
                h.src = d.head,
                h.onerror = function(t) {
                    shar.alert("无法获取文章图片",
                    function() {
                        shar.closeAll()
                    })
                },
                h.onload = function() {
                    var t = parseInt(2 * f.head_width / 3),
                    e = parseInt(2 * h.width / 3),
                    n = 0,
                    i = h.width,
                    o = h.height,
                    a = f.head_width,
                    r = t,
                    c = (w - f.head_width) / 2,
                    d = f.padding_top;
                    h.height === h.width ? (c = parseInt((f.head_width - t) / 2) + (w - f.head_width) / 2 + 20, r = a = t - 40, d = 40 + f.padding_top) : h.height > e ? o = e: h.height < e && (i = parseInt(3 * o / 2), n = parseInt((h.width - i) / 2)),
                    s += t + f.padding_top,
                    u.drawImage(this, n, 0, i, o, c, d, a, r),
                    l && l(s)
                }
            }
            function p(t, e) {
                u.stroke(),
                u.fillStyle = "#00c5fe",
                u.textAlign = "left",
                u.font = "700 90px sans-serif",
                t += -80,
                t = h(jQuery("<div>").html(d.day).text(), f.padding_left, t, 40, u),
                e && e(t)
            }
            function y(t, e) {
                u.stroke(),
                u.fillStyle = "#00c5fe",
                u.textAlign = "left",
                u.font = "300 26px sans-serif",
                t += -40,
                t = h(jQuery("<div>").html(d.year).text(), f.padding_year, t, 40, u),
                e && e(t)
            }
            function k(t, e) {
                u.stroke(),
                u.fillStyle = "#c40000",
                u.textAlign = "left",
                u.font = "700 25px sans-serif",
                t += 42,
                t = h(jQuery("<div>").html(d.ico_cat).text(), f.padding_left, t, 48, u),
                e && e(t)
            }
            function x(t, e) {
                u.stroke(),
                u.fillStyle = "#666",
                u.textAlign = "left",
                u.font = "700 18px sans-serif",
                t += 40,
                t = h(jQuery("<div>").html(d.post_cat).text(), f.padding_cat, t, 48, u),
                e && e(t)
            }
            function i(t, e) {
                u.stroke(),
                u.fillStyle = "#333",
                u.textAlign = "left",
                u.font = "700 34px sans-serif",
                t += 90,
                t = h(jQuery("<div>").html(d.title).text(), f.padding_left, t, 48, u),
                e && e(t)
            }
            function o(t, e) {
                u.textAlign = "left",
                u.fillStyle = "#555",
                u.font = "300 28px sans-serif",
                t += 200,
                t = h(jQuery("<div>").html(d.excerpt).text(), f.padding_left, t, 48, u),
                e && e(t)
            }
            function q(t, e) {
                u.textAlign = "left",
                u.fillStyle = "#333",
                u.font = "700 24px sans-serif",
                t += 445,
                t = h(jQuery("<div>").html(d.get_name).text(), 120, t, 42, u),
                e && e(t)
            }
            function z(t, e) {
                u.textAlign = "left",
                u.fillStyle = "#666",
                u.font = "300 14px sans-serif",
                t += 469,
                t = h(jQuery("<div>").html(d.web_home).text(), 120, t, 42, u),
                e && e(t)
            }
            function j(t, e) {
                u.textAlign = "left",
                u.fillStyle = "#444",
                u.font = "300 16px sans-serif",
                t += 580,
                t = h(jQuery("<div>").html(d.warn).text(), 256, t, 42, u),
                e && e(t)
            }
            function r(n, i) {
                var o = new Image;
                o.crossOrigin = "anonymous",
                d.logo.match(/^\/\//) && (d.logo = window.location.protocol + d.logo),
                o.src = d.logo,
                o.onerror = function(t) {
                    shar.alert("无法获取LOGO",
                    function() {
                        shar.closeAll()
                    })
                },
                o.onload = function() {
                    n += 390;
                    var t = 400 / o.width * o.height;
                    t = 50 < t ? 50 : t;
                    var e = o.width / (o.height / t);
                    t = (e = 400 < e ? 400 : e) / o.width * o.height,
                    u.drawImage(this, 0, 0, o.width, o.height, f.padding_left_logo, n + (117 - t) / 2, e, t),
                    i && i(n, t)
                }
            }
            function c(o, a, r) {
                var c = new Image;
                c.src = d.qrcode,
                c.onerror = function(t) {
                    shar.alert("无法获取二维码",
                    function() {
                        shar.closeAll()
                    })
                },
                c.onload = function() {
                    var t = w - f.padding_left - 120;
                    u.drawImage(this, 0, 0, c.width, c.height, t, 876, 120, 120 / c.width * c.height);
                    var e = 120 / c.width * c.height;
                    o += a < e ? e: a,
                    o = l;
                    var n = u.getImageData(0, 0, w, o);
                    s.height = o,
                    u.putImageData(n, 0, 0);
                    var i = s.toDataURL("image/jpeg", 1);
                    d.callback(i),
                    r && r(o)
                }
            }
            function h(t, e, n, i, o) {
                for (var a = 0,
                r = 0,
                c = 0; c < t.length; c++)(a += o.measureText(t[c]).width) > f.main_width - 20 && (o.fillText(t.substring(r, c), e, n), n += i, a = 0, r = c),
                c == t.length - 1 && (o.fillText(t.substring(r, c + 1), e, n), n += i);
                return n
            }
        }
    };
    c(".AoTon-btn-like").length && t(),
    c(".use-beshare-social-btn").length && i.bySocial(),
    c(".AoTon-share-poster").length && i.poster(),
    c(".use-beshare-donate-btn").length && c(".use-beshare-donate-btn").on("click",
    function() {
        shar.open({
            content: AoTon_beshare_donate_html,
            className: "shar-beshare-donate",
            success: function() {
                var t = c(".shar-beshare-donate"),
                e = t.find(".share-tab-nav-item"),
                n = t.find(".share-tab-cont"),
                i = "current",
                o = 0;
                e.on("click",
                function() {
                    o = c(this).index(),
                    e.removeClass(i).eq(o).addClass(i),
                    n.removeClass(i).eq(o).addClass(i)
                })
            }
        })
    })
}); !
function(c) {
    "use strict";
    if (! (c.shar || 0)) {
        var e, t, n, i, o, f = document,
        b = "getElementsByClassName",
        p = function(e) {
            return f.querySelectorAll(e)
        },
        a = "OK",
        l = "Cancel",
        y = ["dialog", "toast", "loading", "iframe"],
        s = {
            type: 0,
            mask: !0,
            maskClose: !0,
            closebtn: !0,
            whenBtnClickClose: !0,
            fixed: !0,
            anim: "def"
        },
        u = {
            extend: function(e, t) {
                var n = "object" == typeof t ? JSON.parse(JSON.stringify(t)) : JSON.parse(JSON.stringify(s));
                for (var i in e) n[i] = e[i];
                return n
            },
            timer: {},
            end: {},
            touch: function(e, t) {
                e.addEventListener("click",
                function(e) {
                    t.call(this, e)
                },
                !1)
            }
        },
        m = 0,
        w = ["shar"],
        d = function(e) {
            this.config = u.extend(e),
            this.view()
        };
        d.prototype.view = function() {
            var e = this,
            n = e.config,
            t = f.createElement("div"),
            i = "object" == typeof n.content,
            o = "string" == typeof n.type ? n.type: w[0] + "-" + y[n.type || 0];
            e.id = t.id = w[0] + m,
            t.setAttribute("class", w[0] + " " + o),
            t.setAttribute("index", m);
            var s, c, a = (s = "object" == typeof n.title, n.title ? '<h3 class="shar-title' + (s ? " " + n.title[1] : "") + '">' + (s ? n.title[0] : n.title) + "</h3>": ""),
            l = (c = "object" == typeof n.closebtn, n.closebtn ? '<a uk-close class="shar-close' + (c ? " " + n.closetype[1] : "") + '"></a>': ""),
            u = function() {
                "string" == typeof n.btn && (n.btn = [n.btn]);
                var e, t = (n.btn || []).length;
                return 0 !== t && n.btn ? (e = '<span yes type="1">' + n.btn[0] + "</span>", 2 === t && (e = '<span no type="0">' + n.btn[1] + "</span>" + e), '<div class="shar-btn">' + e + "</div>") : ""
            } ();
            if (n.fixed || (n.top = n.hasOwnProperty("top") ? n.top: 100, n.style = n.style || "", n.style += " top:" + (f.body.scrollTop + n.top) + "px"), 2 === n.type && (n.content = '<i></i><i class="shar-load"></i><i></i><p>' + (n.content || "") + "</p>"), 3 === n.type) {
                n.content = i ? n.content: [n.content || "", "auto"];
                n.content = '<iframe scrolling="' + (n.content[1] || "auto") + '" allowtransparency="true" id="' + y[3] + m + '" name="' + y[3] + m + '" onload="this.className=\'\';" class="shar-load" frameborder="0" src="' + n.content[0] + '"></iframe>'
            }
            if (n.skin && (n.anim = "fade"), "msg" === n.skin && (n.mask = n.closebtn = !1, n.time = 2), t.innerHTML = (n.mask ? "<div " + ("string" == typeof n.mask ? 'style="' + n.mask + '"': "") + ' class="shar-mask"></div>': "") + '<div class="shar-main" ' + (n.fixed ? "": 'style="position:static;"') + '><div class="shar-section"><div class="shar-child bk da ' + (n.skin ? "shar-" + n.skin + " ": "") + (n.className ? n.className: "") + " " + (n.anim ? "shar-anim-" + n.anim: "") + '" ' + (n.style ? 'style="' + n.style + '"': "") + ">" + a + '<div class="shar-cont">' + n.content + "</div>" + u + (n.closebtn ? l: "") + "</div></div></div>", !n.type || 2 === n.type) {
                var d = f[b](w[0] + y[n.type]);
                1 <= d.length && shar.close(d[0].getAttribute("index"))
            }
            document.body.appendChild(t);
            var r = e.elem = p("#" + e.id)[0];
            n.success && n.success(r),
            e.index = m++,
            e.action(n, r)
        },
        d.prototype.action = function(e, t) {
            var n = this;
            e.time && (u.timer[n.index] = setTimeout(function() {
                shar.close(n.index)
            },
            1e3 * e.time));
            function i() {
                0 == this.getAttribute("type") ? (e.no && e.no(), shar.close(n.index)) : (e.yes && e.yes(n.index), e.whenBtnClickClose && shar.close(n.index))
            }
            if (e.btn) for (var o = t[b]("shar-btn")[0].children, s = o.length, c = 0; c < s; c++) u.touch(o[c], i);
            if (e.mask && e.maskClose) {
                var a = t[b]("shar-mask")[0];
                u.touch(a,
                function() {
                    shar.close(n.index, e.end)
                })
            }
            if (e.closebtn) {
                var l = t[b]("shar-close")[0];
                u.touch(l,
                function() {
                    shar.close(n.index, e.end)
                })
            }
            e.end && (u.end[n.index] = e.end)
        },
        c.shar = {
            v: "1.0.5",
            index: m,
            open: function(e) {
                return new d(e || {}).index
            },
            alert: function(e, t) {
                var n = "function" == typeof t,
                i = u.extend({
                    content: e,
                    btn: a
                });
                return i = n ? u.extend({
                    yes: t
                },
                i) : u.extend(t, i),
                c.shar.open(i)
            },
            confirm: function(e, t, n, i) {
                var o = "function" == typeof t,
                s = u.extend({
                    content: e,
                    btn: [a, l]
                });
                return s = o ? u.extend({
                    yes: t,
                    no: n
                },
                s) : u.extend(t, s),
                c.shar.open(s)
            },
            toast: function(e, t) {
                var n = "function" == typeof t,
                i = u.extend({
                    type: 1,
                    content: e,
                    mask: 0,
                    closebtn: 0,
                    time: 2
                });
                return i = n ? u.extend({
                    end: t
                },
                i) : u.extend(t, i),
                c.shar.open(i)
            },
            loading: function(e) {
                var t = "function" == typeof e,
                n = u.extend({
                    type: 2,
                    content: 0,
                    mask: 0,
                    maskClose: 0,
                    closebtn: 0
                });
                return n = t ? u.extend({
                    end: e
                },
                n) : u.extend(e, n),
                c.shar.open(n)
            },
            iframe: function(e, t, n, i) {
                var o = "function" == typeof t,
                s = u.extend({
                    type: 3,
                    content: e,
                    mask: 0
                });
                return s = o ? u.extend({
                    yes: t,
                    no: n
                },
                s) : u.extend(t, s),
                c.shar.open(s)
            },
            close: function(e) {
                var t = p("#" + w[0] + e)[0];
                t && (t.innerHTML = "", f.body.removeChild(t), clearTimeout(u.timer[e]), delete u.timer[e], "function" == typeof u.end[e] && u.end[e](), delete u.end[e])
            },
            closeAll: function() {
                for (var e = f[b](w[0]), t = 0, n = e.length; t < n; t++) shar.close(0 | e[0].getAttribute("index"))
            }
        },
        "function" == typeof define ? define(function() {
            return shar
        }) : (t = document.scripts, n = t[t.length - 1], i = n.src, o = i.substring(0, i.lastIndexOf("/") + 1), n.getAttribute("assets") && document.head.appendChild(((e = f.createElement("link")).href = o + "shar.css", e.type = "text/css", e.rel = "styleSheet", e.id = "shar_css", e)))
    }
} (window);
function copyLink() {
	var Url2 = document.getElementById("post-link").innerText;
	var oInput = document.createElement("input");
	oInput.value = Url2;
	document.body.appendChild(oInput);
	oInput.select();
	document.execCommand("Copy");
	oInput.className = "oInput";
	oInput.style.display = "none";
	UIkit.notification("链接已复制！")
};