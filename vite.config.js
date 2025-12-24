import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js',
                    'resources/js/admin/seachSupplier.js',
                    'resources/js/admin/seachCategory.js',
                    'resources/js/shop/cart/change_quantity_item.js',
                    'resources/css/admin/a.css',
                    'resources/css/home/style.css',
                    'resources/css/shop/style.css'
            ],
            refresh: true,
        }),
    ],
});
