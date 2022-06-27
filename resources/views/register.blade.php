
@extends('layouts.app')
@section('title')
    Register page
@endsection
@section('main-section')
<style>
    .error{
        color:red;
    }
</style>
@php
$user=Auth::loginUsingId(Auth::id());
@endphp

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if ($user['profile_img'] !="")
                    <img src="{{ asset('images/' . $user['profile_img']) }}" class="img-circle elevation-2" alt="User Image">
                    @else
                    <img src="{{asset('images'.'/default.jpg')}}" class="img-circle elevatio-2" alt="">
                    @endif
            </div>
            <div class="info">
                <a href="#" class="d-block">{{$user['first_name']." ".$user['last_name']}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Merchant Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/admin-employee')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Employee Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/myaccount')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>My Account</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/logout') }}" class="nav-link">
                                <i class="far fa-lock nav-icon"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Register</h1>
                </div><!-- /.col -->
               
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

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
                    <h1 class="card-title">Register</h1>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
        <form id="form" action=@if ($user['role']==1)
            "{{url('register-admin')}}"
        @else
        "{{url('register-merchant')}}"
        @endif method="POST" enctype="multipart/form-data" >
        <div class="card-body">
            @csrf
        <div class="row">
            <div class="col">
                <label for="fname">First Name</label>
                <input type="text" class="form-control"id="fname" value="" name="first_name"  value="{{old('first_name')}}">
                <span class="text-danger" id="fname-error">@error('first_name')
                    {{$message}}*
                @enderror</span>
            </div>
            <div class="col">
                <label for="lname">Last Name</label>
                <input type="text" class="form-control" value="" id="lname" name="last_name" value="{{old('last_name')}}">
                <span class="text-danger" id="lname-error">@error('last_name')
                    {{$message}}*
                @enderror</span>
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email ID</label>
            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
            <span class="text-danger" id="email-error">@error('email')
                {{$message}}*
            @enderror</span>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}">
            <span class="text-danger" id="password-error">@error('password')
                {{$message}}*
            @enderror</span>
        </div>
     
        <div class="form-group">
            <label for="s">Role</label>
            
            <select class="form-control" id="s" name="role" value="{{old('role')}}">
                @if ($user['role']==1)
                <option value="2">Merchant</option>
                <option value="3">Employee</option>
            @else
                <option value="3">Employee</option>
            @endif
            </select>
            <span class="text-danger" id="role-error">@error('role')
                {{$message}}
            @enderror</span>
        </div>
        <div class="form-group">
            <label for="g">Profile Pic</label>
                    <input type="file" class="form-control custom-dile-input" id="g" name="profile_image">
            </div>
        </div>

        <div class="form-group">
            <label for="dob">DOB</label>
            <input type="date" class="form-control" id="dob" name="dob" value="{{old('dob')}}">
            <span class="text-danger" id="dob-error">@error('dob')
                {{$message}}*
            @enderror</span>
        </div>

        <div class="card-footer">
            <button type="submit" id="submit" class="btn btn-primary">Register</button>
        </div>
    </form>
</div>
<!-- /.card -->
</div>
</div>
</section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
