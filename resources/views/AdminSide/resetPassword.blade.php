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
								<form id="register-form" role="form" autocomplete="off" class="form" method="post" action="{{ route('password.update') }}">
									@csrf
									<h1 class="display-2" style="color: #96c0b7">Reset Password</h1>
										<input type="hidden" class="hide" name="token" id="token" value="{{ $token }}"> 
										<div class="form-outline mb-md-3">
												<label class="form-label" for="UserName" style="font-size:14px; color: #96c0b7">Email address</label>
												<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
											</div>
											<div class="form-outline mb-3">
												
												@error('email')
													<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
												@enderror
											</div><br>

											<div class="form-outline mb-3">
												<label class="form-label" for="UserName" style="font-size:14px; position:relative; top:-7px; color: #96c0b7">New Password</label>
												<span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
											</div>

											<div class="form-outline mb-3">
												<input style="font-size:14px; position:relative; top:-22px;" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
												@error('password')
													<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
												@enderror
											</div><br>

											<div class="form-outline mb-3">
												<label class="form-label" for="UserName" style="font-size:14px; position:relative; top:-38px; color: #96c0b7">Confirm Password</label>
											<span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
											</div>

											<div class="d-flex justify-content-between align-items-center">
											  <input style="font-size:14px; position:relative; top:-58px;" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
											  @error('password_confirmation')
												<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
											@enderror
										</div>
									</div>
									<div>
										<button name="recover-submit" class="btn btn-lg float-end text-white" style="background-color: #96c0b7; position:relative; left:-106px; top:-22px" value="Reset Password" type="submit"> Reset Password </button>
									  </div>

								
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection