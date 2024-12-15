<!DOCTYPE html>
<html lang="en">

@include('website.layouts.head')

<body>

    @include('website.layouts.svg')

    @include('website.layouts.cart')

    @include('website.layouts.scroll')

    @include('website.layouts.header')

    @include('website.layouts.banner')






            @yield('content')





    @include('website.layouts.services')

    @include('website.layouts.insta')



    @include('website.layouts.footer')

    @include('website.layouts.scripts')


</body>

</html>
