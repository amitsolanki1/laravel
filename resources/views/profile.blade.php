@extends('layouts.app')
@section('title')
    Profile Page
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
                        @if($user['role']==1)
                        <li class="nav-item">
                            <a href="{{url('/admin')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Merchant Management</p>
                            </a>
                        </li>
                       
                        @elseif($user['role']==2)
                        <li class="nav-item">
                            <a href="{{url('/admin-employee')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Employee Management</p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{url('/myaccount')}}" class="nav-link active">
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
                    <h1 class="m-0">Profile</h1>
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
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src=
                @if($user['profile_img']!="")
                "{{asset('images').'/'.$user['profile_img']}}"
                @else
                "{{asset('images').'/default.jpg'}}"
                @endif alt="User profile picture">
              </div>

              <h3 class="profile-username text-center">{{$user['first_name']." ".$user['last_nmae']}}</h3>

              <p class="text-muted text-center">{{$user['email']}}</p>
              <ul class="list-group list-group-unbordered mb-3">
                @if($user['role']==1)
                <li class="list-group-item">
                    <b>Total Merchnat</b> <a class="float-right">{{$total_merchant}}</a>
                </li>
                <li class="list-group-item">
                    <b>Total Employee</b> <a class="float-right">{{$total_employee}}</a>
                </li>
                @elseif($user['role']==2)
                <li class="list-group-item">
                    <b>Total Employee</b> <a class="float-right">{{$total_employee}}</a>
                </li>
                @endif
              </ul>

              {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
            </div>
            <!-- /.card-body -->
          </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">User Details</a></li>
                </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                <div class="tab-content">
                <div class="active tab-pane" id="settings">
                  <form class="form-horizontal" >
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">First Name</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputName" placeholder="Name" value="{{$user['first_name']}}">
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName"  value="{{$user['last_name']}}">
                        </div>
                      </div>
                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{$user['email']}}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputName2" class="col-sm-2 col-form-label">Status</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName2" placeholder="" value=@if($user['status']==1)"Active" @endif>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputExperience" class="col-sm-2 col-form-label">DOB</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder=""value="{{ date('M-d-Y', strtotime($user['dob']))}}" >
                      </div>
                    </div>
                  
                  </form>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
</div>
@endsection
