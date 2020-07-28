<script>
  export let ingredients;
</script>

<div>
  {#each ingredients as ingredient}
    <p style="color:black;">
      <span>{ingredient.name}</span>
      <span>{ingredient.grams} grams</span>
    </p>
  {/each}
</div>
