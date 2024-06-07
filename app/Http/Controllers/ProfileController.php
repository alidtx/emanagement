<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Services\FileUploadService;
class ProfileController extends Controller
{
    public $user;
    protected $fileUploadService;
    public function __construct()
    {
        $this->fileUploadService = new FileUploadService();
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    public function index()
    {
        // if (is_null($this->user) || !$this->user->can('dashboard.view')) {
        //     abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        // }
        $user=DB::table('users')->where('id', $this->user->id)->first();
        return view('profile.show',compact('user'));
    }
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('dashboard.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        $request->validate([
            'profile_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $path=url('/storage/').$this->fileUploadService->uploadOne($request->file("profile_img"), 'public/profile_image', '/profile_image');
        DB::table('users')->where('id',Auth::id())->update(['profile_image'=>$path]);
        return back()->with('success', 'You have successfully upload image.'); 
    }
}
