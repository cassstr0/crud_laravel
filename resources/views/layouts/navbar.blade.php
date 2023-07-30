 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href="{{ route('index') }}" class="nav-link">Home</a>
         </li>
     </ul>

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">
         <!-- Navbar Search -->
         <li class="nav-item" style="margin-right: 20px; display: flex; align-items:center;">
             <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                 <i class="fas fa-search"></i>
             </a>
             <div class="navbar-search-block">
                 <form class="form-inline">
                     <div class="input-group input-group-sm">
                         <input class="form-control form-control-navbar" type="search" placeholder="Search"
                             aria-label="Search">
                         <div class="input-group-append">
                             <button class="btn btn-navbar" type="submit">
                                 <i class="fas fa-search"></i>
                             </button>
                             <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                 <i class="fas fa-times"></i>
                             </button>
                         </div>
                     </div>
                 </form>
             </div>
         </li>
         <li class="nav-item">
             <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                 <div class="container">
                     <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                         data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                         aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                         <span class="navbar-toggler-icon"></span>
                     </button>

                     <div class="collapse navbar-collapse" id="navbarSupportedContent">
                         <!-- Left Side Of Navbar -->
                         <ul class="navbar-nav me-auto">

                         </ul>

                         <!-- Right Side Of Navbar -->
                         <ul class="navbar-nav ms-auto">
                             <!-- Authentication Links -->
                             @guest
                                 @if (Route::has('login'))
                                     <li class="nav-item">
                                         <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                     </li>
                                 @endif

                                 @if (Route::has('register'))
                                     <li class="nav-item">
                                         <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                     </li>
                                 @endif
                             @else
                             <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                            
                             @endguest
                         </ul>
                     </div>
                 </div>
             </nav>
         </li>
     </ul>
 </nav>
 <!-- /.navbar -->
