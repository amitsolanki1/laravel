<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\MerchantController;

class RegisterController extends Controller
{
    //
    public function index(Request $request){
        // print_r($request->path());
        print_r(\URL::previous());
        if($request->header('referer')=='http://127.0.0.1:8000/merchant'){
            // echo "merchant";
            
            return redirect()->action([MerchantController::Class,'create']);
            
        }
        else if($request->header('referer')=='http://127.0.0.1:8000/admin')
            {
                
                return redirect()->action([AdminController::Class,'create']);
            }
            die();
            return view('register');
    }

    public function active(User $id){

    }

    public function deactive(User $id){
        
    }

   
}
