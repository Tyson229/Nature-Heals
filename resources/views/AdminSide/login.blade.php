@extends('layouts.adminloginLayout')

@section('style')
    <style>
      .content{
        margin-top: 15%;
      }
      .image{
        width: 50vh;
        height: 50vh;
      }
    </style>
@endsection

@section('content')
<body class="bg-dark text-white" >
      <main class="container p-2" >
        <div class="row content">
          <div class="col-4 align-self-center" text-center>
            <img src="/pictures/Logo.jpg" class="image border rounded-3">
          </div>
          <div class="offset-1 col-6 align-self-center p-2">
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <h1 class="display-4">Login</h1>
              <div class="form-outline mb-md-3">
                <label class="form-label" for="UserName"><strong>Email</strong></label>
                <input name="email" type="email" id="Email address" class="form-control form-control-lg" />
                  @if($errors->has('email'))
                      <span class="error" style="color:red">{{  $errors->first('email') }}</span>
                  @endif
              </div>

              <div class="form-outline mb-3">
                <label class="form-label" for=""><strong>Password</strong></label>
                <input name="password" type="password" id="Password" class="form-control form-control-lg">
                  @if ($errors->has('password'))
                    <span class="error" style="color:red">{{  $errors->first('password') }}</span>
                  @endif
              </div>
    
              <div class="d-flex justify-content-between align-items-center">
                <a href="/login/forgotPassword" class="text-white">Forgot password?</a> 
              </div>
    
              <div>
                <button class="btn btn-success btn-lg float-end" type="submit"> Login </button>
              </div>
            </form>
          </div>
        </div>
      </main>

    </body>
@endsection