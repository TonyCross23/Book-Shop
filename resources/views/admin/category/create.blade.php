@extends('admin.master')

@section('title', 'Category Create')

@section('content')
    <div class="container col-8 offset-2">
        {{-- 
        @if (session('Success'))
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check me-2"></i> {{ session('Success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif --}}

        <div class="card">
            <div class="card-header">
                <h4>Create Category</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin@categoryCreate') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Category Name</label>
                        <input type="text" name="categoryTitle"
                            class="form-control @error('categoryTitle') is-invalid @enderror"
                            value="{{ old('categoryTitle') }}" placeholder="Enter Catgory Title">
                        @error('categoryTitle')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <input type="submit" class="btn btn-primary float-right" value="Create">
                </form>
            </div>
        </div>
    </div>
@endsection
