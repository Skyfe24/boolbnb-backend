<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('includes.layout.head')

<body>

    <div id="app">

        @include('includes.layout.navbar')
        <main>
            <div class="container" id="container">
                @include('includes.layout.modal')
                @include('includes.layout.alert')
                @yield('content')
            </div>
            @yield('scripts')
        </main>
    </div>
</body>

</html>
