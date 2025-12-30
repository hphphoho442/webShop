import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js',
                    'resources/js/admin/seachSupplier.js',
                    'resources/js/admin/seachCategory.js',
                    'resources/js/shop/cart/change_quantity_item.js',
                    'resources/js/admin/Product/input_slug.js',
                    'resources/js/admin/Product/toggle_Active.js',
                    'resources/css/admin/a.css',
                    'resources/css/home/style.css',
                    'resources/css/shop/style.css',
                    'resources/js/shop/cart/notification_add_item.js',
                    'resources/css/shop/notification_add_to_cart.css',
                    'resources/css/style.css'
            ],
            refresh: true,
        }),
    ],
});
