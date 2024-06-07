<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('home');
    }

    public function getLastFourWeekPurchaseData(Request $request)
    {

        $fourWeeksAgo = Carbon::now()->subWeeks(4);

        $weeklyOrders = DB::table('orders')
            ->select(DB::raw('YEAR(created_at) as year, WEEK(created_at) as week'), DB::raw('COUNT(*) as total_orders'))
            ->where('created_at', '>=', $fourWeeksAgo)
            ->groupBy('year', 'week')
            ->orderBy('year', 'week')
            ->get();


        dd($weeklyOrders);

        return $weeklyOrders;
    }
    public function change_password(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            Toastr::error('Old password does not matched');
            return back();
        }
        try {
            if (Auth::check()) {
                $password = bcrypt($request->password);
                User::where('id', Auth::user()->id)->update(["password" => $password]);
                Toastr::success('Password Change Successfully');
                $user =auth()->user();
                $message = [
                    "message"              => "Your Paasword has been changed",
                    "title"                 => "Password Change",
                    "url"                  => url('/change-password')
                ];
                Helper::adminNotification($user, $message);
                return back();
            }
        } catch (Exception $e) {
            Log::info($e->getMessage());
            Toastr::error($e->getMessage());
            return back();
        }
    }
    public function change_password_view()
    {
        return view("profile.change-password");
    }
    public function marAllAsRead(Request $request)
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();
        Toastr::success('All Notifications Marked as Read', 'Success');
        return redirect()->back();
    }
}
