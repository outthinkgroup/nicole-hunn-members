import { handleUpdatePrivacyMode } from "./handleUpdatePrivacyMode";
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

  //TODO Clone List
  const forkBtn = document.querySelector('[data-action="fork-list"]');
  if (forkBtn) {
    forkBtn.addEventListener("click", handleListFork);
  }

  //TODO Share List
  const shareBtn = document.querySelector('[data-action="share-list"]');
  if (shareBtn) {
    shareBtn.addEventListener("click", handleListShare);
  }

  const renameBtn = document.querySelector('[data-action="rename-list"]');
  if (renameBtn) {
    renameBtn.addEventListener("click", handleRename);
  }
}
