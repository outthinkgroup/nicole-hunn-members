export function handleRename(e) {
  const renameButton = e.currentTarget;
  const parent = renameButton.parentElement;
  const parentHTML = parent.innerHTML;
  showUi(e);
  addHandler();

  function showUi(e) {
    const oldTitle = parent.querySelector("span");
    parent.innerHTML = `
    <form data-action="rename-list" >
      <input type="text" value="${oldTitle.textContent}" name="title"/>
      <button>Rename List</button>
    </form>  
  `;
  }
  function addHandler() {
    const form = document.querySelector('form[data-action="rename-list"]');
    form.addEventListener("submit", handleRenameRecipe);
  }
  function handleRenameRecipe(e) {
    e.preventDefault();
    const title = e.target.querySelector("input").value;
    const list = e.target.closest(".list-single");
    const list_id = list.dataset.listId;
    list.dataset.state = "loading";
    e.currentTarget.removeEventListener("submit", handleRenameRecipe);
    window.__FAVE_RECIPE
      .renameList({ title, list_id })
      .then(function receiveResults(res) {
        if (res.error) {
          list.dataset.state = "error";
          parent.innerHTML = parentHTML;
          if (res.error.message) {
            alert(res.error.message);
          }
        } else {
          list.dataset.state = "idle";
          parent.innerHTML = parentHTML;
          parent.querySelector("span").textContent = title;
        }
      });
  }
}
