import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    // Use relative paths for production
    base: process.env.APP_ENV === 'production' ? '/build/' : '/',
    build: {
        manifest: true,
        outDir: 'public/build',
        emptyOutDir: true,
        rollupOptions: {
            output: {
                assetFileNames: 'assets/[name]-[hash][extname]',
                chunkFileNames: 'js/[name]-[hash].js',
                entryFileNames: 'js/[name]-[hash].js',
            },
        },
    },
    server: {
        https: false, // Set to false for production
        host: '0.0.0.0',
        hmr: {
            host: 'localhost',
        },
    },
});