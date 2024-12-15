@extends('dashboard.layouts.app')

@section('title')
    Show_Product
@endsection


@section('content')
    <section class="section profile">



        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">


                        <img src="{{ $product->photo ? asset('storage') . '/' . $product->photo : '' }}"
                            alt="Profile" class="rounded-circle">

                        <h2>{{ $product->code }}</h2>

                        @foreach ($product->categories as $category)
                            <h3>{{ $category->name }}</h3>
                        @endforeach

                        
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">

                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <x-profile.tab class="nav-link active" target="#profile-overview" value="Overview"/>


                            <x-profile.tab class="nav-link" target="#profile-settings" value="Permissions"/>

                            
                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">About</h5>
                                <p class="small fst-italic">{{$product->description}}</p>

                                <h5 class="card-title">Product Details</h5>


                                <x-profile.row name="Product Name" value="{{ $product->name }}" />

                                <x-profile.row name="Company" value="Astra Tech" />


                                <x-profile.row name="Marka" value="{{ $product ? $product->marka: 'null' }}" />


                                <x-profile.row name="Price" value="{{ $product ? $product->price: 'null' }}" />
                                

                                <x-profile.row name="Quantity" value="{{ $product ? $product->quantity: 'null' }}" />

                                

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-settings">

                                <!-- Settings Form -->
                                

                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">User Permissions</label>


                                        {{-- <div class="col-md-8 col-lg-9">

                                            @foreach ($user->roles as $role)
                                                @foreach ($role->permissions as $permission)
                                               
                                                  <x-profile.check value="{{$permission->name}}" />

                                                @endforeach
                                            @endforeach


                                        </div> --}}
                                    </div>

                                

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
