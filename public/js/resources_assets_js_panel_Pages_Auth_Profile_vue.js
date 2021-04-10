(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_assets_js_panel_Pages_Auth_Profile_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/assets/js/panel/Pages/Auth/Profile.vue?vue&type=script&lang=js":
/*!**************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/assets/js/panel/Pages/Auth/Profile.vue?vue&type=script&lang=js ***!
  \**************************************************************************************************************************************************************************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_exports__, __webpack_require__.r, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
Object(function webpackMissingModule() { var e = new Error("Cannot find module '@/Shared/Layout'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module '@/Shared/LoadingButton'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module '@/Shared/SelectInput'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module '@/Shared/TextInput'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module '@/Shared/FileInput'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module '@/Shared/TrashedMessage'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());






/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  metaInfo: function metaInfo() {
    return {
      title: "".concat(this.user.name)
    };
  },
  layout: Object(function webpackMissingModule() { var e = new Error("Cannot find module '@/Shared/Layout'"); e.code = 'MODULE_NOT_FOUND'; throw e; }()),
  components: {
    LoadingButton: Object(function webpackMissingModule() { var e = new Error("Cannot find module '@/Shared/LoadingButton'"); e.code = 'MODULE_NOT_FOUND'; throw e; }()),
    SelectInput: Object(function webpackMissingModule() { var e = new Error("Cannot find module '@/Shared/SelectInput'"); e.code = 'MODULE_NOT_FOUND'; throw e; }()),
    TextInput: Object(function webpackMissingModule() { var e = new Error("Cannot find module '@/Shared/TextInput'"); e.code = 'MODULE_NOT_FOUND'; throw e; }()),
    FileInput: Object(function webpackMissingModule() { var e = new Error("Cannot find module '@/Shared/FileInput'"); e.code = 'MODULE_NOT_FOUND'; throw e; }()),
    TrashedMessage: Object(function webpackMissingModule() { var e = new Error("Cannot find module '@/Shared/TrashedMessage'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())
  },
  props: {
    user: Object,
    settings: Object
  },
  remember: 'form',
  data: function data() {
    return {
      sending: false,
      form: {
        name: this.user.name,
        email: this.user.email,
        password: this.user.password,
        newsletter: this.user.newsletter,
        settings: this.settings
      }
    };
  },
  methods: {
    update: function update() {
      var _this = this;

      this.sending = true;
      this.$inertia.patch(this.route('panel.profile.update'), this.form).then(function () {
        _this.sending = false;
      });
    },
    updateSettings: function updateSettings() {
      var _this2 = this;

      this.sending = true;
      this.$inertia.patch(this.route('panel.profile.settings'), {
        settings: this.form.settings,
        newsletter: this.form.newsletter
      }).then(function () {
        _this2.sending = false;
      });
    }
  }
});

/***/ }),

/***/ "./resources/assets/js/panel/Pages/Auth/Profile.vue":
/*!**********************************************************!*\
  !*** ./resources/assets/js/panel/Pages/Auth/Profile.vue ***!
  \**********************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.r, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _Profile_vue_vue_type_template_id_6ebd562c_bindings_user_props_settings_props_sending_data_form_data_update_options_updateSettings_options___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Profile.vue?vue&type=template&id=6ebd562c&bindings={"user":"props","settings":"props","sending":"data","form":"data","update":"options","updateSettings":"options"} */ "./resources/assets/js/panel/Pages/Auth/Profile.vue?vue&type=template&id=6ebd562c&bindings={\"user\":\"props\",\"settings\":\"props\",\"sending\":\"data\",\"form\":\"data\",\"update\":\"options\",\"updateSettings\":\"options\"}");
/* harmony import */ var _Profile_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Profile.vue?vue&type=script&lang=js */ "./resources/assets/js/panel/Pages/Auth/Profile.vue?vue&type=script&lang=js");



_Profile_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default.render = _Profile_vue_vue_type_template_id_6ebd562c_bindings_user_props_settings_props_sending_data_form_data_update_options_updateSettings_options___WEBPACK_IMPORTED_MODULE_0__.render
/* hot reload */
if (false) {}

_Profile_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default.__file = "resources/assets/js/panel/Pages/Auth/Profile.vue"

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_Profile_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default);

/***/ }),

