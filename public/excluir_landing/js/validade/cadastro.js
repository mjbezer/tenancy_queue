/*!
 * Codebase - v3.2.0
 * @author pixelcave - https://pixelcave.com
 * Copyright (c) 2019
 */


! function (e) {
    var r = {};

    function n(t) {
        if (r[t]) return r[t].exports;
        var i = r[t] = {
            i: t,
            l: !1,
            exports: {}
        };
        return e[t].call(i.exports, i, i.exports, n), i.l = !0, i.exports
    }
    n.m = e, n.c = r, n.d = function (e, r, t) {
        n.o(e, r) || Object.defineProperty(e, r, {
            enumerable: !0,
            get: t
        })
    }, n.r = function (e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(e, "__esModule", {
            value: !0
        })
    }, n.t = function (e, r) {
        if (1 & r && (e = n(e)), 8 & r) return e;
        if (4 & r && "object" == typeof e && e && e.__esModule) return e;
        var t = Object.create(null);
        if (n.r(t), Object.defineProperty(t, "default", {
                enumerable: !0,
                value: e
            }), 2 & r && "string" != typeof e)
            for (var i in e) n.d(t, i, function (r) {
                return e[r]
            }.bind(null, i));
        return t
    }, n.n = function (e) {
        var r = e && e.__esModule ? function () {
            return e.default
        } : function () {
            return e
        };
        return n.d(r, "a", r), r
    }, n.o = function (e, r) {
        return Object.prototype.hasOwnProperty.call(e, r)
    }, n.p = "", n(n.s = 60)
}({
    60: function (e, r, n) {
        e.exports = n(61)
    },
    61: function (e, r) {
        function n(e, r) {
            for (var n = 0; n < r.length; n++) {
                var t = r[n];
                t.enumerable = t.enumerable || !1, t.configurable = !0, "value" in t && (t.writable = !0), Object.defineProperty(e, t.key, t)
            }
        }
        var t = function () {
            function e() {
                ! function (e, r) {
                    if (!(e instanceof r)) throw new TypeError("Cannot call a class as a function")
                }(this, e)
            }
            var r, t, i;
            return r = e, i = [{
                key: "initValidationSignUp",
                value: function () {
                    jQuery(".js-validation-signup").validate({
                        errorClass: "invalid-feedback animated fadeInDown",
                        errorElement: "div",
                        errorPlacement: function (e, r) {
                            jQuery(r).parents(".form-group > div").append(e)
                        },
                        highlight: function (e) {
                            jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
                        },
                        success: function (e) {
                            jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
                        },
                        rules: {
                            "doc" :{
                            required: !0
                            },
                            
                            "nome": {
                                required: !0,
                                minlength: 3
                            },
                            "cep": {
                                required: !0,
                                minlength: 9
                            },
                            "name": {
                                required: !0,
                                minlength: 3
                            },
                            "email": {
                                required: !0,
                                email: !0
                            },
                            "password": {
                                required: !0,
                                minlength: 5
                            },
                            "password-confirm": {
                                required: !0,
                                equalTo: "#password"
                            },
                            "termos": {
                                required: !0
                            }
                        },
                        messages: {
                            "doc": {
                                required: "Indique identificação ",
                            },
                            "nome": {
                                required: "Preencha o campo Nome ",
                                minlength: "Seu Nome deve conter no mínimo 3 caractéres"

                            },

                            "cep": {
                                required: "Preencha o campo CEP ",
                                minlength: "CEP deve conter 8 dígitos"
                            },

                            "name": {
                                required: "Preencha o campo Nome do Usuário",
                                minlength: "Seu Nome deve conter no mínimo 3 caractéres"
                            },


                            "email": "Indique um endereço de e-mail válido!",
                            "password": {
                                required: "Informe sua senha",
                                minlength: "Sua senha deve conter no mínimo 5 caractéres"
                            },
                            "password-confirm": {
                                required: "Confirme sua senha!",
                                minlength: "Sua senha deve conter no mínimo 5 caractéres",
                                equalTo: "Inconsistência na confirmação da senha!"
                            },
                            "termos": "Você deve concordar com os termos de uso!!"
                        }
                    })
                }
            }, {
                key: "init",
                value: function () {
                    this.initValidationSignUp()
                }
            }], (t = null) && n(r.prototype, t), i && n(r, i), e
        }();
        jQuery(function () {
            t.init()
        })
    }
});