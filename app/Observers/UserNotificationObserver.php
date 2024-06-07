<?php

namespace App\Observers;

use App\Jobs\UserNotificationJob;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Support\Facades\Log;

class UserNotificationObserver
{
    public function created(UserNotification $userNotification)
    {
        $message = [
            "type"                 => $userNotification->title,
            "subject"              => $userNotification->body,
        ];

        $chunkSize = 100;

        Log::alert("Reached UserNotification Observer");

        User::query()
            ->select('id', 'fcm_token')
            ->whereNotNull('fcm_token')
            ->distinct('fcm_token')
            ->chunk($chunkSize, function ($users) use ($message) {
                UserNotificationJob::dispatch($users->unique('fcm_token')->pluck('fcm_token')->toArray(), $message["type"], $message["subject"]);
            });
    }
}
