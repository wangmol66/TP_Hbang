webpackJsonp([0], [function(e, i, n) {
	(function(e) {
			"use strict";
			function i(e) {
				return e && e.__esModule ? e : {
					"default": e
				}
			}
			var t = n(2)
				, l = i(t);
			n(3);
			var c = n(4)
				, a = i(c);
			n(5);
			var s = n(9)
				, u = i(s)
				, o = n(11)
				, r = i(o)
				, d = n(14)
				, p = i(d)
				, f = n(19)
				, v = i(f)
				, _ = n(23)
				, w = i(_)
				, g = n(32)
				, h = i(g)
				, m = n(36)
				, b = i(m)
				, y = n(41)
				, C = i(y);
			a["default"].attach(document.body);
			var A = new l["default"];
			A.push(u["default"]).push(r["default"]).push(p["default"]).push(w["default"]).push(v["default"]).push(h["default"]).push(b["default"]).push(C["default"]).setDefault("/").init(),
				e.getJSON("https://weui.io/api/sign?url=" + encodeURIComponent(location.href.split("#")[0])).success(function(e) {
					wx.config({
						debug: !1,
						appId: e.appid,
						timestamp: e.timestamp,
						nonceStr: e.nonceStr,
						signature: e.signature,
						jsApiList: ["onMenuShareTimeline", "onMenuShareAppMessage", "onMenuShareQQ", "onMenuShareWeibo", "onMenuShareQZone"]
					});
					var i = {
						title: "WeUI",
						desc: "WeUI, 为微信 Web 服务量身设计",
						link: "https://weui.io/example",
						imgUrl: "https://mmrb.github.io/avatar/bear.jpg"
					};
					wx.onMenuShareAppMessage(i),
						wx.onMenuShareTimeline(i),
						wx.onMenuShareQQ(i)
				})
		}
	).call(i, n(1))
}
	, , , , function(e, i, n) {
		var t;
		!function() {
			"use strict";
			/**
			 * @preserve FastClick: polyfill to remove click delays on browsers with touch UIs.
			 *
			 * @codingstandard ftlabs-jsv2
			 * @copyright The Financial Times Limited [All Rights Reserved]
			 * @license MIT License (see LICENSE.txt)
			 */
			function l(e, i) {
				function n(e, i) {
					return function() {
						return e.apply(i, arguments)
					}
				}
				var t;
				if (i = i || {},
						this.trackingClick = !1,
						this.trackingClickStart = 0,
						this.targetElement = null ,
						this.touchStartX = 0,
						this.touchStartY = 0,
						this.lastTouchIdentifier = 0,
						this.touchBoundary = i.touchBoundary || 10,
						this.layer = e,
						this.tapDelay = i.tapDelay || 200,
						this.tapTimeout = i.tapTimeout || 700,
						!l.notNeeded(e)) {
					for (var c = ["onMouse", "onClick", "onTouchStart", "onTouchMove", "onTouchEnd", "onTouchCancel"], s = this, u = 0, o = c.length; o > u; u++)
						s[c[u]] = n(s[c[u]], s);
					a && (e.addEventListener("mouseover", this.onMouse, !0),
						e.addEventListener("mousedown", this.onMouse, !0),
						e.addEventListener("mouseup", this.onMouse, !0)),
						e.addEventListener("click", this.onClick, !0),
						e.addEventListener("touchstart", this.onTouchStart, !1),
						e.addEventListener("touchmove", this.onTouchMove, !1),
						e.addEventListener("touchend", this.onTouchEnd, !1),
						e.addEventListener("touchcancel", this.onTouchCancel, !1),
					Event.prototype.stopImmediatePropagation || (e.removeEventListener = function(i, n, t) {
							var l = Node.prototype.removeEventListener;
							"click" === i ? l.call(e, i, n.hijacked || n, t) : l.call(e, i, n, t)
						}
							,
							e.addEventListener = function(i, n, t) {
								var l = Node.prototype.addEventListener;
								"click" === i ? l.call(e, i, n.hijacked || (n.hijacked = function(e) {
											e.propagationStopped || n(e)
										}
									), t) : l.call(e, i, n, t)
							}
					),
					"function" == typeof e.onclick && (t = e.onclick,
						e.addEventListener("click", function(e) {
							t(e)
						}, !1),
						e.onclick = null )
				}
			}
			var c = navigator.userAgent.indexOf("Windows Phone") >= 0
				, a = navigator.userAgent.indexOf("Android") > 0 && !c
				, s = /iP(ad|hone|od)/.test(navigator.userAgent) && !c
				, u = s && /OS 4_\d(_\d)?/.test(navigator.userAgent)
				, o = s && /OS [6-7]_\d/.test(navigator.userAgent)
				, r = navigator.userAgent.indexOf("BB10") > 0;
			l.prototype.needsClick = function(e) {
				switch (e.nodeName.toLowerCase()) {
					case "button":
					case "select":
					case "textarea":
						if (e.disabled)
							return !0;
						break;
					case "input":
						if (s && "file" === e.type || e.disabled)
							return !0;
						break;
					case "label":
					case "iframe":
					case "video":
						return !0
				}
				return /\bneedsclick\b/.test(e.className)
			}
				,
				l.prototype.needsFocus = function(e) {
					switch (e.nodeName.toLowerCase()) {
						case "textarea":
							return !0;
						case "select":
							return !a;
						case "input":
							switch (e.type) {
								case "button":
								case "checkbox":
								case "file":
								case "image":
								case "radio":
								case "submit":
									return !1
							}
							return !e.disabled && !e.readOnly;
						default:
							return /\bneedsfocus\b/.test(e.className)
					}
				}
				,
				l.prototype.sendClick = function(e, i) {
					var n, t;
					document.activeElement && document.activeElement !== e && document.activeElement.blur(),
						t = i.changedTouches[0],
						n = document.createEvent("MouseEvents"),
						n.initMouseEvent(this.determineEventType(e), !0, !0, window, 1, t.screenX, t.screenY, t.clientX, t.clientY, !1, !1, !1, !1, 0, null ),
						n.forwardedTouchEvent = !0,
						e.dispatchEvent(n)
				}
				,
				l.prototype.determineEventType = function(e) {
					return a && "select" === e.tagName.toLowerCase() ? "mousedown" : "click"
				}
				,
				l.prototype.focus = function(e) {
					var i;
					s && e.setSelectionRange && 0 !== e.type.indexOf("date") && "time" !== e.type && "month" !== e.type ? (i = e.value.length,
						e.setSelectionRange(i, i)) : e.focus()
				}
				,
				l.prototype.updateScrollParent = function(e) {
					var i, n;
					if (i = e.fastClickScrollParent,
						!i || !i.contains(e)) {
						n = e;
						do {
							if (n.scrollHeight > n.offsetHeight) {
								i = n,
									e.fastClickScrollParent = n;
								break
							}
							n = n.parentElement
						} while (n)
					}
					i && (i.fastClickLastScrollTop = i.scrollTop)
				}
				,
				l.prototype.getTargetElementFromEventTarget = function(e) {
					return e.nodeType === Node.TEXT_NODE ? e.parentNode : e
				}
				,
				l.prototype.onTouchStart = function(e) {
					var i, n, t;
					if (e.targetTouches.length > 1)
						return !0;
					if (i = this.getTargetElementFromEventTarget(e.target),
							n = e.targetTouches[0],
							s) {
						if (t = window.getSelection(),
							t.rangeCount && !t.isCollapsed)
							return !0;
						if (!u) {
							if (n.identifier && n.identifier === this.lastTouchIdentifier)
								return e.preventDefault(),
									!1;
							this.lastTouchIdentifier = n.identifier,
								this.updateScrollParent(i)
						}
					}
					return this.trackingClick = !0,
						this.trackingClickStart = e.timeStamp,
						this.targetElement = i,
						this.touchStartX = n.pageX,
						this.touchStartY = n.pageY,
					e.timeStamp - this.lastClickTime < this.tapDelay && e.preventDefault(),
						!0
				}
				,
				l.prototype.touchHasMoved = function(e) {
					var i = e.changedTouches[0]
						, n = this.touchBoundary;
					return Math.abs(i.pageX - this.touchStartX) > n || Math.abs(i.pageY - this.touchStartY) > n
				}
				,
				l.prototype.onTouchMove = function(e) {
					return this.trackingClick ? ((this.targetElement !== this.getTargetElementFromEventTarget(e.target) || this.touchHasMoved(e)) && (this.trackingClick = !1,
						this.targetElement = null ),
						!0) : !0
				}
				,
				l.prototype.findControl = function(e) {
					return void 0 !== e.control ? e.control : e.htmlFor ? document.getElementById(e.htmlFor) : e.querySelector("button, input:not([type=hidden]), keygen, meter, output, progress, select, textarea")
				}
				,
				l.prototype.onTouchEnd = function(e) {
					var i, n, t, l, c, r = this.targetElement;
					if (!this.trackingClick)
						return !0;
					if (e.timeStamp - this.lastClickTime < this.tapDelay)
						return this.cancelNextClick = !0,
							!0;
					if (e.timeStamp - this.trackingClickStart > this.tapTimeout)
						return !0;
					if (this.cancelNextClick = !1,
							this.lastClickTime = e.timeStamp,
							n = this.trackingClickStart,
							this.trackingClick = !1,
							this.trackingClickStart = 0,
						o && (c = e.changedTouches[0],
							r = document.elementFromPoint(c.pageX - window.pageXOffset, c.pageY - window.pageYOffset) || r,
							r.fastClickScrollParent = this.targetElement.fastClickScrollParent),
							t = r.tagName.toLowerCase(),
						"label" === t) {
						if (i = this.findControl(r)) {
							if (this.focus(r),
									a)
								return !1;
							r = i
						}
					} else if (this.needsFocus(r))
						return e.timeStamp - n > 100 || s && window.top !== window && "input" === t ? (this.targetElement = null ,
							!1) : (this.focus(r),
							this.sendClick(r, e),
						s && "select" === t || (this.targetElement = null ,
							e.preventDefault()),
							!1);
					return s && !u && (l = r.fastClickScrollParent,
					l && l.fastClickLastScrollTop !== l.scrollTop) ? !0 : (this.needsClick(r) || (e.preventDefault(),
						this.sendClick(r, e)),
						!1)
				}
				,
				l.prototype.onTouchCancel = function() {
					this.trackingClick = !1,
						this.targetElement = null
				}
				,
				l.prototype.onMouse = function(e) {
					return this.targetElement ? e.forwardedTouchEvent ? !0 : e.cancelable && (!this.needsClick(this.targetElement) || this.cancelNextClick) ? (e.stopImmediatePropagation ? e.stopImmediatePropagation() : e.propagationStopped = !0,
						e.stopPropagation(),
						e.preventDefault(),
						!1) : !0 : !0
				}
				,
				l.prototype.onClick = function(e) {
					var i;
					return this.trackingClick ? (this.targetElement = null ,
						this.trackingClick = !1,
						!0) : "submit" === e.target.type && 0 === e.detail ? !0 : (i = this.onMouse(e),
					i || (this.targetElement = null ),
						i)
				}
				,
				l.prototype.destroy = function() {
					var e = this.layer;
					a && (e.removeEventListener("mouseover", this.onMouse, !0),
						e.removeEventListener("mousedown", this.onMouse, !0),
						e.removeEventListener("mouseup", this.onMouse, !0)),
						e.removeEventListener("click", this.onClick, !0),
						e.removeEventListener("touchstart", this.onTouchStart, !1),
						e.removeEventListener("touchmove", this.onTouchMove, !1),
						e.removeEventListener("touchend", this.onTouchEnd, !1),
						e.removeEventListener("touchcancel", this.onTouchCancel, !1)
				}
				,
				l.notNeeded = function(e) {
					var i, n, t, l;
					if ("undefined" == typeof window.ontouchstart)
						return !0;
					if (n = +(/Chrome\/([0-9]+)/.exec(navigator.userAgent) || [, 0])[1]) {
						if (!a)
							return !0;
						if (i = document.querySelector("meta[name=viewport]")) {
							if (-1 !== i.content.indexOf("user-scalable=no"))
								return !0;
							if (n > 31 && document.documentElement.scrollWidth <= window.outerWidth)
								return !0
						}
					}
					if (r && (t = navigator.userAgent.match(/Version\/([0-9]*)\.([0-9]*)/),
						t[1] >= 10 && t[2] >= 3 && (i = document.querySelector("meta[name=viewport]")))) {
						if (-1 !== i.content.indexOf("user-scalable=no"))
							return !0;
						if (document.documentElement.scrollWidth <= window.outerWidth)
							return !0
					}
					return "none" === e.style.msTouchAction || "manipulation" === e.style.touchAction ? !0 : (l = +(/Firefox\/([0-9]+)/.exec(navigator.userAgent) || [, 0])[1],
						l >= 27 && (i = document.querySelector("meta[name=viewport]"),
						i && (-1 !== i.content.indexOf("user-scalable=no") || document.documentElement.scrollWidth <= window.outerWidth)) ? !0 : "none" === e.style.touchAction || "manipulation" === e.style.touchAction)
				}
				,
				l.attach = function(e, i) {
					return new l(e,i)
				}
				,
				t = function() {
					return l
				}
					.call(i, n, i, e),
				!(void 0 !== t && (e.exports = t))
		}()
	}
	, function(e, i, n) {
		var t = n(6);
		"string" == typeof t && (t = [[e.id, t, ""]]);
		n(8)(t, {});
		t.locals && (e.exports = t.locals)
	}
	, function(e, i, n) {
		i = e.exports = n(7)(),
			i.push([e.id, "body{background-color:#efeff4}", ""])
	}
	, function(e, i) {
		e.exports = function() {
			var e = [];
			return e.toString = function() {
				for (var e = [], i = 0; i < this.length; i++) {
					var n = this[i];
					n[2] ? e.push("@media " + n[2] + "{" + n[1] + "}") : e.push(n[1])
				}
				return e.join("")
			}
				,
				e.i = function(i, n) {
					"string" == typeof i && (i = [[null , i, ""]]);
					for (var t = {}, l = 0; l < this.length; l++) {
						var c = this[l][0];
						"number" == typeof c && (t[c] = !0)
					}
					for (l = 0; l < i.length; l++) {
						var a = i[l];
						"number" == typeof a[0] && t[a[0]] || (n && !a[2] ? a[2] = n : n && (a[2] = "(" + a[2] + ") and (" + n + ")"),
							e.push(a))
					}
				}
				,
				e
		}
	}
	, function(e, i, n) {
		function t(e, i) {
			for (var n = 0; n < e.length; n++) {
				var t = e[n]
					, l = f[t.id];
				if (l) {
					l.refs++;
					for (var c = 0; c < l.parts.length; c++)
						l.parts[c](t.parts[c]);
					for (; c < t.parts.length; c++)
						l.parts.push(o(t.parts[c], i))
				} else {
					for (var a = [], c = 0; c < t.parts.length; c++)
						a.push(o(t.parts[c], i));
					f[t.id] = {
						id: t.id,
						refs: 1,
						parts: a
					}
				}
			}
		}
		function l(e) {
			for (var i = [], n = {}, t = 0; t < e.length; t++) {
				var l = e[t]
					, c = l[0]
					, a = l[1]
					, s = l[2]
					, u = l[3]
					, o = {
					css: a,
					media: s,
					sourceMap: u
				};
				n[c] ? n[c].parts.push(o) : i.push(n[c] = {
					id: c,
					parts: [o]
				})
			}
			return i
		}
		function c(e, i) {
			var n = w()
				, t = m[m.length - 1];
			if ("top" === e.insertAt)
				t ? t.nextSibling ? n.insertBefore(i, t.nextSibling) : n.appendChild(i) : n.insertBefore(i, n.firstChild),
					m.push(i);
			else {
				if ("bottom" !== e.insertAt)
					throw new Error("Invalid value for parameter 'insertAt'. Must be 'top' or 'bottom'.");
				n.appendChild(i)
			}
		}
		function a(e) {
			e.parentNode.removeChild(e);
			var i = m.indexOf(e);
			i >= 0 && m.splice(i, 1)
		}
		function s(e) {
			var i = document.createElement("style");
			return i.type = "text/css",
				c(e, i),
				i
		}
		function u(e) {
			var i = document.createElement("link");
			return i.rel = "stylesheet",
				c(e, i),
				i
		}
		function o(e, i) {
			var n, t, l;
			if (i.singleton) {
				var c = h++;
				n = g || (g = s(i)),
					t = r.bind(null , n, c, !1),
					l = r.bind(null , n, c, !0)
			} else
				e.sourceMap && "function" == typeof URL && "function" == typeof URL.createObjectURL && "function" == typeof URL.revokeObjectURL && "function" == typeof Blob && "function" == typeof btoa ? (n = u(i),
						t = p.bind(null , n),
						l = function() {
							a(n),
							n.href && URL.revokeObjectURL(n.href)
						}
				) : (n = s(i),
						t = d.bind(null , n),
						l = function() {
							a(n)
						}
				);
			return t(e),
				function(i) {
					if (i) {
						if (i.css === e.css && i.media === e.media && i.sourceMap === e.sourceMap)
							return;
						t(e = i)
					} else
						l()
				}
		}
		function r(e, i, n, t) {
			var l = n ? "" : t.css;
			if (e.styleSheet)
				e.styleSheet.cssText = b(i, l);
			else {
				var c = document.createTextNode(l)
					, a = e.childNodes;
				a[i] && e.removeChild(a[i]),
					a.length ? e.insertBefore(c, a[i]) : e.appendChild(c)
			}
		}
		function d(e, i) {
			var n = i.css
				, t = i.media;
			if (t && e.setAttribute("media", t),
					e.styleSheet)
				e.styleSheet.cssText = n;
			else {
				for (; e.firstChild; )
					e.removeChild(e.firstChild);
				e.appendChild(document.createTextNode(n))
			}
		}
		function p(e, i) {
			var n = i.css
				, t = i.sourceMap;
			t && (n += "\n/*# sourceMappingURL=data:application/json;base64," + btoa(unescape(encodeURIComponent(JSON.stringify(t)))) + " */");
			var l = new Blob([n],{
				type: "text/css"
			})
				, c = e.href;
			e.href = URL.createObjectURL(l),
			c && URL.revokeObjectURL(c)
		}
		var f = {}
			, v = function(e) {
			var i;
			return function() {
				return "undefined" == typeof i && (i = e.apply(this, arguments)),
					i
			}
		}
			, _ = v(function() {
			return /msie [6-9]\b/.test(window.navigator.userAgent.toLowerCase())
		})
			, w = v(function() {
			return document.head || document.getElementsByTagName("head")[0]
		})
			, g = null
			, h = 0
			, m = [];
		e.exports = function(e, i) {
			i = i || {},
			"undefined" == typeof i.singleton && (i.singleton = _()),
			"undefined" == typeof i.insertAt && (i.insertAt = "bottom");
			var n = l(e);
			return t(n, i),
				function(e) {
					for (var c = [], a = 0; a < n.length; a++) {
						var s = n[a]
							, u = f[s.id];
						u.refs--,
							c.push(u)
					}
					if (e) {
						var o = l(e);
						t(o, i)
					}
					for (var a = 0; a < c.length; a++) {
						var u = c[a];
						if (0 === u.refs) {
							for (var r = 0; r < u.parts.length; r++)
								u.parts[r]();
							delete f[u.id]
						}
					}
				}
		}
		;
		var b = function() {
			var e = [];
			return function(i, n) {
				return e[i] = n,
					e.filter(Boolean).join("\n")
			}
		}()
	}
	, function(e, i, n) {
		"use strict";
		function t(e) {
			return e && e.__esModule ? e : {
				"default": e
			}
		}
		Object.defineProperty(i, "__esModule", {
			value: !0
		});
		var l = n(10)
			, c = t(l);
		i["default"] = {
			url: "/",
			className: "home",
			render: function() {
				return c["default"]
			}
		}
	}
	, function(e, i) {
		e.exports = '<div class="weui_cells_title">场景示例</div>\n<div class="weui_cells weui_cells_access">\n    <a href="#/register" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>注册登录</p>\n        </div>\n        <div class="weui_cell_ft"></div>\n    </a>\n    <a href="#/profile" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>用户中心</p>\n        </div>\n        <div class="weui_cell_ft"></div>\n    </a>\n    <a href="#/swiper" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>Swiper</p>\n        </div>\n        <div class="weui_cell_ft"></div>\n    </a>\n    <a href="#/setting" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>设置</p>\n        </div>\n        <div class="weui_cell_ft"></div>\n    </a>\n    <a href="#/check" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>选项列表</p>\n        </div>\n        <div class="weui_cell_ft"></div>\n    </a>\n    <a href="#/uploader" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>图片上传</p>\n        </div>\n        <div class="weui_cell_ft"></div>\n    </a>\n    <a href="#/list" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>图文列表</p>\n        </div>\n        <div class="weui_cell_ft">下拉刷新</div>\n    </a>\n</div>\n\n<div class="weui_cells_title">应用示例</div>\n<div class="weui_cells weui_cells_access">\n    <a href="http://www.shiciclass.com/sso.php?action=wxvip" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>诗词文学会员中心</p>\n        </div>\n        <div class="weui_cell_ft"></div>\n    </a>\n    <a href="https://res.wx.qq.com/a/wx_fed/feedback/15060201/weixin_feedback_index.html" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>意见反馈</p>\n        </div>\n        <div class="weui_cell_ft"></div>\n    </a>\n    <a href="https://team.weui.io/jfeng/weui-wechat" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>weui-wechat</p>\n        </div>\n        <div class="weui_cell_ft"></div>\n    </a>\n    <a href="https://progrape.github.io/todo" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>TODO</p>\n        </div>\n        <div class="weui_cell_ft"></div>\n    </a>\n</div>'
	}
	, function(e, i, n) {
		"use strict";
		function t(e) {
			return e && e.__esModule ? e : {
				"default": e
			}
		}
		Object.defineProperty(i, "__esModule", {
			value: !0
		});
		var l = n(1)
			, c = t(l);
		n(12);
		var a = n(13)
			, s = t(a);
		i["default"] = {
			url: "/register",
			className: "register",
			render: function() {
				return s["default"]
			},
			bind: function() {
				(0,
					c["default"])("#registerForm").form(),
					(0,
						c["default"])(this).on("click", ".js_btn", function() {
						(0,
							c["default"])("#registerForm").validate(function(e) {
							if (!e) {
								c["default"].weui.loading("数据提交中...");
								var i = (0,
									c["default"])("#registerForm").serialize();
								c["default"].post("/api/v1/user", i).success(function(e) {
									console.log(e)
								}).error(function(e) {
									console.log(e)
								}).always(function() {
									setTimeout(function() {
										c["default"].weui.hideLoading(),
											c["default"].weui.toast("注册成功")
									}, 800)
								})
							}
						})
					})
			}
		}
	}
	, , function(e, i) {
		e.exports = '<form id="registerForm">\n    <div class="weui_cells_title">用户注册</div>\n    <div class="weui_cells weui_cells_form">\n        <div class="weui_cell">\n            <div class="weui_cell_hd">\n                <label for="" class="weui_label">用户名</label>\n            </div>\n            <div class="weui_cell_bd weui_cell_primary">\n                <input type="text" name="username" class="weui_input" required placeholder="请输入用户名">\n            </div>\n            <div class="weui_cell_ft">\n                <i class="weui_icon_warn"></i>\n            </div>\n        </div>\n        <div class="weui_cell">\n            <div class="weui_cell_hd">\n                <label for="" class="weui_label">手机号</label>\n            </div>\n            <div class="weui_cell_bd weui_cell_primary">\n                <input type="tel" name="tel" class="weui_input" required pattern="[\\d]{8,11}" notMatchTips="请输入正确的手机号" placeholder="请输入手机号">\n            </div>\n            <div class="weui_cell_ft">\n                <i class="weui_icon_warn"></i>\n            </div>\n        </div>\n        <div class="weui_cell">\n            <div class="weui_cell_hd">\n                <label for="" class="weui_label">密码</label>\n            </div>\n            <div class="weui_cell_bd weui_cell_primary">\n                <input type="password" name="password" class="weui_input" required pattern="[\\w]{6,}" notMatchTips="密码至少6位" placeholder="请输入密码">\n            </div>\n            <div class="weui_cell_ft">\n                <i class="weui_icon_warn"></i>\n            </div>\n        </div>\n    </div>\n    <p class="weui_cells_tips">在微信里面其实可以调网页授权的</p>\n\n    <div class="weui_btn_area">\n        <a href="javascript:;" class="weui_btn weui_btn_primary js_btn">注册</a>\n    </div>\n</form>'
	}
	, function(e, i, n) {
		"use strict";
		function t(e) {
			return e && e.__esModule ? e : {
				"default": e
			}
		}
		Object.defineProperty(i, "__esModule", {
			value: !0
		});
		var l = n(1)
			, c = t(l);
		n(12);
		var a = n(15)
			, s = (t(a),
			n(16))
			, u = t(s);
		n(17),
			i["default"] = {
				url: "/profile",
				className: "profile",
				render: function() {
					return u["default"]
				},
				bind: function() {
					(0,
						c["default"])(this).on("click", "#avatarCell", function() {
						c["default"].weui.actionSheet([{
							label: "拍照",
							onClick: function() {}
						}, {
							label: "从手机相册选择",
							onClick: function() {}
						}, {
							label: "保存图片",
							onClick: function() {}
						}])
					})
				}
			}
	}
	, , function(e, i) {
		e.exports = '<div class="weui_cells weui_cells_access">\n    <div class="weui_cell" id="avatarCell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>头像</p>\n        </div>\n        <div class="weui_cell_ft">\n            <img class="weui_avatar" src="https://team.weui.io/avatar/bear.jpg" alt="">\n        </div>\n    </div>\n    <div class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>姓名</p>\n        </div>\n        <div class="weui_cell_ft">\n            bear\n        </div>\n    </div>\n    <div class="weui_cell no_access">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>微信号</p>\n        </div>\n        <div class="weui_cell_ft">\n            bear\n        </div>\n    </div>\n    <div class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>我的二维码</p>\n        </div>\n        <div class="weui_cell_ft">\n\n        </div>\n    </div>\n    <div class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>我的地址</p>\n        </div>\n        <div class="weui_cell_ft">\n\n        </div>\n    </div>\n</div>\n<div class="weui_cells weui_cells_access">\n    <a href="javascript:;" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>性别</p>\n        </div>\n        <div class="weui_cell_ft">\n            男\n        </div>\n    </a>\n    <a href="javascript:;" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>地区</p>\n        </div>\n        <div class="weui_cell_ft">\n            奥地利 维也纳\n        </div>\n    </a>\n    <a href="javascript:;" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>个性签名</p>\n        </div>\n        <div class="weui_cell_ft">\n            未设置\n        </div>\n    </a>\n</div>\n<div class="weui_cells weui_cells_access">\n    <a href="javascript:;" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>LinkedIn帐号</p>\n        </div>\n        <div class="weui_cell_ft">\n            未设置\n        </div>\n    </a>\n</div>'
	}
	, function(e, i, n) {
		var t = n(18);
		"string" == typeof t && (t = [[e.id, t, ""]]);
		n(8)(t, {});
		t.locals && (e.exports = t.locals)
	}
	, function(e, i, n) {
		i = e.exports = n(7)(),
			i.push([e.id, ".weui_avatar{width:52px;height:52px;border-radius:4px;vertical-align:middle}", ""])
	}
	, function(e, i, n) {
		"use strict";
		function t(e) {
			return e && e.__esModule ? e : {
				"default": e
			}
		}
		Object.defineProperty(i, "__esModule", {
			value: !0
		}),
			n(12);
		var l = n(20)
			, c = t(l)
			, a = n(21);
		t(a);
		i["default"] = {
			url: "/setting",
			className: "setting",
			render: function() {
				return c["default"]
			},
			bind: function() {}
		}
	}
	, function(e, i) {
		e.exports = '<div class="weui_cells">\n    <div class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">接收新消息通知</div>\n        <div class="weui_cell_ft">已开启</div>\n    </div>\n</div>\n<div class="weui_cells_tips">如果你要关闭或开启微信的新消息通知,请在 iPhone 的"设置"——"通知"功能中, 找到应用程序"微信"更改。</div>\n<div class="weui_cells weui_cells_form">\n    <div class="weui_cell weui_cell_switch">\n        <div class="weui_cell_bd weui_cell_primary">通知显示消息详情</div>\n        <div class="weui_cell_ft">\n            <input type="checkbox" class="weui_switch">\n        </div>\n    </div>\n</div>\n<div class="weui_cells_tips">关闭后, 当收到微信消息时, 通知提示将不显示发信人和内容摘要.</div>\n<div class="weui_cells weui_cells_access">\n    <div class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">功能消息免打扰</div>\n        <div class="weui_cell_ft"></div>\n    </div>\n</div>\n<div class="weui_cells_tips">设置系统功能消息提示声音和振动的时段。</div>\n<div class="weui_cells weui_cells_form">\n    <div class="weui_cell weui_cell_switch">\n        <div class="weui_cell_bd weui_cell_primary">声音</div>\n        <div class="weui_cell_ft">\n            <input type="checkbox" class="weui_switch">\n        </div>\n    </div>\n    <div class="weui_cell weui_cell_switch">\n        <div class="weui_cell_bd weui_cell_primary">振动</div>\n        <div class="weui_cell_ft">\n            <input type="checkbox" class="weui_switch" checked>\n        </div>\n    </div>\n</div>\n<div class="weui_cells_tips">当微信在运行时, 你可以设置是否需要声音或者振动。</div>\n<div class="weui_cells weui_cells_form">\n    <div class="weui_cell weui_cell_switch">\n        <div class="weui_cell_bd weui_cell_primary">朋友圈照片更新</div>\n        <div class="weui_cell_ft">\n            <input type="checkbox" class="weui_switch" checked>\n        </div>\n    </div>\n</div>\n<div class="weui_cells_tips">关闭后, 有朋友更新照片时, 界面下面的"发现"切换按钮上不再出现红点提示。</div>'
	}
	, function(e, i, n) {
		var t = n(22);
		"string" == typeof t && (t = [[e.id, t, ""]]);
		n(8)(t, {});
		t.locals && (e.exports = t.locals)
	}
	, function(e, i, n) {
		i = e.exports = n(7)(),
			i.push([e.id, "", ""])
	}
	, function(e, i, n) {
		"use strict";
		function t(e) {
			return e && e.__esModule ? e : {
				"default": e
			}
		}
		Object.defineProperty(i, "__esModule", {
			value: !0
		}),
			n(12);
		var l = n(15)
			, c = t(l)
			, a = n(24)
			, s = t(a)
			, u = n(25)
			, o = t(u);
		n(26);
		var r = n(28)
			, d = t(r)
			, p = n(29)
			, f = t(p)
			, v = n(30)
			, _ = t(v)
			, w = n(31)
			, g = t(w);
		i["default"] = {
			url: "/swiper",
			className: "swiper-wrapper",
			render: function() {
				return c["default"].compile(o["default"])({
					items: [d["default"], f["default"], _["default"], g["default"]]
				})
			},
			bind: function() {
				var e = new s["default"]({
					direction: "horizontal"
				});
				e.on("swiped", function(e, i) {
					console.log("prev", e),
						console.log("current", i)
				})
			}
		}
	}
	, , function(e, i) {
		e.exports = '<div class="swiper">\n    {{each items as item i}}\n    <div class="item" style="background: url(\'{{item}}\'); background-size: cover; -webkit-background-size: cover;">\n\n    </div>\n    {{/each}}\n</div>'
	}
	, function(e, i, n) {
		var t = n(27);
		"string" == typeof t && (t = [[e.id, t, ""]]);
		n(8)(t, {});
		t.locals && (e.exports = t.locals)
	}
	, function(e, i, n) {
		i = e.exports = n(7)(),
			i.push([e.id, ".swiper,.swiper-wrapper{overflow:hidden}.swiper{height:200px;-webkit-transition:all .3s ease;transition:all .3s ease}.item{height:100%;background-position:50%;background-size:cover;position:relative;overflow:hidden;float:left}.item.active .animated{-webkit-animation-fill-mode:both;animation-fill-mode:both;opacity:1}.item:not(.active) .animated{-webkit-animation:none;animation:none;opacity:0}", ""])
	}
	, function(e, i, n) {
		e.exports = n.p + "8d009c9d91ea14721eaff19d32237d40.png"
	}
	, function(e, i, n) {
		e.exports = n.p + "b8506bdb1a762806f909f5c12cf8d92b.png"
	}
	, function(e, i, n) {
		e.exports = n.p + "b87cd3b87e12ff32ce7c52b6c3a13945.png"
	}
	, function(e, i, n) {
		e.exports = n.p + "47e04b2447b9170b0657988bf64d2126.png"
	}
	, function(e, i, n) {
		(function(e) {
				"use strict";
				function t(e) {
					return e && e.__esModule ? e : {
						"default": e
					}
				}
				Object.defineProperty(i, "__esModule", {
					value: !0
				}),
					n(12);
				var l = n(33)
					, c = t(l);
				n(34),
					i["default"] = {
						url: "/check",
						className: "check",
						render: function() {
							return c["default"]
						},
						bind: function() {
							e(this).on("click", "#checkListBtn", function() {
								var i = e("form").serialize()
									, n = JSON.stringify(i).replace(/"/gi, "").replace(/&/gi, "<br>");
								e.weui.confirm(n, function() {
									console.log(i),
										e.weui.loading("提交中..."),
										e.post("/api/v1/user", i).success(function(e) {
											console.log(e)
										}).error(function(e) {
											console.log(e)
										}).always(function() {
											setTimeout(function() {
												e.weui.hideLoading(),
													e.weui.toast("提交成功")
											}, 1e3)
										})
								})
							})
						}
					}
			}
		).call(i, n(1))
	}
	, function(e, i) {
		e.exports = '<form>\n    <div class="weui_cells_title">性别</div>\n    <div class="weui_cells weui_cells_radio">\n        <label class="weui_cell weui_check_label" for="x11">\n            <div class="weui_cell_bd weui_cell_primary">\n                <p>男</p>\n            </div>\n            <div class="weui_cell_ft">\n                <input type="radio" value="male" class="weui_check" name="gender" id="x11"  checked="checked">\n                <span class="weui_icon_checked"></span>\n            </div>\n        </label>\n        <label class="weui_cell weui_check_label" for="x12">\n            <div class="weui_cell_bd weui_cell_primary">\n                <p>女</p>\n            </div>\n            <div class="weui_cell_ft">\n                <input type="radio" value="female" name="gender" class="weui_check" id="x12">\n                <span class="weui_icon_checked"></span>\n            </div>\n        </label>\n        <label class="weui_cell weui_check_label" for="x13">\n            <div class="weui_cell_bd weui_cell_primary">\n                <p>未知</p>\n            </div>\n            <div class="weui_cell_ft">\n                <input type="radio" value="unknow" name="gender" class="weui_check" id="x13">\n                <span class="weui_icon_checked"></span>\n            </div>\n        </label>\n    </div>\n    <div class="weui_cells_title">兴趣爱好</div>\n    <div class="weui_cells weui_cells_checkbox">\n        <label class="weui_cell weui_check_label" for="s11">\n            <div class="weui_cell_hd">\n                <input type="checkbox" value="coding" class="weui_check" name="hobby" id="s11" checked="checked">\n                <i class="weui_icon_checked"></i>\n            </div>\n            <div class="weui_cell_bd weui_cell_primary">\n                <p>写代码</p>\n            </div>\n        </label>\n        <label class="weui_cell weui_check_label" for="s12">\n            <div class="weui_cell_hd">\n                <input type="checkbox" value="fixBug" name="hobby" class="weui_check" id="s12">\n                <i class="weui_icon_checked"></i>\n            </div>\n            <div class="weui_cell_bd weui_cell_primary">\n                <p>修 bug</p>\n            </div>\n        </label>\n        <label class="weui_cell weui_check_label" for="s13">\n            <div class="weui_cell_hd">\n                <input type="checkbox" value="fixOtherDeBug" name="hobby" class="weui_check" id="s13">\n                <i class="weui_icon_checked"></i>\n            </div>\n            <div class="weui_cell_bd weui_cell_primary">\n                <p>修别人的 bug</p>\n            </div>\n        </label>\n    </div>\n    <div class="weui_cells_title">其他</div>\n    <div class="weui_cells weui_cells_form">\n        <div class="weui_cell weui_cell_switch">\n            <div class="weui_cell_hd weui_cell_primary">已婚</div>\n            <div class="weui_cell_ft">\n                <input class="weui_switch" name="isMarry" value="true" checked type="checkbox">\n            </div>\n        </div>\n    </div>\n    <div class="weui_btn_area">\n        <a class="weui_btn weui_btn_primary" href="javascript:" id="checkListBtn">提交</a>\n    </div>\n</form>'
	}
	, function(e, i, n) {
		var t = n(35);
		"string" == typeof t && (t = [[e.id, t, ""]]);
		n(8)(t, {});
		t.locals && (e.exports = t.locals)
	}
	, function(e, i, n) {
		i = e.exports = n(7)(),
			i.push([e.id, ".weui_cells_checkbox>.weui_cell>*,.weui_cells_radio>.weui_cell>*{pointer-events:none}", ""])
	}
	, function(e, i, n) {
		(function(e) {
				"use strict";
				function t(e) {
					return e && e.__esModule ? e : {
						"default": e
					}
				}
				function l(e) {
					if (e && e.__esModule)
						return e;
					var i = {};
					if (null != e)
						for (var n in e)
							Object.prototype.hasOwnProperty.call(e, n) && (i[n] = e[n]);
					return i["default"] = e,
						i
				}
				Object.defineProperty(i, "__esModule", {
					value: !0
				}),
					n(12);
				var c = n(37)
					, a = l(c)
					, s = n(38)
					, u = t(s)
					, o = n(39);
				t(o);
				i["default"] = {
					url: "/uploader",
					className: "uploader",
					render: function() {
						return u["default"]
					},
					bind: function() {
						var i = this
							, n = [];
						e(this).on("change", "#file", function(t) {
							var l = event.target.files[0];
							l && (e.weui.loading("压缩中..."),
								a.compress(l, 400, function(t, l) {
									e.weui.hideLoading(),
										t ? (e.weui.alert("压缩图片发生异常"),
											console.log(t)) : (e(i).find(".weui_uploader_files").append(e('<li class="weui_uploader_file" style="background-image:url(' + URL.createObjectURL(l.blob) + ')"></li>')),
											n.push(l),
											e("#uploadCounter").text(n.length),
										n.length >= 4 && e(i).find(".weui_uploader_input_wrp").hide())
								}))
						}).on("click", ".weui_uploader_file", function() {
							var i = this
								, t = e(this).index();
							e.weui.confirm("是否要删除这张图片?", function() {
								n.splice(t, 1),
									e(i).remove(),
									e("#uploadCounter").text(n.length),
									e(".weui_uploader_input_wrp").show()
							})
						}).on("click", "#uploadBtn", function() {
							function i(i, n) {
								var t = new FormData;
								t.append("file", i.blob, i.name),
									e.ajax({
										type: "POST",
										url: "/api/upload",
										data: t,
										processData: !1,
										contentType: !1
									}).success(function(e) {}).error(function(e) {}).always(function() {
										e(".weui_uploader_file").eq(n).addClass("weui_uploader_status").html('<div class="weui_uploader_status_content"> <i class="weui_icon_warn"></i> </div>')
									})
							}
							n.map(i)
						})
					}
				}
			}
		).call(i, n(1))
	}
	, function(e, i) {
		"use strict";
		function n(e) {
			var i = arguments.length <= 1 || void 0 === arguments[1] ? 1 : arguments[1]
				, n = arguments.length <= 2 || void 0 === arguments[2] ? function() {}
				: arguments[2]
				, l = new FileReader;
			l.onload = function(l) {
				var c = new Image;
				c.onload = function() {
					var l = 1 >= i ? c.width * i : i
						, a = c.height * (l / c.width)
						, s = document.createElement("canvas")
						, u = s.getContext("2d");
					s.width = l,
						s.height = a,
						u.drawImage(c, 0, 0, l, a);
					var o = s.toDataURL()
						, r = t(o);
					n(null , {
						name: e.name,
						blob: r
					})
				}
					,
					c.onerror = function(e) {
						n(e)
					}
					,
					c.src = l.target.result
			}
				,
				l.readAsDataURL(e)
		}
		Object.defineProperty(i, "__esModule", {
			value: !0
		}),
			i.compress = n;
		var t = i.dataURItoBlob = function(e) {
			for (var i = atob(e.split(",")[1]), n = e.split(",")[0].split(":")[1].split(";")[0], t = new ArrayBuffer(i.length), l = new Uint8Array(t), c = 0; c < i.length; c++)
				l[c] = i.charCodeAt(c);
			return new Blob([t],{
				type: n
			})
		}
	}
	, function(e, i) {
		e.exports = '<div class="weui_cells_title">上传</div>\n<div class="weui_cells weui_cells_form">\n    <div class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <div class="weui_uploader">\n                <div class="weui_uploader_hd weui_cell">\n                    <div class="weui_cell_bd weui_cell_primary">图片上传</div>\n                    <div class="weui_cell_ft"><span id="uploadCounter">0</span>/4</div>\n                </div>\n                <div class="weui_uploader_bd">\n                    <ul class="weui_uploader_files">\n\n                    </ul>\n                    <div class="weui_uploader_input_wrp">\n                        <input id="file" class="weui_uploader_input" type="file" accept="image/jpg,image/jpeg,image/png,image/gif">\n                    </div>\n                </div>\n            </div>\n        </div>\n    </div>\n</div>\n<div class="weui_cells_tips">因为没有后端接收，所以此处文件上传会失败</div>\n<div class="weui_btn_area">\n    <a href="javascript:;" class="weui_btn weui_btn_primary" id="uploadBtn">上传</a>\n</div>'
	}
	, function(e, i, n) {
		var t = n(40);
		"string" == typeof t && (t = [[e.id, t, ""]]);
		n(8)(t, {});
		t.locals && (e.exports = t.locals)
	}
	, function(e, i, n) {
		i = e.exports = n(7)(),
			i.push([e.id, "", ""])
	}
	, function(e, i, n) {
		"use strict";
		function t(e) {
			return e && e.__esModule ? e : {
				"default": e
			}
		}
		Object.defineProperty(i, "__esModule", {
			value: !0
		});
		var l = n(1)
			, c = t(l);
		n(12),
			n(42);
		var a = n(15)
			, s = t(a)
			, u = n(43)
			, o = t(u)
			, r = n(44)
			, d = t(r);
		n(45),
			i["default"] = {
				url: "/list",
				render: function() {
					return s["default"].compile(d["default"])({
						list: o["default"]
					})
				},
				bind: function() {
					(0,
						c["default"])(".weui_pull").pull({
						onRefresh: function(e) {
							setTimeout(e, 1e3)
						}
					})
				}
			}
	}
	, function(e, i, n) {
		"use strict";
		function t(e) {
			return e && e.__esModule ? e : {
				"default": e
			}
		}
		var l = n(1)
			, c = t(l)
			, a = function() {
				return document.documentElement.scrollTop || document.body.scrollTop
			}
			, s = function(e, i) {
				return e.css({
					"-webkit-transition": "all " + i + "s",
					transition: "all " + i + "s"
				})
			}
			, u = function(e, i) {
				return e.css({
					"-webkit-transform": "translate3d(0, " + i + "px, 0)",
					transform: "translate3d(0, " + i + "px, 0)"
				})
			}
			;
		c["default"].fn.pull = function(e) {
			var i = c["default"].extend({
				offset: 40,
				threshold: 100,
				onRefresh: function(e) {
					e(null )
				}
			}, e)
				, n = void 0
				, t = void 0;
			(0,
				c["default"])(this).on("touchstart", function(e) {
				a() <= 0 && (n = e.originalEvent.touches[0].pageY,
					t = 0,
					s((0,
						c["default"])(this), 0),
					(0,
						c["default"])(".weui_pull_tips").find("span").text("下拉刷新").siblings("i").hide())
			}).on("touchmove", function(e) {
				a() <= 0 && (t = e.originalEvent.touches[0].pageY,
				t > n && (e.preventDefault(),
					s((0,
						c["default"])(this), 0),
					u((0,
						c["default"])(this), .6 * (t - n - i.offset))))
			}).on("touchend", function(e) {
				var l = this;
				a() <= 0 && (t - n >= i.threshold ? (s((0,
					c["default"])(this), .3),
					u((0,
						c["default"])(this), 0),
					(0,
						c["default"])(".weui_pull_tips").find("span").text("刷新中").siblings("i").show(),
				"function" == typeof i.onRefresh && i.onRefresh.call((0,
					c["default"])(this), function(e) {
					s((0,
						c["default"])(l), .3),
						u((0,
							c["default"])(l), 0 - i.offset)
				})) : (s((0,
					c["default"])(this), .3),
					u((0,
						c["default"])(this), 0 - i.offset)))
			})
		}
	}
	, function(e, i) {
		"use strict";
		Object.defineProperty(i, "__esModule", {
			value: !0
		});
		for (var n = [], t = 0; 50 > t; t++)
			n.push({
				thumb: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAB4CAMAAAAOusbgAAAAeFBMVEUAwAD///+U5ZTc9twOww7G8MYwzDCH4YcfyR9x23Hw+/DY9dhm2WZG0kbT9NP0/PTL8sux7LFe115T1VM+zz7i+OIXxhes6qxr2mvA8MCe6J6M4oz6/frr+us5zjn2/fa67rqB4IF13XWn6ad83nxa1loqyirn+eccHxx4AAAC/klEQVRo3u2W2ZKiQBBF8wpCNSCyLwri7v//4bRIFVXoTBBB+DAReV5sG6lTXDITiGEYhmEYhmEYhmEYhmEY5v9i5fsZGRx9PyGDne8f6K9cfd+mKXe1yNG/0CcqYE86AkBMBh66f20deBc7wA/1WFiTwvSEpBMA2JJOBsSLxe/4QEEaJRrASP8EVF8Q74GbmevKg0saa0B8QbwBdjRyADYxIhqxAZ++IKYtciPXLQVG+imw+oo4Bu56rjEJ4GYsvPmKOAB+xlz7L5aevqUXuePWVhvWJ4eWiwUQ67mK51qPj4dFDMlRLBZTqF3SDvmr4BwtkECu5gHWPkmDfQh02WLxXuvbvC8ku8F57GsI5e0CmUwLz1kq3kD17R1In5816rGvQ5VMk5FEtIiWislTffuDpl/k/PzscdQsv8r9qWq4LRWX6tQYtTxvI3XyrwdyQxChXioOngH3dLgOFjk0all56XRi/wDFQrGQU3Os5t0wJu1GNtNKHdPqYaGYQuRDfbfDf26AGLYSyGS3ZAK4S8XuoAlxGSdYMKwqZKM9XJMtyqXi7HX/CiAZS6d8bSVUz5J36mEMFDTlAFQzxOT1dzLRljjB6+++ejFqka+mXIe6F59mw22OuOw1F4T6lg/9VjL1rLDoI9Xzl1MSYDNHnPQnt3D1EE7PrXjye/3pVpr1Z45hMUdcACc5NVQI0bOdS1WA0wuz73e7/5TNqBPhQXPEFGJNV2zNqWI7QKBd2Gn6AiBko02zuAOXeWIXjV0jNqdKegaE/kJQ6Bfs4aju04lMLkA2T5wBSYPKDGF3RKhFYEa6A1L1LG2yacmsaZ6YPOSAMKNsO+N5dNTfkc5Aqe26uxHpx7ZirvgCwJpWq/lmX1hA7LyabQ34tt5RiJKXSwQ+0KU0V5xg+hZrd4Bn1n4EID+WkQdgLfRNtvil9SPfwy+WQ7PFBWQz6dGWZBLkeJFXZGCfLUjCgGgqXo5TuSu3cugdcTv/HjqnBTEMwzAMwzAMwzAMwzAMw/zf/AFbXiOA6frlMAAAAABJRU5ErkJggg==",
				title: "标题" + t,
				desc: "由各种物质组成的巨型球状天体，叫做星球。星球有一定的形状，有自己的运行轨道。"
			});
		i["default"] = n
	}
	, function(e, i) {
		e.exports = '<div class="weui_pull">\n    <p class="weui_pull_tips">\n        <i class="weui_pull_loading"></i>\n        <span>下拉刷新</span>\n    </p>\n\n    <div class="weui_panel weui_panel_access">\n        <div class="weui_panel_bd">\n            {{each list as item i}}\n            <a href="javascript:void(0);" class="weui_media_box weui_media_appmsg">\n                <div class="weui_media_hd">\n                    <img class="weui_media_appmsg_thumb" src="{{item.thumb}}" alt="">\n                </div>\n                <div class="weui_media_bd">\n                    <h4 class="weui_media_title">{{item.title}}</h4>\n\n                    <p class="weui_media_desc">{{item.desc}}</p>\n                </div>\n            </a>\n            {{/each}}\n        </div>\n    </div>\n</div>'
	}
	, function(e, i, n) {
		var t = n(46);
		"string" == typeof t && (t = [[e.id, t, ""]]);
		n(8)(t, {});
		t.locals && (e.exports = t.locals)
	}
	, function(e, i, n) {
		i = e.exports = n(7)(),
			i.push([e.id, ".weui_panel{margin-top:0}.weui_pull{-webkit-transform:translate3d(0,-40px,0);transform:translate3d(0,-40px,0)}.weui_pull_tips{text-align:center;font-size:12px;padding:10px;color:#888}.weui_pull_loading{width:16px;height:16px;display:inline-block;vertical-align:-4px;-webkit-animation:loadingAnimation 1s steps(12) infinite;animation:loadingAnimation 1s steps(12) infinite;background:transparent url(data:image/svg+xml;base64,PHN2ZyBjbGFzcz0iciIgd2lkdGg9JzEyMHB4JyBoZWlnaHQ9JzEyMHB4JyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMDAgMTAwIj4KICAgIDxyZWN0IHg9IjAiIHk9IjAiIHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiBmaWxsPSJub25lIiBjbGFzcz0iYmsiPjwvcmVjdD4KICAgIDxyZWN0IHg9JzQ2LjUnIHk9JzQwJyB3aWR0aD0nNycgaGVpZ2h0PScyMCcgcng9JzUnIHJ5PSc1JyBmaWxsPScjRTlFOUU5JwogICAgICAgICAgdHJhbnNmb3JtPSdyb3RhdGUoMCA1MCA1MCkgdHJhbnNsYXRlKDAgLTMwKSc+CiAgICA8L3JlY3Q+CiAgICA8cmVjdCB4PSc0Ni41JyB5PSc0MCcgd2lkdGg9JzcnIGhlaWdodD0nMjAnIHJ4PSc1JyByeT0nNScgZmlsbD0nIzk4OTY5NycKICAgICAgICAgIHRyYW5zZm9ybT0ncm90YXRlKDMwIDUwIDUwKSB0cmFuc2xhdGUoMCAtMzApJz4KICAgICAgICAgICAgICAgICByZXBlYXRDb3VudD0naW5kZWZpbml0ZScvPgogICAgPC9yZWN0PgogICAgPHJlY3QgeD0nNDYuNScgeT0nNDAnIHdpZHRoPSc3JyBoZWlnaHQ9JzIwJyByeD0nNScgcnk9JzUnIGZpbGw9JyM5Qjk5OUEnCiAgICAgICAgICB0cmFuc2Zvcm09J3JvdGF0ZSg2MCA1MCA1MCkgdHJhbnNsYXRlKDAgLTMwKSc+CiAgICAgICAgICAgICAgICAgcmVwZWF0Q291bnQ9J2luZGVmaW5pdGUnLz4KICAgIDwvcmVjdD4KICAgIDxyZWN0IHg9JzQ2LjUnIHk9JzQwJyB3aWR0aD0nNycgaGVpZ2h0PScyMCcgcng9JzUnIHJ5PSc1JyBmaWxsPScjQTNBMUEyJwogICAgICAgICAgdHJhbnNmb3JtPSdyb3RhdGUoOTAgNTAgNTApIHRyYW5zbGF0ZSgwIC0zMCknPgogICAgPC9yZWN0PgogICAgPHJlY3QgeD0nNDYuNScgeT0nNDAnIHdpZHRoPSc3JyBoZWlnaHQ9JzIwJyByeD0nNScgcnk9JzUnIGZpbGw9JyNBQkE5QUEnCiAgICAgICAgICB0cmFuc2Zvcm09J3JvdGF0ZSgxMjAgNTAgNTApIHRyYW5zbGF0ZSgwIC0zMCknPgogICAgPC9yZWN0PgogICAgPHJlY3QgeD0nNDYuNScgeT0nNDAnIHdpZHRoPSc3JyBoZWlnaHQ9JzIwJyByeD0nNScgcnk9JzUnIGZpbGw9JyNCMkIyQjInCiAgICAgICAgICB0cmFuc2Zvcm09J3JvdGF0ZSgxNTAgNTAgNTApIHRyYW5zbGF0ZSgwIC0zMCknPgogICAgPC9yZWN0PgogICAgPHJlY3QgeD0nNDYuNScgeT0nNDAnIHdpZHRoPSc3JyBoZWlnaHQ9JzIwJyByeD0nNScgcnk9JzUnIGZpbGw9JyNCQUI4QjknCiAgICAgICAgICB0cmFuc2Zvcm09J3JvdGF0ZSgxODAgNTAgNTApIHRyYW5zbGF0ZSgwIC0zMCknPgogICAgPC9yZWN0PgogICAgPHJlY3QgeD0nNDYuNScgeT0nNDAnIHdpZHRoPSc3JyBoZWlnaHQ9JzIwJyByeD0nNScgcnk9JzUnIGZpbGw9JyNDMkMwQzEnCiAgICAgICAgICB0cmFuc2Zvcm09J3JvdGF0ZSgyMTAgNTAgNTApIHRyYW5zbGF0ZSgwIC0zMCknPgogICAgPC9yZWN0PgogICAgPHJlY3QgeD0nNDYuNScgeT0nNDAnIHdpZHRoPSc3JyBoZWlnaHQ9JzIwJyByeD0nNScgcnk9JzUnIGZpbGw9JyNDQkNCQ0InCiAgICAgICAgICB0cmFuc2Zvcm09J3JvdGF0ZSgyNDAgNTAgNTApIHRyYW5zbGF0ZSgwIC0zMCknPgogICAgPC9yZWN0PgogICAgPHJlY3QgeD0nNDYuNScgeT0nNDAnIHdpZHRoPSc3JyBoZWlnaHQ9JzIwJyByeD0nNScgcnk9JzUnIGZpbGw9JyNEMkQyRDInCiAgICAgICAgICB0cmFuc2Zvcm09J3JvdGF0ZSgyNzAgNTAgNTApIHRyYW5zbGF0ZSgwIC0zMCknPgogICAgPC9yZWN0PgogICAgPHJlY3QgeD0nNDYuNScgeT0nNDAnIHdpZHRoPSc3JyBoZWlnaHQ9JzIwJyByeD0nNScgcnk9JzUnIGZpbGw9JyNEQURBREEnCiAgICAgICAgICB0cmFuc2Zvcm09J3JvdGF0ZSgzMDAgNTAgNTApIHRyYW5zbGF0ZSgwIC0zMCknPgogICAgPC9yZWN0PgogICAgPHJlY3QgeD0nNDYuNScgeT0nNDAnIHdpZHRoPSc3JyBoZWlnaHQ9JzIwJyByeD0nNScgcnk9JzUnIGZpbGw9JyNFMkUyRTInCiAgICAgICAgICB0cmFuc2Zvcm09J3JvdGF0ZSgzMzAgNTAgNTApIHRyYW5zbGF0ZSgwIC0zMCknPgogICAgPC9yZWN0Pgo8L3N2Zz4=) no-repeat;background-size:100%}@-webkit-keyframes loadingAnimation{0%{-webkit-transform:rotate(0deg)}to{-webkit-transform:rotate(1turn)}}@keyframes loadingAnimation{0%{-webkit-transform:rotate(0deg)}to{-webkit-transform:rotate(1turn)}}", ""])
	}
]);
webpackJsonp([0], [function(e, i, n) {
	(function(e) {
			"use strict";
			function i(e) {
				return e && e.__esModule ? e : {
					"default": e
				}
			}
			var t = n(2)
				, l = i(t);
			n(3);
			var c = n(4)
				, a = i(c);
			n(5);
			var s = n(9)
				, u = i(s)
				, o = n(11)
				, r = i(o)
				, d = n(14)
				, p = i(d)
				, f = n(19)
				, v = i(f)
				, _ = n(23)
				, w = i(_)
				, g = n(32)
				, h = i(g)
				, m = n(36)
				, b = i(m)
				, y = n(41)
				, C = i(y);
			a["default"].attach(document.body);
			var A = new l["default"];
			A.push(u["default"]).push(r["default"]).push(p["default"]).push(w["default"]).push(v["default"]).push(h["default"]).push(b["default"]).push(C["default"]).setDefault("/").init(),
				e.getJSON("https://weui.io/api/sign?url=" + encodeURIComponent(location.href.split("#")[0])).success(function(e) {
					wx.config({
						debug: !1,
						appId: e.appid,
						timestamp: e.timestamp,
						nonceStr: e.nonceStr,
						signature: e.signature,
						jsApiList: ["onMenuShareTimeline", "onMenuShareAppMessage", "onMenuShareQQ", "onMenuShareWeibo", "onMenuShareQZone"]
					});
					var i = {
						title: "WeUI",
						desc: "WeUI, 为微信 Web 服务量身设计",
						link: "https://weui.io/example",
						imgUrl: "https://mmrb.github.io/avatar/bear.jpg"
					};
					wx.onMenuShareAppMessage(i),
						wx.onMenuShareTimeline(i),
						wx.onMenuShareQQ(i)
				})
		}
	).call(i, n(1))
}
	, , , , function(e, i, n) {
		var t;
		!function() {
			"use strict";
			/**
			 * @preserve FastClick: polyfill to remove click delays on browsers with touch UIs.
			 *
			 * @codingstandard ftlabs-jsv2
			 * @copyright The Financial Times Limited [All Rights Reserved]
			 * @license MIT License (see LICENSE.txt)
			 */
			function l(e, i) {
				function n(e, i) {
					return function() {
						return e.apply(i, arguments)
					}
				}
				var t;
				if (i = i || {},
						this.trackingClick = !1,
						this.trackingClickStart = 0,
						this.targetElement = null ,
						this.touchStartX = 0,
						this.touchStartY = 0,
						this.lastTouchIdentifier = 0,
						this.touchBoundary = i.touchBoundary || 10,
						this.layer = e,
						this.tapDelay = i.tapDelay || 200,
						this.tapTimeout = i.tapTimeout || 700,
						!l.notNeeded(e)) {
					for (var c = ["onMouse", "onClick", "onTouchStart", "onTouchMove", "onTouchEnd", "onTouchCancel"], s = this, u = 0, o = c.length; o > u; u++)
						s[c[u]] = n(s[c[u]], s);
					a && (e.addEventListener("mouseover", this.onMouse, !0),
						e.addEventListener("mousedown", this.onMouse, !0),
						e.addEventListener("mouseup", this.onMouse, !0)),
						e.addEventListener("click", this.onClick, !0),
						e.addEventListener("touchstart", this.onTouchStart, !1),
						e.addEventListener("touchmove", this.onTouchMove, !1),
						e.addEventListener("touchend", this.onTouchEnd, !1),
						e.addEventListener("touchcancel", this.onTouchCancel, !1),
					Event.prototype.stopImmediatePropagation || (e.removeEventListener = function(i, n, t) {
							var l = Node.prototype.removeEventListener;
							"click" === i ? l.call(e, i, n.hijacked || n, t) : l.call(e, i, n, t)
						}
							,
							e.addEventListener = function(i, n, t) {
								var l = Node.prototype.addEventListener;
								"click" === i ? l.call(e, i, n.hijacked || (n.hijacked = function(e) {
											e.propagationStopped || n(e)
										}
									), t) : l.call(e, i, n, t)
							}
					),
					"function" == typeof e.onclick && (t = e.onclick,
						e.addEventListener("click", function(e) {
							t(e)
						}, !1),
						e.onclick = null )
				}
			}
			var c = navigator.userAgent.indexOf("Windows Phone") >= 0
				, a = navigator.userAgent.indexOf("Android") > 0 && !c
				, s = /iP(ad|hone|od)/.test(navigator.userAgent) && !c
				, u = s && /OS 4_\d(_\d)?/.test(navigator.userAgent)
				, o = s && /OS [6-7]_\d/.test(navigator.userAgent)
				, r = navigator.userAgent.indexOf("BB10") > 0;
			l.prototype.needsClick = function(e) {
				switch (e.nodeName.toLowerCase()) {
					case "button":
					case "select":
					case "textarea":
						if (e.disabled)
							return !0;
						break;
					case "input":
						if (s && "file" === e.type || e.disabled)
							return !0;
						break;
					case "label":
					case "iframe":
					case "video":
						return !0
				}
				return /\bneedsclick\b/.test(e.className)
			}
				,
				l.prototype.needsFocus = function(e) {
					switch (e.nodeName.toLowerCase()) {
						case "textarea":
							return !0;
						case "select":
							return !a;
						case "input":
							switch (e.type) {
								case "button":
								case "checkbox":
								case "file":
								case "image":
								case "radio":
								case "submit":
									return !1
							}
							return !e.disabled && !e.readOnly;
						default:
							return /\bneedsfocus\b/.test(e.className)
					}
				}
				,
				l.prototype.sendClick = function(e, i) {
					var n, t;
					document.activeElement && document.activeElement !== e && document.activeElement.blur(),
						t = i.changedTouches[0],
						n = document.createEvent("MouseEvents"),
						n.initMouseEvent(this.determineEventType(e), !0, !0, window, 1, t.screenX, t.screenY, t.clientX, t.clientY, !1, !1, !1, !1, 0, null ),
						n.forwardedTouchEvent = !0,
						e.dispatchEvent(n)
				}
				,
				l.prototype.determineEventType = function(e) {
					return a && "select" === e.tagName.toLowerCase() ? "mousedown" : "click"
				}
				,
				l.prototype.focus = function(e) {
					var i;
					s && e.setSelectionRange && 0 !== e.type.indexOf("date") && "time" !== e.type && "month" !== e.type ? (i = e.value.length,
						e.setSelectionRange(i, i)) : e.focus()
				}
				,
				l.prototype.updateScrollParent = function(e) {
					var i, n;
					if (i = e.fastClickScrollParent,
						!i || !i.contains(e)) {
						n = e;
						do {
							if (n.scrollHeight > n.offsetHeight) {
								i = n,
									e.fastClickScrollParent = n;
								break
							}
							n = n.parentElement
						} while (n)
					}
					i && (i.fastClickLastScrollTop = i.scrollTop)
				}
				,
				l.prototype.getTargetElementFromEventTarget = function(e) {
					return e.nodeType === Node.TEXT_NODE ? e.parentNode : e
				}
				,
				l.prototype.onTouchStart = function(e) {
					var i, n, t;
					if (e.targetTouches.length > 1)
						return !0;
					if (i = this.getTargetElementFromEventTarget(e.target),
							n = e.targetTouches[0],
							s) {
						if (t = window.getSelection(),
							t.rangeCount && !t.isCollapsed)
							return !0;
						if (!u) {
							if (n.identifier && n.identifier === this.lastTouchIdentifier)
								return e.preventDefault(),
									!1;
							this.lastTouchIdentifier = n.identifier,
								this.updateScrollParent(i)
						}
					}
					return this.trackingClick = !0,
						this.trackingClickStart = e.timeStamp,
						this.targetElement = i,
						this.touchStartX = n.pageX,
						this.touchStartY = n.pageY,
					e.timeStamp - this.lastClickTime < this.tapDelay && e.preventDefault(),
						!0
				}
				,
				l.prototype.touchHasMoved = function(e) {
					var i = e.changedTouches[0]
						, n = this.touchBoundary;
					return Math.abs(i.pageX - this.touchStartX) > n || Math.abs(i.pageY - this.touchStartY) > n
				}
				,
				l.prototype.onTouchMove = function(e) {
					return this.trackingClick ? ((this.targetElement !== this.getTargetElementFromEventTarget(e.target) || this.touchHasMoved(e)) && (this.trackingClick = !1,
						this.targetElement = null ),
						!0) : !0
				}
				,
				l.prototype.findControl = function(e) {
					return void 0 !== e.control ? e.control : e.htmlFor ? document.getElementById(e.htmlFor) : e.querySelector("button, input:not([type=hidden]), keygen, meter, output, progress, select, textarea")
				}
				,
				l.prototype.onTouchEnd = function(e) {
					var i, n, t, l, c, r = this.targetElement;
					if (!this.trackingClick)
						return !0;
					if (e.timeStamp - this.lastClickTime < this.tapDelay)
						return this.cancelNextClick = !0,
							!0;
					if (e.timeStamp - this.trackingClickStart > this.tapTimeout)
						return !0;
					if (this.cancelNextClick = !1,
							this.lastClickTime = e.timeStamp,
							n = this.trackingClickStart,
							this.trackingClick = !1,
							this.trackingClickStart = 0,
						o && (c = e.changedTouches[0],
							r = document.elementFromPoint(c.pageX - window.pageXOffset, c.pageY - window.pageYOffset) || r,
							r.fastClickScrollParent = this.targetElement.fastClickScrollParent),
							t = r.tagName.toLowerCase(),
						"label" === t) {
						if (i = this.findControl(r)) {
							if (this.focus(r),
									a)
								return !1;
							r = i
						}
					} else if (this.needsFocus(r))
						return e.timeStamp - n > 100 || s && window.top !== window && "input" === t ? (this.targetElement = null ,
							!1) : (this.focus(r),
							this.sendClick(r, e),
						s && "select" === t || (this.targetElement = null ,
							e.preventDefault()),
							!1);
					return s && !u && (l = r.fastClickScrollParent,
					l && l.fastClickLastScrollTop !== l.scrollTop) ? !0 : (this.needsClick(r) || (e.preventDefault(),
						this.sendClick(r, e)),
						!1)
				}
				,
				l.prototype.onTouchCancel = function() {
					this.trackingClick = !1,
						this.targetElement = null
				}
				,
				l.prototype.onMouse = function(e) {
					return this.targetElement ? e.forwardedTouchEvent ? !0 : e.cancelable && (!this.needsClick(this.targetElement) || this.cancelNextClick) ? (e.stopImmediatePropagation ? e.stopImmediatePropagation() : e.propagationStopped = !0,
						e.stopPropagation(),
						e.preventDefault(),
						!1) : !0 : !0
				}
				,
				l.prototype.onClick = function(e) {
					var i;
					return this.trackingClick ? (this.targetElement = null ,
						this.trackingClick = !1,
						!0) : "submit" === e.target.type && 0 === e.detail ? !0 : (i = this.onMouse(e),
					i || (this.targetElement = null ),
						i)
				}
				,
				l.prototype.destroy = function() {
					var e = this.layer;
					a && (e.removeEventListener("mouseover", this.onMouse, !0),
						e.removeEventListener("mousedown", this.onMouse, !0),
						e.removeEventListener("mouseup", this.onMouse, !0)),
						e.removeEventListener("click", this.onClick, !0),
						e.removeEventListener("touchstart", this.onTouchStart, !1),
						e.removeEventListener("touchmove", this.onTouchMove, !1),
						e.removeEventListener("touchend", this.onTouchEnd, !1),
						e.removeEventListener("touchcancel", this.onTouchCancel, !1)
				}
				,
				l.notNeeded = function(e) {
					var i, n, t, l;
					if ("undefined" == typeof window.ontouchstart)
						return !0;
					if (n = +(/Chrome\/([0-9]+)/.exec(navigator.userAgent) || [, 0])[1]) {
						if (!a)
							return !0;
						if (i = document.querySelector("meta[name=viewport]")) {
							if (-1 !== i.content.indexOf("user-scalable=no"))
								return !0;
							if (n > 31 && document.documentElement.scrollWidth <= window.outerWidth)
								return !0
						}
					}
					if (r && (t = navigator.userAgent.match(/Version\/([0-9]*)\.([0-9]*)/),
						t[1] >= 10 && t[2] >= 3 && (i = document.querySelector("meta[name=viewport]")))) {
						if (-1 !== i.content.indexOf("user-scalable=no"))
							return !0;
						if (document.documentElement.scrollWidth <= window.outerWidth)
							return !0
					}
					return "none" === e.style.msTouchAction || "manipulation" === e.style.touchAction ? !0 : (l = +(/Firefox\/([0-9]+)/.exec(navigator.userAgent) || [, 0])[1],
						l >= 27 && (i = document.querySelector("meta[name=viewport]"),
						i && (-1 !== i.content.indexOf("user-scalable=no") || document.documentElement.scrollWidth <= window.outerWidth)) ? !0 : "none" === e.style.touchAction || "manipulation" === e.style.touchAction)
				}
				,
				l.attach = function(e, i) {
					return new l(e,i)
				}
				,
				t = function() {
					return l
				}
					.call(i, n, i, e),
				!(void 0 !== t && (e.exports = t))
		}()
	}
	, function(e, i, n) {
		var t = n(6);
		"string" == typeof t && (t = [[e.id, t, ""]]);
		n(8)(t, {});
		t.locals && (e.exports = t.locals)
	}
	, function(e, i, n) {
		i = e.exports = n(7)(),
			i.push([e.id, "body{background-color:#efeff4}", ""])
	}
	, function(e, i) {
		e.exports = function() {
			var e = [];
			return e.toString = function() {
				for (var e = [], i = 0; i < this.length; i++) {
					var n = this[i];
					n[2] ? e.push("@media " + n[2] + "{" + n[1] + "}") : e.push(n[1])
				}
				return e.join("")
			}
				,
				e.i = function(i, n) {
					"string" == typeof i && (i = [[null , i, ""]]);
					for (var t = {}, l = 0; l < this.length; l++) {
						var c = this[l][0];
						"number" == typeof c && (t[c] = !0)
					}
					for (l = 0; l < i.length; l++) {
						var a = i[l];
						"number" == typeof a[0] && t[a[0]] || (n && !a[2] ? a[2] = n : n && (a[2] = "(" + a[2] + ") and (" + n + ")"),
							e.push(a))
					}
				}
				,
				e
		}
	}
	, function(e, i, n) {
		function t(e, i) {
			for (var n = 0; n < e.length; n++) {
				var t = e[n]
					, l = f[t.id];
				if (l) {
					l.refs++;
					for (var c = 0; c < l.parts.length; c++)
						l.parts[c](t.parts[c]);
					for (; c < t.parts.length; c++)
						l.parts.push(o(t.parts[c], i))
				} else {
					for (var a = [], c = 0; c < t.parts.length; c++)
						a.push(o(t.parts[c], i));
					f[t.id] = {
						id: t.id,
						refs: 1,
						parts: a
					}
				}
			}
		}
		function l(e) {
			for (var i = [], n = {}, t = 0; t < e.length; t++) {
				var l = e[t]
					, c = l[0]
					, a = l[1]
					, s = l[2]
					, u = l[3]
					, o = {
					css: a,
					media: s,
					sourceMap: u
				};
				n[c] ? n[c].parts.push(o) : i.push(n[c] = {
					id: c,
					parts: [o]
				})
			}
			return i
		}
		function c(e, i) {
			var n = w()
				, t = m[m.length - 1];
			if ("top" === e.insertAt)
				t ? t.nextSibling ? n.insertBefore(i, t.nextSibling) : n.appendChild(i) : n.insertBefore(i, n.firstChild),
					m.push(i);
			else {
				if ("bottom" !== e.insertAt)
					throw new Error("Invalid value for parameter 'insertAt'. Must be 'top' or 'bottom'.");
				n.appendChild(i)
			}
		}
		function a(e) {
			e.parentNode.removeChild(e);
			var i = m.indexOf(e);
			i >= 0 && m.splice(i, 1)
		}
		function s(e) {
			var i = document.createElement("style");
			return i.type = "text/css",
				c(e, i),
				i
		}
		function u(e) {
			var i = document.createElement("link");
			return i.rel = "stylesheet",
				c(e, i),
				i
		}
		function o(e, i) {
			var n, t, l;
			if (i.singleton) {
				var c = h++;
				n = g || (g = s(i)),
					t = r.bind(null , n, c, !1),
					l = r.bind(null , n, c, !0)
			} else
				e.sourceMap && "function" == typeof URL && "function" == typeof URL.createObjectURL && "function" == typeof URL.revokeObjectURL && "function" == typeof Blob && "function" == typeof btoa ? (n = u(i),
						t = p.bind(null , n),
						l = function() {
							a(n),
							n.href && URL.revokeObjectURL(n.href)
						}
				) : (n = s(i),
						t = d.bind(null , n),
						l = function() {
							a(n)
						}
				);
			return t(e),
				function(i) {
					if (i) {
						if (i.css === e.css && i.media === e.media && i.sourceMap === e.sourceMap)
							return;
						t(e = i)
					} else
						l()
				}
		}
		function r(e, i, n, t) {
			var l = n ? "" : t.css;
			if (e.styleSheet)
				e.styleSheet.cssText = b(i, l);
			else {
				var c = document.createTextNode(l)
					, a = e.childNodes;
				a[i] && e.removeChild(a[i]),
					a.length ? e.insertBefore(c, a[i]) : e.appendChild(c)
			}
		}
		function d(e, i) {
			var n = i.css
				, t = i.media;
			if (t && e.setAttribute("media", t),
					e.styleSheet)
				e.styleSheet.cssText = n;
			else {
				for (; e.firstChild; )
					e.removeChild(e.firstChild);
				e.appendChild(document.createTextNode(n))
			}
		}
		function p(e, i) {
			var n = i.css
				, t = i.sourceMap;
			t && (n += "\n/*# sourceMappingURL=data:application/json;base64," + btoa(unescape(encodeURIComponent(JSON.stringify(t)))) + " */");
			var l = new Blob([n],{
				type: "text/css"
			})
				, c = e.href;
			e.href = URL.createObjectURL(l),
			c && URL.revokeObjectURL(c)
		}
		var f = {}
			, v = function(e) {
			var i;
			return function() {
				return "undefined" == typeof i && (i = e.apply(this, arguments)),
					i
			}
		}
			, _ = v(function() {
			return /msie [6-9]\b/.test(window.navigator.userAgent.toLowerCase())
		})
			, w = v(function() {
			return document.head || document.getElementsByTagName("head")[0]
		})
			, g = null
			, h = 0
			, m = [];
		e.exports = function(e, i) {
			i = i || {},
			"undefined" == typeof i.singleton && (i.singleton = _()),
			"undefined" == typeof i.insertAt && (i.insertAt = "bottom");
			var n = l(e);
			return t(n, i),
				function(e) {
					for (var c = [], a = 0; a < n.length; a++) {
						var s = n[a]
							, u = f[s.id];
						u.refs--,
							c.push(u)
					}
					if (e) {
						var o = l(e);
						t(o, i)
					}
					for (var a = 0; a < c.length; a++) {
						var u = c[a];
						if (0 === u.refs) {
							for (var r = 0; r < u.parts.length; r++)
								u.parts[r]();
							delete f[u.id]
						}
					}
				}
		}
		;
		var b = function() {
			var e = [];
			return function(i, n) {
				return e[i] = n,
					e.filter(Boolean).join("\n")
			}
		}()
	}
	, function(e, i, n) {
		"use strict";
		function t(e) {
			return e && e.__esModule ? e : {
				"default": e
			}
		}
		Object.defineProperty(i, "__esModule", {
			value: !0
		});
		var l = n(10)
			, c = t(l);
		i["default"] = {
			url: "/",
			className: "home",
			render: function() {
				return c["default"]
			}
		}
	}
	, function(e, i) {
		e.exports = '<div class="weui_cells_title">场景示例</div>\n<div class="weui_cells weui_cells_access">\n    <a href="#/register" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>注册登录</p>\n        </div>\n        <div class="weui_cell_ft"></div>\n    </a>\n    <a href="#/profile" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>用户中心</p>\n        </div>\n        <div class="weui_cell_ft"></div>\n    </a>\n    <a href="#/swiper" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>Swiper</p>\n        </div>\n        <div class="weui_cell_ft"></div>\n    </a>\n    <a href="#/setting" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>设置</p>\n        </div>\n        <div class="weui_cell_ft"></div>\n    </a>\n    <a href="#/check" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>选项列表</p>\n        </div>\n        <div class="weui_cell_ft"></div>\n    </a>\n    <a href="#/uploader" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>图片上传</p>\n        </div>\n        <div class="weui_cell_ft"></div>\n    </a>\n    <a href="#/list" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>图文列表</p>\n        </div>\n        <div class="weui_cell_ft">下拉刷新</div>\n    </a>\n</div>\n\n<div class="weui_cells_title">应用示例</div>\n<div class="weui_cells weui_cells_access">\n    <a href="http://www.shiciclass.com/sso.php?action=wxvip" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>诗词文学会员中心</p>\n        </div>\n        <div class="weui_cell_ft"></div>\n    </a>\n    <a href="https://res.wx.qq.com/a/wx_fed/feedback/15060201/weixin_feedback_index.html" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>意见反馈</p>\n        </div>\n        <div class="weui_cell_ft"></div>\n    </a>\n    <a href="https://team.weui.io/jfeng/weui-wechat" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>weui-wechat</p>\n        </div>\n        <div class="weui_cell_ft"></div>\n    </a>\n    <a href="https://progrape.github.io/todo" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>TODO</p>\n        </div>\n        <div class="weui_cell_ft"></div>\n    </a>\n</div>'
	}
	, function(e, i, n) {
		"use strict";
		function t(e) {
			return e && e.__esModule ? e : {
				"default": e
			}
		}
		Object.defineProperty(i, "__esModule", {
			value: !0
		});
		var l = n(1)
			, c = t(l);
		n(12);
		var a = n(13)
			, s = t(a);
		i["default"] = {
			url: "/register",
			className: "register",
			render: function() {
				return s["default"]
			},
			bind: function() {
				(0,
					c["default"])("#registerForm").form(),
					(0,
						c["default"])(this).on("click", ".js_btn", function() {
						(0,
							c["default"])("#registerForm").validate(function(e) {
							if (!e) {
								c["default"].weui.loading("数据提交中...");
								var i = (0,
									c["default"])("#registerForm").serialize();
								c["default"].post("/api/v1/user", i).success(function(e) {
									console.log(e)
								}).error(function(e) {
									console.log(e)
								}).always(function() {
									setTimeout(function() {
										c["default"].weui.hideLoading(),
											c["default"].weui.toast("注册成功")
									}, 800)
								})
							}
						})
					})
			}
		}
	}
	, , function(e, i) {
		e.exports = '<form id="registerForm">\n    <div class="weui_cells_title">用户注册</div>\n    <div class="weui_cells weui_cells_form">\n        <div class="weui_cell">\n            <div class="weui_cell_hd">\n                <label for="" class="weui_label">用户名</label>\n            </div>\n            <div class="weui_cell_bd weui_cell_primary">\n                <input type="text" name="username" class="weui_input" required placeholder="请输入用户名">\n            </div>\n            <div class="weui_cell_ft">\n                <i class="weui_icon_warn"></i>\n            </div>\n        </div>\n        <div class="weui_cell">\n            <div class="weui_cell_hd">\n                <label for="" class="weui_label">手机号</label>\n            </div>\n            <div class="weui_cell_bd weui_cell_primary">\n                <input type="tel" name="tel" class="weui_input" required pattern="[\\d]{8,11}" notMatchTips="请输入正确的手机号" placeholder="请输入手机号">\n            </div>\n            <div class="weui_cell_ft">\n                <i class="weui_icon_warn"></i>\n            </div>\n        </div>\n        <div class="weui_cell">\n            <div class="weui_cell_hd">\n                <label for="" class="weui_label">密码</label>\n            </div>\n            <div class="weui_cell_bd weui_cell_primary">\n                <input type="password" name="password" class="weui_input" required pattern="[\\w]{6,}" notMatchTips="密码至少6位" placeholder="请输入密码">\n            </div>\n            <div class="weui_cell_ft">\n                <i class="weui_icon_warn"></i>\n            </div>\n        </div>\n    </div>\n    <p class="weui_cells_tips">在微信里面其实可以调网页授权的</p>\n\n    <div class="weui_btn_area">\n        <a href="javascript:;" class="weui_btn weui_btn_primary js_btn">注册</a>\n    </div>\n</form>'
	}
	, function(e, i, n) {
		"use strict";
		function t(e) {
			return e && e.__esModule ? e : {
				"default": e
			}
		}
		Object.defineProperty(i, "__esModule", {
			value: !0
		});
		var l = n(1)
			, c = t(l);
		n(12);
		var a = n(15)
			, s = (t(a),
			n(16))
			, u = t(s);
		n(17),
			i["default"] = {
				url: "/profile",
				className: "profile",
				render: function() {
					return u["default"]
				},
				bind: function() {
					(0,
						c["default"])(this).on("click", "#avatarCell", function() {
						c["default"].weui.actionSheet([{
							label: "拍照",
							onClick: function() {}
						}, {
							label: "从手机相册选择",
							onClick: function() {}
						}, {
							label: "保存图片",
							onClick: function() {}
						}])
					})
				}
			}
	}
	, , function(e, i) {
		e.exports = '<div class="weui_cells weui_cells_access">\n    <div class="weui_cell" id="avatarCell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>头像</p>\n        </div>\n        <div class="weui_cell_ft">\n            <img class="weui_avatar" src="https://team.weui.io/avatar/bear.jpg" alt="">\n        </div>\n    </div>\n    <div class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>姓名</p>\n        </div>\n        <div class="weui_cell_ft">\n            bear\n        </div>\n    </div>\n    <div class="weui_cell no_access">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>微信号</p>\n        </div>\n        <div class="weui_cell_ft">\n            bear\n        </div>\n    </div>\n    <div class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>我的二维码</p>\n        </div>\n        <div class="weui_cell_ft">\n\n        </div>\n    </div>\n    <div class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>我的地址</p>\n        </div>\n        <div class="weui_cell_ft">\n\n        </div>\n    </div>\n</div>\n<div class="weui_cells weui_cells_access">\n    <a href="javascript:;" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>性别</p>\n        </div>\n        <div class="weui_cell_ft">\n            男\n        </div>\n    </a>\n    <a href="javascript:;" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>地区</p>\n        </div>\n        <div class="weui_cell_ft">\n            奥地利 维也纳\n        </div>\n    </a>\n    <a href="javascript:;" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>个性签名</p>\n        </div>\n        <div class="weui_cell_ft">\n            未设置\n        </div>\n    </a>\n</div>\n<div class="weui_cells weui_cells_access">\n    <a href="javascript:;" class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <p>LinkedIn帐号</p>\n        </div>\n        <div class="weui_cell_ft">\n            未设置\n        </div>\n    </a>\n</div>'
	}
	, function(e, i, n) {
		var t = n(18);
		"string" == typeof t && (t = [[e.id, t, ""]]);
		n(8)(t, {});
		t.locals && (e.exports = t.locals)
	}
	, function(e, i, n) {
		i = e.exports = n(7)(),
			i.push([e.id, ".weui_avatar{width:52px;height:52px;border-radius:4px;vertical-align:middle}", ""])
	}
	, function(e, i, n) {
		"use strict";
		function t(e) {
			return e && e.__esModule ? e : {
				"default": e
			}
		}
		Object.defineProperty(i, "__esModule", {
			value: !0
		}),
			n(12);
		var l = n(20)
			, c = t(l)
			, a = n(21);
		t(a);
		i["default"] = {
			url: "/setting",
			className: "setting",
			render: function() {
				return c["default"]
			},
			bind: function() {}
		}
	}
	, function(e, i) {
		e.exports = '<div class="weui_cells">\n    <div class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">接收新消息通知</div>\n        <div class="weui_cell_ft">已开启</div>\n    </div>\n</div>\n<div class="weui_cells_tips">如果你要关闭或开启微信的新消息通知,请在 iPhone 的"设置"——"通知"功能中, 找到应用程序"微信"更改。</div>\n<div class="weui_cells weui_cells_form">\n    <div class="weui_cell weui_cell_switch">\n        <div class="weui_cell_bd weui_cell_primary">通知显示消息详情</div>\n        <div class="weui_cell_ft">\n            <input type="checkbox" class="weui_switch">\n        </div>\n    </div>\n</div>\n<div class="weui_cells_tips">关闭后, 当收到微信消息时, 通知提示将不显示发信人和内容摘要.</div>\n<div class="weui_cells weui_cells_access">\n    <div class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">功能消息免打扰</div>\n        <div class="weui_cell_ft"></div>\n    </div>\n</div>\n<div class="weui_cells_tips">设置系统功能消息提示声音和振动的时段。</div>\n<div class="weui_cells weui_cells_form">\n    <div class="weui_cell weui_cell_switch">\n        <div class="weui_cell_bd weui_cell_primary">声音</div>\n        <div class="weui_cell_ft">\n            <input type="checkbox" class="weui_switch">\n        </div>\n    </div>\n    <div class="weui_cell weui_cell_switch">\n        <div class="weui_cell_bd weui_cell_primary">振动</div>\n        <div class="weui_cell_ft">\n            <input type="checkbox" class="weui_switch" checked>\n        </div>\n    </div>\n</div>\n<div class="weui_cells_tips">当微信在运行时, 你可以设置是否需要声音或者振动。</div>\n<div class="weui_cells weui_cells_form">\n    <div class="weui_cell weui_cell_switch">\n        <div class="weui_cell_bd weui_cell_primary">朋友圈照片更新</div>\n        <div class="weui_cell_ft">\n            <input type="checkbox" class="weui_switch" checked>\n        </div>\n    </div>\n</div>\n<div class="weui_cells_tips">关闭后, 有朋友更新照片时, 界面下面的"发现"切换按钮上不再出现红点提示。</div>'
	}
	, function(e, i, n) {
		var t = n(22);
		"string" == typeof t && (t = [[e.id, t, ""]]);
		n(8)(t, {});
		t.locals && (e.exports = t.locals)
	}
	, function(e, i, n) {
		i = e.exports = n(7)(),
			i.push([e.id, "", ""])
	}
	, function(e, i, n) {
		"use strict";
		function t(e) {
			return e && e.__esModule ? e : {
				"default": e
			}
		}
		Object.defineProperty(i, "__esModule", {
			value: !0
		}),
			n(12);
		var l = n(15)
			, c = t(l)
			, a = n(24)
			, s = t(a)
			, u = n(25)
			, o = t(u);
		n(26);
		var r = n(28)
			, d = t(r)
			, p = n(29)
			, f = t(p)
			, v = n(30)
			, _ = t(v)
			, w = n(31)
			, g = t(w);
		i["default"] = {
			url: "/swiper",
			className: "swiper-wrapper",
			render: function() {
				return c["default"].compile(o["default"])({
					items: [d["default"], f["default"], _["default"], g["default"]]
				})
			},
			bind: function() {
				var e = new s["default"]({
					direction: "horizontal"
				});
				e.on("swiped", function(e, i) {
					console.log("prev", e),
						console.log("current", i)
				})
			}
		}
	}
	, , function(e, i) {
		e.exports = '<div class="swiper">\n    {{each items as item i}}\n    <div class="item" style="background: url(\'{{item}}\'); background-size: cover; -webkit-background-size: cover;">\n\n    </div>\n    {{/each}}\n</div>'
	}
	, function(e, i, n) {
		var t = n(27);
		"string" == typeof t && (t = [[e.id, t, ""]]);
		n(8)(t, {});
		t.locals && (e.exports = t.locals)
	}
	, function(e, i, n) {
		i = e.exports = n(7)(),
			i.push([e.id, ".swiper,.swiper-wrapper{overflow:hidden}.swiper{height:200px;-webkit-transition:all .3s ease;transition:all .3s ease}.item{height:100%;background-position:50%;background-size:cover;position:relative;overflow:hidden;float:left}.item.active .animated{-webkit-animation-fill-mode:both;animation-fill-mode:both;opacity:1}.item:not(.active) .animated{-webkit-animation:none;animation:none;opacity:0}", ""])
	}
	, function(e, i, n) {
		e.exports = n.p + "8d009c9d91ea14721eaff19d32237d40.png"
	}
	, function(e, i, n) {
		e.exports = n.p + "b8506bdb1a762806f909f5c12cf8d92b.png"
	}
	, function(e, i, n) {
		e.exports = n.p + "b87cd3b87e12ff32ce7c52b6c3a13945.png"
	}
	, function(e, i, n) {
		e.exports = n.p + "47e04b2447b9170b0657988bf64d2126.png"
	}
	, function(e, i, n) {
		(function(e) {
				"use strict";
				function t(e) {
					return e && e.__esModule ? e : {
						"default": e
					}
				}
				Object.defineProperty(i, "__esModule", {
					value: !0
				}),
					n(12);
				var l = n(33)
					, c = t(l);
				n(34),
					i["default"] = {
						url: "/check",
						className: "check",
						render: function() {
							return c["default"]
						},
						bind: function() {
							e(this).on("click", "#checkListBtn", function() {
								var i = e("form").serialize()
									, n = JSON.stringify(i).replace(/"/gi, "").replace(/&/gi, "<br>");
								e.weui.confirm(n, function() {
									console.log(i),
										e.weui.loading("提交中..."),
										e.post("/api/v1/user", i).success(function(e) {
											console.log(e)
										}).error(function(e) {
											console.log(e)
										}).always(function() {
											setTimeout(function() {
												e.weui.hideLoading(),
													e.weui.toast("提交成功")
											}, 1e3)
										})
								})
							})
						}
					}
			}
		).call(i, n(1))
	}
	, function(e, i) {
		e.exports = '<form>\n    <div class="weui_cells_title">性别</div>\n    <div class="weui_cells weui_cells_radio">\n        <label class="weui_cell weui_check_label" for="x11">\n            <div class="weui_cell_bd weui_cell_primary">\n                <p>男</p>\n            </div>\n            <div class="weui_cell_ft">\n                <input type="radio" value="male" class="weui_check" name="gender" id="x11"  checked="checked">\n                <span class="weui_icon_checked"></span>\n            </div>\n        </label>\n        <label class="weui_cell weui_check_label" for="x12">\n            <div class="weui_cell_bd weui_cell_primary">\n                <p>女</p>\n            </div>\n            <div class="weui_cell_ft">\n                <input type="radio" value="female" name="gender" class="weui_check" id="x12">\n                <span class="weui_icon_checked"></span>\n            </div>\n        </label>\n        <label class="weui_cell weui_check_label" for="x13">\n            <div class="weui_cell_bd weui_cell_primary">\n                <p>未知</p>\n            </div>\n            <div class="weui_cell_ft">\n                <input type="radio" value="unknow" name="gender" class="weui_check" id="x13">\n                <span class="weui_icon_checked"></span>\n            </div>\n        </label>\n    </div>\n    <div class="weui_cells_title">兴趣爱好</div>\n    <div class="weui_cells weui_cells_checkbox">\n        <label class="weui_cell weui_check_label" for="s11">\n            <div class="weui_cell_hd">\n                <input type="checkbox" value="coding" class="weui_check" name="hobby" id="s11" checked="checked">\n                <i class="weui_icon_checked"></i>\n            </div>\n            <div class="weui_cell_bd weui_cell_primary">\n                <p>写代码</p>\n            </div>\n        </label>\n        <label class="weui_cell weui_check_label" for="s12">\n            <div class="weui_cell_hd">\n                <input type="checkbox" value="fixBug" name="hobby" class="weui_check" id="s12">\n                <i class="weui_icon_checked"></i>\n            </div>\n            <div class="weui_cell_bd weui_cell_primary">\n                <p>修 bug</p>\n            </div>\n        </label>\n        <label class="weui_cell weui_check_label" for="s13">\n            <div class="weui_cell_hd">\n                <input type="checkbox" value="fixOtherDeBug" name="hobby" class="weui_check" id="s13">\n                <i class="weui_icon_checked"></i>\n            </div>\n            <div class="weui_cell_bd weui_cell_primary">\n                <p>修别人的 bug</p>\n            </div>\n        </label>\n    </div>\n    <div class="weui_cells_title">其他</div>\n    <div class="weui_cells weui_cells_form">\n        <div class="weui_cell weui_cell_switch">\n            <div class="weui_cell_hd weui_cell_primary">已婚</div>\n            <div class="weui_cell_ft">\n                <input class="weui_switch" name="isMarry" value="true" checked type="checkbox">\n            </div>\n        </div>\n    </div>\n    <div class="weui_btn_area">\n        <a class="weui_btn weui_btn_primary" href="javascript:" id="checkListBtn">提交</a>\n    </div>\n</form>'
	}
	, function(e, i, n) {
		var t = n(35);
		"string" == typeof t && (t = [[e.id, t, ""]]);
		n(8)(t, {});
		t.locals && (e.exports = t.locals)
	}
	, function(e, i, n) {
		i = e.exports = n(7)(),
			i.push([e.id, ".weui_cells_checkbox>.weui_cell>*,.weui_cells_radio>.weui_cell>*{pointer-events:none}", ""])
	}
	, function(e, i, n) {
		(function(e) {
				"use strict";
				function t(e) {
					return e && e.__esModule ? e : {
						"default": e
					}
				}
				function l(e) {
					if (e && e.__esModule)
						return e;
					var i = {};
					if (null != e)
						for (var n in e)
							Object.prototype.hasOwnProperty.call(e, n) && (i[n] = e[n]);
					return i["default"] = e,
						i
				}
				Object.defineProperty(i, "__esModule", {
					value: !0
				}),
					n(12);
				var c = n(37)
					, a = l(c)
					, s = n(38)
					, u = t(s)
					, o = n(39);
				t(o);
				i["default"] = {
					url: "/uploader",
					className: "uploader",
					render: function() {
						return u["default"]
					},
					bind: function() {
						var i = this
							, n = [];
						e(this).on("change", "#file", function(t) {
							var l = event.target.files[0];
							l && (e.weui.loading("压缩中..."),
								a.compress(l, 400, function(t, l) {
									e.weui.hideLoading(),
										t ? (e.weui.alert("压缩图片发生异常"),
											console.log(t)) : (e(i).find(".weui_uploader_files").append(e('<li class="weui_uploader_file" style="background-image:url(' + URL.createObjectURL(l.blob) + ')"></li>')),
											n.push(l),
											e("#uploadCounter").text(n.length),
										n.length >= 4 && e(i).find(".weui_uploader_input_wrp").hide())
								}))
						}).on("click", ".weui_uploader_file", function() {
							var i = this
								, t = e(this).index();
							e.weui.confirm("是否要删除这张图片?", function() {
								n.splice(t, 1),
									e(i).remove(),
									e("#uploadCounter").text(n.length),
									e(".weui_uploader_input_wrp").show()
							})
						}).on("click", "#uploadBtn", function() {
							function i(i, n) {
								var t = new FormData;
								t.append("file", i.blob, i.name),
									e.ajax({
										type: "POST",
										url: "/api/upload",
										data: t,
										processData: !1,
										contentType: !1
									}).success(function(e) {}).error(function(e) {}).always(function() {
										e(".weui_uploader_file").eq(n).addClass("weui_uploader_status").html('<div class="weui_uploader_status_content"> <i class="weui_icon_warn"></i> </div>')
									})
							}
							n.map(i)
						})
					}
				}
			}
		).call(i, n(1))
	}
	, function(e, i) {
		"use strict";
		function n(e) {
			var i = arguments.length <= 1 || void 0 === arguments[1] ? 1 : arguments[1]
				, n = arguments.length <= 2 || void 0 === arguments[2] ? function() {}
				: arguments[2]
				, l = new FileReader;
			l.onload = function(l) {
				var c = new Image;
				c.onload = function() {
					var l = 1 >= i ? c.width * i : i
						, a = c.height * (l / c.width)
						, s = document.createElement("canvas")
						, u = s.getContext("2d");
					s.width = l,
						s.height = a,
						u.drawImage(c, 0, 0, l, a);
					var o = s.toDataURL()
						, r = t(o);
					n(null , {
						name: e.name,
						blob: r
					})
				}
					,
					c.onerror = function(e) {
						n(e)
					}
					,
					c.src = l.target.result
			}
				,
				l.readAsDataURL(e)
		}
		Object.defineProperty(i, "__esModule", {
			value: !0
		}),
			i.compress = n;
		var t = i.dataURItoBlob = function(e) {
			for (var i = atob(e.split(",")[1]), n = e.split(",")[0].split(":")[1].split(";")[0], t = new ArrayBuffer(i.length), l = new Uint8Array(t), c = 0; c < i.length; c++)
				l[c] = i.charCodeAt(c);
			return new Blob([t],{
				type: n
			})
		}
	}
	, function(e, i) {
		e.exports = '<div class="weui_cells_title">上传</div>\n<div class="weui_cells weui_cells_form">\n    <div class="weui_cell">\n        <div class="weui_cell_bd weui_cell_primary">\n            <div class="weui_uploader">\n                <div class="weui_uploader_hd weui_cell">\n                    <div class="weui_cell_bd weui_cell_primary">图片上传</div>\n                    <div class="weui_cell_ft"><span id="uploadCounter">0</span>/4</div>\n                </div>\n                <div class="weui_uploader_bd">\n                    <ul class="weui_uploader_files">\n\n                    </ul>\n                    <div class="weui_uploader_input_wrp">\n                        <input id="file" class="weui_uploader_input" type="file" accept="image/jpg,image/jpeg,image/png,image/gif">\n                    </div>\n                </div>\n            </div>\n        </div>\n    </div>\n</div>\n<div class="weui_cells_tips">因为没有后端接收，所以此处文件上传会失败</div>\n<div class="weui_btn_area">\n    <a href="javascript:;" class="weui_btn weui_btn_primary" id="uploadBtn">上传</a>\n</div>'
	}
	, function(e, i, n) {
		var t = n(40);
		"string" == typeof t && (t = [[e.id, t, ""]]);
		n(8)(t, {});
		t.locals && (e.exports = t.locals)
	}
	, function(e, i, n) {
		i = e.exports = n(7)(),
			i.push([e.id, "", ""])
	}
	, function(e, i, n) {
		"use strict";
		function t(e) {
			return e && e.__esModule ? e : {
				"default": e
			}
		}
		Object.defineProperty(i, "__esModule", {
			value: !0
		});
		var l = n(1)
			, c = t(l);
		n(12),
			n(42);
		var a = n(15)
			, s = t(a)
			, u = n(43)
			, o = t(u)
			, r = n(44)
			, d = t(r);
		n(45),
			i["default"] = {
				url: "/list",
				render: function() {
					return s["default"].compile(d["default"])({
						list: o["default"]
					})
				},
				bind: function() {
					(0,
						c["default"])(".weui_pull").pull({
						onRefresh: function(e) {
							setTimeout(e, 1e3)
						}
					})
				}
			}
	}
	, function(e, i, n) {
		"use strict";
		function t(e) {
			return e && e.__esModule ? e : {
				"default": e
			}
		}
		var l = n(1)
			, c = t(l)
			, a = function() {
				return document.documentElement.scrollTop || document.body.scrollTop
			}
			, s = function(e, i) {
				return e.css({
					"-webkit-transition": "all " + i + "s",
					transition: "all " + i + "s"
				})
			}
			, u = function(e, i) {
				return e.css({
					"-webkit-transform": "translate3d(0, " + i + "px, 0)",
					transform: "translate3d(0, " + i + "px, 0)"
				})
			}
			;
		c["default"].fn.pull = function(e) {
			var i = c["default"].extend({
				offset: 40,
				threshold: 100,
				onRefresh: function(e) {
					e(null )
				}
			}, e)
				, n = void 0
				, t = void 0;
			(0,
				c["default"])(this).on("touchstart", function(e) {
				a() <= 0 && (n = e.originalEvent.touches[0].pageY,
					t = 0,
					s((0,
						c["default"])(this), 0),
					(0,
						c["default"])(".weui_pull_tips").find("span").text("下拉刷新").siblings("i").hide())
			}).on("touchmove", function(e) {
				a() <= 0 && (t = e.originalEvent.touches[0].pageY,
				t > n && (e.preventDefault(),
					s((0,
						c["default"])(this), 0),
					u((0,
						c["default"])(this), .6 * (t - n - i.offset))))
			}).on("touchend", function(e) {
				var l = this;
				a() <= 0 && (t - n >= i.threshold ? (s((0,
					c["default"])(this), .3),
					u((0,
						c["default"])(this), 0),
					(0,
						c["default"])(".weui_pull_tips").find("span").text("刷新中").siblings("i").show(),
				"function" == typeof i.onRefresh && i.onRefresh.call((0,
					c["default"])(this), function(e) {
					s((0,
						c["default"])(l), .3),
						u((0,
							c["default"])(l), 0 - i.offset)
				})) : (s((0,
					c["default"])(this), .3),
					u((0,
						c["default"])(this), 0 - i.offset)))
			})
		}
	}
	, function(e, i) {
		"use strict";
		Object.defineProperty(i, "__esModule", {
			value: !0
		});
		for (var n = [], t = 0; 50 > t; t++)
			n.push({
				thumb: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAB4CAMAAAAOusbgAAAAeFBMVEUAwAD///+U5ZTc9twOww7G8MYwzDCH4YcfyR9x23Hw+/DY9dhm2WZG0kbT9NP0/PTL8sux7LFe115T1VM+zz7i+OIXxhes6qxr2mvA8MCe6J6M4oz6/frr+us5zjn2/fa67rqB4IF13XWn6ad83nxa1loqyirn+eccHxx4AAAC/klEQVRo3u2W2ZKiQBBF8wpCNSCyLwri7v//4bRIFVXoTBBB+DAReV5sG6lTXDITiGEYhmEYhmEYhmEYhmEY5v9i5fsZGRx9PyGDne8f6K9cfd+mKXe1yNG/0CcqYE86AkBMBh66f20deBc7wA/1WFiTwvSEpBMA2JJOBsSLxe/4QEEaJRrASP8EVF8Q74GbmevKg0saa0B8QbwBdjRyADYxIhqxAZ++IKYtciPXLQVG+imw+oo4Bu56rjEJ4GYsvPmKOAB+xlz7L5aevqUXuePWVhvWJ4eWiwUQ67mK51qPj4dFDMlRLBZTqF3SDvmr4BwtkECu5gHWPkmDfQh02WLxXuvbvC8ku8F57GsI5e0CmUwLz1kq3kD17R1In5816rGvQ5VMk5FEtIiWislTffuDpl/k/PzscdQsv8r9qWq4LRWX6tQYtTxvI3XyrwdyQxChXioOngH3dLgOFjk0all56XRi/wDFQrGQU3Os5t0wJu1GNtNKHdPqYaGYQuRDfbfDf26AGLYSyGS3ZAK4S8XuoAlxGSdYMKwqZKM9XJMtyqXi7HX/CiAZS6d8bSVUz5J36mEMFDTlAFQzxOT1dzLRljjB6+++ejFqka+mXIe6F59mw22OuOw1F4T6lg/9VjL1rLDoI9Xzl1MSYDNHnPQnt3D1EE7PrXjye/3pVpr1Z45hMUdcACc5NVQI0bOdS1WA0wuz73e7/5TNqBPhQXPEFGJNV2zNqWI7QKBd2Gn6AiBko02zuAOXeWIXjV0jNqdKegaE/kJQ6Bfs4aju04lMLkA2T5wBSYPKDGF3RKhFYEa6A1L1LG2yacmsaZ6YPOSAMKNsO+N5dNTfkc5Aqe26uxHpx7ZirvgCwJpWq/lmX1hA7LyabQ34tt5RiJKXSwQ+0KU0V5xg+hZrd4Bn1n4EID+WkQdgLfRNtvil9SPfwy+WQ7PFBWQz6dGWZBLkeJFXZGCfLUjCgGgqXo5TuSu3cugdcTv/HjqnBTEMwzAMwzAMwzAMwzAMw/zf/AFbXiOA6frlMAAAAABJRU5ErkJggg==",
				title: "标题" + t,
				desc: "由各种物质组成的巨型球状天体，叫做星球。星球有一定的形状，有自己的运行轨道。"
			});
		i["default"] = n
	}
	, function(e, i) {
		e.exports = '<div class="weui_pull">\n    <p class="weui_pull_tips">\n        <i class="weui_pull_loading"></i>\n        <span>下拉刷新</span>\n    </p>\n\n    <div class="weui_panel weui_panel_access">\n        <div class="weui_panel_bd">\n            {{each list as item i}}\n            <a href="javascript:void(0);" class="weui_media_box weui_media_appmsg">\n                <div class="weui_media_hd">\n                    <img class="weui_media_appmsg_thumb" src="{{item.thumb}}" alt="">\n                </div>\n                <div class="weui_media_bd">\n                    <h4 class="weui_media_title">{{item.title}}</h4>\n\n                    <p class="weui_media_desc">{{item.desc}}</p>\n                </div>\n            </a>\n            {{/each}}\n        </div>\n    </div>\n</div>'
	}
	, function(e, i, n) {
		var t = n(46);
		"string" == typeof t && (t = [[e.id, t, ""]]);
		n(8)(t, {});
		t.locals && (e.exports = t.locals)
	}
	, function(e, i, n) {
		i = e.exports = n(7)(),
			i.push([e.id, ".weui_panel{margin-top:0}.weui_pull{-webkit-transform:translate3d(0,-40px,0);transform:translate3d(0,-40px,0)}.weui_pull_tips{text-align:center;font-size:12px;padding:10px;color:#888}.weui_pull_loading{width:16px;height:16px;display:inline-block;vertical-align:-4px;-webkit-animation:loadingAnimation 1s steps(12) infinite;animation:loadingAnimation 1s steps(12) infinite;background:transparent url(data:image/svg+xml;base64,PHN2ZyBjbGFzcz0iciIgd2lkdGg9JzEyMHB4JyBoZWlnaHQ9JzEyMHB4JyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMDAgMTAwIj4KICAgIDxyZWN0IHg9IjAiIHk9IjAiIHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiBmaWxsPSJub25lIiBjbGFzcz0iYmsiPjwvcmVjdD4KICAgIDxyZWN0IHg9JzQ2LjUnIHk9JzQwJyB3aWR0aD0nNycgaGVpZ2h0PScyMCcgcng9JzUnIHJ5PSc1JyBmaWxsPScjRTlFOUU5JwogICAgICAgICAgdHJhbnNmb3JtPSdyb3RhdGUoMCA1MCA1MCkgdHJhbnNsYXRlKDAgLTMwKSc+CiAgICA8L3JlY3Q+CiAgICA8cmVjdCB4PSc0Ni41JyB5PSc0MCcgd2lkdGg9JzcnIGhlaWdodD0nMjAnIHJ4PSc1JyByeT0nNScgZmlsbD0nIzk4OTY5NycKICAgICAgICAgIHRyYW5zZm9ybT0ncm90YXRlKDMwIDUwIDUwKSB0cmFuc2xhdGUoMCAtMzApJz4KICAgICAgICAgICAgICAgICByZXBlYXRDb3VudD0naW5kZWZpbml0ZScvPgogICAgPC9yZWN0PgogICAgPHJlY3QgeD0nNDYuNScgeT0nNDAnIHdpZHRoPSc3JyBoZWlnaHQ9JzIwJyByeD0nNScgcnk9JzUnIGZpbGw9JyM5Qjk5OUEnCiAgICAgICAgICB0cmFuc2Zvcm09J3JvdGF0ZSg2MCA1MCA1MCkgdHJhbnNsYXRlKDAgLTMwKSc+CiAgICAgICAgICAgICAgICAgcmVwZWF0Q291bnQ9J2luZGVmaW5pdGUnLz4KICAgIDwvcmVjdD4KICAgIDxyZWN0IHg9JzQ2LjUnIHk9JzQwJyB3aWR0aD0nNycgaGVpZ2h0PScyMCcgcng9JzUnIHJ5PSc1JyBmaWxsPScjQTNBMUEyJwogICAgICAgICAgdHJhbnNmb3JtPSdyb3RhdGUoOTAgNTAgNTApIHRyYW5zbGF0ZSgwIC0zMCknPgogICAgPC9yZWN0PgogICAgPHJlY3QgeD0nNDYuNScgeT0nNDAnIHdpZHRoPSc3JyBoZWlnaHQ9JzIwJyByeD0nNScgcnk9JzUnIGZpbGw9JyNBQkE5QUEnCiAgICAgICAgICB0cmFuc2Zvcm09J3JvdGF0ZSgxMjAgNTAgNTApIHRyYW5zbGF0ZSgwIC0zMCknPgogICAgPC9yZWN0PgogICAgPHJlY3QgeD0nNDYuNScgeT0nNDAnIHdpZHRoPSc3JyBoZWlnaHQ9JzIwJyByeD0nNScgcnk9JzUnIGZpbGw9JyNCMkIyQjInCiAgICAgICAgICB0cmFuc2Zvcm09J3JvdGF0ZSgxNTAgNTAgNTApIHRyYW5zbGF0ZSgwIC0zMCknPgogICAgPC9yZWN0PgogICAgPHJlY3QgeD0nNDYuNScgeT0nNDAnIHdpZHRoPSc3JyBoZWlnaHQ9JzIwJyByeD0nNScgcnk9JzUnIGZpbGw9JyNCQUI4QjknCiAgICAgICAgICB0cmFuc2Zvcm09J3JvdGF0ZSgxODAgNTAgNTApIHRyYW5zbGF0ZSgwIC0zMCknPgogICAgPC9yZWN0PgogICAgPHJlY3QgeD0nNDYuNScgeT0nNDAnIHdpZHRoPSc3JyBoZWlnaHQ9JzIwJyByeD0nNScgcnk9JzUnIGZpbGw9JyNDMkMwQzEnCiAgICAgICAgICB0cmFuc2Zvcm09J3JvdGF0ZSgyMTAgNTAgNTApIHRyYW5zbGF0ZSgwIC0zMCknPgogICAgPC9yZWN0PgogICAgPHJlY3QgeD0nNDYuNScgeT0nNDAnIHdpZHRoPSc3JyBoZWlnaHQ9JzIwJyByeD0nNScgcnk9JzUnIGZpbGw9JyNDQkNCQ0InCiAgICAgICAgICB0cmFuc2Zvcm09J3JvdGF0ZSgyNDAgNTAgNTApIHRyYW5zbGF0ZSgwIC0zMCknPgogICAgPC9yZWN0PgogICAgPHJlY3QgeD0nNDYuNScgeT0nNDAnIHdpZHRoPSc3JyBoZWlnaHQ9JzIwJyByeD0nNScgcnk9JzUnIGZpbGw9JyNEMkQyRDInCiAgICAgICAgICB0cmFuc2Zvcm09J3JvdGF0ZSgyNzAgNTAgNTApIHRyYW5zbGF0ZSgwIC0zMCknPgogICAgPC9yZWN0PgogICAgPHJlY3QgeD0nNDYuNScgeT0nNDAnIHdpZHRoPSc3JyBoZWlnaHQ9JzIwJyByeD0nNScgcnk9JzUnIGZpbGw9JyNEQURBREEnCiAgICAgICAgICB0cmFuc2Zvcm09J3JvdGF0ZSgzMDAgNTAgNTApIHRyYW5zbGF0ZSgwIC0zMCknPgogICAgPC9yZWN0PgogICAgPHJlY3QgeD0nNDYuNScgeT0nNDAnIHdpZHRoPSc3JyBoZWlnaHQ9JzIwJyByeD0nNScgcnk9JzUnIGZpbGw9JyNFMkUyRTInCiAgICAgICAgICB0cmFuc2Zvcm09J3JvdGF0ZSgzMzAgNTAgNTApIHRyYW5zbGF0ZSgwIC0zMCknPgogICAgPC9yZWN0Pgo8L3N2Zz4=) no-repeat;background-size:100%}@-webkit-keyframes loadingAnimation{0%{-webkit-transform:rotate(0deg)}to{-webkit-transform:rotate(1turn)}}@keyframes loadingAnimation{0%{-webkit-transform:rotate(0deg)}to{-webkit-transform:rotate(1turn)}}", ""])
	}
]);
