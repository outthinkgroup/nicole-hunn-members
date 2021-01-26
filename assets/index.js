// modules are defined as an array
// [ module function, map of requires ]
//
// map of requires is short require name -> numeric require
//
// anything defined in a previous bundle is accessed via the
// orig method which is the require for previous bundles
parcelRequire = (function (modules, cache, entry, globalName) {
  // Save the require from previous bundle to this closure if any
  var previousRequire = typeof parcelRequire === 'function' && parcelRequire;
  var nodeRequire = typeof require === 'function' && require;

  function newRequire(name, jumped) {
    if (!cache[name]) {
      if (!modules[name]) {
        // if we cannot find the module within our internal map or
        // cache jump to the current global require ie. the last bundle
        // that was added to the page.
        var currentRequire = typeof parcelRequire === 'function' && parcelRequire;
        if (!jumped && currentRequire) {
          return currentRequire(name, true);
        }

        // If there are other bundles on this page the require from the
        // previous one is saved to 'previousRequire'. Repeat this as
        // many times as there are bundles until the module is found or
        // we exhaust the require chain.
        if (previousRequire) {
          return previousRequire(name, true);
        }

        // Try the node require function if it exists.
        if (nodeRequire && typeof name === 'string') {
          return nodeRequire(name);
        }

        var err = new Error('Cannot find module \'' + name + '\'');
        err.code = 'MODULE_NOT_FOUND';
        throw err;
      }

      localRequire.resolve = resolve;
      localRequire.cache = {};

      var module = cache[name] = new newRequire.Module(name);

      modules[name][0].call(module.exports, localRequire, module, module.exports, this);
    }

    return cache[name].exports;

    function localRequire(x){
      return newRequire(localRequire.resolve(x));
    }

    function resolve(x){
      return modules[name][1][x] || x;
    }
  }

  function Module(moduleName) {
    this.id = moduleName;
    this.bundle = newRequire;
    this.exports = {};
  }

  newRequire.isParcelRequire = true;
  newRequire.Module = Module;
  newRequire.modules = modules;
  newRequire.cache = cache;
  newRequire.parent = previousRequire;
  newRequire.register = function (id, exports) {
    modules[id] = [function (require, module) {
      module.exports = exports;
    }, {}];
  };

  var error;
  for (var i = 0; i < entry.length; i++) {
    try {
      newRequire(entry[i]);
    } catch (e) {
      // Save first error but execute all entries
      if (!error) {
        error = e;
      }
    }
  }

  if (entry.length) {
    // Expose entry point to Node, AMD or browser globals
    // Based on https://github.com/ForbesLindesay/umd/blob/master/template.js
    var mainExports = newRequire(entry[entry.length - 1]);

    // CommonJS
    if (typeof exports === "object" && typeof module !== "undefined") {
      module.exports = mainExports;

    // RequireJS
    } else if (typeof define === "function" && define.amd) {
     define(function () {
       return mainExports;
     });

    // <script>
    } else if (globalName) {
      this[globalName] = mainExports;
    }
  }

  // Override the current require with this new one
  parcelRequire = newRequire;

  if (error) {
    // throw error from earlier, _after updating parcelRequire_
    throw error;
  }

  return newRequire;
})({"global-sidebar/global-sidebar.js":[function(require,module,exports) {
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && Symbol.iterator in Object(iter)) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

window.addEventListener("DOMContentLoaded", initGlobalSidebar);

function initGlobalSidebar() {
  runOnDesktop("650px", expandSidebar);
  addHandlerToToggler();
}

function expandSidebar() {
  isSideBarOpen = localStorage.getItem("isSideBarOpen");
  if (isSideBarOpen === "false") return;
  document.body.dataset.sidebarState = "open";
}

function addHandlerToToggler() {
  var toggleButtons = _toConsumableArray(document.querySelectorAll('[data-part="toggle-sidebar"] button'));

  toggleButtons.forEach(function (toggleBtn) {
    return toggleBtn.addEventListener("click", toggleHandler);
  });

  function toggleHandler() {
    var containerEl = document.body;
    var attr = "sidebarState";
    var oldState = toggle({
      containerEl: containerEl,
      attr: attr
    });
    var isSideBarOpen = typeof oldState === "undefined" ? "true" : "false";
    localStorage.setItem("isSideBarOpen", isSideBarOpen);
  }
}

function toggle(_ref) {
  var containerEl = _ref.containerEl,
      attr = _ref.attr;
  var state = containerEl.dataset[attr];

  if (state) {
    delete containerEl.dataset[attr];
  } else {
    containerEl.dataset[attr] = "open";
  }

  return state;
}

function runOnDesktop(dimensions, callback) {
  function checkIfDesktop(x) {
    if (!isMobile.matches) {
      callback();
    }
  }

  var isMobile = window.matchMedia("(max-width: ".concat(dimensions, ")"));
  checkIfDesktop(isMobile); // Call listener function at run time

  isMobile.addListener(checkIfDesktop); // Attach listener function on state changes
}

window.addEventListener("DOMContentLoaded", initOpenCloseSubMenus);

function initOpenCloseSubMenus() {
  var allMenuItemsWithChildren = _toConsumableArray(document.querySelectorAll(".menu-item-has-children"));

  allMenuItemsWithChildren.forEach(function (menuItem) {
    var button = menuItem.querySelector("[data-action]");
    var subMenu = menuItem.querySelector(".sub-menu");
    button.addEventListener("click", handleToggleSubMenu);

    function handleToggleSubMenu() {
      toggle({
        containerEl: menuItem,
        attr: "open"
      });
    }
  });
}
},{}],"top-bar/top-bar.js":[function(require,module,exports) {
window.addEventListener("DOMContentLoaded", initNotificationAlert);

function initNotificationAlert() {
  var notificationButton = document.querySelector('[data-part="notifications"]');
  notificationButton.addEventListener("click", showRecentUpdates);
}

function showRecentUpdates(e) {
  var button = e.target;
  clearUserNotificationMeta(button);
  toggleUpdatesCard(button);
}

function clearUserNotificationMeta(button) {
  var dot = button.querySelector(".dot");
  if (dot.dataset.notify == "false") return;
  dot.dataset.notify = "false";
  var data = {
    action: "nhm_clear_notification",
    notified: true
  };
  fetch("".concat(WP.ajaxUrl), {
    method: "POST",
    mode: "cors",
    credentials: "same-origin",
    // include, *same-origin, omit
    headers: {
      "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
    },
    body: toQueryString(data)
  }).then(function (res) {
    return console.log(res);
  });
}

function toggleUpdatesCard(button) {
  var wrapperEl = button.closest(".notification-wrapper");
  var state = wrapperEl.dataset.state;

  if (state === "opened") {
    closeUpdatesCard(wrapperEl);
  } else {
    openUpdatesCard(wrapperEl);
  }
}

function openUpdatesCard(el) {
  console.log("ran");
  el.dataset.state = "opened";
  document.body.addEventListener("click", handleCloseUpdatesCard);
}

function closeUpdatesCard(el) {
  el.dataset.state = "closed";
  document.body.removeEventListener("click", handleCloseUpdatesCard);
}

function handleCloseUpdatesCard(e) {
  console.log("ran handleCloseUpdatesCard");
  if (e.target.classList.contains("notification-wrapper") || e.target.closest(".notification-wrapper")) return;
  var wrapper = document.querySelector(".notification-wrapper");
  closeUpdatesCard(wrapper);
}

function toQueryString(data) {
  var urlSearhParams = new URLSearchParams(data);
  var queryString = urlSearhParams.toString();
  return queryString;
}
},{}],"product-card/products/recipe-collection/notification.js":[function(require,module,exports) {
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var Notice = function Notice(el, _ref) {
  var _this = this;

  var _ref2 = _slicedToArray(_ref, 2),
      xAxis = _ref2[0],
      yAxis = _ref2[1];

  _classCallCheck(this, Notice);

  _defineProperty(this, "setNotice", function (msg) {
    _this.noticeEl.textContent = msg;

    if (!document.body.contains(_this.noticeEl)) {
      document.body.appendChild(_this.noticeEl);

      _this.noticeEl.style.setProperty("left", "".concat(_this.position.left, "px"));

      _this.noticeEl.style.setProperty("top", "".concat(_this.position.top, "px"));
    }

    if (_this.timer) clearTimeout(_this.timer);
    _this.timer = setTimeout(_this.removeNotice, 3000);
  });

  _defineProperty(this, "removeNotice", function () {
    clearTimeout(_this.timer); // if (document.body.contains(this.noticeEl)) {

    _this.noticeEl.parentElement.removeChild(_this.noticeEl); // }

  });

  this.el = el;
  this.placement = {
    left: xAxis,
    top: yAxis
  };

  var _this$el$getBoundingC = this.el.getBoundingClientRect(),
      top = _this$el$getBoundingC.y,
      left = _this$el$getBoundingC.x;

  console.log(this.el.getBoundingClientRect());
  this.position = {
    top: window.pageYOffset + (top + this.placement.top * -1),
    left: left + this.placement.left
  };
  this.noticeEl = document.createElement("div");
  this.noticeEl.classList.add("temp-notice");
  this.noticeEl.style.position = "absolute";
};

exports.default = Notice;
},{}],"product-card/products/recipe-collection/recipe-collection.js":[function(require,module,exports) {
"use strict";

var _notification = _interopRequireDefault(require("./notification"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && Symbol.iterator in Object(iter)) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

window.addEventListener("DOMContentLoaded", initRecipeCollectionScript);

function initRecipeCollectionScript() {
  if (!document.querySelector(".product-card.post-type-lists")) return;

  var allCards = _toConsumableArray(document.querySelectorAll(".product-card.post-type-lists"));

  allCards.forEach(function (collectionCard) {
    var showDeleteActionBtn = collectionCard.querySelector('[data-action="warn-delete-list"]');

    if (showDeleteActionBtn) {
      showDeleteActionBtn.addEventListener("click", handleShowDeleteUI);
    }

    var privacyModeToggle = collectionCard.querySelector('[data-action="toggle-privacy-mode"]');

    if (privacyModeToggle) {
      privacyModeToggle.addEventListener("change", handleUpdatePrivacyMode);
    }
  });
}

function handleShowDeleteUI(e) {
  var item = e.target.closest(".list-item");
  var parentElement = item.parentElement;
  var listId = item.dataset.listId;
  var _WP = WP,
      userId = _WP.userId;

  if (window.confirm("Are you sure you want to delete this collection")) {
    item.dataset.state = "loading";

    window.__FAVE_RECIPE.deleteList(listId, userId).then(function (res) {
      if (res.error) {
        if (res.error.message) {
          alert(res.error.message);
        }

        item.dataset.state = "error";
      } else {
        if (parentElement.contains(item)) {
          parentElement.removeChild(item);
        }
      }
    });
  }
} //add default new list link


window.__FAVE_RECIPE.newListItemLink = "/recipes";

function handleUpdatePrivacyMode(e) {
  var toggle = e.currentTarget;
  var list = toggle.closest(".list-item");
  var list_id = list.dataset.listId;
  var _WP2 = WP,
      user_id = _WP2.userId;
  var new_status = getNewStatus(toggle);
  var notice = new _notification.default(toggle.parentElement, [0, -25]);
  list.dataset.state = "loading";
  notice.setNotice("changing to ".concat(new_status));

  window.__FAVE_RECIPE.changeListPrivacyMode({
    user_id: user_id,
    list_id: list_id,
    status: new_status
  }).then(function waitForResponse(res) {
    if (res.error) {
      var message = res.error.message;

      if (message) {
        alert(message);
      }

      list.dataset.state = "error";
    } else {
      notice.setNotice("collection is now ".concat(new_status));
      list.dataset.state = "idle";
      toggle.closest("[data-status]").dataset.status = new_status;
    }
  });
} //checked = `publish`
//unchecked = `private`


function getNewStatus(checkboxEl) {
  var checked = checkboxEl.checked;
  return toggleStatus(checked);
}

function toggleStatus(checked) {
  return checked == true ? "publish" : "private";
}
},{"./notification":"product-card/products/recipe-collection/notification.js"}],"product-card/products/recipes/collection-single-recipes.js":[function(require,module,exports) {
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && Symbol.iterator in Object(iter)) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

window.addEventListener("DOMContentLoaded", initRecipeProductCard);

function initRecipeProductCard() {
  if (!document.querySelector(".recipe-collections-single-layout")) return;

  var allCards = _toConsumableArray(document.querySelectorAll(".recipe-collections-single-layout .product-card.post-type-recipe "));

  allCards.forEach(function (recipeCard) {
    deleteBtn = recipeCard.querySelector('[data-action="delete-from-list"]');
    deleteBtn.addEventListener("click", handleDeleteFromList);
  });
}

function handleDeleteFromList(e) {
  var _e$target$dataset = e.target.dataset,
      listId = _e$target$dataset.listId,
      recipeId = _e$target$dataset.recipeId;
  var _FAVE_RECIPE = __FAVE_RECIPE,
      deleteRecipeFromList = _FAVE_RECIPE.deleteRecipeFromList;
  var card = e.target.closest(".product-card");
  var originalStyle = card.style;
  var list = card.closest("ul");
  card.style = "display:none";
  deleteRecipeFromList({
    listId: listId,
    recipeId: recipeId
  }).then(function (res) {
    if (res.error) {
      if (err.message) {
        card.style = originalStyle;
        alert(err.message);
      }
    } else {
      list.removeChild(card);
    }
  });
}
},{}],"learndash/course-sidebar.js":[function(require,module,exports) {
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && Symbol.iterator in Object(iter)) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

window.addEventListener("load", courseScriptsInit);

function courseScriptsInit() {
  if (!document.getElementById("course_navigation")) return;

  var modules = _toConsumableArray(document.querySelectorAll(".learndash_navigation_lesson_topics_list > div"));

  modules.forEach(function (topic, index) {
    var lessons = _toConsumableArray(topic.querySelectorAll(".topic_item"));

    var totalLessons = lessons.length;
    var completedLessons = lessons.filter(function (lesson) {
      return lesson.querySelector(".topic-completed");
    });
    var totalCompletedLessons = completedLessons.length > 0 ? completedLessons.length : 0;
    var percentCompleted = "".concat(Math.floor(totalCompletedLessons / totalLessons * 100));
    topic.style.setProperty("--module-progress", percentCompleted);

    if (percentCompleted === "100") {
      topic.classList.add("completed");
    }
  });
}
},{}],"dashboard-carousel/dashboard-carousel.js":[function(require,module,exports) {
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && Symbol.iterator in Object(iter)) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

window.addEventListener("DOMContentLoaded", init);

function init() {
  var wrapper = document.querySelector(".carousel-wrapper");

  if (!wrapper) {
    return;
  }

  var _autoNext = autoNext(),
      _autoNext2 = _slicedToArray(_autoNext, 3),
      startAutoNext = _autoNext2[0],
      stopAutoNext = _autoNext2[1],
      resetAutoNext = _autoNext2[2]; //setup initial state


  wrapper.dataset.state = "0";

  var slides = _toConsumableArray(wrapper.querySelectorAll(".slide"));

  var dots = _toConsumableArray(document.querySelectorAll(".navigation button"));

  allSlideStateInactive();
  slides[0].dataset.state = "active";
  slides[1].dataset.state = "next";
  slides[slides.length - 1].dataset.state = "previous";
  slides.forEach(function (slide, i) {
    slide.dataset.slide = i;
    slide.addEventListener("mouseenter", stopAutoNext);
    slide.addEventListener("mouseleave", startAutoNext);
  });
  startAutoNext();
  dots[0].dataset.state = "active";
  dots.forEach(function (dot, index) {
    return dot.addEventListener("click", function () {
      return resetAutoNext(function () {
        return navigateDirectly(index);
      });
    });
  });

  function next() {
    navigateByOne(1);
  }

  function navigateByOne(dir) {
    var wrapperEl = document.querySelector(".carousel-wrapper");
    var currentState = Number(wrapperEl.dataset.state);
    var nextState = getNextState(currentState, dir);
    allSlideStateInactive();
    changeState({
      wrapperEl: wrapperEl,
      nextState: nextState,
      dir: dir
    });
  }

  function navigateDirectly(slideIndex) {
    var wrapperEl = document.querySelector(".carousel-wrapper");
    var nextState = Number(slideIndex);
    changeState({
      wrapperEl: wrapperEl,
      nextState: nextState,
      dir: 1
    });
  }

  function changeState(_ref) {
    var wrapperEl = _ref.wrapperEl,
        nextState = _ref.nextState,
        dir = _ref.dir;
    //change data attr to show the next slides
    var activeSlide = wrapperEl.querySelector("[data-slide=\"".concat(nextState, "\"]"));
    activeSlide.dataset.state = "active";
    var nextSlide = wrapperEl.querySelector("[data-slide=\"".concat(getNextState(nextState, dir), "\"]"));
    nextSlide.dataset.state = "next";
    var previousSlide = wrapperEl.querySelector("[data-slide=\"".concat(getNextState(nextState, dir * -1), "\"]"));
    previousSlide.dataset.state = "previous";
    dots.find(function (_, i) {
      return i == nextState;
    }).dataset.state = "active";
    wrapperEl.dataset.state = nextState;
  }

  function allSlideStateInactive() {
    function removeState(el) {
      el.dataset.state = "inactive";
    }

    slides.forEach(removeState);
    dots.forEach(removeState);
  }

  function getNextState(currentState, dir) {
    if (dir == 1) {
      var state = currentState < slides.length - 1 ? currentState + dir : 0;
      return state;
    }

    if (dir == -1) {
      return currentState <= 0 ? slides.length - 1 : currentState + dir;
    }
  } //responsible for showing the next slide automatically, stopping, and resetting


  function autoNext() {
    var timer;

    function start() {
      timer = setTimeout(function goNext() {
        next();
        start();
      }, 5000);
    }

    function stop() {
      clearTimeout(timer);
    }

    function resetAfter(cb) {
      stop();
      cb();
      start();
    }

    return [start, stop, resetAfter];
  }
}
},{}],"../node_modules/parcel/src/builtins/bundle-url.js":[function(require,module,exports) {
var bundleURL = null;

function getBundleURLCached() {
  if (!bundleURL) {
    bundleURL = getBundleURL();
  }

  return bundleURL;
}

function getBundleURL() {
  // Attempt to find the URL of the current script and use that as the base URL
  try {
    throw new Error();
  } catch (err) {
    var matches = ('' + err.stack).match(/(https?|file|ftp|chrome-extension|moz-extension):\/\/[^)\n]+/g);

    if (matches) {
      return getBaseURL(matches[0]);
    }
  }

  return '/';
}

function getBaseURL(url) {
  return ('' + url).replace(/^((?:https?|file|ftp|chrome-extension|moz-extension):\/\/.+)\/[^/]+$/, '$1') + '/';
}

exports.getBundleURL = getBundleURLCached;
exports.getBaseURL = getBaseURL;
},{}],"../node_modules/parcel/src/builtins/css-loader.js":[function(require,module,exports) {
var bundle = require('./bundle-url');

function updateLink(link) {
  var newLink = link.cloneNode();

  newLink.onload = function () {
    link.remove();
  };

  newLink.href = link.href.split('?')[0] + '?' + Date.now();
  link.parentNode.insertBefore(newLink, link.nextSibling);
}

var cssTimeout = null;

function reloadCSS() {
  if (cssTimeout) {
    return;
  }

  cssTimeout = setTimeout(function () {
    var links = document.querySelectorAll('link[rel="stylesheet"]');

    for (var i = 0; i < links.length; i++) {
      if (bundle.getBaseURL(links[i].href) === bundle.getBundleURL()) {
        updateLink(links[i]);
      }
    }

    cssTimeout = null;
  }, 50);
}

module.exports = reloadCSS;
},{"./bundle-url":"../node_modules/parcel/src/builtins/bundle-url.js"}],"member.scss":[function(require,module,exports) {
var reloadCSS = require('_css_loader');

module.hot.dispose(reloadCSS);
module.hot.accept(reloadCSS);
},{"_css_loader":"../node_modules/parcel/src/builtins/css-loader.js"}],"index.js":[function(require,module,exports) {
"use strict";

require("./global-sidebar/global-sidebar.js");

require("./top-bar/top-bar.js");

require("./product-card/products/recipe-collection/recipe-collection.js");

require("./product-card/products/recipes/collection-single-recipes.js");

require("./learndash/course-sidebar.js");

require("./dashboard-carousel/dashboard-carousel.js");

require("./member.scss");

console.log("hello");
},{"./global-sidebar/global-sidebar.js":"global-sidebar/global-sidebar.js","./top-bar/top-bar.js":"top-bar/top-bar.js","./product-card/products/recipe-collection/recipe-collection.js":"product-card/products/recipe-collection/recipe-collection.js","./product-card/products/recipes/collection-single-recipes.js":"product-card/products/recipes/collection-single-recipes.js","./learndash/course-sidebar.js":"learndash/course-sidebar.js","./dashboard-carousel/dashboard-carousel.js":"dashboard-carousel/dashboard-carousel.js","./member.scss":"member.scss"}],"../node_modules/parcel/src/builtins/hmr-runtime.js":[function(require,module,exports) {
var global = arguments[3];
var OVERLAY_ID = '__parcel__error__overlay__';
var OldModule = module.bundle.Module;

function Module(moduleName) {
  OldModule.call(this, moduleName);
  this.hot = {
    data: module.bundle.hotData,
    _acceptCallbacks: [],
    _disposeCallbacks: [],
    accept: function (fn) {
      this._acceptCallbacks.push(fn || function () {});
    },
    dispose: function (fn) {
      this._disposeCallbacks.push(fn);
    }
  };
  module.bundle.hotData = null;
}

module.bundle.Module = Module;
var checkedAssets, assetsToAccept;
var parent = module.bundle.parent;

if ((!parent || !parent.isParcelRequire) && typeof WebSocket !== 'undefined') {
  var hostname = "" || location.hostname;
  var protocol = location.protocol === 'https:' ? 'wss' : 'ws';
  var ws = new WebSocket(protocol + '://' + hostname + ':' + "49609" + '/');

  ws.onmessage = function (event) {
    checkedAssets = {};
    assetsToAccept = [];
    var data = JSON.parse(event.data);

    if (data.type === 'update') {
      var handled = false;
      data.assets.forEach(function (asset) {
        if (!asset.isNew) {
          var didAccept = hmrAcceptCheck(global.parcelRequire, asset.id);

          if (didAccept) {
            handled = true;
          }
        }
      }); // Enable HMR for CSS by default.

      handled = handled || data.assets.every(function (asset) {
        return asset.type === 'css' && asset.generated.js;
      });

      if (handled) {
        console.clear();
        data.assets.forEach(function (asset) {
          hmrApply(global.parcelRequire, asset);
        });
        assetsToAccept.forEach(function (v) {
          hmrAcceptRun(v[0], v[1]);
        });
      } else if (location.reload) {
        // `location` global exists in a web worker context but lacks `.reload()` function.
        location.reload();
      }
    }

    if (data.type === 'reload') {
      ws.close();

      ws.onclose = function () {
        location.reload();
      };
    }

    if (data.type === 'error-resolved') {
      console.log('[parcel] ✨ Error resolved');
      removeErrorOverlay();
    }

    if (data.type === 'error') {
      console.error('[parcel] 🚨  ' + data.error.message + '\n' + data.error.stack);
      removeErrorOverlay();
      var overlay = createErrorOverlay(data);
      document.body.appendChild(overlay);
    }
  };
}

function removeErrorOverlay() {
  var overlay = document.getElementById(OVERLAY_ID);

  if (overlay) {
    overlay.remove();
  }
}

function createErrorOverlay(data) {
  var overlay = document.createElement('div');
  overlay.id = OVERLAY_ID; // html encode message and stack trace

  var message = document.createElement('div');
  var stackTrace = document.createElement('pre');
  message.innerText = data.error.message;
  stackTrace.innerText = data.error.stack;
  overlay.innerHTML = '<div style="background: black; font-size: 16px; color: white; position: fixed; height: 100%; width: 100%; top: 0px; left: 0px; padding: 30px; opacity: 0.85; font-family: Menlo, Consolas, monospace; z-index: 9999;">' + '<span style="background: red; padding: 2px 4px; border-radius: 2px;">ERROR</span>' + '<span style="top: 2px; margin-left: 5px; position: relative;">🚨</span>' + '<div style="font-size: 18px; font-weight: bold; margin-top: 20px;">' + message.innerHTML + '</div>' + '<pre>' + stackTrace.innerHTML + '</pre>' + '</div>';
  return overlay;
}

function getParents(bundle, id) {
  var modules = bundle.modules;

  if (!modules) {
    return [];
  }

  var parents = [];
  var k, d, dep;

  for (k in modules) {
    for (d in modules[k][1]) {
      dep = modules[k][1][d];

      if (dep === id || Array.isArray(dep) && dep[dep.length - 1] === id) {
        parents.push(k);
      }
    }
  }

  if (bundle.parent) {
    parents = parents.concat(getParents(bundle.parent, id));
  }

  return parents;
}

function hmrApply(bundle, asset) {
  var modules = bundle.modules;

  if (!modules) {
    return;
  }

  if (modules[asset.id] || !bundle.parent) {
    var fn = new Function('require', 'module', 'exports', asset.generated.js);
    asset.isNew = !modules[asset.id];
    modules[asset.id] = [fn, asset.deps];
  } else if (bundle.parent) {
    hmrApply(bundle.parent, asset);
  }
}

function hmrAcceptCheck(bundle, id) {
  var modules = bundle.modules;

  if (!modules) {
    return;
  }

  if (!modules[id] && bundle.parent) {
    return hmrAcceptCheck(bundle.parent, id);
  }

  if (checkedAssets[id]) {
    return;
  }

  checkedAssets[id] = true;
  var cached = bundle.cache[id];
  assetsToAccept.push([bundle, id]);

  if (cached && cached.hot && cached.hot._acceptCallbacks.length) {
    return true;
  }

  return getParents(global.parcelRequire, id).some(function (id) {
    return hmrAcceptCheck(global.parcelRequire, id);
  });
}

function hmrAcceptRun(bundle, id) {
  var cached = bundle.cache[id];
  bundle.hotData = {};

  if (cached) {
    cached.hot.data = bundle.hotData;
  }

  if (cached && cached.hot && cached.hot._disposeCallbacks.length) {
    cached.hot._disposeCallbacks.forEach(function (cb) {
      cb(bundle.hotData);
    });
  }

  delete bundle.cache[id];
  bundle(id);
  cached = bundle.cache[id];

  if (cached && cached.hot && cached.hot._acceptCallbacks.length) {
    cached.hot._acceptCallbacks.forEach(function (cb) {
      cb();
    });

    return true;
  }
}
},{}]},{},["../node_modules/parcel/src/builtins/hmr-runtime.js","index.js"], null)
//# sourceMappingURL=index.js.map