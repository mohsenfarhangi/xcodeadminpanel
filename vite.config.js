import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/gust.scss',
                'resources/scss/dashboard.scss',
                'resources/scss/app.scss',
                'resources/js/plugins/persian-datepicker/persian-date.min.js',
                'resources/js/plugins/persian-datepicker/persian-datepicker.min.css',
                'resources/js/plugins/persian-datepicker/persian-datepicker.min.js',
                'resources/js/dentists/index.js',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
    },
});
