<?php

namespace App\Listeners;

use App\Events\LoginEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Request;


class LoginEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LoginEvent  $event
     * @return void
     */
    public function handle(LoginEvent $event)
    {
        //

    }
    public function loginOk($event)
    {
        //dd('login success');
    }
    public function loginPre($event)
    {
        //dd('login pre');

    }
    /*
     * 编写需要监听的事件
     */
    public function subscribe($events)
    {
        /*
         * 登录成功监听
         */
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\LoginEventListener@loginOk'
        );
        /*
         * 指定有监听 的事件
         */
        /*
        $events->listen(
            'App\Events\LoginEvent',
            'App\Listeners\LoginEventListener@loginPre'
        );
        */
    }


}
