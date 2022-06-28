<?php
    $companyName = isset($company['name']) && $company['name'] ? $company['name'] : '';
?>
<style>
    .position-header{
        position: fixed !important;
        background: #000000 !important;
        z-index: 99999;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light site-navbar-target position-header" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{url("/")}}">{{__($companyName)}}</a>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav nav ml-auto">
                @foreach($siteMenu as $menu)
                    <?php
                        $name = isset($menu['name']) && $menu['name'] ? $menu['name'] : '';
                        $url = isset($menu['url']) && $menu['url'] ? $menu['url'] : '';
                    ?>
                    <li class="nav-item"><a href="#{{$url}}" class="nav-link"><span>{{$name}}</span></a></li>
                @endforeach
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item dropdown">
                            <a href="{{url('admin/dashboard/index')}}" class="nav-link"><span>{{__("Management")}}</span></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    @else
                        <li class="nav-item"><a href="{{route('login')}}" class="nav-link"><span>Login</span></a></li>
{{--                        @if (Route::has('register'))--}}
{{--                            <li class="nav-item"><a href="{{ route('register') }}" class="nav-link"><span>Register</span></a></li>--}}
{{--                        @endif--}}
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>
