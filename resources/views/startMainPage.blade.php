@extends('layouts.appMain')
@section('content')

<div class="content" <div class="content" style="min-height:450px; height:100%; width:45%; margin:40px auto; display:block; ">
  @foreach($tasks as $task)
  <div class="card mb-3" style="width:28%; float:left; display:block; margin:0 2%; overflow:hidden;" >
    <img src="{{asset('images/'.$task->image)}}" style="height:200px; max-width:100%;">
    <div class="card-body" style="height:80px;">
      <h6 class="card-subtitle text-muted" style="font-size:0.8vw;">{{$task->title}}</h6>
    </div>
    <div class="card-body">
      <p>Category: {{$task->category->name}}</p>
    </div>
    <div class="card-body">
      <a href="{{url('show/' . $task->id)}}" class="card-link">Подробнее</a>
    </div>
    <div class="card-footer text-muted">
      Date update - {{$task->updated_at}}
    </div>
  </div>
  @endforeach
</div>

@endsection