import App from "./src/App.svelte";

const app = new App({
  target: document.querySelector("#flour-calc"),
  props: {
    appName: "Flour Calculator",
  },
});

export default app;
