@extends('layouts.pages.site')

@section('title', 'Inicio')

@section('content-page')
<div class="container">
    <div class="mt-4">
        <h1 class="my-4">Busque um evento</h1>
        <div class="p-4 mb-4 bg-body-tertiary rounded-3">
            <div class="container-fluid py-1">
                <form action="/" method="get">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Procurar...">
                        <button class="btn btn-dark" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="mt-4">
        @if ($search)
            <h3>Buscando por: <strong>{{ $search }}</strong></h3>
        @else
            <h2>Próximos Eventos</h2>
            <p>Veja os eventos dos próximos dias</p>
        @endif
        <div class="row">
        @foreach ($events as $event)
            <div class="col-md-3">
                <a href="{{ route('show_events', $event->id) }}" class="link-body-emphasis link-offset-2 link-underline link-underline-opacity-0">
                    <div class="h-75">
                        <img class="img-fluid rounded h-100 w-100" src="{{ asset('assets/img/events/' . $event->image) }}" alt="{{ $event->title }}">
                    </div>
                    <h6 class="mt-2 mb-0">{{ $event->title }}</h6>
                    <p class="m-0">X Participantes</p>
                    <p class="m-0"><small class="text-body-secondary">{{ date( 'd/m/Y' , strtotime($event->date)) }}</small></p>
                </a>
            </div>
        @endforeach
        @if (count($events) == 0 && $search)
        <p>Não foi possivel encontrar nenhum evento com {{ $search }}! <a href="/" class="link-info link-offset-2 link-underline link-underline-opacity-0">Ver Todos!</a></p>
        @elseif(count($events) == 0)
        <p>Não há eventos disponíveis no momento...</p>
        @endif
        </div>
    </div>    
</div>   
@endsection