<?php

namespace App\Providers;

use App\Http\Controllers\PageController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        $views = [
            'main/index',
            'main/subsection',
            'main/article',
            'main/inv',
            'main/error',
            'admin/index-admin',
            'admin/selector-section',
            'admin/form-subsection',
            'admin/form-article',
            'admin/form-inv',
            'admin/form-section',
            'admin/form-index',
            'admin/form-password',
            'admin/other'
        ];

        View::composer($views, function ($view) {
            $sections = app(SectionController::class)->loadHeaderData();
            $footerContent = app(PageController::class)->footerContent();
            $view->with('sections', $sections)->with('footer', $footerContent);
        });
    }
}
