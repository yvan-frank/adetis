import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

// Build unique : un seul bundle "islands-runtime" qui embarque toutes les
// îles React et se monte lui-même sur chaque [data-island] du DOM PHP.
// Sort directement dans backend/public/assets pour être servi par PHP.
export default defineConfig({
    plugins: [react()],
    build: {
        outDir: '../backend/public/assets',
        // false : ce dossier peut contenir aussi du CSS/images écrits à la
        // main — les vider à chaque build les détruirait.
        emptyOutDir: false,
        rollupOptions: {
            input: {
                'islands-runtime': 'src/main.jsx',
            },
            output: {
                entryFileNames: '[name].js',
                // Un seul fichier JS, pas de chunks séparés par île : plus
                // simple à servir depuis PHP, pas de sous-dossier imbriqué
                // à gérer (outDir est déjà "assets").
                inlineDynamicImports: true,
                assetFileNames: '[name][extname]',
            },
        },
    },
    server: {
        // Surchargeable via $PORT pour que plusieurs instances de dev
        // puissent tourner en parallèle sans conflit (cf. backend
        // App\Core\Assets, qui lit VITE_DEV_PORT côté PHP).
        port: Number(process.env.PORT) || 5173,
        strictPort: false,
        // Écoute sur toutes les interfaces réseau (pas juste localhost)
        // pour tester depuis un autre appareil du réseau local.
        host: true,
        // Les pages sont chargées depuis PHP (ex: :8000) — le client Vite
        // et les modules sont donc requêtés cross-origin.
        cors: true,
        proxy: {
            '/api': 'http://localhost:8000',
        },
    },
});