/***/ "./resources/assets/js/panel/Pages/Auth/Profile.vue?vue&type=script&lang=js":
/*!**********************************************************************************!*\
  !*** ./resources/assets/js/panel/Pages/Auth/Profile.vue?vue&type=script&lang=js ***!
  \**********************************************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] -> ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/assets/js/panel/Pages/Auth/Profile.vue?vue&type=script&lang=js .default */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.d, __webpack_require__.r, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => /* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Profile_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__.default
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Profile_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Profile.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/assets/js/panel/Pages/Auth/Profile.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/assets/js/panel/Pages/Auth/Profile.vue?vue&type=template&id=6ebd562c&bindings={\"user\":\"props\",\"settings\":\"props\",\"sending\":\"data\",\"form\":\"data\",\"update\":\"options\",\"updateSettings\":\"options\"}":
/*!******************************************************************************************************************************************************************************************************************!*\
  !*** ./resources/assets/js/panel/Pages/Auth/Profile.vue?vue&type=template&id=6ebd562c&bindings={"user":"props","settings":"props","sending":"data","form":"data","update":"options","updateSettings":"options"} ***!
  \******************************************************************************************************************************************************************************************************************/
/*! namespace exports */
/*! export render [provided] [no usage info] [missing usage info prevents renaming] -> ./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/assets/js/panel/Pages/Auth/Profile.vue?vue&type=template&id=6ebd562c&bindings={"user":"props","settings":"props","sending":"data","form":"data","update":"options","updateSettings":"options"} .render */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.d, __webpack_require__.r, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Profile_vue_vue_type_template_id_6ebd562c_bindings_user_props_settings_props_sending_data_form_data_update_options_updateSettings_options___WEBPACK_IMPORTED_MODULE_0__.render
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Profile_vue_vue_type_template_id_6ebd562c_bindings_user_props_settings_props_sending_data_form_data_update_options_updateSettings_options___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Profile.vue?vue&type=template&id=6ebd562c&bindings={"user":"props","settings":"props","sending":"data","form":"data","update":"options","updateSettings":"options"} */ "./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/assets/js/panel/Pages/Auth/Profile.vue?vue&type=template&id=6ebd562c&bindings={\"user\":\"props\",\"settings\":\"props\",\"sending\":\"data\",\"form\":\"data\",\"update\":\"options\",\"updateSettings\":\"options\"}");


/***/ }),

/***/ "./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/assets/js/panel/Pages/Auth/Profile.vue?vue&type=template&id=6ebd562c&bindings={\"user\":\"props\",\"settings\":\"props\",\"sending\":\"data\",\"form\":\"data\",\"update\":\"options\",\"updateSettings\":\"options\"}":
/*!***************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/assets/js/panel/Pages/Auth/Profile.vue?vue&type=template&id=6ebd562c&bindings={"user":"props","settings":"props","sending":"data","form":"data","update":"options","updateSettings":"options"} ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! namespace exports */
/*! export render [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* binding */ render
/* harmony export */ });
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());


const _hoisted_1 = { class: "mb-8 flex justify-start max-w-lg" }
const _hoisted_2 = { class: "font-bold text-3xl" }
const _hoisted_3 = { class: "flex flex-wrap -mx-4" }
const _hoisted_4 = { class: "w-full lg:w-2/4 px-2 mb-4 lg:mb-0" }
const _hoisted_5 = { class: "bg-white rounded shadow" }
const _hoisted_6 = { class: "px-6 py-4" }
const _hoisted_7 = /*#__PURE__*/Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("h2", { class: "mb-5 font-medium text-2xl" }, " Profile ", -1 /* HOISTED */)
const _hoisted_8 = { class: "px-6 py-4 bg-gray-100 flex justify-end items-center" }
const _hoisted_9 = /*#__PURE__*/Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("Save ")
const _hoisted_10 = { class: "w-full lg:w-2/4 px-2 mb-4 lg:mb-0" }
const _hoisted_11 = { class: "bg-white rounded shadow" }
const _hoisted_12 = { class: "px-6 py-4" }
const _hoisted_13 = /*#__PURE__*/Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("h2", { class: "mb-5 font-medium text-2xl" }, " Settings ", -1 /* HOISTED */)
const _hoisted_14 = /*#__PURE__*/Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("strong", { class: "block mb-2" }, "General", -1 /* HOISTED */)
const _hoisted_15 = {
  class: "form-label pb-5",
  for: "newsletter"
}
const _hoisted_16 = /*#__PURE__*/Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("span", null, "Receive newsletter", -1 /* HOISTED */)
const _hoisted_17 = /*#__PURE__*/Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("strong", { class: "block mb-2" }, "Code preview settings", -1 /* HOISTED */)
const _hoisted_18 = {
  class: "form-label pb-5",
  for: "rainbow"
}
const _hoisted_19 = /*#__PURE__*/Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("span", null, "Enable rainbow brackets", -1 /* HOISTED */)
const _hoisted_20 = { class: "px-6 py-4 bg-gray-100 flex justify-end items-center" }
const _hoisted_21 = /*#__PURE__*/Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("Save")

