<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/css/styleadmin.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>دورى الملاعب</title>
    @yield('header')
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <button class="navbar-toggler sideMenuToggler" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>  
        <a class="navbar-brand" href="#">دوري الملاعب</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
            
          </ul>
        </div>
    </nav>

    <div class="wrapper d-flex">
        <div class="sideMenu bg-mattBlackLight">
            <div class="sidebar">
                <ul class="navbar-nav text-right">
                    <li class="nav-item"><a href="{{ url('admin/dashboard') }}" class="nav-link px-2"><span class="text">لوحة التحكم</span><i class="material-icons icon">dashboard</i></a></li>
                    <li class="nav-item"><a href="{{ url('admin/users') }}" class="nav-link px-2"><span class="text">المستخدمين</span><i class="material-icons icon">person</i></a></li>
                    <li class="nav-item"><a href="{{ url('admin/admins') }}" class="nav-link px-2"><span class="text">المديرين</span><i class="material-icons icon">person</i></a></li>
                    <li class="nav-item"><a href="{{ url('admin/articles') }}" class="nav-link px-2"><span class="text">المقالات</span><i class="material-icons icon">art_track</i></a></li>
                    <li class="nav-item"><a href="{{ url('admin/tags') }}" class="nav-link px-2"><span class="text">الوسوم</span><i class="material-icons icon">local_offer</i></a></li>
                    <li class="nav-item"><a href="#" class="nav-link sideMenuToggler px-2"><span class="text">ex</span><i class="material-icons icon">ex</i></a></li>
                </ul>
            </div>
        </div>
    


    <div class="content">
        <main>
           
            @yield('content')
                        
        </main>
    </div>

    

</body>

<script src="{{ asset('public/js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
<script src="{{ asset('public/js/script.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
@yield('footer')
</html>