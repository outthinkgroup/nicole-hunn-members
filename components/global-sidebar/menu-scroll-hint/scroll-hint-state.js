// A state singleton for creating a global object with the cached dom els
export const scrollHintState = (function State() {
  let instance;

  //Elements we are keeping track of
  let _menuEl;
  let _utilsEl;

  function menuEl() {
    return _menuEl;
  }

  function utilsEl() {
    return _utilsEl;
  }

  function setMenuEl() {
    _menuEl = document.querySelector(
      ".sidebar-menu .menu-sidebar-menu-container"
    );

    return _menuEl;
  }

  function setUtilsEl() {
    _utilsEl = document.querySelector(".bottom-utils");
    return _utilsEl;
  }

  function init() {
    setMenuEl();
    setUtilsEl();

    return {
      menuEl,
      utilsEl,
      setMenuEl,
      setUtilsEl,
    };
  }

  return {
    get() {
      if (!instance) {
        instance = init();
      }
      return instance;
    },
  };
})();
