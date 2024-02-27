import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            buildDirectory: 'bundle',
            input: [
                'resources/assets/sass/style.scss',
                'resources/assets/js/custom/authentication/sign-in/general.js',
                'resources/assets/js/app.js'
            ],
            refresh: true,
        }),
    ],
    build: {
        manifest: 'assets.json', // Customize the manifest filename...
    },
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
    },
});
