@extends('layouts.login')
@section('title')
Edit {{$data->email}}
@endsection 
@section('main-section')
<section class="container mt-4 py-4">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
                <div class="card-header">
                    <h1 class="card-title">View User Details</h1>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
        <div class="card-body">
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
    <div class="form-group">
        <a href="{{url('/back')}}"class="btn btn-primary p-1 mb-2">Back</a>

    </form>
</div>
<!-- /.card -->
</div>
</div>
@endsection
