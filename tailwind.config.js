/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue"],
    darkMode: "class",
    theme: {
      container: {
        center: true,
      },
      extend: {
        colors: {
          primary: {
            DEFAULT: "#0f305b",
            light: "#e7f1f2",
            "dark-light": "rgba(15,48,91,.15)",
          },
          secondary: {
            DEFAULT: "#2f9196",
            light: "#e3f3f3",
            "dark-light": "rgb(47 145 150 / 15%)",
          },
          success: {
            DEFAULT: "#00ab55",
            light: "#ddf5f0",
            "dark-light": "rgba(0,171,85,.15)",
          },
          danger: {
            DEFAULT: "#e7515a",
            light: "#fff5f5",
            "dark-light": "rgba(231,81,90,.15)",
          },
          warning: {
            DEFAULT: "#e2a03f",
            light: "#fff9ed",
            "dark-light": "rgba(226,160,63,.15)",
          },
          info: {
            DEFAULT: "#247387",
            light: "#e2f1f3",
            "dark-light": "rgba(36,115,135,.15)",
          },
          dark: {
            DEFAULT: "#17344c",
            light: "#e7edf1",
            "dark-light": "rgba(23,52,76,.15)",
          },
          black: {
            DEFAULT: "#0b243a",
            light: "#e3eaee",
            "dark-light": "rgba(11,36,58,.15)",
          },
          white: {
            DEFAULT: "#ffffff",
            light: "#e0e6ed",
            dark: "#888ea8",
          },
        },
        fontFamily: {
          nunito: ["Nunito", "sans-serif"],
        },
        spacing: {
          4.5: "18px",
        },
        boxShadow: {
          "3xl":
            "0 2px 2px rgb(224 230 237 / 46%), 1px 6px 7px rgb(224 230 237 / 46%)",
        },
        typography: {
          DEFAULT: {
            css: {
              h1: { fontSize: "40px" },
              h2: { fontSize: "32px" },
              h3: { fontSize: "28px" },
              h4: { fontSize: "24px" },
              h5: { fontSize: "20px" },
              h6: { fontSize: "16px" },
            },
          },
        },
      },
    },
    plugins: [
      require("@tailwindcss/forms")({
        strategy: "base", // only generate global styles
      }),
      require("@tailwindcss/typography"),
    ],
  };
