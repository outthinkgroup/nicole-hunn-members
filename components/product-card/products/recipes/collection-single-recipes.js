window.addEventListener("DOMContentLoaded", initRecipeProductCard);
function initRecipeProductCard() {
  if (!document.querySelector(".recipe-collections-single-layout")) return;

  const allCards = [
    ...document.querySelectorAll(
      ".recipe-collections-single-layout .product-card.post-type-recipe "
    ),
  ];
  allCards.forEach((recipeCard) => {
    deleteBtn = recipeCard.querySelector('[data-action="delete-from-list"]');
    deleteBtn.addEventListener("click", handleDeleteFromList);
  });
}

function handleDeleteFromList(e) {
  const { listId, recipeId } = e.target.dataset;
  const { deleteRecipeFromList } = __FAVE_RECIPE;
  const card = e.target.closest(".product-card");
  const originalStyle = card.style;
  const list = card.closest("ul");
  card.style = "display:none";
  deleteRecipeFromList({ listId, recipeId }).then((res) => {
    if (res.error) {
      if (err.message) {
        card.style = originalStyle;
        alert(err.message);
      }
    } else {
      list.removeChild(card);
    }
  });
}
