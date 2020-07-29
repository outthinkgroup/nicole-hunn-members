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
