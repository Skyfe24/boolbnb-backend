@extends('layouts.app')

@section('title', 'Annunci')
@section('content')
    <header class="d-flex justify-content-between align-items-center mt-3">
        <h1 class="text-center">I tuoi annunci</h1>
        <div class="headerRight">
            <a href="{{ route('admin.estates.create') }}" class="bt bt-gold">
                <span><i class="fa-regular fa-square-plus"></i></span>
                <span class="d-none d-md-inline">Aggiungi un annuncio</span>
            </a>
            <a href="{{ route('admin.estates.messages') }}" class="bt bt-blue">
                <span><i class="fa-regular fa-envelope"></i></span>
                <span class="d-none d-md-inline">Messaggi</span>
            </a>
            <a href="{{ route('admin.estates.trash') }}" class="bt bt-red">
                <span><i class="fa-solid fa-trash-arrow-up"></i></span>
                <span class="d-none d-lg-inline">Cestino</span>
            </a>
        </div>
    </header>

    {{-- Charts --}}
    @forelse ($estates as $estate)

        <div class="charts d-flex">
            <div class="container w-50">
                <canvas id="myChartVisits" data-visits="{{ $monthlyVisitsJSON }}"></canvas>
            </div>
            <div class="container w-50">
                <canvas id="myChartMessages" data-messages="{{ $monthlyMessagesJSON }}"></canvas>
            </div>
        </div>

        {{-- Table --}}
        <div class="indexContent d-flex align-items-center justify-content-center">
            <table class="mt-3 align-middle">
                <thead>
                    <tr>
                        <th class="text-center ps-2"><i class="fa-solid fa-camera-retro"></i></th>
                        <th class="ps-3 text-center text-lg-start" colspan="3"><i class="fa-solid fa-house"></i><span
                                class="d-none d-lg-inline">
                                Annuncio</span></th>
                        <th class="d-none d-md-table-cell text-center text-xl-start px-3"><i
                                class="fa-solid fa-layer-group"></i><span class="d-none d-xl-inline"> Superficie</span></th>
                        <th class="px-3 text-center text-xl-start"><i class="fa-solid fa-sack-dollar"></i><span
                                class="d-none d-xl-inline">
                                Prezzo</span></th>
                        <th class="px-3 text-center text-xl-start"><i class="fa-solid fa-eye"></i><span
                                class="d-none d-xl-inline">
                                Visibile</span></th>
                        <th class="px-3 text-center text-xl-start"><i class="fa-solid fa-arrow-trend-up"></i><span
                                class="d-none d-xl-inline">
                                Sponsor</span></th>
                        <th class="text-end px-3 text-center"><i class="fa-solid fa-gears"></i><span
                                class="d-none d-lg-inline">
                                Azioni</span></th>
                    </tr>
                </thead>
                <tbody>
                    @if (Auth::id() === $estate->user_id)
                        <tr class="dynamic-tr" data-estate="{{ $estate }}">
                            <td class="pt-1"><img width="50px" height="50px" class="rounded" style="object-fit: cover"
                                    src="{{ $estate->get_cover_path() }}" alt="{{ $estate->title }}"></td>
                            <td class="px-3" colspan="3">{{ $estate->title }}</td>
                            <td class="d-none d-md-table-cell px-3">{{ $estate->mq }} m²</td>
                            <td class="px-3">{{ $estate->price }} €</td>
                            <td class="px-3">
                                @if ($estate->is_visible)
                                    <i class="text-success fa-solid fa-circle-check"></i>
                                @else
                                    <i class="text-danger fa-solid fa-circle-xmark"></i>
                                @endif
                            </td>
                            <td class="px-3">
                                @if ($estate->getSponsorEndDate() !== null)
                                    <span
                                        class="badge rounded-pill text-bg-success">{{ $estate->getSponsorEndDate() }}</span>
                                @else
                                    <i class="text-danger fa-solid fa-circle-xmark"></i>
                                @endif
                            </td>
                            <td class="px-3">
                                <div class="d-flex justify-content-center">

                                    <a class="bt bt-dark-g" href="{{ route('admin.estates.promo', $estate) }}">
                                        <span class="d-none d-xl-inline">Promuovi</span>
                                        <span class="d-xl-none"><i class="fa-solid fa-comment-dollar"></i></span>

                                    </a>
                                    <a class="bt bt-gold mx-2 mx-lg-3" href="{{ route('admin.estates.edit', $estate) }}">
                                        <span class="d-none d-xl-inline">Modifica</span>
                                        <span class="d-xl-none"><i class="fa-solid fa-wrench"></i></span>
                                    </a>
                                    <form action="{{ route('admin.estates.destroy', $estate) }}" method="POST"
                                        class="deleteForm trashEstate" data-name="{{ $estate->title }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bt bt-red delete" type="submit" data-bs-toggle="modal"
                                            data-bs-target="#myModal">
                                            <span class="d-none d-xl-inline">Elimina</span>
                                            <span class="d-xl-none"><i class="fa-solid fa-trash-can"></i></span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endif
                @empty
                    <h2 class="text-center mt-5">Non hai pubblicato alcun annuncio</h2>
    @endforelse
    </tbody>
    </table>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/modalScript.js'])
    @vite(['resources/js/charts.js'])
    @vite(['resources/js/dynamicTr.js'])
@endsection
