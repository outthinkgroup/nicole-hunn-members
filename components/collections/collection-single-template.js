import {
  handleUpdatePrivacyMode,
  privacyModeBus,
} from "./handleUpdatePrivacyMode";
import { handleListFork } from "./handleListFork";
import { handleListShare } from "./handleListShare";
import { handleRename } from "./handleRename";

window.addEventListener("DOMContentLoaded", init);
function init() {
  if (!document.querySelector(".recipe-collections-single-layout")) return;
  //add privacy toggle listener
  const toggle = document.querySelector('[data-action="toggle-privacy-mode"]');
  if (toggle) {
    toggle.addEventListener("change", handleUpdatePrivacyMode);
  }

  const forkBtn = document.querySelector('[data-action="fork-list"]');
  if (forkBtn) {
    forkBtn.addEventListener("click", handleListFork);
  }

  const shareBtn = document.querySelector('[data-action="share-list"]');
  if (shareBtn) {
    shareBtn.addEventListener("click", handleListShare);
  }

  const renameBtn = document.querySelector('[data-action="rename-list"]');
  if (renameBtn) {
    renameBtn.addEventListener("click", handleRename);
  }

  //Any Privacy Status should be updated when privacy changes
  privacyModeBus.listenFor("privacy-change", updateAllStatuses);
  function updateAllStatuses(e) {
    console.log(e);
    const allStatuses = [...document.querySelectorAll(".status")];
    allStatuses.forEach((el) => {
      el.textContent = e.detail.status;
    });
  }
}
