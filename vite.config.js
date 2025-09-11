import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue2 from '@vitejs/plugin-vue2';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/cp.js',
                'resources/js/confetti.min.js',
            ],
            publicDirectory: 'resources/dist',
        }),
        vue2(),
    ],
});