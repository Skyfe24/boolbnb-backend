<div class="container mt-5 text-start">

    {{-- Dynamic Section --}}
    @if ($estate->exists)
        {{-- Edit section --}}
        <form method="POST" id="Form" action="{{ route('admin.estates.update', $estate) }}"
            enctype="multipart/form-data">
            @method('PUT')
        @else
            {{-- Create section --}}
            <form method="POST" id="Form" action="{{ route('admin.estates.store') }}" enctype="multipart/form-data">
    @endif

    {{-- Token --}}
    @csrf

    {{-- Display Page title --}}
    <div class="d-flex justify-content-between align-items-center my-3">
        <h1>
            @if ($estate->exists)
                {{-- Edit section --}}
                Modifica l'annuncio
            @else
                {{-- Create section --}}
                Aggiungi un nuovo annuncio
            @endif
        </h1>
        <a href="{{ route('admin.estates.index') }}" class="bt bt-dark-g">
            <span><i class="fa-solid fa-table-list"></i></span>
            <span class="d-none d-md-inline"> Torna agli annunci</span>
        </a>
    </div>

    {{-- Title --}}
    <div class="mb-3 col-12">
        <label for="title">Titolo Annnuncio</label>
        <input type="text" id="title" name="title"
            class="form-control @error('title') is-invalid @elseif (old('title')) is-valid @enderror"
            value="{{ old('title', $estate->title) }}" autofocus required>
        <div class="invalidField text-danger">
            <ul id="titleUl"></ul>
        </div>
        @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    {{-- Description --}}
    <div class="mb-3 col-12">
        <label class="form-label" for="description">Descrizione</label>
        <textarea type="text" id="description" name="description" class="form-control" maxlength="300">{{ old('description', $estate->description) }}</textarea>
        <div class="invalidField text-danger">
            <ul id="descriptionUl"></ul>
        </div>
    </div>

    {{-- Address --}}
    <div class="row align-items-end ">
        <div class="mb-3 d-flex text-start justify-content-between align-items-end">
            <div class="col-11">
                <div class="invalidField text-danger mt-2">
                    <ul>
                        <li id="messagesLi"></li>
                    </ul>
                </div>
                <label for="address">Indirizzo</label>
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <input autocomplete="off" type="text" id="address" name="address"
                    class="form-control @error('address') is-invalid @elseif (old('address')) is-valid @enderror"
                    value="{{ old('address', $estate->address ?? '') }}" min="1" max="254" required
                    @if ($estate->address) readonly='readonly' @endif>
                <div id="autocomplete" class="autocomplete-list p-2 bg-light d-none"></div>

            </div>
            <div class="col-1">
                <div id="reset-address" type="button" class="bt bt-red align-items-end mt-4 ms-1"><i
                        class="fa-solid fa-xmark"></i>
                </div>
            </div>

        </div>

    </div>

    {{-- Only numbers selectors --}}
    <div class="d-flex row justify-content-sm-start justify-content-md-between">

        {{-- Rooms --}}
        <div class="mb-3 text-start col-4 col-sm-4 col-md-2">
            <label for="rooms">Stanze</label>
            <input type="number" id="rooms" name="rooms"
                class="form-control @error('rooms') is-invalid @elseif (old('rooms')) is-valid @enderror"
                value="{{ old('rooms', $estate->rooms) }}" min="1" max="254" required>
            <div class="invalidField text-danger">
                <ul id="roomsUl"></ul>
            </div>
            @error('rooms')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Beds --}}
        <div class="mb-3 text-start col-4 col-sm-4 col-md-2">
            <label for="beds">Posti Letto</label>
            <input type="number" id="beds" name="beds"
                class="form-control @error('beds') is-invalid @elseif (old('beds')) is-valid @enderror"
                value="{{ old('beds', $estate->beds) }}" min="1" max="254" required>
            <div class="invalidField text-danger">
                <ul id="bedsUl"></ul>
            </div>
            @error('beds')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Bathrooms --}}
        <div class="mb-3 text-start col-4 col-sm-4 col-md-2">
            <label for="bathrooms">Bagni</label>
            <input type="number" id="bathrooms" name="bathrooms"
                class="form-control @error('bathrooms') is-invalid @elseif (old('bathrooms')) is-valid @enderror"
                value="{{ old('bathrooms', $estate->bathrooms) }}" min="1" max="254" required>
            <div class="invalidField text-danger">
                <ul id="bathroomsUl"></ul>
            </div>
            @error('bathrooms')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Mq --}}
        <div class="mb-3 text-start col-6 col-md-3 col-lg-2">
            <label for="mq">Superficie</label>
            <div class="input-group">
                <input type="number" id="mq" name="mq"
                    class="form-control @error('mq') is-invalid @elseif (old('mq')) is-valid @enderror"
                    value="{{ old('mq', $estate->mq) }}" min="20" max="1000" required>
                <span class="input-group-text" id="basic-addon2">m²</span>
            </div>
            <div class="invalidField text-danger">
                <ul id="mqUl"></ul>
            </div>
            @error('mq')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Price --}}
        <div class="mb-3 text-start col-6 col-md-3 col-lg-2">
            <label for="price">Prezzo a Notte</label>
            <div class="input-group">
                <input type="number" id="price" name="price"
                    class="form-control @error('price') is-invalid @elseif (old('price')) is-valid @enderror"
                    value="{{ old('price', $estate->price) }}" min="0.01" step="0.01" required>
                <span class="input-group-text" id="basic-addon2">€</span>
            </div>
            <div class="invalidField text-danger">
                <ul id="priceUl"></ul>
            </div>
            @error('price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>


    {{-- Switch & Checboxes --}}
    <div class="row justify-content-between mx-1 my-3">
        {{-- Visible switch --}}
        <div class="col-sm-5 col-md-3 col-lg-2 form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="is_visible" name="is_visible"
                @if ($estate->is_visible) checked @endif>
            <label class="form-check-label" for="is_visible">Visibile per tutti</label>
        </div>

        {{-- Dynamic Services Checkboxes --}}
        <div class="services-contenier col-sm-7 col-md-9 col-lg-10">
            <div class="row justify-content-sm-end justify-content-lg-around">
                @foreach ($services as $service)
                    <div class="col-sm-4 col-md-3 col-lg-1 form-check form-check-inline">
                        <input class="form-check-input service" type="checkbox"
                            @if (in_array($service->id, old('services', $estate_service_ids ?? []))) checked @endif id="tech-{{ $service->id }}"
                            value="{{ $service->id }}" name="services[]">
                        <label class="form-check-label" for="tech-{{ $service->id }}">{{ $service->label }}</label>
                    </div>
                @endforeach
            </div>
            <div class="invalidField text-danger mt-2">
                <ul id="servicesUl"></ul>
            </div>
            @error('services')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>


    {{-- Multiple images --}}
    <div class="col-12 text-start">
        <div class="mb-3">
            <label class="form-label" for="multiple_images">Immagini</label>
            @if (count($estate->images) > 0)
                <div id="oldImages">
                    <div class="text-center py-2">Immagini attuali</div>
                    <div class="row gap-3">
                        @foreach ($estate->images as $image)
                            <div class="col-12 col-md-2 p-2">
                                <img class="previewImages" src="{{ asset('storage/' . $image->url) }}"
                                    alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <input type="file" multiple id="multiple_images" name="multiple_images[]"
                class="form-control @error('multiple_images') is-invalid @elseif (old('multiple_images')) is-valid @enderror"
                value="{{ old('multiple_images', $estate->images) }}">
            <div id="previewTitle" class="text-center py-2">Nessuna immagine attualmente selezionata</div>
            <div id="rowImages" class="row gap-3"></div>
            @error('multiple_images')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    {{-- !PUT IMAGES HERE --}}

    {{-- Button --}}
    <button class="bt bt-blue mb-2">
        @if ($estate->exists)
            {{-- Edit section --}}
            Salva
        @else
            {{-- Create section --}}
            Crea
        @endif
    </button>
    </form>
</div>

{{-- Scritps --}}
@section('scripts')
    @Vite('resources/js/address-select-generator.js')
    @Vite('resources/js/edit-create-validation.js')
    @Vite('resources/js/imagesPreview.js')
@endsection
