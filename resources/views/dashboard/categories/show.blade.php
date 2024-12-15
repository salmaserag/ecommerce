@extends('dashboard.layouts.app')

@section('title')
    Show_Category
@endsection


@section('content')
    <section class="section profile">



        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <h2>{{ $category->name }}</h2>


                        <h3>{{ $category->createdBy->name }}</h3>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">

                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <x-profile.tab class="nav-link active" target="#profile-overview" value="Overview"/>



                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">About</h5>
                                <p class="small fst-italic">{{ $category->description }}</p>

                                <h5 class="card-title">Category Details</h5>

                                <x-profile.row name="Category Name" value="{{ $category->name }}" />


                                <x-profile.row name="Company" value="Astra Tech" />

                                <x-profile.row name="Created_By" value="{{$category->createdBy->name}}" />

                                <x-profile.row name="Updated_By" value="{{$category->updatedBy ? $category->updatedBy->name : " " }}" />
                               

                            </div>

                            
                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
