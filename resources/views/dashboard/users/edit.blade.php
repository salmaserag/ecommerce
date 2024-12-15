@extends('dashboard.layouts.app')

@section('title')
    Edit_User
@endsection

@section('content')

    <section class="section dashboard">
        <!-- Floating Labels Form -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="container w-75">
            <div class="card">
                <div class="card-header mb-3">
                    <h4>Edit User</h4>

                </div>
                <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-6">
                                <div class="form-floating">

                                    <x-form.input value="{{ $user ? $user->name : old('name') }}" label="User Name" id="name"
                                    name="name" placeholder="User Name" type="text" for="name" />

                                </div>
                            </div>
                            <div class="mb-3 col-6">
                                <div class="form-floating">

                                    <x-form.input value="{{ $user ? $user->email : old('email') }}" label="User Email" id="email"
                                        name="email" placeholder="User Email" type="email" for="email" />

                                </div>
                            </div>

                            <div class="mb-3 col-6">
                                <div class="mb-3 col-12">
                                    <div class="form-floating">

                                        <x-form.input value="{{ $user->detailes ? $user->detailes->phone : old('detailes.phone') }}" label="Phone" id="phone_number"
                                            name="phone" placeholder="Phone" type="text" for="phone" />

                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 col-6 mb-3">
                                <div class="fom-floating">

                                    <x-form.input value="" label="" id="formFile" class="form-control form-control-lg"
                                    name="photo" placeholder="" type="file" for="" />

                                </div>
                            </div>

                            <div class="mb-3 col-4">
                                <div class="form-floating mb-3">
                                    
                                        <x-form.select_single>
                                        <option value="">Select Gender</option>
                                        <option @if ((isset($user->detailes) && $user->detailes->gender == 'male') || old('detailes.gender') == 'male') selected @endif value="male">Male
                                        </option>
                                        <option @if ((isset($user->detailes) && $user->detailes->gender == 'female') || old('detailes.gender') == 'female') selected @endif value="female">Female
                                        </option>
                                        </x-form.select_single>
                                   
                                </div>
                            </div>

                            <div class="mb-3 col-4">
                                <div class="form-floating mb-3">
                                   
                                        <x-form.select_mult name="roles[]" id="role" for="role" aria="Roles" label="Roles">
                                        <option value="">Select Roles</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                        </x-form.select_mult>

                                    
                                </div>
                            </div>


                            <div class="mb-3 col-4">
                                <div class="form-floating">

                                    <x-form.input value="{{ $user->detailes ? $user->detailes->age : old('detailes.age') }}" label="Age" id="age"
                                    name="age" placeholder="Age" type="number" for="age" />
                                    
                                </div>
                            </div>




                            <div class="mb-3 col-12">
                                <div class="mb-3 col-12">
                                    <div class="form-floating">

                                        <x-form.texterea type="text" name="address" id="address"
                                        placeholder="Address" value="{{ $user->detailes ? $user->detailes->address : old('detailes.address') }}" for="address"
                                        label="Address" />

                                    </div>
                                </div>
                            </div>





                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            
                            <x-form.button type="submit" class="btn btn-primary" value="Submit" />
                            <x-form.button type="reset" class="btn btn-secondary" value="Reset" />
                            
                        </div>
                    </div>
                </form><!-- End floating Labels Form -->

            </div>
        </div>




    </section>

@endsection
