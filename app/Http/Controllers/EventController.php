<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\Employee;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\DesignationWiseAmount;
use App\Services\TelegramService;
use App\Traits\employees; 
use App\Services\EventService;

use function Laravel\Prompts\select;

class EventController extends Controller

{  

  private $EventService ;
  private $TelegramService;

    public function __construct(TelegramService $TelegramService, EventService  $EventService)
    {
        $this->TelegramService = $TelegramService;
        $this->EventService = $EventService;
    }

    public function index()
    {    
      $data=$this->EventService->getEventData();
      return view('event.list', $data);
    }

    public function create()
    {    
        $data=$this->EventService->createEvent();
        return view('event.add', $data);  
    }

   
    public function store(Request $request)
    {    
    $this->EventService->storeEvent($request);   
    Toastr::success('Event created successfully', 'Create');
    return redirect()->route('event.list');    
    } 


    public function edit($id)
    {  

      $data['designation']= Designation::get();
      $data['edit'] = Event::with('designationWiseEvent')->findOrFail($id);   
   
        return view('event.edit', $data);
    }  

    public function update(Request $request, $id)
    {  

      $this->EventService->updateEvent($request,  $id);  
       Toastr::success('Event update successfully', 'Create');
       return redirect()->route('event.list');
    }
    
    public function status(Request $request, $status, $id){
      $this->EventService->statusEvent($request, $status, $id); 
     
        Toastr::success('Event status updated successfully', 'Create');
        return redirect()->route('event.list'); 
    }


  
public function curl () 

{  
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://dev-hris.sslwireless.com/api/v1/inventory/employees',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer XGPFPpzg2AWwrG1GkZcuzRo7uWEAH5TXflcjRYxxGo83jZkdlMpuizE6G1NfOV2bV9eUcQn0Td3srz5W'
  ),
));
$response = curl_exec($curl);
curl_close($curl);
$result=json_decode($response, true);
return $result;

}

}
