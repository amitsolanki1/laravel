@extends('layouts.app')
@section('title')
    Admin  
@endsection
@section('main-section')
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
                            <a href="{{url('/admin-employee')}}" class="nav-link active">
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
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
               
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$total_merchant}}</h3>
                            <p>Total Merchant</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h2>{{$total_employee}}</h2>
                            <p>Total Employee</p>
                          </div>
                          <div class="icon">
                              <i class="ion ion-bag"></i>
                          </div>
                      </div>
                 </div>
            </div>
        </div>
        
    </section>
    <!-- right col -->
    <a href="/register-admin" class="btn btn-primary mt-3 ml-4 ">+ Create New User</a> 
    
    
        <h2 class="text-center text-primary mt-4 py-3 pb-4">Employee Details</h2>
        <div class="container">
            @if(Session::has('success'))
            <div class="alert {{ Session::get('alert-class', 'alert-success') }} alert-dismissible fade show">
            {{ Session::get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        
        <!-- error -->
        @if(Session::has('error'))
        <div class="alert {{ Session::get('alert-class', 'alert-danger') }} alert-dismissible fade show">
            {{ Session::get('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        </div>
    <div class="col-12">
                <br>
                <table class="table table-bordered mt-3 table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Role</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th >Profile Pic</th>
                            <th>DOB</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>@php
                        $count=1;
                    @endphp
                        @foreach($data as $i)
                        <tr>
                            <td>{{$count  }}</td>
                            <td>@if ($i->role==1)
                                Admin
                            @elseif($i->role==2)
                                Merchant
                            @else
                            Employee
                            @endif</td>
                            <td>{{ $i->first_name.' '.$i->last_name }}</td>
                            <td>{{$i->email}}</td>
                            <td>
                                @if ($i->profile_img=="")
                                    <img src="{{asset('images/'.'default.jpg')}}" width="100px" height="100px" alt="">
                                @else
                                <img src="{{asset('images/'.$i->profile_img)}}" width="100px" height ="100px" alt="">
                                @endif
                            </td>
                            <td>{{date('M-d-Y', strtotime($i->dob))}}</td>

                            @if ($i->status == 1)
                            <td> <a
                                    onclick="fun({{ $i->id }},'{{ url('deactive') }}','Deactivate')"class="badge badge-success btn-sm">Active</a>
                            </td>
                        @else
                            <td> <a onclick="fun({{ $i->id }},'{{ url('active') }}','Activate')"
                                    class="badge badge-warning btn-sm">Deactive</a></td>
                        @endif
                        <td>{{ date('M-d-Y', strtotime($i->created_at)) }}</td>
                        <td>
                            <a href="{{ url('view') . '/' . $i->id }}"
                                class="btn btn-secondary btn-sm">View</a>
                            <a href="{{ url('edit') . '/' . $i->id }}" class="btn btn-primary btn-sm">Edit</a>
                            <a class="btn btn-danger btn-sm"
                                onclick="fun({{ $i->id }},'{{ url('delete') }}','Delete')">Delete</a>
                        </td>
                        </tr>
                        @php
                        $count++;
                    @endphp
                        @endforeach
                    </tbody>
                </table>
            </div> 
        </div>
    </div>



</div>
<!-- /.row (main row) -->

</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    function fun(id,url_,type) {
       if (confirm("Do you want to "+type+" this ?")) {
           console.log(url_+"/"+ id);
           window.location = url_+"/"+ id;
       }
}
</script>
@endsection