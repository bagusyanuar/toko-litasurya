import {defineConfig} from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css','resources/sass/app.scss', 'resources/css/style.scss', 'resources/js/app.js','resources/js/features/category/list.js',
                'resources/js/features/category/bind/table-action-bind.js', 'resources/js/features/category/index.js', 'resources/js/features/category/store/form-category-store.js'],
            refresh: true,
        }),
    ],
})
