@extends('layouts.adminloginLayout')

@section('style')
<style>
body {
    text-align: center;
}
.container{
    background-color:lightgrey;
    position:relative;
    top:230px;
    padding: 52px;
    width:455px;
    border: 1px solid black;
}
.form-group1{
    position:relative;
    top:30px;
}
    </style>
@endsection

@section('content')
<main>
	<div class="form-gap"></div>
	<div class="container h-100 d-flex justify-content-center">
		<div class="row-md-6">
			<div class="col-md-12 col-md-offset-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="text-center">
							<h3><i class="fa fa-lock fa-4x"></i></h3>
							<h2 class="text-center">Reset Password</h2>
							<p>You can reset your password here.</p>
							<div class="panel-body">
								<form id="register-form" role="form" autocomplete="off" class="form" method="post" action="{{ route('password.update') }}">
									@csrf
										<input type="hidden" class="hide" name="token" id="token" value="{{ $token }}"> 
										<div class="form-group">
											<div class="input-group">
												<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
												@error('email')
													<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
												@enderror
											</div>
											<div class="input-group">
												<span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
												<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
												@error('password')
													<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
												@enderror
											</div>
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
											<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
											@error('password_confirmation')
												<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
											@enderror
										</div>
									</div>
									<div class="form-group1">
										<input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
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