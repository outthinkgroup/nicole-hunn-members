<script>
  /* eslint  */
  import { allRecipeNames, activeRecipeSlug } from "../store";

  export let liveActiveRecipe;
  const unsubscribeActiveRecipe = activeRecipeSlug.subscribe((val) => {
    liveActiveRecipe = val;
  });
  const setActiveRecipe = (e) => {
    const slug = e.target.value;
    activeRecipeSlug.set(slug);
  };
</script>

<style>
  select {
    font-weight: 600;
    width: 100%;
    margin-bottom: 10px;
  }
</style>

<select
  value={liveActiveRecipe}
  on:change={setActiveRecipe}
  on:blur={setActiveRecipe}>
  {#each allRecipeNames as recipeName}
    <option value={recipeName.slug}>{recipeName.label}</option>
  {/each}
</select>
