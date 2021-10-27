<script>
  import { onMount, onDestroy } from "svelte";
  import CalculatorIcon from "./assests/icons/calculator.svelte";
  import Calculator from "./components/Calculator.svelte";
  import Modal from "./components/Modal.svelte";
  import { activeRecipeSlug, gramCalc, totalCups } from "./store.js";

  export let appName;
  export let oldFlourCalcURL;
  let isCalcShowing;
  function showCalc(e) {
    e.preventDefault();
    const recipeSlug = oldFlourCalcURL.find((obj) => obj.link === e.target.href)
      .type;
    if (recipeSlug) {
      activeRecipeSlug.set(recipeSlug);
    }
    isCalcShowing = true;
  }
  function toggleCalc() {
    isCalcShowing = !isCalcShowing;
  }
  onMount(() => {
    const linkSelector = oldFlourCalcURL
      .map((obj) => `a[href="${obj.link}"]`)
      .join(", ");
    const allLinks = [...document.querySelectorAll(linkSelector)];
    allLinks.forEach((link) => {
      link.addEventListener("click", showCalc);
    });
  });
  onDestroy(() => {
    const allLinks = [...document.querySelectorAll()];
    allLinks.forEach((link) => {
      link.removeEventListener("click", showCalc);
    });
  });
</script>

<!-- TEMPLATE  -->
<button class="nav-button nav-link" on:click={toggleCalc}>
  <span class="icon">
    <CalculatorIcon />
  </span>
  <span class="link-text">{appName}</span>
</button>
{#if isCalcShowing}
  <Modal on:close={toggleCalc}>
    <Calculator />
  </Modal>
{/if}

<style>

  .nav-button {
    width: calc(100% + 10px);
    padding: 10px;
    justify-content: center;
    display: flex;
    border-radius: 0 20px 20px 0;
  }
</style>
