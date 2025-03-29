@extends('layouts.pages.site')

@section('title', 'Login')

@section('content-page')
<div class="container">
    <div class="col-md-6 offset-md-3">
        <div class="card mt-5">
            <div class="card-body">
                <form class="form-signin" action="{{ route('registration_user') }}" method="POST">
                @csrf
                    <h1 class="h3 mb-3 mt-2 fw-normal">Cadastro</h1>
                    <div class="form-floating my-2">
                        <input type="name" class="form-control" id="nameInput" placeholder="name" name="name" autocomplete="off" required>
                        <label for="nameInput">Nome</label>
                    </div>
                    <div class="form-floating my-2">
                        <input type="email" class="form-control" id="emailInput" placeholder="name@example.com" name="email" autocomplete="off" required>
                        <label for="emailInput">Email</label>
                    </div>
                    <div class="form-floating my-2">
                        <input type="password" class="form-control" id="passwordInput" placeholder="Password" name="password" autocomplete="off" required>
                        <label for="passwordInput">Senha</label>
                    </div>

                    <button class="btn btn-dark w-100 py-2 my-4" type="submit">Cadastre-se</button>
                </form>
            </div>
        </div>
    </div>
</div>   
@endsection