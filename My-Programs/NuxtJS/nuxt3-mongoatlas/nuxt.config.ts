import { resolve } from 'path';

export default defineNuxtConfig({
  experimental: {
    payloadExtraction: true
  },  
  app: {
      head: {
        charset: 'utf-8',
        viewport: 'width=device-width, initial-scale=1',
      }
  },
  vue: {
     defineModel: false,
     propsDestructure: false
   },
  alias: {
    "@": resolve(__dirname, "/"),
  },
  // nitro: {
  //   plugins: ['~/server/index.ts']
  //  },
   runtimeConfig: {
    public: {
      secret: "7bbc21c9826d9d54a4282aacbe9812f32a1dd1148d9be7246c7cecd7b3157b79c76144eea49b12bb4958db055e53a663d4695863ae73556abc47148d247b3830",
    }
  },
  ssr: false,
  css: [
    '~/assets/styles/main.scss',
    "~/static/css/nuxt.css"
  ],
  components: true,
  modules: [
    // 'bootstrap-vue/nuxt',
  ],
  build: {
  },

},


)
