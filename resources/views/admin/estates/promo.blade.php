@extends('layouts.app')
@section('title', 'Offerte')
@section('content')
    <div class="titlePage text-center py-2">
        <h1>Sponsorizza il tuo annuncio</h1>
        <h4>Fallo apparire per primo nella ricerca!</h4>
    </div>

    <div class="promoEstate card my-3">
        <div class="row g-0">
            <div class="col-md-4">
                @if ($estate->images)
                    <img src="{{ $estate->get_cover_path() }}" class="img-fluid rounded-start" height="200"
                        style="object-fit: cover" alt="...">
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $estate->title }}</h5>
                    <p class="card-text">{{ $estate->address }}</p>
                    <p class="card-text py-3">"{{ $estate->description }}"</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container h-50 mt-4">
        <div class="d-flex row">
            @foreach ($sponsorships as $sponsorship)
                <div class="promoCol col-12 col-lg-4 my-3">
                    <div class="promoCard_{{ $sponsorship->level }} card p-2">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h2 class="card-title text-center text-white sponsorName">{{ $sponsorship->name }} </h2>
                            <div class="cardBottom text-center">
                                <div class="clockInfo"><i class="fa-regular fa-clock"></i></div>
                                <div class="clockInfo">{{ $sponsorship->duration }} ORE</div>
                                <p class="card-text fw-bold py-2">Sponsorizza il tuo annuncio per
                                    {{ $sponsorship->duration }}
                                    ore!
                                </p>
                                <div class="d-flex justify-content-center align-items-center">
                                    <form method="POST"
                                        action="{{ route('admin.payments.validateCreditCard', ['estate' => $estate->id, 'sponsorship' => $sponsorship->id]) }}">
                                        @csrf
                                        <button class="btn btn-dark fw-bold priceBtn"
                                            type="submit">{{ $sponsorship->price }}€</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
