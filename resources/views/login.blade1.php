@extends('layouts.login')
@section('title')
Login Page
@endsection
@section('main-section')
<style>
    .error {
        color: red;
    }
</style>
<div class="container mt-4">
    @if(isset($success))
    <div class="alert {{ Session::get('alert-class', 'alert-success') }} alert-dismissible fade show">
    {{$success }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<!-- error -->
@if(isset($error))
<div class="alert {{ Session::get('alert-class', 'alert-danger') }} alert-dismissible fade show">
    {{ $error }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
</div>
<section class="container mt-4 py-4">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Login</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="form" action="{{ route('login') }}" method="POST">
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email ID</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email') }}">
                            <span class="text-danger" id="email-error">
                                @error('email')
                                    {{ $message }}*
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                value="{{ old('password') }}">
                            <span class="text-danger" id="password-error">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="terms" class="custom-control-input"
                                id="exampleCheck1">
                            <label class="custom-control-label" for="exampleCheck1">I agree to the <a
                                    href="#">terms of service</a>.</label>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" id="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>

</section>

<footer class="" style="margin-top: 50vh">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
    </div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
            integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.4/jquery.validate.min.js"
            integrity="sha512-FOhq9HThdn7ltbK8abmGn60A/EMtEzIzv1rvuh+DqzJtSGq8BRdEN0U+j0iKEIffiw/yEtVuladk6rsG4X6Uqg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        if ($('#form').length) {
            $('#form').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                    },
                },
                messages: {
                    email: {
                        required: "Please Enter Email Address",
                    },
                    password: {
                        required: "Please Enter a Password",
                    },
                }
            });
        }

    });
</script>
@endsection
