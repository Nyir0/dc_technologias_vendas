import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/addition.js',
                'resources/js/formSubmite.js',
                'resources/js/history.js',
            ],
            refresh: true,
        }),
    ],
});
