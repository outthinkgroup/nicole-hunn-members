import { writable, readonly } from "svelte/store";
import dataFromYml from "../data/flour-recipes.yaml";
const { recipes } = dataFromYml;

const _allRecipeNames = Object.keys(recipes);
export const allRecipeNames = _allRecipeNames.map((slug) => {
  return { slug, label: recipes[slug].name };
});

export const activeRecipeSlug = writable(allRecipeNames[0].slug);
export const totalCups = writable(1);

export function gramCalc(recipeSlug, totalCups) {
  const recipeObj = recipes[recipeSlug];
  const { name, ingredients } = recipeObj;

  const ingredientsPortions = ingredients.map(({ name, grams }) => {
    const calculatedGrams = Math.round(totalCups * grams);
    return { name, grams: calculatedGrams };
  });

  return { name, ingredients: ingredientsPortions };
}

// export const currentRecipe = gramCalc(recipes[activeRecipe.slug]);
export const setActiveRecipeSlug = (newRecipeSlug) => {
  activeRecipe.set(newRecipeSlug);
};

export const isCalcOpen = writable(false);
