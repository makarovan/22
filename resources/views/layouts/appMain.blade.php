<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href='{{asset("/components/bootstrap/dist/css/bootstrap_journal.css")}}'>
  <link rel="stylesheet" href='{{asset("/components/bootstrap/dist/css/bootstrap_journal.min.css")}}'>
  <title>Project news</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{url('/')}}">Home</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
        aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" href="{{url('/news')}}">News
              <span class="visually-hidden">(current)</span>
            </a>
          </li>
          @if(Auth::guest())
          <li class="nav-item">
            <a class="nav-link" href="{{url('/login')}}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/register')}}">Register</a>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link" href="{{url('/dashboard')}}">Admin panel</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/logout')}}">Logout</a>
          </li>
          @endif
        </ul>
        <form class="d-flex" action="{{url ('search')}}" method="POST">
          @csrf
          <input class="form-control me-sm-2" type="text" name="text" placeholder="Search">
          <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <main>
    @yield('content')
  </main>
</body>

</html>