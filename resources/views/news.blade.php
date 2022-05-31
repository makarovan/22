@extends('layouts.appMain')
@section('content')

<div style="width: 60%;margin-left: 20%;overflow: hidden;display: block;margin-top: 20px;">
    <div style="width:20%; float:left;margin-right:5%;">
        <h1>News Portal</h1>
        <ul>
            <li><a href="{{'/news'}}">Все новости</a></li>
            @foreach($categories as $category)
                <li><a href="{{'/news/' . $category->id}}">{{$category->name}} ({{$category->tasks->count()}})</a></li>
            @endforeach
        </ul>
    </div>
    <div style="width:75%; float:left;">
        <form action="{{url('sortNews')}}" method="POST">
            @csrf
            <select class="form-control input-sm" style="width:20%; float:right;" name="sort" onchange=submit();>
                @foreach($sortinglist as $sort)
                    <option value="{{$sort}}">{{$sort}}</option>
                @endforeach
            </select>
        </form>
        @if(isset($categoryName))
            <h2>{{$categoryName->name}}</h2>
        @else
            <h2>Все новости</h2>
        @endif
        
        @foreach($news as $new)
            <div class=" card border-secondary" style="display: block;overflow: hidden;margin-bottom: 40px;">
                <img src="{{asset('images/'.$new->image)}}" style="width:15%; float:left; margin-right:5%; padding:1%;">
                <div style="width:70%; float:left;">
                    <h3>{{$new->title}}</h3>
                    <p>Updated: {{$new->updated_at}}</p>
                    <p>Category: {{$new->category->name}}</p>
                    <p class="commentscount"><span class="spancomment">Comments: </span> {{$new->comments->count()}}</p>
                    <!-- alternative: -->
                    <!-- <p class="commentscount"><span class="spancomment">Comments: </span> {{count($new->comments)}}</p> -->
                    <a href="{{url('show/' . $new->id)}}">Подробнее</a>
                </div>
                
            </div>
        @endforeach
        <p>Всего новостей: {{$news ->count()}}</p>
    </div>
</div>
@endsection