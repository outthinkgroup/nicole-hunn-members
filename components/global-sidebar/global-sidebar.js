window.addEventListener("DOMContentLoaded", initGlobalSidebar);
function initGlobalSidebar() {
  runOnDesktop("650px", () => (document.body.dataset.sidebarState = "open"));
  addHandlerToToggler();
}
function addHandlerToToggler() {
  const toggleBtn = document.querySelector(
    '[data-part="toggle-sidebar"] button'
  );
  toggleBtn.addEventListener("click", toggleHandler);
  function toggleHandler() {
    const containerEl = document.body;
    const attr = "sidebarState";
    toggle({ containerEl, attr });
  }
}

function toggle({ containerEl, attr }) {
  const state = containerEl.dataset[attr];
  if (state) {
    delete containerEl.dataset[attr];
  } else {
    containerEl.dataset[attr] = "open";
  }
}

function runOnDesktop(dimensions, callback) {
  function checkIfDesktop(x) {
    if (!isMobile.matches) {
      callback();
    }
  }

  var isMobile = window.matchMedia(`(max-width: ${dimensions})`);
  checkIfDesktop(isMobile); // Call listener function at run time
  isMobile.addListener(checkIfDesktop); // Attach listener function on state changes
}
