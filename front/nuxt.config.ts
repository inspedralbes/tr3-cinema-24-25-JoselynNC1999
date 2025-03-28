// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  // Asegúrate de tener configurado el módulo @nuxtjs/tailwindcss
  modules: ["@pinia/nuxt","@nuxtjs/tailwindcss"],

  // (Opcional) Si quieres personalizar tu archivo CSS principal
  css: ['@/assets/css/main.css'],

  ssr: false,

})