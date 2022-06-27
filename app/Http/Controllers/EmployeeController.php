<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EmployeeController extends Controller
{
    public function index()
    {
        if(Auth::user()){
            $id=Auth::id();
            $user=Auth::loginUsingId($id);
            if($user['role']==3 && $user['status']==1)
            {
                return view('employee.index');
            }
            else{
                $error="You're Not Active to LoggedIn Please contact Your Admin!";
                return view('login',compact('error'));
           }
        }
    }


     public function show()
    {
        return view('myaccount');
    }


    public function edit(User $id)
    {
        $data=$id;
        return view('myaccount',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|max:50',
            'last_name' => 'nullable|max:50',
            'email'=> 'required|email',
            'dob' => 'required|date|before:12 years',
            'role'=>'required',
        ]);
        if($request->hasFile('profile_image')){
            $image = $request->file('profile_image');
            $ext = $image->getClientOriginalExtension();
            $filename=time().".".$ext;
            $image->move(public_path('/images'),$filename);
        }
        else{
            $filename=$request->old_img;
        }
        User::where('id',$id)->update([ 
            'role'=>$request->role,
            'first_name'=>$request->first_name,
            'last_name' => $request->last_name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'profile_img'=>$filename,
            'dob'=>$request->dob,
        ]);
        $url=url('merchant');
        return redirect($url)->with('success','User Edit successfully!');
        
    }
}
