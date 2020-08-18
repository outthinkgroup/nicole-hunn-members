window.addEventListener("DOMContentLoaded", initRecipeFilter);

function initRecipeFilter() {
  if (!document.querySelector('[data-action="filter"]')) return;
  const searchBox = document.querySelector('[data-action="filter"]');
  addAllEventHandlers(searchBox);
}

function filterRecipes(e) {
  e.preventDefault();
  const searchVal = e.target.value;

  removeNoResultsEl();

  const grids = document.querySelectorAll("section .grid");

  grids.forEach((grid) => {
    grid.closest("section").dataset.state = "show";
    const recipes = [...grid.querySelectorAll(".product-card")];
    recipes.forEach((recipe) => {
      recipe.dataset.state = "hide";
    });

    const filtered = recipes.filter((recipe) => {
      const title = recipe.querySelector(".product-title h4");
      if (title.innerText.toLowerCase().includes(searchVal.toLowerCase())) {
        return true;
      }
      return false;
    });
    filtered.forEach((recipe) => {
      recipe.dataset.state = "show";
    });
    if (filtered.length === 0) {
      grid.closest("section").dataset.state = "hide";
    }
  });
  const sections = document.querySelectorAll(
    '.recipes section[data-state="show"]'
  );
  if (sections.length === 0) {
    showNoResultsEl();
  }
}

function removeNoResultsEl() {
  const recipes = document.querySelector(".recipe-grids");
  const noResEl = recipes.querySelector(".no-res");
  if (noResEl) {
    noResEl.parentElement.removeChild(noResEl);
  }
}
function showNoResultsEl() {
  const recipes = document.querySelector(".recipe-grids");
  const el = document.createElement("div");
  el.classList.add("no-res");
  el.innerHTML = `<p>No Recipes Found, try a different search</p>`;
  recipes.appendChild(el);
}

function addAllEventHandlers(searchInput) {
  searchInput
    .closest("form")
    .addEventListener("submit", (e) => e.preventDefault());
  searchInput.addEventListener("submit", (e) => e.preventDefault());
  searchInput.addEventListener("input", filterRecipes);
  searchInput.addEventListener("blur", filterRecipes);
}
