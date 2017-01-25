<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //将 cdn 配置数据全局分配到视图
        $cdn_path = env('CDN_PATH');
        view()->share('cdn_path',$cdn_path);

        //定义视图 composer,监听sites 视图模板
        view()->composer(
            'admin.sites', 'App\Http\ViewComposers\PermissionsComposer'
        );
        view()->composer(
            'admin.*', 'App\Http\ViewComposers\LayoutComposer'
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

    }
}
