<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create()
    {

        $settings = Setting::get();
        $data = [];

        $data = $settings->pluck('value', 'key')->mapWithKeys(function ($value, $key) {
            return [$key => $value];
        })->all();

        return view('settings.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request)
    {

        $data = $request->except("_token");

        foreach ($data as $key => $value) {

            if ($request->hasFile($key)) {
                $value = (new FileUploadService)->uploadOne($request->file($key), "public/$key", "$key");
            }
            Setting::set($key, $value);
        }

        Toastr::success('Settings updated successfully');

        return redirect()->back();
    }
}
