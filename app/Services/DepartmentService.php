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
class DepartmentService
{

     
  public function getDepData() {
    $data= Department::orderBy('id','DESC')->paginate(8);
    return $data;
    }
   
   public function createDep() {
    $data= Designation::get(); 
    return $data; 
   }

   public function storeDep($request) {

   $request->validate([
      'name'=>'required', 
  ]); 
    $data=new Department();
    $data->name=$request->name;
    $data->status=1;
    $data->save();
   }

   public function editDep($id) {
    $data = Department::findOrFail($id);
    return $data;
   }

   public function updateDep($request, $id){

    $request->validate([
      'name'=>'required', 
  ]); 
    $data=Department::find($id);
    $data->name=$request->name;
    $data->status=1;
    $data->save();
   }

   public function statusDep($request,$status, $id) {
    $model=Department::find($id);
    $model->status=$status;
    $model->save();
   }
  



}