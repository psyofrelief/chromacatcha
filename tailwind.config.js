/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontSize: {
                xxs: "0.5rem",
            },
            fontFamily: {
                honk: ["Honk"],
                spaceMono: ["Space Mono"],
            },
        },
    },
    daisyui: {
        themes: ["cyberpunk"],
    },
    plugins: [require("daisyui")],
};
