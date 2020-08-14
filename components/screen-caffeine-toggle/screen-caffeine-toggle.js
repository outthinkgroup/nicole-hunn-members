import NoSleep from "nosleep.js";

const noSleep = new NoSleep();

window.addEventListener("DOMContentLoaded", initScreenCaffeine);
function initScreenCaffeine() {
  if (!document.querySelector(".wake-lock-toggle")) return;

  const allToggles = [...document.querySelectorAll(".wake-lock-toggle input")];
  allToggles.forEach((toggle) =>
    toggle.addEventListener("change", toggleScreenCaffeine)
  );

  rememberSetting();
}
function toggleScreenCaffeine(e) {
  if (e.target.checked) {
    caffeinateScreen();
  } else {
    decaffeinateScreen();
  }
}

function rememberSetting() {
  const savedSetting = window.localStorage.getItem("isScreenCaffeinated");
  if (!savedSetting || savedSetting === "false") return;

  caffeinateScreen();
}

function caffeinateScreen() {
  const allToggles = [...document.querySelectorAll(".wake-lock-toggle input")];
  allToggles.forEach((toggle) => (toggle.checked = true));
  window.localStorage.setItem("isScreenCaffeinated", "true");
}
function decaffeinateScreen() {
  const allToggles = [...document.querySelectorAll(".wake-lock-toggle input")];
  allToggles.forEach((toggle) => (toggle.checked = false));
  window.localStorage.setItem("isScreenCaffeinated", "false");
}
