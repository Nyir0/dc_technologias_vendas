import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resource/js/addition.js',
                'resource/js/formSubmite.js'
            ],
            refresh: true,
        }),
    ],
});
