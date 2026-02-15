import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    // server: {
    //     host: true,
    //     port: 5173,
    //     strictPort: true,

    //     allowedHosts: [
    //         'kimiko-chromic-nonmelodiously.ngrok-free.dev',
    //     ],

    //     hmr: {
    //         host: 'kimiko-chromic-nonmelodiously.ngrok-free.dev',
    //         protocol: 'wss',
    //     },
    // },
});
