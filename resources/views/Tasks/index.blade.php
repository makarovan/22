@extends('layouts.app')
@section('content')
<div class="box-header with-border">
	<h3 class="box-title"><strong>News List Manage</strong></h3>
	<div class="add">
		<a href="addtask" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
	</div>
	<div class="pull-right">
		<form class="form-inline" action="{{url('productBycategory')}}" method="POST">
			@csrf
			<div class="form-group">
				<label>Category:</label>
				<select class="from-control input-sm" name="category_id" onChange=submit();>
					<option value="0">All</option>
					@foreach ($categories as $category)
					<option value="{{$category->id}}"
						@if(isset($selectCategory) && $category->id == $selectCategory) selected @endif
						>
						{{$category->name}}
					</option>
					@endforeach
				</select>
			</div>
		</form>
	</div>
</div>

<div class="box-body">
	@if (count($tasks ?? '') > 0)
	<table class="table table-bordered">
		<thead>
			<th width="3%">#</th>
			<th width="20%">Title</th>
			<th>Category</th>
			<th>Date Updated</th>
			<th>Tools</th>
		</thead>
		<tbody>
			@foreach($tasks as $task)
			<tr>
				<td>{{$task->id}}</td>
				<td>{{$task->title}}</td>
				<td>{{$task->category_id}} - {{$task->category->name}}</td>
				<td>{{$task->updated_at->format('d.m.Y')}}</td>
				<td>
					<a href="{{url('edittask/'.$task->id)}}" title="edit" class="btn btn-success btn-sm edit btn-flat"><i class="fa fa-edit"></i> Edit</a>
					<a href="{{url('deletetask/'.$task->id)}}" title="delete" class="btn btn-warning btn-sm delete btn-flat" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</a>

					<form action="{{url('deletetask/'.$task->id)}}" method="POST">
						{{csrf_field()}}
						{{method_field('DELETE')}}
						
						<button type="submit" class="btn btn-danger btn-sm delete btn-flat" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</button>
					</form>
				</td>
			</tr>
			<tr>
				<th>Description</th>
				<td colspan="4">{{$task->description}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@else
		<p>Data not found</p>
	@endif
</div>
@endsection