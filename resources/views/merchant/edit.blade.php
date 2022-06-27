@php
$user = Auth::loginUsingId(Auth::id());
@endphp
@extends('layouts.login')
@section('title')
Edit {{$data->first_name}}
@endsection 
@section('main-section')
<style>
    .error{
        color:red;
    }
</style>
     <div class="container">
    @if(session('success')){
        <div class="alert alert-success alert-dismissible fade show">
            {{session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    }
    @endif
    @if(session('error')){
        <div class="alert alert-danger alert-dismissible fade show">
            {{session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    }
    @endif
    
</div>
<section class="container mt-4 py-4">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
                <div class="card-header">
                    <h1 class="card-title">Edit User Details</h1>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
        <form id="form" action=@if ($user['role']==1)
            "{{url('update')."/".$data->id}}"
        @else
        "{{url('merchant/update')."/".$data->id}}"
        @endif method="POST" enctype="multipart/form-data" >
        <div class="card-body">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <label for="fname">First Name</label>
                    <input type="text" class="form-control"id="fname"  name="first_name" value="{{$data->first_name}}">
                    <span class="text-danger" id="fname-error">@error('first_name')
                        {{$message}}*
                    @enderror</span>
                </div>
                <div class="col">
                    <label for="lname">Last Name</label>
                    <input type="text" class="form-control"  id="lname" name="last_name" value="{{$data->last_name}}">
                    <span class="text-danger" id="lname-error">@error('last_name')
                        {{$message}}*
                    @enderror</span>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email ID</label>
                <input type="mail" class="form-control" id="email" name="email" value="{{$data->email}}">
                <span class="text-danger" id="email-error">@error('email')
                    {{$message}}*
                @enderror</span>
            </div>
        
            <div class="form-group">
                <label for="exampleInputFile">Profile Pic</label>
                @if ($data->profile_img !="")
                <input type="hidden" name="old_img" value="{{$data->profile_img}}">
                <img src="{{url('/images/'.$data->profile_img)}}" width="100" height="100" class="float-right" alt="">
                @else
                <img src="{{asset('images'.'/'.'default.jpg')}}" width="100" height="100"  class="float-right" alt="">
                @endif
                <br>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="form-control custom-file-input" id="g" name="profile_image">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                          </div>
                    </div>
                </div>
                <span class="text-danger" id="profile_image-error">@error('profile_image')
                    {{$message}}
                @enderror</span>
            </div>
            
            <div class="form-group">
                <label for="g">Role</label>
                <select class="form-control" id="g" name="role">
                    @if ($data->role==3)
                    <option value="3">Employee</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="dob">DOB</label>
                <input type="date" class="form-control" id="dob" name="dob" value="{{$data->dob}}">
                <span class="text-danger" id="dob-error">@error('dob')
                    {{$message}}*
                @enderror</span>
            </div>
            <div class="card-footer">
                <button type="submit" id="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
    <div class="form-group">
        <a href="{{url('/back')}}"class="btn btn-primary p-1 mb-2">Back</a>

    </form>
</div>
<!-- /.card -->
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.4/jquery.validate.min.js" ></script>
<script>
$(document).ready(function()
{
    var form=$('#form');
        if(form.length){
            $('#form').validate({
            rules:{
                first_name:{
                    required:true
                },
                email:{
                    required:true,
                    email:true
                }
                ,
                password:{
                    required:true,
                    minlength: 6
                },
                dob:{                                    
                    required:true,
                    date: true,
                    dob_check:true
                }
            },
            messages:{
                first_name:{
                    required:"Please Enter First Name"
                },
                email:{
                    required:"Please Enter Email Address",
                },
                password:{
                    required:"Please Enter a Password",
                },
            }

        });
        $.validator.addMethod("dob_check", function(element) {
            var dob=$('#dob').val();
            var today=new Date();
            var dob=new Date(dob);
            var age=Math.floor((today-dob)/(365.25* 24* 60*60*1000));
            if (age>10){
                return true;}
            },"You are under age. Age must be greater than 10 !");
}
 
});
</script>
@endsection
