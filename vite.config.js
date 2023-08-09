import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/index.scss',
                'resources/scss/front/index.scss',
                'resources/scss/admin/index.scss',
                'resources/js/app.js',
                'resources/js/front.js'
            ],
            refresh: true,
        }),

    ],
});
