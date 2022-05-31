@extends('layouts.appMain')
@section('content')
<div class="content" style="width:60%; margin:40px auto; display:block; overflow:hidden;">
    <div style="display: block; overflow: hidden;">
        <div id="img" style="float:left; width:20%; display:block;overflow:hidden; margin-right:5%; margin-top:15px;">
            <img src="{{asset('images/'.$task->image)}}" style="width:100%;">
        </div>
        <div id="text" style="float:left; width:75%;">
            <h1>{{$task->title}}</h1>
            <h6>Updated: {{$task->updated_at}}</h6>
            <h6>Category: {{$task->category->name}}</h6>
            <p>{{$task->description}}</p>
        </div>
    </div>
    @if(Auth::check())
    <div class="content" style="width:60%; margin-top:40px; display:block; overflow:hidden;">
        <h3>Add comments:</h3>
        <form action="{{url('comments')}}" method="POST">
            {{csrf_field()}}
            <div class="form-group">
                <strong>Comment (max 1000 symbols):</strong>
                <textarea class="form-control" style="height: 50px;" name="body" required></textarea>
            </div>
            <input type="hidden" name="taskid" value="{{$task->id}}" class="form-control" placeholder="newsId">
            <button type="submit" class="btn btn-primary">Add comment</button>
        </form>
    </div>
    @endif
    
    <hr>
    <h3>Comments:</h3>
    @forelse ($task->comments as $comment)
    <p>
        <i>Author: </i>{{$comment->user->name}}<br>
        <i>Date: </i>{{date('d-m-Y', strtotime($comment->created_at))}}
    </p>
    <p><span class="spanclass">Comment: </span>{{$comment->body}}</p>
    <hr>
    @empty
        <p>This post has no comments</p>
    @endforelse
</div>
@endsection