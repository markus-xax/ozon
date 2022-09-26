import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// https://github.com/vuetifyjs/vuetify-loader/tree/next/packages/vite-plugin
import vuetify from 'vite-plugin-vuetify'

// https://vitejs.dev/config/
export default defineConfig({
  server: {
    proxy: {
      '/seo/api': 'http://localhost:8561/'
    }
  },
  devServer: {
    proxy: 'http://localhost:8561'
  },
  plugins: [
		vue(),
		vuetify({ autoImport: true }),
	],
  build: {
    outDir: '../auth/public',
    rollupOptions: {
      output: {
        entryFileNames: `assets/[name].js`,
        chunkFileNames: `assets/[name].js`,
        assetFileNames: `assets/[name].[ext]`
      }
    }
  }
})
