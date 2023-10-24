@extends('layouts.app')
@section('title', $estate->title)
@section('content')
    <div class="d-flex justify-content-between align-items-center my-3">
        <h1>Dettagli annuncio</h1>
        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.estates.index') }}" class="bt bt-dark-g">
                <span><i class="fa-solid fa-table-list"></i></span>
                <span class="d-none d-md-inline"> Torna agli annunci</span>
            </a>
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.estates.edit', $estate) }}" class="bt bt-gold mx-2">
                    <span><i class="fas fa-pencil"></i></span>
                    <span class="d-none d-md-inline"> Modifica</span>
                </a>
                <form action="{{ route('admin.estates.destroy', $estate) }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button class="bt bt-red">
                        <span><i class="fas fa-trash"></i></span>
                        <span class="d-none d-md-inline"> Elimina</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        @if (count($estate->images))
            <img style="height: 26rem; object-fit: cover;" src="{{ $estate->get_cover_path() }}" class="card-img-top"
                alt="{{ $estate->title }}">
        @endif
        <div class="card-body">
            <h5 class="card-title">{{ $estate->title }}</h5>
            <p class="card-text">{{ $estate->description }}</p>
        </div>
        <div class="d-flex justify-content-between">
            <div class="list infoEstate">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Indirizzo: </strong>{{ $estate->address }}</li>
                    <li class="list-group-item"><strong>Stanze: </strong>{{ $estate->rooms }}</li>
                    <li class="list-group-item"><strong>Bagni: </strong>{{ $estate->bathrooms }}</li>
                    <li class="list-group-item"><strong>Posti Letto: </strong>{{ $estate->beds }}</li>
                    <li class="list-group-item"><strong>Metri Quadri: </strong>{{ $estate->mq }} m²</li>
                    <li class="list-group-item"><strong>Prezzo a notte: </strong>{{ $estate->price }} €</li>
                    <li class="list-group-item d-flex align-items-center">
                        <div class="me-3"><strong>Servizi: </strong></div>
                        <div class="d-flex gap-3">
                            @foreach ($estate->services as $service)
                                <i class="text-center fa-solid fa-{{ $service->icon }} iconService"></i>
                            @endforeach
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        {{-- Charts --}}
        <div class="charts d-flex">
            <div class="container w-50">
                <canvas id="myChartVisits" data-visits="{{ $monthlyVisitsJSON }}"></canvas>
            </div>
            <div class="container w-50">
                <canvas id="myChartMessages" data-messages="{{ $monthlyMessagesJSON }}"></canvas>
            </div>
        </div>
    </div>

    <div class="result">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>

@endsection
@section('scripts')
    @vite(['resources/js/charts.js'])
@endsection
