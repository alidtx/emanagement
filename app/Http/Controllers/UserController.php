<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\FileUploadService;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;
use App\Helpers\Helper;

class UserController extends Controller
{
    protected  $fileUploadService;
    public function __construct()
    {
        $this->middleware('permission:User-create')->only("create", "index");
        $this->middleware('permission:User-view')->only("show");
        $this->middleware('permission:User-edit')->only("edit", "update");
        $this->middleware('permission:User-delete')->only("destroy");
        $this->fileUploadService = new FileUploadService();
    }

    public function index(Request $request): View
    {
        $query = User::query();

        if ($request->filled("user_id")) {
            $query->where("id", $request->user_id);
        }
        if ($request->filled("email")) {
            $query->where("email", $request->email);
        }
        if ($request->filled("phone")) {
            $query->where("phone", $request->phone);
        }
        if ($request->filled("user_type")) {
            $query->where("user_type", $request->user_type);
        }
        $default_page = config("constants.default");
        $item_per_page = request()->input('per_page', $default_page);
        $users = $query->paginate($item_per_page)->appends($request->except("_token"));
        $userDropdown = User::dropdown();
        return view('users.index', compact('users', 'userDropdown'))
            ->with('i', ($request->input('page', 1) - 1) * $default_page);
    }
    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create(): View
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }
    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,NULL,id,deleted_at,NULL',
            'phone' => 'required|min:11|unique:users,phone,NULL,id,deleted_at,NULL',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            'status' => 'required',
            'profile_image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'user_type' => 'required'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        if ($request->hasFile('profile_image')) {
            $input["profile_image"] =  $this->fileUploadService->uploadOne($request->file("profile_image"), 'public/profile_image', 'profile_image');
        }
        $user = User::create($input);
        #notification
        $message = [
            "message"              => "Your account has been created successfully. Please change your password.",
            "title"                 => "Account Created",
            "url"                  => url('/change-password')
        ];
        Helper::adminNotification($user, $message);
        $user->assignRole($request->input('roles'));
        Toastr::success('User created successfully', 'Create');
        return redirect()->route('users.index');
    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id): View
    {

        $user = User::find($id);
        return view('users.show', compact('user'));
    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id): View

    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('users.edit', compact('user', 'roles', 'userRole'));
    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id): RedirectResponse

    {
        $this->validate($request, [

            'name' => 'required',
            'phone' => 'required|min:11|unique:users,phone,' . $id . ',id,deleted_at,NULL',
            'email' => 'required|email|unique:users,email,' . $id . ',id,deleted_at,NULL',
            'password' => 'same:confirm-password',
            'roles' => 'required',
            'status' => 'required',
            'profile_image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'user_type' => 'required'

        ]);
        $input = $request->all();
        if (!empty($input['password'])) {

            $input['password'] = Hash::make($input['password']);
        } else {

            $input = Arr::except($input, array('password'));
        }
        $user = User::find($id);
        if ($request->hasFile('profile_image')) {
            $input['profile_image'] =  $this->fileUploadService->uploadOne($request->file("profile_image"), 'public/profile_image', 'profile_image', $user->profile_image);
        }
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));
        Toastr::success('User updated successfully', 'Update');
        return redirect()->route('users.index');
    }
    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)
    {
        User::find($id)->delete();
        Toastr::success('User deleted successfully', 'Delete');
        return redirect()->route('users.index');
    }

    public function userStatusUpdate(Request $request)
    {
        $row = User::find($request->id);
        $row->status = !$row->status; // Toggle the status
        $row->save();

        return response()->json([
            'success' => true,
            'newStatus' => $row->status ? 'Active' : 'InActive'
        ]);
    }
}
