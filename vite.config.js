import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
// This Will Enable TreeShacking
import vuetify from 'vite-plugin-vuetify';
import removePreloads from './removePreloads'

const ASSET_URL = process.env.ASSET_URL || '';

export default defineConfig({
  base: `${ASSET_URL}/build/`,
  plugins: [
    laravel({
      publicDirectory: 'public',
      input: 'resources/js/app.js',
      refresh: true,
    }),
    vue(),
    vuetify(),
    removePreloads(),
  ],
});
