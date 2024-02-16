<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" href="/css/secao_ativos.css">
  <link rel="stylesheet" href="/css/secao_dash.css">
  <link rel="stylesheet" href="/css/secao_login.css">
  <link rel="stylesheet" href="/css/secao_ir.css">
  <link rel="stylesheet" href="/css/secao_movimento.css">
  <link rel="stylesheet" href="/css/secao_mostrar.css">

  <!-- Font awesome -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
  <title>@yield('title')</title>
  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- Bootstrap JavaScript (jQuery e Popper.js) -->
  <link rel="stylesheet" href="/js/app.js">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>  

</head>
<body class="corpo">
  <header>
    <div class="dropdown">
      <a class="dropdown-item" href="/dashboard">Dashboard</a>
    </div>
    <div class="col-lg-3">
      <div class="dropdown d-lg-none">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Menu
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <li><a class="dropdown-item" href="/addativos">Ações</a></li>
          <li><a class="dropdown-item" href="/addativos">Fiis</a></li>
          <li><a class="dropdown-item" href="{{ route('lista.index')}}">Mostrar ativos</a></li>
          <li><a class="dropdown-item" href="{{ route('imposto.index')}}">Imposto de renda</a></li>
          <li><a class="dropdown-item" href="{{ route('movimento.index')}}">Movimentações</a></li>
        </ul>    
      </div>
    </div>
    <div class="dropdown d-none d-lg-block" >
      <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Ativos
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <li><a class="dropdown-item" href="/addativos">Compra e venda</a></li>
        <li><a class="dropdown-item" href="{{ route('lista.index')}}">Mostrar</a></li>
      </ul>    
    </div>
    <div class="dropdown d-none d-lg-block">
      <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Imposto de renda
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <li><a class="dropdown-item" href="{{ route('imposto.index')}}">Mostrar</a></li>
      </ul>    
    </div>
    <div class="dropdown d-none d-lg-block">
      <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        movimentações
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <li><a class="dropdown-item" href="{{ route('movimento.index')}}">Movimentações</a></li>
      </ul>    
    </div>
  </header>
  @if (session('msg'))
    <div class="alert alert-danger">
      {{ session('msg') }}
    </div>
  @endif
  @if ($errors->any())
    <div class="alert alert-danger mt-4"> 
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif 
  @yield('content')
  <footer>
    <p>&copy; 2024 Daniel</p>
    <nav>
      <a href="#">Página Inicial</a>
      <a href="#">Sobre Nós</a>
      <a href="#">Contato</a>
    </nav>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>