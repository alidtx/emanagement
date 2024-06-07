<?php

namespace App\Http\Controllers;

use App\Models\DesignationWiseAmount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
class DesignationWiseAmountController extends Controller
{
    public function index()
    {    
       
      $data['expense']= DesignationWiseAmount::get();
      return view('designation_wise_amount.list', $data);
    }

  
    public function create()
    {  
        $data['expense']= DesignationWiseAmount::get();
        $data['employee']= DesignationWiseAmount::get();
        return view('designation_wise_amount.add', $data);  
    }

   
    public function store(Request $request)
    {   
        //  dd($request->all());
         
        // $request->validate([
        //     'name'=>'required', 
        // ]); 

          $data=new DesignationWiseAmount();
          $data->user_id=auth::user()->id;
          $data->amount=$request->amount;
          $data->employee_id=$request->employee_id;
          $data->date=$request->date;
          $data->save();
          Toastr::success('Dwa created successfully', 'Create');
          return redirect()->route('designation_wise_amount.list');
    } 

 
    public function show(DesignationWiseAmount $DesignationWiseAmount)
    {
        
    }


    public function edit(DesignationWiseAmount $DesignationWiseAmount, $id)
    {
        $data['edit'] = DesignationWiseAmount::findOrFail($id);
        $data['employee'] = DesignationWiseAmount::get();
        return view('designation_wise_amount.edit', $data);
    }  

   
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'name'=>'required', 
        // ]); 

          $data=DesignationWiseAmount::find($id);
          $data->name=$request->name;
          $data->department=$request->department;
          $data->save();
          Toastr::success('Dwa created successfully', 'Create');
          return redirect()->route('designation_wise_amount.list');
    }
    
    public function destroy($id)
    {
         $data=DesignationWiseAmount::find($id); 
         $data->delete();   
         Toastr::success('Dwa delete successfully', 'Create');
         return redirect()->route('designation_wise_amount.list');            
    }
}
