<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Designation;
use Illuminate\Http\Request;
use validator;
use Brian2694\Toastr\Facades\Toastr;
use App\Services\EmployeeService;
use Illuminate\Support\Facades\Log;
class EmployeeController extends Controller
{
    
    private $EmployeeService;

   public function __construct(EmployeeService $EmployeeService)
   {
      $this->EmployeeService=$EmployeeService;
   }


    public function index()
    {    
      $data['emaployees']=$this->EmployeeService->getEmpData();
     
      return view('employees.list', $data);
    }

  
    public function create()
    {  
        $data['designation']= $this->EmployeeService->createEmp();   
        return view('employees.add', $data);  
    }

   
    public function store(Request $request)
    {   
          $this->EmployeeService->storeEmp($request); 
          Toastr::success('Employee created successfully', 'Create');
          return redirect()->route('employees.list');
    } 

    public function edit(Employee $employee, $id)
    {   
        $data=$this->EmployeeService->editEmp( $id); 
        return view('employees.edit', $data);
    }  

   
    public function update(Request $request, $id)
    {
          $this->EmployeeService->updateEmp($request,  $id);
          Toastr::success('Employee updated successfully', 'Create');
          return redirect()->route('employees.list'); 
    }
      
    public function status(Request $request, $status, $id){
        $this->EmployeeService->statusEmp($request,$status, $id);
        Toastr::success('Employee status updated successfully', 'Create');
        return redirect()->route('employees.list'); 
    }



}
