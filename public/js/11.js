(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[11],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/panel/Pages/Dashboard/Index.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/panel/Pages/Dashboard/Index.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Shared_Layout__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @/Shared/Layout */ "./resources/assets/js/panel/Shared/Layout.vue");
/* harmony import */ var _Shared_Icon__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @/Shared/Icon */ "./resources/assets/js/panel/Shared/Icon.vue");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//


/* harmony default export */ __webpack_exports__["default"] = ({
  metaInfo: {
    title: 'Dashboard'
  },
  layout: _Shared_Layout__WEBPACK_IMPORTED_MODULE_0__["default"],
  components: {
    Icon: _Shared_Icon__WEBPACK_IMPORTED_MODULE_1__["default"]
  },
  props: {
    exceptions: Array,
    exceptionChart: Object,
    totalExceptions: Number,
    totalProjects: Number
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/panel/Pages/Dashboard/Index.vue?vue&type=template&id=92026942&":
/*!**************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/panel/Pages/Dashboard/Index.vue?vue&type=template&id=92026942& ***!
  \**************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c(
      "div",
      {
        staticClass:
          "grid grid-cols-12 gap-4 mb-4 bg-white rounded shadow overflow-x-auto p-5"
      },
      [
        _c(
          "div",
          { staticClass: "col-span-12 lg:col-span-4 text-center my-auto" },
          [
            _c("h2", { staticClass: "text-4xl" }, [
              _vm._v(_vm._s(_vm.totalProjects))
            ]),
            _vm._v(" "),
            _c("p", { staticClass: "text-gray-500" }, [
              _vm._v("\n                Projects\n            ")
            ])
          ]
        ),
        _vm._v(" "),
        _c(
          "div",
          { staticClass: "col-span-12 lg:col-span-4 text-center my-auto" },
          [
            _c("h2", { staticClass: "text-4xl text-green-400" }, [
              _vm._v(
                "\n                " +
                  _vm._s(_vm.totalExceptions) +
                  "\n            "
              )
            ]),
            _vm._v(" "),
            _c("p", { staticClass: "text-gray-500" }, [
              _vm._v("\n                Total exceptions\n            ")
            ])
          ]
        ),
        _vm._v(" "),
        _c(
          "div",
          { staticClass: "col-span-12 lg:col-span-4 h-40" },
          [
            _c("line-chart", {
              attrs: {
                height: "100%",
                data: _vm.exceptionChart,
                curve: false,
                colors: ["#D22651"]
              }
            })
          ],
          1
        )
      ]
    ),
    _vm._v(" "),
    _vm.totalProjects && _vm.exceptions.length
      ? _c("div", [
          _vm._m(0),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "grid grid-cols-12" },
            _vm._l(_vm.exceptions, function(exception) {
              return _c(
                "inertia-link",
                {
                  key: exception.id,
                  staticClass:
                    "bg-white col-span-12 border-l-4 mb-3 pl-5 border-solid shadow py-5",
                  class: {
                    "border-primary-600": exception.status === "OPEN",
                    "border-green-600": exception.status === "READ"
                  },
                  attrs: {
                    href: _vm.route("panel.exceptions.show", [
                      exception.project.id,
                      exception.id
                    ])
                  }
                },
                [
                  _c("p", [
                    exception.class
                      ? _c(
                          "span",
                          { staticClass: "text-xl font-bold text-primary-600" },
                          [_vm._v(_vm._s(exception.class) + " - ")]
                        )
                      : _vm._e(),
                    _vm._v(
                      " " +
                        _vm._s(exception.method) +
                        " " +
                        _vm._s(exception.fullUrl) +
                        "\n\n                    "
                    ),
                    exception.file_type === "javascript"
                      ? _c(
                          "span",
                          {
                            staticClass:
                              "bg-blue-500 text-blue-100 text-xs px-2 rounded-full font-semibold tracking-wide align-middle"
                          },
                          [
                            _vm._v(
                              "\n                        Javascript\n                    "
                            )
                          ]
                        )
                      : _vm._e()
                  ]),
                  _vm._v(" "),
                  _c("p", { staticClass: "flex text-xl font-bold" }, [
                    _vm._v(_vm._s(exception.short_exception_text))
                  ]),
                  _vm._v(" "),
                  _c("p", { staticClass: "flex mb-2" }, [
                    _vm._v(
                      _vm._s(exception.file) + ":" + _vm._s(exception.line)
                    )
                  ]),
                  _vm._v(" "),
                  _c("p", { staticClass: "text-sm" }, [
                    _c("span", [_vm._v(_vm._s(exception.project.title))]),
                    _vm._v(
                      " - " +
                        _vm._s(exception.created_at) +
                        " (" +
                        _vm._s(exception.human_date) +
                        ")\n                "
                    )
                  ])
                ]
              )
            }),
            1
          )
        ])
      : _vm._e()
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("h2", { staticClass: "font-bold text-xl mb-6" }, [
      _c("i", { staticClass: "fas fa-angle-right mr-1" }),
      _vm._v(" Activity Feed\n        ")
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/assets/js/panel/Pages/Dashboard/Index.vue":
/*!*************************************************************!*\
  !*** ./resources/assets/js/panel/Pages/Dashboard/Index.vue ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Index_vue_vue_type_template_id_92026942___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Index.vue?vue&type=template&id=92026942& */ "./resources/assets/js/panel/Pages/Dashboard/Index.vue?vue&type=template&id=92026942&");
/* harmony import */ var _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Index.vue?vue&type=script&lang=js& */ "./resources/assets/js/panel/Pages/Dashboard/Index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Index_vue_vue_type_template_id_92026942___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Index_vue_vue_type_template_id_92026942___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/js/panel/Pages/Dashboard/Index.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/assets/js/panel/Pages/Dashboard/Index.vue?vue&type=script&lang=js&":
/*!**************************************************************************************!*\
  !*** ./resources/assets/js/panel/Pages/Dashboard/Index.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/panel/Pages/Dashboard/Index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/assets/js/panel/Pages/Dashboard/Index.vue?vue&type=template&id=92026942&":
/*!********************************************************************************************!*\
  !*** ./resources/assets/js/panel/Pages/Dashboard/Index.vue?vue&type=template&id=92026942& ***!
  \********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_92026942___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=template&id=92026942& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/panel/Pages/Dashboard/Index.vue?vue&type=template&id=92026942&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_92026942___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_92026942___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);