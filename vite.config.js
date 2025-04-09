import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            build: {
                manifest: true,        // genera un file manifest.json che mappa i nomi dei file originali con quelli con hash
                outDir: 'public/build' // specifica dove mettere i file compilati
            },
            refresh: true,
        }),
    ],
});
