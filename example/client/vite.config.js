import { defineConfig } from 'vite';

export default defineConfig({
    build: {
        manifest: true,
        emptyOutDir: true,
        outDir: '../public/assets',
        rollupOptions: {
            input: 'main.js',
        },
    },
});