function render(_ctx, _cache, $props, $setup, $data, $options) {
  const _component_text_input = Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("text-input")
  const _component_loading_button = Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("loading-button")

  return (Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())(), Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("div", null, [
    Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("div", _hoisted_1, [
      Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("h1", _hoisted_2, Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())($props.user.name), 1 /* TEXT */),
      Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("img", {
        src: _ctx.$page.props.auth.user.avatar,
        class: "block w-8 h-8 rounded-full ml-4 my-auto"
      }, null, 8 /* PROPS */, ["src"])
    ]),
    Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("div", _hoisted_3, [
      Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("div", _hoisted_4, [
        Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("div", _hoisted_5, [
          Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("form", {
            onSubmit: _cache[3] || (_cache[3] = Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())((...args) => ($options.update(...args)), ["prevent"]))
          }, [
            Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("div", _hoisted_6, [
              _hoisted_7,
              Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())(_component_text_input, {
                modelValue: $data.form.name,
                "onUpdate:modelValue": _cache[1] || (_cache[1] = $event => ($data.form.name = $event)),
                errors: _ctx.$page.props.errors.name,
                class: "pb-8",
                label: "Name"
              }, null, 8 /* PROPS */, ["modelValue", "errors"]),
              Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())(_component_text_input, {
                modelValue: $data.form.email,
                "onUpdate:modelValue": _cache[2] || (_cache[2] = $event => ($data.form.email = $event)),
                errors: _ctx.$page.props.errors.email,
                class: "pb-8",
                label: "Email"
              }, null, 8 /* PROPS */, ["modelValue", "errors"])
            ]),
            Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("div", _hoisted_8, [
              Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())(_component_loading_button, {
                loading: $data.sending,
                class: "btn-green ml-auto",
                type: "submit"
              }, {
                default: Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())(() => [
                  _hoisted_9
                ]),
                _: 1
              }, 8 /* PROPS */, ["loading"])
            ])
          ], 32 /* HYDRATE_EVENTS */)
        ])
      ]),
      Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("div", _hoisted_10, [
        Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("div", _hoisted_11, [
          Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("form", {
            onSubmit: _cache[6] || (_cache[6] = Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())((...args) => ($options.updateSettings(...args)), ["prevent"]))
          }, [
            Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("div", _hoisted_12, [
              _hoisted_13,
              _hoisted_14,
              Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("label", _hoisted_15, [
                Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())(Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("input", {
                  id: "newsletter",
                  type: "checkbox",
                  "onUpdate:modelValue": _cache[4] || (_cache[4] = $event => ($data.form.newsletter = $event))
                }, null, 512 /* NEED_PATCH */), [
                  [Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }()), $data.form.newsletter]
                ]),
                _hoisted_16
              ]),
              _hoisted_17,
              Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("label", _hoisted_18, [
                Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())(Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("input", {
                  id: "rainbow",
                  type: "checkbox",
                  "onUpdate:modelValue": _cache[5] || (_cache[5] = $event => ($data.form.settings.code_preview.rainbow = $event))
                }, null, 512 /* NEED_PATCH */), [
                  [Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }()), $data.form.settings.code_preview.rainbow]
                ]),
                _hoisted_19
              ])
            ]),
            Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())("div", _hoisted_20, [
              Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())(_component_loading_button, {
                loading: $data.sending,
                class: "btn-green",
                type: "submit"
              }, {
                default: Object(function webpackMissingModule() { var e = new Error("Cannot find module 'vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())(() => [
                  _hoisted_21
                ]),
                _: 1
              }, 8 /* PROPS */, ["loading"])
            ])
          ], 32 /* HYDRATE_EVENTS */)
        ])
      ])
    ])
  ]))
}

/***/ })

}]);