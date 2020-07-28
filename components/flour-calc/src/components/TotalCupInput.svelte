<script>
  import { createEventDispatcher } from "svelte";
  export let totalCups;

  const dispatch = createEventDispatcher();
</script>

<div>
  I want
  <input
    type="number"
    name="totalcups"
    id="totalcups"
    on:change={(e) => dispatch('updateCups', e.target.value)}
    value={totalCups} />
  cups of flour
</div>
