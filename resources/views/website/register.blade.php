@extends('website.basic')

@section('content')
    <section id="register" style="background: url('images/background-img.png') no-repeat;">
        <div class="container ">
            <div class="row my-5 py-5">
                <div class="offset-md-3 col-md-6 my-5 ">
                    <h2 class="display-3 fw-normal text-center">Get 20% Off on <span class="text-primary">first
                            Purchase</span>
                    </h2>
                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    <form id="form" action="{{ route('web-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <input type="text" class="form-control form-control-lg" name="name" id="name"
                                placeholder="Enter Your UserName">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control form-control-lg" name="email" id="email"
                                placeholder="Enter Your Email Address">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control form-control-lg" name="password" id="password"
                                placeholder="Create Password">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control form-control-lg" name="password_confirmation" id="password_confirmation"
                                placeholder="Repeat Password">
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control form-control-lg" name="phone" id="phone"
                                placeholder="Phone">
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control form-control-lg" name="address" id="address"
                                placeholder="Address">
                        </div>


                        <div class="mb-3">
                            <div class="fom-floating">

                                <x-form.input value="" label="" id="formFile"
                                    class="form-control form-control-lg" name="photo" placeholder="" type="file"
                                    for="" />


                            </div>
                        </div>



                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-dark btn-lg rounded-1">Register it now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
