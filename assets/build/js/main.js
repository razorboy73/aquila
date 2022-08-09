/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/clock/index.js":
/*!*******************************!*\
  !*** ./src/js/clock/index.js ***!
  \*******************************/
/***/ (function() {

(function ($) {
  /**
   * Clock Class.
   */
  class Clock {
    /**
     * Constructor
     */
    constructor() {
      this.initializeClock();
    }
    /**
     * initializeClock
     */


    initializeClock() {
      setInterval(() => this.time(), 1000);
    }
    /**
     * Numpad
     *
     * @param {String} str String
     *
     * @return {string} String
     */


    numPad(str) {
      const cStr = str.toString();

      if (2 > cStr.length) {
        str = 0 + cStr;
      }

      return str;
    }
    /**
     * Time
     */


    time() {
      const currDate = new Date();
      const currSec = currDate.getSeconds();
      const currMin = currDate.getMinutes();
      const curr24Hr = currDate.getHours();
      const ampm = 12 <= curr24Hr ? 'pm' : 'am';
      let currHr = curr24Hr % 12;
      currHr = currHr ? currHr : 12;
      const stringTime = currHr + ':' + this.numPad(currMin) + ':' + this.numPad(currSec);
      const timeEmojiEl = $('#time-emoji');

      if (5 <= curr24Hr && 17 >= curr24Hr) {
        timeEmojiEl.text('🌞');
      } else {
        timeEmojiEl.text('🌜');
      }

      $('#time').text(stringTime);
      $('#ampm').text(ampm);
    }

  }

  new Clock();
})(jQuery);

/***/ }),

/***/ "./src/img/cats.jpg":
/*!**************************!*\
  !*** ./src/img/cats.jpg ***!
  \**************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ("../../src/img/cats.jpg");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
!function() {
"use strict";
/*!************************!*\
  !*** ./src/js/main.js ***!
  \************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _clock__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./clock */ "./src/js/clock/index.js");
/* harmony import */ var _clock__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_clock__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _img_cats_jpg__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../img/cats.jpg */ "./src/img/cats.jpg");
//main.js
 //this is the same thing as import './clock/index';
//


}();
/******/ })()
;
//# sourceMappingURL=main.js.map