<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;
class MerchantController extends Controller
{
   
    public function index()
    {
        if(Auth::user()){
            $id=Auth::id();
            $user=Auth::loginUsingId($id);
            if($user['role']==2 && $user['status']==1)
            {
                $data=User::where(['role'=>3,
                'created_by'=>$id])->get();
                $total_employee=sizeof($data);
                return view('merchant.index',compact('data','total_employee'));
            }
            else{
                $error="You're Not Active to LoggedIn Please contact Your Admin!";
                return view('login',compact('error'));
           }
        }
    }

    public function create()
    {
        if(Auth::check())
        {
            return view('register');
        }
        return redirect('login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:50',
            'last_name'=>'nullable',
            'email' => 'required|email|unique:users',
            'password'=> 'required|min:6',
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
            $filename="";
        }
        User::insert([
            'role'=>$request->role,
            'created_by'=>Auth::id(),
            'first_name'=>$request->first_name,
            'last_name' => $request->last_name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'profile_img'=>$filename,
            'dob'=>$request->dob,
        ]);
        return redirect('/merchant')->with('success','Employee Created successfully!');
    }

    public function show(User $id)
    {
        $data=$id;
        return view('merchant.show',compact('data'));
    }

 
    public function edit(User $id)
    {
        $data=$id;
        return view('merchant.edit',compact('data'));
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
            if($filename==""){
                $filename="";
            }
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
        return redirect(url('merchant'))->with('success','Employee Updated Successfully!');
    }

    public function destroy($id)
    {
     User::where('id',$id)->delete();
     return redirect()->back()->with('success','Employee Deleted Successfully!');
    }

    
    public function active($id){
        User::where('id',$id)->update(['status'=>1]);
        return redirect(url('merchant'))->with('success','Status Updated!');
    }

    public function deactive($id){
        User::where('id',$id)->update(['status'=>0]);
        return redirect(url('merchant'))->with('success','Status Updated!');
    }

}