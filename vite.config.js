import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/scss/add.scss',
                'resources/scss/editProfile.scss',
                'resources/scss/home.scss',
                'resources/scss/login.scss',
                'resources/scss/pet.scss',
                'resources/scss/profile.scss',
                'resources/scss/styles.scss',
                'resources/scss/card.scss',
                'resources/scss/mediaQueries.scss',
            ],
            refresh: true,
        }),
        {
            name: 'blade',
            handleHotUpdate({ file, server }) {
                if (file.endsWith('.blade.php')) {
                    server.ws.send({
                        type: 'full-reload',
                        path: '*',
                    });
                }
            },
        }
    ],
});
