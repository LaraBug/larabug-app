/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/feedback/feedback.js":
/*!**************************************************!*\
  !*** ./resources/assets/js/feedback/feedback.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var LaraBug =
/*#__PURE__*/
function () {
  function LaraBug() {
    _classCallCheck(this, LaraBug);

    _defineProperty(this, "success", "<p>Thanks for your report, we'll jump right on it!</p>");

    _defineProperty(this, "template", "\n\t\t<div id=\"larabug_feedback_modal\" class=\"larabug-modal\">\n\t\t\t<div class=\"larabug-modal-window\">\n\t\t\t\t<h3>It looks like something went wrong!</h3>\n\t\t\t\t<h5>Dont worry, we're onto it! However if you'd like to tell us what happened please let us know below.</h5>\n\t\t\t\t<hr>\n\t\t\t\t<form id=\"larabug_feedback_modal_form\">\n\t\t\t\t\t<div class=\"larabug-modal-body\" id=\"larabug-modal-body\">\n\t\t\t\t\t\t<label class=\"larabug-input-label\" for=\"larabug_name\">Your Name</label>\n\t\t\t\t\t\t<input class=\"larabug-input\" type=\"text\" id=\"larabug_name\" name=\"name\" placeholder=\"Jane Doe\">\n\t\t\t\t\t\t<label class=\"larabug-input-label\" for=\"larabug_email\">Your Email</label>\n\t\t\t\t\t\t<input class=\"larabug-input\" type=\"email\" id=\"larabug_email\" name=\"email\" placeholder=\"Your email\">\n\t\t\t\t\t\t<label class=\"larabug-input-label\" for=\"larabug_feedback\">Your feedback</label>\n\t\t\t\t\t\t<textarea class=\"larabug-input\" id=\"larabug_feedback\" name=\"feedback\"></textarea>\n\t\t\t\t\t</div>\n\t\t\t\t\t<div class=\"larabug-modal-footer\">\n\t\t\t\t\t\t<button type=\"submit\">Submit Report</button>\n\t\t\t\t\t\t<a class=\"larabug-modal-close\">X</a>\n\t\t\t\t\t\t<div>Error Reporting by LaraBug</div>\n\t\t\t\t\t</div>\n\t\t\t\t</form>\n\t\t\t</div>\n\t\t</div>\n\t");

    _defineProperty(this, "styles", "\n\t\t<style>\n\t\t.larabug-modal-footer {\n\t\t\tdisplay: flex;\n\t\t\tjustify-content: space-between;\n\t\t}\n\t\t.larabug-modal {\n\t\t\tposition: fixed;\n\t\t\ttop: 0;\n\t\t\tleft: 0;\n\t\t\tbottom: 0;\n\t\t\tright: 0;\n\t\t\tdisplay: none;\n\t\t\toverflow: auto;\n\t\t\tbackground-color: #000000;\n\t\t\tbackground-color: rgba(0, 0, 0, 0.7);\n\t\t\tz-index: 9999;\n\t\t}\n\t\t\n\t\t.larabug-input {\n\t\t\tpadding: 0.5rem;\n\t\t\tline-height: 1.5;\n\t\t\tdisplay: block;\n\t\t\twidth: 100%;\n\t\t\tborder-width: 1px;\n\t\t\tcolor: #2d3748;\n\t\t\tbackground-color: #fff;\n\t\t\tborder-radius: 0.25rem;\n\t\t\ttext-align: left;\n\t\t\t-webkit-appearance: none;\n\t\t\t-moz-appearance: none;\n\t\t\tappearance: none;\n\t\t\tposition: relative;\n\t\t}\n\n\t\t.larabug-input-label {\n\t\t\n\t\t}\n\t\t\t\t\n\t\t.larabug-modal-window {\n\t\t\tposition: relative;\n\t\t\tbackground-color: #FFFFFF;\n\t\t\twidth: 50%;\n\t\t\tmargin: 10% auto;\n\t\t\tpadding: 20px;\n\t\t}\n\t\t\n\t\t.larabug-modal-window {\n\t\t\twidth: 75%;\n\t\t}\n\t\t\n\t\t.larabug-modal-close {\n\t\t\tposition: absolute;\n\t\t\ttop: 0;\n\t\t\tright: 0;\n\t\t\tcolor: rgba(0,0,0,0.3);\n\t\t\theight: 30px;\n\t\t\twidth: 30px;\n\t\t\tfont-size: 30px;\n\t\t\tline-height: 30px;\n\t\t\ttext-align: center;\n\t\t}\n\t\t\n\t\t.larabug-modal-close:hover,\n\t\t.larabug-modal-close:focus {\n\t\t\tcolor: #000000;\n\t\t\tcursor: pointer;\n\t\t}\n\t\t\n\t\t.larabug-modal-open {\n\t\t\tdisplay: block;\n\t\t}\n\t\t.larabug-modal-body {\n\t\t\tdisplay: flex;\n\t\t\tflex-direction: column;\n\t\t\tmargin-bottom: 30px;\n\t\t}\n\t\t</style>\n\t");

    _defineProperty(this, "modal", null);

    _defineProperty(this, "id", null);

    _defineProperty(this, "hasInitted", false);
  }

  _createClass(LaraBug, [{
    key: "init",
    value: function init() {
      if (this.hasInitted) {
        return;
      }

      document.body.innerHTML += this.template + this.styles;
      this.modal = document.getElementById('larabug_feedback_modal');
      this.registerCloseHandler();
      this.registerSubmidHandler();
      this.hasInitted = true;
    }
    /** Register handlers for the close button **/

  }, {
    key: "registerCloseHandler",
    value: function registerCloseHandler() {
      var _this = this;

      Array.from(document.getElementsByClassName("larabug-modal-close")).forEach(function (el) {
        el.addEventListener('click', function () {
          _this.modal.classList.remove('larabug-modal-open');
        });
      });
    }
    /** Register a handler for form submission **/

  }, {
    key: "registerSubmidHandler",
    value: function registerSubmidHandler() {
      var _this2 = this;

      document.getElementById('larabug_feedback_modal_form').addEventListener('submit', function (e) {
        e.preventDefault();

        _this2.submit();
      });
    }
  }, {
    key: "showModal",
    value: function showModal(id) {
      this.init();
      this.id = id;
      this.modal.classList.add('larabug-modal-open');
    }
  }, {
    key: "submit",
    value: function submit() {
      var data = {
        name: document.getElementById("larabug_name").value,
        email: document.getElementById("larabug_email").value,
        feedback: document.getElementById("larabug_feedback").value,
        id: this.id
      };
      var xhr = new XMLHttpRequest();
      xhr.open("POST", 'http://larabug-website.test/api/feedback', true);
      xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
      var instance = this;

      xhr.onreadystatechange = function () {
        // Call a function when the state changes.
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
          instance.handleSent();
        }

        ;
      };

      xhr.send(JSON.stringify(data));
    }
  }, {
    key: "handleSent",
    value: function handleSent() {
      document.getElementById('larabug-modal-body').innerHTML = this.success;
    }
  }]);

  return LaraBug;
}();

window.LaraBug = new LaraBug();

/***/ }),

/***/ 1:
/*!********************************************************!*\
  !*** multi ./resources/assets/js/feedback/feedback.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/dennissmink/Workspace/larabug-website/resources/assets/js/feedback/feedback.js */"./resources/assets/js/feedback/feedback.js");


/***/ })

/******/ });