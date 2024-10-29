import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/snippets/snippets.css',
                'resources/js/snippets/snippets.js'
            ],
            refresh: true,
        }),
    ],
});
