@extends('layouts.app')

@section('content')
<div class="box-header with-border">
	<h3 class="box-title"><strong> User manage - Edit user</strong></h3>
	<div class="add">
	<a href="/users" class="btn btn-primary btn-sm btn-flat"> <i class="fa fa-backward"></i> Back to list</a>
	</div>

</div>

<div class="box-body">
	<div class="container">
        <div class="col-lg-9 margin-tb">
			@include('common.errors')
		<form action="{{url('edituser/'.$user->id)}}" method="POST" enctype="multipart/form-data">
			@csrf			
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					<strong>Name:</strong>
					<input type="text" name="name" class="form-control" value="{{$user->name}}" required>
				</div>
			</div>	
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					<strong>Email:</strong>
					<input type="email" class="form-control" value="{{$user->email}}" readonly>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					<strong>Role:</strong>
					<select class="form-control input-sm" name="role"
						@if(Auth::user()->role!='admin') disabled @endif
					>
						@foreach($roles as $role)
						<option value="{{$role}}"
							@if($role==$user->role)
								selected 
							@endif
						>{{$role}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					<strong>Password:</strong>
					<input type="password" name="password" class="form-control" placeholder="Password" >
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
					<strong>Repeat password:</strong>
					<input type="password" name="password_confirmation" class="form-control" placeholder="Password" >
				</div>
			</div>			
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-primary">Save user</button>
			</div>			
		</form>
		</div>
    </div>
</div>
@endsection