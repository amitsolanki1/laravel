<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()){
            $id=Auth::id();
            $user=Auth::loginUsingId($id);
            if($user['role']==1)
            {
                $data=User::all()->where('role',2);
                $total_merchant=sizeof($data);
                $total_employee=sizeof(User::all()->where('role',3));
                return view('admin.index',compact('data','total_merchant','total_employee'))->with('success','You are Logged in !!!');
            }
            else{
                return view('login');
        }
    }
}
    public function index_employee()
    {
        $data=User::all()->where('role',3);
        $total_employee=sizeof($data);
        $total_merchant=sizeof(User::all()->where('role',2));
        return view('admin.index-employee',compact('data','total_merchant','total_employee'));
    }

 
    public function create()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:50',
            'last_name' => 'nullable|max:50',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|min:6',
            'dob' => 'required|date|before:12 years',
            'role'=>'required',
        ]);
        // $user = new User();
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
            'first_name'=>$request->first_name,
            'last_name' => $request->last_name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'profile_img'=>$filename,
            'role'=>$request->role,
            'dob'=>$request->dob,
        ]);
        if($request->role==2){
            $url=url('admin');
        }
        else{
            $url=url('admin-employee');
        }
        return redirect($url)->with('success','User Created successfully!');
    }

    public function show(User $id)
    {
        $data=$id;
        return view('admin.show',compact('data'));
    }

 
    public function edit(User $id)
    {
        $data=$id;
        return view('admin.edit',compact('data'));
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
        if($request->role==2){
            $url=url('admin');
        }
        else{
            $url=url('admin-employee');
        }
        return redirect($url)->with('success','User Edit successfully!');
        
    }

    public function destroy($id)
    {
    $data=User::find(['id'=>$id],'role')->first();
     User::where('id',$id)->delete();
     if($data->role==2){
         $url=url('admin');
     }
     else{
         $url=url('admin-employee');
     }
     return redirect(url('admin'))->with('success','User Deleted Successfully!');
    }

    public function active($id){
        User::where('id',$id)->update(['status'=>1]);
        $data=User::find(['id'=>$id],'role')->first();
        if($data->role==2){
            $url=url('admin');
        }
        else{
            $url=url('admin-employee');
        }
        return redirect($url)->with('success','Status Updated!');

    }

    public function deactive($id){
        User::where('id',$id)->update(['status'=>0]);
        $data=User::find(['id'=>$id],'role')->first();
        if($data->role==2){
            $url=url('admin');
        }
        else{
            $url=url('admin-employee');
        }
        return redirect($url)->with('success','Status Updated!');

    }

}
