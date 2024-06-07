<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Services\DepartmentService;
class DepartmentController extends Controller
{
   
   private $DepartmentService;

   public function __construct(DepartmentService $DepartmentService)
   {
       $this->DepartmentService=$DepartmentService;
   }


    public function index()
    {    
       
      $data['department']=$this->DepartmentService->getDepData();
      return view('department.list', $data);
    }

  
    public function create()
    {  
         
        return view('department.add');  
    }

   
    public function store(Request $request)
    {   
        
          $this->DepartmentService->storeDep($request); 
          Toastr::success('Department created successfully', 'Create');
          return redirect()->route('department.list');
    } 

    public function edit(Department $Department, $id)
    {
        
        $data['edit']=$this->DepartmentService->editDep($id); 
        return view('department.edit', $data);
    }  

   
    public function update(Request $request, $id)
    { 
          $this->DepartmentService->updateDep($request,$id); 
          Toastr::success('Department updated successfully', 'Create');
          return redirect()->route('department.list'); 
    }

    public function status(Request $request, $status, $id){
        $this->DepartmentService->statusDep($request,$status,$id); 
 
        Toastr::success('Department status updated successfully', 'Create');
        return redirect()->route('department.list'); 
    }
}
