@extends('layouts.pages.site')

@section('title', 'Login')

@section('content-page')
<div class="container">
    <div class="col-md-6 offset-md-3">
        <div class="card mt-5">
            <div class="card-body">
                <form class="form-signin" action="{{ route('authenticate_user') }}" method="POST">
                @csrf
                    <h1 class="h3 mb-3 mt-2 fw-normal">Login</h1>

                    <div class="form-floating my-2">
                        <input type="email" class="form-control" id="loginInput" placeholder="name@example.com" name="email" autocomplete="off" required>
                        <label for="loginInput">Email</label>
                    </div>
                    <div class="form-floating my-2">
                        <input type="password" class="form-control" id="passwordInput" placeholder="Password" name="password" autocomplete="off" required>
                        <label for="passwordInput">Senha</label>
                    </div>

                    <button class="btn btn-dark w-100 py-2 my-4" type="submit">Login</button>
                </form>
                <p><a href="{{ route('register_user') }}" class="link-info link-offset-2 link-underline-opacity-0 link-underline-opacity-0-hover">Ainda não possui cadastro? Cadastre-se já!</a></p>
            </div>
        </div>
    </div>
</div>   
@endsection