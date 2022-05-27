@extends('layouts.app')
@section('content')
<div class="box-header with-border">
	<h3 class="box-title"><strong>Comment List Manage</strong></h3>
</div>

<div class="box-body">
	@if (count($comments ?? '') > 0)
	<table class="table table-bordered">
		<thead>
			<th width="3%">#</th>
			<th width="20%">User</th>
			<th>News</th>
            <th>Comment body</th>
			<th>Date created</th>
			<th>Tools</th>
		</thead>
		<tbody>
			@foreach($comments as $comment)
			<tr>
				<td>{{$comment->id}}</td>
                <td>{{$comment->user->name}}</td>
				<td>({{$comment->task->updated_at}}) | {{$comment->task->title}} <br>
                    <a href="{{url('show/' . $comment->task->id)}}">К новости</a>
                </td>
                <td>{{$comment->body}}</td> 
				<td>{{$comment->created_at}}</td>
				<td>
                <a href="{{url('deletecomment/'.$comment->id)}}" title="delete" class="btn btn-warning btn-sm delete btn-flat" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</a>
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