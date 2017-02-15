(function (g) {



    var d, i, f;
    i = {
        dragSmooth: 8
    };
    f = {
        viewportWidth: "100%",
        viewportHeight: "100%",
        fitToViewportShortSide: false,
        contentSizeOver100: true,
        loadingBgColor: "#212121",
        startScale: 0,
        startX: 0,
        startY: 0,
        animTime: 500,
        draggInertia: 10,
        zoomLevel: 1,
        zoomStep: 0.1,
        contentUrl: "",
        intNavEnable: true,
        intNavPos: "B",
        intNavAutoHide: true,
        intNavMoveDownBtt: false,
        intNavMoveUpBtt: false,
        intNavMoveRightBtt: false,
        intNavMoveLeftBtt: false,
        intNavZoomBtt: true,
        intNavUnzoomBtt: true,
        intNavFitToViewportBtt: true,
        intNavFullSizeBtt: true,
        intNavBttSizeRation: 1,
        mapEnable: true,
        mapThumb: null,
        mapPos: "BL",
        popupShowAction: "click",
        testMode: false
    };
    d = {
        init: function (n, m) {
            return this.each(function () {
                var r = g(this),
                    q = r.data("lhpMIV"),
                    p = r.find("img"),
                    o = {};
                g.extend(o, f, n);
                g.extend(o, i);
                if (!q) {
                    if (o.draggInertia < 0) {
                        o.draggInertia = 0
                    }
                    o.animTime = parseInt(o.animTime);
                    if (o.animTime < 0) {
                        o.animTime = 0
                    }
                    if (p.length > 0) {
                        o.contentUrl = p[0].src;
                        p.remove()
                    }
                    r.data("lhpMIV", {});
                    r.data("lhpMIV").interImgsTmp = p;
                    r.data("lhpMIV").lc = new e(o, r, m)
                }
            })
        },
        setPosition: function (m, p, o, n) {
            return this.each(function () {
                var r = g(this),
                    q = r.data("lhpMIV");
                if (q) {
                    r.data("lhpMIV").lc.setProperties(m, p, o, n)
                }
            })
        },
        moveUp: function () {
            return this.each(function () {
                var n = g(this),
                    m = n.data("lhpMIV");
                if (m) {
                    n.data("lhpMIV").lc.beginDirectMove("U")
                }
            })
        },
        moveDown: function () {
            return this.each(function () {
                var n = g(this),
                    m = n.data("lhpMIV");
                if (m) {
                    n.data("lhpMIV").lc.beginDirectMove("D")
                }
            })
        },
        moveLeft: function () {
            return this.each(function () {
                var n = g(this),
                    m = n.data("lhpMIV");
                if (m) {
                    n.data("lhpMIV").lc.beginDirectMove("L")
                }
            })
        },
        moveRight: function () {
            return this.each(function () {
                var n = g(this),
                    m = n.data("lhpMIV");
                if (m) {
                    n.data("lhpMIV").lc.beginDirectMove("R")
                }
            })
        },
        moveStop: function () {
            return this.each(function () {
                var n = g(this),
                    m = n.data("lhpMIV");
                if (m) {
                    n.data("lhpMIV").lc.stopDirectMoving()
                }
            })
        },
        zoom: function () {
            return this.each(function () {
                var n = g(this),
                    m = n.data("lhpMIV");
                if (m) {
                    n.data("lhpMIV").lc.beginZooming("Z")
                }
            })
        },
        unzoom: function () {
            return this.each(function () {
                var n = g(this),
                    m = n.data("lhpMIV");
                if (m) {
                    n.data("lhpMIV").lc.beginZooming("U")
                }
            })
        },
        zoomStop: function () {
            return this.each(function () {
                var n = g(this),
                    m = n.data("lhpMIV");
                if (m) {
                    n.data("lhpMIV").lc.stopZooming()
                }
            })
        },
        fitToViewport: function () {
            return this.each(function () {
                var n = g(this),
                    m = n.data("lhpMIV");
                if (m) {
                    n.data("lhpMIV").lc.setProperties(null, null, 0)
                }
            })
        },
        fullSize: function () {
            return this.each(function () {
                var n = g(this),
                    m = n.data("lhpMIV");
                if (m) {
                    n.data("lhpMIV").lc.setProperties(null, null, n.data("lhpMIV").lc.sett.zoomLevel)
                }
            })
        },
        adaptsToContainer: function () {
            return this.each(function () {
                var n = g(this),
                    m = n.data("lhpMIV");
                if (m) {
                    n.data("lhpMIV").lc.adaptsToContainer()
                }
            })
        },
        getCurrentState: function () {
            var o = g(this),
                n = o.data("lhpMIV"),
                m = {};
            if (n) {
                m = o.data("lhpMIV").lc.getCurrentState()
            }
            return m
        },
        destroy: function () {
            return this.each(function () {
                var n = g(this),
                    m = n.data("lhpMIV");
                if (m) {
                    n.data("lhpMIV").lc.destroy();
                    n.prepend(n.data("lhpMIV").interImgsTmp);
                    n.removeData("lhpMIV")
                }
            })
        }
    };
    g.fn.lhpMegaImgViewer = function (m) {
	
		
	
        if (d[m]) {
            return d[m].apply(this, Array.prototype.slice.call(arguments, 1))
        } else {
            if (typeof m === "object" || !m) {
                return d.init.apply(this, arguments)
            } else {
                g.error("Method " + m + " does not exist on jQuery.lhpMegaImgViewer")
            }
        }
    };
	
	
	
    var e = function (n, o, m) {
        this.isTouchDev = this.isTouchDevice();
        this.sett = n;
        this.$mainHolder = o;
        this.lastMousePageCoor = null;
        this.lastDrag = null;
        this.contentFullSize = {};
        this.$mivHol = null;
        this.$contentHol = null;
        this.$content = null;
        this.$preloadHol = null;
        this.$blackScreen = null;
        this.$infoBox = null;
        this.$navHol = null;
        this.movingIntreval = null;
        this.movingDirectIntreval = null;
        this.navAutohideInterval = null;
        this.speedX = this.speedY = null;
        this.targetX = this.targetY = null;
        this.allow = {
            allowDown: false,
            allowUp: false,
            allowLeft: false,
            allowRight: false,
            allowZoom: false,
            allowUnzoom: false
        };
        this.isScaled = false;
        this.sett.zoomLevel = Math.abs(this.sett.zoomLevel);
        this.sett.zoomStep = Math.abs(this.sett.zoomStep);
        this.sm = new l(this.sett.zoomLevel, this.sett.zoomStep);
        this.map = null;
        this.pinchData = {
            dt: 0,
            ds: 0
        };
        this.markersContainer = m;
        this.markers = null;
        this.createHolders();
        this.contentLoader = new h(this.sett.contentUrl, this.$contentHol, function (p) {
            return function (q) {
                p.imgContentStart(q)
            }
        }(this));
        this.contentLoader.loadStart()
    };
    e.prototype.isTouchDevice = function () {
        if (navigator.userAgent.toLowerCase().indexOf("chrome") > -1) {
            if (navigator.userAgent.match(/(iPad)|(iPhone)|(iPod)|(android)|(webOS)/i) == null) {
                return false
            }
        }
        return (("ontouchstart" in window) || window.DocumentTouch && document instanceof DocumentTouch)
    };
    e.prototype.createHolders = function () {
        this.$mivHol = g("<div />").addClass("lhp_miv_holder").css({
            position: "relative",
            overflow: "hidden",
            width: this.sett.viewportWidth,
            height: this.sett.viewportHeight
        });
        this.$preloadHol = g("<div />").addClass("lhp_miv_preload_holder");
        this.$contentHol = g("<div />").addClass("lhp_miv_content_holder").css({
            position: "absolute"
        });
        this.$blackScreen = g("<div />").addClass("lhp_miv_blackScreen").css({
            position: "absolute",
            "z-index": "9999",
            width: "100%",
            height: "100%"
            //background: this.sett.loadingBgColor
        });
        this.$mivHol.append(this.$preloadHol);
        this.$mivHol.append(this.$blackScreen);
        this.$mivHol.append(this.$contentHol);
        this.$mainHolder.append(this.$mivHol);
        if (this.sett.testMode) {
            this.$infoBox = g("<div />").addClass("lhp_miv_infoBox_holder");
            this.$mivHol.append(this.$infoBox)
        }
    };
    e.prototype.navBttCalcSize = function () {
        var o = 27,
            m = 0,
            p = 4,
            n = this.sett.intNavBttSizeRation;
        if (n > 1) {
            p = Math.ceil(p * n);
            m = p - 4;
            o += 2 * m
        }
        return {
            width: o,
            paddingHoriziontal: m,
            paddingVertical: p
        }
    };
    e.prototype.iniNav = function () {
        var n = g("<ul />").addClass("ui-widget ui-helper-clearfix"),
            u = this.$mainHolder,
            o = this.$navHol,
            r, s, p = this,
            w = this.navBttCalcSize().width,
            v = this.navBttCalcSize().paddingVertical,
            q = this.navBttCalcSize().paddingHoriziontal,
            m = 0,
            t = [
                ["moveDown", "moveStop", "ui-icon-carat-1-n", "intNavMoveDownBtt"],
                ["moveUp", "moveStop", "ui-icon-carat-1-s", "intNavMoveUpBtt"],
                ["moveRight", "moveStop", "ui-icon-carat-1-w", "intNavMoveRightBtt"],
                ["moveLeft", "moveStop", "ui-icon-carat-1-e", "intNavMoveLeftBtt"],
                ["zoom", "zoomStop", "ui-icon-zoomin", "intNavZoomBtt"],
                ["unzoom", "zoomStop", "ui-icon-zoomout", "intNavUnzoomBtt"],
                ["fitToViewport", null, "ui-icon-stop", "intNavFitToViewportBtt"],
                ["fullSize", null, "ui-icon-arrow-4-diag", "intNavFullSizeBtt"]
            ];
        g.each(t, function (y) {
            var z = t[y][0],
                A = t[y][1],
                C = t[y][3],
                B, x;
            if (p.sett[C]) {
                m += w;
                B = g("<li />").addClass("ui-state-default ui-corner-all " + z), x = g("<span />").addClass("ui-icon " + t[y][2]);
                B.append(x);
                n.append(B);
                B.css("padding", v + "px " + q + "px");
                B.bind("mouseenter.lhpMIV touchstart.lhpMIV", function () {
                    if (!g(this).hasClass("lhp_miv_nav_btt_disab")) {
                        g(this).addClass("ui-state-hover")
                    }
                });
                B.bind("mouseleave.lhpMIV touchend.lhpMIV", function () {
                    g(this).removeClass("ui-state-hover")
                });
                B.bind(((p.isTouchDev) ? "touchstart.lhpMIV" : "mousedown.lhpMIV"), function (D) {
                    return function (E) {
                        if (!g(this).hasClass("lhp_miv_nav_btt_disab")) {
                            u.lhpMegaImgViewer(D)
                        }
                        E.preventDefault()
                    }
                }(z));
                if (A) {
                    B.bind(((p.isTouchDev) ? "touchend.lhpMIV" : "mouseup.lhpMIV"), function (D) {
                        return function (E) {
                            if (!g(this).hasClass("lhp_miv_nav_btt_disab")) {
                                u.lhpMegaImgViewer(D)
                            }
                            E.preventDefault()
                        }
                    }(A))
                }
            }
        });
        if (this.$navHol.hasClass("lhp_miv_nav_pos_L") || this.$navHol.hasClass("lhp_miv_nav_pos_R")) {
            this.$navHol.css("width", w);
            this.$navHol.css("margin-top", -m / 2)
        }
        if (this.$navHol.hasClass("lhp_miv_nav_pos_T") || this.$navHol.hasClass("lhp_miv_nav_pos_B")) {
            this.$navHol.css("margin-left", -m / 2)
        }
        u.bind("mivChange.lhpMIV", function (z) {
            var y = "lhp_miv_nav_btt_disab",
                x = "ui-state-hover";
            if (z.allowDown) {
                o.find(".moveDown").removeClass(y)
            } else {
                o.find(".moveDown").removeClass(x).addClass(y)
            } if (z.allowUp) {
                o.find(".moveUp").removeClass(y)
            } else {
                o.find(".moveUp").removeClass(x).addClass(y)
            } if (z.allowLeft) {
                o.find(".moveLeft").removeClass(y)
            } else {
                o.find(".moveLeft").removeClass(x).addClass(y)
            } if (z.allowRight) {
                o.find(".moveRight").removeClass(y)
            } else {
                o.find(".moveRight").removeClass(x).addClass(y)
            } if (z.allowZoom) {
                o.find(".zoom").removeClass(y);
                o.find(".fullSize").removeClass(y)
            } else {
                o.find(".zoom").removeClass(x).addClass(y);
                o.find(".fullSize").removeClass(x).addClass(y)
            } if (z.allowUnzoom) {
                o.find(".unzoom").removeClass(y);
                o.find(".fitToViewport").removeClass(y)
            } else {
                o.find(".unzoom").removeClass(x).addClass(y);
                o.find(".fitToViewport").removeClass(x).addClass(y)
            }
        });
        if (this.sett.intNavAutoHide) {
            //o.css("display", "none");
			
            u.bind("mouseenter.lhpMIV touchstart.lhpMIV", function () {
                clearInterval(p.navAutohideInterval);
                o.fadeIn("fast");
				
				
				
            });
            u.bind("mouseleave.lhpMIV touchend.lhpMIV", function () {
                clearInterval(p.navAutohideInterval);
                p.navAutohideInterval = setInterval(function (x) {
                    return function () {
                        x.stop().clearQueue().fadeOut("fast");
			
						
                    }
                }(o), 1000)
            })
        }
        o.append(n)
    };
    e.prototype.imgContentStart = function (m) {
        this.$content = m;
        m.addClass("lhp_miv_content").css({
            "float": "left"
        });
        this.contentFullSize = {
            w: m.width(),
            h: m.height()
        };
		
		
		
        this.sett.mainImgWidth = this.contentFullSize.w;
        this.sett.mainImgHeight = this.contentFullSize.h;

		this.sett.startX = (this.sett.mainImgWidth / 2);
		this.sett.startY = (this.sett.mainImgHeight / 2);

		
		
		
        this.start();
        this.$preloadHol.remove();
        this.$blackScreen.animate({
            opacity: 0
        }, {
            duration: 500,
            complete: function () {
                g(this).remove()
            }
        });
        this.dispatchEventReady()
    };
    e.prototype.start = function () {
        if (this.sett.mapEnable && this.sett.mapThumb) {
            this.map = new c(this.sett, this.$mainHolder, this.$content, this.isTouchDev);
            this.map.ini(this.$mivHol)
        }
        if (this.sett.intNavEnable) {
            this.$navHol = g('<div class="lhp_miv_nav"/>').addClass("lhp_miv_nav_pos_" + this.sett.intNavPos);
            this.iniNav();
            this.$mivHol.prepend(this.$navHol)
        }
        this.markers = new b(this.$mainHolder, this.$contentHol, this.markersContainer, this.isTouchDev, this.sett.popupShowAction, this.sett.startScale);
        this.markers.ini();
        if (this.isTouchDev) {
            this.$contentHol.hammer({
                preventDefault: true
            });
            this.$contentHol.off("touch", this.mousedownHandler).on("touch", {
                _this: this
            }, this.mousedownHandler);
            this.$contentHol.on("pinch", {
                _this: this
            }, this.pinchHandler)
        } else {
            this.$contentHol.bind("mouseenter.lhpMIV", {
                _this: this
            }, this.mouseenterHandler);
            this.$contentHol.bind("mousedown.lhpMIV", {
                _this: this
            }, this.mousedownHandler);
            this.$contentHol.bind("mouseup.lhpMIV", {
                _this: this
            }, this.mouseupHandler);
            this.$contentHol.bind("mouseleave.lhpMIV", {
                _this: this
            }, this.mouseupHandler);
            this.$contentHol.bind("mousewheel.lhpMIV", {
                _this: this
            }, this.mousewheelHandler);
            if (this.sett.testMode) {
                this.$contentHol.bind("mousemove.lhpMIV", {
                    _this: this
                }, this.showCurrentCoor)
            }
        }
        this.setProperties(this.sett.startX, this.sett.startY, this.sett.startScale, true)
    };
    e.prototype.destroy = function () {
        this.contentLoader.dispose();
        this.contentLoader = null;
        this.animStop();
        this.stopMoving();
        this.stopDirectMoving();
        if (this.markers) {
            this.markers.destroy()
        }
        if (this.$navHol) {
            this.$navHol.find("li").each(function (m) {
                g(this).unbind()
            })
        }
        if (this.map) {
            this.map.destroy()
        }
        this.$mainHolder.unbind(".lhpMIV");
        this.$contentHol.unbind();
        this.$mivHol.remove();
        g.each(this, function (n, m) {
            if (!g.isFunction(m)) {
                n = null
            }
        })
    };
    e.prototype.mouseenterHandler = function (m) {
        if (!m.data._this.sett.testMode) {
            m.data._this.$contentHol.removeClass("lhp_cursor_drag").addClass("lhp_cursor_hand")
        }
    };
    e.prototype.mousedownHandler = function (n) {
        if (g(n.target).hasClass("lhp_miv_content")) {
            var o = n.data._this,
                m = a(n);
            o.animStop(true);
            o.stopMoving();
            o.stopDirectMoving();
            o.lastMousePageCoor = m[0];
            if (o.isTouchDev) {
                o.pinchData.dt = 0;
                o.pinchData.ds = null;
                o.$contentHol.off("drag", o.mousemoveHandler);
                o.$contentHol.off("release", o.positioning);
                if (m.length < 2) {
                    o.$contentHol.on("drag", {
                        _this: o
                    }, o.mousemoveHandler);
                    o.$contentHol.on("release", {
                        _this: o
                    }, o.positioning)
                }
            } else {
                o.$contentHol.removeClass("lhp_cursor_hand").addClass("lhp_cursor_drag");
                o.$contentHol.unbind("mousemove.lhpMIV", o.mousemoveHandler).bind("mousemove.lhpMIV", {
                    _this: o
                }, o.mousemoveHandler);
                o.$contentHol.unbind({
                    "mouseup.lhpMIV": o.positioning
                }).bind("mouseup.lhpMIV", {
                    _this: o
                }, o.positioning)
            }
            n.preventDefault()
        }
    };
    e.prototype.pinchHandler = function (q) {
        if (g(q.target).hasClass("lhp_miv_content")) {
            var t = q.data._this,
                n = q.gesture.timeStamp - t.pinchData.dt,
                o = q.gesture.scale - t.pinchData.ds,
                m = t.pinchData.ds === null;
            if (n > 100 && Math.abs(o) > 0.1) {
                t.animStop();
                t.stopMoving();
                t.stopDirectMoving();
                t.pinchData.dt = q.gesture.timeStamp;
                t.pinchData.ds = q.gesture.scale;
                if (!m) {
                    var r = t.getCurrentState().scale,
                        s = (o > 0) ? t.sm.nextScale() : t.sm.prevScale(),
                        p = t.calculateScale(q, s);
                    t.animSizeAndPos(p.x, p.y, p.w, p.h, false)
                }
            }
        }
    };
    e.prototype.mousemoveHandler = function (m) {
        if (g(m.target).hasClass("lhp_miv_content")) {
            var n = m.data._this;
            if (n.isTouchDev) {
                n.$contentHol.off("release", n.positioning);
                n.$contentHol.off("release", n.stopDraggingHandler).on("release", {
                    _this: n
                }, n.stopDraggingHandler)
            } else {
                n.$contentHol.unbind("mouseup.lhpMIV", n.positioning);
                n.$contentHol.unbind({
                    "mouseup.lhpMIV": n.stopDraggingHandler
                }).bind("mouseup.lhpMIV", {
                    _this: n
                }, n.stopDraggingHandler);
                n.$contentHol.unbind({
                    "mouseleave.lhpMIV": n.stopDraggingHandler
                }).bind("mouseleave.lhpMIV", {
                    _this: n
                }, n.stopDraggingHandler)
            }
            n.dragging(m, "hard");
            m.preventDefault()
        }
    };
    e.prototype.mouseupHandler = function (m) {
        var n = m.data._this;
        n.$contentHol.unbind("mousemove.lhpMIV", n.mousemoveHandler);
        n.$contentHol.unbind("mouseup.lhpMIV", n.positioning);
        if (!n.sett.testMode) {
            n.$contentHol.removeClass("lhp_cursor_drag").addClass("lhp_cursor_hand")
        } else {
            n.$contentHol.css("cursor", "default")
        }
    };
    e.prototype.stopDraggingHandler = function (m) {
        var n = m.data._this;
        if (n.isTouchDev) {
            n.$contentHol.off("release", n.stopDraggingHandler)
        } else {
            n.$contentHol.unbind({
                "mouseup.lhpMIV": n.stopDraggingHandler
            });
            n.$contentHol.unbind({
                "mouseleave.lhpMIV": n.stopDraggingHandler
            })
        }
        n.dragging(m, "inertia")
    };
    e.prototype.mousewheelHandler = function (n, q) {
        var p = n.data._this,
            o = (q > 0) ? p.sm.nextScale() : p.sm.prevScale(),
            m = p.calculateScale(n, o);
        p.animStop();
        p.stopMoving();
        p.stopDirectMoving();
        p.animSizeAndPos(m.x, m.y, m.w, m.h);
        n.preventDefault();
        n.stopPropagation();
        return false
    };
    e.prototype.showCurrentCoor = function (p) {
        var r = p.data._this,
            m = a(p)[0],
            q = r.$contentHol.position(),
            n = r.$mivHol.offset(),
            o = r.$content.width() / r.contentFullSize.w;
        m.x = Math.round((m.x - q.left - n.left) / o);
        m.y = Math.round((m.y - q.top - n.top) / o);
        r.$infoBox.css("display", "block");
        r.$infoBox.html("x:" + m.x + " y:" + m.y)
    };
    e.prototype.adaptsToContainer = function () {
        if (this.$content) {
            var m = this.$content.width() / this.contentFullSize.w;
            m = (m > this.sett.zoomLevel) ? this.sett.zoomLevel : m;
            this.animStop();
            this.stopMoving();
            this.stopDirectMoving();
            this.setProperties(null, null, m, true)
        }
    };
    e.prototype.beginZooming = function (o) {
        if (this.$content) {
            var s = (o == "Z") ? 1 : -1,
                p = {
                    _this: this
                }, r = {
                    x: (this.$mivHol.width() / 2),
                    y: (this.$mivHol.height() / 2)
                }, n = this.$mivHol.offset(),
                m = {
                    x: (r.x + n.left),
                    y: (r.y + n.top)
                }, q = {
                    data: p,
                    pageX: m.x,
                    pageY: m.y
                };
            this.animStop(true);
            this.stopMoving();
            this.stopDirectMoving();
            if (!this.movingIntreval) {
                this.movingIntreval = setInterval(function (v, t, u) {
                    return function () {
                        v.zooming(t, u)
                    }
                }(this, q, s), this.sett.animTime / 5)
            }
            this.zooming(q, s)
        }
    };
    e.prototype.zooming = function (n, p) {
        var o = (p > 0) ? this.sm.nextScale() : this.sm.prevScale(),
            m = this.calculateScale(n, o);
        this.animStop();
        this.animSizeAndPos(m.x, m.y, m.w, m.h);
        if (this.sett.fitToViewportShortSide) {
            if (o >= this.sett.zoomLevel || m.w <= this.$mivHol.width() || m.h <= this.$mivHol.height()) {
                this.stopZooming()
            }
        } else {
            if (o >= this.sett.zoomLevel || (m.w <= this.$mivHol.width() && m.h <= this.$mivHol.height())) {
                this.stopZooming()
            }
        }
    };
    e.prototype.stopZooming = function () {
        this.stopMoving()
    };
    e.prototype.beginDirectMove = function (m) {
        if (this.$content) {
            this.animStop(true);
            this.stopMoving();
            this.sm.setScale(this.$content.width() / this.contentFullSize.w);
            this.speedX = this.speedY = 0;
            switch (m) {
            case "U":
                this.speedY = -50000 / this.sett.animTime;
                break;
            case "D":
                this.speedY = 50000 / this.sett.animTime;
                break;
            case "L":
                this.speedX = -50000 / this.sett.animTime;
                break;
            case "R":
                this.speedX = 50000 / this.sett.animTime;
                break
            }
            if (!this.movingDirectIntreval && (this.speedX || this.speedY)) {
                this.movingDirectIntreval = setInterval(function (n) {
                    return function () {
                        n.directMoveWithInertia()
                    }
                }(this), 10)
            }
        }
    };
    e.prototype.directMoveWithInertia = function () {
        var n = this.$contentHol.position().left,
            m = this.$contentHol.position().top,
            q = Math.ceil(n + this.speedX),
            o = Math.ceil(m + this.speedY),
            p;
        if (!this.movingIntreval) {
            this.movingIntreval = setInterval(function (r) {
                return function () {
                    r.moveWithInertia()
                }
            }(this), 10)
        }
        p = this.getSafeTarget(q, o, this.speedX, this.speedY);
        this.targetX = Math.round(p.x);
        this.targetY = Math.round(p.y)
    };
    e.prototype.stopDirectMoving = function () {
        clearInterval(this.movingDirectIntreval);
        this.movingDirectIntreval = null
    };
    e.prototype.dragging = function (r, p) {
        var q = this.sett.draggInertia,
            n = a(r)[0],
            o = n.x - this.lastMousePageCoor.x,
            m = n.y - this.lastMousePageCoor.y;
        if (p == "inertia" && this.lastDragg) {
            this.draggingWithInertia(this.lastDragg.x * q, this.lastDragg.y * q)
        } else {
            this.draggingHard(o, m)
        }
        this.lastDragg = {
            x: (Math.abs(o) < 5) ? 0 : o,
            y: (Math.abs(m) < 5) ? 0 : m
        };
        this.lastMousePageCoor = n
    };
    e.prototype.draggingHard = function (n, m) {
        var r = this.$contentHol.position(),
            q = r.left + n,
            o = r.top + m,
            p = this.getSafeTarget(q, o, n, m);
        this.animStop();
        this.$contentHol.css({
            left: p.x,
            top: p.y
        })
    };
    e.prototype.draggingWithInertia = function (n, m) {
        var q = this.targetX + n,
            o = this.targetY + m,
            p;
        if (!this.movingIntreval) {
            this.movingIntreval = setInterval(function (r) {
                return function () {
                    r.moveWithInertia()
                }
            }(this), 10);
            q = this.$contentHol.position().left + n;
            o = this.$contentHol.position().top + m
        }
        p = this.getSafeTarget(q, o, n, m);
        this.targetX = Math.round(p.x);
        this.targetY = Math.round(p.y)
    };
    e.prototype.getSafeTarget = function (z, x, p, n) {
        var m = this.getLimit(this.sm.getScale()),
            q = m.xMin,
            t = m.xMax,
            A = m.yMin,
            s = m.yMax,
            o = this.$mivHol.width(),
            y = this.$mivHol.height(),
            w = o / 2,
            v = y / 2,
            u = this.contentFullSize.w * this.sm.getScale(),
            r = this.contentFullSize.h * this.sm.getScale();
        if ((n < 0) && (x < A)) {
            x = A
        } else {
            if ((n > 0) && (x > s)) {
                x = s
            }
        } if (r < y) {
            x = v - r / 2
        }
        if ((p < 0) && (z < q)) {
            z = q
        } else {
            if ((p > 0) && (z > t)) {
                z = t
            }
        } if (u < o) {
            z = w - u / 2
        }
        return {
            x: z,
            y: x
        }
    };
    e.prototype.moveWithInertia = function () {
        var p = this.$contentHol.position(),
            o = this.sett.dragSmooth,
            n, m;
        p.left = Math.ceil(p.left);
        p.top = Math.ceil(p.top);
        n = (this.targetX - p.left) / o;
        m = (this.targetY - p.top) / o;
        if (Math.abs(n) < 1) {
            n = (n > 0) ? 1 : -1
        }
        if (Math.abs(m) < 1) {
            m = (m > 0) ? 1 : -1
        }
        if (p.left == this.targetX) {
            n = 0
        }
        if (p.top == this.targetY) {
            m = 0
        }
        this.$contentHol.css({
            left: p.left + n,
            top: p.top + m
        });
        this.dispatchEventChange();
        if (p.left == this.targetX && p.top == this.targetY) {
            this.stopDirectMoving();
            this.stopMoving()
        }
    };
    e.prototype.stopMoving = function () {
        clearInterval(this.movingIntreval);
        this.movingIntreval = null
    };
    e.prototype.positioning = function (n) {
        if (g(n.target).hasClass("lhp_miv_content")) {
            var o = n.data._this,
                m = o.calculatePosInCenter(n);
            o.animStop();
            o.stopMoving();
            o.stopDirectMoving();
            o.animSizeAndPos(m.x, m.y)
        }
    };
    e.prototype.setProperties = function (B, v, p, A) {
        if (this.$content) {
            var q = {
                _this: this
            }, r = {
                    x: (this.$mivHol.width() / 2),
                    y: (this.$mivHol.height() / 2)
                }, C = this.$mivHol.offset(),
                o = {
                    x: (r.x + C.left),
                    y: (r.y + C.top)
                }, s = {
                    data: q,
                    pageX: o.x,
                    pageY: o.y
                }, z = this.$contentHol.position(),
                t, w, m = z.left,
                D = z.top,
                n = this.$content.width(),
                u = this.$content.height();
            B = parseFloat(B);
            v = parseFloat(v);
            p = parseFloat(p);
            if (!isNaN(p)) {
                if (p > this.sett.zoomLevel) {
                    p = this.sett.zoomLevel
                }
                t = this.calculateScale(s, p);
                m = t.x;
                D = t.y;
                n = t.w;
                u = t.h
            }
            w = n / this.contentFullSize.w;
            if (!isNaN(B)) {
                m = -(B * w) + r.x
            }
            if (!isNaN(v)) {
                D = -(v * w) + r.y
            }
            this.animStop();
            this.stopMoving();
            this.stopDirectMoving();
            this.animSizeAndPos(m, D, n, u, A)
        }
    };
    e.prototype.calculatePosInCenter = function (o) {
        var p = this.$contentHol.position(),
            s = this.$mivHol.offset(),
            n = {
                x: (this.$mivHol.width() / 2),
                y: (this.$mivHol.height() / 2)
            }, t = a(o)[0],
            u = {
                x: (t.x - s.left),
                y: (t.y - s.top)
            }, r, q, m, v;
        r = n.x - u.x;
        q = n.y - u.y;
        m = p.left + r;
        v = p.top + q;
        return {
            x: m,
            y: v,
            shftX: r,
            shftY: q
        }
    };
    e.prototype.calculateScale = function (r, q) {
        var u = this.$mivHol.offset(),
            p = this.$content.offset(),
            v = a(r)[0],
            t, o, m, w, n, s;
        q = this.getSafeScale(q);
        this.sm.setScale(q);
        t = this.$content.width() / this.contentFullSize.w;
        o = {
            x: (v.x - p.left) / t,
            y: (v.y - p.top) / t
        };
        n = Math.round(this.contentFullSize.w * q);
        s = Math.round(this.contentFullSize.h * q);
        m = Math.round(p.left - u.left + o.x * (t - q));
        w = Math.round(p.top - u.top + o.y * (t - q));
        return {
            x: m,
            y: w,
            w: n,
            h: s
        }
    };
    e.prototype.getSafeScale = function (t) {
        var v = (t <= 0) ? 0.00001 : t,
            m = this.$mivHol.width(),
            w = this.$mivHol.height(),
            u = this.contentFullSize.w,
            q = this.contentFullSize.h,
            s = u * v,
            o = q * v,
            r = m / u,
            x = w / q,
            n = m / w,
            p = s / o;
        if (this.sett.fitToViewportShortSide) {
            if (s < m || o < w) {
                r = m / this.contentFullSize.w;
                x = w / this.contentFullSize.h;
                v = Math.max(r, x);
                if (!this.sett.contentSizeOver100 && (u <= m || q <= w)) {
                    v = 1
                }
            }
        } else {
            if (s < m && o < w) {
                if (p <= n) {
                    v = x
                } else {
                    v = r
                }
            }
            if (!this.sett.contentSizeOver100 && u <= m && q <= w) {
                v = 1
            }
        }
        return v
    };
    e.prototype.getLimit = function (o) {
        var n = -(Math.round(this.contentFullSize.w * o) - this.$mivHol.width()),
            m = -(Math.round(this.contentFullSize.h * o) - this.$mivHol.height());
        return {
            xMin: n,
            xMax: 0,
            yMin: m,
            yMax: 0
        }
    };
    e.prototype.getSafeXY = function (z, v, u) {
        var m = this.getLimit(u),
            n = this.$mivHol.width(),
            w = this.$mivHol.height(),
            t = n / 2,
            r = w / 2,
            s = this.contentFullSize.w,
            p = this.contentFullSize.h,
            q = s * u,
            o = p * u,
            B = z,
            A = v;
        if (q < n) {
            if (z < m.xMin || z > m.xMax) {
                B = t - q / 2
            }
        } else {
            if (z < m.xMin) {
                B = m.xMin
            } else {
                if (z > m.xMax) {
                    B = m.xMax
                }
            }
        } if (o < w) {
            if (v < m.yMin || v > m.yMax) {
                A = r - o / 2
            }
        } else {
            if (v < m.yMin) {
                A = m.yMin
            } else {
                if (v > m.yMax) {
                    A = m.yMax
                }
            }
        }
        return {
            x: B,
            y: A
        }
    };
    e.prototype.animSizeAndPos = function (u, r, v, o, t) {
        var q, s, z = function (w) {
                return function () {
                    w.dispatchEventChange()
                }
            }(this),
            m = function (w) {
                return function () {
                    w.dispatchEventChange()
                }
            }(this),
            n = function (w) {
                return function () {
                    w.dispatchEventChange()
                }
            }(this),
            p = function (w) {
                return function () {
                    w.isScaled = false;
                    w.dispatchEventChange()
                }
            }(this);
        if (v != undefined) {
            s = v / this.contentFullSize.w
        } else {
            s = this.$content.width() / this.contentFullSize.w
        } if (u != undefined && r != undefined) {
            q = this.getSafeXY(u, r, s);
            if (t) {
                this.$contentHol.css({
                    left: q.x,
                    top: q.y
                });
                m()
            } else {
                this.$contentHol.animate({
                    left: q.x,
                    top: q.y
                }, {
                    duration: this.sett.animTime,
                    easing: "easeOutCubic",
                    step: z,
                    complete: m
                })
            }
        }
        if (v != undefined && o != undefined && (v != this.$content.width() || o != this.$content.height())) {
            this.isScaled = true;
            if (t) {
                this.$content.css({
                    width: v,
                    height: o
                });
                n();
                p()
            } else {
                this.$content.animate({
                    width: v,
                    height: o
                }, {
                    duration: this.sett.animTime,
                    easing: "easeOutCubic",
                    step: n,
                    complete: p
                })
            }
        }
    };
    e.prototype.animStop = function (m) {
        if (this.$contentHol && this.$content) {
            this.$contentHol.stop().clearQueue();
            this.$content.stop().clearQueue();
            if (m) {
                this.sm.setScale(this.$content.width() / this.contentFullSize.w)
            }
            this.dispatchEventChange()
        }
    };
    e.prototype.dispatchEventChange = function () {
        var m = this.getCurrentState(),
            n = g.Event("mivChange", m);
        this.allow = m;
        this.$mainHolder.trigger(n)
    };
    e.prototype.dispatchEventReady = function () {
        this.$mainHolder.trigger(g.Event("mivReady"))
    };
    e.prototype.getCurrentState = function () {
        var n = {};
        if (this.$content) {
            var s = this.$contentHol.position(),
                o = this.getLimit(this.sm.getScale()),
                m = this.$content.width(),
                p = this.$content.height(),
                r = {
                    x: (this.$mivHol.width() / 2),
                    y: (this.$mivHol.height() / 2)
                }, q = m / this.contentFullSize.w;
            n.allowDown = (Math.ceil(s.top) < Math.ceil(o.yMax));
            n.allowUp = (Math.ceil(s.top) > Math.ceil(o.yMin));
            n.allowRight = (Math.ceil(s.left) < Math.ceil(o.xMax));
            n.allowLeft = (Math.ceil(s.left) > Math.ceil(o.xMin));
            n.allowZoom = (m / this.contentFullSize.w < this.sett.zoomLevel);
            if (this.sett.fitToViewportShortSide) {
                n.allowUnzoom = (m > this.$mivHol.width() && p > this.$mivHol.height())
            } else {
                n.allowUnzoom = (m > this.$mivHol.width() || p > this.$mivHol.height())
            }
            n.wPropViewpContent = this.$mivHol.width() / m;
            n.hPropViewpContent = this.$mivHol.height() / p;
            n.xPosInCenter = Math.round((-s.left + r.x) / q);
            n.yPosInCenter = Math.round((-s.top + r.y) / q);
            n.scale = q;
            n.isScaled = this.isScaled
        }
        return n
    };
    e.prototype.allowCompare = function (o, m) {
        var n = true;
        g.each(o, function (p) {
            if (o[p] != m[p]) {
                n = false;
                return
            }
        });
        return n
    };
    var l = function (n, m) {
        this.step = m;
        this.curr = 1;
        this.zoomLevel = n
    };
    l.prototype.getScale = function () {
        return this.curr
    };
    l.prototype.setScale = function (m) {
        this.curr = m
    };
    l.prototype.nextScale = function () {
        var m = this.curr + this.step;
        if (m > this.zoomLevel) {
            this.curr = this.zoomLevel
        } else {
            this.curr = m
        }
        return this.getScale()
    };
    l.prototype.prevScale = function () {
        var m = this.curr - this.step;
        if (m < this.step) {
            this.curr = 0
        } else {
            this.curr = m
        }
        return this.getScale()
    };
    var h = function (n, m, o) {
        this.url = n;
        this.$imgHolder = m;
        this.callback = o
    };
    h.prototype.loadStart = function () {
        var m = g("<img/>");
        m.one("load", function (n) {
            return function (o) {
                n.loadComplete(o)
            }
        }(this));
        this.$imgHolder.prepend(m);
        m.attr("src", this.url)
    };
    h.prototype.loadComplete = function (m) {
        if (this.callback) {
            this.callback(g(m.currentTarget))
        }
    };
    h.prototype.dispose = function () {
        this.callback = null
    };
    var c = function (o, p, m, n) {
        this.contentLoader = null;
        this.isTouchDev = n;
        this.sett = o;
        this.$mainHolder = p;
        this.$previewImg = m;
        this.$img = null;
        this.$mapHol = null;
        this.$mapWrappHol = null;
        this.$vr = null;
        this.lastMousePageCoor = {};
        this.contentLoadStartTimeout = null
    };
    c.prototype.ini = function (m) {
        this.$mapHol = g('<div class="lhp_miv_map"/>');
        this.$mapWrappHol = g('<div class="lhp_miv_map_wrapp_hol"/>');
        this.$mapHol.append(this.$mapWrappHol);
        m.prepend(this.$mapHol);
        this.contentLoader = new h(this.sett.mapThumb, this.$mapWrappHol, function (o) {
            return function (p) {
                o.start(p)
            }
        }(this));
        var n = this;
        this.contentLoadStartTimeout = setTimeout(function () {
            return function () {
                n.contentLoader.loadStart()
            }
        }(), 10)
    };
    c.prototype.start = function (n) {
        var m = n.width(),
            o = n.height(),
            p;
        this.$img = n;
        this.$img.css({
            cursor: "pointer"
        });
        this.$mapHol.addClass("lhp_miv_map_pos_" + this.sett.mapPos).css({
            width: m,
            height: o
        });
        this.$mapWrappHol.addClass("lhp_miv_map_wrapp_hol_" + this.sett.mapPos).css({
            width: m,
            height: o
        });
        switch (this.sett.mapPos) {
        case "T":
        case "B":
            this.$mapHol.css("margin-left", -m / 2);
            break;
        case "L":
        case "R":
            this.$mapHol.css("margin-top", -o / 2);
            break
        }
        this.$mapWrappHol.append(this.$img);
        this.$vr = g('<div class="lhp_miv_map_vr"/>').css({
            position: "absolute",
            "z-index": 2
        }).appendTo(this.$mapWrappHol);
        this.vrAddInteractions();
        this.$mainHolder.bind("mivChange.lhpMIV", {
            _this: this
        }, this.mivChangeHandler);
        p = this.$mainHolder.lhpMegaImgViewer("getCurrentState");
        p.data = {};
        p.data._this = this;
        this.mivChangeHandler(p)
    };
    c.prototype.destroy = function () {
        clearTimeout(this.contentLoadStartTimeout);
        this.$vr.unbind(".lhpMIV");
        this.$mapHol.unbind(".lhpMIV");
        this.$img.unbind(".lhpMIV");
        this.contentLoader.dispose();
        this.contentLoader = null
    };
    c.prototype.vrAddInteractions = function () {
        if (this.isTouchDev) {
            this.$vr.bind("touchstart.lhpMIV", {
                _this: this
            }, this.mousedownHandler);
            this.$vr.bind("touchend.lhpMIV", {
                _this: this
            }, this.mouseupHandler);
            this.$img.bind("touchstart.lhpMIV", {
                _this: this
            }, this.mouseclickHandler)
        } else {
            this.$vr.bind("mouseenter.lhpMIV", {
                _this: this
            }, this.mouseenterHandler);
            this.$vr.bind("mousedown.lhpMIV", {
                _this: this
            }, this.mousedownHandler);
            this.$mapHol.bind("mouseup.lhpMIV", {
                _this: this
            }, this.mouseupHandler);
            this.$mapHol.bind("mouseleave.lhpMIV", {
                _this: this
            }, this.mouseupHandler);
            this.$img.bind("click.lhpMIV", {
                _this: this
            }, this.mouseclickHandler);
			
			
			
			if (this.sett.intNavAutoHide) {
				
				var esto = this.$mapHol;
				var pp = this;
			
			
            this.$mainHolder.bind("mouseenter.lhpMIV touchstart.lhpMIV", function () {
                clearInterval(pp.navAutohideInterval);
                esto.fadeIn("fast");
				
				
				
            });
            this.$mainHolder.bind("mouseleave.lhpMIV touchend.lhpMIV", function () {
                clearInterval(pp.navAutohideInterval);
                pp.navAutohideInterval = setInterval(function (x) {
                    return function () {
                        x.stop().clearQueue().fadeOut("fast");
			
						
                    }
                }(esto), 1000)
            })			
			
			
			
            		
				
			}
			
			
        }
    };
    c.prototype.mouseenterHandler = function (m) {
        m.data._this.$vr.removeClass("lhp_cursor_drag").addClass("lhp_cursor_hand")
    };
    c.prototype.mousedownHandler = function (m) {
        var n = m.data._this;
        n.$mainHolder.unbind("mivChange.lhpMIV", n.mivChangeHandler);
        if (n.isTouchDev) {
            n.$mapHol.unbind("touchmove.lhpMIV", n.mousemoveHandler).bind("touchmove.lhpMIV", {
                _this: n
            }, n.mousemoveHandler)
        } else {
            n.$vr.removeClass("lhp_cursor_hand").addClass("lhp_cursor_drag");
            n.$mapHol.unbind("mousemove.lhpMIV", n.mousemoveHandler).bind("mousemove.lhpMIV", {
                _this: n
            }, n.mousemoveHandler)
        }
        n.$vr.unbind("mouseenter.lhpMIV", n.mouseenterHandler);
        n.lastMousePageCoor = a(m)[0];
        n.$vr.addClass("lhp_miv_map_vr_over");
        m.preventDefault()
    };
    c.prototype.mousemoveHandler = function (m) {
        var n = m.data._this;
        if (n.isTouchDev) {
            n.$mapHol.unbind({
                "touchend.lhpMIV": n.stopDraggingHandler
            }).bind("touchend.lhpMIV", {
                _this: n
            }, n.stopDraggingHandler)
        } else {
            n.$mapHol.unbind({
                "mouseup.lhpMIV": n.stopDraggingHandler
            }).bind("mouseup.lhpMIV", {
                _this: n
            }, n.stopDraggingHandler);
            n.$mapHol.unbind({
                "mouseleave.lhpMIV": n.stopDraggingHandler
            }).bind("mouseleave.lhpMIV", {
                _this: n
            }, n.stopDraggingHandler)
        }
        n.dragging(m);
        m.preventDefault()
    };
    c.prototype.mouseupHandler = function (m) {
        var n = m.data._this;
        n.$mapHol.unbind("touchmove.lhpMIV", n.mousemoveHandler);
        n.$mapHol.unbind("mousemove.lhpMIV", n.mousemoveHandler);
        n.$mainHolder.unbind("mivChange.lhpMIV", n.mivChangeHandler).bind("mivChange.lhpMIV", {
            _this: n
        }, n.mivChangeHandler);
        if (!n.isTouchDev) {
            n.$vr.removeClass("lhp_cursor_drag").addClass("lhp_cursor_hand");
            n.$vr.unbind("mouseenter.lhpMIV", n.mouseenterHandler).bind("mouseenter.lhpMIV", {
                _this: n
            }, n.mouseenterHandler)
        }
        n.$vr.removeClass("lhp_miv_map_vr_over")
    };
    c.prototype.mouseclickHandler = function (p) {
        var r = p.data._this,
            n = a(p)[0],
            o = r.$mapHol.offset(),
            m = (n.x - o.left) * r.sett.mainImgWidth / r.$mapWrappHol.width(),
            q = (n.y - o.top) * r.sett.mainImgHeight / r.$mapWrappHol.height();
        r.$mainHolder.lhpMegaImgViewer("setPosition", m, q)
    };
    c.prototype.dragging = function (s) {
        var n = a(s)[0],
            o = n.x - this.lastMousePageCoor.x,
            m = n.y - this.lastMousePageCoor.y,
            t = this.$vr.position(),
            r = t.left + o,
            p = t.top + m,
            q = this.getSafeTarget(r, p, o, m);
        this.$vr.css({
            left: q.x,
            top: q.y
        });
        this.lastMousePageCoor = n;
        this.mainHolderSetPosition(q.x, q.y)
    };
    c.prototype.stopDraggingHandler = function (m) {
        var n = m.data._this;
        n.$mapHol.unbind({
            "touchend.lhpMIV": n.stopDraggingHandler
        });
        n.$mapHol.unbind({
            "mouseup.lhpMIV": n.stopDraggingHandler
        });
        n.$mapHol.unbind({
            "mouseleave.lhpMIV": n.stopDraggingHandler
        })
    };
    c.prototype.getSafeTarget = function (r, q, o, n) {
        var p = 0,
            m = 0,
            t = this.$mapWrappHol.width() - this.$vr.width(),
            s = this.$mapWrappHol.height() - this.$vr.height();
        if ((n < 0) && (q < m)) {
            q = m
        } else {
            if ((n > 0) && (q > s)) {
                q = s
            }
        } if ((o < 0) && (r < p)) {
            r = p
        } else {
            if ((o > 0) && (r > t)) {
                r = t
            }
        }
        return {
            x: r,
            y: q
        }
    };
    c.prototype.mainHolderSetPosition = function (o, n) {
        var m = (o + this.$vr.width() / 2) * this.sett.mainImgWidth / this.$mapWrappHol.width(),
            p = (n + this.$vr.height() / 2) * this.sett.mainImgHeight / this.$mapWrappHol.height();
        this.$mainHolder.lhpMegaImgViewer("setPosition", m, p, null, true)
    };
    c.prototype.mivChangeHandler = function (r) {
        var t = r.data._this,
            n = t.$mapWrappHol.width(),
            q = t.$mapWrappHol.height(),
            s = Math.round(n * ((r.wPropViewpContent > 1) ? 1 : r.wPropViewpContent)),
            m = Math.round(q * ((r.hPropViewpContent > 1) ? 1 : r.hPropViewpContent)),
            p = Math.round((n / t.sett.mainImgWidth) * r.xPosInCenter - (s / 2)),
            o = Math.round((q / t.sett.mainImgHeight) * r.yPosInCenter - (m / 2));
        t.$vr.css({
            width: s,
            height: m,
            left: p,
            top: o
        })
    };
    var b = function (r, q, m, o, p, n) {
        this.$mainHolder = r;
        this.$contentHol = q;
        this.containerId = m;
        this.mClass = "lhp_miv_hotspot";
        this.mInnClass = "lhp_miv_marker";
        this.pClass = "lhp_miv_popup";
        this.isTouchDev = o;
        this.markers = [];
        this.popups = [];
        this.currShowPopup = null;
        this.popupShowAction = p;
        this.startScale = n
    };
    b.prototype.ini = function () {
        var n = this,
            m;
        g("#" + this.containerId).find("." + this.mClass).each(function () {
            n.addMarker(g(this).clone(true, true))
        });
        this.$mainHolder.bind("mivChange.lhpMIV", {
            _this: this
        }, this.mivChangeHandler);
        if (this.startScale == 1) {
            this.positionsMarkers(1)
        }
    };
    b.prototype.destroy = function () {
        var m;
        for (m in this.markers) {
            this.markers[m].destroy()
        }
        for (m in this.popups) {
            this.popups[m].destroy()
        }
        this.$mainHolder = null;
        this.$contentHol = null;
        this.markers = null;
        this.popups = null
    };
    b.prototype.addMarker = function (u) {
        var q = 0,
            v = 0,
            t = 0,
            s = 0,
            m, r, n, o;
        if (u.attr("data-id")) {
            q = u.attr("data-id")
        }
        if (u.attr("data-x")) {
            v = parseInt(u.attr("data-x"))
        }
        if (u.attr("data-y")) {
            t = parseInt(u.attr("data-y"))
        }
        if (u.attr("data-visible-scale")) {
            s = parseFloat(u.attr("data-visible-scale"))
        }
        if (u.attr("data-url")) {
            m = u.attr("data-url")
        }
        o = u.find("." + this.pClass).remove()[0];
        this.$contentHol.append(u);
        r = new j(this, q, v, t, s, m, u);
        this.markers.push(r);
        if (o) {
            this.$contentHol.append(o);
            n = new k(q, g(o), r);
            n.ini();
            this.popups.push(n);
            r.popup = n
        }
        r.ini()
    };
    b.prototype.mivChangeHandler = function (m) {
        var n = m.data._this;
        if (m.isScaled) {
            n.positionsMarkers(m.scale);
            n.positionsPopup()
        } else {
            n.positionsPopup()
        }
    };
    b.prototype.positionsMarkers = function (o) {
        var n, m;
        for (n in this.markers) {
            m = this.markers[n];
            if (m.positions) {
                m.positions(o)
            }
            if (m.visibility) {
                m.visibility(o)
            }
        }
    };
    b.prototype.positionsPopup = function () {
        if (this.currShowPopup) {
            this.currShowPopup.positions()
        }
    };
    b.prototype.getLimit = function () {
        var q = this.$contentHol.position(),
            n = -q.left,
            p = n + this.$mainHolder.width(),
            m = -q.top,
            o = m + this.$mainHolder.height();
        return {
            xMin: n,
            xMax: p,
            yMin: m,
            yMax: o
        }
    };
    b.prototype.showPopup = function (m) {
        if (!this.currShowPopup) {
            this.currShowPopup = m;
            this.currShowPopup.show();
            this.currShowPopup.positions();
            return
        }
        if (this.currShowPopup && this.currShowPopup != m) {
            this.hidePopup(this.currShowPopup);
            this.currShowPopup = m;
            this.currShowPopup.show();
            this.currShowPopup.positions()
        }
    };
    b.prototype.hidePopup = function (m) {
        if (this.currShowPopup && this.currShowPopup == m) {
            this.currShowPopup.hide();
            this.currShowPopup = null
        }
    };
    var j = function (q, s, m, r, p, n, o) {
        this.markers = q;
        this.id = s;
        this.x = m;
        this.y = r;
        this.visibleScale = p;
        this.url = n;
        this.$m = o;
        this.visible = false;
        this.popup = null;
        this.popupClose = null
    };
    j.prototype.ini = function () {
        this.style();
        this.positions(1);
        if (this.url) {
            this.addInteractivityUrl()
        }
        if (this.popup) {
            this.popupClose = this.popup.addClose();
            this.addPopupAction()
        } else {
            if (this.markers.popupShowAction == "rollover") {
                this.addPopupActionNull()
            }
        }
    };
    j.prototype.destroy = function () {
        this.getInn().unbind(".lhpMIV");
        if (this.popup) {
            this.popupClose.unbind(".lhpMIV");
            this.popupClose = null;
            this.popup = null
        }
        this.$m = null;
        this.markers = null
    };
    j.prototype.getInn = function () {
        return this.$m.find("." + this.markers.mInnClass)
    };
    j.prototype.getSize = function () {
        return {
            w: this.getInn().width(),
            h: this.getInn().height()
        }
    };
    j.prototype.getEdges = function () {
        return this.findEdges()
    };
    j.prototype.findEdges = function () {
        var q = this.getInn().offset(),
            n = this.markers.$mainHolder.offset(),
            u = this.markers.$contentHol.position(),
            x = u.left,
            p = u.top,
            v = this.getSize(),
            o = q.left - x - n.left,
            m = o + v.w,
            w = q.top - p - n.top,
            s = w + v.h;
        return ({
            L: o,
            R: m,
            T: w,
            B: s
        })
    };
    j.prototype.getLimit = function () {
        return this.markers.getLimit()
    };
    j.prototype.style = function () {
        var m = {
            position: "absolute",
            "z-index": "2",
            display: "none"
        };
        this.$m.css(m);
        this.$m.css("height", this.$m.height())
    };
    j.prototype.positions = function (n) {
        var m = Math.round(this.x * n),
            o = Math.round(this.y * n);
        this.$m.css({
            left: m,
            top: o
        })
    };
    j.prototype.visibility = function (m) {
        if (m >= this.visibleScale) {
            if (!this.visible) {
                this.$m.stop(true, true).fadeIn(300)
            }
            this.visible = true
        } else {
            if (this.visible) {
                this.$m.fadeOut(300)
            }
            this.visible = false;
            this.markers.hidePopup(this.popup)
        }
    };
    j.prototype.addInteractivityUrl = function () {
        this.getInn().css("cursor", "pointer");
        this.getInn().bind(((this.markers.isTouchDev) ? "touchend.lhpMIV" : "mousedown.lhpMIV"), {
            _this: this
        }, this.clickHandlerUrl)
    };
    j.prototype.clickHandlerUrl = function (m) {
        var n = m.data._this;
        if (n.url) {
            window.location = n.url
        }
        m.stopPropagation()
    };
    j.prototype.addPopupAction = function () {
        if (this.markers.popupShowAction == "click") {
            this.getInn().bind(((this.markers.isTouchDev) ? "touchend.lhpMIV" : "mousedown.lhpMIV"), {
                _this: this
            }, this.showPopup);
            this.getInn().css("cursor", "pointer")
        } else {
            this.getInn().bind(((this.markers.isTouchDev) ? "touchend.lhpMIV" : "mouseenter.lhpMIV"), {
                _this: this
            }, this.showPopup)
        }
        this.popupClose.bind(((this.markers.isTouchDev) ? "touchend.lhpMIV" : "mousedown.lhpMIV"), {
            _this: this
        }, this.hidePopup)
    };
    j.prototype.addPopupActionNull = function () {
        this.getInn().bind(((this.markers.isTouchDev) ? "touchend.lhpMIV" : "mouseenter.lhpMIV"), {
            _this: this
        }, this.showPopup)
    };
    j.prototype.showPopup = function (m) {
        var n = m.data._this;
        n.markers.showPopup(n.popup);
        m.preventDefault();
        m.stopPropagation();
        return false
    };
    j.prototype.hidePopup = function (m) {
        var n = m.data._this;
        n.markers.hidePopup(n.popup);
        m.preventDefault();
        m.stopPropagation();
        return false
    };
    var k = function (o, n, m) {
        this.id = o;
        this.$p = n;
        this.marker = m;
        this.posHor = this.posHC;
        this.posVer = this.posVT;
        this.$closeHolder = null
    };
    k.prototype.ini = function () {
        if (this.$p.hasClass("pos-TL")) {
            this.posHor = this.posHL;
            this.posVer = this.posVT
        } else {
            if (this.$p.hasClass("pos-T")) {
                this.posHor = this.posHC;
                this.posVer = this.posVT
            } else {
                if (this.$p.hasClass("pos-TR")) {
                    this.posHor = this.posHR;
                    this.posVer = this.posVT
                } else {
                    if (this.$p.hasClass("pos-L")) {
                        this.posHor = this.posHL;
                        this.posVer = this.posVC
                    } else {
                        if (this.$p.hasClass("pos-R")) {
                            this.posHor = this.posHR;
                            this.posVer = this.posVC
                        } else {
                            if (this.$p.hasClass("pos-BL")) {
                                this.posHor = this.posHL;
                                this.posVer = this.posVB
                            } else {
                                if (this.$p.hasClass("pos-B")) {
                                    this.posHor = this.posHC;
                                    this.posVer = this.posVB
                                } else {
                                    if (this.$p.hasClass("pos-BR")) {
                                        this.posHor = this.posHR;
                                        this.posVer = this.posVB
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        this.$p.bind("mousewheel.lhpGIV", function (m) {
            m.stopPropagation();
            return false
        });
        this.style();
        this.positions(1)
    };
    k.prototype.destroy = function () {
        this.$p = null;
        this.marker = null
    };
    k.prototype.style = function () {
        var m = {
            display: "none",
            position: "absolute",
            "z-index": "3"
        };
        this.$p.css(m);
        this.$p.css("height", this.$p.height())
    };
    k.prototype.addClose = function () {
        this.$closeHolder = g('<div class="lhp_miv_popup_close"></div>');
        this.$closeHolder.hover(function () {
            g(this).css("opacity", 0.7)
        }, function () {
            g(this).css("opacity", 1)
        });
        this.$p.append(this.$closeHolder);
        return this.$closeHolder
    };
    k.prototype.getSize = function () {
        return {
            w: this.$p.width(),
            h: this.$p.height()
        }
    };
    k.prototype.positions = function () {
        var n = this.marker.getEdges(),
            m = this.posHor(n),
            r = this.posVer(n),
            p = this.marker.getLimit(),
            o = this.$p.width(),
            q = this.$p.height();
        if (m < p.xMin) {
            m = p.xMin
        } else {
            if (m + o > p.xMax) {
                m = p.xMax - o
            }
        } if (r < p.yMin) {
            r = p.yMin
        } else {
            if (r + q > p.yMax) {
                r = p.yMax - q
            }
        }
        this.$p.css({
            left: m,
            top: r
        })
    };
    k.prototype.posVT = function (m) {
        return Math.round(m.T) - this.$p.height()
    };
    k.prototype.posVC = function (m) {
        return Math.round(m.T + (m.B - m.T) / 2) - this.$p.height() / 2
    };
    k.prototype.posVB = function (m) {
        return Math.round(m.B)
    };
    k.prototype.posHL = function (m) {
        return Math.round(m.L) - this.$p.width()
    };
    k.prototype.posHC = function (m) {
        return Math.round(m.L + (m.R - m.L) / 2) - this.$p.width() / 2
    };
    k.prototype.posHR = function (m) {
        return Math.round(m.R)
    };
    k.prototype.show = function () {
        this.$p.fadeIn(300)
    };
    k.prototype.hide = function () {
        this.$p.stop().clearQueue().fadeOut(100)
    };

    function a(q) {
        var o, p = [],
            m = q.originalEvent,
            n = q.gesture;
        if (m && m.changedTouches) {
            for (o = 0; o < m.changedTouches.length; o++) {
                p.push({
                    x: m.changedTouches[o].pageX,
                    y: m.changedTouches[o].pageY
                })
            }
        } else {
            if (n && n.touches) {
                for (o = 0; o < n.touches.length; o++) {
                    p.push({
                        x: n.touches[o].pageX,
                        y: n.touches[o].pageY
                    })
                }
            } else {
                p.push({
                    x: q.pageX,
                    y: q.pageY
                })
            }
        }
        return p
    }
})(jQuery);