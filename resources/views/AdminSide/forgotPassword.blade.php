@extends('layouts.adminloginLayout')

@section('style')
<style>
body {
    text-align: center;
}
.container{
    background-color:lightgrey;
    position:relative;
    top:240px;
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
	@if (session('status'))
		<div class="alert alert-success" role="alert">
			{{ session('status') }}
		</div>
	@endif
	<div class="container h-100 d-flex justify-content-center">
		<div class="row-md-6">
			<div class="col-md-12 col-md-offset-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="text-center">
							<h3><i class="fa fa-lock fa-4x"></i></h3>
							<h2 class="text-center">Forgot Password?</h2>
							<p>You can reset your password here.</p>
							<div class="panel-body">
								<form id="register-form" role="form" autocomplete="off" class="form" method="post" action="{{route('password.email')}}">
									@csrf
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
											<input id="email" name="email" placeholder="Email address" class="form-control"  type="email" required>
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
