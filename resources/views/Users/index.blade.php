@extends('layouts.app')
@section('content')
<div class="box-header with-border">
	<h3 class="box-title"><strong>User List Manage</strong></h3>
	<div class="add">
		<a href="adduser" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
	</div>
</div>

<div class="pull-right">
	<form class="form-inline" action="{{url ('userByrole')}}" method="POST">
		@csrf
		<div class="form-group">
			<label>Role: </label>
			<select class="form-control input-sm" name="role" onChange=submit();>
				<option value="0">All</option>
				@foreach ($roles as $role)
				<option value="{{$role}}"
					@if (isset($selectRole) && $role==$selectRole)
						selected
					@endif
				>{{$role}}</option>
				@endforeach
			</select>
		</div>
	</form>
</div>

<div class="box-body">
	@if (count($users ?? '') > 0)
	<table class="table table-bordered">
		<thead>
			<th width="3%">#</th>
			<th width="20%">Email</th>
			<th>Name</th>
			<th>Role</th>
			<th>Tools</th>
		</thead>
		<tbody>
			@foreach($users as $user)
			<tr>
				<td>{{$user->id}}</td>
				<td>{{$user->email}}</td>
				<td>{{$user->name}}</td>
				<td>{{$user->role}}</td>
				<td>
					<a href="{{url('edituser/'.$user->id)}}" title="edit" class="btn btn-success btn-sm edit btn-flat"><i class="fa fa-edit"></i> Edit</a>

				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@else
		<p>Data not found</p>
	@endif
</div>
@endsection