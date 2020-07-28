<script>
  import CalculatorIcon from "./assests/icons/calculator.svelte";
  import Calculator from "./components/Calculator.svelte";
  import Modal from "./components/Modal.svelte";
  export let appName;

  let isCalcShowing = false;
  function toggleCalc() {
    isCalcShowing = !isCalcShowing;
  }
</script>

<style>

</style>

<button class="nav-button nav-link" on:click={toggleCalc}>
  <span class="icon">
    <CalculatorIcon />
  </span>
  <span class="link-text">{appName}</span>
</button>
{#if isCalcShowing}
  <Modal>
    <Calculator />
  </Modal>
{/if}
