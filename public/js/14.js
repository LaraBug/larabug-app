(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[14],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/panel/Pages/Projects/FeedbackInstallation.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/panel/Pages/Projects/FeedbackInstallation.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Shared_Layout__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @/Shared/Layout */ "./resources/assets/js/panel/Shared/Layout.vue");
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
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  metaInfo: {
    title: 'Feedback installation'
  },
  layout: _Shared_Layout__WEBPACK_IMPORTED_MODULE_0__["default"],
  props: {
    project: Object
  },
  computed: {
    forwardBrackets: function forwardBrackets() {
      return '{{';
    },
    backwardBrackets: function backwardBrackets() {
      return '}}';
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/panel/Pages/Projects/FeedbackInstallation.vue?vue&type=template&id=2c238c5c&":
/*!****************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/panel/Pages/Projects/FeedbackInstallation.vue?vue&type=template&id=2c238c5c& ***!
  \****************************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "installation-page" }, [
    _c(
      "h1",
      { staticClass: "mb-8 font-bold text-3xl" },
      [
        _c(
          "inertia-link",
          {
            staticClass: "text-gray-600 hover:text-gray-900",
            attrs: { href: _vm.route("panel.projects.index") }
          },
          [_vm._v("\n                Projects\n            ")]
        ),
        _vm._v(" "),
        _c("span", { staticClass: "text-gray-500 font-medium" }, [_vm._v("/")]),
        _vm._v(" "),
        _c(
          "inertia-link",
          {
            staticClass: "text-gray-600 hover:text-gray-900",
            attrs: { href: _vm.route("panel.projects.show", _vm.project.id) }
          },
          [
            _vm._v(
              "\n                " +
                _vm._s(_vm.project.title) +
                "\n            "
            )
          ]
        ),
        _vm._v(" "),
        _c("span", { staticClass: "text-gray-600 font-medium" }, [_vm._v("/")]),
        _vm._v(" "),
        _c("span", { staticClass: "text-primary-500 font-medium" }, [
          _vm._v("Feedback installation")
        ])
      ],
      1
    ),
    _vm._v(" "),
    _c("div", { staticClass: "grid grid-cols-2 gap-4" }, [
      _c(
        "div",
        { staticClass: "bg-white rounded shadow overflow-hidden p-5 mb-4" },
        [
          _c("h3", { staticClass: "text-lg font-bold pb-3" }, [
            _vm._v("Step 1 - Installation")
          ]),
          _vm._v(" "),
          _vm._m(0),
          _vm._v(" "),
          _vm._m(1),
          _vm._v(" "),
          _c("pre", { staticClass: "mb-0" }, [
            _vm._v(_vm._s(_vm.project.feedback_script_html))
          ]),
          _vm._v(" "),
          _c(
            "button",
            {
              directives: [
                {
                  name: "clipboard",
                  rawName: "v-clipboard:copy",
                  value: _vm.project.feedback_script_html,
                  expression: "project.feedback_script_html",
                  arg: "copy"
                }
              ],
              staticClass: "text-sm text-blue-500",
              attrs: { type: "button" }
            },
            [_vm._v("Copy this value")]
          )
        ]
      ),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "bg-white rounded shadow overflow-hidden p-5 mb-4" },
        [
          _c("h3", { staticClass: "text-lg font-bold pb-3" }, [
            _vm._v("Step 2 - Usage")
          ]),
          _vm._v(" "),
          _vm._m(2),
          _vm._v(" "),
          _c("pre", [
            _vm._v(
              "<script>\n    let laraBug = new LaraBug('" +
                _vm._s(_vm.forwardBrackets) +
                " \\LaraBug::getLastExceptionId() " +
                _vm._s(_vm.backwardBrackets) +
                "');\n    laraBug.leaveFeedback();\n</script>"
            )
          ])
        ]
      )
    ]),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "bg-white rounded shadow overflow-hidden p-5" },
      [
        _c("h3", { staticClass: "text-lg font-bold pb-3" }, [
          _vm._v("Step 3 - Finished!")
        ]),
        _vm._v(" "),
        _c("p", { staticClass: "pb-6" }, [
          _vm._v("Thats it! You are all set to go!")
        ]),
        _vm._v(" "),
        _c(
          "inertia-link",
          {
            staticClass: "btn-primary",
            attrs: {
              href: _vm.route("panel.projects.show", _vm.project.id),
              tabindex: "-1"
            }
          },
          [
            _vm._v(
              "\n                Take me to my project overview\n            "
            )
          ]
        )
      ],
      1
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [
      _vm._v(
        "\n                    If you do not have a custom 500 error view file, create one in this directory: "
      ),
      _c("code", [_vm._v("resources/views/errors/500.blade.php")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [
      _vm._v(
        "\n                    Next, on your 500 page register this JS file before your closing "
      ),
      _c("code", [_vm._v("</head>")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [
      _vm._v("\n                    Before your closing "),
      _c("code", [_vm._v("</body>")]),
      _vm._v(
        " tag, enter this code to initiate the feedback modal\n                "
      )
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/assets/js/panel/Pages/Projects/FeedbackInstallation.vue":
/*!***************************************************************************!*\
  !*** ./resources/assets/js/panel/Pages/Projects/FeedbackInstallation.vue ***!
  \***************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _FeedbackInstallation_vue_vue_type_template_id_2c238c5c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./FeedbackInstallation.vue?vue&type=template&id=2c238c5c& */ "./resources/assets/js/panel/Pages/Projects/FeedbackInstallation.vue?vue&type=template&id=2c238c5c&");
/* harmony import */ var _FeedbackInstallation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./FeedbackInstallation.vue?vue&type=script&lang=js& */ "./resources/assets/js/panel/Pages/Projects/FeedbackInstallation.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _FeedbackInstallation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _FeedbackInstallation_vue_vue_type_template_id_2c238c5c___WEBPACK_IMPORTED_MODULE_0__["render"],
  _FeedbackInstallation_vue_vue_type_template_id_2c238c5c___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/js/panel/Pages/Projects/FeedbackInstallation.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/assets/js/panel/Pages/Projects/FeedbackInstallation.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************!*\
  !*** ./resources/assets/js/panel/Pages/Projects/FeedbackInstallation.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_FeedbackInstallation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./FeedbackInstallation.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/panel/Pages/Projects/FeedbackInstallation.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_FeedbackInstallation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/assets/js/panel/Pages/Projects/FeedbackInstallation.vue?vue&type=template&id=2c238c5c&":
/*!**********************************************************************************************************!*\
  !*** ./resources/assets/js/panel/Pages/Projects/FeedbackInstallation.vue?vue&type=template&id=2c238c5c& ***!
  \**********************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_FeedbackInstallation_vue_vue_type_template_id_2c238c5c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./FeedbackInstallation.vue?vue&type=template&id=2c238c5c& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/panel/Pages/Projects/FeedbackInstallation.vue?vue&type=template&id=2c238c5c&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_FeedbackInstallation_vue_vue_type_template_id_2c238c5c___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_FeedbackInstallation_vue_vue_type_template_id_2c238c5c___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);