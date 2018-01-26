@include('inc.header')

    @if(Auth::check() && Auth::user()->access_level == 0)
        @include('inc.top-visitor')

    @elseif(Auth::check() && Auth::user()->access_level == 1)
        @include('inc.top-admin')

    @else
        @include('inc.top-visitor')
    @endif

    @yield('content')


@include('inc.footer')
