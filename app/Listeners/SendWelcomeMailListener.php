<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\SendWelcomeMailJob;
use App\Events\UserRegistered;

class SendWelcomeMailListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    /**
     * 이벤트, 리스너를 연결시키는 방법2가지 
     * 1.Event Discovery(laravel11/12)
     * 아래처럼 리스너의 handle()의 파라미터의 타입지정하면 라라벨 내부에서 자동으로 이벤트/리스너 연결
     * 2.수동등록
     * eventServiceProveider or appServiceProvider에 연결관계등록
     * 두 방법 다 사용하면 리스너가 두번실행된디
     * */ 

    public function handle(UserRegistered $event): void
    {
        SendWelcomeMailJob::dispatch($event->user);
    }
}
