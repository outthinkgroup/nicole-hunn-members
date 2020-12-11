import App from "./src/App.svelte";

const app = new App({
  target: document.querySelector("#flour-calc"),
  props: {
    appName: "Flour Calculator",
    oldFlourCalcURL: [
      {
        link: "https://nicolehunn.com/flour-calculator/",
        type: null,
      },
      {
        link: "https://glutenfreeonashoestring.com/gluten-free-bread-flour/",
        type: "glutenFreeBreadFlour",
      },
      {
        link:
          "https://glutenfreeonashoestring.com/d-i-y-gluten-free-all-purpose-flour/",
        type: "mockBetterBatter",
      },
      {
        link:
          "https://glutenfreeonashoestring.com/basic-gluten-free-flour-blend/",
        type: "basicXanthanFreeBlend",
      },
      {
        link:
          "https://glutenfreeonashoestring.com/better-than-cup4cup-gluten-free-flour-blend-d-i-y-how-to/",
        type: "betterThanCup4CupBlend",
      },
      {
        link:
          "https://glutenfreeonashoestring.com/better-batter-pastry-flour-hack-mock-cup4cup/",
        type: "mockCup4CupBlend",
      },
      {
        link:
          "https://glutenfreeonashoestring.com/category/basic-gluten-free-recipes/gluten-free-flour-blends/",
        type: null,
      },
      {
        link:
          "https://glutenfreeonashoestring.com/all-purpose-gluten-free-flour-recipes/",
        type: null,
      },
      {
        link:
          "http://glutenfreeonashoestring.com/all-purpose-gluten-free-flour-recipes/",
        type: null,
      },
      {
        link:
          "https://members.glutenfreeonashoestring.com/all-purpose-gluten-free-flour-blend-recipes-information/",
        type: null,
      },
    ],
  },
});

export default app;
