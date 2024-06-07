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
use App\Models\Payment;
class PaymentService
{

     
  public function getPaydata() {
    $data=Payment::with(['user', 'event', 'employee'])->orderBy('id','DESC')->paginate(5);
    return $data;
    }
   

}