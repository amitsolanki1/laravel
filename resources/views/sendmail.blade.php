<h1>Forget Password Link</h1>

you can reset your password from bellow link:
{{-- <a href="{{route('reset-forget-password',[$email,$token])}}">Rest Password</a> --}}
<a href="{{url('/reset-forget-password/'.$email.'/'.$token)}}">Rest Password</a>