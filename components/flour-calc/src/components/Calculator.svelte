<script>
  import Date from "../../data/flour-recipes.yaml";
  import { onDestroy } from "svelte";
  import { activeRecipeSlug, gramCalc, totalCups } from "../store.js";
  import FlourSelector from "./FlourSelector.svelte";
  import IngredientTable from "./IngredientTable.svelte";
  import TotalCupInput from "./TotalCupInput.svelte";

  let liveActiveRecipe;
  const unsubscribeActiveRecipe = activeRecipeSlug.subscribe((val) => {
    liveActiveRecipe = val;
  });
  let liveTotalCups;
  const unsubscribeTotalCup = totalCups.subscribe((val) => {
    liveTotalCups = val;
  });
  $: recipe = gramCalc(liveActiveRecipe, liveTotalCups);

  function updateCupTotal(e) {
    const newTotal = e.detail;
    totalCups.set(newTotal);
  }
  $: test = console.log(liveActiveRecipe);
  onDestroy(() => {
    unsubscribeTotalCup();
    unsubscribeActiveRecipe();
  });
</script>

<h4>Flour Calculator</h4>
<div>

  <TotalCupInput totalCups={liveTotalCups} on:updateCups={updateCupTotal} />

  <IngredientTable ingredients={recipe.ingredients} />
</div>
<FlourSelector />
