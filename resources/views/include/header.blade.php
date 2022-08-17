<!-- ======= Header ======= -->

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Amiri:wght@700&family=Work+Sans:ital,wght@0,600;0,800;1,200;1,500&display=swap" rel="stylesheet">
<!-- Vendor CSS Files -->
<link href="{{URL::asset('assets2/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets2/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets2/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets2/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets2/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets2/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="{{URL::asset('assets2/css/style.css')}}" rel="stylesheet">



<header id="header" class="fixed-top d-flex align-items-center">

    <div class="container d-flex justify-content-between">

    <div class="logo">
        <h3><a href="index.html"><img src="{{URL::asset('assets2/img/logo.png')}}" rel="logo"/><span>  k</span>hadamat</a></h3>
    </div>


@unlessrole('owner|customer|provider')
    <nav id="navbar" class="navbar">
        <ul>
        <li><a class="nav-link scrollto active" href="#hero"> <span class="servi"> الصفحة الرئيسية </span></a></li>
        <li><a class="nav-link scrollto " href="#about"> <span class="servi"> حول خدمات </span></a></li>
        <li><a class="nav-link scrollto" href="{{url('/all_services')}}"> <span class="servi"> الخدمات <span class="bi bi-files"></span> </span></a></li>
        <li class="dropdown"><a href="#portfolio"> <span class="servi">الأقسام </span><i class="bi bi-chevron-down"></i></a>
            <ul>
                @foreach ($mainsections as $mainsection)
                <li class="dropdown">
                    <a href="">{{ $mainsection->name }}</a>
            @endforeach
                </li>
            </ul>
        </li>
        <li><a class="nav-link scrollto" href="#contact"> <span class="servi"> تواصل معنا  </span> </a></li>
        <li class="dropdown"><a href="#"> <span class="servi">أبدأ الآن </span><i class="bi bi-chevron-down"></i></a>
            <ul>
            <button><li><a  href="{{ route('login') }}"><span class="servi"> دخول</span></a></li></button>
            <button><li><a  href="{{ route('register') }}"><span class="servi"> حساب جديد</span></a></li></button>
            </ul>
        </li>
        </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
    </nav>
@endunlessrole
@hasanyrole('customer|provider|owner')
    <nav id="navbar" class="navbar" >
            <ul>

                <li class="dropdown"><a href="#portfolio"> <span class="servi">الأقسام </span><i class="bi bi-chevron-down"></i></a>
                    <ul>
                        @foreach ($mainsections as $mainsection)
                        <li class="dropdown">
                            <a href="">{{ $mainsection->name }}</a>
                    @endforeach
                        </li>
                    </ul>
                </li>

                <li><a class="nav-link scrollto" href="{{url('/all_services')}}">
                    <span class="servi"> الخدمات<span class="bi bi-files"></span>  </span>  </span>
                    </a>
                </li>

        @hasanyrole('customer|provider')
        <li><a class="nav-link scrollto"  href="{{ url('/userservices') }}">
            <span class="servi">  أضف خدمة  <span class="bi bi-plus-square-dotted">  </span> </span>
            </a>
        </li>
        <li><a class="nav-link scrollto" href="{{url('/customer_order')}}">
            <span class="servi">المشتريات <span class="bi bi-cart2"></span> </span>
        </a>
    </li>
        @endhasanyrole

        @role('provider')
        <li><a class="nav-link scrollto" href="{{url('providerOrders')}}">
                <span class="servi">الطلبات الواردة <span class=" bi bi-truck "> </span> </span>
            </a>
        </li>
        @endrole

   {{-- notification --}}
    @hasanyrole('customer|provider')
        <notification :userid="{{auth()->id()}}" :unreads="{{auth()->user()->unreadNotifications}}"></notification>
    @endhasanyrole

        <li class="dropdown"><a class="nav-link scrollto" href="">
            <span class="servi" id="alignright"> الملف الشخصي <span class="bi bi-person-lines-fill">
                </span>
            </span>
        </a>
        <ul>
            <button>
            <li><a class="nav-link scrollto"  href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <span class="servi" id="alignright">  تسجيل خروج  <span class="bi bi-door-open-fill"></span>  </span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
            </button>
            <button>
                <li><a href="{{url('profile')}}">عرض الملف الشخصي</a></li>
            </button>
            <button>
                <li><a href="{{url('profile/'.Auth::user()->name.'/edit')}}">تعديل الملف الشخصي</a>
                </li>
            </button>
        </ul>
    </li>

    @can('لوحة التحكم')
    <li><a class="nav-link scrollto" href="{{ url('/' . $page='dashboard') }}"> <span class="servi" >لوحة التحكم </span></a></li>
    @endcan
    <li><a href="/chat"> <span class="servi"> محادثاتي <span class="bi bi-chat-dots font-weight-bold"> </span></span></a></li>
    <li><a href="{{url('/user')}}"><span class="bi bi-arrow-right-circle font-weight-bold"></span></a></li>
        </ul>

        <i class="bi bi-list mobile-nav-toggle"></i>
    </nav>
@endhasanyrole
    <!-- .navbar -->

    </div>
</header><!-- End Header -->

