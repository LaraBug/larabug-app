(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[15],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/panel/Pages/Projects/Installation.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/panel/Pages/Projects/Installation.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************/
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
    title: 'Project installation'
  },
  layout: _Shared_Layout__WEBPACK_IMPORTED_MODULE_0__["default"],
  props: {
    project: Object
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/panel/Pages/Projects/Installation.vue?vue&type=template&id=1c628892&":
/*!********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/assets/js/panel/Pages/Projects/Installation.vue?vue&type=template&id=1c628892& ***!
  \********************************************************************************************************************************************************************************************************************************/
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
          _vm._v("Installation")
        ])
      ],
      1
    ),
    _vm._v(" "),
    _c("div", { staticClass: "grid grid-cols-2 gap-4" }, [
      _vm._m(0),
      _vm._v(" "),
      _c("div", { staticClass: "bg-white rounded shadow p-5 mb-4" }, [
        _c("h3", { staticClass: "text-lg font-bold pb-3" }, [
          _vm._v("Step 2 - Usage")
        ]),
        _vm._v(" "),
        _vm._m(1),
        _vm._v(" "),
        _c("pre", [
          _vm._v(
            "LB_KEY=" +
              _vm._s(_vm.$page.props.auth.user.api_token) +
              "\nLB_PROJECT_KEY=" +
              _vm._s(_vm.project.key) +
              "\n"
          )
        ]),
        _vm._v(" "),
        _c("p", { staticClass: "pb-4" }, [
          _vm._v("Now test to see if it works, you can do this in two ways.")
        ]),
        _vm._v(" "),
        _vm._m(2),
        _vm._v(" "),
        _vm._m(3),
        _vm._v(" "),
        _c("code", { staticClass: "mb-4" }, [
          _vm._v("throw new \\Exception('Testing my application!');")
        ])
      ])
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
    return _c(
      "div",
      { staticClass: "bg-white rounded shadow overflow-hidden p-5 mb-4" },
      [
        _c("h3", { staticClass: "text-lg font-bold pb-3" }, [
          _vm._v("Step 1 - Installation")
        ]),
        _vm._v(" "),
        _c("p", { staticClass: "pb-3" }, [
          _vm._v(
            "\n                    Install the package in your project:\n                "
          )
        ]),
        _vm._v(" "),
        _c("code", [_vm._v("composer require larabug/larabug")]),
        _vm._v(" "),
        _c("p", { staticClass: "pb-2" }, [
          _vm._v("\n                    Publish the config file:"),
          _c("br")
        ]),
        _vm._v(" "),
        _c("code", [
          _vm._v(
            'php artisan vendor:publish --provider="LaraBug\\ServiceProvider"'
          )
        ]),
        _vm._v(" "),
        _c("p", { staticClass: "pb-4" }, [
          _vm._v("\n                    Next is to add the "),
          _c("code", [_vm._v("larabug")]),
          _vm._v(" driver to the "),
          _c("code", [_vm._v("logging.php")]),
          _vm._v(" file:\n                ")
        ]),
        _vm._v(" "),
        _c("pre", [
          _vm._v(
            "'channels' => [\n    // ...\n    'larabug' => [\n        'driver' => 'larabug',\n    ],\n],"
          )
        ]),
        _vm._v(" "),
        _c("p", { staticClass: "pb-4" }, [
          _vm._v(
            "\n                    After that you have configured the LaraBug channel you can add it to the stack section:\n                "
          )
        ]),
        _vm._v(" "),
        _c("pre", [
          _vm._v(
            "'channels' => [\n    'stack' => [\n        'driver' => 'stack',\n        'channels' => ['single', 'larabug'],\n    ],\n    //...\n],"
          )
        ])
      ]
    )
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", { staticClass: "pb-4" }, [
      _vm._v("Now all that is left to do is to add the 2 "),
      _c("strong", [_vm._v("enviroment variables")]),
      _vm._v(" to your .env file:")
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [
      _c("strong", [_vm._v("Option 1")]),
      _c("br"),
      _vm._v("\n                    Run this in your terminal:"),
      _c("br"),
      _c("code", [_vm._v("php artisan larabug:test")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", [
      _c("strong", [_vm._v("Option 2")]),
      _c("br"),
      _vm._v(
        "\n                    Run this code in your application to see if the exception is received by LaraBug.\n                "
      )
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/assets/js/panel/Pages/Projects/Installation.vue":
/*!*******************************************************************!*\
  !*** ./resources/assets/js/panel/Pages/Projects/Installation.vue ***!
  \*******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Installation_vue_vue_type_template_id_1c628892___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Installation.vue?vue&type=template&id=1c628892& */ "./resources/assets/js/panel/Pages/Projects/Installation.vue?vue&type=template&id=1c628892&");
/* harmony import */ var _Installation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Installation.vue?vue&type=script&lang=js& */ "./resources/assets/js/panel/Pages/Projects/Installation.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Installation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Installation_vue_vue_type_template_id_1c628892___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Installation_vue_vue_type_template_id_1c628892___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/js/panel/Pages/Projects/Installation.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/assets/js/panel/Pages/Projects/Installation.vue?vue&type=script&lang=js&":
/*!********************************************************************************************!*\
  !*** ./resources/assets/js/panel/Pages/Projects/Installation.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Installation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Installation.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/panel/Pages/Projects/Installation.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Installation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/assets/js/panel/Pages/Projects/Installation.vue?vue&type=template&id=1c628892&":
/*!**************************************************************************************************!*\
  !*** ./resources/assets/js/panel/Pages/Projects/Installation.vue?vue&type=template&id=1c628892& ***!
  \**************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Installation_vue_vue_type_template_id_1c628892___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Installation.vue?vue&type=template&id=1c628892& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/assets/js/panel/Pages/Projects/Installation.vue?vue&type=template&id=1c628892&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Installation_vue_vue_type_template_id_1c628892___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Installation_vue_vue_type_template_id_1c628892___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);