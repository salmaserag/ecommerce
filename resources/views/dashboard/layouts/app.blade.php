<!DOCTYPE html>
<html lang="en">

@include('dashboard.layouts.head')

@include('dashboard.layouts.navbar')

@include('dashboard.layouts.sidebar')

<body>

    <main id="main" class="main">

        @include('dashboard.layouts.title')

        @yield('content')


    </main>


</body>




@include('dashboard.layouts.footer')

@include('dashboard.layouts.scripts')

</html>