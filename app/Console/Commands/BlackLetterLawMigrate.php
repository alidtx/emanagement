<?php

namespace App\Console\Commands;

use App\Models\File;
use App\Models\Subject;
use Illuminate\Console\Command;

class BlackLetterLawMigrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:black-letter-law-migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $subjects = Subject::get();

        foreach ($subjects as $subject) {

            if(is_null($subject->attachment)) {
                continue;
            }

            File::create([
                'model' => "Subject",
                'model_id' => $subject->id,
                'type' => "BlackLetterLaw",
                "file_path" => $subject->attachment
            ]);

        }

        $this->info("Processed done");
    }
}
