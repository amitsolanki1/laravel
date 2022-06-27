<!doctype html>
<html lang="en">
  <head>
    <title>Show {{$data->email}} data</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-4 py-4">
        <h2 class="text-center text-dark mb-4">View Detail</h2>
        <div class="row">
            <div class="col">
                <label for="fname">First Name</label>
                <input type="text" class="form-control" readonly id="fname" name="first_name"
                    value="{{ $data->first_name }}">
            </div>
            <div class="col">
                <label for="lname">Last Name</label>
                <input type="text" class="form-control" readonly id="lname" name="last_name"
                    value="{{ $data->last_name }}">
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email ID</label>
            <input type="mail" class="form-control" readonly id="email" name="email" value="{{ $data->email }}">
        </div>
      
        <div class="form-group">
            <label for="g">Role</label>
            <select class="form-control" readonly id="g" name="gender">
                @if ($data->role == 3)
                    <option value="3">Employee</option>
                @else
                    <option value="3">Merchant</option>
                @endif
            </select>
        </div>
        <div class="form-group">
            <label for="Status">Status</label>
            <input type="text" class="form-control" readonly id="Status" name="role"
                value=@if ($data->status==1)
                    "Active"
                    @else
                    "Deactive"
                @endif>
        </div>
        <div class="form-group">
            <label for="dob">DOB</label>
            <input type="date" class="form-control" readonly id="dob" name="dob" value="{{ $data->dob }}">
        </div>
        <div class="form-group">
            <label for="p">Profile Pic</label>
            @if ($data->profile_img !="")
            <input type="hidden" name="old_img" value="{{$data->profile_img}}">
            <img src="{{url('/images/'.$data->profile_img)}}" width="100" height="100" class="float-right" alt="">
            @else
            <img src="{{asset('images/'.'default.jpg')}}" width="100px" height="100px"  class="float-right" alt="">
            @endif
        </div>
       
        <div class="form-group">
            <a href="{{url('/back')}}" class="btn btn-primary">Back</a>
        </div>
       
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
   