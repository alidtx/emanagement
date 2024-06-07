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
class ExpenseService
{

     
  public function getExpgData() {
    $data=Expense::with('user','employee')->orderBy('id','DESC')->paginate(8); 
    return $data;
    }
   
   public function createExp() {
    $data= Designation::get(); 
    return $data; 
   }

   public function storeExp($request) {

     $request->validate([
            'employee_id'=>'required', 
            'amount'=>'required', 
            'date'=>'required', 
        ]); 

    $data=new Expense();
    $data->user_id=auth::user()->id;
    $data->amount=$request->amount;
    $data->employee_id=$request->employee_id;
    $data->date=$request->date;
    $data->comment=$request->comment;
    $data->status=1;
    $data->save();

   }

   public function editExp($id) {
    $data['edit'] = Expense::findOrFail($id);
    $data['employee'] = Employee::get();
    return $data;
   }

   public function updateExp($request, $id){

  //   $request->validate([
  //     'name'=>'required', 
  // ]); 
    $data=Expense::find($id);
    $data->user_id=auth::user()->id;
    $data->amount=$request->amount;
    $data->employee_id=$request->employee_id;
    $data->date=$request->date;
    $data->comment=$request->comment;
    $data->status=1;
    $data->save();
   }

   public function statusExp($request,$status, $id) {
    $model=Expense::find($id);
    $model->status=$status;
    $model->save();
   }
  



}