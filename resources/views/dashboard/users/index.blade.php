
@extends('dashboard.layouts.app')

@section('title')
Users
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Users
                <a class="btn btn-success float-end my-3" href="{{ route('users.create') }}"><i class="bi bi-plus-lg me-2"></i>User</a>
            </div>
           <div class="card-body">

                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection