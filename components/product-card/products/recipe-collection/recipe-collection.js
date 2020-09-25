window.addEventListener("DOMContentLoaded", initRecipeCollectionScript);
function initRecipeCollectionScript() {
  if (!document.querySelector(".product-card.post-type-lists")) return;

  const allCards = [
    ...document.querySelectorAll(".product-card.post-type-lists"),
  ];
  allCards.forEach((collectionCard) => {
    showDeleteActionBtn = collectionCard.querySelector(
      '[data-action="warn-delete-list"]'
    );
    showDeleteActionBtn.addEventListener("click", handleShowDeleteUI);
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
        if (err.message) {
          alert(err.message);
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
