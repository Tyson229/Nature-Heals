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
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div> 
@endif

<body class="bg-dark text-white" >
  <main class="container p-2" >
    
    <div class="row content">
    <div class="col-4 align-self-center" text-center>
      <img src="/pictures/Logo.jpg" class="image border rounded-3">
    </div>

    <div class="offset-1 col-6 align-self-center p-2">
      <form id="register-form" role="form" autocomplete="off" class="form" method="post" action="{{route('password.email')}}">
                      @csrf
                      <h1 class="display-2" style="color: #96c0b7">Forget Password?</h1>
                      <div class="form-outline mb-md-3">
                        <label class="form-label" for="Email" style="color: #96c0b7"><strong>Email</strong></label>
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="email" name="email" placeholder="Email address" class="form-control"  type="email" required>
                      </div>


                      <div>
                        <input name="recover-submit" style="background-color: #96c0b7; float:left;"  class="btn btn-lg float-end text-white" value="Reset Password" type="submit">
                      </div>
                    </form>
    
	</div>

</div>  
</main>
      </body>

@endsection