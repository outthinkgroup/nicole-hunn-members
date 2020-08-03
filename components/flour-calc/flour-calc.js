import App from "./src/App.svelte";

const app = new App({
  target: document.querySelector("#flour-calc"),
  props: {
    appName: "Flour Calculator",
    oldFlourCalcURL:
      "https://nicolehunn.local/recipe/how-to-make-quickbread-pita-bread-step-x-step/",
  },
});

export default app;
