<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Services\ExpenseService;
class ExpenseController extends Controller
{  

    private $ExpenseService;  
    
    public function  __construct(ExpenseService $ExpenseService)
    {
        $this->ExpenseService=$ExpenseService;
    }

    public function index()
    {    
      $data['expense']=$this->ExpenseService->getExpgData();
      return view('expense.list', $data);
    }

  
    public function create()
    {  
        $data['expense']= Expense::get();
        $data['employee']= Employee::get();
        return view('expense.add', $data);  
    }

   
    public function store(Request $request)
    {   

          $data['expense']=$this->ExpenseService->storeExp($request);
          Toastr::success('Exense created successfully', 'Create');
          return redirect()->route('expense.list');
    } 

    public function edit(Expense $Expense, $id)
    {   
      $data=$this->ExpenseService->editExp($id);
        return view('expense.edit', $data);
    }  

   
    public function update(Request $request, $id)
    {

         $data['expense']=$this->ExpenseService->updateExp($request, $id);
          Toastr::success('Expense created successfully', 'Create');
          return redirect()->route('expense.list');
    }
    
    public function status(Request $request, $status, $id){
      $data['expense']=$this->ExpenseService->statusExp($request,$status, $id);
     
      Toastr::success('Expense status updated successfully', 'Create');
      return redirect()->route('expense.list'); 
  }
}
