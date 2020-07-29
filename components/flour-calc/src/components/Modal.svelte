<script>
  import { createEventDispatcher } from "svelte";
  import CloseIcon from "../assests/icons/close.svelte";
  const dispatch = createEventDispatcher();

  function handleClose() {
    dispatch("close");
  }
</script>

<style>
  .modal {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    height: 550px;
    width: 300px;
    z-index: 1;
  }
  .modal-bg {
    background: #fff;
    box-shadow: 0 50px 100px rgba(50, 50, 93, 0.1),
      0 15px 35px rgba(50, 50, 93, 0.15), 0 5px 15px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    padding: 20px;
    padding-bottom: 10px;
    overflow: hidden;
    position: relative;
  }
  @media (min-width: 650px) {
    .modal {
      transform: none;
      position: absolute;
      left: calc(100% + 30px);
      bottom: 50%;
      top: unset;
    }

    .modal:after {
      position: absolute;
      bottom: 20px;
      left: -17px;
      width: 0;

      content: "";
      height: 0;
      border-top: 20px solid transparent;
      border-bottom: 20px solid transparent;

      border-right: 20px solid white;
    }
  }
  button {
    position: absolute;
    right: 5px;
    top: 5px;
    z-index: 10;
    background: transparent;
    color: black;
    padding: 0;
    font-size: 10px;
    width: 20px;
    height: 20px;
    line-height: 0;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  button:hover {
    background: #efefef;
  }
</style>

<div class="modal">
  <button on:click={handleClose}>
    <span>
      <CloseIcon />
    </span>
  </button>
  <div class="modal-bg">
    <slot />
  </div>
</div>
