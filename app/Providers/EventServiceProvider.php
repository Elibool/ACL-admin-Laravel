<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\LoginEvent' => [
            'App\Listeners\LoginEventListener',
        ],
    ];
    /*
     * 主动注册监听 事件组到 application 中
     */
    protected  $subscribe = [
        'App\Listeners\LoginEventListener',
    ];

    /*
     * 其他类动态注册事件监听到 application 中
     */
    function setSubscribe($subscribe)
    {
        $this->subscribe = $subscribe;
    }

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
