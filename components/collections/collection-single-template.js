import { handleUpdatePrivacyMode } from "./handleUpdatePrivacyMode";

window.addEventListener("DOMContentLoaded", init);
function init() {
  if (!document.querySelector(".recipe-collections-single-layout")) return;
  //add privacy toggle listener
  const toggle = document.querySelector('[data-action="toggle-privacy-mode"]');
  if (toggle) {
    toggle.addEventListener("change", handleUpdatePrivacyMode);
  }
}
