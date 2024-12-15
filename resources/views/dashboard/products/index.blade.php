
@extends('dashboard.layouts.app')

@section('title')
Products
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Products
                <a class="btn btn-success float-end my-3" href="{{ route('products.create') }}"><i class="bi bi-plus-lg me-2"></i>Product</a>
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