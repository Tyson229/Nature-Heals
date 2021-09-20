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
<<<<<<< HEAD
<body class="bg-dark text-white" >
      <main class="container p-2" >
        <div class="row content">
          <div class="col-4 align-self-center" text-center>
            <img src="/pictures/Logo.jpg" class="image border rounded-3">
          </div>
          <div class="offset-1 col-6 align-self-center p-2">
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <h1 class="display-2" style="color: #96c0b7">Login</h1>
              <div class="form-outline mb-md-3">
                <label class="form-label" for="Email" style="color: #96c0b7"><strong>Email</strong></label>
                <input name="email" type="email" id="Email" class="form-control form-control-lg" />
                  @if($errors->has('email'))
                      <span class="error" style="color:red">{{  $errors->first('email') }}</span>
                  @endif
              </div>
=======
<main>
    <body style="background-color: #f8f6f5;">
    
        <section class="vh-100">
            <div class="container-fluid">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-4">
                  <img src="/pictures/Logo.jpg" class="card-img-top" width="200" height="550">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="log1"><p>Log In</p></div>
                    
                    <div class="form-outline mb-md-3">
                                      <label class="form-label" for="UserName">Email address</label>
    
                      <input name="email" type="email" id="Email address" class="form-control form-control-lg" />
                        @if($errors->has('email'))
                            <span class="error" style="color:red">{{  $errors->first('email') }}</span>

                        @endif
                    </div>
          
                    
                    <div class="form-outline mb-3">
                                      <label class="form-label" for="">Password</label>
    
                      <input name="password" type="password" id="Password" class="form-control form-control-lg">
                        @if ($errors->has('password'))
                        <span class="error" style="color:red">{{  $errors->first('password') }}</span>
                        @endif
                    </div>
          
                    <div class="d-flex justify-content-between align-items-center">
                      
                      
               
                  <p style="color:red;"><a href="/login/forgotPassword">Forgot password?</a></p> 
                    </div>
          
                    <div>
>>>>>>> origin/HaoBranch

              <div class="form-outline mb-3">
                <label class="form-label" for="Password" style="color: #96c0b7"><strong>Password</strong></label>
                <input name="password" type="password" id="Password" class="form-control form-control-lg">
                  @if ($errors->has('password'))
                    <span class="error" style="color:red">{{  $errors->first('password') }}</span>
                  @endif
              </div>
    
              <div class="d-flex justify-content-between align-items-center">
                <a href="/login/forgotPassword" class="text-white">Forgot password?</a> 
              </div>
    
              <div>
                <button class="btn btn-lg float-end text-white" style="background-color: #96c0b7" type="submit"> Login </button>
              </div>
            </form>
          </div>
        </div>
      </main>

    </body>
@endsection