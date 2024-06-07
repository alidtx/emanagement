<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\FcmService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UserNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $users;
    private $type;
    private $subject;

    /**
     * Create a new job instance.
     */
    public function __construct($users, $type, $subject)
    {
        $this->users = $users;
        $this->type = $type;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::alert("Okay to send to job");

        (new FcmService)->send($this->users, $this->type, $this->subject);

    }
}
