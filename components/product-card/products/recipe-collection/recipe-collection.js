import Notice from "./notification";

window.addEventListener("DOMContentLoaded", initRecipeCollectionScript);
function initRecipeCollectionScript() {
  if (!document.querySelector(".product-card.post-type-lists")) return;

  const allCards = [
    ...document.querySelectorAll(".product-card.post-type-lists"),
  ];
  allCards.forEach((collectionCard) => {
    const showDeleteActionBtn = collectionCard.querySelector(
      '[data-action="warn-delete-list"]'
    );
    if (showDeleteActionBtn) {
      showDeleteActionBtn.addEventListener("click", handleShowDeleteUI);
    }

    const privacyModeToggle = collectionCard.querySelector(
      '[data-action="toggle-privacy-mode"]'
    );
    if (privacyModeToggle) {
      privacyModeToggle.addEventListener("change", handleUpdatePrivacyMode);
    }
  });
}

function handleShowDeleteUI(e) {
  const item = e.target.closest(".list-item");
  const parentElement = item.parentElement;
  const { listId } = item.dataset;
  const { userId } = WP;
  if (window.confirm("Are you sure you want to delete this collection")) {
    item.dataset.state = "loading";
    window.__FAVE_RECIPE.deleteList(listId, userId).then((res) => {
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
}
//add default new list link
window.__FAVE_RECIPE.newListItemLink = "/recipes";

function handleUpdatePrivacyMode(e) {
  const toggle = e.currentTarget;
  const list = toggle.closest(".list-item");

  const { listId: list_id } = list.dataset;
  const { userId: user_id } = WP;

  const new_status = getNewStatus(toggle);
  const notice = new Notice(toggle.parentElement, [0, -25]);
  list.dataset.state = "loading";
  notice.setNotice(`changing to ${new_status}`);
  window.__FAVE_RECIPE
    .changeListPrivacyMode({ user_id, list_id, status: new_status })
    .then(function waitForResponse(res) {
      if (res.error) {
        const { message } = res.error;
        if (message) {
          alert(message);
        }
        list.dataset.state = "error";
      } else {
        notice.setNotice(`collection is now ${new_status}`);
        list.dataset.state = "idle";
        toggle.closest("[data-status]").dataset.status = new_status;
      }
    });
}

//checked = `publish`
//unchecked = `private`
function getNewStatus(checkboxEl) {
  const { checked } = checkboxEl;
  return toggleStatus(checked);
}
function toggleStatus(checked) {
  return checked == true ? "publish" : "private";
}
