<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        $listMentionCurrent = json_decode($request->listMentionCurrent) ?? [];

        foreach ($request->usersMentions as $userId) {
            if($request->user_review == $userId || in_array($userId, $listMentionCurrent)) continue;

            $info = [
                'send_id' => Auth::id(),
                'receive_id' => $userId,
                'target_type' => config('model.target_type.comment'),
                'target_id' => $request->comment_id,
                'viewed' => config('model.viewed.false'),
            ];
            $this->notification->store($info);
        }
    }
}
