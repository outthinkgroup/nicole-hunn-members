import "./global-sidebar/global-sidebar.js";
import "./top-bar/top-bar.js";
import "./product-card/products/recipe-collection/recipe-collection.js";
import "./product-card/products/recipes/collection-single-recipes.js";
import "./learndash/course-sidebar.js";
import "./dashboard-carousel/dashboard-carousel.js";
import "./member.scss";
import "./collections/collection-single-template.js";

// TESTING

window.addEventListener("DOMContentLoaded", function () {
  const newNoteForm = document.querySelector("#commentform");
  newNoteForm.addEventListener("submit", submitNewNote);

  const notesEl = document.querySelector("#notes");
  console.log("notesEl", notesEl);

  notesEl.addEventListener("click", deleteNote);
});

let canSubmit = true;
function submitNewNote(e) {
  e.preventDefault();
  if (canSubmit == false) return;
  const form = e.currentTarget;
  canSubmit = false;
  form.dataset.isLoading = !canSubmit;
  const data = new FormData(form);
  form.setAttribute("disabled", "true");
  fetch(form.action, {
    method: "POST",
    mode: "cors",
    credentials: "same-origin", // include, *same-origin, omit
    body: data,
  })
    .then((res) => res.text())
    .then((res) => {
      const parser = new DOMParser();
      const doc = parser.parseFromString(res, "text/html");
      const newNotes = doc.querySelector("#notes");
      const outDatedNotes = document.querySelector("#notes");
      outDatedNotes.outerHTML = `${newNotes.outerHTML}`;

      const oldNonce = document.querySelector(
        "#_wp_unfiltered_html_comment_disabled"
      );
      const newNonce = doc.querySelector(
        "#_wp_unfiltered_html_comment_disabled"
      );
      oldNonce.outerHTML = newNonce.outerHTML;
    })
    .then((res) => {
      canSubmit = true;
      form.dataset.isLoading = !canSubmit;
      form.reset();
    });
}

function deleteNote(e) {
  if (!e.target.classList.contains("delete")) return;

  const button = e.target;
  const url = button.dataset.url;

  // tell wp to delete
  fetch(url);

  // we will delete it instantly from dom
  const note = button.closest(".note");
  note.parentElement.removeChild(note);
}
