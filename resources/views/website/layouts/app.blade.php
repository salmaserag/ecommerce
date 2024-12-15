@extends('website.basic')

@section('content')
    @include('website.layouts.categories')

    @include('website.layouts.clothing')

    @include('website.layouts.fooding')

    @include('website.layouts.mid_banner')

    @include('website.layouts.best_selling')
{{-- 
    @include('website.layouts.mid_form') --}}

    @include('website.layouts.latest_blog')
@endsection
