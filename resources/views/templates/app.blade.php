<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/30d9a6bac1.js" crossorigin="anonymous"></script>
    <style>
        .navbar {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            padding: 1rem 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .navbar-brand {
            color: #ffffff !important;
            font-weight: 700;
            font-size: 1.5rem;
            transition: transform 0.3s ease;
        }
        
        .navbar-brand:hover {
            transform: scale(1.05);
        }
        
        .nav-link {
            color: #ffffff !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .nav-link:before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: #ffffff;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        
        .nav-link:hover:before {
            width: 80%;
        }
        
        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }
        
        .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
        }
        
        .navbar-toggler {
            border: none;
            padding: 0.5rem;
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
            outline: none;
        }
        
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
                padding: 1rem;
                border-radius: 0.5rem;
                margin-top: 1rem;
            }
        }
    </style>
</head>
<body>
  @if (Auth::check())
    <nav class="navbar navbar-expand-lg fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#" data-aos="fade-right">
            <i class="fas fa-bullhorn me-2"></i>LaporKeun
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            
            @if(Auth::user()->role ==('GUEST'))
              <li class="nav-item" data-aos="fade-down" data-aos-delay="100">
                <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" aria-current="page" href="{{route('home')}}">
                    <i class="fas fa-home me-1"></i>Home
                </a>
              </li>
              <li class="nav-item" data-aos="fade-down" data-aos-delay="200">
                <a class="nav-link {{ request()->is('report') ? 'active' : '' }}" href="{{route('report.index')}}">
                    <i class="fas fa-clipboard-list me-1"></i>Daftar Laporan
                </a>
              </li>
              <li class="nav-item" data-aos="fade-down" data-aos-delay="300">
                <a class="nav-link {{ request()->is('report/monitor*') ? 'active' : '' }}" href="{{route('report.monitor')}}">
                    <i class="fas fa-history me-1"></i>Riwayat Laporan
                </a>
              </li>
            @endif
            
            @if(Auth::user()->role ==('STAFF'))
              <li class="nav-item" data-aos="fade-down" data-aos-delay="100">
                <a class="nav-link {{ request()->is('response*') ? 'active' : '' }}" href="{{route('response')}}">
                    <i class="fas fa-reply me-1"></i>Response
                </a>
              </li>
            @endif
            
            @if(Auth::user()->role ==('HEAD_STAFF'))
              <li class="nav-item" data-aos="fade-down" data-aos-delay="100">
                <a class="nav-link {{ request()->is('home/akun*') ? 'active' : '' }}" href="{{route('home.akun')}}">
                    <i class="fas fa-users-cog me-1"></i>Kelola Akun
                </a>
              </li>
              <li class="nav-item" data-aos="fade-down" data-aos-delay="100">
                <a class="nav-link {{ request()->is('home/chart*') ? 'active' : '' }}" href="{{route('home.chart')}}">
                  <i class="fas fa-chart-line me-1"></i>Chart
                </a>
              </li>
            @endif
            
            <li class="nav-item" data-aos="fade-down" data-aos-delay="400">
              <a class="nav-link" href="{{route('logout')}}">
                <i class="fas fa-sign-out-alt me-1"></i>Logout
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  @endif
  
  <div class="container" style="margin-top: 100px;">
    @yield('content')
  </div>

  @stack('style')
  @stack('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script>
    AOS.init({
        duration: 800,
        once: true
    });
  </script>
</body>
</html>
