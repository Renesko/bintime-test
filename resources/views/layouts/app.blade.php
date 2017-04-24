<!DOCTYPE html>

<html lang="{{ config('app.locale') }}">

@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show

<body>

<div class="app">
    <div class="content">
        @yield('content')
    </div>

    @include('layouts.partials.footer')
</div>

@section('scripts')
    @include('layouts.partials.scripts')
@show

</body>
</html>