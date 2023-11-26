<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kebutuhan Harian Terlengkap di kotaraya</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/71b7145720.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    
    




</head>
<body>

    <nav class="navbar navbar-expand-lg bg-warning bg-gradient">
        <div class="container-sm">
          <a class="navbar-brand" href="{{ URL('/welcome') }}">Dusna Store</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" ></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
            @if (Auth::check() && Auth::user()->role === 'admin')
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="masterDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Master
                </a>
                <ul class="dropdown-menu" aria-labelledby="masterDropdown">
                
                        <li><a class="dropdown-item" href="{{ URL('/itemx') }}" >Item</a></li>
                        <li><a class="dropdown-item" href="{{ route('kategori.index') }}">Kategori</a></li>
                        <li><a class="dropdown-item" href="{{ route('users.index') }}">Users</a></li>
                        <li><a class="dropdown-item" href="{{ route('ongkirs.index') }}">Ongkir</a></li>
                </ul>
            </li>
            
            @endif    

                
                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('login')) ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('register')) ? 'active' : '' }}" href="{{ route('register') }}">Register</a>
                    </li>

                    <div class="dropdown" >
                        <a class="btn btn-outline-dark" href="{{ route('shopping.cart') }}">
                            <i class="fa-solid fa-cart-shopping"></i> Cart <span class="badge text-bg-warning">{{ count((array) session('cart')) }}</span>
                        </a>
                    </div>
                @else    
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="masterDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Penjualan
                </a>
                <ul class="dropdown-menu" aria-labelledby="masterDropdown">
                        <li><a class="dropdown-item" href="{{ route('laporan.index') }}" >Rekap Penjualan</a></li>
                        <li><a class="dropdown-item" href="{{ route('detailpenjualan.index') }}" >Detail Penjualan</a></li>
                </ul>
            </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                            
                        
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('users.gantipassword', Auth::user()->id) }}" >Ganti Password</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                            >Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </li>
                        </ul>
                    </li>

                    <div class="dropdown" >
                        <a class="btn btn-outline-dark" href="{{ route('shopping.cart') }}">
                            <i class="fa-solid fa-cart-shopping"></i> Cart <span class="badge text-bg-warning">{{ count((array) session('cart')) }}</span>
                        </a>
                    </div>
                @endguest
            </ul>
          </div>
        </div>
    </nav>    

    <div class="container">
        @yield('content')
    </div>
       
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>    
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'desc' );
</script>
</body>
</html>