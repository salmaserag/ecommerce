@extends('website.basic')

@section('content')
    <section id="clothing" class="my-5 overflow-hidden">
        <div class="container pb-5">

            <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
                <h2 class="display-3 fw-normal">Pet Categories</h2>
                <div>
                    <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
                        shop now
                        <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                            <use xlink:href="#arrow-right"></use>
                        </svg></a>
                </div>
            </div>


            <div class="products-carousel swiper">
                <div class="row">

                    @foreach ($categories as $category)
                        <div class="col-3 mb-3">

                            <div class="card ">
                                <a href="{{ route("web-product", [$category->id]) }}"><img
                                        src="http://127.0.0.1:8000/website/assets/images/item1.jpg"
                                        class="img-fluid rounded-4" alt="image"></a>
                                <div class="card-body p-0">
                                    <a href="{{ route("web-product", [$category->id]) }}">
                                        <h3 class="card-title pt-4 m-0">{{$category->name}}</h3>
                                    </a>

                                    <div class="card-text">
                                        <span class="rating secondary-font">
                                            <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                            <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                            <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                            <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                            <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                            5.0</span>


                                            <h3 class="secondary-font text-primary">{{$category->description}}</h3>

                                        <div class="d-flex flex-wrap mt-3">

                                            <a href="#" class="btn-wishlist px-4 pt-3 ">
                                                <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                                            </a>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>





        </div>
    </section>
@endsection
