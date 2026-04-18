// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  // ОСЬ ТУТ ДОДАЛИ @pinia/nuxt
  modules: ['@nuxt/eslint', '@nuxt/ui', '@vueuse/nuxt', '@pinia/nuxt'],

  colorMode: {
    preference: 'light'
  },

  devtools: {
    enabled: true
  },

  css: ['~/assets/css/main.css'],

  routeRules: {
    '/': { prerender: true }
  },

  compatibilityDate: '2025-01-15',

  eslint: {
    config: {
      stylistic: {
        commaDangle: 'never',
        braceStyle: '1tbs'
      }
    }
  }
})
