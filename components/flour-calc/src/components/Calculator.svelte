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

<style>
  header {
    display: flex;
    align-items: center;
    width: 100%;
    font-size: 18px;
    height: 3em;
    position: absolute;
    border-top: 5px solid var(--blue-base);
    color: white;
    top: 0;
    left: 0;
    padding: 0 20px;
  }
  h4 {
    font-size: 1em;
    font-family: "Berkshire Swash";
    color: var(--blue-base);
  }
  .calc-body {
    margin-top: calc(3em + 10px - 20px);
  }
</style>

<header>
  <h4>Flour Calculator</h4>
</header>
<div class="calc-body">
  <TotalCupInput totalCups={liveTotalCups} on:updateCups={updateCupTotal} />
  <FlourSelector />
  <IngredientTable ingredients={recipe.ingredients} />
</div>
