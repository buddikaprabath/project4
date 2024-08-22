import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.css',
                'resources/js/app.js',
                'resources/css/home.css',
                'resources/css/user.css',
                'resources/css/loginapp.css',
            ],
            refresh: true,
        }),
    ],
});
