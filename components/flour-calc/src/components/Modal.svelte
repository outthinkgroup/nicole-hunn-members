<style>
  .modal {
    position: absolute;
    left: calc(100% + 50px);
    bottom: 60%;
    background: #fff;
    box-shadow: 0 50px 100px rgba(50, 50, 93, 0.1),
      0 15px 35px rgba(50, 50, 93, 0.15), 0 5px 15px rgba(0, 0, 0, 0.1);
    height: 500px;
    width: 300px;
    z-index: 1;
    border-radius: 8px;
    padding: 20px;
  }
</style>

<div class="modal">
  <slot />
</div>
