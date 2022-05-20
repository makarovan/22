@extends('layouts.appLogin')
@section('content')
	<hr>
	<div class="login-box">
		<div class="login-box-body">
			@if(session()->has('error'))
			<div class="alert alert-danger">
				{{ session()->get('error') }}
			</div>
			@endif
			<p class="login-box-msg">Sign in to start your dashboard</p>
			<form action="{{url('login')}}" method="POST">
				@csrf
				<div class="form-group has-feedback">
					<input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>								
				</div>
				
				<div class="form-group has-feedback">
					<input type="password" class="form-control" name="password" placeholder="Password" required>
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>			
				</div>
			
				<div class="row">
					<div class="col-xs-4">
						<button type="submit" class="btn btn-primary btn-block btn-flat" name="login">
						<i class="fa fa-sign-in"></i> Sign In</button>
					</div>
				</div>
			</form>
			<br>      
		</div>
	</div>
@endsection