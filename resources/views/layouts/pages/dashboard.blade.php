@extends('layouts.main')

@section('content')
    @include('layouts.navbars.navbar_dashboard')
    @yield('content-page')
@endsection