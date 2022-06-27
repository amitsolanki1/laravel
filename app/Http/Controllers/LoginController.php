<?php

namespace App\Http\Controllers;
use Hash;
use App\Http\Controllers;
use Illuminate\Validation;
use DB;
// use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Mail;

class LoginController extends Controller
{
    //
    public function index(){
     
        if(Auth::user()){
            $id=Auth::id();
            $user=Auth::loginUsingId($id);
            if($user['role']==1)
            {
                return redirect()->action([AdminController::class,'index']);
            }
            elseif($user['role']==2){
                return redirect()->action([MerchantController::class,'index']);
            }elseif($user['role']==3){
                return redirect()->action([EmployeeController::class,'index']);
            }
        }else{
            return view('login');
        }
    }

    public function Login(Request $request)
    {
        // dd($request->all());
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password]) ){
            // dd(Hash::make($request->password));
            $id=Auth::id();
            $user=Auth::loginUsingId($id);
            // dd($user);
            if($user['role']==1)
            {
                return redirect()->action([AdminController::class,'index']);
            }
            else if($user['role']==2 ){
                return redirect()->action([MerchantController::class,'index']);

            }else if($user['role']==3 ){
                return redirect()->action([EmployeeController::class,'index']);

            }
        } else {        
            return back()->withErrors([
                'error','Your Account is status is deactivate Please contact Admin!',
            ]);
        }
    }

    public function logout(Request $request){
        if(Auth::check())
        {
            Session::flush();
            Auth::logout();
            return redirect('login')->with('success',"Now you're logout!");
        }
        else{
            return redirect('login')->with('error',"Please enter your details !");
        }
    }

    public function back(){
        return redirect()->back();
    }

    public function profile(){
        $data=User::all()->where('role',2);
        $total_merchant=sizeof($data);
        $total_employee=sizeof(User::all()->where('role',3));
        return view('profile',compact('total_employee','total_merchant'));
    }


    public function forget(){
        return view('forgot-password');
    }
    public function forget_password(Request $request){
        $request->validate([
            'email' => 'required|email',
            // 'email' => 'required|email|exits:user',
        ]);
        $email=base64_encode($request->email);
        $token=rand(10000,99999);

        $data= User::where('email',$request->email)->first();
        if($data){
            DB::table('password_resets')->insert([
                'email'=>$request->email,
                'token'=>$token,
            ]);
            Mail::send('sendmail',['email'=>$email,'token'=>$token],function($msg) use($request){
                $msg->to($request->email);
                $msg->subject('Reset Password');
            });
            return back()->with('success', "we have sent you the password reset mail!");

        }else{
            return back()->with('error','Invalid Email ID');
        }
        
    }

    public function reset_password($email,$token){
        $mail=base64_decode($email);
        $res=DB::table('password_resets')->where([
    'email'=>$mail,
    'token'=>$token])->first();
    if($res){
        return view('recover-password',['token'=>$token,'email'=>$email])->with('success','correct');
        
    }else{
        // return back()->with('error',"Link has been Expired!");
        return view('login')->with('error','Link has been expired!');
    }
    //  200|400

    }

    public function reset(Request $request){
        // dd($request->all());
        $request->validate([
            'password' => 'min:4|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:4'
        ]);
        $email=base64_decode($request->email);
        User::where('email',$email)->update([
            'password'=>Hash::make($request->password)
        ]);
        Mail::send('password_reset_success_mail',['email'=>$email],function($msg) use($email){
            $msg->to($email);
            $msg->subject('Password Changed!');
        });
        return redirect('login')->with('success','Your password is now updated!');    

}
}