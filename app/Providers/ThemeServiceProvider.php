<?php

namespace App\Providers;

use Roots\Acorn\Sage\SageServiceProvider;

class ThemeServiceProvider extends SageServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // 
        add_filter('template_include', function ($template) {
            if (is_singular('product')) {
                echo view('woocommerce.single-product')->render();
                return get_stylesheet_directory() . '/index.php';
            }
            return $template;
        }, 100);
        // 
        // add_filter('woocommerce_product_tabs', function ($tabs) {
        //     unset($tabs['description']); // Remove the Description tab
        //     return $tabs;
        // }, 98);

    }

}



