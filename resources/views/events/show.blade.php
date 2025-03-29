@extends('layouts.pages.site')

@section('title', $event->title)

@section('content-page')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-8">
                    <div class="h-100">
                        <img class="img-fluid rounded h-100 w-100" src="{{ asset('assets/img/events/' . $event->image) }}" alt="{{ $event->title }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <h3 class="mt-3">{{ $event->title }}</h3>
                    <ul class="list-unstyled">
                        <li class="py-3 border-bottom justify-content-between"><i class="fa-solid fa-location-dot col-2"></i> {{ $event->city }}</li>
                        <li class="py-3 border-bottom justify-content-between"><i class="fa-solid fa-users col-2"></i> X participantes</li>
                        <li class="py-3 border-bottom justify-content-between"><i class="fa-solid fa-certificate col-2"></i> {{ $eventOwner->name }}</li>
                        <li class="py-3"><button class="btn btn-sm btn-dark">Participar</button></li>
                    </ul>
                </div>
            </div>
            <div class="mt-2">
                <p>
                    <span class="badge rounded-pill text-bg-dark">Data: {{ date( 'd/m/Y' , strtotime($event->date)) }}</span> 
                    <span class="badge rounded-pill text-bg-dark">Horário: {{ date( 'H:i' , strtotime($event->date)) }} </span>
                </p>
                <h5>Descrição do evento:</h5>
                <p>{{ $event->description }}</p>
                @if (isset($event->items))
                    @foreach($event->items as $items)
                        <span class="badge rounded-pill text-bg-dark">{{ $items }}</span>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="col-md-3 offset-md-1 mt-5">
            <h6 class="fst-italic">Outros eventos desse usuario:</h6>
            <ul class="list-unstyled">
                <li>
                    <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="#">  
                        <img class="bd-placeholder-img rounded" src="{{ asset('assets/img/events/' . $event->image) }}" alt="{{ $event->title }}" width="100%" height="96">
                        <div class="col-lg-8">
                            <h6 class="mb-0">Evento exemplo</h6>
                            <small class="text-body-secondary">January 15, 2023</small>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="#">  
                        <img class="bd-placeholder-img rounded" src="{{ asset('assets/img/events/' . $event->image) }}" alt="{{ $event->title }}" width="100%" height="96">
                        <div class="col-lg-8">
                            <h6 class="mb-0">Evento exemplo</h6>
                            <small class="text-body-secondary">January 15, 2023</small>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>   
@endsection