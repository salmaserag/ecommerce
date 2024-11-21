@extends('dashboard.layouts.app')

@section('title')
    Show_User
@endsection


@section('content')
    <section class="section profile">



        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">


                        <img src="{{ $user->detailes && $user->detailes->photo ? asset('storage') . '/' . $user->detailes->photo : '' }}"
                            alt="Profile" class="rounded-circle">

                        <h2>{{ $user->name }}</h2>

                        @foreach ($user->roles as $role)
                            <h3>{{ $role->name }}</h3>
                        @endforeach

                        <div class="social-links mt-2">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
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
                                <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque
                                    temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae
                                    quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                                <h5 class="card-title">Profile Details</h5>


                                <x-profile.row name="Full Name" value="{{ $user->name }}" />

                                <x-profile.row name="Company" value="Astra Tech" />


                                <x-profile.row name="Gender" value="{{ $user->detailes ? $user->detailes->gender : 'null' }}" />
                                

                                <x-profile.row name="Age" value="{{ $user->detailes ? $user->detailes->age : 'null' }}" />

                                    
                                <x-profile.row name="Address" value="{{ $user->detailes ? $user->detailes->address : 'null' }}" />



                                <x-profile.row name="Phone" value="{{ $user->detailes ? $user->detailes->phone : 'null' }}" />


                                <x-profile.row name="Email" value="{{ $user->detailes ? $user->email : 'null' }}" />
                                

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-settings">

                                <!-- Settings Form -->
                                

                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">User Permissions</label>


                                        <div class="col-md-8 col-lg-9">

                                            @foreach ($user->roles as $role)
                                                @foreach ($role->permissions as $permission)
                                               
                                                  <x-profile.check value="{{$permission->name}}" />

                                                @endforeach
                                            @endforeach


                                        </div>
                                    </div>

                                

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
