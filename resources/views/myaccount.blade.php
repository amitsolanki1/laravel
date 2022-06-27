<!doctype html>
<html lang="en">
    @php
$user=Auth::loginUsingId(Auth::id());
@endphp
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <style>
    body {
        background: rgb(99, 39, 120)
    }
    
    .form-control:focus {
        box-shadow: none;
        border-color: #BA68C8
    }
    
    .profile-button {
        background: rgb(99, 39, 120);
        box-shadow: none;
        border: none
    }
    
    .profile-button:hover {
        background: #682773
    }
    
    .profile-button:focus {
        background: #682773;
        box-shadow: none
    }
    
    .profile-button:active {
        background: #682773;
        box-shadow: none
    }
    
    .back:hover {
        color: #682773;
        cursor: pointer
    }
    
    .labels {
        font-size: 11px
    }
  
  </style>
  <body>
      
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                @if ($user['profile_img'] !="")
                <input type="hidden" name="old_img" value="{{$data->profile_img}}">
                <img class="rounded-circle mt-5" width="150px" hight="100px "src="{{asset('images/'.$user['profile_img'])}}">
                @else
                <img src="{{asset('images'.'/'.'default.jpg')}}" width="100" height="100"  class="float-right" alt="">
                @endif
                <br><span class="font-weight-bold">{{$user['first_name']}}</span><span class="text-black-50">{{$user['email']}}</span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Name</label><input type="text" class="form-control" placeholder="first name" value="{{$user['first_name']}}"></div>
                    <div class="col-md-6"><label class="labels">Surname</label><input type="text" class="form-control" value="{{$user['last_name']}}" placeholder="surname"></div>
                </div>
                <div class="col-md-12"><label class="labels">Email ID</label><input type="text" class="form-control" placeholder="enter email id" value="{{$user['email']}}"></div>
                <div class="col-md-12"><label class="labels">Status</label><input type="text" class="form-control" placeholder="enter address line 2" value="{{$user['status']}}"></div>
                    <div class="col-md-12"><label class="labels">DOB</label><input type="text" class="form-control" placeholder="country" value="{{$user['dob']}}"></div>
                    {{--  <div class="col-md-12"><label class="labels">State/Region</label><input type="text" class="form-control" value="{{$user['']}}" placeholder="state"></div>  --}}
                </div>
                <div class="mt-1 p-4 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div>
            </div>
        </div>
        @if ($user['role']==1)
            <a href="{{url('/admin')}}"class="btn btn-primary p-1 mb-2">Back</a>
        @elseif($user['role']==2)
            <a href="{{url('/merchant')}}"class="btn btn-primary p-1 mb-2">Back</a>
        @else
        <a href="{{url('/employee')}}"class="btn btn-primary p-1 mb-2">Back</a>
        @endif
    </div>
</div>
</div>
</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>