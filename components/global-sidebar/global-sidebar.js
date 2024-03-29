import { addMenuScrollHint } from "./menu-scroll-hint";
// Opening and closing / showing the sidebar
window.addEventListener("DOMContentLoaded", initGlobalSidebar);
function initGlobalSidebar() {
  runOnDesktop("650px", expandSidebar);
  addHandlerToToggler();
  addMenuScrollHint();
}

function expandSidebar() {
  const isSideBarOpen = localStorage.getItem("isSideBarOpen");
  if (isSideBarOpen === "false") return;
  document.body.dataset.sidebarState = "open";
}
function addHandlerToToggler() {
  const toggleButtons = [
    ...document.querySelectorAll('[data-part="toggle-sidebar"] button'),
  ];
  toggleButtons.forEach((toggleBtn) =>
    toggleBtn.addEventListener("click", toggleHandler)
  );

  function toggleHandler() {
    const containerEl = document.body;
    const attr = "sidebarState";
    const oldState = toggle({ containerEl, attr });
    const isSideBarOpen = typeof oldState === "undefined" ? "true" : "false";
    localStorage.setItem("isSideBarOpen", isSideBarOpen);
  }
}

function toggle({ containerEl, attr }) {
  const state = containerEl.dataset[attr];
  if (state) {
    delete containerEl.dataset[attr];
  } else {
    containerEl.dataset[attr] = "open";
  }
  return state;
}

function runOnDesktop(dimensions, callback) {
  function checkIfDesktop(x) {
    if (!x.matches) {
      callback();
    }
  }

  const isMobile = window.matchMedia(`(max-width: ${dimensions})`);
  checkIfDesktop(isMobile); // Call listener function at run time
  isMobile.addListener(checkIfDesktop); // Attach listener function on state changes
}

window.addEventListener("DOMContentLoaded", initOpenCloseSubMenus);
function initOpenCloseSubMenus() {
  const allMenuItemsWithChildren = [
    ...document.querySelectorAll(".menu-item-has-children"),
  ];
  allMenuItemsWithChildren.forEach((menuItem) => {
    const button = menuItem.querySelector("[data-action]");
    const subMenu = menuItem.querySelector(".sub-menu");
    button.addEventListener("click", handleToggleSubMenu);
    function handleToggleSubMenu() {
      toggle({ containerEl: menuItem, attr: "open" });
    }
  });
}
