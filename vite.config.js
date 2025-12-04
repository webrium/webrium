import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';
import liveReload from 'vite-plugin-live-reload';
import path from 'path';

export default defineConfig({
    plugins: [
        tailwindcss(),
        // This plugin listens for changes in PHP files and refreshes the browser
        liveReload(['./app/Views/**/*.php']),
    ],
    root: '.', // Project root directory
    build: {
        // The final build output is saved in the public folder
        outDir: 'public/build',
        manifest: true, // The manifest file is necessary for addressing in production mode
        rollupOptions: {
            // Your files' entry point
            input: 'resources/js/app.js',
        },
    },
    server: {
        // Development server settings to prevent potential CORS errors
        cors: true,
        strictPort: true,
        port: 5173,
    },
});