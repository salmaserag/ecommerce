
@extends('dashboard.layouts.app')

@section('title')
Categories
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Categories
                <a class="btn btn-success float-end my-3" href="{{ route('categories.create') }}"><i class="bi bi-plus-lg me-2"></i>Category</a>
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