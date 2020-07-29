<script>
  import { createEventDispatcher } from "svelte";
  export let totalCups;

  const dispatch = createEventDispatcher();
</script>

<style>
  .totalcups {
    font-weight: 600;
    color: black;
    margin-bottom: 10px;
  }
  input {
    background: #edf2f7;
    width: 3.5em;
    padding: 5px;
    padding: 2px 5px;
    margin: 0 0.25em;
    font-weight: 600;
  }
</style>

<div class="totalcups">
  I want
  <input
    type="number"
    name="totalcups"
    id="totalcups"
    on:input={(e) => dispatch('updateCups', e.target.value)}
    value={totalCups} />
  cups of flour
</div>
