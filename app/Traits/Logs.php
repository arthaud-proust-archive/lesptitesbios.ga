<?php 

namespace App\Traits;
use App\Log;
use JWTAuth;

trait Logs
{
    public function addLog($token, $action, $content)
    {
        $user = JWTAuth::toUser($token);

        $log = log::create([
            'action' => $action,
            'user' => $user->name,
            'content' => $content
        ]);
    }

    public function getUser($token)
    {
        return JWTAuth::toUser($token);
    }
}
