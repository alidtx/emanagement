<?php

namespace App\Services;

use App\Models\File;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Employee;
use App\Models\Designation;
use App\Models\Expense;
use Sabberworm\CSS\Rule\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\Event;
use App\Models\DesignationWiseAmount;
use App\Services\TelegramService;
class EventService
{
  
  private $TelegramService;
  
   public function __construct(TelegramService $TelegramService)
   {
      $this->TelegramService=$TelegramService;
    
    }  

  public function getEventData() {

    $data['events']= Event::with('designationWiseEvent')->orderBy('id','DESC')->paginate(8);
    $data['designationwiseAmounts']  = DesignationwiseAmount::with(['event', 'designation'])->get();
    return $data;
    
    }
   
   public function createEvent() {
    $data['employees']= Employee::get();
    $data['designation']= Designation::get();
    return $data; 
   }

   public function storeEvent($request) {
    $randomId = rand(10000, 99999); 
    $siteLink=url('checkout/' . $randomId);   
    $request->validate([
        'name'=>'required', 
        'start_date'=>'required', 
        'end_date'=>'required', 
        'amount'=>'required', 
        'designation_id'=>'required', 
    ]); 
    #event create
    $data=new Event();
    $data->name=$request->name;
    $data->created_by=auth::user()->id;
    $data->employee_id=$request->employee_id;
    $data->start_date=$request->start_date;
    $data->end_date=$request->end_date;
    $data->type=$request->type;
    $data->event_unique_code= $randomId ;
    $data->telegram_id=$request->telegram;
    $data->status=1;
    if ($request->type != '2') {
        $data->amount = is_array($request->amount) ? null : $request->amount;
    }
  $data->save();
  $this->TelegramService->TelegramBot($request->employee_id, $request->start_date, $request->end_date, $siteLink );
  if ($request->type== '2')
  {
    if (is_array($request->amount) && is_array($request->designation_id) && count($request->amount) === count($request->designation_id)) {
        foreach ($request->amount as $key => $amount) {
            $designation = new DesignationWiseAmount();
            $designation->designation_id = $request->designation_id[$key]; 
            $designation->event_id = $data->id;
            $designation->amount = $amount; 
            $designation->save();
            $this->TelegramService->TelegramBot($request->employee_id, $request->start_date, $request->end_date,  $siteLink );
        }
    }
  }
   }

   public function editEvent($id) {
    $data['edit'] = Event::with('designationWiseEvent')->findOrFail($id);
    $data['designation']= Designation::get();
    return $data;
   }

   public function updateEvent($request, $id){
    $request->validate([
      'name'=>'required', 
      'start_date'=>'required', 
      'end_date'=>'required', 
      'amount'=>'required', 
      'designation_id'=>'required', 
  ]);

  $data=Event::find($id);
  $data->name=$request->name;
  $data->employee_id=$request->employee_id;
  $data->start_date=$request->start_date;
  $data->end_date=$request->end_date;
  $data->type=$request->type;
  $randomId = rand(10000, 99999);
  $data->event_unique_code= $randomId ;
  if ($request->type != '2') {
      $data->amount = is_array($request->amount) ? null : $request->amount;
  }
$data->save();
  if ($request->type== '2')
  {
    #previous data delete
    DesignationWiseAmount::where('event_id',$id)->delete();
    if (is_array($request->amount) && is_array($request->designation_id) && count($request->amount) === count($request->designation_id)) {
     $data=array();
      foreach ($request->amount as $key => $amount) {
          $data[]=[
              "event_id"=>$id,
              "designation_id"=> $request->designation_id[$key],
              "amount"=>$amount
          ]; 
      }
      DesignationWiseAmount::insert($data);
    }
  }
   }

   public function statusEvent($request,$status, $id) {
        $model=Event::find($id);
        $model->status=$status;
        $model->save();
   }
  



}