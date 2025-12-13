import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';
import liveReload from 'vite-plugin-live-reload';
export default defineConfig(({ command }) => ({
    plugins: [
        tailwindcss(),
        // This plugin listens for changes in PHP files and refreshes the browser
        liveReload(['./app/Views/**/*.php']),
    ],
    root: '.', // Project root directory
    // Important: this line prevents the copying of public files
    publicDir: false,
    // Important: base is only applied in build (production) mode
    // It is not needed in dev mode
    base: command === 'build' ? '/build/' : '/',
    build: {
        // The final build output is saved in the public folder
        outDir: 'public/build',
        // Clear the build folder before a new build
        emptyOutDir: true,
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
}));