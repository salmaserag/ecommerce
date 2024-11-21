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

                        <h2>{{ $role->name }}</h2>


                        <h3>{{ $role->guard_name }}</h3>
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
                                <p class="small fst-italic">{{ $role->description }}</p>

                                <h5 class="card-title">Role Details</h5>

                                <x-profile.row name="Role Name" value="{{ $role->name }}" />


                                <x-profile.row name="Company" value="Astra Tech" />
                               

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-settings">

                                <!-- Settings Form -->


                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Role Permissions</label>


                                    <div class="col-md-8 col-lg-9">

                                        @foreach ($permissions as $permission)

                                            <x-profile.check value="{{ $permission->name }}" />

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
