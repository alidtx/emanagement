<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Services\DesignationService;

class DesignationController extends Controller
{  

     private $DesignationService;
    
    public function __construct(DesignationService $DesignationService)
    {
        $this->DesignationService=$DesignationService;
    }

    public function index()
    {    
      
      $data['designation']=$this->DesignationService->getDesigData();
    //    dd($data['designation']);
      return view('designation.list', $data);
    }

  
    public function create()
    {  
        $data['department']=$this->DesignationService->createDesig();
        return view('designation.add', $data);  
    }

   
    public function store(Request $request)
    {   
       
          $this->DesignationService->storeDesig( $request);
          Toastr::success('Designation created successfully', 'Create');
          return redirect()->route('designation.list');
    } 

    public function edit(Designation $Designation, $id)
    {
        $data['edit'] = Designation::findOrFail($id); 
        $data['department']= Department::get();

        return view('designation.edit', $data);
    }  

   
    public function update(Request $request, $id)
    {
        // TODO:: Same as store
        $this->DesignationService->updateDesig( $request, $id);
       
          Toastr::success('Designation created successfully', 'Create');
          return redirect()->route('designation.list');
    }
    
    public function status(Request $request, $status, $id){
        $this->DesignationService->statusDesig( $request,$status, $id);
        
        Toastr::success('Designation status updated successfully', 'Create');
        return redirect()->route('designation.list'); 
    }
}
