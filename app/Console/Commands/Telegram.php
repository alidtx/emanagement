<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Payment;
use App\Models\Event;
use Illuminate\Support\Facades\Log;
use App\Models\Employee;
use Carbon\Carbon;
class Telegram extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:telegram';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add telegram Message';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $eventId = Event::latest()->first();
        $start_date = Carbon::parse($eventId->start_date);
        $end_date = Carbon::parse($eventId->end_date);
        $duration = $start_date->diffInDays($end_date);
        $halfway_point = $start_date->copy()->addDays($duration / 2);
        
        if (Carbon::now() >= $halfway_point) {
        $name= $eventId->name;
        $paidEmployeeIds = Payment::where('event_id', $eventId->id)->pluck('employee_id');
        $employeesNotInPayment = Employee::whereNotIn('id', $paidEmployeeIds)->get();
         $da=array(); 
        foreach ($employeesNotInPayment as $employee) {
            $da[]=$employee->name;   
        }

        $unpaidEmployeeNames = implode("\n", $da);
        $apiToken = "6849169381:AAEEZBTTAU5NVl2ZfEWGjkWQH88TGsfPPu4";
        $text = "You guys not yet made payments for "."$name"."\n".$unpaidEmployeeNames."\nPlease Make payment";
        $data = [
            'chat_id' => '@alidtx',
            'text' =>  $text  
        ];
        $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );
        $this->info('success');
    }

}
}
