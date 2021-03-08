import debounce from "lodash.debounce";
import { scrollHintState } from "./scroll-hint-state.js";

const state = scrollHintState.get();

function addMenuScrollHint() {
  /* INITIALIZE */
  // add hint el to dom
  addHintEl();
  // add listeners
  // - load
  run();
  // - resize
  window.addEventListener("resize", debounce(run));
  // - menu scroll
  state.menuEl().parentElement.addEventListener("scroll", debounce(run));
}

function run() {
  /* orchestration */
  // get dom els
  const menuEl = state.menuEl();
  const utilsEl = state.utilsEl();

  // get heights and positions
  const menuSize = menuEl.getBoundingClientRect();
  const utilsSize = utilsEl.getBoundingClientRect();

  if (menuSize.bottom >= utilsSize.top) {
    toggleState("on");
  } else {
    toggleState("off");
  }
}

function toggleState(newState) {
  if (newState != state.utilsEl().dataset.scrollHint) {
    state.utilsEl().dataset.scrollHint = newState;
    state.setUtilsEl();
  }
}

function addHintEl() {
  const el = document.createElement("div");
  el.innerHTML = /* html */ `<div>Scroll &darr;</div>`;
  el.classList.add("scroll-hint-el");
  state.utilsEl().appendChild(el);
}

export { addMenuScrollHint, scrollHintState };
