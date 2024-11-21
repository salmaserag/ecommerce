@extends('dashboard.layouts.app')

@section('title')
    Edit_Role
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
                    <h4>Edit Role</h4>

                </div>

                <form action="{{ route('roles.update', ['role' => $role->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-floating">

                                    <x-form.input value="{{ $role ? $role->name : old('name') }}" label="Role Name"
                                        id="name" name="name" placeholder="Role Name" type="text"
                                        for="name" />

                                </div>
                            </div>
                            <div class="col-12 mb-3">

                                <div class="form-floating">

                                    <x-form.texterea type="text" name="description" id="description"
                                        placeholder="Description" value="{{ $role ? $role->description : old('description') }}" for="description"
                                        label="Description" />
                                        
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="div">
                            @foreach ($permissions as $permission)
                                <div class="form-check">


                                    <x-form.input value="{{ $permission->id }}" label="{{ Str::ucfirst(str_replace('.', ' ', $permission->name)) }}"
                                        id="flexCheckDefault" name="permission_id[]" placeholder="" type="checkbox"
                                        for="flexCheckDefault" class="form-check-input" />

                                </div>
                            @endforeach
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
