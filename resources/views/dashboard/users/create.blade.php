@extends('dashboard.layouts.app')

@section('title')
    Create_User
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
                    <h4>Create User</h4>

                </div>
                <form id="form" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-6">
                                <div class="form-floating">

                                    <x-form.input value="{{ old('name') }}" label="User Name" id="name"
                                        name="name" placeholder="User Name" type="text" for="name" />

                                </div>
                            </div>
                            <div class="mb-3 col-6">
                                <div class="form-floating">

                                    <x-form.input value="{{ old('email') }}" label="User Email" id="email"
                                        name="email" placeholder="User Email" type="email" for="email" />

                                </div>
                            </div>


                            <div class="mb-3 col-6">
                                <div class="form-floating">

                                    <x-form.input value="" label="Password" id="password" name="password"
                                        placeholder="Password" type="password" for="password" />

                                </div>
                            </div>

                            <div class="mb-3 col-6">
                                <div class="form-floating">

                                    <x-form.input value="" label="Password_Confirmation" id="Password_Confirmation"
                                        name="password_confirmation" placeholder="Password_Confirmation" type="password"
                                        for="Password_Confirmation" />

                                </div>
                            </div>

                            <div class="mb-3 col-6">
                                <div class="mb-3 col-12">
                                    <div class="form-floating">

                                        <x-form.input value="{{ old('detailes.phone') }}" label="Phone" id="phone_number"
                                            name="phone" placeholder="Phone" type="text" for="phone" />

                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 col-6 mb-3">
                                <div class="fom-floating">

                                    <x-form.input value="" label="" id="formFile"
                                        class="form-control form-control-lg" name="photo" placeholder="" type="file"
                                        for="" />


                                </div>
                            </div>


                            <div class="mb-3 col-4">
                                <div class="form-floating mb-3">
                                    <x-form.select_single>
                                        <option value="">Select Gender</option>
                                        <option @if (old('detailes.gender') == 'male') selected @endif value="male">Male
                                        </option>
                                        <option @if (old('detailes.gender') == 'female') selected @endif value="female">Female
                                        </option>
                                    </x-form.select_single>
                                </div>
                            </div>




                            <div class="mb-3 col-4">
                                <div class="form-floating mb-3">
                                    <x-form.select_mult name="roles[]" id="role" for="role" label="Role" aria="role">
 
                                        <option value="">Select Roles</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach

                                    </x-form.select_mult>

                                </div>
                            </div>


                            <div class="mb-3 col-4">
                                <div class="form-floating">

                                    <x-form.input value="{{ old('detailes.age') }}" label="Age" id="age"
                                        name="age" placeholder="Age" type="number" for="age" />

                                </div>
                            </div>

                            <div class="mb-3 col-12">
                                <div class="mb-3 col-12">
                                    <div class="form-floating">

                                        <x-form.texterea type="text" name="address" id="address" placeholder="Address"
                                            value="{{ old('detailes.address') }}" for="address" label="Address" />

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


    {{-- @section('scripts')
        <script>
            $(document).ready(function() {
                $('#form').validate({
                    rules: {
                        name: {
                            required: true,
                            maxlength: 20,
                            minlength: 7,
                            // userName: true
                        },
                        email: {
                            required: true,
                            email: true,
                            remote: {
                                url: "/admin/validate-email",
                                type: "POST",
                                data: {
                                    email: function() {
                                        return $('#email').val();
                                    },
                                    _token: "{{ csrf_token() }}" // Include CSRF token
                                }
                            }
                        },
                        phone: {
                            maxlength: 13,
                            minlength: 11
                        },
                        age: {
                            maxlength: 3,
                            minlength: 2
                        },
                        password: {
                            required: true,
                            minlength: 8,
                            maxlength: 20,
                            strongPassword: true
                        },
                        password_confirmation: {
                            required: true,
                            equalTo: "#password"
                        }
                    },
                    messages: {
                        name: {
                            required: "Username is required",
                            maxlength: "Username must not exceed 20 letters",
                            minlength: "Username must be at least 7 letters",
                            // userName: "Username must start the first name and last name with capital letter may be sperate this with space and can write at most 3 digit in the end"
                        },
                        email: {
                            required: "Email is required",
                            email: "Invalid email",
                            remote: "Email is already in use"
                        },
                        phone: {
                            maxlength: "Phone must not exceed 13 digits",
                            minlength: "Phone must be at least 11 digits"
                        },
                        age: {
                            maxlength: "Age must not exceed 3 digits",
                            minlength: "Age must be at least 2 digits"
                        },
                        password: {
                            required: "Password is required",
                            minlength: "Password must be at least 8 characters",
                            maxlength: "Password must not exceed 20 characters",
                            strongPassword: "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character"
                        },
                        password_confirmation: {
                            required: "Password confirmation is required",
                            equalTo: "Passwords do not match"
                        }
                    },
                    errorClass: "error text-danger fs--1",
                    errorElement: "span"
                });



                // $.validator.addMethod("userName", function(value, element) {
                //         return this.optional(element) ||
                //             /^[A-Z][a-z]{2,10} ?[A-Z][a-z]{2,10}[0-9]{0,3}$/.test(value);
                //     },
                //     "Username must start the first name and last name with capital letter may be sperate this with space and can write at most 3 digit in the end"
                // );


                $.validator.addMethod("strongPassword", function(value, element) {
                        return this.optional(element) ||
                            /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/.test(value);
                    },
                    "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character"
                );


                $('#form').on('submit', function(e) {
                    if (!$(this).valid()) {
                        e.preventDefault(); // Prevent form submission
                    }
                });

                console.log("CSRF Token:", "{{ csrf_token() }}");


            });
        </script>



    </section>
@endsection --}}



@endsection
