import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import eslint from 'vite-plugin-eslint'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                '/resources/js/app.js',
                '/resources/scss/style.scss',
            ],
            refresh: true,
        }),
        eslint({
            include: ['**/*.js', '**/*.vue'],
        }),
        vue({
            template: {
                compilerOptions: {
                    isCustomElement: (tag) => tag.startsWith('swiper-'),
                },
            },
        }),
    ],
    resolve: {
        alias: {
            '@site': '/resources/js',
            '@scss': '/resources/scss',
        },
    },
})
