const plugin = require("tailwindcss/plugin");
module.exports = {
  theme: {
    extend: {
      colors: {
        nhRed: "#F87575",
        nhBlue: {
          dark: "hsl(224, 37%, 13%)",
          base: "hsl(224, 37%, 17%)",
          light: "hsl(221, 29%, 22%)",
        },
      },
      spacing: {
        "72": "20rem",
        "1/5": "20%",
      },
      maxWidth: {
        "1/5": "20%",
      },
      minWidth: {
        "72": "20rem",
      },
      inset: {
        full: "100%",
      },
    },
  },
  variants: {},
  plugins: [],
};
