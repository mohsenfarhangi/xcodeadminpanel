import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            buildDirectory: 'bundle',
            input: [
                'resources/assets/sass/style.scss',

                'resources/assets/plugins/formvalidation/dist/css/formValidation.css',
                'resources/assets/plugins/formvalidation/dist/js/FormValidation.full.js',
                'resources/assets/plugins/formvalidation/dist/js/plugins/Bootstrap5.js',

                'resources/assets/js/custom/authentication/sign-in/general.js',
                'resources/assets/js/app.js',
                'resources/assets/js/components.js',
                'resources/assets/js/custom/pages/cpanel/controls.js'
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
