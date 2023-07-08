@extends('layouts.app')
@section('sidebar')
<nav class="navbar p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
        <a class="navbar-brand brand-logo-mini" href="index.html">
            <img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav w-100">
            <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                    <input type="text" class="form-control" placeholder="Search products">
                </form>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">

            {{-- <li class="nav-item nav-settings d-none d-lg-block">
                            <a class="nav-link" href="{{ route('parametre') }}">
            <i class="mdi mdi-settings"></i>
            </a>
            </li> --}}
            @guest
            @else
            <li class="nav-item border-left">
                <a class="nav-link count-indicator dropdown-toggle" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{ route('logout') }}" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-logout text-danger"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
            @endguest
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
        </button>
    </div>
</nav>
@endsection