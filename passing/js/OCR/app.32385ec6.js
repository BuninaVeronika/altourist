parcelRequire = function (e, r, t, n) {
    var i, o = "function" == typeof parcelRequire && parcelRequire, u = "function" == typeof require && require;

    function f(t, n) {
        if (!r[t]) {
            if (!e[t]) {
                var i = "function" == typeof parcelRequire && parcelRequire;
                if (!n && i) return i(t, !0);
                if (o) return o(t, !0);
                if (u && "string" == typeof t) return u(t);
                var c = new Error("Cannot find module '" + t + "'");
                throw c.code = "MODULE_NOT_FOUND", c
            }
            p.resolve = function (r) {
                return e[t][1][r] || r
            }, p.cache = {};
            var l = r[t] = new f.Module(t);
            e[t][0].call(l.exports, p, l, l.exports, this)
        }
        return r[t].exports;

        function p(e) {
            return f(p.resolve(e))
        }
    }

    f.isParcelRequire = !0, f.Module = function (e) {
        this.id = e, this.bundle = f, this.exports = {}
    }, f.modules = e, f.cache = r, f.parent = o, f.register = function (r, t) {
        e[r] = [function (e, r) {
            r.exports = t
        }, {}]
    };
    for (var c = 0; c < t.length; c++) try {
        f(t[c])
    } catch (e) {
        i || (i = e)
    }
    if (t.length) {
        var l = f(t[t.length - 1]);
        "object" == typeof exports && "undefined" != typeof module ? module.exports = l : "function" == typeof define && define.amd ? define(function () {
            return l
        }) : n && (this[n] = l)
    }
    if (parcelRequire = f, i) throw i;
    return f
}({
    "QVnC": [function (require, module, exports) {
        var t = function (t) {
            "use strict";
            var r, e = Object.prototype, n = e.hasOwnProperty, o = "function" == typeof Symbol ? Symbol : {},
                i = o.iterator || "@@iterator", a = o.asyncIterator || "@@asyncIterator",
                c = o.toStringTag || "@@toStringTag";

            function u(t, r, e, n) {
                var o = r && r.prototype instanceof v ? r : v, i = Object.create(o.prototype), a = new k(n || []);
                return i._invoke = function (t, r, e) {
                    var n = f;
                    return function (o, i) {
                        if (n === l) throw new Error("Generator is already running");
                        if (n === p) {
                            if ("throw" === o) throw i;
                            return N()
                        }
                        for (e.method = o, e.arg = i; ;) {
                            var a = e.delegate;
                            if (a) {
                                var c = _(a, e);
                                if (c) {
                                    if (c === y) continue;
                                    return c
                                }
                            }
                            if ("next" === e.method) e.sent = e._sent = e.arg; else if ("throw" === e.method) {
                                if (n === f) throw n = p, e.arg;
                                e.dispatchException(e.arg)
                            } else "return" === e.method && e.abrupt("return", e.arg);
                            n = l;
                            var u = h(t, r, e);
                            if ("normal" === u.type) {
                                if (n = e.done ? p : s, u.arg === y) continue;
                                return {value: u.arg, done: e.done}
                            }
                            "throw" === u.type && (n = p, e.method = "throw", e.arg = u.arg)
                        }
                    }
                }(t, e, a), i
            }

            function h(t, r, e) {
                try {
                    return {type: "normal", arg: t.call(r, e)}
                } catch (n) {
                    return {type: "throw", arg: n}
                }
            }

            t.wrap = u;
            var f = "suspendedStart", s = "suspendedYield", l = "executing", p = "completed", y = {};

            function v() {
            }

            function d() {
            }

            function g() {
            }

            var m = {};
            m[i] = function () {
                return this
            };
            var w = Object.getPrototypeOf, L = w && w(w(G([])));
            L && L !== e && n.call(L, i) && (m = L);
            var x = g.prototype = v.prototype = Object.create(m);

            function E(t) {
                ["next", "throw", "return"].forEach(function (r) {
                    t[r] = function (t) {
                        return this._invoke(r, t)
                    }
                })
            }

            function b(t, r) {
                var e;
                this._invoke = function (o, i) {
                    function a() {
                        return new r(function (e, a) {
                            !function e(o, i, a, c) {
                                var u = h(t[o], t, i);
                                if ("throw" !== u.type) {
                                    var f = u.arg, s = f.value;
                                    return s && "object" == typeof s && n.call(s, "__await") ? r.resolve(s.__await).then(function (t) {
                                        e("next", t, a, c)
                                    }, function (t) {
                                        e("throw", t, a, c)
                                    }) : r.resolve(s).then(function (t) {
                                        f.value = t, a(f)
                                    }, function (t) {
                                        return e("throw", t, a, c)
                                    })
                                }
                                c(u.arg)
                            }(o, i, e, a)
                        })
                    }

                    return e = e ? e.then(a, a) : a()
                }
            }

            function _(t, e) {
                var n = t.iterator[e.method];
                if (n === r) {
                    if (e.delegate = null, "throw" === e.method) {
                        if (t.iterator.return && (e.method = "return", e.arg = r, _(t, e), "throw" === e.method)) return y;
                        e.method = "throw", e.arg = new TypeError("The iterator does not provide a 'throw' method")
                    }
                    return y
                }
                var o = h(n, t.iterator, e.arg);
                if ("throw" === o.type) return e.method = "throw", e.arg = o.arg, e.delegate = null, y;
                var i = o.arg;
                return i ? i.done ? (e[t.resultName] = i.value, e.next = t.nextLoc, "return" !== e.method && (e.method = "next", e.arg = r), e.delegate = null, y) : i : (e.method = "throw", e.arg = new TypeError("iterator result is not an object"), e.delegate = null, y)
            }

            function j(t) {
                var r = {tryLoc: t[0]};
                1 in t && (r.catchLoc = t[1]), 2 in t && (r.finallyLoc = t[2], r.afterLoc = t[3]), this.tryEntries.push(r)
            }

            function O(t) {
                var r = t.completion || {};
                r.type = "normal", delete r.arg, t.completion = r
            }

            function k(t) {
                this.tryEntries = [{tryLoc: "root"}], t.forEach(j, this), this.reset(!0)
            }

            function G(t) {
                if (t) {
                    var e = t[i];
                    if (e) return e.call(t);
                    if ("function" == typeof t.next) return t;
                    if (!isNaN(t.length)) {
                        var o = -1, a = function e() {
                            for (; ++o < t.length;) if (n.call(t, o)) return e.value = t[o], e.done = !1, e;
                            return e.value = r, e.done = !0, e
                        };
                        return a.next = a
                    }
                }
                return {next: N}
            }

            function N() {
                return {value: r, done: !0}
            }

            return d.prototype = x.constructor = g, g.constructor = d, g[c] = d.displayName = "GeneratorFunction", t.isGeneratorFunction = function (t) {
                var r = "function" == typeof t && t.constructor;
                return !!r && (r === d || "GeneratorFunction" === (r.displayName || r.name))
            }, t.mark = function (t) {
                return Object.setPrototypeOf ? Object.setPrototypeOf(t, g) : (t.__proto__ = g, c in t || (t[c] = "GeneratorFunction")), t.prototype = Object.create(x), t
            }, t.awrap = function (t) {
                return {__await: t}
            }, E(b.prototype), b.prototype[a] = function () {
                return this
            }, t.AsyncIterator = b, t.async = function (r, e, n, o, i) {
                void 0 === i && (i = Promise);
                var a = new b(u(r, e, n, o), i);
                return t.isGeneratorFunction(e) ? a : a.next().then(function (t) {
                    return t.done ? t.value : a.next()
                })
            }, E(x), x[c] = "Generator", x[i] = function () {
                return this
            }, x.toString = function () {
                return "[object Generator]"
            }, t.keys = function (t) {
                var r = [];
                for (var e in t) r.push(e);
                return r.reverse(), function e() {
                    for (; r.length;) {
                        var n = r.pop();
                        if (n in t) return e.value = n, e.done = !1, e
                    }
                    return e.done = !0, e
                }
            }, t.values = G, k.prototype = {
                constructor: k, reset: function (t) {
                    if (this.prev = 0, this.next = 0, this.sent = this._sent = r, this.done = !1, this.delegate = null, this.method = "next", this.arg = r, this.tryEntries.forEach(O), !t) for (var e in this) "t" === e.charAt(0) && n.call(this, e) && !isNaN(+e.slice(1)) && (this[e] = r)
                }, stop: function () {
                    this.done = !0;
                    var t = this.tryEntries[0].completion;
                    if ("throw" === t.type) throw t.arg;
                    return this.rval
                }, dispatchException: function (t) {
                    if (this.done) throw t;
                    var e = this;

                    function o(n, o) {
                        return c.type = "throw", c.arg = t, e.next = n, o && (e.method = "next", e.arg = r), !!o
                    }

                    for (var i = this.tryEntries.length - 1; i >= 0; --i) {
                        var a = this.tryEntries[i], c = a.completion;
                        if ("root" === a.tryLoc) return o("end");
                        if (a.tryLoc <= this.prev) {
                            var u = n.call(a, "catchLoc"), h = n.call(a, "finallyLoc");
                            if (u && h) {
                                if (this.prev < a.catchLoc) return o(a.catchLoc, !0);
                                if (this.prev < a.finallyLoc) return o(a.finallyLoc)
                            } else if (u) {
                                if (this.prev < a.catchLoc) return o(a.catchLoc, !0)
                            } else {
                                if (!h) throw new Error("try statement without catch or finally");
                                if (this.prev < a.finallyLoc) return o(a.finallyLoc)
                            }
                        }
                    }
                }, abrupt: function (t, r) {
                    for (var e = this.tryEntries.length - 1; e >= 0; --e) {
                        var o = this.tryEntries[e];
                        if (o.tryLoc <= this.prev && n.call(o, "finallyLoc") && this.prev < o.finallyLoc) {
                            var i = o;
                            break
                        }
                    }
                    i && ("break" === t || "continue" === t) && i.tryLoc <= r && r <= i.finallyLoc && (i = null);
                    var a = i ? i.completion : {};
                    return a.type = t, a.arg = r, i ? (this.method = "next", this.next = i.finallyLoc, y) : this.complete(a)
                }, complete: function (t, r) {
                    if ("throw" === t.type) throw t.arg;
                    return "break" === t.type || "continue" === t.type ? this.next = t.arg : "return" === t.type ? (this.rval = this.arg = t.arg, this.method = "return", this.next = "end") : "normal" === t.type && r && (this.next = r), y
                }, finish: function (t) {
                    for (var r = this.tryEntries.length - 1; r >= 0; --r) {
                        var e = this.tryEntries[r];
                        if (e.finallyLoc === t) return this.complete(e.completion, e.afterLoc), O(e), y
                    }
                }, catch: function (t) {
                    for (var r = this.tryEntries.length - 1; r >= 0; --r) {
                        var e = this.tryEntries[r];
                        if (e.tryLoc === t) {
                            var n = e.completion;
                            if ("throw" === n.type) {
                                var o = n.arg;
                                O(e)
                            }
                            return o
                        }
                    }
                    throw new Error("illegal catch attempt")
                }, delegateYield: function (t, e, n) {
                    return this.delegate = {
                        iterator: G(t),
                        resultName: e,
                        nextLoc: n
                    }, "next" === this.method && (this.arg = r), y
                }
            }, t
        }("object" == typeof module ? module.exports : {});
        try {
            regeneratorRuntime = t
        } catch (r) {
            Function("r", "regeneratorRuntime = r")(t)
        }
    }, {}],
    "XvCm": [function (require, module, exports) {
        module.exports = ((o, t) => `${o}-${t}-${Math.random().toString(16).slice(3, 8)}`);
    }, {}],
    "uXW0": [function (require, module, exports) {
        const o = require("./utils/getId");
        let t = 0;
        module.exports = (({id: e, action: d, payload: i = {}}) => {
            let a = e;
            return void 0 === a && (a = o("Job", t), t += 1), {id: a, action: d, payload: i}
        });
    }, {"./utils/getId": "XvCm"}],
    "i6s0": [function (require, module, exports) {
        let o = !1;
        exports.logging = o, exports.setLogging = (g => {
            o = g
        }), exports.log = ((...g) => o ? console.log.apply(this, g) : null);
    }, {}],
    "eMFN": [function (require, module, exports) {
        const e = require("./createJob"), {log: t} = require("./utils/log"), r = require("./utils/getId");
        let o = 0;
        module.exports = (() => {
            const i = r("Scheduler", o), n = {}, a = {};
            let d = [];
            o += 1;
            const s = () => Object.keys(n).length, l = () => {
                if (0 !== d.length) {
                    const e = Object.keys(n);
                    for (let t = 0; t < e.length; t += 1) if (void 0 === a[e[t]]) {
                        d[0](n[e[t]]);
                        break
                    }
                }
            }, u = (r, o) => new Promise((n, s) => {
                const u = e({action: r, payload: o});
                d.push(async e => {
                    d.shift(), a[e.id] = u;
                    try {
                        n(await e[r].apply(this, [...o, u.id]))
                    } catch (t) {
                        s(t)
                    } finally {
                        delete a[e.id], l()
                    }
                }), t(`[${i}]: Add ${u.id} to JobQueue`), t(`[${i}]: JobQueue length=${d.length}`), l()
            });
            return {
                addWorker: e => (n[e.id] = e, t(`[${i}]: Add ${e.id}`), t(`[${i}]: Number of workers=${s()}`), l(), e.id),
                addJob: async (e, ...t) => {
                    if (0 === s()) throw Error(`[${i}]: You need to have at least one worker before adding jobs`);
                    return u(e, t)
                },
                terminate: async () => {
                    Object.keys(n).forEach(async e => {
                        await n[e].terminate()
                    }), d = []
                },
                getQueueLen: () => d.length,
                getNumWorkers: s
            }
        });
    }, {"./createJob": "uXW0", "./utils/log": "i6s0", "./utils/getId": "XvCm"}],
    "W2yU": [function (require, module, exports) {
        module.exports = (o => {
            const e = {type: "undefined" != typeof window && void 0 !== window.document ? "browser" : "node"};
            return void 0 === o ? e : e[o]
        });
    }, {}],
    "A2Q1": [function (require, module, exports) {
        var define;
        var e;
        !function (r, t) {
            "function" == typeof e && e.amd ? e(t) : "object" == typeof exports ? module.exports = t() : r.resolveUrl = t()
        }(this, function () {
            return function () {
                var e = arguments.length;
                if (0 === e) throw new Error("resolveUrl requires at least one argument; got none.");
                var r = document.createElement("base");
                if (r.href = arguments[0], 1 === e) return r.href;
                var t = document.getElementsByTagName("head")[0];
                t.insertBefore(r, t.firstChild);
                for (var n, o = document.createElement("a"), a = 1; a < e; a++) o.href = arguments[a], n = o.href, r.href = n;
                return t.removeChild(r), n
            }
        });
    }, {}],
    "EDO9": [function (require, module, exports) {
        const r = "browser" === require("./getEnvironment")("type"), e = r ? require("resolve-url") : r => r;
        module.exports = (r => {
            const o = {...r};
            return ["corePath", "workerPath", "langPath"].forEach(t => {
                void 0 !== r[t] && (o[t] = e(o[t]))
            }), o
        });
    }, {"./getEnvironment": "W2yU", "resolve-url": "A2Q1"}],
    "RXnt": [function (require, module, exports) {
        module.exports = (a => {
            const p = [], r = [], o = [], s = [], h = [];
            return a.blocks.forEach(l => {
                l.paragraphs.forEach(p => {
                    p.lines.forEach(r => {
                        r.words.forEach(o => {
                            o.symbols.forEach(s => {
                                h.push({...s, page: a, block: l, paragraph: p, line: r, word: o})
                            }), s.push({...o, page: a, block: l, paragraph: p, line: r})
                        }), o.push({...r, page: a, block: l, paragraph: p})
                    }), r.push({...p, page: a, block: l})
                }), p.push({...l, page: a})
            }), {...a, blocks: p, paragraphs: r, lines: o, words: s, symbols: h}
        });
    }, {}],
    "XDIt": [function (require, module, exports) {
        module.exports = {TESSERACT_ONLY: 0, LSTM_ONLY: 1, TESSERACT_LSTM_COMBINED: 2, DEFAULT: 3};
    }, {}],
    "KTE2": [function (require, module, exports) {
        const e = require("./OEM");
        module.exports = {defaultOEM: e.DEFAULT};
    }, {"./OEM": "XDIt"}],
    "CQBu": [function (require, module, exports) {
        module.exports = {
            _args: [["tesseract.js@2.0.0-beta.2", "C:\\Users\\catinweb\\Documents\\XXX\\tesseract"]],
            _from: "tesseract.js@2.0.0-beta.2",
            _id: "tesseract.js@2.0.0-beta.2",
            _inBundle: !1,
            _integrity: "sha512-vbBqWOzr2UNrac8vhtwvsMABumwhLw8ILdWRp0XqcwVYrc8Ay6IDG9/riq16XQF0uETwcbuACSv3JEj2bYfDhA==",
            _location: "/tesseract.js",
            _phantomChildren: {},
            _requested: {
                type: "version",
                registry: !0,
                raw: "tesseract.js@2.0.0-beta.2",
                name: "tesseract.js",
                escapedName: "tesseract.js",
                rawSpec: "2.0.0-beta.2",
                saveSpec: null,
                fetchSpec: "2.0.0-beta.2"
            },
            _requiredBy: ["/"],
            _resolved: "https://registry.npmjs.org/tesseract.js/-/tesseract.js-2.0.0-beta.2.tgz",
            _spec: "2.0.0-beta.2",
            _where: "C:\\Users\\catinweb\\Documents\\XXX\\tesseract",
            author: "",
            browser: {"./src/worker/node/index.js": "./src/worker/browser/index.js"},
            bugs: {url: "https://github.com/naptha/tesseract.js/issues"},
            collective: {type: "opencollective", url: "https://opencollective.com/tesseractjs"},
            contributors: [{name: "jeromewu"}],
            dependencies: {
                axios: "^0.18.0",
                "bmp-js": "^0.1.0",
                "file-type": "^12.3.0",
                "idb-keyval": "^3.2.0",
                "is-url": "1.2.2",
                "opencollective-postinstall": "^2.0.2",
                "regenerator-runtime": "^0.13.3",
                "resolve-url": "^0.2.1",
                "tesseract.js-core": "^2.0.0-beta.13",
                zlibjs: "^0.3.1"
            },
            description: "Pure Javascript Multilingual OCR",
            devDependencies: {
                "@babel/core": "^7.4.5",
                "@babel/preset-env": "^7.4.5",
                acorn: "^6.1.1",
                "babel-loader": "^8.0.6",
                cors: "^2.8.5",
                eslint: "^5.9.0",
                "eslint-config-airbnb": "^17.1.0",
                "eslint-plugin-import": "^2.14.0",
                "eslint-plugin-jsx-a11y": "^6.1.2",
                "eslint-plugin-react": "^7.11.1",
                "expect.js": "^0.3.1",
                express: "^4.16.4",
                mocha: "^5.2.0",
                "mocha-headless-chrome": "^2.0.2",
                "npm-run-all": "^4.1.5",
                nyc: "^13.1.0",
                rimraf: "^2.6.3",
                "wait-on": "^3.2.0",
                webpack: "^4.26.0",
                "webpack-cli": "^3.1.2",
                "webpack-dev-middleware": "^3.4.0"
            },
            homepage: "https://github.com/naptha/tesseract.js",
            jsdelivr: "dist/tesseract.min.js",
            license: "Apache-2.0",
            main: "src/index.js",
            name: "tesseract.js",
            repository: {type: "git", url: "git+https://github.com/naptha/tesseract.js.git"},
            scripts: {
                build: "rimraf dist && webpack --config scripts/webpack.config.prod.js",
                lint: "eslint src",
                postinstall: "opencollective-postinstall || true",
                prepublishOnly: "npm run build",
                start: "node scripts/server.js",
                test: "npm-run-all -p -r start test:all",
                "test:all": "npm-run-all wait test:browser:* test:node:all",
                "test:browser-tpl": "mocha-headless-chrome -a incognito -a no-sandbox -a disable-setuid-sandbox -a disable-logging -t 300000",
                "test:browser:detect": "npm run test:browser-tpl -- -f ./tests/detect.test.html",
                "test:browser:recognize": "npm run test:browser-tpl -- -f ./tests/recognize.test.html",
                "test:browser:scheduler": "npm run test:browser-tpl -- -f ./tests/scheduler.test.html",
                "test:node": "nyc mocha --exit --bail --require ./scripts/test-helper.js",
                "test:node:all": "npm run test:node -- ./tests/*.test.js",
                wait: "rimraf dist && wait-on http://localhost:3000/dist/tesseract.dev.js"
            },
            types: "src/index.d.ts",
            unpkg: "dist/tesseract.min.js",
            version: "2.0.0-beta.2"
        };
    }, {}],
    "SCmm": [function (require, module, exports) {
        module.exports = {
            langPath: "https://tessdata.projectnaptha.com/4.0.0", workerBlobURL: !0, logger: () => {
            }
        };
    }, {}],
    "pBGv": [function (require, module, exports) {

        var t, e, n = module.exports = {};

        function r() {
            throw new Error("setTimeout has not been defined")
        }

        function o() {
            throw new Error("clearTimeout has not been defined")
        }

        function i(e) {
            if (t === setTimeout) return setTimeout(e, 0);
            if ((t === r || !t) && setTimeout) return t = setTimeout, setTimeout(e, 0);
            try {
                return t(e, 0)
            } catch (n) {
                try {
                    return t.call(null, e, 0)
                } catch (n) {
                    return t.call(this, e, 0)
                }
            }
        }

        function u(t) {
            if (e === clearTimeout) return clearTimeout(t);
            if ((e === o || !e) && clearTimeout) return e = clearTimeout, clearTimeout(t);
            try {
                return e(t)
            } catch (n) {
                try {
                    return e.call(null, t)
                } catch (n) {
                    return e.call(this, t)
                }
            }
        }

        !function () {
            try {
                t = "function" == typeof setTimeout ? setTimeout : r
            } catch (n) {
                t = r
            }
            try {
                e = "function" == typeof clearTimeout ? clearTimeout : o
            } catch (n) {
                e = o
            }
        }();
        var c, s = [], l = !1, a = -1;

        function f() {
            l && c && (l = !1, c.length ? s = c.concat(s) : a = -1, s.length && h())
        }

        function h() {
            if (!l) {
                var t = i(f);
                l = !0;
                for (var e = s.length; e;) {
                    for (c = s, s = []; ++a < e;) c && c[a].run();
                    a = -1, e = s.length
                }
                c = null, l = !1, u(t)
            }
        }

        function m(t, e) {
            this.fun = t, this.array = e
        }

        function p() {
        }

        n.nextTick = function (t) {
            var e = new Array(arguments.length - 1);
            if (arguments.length > 1) for (var n = 1; n < arguments.length; n++) e[n - 1] = arguments[n];
            s.push(new m(t, e)), 1 !== s.length || l || i(h)
        }, m.prototype.run = function () {
            this.fun.apply(null, this.array)
        }, n.title = "browser", n.env = {}, n.argv = [], n.version = "", n.versions = {}, n.on = p, n.addListener = p, n.once = p, n.off = p, n.removeListener = p, n.removeAllListeners = p, n.emit = p, n.prependListener = p, n.prependOnceListener = p, n.listeners = function (t) {
            return []
        }, n.binding = function (t) {
            throw new Error("process.binding is not supported")
        }, n.cwd = function () {
            return "/"
        }, n.chdir = function (t) {
            throw new Error("process.chdir is not supported")
        }, n.umask = function () {
            return 0
        };
    }, {}],
    "I5Ld": [function (require, module, exports) {
        var process = require("process");
        var e = require("process");
        const s = require("resolve-url"), {version: r, dependencies: t} = require("../../../package.json"),
            o = require("../../constants/defaultOptions");
        module.exports = {
            ...o,
            workerPath: `https://unpkg.com/tesseract.js@v${r}/dist/worker.min.js`,
            corePath: `https://unpkg.com/tesseract.js-core@v${t["tesseract.js-core"].substring(1)}/tesseract-core.${"object" == typeof WebAssembly ? "wasm" : "asm"}.js`
        };
    }, {
        "resolve-url": "A2Q1",
        "../../../package.json": "CQBu",
        "../../constants/defaultOptions": "SCmm",
        "process": "pBGv"
    }],
    "U2yn": [function (require, module, exports) {
        module.exports = (({workerPath: e, workerBlobURL: r}) => {
            let o;
            if (Blob && URL && r) {
                const r = new Blob([`importScripts("${e}");`], {type: "application/javascript"});
                o = new Worker(URL.createObjectURL(r))
            } else o = new Worker(e);
            return o
        });
    }, {}],
    "X0rf": [function (require, module, exports) {
        module.exports = (e => {
            e.terminate()
        });
    }, {}],
    "UyLp": [function (require, module, exports) {
        module.exports = ((e, a) => {
            e.onmessage = (({data: e}) => {
                a(e)
            })
        });
    }, {}],
    "NstZ": [function (require, module, exports) {
        module.exports = (async (s, e) => {
            s.postMessage(e)
        });
    }, {}],
    "EDTP": [function (require, module, exports) {
        "use strict";
        module.exports = function (r, n) {
            return function () {
                for (var t = new Array(arguments.length), e = 0; e < t.length; e++) t[e] = arguments[e];
                return r.apply(n, t)
            }
        };
    }, {}],
    "pOJS": [function (require, module, exports) {
        module.exports = function (o) {
            return null != o && null != o.constructor && "function" == typeof o.constructor.isBuffer && o.constructor.isBuffer(o)
        };
    }, {}],
    "S1cf": [function (require, module, exports) {
        "use strict";
        var e = require("./helpers/bind"), r = require("is-buffer"), n = Object.prototype.toString;

        function t(e) {
            return "[object Array]" === n.call(e)
        }

        function i(e) {
            return "[object ArrayBuffer]" === n.call(e)
        }

        function o(e) {
            return "undefined" != typeof FormData && e instanceof FormData
        }

        function f(e) {
            return "undefined" != typeof ArrayBuffer && ArrayBuffer.isView ? ArrayBuffer.isView(e) : e && e.buffer && e.buffer instanceof ArrayBuffer
        }

        function u(e) {
            return "string" == typeof e
        }

        function c(e) {
            return "number" == typeof e
        }

        function a(e) {
            return void 0 === e
        }

        function l(e) {
            return null !== e && "object" == typeof e
        }

        function s(e) {
            return "[object Date]" === n.call(e)
        }

        function p(e) {
            return "[object File]" === n.call(e)
        }

        function y(e) {
            return "[object Blob]" === n.call(e)
        }

        function d(e) {
            return "[object Function]" === n.call(e)
        }

        function b(e) {
            return l(e) && d(e.pipe)
        }

        function j(e) {
            return "undefined" != typeof URLSearchParams && e instanceof URLSearchParams
        }

        function m(e) {
            return e.replace(/^\s*/, "").replace(/\s*$/, "")
        }

        function B() {
            return ("undefined" == typeof navigator || "ReactNative" !== navigator.product) && ("undefined" != typeof window && "undefined" != typeof document)
        }

        function v(e, r) {
            if (null != e) if ("object" != typeof e && (e = [e]), t(e)) for (var n = 0, i = e.length; n < i; n++) r.call(null, e[n], n, e); else for (var o in e) Object.prototype.hasOwnProperty.call(e, o) && r.call(null, e[o], o, e)
        }

        function A() {
            var e = {};

            function r(r, n) {
                "object" == typeof e[n] && "object" == typeof r ? e[n] = A(e[n], r) : e[n] = r
            }

            for (var n = 0, t = arguments.length; n < t; n++) v(arguments[n], r);
            return e
        }

        function g(r, n, t) {
            return v(n, function (n, i) {
                r[i] = t && "function" == typeof n ? e(n, t) : n
            }), r
        }

        module.exports = {
            isArray: t,
            isArrayBuffer: i,
            isBuffer: r,
            isFormData: o,
            isArrayBufferView: f,
            isString: u,
            isNumber: c,
            isObject: l,
            isUndefined: a,
            isDate: s,
            isFile: p,
            isBlob: y,
            isFunction: d,
            isStream: b,
            isURLSearchParams: j,
            isStandardBrowserEnv: B,
            forEach: v,
            merge: A,
            extend: g,
            trim: m
        };
    }, {"./helpers/bind": "EDTP", "is-buffer": "pOJS"}],
    "M8l6": [function (require, module, exports) {
        "use strict";
        var e = require("../utils");
        module.exports = function (t, r) {
            e.forEach(t, function (e, o) {
                o !== r && o.toUpperCase() === r.toUpperCase() && (t[r] = e, delete t[o])
            })
        };
    }, {"../utils": "S1cf"}],
    "YdsM": [function (require, module, exports) {
        "use strict";
        module.exports = function (e, o, r, s, t) {
            return e.config = o, r && (e.code = r), e.request = s, e.response = t, e
        };
    }, {}],
    "bIiH": [function (require, module, exports) {
        "use strict";
        var r = require("./enhanceError");
        module.exports = function (e, n, o, t, u) {
            var a = new Error(e);
            return r(a, n, o, t, u)
        };
    }, {"./enhanceError": "YdsM"}],
    "aS8y": [function (require, module, exports) {
        "use strict";
        var t = require("./createError");
        module.exports = function (e, s, u) {
            var a = u.config.validateStatus;
            u.status && a && !a(u.status) ? s(t("Request failed with status code " + u.status, u.config, null, u.request, u)) : e(u)
        };
    }, {"./createError": "bIiH"}],
    "H6Qo": [function (require, module, exports) {
        "use strict";
        var e = require("./../utils");

        function r(e) {
            return encodeURIComponent(e).replace(/%40/gi, "@").replace(/%3A/gi, ":").replace(/%24/g, "$").replace(/%2C/gi, ",").replace(/%20/g, "+").replace(/%5B/gi, "[").replace(/%5D/gi, "]")
        }

        module.exports = function (i, n, t) {
            if (!n) return i;
            var a;
            if (t) a = t(n); else if (e.isURLSearchParams(n)) a = n.toString(); else {
                var c = [];
                e.forEach(n, function (i, n) {
                    null != i && (e.isArray(i) ? n += "[]" : i = [i], e.forEach(i, function (i) {
                        e.isDate(i) ? i = i.toISOString() : e.isObject(i) && (i = JSON.stringify(i)), c.push(r(n) + "=" + r(i))
                    }))
                }), a = c.join("&")
            }
            return a && (i += (-1 === i.indexOf("?") ? "?" : "&") + a), i
        };
    }, {"./../utils": "S1cf"}],
    "ZeD7": [function (require, module, exports) {
        "use strict";
        var e = require("./../utils"),
            t = ["age", "authorization", "content-length", "content-type", "etag", "expires", "from", "host", "if-modified-since", "if-unmodified-since", "last-modified", "location", "max-forwards", "proxy-authorization", "referer", "retry-after", "user-agent"];
        module.exports = function (r) {
            var i, o, n, s = {};
            return r ? (e.forEach(r.split("\n"), function (r) {
                if (n = r.indexOf(":"), i = e.trim(r.substr(0, n)).toLowerCase(), o = e.trim(r.substr(n + 1)), i) {
                    if (s[i] && t.indexOf(i) >= 0) return;
                    s[i] = "set-cookie" === i ? (s[i] ? s[i] : []).concat([o]) : s[i] ? s[i] + ", " + o : o
                }
            }), s) : s
        };
    }, {"./../utils": "S1cf"}],
    "w7LF": [function (require, module, exports) {
        "use strict";
        var t = require("./../utils");
        module.exports = t.isStandardBrowserEnv() ? function () {
            var r, e = /(msie|trident)/i.test(navigator.userAgent), o = document.createElement("a");

            function a(t) {
                var r = t;
                return e && (o.setAttribute("href", r), r = o.href), o.setAttribute("href", r), {
                    href: o.href,
                    protocol: o.protocol ? o.protocol.replace(/:$/, "") : "",
                    host: o.host,
                    search: o.search ? o.search.replace(/^\?/, "") : "",
                    hash: o.hash ? o.hash.replace(/^#/, "") : "",
                    hostname: o.hostname,
                    port: o.port,
                    pathname: "/" === o.pathname.charAt(0) ? o.pathname : "/" + o.pathname
                }
            }

            return r = a(window.location.href), function (e) {
                var o = t.isString(e) ? a(e) : e;
                return o.protocol === r.protocol && o.host === r.host
            }
        }() : function () {
            return !0
        };
    }, {"./../utils": "S1cf"}],
    "dn2M": [function (require, module, exports) {
        "use strict";
        var e = require("./../utils");
        module.exports = e.isStandardBrowserEnv() ? {
            write: function (n, t, o, r, i, u) {
                var s = [];
                s.push(n + "=" + encodeURIComponent(t)), e.isNumber(o) && s.push("expires=" + new Date(o).toGMTString()), e.isString(r) && s.push("path=" + r), e.isString(i) && s.push("domain=" + i), !0 === u && s.push("secure"), document.cookie = s.join("; ")
            }, read: function (e) {
                var n = document.cookie.match(new RegExp("(^|;\\s*)(" + e + ")=([^;]*)"));
                return n ? decodeURIComponent(n[3]) : null
            }, remove: function (e) {
                this.write(e, "", Date.now() - 864e5)
            }
        } : {
            write: function () {
            }, read: function () {
                return null
            }, remove: function () {
            }
        };
    }, {"./../utils": "S1cf"}],
    "KRuG": [function (require, module, exports) {
        "use strict";
        var e = require("./../utils"), r = require("./../core/settle"), s = require("./../helpers/buildURL"),
            t = require("./../helpers/parseHeaders"), o = require("./../helpers/isURLSameOrigin"),
            n = require("../core/createError");
        module.exports = function (a) {
            return new Promise(function (i, u) {
                var l = a.data, p = a.headers;
                e.isFormData(l) && delete p["Content-Type"];
                var d = new XMLHttpRequest;
                if (a.auth) {
                    var c = a.auth.username || "", f = a.auth.password || "";
                    p.Authorization = "Basic " + btoa(c + ":" + f)
                }
                if (d.open(a.method.toUpperCase(), s(a.url, a.params, a.paramsSerializer), !0), d.timeout = a.timeout, d.onreadystatechange = function () {
                    if (d && 4 === d.readyState && (0 !== d.status || d.responseURL && 0 === d.responseURL.indexOf("file:"))) {
                        var e = "getAllResponseHeaders" in d ? t(d.getAllResponseHeaders()) : null, s = {
                            data: a.responseType && "text" !== a.responseType ? d.response : d.responseText,
                            status: d.status,
                            statusText: d.statusText,
                            headers: e,
                            config: a,
                            request: d
                        };
                        r(i, u, s), d = null
                    }
                }, d.onerror = function () {
                    u(n("Network Error", a, null, d)), d = null
                }, d.ontimeout = function () {
                    u(n("timeout of " + a.timeout + "ms exceeded", a, "ECONNABORTED", d)), d = null
                }, e.isStandardBrowserEnv()) {
                    var h = require("./../helpers/cookies"),
                        m = (a.withCredentials || o(a.url)) && a.xsrfCookieName ? h.read(a.xsrfCookieName) : void 0;
                    m && (p[a.xsrfHeaderName] = m)
                }
                if ("setRequestHeader" in d && e.forEach(p, function (e, r) {
                    void 0 === l && "content-type" === r.toLowerCase() ? delete p[r] : d.setRequestHeader(r, e)
                }), a.withCredentials && (d.withCredentials = !0), a.responseType) try {
                    d.responseType = a.responseType
                } catch (y) {
                    if ("json" !== a.responseType) throw y
                }
                "function" == typeof a.onDownloadProgress && d.addEventListener("progress", a.onDownloadProgress), "function" == typeof a.onUploadProgress && d.upload && d.upload.addEventListener("progress", a.onUploadProgress), a.cancelToken && a.cancelToken.promise.then(function (e) {
                    d && (d.abort(), u(e), d = null)
                }), void 0 === l && (l = null), d.send(l)
            })
        };
    }, {
        "./../utils": "S1cf",
        "./../core/settle": "aS8y",
        "./../helpers/buildURL": "H6Qo",
        "./../helpers/parseHeaders": "ZeD7",
        "./../helpers/isURLSameOrigin": "w7LF",
        "../core/createError": "bIiH",
        "./../helpers/cookies": "dn2M"
    }],
    "BXyq": [function (require, module, exports) {
        var process = require("process");
        var e = require("process"), t = require("./utils"), r = require("./helpers/normalizeHeaderName"),
            n = {"Content-Type": "application/x-www-form-urlencoded"};

        function a(e, r) {
            !t.isUndefined(e) && t.isUndefined(e["Content-Type"]) && (e["Content-Type"] = r)
        }

        function i() {
            var t;
            return "undefined" != typeof XMLHttpRequest ? t = require("./adapters/xhr") : void 0 !== e && (t = require("./adapters/http")), t
        }

        var o = {
            adapter: i(),
            transformRequest: [function (e, n) {
                return r(n, "Content-Type"), t.isFormData(e) || t.isArrayBuffer(e) || t.isBuffer(e) || t.isStream(e) || t.isFile(e) || t.isBlob(e) ? e : t.isArrayBufferView(e) ? e.buffer : t.isURLSearchParams(e) ? (a(n, "application/x-www-form-urlencoded;charset=utf-8"), e.toString()) : t.isObject(e) ? (a(n, "application/json;charset=utf-8"), JSON.stringify(e)) : e
            }],
            transformResponse: [function (e) {
                if ("string" == typeof e) try {
                    e = JSON.parse(e)
                } catch (t) {
                }
                return e
            }],
            timeout: 0,
            xsrfCookieName: "XSRF-TOKEN",
            xsrfHeaderName: "X-XSRF-TOKEN",
            maxContentLength: -1,
            validateStatus: function (e) {
                return e >= 200 && e < 300
            },
            headers: {common: {Accept: "application/json, text/plain, */*"}}
        };
        t.forEach(["delete", "get", "head"], function (e) {
            o.headers[e] = {}
        }), t.forEach(["post", "put", "patch"], function (e) {
            o.headers[e] = t.merge(n)
        }), module.exports = o;
    }, {
        "./utils": "S1cf",
        "./helpers/normalizeHeaderName": "M8l6",
        "./adapters/xhr": "KRuG",
        "./adapters/http": "KRuG",
        "process": "pBGv"
    }],
    "rj2i": [function (require, module, exports) {
        "use strict";
        var t = require("./../utils");

        function e() {
            this.handlers = []
        }

        e.prototype.use = function (t, e) {
            return this.handlers.push({fulfilled: t, rejected: e}), this.handlers.length - 1
        }, e.prototype.eject = function (t) {
            this.handlers[t] && (this.handlers[t] = null)
        }, e.prototype.forEach = function (e) {
            t.forEach(this.handlers, function (t) {
                null !== t && e(t)
            })
        }, module.exports = e;
    }, {"./../utils": "S1cf"}],
    "woEt": [function (require, module, exports) {
        "use strict";
        var r = require("./../utils");
        module.exports = function (t, u, e) {
            return r.forEach(e, function (r) {
                t = r(t, u)
            }), t
        };
    }, {"./../utils": "S1cf"}],
    "V30M": [function (require, module, exports) {
        "use strict";
        module.exports = function (t) {
            return !(!t || !t.__CANCEL__)
        };
    }, {}],
    "YZjV": [function (require, module, exports) {
        "use strict";
        module.exports = function (t) {
            return /^([a-z][a-z\d\+\-\.]*:)?\/\//i.test(t)
        };
    }, {}],
    "a2Uu": [function (require, module, exports) {
        "use strict";
        module.exports = function (e, r) {
            return r ? e.replace(/\/+$/, "") + "/" + r.replace(/^\/+/, "") : e
        };
    }, {}],
    "uz6X": [function (require, module, exports) {
        "use strict";
        var e = require("./../utils"), r = require("./transformData"), a = require("../cancel/isCancel"),
            s = require("../defaults"), t = require("./../helpers/isAbsoluteURL"),
            n = require("./../helpers/combineURLs");

        function o(e) {
            e.cancelToken && e.cancelToken.throwIfRequested()
        }

        module.exports = function (d) {
            return o(d), d.baseURL && !t(d.url) && (d.url = n(d.baseURL, d.url)), d.headers = d.headers || {}, d.data = r(d.data, d.headers, d.transformRequest), d.headers = e.merge(d.headers.common || {}, d.headers[d.method] || {}, d.headers || {}), e.forEach(["delete", "get", "head", "post", "put", "patch", "common"], function (e) {
                delete d.headers[e]
            }), (d.adapter || s.adapter)(d).then(function (e) {
                return o(d), e.data = r(e.data, e.headers, d.transformResponse), e
            }, function (e) {
                return a(e) || (o(d), e && e.response && (e.response.data = r(e.response.data, e.response.headers, d.transformResponse))), Promise.reject(e)
            })
        };
    }, {
        "./../utils": "S1cf",
        "./transformData": "woEt",
        "../cancel/isCancel": "V30M",
        "../defaults": "BXyq",
        "./../helpers/isAbsoluteURL": "YZjV",
        "./../helpers/combineURLs": "a2Uu"
    }],
    "OvAf": [function (require, module, exports) {
        "use strict";
        var e = require("./../defaults"), t = require("./../utils"), r = require("./InterceptorManager"),
            o = require("./dispatchRequest");

        function s(e) {
            this.defaults = e, this.interceptors = {request: new r, response: new r}
        }

        s.prototype.request = function (r) {
            "string" == typeof r && (r = t.merge({url: arguments[0]}, arguments[1])), (r = t.merge(e, {method: "get"}, this.defaults, r)).method = r.method.toLowerCase();
            var s = [o, void 0], u = Promise.resolve(r);
            for (this.interceptors.request.forEach(function (e) {
                s.unshift(e.fulfilled, e.rejected)
            }), this.interceptors.response.forEach(function (e) {
                s.push(e.fulfilled, e.rejected)
            }); s.length;) u = u.then(s.shift(), s.shift());
            return u
        }, t.forEach(["delete", "get", "head", "options"], function (e) {
            s.prototype[e] = function (r, o) {
                return this.request(t.merge(o || {}, {method: e, url: r}))
            }
        }), t.forEach(["post", "put", "patch"], function (e) {
            s.prototype[e] = function (r, o, s) {
                return this.request(t.merge(s || {}, {method: e, url: r, data: o}))
            }
        }), module.exports = s;
    }, {"./../defaults": "BXyq", "./../utils": "S1cf", "./InterceptorManager": "rj2i", "./dispatchRequest": "uz6X"}],
    "mIKj": [function (require, module, exports) {
        "use strict";

        function t(t) {
            this.message = t
        }

        t.prototype.toString = function () {
            return "Cancel" + (this.message ? ": " + this.message : "")
        }, t.prototype.__CANCEL__ = !0, module.exports = t;
    }, {}],
    "tsWd": [function (require, module, exports) {
        "use strict";
        var e = require("./Cancel");

        function n(n) {
            if ("function" != typeof n) throw new TypeError("executor must be a function.");
            var o;
            this.promise = new Promise(function (e) {
                o = e
            });
            var r = this;
            n(function (n) {
                r.reason || (r.reason = new e(n), o(r.reason))
            })
        }

        n.prototype.throwIfRequested = function () {
            if (this.reason) throw this.reason
        }, n.source = function () {
            var e;
            return {
                token: new n(function (n) {
                    e = n
                }), cancel: e
            }
        }, module.exports = n;
    }, {"./Cancel": "mIKj"}],
    "X8jb": [function (require, module, exports) {
        "use strict";
        module.exports = function (n) {
            return function (t) {
                return n.apply(null, t)
            }
        };
    }, {}],
    "nUiQ": [function (require, module, exports) {
        "use strict";
        var e = require("./utils"), r = require("./helpers/bind"), n = require("./core/Axios"),
            t = require("./defaults");

        function u(t) {
            var u = new n(t), l = r(n.prototype.request, u);
            return e.extend(l, n.prototype, u), e.extend(l, u), l
        }

        var l = u(t);
        l.Axios = n, l.create = function (r) {
            return u(e.merge(t, r))
        }, l.Cancel = require("./cancel/Cancel"), l.CancelToken = require("./cancel/CancelToken"), l.isCancel = require("./cancel/isCancel"), l.all = function (e) {
            return Promise.all(e)
        }, l.spread = require("./helpers/spread"), module.exports = l, module.exports.default = l;
    }, {
        "./utils": "S1cf",
        "./helpers/bind": "EDTP",
        "./core/Axios": "OvAf",
        "./defaults": "BXyq",
        "./cancel/Cancel": "mIKj",
        "./cancel/CancelToken": "tsWd",
        "./cancel/isCancel": "V30M",
        "./helpers/spread": "X8jb"
    }],
    "dZBD": [function (require, module, exports) {
        module.exports = require("./lib/axios");
    }, {"./lib/axios": "nUiQ"}],
    "N04R": [function (require, module, exports) {
        const e = require("axios"), a = require("resolve-url"), r = e => new Promise((a, r) => {
            const t = new FileReader;
            t.onload = (() => {
                a(t.result)
            }), t.onerror = (({target: {error: {code: e}}}) => {
                r(Error(`File could not be read! Code=${e}`))
            }), t.readAsArrayBuffer(e)
        }), t = async o => {
            let i = o;
            if (void 0 === o) return "undefined";
            if ("string" == typeof o) if (/data:image\/([a-zA-Z]*);base64,([^"]*)/.test(o)) i = atob(o.split(",")[1]).split("").map(e => e.charCodeAt(0)); else {
                const {data: r} = await e.get(a(o), {responseType: "arraybuffer"});
                i = r
            } else o instanceof HTMLElement ? ("IMG" === o.tagName && (i = await t(o.src)), "VIDEO" === o.tagName && (i = await t(o.poster)), "CANVAS" === o.tagName && await new Promise(e => {
                o.toBlob(async a => {
                    i = await r(a), e()
                })
            })) : (o instanceof File || o instanceof Blob) && (i = await r(o));
            return new Uint8Array(i)
        };
        module.exports = t;
    }, {"axios": "dZBD", "resolve-url": "A2Q1"}],
    "f6pb": [function (require, module, exports) {
        const e = require("./defaultOptions"), r = require("./spawnWorker"), o = require("./terminateWorker"),
            a = require("./onMessage"), s = require("./send"), n = require("./loadImage");
        module.exports = {defaultOptions: e, spawnWorker: r, terminateWorker: o, onMessage: a, send: s, loadImage: n};
    }, {
        "./defaultOptions": "I5Ld",
        "./spawnWorker": "U2yn",
        "./terminateWorker": "X0rf",
        "./onMessage": "UyLp",
        "./send": "NstZ",
        "./loadImage": "N04R"
    }],
    "Fqzj": [function (require, module, exports) {
        const e = require("./utils/resolvePaths"), a = require("./utils/circularize"),
            t = require("./createJob"), {log: o} = require("./utils/log"),
            i = require("./utils/getId"), {defaultOEM: r} = require("./constants/config"), {
                defaultOptions: n,
                spawnWorker: l,
                terminateWorker: s,
                onMessage: d,
                loadImage: c,
                send: g
            } = require("./worker/node");
        let u = 0;
        module.exports = ((p = {}) => {
            const m = i("Worker", u), {logger: y, ...w} = e({...n, ...p}), k = {}, P = {};
            let q = l(w);
            u += 1;
            const I = (e, a) => {
                k[e] = a
            }, f = (e, a) => {
                P[e] = a
            }, j = ({id: e, action: a, payload: t}) => new Promise((i, r) => {
                o(`[${m}]: Start ${e}, action=${a}`), I(a, i), f(a, r), g(q, {
                    workerId: m,
                    jobId: e,
                    action: a,
                    payload: t
                })
            });
            return d(q, ({workerId: e, jobId: t, status: i, action: r, data: n}) => {
                if ("resolve" === i) {
                    o(`[${e}]: Complete ${t}`);
                    let i = n;
                    "recognize" === r ? i = a(n) : "getPDF" === r && (i = Array.from({
                        ...n,
                        length: Object.keys(n).length
                    })), k[r]({jobId: t, data: i})
                } else {
                    if ("reject" === i) throw P[r](n), Error(n);
                    "progress" === i && y(n)
                }
            }), {
                id: m,
                worker: q,
                setResolve: I,
                setReject: f,
                load: e => j(t({id: e, action: "load", payload: {options: w}})),
                loadLanguage: (e = "eng", a) => j(t({id: a, action: "loadLanguage", payload: {langs: e, options: w}})),
                initialize: (e = "eng", a = r, o) => j(t({id: o, action: "initialize", payload: {langs: e, oem: a}})),
                setParameters: (e = {}, a) => j(t({id: a, action: "setParameters", payload: {params: e}})),
                recognize: async (e, a = {}, o) => j(t({
                    id: o,
                    action: "recognize",
                    payload: {image: await c(e), options: a}
                })),
                getPDF: (e = "Tesseract OCR Result", a = !1, o) => j(t({
                    id: o,
                    action: "getPDF",
                    payload: {title: e, textonly: a}
                })),
                detect: async (e, a) => j(t({id: a, action: "detect", payload: {image: await c(e)}})),
                terminate: async e => (null !== q && (await j(t({
                    id: e,
                    action: "terminate"
                })), s(q), q = null), Promise.resolve())
            }
        });
    }, {
        "./utils/resolvePaths": "EDO9",
        "./utils/circularize": "RXnt",
        "./createJob": "uXW0",
        "./utils/log": "i6s0",
        "./utils/getId": "XvCm",
        "./constants/config": "KTE2",
        "./worker/node": "f6pb"
    }],
    "XgES": [function (require, module, exports) {
        const a = require("./createWorker"), e = async (e, t, i) => {
            const n = a(i);
            return await n.load(), await n.loadLanguage(t), await n.initialize(t), n.recognize(e).finally(async () => {
                await n.terminate()
            })
        }, t = async (e, t) => {
            const i = a(t);
            return await i.load(), await i.loadLanguage("osd"), await i.initialize("osd"), i.detect(e).finally(async () => {
                await i.terminate()
            })
        };
        module.exports = {recognize: e, detect: t};
    }, {"./createWorker": "Fqzj"}],
    "JYuR": [function (require, module, exports) {
        module.exports = {
            OSD_ONLY: "0",
            AUTO_OSD: "1",
            AUTO_ONLY: "2",
            AUTO: "3",
            SINGLE_COLUMN: "4",
            SINGLE_BLOCK_VERT_TEXT: "5",
            SINGLE_BLOCK: "6",
            SINGLE_LINE: "7",
            SINGLE_WORD: "8",
            CIRCLE_WORD: "9",
            SINGLE_CHAR: "10",
            SPARSE_TEXT: "11",
            SPARSE_TEXT_OSD: "12"
        };
    }, {}],
    "W8hG": [function (require, module, exports) {
        require("regenerator-runtime/runtime");
        const e = require("./createScheduler"), r = require("./createWorker"), t = require("./Tesseract"),
            u = require("./constants/OEM"), i = require("./constants/PSM"), {setLogging: o} = require("./utils/log");
        module.exports = {OEM: u, PSM: i, createScheduler: e, createWorker: r, setLogging: o, ...t};
    }, {
        "regenerator-runtime/runtime": "QVnC",
        "./createScheduler": "eMFN",
        "./createWorker": "Fqzj",
        "./Tesseract": "XgES",
        "./constants/OEM": "XDIt",
        "./constants/PSM": "JYuR",
        "./utils/log": "i6s0"
    }],
    "Tgps": [function (require, module, exports) {
        "use strict";
        Object.defineProperty(exports, "__esModule", {value: !0}), exports.langs = void 0;
        var e = [{value: "rus", text: "??????????????"}, {value: "ukr", text: "????????????????????"}, {
            value: "eng",
            text: "English"
        }, {value: "deu", text: "Deutsch"}, {value: "fra", text: "Fran??ais"}];
        exports.langs = e;
    }, {}],
    "LH3n": [function (require, module, exports) {
        "use strict";

        function e() {
            var e = document.createElement("div");
            e.className = "state";
            var t = document.createElement("div");
            t.className = "state__status";
            var s = document.createElement("progress");
            return s.className = "state__progress", s.max = 1, e.appendChild(t), e.appendChild(s), {
                el: e,
                get status() {
                    return this._status
                },
                set status(e) {
                    this._status = e, t.textContent = e
                },
                set progress(e) {
                    s.value = e
                }
            }
        }

        function t(t) {
            var s = e();
            return {
                clear: function () {
                    s.status = null, t.innerHTML = ""
                }, updateProgress: function (e, a) {
                    s.status || t.appendChild(s.el), e !== s.status && (s.status = e), s.progress = a
                }, setResult: function (e) {
                    e = e.replace(/\n\s*\n/g, "\n");
                    var s = document.createElement("pre");
                    s.innerHTML = e, t.appendChild(s)
                }
            }
        }

        Object.defineProperty(exports, "__esModule", {value: !0}), exports.Log = t;
    }, {}],
    "pUwX": [function (require, module, exports) {
        "use strict";

        function e(e) {
            e.preventDefault(), e.stopPropagation()
        }

        function t(t, n) {
            function r(e) {
                t.classList.add("highlight")
            }

            function a(e) {
                t.classList.remove("highlight")
            }

            ["dragenter", "dragover", "dragleave", "drop"].forEach(function (n) {
                t.addEventListener(n, e, !1)
            }), ["dragenter", "dragover"].forEach(function (e) {
                t.addEventListener(e, r, !1)
            }), t.addEventListener("dragleave", function (e) {
                e.toElement && e.toElement !== t && t.contains(e.toElement) || a()
            }, !1), t.addEventListener("drop", function (e) {
                a();
                var t = e.dataTransfer.files;
                n(t[0])
            }, !1)
        }

        Object.defineProperty(exports, "__esModule", {value: !0}), exports.DnD = t;
    }, {}],
    "OCl4": [function (require, module, exports) {
        module.exports = "rus.742ca886.png";
    }, {}],
    "A2T1": [function (require, module, exports) {
        "use strict";
        var e, t = a(require("tesseract.js")), n = require("./langs"), r = require("./Log"), o = require("./DnD"),
            u = a(require("./rus.png"));

        function a(e) {
            return e && e.__esModule ? e : {default: e}
        }

        var l = document.getElementById("langs");
        n.langs.forEach(function (e) {
            var t = document.createElement("option");
            t.textContent = e.text, t.value = e.value, l.appendChild(t)
        });
        var c = document.getElementById("preview"), s = document.getElementById("file");

        function d(e) {
            var t = new FileReader;
            t.onloadend = function () {
                c.src = t.result
            }, t.readAsDataURL(e)
        }

        s.addEventListener("change", function () {
            d(e = s.files[0])
        }), (0, o.DnD)(document.body, function (t) {
            d(e = t)
        }), e = c.src = u.default;
        var i = document.getElementById("start"), g = (0, r.Log)(document.getElementById("log"));

        function f(e, n) {
            return t.default.recognize(e, n, {
                logger: function (e) {
                    console.log("Progress:", e), g.updateProgress(e.status, e.progress)
                }
            }).then(function (e) {
                return console.log("Result:", e), e.data.text
            })
        }

        i.addEventListener("click", function () {
            i.disabled = !0, g.clear(), f(e, l.value).then(function (e) {
                g.clear(), g.setResult(e)
            }).catch(function (e) {
                console.error(e)
            }).finally(function () {
                i.disabled = !1
            })
        });
    }, {"tesseract.js": "W8hG", "./langs": "Tgps", "./Log": "LH3n", "./DnD": "pUwX", "./rus.png": "OCl4"}]
}, {}, ["A2T1"], null)
//# sourceMappingURL=app.32385ec6.js.map