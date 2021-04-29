import "./recipe-print-button.scss";
window.addEventListener("DOMContentLoaded", addRecipeButton);

function addRecipeButton() {
  if (!document.querySelector("body.single-recipe")) return;

  const parentModule = document.querySelector(".fl-module-advanced-tabs");
  const mount = parentModule.querySelector(".uabb-tabs-nav");

  const printButton = createPrintButton();
  mount.appendChild(printButton);
}

function createPrintButton() {
  const btn = document.createElement("button");
  btn.setAttribute("type", "button");
  btn.textContent = "Print Recipe";
  btn.classList.add("print-button");
  btn.addEventListener("click", print);
  return btn;
}
function print() {
  window.print();
}
