@extends('layouts.adminloginLayout')

@section('style')
    <style>
      

        .log1{
     position: relative;
    margin-top;80px;
	font-size:50px;
 }
.container-fluid {
  height: calc(100% - 100px);
  
}
img{
    position: relative;
    left: 20%;  
      
  }
  
  .btn{
      margin: 10px;
      
      
  }

@media (max-width: 450px) {
  .container-fluid {
    height: 100%;
  }
}

    </style>
@endsection

@section('content')
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

                      <button class="btn btn-primary btn-lg float-end" type="submit"> Login </button>
               
                      
                    </div>
          
                  </form>
                </div>
              </div>
            </div>
            
          </section>
    
    
      </body>
</main>
@endsection