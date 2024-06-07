<?php

namespace App\Services;

use App\Models\File;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Employee;
use App\Models\Designation;
use Sabberworm\CSS\Rule\Rule;
class DesignationService
{

     
  public function getDesigData() {
    $data= Designation::with('department')->orderBy('id','DESC')->paginate(8);  
      return $data;
    }
   
   public function createDesig() {
    $data= Designation::get(); 
    return $data; 
   }

   public function storeDesig($request) {
     
      $request->validate([
        'name'=>'required', 
        'department_id'=>'required', 
    ]); 
    
  $data=new Designation();
    $data->name=$request->name;
    $data->department_id=$request->department_id;
    $data->status=1;
    $data->save();

   }

   public function editDesign($id) {
    $data['edit'] = Employee::findOrFail($id);
    $data['designation']= Designation::get();  
    return $data;
   }

   public function updateDesig($request, $id){

    $request->validate([
      'name'=>'required', 
      'department_id'=>'required', 
  ]); 

    $data=Designation::find($id);
    $data->name=$request->name;
    $data->department_id=$request->department_id;
    $data->status=1;
    $data->save();
   }

   public function statusDesig($request,$status, $id) {
       $model=Designation::find($id);
        $model->status=$status;
        $model->save();
   }
  



}