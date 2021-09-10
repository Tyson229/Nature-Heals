@extends('layouts.userLayout')

@section('style')
<style>

html{
		font-size:1.2rem;
	}
	
	.logo{
		width: 20vh;
	}
	ul.nav a:hover { 
					color: white !important; 
					background-color: #96c0b7 !important;
					border-radius: 3px;
				}
	
	 .footer-title ,.footer-copyright{
		 color:#96c0b7
	}
	.col-md-5 {
		font-size: 20px;
	}
	
	.contact {
		padding: 4%;
		height: 400px;
	}
	
	.col-md-3 {
		padding: 4%;
		border-top-left-radius: 0.5rem;
		border-bottom-left-radius: 0.5rem;
	}
	
	p{
		position:relative;
		top:-22px;
		right:-4px;
	}
	.contact-info {
		margin-top: 10%;
	}
	
	.contact-info img {
		margin-bottom: 15%;
	}
	
	.contact-info h2 {
		margin-bottom: 10%;
	}
	
	.col-md-9 {
		padding: 3%;
		border-top-right-radius: 0.5rem;
		border-bottom-right-radius: 0.5rem;
	}
	
	.contact-form label {
		font-weight: 600;
	}
	
	.contact-form button {
		font-weight: 600;
		width: 25%;
	}
	
	.contact-form button:focus {
		box-shadow: none;
	}
	
	h2 {
		position: relative;
		top: -3px;
		color: black;
	}
	
	.msg {
		position: relative;
		top: -32px;
		text-transform: uppercase;
	}
	
	.form-group1 {
		position: relative;
		top: -32px;
	}
	
	.info-wrap {
		background-color: #96c0b7;
		position: relative;
	}
	
	.text-sub
	{
		font-weight: normal;
	}
	.mt-5
	{
		margin-top: 2rem;
	}
	
	.text.pl-4 p span
	{
		font-size: 16px;
		font-weight: 600;
	}
	.form-sub
	{
	
	padding: 40px 5px 5px 5px;
	}
	
	
	.fa
	{
		padding: 11px 16px;
	
		border-radius: 50%;
		margin-right: 13px;
	}
	.address-data
	{
		padding-left: 10px;
	}


	.no-gutters{
		--bs-gutter-x: 0rem;
	}
	@media (min-width:1025px) {
	.contact-wrap
	{
	
		padding-top: 25px !important;
		padding-bottom: 25px !important;
	}
	.align-items-stretch
	{
		padding-right: 0;
	}
	
	}
	@media (max-width:768px)  {
	.col-md-5.align-items-stretch
	{
		
		display: block !important; 
	}
	.info-wrap
	{
		padding: 45px !important;
	}
	}

	.break-word{
		word-break: break-word;
	}


	@media (max-width: 768px) {
		.d-flex {
			display: block !important;
		}
	}
	</style>
@endsection

@section('nav-bar')
	<li class="nav-item"><a href="/" class="nav-link">Home</a></li>
	<li class="nav-item"><a href="/tools" class="nav-link">Tools</a></li>
	<li class="nav-item"><a href="/contact" class="nav-link"style="color: white; background-color: #96c0b7; border-radius: 3px;">Contact</a></li>
	<li class="nav-item"><a href="/request" class="nav-link">Request</a></li>
@endsection

@section('content')
	<section class="ftco-section ">
		<div class="container ">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section"></h2> </div>
			</div>
			<div class="row justify-content-center" >
				<div class="col-lg-10 col-md-12">
					<div class="wrapper">
						<div class="row no-gutters" style="margin-bottom: 100px;">
							<div class="col-md-7 d-flex align-items-stretch" >
								<div class="contact-wrap w-100 p-md-5 p-4  border-top border-bottom border-start rounded-3" style="border-radius: 3px;background-color:#f8f9fa;">
									<div class="form-sub">
										<h1 class="mb-4 display-4"> Get in touch </h3>
										<p class="text-sub" style="color:red"> To get a update Please provide email address. </p>
										<div id="form-message-warning" class="mb-4"></div>
										<div id="form-message-success" class="mb-4"> </div>
										<form>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="exampleFormControlInput1"> Name </label>
														<input type="name" class="form-control" id="exampleFormControlInput1" placeholder="Name@example.com"> 
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="exampleFormControlInput1"> Email address </label>
														<input type="email" class="form-control" id="exampleFormControlInput2" placeholder="Name"> 
													</div>
												</div>
											</div>
											
											
											<div class="form-group" style="margin-top: 10px;"> 
												<label for="exampleFormControlSelect1">Select Category</label>
												<select class="form-control" id="exampleFormControlSelect1">
													<option value=""> ---------- Please choose an option ------------ </option>
													<option value="feedback"> Feedback </option>
													<option value="question"> Question </option>
													<option value="generalInquiry"> General Inquiry </option>
													<option value="others"> Others </option>
												</select>
											</div>
											<div class="form-group" style="margin-top: 10px;">
												<label for="exampleFormControlTextarea1"> Message </label>
												<textarea class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder=" Write your Message...... " ></textarea>
											</div>
											<div class="row mt-5 mb-8">
												<div class="col-sm-2"></div>
												<div class="col-sm-12">
													<button class="btn btn-dark btn-lg float-end" type="button"> Send</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							<div class="col-md-5 d-flex align-items-stretch" style="padding-left: 0;">
								<div class="info-wrap w-130 p-lg-5 p-1  border rounded-3" style="color: white;">
									<h3 class="mb-4 mt-md-4">  </h3>
									<h2 style="color: #fff;font-size: 29px;margin-bottom: 30px; position:relative; top:-22px;"> Contact Us </h2>
									<div class="dbox w-110 d-flex align-items-start">
										<div class="icon d-flex align-items-center justify-content-center"></div>
										<div class="text pl-4">
											<p style="position:relative; top:-38px;"><span> Address: <span class="address-data"> Locked Bag 1797, Penrith, NSW 2751 </span></span></p>
										</div>
									</div>
									<div class="dbox w-100 d-flex align-items-center">
										<div class="icon d-flex align-items-center justify-content-center">  </div>
										<div class="text pl-4">
											<p style="position:relative; top:-42px;" ><span> Telephone: </span> <span class="address-data"> +61298525222 </span>
												<a href="tel://1234567920"> </a>
											</p>
										</div>
									</div>
									<div class="dbox w-100 d-flex align-items-center">
										<div class="icon d-flex align-items-center justify-content-center">  </div>
										<div class="text pl-4">
											<p style="position:relative; top:-42px;"><span>Email:</span><span class="address-data">__@staff.westernsydney.edu.au</span>
												<a href="mailto:info@yoursite.com"></a>
											</p>
										</div>
									</div>
								</div>
						
							</div>
					
							</div>
								
						</div>
					
					</div>
						
				</div>
			</div>
			
		</div>
	</section>
@endsection


