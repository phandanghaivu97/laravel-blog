<?php
foreach ($request->usersMentions as $userId) {
            if($request->user_review != $userId) {
                if($request->listMentionCurrent != null) {
                    if(!in_array($userId, json_decode($request->listMentionCurrent))) {
                        $info = [
                            'send_id' => Auth::id(),
                            'receive_id' => $userId,
                            'target_type' => config('model.target_type.comment'),
                            'target_id' => $request->comment_id,
                            'viewed' => config('model.viewed.false'),
                        ];
                        $this->notification->store($info);
                    }
                } else {
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
