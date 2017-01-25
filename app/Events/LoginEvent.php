<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\LoginLog;
use Illuminate\Http\Request;

class LoginEvent
{
    use InteractsWithSockets, SerializesModels;
    public $request;
    public $logText;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Request $request,$logText)
    {
        $this->request = $request;
        $this->logText = $logText;
        $this->insertLog();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    /*
     * @todo 写入登录日志
     */
    public function insertLog()
    {
        $loginLog = new LoginLog;
        $loginLog->email = $this->request->email;
        $loginLog->content = $this->logText;
        $loginLog->ip = $this->request->ip();
        $loginLog->created_at = time();

        $loginLog->save();
    }

}
