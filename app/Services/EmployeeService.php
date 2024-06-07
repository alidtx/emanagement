<?php

namespace App\Services;

use App\Models\File;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Employee;
use App\Models\Designation;
class EmployeeService
{

     
  public function getEmpData() {
      $data=Employee::orderBy('id','DESC')->paginate(8);
      return $data;
    }
   
   public function createEmp() {
    $data= Designation::get(); 
    return $data; 
   }

   public function storeEmp($request) {

    $request->validate([
      'name'=>'required', 
      'email'=>'required|unique:employees,email', 
      'employee_uniqueId' => 'required|unique:employees,employee_unique_id', 
      'telegram'=>['required', 'regex:/^@/'],
      'designation_id'=>'required', 
  ],
    [
    'employee_uniqueId.unique' => 'This employe Id is taken, try another one!!',
    'email.unique' => 'This email Id is taken, try another one!!',
    ]
); 

    $data=new Employee();
    $data->name=$request->name;
    $data->email=$request->email;
    $data->employee_unique_id=$request->employee_uniqueId; // TODO:: get data from request , Employee ID
    $data->telegram=$request->telegram;
    $data->designation_id=$request->designation_id;
    $data->status=1;
    $data->save();
   }

   public function editEmp($id) {
    $data['edit'] = Employee::findOrFail($id);
    $data['designation']= Designation::get();   
    return $data;
   }

   public function updateEmp($request, $id){

    $request->validate([
      'name'=>'required', 
      'email'=>'required|unique:employees,email', 
      'employee_uniqueId' => 'required|unique:employees,employee_unique_id', 
      'telegram'=>['required', 'regex:/^@/'],
      'designation_id'=>'required', 
  ],
    [
    'employee_uniqueId.unique' => 'This employe Id is taken, try another one!!',
    'email.unique' => 'This email Id is taken, try another one!!',
    ]
); 
  
    $data=Employee::find($id);
    $data->name=$request->name;
    $data->email=$request->email;
    $data->employee_unique_id=$request->employee_uniqueId;
    $data->telegram=$request->telegram;
    $data->status=1;
    $data->save();
   }

   public function statusEmp($request,$status, $id) {
    $model=Employee::find($id);
    $model->status=$status;
    $model->save();
   }
  



}