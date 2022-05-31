@extends('layouts.appMain')
@section('content')

<div class="col-md-4 offset-md-4 mt-4">
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <h2>Регистрация</h2>
    @include('common.errors')
<form action="{{url('register')}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}		
    <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
        <div class="form-group">
            <strong>Name:</strong>
            <input type="text" name="name" class="form-control" placeholder="Name" required>
        </div>
    </div>	
    <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
        <div class="form-group">
            <strong>Email:</strong>
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
        <div class="form-group">
            <strong>Password:</strong>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
        <div class="form-group">
            <strong>Repeat password:</strong>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Password" required>
        </div>
    </div>			
    <div class="col-xs-12 col-sm-12 col-md-12 mt-3 text-center">
        <button type="submit" class="btn btn-primary">Зарегестрироваться</button>
    </div>			
</form>
</div>

@endsection