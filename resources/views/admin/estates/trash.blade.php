@extends('layouts.app')
@section('title', 'Cestino')

@section('title', 'Trash Can')

@section('content')
    <header class="d-flex justify-content-between align-items-center py-4">
        <h1>Cestino</h1>
        <div class="headerLeft d-flex justify-content-center align-items-center gap-3">
            <a href="{{ route('admin.estates.index') }}" class="bt bt-dark-g">
                <span><i class="fa-solid fa-table-list"></i></span>
                <span class="d-none d-md-inline"> Torna agli annunci</span>
            </a>
            <form action="{{ route('admin.estates.restoreAll') }}" method="POST">
                @csrf
                @method('PATCH')
                <button class="bt bt-gold" type="submit">
                    <span><i class="fa-solid fa-recycle"></i></span>
                    <span class="d-none d-sm-inline">Ripristina tutto</span>
                </button>
            </form>
            <form action="{{ route('admin.estates.dropAll') }}" method="POST" class="deleteForm dropAllEstates">
                @csrf
                @method('DELETE')
                <button class="bt bt-red" type="submit" data-bs-toggle="modal" data-bs-target="#myModal">
                    <span><i class="fa-solid fa-explosion"></i></span>
                    <span class="d-none d-sm-inline">Cancella tutto</span>
                </button>
            </form>
        </div>
    </header>
    <div class="trashContent">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" width="20%">#</th>
                    <th scope="col" width="50%">Annuncio</th>
                    <th scope="col" width="30%" class="text-center">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($estates as $estate)
                    <tr>
                        <td> {{ $estate->id }} </td>
                        <td> {{ $estate->title }} </td>
                        <td>
                            <div class="trashButtons d-flex justify-content-center align-items-center gap-3">
                                <form action="{{ route('admin.estates.restore', $estate->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="bt bt-gold d-flex" type="submit">
                                        <span><i class="fa-solid fa-recycle"></i></span>
                                        <span class="d-none d-md-inline ms-1">Ripristina</span>
                                    </button>
                                </form>
                                <a class="bt bt-blue d-flex" href="{{ route('admin.estates.show', $estate->id) }}">
                                    <span><i class="fa-solid fa-circle-info"></i></span>
                                    <span class="d-none d-md-inline ms-1">Informazioni</span>
                                </a>
                                <form action="{{ route('admin.estates.drop', $estate->id) }}" method="POST"
                                    class="deleteForm dropEstate" data-name="{{ $estate->title }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bt bt-red d-flex" type="submit" data-bs-toggle="modal"
                                        data-bs-target="#myModal">
                                        <span><i class="fa-solid fa-trash-can"></i></span>
                                        <span class="d-none d-md-inline ms-1">Cancella</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="3">
                            <h2>Il cestino è vuoto</h2>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/modalScript.js'])
@endsection
