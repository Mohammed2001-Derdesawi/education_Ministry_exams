<?php

namespace App\Http\Controllers\admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\auth\RegisterRequest;
use App\Models\Office;
use App\Models\Specialization;

class AdminController extends Controller
{
 public function registerPage()
 {
    $specializations=Specialization::select('id','specialization')->get();
    $offices=Office::select('id','name')->get();
    return view('admin.auth.register',['specializations'=>$specializations,'offices'=>$offices]);
 }

 public function register(RegisterRequest $request)
 {
    $admin=Admin::create([
        'email'=>$request->email,
        'password'=>bcrypt($request->password),
        'specialization_id'=>$request->specialization,
        'office_id'=>$request->type=='office'?$request->office:NULL
    ]);

    return redirect()->route('admin.login')->with('success','تم تسجيل الحساب بنجاح');

 }

 public function loginPage()
 {
    return view('admin.auth.login');
 }

 public function login(LoginRequest $request)
 {
    if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){
         return redirect()->route('admin.fields.index');
    }

    return redirect()->route('admin.login.page')->with('faild','كلمة المرور خاطئة');
 }


}
