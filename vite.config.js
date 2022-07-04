import laravel from 'laravel-vite-plugin'
import {defineConfig} from 'vite'

export default defineConfig({
    plugins: [
        laravel([
            'resources/js/app.js',
            'resources/scss/add.scss',
            'resources/scss/editProfile.scss',
            'resources/scss/home.scss',
            'resources/scss/login.scss',
            'resources/scss/pet.scss',
            'resources/scss/profile.scss',
            'resources/scss/register.scss',
            'resources/scss/styles.scss',
        ]),
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
})
