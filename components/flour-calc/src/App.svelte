<script>
  import CalculatorIcon from "./assests/icons/calculator.svelte";
  import Calculator from "./components/Calculator.svelte";
  import Modal from "./components/Modal.svelte";
  import { isCalcOpen } from "./store.js";
  import { onMount, onDestroy } from "svelte";
  export let appName;
  export let oldFlourCalcURL;
  let isCalcShowing;
  function showCalc(e) {
    e.preventDefault();
    isCalcShowing = true;
  }
  function toggleCalc() {
    isCalcShowing = !isCalcShowing;
  }
  onMount(() => {
    const allLinks = [
      ...document.querySelectorAll(`a[href="${oldFlourCalcURL}"]`),
    ];
    allLinks.forEach((link) => {
      link.addEventListener("click", showCalc);
    });
  });
  onDestroy(() => {
    const allLinks = [
      ...document.querySelectorAll(`a[href="${oldFlourCalcURL}"]`),
    ];
    allLinks.forEach((link) => {
      link.removeEventListener("click", showCalc);
    });
  });
</script>

<style>
  .nav-button {
    width: calc(100% + 10px);
    padding: 10px;
    justify-content: center;
    display: flex;
    border-radius: 0 20px 20px 0;
  }
</style>

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
