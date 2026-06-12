import { defineConfig } from 'vite';
import webrium from '@webrium/vite-plugin';

export default defineConfig(({ command }) => ({
  plugins: [
    webrium(),
  ],
  root: '.',
  publicDir: false,
  base: command === 'build' ? '/build/' : '/',
  build: {
    outDir: 'public/build',
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input: 'resources/js/app.js',
    },
  },
  server: {
    cors: true,
    strictPort: true,
    port: 5173,
  },
}));