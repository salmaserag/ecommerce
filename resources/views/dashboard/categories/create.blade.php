@extends('dashboard.layouts.app')

@section('title')
    Create_Category
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
                    <h4>Create Category</h4>

                </div>
                <form id="form" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="card-body">

                        <div class="mb-3 col-12">
                            <div class="form-floating">

                                <x-form.input value="{{ old('name') }}" label="Category Name" id="name"
                                    name="name" placeholder="Category Name" type="text" for="name" />

                            </div>
                        </div>


                        <div class="col-12 mb-3">
                            <div class="form-floating">

                                <x-form.texterea type="text" name="description" id="description"
                                    placeholder="Description" value="{{ old('description') }}" for="description"
                                    label="Description" />

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
                            minlength: 3,
                            categoryName: true
                        },
                        
                    },
                    messages: {
                        name: {
                            required: "Category is required",
                            maxlength: "Category must not exceed 20 letters",
                            minlength: "Category must be at least 3 letters",
                            categoryName: "Category must start with capital letter"
                        },
                        
                    },
                    errorClass: "error text-danger fs--1",
                    errorElement: "span"
                });



                $.validator.addMethod("categoryName", function(value, element) {
                        return this.optional(element) ||
                            /^[A-Z][a-z]{2,15}$/.test(value);
                    },
                    "Category must start with capital letter"
                );


                $('#form').on('submit', function(e) {
                    if (!$(this).valid()) {
                        e.preventDefault(); // Prevent form submission
                    }
                });



            });
        </script>



    </section>
@endsection --}}



@endsection
